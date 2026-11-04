"""Build the Market Stats figures for the city, county, foreclosure and statewide pages.

Every figure comes from one of three free public sources, with its period:
  Redfin Data Center  median sale price, median days on market, homes sold,
                      average sale-to-list ratio (cities: rolling 3 months;
                      counties and the state: calendar month)
  Zillow ZHVI         typical home value (middle tier, all homes, smoothed,
                      seasonally adjusted), by month
  U.S. Census ACS     population, median household income, median year
                      structure built (5-year estimates)

When a city has no figure from a source, or fewer than MIN_CITY_SALES Redfin
sales in the window, that source's figures come from its county instead and
the card is labeled as county data. Nothing is estimated.

Inputs are the files fetch_market_data.sh writes into RAW_DIR. Before writing
the theme file, check() compares the result with sanity limits and with the
figures currently live; if anything fails, nothing is written and the reasons
are printed (exit code 2).

usage: python3 -I build_market_stats.py RAW_DIR [--only SLUG ...] [--json OUT]
                                        [--php OUT] [--previous LIVE_PHP_FILE]
"""
import argparse, csv, datetime, json, os, re, subprocess, sys

MIN_CITY_SALES = 20   # Redfin sales in the 3-month window below which city figures are too thin
MAX_AGE_MONTHS = 4    # Redfin and Zillow periods older than this fail the freshness check

MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
          'September', 'October', 'November', 'December']

# City pages (location and foreclosure templates): slug -> (place name in the sources, county)
CITIES = {
    'nashville': ('Nashville', 'Davidson'), 'franklin': ('Franklin', 'Williamson'),
    'brentwood': ('Brentwood', 'Williamson'), 'spring-hill': ('Spring Hill', 'Maury'),
    'columbia': ('Columbia', 'Maury'), 'murfreesboro': ('Murfreesboro', 'Rutherford'),
    'smyrna': ('Smyrna', 'Rutherford'), 'la-vergne': ('La Vergne', 'Rutherford'),
    'clarksville': ('Clarksville', 'Montgomery'), 'hendersonville': ('Hendersonville', 'Sumner'),
    'gallatin': ('Gallatin', 'Sumner'), 'lebanon': ('Lebanon', 'Wilson'),
    'mt-juliet': ('Mount Juliet', 'Wilson'), 'springfield': ('Springfield', 'Robertson'),
    'dickson': ('Dickson', 'Dickson'), 'shelbyville': ('Shelbyville', 'Bedford'),
    'tullahoma': ('Tullahoma', 'Coffee'), 'cookeville': ('Cookeville', 'Putnam'),
    # foreclosure pages only
    'antioch': ('Antioch', 'Davidson'), 'old-hickory': ('Old Hickory', 'Davidson'),
    'chapel-hill': ('Chapel Hill', 'Marshall'), 'chattanooga': ('Chattanooga', 'Hamilton'),
    'crossville': ('Crossville', 'Cumberland'), 'jackson': ('Jackson', 'Madison'),
    'knoxville': ('Knoxville', 'Knox'), 'mcminnville': ('McMinnville', 'Warren'),
    'memphis': ('Memphis', 'Shelby'), 'woodbury': ('Woodbury', 'Cannon'),
}
COUNTIES = ['Bedford', 'Coffee', 'Davidson', 'Dickson', 'Maury', 'Montgomery', 'Putnam',
            'Robertson', 'Rutherford', 'Sumner', 'Williamson', 'Wilson']

# Census place names that don't start with the city name.
ACS_NAMES = {'nashville': 'Nashville-Davidson metropolitan government (balance), Tennessee'}
ACS_PLACE_TYPES = ('city', 'town', 'city (balance)', 'metropolitan government (balance)')


def month_label(iso):
    d = datetime.date.fromisoformat(iso)
    return f'{MONTHS[d.month - 1]} {d.year}'


def num(x):
    try:
        return float(x)
    except (TypeError, ValueError):
        return None


# ── Redfin ──
def load_redfin(path):
    """Latest row per region name."""
    latest = {}
    with open(path, newline='') as f:
        for row in csv.DictReader(f):
            name = row['REGION NAME']
            if name not in latest or row['PERIOD END'] > latest[name]['PERIOD END']:
                latest[name] = row
    return latest


