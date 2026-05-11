#!/usr/bin/env python3
"""Analyze crawl.json: compare metadata, check redirects, robots, sitemap completeness, alt text, broken links."""
import json
import urllib.parse as up
import warnings
from concurrent.futures import ThreadPoolExecutor, as_completed
from xml.etree import ElementTree as ET

import requests

warnings.filterwarnings("ignore")

WIX_HOST = "www.tennesseecashforhomes.com"
WP_HOST = "nationcfh.wpcomstaging.com"
WIX = f"https://{WIX_HOST}"
WP = f"https://{WP_HOST}"
UA = "Mozilla/5.0 (compatible; SEO-Audit/1.0)"
SESSION = requests.Session()
SESSION.headers.update({"User-Agent": UA})

with open("/Users/karsoncarmichael/Claude Code Website Creator/seo-audit/crawl.json") as fh:
    DATA = json.load(fh)


def norm_path(url):
    p = up.urlparse(url)
    path = p.path or "/"
    if path != "/" and path.endswith("/"):
        path = path[:-1]
    return path


def by_path(pages):
    out = {}
    for p in pages:
        out[norm_path(p["url"])] = p
    return out


WIX_BY_PATH = by_path(DATA["wix"])
WP_BY_PATH = by_path(DATA["wp"])

# ---------------- 1. Side-by-side metadata comparison ----------------
def compare_metadata():
    rows = []
    all_paths = sorted(set(WIX_BY_PATH) | set(WP_BY_PATH))
    for path in all_paths:
        w = WIX_BY_PATH.get(path)
        p = WP_BY_PATH.get(path)
        row = {
            "path": path,
            "in_wix": w is not None,
            "in_wp": p is not None,
            "wix_title": w["title"] if w else None,
            "wp_title": p["title"] if p else None,
            "wix_meta": w["meta_description"] if w else None,
            "wp_meta": p["meta_description"] if p else None,
            "wix_h1": (w["h1s"][0] if w and w["h1s"] else None) if w else None,
            "wp_h1": (p["h1s"][0] if p and p["h1s"] else None) if p else None,
            "wix_canonical": w["canonical"] if w else None,
            "wp_canonical": p["canonical"] if p else None,
            "wp_h1_count": len(p["h1s"]) if p else None,
        }
        issues = []
        if w and not p:
            issues.append("MISSING_ON_WP")
        if p and not w:
            issues.append("NEW_ON_WP")
        if w and p:
            if not row["wp_title"]:
                issues.append("WP_TITLE_MISSING")
            if not row["wp_meta"]:
                issues.append("WP_META_MISSING")
            if row["wp_h1_count"] == 0:
                issues.append("WP_H1_MISSING")
            elif row["wp_h1_count"] > 1:
                issues.append(f"WP_MULTIPLE_H1({row['wp_h1_count']})")
            if row["wix_title"] and row["wp_title"] and row["wix_title"] != row["wp_title"]:
                issues.append("TITLE_MISMATCH")
            if row["wix_meta"] and row["wp_meta"] and row["wix_meta"] != row["wp_meta"]:
                issues.append("META_MISMATCH")
            if row["wix_h1"] and row["wp_h1"] and row["wix_h1"] != row["wp_h1"]:
                issues.append("H1_MISMATCH")
            # canonical sanity: should point to same path on its own host
            if p["canonical"]:
                cp = up.urlparse(p["canonical"])
                if cp.netloc and cp.netloc not in (WP_HOST, WIX_HOST):
                    issues.append("WP_CANONICAL_FOREIGN_HOST")
                cpath = cp.path or "/"
                if cpath != "/" and cpath.endswith("/"):
                    cpath = cpath[:-1]
                if cpath != path:
                    issues.append("WP_CANONICAL_PATH_MISMATCH")
            else:
                issues.append("WP_CANONICAL_MISSING")
        row["issues"] = issues
        rows.append(row)
    return rows

