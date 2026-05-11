#!/usr/bin/env python3
"""Download SVG map files from Wikimedia Commons for Tennessee cities and counties.
Two-phase approach: batch all searches first, then download."""

import os
import re
import sys
import time
import json
import hashlib
import subprocess
import urllib.request
import urllib.parse
import urllib.error

sys.stdout = os.fdopen(sys.stdout.fileno(), 'w', buffering=1)

CITY_DIR = "brand_assets/city-svgs"
COUNTY_DIR = "brand_assets/county-svgs"
os.makedirs(CITY_DIR, exist_ok=True)
os.makedirs(COUNTY_DIR, exist_ok=True)

API_HEADERS = {"User-Agent": "TN-Map-Downloader/1.0 (Educational use; contact: admin@example.com)"}
DOWNLOAD_HEADERS = {
    "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/svg+xml,*/*;q=0.8",
}


def slugify(name):
    return re.sub(r'[^a-z0-9]+', '-', name.lower()).strip('-')


SEARCH_CACHE = "brand_assets/search_results.json"


def robust_request(url, headers, timeout=30, max_retries=8):
    """HTTP request with exponential backoff retry."""
    for attempt in range(max_retries):
        try:
            req = urllib.request.Request(url, headers=headers)
            with urllib.request.urlopen(req, timeout=timeout) as resp:
                return resp.read()
        except urllib.error.HTTPError as e:
            if e.code == 429 or e.code >= 500:
                wait = min(180, (2 ** attempt) * 5)
                print(f"    [{e.code}] Retry in {wait}s (attempt {attempt+1}/{max_retries})")
                time.sleep(wait)
                continue
            raise
        except (urllib.error.URLError, TimeoutError, ConnectionResetError):
            if attempt < max_retries - 1:
                time.sleep(5)
                continue
            raise
    raise Exception(f"Max retries exceeded")


def wikimedia_file_url(filename):
    """Construct direct URL from Wikimedia filename using MD5 hash scheme."""
    name = filename.replace("File:", "").replace(" ", "_")
    md5 = hashlib.md5(name.encode('utf-8')).hexdigest()
    # URL-encode the name but keep underscores
    encoded_name = urllib.parse.quote(name, safe='_')
    return f"https://upload.wikimedia.org/wikipedia/commons/{md5[0]}/{md5[0:2]}/{encoded_name}"


def search_wikimedia(query):
    encoded = urllib.parse.quote(query)
    url = f"https://commons.wikimedia.org/w/api.php?action=query&list=search&srsearch={encoded}&srnamespace=6&format=json"
    data = robust_request(url, API_HEADERS)
    results = json.loads(data).get("query", {}).get("search", [])
    return [r["title"] for r in results]


def find_svg_filename(search_terms):
    """Search for an SVG file using multiple search terms. Returns filename or None."""
    for term in search_terms:
        time.sleep(1)  # 1 second between search API calls
        try:
            results = search_wikimedia(term)
            svg_results = [r for r in results if r.lower().endswith('.svg')]
            if svg_results:
                return svg_results[0]
        except Exception as e:
            print(f"    Search error: {e}")
            continue
    return None


def download_svg_curl(url, filepath, max_retries=6):
    """Download SVG file using curl (better handling of rate limits)."""
    for attempt in range(max_retries):
        result = subprocess.run(
            ['curl', '-s', '-o', filepath, '-w', '%{http_code}',
             '-A', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
             '--max-time', '60', url],
            capture_output=True, text=True
        )
        http_code = result.stdout.strip()
        if http_code == '200':
            # Verify it's SVG
            with open(filepath, 'rb') as f:
                head = f.read(500)
            if b'<svg' in head or b'<?xml' in head:
                return True
            os.remove(filepath)
            return False
        elif http_code == '429' or http_code.startswith('5'):
            wait = min(120, (2 ** attempt) * 10)
            print(f"    [{http_code}] Retry in {wait}s (attempt {attempt+1}/{max_retries})")
            if os.path.exists(filepath):
                os.remove(filepath)
            time.sleep(wait)
        else:
            print(f"    HTTP {http_code}")
            if os.path.exists(filepath):
                os.remove(filepath)
            return False
    return False


