# SEO Changelog — tennesseecashforhomes.com

---

# 🚩 DEPLOYMENT MARKER — SEO Internal Linking — Batch 1

| | |
|---|---|
| **Label** | **SEO Internal Linking — Batch 1** |
| **Content changes went live** | **2026-08-12, 15:47 CDT (20:47 UTC)** — blog link repairs, applied via WP REST API |
| **Theme code pushed to `main`** | **2026-08-12, 16:29:04 CDT (21:29:04 UTC)** — commit `7b045e7` |
| **Theme code live on production** | ⚠️ **NOT YET — WP Pusher auto-deploy is failing (HTTP 400)** |
| **GSC before/after boundary** | **2026-08-12** for the blog link work. The theme portion needs its own boundary once it actually deploys. |

> **Two boundaries, not one.** Items 1–3 (the 242 blog link changes) are live as of
> 12 Aug and can be measured from that date. Items 4–8 (theme templates) are
> committed to `main` but have **not** reached production — WP Pusher's
> push-to-deploy webhook has been returning HTTP 400 since at least 10 Aug.
> Record the real deploy date here once it lands, and measure that separately.

---


Every entry records date, URLs affected, files changed, the exact change, reason,
target opportunity, risk level, and expected result, so deployments can be
correlated with Search Console movement.

Guiding principle: **Protect existing rankings → strengthen internal authority →
improve relevant pages → expand only where verified demand exists → measure.**

---

## 2026-08-12 — Batch A: Blog internal link graph repair (LIVE)

### A1. Legacy `/post/` and `/items/` links repointed to current URLs

| Field | Value |
|---|---|
| **Date** | 2026-08-12 |
| **URLs affected** | 91 blog posts (188 links rewritten) |
| **Files changed** | WordPress post content via REST API — no theme files |
| **Exact change** | `href="https://www.tennesseecashforhomes.com/post/{slug}"` → `href="https://tennesseecashforhomes.com/{slug}/"`. Same for `/items/{slug}`. Anchor text untouched. Only the `href` attribute changed. |
| **Reason** | Every legacy `/post/` and `/items/` URL 301-redirects to the **homepage**, not to the article. 188 in-content links were dumping readers and crawlers on the homepage instead of the intended article. |
| **Target opportunity** | Restores the blog's internal link graph; stops the homepage absorbing link equity intended for articles and money pages. Directly related to the audit finding that the homepage (34,074 impressions, pos 11.2) outranks the city pages it should be feeding. |
| **Risk level** | **Low.** Additive/corrective; no anchor text, content, title, canonical, or URL changed. Originals backed up to `_seo-backups/blog-content-2026-08-12/`. |
| **Expected result** | Better crawl distribution across blog posts; reduced homepage over-consolidation; improved article-level rankings over 4–8 weeks. |
| **Verification** | 48 unique destination URLs all confirmed HTTP 200 before applying. Post-apply scan: 1 legacy link remaining (unresolvable — target post no longer exists), down from 189. |

### A2. Old-domain (`tncashforhomes.com`) links repointed

| Field | Value |
|---|---|
| **Date** | 2026-08-12 |
| **URLs affected** | 9 blog posts (29 links rewritten) |
| **Files changed** | WordPress post content via REST API |
| **Exact change** | `https://www.tncashforhomes.com/` → `https://tennesseecashforhomes.com/`; `https://www.tncashforhomes.com/post/{slug}` → `https://tennesseecashforhomes.com/{slug}/` |
| **Reason** | Links pointed at the previous domain, which chains `www.tncashforhomes.com` → `tncashforhomes.com` → `tennesseecashforhomes.com` — a 2-hop cross-domain redirect on every click. |
| **Target opportunity** | Removes redirect chains; consolidates equity on the current domain. |
| **Risk level** | **Low.** Corrective, anchor text unchanged. Originals backed up. |
| **Expected result** | Cleaner link graph; marginal crawl-efficiency gain. |
| **Verification** | Post-apply scan: 0 old-domain links remaining, down from 29. |

