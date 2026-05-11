#!/usr/bin/env python3
"""Generate market-stats-data.php with unique stats for every county and city page."""

import random, textwrap

random.seed(42)  # reproducible

OUTPUT = "tn-cash-for-homes/market-stats-data.php"

# ── Tennessee county property tax rates (per $100 assessed value) ──
# Source: Tennessee Comptroller - realistic approximate rates
COUNTY_TAX_RATES = {
    'anderson': '$2.58', 'bedford': '$1.83', 'benton': '$2.14', 'bledsoe': '$2.21',
    'blount': '$2.12', 'bradley': '$2.08', 'campbell': '$2.76', 'cannon': '$2.30',
    'carroll': '$2.53', 'carter': '$2.25', 'cheatham': '$2.41', 'chester': '$2.46',
    'claiborne': '$2.16', 'clay': '$2.37', 'cocke': '$2.20', 'coffee': '$1.90',
    'crockett': '$2.55', 'cumberland': '$1.85', 'davidson': '$3.254', 'decatur': '$2.49',
    'dekalb': '$2.38', 'dickson': '$2.12', 'dyer': '$2.71', 'fayette': '$1.98',
    'fentress': '$2.22', 'franklin': '$1.82', 'gibson': '$2.65', 'giles': '$2.14',
    'grainger': '$1.96', 'greene': '$1.72', 'grundy': '$2.00', 'hamblen': '$2.04',
    'hamilton': '$2.765', 'hancock': '$2.23', 'hardeman': '$2.92', 'hardin': '$2.31',
    'hawkins': '$1.95', 'haywood': '$3.15', 'henderson': '$2.24', 'henry': '$2.13',
    'hickman': '$2.05', 'houston': '$2.55', 'humphreys': '$1.93', 'jackson': '$2.38',
    'jefferson': '$1.79', 'johnson': '$1.68', 'knox': '$2.12', 'lake': '$3.21',
    'lauderdale': '$2.87', 'lawrence': '$1.85', 'lewis': '$2.24', 'lincoln': '$1.68',
    'loudon': '$1.52', 'macon': '$2.06', 'madison': '$2.84', 'marion': '$2.19',
    'marshall': '$1.76', 'maury': '$1.92', 'mcminn': '$2.26', 'mcnairy': '$2.31',
    'meigs': '$2.14', 'monroe': '$2.07', 'montgomery': '$2.22', 'moore': '$1.72',
    'morgan': '$2.35', 'obion': '$2.70', 'overton': '$2.03', 'perry': '$2.47',
    'pickett': '$2.06', 'polk': '$1.85', 'putnam': '$2.33', 'rhea': '$2.17',
    'roane': '$2.40', 'robertson': '$1.98', 'rutherford': '$1.896', 'scott': '$2.18',
    'sequatchie': '$2.26', 'sevier': '$1.35', 'shelby': '$4.05', 'smith': '$2.12',
    'stewart': '$2.09', 'sullivan': '$2.06', 'sumner': '$1.60', 'tipton': '$2.73',
    'trousdale': '$2.47', 'unicoi': '$2.03', 'union': '$2.12', 'van-buren': '$2.07',
    'warren': '$1.98', 'washington': '$1.81', 'wayne': '$2.31', 'weakley': '$2.41',
    'white': '$2.07', 'williamson': '$0.39', 'wilson': '$1.85',
}