# All 95 Tennessee counties
COUNTIES = [
    "Anderson", "Bedford", "Benton", "Bledsoe", "Blount", "Bradley", "Campbell",
    "Cannon", "Carroll", "Carter", "Cheatham", "Chester", "Claiborne", "Clay",
    "Cocke", "Coffee", "Crockett", "Cumberland", "Davidson", "Decatur", "DeKalb",
    "Dickson", "Dyer", "Fayette", "Fentress", "Franklin", "Gibson", "Giles",
    "Grainger", "Greene", "Grundy", "Hamblen", "Hamilton", "Hancock", "Hardeman",
    "Hardin", "Hawkins", "Haywood", "Henderson", "Henry", "Hickman", "Houston",
    "Humphreys", "Jackson", "Jefferson", "Johnson", "Knox", "Lake", "Lauderdale",
    "Lawrence", "Lewis", "Lincoln", "Loudon", "McMinn", "McNairy", "Macon",
    "Madison", "Marion", "Marshall", "Maury", "Meigs", "Monroe", "Montgomery",
    "Moore", "Morgan", "Obion", "Overton", "Perry", "Pickett", "Polk", "Putnam",
    "Rhea", "Roane", "Robertson", "Rutherford", "Scott", "Sequatchie", "Sevier",
    "Shelby", "Smith", "Stewart", "Sullivan", "Sumner", "Tipton", "Trousdale",
    "Unicoi", "Union", "Van Buren", "Warren", "Washington", "Wayne", "Weakley",
    "White", "Williamson", "Wilson"
]