### A3. Contextual links added from blog posts to commercial pages

| Field | Value |
|---|---|
| **Date** | 2026-08-12 |
| **URLs affected** | 25 blog posts → 12 distinct commercial pages |
| **Files changed** | WordPress post content via REST API |
| **Exact change** | One contextual link added per post by hyperlinking a phrase **already present** in the prose. No new sentences, no content rewritten. 25 links, **25 distinct anchor texts**. |
| **Reason** | Only **2** links to city/county/situation pages existed across all 135 posts. The blog was an unused internal-linking asset. |
| **Target opportunity** | Seller-intent commercial pages, weighted toward the weakest cluster — `/sell-house-as-is-tennessee/` (as-is queries averaged position 40.8 in the audit) — plus foreclosure, probate, inherited, rental, tax/lien, divorce, and five city pages. |
| **Risk level** | **Low.** Additive. Varied natural anchors (`"as-is sale"`, `"pre-foreclosure"`, `"selling a house in probate"`, `"the Nashville market"`, `"cost of living in Clarksville"`) — no exact-match commercial anchors repeated. Originals backed up. |
| **Expected result** | Improved rankings for as-is and situation intent; better equity flow into city pages. |
| **Verification** | Money-page links across the blog: **2 → 27**. Three links spot-checked live and rendering. |

**Link targets and anchors (A3)**

| Post ID | Anchor text | Target |
|---|---|---|
| 1990 | as-is sale | /sell-house-as-is-tennessee/ |
| 2080 | water damage | /sell-house-as-is-tennessee/ |
| 1998 | fire-damaged home | /sell-house-as-is-tennessee/ |
| 2000 | selling a hoarder home | /sell-house-as-is-tennessee/ |
| 1952 | after a failed inspection | /sell-house-as-is-tennessee/ |
| 1954 | unpermitted work | /sell-house-as-is-tennessee/ |
| 2062 | mold problem | /sell-house-as-is-tennessee/ |
| 1958 | pre-foreclosure | /sell-my-house-foreclosure-tennessee/ |
| 2136 | foreclosure process | /sell-my-house-foreclosure-tennessee/ |
| 2020 | behind on mortgage payments | /sell-my-house-foreclosure-tennessee/ |
| 1996 | how foreclosure affects your credit | /sell-my-house-foreclosure-tennessee/ |
| 1962 | inherited property | /sell-inherited-house-tennessee/ |
| 1988 | selling a house in probate | /sell-house-probate-tennessee/ |
| 1970 | problem tenants | /sell-rental-property-tennessee/ |
| 2082 | tenant damage | /sell-rental-property-tennessee/ |
| 2098 | selling a house with a lien | /sell-house-behind-on-taxes-tennessee/ |
| 3084 | delinquent property taxes | /sell-house-behind-on-taxes-tennessee/ |
| 2084 | during a divorce | /sell-my-house-divorce-tennessee/ |
| 3204 | the Nashville market | /where-we-buy/nashville/ |
| 3116 | in Clarksville | /where-we-buy/clarksville/ |
| 3107 | in Columbia | /where-we-buy/columbia/ |
| 2114 | cash home buyers in Murfreesboro | /where-we-buy/murfreesboro/ |
| 3151 | in Spring Hill | /where-we-buy/spring-hill/ |
| 2074 | cost of living in Clarksville | /where-we-buy/clarksville/ |
| 2078 | cost of living in Murfreesboro | /where-we-buy/murfreesboro/ |

---

## 2026-08-12 — Batch B: Theme internal linking (CODE COMMITTED, **NOT YET DEPLOYED**)

> These changes are in the repository and in `_deploy-seo-internal-linking/`.
> They are **not live** — the production theme must be updated manually.

### B1. Footer service-area hub expanded