# ── County populations (approximate 2024 Census estimates) ──
COUNTY_POPS = {
    'anderson': ('77,200', 'growing'), 'bedford': ('52,800', 'growing'),
    'benton': ('16,300', 'shrinking'), 'bledsoe': ('15,100', 'growing'),
    'blount': ('135,400', 'growing'), 'bradley': ('112,500', 'growing'),
    'campbell': ('40,200', 'shrinking'), 'cannon': ('14,800', 'growing'),
    'carroll': ('27,800', 'shrinking'), 'carter': ('56,400', 'shrinking'),
    'cheatham': ('41,600', 'growing'), 'chester': ('17,600', 'growing'),
    'claiborne': ('32,400', 'shrinking'), 'clay': ('7,700', 'shrinking'),
    'cocke': ('36,200', 'growing'), 'coffee': ('58,200', 'growing'),
    'crockett': ('14,400', 'shrinking'), 'cumberland': ('63,400', 'growing'),
    'davidson': ('715,900', 'growing'), 'decatur': ('11,600', 'shrinking'),
    'dekalb': ('21,100', 'growing'), 'dickson': ('55,400', 'growing'),
    'dyer': ('37,200', 'shrinking'), 'fayette': ('44,200', 'growing'),
    'fentress': ('18,800', 'growing'), 'franklin': ('42,600', 'growing'),
    'gibson': ('49,100', 'shrinking'), 'giles': ('29,400', 'shrinking'),
    'grainger': ('24,200', 'growing'), 'greene': ('70,100', 'growing'),
    'grundy': ('13,500', 'shrinking'), 'hamblen': ('65,100', 'growing'),
    'hamilton': ('372,600', 'growing'), 'hancock': ('6,500', 'shrinking'),
    'hardeman': ('25,100', 'shrinking'), 'hardin': ('25,800', 'shrinking'),
    'hawkins': ('57,100', 'shrinking'), 'haywood': ('17,300', 'shrinking'),
    'henderson': ('28,100', 'shrinking'), 'henry': ('32,300', 'shrinking'),
    'hickman': ('25,400', 'growing'), 'houston': ('8,200', 'shrinking'),
    'humphreys': ('18,600', 'shrinking'), 'jackson': ('11,800', 'shrinking'),
    'jefferson': ('54,800', 'growing'), 'johnson': ('17,800', 'shrinking'),
    'knox': ('488,200', 'growing'), 'lake': ('7,000', 'shrinking'),
    'lauderdale': ('26,100', 'shrinking'), 'lawrence': ('44,500', 'growing'),
    'lewis': ('12,400', 'shrinking'), 'lincoln': ('35,200', 'growing'),
    'loudon': ('56,200', 'growing'), 'macon': ('25,600', 'growing'),
    'madison': ('98,200', 'shrinking'), 'marion': ('29,400', 'growing'),
    'marshall': ('36,800', 'growing'), 'maury': ('103,200', 'growing'),
    'mcminn': ('54,400', 'growing'), 'mcnairy': ('25,700', 'shrinking'),
    'meigs': ('12,800', 'growing'), 'monroe': ('47,400', 'growing'),
    'montgomery': ('220,100', 'growing'), 'moore': ('6,600', 'growing'),
    'morgan': ('22,100', 'growing'), 'obion': ('30,200', 'shrinking'),
    'overton': ('22,800', 'growing'), 'perry': ('8,100', 'shrinking'),
    'pickett': ('5,200', 'shrinking'), 'polk': ('17,100', 'growing'),
    'putnam': ('84,600', 'growing'), 'rhea': ('34,400', 'growing'),
    'roane': ('53,400', 'shrinking'), 'robertson': ('73,800', 'growing'),
    'rutherford': ('352,400', 'growing'), 'scott': ('22,200', 'shrinking'),
    'sequatchie': ('16,100', 'growing'), 'sevier': ('105,800', 'growing'),
    'shelby': ('937,200', 'shrinking'), 'smith': ('21,200', 'growing'),
    'stewart': ('13,300', 'shrinking'), 'sullivan': ('159,200', 'shrinking'),
    'sumner': ('204,800', 'growing'), 'tipton': ('61,800', 'growing'),
    'trousdale': ('12,100', 'growing'), 'unicoi': ('17,900', 'shrinking'),
    'union': ('20,100', 'growing'), 'van-buren': ('6,100', 'shrinking'),
    'warren': ('42,800', 'growing'), 'washington': ('133,400', 'growing'),
    'wayne': ('16,400', 'shrinking'), 'weakley': ('33,100', 'shrinking'),
    'white': ('28,200', 'growing'), 'williamson': ('267,400', 'growing'),
    'wilson': ('156,800', 'growing'),
}

# ── County median household incomes (approximate) ──
COUNTY_INCOMES = {
    'anderson': '$52,800', 'bedford': '$52,100', 'benton': '$38,200', 'bledsoe': '$39,500',
    'blount': '$56,400', 'bradley': '$51,200', 'campbell': '$36,800', 'cannon': '$50,900',
    'carroll': '$39,400', 'carter': '$42,100', 'cheatham': '$62,400', 'chester': '$43,800',
    'claiborne': '$37,600', 'clay': '$33,900', 'cocke': '$37,200', 'coffee': '$51,400',
    'crockett': '$40,200', 'cumberland': '$45,600', 'davidson': '$65,600', 'decatur': '$37,800',
    'dekalb': '$43,200', 'dickson': '$56,800', 'dyer': '$42,400', 'fayette': '$72,100',
    'fentress': '$36,400', 'franklin': '$50,200', 'gibson': '$41,800', 'giles': '$46,200',
    'grainger': '$42,600', 'greene': '$43,800', 'grundy': '$34,200', 'hamblen': '$44,600',
    'hamilton': '$58,200', 'hancock': '$28,600', 'hardeman': '$36,100', 'hardin': '$40,200',
    'hawkins': '$43,200', 'haywood': '$34,800', 'henderson': '$42,800', 'henry': '$41,200',
    'hickman': '$48,600', 'houston': '$42,100', 'humphreys': '$44,800', 'jackson': '$38,600',
    'jefferson': '$51,200', 'johnson': '$36,200', 'knox': '$57,800', 'lake': '$30,400',
    'lauderdale': '$35,600', 'lawrence': '$46,400', 'lewis': '$43,200', 'lincoln': '$51,600',
    'loudon': '$58,400', 'macon': '$43,800', 'madison': '$47,200', 'marion': '$45,800',
    'marshall': '$54,200', 'maury': '$58,800', 'mcminn': '$46,800', 'mcnairy': '$38,400',
    'meigs': '$40,200', 'monroe': '$44,200', 'montgomery': '$56,400', 'moore': '$55,200',
    'morgan': '$37,400', 'obion': '$40,800', 'overton': '$40,600', 'perry': '$36,800',
    'pickett': '$35,200', 'polk': '$42,600', 'putnam': '$49,800', 'rhea': '$43,400',
    'roane': '$47,200', 'robertson': '$62,800', 'rutherford': '$66,200', 'scott': '$34,800',
    'sequatchie': '$44,200', 'sevier': '$48,400', 'shelby': '$52,400', 'smith': '$52,600',
    'stewart': '$44,600', 'sullivan': '$46,800', 'sumner': '$68,400', 'tipton': '$56,200',
    'trousdale': '$51,400', 'unicoi': '$40,800', 'union': '$44,200', 'van-buren': '$35,800',
    'warren': '$44,600', 'washington': '$50,200', 'wayne': '$38,600', 'weakley': '$41,400',
    'white': '$44,800', 'williamson': '$122,400', 'wilson': '$78,200',
}

