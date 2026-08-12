#!/usr/bin/env python3
"""
SEO Internal Linking — Batch 1 measurement.

Compares Search Console performance after the 2026-08-12 deployment against the
equivalent window before it, across the metrics agreed for this measurement period.

FIRST RUN — reconnect Search Console (the saved token expired):

    cd gsc-dashboard
    ./venv/bin/python fetch_gsc_data.py      # opens a browser for OAuth consent

Then run this at the 7 / 14 / 21 / 28 day marks:

    ./venv/bin/python measure_batch1.py --days 7
    ./venv/bin/python measure_batch1.py --days 28        # primary decision point

Each run writes a snapshot to gsc-dashboard/data/batch1/ so the series is kept.
"""

import argparse
import json
import re
from datetime import date, timedelta
from pathlib import Path

from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from google_auth_oauthlib.flow import InstalledAppFlow
from googleapiclient.discovery import build

SCOPES = ["https://www.googleapis.com/auth/webmasters.readonly"]
HERE = Path(__file__).parent
TOKEN_FILE = HERE / "token.json"
CLIENT_SECRET = HERE / "client_secret.json"
OUT_DIR = HERE / "data" / "batch1"

# The deployment boundary. Blog link repairs went live on this date.
DEPLOY_DATE = date(2026, 8, 12)

# Clusters we committed to tracking.
CLUSTERS = {
    "sell my house fast": r"sell my house fast|sell house fast|sell my home fast",
    "cash home buyers": r"cash home buyer|cash house buyer|cash buyer",
    "we buy houses": r"we buy houses|we buy homes",
    "sell house for cash": r"(sell|selling).*(for cash|cash offer)",
    "as-is": r"\bas.is\b|as is\b",
    "near me": r"near me",
}
WATCH_CITIES = ["nashville", "murfreesboro", "clarksville", "columbia", "spring hill"]
COUNTY_RE = r"\bcounty\b"

# Buyer-intent noise we deliberately do NOT optimise for; reported separately so
# it never gets mistaken for a win.
BUYER_INTENT = r"homes for sale|houses for sale|buy homes in|buy a house in"


def authenticate():
    creds = None
    if TOKEN_FILE.exists():
        creds = Credentials.from_authorized_user_file(str(TOKEN_FILE), SCOPES)
    if not creds or not creds.valid:
        if creds and creds.expired and creds.refresh_token:
            try:
                creds.refresh(Request())
            except Exception:
                creds = None
        if not creds:
            if not CLIENT_SECRET.exists():
                raise SystemExit(
                    "token expired and client_secret.json missing — cannot reconnect."
                )
            flow = InstalledAppFlow.from_client_secrets_file(str(CLIENT_SECRET), SCOPES)
            creds = flow.run_local_server(port=0)
        TOKEN_FILE.write_text(creds.to_json())
    return creds


def pick_site(svc):
    sites = [s["siteUrl"] for s in svc.sites().list().execute().get("siteEntry", [])]
    for c in ("sc-domain:tennesseecashforhomes.com",
              "https://tennesseecashforhomes.com/",
              "https://www.tennesseecashforhomes.com/"):
        if c in sites:
            return c
    for s in sites:
        if "tennesseecashforhomes" in s:
            return s
    raise SystemExit(f"property not found. Available: {sites}")


def query(svc, site, start, end, dims, limit=25000):
    rows, start_row = [], 0
    while True:
        body = {
            "startDate": start.isoformat(),
            "endDate": end.isoformat(),
            "dimensions": dims,
            "rowLimit": min(limit, 25000),
            "startRow": start_row,
        }
        resp = svc.searchanalytics().query(siteUrl=site, body=body).execute()
        got = resp.get("rows", [])
        rows += got
        if len(got) < body["rowLimit"]:
            break
        start_row += len(got)
        if start_row >= limit:
            break
    return rows


def agg(rows):
    c = sum(r["clicks"] for r in rows)
    i = sum(r["impressions"] for r in rows)
    pos = sum(r["position"] * r["impressions"] for r in rows) / i if i else 0
    return {"clicks": c, "impressions": i,
            "ctr": round(c / i * 100, 3) if i else 0,
            "position": round(pos, 2)}


def subset(rows, pattern, idx=0):
    rx = re.compile(pattern, re.I)
    return [r for r in rows if rx.search(r["keys"][idx])]


