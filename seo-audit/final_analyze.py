#!/usr/bin/env python3
"""Analyze final_crawl.json + final_redirects.json into a launch report."""
import csv
import json
import os
import re
import urllib.parse
from collections import defaultdict, Counter

OUT_DIR = "/Users/karsoncarmichael/Claude Code Website Creator/seo-audit"
BASE = "https://nationcfh.wpcomstaging.com"

with open(f"{OUT_DIR}/final_crawl.json") as f:
    data = json.load(f)
with open(f"{OUT_DIR}/final_redirects.json") as f:
    redir = json.load(f)

visited = data["visited"]
sitemap_urls = set(data["sitemap_urls"])

# ---------- Status code distribution ----------
status_counts = Counter()
for u, rec in visited.items():
    status_counts[rec.get("status")] += 1

print("=" * 60)
print("STATUS DISTRIBUTION (crawled pages)")
print("=" * 60)
for s, n in sorted(status_counts.items(), key=lambda x: -x[1]):
    print(f"  {s}: {n}")

# Pages with non-200 status
non200 = [(u, rec.get("status")) for u, rec in visited.items() if not (200 <= (rec.get("status") or 0) < 300)]
print(f"\nNon-2xx pages: {len(non200)}")

# Successful pages only
ok_pages = {u: rec for u, rec in visited.items() if 200 <= (rec.get("status") or 0) < 300}
print(f"Successful (2xx) pages: {len(ok_pages)}")


# ---------- Redirects to & from crawl ----------
print("\n" + "=" * 60)
print("REDIRECTS — chains & loops")
print("=" * 60)
chain_issues = []
loop_issues = []
final_404 = []
for r in redir:
    chain = r.get("chain", [])
    urls_in_chain = [c[0] for c in chain]
    # Loops?
    if len(urls_in_chain) != len(set(urls_in_chain)):
        loop_issues.append(r)
    # >2 hops is a chain
    if len(chain) > 2:
        chain_issues.append(r)
    # Final 404
    if r.get("final_status") and r["final_status"] >= 400:
        final_404.append(r)

print(f"Total redirect tests: {len(redir)}")
print(f"  Final 200 OK:                {sum(1 for r in redir if 200 <= (r.get('final_status') or 0) < 300)}")
print(f"  Final 4xx/5xx:               {len(final_404)}")
print(f"  Multi-hop chains (>2 hops):  {len(chain_issues)}")
print(f"  Loops:                       {len(loop_issues)}")

with open(f"{OUT_DIR}/final_redirect_issues.csv", "w", newline="") as f:
    w = csv.writer(f)
    w.writerow(["src_path", "final", "final_status", "hops", "chain_summary"])
    for r in chain_issues + final_404:
        chain_summary = " → ".join(f"{c[0]} [{c[1]}]" for c in r.get("chain", []))
        w.writerow([r["src_path"], r["final"], r["final_status"], r["hop_count"], chain_summary])

if final_404:
    print("\n  Sample final 404s:")
    for r in final_404[:8]:
        print(f"    {r['src_path']} → {r['final_status']} at {r['final']}")

if chain_issues:
    print("\n  Sample multi-hop chains:")
    for r in chain_issues[:5]:
        print(f"    {r['src_path']} ({r['hop_count']} hops)")


# ---------- Internal broken links ----------
print("\n" + "=" * 60)
print("BROKEN INTERNAL LINKS")
print("=" * 60)
def is_internal(url):
    return urllib.parse.urlparse(url).netloc in ("", "nationcfh.wpcomstaging.com")

# A link target is "broken" if visited and not 2xx, OR if not visited and we know nothing
# Build all known statuses
url_status = {u: rec.get("status") for u, rec in visited.items()}

