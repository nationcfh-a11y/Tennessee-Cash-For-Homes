# Merge plan: blog posts competing with money pages

Nothing has been merged or redirected. This is the plan to approve.

**Updated Nov 3, 2026:** the statewide "sell fast" posts no longer all go to the homepage. One guide stays (`/how-to-sell-your-house-fast-in-tennessee/`, post #2004) and takes the best content from the other two, which 301 to it. See "Statewide sell fast posts" below. All eight posts are still published, and the city page files have not changed since this plan was written. Search Console figures in the table are from Oct 15; the Nov 3 figures are in the README.

**Order for every merge:**
1. Move the listed content into the money page (a theme file edit, deployed).
2. Check the money page is live with the new content.
3. Add the 301 in Tools > Redirection.
4. Update internal links that point at the old post.
5. Remove the post from the blog: trash it, or set it to draft.

Do the 301 on the same day as the content move, never before it.

Search Console figures are the last 3 months, cleaned of bot traffic.

| Post | Impr | Clicks | Pos | Competes with | Recommendation |
|---|---:|---:|---:|---|---|
| sell-my-house-fast-in-nashville-tn-a-guide-for-local-homeowners | 212 | 0 | 16.8 | /where-we-buy/nashville/ (pos 29 to 34 on the same searches) | **Merge, 301 to /where-we-buy/nashville/** |
| sell-your-house-fast-in-spring-hill-tennessee | 288 | 0 | 37.8 | /where-we-buy/spring-hill/ (beats the post on all 3 shared searches) | **Merge, 301 to /where-we-buy/spring-hill/** |
| sell-my-house-fast-in-murfreesboro-tn | 50 | 0 | 10.3 | /where-we-buy/murfreesboro/ (pos 18 to 27) | **Merge, 301 to /where-we-buy/murfreesboro/** |
| how-to-identify-the-top-cash-home-buyers-in-murfreesboro-tn | 2 | 0 | 10 | same | **301 to /where-we-buy/murfreesboro/** (one FAQ worth keeping) |
| sell-my-house-fast-in-columbia-tn-a-guide-for-local-homeowners | 37 | 0 | 9.3 | /where-we-buy/columbia/ (pos 14 to 20; homepage at 9 to 16) | **Merge, 301 to /where-we-buy/columbia/** |
| how-to-sell-your-house-fast-in-tennessee | 334 | 0 | 68.5 | Homepage (pos 8.8 on "sell house fast tennessee") | **Keep as the one statewide guide.** New body from sell-my-house-fast-in-tn, new title |
| sell-my-house-fast-in-tn | 27 | 0 | 72.2 | Homepage | **Move its content into the kept guide, then 301 to the guide** |
| how-to-sell-your-house-fast-in-tennessee-insider-tips-for-a-quick-hassle-free-sale | 32 | 0 | 67.5 | Homepage | **301 to the kept guide**, nothing to move |

**One trade-off to accept:**
- Nashville and Murfreesboro are the only posts that currently rank better than their city page (16.8 vs 29, and 10.3 vs 24.8). Expect a short dip on those few searches after the 301 while Google moves the signals over.
- Both are small: 212 and 50 impressions, with zero clicks. The city pages have 4,673 and 2,482.

**Root cause:** the new-blog workflow published the Nashville (Aug 10), Murfreesboro (Aug 13) and statewide (Oct 2) posts. All three target "sell my house fast [place]" keywords that a money page already owns. See README, item 1, for the rule to add to the workflow.

---

## Nashville: merge into /where-we-buy/nashville/

**Move over** (city data lives in `tn-cash-for-homes/page-location-nashville.php`):

| From the post | Where it goes on the city page |
|---|---|
| Neighborhoods from "Where We Buy Across Nashville": Donelson, Inglewood, Bordeaux, Hermitage, Old Hickory, Whites Creek, Bellevue | `neighborhoods` pills. Consider dropping The Gulch (mostly condos). |
| "Nashville is really several markets wearing one name": new construction and luxury sales pull the median up, so price from your own street's last 90 days | Opening of `desc3` |
| "Why Nashville Houses Sit Longer": FHA/VA appraisal standards, older housing stock, crawl space repair requests after inspection | Two sentences in `desc2` |
| "What 'Fast' Actually Means": fast to contract is not fast to close; a lender adds 30 to 45 days; cash is limited only by title | New `faq_extra`: "Why is a cash sale faster than listing in Nashville?" |
| "Condition is not a filter for us": fire or water damage, 1980s interiors, a house still full of a late relative's things | `desc3` (supports "sell my house as is nashville") |
| The Short Answer's three paths and their trade-offs | New `faq_extra`: "What is the best way to sell a house fast in Nashville?" (targets a 47-impression query) |
| "How to Vet a Cash Buyer": three questions, plus the warning about contract assignment | New `faq_extra` |
| FAQ "What if I still owe money on the mortgage?", including owing more than it is worth | New `faq_extra` |

**Leave behind:**
- The process steps and the fees, repairs and "how much" FAQs (the template already has them).
- The "Common Reasons" list (the Who We Help section covers it).
- The "six offers by Sunday" anecdote and "inventory has recovered substantially" (vague, and will date).
- The jab at out-of-state investors, and the Final Thoughts and CTA sections.

**Verify before reuse:**
- That FHA/VA buyers are "a large share" of Davidson County.
- "Large stock of homes built before 1980."
- "60 to 90 days on market" (the page itself says 52).
- "Title takes two to three weeks."
- "We own property here."

**Fix on the city page while you're in it:**
- The `faq_extra` answer calls Nashville "one of the hottest markets in the Southeast", but `desc2` says inventory is climbing. Rewrite the FAQ.
- `desc1` says the median is $475,000; `median_price` says $480,000.
- Closing speed reads "two weeks" in `desc2` but "7 days" in the template.

---

## Spring Hill: merge into /where-we-buy/spring-hill/

**Move over** (`page-location-spring-hill.php`):

| From the post | Where it goes |
|---|---|
| "Newer builds in the subdivisions off Buckner Lane" | `desc3`, plus a "Buckner Lane" pill (verify the subdivisions first) |
| "An easy commute up I-65 to Franklin and Nashville" | One clause in `desc1` (Spring Hill reaches I-65 by way of Saturn Parkway, so word it accurately) |
| "Builders offering incentives on brand-new inventory" | Add "incentives" to the new-construction sentence in `desc2` |
| "Full of belongings you do not want to move" | Short phrase in `desc3` |
| "What Selling Fast Actually Looks Like": walkthrough (in person or virtual), written no-obligation offer, local title company, you pick the date | New `faq_extra`: "How do I sell my house fast in Spring Hill, TN?", opening with the post's Short Answer. This is the search where the post does best (16.7). |
| "Pricing and What to Expect from an Offer": repairs, carrying costs and margin, offset by no commissions | Replace the current `faq_extra` answer that says offers "reflect this premium market" (it overpromises) |

**Leave behind:** the traditional-listing section, Final Thoughts and CTA, the generic reasons list, the appraisal/financing paragraph (already in `desc2`), the tenants and inherited material (already in Who We Help), "three or four months" (unsourced), and "strong schools" (generic).

**Fix on the city page:**
- `county` is set to Maury only, but Spring Hill straddles Maury and Williamson, so the resources section shows Maury links only.
- Thompson's Station is a separate town, and Duplex Road and Columbia Pike are roads, yet they're used as neighborhood pills. The real subdivisions named in `desc1` (Brixworth, Wades Grove, Harvest Point) are not pills.
- Verify:
  - 549% growth vs "nearly 56,000" (the two numbers don't agree)
  - "85 developed subdivisions"
  - GM's "around 3,200 employees"
  - "different appraisal standards" by county (appraisal standards aren't set by county, so remove this)
  - homes_sold 138

---

## Murfreesboro: merge both posts into /where-we-buy/murfreesboro/

**Move over** (`page-location-murfreesboro.php`). Everything below comes from `sell-my-house-fast-in-murfreesboro-tn` unless noted:

| From the post | Where it goes |
|---|---|
| Short Answer: three options (price below comps, list and wait, sell for cash) | New `faq_extra`: "What is the fastest way to sell my house in Murfreesboro?" (its main search) |
| "Understanding the Murfreesboro Market": east/southeast new construction, the square and MTSU, rural Christiana and Rockvale, student-rental pockets | One sentence in `desc1` or `desc3`. Add Christiana and Rockvale as pills labeled "nearby". |
| "Why Homes Sit Longer": online estimates overvalue homes that need work; FHA/VA buyers have little cash for repairs | One or two sentences in `desc2` |
| "What Fast Actually Means": a financed sale takes 30 to 45 days after contract | `desc2`, or an FAQ comparing timelines |
| "Cash Sale Timeline in Rutherford County": walkthrough, offer, title file, title search sets the date, seller picks the date | New `faq_extra`: "What happens after I accept your offer?" |
| "What Your House Is Worth to a Cash Buyer": ARV minus repairs, holding costs and margin, and "we will show you our numbers" | New `faq_extra` on how the offer is calculated |
| "Mistakes That Slow Down a Murfreesboro Home Sale": unreleased lien from an old refinance, heirs who never transferred the deed, unpermitted garage conversions | New `faq_extra` on title problems and unpermitted work |
| From **how-to-identify-the-top-cash-home-buyers**: "Verify Credentials" and "Are Cash Offers Legitimate?" | New `faq_extra`: "How do I know a Murfreesboro cash buyer is legitimate?" Point to your Murfreesboro BBB profile (the seal is already in the hero) and Google reviews. Supports "cash home buyers murfreesboro". |

**Leave behind:** the old post's iBuyer claim and "the trusted choice across the state", agent vs cash buyer material, Final Thoughts and CTA, and "fastest growing city for two decades" (unsourced).

**Fix on the city page:**
- Closing speed should read one way everywhere, for example "as little as 7 days, most in 1 to 3 weeks". It currently says 7 days, while the posts say 1 to 3 weeks and 1 to 2 weeks.
- Offer speed: "24 hours" vs "24 to 48 hours".
- Verify these unsourced figures: population over 150,000, "5 to 8% annually", "Blackman Farm and Three Rivers outperform", and median $379,900 / 246 sold / 54 days.

---

## Columbia: merge into /where-we-buy/columbia/

**Move over** (`page-location-columbia.php`):

| From the post | Where it goes |
|---|---|
| "A home near the Duck River" and "newer developments along the Spring Hill corridor" | `desc3`; add "Spring Hill corridor" or "North Columbia" as a pill |
| "How to Get a Fair Cash Offer": the offer is based on condition plus recent Maury County sales, ask for proof of funds, compare against your net after repairs and commissions | New `faq_extra`: "How do you calculate a cash offer on a Columbia home?" |
| "Why Choose a Local Cash Home Buyer": no franchise fees, no out-of-state call center, block-by-block values | New `faq_extra`: "Why sell to a local Columbia buyer instead of a national company?" |
| "Walkthrough in person or virtually" and "coordinates with a local title company" | One sentence in `desc2` or `desc3` |
| Downsizing (the one situation the Who We Help cards miss) | Add to the situation list in `desc3` |

**Leave behind:**
- Everything else. About 85% of the post is generic process copy.
- "Pay more for houses than many competitors" (an unprovable competitor claim).
- "Fastest-growing communities in Maury County" (unsourced).
- "Close in one to two weeks" (the page says 7 days).

**Fix on the city page:**
- `desc2` says 66 days on market, but `avg_days` is 56.
- `homes_sold` is 75, but market-stats-data.php says 900.
- Mount Pleasant, Hampshire and Santa Fe are separate Maury County communities, not Columbia neighborhoods. Relabel the pills or swap in real areas.
- Verify "12 percent growth" and "30 percent below Nashville's median".

**Also for Columbia:** about 420 impressions of Columbia seller searches currently land on the homepage. After the merge, link /where-we-buy/columbia/ from the homepage and from related posts, with anchors like "sell my house for cash in Columbia TN".

---

## Statewide "sell fast" posts: keep one guide

**Keep:** `/how-to-sell-your-house-fast-in-tennessee/` (post #2004).
- It has the most impressions of the three (361 in the 90 days to Nov 3), the oldest URL, and 5 internal links.
- Its "how to" slug suits an informational guide, so it doesn't compete head on with the homepage's commercial "sell my house fast Tennessee".

**Its new body:** the content of `sell-my-house-fast-in-tn` (#3601, published Oct 2), the best written of the three. #2004's current 7 generic steps go.
- Keep: the Short Answer, "What Fast Actually Means" (cash 1 to 3 weeks, financed 2 to 4 months), "Why Most Tennessee Sales Take Longer", listing vs cash buyer, "Comparing the Two on Net, Not on Price", "What Reliably Slows a Tennessee Sale Down", "Selling Fast Where You Live" (links to the city pages), and "Situations Where Speed Is Worth Paying For".
- From #1984, add only "Avoiding Common Mistakes That Slow Down a Home Sale", where it adds something #3601 doesn't have.
- Drop: #1984's staging and curb-appeal sections, and its "staged homes sell 88% faster" claim (no source).
- Make closing times match the site: "as little as 7 days, most in 1 to 3 weeks".
- No em or en dashes. Don't set the excerpt.

**New SEO fields** (set with Rank Math's `updateMeta`, as on Nov 1):
- Title: `How to Sell Your House Fast in Tennessee: Cash vs Listing` (57 characters)
- Description: `How long a Tennessee sale really takes, what slows it down, and how a cash sale compares with listing on what you actually net.` (127 characters)

**Then:**
- 301 `/sell-my-house-fast-in-tn/` and `/how-to-sell-your-house-fast-in-tennessee-insider-tips-for-a-quick-hassle-free-sale/` to the kept guide.
- Repoint internal links: 3 posts link to #3601 (#3612, #3625, #3640) and 1 to #1984 (#1944). The 5 posts already linking to #2004 stay as they are.
- Link the kept guide from the homepage FAQ "How fast can I sell…" answer, with the anchor "how to sell your house fast in Tennessee".

**No longer needed:** the homepage content moves from the October plan. The homepage FAQ schema mismatch was fixed on Nov 3 (all 6 schema questions are now visible, with no dashes).

**Also folded into the kept guide (approved Nov 3):** four generic "sell fast" posts with no Search Console impressions in the 90 days to Nov 3. Each 301s to the kept guide, and anything useful it has that the guide lacks moves in.

| Post | Words | Linked from | Unique content worth keeping |
|---|---:|---|---|
| #1994 `how-to-sell-a-home-in-tennessee-fast-tips-for-2025` | 960 | none | none (pricing, curb appeal and staging tips the guide drops on purpose) |
| #2034 `navigating-the-tennessee-real-estate-market-a-guide-to-selling-your-home-fast` | 650 | #1994 | none |
| #2134 `how-to-sell-your-house-fast` | 371 | none | none |
| #2138 `sell-your-house-fast-for-cash-a-step-by-step-guide-for-success` | 756 | #1996, #2026, #2104, #2108, #2122, #2130 | the cash-buyer scam warning, folded into the guide's "how to vet a cash buyer" checklist |

The 6 posts linking to #2138 get their links repointed to the kept guide.

## After the merges

- Update internal links that point at the eight post URLs. They'll still work through the 301, but direct links are cleaner. The Redirection plugin's 404 log and Rank Math's Link Counter will show where they are.
- Recheck the merged pages in Search Console 4 to 6 weeks later.