CITIES_BY_COUNTY = {
    "Davidson": ["Nashville", "Berry Hill", "Belle Meade", "Goodlettsville", "Lakewood", "Oak Hill", "Ridgetop", "Forest Hills"],
    "Rutherford": ["Murfreesboro", "Smyrna", "La Vergne", "Eagleville"],
    "Williamson": ["Franklin", "Brentwood", "Spring Hill", "Nolensville", "Thompson Station", "Fairview"],
    "Montgomery": ["Clarksville", "Pleasant View", "Woodlawn"],
    "Wilson": ["Lebanon", "Mt. Juliet", "Watertown", "Statesville"],
    "Sumner": ["Hendersonville", "Gallatin", "White House", "Millersville", "Portland", "Westmoreland"],
    "Maury": ["Columbia", "Spring Hill", "Mount Pleasant"],
    "Cheatham": ["Ashland City", "Kingston Springs", "Pegram", "Pleasant View"],
    "Robertson": ["Springfield", "White House", "Greenbrier", "Cross Plains", "Coopertown", "Cedar Hill", "Ridgetop", "Orlinda"],
    "Dickson": ["Dickson", "Burns", "White Bluff", "Vanleer"],
    "Marshall": ["Lewisburg", "Chapel Hill", "Petersburg", "Cornersville"],
    "Bedford": ["Shelbyville", "Bell Buckle", "Wartrace", "Normandy", "Unionville"],
    "Coffee": ["Manchester", "Tullahoma", "Estill Springs", "Hillsboro"],
    "Warren": ["McMinnville", "Morrison", "Viola", "Centertown"],
    "Cannon": ["Woodbury", "Auburntown", "Readyville"],
    "DeKalb": ["Smithville", "Alexandria", "Dowelltown", "Liberty"],
    "Smith": ["Carthage", "Gordonsville", "South Carthage", "Dixon Springs"],
    "Trousdale": ["Hartsville"],
    "Hickman": ["Centerville", "Nunnelly"],
    "Lewis": ["Hohenwald"],
    "Perry": ["Linden", "Lobelville"],
    "Houston": ["Erin", "Tennessee Ridge"],
    "Stewart": ["Dover", "Big Rock", "Cumberland City", "Bumpus Mills", "Indian Mound"],
    "Humphreys": ["Waverly", "McEwen", "New Johnsonville"],
    "Lawrence": ["Lawrenceburg", "Loretto", "Ethridge", "Iron City", "St. Joseph", "Westpoint"],
    "Knox": ["Knoxville", "Farragut", "Powell", "Halls", "Corryton"],
    "Hamilton": ["Chattanooga", "East Ridge", "Collegedale", "Lookout Mountain", "Red Bank", "Signal Mountain", "Soddy-Daisy"],
    "Shelby": ["Memphis", "Bartlett", "Germantown", "Collierville", "Lakeland", "Arlington", "Millington"],
    "Madison": ["Jackson", "Humboldt", "Medina"],
    "Cumberland": ["Crossville", "Crab Orchard", "Pleasant Hill"],
    "Sullivan": ["Kingsport", "Bristol", "Blountville", "Bluff City", "Mount Carmel"],
    "Washington": ["Johnson City", "Jonesborough", "Limestone", "Telford", "Gray"],
    "Hawkins": ["Rogersville", "Church Hill", "Mount Carmel", "Surgoinsville", "Bulls Gap"],
    "Greene": ["Greeneville", "Mosheim", "Tusculum", "Baileyton"],
    "Anderson": ["Clinton", "Oak Ridge", "Oliver Springs", "Norris", "Rocky Top"],
    "Blount": ["Maryville", "Alcoa", "Friendsville", "Townsend", "Louisville"],
    "Sevier": ["Sevierville", "Gatlinburg", "Pigeon Forge", "Pittman Center"],
    "Bradley": ["Cleveland", "Blue Ridge", "Benton", "McDonald"],
    "Roane": ["Kingston", "Harriman", "Rockwood", "Oliver Springs"],
    "Loudon": ["Loudon", "Lenoir City", "Philadelphia", "Greenback"],
    "Monroe": ["Madisonville", "Sweetwater", "Vonore", "Tellico Plains", "Englewood"],
    "McMinn": ["Athens", "Etowah", "Englewood", "Niota", "Riceville"],
    "Meigs": ["Decatur", "Riceville"],
    "Rhea": ["Dayton", "Spring City", "Graysville", "Evensville"],
    "Sequatchie": ["Dunlap", "Whitwell"],
    "Marion": ["Jasper", "South Pittsburg", "Whitwell", "Kimball"],
    "Grundy": ["Altamont", "Coalmont", "Tracy City", "Monteagle", "Palmer"],
    "Van Buren": ["Spencer"],
    "White": ["Sparta", "Doyle", "Silver Point"],
    "Putnam": ["Cookeville", "Algood", "Baxter", "Monterey"],
    "Overton": ["Livingston", "Rickman"],
    "Pickett": ["Byrdstown"],
    "Fentress": ["Jamestown", "Allardt"],
    "Scott": ["Huntsville", "Oneida", "Winfield", "Helenwood"],
    "Morgan": ["Wartburg", "Sunbright", "Oakdale"],
    "Campbell": ["Jacksboro", "LaFollette", "Caryville", "Jellico"],
    "Claiborne": ["Tazewell", "New Tazewell", "Harrogate", "Cumberland Gap"],
    "Union": ["Maynardville", "Luttrell"],
    "Grainger": ["Rutledge", "Bean Station", "Washburn"],
    "Hamblen": ["Morristown", "Russellville", "Whitesburg"],
    "Jefferson": ["Dandridge", "Jefferson City", "White Pine", "New Market", "Baneberry"],
    "Cocke": ["Newport", "Del Rio", "Parrottsville"],
    "Unicoi": ["Erwin", "Unicoi"],
    "Carter": ["Elizabethton", "Roan Mountain", "Hampton", "Watauga"],
    "Johnson": ["Mountain City", "Butler"],
    "Hancock": ["Sneedville", "Treadway"],
    "Dyer": ["Dyersburg", "Newbern", "Trimble", "Halls"],
    "Gibson": ["Trenton", "Milan", "Humboldt", "Bradford", "Dyer", "Kenton", "Rutherford", "Medina"],
    "Carroll": ["Huntingdon", "McKenzie", "Hollow Rock", "Bruceton", "Atwood", "Gleason", "Trezevant"],
    "Henry": ["Paris", "Puryear", "Big Sandy", "Cottage Grove"],
    "Weakley": ["Dresden", "Martin", "Gleason", "Greenfield", "Sharon"],
    "Obion": ["Union City", "South Fulton", "Obion", "Rives", "Kenton", "Troy"],
    "Lake": ["Tiptonville", "Ridgely"],
    "Lauderdale": ["Ripley", "Halls", "Gates", "Henning"],
    "Tipton": ["Covington", "Munford", "Atoka", "Brighton", "Garland"],
    "Haywood": ["Brownsville", "Stanton", "Bells", "Macon"],
    "Hardeman": ["Bolivar", "Whiteville", "Grand Junction", "Middleton", "Saulsbury"],
    "McNairy": ["Selmer", "Adamsville", "Bethel Springs", "Guys", "Stantonville", "Michie"],
    "Chester": ["Henderson", "Enville"],
    "Decatur": ["Decaturville", "Parsons", "Scotts Hill"],
    "Benton": ["Camden", "Big Sandy", "Holladay", "Eva"],
    "Hardin": ["Savannah", "Adamsville", "Crump"],
    "Wayne": ["Waynesboro", "Collinwood", "Clifton"],
    "Giles": ["Pulaski", "Ardmore", "Elkton", "Lynnville", "Minor Hill"],
    "Lincoln": ["Fayetteville", "Ardmore", "Petersburg", "Taft", "Elora", "Mulberry"],
    "Franklin": ["Winchester", "Cowan", "Decherd", "Estill Springs", "Huntland", "Sewanee"],
    "Moore": ["Lynchburg"],
    "Polk": ["Benton", "Ducktown", "Copperhill", "Ocoee", "Delano"],
    "Jackson": ["Gainesboro", "Granville"],
    "Clay": ["Celina", "Red Boiling Springs"],
    "Macon": ["Lafayette", "Red Boiling Springs", "Westmoreland"],
    "Fayette": ["Somerville", "Oakland", "Piperton", "Moscow", "Rossville"],
    "Crockett": ["Alamo", "Bells", "Friendship", "Gadsden", "Maury City"],
    "Henderson": ["Lexington", "Sardis", "Scotts Hill", "Parsons"],
    "Bledsoe": ["Pikeville", "Dunlap"],
}


