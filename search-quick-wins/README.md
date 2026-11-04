# Search quick wins (branch: search-quick-wins)

Prepared Oct 15, 2026 from `search-opportunities.md`. Nothing has been deployed, merged, or changed on the live site. Every action below needs your approval.

## Status on Nov 3, 2026

| Item | Status |
|---|---|
| 1. Blog title/description fallback (`functions.php`) | **Not live.** Merged onto today's main (no other changes to main's code) and retested on all 152 posts: titles 26 to 60 characters, descriptions 92 to 155, no dashes. It now also turns any en or em dash in a post's opening paragraph into a comma. |
| 2. Six blog titles and descriptions | **Done.** Five are live as planned. The mortgage post has a newer title from the Nov 1 blog upgrade, which stays. |
| 2. Tullahoma title and description | **Not live.** It ships with the theme deploy. |
| 3. Dated-URL redirects (104) | **Not imported.** All 104 rechecked today: each old URL is still a 404, and each target returns 200. Rows 24 and 85 now point at the final destinations instead of posts being retired. |
| 4. Merges | **None done.** All 8 posts are still published. Statewide plan changed: one guide is kept, and four more zero-impression "sell fast" posts 301 into it (see `cannibalization-plan.md`). |
| 5. Tullahoma on-page plan | **Not started.** It needs real local deals and numbers from you. |
| Homepage FAQ schema mismatch | **Fixed on Nov 3** by the homepage work. |

## What's on this branch

| File | What it is | Goes live by |
|---|---|---|
| `tn-cash-for-homes/functions.php` | Blog title/description fallback (item 1) | Theme deploy |
| `tn-cash-for-homes/page-location-tullahoma.php` | New Tullahoma title and description (item 2) | Theme deploy |
| `search-quick-wins/meta-paste-list.md` | The six blog titles/descriptions to paste into Rank Math (item 2) | You, in WP admin |
| `search-quick-wins/apply_rank_math_meta.py` + `seo-meta.json` | The same six, as a script (dry run unless `--apply`) | You, when you run it |
| `search-quick-wins/redirects-dated-urls.csv` | 104 dated-URL 301s for the Redirection plugin (item 3) | You, via import |
| `search-quick-wins/cannibalization-plan.md` | Merge plan for 8 posts (item 4) | Nothing changes until you approve each merge |
| `search-quick-wins/tullahoma-plan.md` | On-page plan for Tullahoma (item 5) | Nothing changes until you approve |

## Approvals needed

1. **Deploy the theme** (`functions.php` and `page-location-tullahoma.php`). This turns on the blog fallback and the new Tullahoma title and description.
2. **Apply the six blog titles and descriptions:** paste them by hand, or run the script with `--apply`.
3. **Import the redirect CSV** into Tools > Redirection.
4. **Change the blog workflow** so new posts get hand-written SEO fields (item 1, below). I couldn't make this change myself.
5. **Approve each merge** in `cannibalization-plan.md`, one at a time.
6. **Approve the Tullahoma on-page changes** in `tullahoma-plan.md`. Steps 3 and 6 need real local deals and real numbers from you.

---

## Item 1: where the cut-off descriptions and long titles come from

**The source is Rank Math's global templates. Nothing ever fills in the per-post fields.**
- On blog posts, Rank Math prints the `<title>` and the meta description.
- With no per-post fields set, it falls back to its Titles & Meta > Posts templates:
  - **Title:** `%title% %sep% %sitename%`. This produces "[100-character post title] - Tennessee Cash For Homes".
  - **Description:** the auto excerpt, which is the first ~160 characters of the body. Every post body starts with "Short Answer:", so that's what Google shows, cut off mid-sentence.
- The posts are published through the WordPress REST API. On this site that API **can't** write Rank Math's `rank_math_title` and `rank_math_description` fields (tested Oct 2), so no post has ever had them.
- The theme isn't the cause. Its `tcfh_seo_meta_tags()` only prints duplicate og/twitter title tags on posts, never the description.

**What I changed (`functions.php`, after `tcfh_seo_meta_tags`):** two filters on Rank Math's output, used only on blog posts and only when the post has no hand-written field.
- **Title:** if Rank Math's title is over 60 characters, use the post title instead. If that's still too long, use the part before the colon. Failing that, swap "Tennessee" for "TN". As a last resort, cut on a word boundary.
- **Description:** take the first real paragraph, drop the "Short Answer:" label, and keep whole sentences up to 155 characters. If whole sentences come out under 100 characters, fill to the limit and end with "...".
- **Hand-written fields always win.** Anything set in the Rank Math editor or by the script is left alone.
- **Tested locally on 29 real posts and drafts:** every title came out at 60 characters or fewer, and every description between 100 and 155.

**Rank Math setting you have to change: none.** Leave Titles & Meta > Posts as it is. The fallback works by rewriting the title and description Rank Math prints, so emptying those templates could stop the tags from printing at all.

**The blog workflow: you need to make this change.**
- The `new-blog` skill my notes mention isn't on this Mac anymore. The n8n connector needs authorization I don't have in this session, so I couldn't open or edit the workflow.
- The theme fallback above keeps future posts within limits even if the workflow never changes. Its descriptions are good, but a hand-written one is better.
- Add this step after the post is created:

