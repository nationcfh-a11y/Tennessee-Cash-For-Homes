#!/usr/bin/env python3
"""Set Rank Math SEO titles and descriptions on blog posts, from seo-meta.json.

DRY RUN BY DEFAULT. Nothing is written unless you pass --apply.

    python3 search-quick-wins/apply_rank_math_meta.py                      # preview all
    python3 search-quick-wins/apply_rank_math_meta.py --only how-long-does-it-take-to-sell-a-house-in-tennessee --apply
    python3 search-quick-wins/apply_rank_math_meta.py --apply              # all six
    python3 search-quick-wins/apply_rank_math_meta.py --revert --apply     # clear the fields again

What --apply does, per post: POST /wp-json/rankmath/v1/updateMeta with
{objectType: "post", objectID: <id>, meta: {rank_math_title, rank_math_description}}.
That is the same route the Rank Math sidebar in the post editor uses. Core
/wp/v2 REST cannot write these fields on this site, so the script does not try it.

Safety checks before any write:
  - every title is 60 characters or fewer and every description 155 or fewer
  - no em or en dashes
  - the post ID in seo-meta.json still has the expected slug (stops if not)
After each write it re-reads the live page and reports whether the new title
and description are being served.

Credentials come from the repo's .env (WP_URL, WP_USERNAME, WP_APP_PASSWORD),
the same ones the other scripts in this repo use.
"""
import argparse
import base64
import html
import json
import re
import sys
import time
import urllib.error
import urllib.request
from pathlib import Path

HERE = Path(__file__).resolve().parent
ROOT = HERE.parent
TITLE_MAX, DESC_MAX = 60, 155
PAUSE = 3  # seconds between requests; the site returns 429 when hit quickly


def load_env(path):
    env = {}
    for line in path.read_text().splitlines():
        line = line.strip()
        if line and not line.startswith("#") and "=" in line:
            k, v = line.split("=", 1)
            env[k.strip()] = v.strip().strip('"').strip("'")
    return env


def request(url, auth=None, data=None, method=None):
    headers = {"User-Agent": "tcfh-seo-meta/1.0", "Accept": "application/json, text/html"}
    if auth:
        headers["Authorization"] = "Basic " + auth
    body = None
    if data is not None:
        body = json.dumps(data).encode()
        headers["Content-Type"] = "application/json"
    for attempt in range(4):
        req = urllib.request.Request(url, data=body, headers=headers, method=method)
        try:
            with urllib.request.urlopen(req, timeout=30) as r:
                time.sleep(PAUSE)
                return r.status, r.read().decode("utf-8", "replace")
        except urllib.error.HTTPError as e:
            if e.code == 429 and attempt < 3:
                time.sleep(20)
                continue
            time.sleep(PAUSE)
            return e.code, e.read().decode("utf-8", "replace")


def live_head(url):
    try:
        status, page = request(url)
    except Exception as e:  # DNS or network trouble on this machine
        return None, None, f"could not fetch ({e.__class__.__name__})"
    t = re.search(r"<title[^>]*>(.*?)</title>", page, re.S)
    d = re.search(r'<meta name="description" content="([^"]*)"', page)
    return (html.unescape(t.group(1).strip()) if t else None,
            html.unescape(d.group(1)) if d else None, status)


def validate(items):
    problems = []
    for it in items:
        for field, limit in (("title", TITLE_MAX), ("description", DESC_MAX)):
            v = it[field]
            if len(v) > limit:
                problems.append(f"{it['slug']}: {field} is {len(v)} chars (max {limit})")
            if "—" in v or "–" in v:
                problems.append(f"{it['slug']}: {field} contains a dash")
    return problems


def main():
    ap = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    ap.add_argument("--apply", action="store_true", help="actually write (default is a dry run)")
    ap.add_argument("--only", metavar="SLUG", help="limit to one post slug")
    ap.add_argument("--revert", action="store_true", help="clear both fields so Rank Math falls back again")
    args = ap.parse_args()

    items = json.loads((HERE / "seo-meta.json").read_text())
    if args.only:
        items = [i for i in items if i["slug"] == args.only]
        if not items:
            sys.exit(f"No entry with slug {args.only!r} in seo-meta.json")
    problems = validate(items)
    if problems:
        sys.exit("Refusing to run:\n  " + "\n  ".join(problems))

    env = load_env(ROOT / ".env")
    base = env["WP_URL"].rstrip("/")
    auth = base64.b64encode(f"{env['WP_USERNAME']}:{env['WP_APP_PASSWORD'].replace(' ', '')}".encode()).decode()

    print(("APPLYING" if args.apply else "DRY RUN (nothing will be written)") + (" / REVERT" if args.revert else ""))
    for it in items:
        status, body = request(f"{base}/wp-json/wp/v2/posts/{it['id']}?_fields=id,slug,link")
        post = json.loads(body) if status == 200 else {}
        if post.get("slug") != it["slug"]:
            print(f"\n!! Post {it['id']} is not {it['slug']} (got {post.get('slug')!r}, HTTP {status}). Skipped.")
            continue
        new_t = "" if args.revert else it["title"]
        new_d = "" if args.revert else it["description"]
        cur_t, cur_d, note = live_head(post["link"])
        print(f"\n== {post['link']}  (post {it['id']})")
        print(f"   live title : {cur_t or note}")
        print(f"   new title  : {new_t or '(cleared: theme/Rank Math fallback)'}")
        print(f"   live desc  : {cur_d or note}")
        print(f"   new desc   : {new_d or '(cleared: theme/Rank Math fallback)'}")
        if not args.apply:
            continue

        status, body = request(
            f"{base}/wp-json/rankmath/v1/updateMeta",
            auth=auth,
            data={"objectType": "post", "objectID": it["id"],
                  "meta": {"rank_math_title": new_t, "rank_math_description": new_d}},
            method="POST",
        )
        print(f"   write      : HTTP {status} {body[:200]}")
        if status != 200:
            print("   Stopping: fix the error above before running the rest.")
            sys.exit(1)
        got_t, got_d, note = live_head(post["link"])
        if got_t is None:
            print(f"   verify     : {note}. Check the page source by hand.")
        elif args.revert:
            print(f"   verify     : now serving title {got_t!r}")
        else:
            ok = got_t == new_t and got_d == new_d
            print(f"   verify     : {'OK' if ok else 'NOT YET LIVE (page cache?)'}  title={got_t!r}")


if __name__ == "__main__":
    main()
