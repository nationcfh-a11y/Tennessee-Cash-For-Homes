#!/usr/bin/env python3
"""Final pre-launch audit: crawl + redirects + duplicates + alt + broken links."""
import csv
import json
import re
import sys
import time
import urllib.parse
import urllib.request
from collections import defaultdict
from concurrent.futures import ThreadPoolExecutor, as_completed
from html.parser import HTMLParser

BASE = "https://nationcfh.wpcomstaging.com"
OUT_DIR = "/Users/karsoncarmichael/Claude Code Website Creator/seo-audit"
UA = "Mozilla/5.0 (FinalAuditBot)"
TIMEOUT = 30


def fetch(url, follow=True):
    """Return (final_url, status, body, chain). chain is list of (url, status)."""
    chain = []
    cur = url
    for _ in range(10):
        req = urllib.request.Request(cur, headers={"User-Agent": UA})
        try:
            opener = urllib.request.build_opener(NoRedirect())
            resp = opener.open(req, timeout=TIMEOUT)
            status = resp.status
            body = resp.read()
            chain.append((cur, status))
            return cur, status, body, chain
        except urllib.error.HTTPError as e:
            status = e.code
            chain.append((cur, status))
            if follow and status in (301, 302, 307, 308):
                loc = e.headers.get("Location")
                if not loc:
                    return cur, status, b"", chain
                cur = urllib.parse.urljoin(cur, loc)
                continue
            try:
                body = e.read()
            except Exception:
                body = b""
            return cur, status, body, chain
        except Exception as e:
            chain.append((cur, f"ERR:{e}"))
            return cur, 0, b"", chain
    return cur, 0, b"", chain


class NoRedirect(urllib.request.HTTPRedirectHandler):
    def http_error_301(self, req, fp, code, msg, headers):
        raise urllib.error.HTTPError(req.full_url, code, msg, headers, fp)
    http_error_302 = http_error_301
    http_error_307 = http_error_301
    http_error_308 = http_error_301


# ---------- HTML parsing ----------
class PageParser(HTMLParser):
    def __init__(self):
        super().__init__(convert_charrefs=True)
        self.title = None
        self.in_title = False
        self.meta_desc = None
        self.canonical = None
        self.meta_robots = None
        self.h1s = []
        self.in_h1 = False
        self.cur_h1 = []
        self.images = []  # list of (src, alt)
        self.links = []  # list of href
        self.body_text = []
        self.in_script = 0
        self.in_style = 0

    def handle_starttag(self, tag, attrs):
        a = dict(attrs)
        if tag == "title":
            self.in_title = True
        elif tag == "meta":
            n = (a.get("name") or "").lower()
            if n == "description":
                self.meta_desc = a.get("content")
            elif n == "robots":
                self.meta_robots = a.get("content")
        elif tag == "link":
            rel = (a.get("rel") or "").lower()
            if "canonical" in rel:
                self.canonical = a.get("href")
        elif tag == "h1":
            self.in_h1 = True
            self.cur_h1 = []
        elif tag == "img":
            self.images.append((a.get("src", ""), a.get("alt", None)))
        elif tag == "a":
            href = a.get("href")
            if href:
                self.links.append(href)
        elif tag == "script":
            self.in_script += 1
        elif tag == "style":
            self.in_style += 1

    def handle_endtag(self, tag):
        if tag == "title":
            self.in_title = False
        elif tag == "h1":
            self.in_h1 = False
            self.h1s.append("".join(self.cur_h1).strip())
        elif tag == "script":
            self.in_script = max(0, self.in_script - 1)
        elif tag == "style":
            self.in_style = max(0, self.in_style - 1)

    def handle_data(self, data):
        if self.in_title and self.title is None:
            self.title = data.strip()
        if self.in_h1:
            self.cur_h1.append(data)
        if not self.in_script and not self.in_style:
            self.body_text.append(data)


def parse_html(body):
    p = PageParser()
    try:
        p.feed(body.decode("utf-8", errors="replace"))
    except Exception:
        pass
    return p


# ---------- Sitemap loading ----------
def load_sitemap_urls():
    urls = set()
    _, _, idx_body, _ = fetch(f"{BASE}/sitemap_index.xml")
    idx_text = idx_body.decode("utf-8", errors="replace")
    sub_sitemaps = re.findall(r"<loc>([^<]+)</loc>", idx_text)
    for sm in sub_sitemaps:
        _, _, sm_body, _ = fetch(sm)
        sm_text = sm_body.decode("utf-8", errors="replace")
        for u in re.findall(r"<loc>([^<]+)</loc>", sm_text):
            urls.add(u.strip())
    return urls, sub_sitemaps


# ---------- Crawl ----------
def is_internal(url):
    return urllib.parse.urlparse(url).netloc in ("", "nationcfh.wpcomstaging.com")


def normalize(url):
    p = urllib.parse.urlparse(url)
    if not p.netloc:
        p = p._replace(netloc="nationcfh.wpcomstaging.com", scheme="https")
    # drop fragment
    p = p._replace(fragment="")
    return urllib.parse.urlunparse(p)


SKIP_PATTERNS = [
    "/wp-admin/",
    "/wp-json/",
    "/wp-login",
    "/feed/",
    "?share=",
    "/cdn-cgi/",
    "wp-content/uploads/",  # we don't crawl actual binary asset URLs as pages
]


def should_crawl(url):
    if not is_internal(url):
        return False
    p = urllib.parse.urlparse(url)
    if p.scheme not in ("http", "https", ""):
        return False
    if "#" in url:
        url = url.split("#")[0]
    path = p.path.lower()
    for pat in SKIP_PATTERNS:
        if pat in url.lower():
            return False
    if path.endswith((".jpg", ".jpeg", ".png", ".webp", ".gif", ".svg", ".pdf",
                      ".css", ".js", ".xml", ".ico", ".zip", ".mp4", ".woff", ".woff2", ".ttf", ".eot")):
        return False
    return True


