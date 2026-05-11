# Online Presence Audit — Tennessee Cash For Homes

**Date:** 2026-04-29
**Scope:** Where is Tennessee Cash For Homes visible to AI engines today, and where are the gaps?

---

## TL;DR

You have a **strong foundation** but a **stale live site** and **gaps in third-party citations** that AI engines weight heavily.

| Asset | Status | AEO Impact |
|---|---|---|
| Live website (tennesseecashforhomes.com) | Still on Wix | High — minimal schema, missing FAQ/Review/Service entities |
| WordPress staging (nationcfh.wpcomstaging.com) | Built, not live | High — has full schema once it goes live |
| Google Business Profile | Indexed via search but profile not directly accessible | High — verify ownership and optimize |
| BBB profile | Live, A+, Accredited 2/26/2026 | High — already cited as `sameAs` in schema |
| Facebook | Live (page id 61557645432215) | Medium — already linked |
| Yahoo Local | Live (Murfreesboro listing) | Medium — confirm NAP accuracy |
| Yelp | Not found | Medium — gap |
| Trustpilot | Not found | Medium — gap |
| Houzeo / HomeLight / iBuyer / Clever | Listed in third-party "best of TN cash buyers" articles | Medium — none have your business directly profiled |
| YouTube / Instagram / TikTok | Linked from schema, but content depth unverified | Low/Medium |

---

## 1. Live website (tennesseecashforhomes.com)

**Status:** Currently served by **Wix**. Returns HTTP 301 from the apex to the `www.` host, then HTTP 200.

### Live schema actually being served
Only **2** JSON-LD blocks:

```json
{
  "@context": "https://schema.org/",
  "@type": "LocalBusiness",
  "name": "Tennessee Cash For Homes",
  "url": "https://www.tennesseecashforhomes.com",
  "image": "https://static.wixstatic.com/...",
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "US",
    "addressLocality": "Nashville",
    "addressRegion": "TN"
  },
  "telephone": "(615) 801-8126"
}
```
plus a minimal `WebSite` block.

### Problems with the live (Wix) schema
- ❌ City says **Nashville** but you operate from **Murfreesboro** (4183 Franklin Rd, 37128). NAP inconsistency hurts AI trust.
- ❌ No `aggregateRating`, no `review`, no `sameAs` (BBB / social), no `openingHours`, no `geo`.
- ❌ No `FAQPage` schema → AI engines have nothing to pull from for question-answering.
- ❌ No `Service` or `Product` entity describing what you sell.

### What the WordPress build (nationcfh.wpcomstaging.com) already has — much better
- ✅ `LocalBusiness` + `RealEstateAgent` with full address (Murfreesboro), telephone, geo coordinates, opening hours, `sameAs` linking BBB/Facebook/Instagram/YouTube/TikTok, `aggregateRating` (5.0 / 50 reviews).
- ✅ `FAQPage` schema on homepage (now expanded to the 4 AEO questions you requested) and `/faq/` page (now 19 questions).
- ✅ `BreadcrumbList` on every interior page.
- ✅ `LocalBusiness` re-emitted on every city, county, foreclosure, and situation page (with `areaServed` localized).
- ✅ **(Just added)** Individual `Review` entities for 9 named customers.
- ✅ **(Just added)** `Service` entity for "Cash Home Buying in Tennessee" with an `OfferCatalog` of sub-services.
- ✅ **(Just added)** `Person` entities on `/about/` for Karson Carmichael, Dowling Armstrong, and Davis Armstrong.

**The single most impactful AEO action you can take right now is finishing the WordPress migration** so the new schema replaces the Wix schema on `tennesseecashforhomes.com`.

---

## 2. Google Business Profile (GBP)

**Status:** Search results confirm you appear on Yahoo Local with the address `4183 Franklin Rd, Murfreesboro, TN 37128`, but I cannot directly read your GBP without your login. Action items:

