"""
Fetches Google Search Console query data for tennesseecashforhomes.com
and saves it as JSON for the dashboard to consume.

First run: opens a browser for OAuth consent, then saves token.json.
Subsequent runs: uses the saved token (auto-refreshes as needed).
"""

import json
import os
import sys
from datetime import date, timedelta
from pathlib import Path

from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from google_auth_oauthlib.flow import InstalledAppFlow
from googleapiclient.discovery import build

SCOPES = ["https://www.googleapis.com/auth/webmasters.readonly"]
SITE_URL = "sc-domain:tennesseecashforhomes.com"
SITE_URL_FALLBACK = "https://tennesseecashforhomes.com/"

HERE = Path(__file__).parent
CLIENT_SECRET = HERE / "client_secret.json"
TOKEN_FILE = HERE / "token.json"
DATA_DIR = HERE / "data"
DATA_DIR.mkdir(exist_ok=True)


def authenticate():
    creds = None
    if TOKEN_FILE.exists():
        creds = Credentials.from_authorized_user_file(str(TOKEN_FILE), SCOPES)
    if not creds or not creds.valid:
        # A saved token can be not just expired but revoked — Google returns
        # invalid_grant, and refresh() raises. That used to crash the script;
        # fall back to a fresh sign-in instead.
        if creds and creds.expired and creds.refresh_token:
            try:
                creds.refresh(Request())
            except Exception as e:
                print(f"Saved sign-in is no longer valid ({e}). Opening a browser to sign in again...")
                creds = None
        if not creds or not creds.valid:
            if not CLIENT_SECRET.exists():
                raise SystemExit(f"Need {CLIENT_SECRET} to sign in. Download it from Google Cloud Console.")
            flow = InstalledAppFlow.from_client_secrets_file(str(CLIENT_SECRET), SCOPES)
            creds = flow.run_local_server(port=0)
        TOKEN_FILE.write_text(creds.to_json())
    return creds


def list_sites(service):
    resp = service.sites().list().execute()
    return [s["siteUrl"] for s in resp.get("siteEntry", [])]


def pick_site(service):
    sites = list_sites(service)
    print("Sites on this account:")
    for s in sites:
        print(f"  - {s}")
    for candidate in (SITE_URL, SITE_URL_FALLBACK):
        if candidate in sites:
            print(f"Using: {candidate}")
            return candidate
    for s in sites:
        if "tennesseecashforhomes.com" in s:
            print(f"Using: {s}")
            return s
    print("ERROR: tennesseecashforhomes.com not found in account.")
    sys.exit(1)


def query_gsc(service, site, dimension, row_limit=1000, days=90):
    end = date.today() - timedelta(days=2)
    start = end - timedelta(days=days)
    body = {
        "startDate": start.isoformat(),
        "endDate": end.isoformat(),
        "dimensions": [dimension],
        "rowLimit": row_limit,
    }
    resp = service.searchanalytics().query(siteUrl=site, body=body).execute()
    return {
        "startDate": start.isoformat(),
        "endDate": end.isoformat(),
        "rows": resp.get("rows", []),
    }


def query_gsc_daily(service, site, days=90):
    end = date.today() - timedelta(days=2)
    start = end - timedelta(days=days)
    body = {
        "startDate": start.isoformat(),
        "endDate": end.isoformat(),
        "dimensions": ["date"],
        "rowLimit": 1000,
    }
    resp = service.searchanalytics().query(siteUrl=site, body=body).execute()
    return resp.get("rows", [])


def main():
    creds = authenticate()
    service = build("searchconsole", "v1", credentials=creds)
    site = pick_site(service)

    print("Pulling 90-day query data...")
    queries = query_gsc(service, site, "query", row_limit=1000, days=90)
    print(f"  {len(queries['rows'])} query rows")

    print("Pulling 90-day page data...")
    pages = query_gsc(service, site, "page", row_limit=500, days=90)
    print(f"  {len(pages['rows'])} page rows")

    print("Pulling daily totals...")
    daily = query_gsc_daily(service, site, days=90)
    print(f"  {len(daily)} daily rows")

    payload = {
        "site": site,
        "startDate": queries["startDate"],
        "endDate": queries["endDate"],
        "queries": queries["rows"],
        "pages": pages["rows"],
        "daily": daily,
    }

    out = DATA_DIR / "gsc_data.json"
    out.write_text(json.dumps(payload, indent=2))
    print(f"Saved {out}")


if __name__ == "__main__":
    main()