def redfin_figures(row, where):
    period = (f"{month_label(row['PERIOD BEGIN'])[:-5]} to {month_label(row['PERIOD END'])}"
              if row['FREQUENCY'].startswith('Rolling') else month_label(row['PERIOD END']))
    src = f'Redfin, {period}'
    fig = lambda value, **kw: dict(value=value, source=src, where=where, period_end=row['PERIOD END'], **kw)
    return {
        'median_sale_price': fig(num(row['MEDIAN SALE PRICE NSA ($)']), yoy_pct=num(row['MEDIAN SALE PRICE NSA YOY (%)'])),
        'median_dom': fig(num(row['MEDIAN DAYS ON MARKET (DAYS)']), yoy_days=num(row['MEDIAN DAYS ON MARKET YOY (DAYS)'])),
        'homes_sold': fig(num(row['HOMES SOLD']), yoy_pct=num(row['HOMES SOLD YOY (%)']), period=period),
        'sale_to_list': fig(num(row['AVERAGE SALE TO LIST RATIO (%)']), yoy_ppts=num(row['AVERAGE SALE TO LIST RATIO YOY (PPTS)'])),
    }


# ── Zillow ──
def load_zillow(path):
    """Tennessee rows keyed by RegionName."""
    out = {}
    with open(path, newline='') as f:
        r = csv.reader(f)
        head = next(r)
        months = [i for i, h in enumerate(head) if h[:2] in ('19', '20')]
        col = {h: i for i, h in enumerate(head)}
        for row in r:
            state = row[col['State']] if 'State' in col else ''
            name = row[col['RegionName']]
            if state == 'TN' or (head[col['RegionType']] and row[col['RegionType']] == 'state' and name == 'Tennessee'):
                out[name] = (head, row, months)
    return out


def zillow_figure(entry, where):
    if not entry:
        return None
    head, row, months = entry
    last = max((i for i in months if row[i]), default=None)
    if last is None:
        return None
    prev = last - 12 if last - 12 in months and row[last - 12] else None
    v = float(row[last])
    return {'value': v, 'yoy_pct': (v / float(row[prev]) - 1) * 100 if prev else None,
            'source': f'Zillow Home Value Index, {month_label(head[last])}', 'where': where, 'period_end': head[last]}


# ── Census ACS ──
def load_acs(raw):
    names = {}
    with open(os.path.join(raw, 'acs', 'geos.txt'), newline='', encoding='latin-1') as f:
        for row in csv.DictReader(f, delimiter='|'):
            if row['STUSAB'] == 'TN' and row['SUMLEVEL'] in ('040', '050', '160') and row['COMPONENT'] == '00':
                names[row['GEO_ID']] = row['NAME']
    tables = {}
    for t, col in (('b01003', 'B01003_E001'), ('b19013', 'B19013_E001'), ('b25035', 'B25035_E001')):
        with open(os.path.join(raw, 'acs', f'{t}.dat'), newline='') as f:
            for row in csv.DictReader(f, delimiter='|'):
                if row['GEO_ID'] in names:
                    v = num(row[col])
                    tables.setdefault(names[row['GEO_ID']], {})[t] = v if v is not None and v > 0 else None
    return tables


def acs_figures(vals, where, vintage):
    src = f'U.S. Census Bureau, ACS 5-year estimates, {vintage}'
    return {key: {'value': (vals or {}).get(t), 'source': src, 'where': where}
            for key, t in (('population', 'b01003'), ('median_income', 'b19013'), ('median_year_built', 'b25035'))}


def acs_place(acs, slug, place):
    if slug in ACS_NAMES:
        return ACS_NAMES[slug]
    for n in acs:
        head = n.split(',')[0]
        if n.endswith(', Tennessee') and head.startswith(place + ' ') and head[len(place):].strip() in ACS_PLACE_TYPES:
            return n
    return None


