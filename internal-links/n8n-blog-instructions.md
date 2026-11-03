# City links in new blog posts

Add this block to the post-writing prompt (the system message of the model node
that writes the article body) in the n8n workflow that publishes to WordPress.

```
CITY LINKS:
- If the post mentions any of the cities or counties below, link the FIRST
  natural mention of each one in body text to its page. Use the city name as
  the anchor text (for example <a href="https://tennesseecashforhomes.com/where-we-buy/columbia/">Columbia</a>).
- At most 2 city links per post. If more cities are mentioned, link the city
  the post is about first, then the next one mentioned.
- Never link inside a heading, an image caption, or the Short Answer label.
- Always use https://tennesseecashforhomes.com (no www) and keep the trailing slash.
- Never link /sell-your-house-fast-in-spring-hill-tennessee/. Spring Hill links
  go to /where-we-buy/spring-hill/.
- Do not link "Franklin County" or any other county not listed here. "Dickson"
  (the city) and "Dickson County" have separate pages.

Nashville          https://tennesseecashforhomes.com/where-we-buy/nashville/
Franklin           https://tennesseecashforhomes.com/where-we-buy/franklin/
Brentwood          https://tennesseecashforhomes.com/where-we-buy/brentwood/
Spring Hill        https://tennesseecashforhomes.com/where-we-buy/spring-hill/
Columbia           https://tennesseecashforhomes.com/where-we-buy/columbia/
Murfreesboro       https://tennesseecashforhomes.com/where-we-buy/murfreesboro/
Smyrna             https://tennesseecashforhomes.com/where-we-buy/smyrna/
La Vergne          https://tennesseecashforhomes.com/where-we-buy/la-vergne/
Clarksville        https://tennesseecashforhomes.com/where-we-buy/clarksville/
Hendersonville     https://tennesseecashforhomes.com/where-we-buy/hendersonville/
Gallatin           https://tennesseecashforhomes.com/where-we-buy/gallatin/
Lebanon            https://tennesseecashforhomes.com/where-we-buy/lebanon/
Mt. Juliet         https://tennesseecashforhomes.com/where-we-buy/mount-juliet/
Springfield        https://tennesseecashforhomes.com/where-we-buy/springfield/
Dickson            https://tennesseecashforhomes.com/where-we-buy/dickson/
Shelbyville        https://tennesseecashforhomes.com/where-we-buy/shelbyville/
Tullahoma          https://tennesseecashforhomes.com/where-we-buy/tullahoma/
Cookeville         https://tennesseecashforhomes.com/where-we-buy/cookeville/
Williamson County  https://tennesseecashforhomes.com/where-we-buy/williamson-county/
Sumner County      https://tennesseecashforhomes.com/where-we-buy/sumner-county/
Bedford County     https://tennesseecashforhomes.com/where-we-buy/bedford-county/
Davidson County    https://tennesseecashforhomes.com/where-we-buy/davidson-county/
Maury County       https://tennesseecashforhomes.com/where-we-buy/maury-county/
Rutherford County  https://tennesseecashforhomes.com/where-we-buy/rutherford-county/
Montgomery County  https://tennesseecashforhomes.com/where-we-buy/montgomery-county/
Wilson County      https://tennesseecashforhomes.com/where-we-buy/wilson-county/
Robertson County   https://tennesseecashforhomes.com/where-we-buy/robertson-county/
Dickson County     https://tennesseecashforhomes.com/where-we-buy/dickson-county/
Coffee County      https://tennesseecashforhomes.com/where-we-buy/coffee-county/
Putnam County      https://tennesseecashforhomes.com/where-we-buy/putnam-county/
```

## Status (Nov 3, 2026)

- **"Blog Agent Image Capture"** (IdKpwjIpku6RUjh7, publishes to Wix) was
  deactivated on Nov 3.
- **"WORDPRESS Blog Agent Image Capture"** (qww6PEXpboRxZm0k) still has MCP
  access turned off, so this text has not been added yet. Turn on
  "Available in MCP" in its settings and Claude can add it, or paste it in
  yourself.
