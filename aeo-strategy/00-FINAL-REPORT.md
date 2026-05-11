# Tennessee Cash For Homes — AEO/GEO Strategy: Final Report

**Date:** 2026-04-29
**Prepared for:** Karson Carmichael
**Scope:** Full audit + implementation of an Answer Engine Optimization / Generative Engine Optimization strategy so Tennessee Cash For Homes is more likely to be cited by ChatGPT, Claude, Perplexity, Google AI Overviews, and similar engines for queries like *"who buys houses for cash in Tennessee"* and *"how do I sell my house fast in Nashville."*

---

## Executive summary

You started this project in a stronger position than most cash-buying companies: you have a real BBB Accreditation, real Google reviews from named sellers, a named team with verifiable credentials, and a WordPress build with significant schema infrastructure already in place. The main gaps are:

1. **The live website is still on Wix**, serving minimal schema with the wrong city. Migrating to WordPress is the single biggest AEO improvement available — and the WordPress build is already finished.
2. **Authoritativeness** is the weakest E-E-A-T pillar. You're mentioned in third-party roundups but not directly profiled on Yelp, Trustpilot, BiggerPockets, or industry directories. No news mentions, no podcast appearances, no .gov/.edu backlinks.
3. **Schema is good** and was made better today (added Review, Service, and Person schema). FAQ content was rewritten with the 4 priority AEO questions you specified.
4. **Content for AI citation** — the 3 long-form blog posts in this folder are written to be cited as sources, not to chase Google rankings. They need to be uploaded to WordPress as posts.

This report tells you exactly what was done, what's left, and the priority order for tackling the remaining items.

---

## What was completed today

### ✅ 1. Online presence audit — see [`01-online-presence-audit.md`](./01-online-presence-audit.md)
- Mapped every online surface where Tennessee Cash For Homes is currently visible
- Identified the Wix → WordPress schema gap as the #1 issue
- Cross-checked NAP across BBB, Yahoo Local, Wix schema, WordPress schema (one outlier: Wix says Nashville, everywhere else says Murfreesboro)
- Confirmed BBB profile is live and Accredited as of 2/26/2026

### ✅ 2. Schema markup — see [`02-schema-changes.md`](./02-schema-changes.md)

**Already in place (kept as-is):**
- LocalBusiness + RealEstateAgent (homepage + interior pages)
- FAQPage (homepage + /faq/)
- BreadcrumbList (all interior pages)
- LocalBusiness on every city, county, foreclosure, and situation page

**Added today** (in [`tn-cash-for-homes/functions.php`](../tn-cash-for-homes/functions.php)):
- **Review schema** — 9 individual customer reviews now expose review bodies, dates, ratings, authors as structured data on the homepage
- **Service schema** — describes "Cash Home Buying in Tennessee" with a 6-item OfferCatalog (sell fast, sell as-is, stop foreclosure, sell inherited, sell rental w/ tenants, sell land)
- **Person schema** — Karson Carmichael, Dowling Armstrong, Davis Armstrong on the about page with full credentials

### ✅ 3. AEO-optimized FAQ content — see [`03-aeo-faq-content.md`](./03-aeo-faq-content.md)
The 4 specific questions you asked for (cash sale process, speed, pros/cons, legitimacy) were:
- Rewritten in AEO format (direct first-sentence answer, entity-rich, specific numbers, self-grounding citations)
- Added to the homepage FAQ (now 6 questions, was 6 different ones)
- Prepended to the dedicated /faq/ page (now 19 questions, was 15)
- Provided as a copy-paste-ready standalone JSON-LD block for use elsewhere (GBP Q&A, landing pages)

### ✅ 4. Top 10 directories — see [`04-directories.md`](./04-directories.md)
Prioritized list with submission steps for: Google Business Profile, BBB (already done), Yelp, Trustpilot, Bing Places, Apple Business Connect, Facebook (audit), industry directories (Houzeo/HomeLight/Sundae/iBuyer/Clever/RealEstateBees), Tennessee Chamber/REIA/BiggerPockets, and niche "we buy houses" aggregators.