def build(raw, only=None):
    vintage = open(os.path.join(raw, 'acs', 'VINTAGE')).read().strip()
    rf = {k: load_redfin(os.path.join(raw, 'redfin', f'tn_{k}.csv')) for k in ('cities', 'counties', 'state')}
    zl = {k: load_zillow(os.path.join(raw, 'zillow', f)) for k, f in
          (('city', 'tn_city_zhvi.csv'), ('county', 'county_zhvi_all.csv'), ('state', 'state_zhvi_all.csv'))}
    acs = load_acs(raw)
    out = {}

    def county_parts(cname):
        return (redfin_figures(rf['counties'][f'{cname}, TN'], cname), zillow_figure(zl['county'].get(cname), cname),
                acs_figures(acs.get(f'{cname}, Tennessee'), cname, vintage))

    for slug, (place, county) in CITIES.items():
        if only and slug not in only:
            continue
        cname = f'{county} County'
        c_rf, c_zl, c_acs = county_parts(cname)
        stats, notes = {}, []
        row = rf['cities'].get(f'{place}, TN')
        sold = num(row['HOMES SOLD']) if row else None
        if row and sold and sold >= MIN_CITY_SALES and num(row['MEDIAN SALE PRICE NSA ($)']):
            stats.update(redfin_figures(row, place))
        else:
            notes.append(f'Redfin: {place} had {sold if row else "no"} sales in the window, so {cname} figures are used')
            stats.update(c_rf)
        z = zillow_figure(zl['city'].get(place), place)
        if not z:
            notes.append(f'Zillow: no {place} series, so {cname} is used')
        stats['typical_home_value'] = z or c_zl
        an = acs_place(acs, slug, place)
        if an:
            stats.update(acs_figures(acs.get(an), place, vintage))
        else:
            notes.append(f'Census: {place} is not a Census place, so {cname} is used')
            stats.update(c_acs)
        out[slug] = {'name': place, 'county': cname, 'stats': stats, 'notes': notes}

    for county in COUNTIES:
        slug, cname = f'{county.lower()}-county', f'{county} County'
        if only and slug not in only:
            continue
        c_rf, c_zl, c_acs = county_parts(cname)
        out[slug] = {'name': cname, 'county': cname, 'stats': {**c_rf, 'typical_home_value': c_zl, **c_acs}, 'notes': []}

    if not only or 'tennessee' in only:
        out['tennessee'] = {'name': 'Tennessee', 'county': '', 'notes': [], 'stats': {
            **redfin_figures(rf['state']['Tennessee'], 'Tennessee'),
            'typical_home_value': zillow_figure(zl['state'].get('Tennessee'), 'Tennessee'),
            **acs_figures(acs.get('Tennessee'), 'Tennessee', vintage)}}
    return out


# ── Display strings ──
def money(v): return f'${v:,.0f}'


def signed(v, unit, places=1):
    if v is None:
        return ''
    if round(v, places) == 0:
        return 'No change from a year earlier'
    sign = '+' if v > 0 else '-'
    return f"{sign}{abs(v):,.{places}f}{unit} vs a year earlier"


def cards(entry):
    """Display strings for the Market Stats cards, in page order."""
    s, county = entry['stats'], entry['county']

    def card(key, label, fmt, change, fig):
        if not fig or fig.get('value') is None:
            return None
        c = {'key': key, 'label': label, 'value': fmt(fig['value']), 'change': change, 'source': f"Source: {fig['source']}"}
        if fig['where'] != entry['name']:
            c['scope'] = f'{county} data'
        return c
    hs = s['homes_sold']
    out = [
        card('median_sale_price', 'Median Sale Price', money, signed(s['median_sale_price']['yoy_pct'], '%'), s['median_sale_price']),
        card('typical_home_value', 'Typical Home Value', money,
             signed((s['typical_home_value'] or {}).get('yoy_pct'), '%'), s['typical_home_value']),
        card('median_dom', 'Median Days on Market', lambda v: f'{v:.0f} days', signed(s['median_dom']['yoy_days'], ' days', 0), s['median_dom']),
        card('homes_sold', f"Homes Sold ({hs['period']})", lambda v: f'{v:,.0f}', signed(hs['yoy_pct'], '%'), hs),
        card('sale_to_list', 'Average Sale-to-List Price', lambda v: f'{v:.1f}%', signed(s['sale_to_list']['yoy_ppts'], ' pts'), s['sale_to_list']),
        card('population', 'Population', lambda v: f'{v:,.0f}', '', s['population']),
        card('median_income', 'Median Household Income', money, '', s['median_income']),
        card('median_year_built', 'Median Year Homes Were Built', lambda v: f'{v:.0f}', '', s['median_year_built']),
    ]
    return [c for c in out if c]


# ── Sanity checks ──
RANGES = {'median_sale_price': (50_000, 3_000_000), 'typical_home_value': (50_000, 3_000_000),
          'median_dom': (1, 365), 'homes_sold': (1, 200_000), 'sale_to_list': (80, 120),
          'population': (100, 10_000_000), 'median_income': (10_000, 400_000), 'median_year_built': (1900, 2025)}