def window_report(svc, site, start, end, label):
    q = query(svc, site, start, end, ["query"])
    p = query(svc, site, start, end, ["page"])
    total = agg(q)
    total_impr = total["impressions"] or 1

    def page_group(pat):
        sub = [r for r in p if re.search(pat, r["keys"][0], re.I)]
        return agg(sub)

    home = [r for r in p if re.match(r"https?://[^/]+/?$", r["keys"][0])]

    rep = {
        "label": label,
        "start": start.isoformat(), "end": end.isoformat(),
        "sitewide": total,
        "homepage_impression_share_pct": round(
            (agg(home)["impressions"] / total_impr) * 100, 2),
        "page_groups": {
            "city_pages": page_group(r"/where-we-buy/(?!.*county)"),
            "county_pages": page_group(r"/where-we-buy/.*county"),
            "situation_pages": page_group(r"/sell-[a-z-]+-tennessee/|/sell-rental|/sell-house-|/sell-my-house-"),
            "as_is_page": page_group(r"/sell-house-as-is-tennessee/"),
            "blog_posts": page_group(r"tennesseecashforhomes\.com/(?!where-we-buy|sell-|facing-|about|faq|how-it-works|investors|privacy|blog/?$)[a-z0-9-]{25,}/"),
        },
        "watch_cities": {c: agg(subset(q, re.escape(c))) for c in WATCH_CITIES},
        "clusters": {k: agg(subset(q, v)) for k, v in CLUSTERS.items()},
        "county_queries": agg(subset(q, COUNTY_RE)),
        "buyer_intent_noise": agg(subset(q, BUYER_INTENT)),
        "striking_distance_8_20": len([r for r in q if 8 <= r["position"] <= 20]),
        "top3_queries": len([r for r in q if r["position"] <= 3]),
        "top10_queries": len([r for r in q if r["position"] <= 10]),
    }
    return rep


def delta(a, b, key):
    """b - a for a metric dict."""
    return {k: round(b[key][k] - a[key][k], 3) for k in b[key]} if key in b else {}


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("--days", type=int, default=28,
                    help="days after deployment to measure (7/14/21/28)")
    args = ap.parse_args()

    OUT_DIR.mkdir(parents=True, exist_ok=True)
    svc = build("searchconsole", "v1", credentials=authenticate())
    site = pick_site(svc)
    print(f"property: {site}")

    n = args.days
    # GSC data lags ~2-3 days; the caller should run this at least 3 days past the mark.
    after_start = DEPLOY_DATE + timedelta(days=1)
    after_end = DEPLOY_DATE + timedelta(days=n)
    before_end = DEPLOY_DATE - timedelta(days=1)
    before_start = before_end - timedelta(days=n - 1)

    print(f"BEFORE : {before_start} -> {before_end}")
    print(f"AFTER  : {after_start} -> {after_end}   (deployment {DEPLOY_DATE})")

    before = window_report(svc, site, before_start, before_end, f"before_{n}d")
    after = window_report(svc, site, after_start, after_end, f"after_{n}d")

    out = {"deploy_date": DEPLOY_DATE.isoformat(), "window_days": n,
           "before": before, "after": after}
    path = OUT_DIR / f"batch1_{n}d.json"
    path.write_text(json.dumps(out, indent=1))

    def line(name, a, b):
        d = b["clicks"] - a["clicks"]
        di = b["impressions"] - a["impressions"]
        dp = a["position"] - b["position"]          # positive = improved
        print(f"  {name:24} clicks {a['clicks']:>5} -> {b['clicks']:<5} ({d:+d})"
              f"   impr {a['impressions']:>7} -> {b['impressions']:<7} ({di:+d})"
              f"   pos {a['position']:>5} -> {b['position']:<5} ({dp:+.2f})")

    print(f"\n{'='*104}\nSITEWIDE")
    line("total", before["sitewide"], after["sitewide"])
    print(f"  homepage impression share  {before['homepage_impression_share_pct']}% "
          f"-> {after['homepage_impression_share_pct']}%  "
          f"({after['homepage_impression_share_pct']-before['homepage_impression_share_pct']:+.2f} pts)"
          "   [down = internal authority spreading, this is the goal]")
    print(f"  queries in top 3   {before['top3_queries']} -> {after['top3_queries']}")
    print(f"  queries in top 10  {before['top10_queries']} -> {after['top10_queries']}")
    print(f"  striking distance 8-20  {before['striking_distance_8_20']} -> {after['striking_distance_8_20']}")

    print("\nPAGE GROUPS")
    for k in before["page_groups"]:
        line(k, before["page_groups"][k], after["page_groups"][k])

    print("\nWATCH CITIES")
    for k in before["watch_cities"]:
        line(k, before["watch_cities"][k], after["watch_cities"][k])

    print("\nQUERY CLUSTERS")
    for k in before["clusters"]:
        line(k, before["clusters"][k], after["clusters"][k])
    line("county queries", before["county_queries"], after["county_queries"])

    print("\nNOT A GOAL (buyer intent — ignore movement here)")
    line("buyer-intent noise", before["buyer_intent_noise"], after["buyer_intent_noise"])

    print(f"\nsnapshot written to {path}")


if __name__ == "__main__":
    main()