broken_links = []  # list of (source_page, target, target_status)
for src, rec in ok_pages.items():
    for href in rec.get("links", []):
        if not is_internal(href):
            continue
        # strip fragments
        href_clean = href.split("#")[0]
        if href_clean in (BASE, BASE + "/"):
            continue
        # Skip non-html resources
        path = urllib.parse.urlparse(href_clean).path.lower()
        if path.endswith((".jpg", ".jpeg", ".png", ".webp", ".gif", ".svg", ".pdf",
                          ".css", ".js", ".xml", ".ico", ".zip", ".mp4")):
            continue
        if "/wp-admin/" in href_clean or "/wp-json/" in href_clean or "?share=" in href_clean:
            continue
        s = url_status.get(href_clean)
        if s is None:
            continue  # not crawled
        if not (200 <= (s or 0) < 300):
            broken_links.append((src, href_clean, s))

print(f"Broken internal links: {len(broken_links)}")
# Group by target
broken_by_target = defaultdict(list)
for src, tgt, s in broken_links:
    broken_by_target[(tgt, s)].append(src)

print(f"Unique broken targets: {len(broken_by_target)}")
with open(f"{OUT_DIR}/final_broken_links.csv", "w", newline="") as f:
    w = csv.writer(f)
    w.writerow(["target_url", "status", "linked_from"])
    for (tgt, s), srcs in sorted(broken_by_target.items(), key=lambda x: -len(x[1])):
        w.writerow([tgt, s, "; ".join(srcs[:5])])

if broken_by_target:
    print("\n  Top broken targets (by # of pages linking to them):")
    for (tgt, s), srcs in sorted(broken_by_target.items(), key=lambda x: -len(x[1]))[:10]:
        print(f"    [{s}] {tgt}  ← {len(srcs)} pages")


# ---------- Links to redirected URLs ----------
print("\n" + "=" * 60)
print("INTERNAL LINKS TO REDIRECTED URLS")
print("=" * 60)
# A link is "to a redirected URL" if its target is in url_status with 3xx OR if it differs from canonical of its target
redirected_link_count = 0
redirected_link_examples = []
for src, rec in ok_pages.items():
    for href in rec.get("links", []):
        if not is_internal(href):
            continue
        href_clean = href.split("#")[0]
        path = urllib.parse.urlparse(href_clean).path.lower()
        if path.endswith((".jpg", ".jpeg", ".png", ".webp", ".gif", ".svg", ".pdf",
                          ".css", ".js", ".xml", ".ico", ".zip", ".mp4")):
            continue
        if "/wp-admin/" in href_clean or "/wp-json/" in href_clean or "?share=" in href_clean:
            continue
        s = url_status.get(href_clean)
        if s and 300 <= s < 400:
            redirected_link_count += 1
            if len(redirected_link_examples) < 30:
                redirected_link_examples.append((src, href_clean, s))

print(f"Internal links pointing to a redirect: {redirected_link_count}")
for src, tgt, s in redirected_link_examples[:10]:
    print(f"  [{s}] {tgt}  ← {src}")


# ---------- Duplicate titles ----------
print("\n" + "=" * 60)
print("DUPLICATE TITLES, H1s, CANONICALS")
print("=" * 60)
title_map = defaultdict(list)
h1_map = defaultdict(list)
canonical_map = defaultdict(list)
multi_h1 = []
missing_canonical = []
canonical_self_mismatch = []

for u, rec in ok_pages.items():
    t = (rec.get("title") or "").strip()
    if t:
        title_map[t].append(u)
    h1s = rec.get("h1s") or []
    if len(h1s) > 1:
        multi_h1.append((u, h1s))
    if h1s:
        h1_map[h1s[0].strip()].append(u)
    can = rec.get("canonical")
    if not can:
        missing_canonical.append(u)
    else:
        canonical_map[can].append(u)
        # If page has canonical pointing to a *different* URL, that's a "non-self" canonical
        if can.rstrip("/") != u.rstrip("/"):
            canonical_self_mismatch.append((u, can))