def check(data, today, previous=None):
    """List of problems; empty means the build can go live."""
    problems = []
    expected = set(CITIES) | {f'{c.lower()}-county' for c in COUNTIES} | {'tennessee'}
    missing = expected - set(data)
    if missing:
        problems.append(f'pages with no data: {", ".join(sorted(missing))}')
    oldest = (today.replace(day=1) - datetime.timedelta(days=31 * MAX_AGE_MONTHS)).isoformat()
    for slug, e in data.items():
        for key, (lo, hi) in RANGES.items():
            fig = e['stats'].get(key)
            if not fig or fig.get('value') is None:
                problems.append(f'{slug}: no {key}')
                continue
            if not lo <= fig['value'] <= hi:
                problems.append(f'{slug}: {key} {fig["value"]:,.0f} is outside {lo:,}-{hi:,}')
            if fig.get('period_end') and fig['period_end'] < oldest:
                problems.append(f'{slug}: {key} period ends {fig["period_end"]}, older than {MAX_AGE_MONTHS} months')
    if previous:
        for slug, page in previous.get('pages', {}).items():
            old = {c['key']: c['value'] for c in page['cards']}
            if slug not in data:
                continue
            new = {c['key']: c['value'] for c in cards(data[slug])}
            for key in ('median_sale_price', 'typical_home_value'):
                if key in old and key in new:
                    a, b = (float(re.sub(r'[^\d.]', '', x)) for x in (old[key], new[key]))
                    if a and abs(b / a - 1) > 0.25:
                        problems.append(f'{slug}: {key} moved from {old[key]} to {new[key]} in one refresh (over 25%)')
    return problems


# ── Theme file ──
def php(v, ind=1):
    pad = '    ' * ind
    if isinstance(v, dict):
        return '[\n' + ''.join(f"{pad}{php(k)} => {php(x, ind + 1)},\n" for k, x in v.items()) + '    ' * (ind - 1) + ']'
    if isinstance(v, list):
        return '[\n' + ''.join(f"{pad}{php(x, ind + 1)},\n" for x in v) + '    ' * (ind - 1) + ']'
    return "'" + str(v).replace('\\', '\\\\').replace("'", "\\'") + "'"


def write_php(data, path, built):
    pages = {slug: {'name': e['name'], 'cards': cards(e)} for slug, e in data.items()}
    body = php({'updated': built, 'pages': pages})
    open(path, 'w').write("<?php\n/**\n * Market Stats figures, generated by market-stats/build_market_stats.py on "
                          + built + ".\n * Do not edit by hand: every figure carries its public source and period.\n */\nreturn "
                          + body + ";\n")


def read_php(path):
    """The figures currently in a theme data file, via PHP itself."""
    if not path or not os.path.exists(path):
        return None
    try:
        out = subprocess.run(['php', '-r', '$d = include $argv[1]; echo json_encode($d);', path],
                             capture_output=True, text=True, check=True).stdout
        d = json.loads(out)
        return d if isinstance(d, dict) and 'pages' in d else None
    except (subprocess.CalledProcessError, ValueError):
        return None


if __name__ == '__main__':
    ap = argparse.ArgumentParser()
    ap.add_argument('raw')
    ap.add_argument('--only', nargs='*')
    ap.add_argument('--json')
    ap.add_argument('--php', help='write the theme data file here (only if every check passes)')
    ap.add_argument('--previous', help='the live theme data file, to catch implausible jumps')
    a = ap.parse_args()
    data = build(a.raw, a.only)
    today = datetime.date.today()
    if a.json:
        open(a.json, 'w').write(json.dumps(data, indent=1))
    for slug, e in data.items():
        for n in e['notes']:
            print(f'note {slug}: {n}')
    if a.php:
        problems = [] if a.only else check(data, today, read_php(a.previous))
        if problems:
            print('CHECKS FAILED, nothing written:')
            for p in problems:
                print('  - ' + p)
            sys.exit(2)
        write_php(data, a.php, f'{MONTHS[today.month - 1]} {today.day}, {today.year}')
        print(f'wrote {a.php}: {len(data)} pages')
    if not (a.json or a.php):
        print(json.dumps(data, indent=1))
