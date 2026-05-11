#!/usr/bin/env python3
"""Pull PageSpeed Insights for homepages, mobile + desktop."""
import json, urllib.parse as up, requests, warnings
warnings.filterwarnings("ignore")
URLS = ["https://www.tennesseecashforhomes.com/", "https://nationcfh.wpcomstaging.com/"]
API = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed"
out = {}
for url in URLS:
    out[url] = {}
    for strat in ["mobile", "desktop"]:
        params = {"url": url, "strategy": strat,
                  "category": ["performance", "accessibility", "seo", "best-practices"]}
        # requests doesn't support repeated params via dict, build manually
        q = up.urlencode([("url", url), ("strategy", strat),
                          ("category", "performance"),
                          ("category", "accessibility"),
                          ("category", "seo"),
                          ("category", "best-practices")])
        r = requests.get(f"{API}?{q}", timeout=120)
        try:
            j = r.json()
        except Exception:
            j = {"error": r.text[:500]}
        if "error" in j:
            out[url][strat] = {"error": j["error"]}
            continue
        cats = j.get("lighthouseResult", {}).get("categories", {})
        audits = j.get("lighthouseResult", {}).get("audits", {})
        crux = j.get("loadingExperience", {}).get("metrics", {})
        out[url][strat] = {
            "scores": {k: round((v.get("score") or 0) * 100) for k, v in cats.items()},
            "lab": {
                "lcp_ms": audits.get("largest-contentful-paint", {}).get("numericValue"),
                "cls": audits.get("cumulative-layout-shift", {}).get("numericValue"),
                "tbt_ms": audits.get("total-blocking-time", {}).get("numericValue"),
                "fcp_ms": audits.get("first-contentful-paint", {}).get("numericValue"),
                "si_ms": audits.get("speed-index", {}).get("numericValue"),
                "tti_ms": audits.get("interactive", {}).get("numericValue"),
            },
            "crux": {k: {"p75": v.get("percentile"), "category": v.get("category")} for k, v in crux.items()},
        }
        print(f"{strat:7s} {url}: perf={out[url][strat]['scores'].get('performance')}")
with open("/Users/karsoncarmichael/Claude Code Website Creator/seo-audit/pagespeed.json", "w") as fh:
    json.dump(out, fh, indent=2)