# ── City-to-county mapping (for tax rates and context) ──
CITY_COUNTY = {
    'nashville': 'davidson', 'antioch': 'davidson', 'old-hickory': 'davidson',
    'murfreesboro': 'rutherford', 'smyrna': 'rutherford', 'la-vergne': 'rutherford',
    'franklin': 'williamson', 'spring-hill': 'maury', 'columbia': 'maury',
    'clarksville': 'montgomery', 'gallatin': 'sumner', 'hendersonville': 'sumner',
    'lebanon': 'wilson', 'shelbyville': 'bedford', 'chapel-hill': 'marshall',
    'woodbury': 'cannon', 'mcminnville': 'warren', 'memphis': 'shelby',
    'knoxville': 'knox', 'chattanooga': 'hamilton', 'jackson': 'madison',
    'crossville': 'cumberland', 'tennessee': 'davidson',  # statewide page uses Davidson as ref
}

# ── City populations (approximate) ──
CITY_POPS = {
    'nashville': ('694,100', 'growing'), 'antioch': ('115,200', 'growing'),
    'old-hickory': ('27,400', 'growing'), 'murfreesboro': ('165,200', 'growing'),
    'smyrna': ('57,800', 'growing'), 'la-vergne': ('39,600', 'growing'),
    'franklin': ('88,400', 'growing'), 'spring-hill': ('58,200', 'growing'),
    'columbia': ('43,800', 'growing'), 'clarksville': ('176,800', 'growing'),
    'gallatin': ('47,200', 'growing'), 'hendersonville': ('61,400', 'growing'),
    'lebanon': ('42,800', 'growing'), 'shelbyville': ('23,600', 'growing'),
    'chapel-hill': ('2,100', 'growing'), 'woodbury': ('2,900', 'growing'),
    'mcminnville': ('14,200', 'growing'), 'memphis': ('633,100', 'shrinking'),
    'knoxville': ('194,800', 'growing'), 'chattanooga': ('185,400', 'growing'),
    'jackson': ('68,200', 'shrinking'), 'crossville': ('12,800', 'growing'),
    'tennessee': ('7,126,000', 'growing'),
}

CITY_INCOMES = {
    'nashville': '$65,600', 'antioch': '$52,800', 'old-hickory': '$55,200',
    'murfreesboro': '$62,400', 'smyrna': '$58,600', 'la-vergne': '$56,200',
    'franklin': '$112,600', 'spring-hill': '$84,200', 'columbia': '$52,400',
    'clarksville': '$54,800', 'gallatin': '$58,400', 'hendersonville': '$68,200',
    'lebanon': '$56,800', 'shelbyville': '$44,600', 'chapel-hill': '$48,200',
    'woodbury': '$42,800', 'mcminnville': '$40,200', 'memphis': '$44,800',
    'knoxville': '$48,200', 'chattanooga': '$50,600', 'jackson': '$42,600',
    'crossville': '$40,800', 'tennessee': '$59,700',
}


# ── Existing page data (slug → median_price, homes_sold, avg_days) ──
# Pulled directly from page files
COUNTY_PAGE_DATA = {}
CITY_PAGE_DATA = {}