# ---------------- 2. Redirect check: Wix URL -> WP ----------------
def check_redirect(wix_url):
    """Simulate post-domain-transfer: hit Wix URL on the WP host (path) and follow chain."""
    path = norm_path(wix_url) or "/"
    target = f"{WP}{path}"
    try:
        r = SESSION.head(target, timeout=20, allow_redirects=False)
        chain = []
        cur_status = r.status_code
        cur_location = r.headers.get("location", "")
        chain.append({"status": r.status_code, "location": cur_location})
        # follow up to 5 hops
        next_url = up.urljoin(target, cur_location) if cur_location else None
        hops = 0
        while next_url and 300 <= cur_status < 400 and hops < 5:
            rr = SESSION.head(next_url, timeout=20, allow_redirects=False)
            cur_status = rr.status_code
            loc = rr.headers.get("location", "")
            chain.append({"status": rr.status_code, "location": loc, "url": next_url})
            next_url = up.urljoin(next_url, loc) if loc else None
            hops += 1
        # final status: get with follow_redirects
        rf = SESSION.get(target, timeout=20, allow_redirects=True)
        return {"wix_path": path, "tested": target, "first_status": r.status_code,
                "first_location": chain[0]["location"], "final_status": rf.status_code,
                "final_url": rf.url, "chain": chain}
    except Exception as e:
        return {"wix_path": path, "tested": target, "error": f"{type(e).__name__}: {e}"}


def check_redirects():
    paths = [p["url"] for p in DATA["wix"]]
    out = []
    with ThreadPoolExecutor(max_workers=8) as ex:
        futures = {ex.submit(check_redirect, u): u for u in paths}
        for f in as_completed(futures):
            out.append(f.result())
    return out

# ---------------- 3. Robots.txt + indexing ----------------
def check_robots():
    r = SESSION.get(f"{WP}/robots.txt", timeout=20)
    txt = r.text if r.status_code == 200 else ""
    blocked_googlebot = False
    discouraged = False
    # crude detect: WordPress "discourage search engines" emits Disallow: /
    lines = [l.strip() for l in txt.splitlines()]
    cur_agents = []
    blocks = []
    cur = None
    for line in lines:
        if not line or line.startswith("#"):
            continue
        if line.lower().startswith("user-agent:"):
            ua = line.split(":", 1)[1].strip()
            if cur is None:
                cur = {"agents": [], "rules": []}
            cur["agents"].append(ua)
        elif line.lower().startswith(("disallow:", "allow:")):
            if cur is not None:
                cur["rules"].append(line)
                # next non-UA line keeps adding to current; new UA starts new block
        elif line.lower().startswith("sitemap:"):
            blocks.append({"sitemap": line.split(":", 1)[1].strip()})
        # heuristic: split blocks on blank lines we already skipped — fine
    # simpler scan:
    sections = []
    cur_block = None
    for line in lines:
        if not line or line.startswith("#"):
            if cur_block is not None:
                sections.append(cur_block)
                cur_block = None
            continue
        if line.lower().startswith("user-agent:"):
            if cur_block is None or cur_block.get("rules"):
                if cur_block:
                    sections.append(cur_block)
                cur_block = {"agents": [], "rules": []}
            cur_block["agents"].append(line.split(":", 1)[1].strip())
        elif line.lower().startswith(("disallow:", "allow:")):
            if cur_block is None:
                cur_block = {"agents": ["*"], "rules": []}
            cur_block["rules"].append(line)
    if cur_block:
        sections.append(cur_block)

    for s in sections:
        agents = [a.lower() for a in s["agents"]]
        if "googlebot" in agents or "*" in agents:
            for rule in s["rules"]:
                if rule.lower().strip() == "disallow: /":
                    if "*" in agents:
                        discouraged = True
                    if "googlebot" in agents:
                        blocked_googlebot = True
    return {"status": r.status_code, "body": txt, "blocked_googlebot": blocked_googlebot,
            "discouraged_search_engines": discouraged, "sections": sections}

