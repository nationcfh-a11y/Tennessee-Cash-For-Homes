# Final Pre-Launch Audit — Tennessee Cash For Homes

**Date:** 2026-05-05
**Site under audit:** https://nationcfh.wpcomstaging.com/
**Crawl scope:** 223 URLs (211 with 200 OK), 186 sitemap URLs, 104 redirects re-tested, 28 pages mobile-rendered, 370 image URLs HEAD-checked, 6 pages perf-profiled.

## Verdict: ❌ DO NOT LAUNCH — 6 hard blockers

A user landing on the site today gets a contact page with no form, and Google is locked out by robots.txt. Both of those alone disqualify launch. The detailed pass/fail follows.

---

## Pass/Fail Summary

| # | Item | Status |
|---|---|---|
| 1 | All 301 redirects return correct status codes | ✅ PASS |
| 2 | No redirect chains or loops | ✅ PASS |
| 3 | No pages have placeholder or empty content | ❌ **FAIL** |
| 4 | No broken internal links on any page | ❌ **FAIL** |
| 5 | No pages linking to redirected URLs | ❌ **FAIL** |
| 6 | XML sitemap exists and includes all pages | ✅ PASS |
| 7 | Robots.txt is NOT blocking Google | ❌ **FAIL** (BLOCKER) |
| 8 | No duplicate title tags across the site | ⚠️ Minor (1 group, paginated archives — acceptable) |
| 9 | No duplicate H1s across the site | ❌ **FAIL** |
| 10 | Canonical tags set correctly on every page | ✅ PASS |
| 11 | All images have alt text | ❌ **FAIL** (only on demo pages — same pages as #3) |
| 12 | No horizontal scrolling on any page | ✅ PASS |
| 13 | All tap targets adequate size | ⚠️ Mostly OK, 2-7 small items per page (visual review needed) |
| 14 | No content overflowing off screen | ⚠️ Minor (Investors hero +14px on iPhone SE) |
| 15 | Contact form working correctly | ❌ **FAIL** (BLOCKER) |
| 16 | Homepage lead form working correctly | ✅ PASS |
| 17 | PageSpeed run on homepage + top 5 city pages | ⚠️ Lab-only (PSI API quota exhausted; need API key) |
| 18 | No images over 200KB | ❌ **FAIL** (61 images flagged) |

---

## Hard blockers (fix before launch)

### 🚨 1. robots.txt is still blocking Google

```
$ curl https://nationcfh.wpcomstaging.com/robots.txt
User-agent: *
Disallow: /
```

This is the same blocker flagged in the April 26 audit and is still in place 9 days later. WordPress's *Settings → Reading → "Discourage search engines from indexing this site"* is ON.

**Fix:** WP Admin → Settings → Reading → uncheck the "Discourage" box → Save. After saving, `/robots.txt` should serve the normal `User-agent: *` / `Disallow: /wp-admin/` response. **Do not flip the domain until this is done — Google will see the block immediately and stop crawling.**

### 🚨 2. Contact form is not rendering at all

The shortcode on /contact-us/ has been corrupted by WordPress's smart-quote conversion. Raw HTML on the live page contains:

```
<p>		[sureforms id=&#8217;1762&#8217;]		</p>
```

Those `&#8217;` characters are right-single-quotation marks (curly apostrophes), not straight quotes. WordPress's shortcode parser only recognizes straight `'` or `"` — so the shortcode never executes and the literal `[sureforms id='1762']` text is shown to users. There is no `<form>` element in the rendered DOM. **Visitors who go to /contact-us/ today cannot contact you.**

**Fix:** WP Admin → Pages → Contact Us → edit the block containing the shortcode. Replace `[sureforms id='1762']` with one of:
- `[sureforms id=1762]` (no quotes — best, can't be re-texturized)
- `[sureforms id="1762"]` (double quotes)

After saving, verify `<form>` is present in the page source: `curl -s https://nationcfh.wpcomstaging.com/contact-us/ | grep -c '<form'` — should be ≥ 1.

### 🚨 3. 34 broken internal links: `/where-we-buy/mt-juliet/` (404) — typo in the theme

The actual page slug is `/where-we-buy/mount-juliet/`. The templates use the abbreviated `/mt-juliet/`. Affected files:

- [tn-cash-for-homes/front-page.php](tn-cash-for-homes/front-page.php) (homepage map link)
- [tn-cash-for-homes/page-about.php](tn-cash-for-homes/page-about.php)
- [tn-cash-for-homes/page-where-we-buy.php](tn-cash-for-homes/page-where-we-buy.php)
- [tn-cash-for-homes/location-template.php](tn-cash-for-homes/location-template.php)
- [tn-cash-for-homes/county-template.php](tn-cash-for-homes/county-template.php)
- [tn-cash-for-homes/svg-viewbox-map.php](tn-cash-for-homes/svg-viewbox-map.php)
- [tn-cash-for-homes/county-pages/page-county-wilson-county.php](tn-cash-for-homes/county-pages/page-county-wilson-county.php)

Source pages affected (sample): homepage, /where-we-buy/columbia/, /where-we-buy/davidson-county/, /where-we-buy/sumner-county/, /where-we-buy/robertson-county/, /where-we-buy/dickson-county/, /where-we-buy/tennessee/, …

**Fix:** Find/replace `mt-juliet` → `mount-juliet` across all theme files (be careful in `page-location-mt-juliet.php`'s filename — keep the filename, just fix the URL it links *to*; or rename it to `page-location-mount-juliet.php` and update wherever it's referenced).

### 🚨 4. 315 internal links point to `/blog/` (which 301 → `/blog-home/`)

Every page has a "Blog" item in the main nav: [tn-cash-for-homes/header.php:36](tn-cash-for-homes/header.php#L36):

```php
<a role="menuitem" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
```

That link 301-redirects to /blog-home/. Multiplied across every page on the site, that's 315 unnecessary redirects served to bots and users. (Only 1 hop, so functionally fine, but it harms crawl budget and is trivial to fix.)

**Fix:** Change `'/blog/'` → `'/blog-home/'` in [tn-cash-for-homes/header.php:36](tn-cash-for-homes/header.php#L36). Then grep the rest of the theme for any other `/blog/` references and update them too.

### 🚨 5. Demo theme pages still live and indexable: `/home-2/`, `/projects/`, `/services/`

Three leftover starter-theme pages are live on the site, set to `index, follow`, and contain placeholder content:

| URL | Title | H1s | Issue |
|---|---|---|---|
| /home-2/ | "Home - Tennessee Cash For Homes" | "Home", "We are Commercial\nRoofing Experts" | Contains literal "We are Commercial Roofing Experts" copy |
| /projects/ | "Projects - Tennessee Cash For Homes" | "Projects", "Projects" | Demo content + duplicate H1 |
| /services/ | "Services - Tennessee Cash For Homes" | "Services", "Services" | Demo content + duplicate H1 |

These three pages are also responsible for **all 23 missing alt-text instances** on the site (11 / 6 / 6 split). The rest of the site is at 100% alt coverage (1,376 / 1,376 real images).

**Fix:** Delete all three pages from WP Admin → Pages → Trash (and empty trash). After deletion, add 410-Gone or 301-redirect entries pointing to the homepage.

### 🚨 6. 61 images over 200KB

Top 10:

| Size | URL |
|---:|---|
| 10.0 MB | `i0.wp.com/static.wixstatic.com/.../c38eda_0aef5179bdaa…?resize=4752×3168` |
| 8.0 MB | `i0.wp.com/static.wixstatic.com/.../c38eda_246f8a8601…?resize=5616×3744` |
| 6.9 MB | `i0.wp.com/static.wixstatic.com/.../c38eda_1c83fc168bcb…?resize=7360×4912` |
| 6.5 MB | `i0.wp.com/static.wixstatic.com/.../c38eda_c8fd6cccc6c1…?resize=5640×3760` |
| 5.9 MB | `i0.wp.com/static.wixstatic.com/.../c38eda_ab0b57cd97c9…?resize=6000×3996` |
| 4.4 MB | `i0.wp.com/static.wixstatic.com/.../c38eda_0ac8e67750…?resize=5760×3840` |
| 3.6 MB | `i0.wp.com/static.wixstatic.com/.../c38eda_ae53e04960…?resize=4000×2670` |
| 1.2 MB | `i0.wp.com/static.wixstatic.com/.../c38eda_ed859e29953…?resize=2110×1068` |
| 1.1 MB | `i0.wp.com/static.wixstatic.com/.../c38eda_e7a1bd916cd…?resize=2156×1168` |
| 988 KB | `i0.wp.com/static.wixstatic.com/.../c38eda_4f380071c5…?resize=1536×1024` |

The top 7 are old Wix-imported full-resolution photos (4000–7000 px wide) being served through the Jetpack image proxy without effective resizing. The remaining 54 include WordPress-uploaded blog hero images at 1200 px wide × 200–370 KB. Full list: [seo-audit/final_image_sizes.json](seo-audit/final_image_sizes.json).

**Fix:** Two options, do both:
1. **Resize at the source.** Re-upload the top-10 worst offenders at 1600 px max width and 80% JPEG quality. Each should drop to <200 KB.
2. **Serve responsive variants.** Make sure `<img srcset>` is used so the 7000-px hero image isn't ever fetched on mobile.

---

## Detail by audit category

### Redirects ✅
- 104 redirect entries from [redirects.csv](redirects.csv) re-tested.
- 103/104 final-resolved to 200 OK; 1 was already a 200 (homepage entry).
- 0 final 4xx, 0 chains > 2 hops, 0 loops.

### Sitemap ✅
- `https://nationcfh.wpcomstaging.com/sitemap_index.xml` exists, returns 200, declares 186 URLs across post-sitemap.xml + page-sitemap.xml + category-sitemap.xml (Rank Math).
- All 186 declared URLs were reachable.
- 21 crawled URLs are not in the sitemap — all are blog-home pagination (`/blog-home/page/2/`, `/blog-home/page/3/?category_name=…`). Rank Math correctly excludes these and they're properly canonicalised back to the unfiltered base. No action needed.
- After deleting `/home-2/`, `/projects/`, `/services/` (#5 above), confirm they're also removed from `page-sitemap.xml`.

### Broken internal links ❌
**Total broken links found: 431** (across 12 unique broken targets).

| Target | Status | # of pages linking | Notes |
|---|---:|---:|---|
| /blog/ | 301 | 315 | Header nav link, see blocker #4 |
| /where-we-buy/mt-juliet/ | 404 | 34 | Typo, see blocker #3 |
| /where-we-buy/knoxville/ | 301 | 9 | Goes to /tennessee/ — link directly |
| /where-we-buy/memphis/ | 301 | 9 | Goes to /tennessee/ — link directly |
| /where-we-buy/chattanooga/ | 301 | 9 | Goes to /tennessee/ — link directly |
| /where-we-buy/antioch/ | 301 | 9 | Goes to /tennessee/ — link directly |
| /where-we-buy/jackson/ | 301 | 9 | Goes to /tennessee/ — link directly |
| /where-we-buy/crossville/ | 301 | 9 | Goes to /tennessee/ — link directly |
| /where-we-buy/mcminnville/ | 301 | 9 | Goes to /tennessee/ — link directly |
| /where-we-buy/old-hickory/ | 301 | 9 | Goes to /tennessee/ — link directly |

The 9 city-each redirects come from cross-link blocks in templates that list neighboring cities. They should either point to actual pages (when the city has one) or point directly to `/where-we-buy/tennessee/` (skipping the redirect hop).

Full list: [seo-audit/final_broken_links.csv](seo-audit/final_broken_links.csv).

### Internal links to redirected URLs ❌
**397 internal links target a URL that 301-redirects.** Almost entirely the items above (`/blog/` and the 9 redirected city paths). Resolving #3 and #4 will eliminate ~370 of these. The remaining 27 are city links inside neighboring-cities cross-link blocks — fix as part of the same template pass.

### Duplicate titles ⚠️ Minor
- Only 1 duplicate title group: `"Blog Home - Tennessee Cash For Homes"` is reused across 26 paginated/filtered blog index URLs (`/blog-home/page/3/?category_name=education` etc.). All 26 properly canonical-back to `/blog-home/`, so this is search-engine-acceptable. No action required.

### Duplicate H1s ❌
**8 pages have multiple H1 tags:**

| URL | H1s | Notes |
|---|---|---|
| /home-2/ | "Home", "We are Commercial Roofing Experts" | Demo page — delete (blocker #5) |
| /projects/ | "Projects", "Projects" | Demo page — delete (blocker #5) |
| /services/ | "Services", "Services" | Demo page — delete (blocker #5) |
| /contact-us/ | "Contact Us", "Contact" | **Real bug** — page content has 2 H1 blocks |
| /category/market-trends/ | 9× post titles | Rank Math archive template — uses `<h1>` for each post card |
| /category/home-tips/ | 9× post titles | Same |
| /category/selling-guide/ | 9× post titles | Same |
| /category/education/ | 9× post titles | Same |

**Fixes:**
- /contact-us/ — edit the page in WP Admin and demote the second "Contact" H1 to an H2 (or remove it).
- The four /category/ archives are using `<h1>` for each post card. That's a Rank Math + theme-template choice. If you want to be strict, change the post-card heading to `<h2>` in the archive template ([tn-cash-for-homes/category-archive…] — search the theme for the archive loop). Lower priority than the rest.

### Canonical tags ✅
- 0 pages missing a canonical tag.
- 14 pages have a non-self canonical — all are paginated/filtered blog views correctly canonicalising up to the unfiltered base. By design.

### Alt text ❌
- 1,399 `<img>` tags inspected across 211 successfully-crawled pages.
- 23 missing alts, all concentrated on the 3 demo pages (`/home-2/` 11, `/projects/` 6, `/services/` 6).
- Real-content alt coverage: **100% (1,376 / 1,376)**.
- After deleting the demo pages (blocker #5), this becomes a clean PASS.

### Mobile (28 pages rendered at 375 × 812 iPhone-SE viewport) ⚠️
- **Horizontal scroll: 0 / 28 pages** ✅
- **Off-screen-right elements:** Only 1 (Investors hero — see below).
- **Overflow elements wider than viewport:** 22 / 28 pages have 1 each. The homepage's flag is `div#reviewsTrack` which is the carousel track (1735 px) — by design, parent has overflow-hidden. Most other pages flag a hero element 389 px wide on a 375 px viewport (a 14 px CSS bleed). The Investors page has 5 such items (hero content, breadcrumb, h1, subtitle, trust-row — all 389 px). Visual on /investors/ is fine because of `overflow-x: hidden` further up, but ideally tighten the hero container to 100% width with no horizontal padding leak.
- **Small tap targets (<40 × 36 px):** 2–7 per page. Most are the hamburger-menu icon and footer social icons (visually fine but technically small per WCAG's 44×44 recommendation). A visual review is recommended; not a launch blocker.
- **Small text (<12 px):** 1–3 per page, typically `.form-disclaimer` or `.areas-footnote`. Verify these are intentional.

Full results: [mobile-audit/results.json](mobile-audit/results.json), screenshots in [mobile-audit/shots/](mobile-audit/shots/).

### Forms

| Form | Status |
|---|---|
| Homepage hero "Get Your Free Cash Offer" (id="leadForm") | ✅ PASS — endpoint at `/wp-admin/admin-ajax.php?action=tcfh_submit_lead` validates and writes to Airtable. Tested with empty payload → returns `{"success":false,"data":{"error":"Please fill in all required fields."}}` HTTP 422 as expected. Nonce verifies correctly. |
| Land-section form on homepage | ✅ PASS — same handler |
| Lead-form on FAQ / How It Works / city / county / situation / facing-foreclosure templates | ✅ PASS — same handler, same nonce |
| Investors form (/investors/) | Not re-tested in this audit; same handler family (`tcfh_submit_investor`). |
| **Contact form** (/contact-us/, Sureforms id 1762) | ❌ **FAIL** — see blocker #2 |

### Page Speed (lab snapshot, simulated mobile: Slow 4G + 4× CPU throttling)

| Page | TTFB | FCP | Total transfer | Requests |
|---|---:|---:|---:|---:|
| Homepage | 171 ms | 1,072 ms | **6,319 KB** | 38 |
| /where-we-buy/nashville/ | 349 ms | 696 ms | 1,936 KB | 19 |
| /where-we-buy/franklin/ | 334 ms | 596 ms | 1,936 KB | 19 |
| /where-we-buy/murfreesboro/ | 398 ms | 660 ms | 1,937 KB | 19 |
| /where-we-buy/clarksville/ | 365 ms | 612 ms | 1,936 KB | 19 |
| /where-we-buy/columbia/ | 318 ms | 580 ms | 1,936 KB | 19 |

Notes:
- TTFB and FCP are good. The **homepage is 6.3 MB** — way too heavy. Most of that is the same large Wix images called out in blocker #6.
- City pages are uniformly ~1.94 MB — borderline; reduce hero/section images to get under the 1.5 MB Google "fast" threshold.
- LCP could not be captured (PerformanceObserver must be registered before paint, which a retroactive snapshot can't do).
- **Real PageSpeed Insights scores are still unobtainable** without a Google Cloud API key. The unauthenticated daily quota is 0 (same as the April 26 audit). To unblock: create a key at https://console.cloud.google.com/apis/credentials and re-run with it. Until then, the manual fallback is opening pagespeed.web.dev for each URL in a browser.

### Images > 200KB ❌
61 / 370 unique image URLs are over 200 KB. See blocker #6 for the worst offenders. Full list: [seo-audit/final_image_sizes.json](seo-audit/final_image_sizes.json).

---

## Files written by this audit

| File | What it is |
|---|---|
| [seo-audit/final_crawl.json](seo-audit/final_crawl.json) | Full crawl (211 pages w/ titles, H1s, canonicals, link targets, image lists) |
| [seo-audit/final_redirects.json](seo-audit/final_redirects.json) | 104 redirect tests with chain detail |
| [seo-audit/final_broken_links.csv](seo-audit/final_broken_links.csv) | 12 unique broken-link targets + sources |
| [seo-audit/final_dup_titles.csv](seo-audit/final_dup_titles.csv) | Duplicate-title groups |
| [seo-audit/final_dup_h1s.csv](seo-audit/final_dup_h1s.csv) | Duplicate-H1 groups |
| [seo-audit/final_canonical_issues.csv](seo-audit/final_canonical_issues.csv) | Pages with non-self canonicals |
| [seo-audit/final_alt_issues.csv](seo-audit/final_alt_issues.csv) | Pages with missing alt text |
| [seo-audit/final_thin_content.csv](seo-audit/final_thin_content.csv) | Thin / placeholder content scan results |
| [seo-audit/final_image_urls.txt](seo-audit/final_image_urls.txt) | All 370 unique image URLs |
| [seo-audit/final_image_sizes.json](seo-audit/final_image_sizes.json) | Each image's bytes + content-type |
| [seo-audit/final_perf.json](seo-audit/final_perf.json) | Lab perf snapshot for homepage + 5 cities |
| [seo-audit/final_summary.json](seo-audit/final_summary.json) | Top-line counts for every check |
| [seo-audit/contact-form.png](seo-audit/contact-form.png) | Screenshot showing the broken contact page |
| [mobile-audit/results.json](mobile-audit/results.json) | Mobile audit (28 pages at 375px) |

Reproducible scripts: [seo-audit/final_audit.py](seo-audit/final_audit.py), [seo-audit/final_analyze.py](seo-audit/final_analyze.py), [seo-audit/check_images.py](seo-audit/check_images.py), [seo-audit/perf_snapshot.js](seo-audit/perf_snapshot.js), [seo-audit/test_contact_form_v2.js](seo-audit/test_contact_form_v2.js).

---

## Suggested fix order

1. **Fix the contact form** (5 min — edit the shortcode in WP Admin to use no quotes or double quotes).
2. **Find/replace `mt-juliet` → `mount-juliet`** in the theme.
3. **Change `/blog/` → `/blog-home/`** in [tn-cash-for-homes/header.php:36](tn-cash-for-homes/header.php#L36).
4. **Fix the second H1 on /contact-us/** — demote to H2 in the page editor.
5. **Delete /home-2/, /projects/, /services/** in WP Admin.
6. **Resize the top 10 oversized images** (re-upload at 1600 px / 80% JPEG).
7. **Uncheck "Discourage search engines"** in WP Settings → Reading. *(Do this LAST, right before flipping the domain — verify robots.txt no longer says `Disallow: /` immediately after.)*
8. **Re-run this audit** (just `python3 final_audit.py && python3 final_analyze.py`) to confirm everything is clean.
9. **(Optional but recommended)** create a Google Cloud API key and run real PageSpeed Insights on all 6 URLs above before launch.

The site is **not** ready to launch in its current state.