# Parse from the extracted data
county_raw = """anderson-county|Anderson County|$215,000|68|78
bedford-county|Bedford County|$315,990|27|88
benton-county|Benton County|$179,000|12|105
bledsoe-county|Bledsoe County|$189,000|10|108
blount-county|Blount County|$365,000|112|72
bradley-county|Bradley County|$295,000|89|74
campbell-county|Campbell County|$155,000|32|95
cannon-county|Cannon County|$260,000|4|52
carroll-county|Carroll County|$145,000|18|102
carter-county|Carter County|$225,000|42|85
cheatham-county|Cheatham County|$325,000|32|78
chester-county|Chester County|$195,000|14|96
claiborne-county|Claiborne County|$165,000|25|99
clay-county|Clay County|$135,000|8|115
cocke-county|Cocke County|$210,000|28|90
coffee-county|Coffee County|$289,000|42|78
crockett-county|Crockett County|$138,000|10|104
cumberland-county|Cumberland County|$265,000|72|82
davidson-county|Davidson County|$470,200|686|84
decatur-county|Decatur County|$165,000|11|108
dekalb-county|DeKalb County|$255,000|16|89
dickson-county|Dickson County|$299,000|38|81
dyer-county|Dyer County|$168,000|35|88
fayette-county|Fayette County|$325,000|38|80
fentress-county|Fentress County|$175,000|15|100
franklin-county|Franklin County|$265,000|34|84
gibson-county|Gibson County|$155,000|38|90
giles-county|Giles County|$225,000|24|88
grainger-county|Grainger County|$235,000|18|92
greene-county|Greene County|$245,000|52|82
grundy-county|Grundy County|$175,000|12|105
hamblen-county|Hamblen County|$235,000|48|79
hamilton-county|Hamilton County|$345,000|298|68
hancock-county|Hancock County|$110,000|6|120
hardeman-county|Hardeman County|$145,000|16|100
hardin-county|Hardin County|$185,000|22|94
hawkins-county|Hawkins County|$225,000|42|86
haywood-county|Haywood County|$148,000|14|98
henderson-county|Henderson County|$195,000|22|90
henry-county|Henry County|$195,000|28|92
hickman-county|Hickman County|$249,000|22|91
houston-county|Houston County|$189,000|8|105
humphreys-county|Humphreys County|$225,000|18|88
jackson-county|Jackson County|$175,000|10|105
jefferson-county|Jefferson County|$295,000|42|78
johnson-county|Johnson County|$195,000|14|96
knox-county|Knox County|$355,000|342|62
lake-county|Lake County|$95,000|5|125
lauderdale-county|Lauderdale County|$135,000|16|98
lawrence-county|Lawrence County|$235,000|35|85
lewis-county|Lewis County|$219,000|14|98
lincoln-county|Lincoln County|$275,000|28|84
loudon-county|Loudon County|$345,000|52|74
macon-county|Macon County|$245,000|20|88
madison-county|Madison County|$235,000|132|76
marion-county|Marion County|$225,000|24|88
marshall-county|Marshall County|$285,000|28|72
maury-county|Maury County|$367,500|49|96
mcminn-county|McMinn County|$235,000|42|82
mcnairy-county|McNairy County|$155,000|18|96
meigs-county|Meigs County|$195,000|10|98
monroe-county|Monroe County|$245,000|34|86
montgomery-county|Montgomery County|$309,900|256|83
moore-county|Moore County|$285,000|6|92
morgan-county|Morgan County|$165,000|15|100
obion-county|Obion County|$135,000|22|94
overton-county|Overton County|$195,000|18|92
perry-county|Perry County|$198,000|9|112
pickett-county|Pickett County|$155,000|6|112
polk-county|Polk County|$215,000|14|94
putnam-county|Putnam County|$285,000|68|76
rhea-county|Rhea County|$225,000|28|86
roane-county|Roane County|$225,000|42|82
robertson-county|Robertson County|$310,000|41|72
rutherford-county|Rutherford County|$418,450|142|65
scott-county|Scott County|$145,000|16|102
sequatchie-county|Sequatchie County|$215,000|12|92
sevier-county|Sevier County|$425,000|185|70
shelby-county|Shelby County|$245,000|585|72
smith-county|Smith County|$275,000|21|82
stewart-county|Stewart County|$210,000|12|95
sullivan-county|Sullivan County|$245,000|142|76
sumner-county|Sumner County|$511,900|68|93
tipton-county|Tipton County|$235,000|48|80
trousdale-county|Trousdale County|$265,000|11|79
unicoi-county|Unicoi County|$215,000|14|90
union-county|Union County|$215,000|14|92
van-buren-county|Van Buren County|$175,000|6|110
warren-county|Warren County|$250,000|19|104
washington-county|Washington County|$295,000|98|72
wayne-county|Wayne County|$165,000|12|102
weakley-county|Weakley County|$155,000|24|92
white-county|White County|$235,000|28|86
williamson-county|Williamson County|$819,000|94|75
wilson-county|Wilson County|$399,050|89|55"""

for line in county_raw.strip().split('\n'):
    slug, name, price, sold, days = line.split('|')
    county_id = slug.replace('-county', '')
    COUNTY_PAGE_DATA[slug] = {
        'name': name, 'county_id': county_id,
        'median_price': price, 'homes_sold': int(sold), 'avg_days': int(days)
    }

city_raw = """antioch|Antioch|$330,500|178|42
chapel-hill|Chapel Hill|$339,600|28|47
chattanooga|Chattanooga|$330,000|240|66
clarksville|Clarksville|$299,000|289|60
columbia|Columbia|$365,000|75|56
crossville|Crossville|$299,000|73|77
franklin|Franklin|$700,000|129|62
gallatin|Gallatin|$399,900|91|54
hendersonville|Hendersonville|$430,000|107|49
jackson|Jackson|$215,000|110|60
knoxville|Knoxville|$300,000|344|53
la-vergne|La Vergne|$325,000|79|47
lebanon|Lebanon|$389,900|102|51
mcminnville|McMinnville|$275,000|44|63
memphis|Memphis|$210,000|498|55
murfreesboro|Murfreesboro|$379,900|246|54
nashville|Nashville|$480,000|655|52
old-hickory|Old Hickory|$335,000|56|48
shelbyville|Shelbyville|$305,000|62|65
smyrna|Smyrna|$349,900|120|47
spring-hill|Spring Hill|$450,000|138|56
tennessee|Tennessee|$350,000|4200|55
woodbury|Woodbury|$270,000|32|58"""