```
After the post is created (you have its ID), set the SEO fields with Rank Math's own route.
Core /wp/v2 REST cannot write them on this site.

POST {WP_URL}/wp-json/rankmath/v1/updateMeta   (Basic auth: WP_USERNAME + WP_APP_PASSWORD)
{
  "objectType": "post",
  "objectID": <post id>,
  "meta": {
    "rank_math_title": "<SEO title>",
    "rank_math_description": "<meta description>"
  }
}

Rules:
- SEO title: 60 characters or fewer, the searcher's phrase first, no " - Tennessee Cash For Homes" suffix.
- Description: 155 characters or fewer, whole sentences, written for the click, not copied from "Short Answer:".
- No em dashes or en dashes in either.
- Never set the WordPress excerpt (it renders as a subtitle under the title on this theme).
- Do not create a post whose main keyword is "sell my house fast [city]" or "we buy houses [city]" when
  /where-we-buy/[city]/ exists. Those belong on the city page. (The Nashville, Murfreesboro, and
  statewide posts in cannibalization-plan.md all came from this workflow.)
```

---

## Item 2: the seven titles and descriptions

- **Tullahoma** is set in theme code on this branch and goes live with the theme deploy.
- **The six blog posts** are Rank Math post meta. Apply them **one** of two ways:
  - **Paste by hand** from `meta-paste-list.md`. It has the edit links, takes about 2 minutes per post, and needs no deploy.
  - **Run the script:**
    ```
    python3 search-quick-wins/apply_rank_math_meta.py                  # dry run: shows live vs new for all six
    python3 search-quick-wins/apply_rank_math_meta.py --only how-long-does-it-take-to-sell-a-house-in-tennessee --apply
    python3 search-quick-wins/apply_rank_math_meta.py --apply          # the rest, once the first one looks right
    python3 search-quick-wins/apply_rank_math_meta.py --revert --apply # undo: clears the fields again
    ```
- **What the script does:**
  - Before writing, it checks the length limits, checks for dashes, and confirms each post ID still has the expected slug.
  - It writes through Rank Math's `/rankmath/v1/updateMeta` route, the same one the editor sidebar uses.
  - After each write, it re-reads the live page to confirm.
- **What I've tested:** the dry run, which only reads, worked against the live site. The `--apply` write has **not** been run, because that would change the site. Run it on one post first.

## Item 3: dated URLs (`redirects-dated-urls.csv`)

- **104 rows.** They come from every old `/YYYY/MM/DD/slug/` permalink in `redirects.csv` (the migration map) plus every dated URL in the 3-month and 16-month Search Console data.
- **All 104 verified live today:** each old URL returns 404, and each target returns 200.
- **Sorted by clicks, then impressions.** The one still earning clicks is first: `/2025/05/13/what-happens-when-you-inherit-a-house-with-a-mortgage-in-tennessee/` (2 clicks, 27 impressions). 15 rows had any Search Console impressions in the last 3 months.
- **Format:** no header row, so the import can't create a junk "source" redirect. Columns are source, target, regex (0), HTTP code (301), which is the order Redirection's CSV import reads them in.
- **To import:**
  1. Go to Tools > Redirection > Import/Export.
  2. Import the file into the "Redirections" group.
  3. Open the first source URL in a private window and confirm it lands on the post.
- **Rows that pointed at posts the merge plan retires** (fixed so visitors don't take two hops):
  - row 24, `/2024/02/29/how-to-identify-the-top-cash-home-buyers-in-murfreesboro-tn/`: now points at `/where-we-buy/murfreesboro/` (updated Nov 3)
  - row 76, `/2024/12/19/how-to-sell-your-house-fast-in-tennessee/`: no change, because this post is now the kept guide
  - row 85, `/2025/01/29/how-to-sell-your-house-fast-in-tennessee-insider-tips-for-a-quick-hassle-free-sale/`: now points at `/how-to-sell-your-house-fast-in-tennessee/` (updated Nov 3)
- **Alternative:** one regex rule instead of 104 rows. Source `^/20\d{2}/\d{2}/\d{2}/([^/]+)/?$`, target `/$1/`, regex on. It also catches dated URLs not on this list. The catch is that it would also redirect dated URLs for posts that no longer exist (those would land on a 404 instead of the old 404).

## Items 4 and 5

See `cannibalization-plan.md` and `tullahoma-plan.md`.

---

## Found along the way (not fixed; your call)

- **The market stats on city and county pages are partly made up.**
  - `generate_market_stats.py` uses `random.uniform()` to produce the year-over-year price change, homes-sold change, days-on-market change, population change and foreclosure rate shown in the Market Stats block.
  - These are published as facts on money pages. That's a trust and accuracy risk, especially with Google's helpful-content signals and if a seller ever relies on them.
  - Replace them with real dated figures, or drop those rows from the block.
- **The homepage FAQ schema doesn't match the visible FAQ.** Only 3 of its 6 questions appear on the page, and it contains em dashes. Details are in `cannibalization-plan.md`.
- **Closing time is stated four ways across the site** (7 days, 14 days average, 1 to 3 weeks, two weeks). Pick one figure and use it everywhere.
- **This Mac's normal DNS lookup can't resolve tennesseecashforhomes.com,** although public DNS can and the site is up. If the script's live check prints "could not fetch", view the page source in a browser instead.