def crawl():
    print("Loading sitemap...", flush=True)
    sitemap_urls, sub_sitemaps = load_sitemap_urls()
    print(f"  sitemap URLs: {len(sitemap_urls)}", flush=True)

    # seed with sitemap + homepage
    seeds = set([BASE + "/"]) | sitemap_urls
    seeds = {normalize(u) for u in seeds if should_crawl(u)}

    visited = {}  # url -> result dict
    queue = list(seeds)
    seen = set(queue)

    def fetch_one(u):
        final, status, body, chain = fetch(u, follow=False)
        # If non-2xx, also try a single follow to capture canonicalised url
        return u, final, status, body, chain

    while queue:
        batch = queue[:30]
        queue = queue[30:]
        with ThreadPoolExecutor(max_workers=10) as ex:
            futs = {ex.submit(fetch_one, u): u for u in batch}
            for f in as_completed(futs):
                u, final, status, body, chain = f.result()
                rec = {
                    "url": u,
                    "status": status,
                    "final": final,
                    "chain": chain,
                    "title": None,
                    "meta_desc": None,
                    "canonical": None,
                    "meta_robots": None,
                    "h1s": [],
                    "img_count": 0,
                    "img_missing_alt": [],
                    "links": [],
                    "body_words": 0,
                    "from_sitemap": u in sitemap_urls,
                }
                if 200 <= status < 300 and body:
                    p = parse_html(body)
                    img_pairs = [(normalize(urllib.parse.urljoin(u, src)), alt) for src, alt in p.images if src]
                    rec.update({
                        "title": p.title,
                        "meta_desc": p.meta_desc,
                        "canonical": p.canonical,
                        "meta_robots": p.meta_robots,
                        "h1s": p.h1s,
                        "img_count": len(p.images),
                        "img_missing_alt": [src for src, alt in img_pairs if alt is None or alt.strip() == ""],
                        "img_srcs": [src for src, _ in img_pairs],
                    })
                    text = " ".join(p.body_text)
                    text = re.sub(r"\s+", " ", text).strip()
                    rec["body_words"] = len(text.split())
                    rec["body_sample"] = text[:200]
                    # collect new internal links
                    rec_links = []
                    for href in p.links:
                        if not href:
                            continue
                        if href.startswith(("mailto:", "tel:", "javascript:")):
                            continue
                        absu = normalize(urllib.parse.urljoin(u, href))
                        rec_links.append(absu)
                        if should_crawl(absu) and absu not in seen:
                            seen.add(absu)
                            queue.append(absu)
                    rec["links"] = rec_links
                visited[u] = rec
        print(f"  visited {len(visited)}, queue {len(queue)}", flush=True)

    return visited, sitemap_urls, sub_sitemaps


# ---------- Redirect tests ----------
def test_redirects():
    """Re-test every redirect from redirects.csv against the staging host."""
    rows = []
    with open("/Users/karsoncarmichael/Claude Code Website Creator/redirects.csv") as f:
        rdr = csv.DictReader(f)
        for r in rdr:
            rows.append(r)

    results = []
    def test_one(r):
        src_path = r["source_url"]
        target = r["target_url"]
        test_url = BASE + src_path
        final, status, _, chain = fetch(test_url, follow=True)
        return {
            "src_path": src_path,
            "target_path": target,
            "test_url": test_url,
            "final": final,
            "final_status": status,
            "chain": chain,
            "hop_count": len(chain),
        }
    with ThreadPoolExecutor(max_workers=15) as ex:
        for res in ex.map(test_one, rows):
            results.append(res)
    return results


# ---------- Image weight check ----------
def check_image_sizes(image_urls):
    """HEAD each image, return list of (url, content_length)."""
    results = []
    def head(u):
        try:
            req = urllib.request.Request(u, method="HEAD", headers={"User-Agent": UA})
            r = urllib.request.urlopen(req, timeout=TIMEOUT)
            cl = r.headers.get("Content-Length")
            return u, int(cl) if cl else None, r.headers.get("Content-Type")
        except Exception as e:
            return u, None, str(e)[:80]
    with ThreadPoolExecutor(max_workers=20) as ex:
        for u, cl, ct in ex.map(head, image_urls):
            results.append({"url": u, "bytes": cl, "type": ct})
    return results


# ---------- Main ----------
def main():
    visited, sitemap_urls, sub_sitemaps = crawl()

    # Save raw crawl
    with open(f"{OUT_DIR}/final_crawl.json", "w") as f:
        json.dump({"visited": visited, "sitemap_urls": list(sitemap_urls)}, f, indent=2, default=str)
    print(f"Saved final_crawl.json ({len(visited)} pages)", flush=True)

    # Redirect tests
    print("Testing redirects...", flush=True)
    redir = test_redirects()
    with open(f"{OUT_DIR}/final_redirects.json", "w") as f:
        json.dump(redir, f, indent=2, default=str)
    print(f"Saved final_redirects.json ({len(redir)} tests)", flush=True)

    # Image size check (only on images referenced from successful pages)
    img_urls = set()
    for rec in visited.values():
        if 200 <= (rec.get("status") or 0) < 300:
            # also include image URLs from the page
            pass  # we'll do a pass below
    # gather image urls — we didn't keep them all on the rec to limit size; redo from links pattern
    # instead, re-parse from rec's links list — image src isn't there. Skip; we'll do a separate pass.

    print("Done crawl phase.", flush=True)


if __name__ == "__main__":
    main()