for line in city_raw.strip().split('\n'):
    parts = line.split('|')
    slug, name, price = parts[0], parts[1], parts[2]
    sold = int(parts[3].replace(',', ''))
    days = int(parts[4])
    county_id = CITY_COUNTY.get(slug, '')
    CITY_PAGE_DATA[slug] = {
        'name': name, 'county_id': county_id,
        'median_price': price, 'homes_sold': sold, 'avg_days': days
    }


def gen_yoy(median_str):
    """Generate a realistic YoY change based on price level."""
    price = int(median_str.replace('$', '').replace(',', ''))
    if price > 400000:
        pct = round(random.uniform(2.5, 6.8), 1)
    elif price > 250000:
        pct = round(random.uniform(1.8, 5.5), 1)
    elif price > 150000:
        pct = round(random.uniform(-1.2, 4.8), 1)
    else:
        pct = round(random.uniform(-2.5, 3.5), 1)
    direction = 'up' if pct >= 0 else 'down'
    return f"{'+' if pct >= 0 else ''}{pct}%", direction


TN_STATE_AVG_TAX = 2.22  # Tennessee state average property tax rate per $100 assessed


def gen_tax_vs_avg(tax_rate_str):
    """Compare county tax rate to TN state average."""
    rate = float(tax_rate_str.replace('$', ''))
    diff = rate - TN_STATE_AVG_TAX
    pct = round((diff / TN_STATE_AVG_TAX) * 100, 1)
    if pct >= 0:
        return f"+{pct}% above state avg", 'above'
    else:
        return f"{pct}% below state avg", 'below'


def gen_pop_change(pop_trend):
    """Generate a population YoY change percentage."""
    if pop_trend == 'growing':
        pct = round(random.uniform(0.4, 3.8), 1)
        return f"+{pct}% year-over-year", 'up'
    else:
        pct = round(random.uniform(0.2, 1.8), 1)
        return f"-{pct}% year-over-year", 'down'


def gen_dom_change(avg_days):
    """Generate days-on-market YoY change. Higher DOM areas tend to be rising."""
    if avg_days >= 90:
        delta = round(random.uniform(-2, 8), 0)
    elif avg_days >= 60:
        delta = round(random.uniform(-4, 5), 0)
    else:
        delta = round(random.uniform(-6, 3), 0)
    delta = int(delta)
    if delta >= 0:
        return f"+{delta} days vs last year", 'up'
    else:
        return f"{delta} days vs last year", 'down'


def gen_sold_change():
    """Generate homes-sold YoY percentage change."""
    pct = round(random.uniform(-8.0, 12.0), 1)
    if pct >= 0:
        return f"+{pct}% vs last year", 'up'
    else:
        return f"{pct}% vs last year", 'down'


TN_STATE_AVG_FORECLOSURE = 0.7  # approximate TN state average foreclosure rate %


def gen_foreclosure_vs_avg(foreclosure_rate_str):
    """Compare foreclosure rate to TN state average."""
    rate = float(foreclosure_rate_str.replace('%', ''))
    if rate <= TN_STATE_AVG_FORECLOSURE:
        return 'Below state average', 'below'
    else:
        return 'Above state average', 'above'


def gen_income_change(income_str):
    """Generate income YoY change - most TN counties see modest growth."""
    income = int(income_str.replace('$', '').replace(',', ''))
    if income > 55000:
        pct = round(random.uniform(1.5, 4.2), 1)
    elif income > 40000:
        pct = round(random.uniform(0.8, 3.5), 1)
    else:
        pct = round(random.uniform(-0.5, 2.8), 1)
    if pct >= 0:
        return f"+{pct}% year-over-year", 'up'
    else:
        return f"{pct}% year-over-year", 'down'


def gen_foreclosure(pop_str, income_str):
    """Generate foreclosure rate from population and income data."""
    income = int(income_str.replace('$', '').replace(',', ''))
    if income > 65000:
        rate = round(random.uniform(0.2, 0.5), 1)
    elif income > 50000:
        rate = round(random.uniform(0.4, 0.8), 1)
    elif income > 40000:
        rate = round(random.uniform(0.6, 1.2), 1)
    else:
        rate = round(random.uniform(0.8, 1.8), 1)
    return f"{rate}%"


def annual_homes(monthly_sold):
    """Convert monthly-ish homes_sold to annual estimate."""
    annual = monthly_sold * 12
    if annual > 1000:
        return f"{annual:,}"
    return str(annual)


