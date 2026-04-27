#!/usr/bin/env python3
"""Phase 1 city pages — POST 25 location pages to WordPress and write CSV log."""
import csv
import os
import sys
import time
import json
import urllib.request
import urllib.error
import base64

WP_URL = "https://nationcfh.wpcomstaging.com"
WP_USER = "nationcfh"
WP_APP_PASSWORD = "46Vb FCVr 2N44 BqkP hBF8 e7T0"
PARENT_ID = 1742

CITIES = [
    ("Brentwood",    "brentwood",    "page-location-brentwood.php"),
    ("Mt. Juliet",   "mt-juliet",    "page-location-mt-juliet.php"),
    ("White House",  "white-house",  "page-location-white-house.php"),
    ("Dickson",      "dickson",      "page-location-dickson.php"),
    ("Springfield",  "springfield",  "page-location-springfield.php"),
    ("Ashland City", "ashland-city", "page-location-ashland-city.php"),
    ("Burns",        "burns",        "page-location-burns.php"),
    ("Lewisburg",    "lewisburg",    "page-location-lewisburg.php"),
    ("Alamo",        "alamo",        "page-location-alamo.php"),
    ("Alcoa",        "alcoa",        "page-location-alcoa.php"),
    ("Altamont",     "altamont",     "page-location-altamont.php"),
    ("Athens",       "athens",       "page-location-athens.php"),
    ("Bartlett",     "bartlett",     "page-location-bartlett.php"),
    ("Bean Station", "bean-station", "page-location-bean-station.php"),
    ("Benton",       "benton",       "page-location-benton.php"),
    ("Big Sandy",    "big-sandy",    "page-location-big-sandy.php"),
    ("Blountville",  "blountville",  "page-location-blountville.php"),
    ("Bolivar",      "bolivar",      "page-location-bolivar.php"),
    ("Bristol",      "bristol",      "page-location-bristol.php"),
    ("Brownsville",  "brownsville",  "page-location-brownsville.php"),
    ("Byrdstown",    "byrdstown",    "page-location-byrdstown.php"),
    ("Camden",       "camden",       "page-location-camden.php"),
    ("Carthage",     "carthage",     "page-location-carthage.php"),
    ("Celina",       "celina",       "page-location-celina.php"),
    ("Centerville",  "centerville",  "page-location-centerville.php"),
]

def auth_header():
    raw = f"{WP_USER}:{WP_APP_PASSWORD}".encode("utf-8")
    return "Basic " + base64.b64encode(raw).decode("ascii")

def request(method, path, body=None):
    url = f"{WP_URL}{path}"
    data = json.dumps(body).encode("utf-8") if body is not None else None
    req = urllib.request.Request(url, data=data, method=method)
    req.add_header("Authorization", auth_header())
    req.add_header("Content-Type", "application/json")
    try:
        with urllib.request.urlopen(req, timeout=60) as resp:
            return resp.status, json.loads(resp.read().decode("utf-8"))
    except urllib.error.HTTPError as e:
        body_text = e.read().decode("utf-8", errors="replace")
        try:
            body_json = json.loads(body_text)
        except Exception:
            body_json = {"raw": body_text}
        return e.code, body_json
    except Exception as e:
        return 0, {"error": str(e)}

def find_existing(slug):
    code, data = request("GET", f"/wp-json/wp/v2/pages?slug={slug}&per_page=1&_fields=id,slug,title,link,status")
    if code == 200 and isinstance(data, list) and data:
        return data[0]
    return None

def create_page(title, slug, template_filename):
    payload = {
        "title": f"Where We Buy {title}",
        "slug": slug,
        "parent": PARENT_ID,
        "status": "publish",
        "template": template_filename,
    }
    return request("POST", "/wp-json/wp/v2/pages", payload)

def main():
    os.makedirs("seo-audit", exist_ok=True)
    log_path = "seo-audit/phase1_city_pages_log.csv"
    rows = []

    for title, slug, tpl in CITIES:
        existing = find_existing(slug)
        if existing:
            row = {
                "slug": slug,
                "page_id": existing["id"],
                "http_status": "skipped (exists)",
                "link": existing.get("link", ""),
                "error": "",
            }
            print(f"[skip] {slug} already exists: id={existing['id']}")
        else:
            code, body = create_page(title, slug, tpl)
            page_id = body.get("id") if isinstance(body, dict) else ""
            link = body.get("link", "") if isinstance(body, dict) else ""
            error = ""
            if code not in (200, 201):
                error = json.dumps(body)[:500]
            row = {
                "slug": slug,
                "page_id": page_id,
                "http_status": code,
                "link": link,
                "error": error,
            }
            print(f"[{code}] {slug} -> id={page_id} link={link}")
            time.sleep(0.5)

        rows.append(row)

    with open(log_path, "w", newline="") as f:
        w = csv.DictWriter(f, fieldnames=["slug", "page_id", "http_status", "link", "error"])
        w.writeheader()
        for r in rows:
            w.writerow(r)
    print(f"\nLog written: {log_path}")

    # Summary
    created = sum(1 for r in rows if str(r["http_status"]) in ("200", "201"))
    skipped = sum(1 for r in rows if "skipped" in str(r["http_status"]))
    errors = sum(1 for r in rows if r["error"])
    print(f"\nCreated: {created}  Skipped: {skipped}  Errors: {errors}  Total: {len(rows)}")

if __name__ == "__main__":
    main()
