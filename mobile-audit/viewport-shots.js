// Capture single-viewport (above-the-fold) screenshots for visual review.
// Also captures the "footer" segment by scrolling to bottom.
const puppeteer = require("puppeteer");
const fs = require("fs");
const path = require("path");

const BASE = "https://nationcfh.wpcomstaging.com";

const PAGES = [
  { slug: "/", label: "homepage" },
  { slug: "/where-we-buy/tennessee/", label: "where-we-buy-tn" },
  { slug: "/where-we-buy/nashville/", label: "city-nashville" },
  { slug: "/where-we-buy/davidson-county/", label: "county-davidson" },
  { slug: "/how-it-works/", label: "how-it-works" },
  { slug: "/about/", label: "about" },
  { slug: "/contact-us/", label: "contact" },
  { slug: "/faq/", label: "faq" },
  { slug: "/sell-my-land-for-cash-fast/", label: "sell-land" },
  { slug: "/facing-foreclosure/", label: "facing-foreclosure" },
  { slug: "/facing-foreclosure/nashville/", label: "fc-nashville" },
  { slug: "/sell-inherited-house-tennessee/", label: "sit-inherited" },
  { slug: "/sell-my-house-divorce-tennessee/", label: "sit-divorce" },
  { slug: "/investors/", label: "investors" },
  { slug: "/2026/01/24/zillow-is-lying-about-your-home-s-value-the-zestimate-does-not-determine-your-home-s-value/", label: "blog-post" },
  { slug: "/privacy-policy/", label: "privacy" },
  { slug: "/thank-you/", label: "thank-you" },
];

const VIEWPORT = { width: 375, height: 812, deviceScaleFactor: 2, isMobile: true, hasTouch: true };

const OUT = path.join(__dirname, "viewport");
fs.mkdirSync(OUT, { recursive: true });

(async () => {
  const browser = await puppeteer.launch({ headless: "new", args: ["--no-sandbox"] });
  const page = await browser.newPage();
  await page.setViewport(VIEWPORT);
  await page.setUserAgent(
    "Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1"
  );

  for (const p of PAGES) {
    const url = BASE + p.slug;
    console.log("→", p.label);
    try {
      await page.goto(url, { waitUntil: "networkidle2", timeout: 45000 });
      await page.addStyleTag({ content: "*,*::before,*::after{transition:none!important;animation:none!important}" });
      // Above-the-fold (hero)
      await page.screenshot({ path: path.join(OUT, `${p.label}-hero.png`) });
      // Mid-page  (scroll 1.5x viewport)
      await page.evaluate(() => window.scrollTo(0, window.innerHeight * 1.2));
      await new Promise(r => setTimeout(r, 200));
      await page.screenshot({ path: path.join(OUT, `${p.label}-mid.png`) });
      // Footer
      await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));
      await new Promise(r => setTimeout(r, 300));
      await page.screenshot({ path: path.join(OUT, `${p.label}-footer.png`) });
    } catch (e) {
      console.error("  err:", e.message);
    }
  }
  await browser.close();
})();
