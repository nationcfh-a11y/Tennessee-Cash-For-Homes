# Deploy bundle — SEO internal linking (2026-08-12)

Upload these two files to the active theme directory, overwriting the current versions:

| File | What changed |
|---|---|
| `footer.php` | Added Shelbyville + La Vergne to the city column (now 12). Added a new "Situations We Help With" column (8 links). Grid widened to 4 columns with a 2-col tablet breakpoint. |
| `situation-template.php` | Replaced the "Areas We Serve" city list with only cities that have a real self-canonical page (removed 9 slugs that 301 elsewhere). Added a 12-county chip loop. |

**Not included but already committed and still undeployed** (from commit `389f7e3`, and the schema fixes):
- `footer.php` city/county nav hub — included here (this file supersedes it)
- `location-template.php` — county chips in "Areas We Serve"
- `functions.php` — `reviewCount` 50 -> 82, `streetAddress` + `postalCode` added to LocalBusiness schema
- `page-about.php`, `page-sell-your-land-1.php` — `reviewCount` 50 -> 82

Verify after upload:
1. Footer shows 4 columns on desktop, stacks on mobile.
2. `curl -s https://tennesseecashforhomes.com/ | grep -c "Counties We Serve"` returns 1.
3. Lead form, phone links, and GTM container still present on the homepage and a city page.