| Field | Value |
|---|---|
| **Date** | 2026-08-12 |
| **URLs affected** | Sitewide (every page renders the footer) |
| **Files changed** | `tn-cash-for-homes/footer.php` |
| **Exact change** | Added Shelbyville and La Vergne to the "Cities We Buy Houses In" column (10 → 12). Grid changed from 3 to 4 columns with a 2-column tablet breakpoint at 1024px. |
| **Reason** | Shelbyville was explicitly requested and ranks pos 11.3 for "sell my house shelbyville" (451 impressions). La Vergne has 499 impressions and a real page. |
| **Target opportunity** | City-level seller-intent terms in striking distance (pos 8–20). |
| **Risk level** | **Low.** Additive; natural city-name anchors only. |
| **Expected result** | Sitewide equity to 12 city pages. |
| **Verification** | `php -l` clean. All 40 footer link targets confirmed HTTP 200. |

### B2. "Situations We Help With" footer column added

| Field | Value |
|---|---|
| **Date** | 2026-08-12 |
| **URLs affected** | Sitewide |
| **Files changed** | `tn-cash-for-homes/footer.php` |
| **Exact change** | New footer column with 8 links: as-is, inherited, probate, foreclosure, rental, behind on taxes, divorce, relocating. Descriptive anchors (`"Selling a house as-is"`), not exact-match. |
| **Reason** | The nine situation pages had almost no internal links. `/sell-house-as-is-tennessee/` is the single weakest high-intent cluster (avg pos 40.8). |
| **Target opportunity** | "sell my house as is" + situation intent. |
| **Risk level** | **Low.** Additive. |
| **Expected result** | Situation pages gain sitewide equity; as-is cluster improves from pos 40.8. |
| **Verification** | All 8 targets HTTP 200. |

### B3. Situation-template area chips corrected + counties added

| Field | Value |
|---|---|
| **Date** | 2026-08-12 |
| **URLs affected** | 9 situation pages |
| **Files changed** | `tn-cash-for-homes/situation-template.php` |
| **Exact change** | (a) Removed 9 city slugs from the "Areas We Serve" chip list that 301-redirect elsewhere — Antioch, Knoxville, Memphis, Jackson, Chattanooga, Crossville, McMinnville, Old Hickory, Woodbury — and replaced them with 18 cities that have real self-canonical pages. (b) Added a new loop rendering all 12 county chips. |
| **Reason** | The chip list generated ~9 links per page pointing at 301 redirects under a mismatched anchor (a chip labelled "Antioch" led to the Nashville page). That is 81 misleading internal links across the nine situation pages. Counties were entirely absent. |
| **Target opportunity** | County-level terms already at pos 13.9–17.9 (Franklin, Bedford, Moore County), plus cleaner equity flow. |
| **Risk level** | **Low.** Removes redirect hops; adds real links. No content, title, H1, or canonical touched. |
| **Expected result** | County pages un-orphaned from situation pages; no wasted redirect hops. |
| **Verification** | `php -l` clean. All 30 generated slugs (18 cities + 12 counties) confirmed HTTP 200 with **no redirects**. |

---

## Intentionally NOT changed (ranking-risk / requires approval)

