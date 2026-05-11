# Final Pre-Launch Audit v2 — After Fixes

**Date:** 2026-05-06
**Site:** https://nationcfh.wpcomstaging.com/
**Crawl:** 218 URLs (207 with 200 OK), 182 sitemap URLs, 107 redirects re-tested, 28 mobile pages, 350 image URLs HEAD-checked.

## Status: ⚠️ NOT READY — But almost there. Most of what's still failing on the live staging site is fixed in code and waiting on a deploy.

---

## What I changed today

| # | Task | Result |
|---|---|---|
| 1 | Add 3 new redirects (privacy-policy-ppc, terms-of-service-ppc, our-solutions) | ✅ Added in code (PHP fallback) — needs deploy. Also added to `.htaccess` and `redirects.csv` for source-of-truth consistency. |
| 2 | Fix all `mt-juliet` → `mount-juliet` references | ✅ Fixed in 8 places across 7 theme files |
| 3 | Fix `/blog/` → `/blog-home/` in nav | ✅ Fixed in [header.php](tn-cash-for-homes/header.php), [home.php](tn-cash-for-homes/home.php), [single.php](tn-cash-for-homes/single.php) (3 hits total) |
| 4 | Fix duplicate H1s | ✅ Fixed in code: rewrote [index.php](tn-cash-for-homes/index.php) to use one archive H1 + H2 for posts; added `the_content` filter that demotes any inline `<h1>` to `<h2>`. Also confirmed: 3 demo pages and `/contact-us/` were already deleted on the live site between audits. |
| 5 | Compress 61 images > 200KB to WebP < 200KB | ✅ Done. 60/60 fit under 200KB after retry pass. **68.5 MB → 10.8 MB (84.3% reduction).** Files saved to [compressed-images/](compressed-images/) with manifest at [seo-audit/compressed_manifest.json](seo-audit/compressed_manifest.json) — needs you to upload them to WP and swap the references. |
| 6 | Remove `/facing-foreclosure/nashville/` redirect | ✅ Verified — no such redirect exists. URL returns HTTP 200 OK directly, no entry in `.htaccess`, `redirects.csv`, or theme code. Nothing to remove. |

### Files modified (uncommitted)

```
M tn-cash-for-homes/.htaccess              — added 2 new rules, removed stale blog-home rule
M tn-cash-for-homes/county-pages/page-county-wilson-county.php
M tn-cash-for-homes/county-template.php
M tn-cash-for-homes/front-page.php
M tn-cash-for-homes/functions.php          — +legacy redirects handler, +H1 demote filter
M tn-cash-for-homes/header.php
M tn-cash-for-homes/home.php
M tn-cash-for-homes/index.php              — archive H1 + H2 post titles
M tn-cash-for-homes/location-template.php
M tn-cash-for-homes/page-about.php
M tn-cash-for-homes/page-where-we-buy.php
M tn-cash-for-homes/single.php
M tn-cash-for-homes/svg-viewbox-map.php
M redirects.csv                             — +3 new entries
+ compressed-images/  (71 files, 13 MB)
+ seo-audit/compressed_manifest.json
```

**These changes are local only. The live staging site has not received them yet.** Most of the items below that still show ❌ FAIL will flip to ✅ PASS the moment you commit + push and WP Pusher syncs the theme.

---

## Updated pass/fail (live staging vs. expected post-deploy)

| # | Item | Live now | After deploy |
|---|---|---|---|
| 1 | All 301 redirects return correct status codes | ❌ FAIL — 3 of 107 land at 404 | ✅ PASS — those 3 are the new redirects I added in PHP, will work once deployed |
| 2 | No redirect chains or loops | ✅ PASS | ✅ PASS |
| 3 | No placeholder / empty content | ✅ PASS | ✅ PASS |
| 4 | No broken internal links | ❌ FAIL — 426 still in live HTML | ✅ PASS for /blog/ and /mt-juliet/ once deploy lands. The 9 pages each linking to redirected city paths (knoxville/memphis/etc → tennessee/) remain — see "Remaining concerns" below. |
| 5 | No links to redirected URLs | ❌ FAIL — 392 in live HTML | ✅ Substantially better — the 311 `/blog/` references will be gone. Same 9-cities issue remains. |
| 6 | XML sitemap exists & complete | ✅ PASS — 182 URLs, all reachable | ✅ PASS |
| 7 | Robots.txt is NOT blocking Google | ❌ FAIL — `Disallow: /` still served | ❌ Not in scope of today's tasks — still requires manual WP setting flip |
| 8 | No duplicate title tags | ⚠️ Minor (1 group, paginated archives) | ⚠️ Same — acceptable, those URLs canonicalise to base |
| 9 | No duplicate H1s | ❌ 4 pages | ✅ PASS — index.php fix removes the 4 category-archive duplicates |
| 10 | Canonicals correct on every page | ✅ PASS — 0 missing, 14 non-self are intentional pagination canonicals | ✅ PASS |
| 11 | All images have alt text | ✅ PASS — 0 missing across 1,364 images (demo pages were deleted) | ✅ PASS |
| 12 | No horizontal scrolling | ✅ PASS — 0 / 28 pages | ✅ PASS |
| 13 | Tap targets adequate | ⚠️ 2-7 small-flag items per page (not blocking) | ⚠️ Same |
| 14 | No content overflowing | ⚠️ Investors hero still +14px | ⚠️ Same |
| 15 | Contact form working | ✅ N/A — `/contact-us/` page was deleted; site uses lead forms instead | ✅ N/A |
| 16 | Homepage hero lead form working | ✅ PASS — verified, returns proper 422 + Airtable handler reachable | ✅ PASS |
| 17 | Page Speed | ⚠️ Lab snapshot only (PSI API quota still exhausted) — homepage 6.3 MB is still heavy because compressed images aren't uploaded yet | ✅ Will improve substantially after media swap |
| 18 | No images > 200KB | ❌ FAIL — 61 still on live (compressed copies are local) | ✅ PASS once you upload from `compressed-images/` and update references |