- [ ] **Confirm GBP ownership** — log in at business.google.com and verify the listing is claimed.
- [ ] **NAP must match the BBB / website / Yahoo** exactly. Pick one address and use the identical formatting everywhere (the BBB has Murfreesboro; the Wix schema currently says Nashville — fix that).
- [ ] **Categories:** Primary = "Real Estate Investing Service" or "Real Estate Agency". Secondary = "We Buy Houses" if available, "Cash Home Buyer".
- [ ] **Service area:** Add all of Tennessee (or your top 30+ cities) so you appear in `near me` queries statewide.
- [ ] **Q&A section:** Pre-seed the 4 AEO questions ("How does selling your house for cash work in Tennessee?", etc.) with your own answer. AI engines and Google scrape this section.
- [ ] **Posts:** Publish at least 1 GBP post/week — these get indexed and feed into AI overviews.
- [ ] **Photos:** Upload the team photos and at least 10 sold-home before/after photos. AI image-grounding favors businesses with abundant verified imagery.
- [ ] **Review responses:** Reply to 100% of reviews, mentioning the city ("Thanks Nathan, glad we could help with your Murfreesboro home!") to feed location-relevance signals.

---

## 3. Third-party mentions found in the wild

Search confirmed the following independent citations exist:

| Source | URL | Notes |
|---|---|---|
| BBB | https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815 | A+, Accredited 2/26/2026, 8 yrs in business |
| Yahoo Local | https://local.yahoo.com/info-237540340-carmichael-karson-tennessee-cash-for-homes-murfreesboro | Listed under owner name |
| Facebook | https://www.facebook.com/61557645432215/ | Active page |
| ListWithClever (top-10 article) | https://listwithclever.com/cash-home-buyers/tennessee/murfreesboro/ | Mentioned in roundup |
| HomeLight (best-of article) | https://www.homelight.com/blog/we-buy-houses-tennessee/ | Tennessee roundup, you may or may not be named |
| iBuyer.com (top-7 article) | https://ibuyer.com/blog/cash-home-buyers-tennessee/ | Tennessee roundup |
| Houzeo (rankings article) | https://www.houzeo.com/blog/companies-that-buy-houses-for-cash-in-tennessee/ | Tennessee roundup |
| RealEstateBees | https://realestatebees.com/sell/home/investors/murfreesboro-tn/ | Murfreesboro roundup |

**Gap analysis:**
- ❌ No Yelp profile detected.
- ❌ No Trustpilot profile detected.
- ❌ Not directly profiled on Houzeo / HomeLight / iBuyer / Clever — only mentioned in roundups.
- ❌ No news mentions, no podcast appearances, no guest blog posts.
- ❌ No backlinks from Tennessee government, Tennessee REIA (real estate investor association), or Tennessee homeowner-help nonprofits.

These third-party citations and link-backs are precisely what AI engines weight to decide whether to cite a business as authoritative. See `04-directories.md` for the prioritized list of where to get listed.

---

## 4. Cross-source NAP audit

| Source | Name | Address | Phone |
|---|---|---|---|
| Wix live site schema | Tennessee Cash For Homes | Nashville, TN | (615) 801-8126 |
| BBB | Tennessee Cash For Homes | Murfreesboro, TN | — |
| Yahoo Local | Tennessee Cash For Homes (owner: Karson Carmichael) | 4183 Franklin Rd, Murfreesboro, TN 37128 | — |
| WP about page schema | Tennessee Cash For Homes | Murfreesboro, TN | +1-615-801-8126 |
| WP `tcfh_build_localbusiness_schema()` | Tennessee Cash For Homes | Murfreesboro, TN | +1-615-801-8126 |

**Action:** The Wix schema saying Nashville is the only outlier. It will resolve itself once the WordPress migration goes live. In the meantime, **fix it on Wix** (Settings → Business Info) so the live site stops contradicting BBB and Yahoo. Inconsistent NAP is a major AEO trust hit.

Also note: the team page says Karson **relocated** from Murfreesboro to Spring Hill. If you want Spring Hill mentioned in the GBP service area or about copy, add it — but **do not** change the registered business address until you've updated BBB and the Tennessee Secretary of State, or you'll re-introduce NAP inconsistency.

---

## 5. Content E-E-A-T signals already in place (good news)

- ✅ Founder is **named** with a photo and bio (Karson Carmichael)
- ✅ Two additional team members **named** with photos, bios, credentials (degrees, transaction counts, years of experience)
- ✅ BBB Accredited badge with link
- ✅ Real customer reviews displayed with full names
- ✅ Founding date stated (2017)
- ✅ "Christian-based, family-owned" trust language

See `06-eeat-recommendations.md` for what's still missing and how to strengthen it.