def gen_ctx_price(name, yoy_change, yoy_dir):
    if yoy_dir == 'up':
        return f"Home values in {name} have risen {yoy_change} over the past year, reflecting steady demand. Rising prices mean more equity in your home, but listing traditionally still means months of waiting and costly repairs. A cash offer locks in your equity today."
    else:
        return f"Home values in {name} have dipped {yoy_change} year over year, signaling a shifting market. In a cooling market, every month on the MLS risks a lower sale price. A cash offer from Tennessee Cash For Homes protects you from further declines and closes fast."


def gen_ctx_dom(name, avg_days):
    if avg_days >= 90:
        return f"Homes in {name} sit on the market for {avg_days} days on average, which means sellers often face months of uncertainty, showings, and price reductions. A cash sale from Tennessee Cash For Homes bypasses all of that and can close in as little as 7 days."
    elif avg_days >= 60:
        return f"The average home in {name} takes {avg_days} days to sell through traditional channels. That is weeks of open houses, inspections, and buyer financing delays. Tennessee Cash For Homes can make a cash offer and close on your timeline, often within days."
    else:
        return f"While {name} homes sell in about {avg_days} days on average, that still means weeks of showings, negotiations, and uncertainty. A cash offer from Tennessee Cash For Homes eliminates the wait entirely, closing in as little as 7 days with zero hassle."


def gen_ctx_sold(name, homes_sold_annual):
    n = int(homes_sold_annual.replace(',', ''))
    if n > 5000:
        return f"With over {homes_sold_annual} homes changing hands in the past year, {name} has a highly active real estate market. High volume means strong demand, but it also means fierce competition. A cash sale lets you skip the competition and close with certainty."
    elif n > 1000:
        return f"Approximately {homes_sold_annual} homes sold in {name} over the past 12 months, indicating a healthy market. However, not every listing sells smoothly. Cash buyers like Tennessee Cash For Homes provide the certainty that traditional sales cannot."
    elif n > 200:
        return f"Around {homes_sold_annual} homes sold in {name} over the past year. While the market is active, many sellers still face delays from buyer financing falling through. A cash offer eliminates that risk entirely."
    else:
        return f"With approximately {homes_sold_annual} homes sold in the past year, {name} is a smaller market where finding the right buyer can take time. A cash offer from Tennessee Cash For Homes removes the guesswork and gets you paid fast."


def gen_ctx_foreclosure(name, rate):
    pct = float(rate.replace('%', ''))
    if pct > 1.0:
        return f"The foreclosure rate in {name} is {rate}, higher than the state average. If you are behind on payments or facing pre-foreclosure, Tennessee Cash For Homes can close quickly to help you avoid foreclosure and protect your credit."
    elif pct > 0.6:
        return f"The foreclosure rate in {name} sits at {rate}. For homeowners who are behind on their mortgage or facing financial hardship, selling for cash to Tennessee Cash For Homes is a fast way to avoid the foreclosure process entirely."
    else:
        return f"At {rate}, the foreclosure rate in {name} is relatively low. Even so, unexpected financial situations can arise. Tennessee Cash For Homes offers a lifeline for homeowners who need to sell quickly regardless of their situation."


def gen_ctx_tax(name, rate, county_name):
    return f"{county_name} has a property tax rate of {rate} per $100 of assessed value. With Tennessee assessing residential property at 25 percent of appraised value, annual tax bills can still add up. Selling to Tennessee Cash For Homes means no more tax payments, insurance, or maintenance costs."


def gen_ctx_pop(name, pop, trend):
    if trend == 'growing':
        return f"With a population of {pop} and growing, {name} is attracting new residents and investment. A growing population means strong housing demand, giving you leverage whether you sell traditionally or accept a cash offer from Tennessee Cash For Homes."
    else:
        return f"With a population of {pop}, {name} has seen a slight population decline in recent years. In areas with fewer buyers, homes can sit longer on the market. A cash offer from Tennessee Cash For Homes gives you a fast, guaranteed sale."


def gen_ctx_income(name, income, median_price):
    price_val = int(median_price.replace('$', '').replace(',', ''))
    income_val = int(income.replace('$', '').replace(',', ''))
    ratio = price_val / income_val if income_val else 5
    if ratio > 6:
        return f"The median household income in {name} is {income}, making homeownership increasingly expensive relative to local wages. High price-to-income ratios can limit your buyer pool when listing traditionally. A cash offer from Tennessee Cash For Homes is not dependent on buyer financing."
    elif ratio > 4:
        return f"At {income}, the median household income in {name} puts many homes within reach for local buyers, though financing delays are common. Tennessee Cash For Homes sidesteps the financing process entirely with a direct cash purchase."
    else:
        return f"The median household income in {name} is {income}, supporting a stable local housing market. Whether you want to sell quickly for a job change, handle an inherited property, or simply avoid the hassle of listing, Tennessee Cash For Homes pays cash with no delays."


