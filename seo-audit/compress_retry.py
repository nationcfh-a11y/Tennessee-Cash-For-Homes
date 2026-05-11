#!/usr/bin/env python3
"""Retry the 11 images that didn't fit under 200KB after the first pass."""
import io
import json
import os
import urllib.parse
import urllib.request
import re
from PIL import Image

OUT_DIR = "/Users/karsoncarmichael/Claude Code Website Creator/seo-audit"
COMPRESS_DIR = "/Users/karsoncarmichael/Claude Code Website Creator/compressed-images"
TARGET = 200 * 1024
UA = "Mozilla/5.0 (TCFH-Compress)"

with open(f"{OUT_DIR}/compressed_manifest.json") as f:
    manifest = json.load(f)
unfit = [m for m in manifest if "error" not in m and not m.get("fit")]
print(f"Retrying {len(unfit)} unfit images...")


def safe_name(url):
    p = urllib.parse.urlparse(url)
    base = os.path.basename(p.path) or "image"
    base = re.sub(r"[^a-zA-Z0-9._-]", "_", base)
    base = os.path.splitext(base)[0]
    hsh = abs(hash(url)) % (10**8)
    return f"{base}_{hsh}.webp"


def fetch(url):
    req = urllib.request.Request(url, headers={"User-Agent": UA})
    with urllib.request.urlopen(req, timeout=60) as r:
        return r.read()


for item in unfit:
    url = item["url"]
    try:
        raw = fetch(url)
        img = Image.open(io.BytesIO(raw))
        if img.mode == "P":
            img = img.convert("RGB")
        elif img.mode == "RGBA":
            img = img.convert("RGB")  # drop alpha for max compression
        # Force start at 1280px max — already known to be too big at 1600
        w, h = img.size
        target_long = 1280
        if max(w, h) > target_long:
            scale = target_long / float(max(w, h))
            img = img.resize((int(w * scale), int(h * scale)), Image.LANCZOS)

        # Walk down quality and dimensions until <200KB or sane minimum
        quality = 80
        size_factor = 1.0
        last = None
        for attempt in range(20):
            buf = io.BytesIO()
            img.save(buf, format="WEBP", quality=quality, method=6)
            sz = buf.tell()
            last = (sz, quality, img.size)
            if sz <= TARGET:
                break
            if quality > 50:
                quality -= 5
            else:
                # Downscale 10% and reset quality to 70
                size_factor *= 0.9
                w2, h2 = img.size
                img = img.resize((int(w2 * 0.9), int(h2 * 0.9)), Image.LANCZOS)
                quality = 70

        out_path = os.path.join(COMPRESS_DIR, safe_name(url))
        with open(out_path, "wb") as f:
            f.write(buf.getvalue())
        kb_in = (item.get("orig_bytes") or 0) / 1024
        kb_out = sz / 1024
        ok = sz <= TARGET
        print(f"  {kb_in:7.1f} → {kb_out:6.1f} KB  q={quality}  {img.size}  fit={ok}")
        # Update manifest
        item["out_bytes"] = sz
        item["final_quality"] = quality
        item["final_size"] = list(img.size)
        item["fit"] = ok
    except Exception as e:
        print(f"  ERROR {url}: {e}")
        item["error"] = str(e)

with open(f"{OUT_DIR}/compressed_manifest.json", "w") as f:
    json.dump(manifest, f, indent=2)

# Final summary
fit = [m for m in manifest if m.get("fit")]
unfit2 = [m for m in manifest if "error" not in m and not m.get("fit")]
print(f"\nFinal: {len(fit)} fit, {len(unfit2)} still unfit")
for m in unfit2:
    print(f"  STILL OVER: {m['out_bytes']/1024:.1f} KB  {m['url']}")
