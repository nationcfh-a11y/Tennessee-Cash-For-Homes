"""Add the hidden-gems city links (hidden-gems-links.json) to live blog posts.

Dry run by default. With --apply: backs up raw content to backups/hidden-gems/<id>.html,
refuses if the post was modified since the backup snapshot, then updates content only.
Each row either appends a sentence to the end of the paragraph that contains `para`
(before a trailing <br /> when `before` is set) or replaces exact text `find`.
[[slug|anchor]] becomes a link to /where-we-buy/slug/.

usage: python3 apply_hidden_gems_links.py [--apply] [--snapshot FILE]
"""
import argparse, base64, json, os, re, time, urllib.request, urllib.error, collections
HERE = os.path.dirname(os.path.abspath(__file__))
SITE = "https://tennesseecashforhomes.com"
DASH = re.compile("[—–]|\\s-\\s")

def env():
    e = {}
    for l in open(os.path.join(HERE, "..", ".env")):
        if "=" in l and not l.startswith("#"):
            k, v = l.strip().split("=", 1); e[k] = v.strip().strip("\"'")
    return e

E = env()
AUTH = base64.b64encode(f"{E['WP_USERNAME']}:{E['WP_APP_PASSWORD'].replace(' ', '')}".encode()).decode()

def api(path, data=None):
    for attempt in range(5):
        req = urllib.request.Request(SITE + "/wp-json/wp/v2" + path,
            data=json.dumps(data).encode() if data is not None else None,
            headers={"Authorization": "Basic " + AUTH, "User-Agent": "Mozilla/5.0", "Content-Type": "application/json"},
            method="POST" if data is not None else "GET")
        try:
            r = json.load(urllib.request.urlopen(req, timeout=60)); time.sleep(4); return r
        except urllib.error.HTTPError as e:
            if e.code == 429: time.sleep(30); continue
            raise

def link(m):
    slug, anchor = m.group(1), m.group(2)
    return f'<a href="{SITE}/where-we-buy/{slug}/">{anchor}</a>'

def apply_row(raw, row):
    if "find" in row:
        if raw.count(row["find"]) != 1: raise ValueError(f"find text count {raw.count(row['find'])}")
        return raw.replace(row["find"], re.sub(r"\[\[([a-z-]+)\|([^\]]+)\]\]", link, row["replace"]))
    i = raw.find(row["para"])
    if i < 0 or raw.count(row["para"]) != 1: raise ValueError("paragraph not found exactly once")
    j = raw.find("</p>", i)
    end = row.get("before", "")
    if end:
        if raw[j - len(end):j] != end: raise ValueError("expected trailing " + end)
        j -= len(end)
    return raw[:j] + re.sub(r"\[\[([a-z-]+)\|([^\]]+)\]\]", link, row["add"]) + raw[j:]

ap = argparse.ArgumentParser(); ap.add_argument("--apply", action="store_true"); ap.add_argument("--snapshot")
a = ap.parse_args()
rows = json.load(open(os.path.join(HERE, "hidden-gems-links.json")))
snap = {p["id"]: p for p in json.load(open(a.snapshot))} if a.snapshot else {}
# checks: dashes, 4-per-page cap, anchors unique per city
per_page = collections.Counter(); anchors = collections.defaultdict(list)
for r in rows:
    text = r.get("add", r.get("replace", ""))
    if DASH.search(text): raise SystemExit(f"dash in row for {r['post']}")
    for slug, anc in re.findall(r"\[\[([a-z-]+)\|([^\]]+)\]\]", text):
        per_page[r["post"]] += 1; anchors[slug].append(anc.lower())
for p, n in per_page.items():
    if n > 4: raise SystemExit(f"post {p} has {n} new links")
for s, l in anchors.items():
    if len(set(l)) != len(l): raise SystemExit(f"repeated anchor for {s}: {l}")
by = collections.defaultdict(list)
for r in rows: by[r["post"]].append(r)
os.makedirs(os.path.join(HERE, "backups", "hidden-gems"), exist_ok=True)
for pid, rs in by.items():
    live = api(f"/posts/{pid}?context=edit&_fields=id,link,modified,content")
    if snap and live["modified"] != snap[pid]["modified"]:
        raise SystemExit(f"{pid} changed since snapshot ({live['modified']}); stopping")
    raw = live["content"]["raw"]; new = raw
    for r in rs: new = apply_row(new, r)
    added = len(re.findall(r"where-we-buy/", new)) - len(re.findall(r"where-we-buy/", raw))
    print(f"{pid} {live['link']}  +{added} links")
    if a.apply:
        open(os.path.join(HERE, "backups", "hidden-gems", f"{pid}.html"), "w").write(raw)
        res = api(f"/posts/{pid}", {"content": new})
        print("   saved, modified", res["modified"])
