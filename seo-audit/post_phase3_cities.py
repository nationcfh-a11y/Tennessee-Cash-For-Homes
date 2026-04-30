#!/usr/bin/env python3
"""Phase 3 city pages — POST 63 location pages to WordPress and write CSV log."""
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
    ("Kingston",        "kingston",        "page-location-kingston.php"),
    ("La Follette",     "la-follette",     "page-location-la-follette.php"),
    ("Lafayette",       "lafayette",       "page-location-lafayette.php"),
    ("Lawrenceburg",    "lawrenceburg",    "page-location-lawrenceburg.php"),
    ("Lenoir City",     "lenoir-city",     "page-location-lenoir-city.php"),
    ("Lexington",       "lexington",       "page-location-lexington.php"),
    ("Linden",          "linden",          "page-location-linden.php"),
    ("Livingston",      "livingston",      "page-location-livingston.php"),
    ("Loudon",          "loudon",          "page-location-loudon.php"),
    ("Lynchburg",       "lynchburg",       "page-location-lynchburg.php"),
    ("Madisonville",    "madisonville",    "page-location-madisonville.php"),
    ("Manchester",      "manchester",      "page-location-manchester.php"),
    ("Martin",          "martin",          "page-location-martin.php"),
    ("Maryville",       "maryville",       "page-location-maryville.php"),
    ("Maynardville",    "maynardville",    "page-location-maynardville.php"),
    ("McKenzie",        "mckenzie",        "page-location-mckenzie.php"),
    ("Milan",           "milan",           "page-location-milan.php"),
    ("Monteagle",       "monteagle",       "page-location-monteagle.php"),
    ("Morristown",      "morristown",      "page-location-morristown.php"),
    ("Mosheim",         "mosheim",         "page-location-mosheim.php"),
    ("Mountain City",   "mountain-city",   "page-location-mountain-city.php"),
    ("Munford",         "munford",         "page-location-munford.php"),
    ("Newport",         "newport",         "page-location-newport.php"),
    ("Norris",          "norris",          "page-location-norris.php"),
    ("Oak Ridge",       "oak-ridge",       "page-location-oak-ridge.php"),
    ("Oakland",         "oakland",         "page-location-oakland.php"),
    ("Oneida",          "oneida",          "page-location-oneida.php"),
    ("Paris",           "paris",           "page-location-paris.php"),
    ("Parsons",         "parsons",         "page-location-parsons.php"),
    ("Pigeon Forge",    "pigeon-forge",    "page-location-pigeon-forge.php"),
    ("Pikeville",       "pikeville",       "page-location-pikeville.php"),
    ("Powell",          "powell",          "page-location-powell.php"),
    ("Pulaski",         "pulaski",         "page-location-pulaski.php"),
    ("Red Bank",        "red-bank",        "page-location-red-bank.php"),
    ("Ripley",          "ripley",          "page-location-ripley.php"),
    ("Rogersville",     "rogersville",     "page-location-rogersville.php"),
    ("Rutledge",        "rutledge",        "page-location-rutledge.php"),
    ("Savannah",        "savannah",        "page-location-savannah.php"),
    ("Selmer",          "selmer",          "page-location-selmer.php"),
    ("Sevierville",     "sevierville",     "page-location-sevierville.php"),
    ("Signal Mountain", "signal-mountain", "page-location-signal-mountain.php"),
    ("Smithville",      "smithville",      "page-location-smithville.php"),
    ("Sneedville",      "sneedville",      "page-location-sneedville.php"),
    ("Soddy-Daisy",     "soddy-daisy",     "page-location-soddy-daisy.php"),
    ("Somerville",      "somerville",      "page-location-somerville.php"),
    ("South Pittsburg", "south-pittsburg", "page-location-south-pittsburg.php"),
    ("Sparta",          "sparta",          "page-location-sparta.php"),
    ("Spencer",         "spencer",         "page-location-spencer.php"),
    ("Spring City",     "spring-city",     "page-location-spring-city.php"),
    ("Sweetwater",      "sweetwater",      "page-location-sweetwater.php"),
    ("Tazewell",        "tazewell",        "page-location-tazewell.php"),
    ("Tiptonville",     "tiptonville",     "page-location-tiptonville.php"),
    ("Townsend",        "townsend",        "page-location-townsend.php"),
    ("Tracy City",      "tracy-city",      "page-location-tracy-city.php"),
    ("Trenton",         "trenton",         "page-location-trenton.php"),
    ("Tullahoma",       "tullahoma",       "page-location-tullahoma.php"),
    ("Union City",      "union-city",      "page-location-union-city.php"),
    ("Wartburg",        "wartburg",        "page-location-wartburg.php"),
    ("Watauga",         "watauga",         "page-location-watauga.php"),
    ("Waverly",         "waverly",         "page-location-waverly.php"),
    ("Waynesboro",      "waynesboro",      "page-location-waynesboro.php"),
    ("White Pine",      "white-pine",      "page-location-white-pine.php"),
    ("Winchester",      "winchester",      "page-location-winchester.php"),
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
    }
    return request("POST", "/wp-json/wp/v2/pages", payload)

def main():
    os.makedirs("seo-audit", exist_ok=True)
    log_path = "seo-audit/phase3_city_pages_log.csv"
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
            time.sleep(0.4)

        rows.append(row)

    with open(log_path, "w", newline="") as f:
        w = csv.DictWriter(f, fieldnames=["slug", "page_id", "http_status", "link", "error"])
        w.writeheader()
        for r in rows:
            w.writerow(r)
    print(f"\nLog written: {log_path}")

    created = sum(1 for r in rows if str(r["http_status"]) in ("200", "201"))
    skipped = sum(1 for r in rows if "skipped" in str(r["http_status"]))
    errors = sum(1 for r in rows if r["error"])
    print(f"\nCreated: {created}  Skipped: {skipped}  Errors: {errors}  Total: {len(rows)}")

if __name__ == "__main__":
    main()