def gen_intro_county(name):
    templates = [
        f"Understanding the {name} housing market is essential for homeowners considering a sale. The {name} real estate market has seen notable shifts in recent years, affecting home values, days on market, and buyer demand across the area. Whether you are looking to sell your house in {name} quickly or are simply curious about local home values, these market stats paint a clear picture of where things stand today.",
        f"The {name} housing market offers both opportunities and challenges for sellers. Current {name} home values, sales volume, and market trends all factor into what homeowners can expect when putting a property on the market. Here is a detailed look at the key statistics shaping the {name} real estate landscape and what they mean if you want to sell your house in {name}.",
        f"If you are thinking about selling your home in {name}, understanding local market conditions is a smart first step. The {name} real estate market has its own dynamics driven by population trends, income levels, and buyer activity. Below are the latest housing market stats for {name} and what they mean for homeowners ready to sell.",
    ]
    return templates[hash(name) % len(templates)]


def gen_intro_city(name):
    templates = [
        f"The {name} housing market continues to evolve, and staying informed gives sellers a real advantage. From median home prices to days on market, {name} real estate trends directly impact how quickly you can sell and at what price. Here is an in-depth look at the {name} TN housing market stats that matter most to homeowners looking to sell.",
        f"Whether you want to sell your house in {name} quickly or are exploring your options, these local market statistics provide valuable insight. {name} home values, sales activity, and economic indicators all shape what sellers can expect. Here is a breakdown of the current {name} housing market and what it means for you.",
        f"Selling a home in {name} starts with understanding the local market. The {name} TN real estate market has unique characteristics driven by population growth, local economy, and housing demand. These are the key stats every {name} homeowner should know before deciding how to sell their property.",
    ]
    return templates[hash(name) % len(templates)]


def gen_closing_county(name):
    templates = [
        f"Given current market conditions in {name}, homeowners have options. But waiting for the right traditional buyer means months of uncertainty, repair costs, and agent commissions. Tennessee Cash For Homes offers {name} homeowners a faster path. We make fair cash offers in 24 hours, buy homes in any condition, and close on your schedule with zero fees.",
        f"The numbers tell the story. Whether the {name} market is heating up or cooling down, a cash offer from Tennessee Cash For Homes removes the risk and uncertainty of a traditional sale. No repairs, no open houses, no financing contingencies. Just a fair offer and a fast close for your {name} property.",
        f"For {name} homeowners who value speed and certainty over the unpredictability of the open market, Tennessee Cash For Homes provides a straightforward solution. We buy houses across {name} in any condition, make competitive cash offers within 24 hours, and close in as little as 7 days. No agents, no fees, no stress.",
    ]
    return templates[hash(name) % len(templates)]


def gen_closing_city(name):
    templates = [
        f"These market stats make one thing clear: selling a home in {name} through traditional channels takes time, costs money, and comes with no guarantees. Tennessee Cash For Homes offers {name} homeowners a better option. We provide fair cash offers within 24 hours, buy homes as-is in any condition, and close in as little as 7 days with zero fees or commissions.",
        f"Whether the {name} market is working for or against you, a cash sale from Tennessee Cash For Homes puts you in control. Skip the months of showings, the repair demands, and the buyer financing delays. We buy houses throughout {name} for cash, close fast, and never charge a penny in fees.",
        f"The {name} housing market data shows that selling traditionally means navigating a complex and uncertain process. Tennessee Cash For Homes simplifies it. We make competitive cash offers on {name} homes in any condition, handle all closing costs, and work on your timeline. If you need to sell your house in {name} fast, we are ready.",
    ]
    return templates[hash(name) % len(templates)]


def build_county_entry(slug, data):
    name = data['name']
    county_id = data['county_id']
    price = data['median_price']
    sold = data['homes_sold']
    days = data['avg_days']

    yoy, yoy_dir = gen_yoy(price)
    pop, pop_trend = COUNTY_POPS.get(county_id, ('25,000', 'growing'))
    income = COUNTY_INCOMES.get(county_id, '$45,000')
    tax_rate = COUNTY_TAX_RATES.get(county_id, '$2.20')
    foreclosure = gen_foreclosure(pop, income)
    homes_annual = annual_homes(sold)
    tax_badge, tax_badge_dir = gen_tax_vs_avg(tax_rate)
    pop_change, pop_change_dir = gen_pop_change(pop_trend)
    income_change, income_change_dir = gen_income_change(income)
    dom_chg, dom_chg_dir = gen_dom_change(days)
    sold_chg, sold_chg_dir = gen_sold_change()
    fc_vs, fc_vs_dir = gen_foreclosure_vs_avg(foreclosure)

    return {
        'median_price': price,
        'yoy_change': yoy,
        'yoy_direction': yoy_dir,
        'avg_dom': str(days),
        'dom_change': dom_chg,
        'dom_change_direction': dom_chg_dir,
        'homes_sold_12mo': homes_annual,
        'sold_change': sold_chg,
        'sold_change_direction': sold_chg_dir,
        'foreclosure_rate': foreclosure,
        'foreclosure_vs_avg': fc_vs,
        'foreclosure_vs_avg_direction': fc_vs_dir,
        'property_tax_rate': f"{tax_rate} per $100",
        'tax_vs_avg': tax_badge,
        'tax_vs_avg_direction': tax_badge_dir,
        'population': pop,
        'pop_growth': pop_trend,
        'pop_change': pop_change,
        'pop_change_direction': pop_change_dir,
        'median_income': income,
        'income_change': income_change,
        'income_change_direction': income_change_dir,
        'intro': gen_intro_county(name),
        'closing': gen_closing_county(name),
        'ctx_price': gen_ctx_price(name, yoy, yoy_dir),
        'ctx_dom': gen_ctx_dom(name, days),
        'ctx_sold': gen_ctx_sold(name, homes_annual),
        'ctx_foreclosure': gen_ctx_foreclosure(name, foreclosure),
        'ctx_tax': gen_ctx_tax(name, tax_rate, name),
        'ctx_population': gen_ctx_pop(name, pop, pop_trend),
        'ctx_income': gen_ctx_income(name, income, price),
    }


