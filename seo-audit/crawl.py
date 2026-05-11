#!/usr/bin/env python3
"""Crawl both Wix and WordPress staging, extract SEO metadata, and dump to JSON."""
import json
import re
import sys
import time
import urllib.parse as up
import warnings
from concurrent.futures import ThreadPoolExecutor, as_completed
from xml.etree import ElementTree as ET

import requests
from bs4 import BeautifulSoup

warnings.filterwarnings("ignore")

WIX = "https://www.tennesseecashforhomes.com"
WP = "https://nationcfh.wpcomstaging.com"
UA = "Mozilla/5.0 (compatible; SEO-Audit/1.0)"
SESSION = requests.Session()
SESSION.headers.update({"User-Agent": UA})
TIMEOUT = 25

NS = {"sm": "http://www.sitemaps.org/schemas/sitemap/0.9"}


def fetch(url, allow_redirects=True):
    try:
        r = SESSION.get(url, timeout=TIMEOUT, allow_redirects=allow_redirects)
        return r
    except Exception as e:
        return e


def parse_sitemap(url, seen=None):
    """Return list of page URLs found, recursing through sitemap indexes."""
    if seen is None:
        seen = set()
    if url in seen:
        return []
    seen.add(url)

    r = fetch(url)
    if not hasattr(r, "status_code") or r.status_code != 200:
        return []
    out = []
    try:
        root = ET.fromstring(r.content)
    except ET.ParseError:
        return []
    tag = root.tag.lower()
    if "sitemapindex" in tag:
        for sm in root.findall("sm:sitemap", NS):
            loc = sm.findtext("sm:loc", default="", namespaces=NS).strip()
            if loc:
                out.extend(parse_sitemap(loc, seen))
    else:
        for u in root.findall("sm:url", NS):
            loc = u.findtext("sm:loc", default="", namespaces=NS).strip()
            if loc:
                out.append(loc)
    return out


def normalize_path(url):
    p = up.urlparse(url)
    path = p.path or "/"
    if path.endswith("/") and path != "/":
        path = path[:-1]
    return path.lower()


def extract_seo(url):
    info = {"url": url, "status": None, "final_url": None, "title": None,
            "meta_description": None, "h1s": [], "canonical": None,
            "meta_robots": None, "og_title": None, "og_description": None,
            "img_total": 0, "img_missing_alt": 0, "img_missing_alt_srcs": [],
            "internal_links": [], "error": None}
    try:
        r = SESSION.get(url, timeout=TIMEOUT, allow_redirects=True)
        info["status"] = r.status_code
        info["final_url"] = r.url
        if r.status_code != 200:
            return info
        soup = BeautifulSoup(r.text, "html.parser")
        if soup.title and soup.title.string:
            info["title"] = soup.title.string.strip()
        md = soup.find("meta", attrs={"name": "description"})
        if md and md.get("content"):
            info["meta_description"] = md["content"].strip()
        mr = soup.find("meta", attrs={"name": "robots"})
        if mr and mr.get("content"):
            info["meta_robots"] = mr["content"].strip()
        ogt = soup.find("meta", attrs={"property": "og:title"})
        if ogt and ogt.get("content"):
            info["og_title"] = ogt["content"].strip()
        ogd = soup.find("meta", attrs={"property": "og:description"})
        if ogd and ogd.get("content"):
            info["og_description"] = ogd["content"].strip()
        can = soup.find("link", attrs={"rel": "canonical"})
        if can and can.get("href"):
            info["canonical"] = can["href"].strip()
        info["h1s"] = [h.get_text(" ", strip=True) for h in soup.find_all("h1")]
        for img in soup.find_all("img"):
            info["img_total"] += 1
            alt = img.get("alt")
            if alt is None or alt.strip() == "":
                info["img_missing_alt"] += 1
                src = img.get("src") or img.get("data-src") or ""
                info["img_missing_alt_srcs"].append(src[:200])
        # internal link collection (for broken-link check)
        host = up.urlparse(url).netloc
        for a in soup.find_all("a", href=True):
            href = a["href"].strip()
            if not href or href.startswith(("mailto:", "tel:", "javascript:", "#")):
                continue
            absu = up.urljoin(url, href)
            ph = up.urlparse(absu)
            if ph.netloc == host:
                info["internal_links"].append(absu.split("#")[0])
    except Exception as e:
        info["error"] = f"{type(e).__name__}: {e}"
    return info


def crawl(label, base):
    print(f"[{label}] fetching sitemap...", flush=True)
    sm_urls = [f"{base}/sitemap.xml", f"{base}/sitemap_index.xml", f"{base}/wp-sitemap.xml"]
    pages = []
    for sm in sm_urls:
        pages = parse_sitemap(sm)
        if pages:
            print(f"[{label}] found {len(pages)} URLs in {sm}", flush=True)
            break
    # de-dupe, keep only same host
    host = up.urlparse(base).netloc
    seen, kept = set(), []
    for u in pages:
        if up.urlparse(u).netloc != host:
            continue
        if u in seen:
            continue
        seen.add(u)
        kept.append(u)
    print(f"[{label}] crawling {len(kept)} URLs...", flush=True)
    results = []
    with ThreadPoolExecutor(max_workers=6) as ex:
        futures = {ex.submit(extract_seo, u): u for u in kept}
        done = 0
        for f in as_completed(futures):
            results.append(f.result())
            done += 1
            if done % 10 == 0:
                print(f"[{label}] {done}/{len(kept)}", flush=True)
    return results


if __name__ == "__main__":
    out = {}
    out["wix"] = crawl("wix", WIX)
    out["wp"] = crawl("wp", WP)
    with open("/Users/karsoncarmichael/Claude Code Website Creator/seo-audit/crawl.json", "w") as fh:
        json.dump(out, fh, indent=2)
    print(f"wix pages: {len(out['wix'])}, wp pages: {len(out['wp'])}")