### ✅ 5. Three authoritative blog posts — see folder
- [`05-blog-post-1-how-cash-sale-works-tennessee.md`](./05-blog-post-1-how-cash-sale-works-tennessee.md) — *How Selling Your House for Cash Works in Tennessee* (~1,750 words)
- [`05-blog-post-2-pros-cons-cash-buyer-tennessee.md`](./05-blog-post-2-pros-cons-cash-buyer-tennessee.md) — *The Real Pros and Cons of Selling Your House to a Cash Buyer in Tennessee* (~1,650 words)
- [`05-blog-post-3-how-to-spot-legitimate-cash-buyer-tennessee.md`](./05-blog-post-3-how-to-spot-legitimate-cash-buyer-tennessee.md) — *How to Spot a Legitimate Cash Home Buyer in Tennessee — A Verification Checklist* (~1,800 words)

These are intentionally long, cite sources, name competitors' tactics honestly, and include verifiable specifics — all the things AI engines look for when deciding what to cite.

### ✅ 6. E-E-A-T audit — see [`06-eeat-recommendations.md`](./06-eeat-recommendations.md)
Scored each pillar (Experience 7/10, Expertise 8/10, Authoritativeness 5/10, Trustworthiness 8/10), with prioritized recommendations to close the Authoritativeness gap.

---

## What still needs to be done — manual, in priority order

### 🔴 Priority 0 — Blockers (must happen for any of this to matter)

#### 0.1 — Finish the WordPress migration (already in progress per the prior SEO audit)
The most important single action. The schema work I did today only takes effect once `tennesseecashforhomes.com` points to the WordPress site instead of Wix. Pre-migration blockers from `seo-audit/REPORT.md`:
- [ ] Disable "Discourage search engines" in WP Settings → Reading
- [ ] Add 26 missing 301 redirects (see `seo-audit/missing_redirects.csv`)
- [ ] Fix 109 internal 404 links in `/where-we-buy/`
- [ ] **Then** flip the domain DNS

**Estimated effort:** 4–8 hours of manual WordPress admin work. **Until this happens, AI engines see the inferior Wix schema.**

#### 0.2 — Verify the new schema doesn't break anything
After deploying the `functions.php` changes from today:
- [ ] Visit a staging URL and view source — confirm no PHP errors and JSON-LD blocks render
- [ ] Run https://search.google.com/test/rich-results on homepage and `/about/` — confirm no errors
- [ ] If anything breaks, the safe rollback is `git checkout` the changes to `functions.php`

---

### 🔴 Priority 1 — Highest-leverage manual work (next 14 days)

#### 1.1 — Google Business Profile claim & optimization
See [`04-directories.md`](./04-directories.md) §1. **30 minutes.** This is the single highest-ROI manual task in the entire plan.
- [ ] Claim the listing
- [ ] Set primary category, service area (20+ TN cities), services
- [ ] Upload 25+ photos
- [ ] Pre-seed Q&A with the 6 priority FAQs
- [ ] Set up a recurring weekly GBP post

#### 1.2 — Fix the Wix homepage schema (until migration completes)
The Wix site currently says your city is **Nashville**. Until the WP site goes live, fix this in Wix Settings → Business Info to say **Murfreesboro**. **15 minutes.** NAP inconsistency hurts AEO trust.

#### 1.3 — Fix the "9+ years" vs Karson's "3 years" inconsistency on about page
See [`06-eeat-recommendations.md`](./06-eeat-recommendations.md) §3A. Suggested rewrite: *"Tennessee Cash For Homes has bought houses across Tennessee since 2017. Our combined team brings over 17 years of Tennessee real estate experience and 1,500+ transactions."* **15 minutes.**

#### 1.4 — Publish the 3 blog posts as WordPress posts
Convert each `.md` file in this folder to a WordPress blog post. Set the author to Karson (or appropriate team member). **1 hour.**