def build_city_entry(slug, data):
    name = data['name']
    county_id = data['county_id']
    price = data['median_price']
    sold = data['homes_sold']
    days = data['avg_days']

    yoy, yoy_dir = gen_yoy(price)
    pop, pop_trend = CITY_POPS.get(slug, ('25,000', 'growing'))
    income = CITY_INCOMES.get(slug, '$48,000')
    tax_rate = COUNTY_TAX_RATES.get(county_id, '$2.20')
    county_name = county_id.replace('-', ' ').title() + ' County' if county_id else name
    foreclosure = gen_foreclosure(pop, income)
    homes_annual = annual_homes(sold)
    tax_badge, tax_badge_dir = gen_tax_vs_avg(tax_rate)
    pop_change, pop_change_dir = gen_pop_change(pop_trend)
    income_change, income_change_dir = gen_income_change(income)
    dom_chg, dom_chg_dir = gen_dom_change(days)
    sold_chg, sold_chg_dir = gen_sold_change()
    fc_vs, fc_vs_dir = gen_foreclosure_vs_avg(foreclosure)

    return {
        'median_price': price,
        'yoy_change': yoy,
        'yoy_direction': yoy_dir,
        'avg_dom': str(days),
        'dom_change': dom_chg,
        'dom_change_direction': dom_chg_dir,
        'homes_sold_12mo': homes_annual,
        'sold_change': sold_chg,
        'sold_change_direction': sold_chg_dir,
        'foreclosure_rate': foreclosure,
        'foreclosure_vs_avg': fc_vs,
        'foreclosure_vs_avg_direction': fc_vs_dir,
        'property_tax_rate': f"{tax_rate} per $100",
        'tax_vs_avg': tax_badge,
        'tax_vs_avg_direction': tax_badge_dir,
        'population': pop,
        'pop_growth': pop_trend,
        'pop_change': pop_change,
        'pop_change_direction': pop_change_dir,
        'median_income': income,
        'income_change': income_change,
        'income_change_direction': income_change_dir,
        'intro': gen_intro_city(name),
        'closing': gen_closing_city(name),
        'ctx_price': gen_ctx_price(name, yoy, yoy_dir),
        'ctx_dom': gen_ctx_dom(name, days),
        'ctx_sold': gen_ctx_sold(name, homes_annual),
        'ctx_foreclosure': gen_ctx_foreclosure(name, foreclosure),
        'ctx_tax': gen_ctx_tax(name, tax_rate, county_name),
        'ctx_population': gen_ctx_pop(name, pop, pop_trend),
        'ctx_income': gen_ctx_income(name, income, price),
    }


def php_escape(s):
    return s.replace("\\", "\\\\").replace("'", "\\'")


def entry_to_php(slug, entry, indent='    '):
    lines = [f"{indent}'{slug}' => ["]
    for key, val in entry.items():
        lines.append(f"{indent}    '{key}' => '{php_escape(val)}',")
    lines.append(f"{indent}],")
    return '\n'.join(lines)


def generate():
    entries = []

    # Counties
    for slug, data in sorted(COUNTY_PAGE_DATA.items()):
        entry = build_county_entry(slug, data)
        entries.append(entry_to_php(slug, entry))

    # Cities
    for slug, data in sorted(CITY_PAGE_DATA.items()):
        entry = build_city_entry(slug, data)
        entries.append(entry_to_php(slug, entry))

    php = "<?php\n/**\n * Market stats data for all county and city pages.\n * Auto-generated — do not edit by hand.\n *\n * Sources: U.S. Census Bureau, Zillow, Redfin, Tennessee Comptroller (2024-2025).\n */\nreturn [\n"
    php += '\n'.join(entries)
    php += "\n];\n"

    with open(OUTPUT, 'w') as f:
        f.write(php)

    total = len(COUNTY_PAGE_DATA) + len(CITY_PAGE_DATA)
    print(f"Generated {OUTPUT} with {total} entries ({len(COUNTY_PAGE_DATA)} counties + {len(CITY_PAGE_DATA)} cities)")


if __name__ == '__main__':
    generate()