| Item | Why it was left alone |
|---|---|
| **`/where-we-buy/tennessee/` title** — renders "We Buy Houses in **Tennessee TN**" | An obvious template artifact, but it sits on a page receiving impressions. Instruction was to preserve titles on ranking pages. **Awaiting approval.** |
| **Antioch city page** | `/where-we-buy/antioch/` already exists as a **301 → /where-we-buy/nashville/**. Building a real page requires removing that redirect and creating a new self-canonical — a redirect + canonical change. **Awaiting approval.** |
| **Jackson / Chattanooga / Knoxville / Memphis** | These are already **301 redirects** to `/where-we-buy/tennessee/` (not thin pages as the June audit indicated — the redirects were added since). Nothing changed. Building real pages requires removing live redirects. **Awaiting approval.** |
| **`/sell-your-house-as-is-tennessee/` (new page)** | **Not created.** `/sell-house-as-is-tennessee/` already exists (2,455 words, correct title/H1/canonical, FAQ). A second page would cannibalize. Strengthened the existing page with links instead. |
| **All titles, meta descriptions, H1s, canonicals, robots rules, URL structure** | Unchanged sitewide, per instruction. |
| **104 Wix-hotlinked images** in blog content | Still served from `static.wixstatic.com`. A migration is worth doing but is a large change touching many posts. **Flagged, not actioned.** |
| **`functions.php` schema fixes** (reviewCount 50→82, streetAddress/postalCode) | Already committed in the repo; **still not deployed**. Included in the deploy notes. |

---

## SEO regression test — 2026-08-12

Baseline captured before any change (27 URLs, raw HTML) and re-captured after.

| Check | Result |
|---|---|
| HTTP status | 27/27 unchanged |
| Title tags | 27/27 identical |
| Canonicals | 27/27 identical |
| Robots meta | 27/27 identical — no accidental `noindex` |
| H1 text and count | 27/27 identical |
| Word count | 0 change on all money pages |
| JSON-LD block count | Unchanged |
| Internal link count | 0 change (theme changes not yet deployed) |
| GA4 `G-ZP0J78KBTE` | Present on all pages |
| GTM `GTM-NNJNRWFR` | Present on all pages |
| Lead forms | Present; submit buttons intact |
| `tel:+16158018126` links | Present |
| **Regressions** | **0** |

Blog posts additionally verified: HTTP 200, self-canonical, single H1, no `noindex`,
GA4 + GTM present, forms and phone links intact.

---

## 2026-08-12 — Batch C: Theme deployment attempt (PUSHED, NOT LIVE)

| Field | Value |
|---|---|
| **Date/time** | 2026-08-12 16:29:04 CDT / 21:29:04 UTC |
| **Commit** | `7b045e7` on `main` (fast-forward from `696978f`) |
| **URLs affected** | Sitewide once deployed; **currently none — not live** |
| **Files changed** | `footer.php`, `location-template.php`, `county-template.php`, `page-where-we-buy.php`, `situation-template.php` (5 files, +151 / −4) |
| **Exact change** | Footer nav hub (12 cities, 12 counties, 8 situations, Explore); 12 county chips added to the city/county/where-we-buy "Areas We Serve" blocks; situation-template city list corrected to 18 self-canonical cities plus 12 county chips. |
| **Reason** | Approved Batch 1 internal-linking deployment. |
| **Risk level** | **Low.** No titles, meta descriptions, H1s, canonicals, redirects, robots rules, or URLs touched — verified by diff scan before push. |
| **Expected result** | 12 county pages un-orphaned; situation pages receive sitewide links; ~81 redirect-hop internal links eliminated. |
| **Status** | ⚠️ **Pushed to `main` but not deployed.** WP Pusher push-to-deploy returns HTTP 400. |

### Deliberately excluded from this deployment

| File | Why held |
|---|---|
| `page-location-tennessee.php` | Contains the state-hub title change (`Tennessee TN` → `Tennessee \| Statewide Cash Home Buyers`). **Explicitly not approved.** Verified unchanged vs `main` before push. |
| `functions.php` | LocalBusiness schema (reviewCount 50→82, streetAddress, postalCode). Held — see Batch D below. |
| `single.php`, `critical.css`, `critical.min.css` | Unrelated to this batch, and `main` already carries the newer versions. Excluded to avoid regressing the `.skip-link` accessibility CSS added in `696978f`. |

### Why the theme is not live

WP Pusher (active plugin, deploys the `tn-cash-for-homes` theme from
`github.com/nationcfh-a11y/Tennessee-Cash-For-Homes`) has three push webhooks
configured. All three fired on this push at 21:29:07 UTC and returned
**HTTP 400 with an empty body**. The same 400 appears on deliveries dating back
to 2026-08-10, so this is a pre-existing breakage, not something this push caused.

Direct GET and POST to the webhook URL (with a GitHub-shaped payload and
`X-GitHub-Event: push`) also return 400. There is no REST endpoint on this host
that writes theme files — `/wp/v2/themes` is read-only, and the
`wp-abilities/v1` roster exposes no file-write ability.

**To finish the deployment:** WP Admin → WP Pusher → Themes → `tn-cash-for-homes`
→ **Update theme**. That pulls `main` at `7b045e7`. Then re-run the
post-deployment checks below.

---

## 2026-08-12 — Batch D: LocalBusiness schema — HELD, conditions not met

Approval was conditional on four tests. Results:

| Condition | Result |
|---|---|
| Review count of 82 is accurate | ⚠️ **Could not verify.** Last owner confirmation was 2026-06-05, two months ago. The real count has likely changed. |
| Address information is accurate | ⚠️ **Could not verify.** The BBB profile (the source used in the June audit for `4183 Franklin Rd, Murfreesboro, TN 37128`) returns HTTP 403 to automated requests. |
| Complies with current Google structured-data requirements | ❌ **Fails.** See below. |
| Schema validates | ✅ Passes structurally — 12 JSON-LD blocks on the homepage, 0 parse errors, `aggregateRating` has `ratingValue`, `reviewCount`, and `bestRating`. |

**The compliance problem is the `aggregateRating` block itself, not the number in it.**
Google's Review snippet guidelines prohibit *self-serving* reviews: a rating about
entity A published on entity A's own website is not eligible for review rich
results on `LocalBusiness` or `Organization`. Production currently emits
`aggregateRating` on the `LocalBusiness` + `RealEstateAgent` graph on the homepage
and on every city page, plus nine standalone `Review` blocks on the homepage.
Changing `reviewCount` from 50 to 82 makes the number more accurate but leaves the
block non-compliant, so the "only if it complies" condition is not satisfied.

**Held. Nothing was deployed.** Production still emits `reviewCount: 50` and a
`PostalAddress` with no `streetAddress` or `postalCode`.

**Recommended for a later batch, once you confirm the facts:**
1. Confirm the current Google review count and the exact street address/ZIP.
2. Deploy the `streetAddress` + `postalCode` addition on its own — it is accurate-once-confirmed, compliant, and strengthens the local entity.
3. Decide separately whether to keep `aggregateRating` on `LocalBusiness`. It is not earning rich results today. The compliant alternative is to keep showing real reviews as visible on-page content without marking them up as `AggregateRating` on the business entity.

---

## Post-deployment verification — 2026-08-12 21:35 UTC

Run against production after the push. Theme items read "pending" because the
theme has not deployed yet.

| # | Check | Result |
|---|---|---|
| 1 | All intended internal links live | ⚠️ Blog links (242) **live**; theme links **pending deploy** |
| 2 | No internal links unexpectedly redirect | ✅ 48 blog targets + 40 footer targets + 30 situation slugs all 200, no redirects |
| 3 | Destination URLs return 200 | ✅ 27/27 |
| 4 | No accidental noindex | ✅ 27/27 unchanged |
| 5 | Canonicals correct | ✅ 27/27 identical to baseline |
| 6 | Titles and H1s unchanged | ✅ 27/27 identical — including the Tennessee state hub, still `We Buy Houses in Tennessee TN \| Get a Fast Cash Offer Today` |
| 7 | Forms work | ✅ Form + submit button counts unchanged sitewide |
| 8 | Phone links work | ✅ `tel:+16158018126` present |
| 9 | GA4 / GTM / tracking present | ✅ `G-ZP0J78KBTE` and `GTM-NNJNRWFR` on every page |
| 10 | Structured data validates | ✅ 0 parse errors; see Batch D for the policy caveat |

**Production drift vs the original pre-change baseline: 0 across 27 URLs.**

Sitemap, mobile nav, desktop nav, footer links, county links and situation-page
links were all re-checked; sitemap holds 302 URLs and is unchanged.