dup_titles = {t: us for t, us in title_map.items() if len(us) > 1}
dup_h1s = {h: us for h, us in h1_map.items() if len(us) > 1}
print(f"Total ok pages with title: {sum(1 for u, r in ok_pages.items() if (r.get('title') or '').strip())}")
print(f"Duplicate title strings: {len(dup_titles)}")
print(f"Duplicate H1 strings: {len(dup_h1s)}")
print(f"Pages with multiple H1 tags: {len(multi_h1)}")
print(f"Pages missing canonical: {len(missing_canonical)}")
print(f"Pages whose canonical points elsewhere: {len(canonical_self_mismatch)}")

with open(f"{OUT_DIR}/final_dup_titles.csv", "w", newline="") as f:
    w = csv.writer(f)
    w.writerow(["title", "url_count", "urls"])
    for t, us in sorted(dup_titles.items(), key=lambda x: -len(x[1])):
        w.writerow([t, len(us), "; ".join(us)])

with open(f"{OUT_DIR}/final_dup_h1s.csv", "w", newline="") as f:
    w = csv.writer(f)
    w.writerow(["h1", "url_count", "urls"])
    for h, us in sorted(dup_h1s.items(), key=lambda x: -len(x[1])):
        w.writerow([h, len(us), "; ".join(us)])

with open(f"{OUT_DIR}/final_canonical_issues.csv", "w", newline="") as f:
    w = csv.writer(f)
    w.writerow(["url", "canonical", "issue"])
    for u in missing_canonical:
        w.writerow([u, "", "missing"])
    for u, c in canonical_self_mismatch:
        w.writerow([u, c, "non-self"])

if dup_titles:
    print("\n  Top duplicate titles:")
    for t, us in sorted(dup_titles.items(), key=lambda x: -len(x[1]))[:5]:
        print(f"    [{len(us)}] {t!r}")
        for u in us[:3]:
            print(f"        {u}")

if multi_h1:
    print("\n  Pages with multiple H1 tags:")
    for u, h1s in multi_h1[:10]:
        print(f"    {u}  → {len(h1s)} H1s: {h1s[:2]}...")


# ---------- Alt text ----------
print("\n" + "=" * 60)
print("IMAGE ALT TEXT")
print("=" * 60)
all_imgs = 0
missing_alt_count = 0
pages_missing_alt = []
for u, rec in ok_pages.items():
    n_imgs = rec.get("img_count") or 0
    n_missing = len(rec.get("img_missing_alt") or [])
    all_imgs += n_imgs
    missing_alt_count += n_missing
    if n_missing > 0:
        pages_missing_alt.append((u, n_missing, n_imgs, rec.get("img_missing_alt")))

print(f"Total <img> tags across crawled pages: {all_imgs}")
print(f"Total missing alt: {missing_alt_count}")
print(f"Pages with at least one missing alt: {len(pages_missing_alt)}")

with open(f"{OUT_DIR}/final_alt_issues.csv", "w", newline="") as f:
    w = csv.writer(f)
    w.writerow(["url", "missing_count", "total_imgs", "missing_srcs"])
    for u, n, total, srcs in sorted(pages_missing_alt, key=lambda x: -x[1]):
        w.writerow([u, n, total, "; ".join(srcs[:5])])

for u, n, total, srcs in sorted(pages_missing_alt, key=lambda x: -x[1])[:8]:
    print(f"  {u}: {n}/{total} missing alt")


# ---------- Sitemap coverage ----------
print("\n" + "=" * 60)
print("SITEMAP COVERAGE")
print("=" * 60)
crawled_paths = {urllib.parse.urlparse(u).path.rstrip("/") + "/" for u in ok_pages}
sitemap_paths = {urllib.parse.urlparse(u).path.rstrip("/") + "/" for u in sitemap_urls}
in_crawl_not_sitemap = crawled_paths - sitemap_paths
in_sitemap_not_crawl = sitemap_paths - crawled_paths
print(f"Crawled & 200 OK pages:      {len(crawled_paths)}")
print(f"Sitemap declared URLs:       {len(sitemap_paths)}")
print(f"Crawled but NOT in sitemap:  {len(in_crawl_not_sitemap)}")
print(f"In sitemap but NOT crawled:  {len(in_sitemap_not_crawl)}")