When publishing:
- Add an `Article` schema block with `author` referencing the Person schema we just added
- Use the suggested URL slug listed at the top of each post
- Set the meta title and meta description from the post header
- Add 1 featured image per post
- Internal-link each post to: `/about/`, `/faq/`, the most relevant `/where-we-buy/{city}/` page, and to the other 2 blog posts

#### 1.5 — Submit to Yelp + Trustpilot + Bing Places + Apple Business Connect
See [`04-directories.md`](./04-directories.md) §3–6. **2 hours total.**

---

### 🟡 Priority 2 — Authority building (next 60 days)

#### 2.1 — HARO / Connectively
Sign up at https://connectively.us/ and respond to 2–3 journalist queries per week related to Tennessee real estate, foreclosure, probate sales, or housing trends. **30 min/week ongoing.** First news mention typically lands within 30–60 days.

#### 2.2 — BiggerPockets profile
Create profiles for Karson and Dowling at https://www.biggerpockets.com. Add company link. Engage in 1–2 forum threads per week. **30 min/week ongoing.**

#### 2.3 — Industry directory submissions
Apply to the niche directories in [`04-directories.md`](./04-directories.md) §8 (Houzeo, HomeLight, Sundae, iBuyer, Clever, RealEstateBees). **1 hour/directory.**

#### 2.4 — Solicit longer Google reviews
Ask 5 past sellers for ≥ 100-word reviews using the prompt: *"What was the situation, what was your timeline, and how did the process compare to what you expected?"* See [`06-eeat-recommendations.md`](./06-eeat-recommendations.md) §2A. **Ongoing — 1 ask per closed deal.**

#### 2.5 — Tennessee Chamber + REIA memberships
Apply for membership in the Murfreesboro/Rutherford Chamber, Tennessee Chamber, and Tennessee REIA. **2 hours total.** Annual fees range $200–$800 each.

---

### 🟡 Priority 3 — Authority expansion (next 90–180 days)

#### 3.1 — Local news outreach
Pitch local Tennessee real estate journalists with a data-driven angle from your closed deals. Target: Nashville Business Journal, The Tennessean, Memphis Business Journal, WPLN. **2 hours/month.** First placement typically within 90 days of consistent outreach.

#### 3.2 — Podcast guest appearances
Pitch 5 real estate podcasts (BiggerPockets, Best Ever, REtipster, regional TN shows). **1 hour/pitch, 1 placement per 5 pitches.** Typically 1 successful appearance per quarter.

#### 3.3 — Case study production
Pick 1 closed deal where the seller will consent to a written case study (and ideally a 90-second video). Publish on your site, on YouTube, on LinkedIn. See [`06-eeat-recommendations.md`](./06-eeat-recommendations.md) §2B. **3–5 hours per case study, 1 per quarter.**

#### 3.4 — Video testimonials
Record 3 video testimonials from happy sellers. Publish to YouTube, embed on homepage, transcribe and add `VideoObject` schema. **1 day of filming + edit time.**

#### 3.5 — `.gov` / `.org` backlinks
Apply to be a "trusted vendor" or financial-hardship resource for THDA, local United Way chapters, etc. See [`06-eeat-recommendations.md`](./06-eeat-recommendations.md) §1C. **Long-cycle work.**

---

### 🟢 Priority 4 — Maintenance & monitoring

#### 4.1 — Quarterly schema audit
Once a quarter, run https://validator.schema.org/ on:
- Homepage
- `/about/`
- `/faq/`
- 1 random city page
- 1 random foreclosure page

Fix any new warnings.

#### 4.2 — Citation audit (every 6 months)
Search `"Tennessee Cash For Homes" "(615) 801-8126"` and count distinct domains. Confirm NAP consistency on every result. The list should grow over time as you add directories.

#### 4.3 — Monitor AI mentions
Once a quarter, ask each major AI engine the 4 priority questions:
- "Who buys houses for cash in Tennessee?"
- "How do I sell my house fast in Nashville?"
- "Is Tennessee Cash For Homes legitimate?"
- "What are the pros and cons of selling to a cash buyer in Tennessee?"

