#!/usr/bin/env python3
"""
Compress every image >200KB to WebP <200KB.

Strategy:
- Download via i0.wp.com (the live URL, which is what's served on the page).
- Compute target dimensions: cap longest side at 1600px (mobile-safe, retina-OK).
- Convert to WebP with quality=85; if still >200KB, drop quality until it fits
  or we hit 60. If still too big, downscale 10% and retry.
- Save with deterministic filename derived from the original path so the user
  can match each output back to its source for re-upload.
"""
import io
import json
import os
import re
import urllib.parse
import urllib.request
from concurrent.futures import ThreadPoolExecutor
from PIL import Image

OUT_DIR = "/Users/karsoncarmichael/Claude Code Website Creator/seo-audit"
COMPRESS_DIR = "/Users/karsoncarmichael/Claude Code Website Creator/compressed-images"
TARGET_BYTES = 200 * 1024
MAX_LONGEST_SIDE = 1600
UA = "Mozilla/5.0 (TCFH-Compress)"

os.makedirs(COMPRESS_DIR, exist_ok=True)

with open(f"{OUT_DIR}/final_image_sizes.json") as f:
    sizes = json.load(f)

# Filter to >200KB only
big = [s for s in sizes if (s.get("bytes") or 0) > TARGET_BYTES]
big.sort(key=lambda s: -s["bytes"])
print(f"Images >200KB to compress: {len(big)}")
print(f"Largest 7 (process first):")
for s in big[:7]:
    print(f"  {s['bytes']/1024:7.1f} KB  {s['url']}")


def safe_name(url):
    """Make a stable filename from the URL."""
    p = urllib.parse.urlparse(url)
    base = os.path.basename(p.path) or "image"
    base = re.sub(r"[^a-zA-Z0-9._-]", "_", base)
    if not base.lower().endswith((".jpg", ".jpeg", ".png", ".webp")):
        base += ".bin"
    # Strip extension; we'll add .webp
    base = os.path.splitext(base)[0]
    # Add a short hash from query/path so different sizes of the same image don't collide
    hsh = abs(hash(url)) % (10**8)
    return f"{base}_{hsh}.webp"


def fetch_image(url):
    req = urllib.request.Request(url, headers={"User-Agent": UA})
    with urllib.request.urlopen(req, timeout=60) as r:
        return r.read()


def compress_one(item):
    url = item["url"]
    orig_bytes = item["bytes"]
    out_path = os.path.join(COMPRESS_DIR, safe_name(url))
    if os.path.exists(out_path):
        return {"url": url, "out": out_path, "skipped": True, "out_bytes": os.path.getsize(out_path)}

    try:
        raw = fetch_image(url)
    except Exception as e:
        return {"url": url, "error": f"fetch: {e}"}

    try:
        img = Image.open(io.BytesIO(raw))
        if img.mode in ("P", "RGBA"):
            # WebP can keep alpha but transparent in JPG-only contexts; convert smart
            if img.mode == "P":
                img = img.convert("RGBA" if "transparency" in img.info else "RGB")
        # Resize if longest side too big
        w, h = img.size
        if max(w, h) > MAX_LONGEST_SIDE:
            scale = MAX_LONGEST_SIDE / float(max(w, h))
            img = img.resize((int(w * scale), int(h * scale)), Image.LANCZOS)

        # Try descending quality until under target
        quality = 85
        for attempt in range(8):
            buf = io.BytesIO()
            img.save(buf, format="WEBP", quality=quality, method=6)
            sz = buf.tell()
            if sz <= TARGET_BYTES:
                break
            # First try lowering quality, then resizing
            if quality > 60:
                quality -= 5
            else:
                w2, h2 = img.size
                img = img.resize((int(w2 * 0.9), int(h2 * 0.9)), Image.LANCZOS)
                quality = 80
        with open(out_path, "wb") as f:
            f.write(buf.getvalue())
        return {
            "url": url,
            "orig_bytes": orig_bytes,
            "out_bytes": sz,
            "out": out_path,
            "final_quality": quality,
            "final_size": img.size,
            "fit": sz <= TARGET_BYTES,
        }
    except Exception as e:
        return {"url": url, "error": f"compress: {e}"}


print("\nStarting compression (priority: top 7 first)...")
results = []

# Top 7 sequentially so we can show progress in order
for i, item in enumerate(big[:7], 1):
    r = compress_one(item)
    if "error" in r:
        print(f"  [{i}/7] ERROR  {r['url']}\n          {r['error']}")
    else:
        kb_in = (r.get("orig_bytes") or 0) / 1024
        kb_out = r["out_bytes"] / 1024
        print(f"  [{i}/7] {kb_in:7.1f} KB → {kb_out:6.1f} KB  q={r['final_quality']}  {r['final_size']}  fit={r['fit']}")
    results.append(r)

# Remaining in parallel
print(f"\nProcessing remaining {len(big) - 7} images in parallel...")
with ThreadPoolExecutor(max_workers=6) as ex:
    for r in ex.map(compress_one, big[7:]):
        if "error" in r:
            print(f"  ERROR  {r['url']}: {r['error']}")
        else:
            kb_in = (r.get("orig_bytes") or 0) / 1024
            kb_out = r["out_bytes"] / 1024
            print(f"  {kb_in:7.1f} → {kb_out:6.1f} KB  q={r['final_quality']}  {r['final_size']}  fit={r['fit']}")
        results.append(r)

# Summary
fit = [r for r in results if r.get("fit")]
unfit = [r for r in results if "error" not in r and not r.get("fit")]
errored = [r for r in results if "error" in r]
total_in = sum((r.get("orig_bytes") or 0) for r in results if "error" not in r)
total_out = sum((r.get("out_bytes") or 0) for r in results if "error" not in r)

print(f"\n{'='*60}")
print(f"COMPRESSION SUMMARY")
print(f"{'='*60}")
print(f"  Total processed:     {len(results)}")
print(f"  Compressed <200KB:   {len(fit)}")
print(f"  Still over 200KB:    {len(unfit)}")
print(f"  Errors:              {len(errored)}")
print(f"  Bytes in:            {total_in/1024/1024:.2f} MB")
print(f"  Bytes out:           {total_out/1024/1024:.2f} MB")
if total_in:
    print(f"  Reduction:           {100*(1 - total_out/total_in):.1f}%")
print(f"\nOutput: {COMPRESS_DIR}/")

# Save manifest mapping each output WebP filename to the original URL
with open(f"{OUT_DIR}/compressed_manifest.json", "w") as f:
    json.dump(results, f, indent=2)
print(f"Manifest: {OUT_DIR}/compressed_manifest.json")
