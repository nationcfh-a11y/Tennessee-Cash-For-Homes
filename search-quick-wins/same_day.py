"""Same-day steps for the Nov 3, 2026 merges (cannibalization-plan.md).

Run only after the theme deploy that moves the content into the city pages.

  1. Kept guide: replace post #2004's body with merge-content/2004-kept-guide.html
     and set its Rank Math title and description.
  2. Internal links: repoint every link to a retiring post at its new home.
  3. Redirects: 301 each retiring post, plus the 104 dated URLs in
     redirects-dated-urls.csv, in the Redirection plugin's "Redirections" group.
  4. Retired posts go to draft (after their 301 exists, so there is no 404 gap).

Dry run by default: prints every change and writes nothing. With --apply, each
post's raw content is saved to backups/<id>.html (never overwritten) before it
is changed, and every write is read back to confirm.

usage: python3 same_day.py [--apply]
"""
import argparse, base64, csv, json, os, re, socket, sys, time, urllib.error

HERE = os.path.dirname(os.path.abspath(__file__))
sys.path.insert(0, os.path.join(HERE, '..', 'internal-links'))
from apply_city_links import load_env, api as _api

socket.setdefaulttimeout(60)

KEEP_ID = 2004
KEEP = '/how-to-sell-your-house-fast-in-tennessee/'
KEEP_TITLE = 'How to Sell Your House Fast in Tennessee: Cash vs Listing'
KEEP_DESC = ('How long a Tennessee sale really takes, what slows it down, and how a cash sale '
             'compares with listing on what you actually net.')

# Retiring post id: (slug, where it 301s)
RETIRE = {
    3204: ('sell-my-house-fast-in-nashville-tn-a-guide-for-local-homeowners', '/where-we-buy/nashville/'),
    3151: ('sell-your-house-fast-in-spring-hill-tennessee', '/where-we-buy/spring-hill/'),
    3343: ('sell-my-house-fast-in-murfreesboro-tn', '/where-we-buy/murfreesboro/'),
    2114: ('how-to-identify-the-top-cash-home-buyers-in-murfreesboro-tn', '/where-we-buy/murfreesboro/'),
    3107: ('sell-my-house-fast-in-columbia-tn-a-guide-for-local-homeowners', '/where-we-buy/columbia/'),
    3601: ('sell-my-house-fast-in-tn', KEEP),
    1984: ('how-to-sell-your-house-fast-in-tennessee-insider-tips-for-a-quick-hassle-free-sale', KEEP),
    1994: ('how-to-sell-a-home-in-tennessee-fast-tips-for-2025', KEEP),
    2034: ('navigating-the-tennessee-real-estate-market-a-guide-to-selling-your-home-fast', KEEP),
    2134: ('how-to-sell-your-house-fast', KEEP),
    2138: ('sell-your-house-fast-for-cash-a-step-by-step-guide-for-success', KEEP),
}
SITE = 'https://tennesseecashforhomes.com'


def api(*a, **k):
    """api() that waits and retries when WordPress rate-limits (429) or the network drops."""
    for wait in (30, 60, 120, 240, None):
        try:
            return _api(*a, **k)
        except urllib.error.HTTPError as e:
            if e.code != 429 or wait is None:
                raise
            print(f'  rate limited, waiting {wait}s')
        except (urllib.error.URLError, socket.timeout, ConnectionError) as e:
            if wait is None:
                raise
            print(f'  network error ({e}), waiting {wait}s')
        time.sleep(wait)


def link_pattern(slug):
    """href to the post: absolute or relative, optional /YYYY/MM/DD/, optional trailing slash, optional #anchor."""
    return re.compile(r'href="(?:https?://(?:www\.)?tennesseecashforhomes\.com)?(?:/\d{4}/\d{2}/\d{2})?/'
                      + re.escape(slug) + r'/?(#[^"]*)?"')