def main():
    # ============================================================
    # PHASE 1: Search for all filenames (API calls to search endpoint)
    # ============================================================
    print("=" * 60)
    print("PHASE 1: SEARCHING FOR SVG FILENAMES")
    print("=" * 60)

    # Build list of all items to search
    items = []  # list of (label, slug, directory, search_terms)

    # Counties
    for county in COUNTIES:
        slug = slugify(county) + "-county"
        items.append((
            f"{county} County",
            slug,
            COUNTY_DIR,
            [
                f"{county} County Tennessee Highlighted",
                f"{county} Tennessee county map",
                f"{county} County Tennessee incorporated unincorporated",
            ]
        ))

    # Cities (deduplicated)
    processed = set()
    for county, cities in CITIES_BY_COUNTY.items():
        for city in cities:
            key = f"{city}-{county}"
            if key in processed:
                continue
            processed.add(key)
            slug = slugify(city)
            items.append((
                f"{city} ({county} County)",
                slug,
                CITY_DIR,
                [
                    f"{county} County Tennessee {city} Highlighted",
                    f"{city} Tennessee {county} Highlighted",
                    f"{city} Tennessee Highlighted",
                    f"{city} Tennessee incorporated unincorporated",
                ]
            ))

    # Load cached search results if available
    cached = {}
    if os.path.exists(SEARCH_CACHE):
        with open(SEARCH_CACHE) as f:
            cached = json.load(f)
        print(f"Loaded {len(cached)} cached search results")

    # Search phase - find filenames
    found_files = {}  # slug -> (wikimedia_filename, filepath, label)
    not_found = []
    skipped = []

    for i, (label, slug, directory, search_terms) in enumerate(items, 1):
        filepath = os.path.join(directory, f"{slug}.svg")

        if os.path.exists(filepath) and os.path.getsize(filepath) > 100:
            print(f"[{i}/{len(items)}] SKIP (exists): {label}")
            skipped.append(label)
            continue

        # Check cache first
        cache_key = f"{directory}/{slug}"
        if cache_key in cached:
            if cached[cache_key] is None:
                not_found.append(label)
                print(f"[{i}/{len(items)}] CACHED NOT FOUND: {label}")
            else:
                found_files[slug] = (cached[cache_key], filepath, label)
                print(f"[{i}/{len(items)}] CACHED: {label} -> {cached[cache_key]}")
            continue

        print(f"[{i}/{len(items)}] Searching: {label}...")
        filename = find_svg_filename(search_terms)
        if filename:
            found_files[slug] = (filename, filepath, label)
            cached[cache_key] = filename
            print(f"  Found: {filename}")
        else:
            not_found.append(label)
            cached[cache_key] = None
            print(f"  NOT FOUND")

        # Save cache periodically
        if i % 20 == 0:
            with open(SEARCH_CACHE, 'w') as f:
                json.dump(cached, f, indent=2)

    # Save final cache
    with open(SEARCH_CACHE, 'w') as f:
        json.dump(cached, f, indent=2)
    print(f"\nSearch complete: {len(found_files)} to download, {len(skipped)} already exist, {len(not_found)} not found")

    # ============================================================
    # PHASE 2: Download all found SVGs
    # ============================================================
    print("\n" + "=" * 60)
    print("PHASE 2: DOWNLOADING SVGs")
    print("=" * 60)

    downloaded = 0
    download_failed = []

    for i, (slug, (filename, filepath, label)) in enumerate(found_files.items(), 1):
        # Skip already downloaded
        if os.path.exists(filepath) and os.path.getsize(filepath) > 100:
            print(f"[{i}/{len(found_files)}] SKIP (exists): {label}")
            downloaded += 1
            continue
        print(f"[{i}/{len(found_files)}] Downloading: {label}...")
        url = wikimedia_file_url(filename)
        time.sleep(10)  # 10 seconds between downloads to avoid rate limiting
        if download_svg_curl(url, filepath):
            print(f"  OK: {os.path.basename(filepath)} ({os.path.getsize(filepath)} bytes)")
            downloaded += 1
        else:
            print(f"  FAILED")
            download_failed.append(label)

    # ============================================================
    # SUMMARY
    # ============================================================
    print("\n" + "=" * 60)
    print("SUMMARY")
    print("=" * 60)

    total_counties = len(COUNTIES)
    total_cities = len(processed)

    # Count results
    county_ok = 0
    county_fail = []
    city_ok = 0
    city_fail = []

    for county in COUNTIES:
        slug = slugify(county) + "-county"
        filepath = os.path.join(COUNTY_DIR, f"{slug}.svg")
        if os.path.exists(filepath) and os.path.getsize(filepath) > 100:
            county_ok += 1
        else:
            county_fail.append(f"{county} County")

    for county, cities in CITIES_BY_COUNTY.items():
        seen = set()
        for city in cities:
            key = f"{city}-{county}"
            if key in seen:
                continue
            seen.add(key)
            slug = slugify(city)
            filepath = os.path.join(CITY_DIR, f"{slug}.svg")
            if os.path.exists(filepath) and os.path.getsize(filepath) > 100:
                city_ok += 1
            else:
                city_fail.append(f"{city} ({county} County)")

    print(f"\nCounties: {county_ok} found, {len(county_fail)} not found (out of {total_counties})")
    if county_fail:
        print("  Not found:")
        for c in county_fail:
            print(f"    - {c}")

    print(f"\nCities: {city_ok} found, {len(city_fail)} not found (out of {total_cities})")
    if city_fail:
        print("  Not found:")
        for c in city_fail:
            print(f"    - {c}")

    if download_failed:
        print(f"\nDownload failures ({len(download_failed)}):")
        for d in download_failed:
            print(f"    - {d}")

    print(f"\nTotal SVGs on disk: {county_ok + city_ok}")
    print(f"Total not found: {len(county_fail) + len(city_fail)}")


if __name__ == "__main__":
    main()
