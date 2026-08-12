# SEO Changelog — tennesseecashforhomes.com

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
