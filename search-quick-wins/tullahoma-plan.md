# Tullahoma: from position 10.5 to page 1

Page: https://tennesseecashforhomes.com/where-we-buy/tullahoma/
Code: `tn-cash-for-homes/page-location-tullahoma.php` (the text) and `location-template.php` (the layout shared by every city page)

## Where it stands (last 3 months, cleaned)

| Search | Impr | Clicks | Tullahoma page position |
|---|---:|---:|---:|
| sell my house fast tullahoma | 255 | 0 | 9.6 (the homepage also shows, at 20.1) |
| sell my house tullahoma | 221 | 0 | 13.5 |
| sell my house for cash coffee county | 99 | 0 | on this page |
| sell my house fas tullahoma | 59 | 0 | 7.3 |
| cash offer tullahoma | 48 | 0 | on this page |

The page sits at the bottom of page 1 or the top of page 2 with zero clicks. The searches say "sell my house **fast** tullahoma", but the title, H1 and badge say "We Buy Houses" and "Sell Your House For Cash".

## Already done on this branch

**1. Title and description** (item 2). Now:
- Title: "Sell My House Fast in Tullahoma TN | Cash Offer in 24 Hours" (59 characters)
- Description: "Selling a house in Tullahoma or anywhere in Coffee County? Get a fair cash offer in 24 hours, sell as-is, pay no fees, and close on your date." (142 characters)

This helps clicks right away. On its own it won't move the ranking much.

## Change on the page (in order of expected effect)

**2. Make the H1 match the search.** In `page-location-tullahoma.php`:
```php
'h1' => 'Sell Your House Fast in Tullahoma, TN',
```
The current value is "Sell Your House For Cash In Tullahoma, TN". The template also reuses `h1` as the heading of the "About Tullahoma" section, so this one line changes both.

**3. Add proof that only a Tullahoma page could have.** This matters most. Right now the page's "Tullahoma" content is a profile of the city: AEDC, neighborhoods, the PCS cycle. Nothing on it shows you've actually bought there. Add:
- **One or two real Coffee County purchases**: street or area (not the full address), the condition, and days from offer to close. Put it in `desc3`, or a new short "Recent Tullahoma purchase" block. Only use real deals.
- **A Tullahoma or Coffee County review.** The shared reviews section has no local reviews (the only city it mentions is Clarksville). Ask a past Coffee County seller for a Google review that mentions the town, then show it on this page.
- **A real photo** of a house you bought in Tullahoma, or of the area. `image_file => 'Tullahoma.webp'` is set, but the template never uses it, and there's no such file in `brand_assets/`.

**4. Cover the rest of Coffee County.** "sell my house for cash coffee county" already lands on this page, and Manchester (the county seat) has no page of its own. Add a sentence to `desc3`, for example: "We also buy houses in Manchester and Hillsboro in Coffee County, and in Estill Springs, Winchester, and Decherd in Franklin County." Then add this `faq_extra` entry:
```php
['q' => 'Do you buy houses in Manchester and the rest of Coffee County?', 'a' => 'Yes. We buy throughout Coffee County, including Manchester and Hillsboro, plus Estill Springs, Winchester, and Decherd in neighboring Franklin County. Offers are based on local comps and we close on your timeline.'],
```

**5. Add two FAQs that match how people search.**
```php
['q' => 'How fast can I sell my house in Tullahoma?', 'a' => 'You can have a cash offer within 24 hours of a walkthrough and close in as little as 7 days. Most Tullahoma sales close in one to three weeks, depending on how quickly the title company clears the title.'],
['q' => 'How do you calculate a cash offer on a Tullahoma home?', 'a' => 'We start from recent Tullahoma and Coffee County sales of similar homes, subtract the repairs the house needs and our costs to hold and resell it, and show you the numbers. There are no commissions or fees taken out of the offer.'],
```
Before publishing, check that "most close in one to three weeks" matches what you actually do. The site currently says both 7 days and 14 days, so pick one figure (see cannibalization-plan.md).

**6. Market stats: show real numbers or nothing.**
- There is no `tullahoma` entry in `market-stats-data.php`, so the Market Stats block silently doesn't render on this page.
- **Don't fill it with `generate_market_stats.py`.** That script makes up the year-over-year price, sales, days-on-market, population and foreclosure figures with `random.uniform()`.
- If you want the block here, enter real numbers from a dated source, such as your MLS/Realtor contact or Redfin's Tullahoma data page.
- Also check the page's own figures: median $315,000, 85 homes sold, 68 days.

**7. Internal links with better anchor text.** Today every link to this page is a chip that just says "Tullahoma" (homepage, every city page, Where We Buy, Coffee County).
- On the **Coffee County page**, link the Tullahoma mention with the anchor "sell your house fast in Tullahoma".
- In the **PCS / military orders post** (`selling-your-house-fast-on-military-orders-pcs-in-tennessee`), add a sentence linking to this page about AEDC and Arnold Air Force Base moves. It's the most relevant post you have for Tullahoma's biggest seller group.
- **Homepage:** the homepage also shows for "sell my house fast tullahoma" (245 impressions at 20.1), which means Google is splitting the signal. A chip anchor of "Tullahoma" is fine; don't add Tullahoma copy to the homepage.

**8. Google Business Profile.** Make sure Tullahoma and Manchester are in the profile's service areas, and post the Tullahoma purchase from step 3 as a GBP update.

## What to expect

- **Steps 1 and 2:** more clicks at the current position within 2 to 4 weeks.
- **Steps 3 to 5:** these give Google a reason to rank this page above the national "we buy houses" sites. Expect movement over 4 to 8 weeks.
- **Re-measure** with a 28-day Search Console comparison on the domain property. Exclude sweep and GBP-scan days (see search-opportunities.md).

## Doesn't need changing

- **"Read more" toggle:** `desc3` sits behind it. Google still indexes it, and the toggle is shared by every city page, so leave it.
- **Word count:** the page is about 2,300 words, which is enough. More generic copy won't help; local proof will.
