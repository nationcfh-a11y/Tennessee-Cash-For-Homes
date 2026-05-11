# Schema Markup — What Was Added and What's Already There

**Date:** 2026-04-29
**File modified:** `tn-cash-for-homes/functions.php`

---

## What was already in place (kept as-is)

| Schema | Where it fires | Notes |
|---|---|---|
| `LocalBusiness` + `RealEstateAgent` | Homepage + `/about/`, `/how-it-works/`, `/where-we-buy/`, `/sell-your-land/`, `/investors/`, `/facing-foreclosure/` | Built by `tcfh_build_localbusiness_schema()` — single source of truth |
| `LocalBusiness` (per-city) | Every `page-location-*.php` and county page | Uses the shared builder with localized `areaServed` |
| `LocalBusiness` (per-foreclosure-city) | `foreclosure-template.php` | Localized foreclosure variant |
| `LocalBusiness` (per-situation) | `situation-template.php` | Localized situation variant |
| `FAQPage` | Homepage (top 6) and `/faq/` page (full list) | Built from `tcfh_get_faq_page_items()` so the rendered accordion and JSON-LD never drift |
| `BreadcrumbList` | All interior pages | Auto-detects city / county templates |

---

## What was added today

All additions are in `functions.php` and follow the same naming convention as the existing functions.

### 1. Individual `Review` schema (new function `tcfh_schema_reviews`)

Emits 9 individual `Review` entities on the homepage, sourced from the real customer testimonials in `reviews-section.php`. Each has:
- `author` (Person with name)
- `datePublished`
- `reviewBody` (full review text)
- `reviewRating` (5/5)
- `itemReviewed` (LocalBusiness, Tennessee Cash For Homes)

**Why it matters for AEO:** the existing `aggregateRating` tells search engines you have reviews. Individual `Review` entities tell AI engines what those reviews actually *say*, in the homeowners' own words. ChatGPT/Perplexity/Claude pull these into citations.

**Maintenance note:** If you add or remove customer testimonials in `reviews-section.php`, also update `tcfh_get_reviews()` so the schema stays in sync.

### 2. `Service` schema with `OfferCatalog` (new function `tcfh_schema_service`)

Emits a single `Service` entity on the homepage describing "Cash Home Buying in Tennessee" with:
- Provider (LocalBusiness)
- Area served (State of Tennessee)
- Audience (Tennessee homeowners)
- Free / no-obligation `Offer` ($0)
- A 6-item `OfferCatalog` covering: sell fast for cash, sell as-is, stop foreclosure, sell inherited/probate, sell rental with tenants, sell vacant land

**Why it matters for AEO:** When someone asks ChatGPT "how do I sell my house fast in Tennessee," the answer engine looks for a Service entity that maps "sell house fast" → a provider. This explicitly tells the engine what you do and who you do it for.

### 3. `Person` schema for the team (new function `tcfh_schema_persons`)

Emits 3 `Person` entities on the `/about/` page only:
- **Karson Carmichael** — Founder, Bachelor's in Business Management, Tennessee real estate; sameAs → BBB profile
- **Dowling Armstrong** — Licensed Tennessee real estate agent, 9 years, 1,000+ transactions
- **Davis Armstrong** — Lipscomb University Finance graduate, 6 years, 500+ transactions

Each links to the organization via `worksFor`.

**Why it matters for AEO:** This is the single biggest E-E-A-T (Experience/Expertise/Authoritativeness/Trustworthiness) lever you have. AI engines explicitly look for named, qualified humans behind a business. With this schema, "who runs Tennessee Cash For Homes" becomes a directly answerable question with verifiable people.

---

## What was rewritten today (FAQ content)

`tcfh_get_faq_page_items()` (the dedicated `/faq/` page list) and the homepage FAQ array in `tcfh_schema_faq()` were both updated.

**Homepage FAQ — now 6 questions:**

1. How does selling your house for cash work in Tennessee?
2. How fast can I sell my house in Tennessee?
3. What are the pros and cons of selling to a cash buyer?
4. Is Tennessee Cash For Homes legitimate?
5. What types of homes do you buy?
6. Which areas of Tennessee do you serve?

The first 4 are the exact questions you specified. Answers were rewritten to AEO format:
- **Direct answer in the first sentence** (so it can be quoted as a single citation).
- **Entity-rich:** include "Tennessee," "Murfreesboro," "BBB," named team members, "all 95 Tennessee counties."
- **Numerical specificity:** "7 days," "60–90 days," "5–6%," "24 hours," "1,000+ transactions" — answer engines prefer answers with concrete numbers.
- **Self-disclosing:** the "is X legitimate" answer names every verifiable third-party signal (BBB, A+, Google, Murfreesboro, founding year, named team) — so an AI engine can validate the claim from independent sources.

**`/faq/` page — now 19 questions:** the 4 AEO questions are prepended to the existing 15.

See `03-aeo-faq-content.md` for the full text and a copy-paste-ready JSON-LD block for any non-WordPress channels.

---

## What's *not* in the WordPress build but worth considering later

| Schema type | Use case | Priority |
|---|---|---|
| `RealEstateListing` | If you ever resell rehabbed homes | Low (not your model) |
| `HowTo` | "How to sell your house fast" guide pages | Medium — pair with the blog posts in this folder |
| `VideoObject` | If/when you publish testimonial or process videos to YouTube | Medium |
| `Article` w/ `author` Person | On every blog post, attribute to Karson / Dowling | **High — do this when blog posts go live** |
| `Event` | If you host buyer info sessions | Low |

---

## How to verify the schema is firing correctly

After the WordPress migration goes live:

1. Visit https://search.google.com/test/rich-results and paste your homepage URL. You should see: LocalBusiness, RealEstateAgent, FAQPage, BreadcrumbList, Service, plus 9 Review items.
2. Visit https://validator.schema.org/ and run the same URL — it shouldn't show any errors.
3. Run the `/about/` page through both — you should see LocalBusiness + 3 Person entities.
4. Run a city page (e.g. `/where-we-buy/nashville/`) — you should see a city-localized LocalBusiness.

If anything shows as a warning, paste the warning text back and I'll fix it.
