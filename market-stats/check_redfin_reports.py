"""Check whether Redfin has published a newer report for the hand-updated
Nashville figures on /cash-buyer-vs-agent-tennessee/ (all-cash share and
seller concessions), listed in tn-cash-for-homes/cva-market-numbers.json.

Runs in the monthly Market Stats workflow. It never changes the site: it prints
a short Markdown section for REFRESH_STATUS.md and, when a newer report exists,
writes the issue text to the --issue file so the workflow can open a GitHub
issue (which emails the repository owner).

usage: python3 -I check_redfin_reports.py NUMBERS_JSON [--issue OUT_MD]
exit code is always 0; "could not check" is reported in the text instead.
"""
import argparse, html, json, re, sys, urllib.parse, urllib.request

API = 'https://www.redfin.com/news/wp-json/wp/v2/posts'
# Title or URL slug patterns for each report series. Kept narrow so general
# market posts that merely mention cash or concessions are not flagged.
SERIES = {
    'all-cash': re.compile(r'all-cash|paid cash|made in cash|cash (home )?(purchases|buyers|homebuyers)|in cash\b', re.I),
    'concessions': re.compile(r'concession', re.I),
}


def posts_after(date):
    """Every Redfin news post published after DATE (YYYY-MM-DD), newest first."""
    out, page = [], 1
    while page <= 10:
        q = urllib.parse.urlencode({'after': f'{date}T23:59:59', 'per_page': 100, 'page': page,
                                    '_fields': 'date,link,title'})
        req = urllib.request.Request(f'{API}?{q}', headers={'User-Agent': 'tcfh-market-stats-check'})
        try:
            with urllib.request.urlopen(req, timeout=60) as r:
                batch = json.load(r)
                pages = int(r.headers.get('X-WP-TotalPages', '1'))
        except urllib.error.HTTPError as e:
            if e.code == 400 and page > 1:   # past the last page
                break
            raise
        out += batch
        if page >= pages:
            break
        page += 1
    return out


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument('numbers')
    ap.add_argument('--issue')
    a = ap.parse_args()
    figures = json.load(open(a.numbers))['nashville']
    lines = ['', '## Cash buyer vs agent page: Nashville figures', '']
    newer = []
    for f in figures:
        pat = SERIES.get(f['series'])
        if not pat:
            lines.append(f"- {f['series']}: unknown series, not checked")
            continue
        try:
            found = [p for p in posts_after(f['published'])
                     if pat.search(html.unescape(p['title']['rendered'])) or pat.search(p['link'])]
        except Exception as e:  # network, block, bad JSON: report it, don't fail the refresh
            lines.append(f"- {f['series']} ({f['value']}, {f['data_period']}): could not check Redfin ({e.__class__.__name__}: {e})")
            continue
        if found:
            for p in found:
                newer.append((f, p))
            lines.append(f"- **{f['series']}: newer Redfin report found.** Live figure {f['value']} ({f['data_period']}, published {f['published']}). "
                         + '; '.join(f"{p['date'][:10]} {p['link']}" for p in found))
        else:
            lines.append(f"- {f['series']}: up to date. Live figure {f['value']} ({f['data_period']}, published {f['published']}); no newer Redfin report.")
    print('\n'.join(lines))
    if newer and a.issue:
        body = ['Redfin has published a newer report for a Nashville figure in the **By the Numbers** block on '
                'https://tennesseecashforhomes.com/cash-buyer-vs-agent-tennessee/.', '',
                'Nothing on the site changed. To update it: open the report, check that it has a Nashville figure, then edit '
                '`tn-cash-for-homes/cva-market-numbers.json` (value, data_period, published, url) and deploy.', '']
        for f, p in newer:
            body.append(f"- **{f['series']}**: live figure {f['value']} ({f['data_period']}, published {f['published']}). "
                        f"Newer: [{html.unescape(p['title']['rendered'])}]({p['link']}) ({p['date'][:10]})")
        open(a.issue, 'w').write('\n'.join(body) + '\n')


if __name__ == '__main__':
    main()