# ---------------- 4. Sitemap coverage ----------------
def sitemap_coverage():
    # Compare crawled URLs vs sitemap URLs (we already used sitemap to crawl,
    # but check if the staging exposes wp pages NOT in sitemap by hitting
    # the public top-level pages and post types)
    sm_urls = set()
    # walk sitemap_index
    r = SESSION.get(f"{WP}/sitemap_index.xml", timeout=20)
    NS = {"sm": "http://www.sitemaps.org/schemas/sitemap/0.9"}
    if r.status_code == 200:
        try:
            root = ET.fromstring(r.content)
            child_sms = [s.findtext("sm:loc", default="", namespaces=NS).strip()
                         for s in root.findall("sm:sitemap", NS)]
        except Exception:
            child_sms = []
        for cs in child_sms:
            try:
                rr = SESSION.get(cs, timeout=20)
                sub = ET.fromstring(rr.content)
                for u in sub.findall("sm:url", NS):
                    loc = u.findtext("sm:loc", default="", namespaces=NS).strip()
                    if loc:
                        sm_urls.add(loc)
            except Exception:
                pass
    # Compare to crawl set
    crawled = {p["url"] for p in DATA["wp"] if p["status"] == 200}
    missing_from_sitemap = sorted(crawled - sm_urls)
    extra_in_sitemap = sorted(sm_urls - crawled)
    return {"sitemap_count": len(sm_urls), "crawled_count": len(crawled),
            "missing_from_sitemap": missing_from_sitemap,
            "extra_in_sitemap": extra_in_sitemap}

# ---------------- 5. Alt text audit (already collected) ----------------
def alt_audit():
    issues = []
    total_imgs = 0
    total_missing = 0
    for p in DATA["wp"]:
        total_imgs += p["img_total"]
        total_missing += p["img_missing_alt"]
        if p["img_missing_alt"]:
            issues.append({"url": p["url"], "missing": p["img_missing_alt"],
                           "total": p["img_total"], "examples": p["img_missing_alt_srcs"][:5]})
    return {"total_imgs": total_imgs, "total_missing_alt": total_missing,
            "pages_with_missing": len(issues), "details": issues}

# ---------------- 6. Broken link check (HEAD on every internal link discovered) ----------------
def broken_links():
    seen = set()
    edges = {}  # url -> [pages it appears on]
    for p in DATA["wp"]:
        for href in p["internal_links"]:
            seen.add(href)
            edges.setdefault(href, []).append(p["url"])
    print(f"[broken] checking {len(seen)} unique internal links...")

    def check(u):
        try:
            r = SESSION.head(u, timeout=15, allow_redirects=True)
            sc = r.status_code
            if sc == 405:  # some servers reject HEAD
                r = SESSION.get(u, timeout=15, allow_redirects=True, stream=True)
                sc = r.status_code
                r.close()
            return (u, sc, r.url)
        except Exception as e:
            return (u, None, f"{type(e).__name__}: {e}")
    results = []
    with ThreadPoolExecutor(max_workers=10) as ex:
        futures = {ex.submit(check, u): u for u in seen}
        done = 0
        for f in as_completed(futures):
            results.append(f.result())
            done += 1
            if done % 50 == 0:
                print(f"[broken] {done}/{len(seen)}")
    broken = []
    for u, sc, final in results:
        if sc is None or sc >= 400:
            broken.append({"url": u, "status": sc, "final": final, "found_on": edges[u][:5]})
    return {"checked": len(seen), "broken_count": len(broken), "broken": broken}


if __name__ == "__main__":
    out = {}
    print("comparing metadata...")
    out["metadata"] = compare_metadata()
    print("checking robots.txt...")
    out["robots"] = check_robots()
    print("checking sitemap coverage...")
    out["sitemap"] = sitemap_coverage()
    print("alt text audit...")
    out["alt"] = alt_audit()
    print("checking redirects...")
    out["redirects"] = check_redirects()
    print("broken-link check...")
    out["broken"] = broken_links()
    with open("/Users/karsoncarmichael/Claude Code Website Creator/seo-audit/analysis.json", "w") as fh:
        json.dump(out, fh, indent=2)
    print("done")