# ---------- Placeholder / thin content ----------
print("\n" + "=" * 60)
print("THIN / PLACEHOLDER CONTENT")
print("=" * 60)
PLACEHOLDER_PATTERNS = [
    r"\blorem ipsum\b",
    r"\bplaceholder\b",
    r"\btemplate page\b",
    r"\bcoming soon\b",
    r"\btemporary content\b",
    r"\bthis page is under construction\b",
    r"\btodo\b",
    r"\bplease replace\b",
    r"\bpage title\b\s+sample",
    r"\bjohn doe\b",
    r"\bjane doe\b",
]
thin = []
placeholder_hits = []
for u, rec in ok_pages.items():
    bw = rec.get("body_words") or 0
    if bw < 80:
        thin.append((u, bw))
    body = rec.get("body_sample") or ""
    for pat in PLACEHOLDER_PATTERNS:
        if re.search(pat, body, re.IGNORECASE):
            placeholder_hits.append((u, pat, body[:200]))
            break

print(f"Pages with < 80 body words: {len(thin)}")
for u, bw in sorted(thin, key=lambda x: x[1])[:15]:
    print(f"  {bw} words: {u}")
print(f"\nPages with placeholder text patterns: {len(placeholder_hits)}")
for u, pat, sample in placeholder_hits[:8]:
    print(f"  [{pat}] {u}")
    print(f"    sample: {sample[:120]}")

with open(f"{OUT_DIR}/final_thin_content.csv", "w", newline="") as f:
    w = csv.writer(f)
    w.writerow(["url", "body_words", "issue"])
    for u, bw in sorted(thin, key=lambda x: x[1]):
        w.writerow([u, bw, "thin"])
    for u, pat, _ in placeholder_hits:
        w.writerow([u, "", f"placeholder: {pat}"])


# ---------- Image weight (using saved img_srcs) ----------
print("\n" + "=" * 60)
print("LARGE IMAGE CHECK QUEUE")
print("=" * 60)
all_img_srcs = set()
for u, rec in ok_pages.items():
    for s in rec.get("img_srcs", []) or []:
        if s.startswith("http"):
            all_img_srcs.add(s)
print(f"Unique image URLs to check: {len(all_img_srcs)}")
with open(f"{OUT_DIR}/final_image_urls.txt", "w") as f:
    for s in sorted(all_img_srcs):
        f.write(s + "\n")


# ---------- Summary file ----------
summary = {
    "robots_txt": "BLOCKED (Disallow: /)",  # confirmed earlier
    "sitemap_count": len(sitemap_paths),
    "crawled_ok": len(ok_pages),
    "non_2xx": len(non200),
    "redirect_tests": len(redir),
    "redirect_final_4xx": len(final_404),
    "redirect_chains": len(chain_issues),
    "redirect_loops": len(loop_issues),
    "broken_internal_links": len(broken_links),
    "links_to_redirects": redirected_link_count,
    "duplicate_titles": len(dup_titles),
    "duplicate_h1s": len(dup_h1s),
    "multi_h1_pages": len(multi_h1),
    "missing_canonical": len(missing_canonical),
    "non_self_canonical": len(canonical_self_mismatch),
    "missing_alt_total": missing_alt_count,
    "pages_with_missing_alt": len(pages_missing_alt),
    "thin_pages": len(thin),
    "placeholder_pages": len(placeholder_hits),
    "unique_image_urls": len(all_img_srcs),
}
with open(f"{OUT_DIR}/final_summary.json", "w") as f:
    json.dump(summary, f, indent=2)
print("\nSAVED final_summary.json")
print(json.dumps(summary, indent=2))