Track which engines mention you and in what context. As authority signals accumulate, you should appear in more answers over time.

---

## Realistic timeline expectations

You called out in the prompt that AEO is a longer game than SEO. That's right.

| Time horizon | What to expect |
|---|---|
| 30 days | Schema fixes are live, GBP is optimized, FAQ content is in place. AI engines start re-crawling. No measurable change in citation rate yet. |
| 60–90 days | Directory submissions are processed. First HARO placements land. Long-form blog posts get indexed. You may start seeing Tennessee-specific queries cite your content occasionally. |
| 120–180 days | Cumulative authority signals (BBB, Trustpilot, Yelp, BiggerPockets, news mentions, podcast appearances) reach critical mass. You should now be cited by ChatGPT/Perplexity/Claude for general "Tennessee cash home buyer" queries. |
| 180–365 days | If consistent, you become one of the default-cited Tennessee cash buyers in AI answers. The work moves from "build" to "maintain." |

The single most important driver: **consistency of authority-building over months, not bursts of activity.** A homeowner asking ChatGPT "is Tennessee Cash For Homes legitimate?" gets a confident citation only after the AI has seen the company referenced positively across BBB, Google, Yelp, Trustpilot, news mentions, podcasts, and industry directories — not just on its own website.

---

## Files in this folder

| File | Purpose |
|---|---|
| [`00-FINAL-REPORT.md`](./00-FINAL-REPORT.md) | This document |
| [`01-online-presence-audit.md`](./01-online-presence-audit.md) | Audit of current online visibility |
| [`02-schema-changes.md`](./02-schema-changes.md) | What schema was added today + what was already there |
| [`03-aeo-faq-content.md`](./03-aeo-faq-content.md) | The 4 priority FAQ questions + standalone JSON-LD |
| [`04-directories.md`](./04-directories.md) | Top 10 directories with submission instructions |
| [`05-blog-post-1-how-cash-sale-works-tennessee.md`](./05-blog-post-1-how-cash-sale-works-tennessee.md) | Blog post 1 |
| [`05-blog-post-2-pros-cons-cash-buyer-tennessee.md`](./05-blog-post-2-pros-cons-cash-buyer-tennessee.md) | Blog post 2 |
| [`05-blog-post-3-how-to-spot-legitimate-cash-buyer-tennessee.md`](./05-blog-post-3-how-to-spot-legitimate-cash-buyer-tennessee.md) | Blog post 3 |
| [`06-eeat-recommendations.md`](./06-eeat-recommendations.md) | E-E-A-T scoring + recommendations |

---

## Next 7 days — concrete checklist

If you want a 7-day sprint, in order:

- [ ] **Day 1:** Verify schema changes don't break the WP site. Fix Wix NAP (Nashville → Murfreesboro). Fix the about page "9+ years" inconsistency.
- [ ] **Day 2:** Claim/optimize Google Business Profile fully. Pre-seed all 6 FAQ questions.
- [ ] **Day 3:** Upload all 3 blog posts to WordPress with `Article` schema and proper authors. Internal-link them.
- [ ] **Day 4:** Set up Yelp, Trustpilot, Bing Places, Apple Business Connect.
- [ ] **Day 5:** Sign up for HARO/Connectively. Respond to 3 queries.
- [ ] **Day 6:** Create BiggerPockets profile for Karson + Dowling. Submit profile to Houzeo, HomeLight, iBuyer.
- [ ] **Day 7:** Audit. Confirm everything from days 1–6 is live and rendering correctly. Make a list of anything that needs follow-up.

After this 7-day sprint, switch to ongoing weekly discipline (HARO 3x/week, BiggerPockets 2x/week, GBP post 1x/week, Google review request after every closed deal).

---

*Prepared by Claude Code on 2026-04-29. Schema changes are live in `tn-cash-for-homes/functions.php`. Recommend running the WP site through https://validator.schema.org/ before pushing to production.*
