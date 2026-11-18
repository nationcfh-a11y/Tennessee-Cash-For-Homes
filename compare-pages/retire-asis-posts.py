"""Retire 5 posts into /sell-as-is-vs-fix-up-tennessee/ (page 3943) and
/sell-house-as-is-tennessee/. Approved by Karson Nov 18 2026; run ONLY after
page 3943 is published and the functions.php redirects are deployed.

  gsc-dashboard/venv/bin/python compare-pages/retire-asis-posts.py          # dry run
  gsc-dashboard/venv/bin/python compare-pages/retire-asis-posts.py --apply  # does it

1. In every published post and page, repoints links to the 5 posts (plain,
   www, relative and dated forms). Where the link text is the old post's
   title, it becomes the new target's title; descriptive link text stays.
2. Adds one sentence linking to the new page in post 2050 (Renovating a
   House Tips), at the end of its conclusion.
3. Sets the 5 posts to draft, which drops them from the Jetpack sitemap; the
   theme's redirect map 301s their URLs.
"""
import html, re, sys, requests
env = dict(l.strip().split('=', 1) for l in open('.env') if '=' in l and not l.startswith('#'))
auth = (env['WP_USERNAME'], env['WP_APP_PASSWORD'].replace(' ', '').strip('"'))
B = 'https://tennesseecashforhomes.com/wp-json/wp/v2/'
SITE = 'https://tennesseecashforhomes.com'
NEW = (SITE + '/sell-as-is-vs-fix-up-tennessee/', 'Sell As-Is or Fix Up in Tennessee')
ASIS = (SITE + '/sell-house-as-is-tennessee/', 'Sell Your House As-Is in Tennessee')
RETIRE = {  # id: (slug, dated prefix, target, title-like link text pattern)
    1990: ('selling-a-house-in-poor-condition-unlocking-the-value-of-as-is-sales', '2024/12/31', NEW, r'Selling a House in Poor Condition: Unlocking'),
    2094: ('top-10-home-improvements-to-boost-your-property-s-value-before-selling', '2024/03/12', NEW, r'Top 10 Home Improvements'),
    2048: ('how-to-prepare-for-a-quick-home-sale-in-tennessee', '2024/04/28', NEW, r'How to Prepare for a Quick Home Sale in Tennessee'),
    2126: ('selling-homes-as-is-condition', '2024/02/29', ASIS, r'Selling Homes .{0,12}As-Is.{0,12} Condition'),
    2100: ('why-tennessee-cash-for-homes-is-your-best-choice-for-selling-ugly-houses', '2024/03/08', ASIS, r'Why Tennessee Cash For Homes is Your Best Choice for Selling'),
}
apply = '--apply' in sys.argv

page = requests.get(B + 'pages/3943', params={'context': 'edit', '_fields': 'status'}, auth=auth).json()
if apply and page.get('status') != 'publish':
    sys.exit('Page 3943 is not published yet. Stopping.')


def fix_links(raw):
    changes = []
    for pid, (slug, dated, (to_url, to_title), title_rx) in RETIRE.items():
        href_rx = r'href="(?:https?://(?:www\.)?tennesseecashforhomes\.com)?/(?:' + re.escape(dated) + r'/)?' + re.escape(slug) + r'/?"'
        def repl(m):
            a = m.group(0)
            a2 = re.sub(href_rx, f'href="{to_url}"', a)
            text = m.group(2)
            if re.search(title_rx, html.unescape(re.sub(r"<[^>]+>", "", text)).replace("\xa0", " "), re.I):
                a2 = a2[:a2.index('>', a2.index('href=')) + 1] + to_title + '</a>'
                changes.append(f'{slug[:40]} -> {to_url} (text now "{to_title}")')
            else:
                changes.append(f'{slug[:40]} -> {to_url} (text kept "{re.sub("<[^>]+>", "", text)[:50]}")')
            return a2
        raw = re.sub(r'(<a\b[^>]*' + href_rx + r'[^>]*>)(.*?)</a>', repl, raw, flags=re.S)
    return raw, changes


items = []
for t in ('posts', 'pages'):
    pg = 1
    while True:
        r = requests.get(B + t, params={'per_page': 100, 'page': pg, 'status': 'publish', 'context': 'edit', '_fields': 'id,content'}, auth=auth)
        if r.status_code != 200:
            break
        items += [(t, x['id'], x['content']['raw']) for x in r.json()]
        if pg >= int(r.headers.get('X-WP-TotalPages', 1)):
            break
        pg += 1

total = 0
for t, i, raw in items:
    if i in RETIRE:
        continue
    new, changes = fix_links(raw)
    if i == 2050:
        marker = 'Not sure whether a project will pay off before you sell?'
        if marker not in new:
            add = ('<p>' + marker + ' Our <a href="' + NEW[0] + '">sell as-is or fix up comparison</a> shows which repairs usually '
                   'pay for themselves before listing, which usually don\'t, and when selling as-is leaves you with more.</p>')
            new = new.rstrip() + '\n\n' + add
            changes.append('added link to the new page at the end')
    if changes:
        total += len(changes)
        print(f'{t[:-1]} {i}:'); [print('   ', c) for c in changes]
        if apply:
            r = requests.post(B + f'{t}/{i}', json={'content': new}, auth=auth)
            print('    updated', r.status_code)
print(f'{total} change(s)')

for pid in RETIRE:
    print(f'post {pid} -> draft')
    if apply:
        r = requests.post(B + f'posts/{pid}', json={'status': 'draft'}, auth=auth)
        print('   status', r.status_code, r.json().get('status'))
if not apply:
    print('Dry run only. Add --apply to make the changes.')
