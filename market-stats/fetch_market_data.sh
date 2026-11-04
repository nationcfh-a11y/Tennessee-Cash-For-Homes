#!/usr/bin/env bash
# Download the public data build_market_stats.py needs, keeping only Tennessee rows.
#
#   Redfin Data Center   city, county and state monthly housing market files
#                        (paths read from Redfin's own index.json, since the
#                        file names changed when the Data Center was rebuilt)
#   Zillow ZHVI          city, county and state typical home values
#   U.S. Census ACS      5-year tables B01003 (population), B19013 (median
#                        household income), B25035 (median year built), using
#                        the newest release that exists
#
# usage: fetch_market_data.sh RAW_DIR      (exits non-zero, with a reason, on any failure)
set -euo pipefail

RAW=${1:?usage: fetch_market_data.sh RAW_DIR}
mkdir -p "$RAW/redfin" "$RAW/zillow" "$RAW/acs"
fail() { echo "FETCH FAILED: $*" >&2; exit 1; }
get() { curl -sSfL --retry 3 --retry-delay 10 --max-time 1800 "$@"; }

# ── Redfin ──
RF=https://redfin-public-data.s3.us-west-2.amazonaws.com/redfin_data_center
get "$RF/index.json" -o "$RAW/redfin/index.json" || fail "Redfin index.json"
path() { python3 -I -c "import json,sys; d=json.load(open(sys.argv[1])); print(d['housing_market']['monthly'][sys.argv[2]]['all'])" "$RAW/redfin/index.json" "$1"; }
get "$RF/$(path city)"   | awk 'NR==1 || /, TN"/'        > "$RAW/redfin/tn_cities.csv"   || fail "Redfin city file"
get "$RF/$(path county)" | awk 'NR==1 || /County, TN"/'  > "$RAW/redfin/tn_counties.csv" || fail "Redfin county file"
get "$RF/$(path state)"  | awk 'NR==1 || /"Tennessee"/'  > "$RAW/redfin/tn_state.csv"    || fail "Redfin state file"

# ── Zillow ──
ZL=https://files.zillowstatic.com/research/public_csvs/zhvi
SERIES=zhvi_uc_sfrcondo_tier_0.33_0.67_sm_sa_month.csv
get "$ZL/City_$SERIES"   | awk -F, 'NR==1 || $6=="TN" || $6=="\"TN\""' > "$RAW/zillow/tn_city_zhvi.csv" || fail "Zillow city file"
get "$ZL/County_$SERIES" -o "$RAW/zillow/county_zhvi_all.csv" || fail "Zillow county file"
get "$ZL/State_$SERIES"  -o "$RAW/zillow/state_zhvi_all.csv"  || fail "Zillow state file"

# ── Census ACS: newest 5-year release that exists ──
ACS=https://www2.census.gov/programs-surveys/acs/summary_file
year=""
for y in $(seq "$(date +%Y)" -1 "$(( $(date +%Y) - 3 ))"); do
  if curl -sSfI --max-time 60 "$ACS/$y/table-based-SF/data/5YRData/acsdt5y$y-b01003.dat" >/dev/null 2>&1; then year=$y; break; fi
done
[ -n "$year" ] || fail "no ACS 5-year release found"
for t in b01003 b19013 b25035; do
  get "$ACS/$year/table-based-SF/data/5YRData/acsdt5y$year-$t.dat" -o "$RAW/acs/$t.dat" || fail "ACS table $t ($year)"
done
get "$ACS/$year/table-based-SF/documentation/Geos${year}5YR.txt" -o "$RAW/acs/geos.txt" || fail "ACS geography file ($year)"
echo "$(( year - 4 )) to $year" > "$RAW/acs/VINTAGE"

# ── Minimum sizes: a truncated or empty download fails here, not on the site ──
check() { [ "$(wc -l < "$1")" -ge "$2" ] || fail "$1 has $(wc -l < "$1") lines, expected at least $2"; }
check "$RAW/redfin/tn_cities.csv" 10000
check "$RAW/redfin/tn_counties.csv" 5000
check "$RAW/redfin/tn_state.csv" 50
check "$RAW/zillow/tn_city_zhvi.csv" 100
check "$RAW/zillow/county_zhvi_all.csv" 1000
check "$RAW/zillow/state_zhvi_all.csv" 40
echo "fetched: Redfin $(path city | xargs basename) etc., Zillow ZHVI, ACS 5-year $(cat "$RAW/acs/VINTAGE")"
