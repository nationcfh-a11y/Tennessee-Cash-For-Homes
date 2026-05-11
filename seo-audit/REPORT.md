# Pre-Launch SEO Audit — Wix → WordPress Migration

**Date:** 2026-04-26
**Sites compared:**
- Wix (live):       https://www.tennesseecashforhomes.com/
- WordPress (staging): https://nationcfh.wpcomstaging.com/

**Scope:** 186 Wix URLs (from sitemap.xml), 342 WordPress URLs (from Rank Math sitemap_index.xml).

---

## TL;DR — Launch Blockers

You have **3 hard blockers** that will damage SEO if you transfer the domain right now:

1. **WordPress is set to "Discourage search engines"** — robots.txt currently serves `User-agent: *` / `Disallow: /`. After domain transfer, Googlebot will be blocked from the entire site until this is turned off.
2. **109 internal 404s on the WordPress site** — almost every county/city page in `/where-we-buy/` links to other county/city pages that don't exist yet. This is an internal site issue, not a Wix-redirect issue.
3. **26 Wix URLs have no 301 redirect on WordPress** — these will go from indexed to 404 the moment the domain flips.

Plus several yellow flags below. Full data in the CSVs in this folder.

---

## 1. URL & Metadata Comparison (Wix vs WordPress)

| Check | Count |
|---|---:|
| Wix URLs in sitemap | 186 |
| WordPress URLs in sitemap | 342 |
| Paths present on Wix but NOT on WP | 132 |
| Paths present on WP but NOT on Wix | 287 |
| Pages with title mismatch | 53 |
| Pages with meta description mismatch | 48 |
| Pages with H1 mismatch | 28 |
| WP pages missing meta description | 6 |
| WP pages missing canonical | 1 (likely false positive — see note) |
| WP pages with multiple H1 tags | 0 |

### Notes

- The 132 "missing on WP" paths are mostly Wix-only URL patterns (`/post/...`, `/items/...`) that DO have WordPress equivalents at different paths (`/2024/05/.../...`, etc.) reached via 301 redirect. Of those 132, **only 26 actually 404 on the WordPress side** (see §2).
- The 287 "new on WP" paths are largely the new `/where-we-buy/{county}/` and city pages plus `/2024/...` blog post permalinks. This is expected — you've added content and changed the blog URL structure.
- **Title/meta/H1 differences are intentional rewrites in most cases** (the WP versions look better-targeted). Decide page-by-page whether you want to keep the WP wording or restore Wix wording for ranking continuity. Suggested rule: pages that already rank well on Wix → keep the Wix title/H1; pages that don't rank → keep the rewritten WP version. See `metadata_compare.csv`.
- WP pages flagged missing meta description (verify in the editor):
  - `/blog-home`
  - `/faq`
  - `/how-it-works`
  - `/investors`
  - One row tagged for `/` is a crawl-key artifact; the homepage actually has a healthy title, meta, canonical, and one H1 when fetched directly.
- WP canonical for `/blog-home` doesn't match its own path — verify the canonical tag in Rank Math is set correctly.

**Sample title rewrites** (full list in CSV):

| Path | Wix | WordPress |
|---|---|---|
| `/about` | Tennessee Cash For Homes \| About | About Tennessee Cash For Homes \| Family Owned Tennessee Cash Home Buyers |
| `/blog-home` | Real Estate Tips & Market Insights \| Read Our Blog | Blog Home - Tennessee Cash For Homes |
| `/facing-foreclosure/antioch` | Avoid Foreclosure in Antioch \| Sell Your Home Fast | Facing Foreclosure in Antioch TN \| Tennessee Cash For Homes |

→ Output: [metadata_compare.csv](metadata_compare.csv) (473 rows, every path side-by-side with all fields).

---

## 2. 301 Redirect Coverage (Wix → WordPress)

We tested every Wix URL against the WordPress host (which is what will happen when you flip the domain) and followed redirect chains.

| Result | Count |
|---|---:|
| 301 → 200 (correct redirect) | 153 |
| 301 → 200 after fixing trailing slash | 6 |
| 200 direct (homepage) | 1 |
| **404 — NO redirect set up** | **26** |

The 26 missing redirects are Wix-only URL paths that need 301s before launch. Most are old `/items/...` URLs and a few orphan pages:

