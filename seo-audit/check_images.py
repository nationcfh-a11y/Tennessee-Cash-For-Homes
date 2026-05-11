#!/usr/bin/env python3
"""HEAD every image URL and flag >200KB."""
import json
import urllib.request
from concurrent.futures import ThreadPoolExecutor

OUT = "/Users/karsoncarmichael/Claude Code Website Creator/seo-audit"
UA = "Mozilla/5.0 (FinalAuditBot)"

with open(f"{OUT}/final_image_urls.txt") as f:
    urls = [u.strip() for u in f if u.strip()]

def head(u):
    try:
        req = urllib.request.Request(u, method="HEAD", headers={"User-Agent": UA})
        r = urllib.request.urlopen(req, timeout=20)
        cl = r.headers.get("Content-Length")
        ct = r.headers.get("Content-Type", "")
        return {"url": u, "bytes": int(cl) if cl else None, "type": ct, "status": r.status}
    except Exception as e:
        return {"url": u, "bytes": None, "type": str(e)[:80], "status": 0}

results = []
with ThreadPoolExecutor(max_workers=20) as ex:
    for r in ex.map(head, urls):
        results.append(r)

# >200KB
big = [r for r in results if (r["bytes"] or 0) > 200_000]
big.sort(key=lambda r: -(r["bytes"] or 0))

with open(f"{OUT}/final_image_sizes.json", "w") as f:
    json.dump(results, f, indent=2)

print(f"Total images checked: {len(results)}")
print(f"With Content-Length: {sum(1 for r in results if r['bytes'])}")
print(f"Without Content-Length (chunked/error): {sum(1 for r in results if not r['bytes'])}")
print(f"\nIMAGES > 200KB: {len(big)}")
for r in big[:40]:
    kb = r["bytes"] / 1024
    print(f"  {kb:7.1f} KB  {r['url']}")
