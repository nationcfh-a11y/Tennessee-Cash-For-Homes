"""Check whether a newer source report exists for the hand-updated figures in
the By the Numbers blocks:

  tn-cash-for-homes/cva-market-numbers.json   /cash-buyer-vs-agent-tennessee/
  tn-cash-for-homes/asis-market-numbers.json  /sell-as-is-vs-fix-up-tennessee/

Redfin series (all-cash, concessions, price-drops, buyers-vs-sellers) are
checked every run against Redfin's news posts published after the live
figure. The Cost vs Value series is an annual report (usually September), so
it is only checked from September through December: it looks for the next
edition's Nashville page.

Runs in the monthly Market Stats workflow. It never changes the site: it
prints a Markdown section for REFRESH_STATUS.md and, when something newer
exists, writes issue text to --issue so the workflow can open a GitHub issue
(which emails the repository owner).

usage: python3 -I check_redfin_reports.py NUMBERS_JSON [NUMBERS_JSON ...]
                                          [--issue OUT_MD] [--cvv-any-month]
exit code is always 0; "could not check" is reported in the text instead.
"""
import argparse, datetime, html, json, re, urllib.parse, urllib.request

API = 'https://www.redfin.com/news/wp-json/wp/v2/posts'
UA = 'Mozilla/5.0 (compatible; tcfh-market-stats-check)'
# Title or URL slug patterns for each Redfin series. Kept narrow so general
# market posts that merely mention the topic are not flagged.
REDFIN = {
    'all-cash': re.compile(r'all-cash|paid cash|made in cash|cash (home )?(purchases|buyers|homebuyers)|in cash\b', re.I),
    'concessions': re.compile(r'concession', re.I),
    'price-drops': re.compile(r'price-drop|price drop', re.I),
    'buyers-vs-sellers': re.compile(r'buyers-vs-sellers|sellers than buyers|buyers vs\.? sellers', re.I),
}
CVV_URL = 'https://www.jlconline.com/cost-vs-value/{year}/east-south-central/nashville-tn/'


def fetch(url):
    req = urllib.request.Request(url, headers={'User-Agent': UA})
    with urllib.request.urlopen(req, timeout=60) as r:
        return r.read().decode('utf-8', 'replace'), r.headers


def posts_after(date):
    """Every Redfin news post published after DATE (YYYY-MM-DD), newest first."""
    out, page = [], 1
    while page <= 10:
        q = urllib.parse.urlencode({'after': f'{date}T23:59:59', 'per_page': 100, 'page': page,
                                    '_fields': 'date,link,title'})
        try:
            body, headers = fetch(f'{API}?{q}')
        except urllib.error.HTTPError as e:
            if e.code == 400 and page > 1:   # past the last page
                break
            raise
        out += json.loads(body)
        if page >= int(headers.get('X-WP-TotalPages', '1')):
            break
        page += 1
    return out


def newest_by_series(figures):
    """One entry per series: the most recently published live figure."""
    out = {}
    for f in figures:
        s = f.get('series')
        if s and (s not in out or f['published'] > out[s]['published']):
            out[s] = f
    return out


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument('numbers', nargs='+')
    ap.add_argument('--issue')
    ap.add_argument('--cvv-any-month', action='store_true', help='check Cost vs Value outside September to December (testing)')
    a = ap.parse_args()
    lines, newer = [], []
    cvv_season = a.cvv_any_month or datetime.date.today().month >= 9
    for path in a.numbers:
        data = json.load(open(path))
        page = data.get('page', 'https://tennesseecashforhomes.com/cash-buyer-vs-agent-tennessee/')
        figures = data.get('figures') or data.get('nashville') or []
        lines += ['', f'## By the Numbers figures: {page}', '']
        for series, f in newest_by_series(figures).items():
            live = f"{f['value']}, published {f['published']}"
            if series == 'cost-vs-value':
                if not cvv_season:
                    lines.append(f"- cost-vs-value: {f['edition']} edition live; next check in September (the report usually comes out then).")
                    continue
                url = CVV_URL.format(year=f['edition'] + 1)
                try:
                    body, _ = fetch(url)
                    found = 'Cost Recouped' in body
                except Exception as e:
                    lines.append(f"- cost-vs-value: could not check {url} ({e.__class__.__name__}: {e})")
                    continue
                if found:
                    newer.append((page, series, live, f"Cost vs Value {f['edition'] + 1}, Nashville", url, ''))
                    lines.append(f"- **cost-vs-value: the {f['edition'] + 1} edition is out.** Live: {f['edition']} edition. {url}")
                else:
                    lines.append(f"- cost-vs-value: up to date ({f['edition']} edition); no {f['edition'] + 1} Nashville page yet.")
                continue
            pat = REDFIN.get(series)
            if not pat:
                lines.append(f'- {series}: unknown series, not checked')
                continue
            try:
                found = [p for p in posts_after(f['published'])
                         if pat.search(html.unescape(p['title']['rendered'])) or pat.search(p['link'])]
            except Exception as e:  # network, block, bad JSON: report it, don't fail the refresh
                lines.append(f'- {series} ({live}): could not check Redfin ({e.__class__.__name__}: {e})')
                continue
            if found:
                for p in found:
                    newer.append((page, series, live, html.unescape(p['title']['rendered']), p['link'], p['date'][:10]))
                lines.append(f'- **{series}: newer Redfin report found.** Live figure {live}. '
                             + '; '.join(f"{p['date'][:10]} {p['link']}" for p in found))
            else:
                lines.append(f'- {series}: up to date. Live figure {live}; no newer Redfin report.')
    print('\n'.join(lines))
    if newer and a.issue:
        body = ['A newer source report exists for a figure in a **By the Numbers** block. Nothing on the site changed.', '',
                'To update: open the report, check it has a Nashville (or Tennessee) figure for the same measure, then edit the '
                'page\'s JSON file in `tn-cash-for-homes/` (value, label/source, published, url) and deploy.', '']
        for page, series, live, title, url, date in newer:
            body.append(f"- {page} **{series}** (live: {live}). Newer: [{title}]({url}){' (' + date + ')' if date else ''}")
        open(a.issue, 'w').write('\n'.join(body) + '\n')


if __name__ == '__main__':
    main()