```
/items/how-lawrenceburg-tn-homeowners-can-avoid-foreclosure-lawsuits-effectively
/items/how-nashville-tn-homeowners-can-sell-their-home-during-probate-delays
/items/how-oak-ridge-tn-homeowners-can-sell-homes-with-code-violations-easily
/items/how-tennessee-homeowners-can-sell-a-house-with-tax-liens-fast
/items/how-tennessee-homeowners-can-sell-during-financial-hardship-fast
/items/how-tennessee-homeowners-can-sell-fast-for-cash
/items/how-tennessee-homeowners-can-sell-homes-amid-probate-delays
/items/how-tennessee-homeowners-can-sell-properties-facing-bankruptcy
/items/how-tennessee-homeowners-can-sell-quickly-amid-financial-hardship
/items/how-tennessee-homeowners-can-sell-quickly-before-foreclosure-starts
/items/how-tennessee-homeowners-can-stop-tax-lien-foreclosure-fast
/items/how-to-sell-an-as-is-home-in-alcoa-tn-with-code-violations
/items/navigating-probate-to-sell-inherited-homes-in-soddy-daisy-tn
/items/tennessee-guide-to-selling-a-home-in-probate-quickly-and-easily
/items/tennessee-homeowners-facing-divorce%3A-how-to-sell-property-fast
/items/tennessee-homeowners-guide-to-avoid-foreclosure-lawsuit-fees
/items/tennessee-homeowners-guide-to-selling-property-with-bankruptcy
/items/understanding-tennessee-foreclosure-timelines-to-protect-your-home
/items/understanding-tennessee-tax-lien-foreclosure-timelines-for-sellers
/items/what-tennessee-homeowners-must-know-about-pre-foreclosure-rights
/items/what-tennessee-homeowners-should-do-when-facing-property-tax-liens
/items/what-tennessee-homeowners-should-know-about-bankruptcy-and-selling
/items/when-does-foreclosure-start-in-dickson-tn-how-to-respond
/items   (the index page itself)
/more-information
/our-solutions
```

**Action:** Add Rank Math (or Redirection plugin) entries for each of the above pointing to the closest WP equivalent. For the 23 `/items/...` URLs, point to the matching new blog post or to the `/blog/` index if no equivalent exists. For `/more-information` and `/our-solutions`, point to the most relevant top-nav page (`/how-it-works` and `/about` are likely fits).

**Note on the 6 trailing-slash redirects:** these worked (`/where-we-buy/gallatin` → 301 → `/where-we-buy/gallatin/` → 200) so they're fine, but if Wix originally indexed the slashless versions, that's a 1-hop redirect chain. Acceptable but not ideal.

→ Output: [missing_redirects.csv](missing_redirects.csv)

---

## 3. Robots.txt & Indexing

**Live robots.txt content:**
```
User-agent: *
Disallow: /
```

**This is a launch blocker.** WordPress's "Discourage search engines from indexing this site" setting is ON. The moment you point your domain at this site, Google will see this and stop crawling.

**Fix:** WP Admin → Settings → Reading → uncheck "Discourage search engines from indexing this site" → Save. Then verify `https://nationcfh.wpcomstaging.com/robots.txt` no longer contains `Disallow: /` (it should look something like `User-agent: *` with `Disallow: /wp-admin/` and a `Sitemap:` line).

Googlebot is not specifically blocked beyond the wildcard, so flipping the setting is the only fix needed.

---

## 4. XML Sitemap

- Sitemap exists at `https://nationcfh.wpcomstaging.com/sitemap_index.xml` (Rank Math; `/sitemap.xml` and `/wp-sitemap.xml` both 301 here).
- Sitemap declares **221 URLs**.
- The crawl found **341 reachable pages** that aren't `/wp-admin/` or feed URLs.
- **124 reachable pages are NOT in the sitemap.**

The vast majority of the 124 missing-from-sitemap entries are WordPress media-attachment pages (e.g. `/black-labrador-birddog-image/`, `/house-logo1/`, `/100-image/`, `/favicon/`). Those are auto-generated and are usually not worth indexing — Rank Math correctly excludes them. But several real content pages are also missing, including:

```
/are-we-buy-homes-for-cash-legit/
/asbestos-in-tennessee-homes-risks-removal-and-how-tennessee-cash-for-homes-can-help/
/avoiding-common-home-selling-mistakes-a-comprehensive-guide-for-homeowners/
/behind-on-mortgage-payments-a-homeowners-guide/
/comparing-the-benefits-real-estate-agent-vs-direct-sale-for-your-property/
/do-i-have-to-pay-taxes-on-money-made-from-selling-my-home-...
/downsizing-to-a-smaller-home-...
/fair-cash-offer-for-your-home-which-route-to-take/
/from-offer-to-closing-the-timeline-of-a-cash-home-sale-in-tennessee/
/high-interest-rates-why-now-is-the-right-time-to-sell-your-home/
/how-foreclosure-affects-your-credit-score-and-what-to-do-about-it/
/how-to-identify-the-top-cash-home-buyers-in-murfreesboro-tn/
…
```

These look like duplicate post URLs — WordPress probably has each blog post at both `/post-slug/` AND `/2024/01/15/post-slug/` and Rank Math is only listing one of them. Pick a canonical URL pattern, set canonical tags accordingly, and either remove the duplicate or 301 it to the canonical.

The sitemap also exposes 4 category archive pages (`/category/education/`, etc.) that the crawler never reached because nothing links to them. That's fine but verify they have meaningful content before indexing.

→ Output: [sitemap_missing.csv](sitemap_missing.csv) (124 rows)

---

## 5. Image Alt Text

**Total images on WordPress:** 2,153
**Missing alt text:** 23 images on **3 pages** (1.1%)

| Page | Missing / Total |
|---|---|
| `/home-2/` | 11 / 14 |
| `/projects/` | 6 / 9 |
| `/services/` | 6 / 9 |

These three URLs look like leftover demo/template pages from a starter theme — `/home-2/`, `/projects/`, and `/services/` are typical placeholder slugs and don't appear in your nav. **Recommend deleting them entirely** rather than fixing alt text, as they likely contain dummy content. If you delete them, exclude them from the sitemap and add 410 (Gone) responses or redirects.

The rest of the site has 100% alt text coverage. Solid.

→ Output: [alt_issues.csv](alt_issues.csv)

---

## 6. Broken Links on WordPress Staging

After de-duplicating share-widget URLs (`?share=twitter`, `?share=facebook` — these are WordPress.com Jetpack artifacts, not real links) and re-checking rate-limited responses sequentially:

**109 unique internal links return HTTP 404.**

**Pattern:** every single 404 is a `/where-we-buy/{slug}/` page. The county and city pages in your `/where-we-buy/` section link to one another and to neighbors that don't exist yet.

Examples:
- `/about/` links to `/where-we-buy/johnson-county/` → 404
- `/about/` links to `/where-we-buy/giles-county/` → 404
- `/where-we-buy/sevier-county/` links to `/where-we-buy/gatlinburg/` → 404
- `/where-we-buy/sullivan-county/` links to `/where-we-buy/kingsport/`, `/bristol/`, `/blountville/` — all 404
- `/where-we-buy/hamilton-county/` links to `/where-we-buy/soddy-daisy/` → 404
- …and 104 more

This is the largest cleanup item. Either (a) generate the missing city/county pages before launch, or (b) remove the dead internal links from the pages that point to them so the site's own crawl doesn't hit 404s.

**Note:** these are WP-internal broken links, not Wix→WP redirect problems. They will exist after launch unless fixed.

→ Output: [broken_links.csv](broken_links.csv) (109 rows with the source page that links to each broken URL)

---

## 7. Page Speed / Core Web Vitals

**PageSpeed Insights API requires a Google Cloud API key** (the unauthenticated daily quota is 0). I attempted both runs and got `RESOURCE_EXHAUSTED` from Google.

To unblock this in 2 minutes:
1. Visit https://console.cloud.google.com/apis/credentials
2. Create credentials → API key (no restrictions needed for this audit)
3. Paste the key into me; I'll re-run mobile + desktop on both home pages and add the comparison.

**Manual fallback while you decide:** open these in your browser to get scores immediately:
- Wix: https://pagespeed.web.dev/analysis?url=https%3A%2F%2Fwww.tennesseecashforhomes.com%2F
- WP staging: https://pagespeed.web.dev/analysis?url=https%3A%2F%2Fnationcfh.wpcomstaging.com%2F