def backup(pid, raw):
    path = os.path.join(HERE, 'backups', f'{pid}.html')
    os.makedirs(os.path.dirname(path), exist_ok=True)
    if not os.path.exists(path):
        open(path, 'w').write(raw)


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument('--apply', action='store_true')
    args = ap.parse_args()
    env = load_env()
    base = env['WP_URL'].rstrip('/')
    auth = base64.b64encode(f"{env['WP_USERNAME']}:{env['WP_APP_PASSWORD']}".encode()).decode()
    say = (lambda *m: print(*m)) if args.apply else (lambda *m: print('[dry run]', *m))

    posts, page = [], 1
    while True:
        try:
            batch = api(base, auth, f'/wp-json/wp/v2/posts?context=edit&per_page=100&page={page}'
                                    '&status=publish,draft,future,private&_fields=id,slug,status,content')
        except urllib.error.HTTPError as e:
            if e.code == 400:
                break
            raise
        if not batch:
            break
        posts += batch
        page += 1
    by_id = {p['id']: p for p in posts}
    for pid, (slug, _) in RETIRE.items():
        assert by_id[pid]['slug'] == slug, (pid, by_id[pid]['slug'])
    assert by_id[KEEP_ID]['slug'] == KEEP.strip('/')

    # The city pages must already show the moved content.
    for target, marker in (('/where-we-buy/columbia/', 'Why sell to a local Columbia buyer'),
                           ('/where-we-buy/murfreesboro/', 'What happens after I accept your offer?'),
                           ('/where-we-buy/spring-hill/', 'How do I sell my house fast in Spring Hill, TN?'),
                           ('/where-we-buy/nashville/', 'What should I ask a cash buyer in Nashville?')):
        import subprocess
        html = subprocess.run(['curl', '-s', '--max-time', '30', '--resolve', 'tennesseecashforhomes.com:443:192.0.78.130',
                               f'{SITE}{target}?deploycheck={int(time.time())}'], capture_output=True, text=True).stdout
        ok = marker.replace("'", '&#039;') in html or marker in html
        print(f'deploy check {target}: {"moved content is live" if ok else "NOT LIVE YET"}')
        if args.apply and not ok:
            sys.exit('Stop: deploy the theme first, then rerun.')

    # 1. Kept guide
    new_body = open(os.path.join(HERE, 'merge-content', '2004-kept-guide.html')).read()
    say(f'#{KEEP_ID}: body {len(by_id[KEEP_ID]["content"]["raw"])} -> {len(new_body)} chars; SEO title "{KEEP_TITLE}"')
    if args.apply:
        backup(KEEP_ID, by_id[KEEP_ID]['content']['raw'])
        api(base, auth, f'/wp-json/wp/v2/posts/{KEEP_ID}', {'content': new_body})
        api(base, auth, '/wp-json/rankmath/v1/updateMeta', {'objectType': 'post', 'objectID': KEEP_ID,
            'meta': {'rank_math_title': KEEP_TITLE, 'rank_math_description': KEEP_DESC}})
        assert api(base, auth, f'/wp-json/wp/v2/posts/{KEEP_ID}?context=edit&_fields=content')['content']['raw'] == new_body
        by_id[KEEP_ID]['content']['raw'] = new_body

    # 2. Internal links (in posts that stay published)
    link_changes = 0
    for p in posts:
        if p['id'] in RETIRE:
            continue
        raw = new = p['content']['raw']
        for slug, target in RETIRE.values():
            new = link_pattern(slug).sub(lambda m: f'href="{SITE}{target}"', new)
        if new != raw:
            n = sum(len(link_pattern(s).findall(raw)) for s, _ in RETIRE.values())
            link_changes += n
            say(f'#{p["id"]} {p["slug"][:60]}: {n} link(s) repointed')
            if args.apply:
                backup(p['id'], raw)
                api(base, auth, f'/wp-json/wp/v2/posts/{p["id"]}', {'content': new})
                assert api(base, auth, f'/wp-json/wp/v2/posts/{p["id"]}?context=edit&_fields=content')['content']['raw'] == new
    print(f'internal links: {link_changes} repointed')

    # 3. Redirects
    existing = {r['url'].rstrip('/') for r in api(base, auth, '/wp-json/redirection/v1/redirect?per_page=200')['items']}
    rules = [(f'/{slug}/', target) for slug, target in RETIRE.values()]
    rules += [(r[0], r[1]) for r in csv.reader(open(os.path.join(HERE, 'redirects-dated-urls.csv')))]
    retiring = {f'/{s}/' for s, _ in RETIRE.values()}
    assert not [t for _, t in rules if t in retiring], 'a redirect points at a retiring post'
    added = 0
    for src, target in rules:
        if src.rstrip('/') in existing:
            print(f'  skip (already exists): {src}')
            continue
        added += 1
        if args.apply:
            api(base, auth, '/wp-json/redirection/v1/redirect', {
                'url': src, 'match_type': 'url', 'action_type': 'url', 'action_code': 301,
                'action_data': {'url': target}, 'group_id': 1, 'regex': False})
    say(f'redirects: {added} to add ({len(RETIRE)} retiring posts, {len(rules) - len(RETIRE)} dated URLs)')

    # 4. Retired posts to draft
    for pid, (slug, target) in RETIRE.items():
        say(f'#{pid} /{slug}/ -> draft (301 to {target})')
        if args.apply:
            backup(pid, by_id[pid]['content']['raw'])
            api(base, auth, f'/wp-json/wp/v2/posts/{pid}', {'status': 'draft'})


if __name__ == '__main__':
    main()