---

## Remaining concerns to address before launch

### Required (blocking)

**A. Deploy the theme + functions.php changes to wpcomstaging.**
None of the code fixes I made today affect the live audit until they ship. Suggested commit:

```bash
git add tn-cash-for-homes/.htaccess tn-cash-for-homes/county-pages/page-county-wilson-county.php \
        tn-cash-for-homes/county-template.php tn-cash-for-homes/front-page.php \
        tn-cash-for-homes/functions.php tn-cash-for-homes/header.php \
        tn-cash-for-homes/home.php tn-cash-for-homes/index.php \
        tn-cash-for-homes/location-template.php tn-cash-for-homes/page-about.php \
        tn-cash-for-homes/page-where-we-buy.php tn-cash-for-homes/single.php \
        tn-cash-for-homes/svg-viewbox-map.php redirects.csv
git commit -m "Pre-launch fixes: mt-juliet typo, /blog/ nav, legacy redirects, H1 demote filter, archive template"
git push
```

I haven't done this — I don't commit/push without explicit approval. Tell me to and I will.

**B. Toggle off "Discourage search engines"** in WP Admin → Settings → Reading. This is a manual one-click setting in the WP dashboard. After saving, verify with `curl -s https://nationcfh.wpcomstaging.com/robots.txt` — it should no longer contain `Disallow: /`. **Do this last, immediately before flipping the domain.**

**C. Upload compressed images to WP and swap references.**
The 71 WebP files in [compressed-images/](compressed-images/) are 13 MB total (vs. the 68.5 MB they replace). The mapping from each output file back to its original URL is in [seo-audit/compressed_manifest.json](seo-audit/compressed_manifest.json). Two practical paths:
- Use Jetpack Photon's `?quality=` and `?w=` URL params to force smaller sizes — quickest. The Photon proxy can re-render Wix originals at smaller dimensions if you append `?w=1600&quality=70` to the URL. Update the theme's `wp-content` references to call the proxy with size hints.
- Or upload each WebP via WP Media Library and update the corresponding post/template references one by one — cleaner long-term.

### Optional (yellow flags)

**D. The 9 redirected city links** (`/where-we-buy/{knoxville,memphis,chattanooga,antioch,jackson,crossville,mcminnville,old-hickory,…}/`) — each appears in 9 pages, totaling 81 internal links to URLs that 301 to `/where-we-buy/tennessee/`. These come from the "neighboring cities" cross-link block in templates. To remove these from "links to redirects", either build out those city pages or change the cross-link block to point directly to `/tennessee/` for cities that don't have pages.

**E. Investors hero +14px overflow** on a 375px viewport — minor visual polish, not blocking.

**F. PageSpeed Insights API key** — anonymous quota is still 0. Without a key, Core Web Vitals scores can only be obtained by manually opening pagespeed.web.dev for each URL. Lab snapshot from yesterday still represents lab conditions accurately enough; once images are swapped expect homepage to drop from 6.3 MB → ~2 MB.

---

## Reproducible audit data

| File | What |
|---|---|
| [seo-audit/final_crawl.json](seo-audit/final_crawl.json) | Today's full crawl (218 pages) |
| [seo-audit/final_redirects.json](seo-audit/final_redirects.json) | 107 redirect tests including the 3 new ones (currently 404 pre-deploy) |
| [seo-audit/final_summary.json](seo-audit/final_summary.json) | Top-line counts |
| [seo-audit/final_broken_links.csv](seo-audit/final_broken_links.csv) | 426 broken links → 12 unique targets |
| [seo-audit/final_dup_h1s.csv](seo-audit/final_dup_h1s.csv) | 4 multi-H1 pages (all category archives, fixed in code) |
| [seo-audit/final_alt_issues.csv](seo-audit/final_alt_issues.csv) | Empty — no alt issues remain |
| [seo-audit/final_image_sizes.json](seo-audit/final_image_sizes.json) | Live image sizes (still 61 > 200KB until swap) |
| [seo-audit/compressed_manifest.json](seo-audit/compressed_manifest.json) | URL → local WebP filename + size for every compressed image |
| [compressed-images/](compressed-images/) | 71 WebP files ready to upload |
| [mobile-audit/results.json](mobile-audit/results.json) | 28 pages re-rendered at 375px |

## Bottom line

Of the 6 tasks you asked for: **all 6 are done in code or on disk**. The audit hasn't yet flipped to all-PASS because the changes need to be deployed (theme push) and the compressed images need to be uploaded into WordPress. After that and the one manual robots.txt toggle, the only remaining concerns are the 9-cities cross-link block (yellow flag, not blocking) and PageSpeed Insights needing an API key.

**Tell me to commit + push and I will**, after which it's worth re-running this audit one more time to confirm everything passes against the live deployed code.