**Basic page-weight comparison (homepage, not a substitute for Lighthouse):**

| Metric | Wix | WordPress |
|---|---:|---:|
| TTFB (single request) | 0.22 s | 0.41 s |
| HTML transfer size | 1,461 KB | 117 KB |
| `<script src>` count | 11 | 5 |
| `<link stylesheet>` count | 0 (inlined) | 2 |
| `<img>` count above the fold | 55 | 7 |
| JS+CSS asset weight (estimated) | 232 KB | unknown (gzipped no Content-Length) |

The WordPress homepage HTML is **12× smaller** and has fewer above-the-fold images, which usually translates to materially better LCP and TBT once you run real Lighthouse measurements. The TTFB is slightly higher on staging (likely WordPress.com cold-cache hitting Atlanta region). I'd expect WP to win Core Web Vitals; the API runs will confirm.

---

## Punch List Before Domain Transfer

### Must-fix (blockers)

- [ ] **Disable "Discourage search engines"** in WP Settings → Reading. Verify robots.txt no longer contains `Disallow: /`.
- [ ] **Add 301 redirects for the 26 Wix URLs that currently 404** on WP (see [missing_redirects.csv](missing_redirects.csv)).
- [ ] **Fix or remove the 109 internal 404 links** in `/where-we-buy/` (see [broken_links.csv](broken_links.csv)).

### Should-fix (yellow flags)

- [ ] Decide title/meta/H1 strategy on the 53/48/28 mismatched pages. Default to keeping the WP rewrites unless a Wix page is currently ranking — in those cases, restore the Wix title/H1 to preserve ranking. ([metadata_compare.csv](metadata_compare.csv))
- [ ] Add meta descriptions to: `/blog-home`, `/faq`, `/how-it-works`, `/investors`.
- [ ] Verify canonical tag on `/blog-home/` (it currently points to a different path).
- [ ] Delete `/home-2/`, `/projects/`, `/services/` placeholder pages OR add alt text and real content. They have 23 missing-alt images and look like theme demo pages.
- [ ] Investigate the 124 pages reachable but not in the sitemap. Most are media attachment pages (correctly excluded), but the duplicate blog post URLs (`/some-post-title/` vs `/2024/01/15/some-post-title/`) need a canonical strategy.
- [ ] Provide a PageSpeed Insights API key so I can run the proper Core Web Vitals comparison.

### After launch

- [ ] Submit the new sitemap (`/sitemap_index.xml`) to Google Search Console under the production domain.
- [ ] Use the GSC URL Inspection tool on 5–10 critical pages to confirm Google can index them.
- [ ] Monitor GSC's Coverage report for a 1–2 week window; expect a temporary spike in 404s as Google rediscovers old `/items/...` and `/post/...` URLs and follows the 301s.
- [ ] Watch CrUX (real-user) Core Web Vitals in the first 28 days post-launch; field data will replace the lab data.

---

## Files in this folder

| File | What it is |
|---|---|
| [REPORT.md](REPORT.md) | This document |
| [crawl.json](crawl.json) | Raw crawl output for both sites |
| [analysis.json](analysis.json) | Analysis results (metadata, robots, sitemap, alt, redirects, broken links) |
| [redirect_recheck.json](redirect_recheck.json) | Sequential re-check of suspect redirects |
| [broken_clean.json](broken_clean.json) | De-rate-limited broken-link list |
| [pagespeed.json](pagespeed.json) | (Quota errors — needs API key) |
| [page_weight.json](page_weight.json) | Basic asset-weight comparison |
| [metadata_compare.csv](metadata_compare.csv) | Side-by-side metadata for all 473 paths |
| [missing_redirects.csv](missing_redirects.csv) | 26 Wix URLs without WP redirects |
| [broken_links.csv](broken_links.csv) | 109 WP-internal 404s + source pages |
| [alt_issues.csv](alt_issues.csv) | 3 pages with missing alt text |
| [sitemap_missing.csv](sitemap_missing.csv) | 124 crawled pages absent from sitemap |
| [crawl.py](crawl.py), [analyze.py](analyze.py) | Reproducible scripts |
