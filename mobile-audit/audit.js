/* eslint-disable no-console */
// Mobile audit — visits a curated set of pages on the WP staging site at
// 375px width and reports horizontal-overflow elements, oversized media,
// undersized tap targets, undersized text, and forms/buttons that escape
// the viewport. Screenshots are saved per page for visual review.

const puppeteer = require("puppeteer");
const fs = require("fs");
const path = require("path");

const BASE = "https://nationcfh.wpcomstaging.com";

// Curated page list — every distinct template type on the site, plus 1-2
// representative variants of each repeating template (city, county, situation).
const PAGES = [
  { slug: "/", label: "homepage" },
  { slug: "/where-we-buy/", label: "where-we-buy" },
  { slug: "/where-we-buy/tennessee/", label: "where-we-buy-tn" },
  { slug: "/where-we-buy/nashville/", label: "city-nashville" },
  { slug: "/where-we-buy/franklin/", label: "city-franklin" },
  { slug: "/where-we-buy/columbia/", label: "city-columbia" },
  { slug: "/where-we-buy/davidson-county/", label: "county-davidson" },
  { slug: "/where-we-buy/williamson-county/", label: "county-williamson" },
  { slug: "/how-it-works/", label: "how-it-works" },
  { slug: "/about/", label: "about" },
  { slug: "/contact-us/", label: "contact" },
  { slug: "/faq/", label: "faq" },
  { slug: "/sell-my-land-for-cash-fast/", label: "sell-land" },
  { slug: "/facing-foreclosure/", label: "facing-foreclosure" },
  { slug: "/facing-foreclosure/nashville/", label: "fc-nashville" },
  { slug: "/sell-inherited-house-tennessee/", label: "sit-inherited" },
  { slug: "/sell-my-house-divorce-tennessee/", label: "sit-divorce" },
  { slug: "/sell-my-house-relocating-tennessee/", label: "sit-relocating" },
  { slug: "/sell-my-house-foreclosure-tennessee/", label: "sit-foreclosure" },
  { slug: "/sell-house-probate-tennessee/", label: "sit-probate" },
  { slug: "/sell-house-as-is-tennessee/", label: "sit-asis" },
  { slug: "/sell-rental-property-tennessee/", label: "sit-landlord" },
  { slug: "/sell-house-behind-on-taxes-tennessee/", label: "sit-taxes" },
  { slug: "/sell-my-house-downsizing-tennessee/", label: "sit-downsizing" },
  { slug: "/investors/", label: "investors" },
  { slug: "/2026/01/24/zillow-is-lying-about-your-home-s-value-the-zestimate-does-not-determine-your-home-s-value/", label: "blog-post" },
  { slug: "/privacy-policy/", label: "privacy" },
  { slug: "/thank-you/", label: "thank-you" },
];

const VIEWPORT = { width: 375, height: 812, deviceScaleFactor: 2, isMobile: true, hasTouch: true };

const OUT = path.join(__dirname, "shots");
fs.mkdirSync(OUT, { recursive: true });

async function audit(page, slug, label) {
  const url = BASE + slug;
  const result = { url, label, errors: [], stats: {} };
  try {
    const resp = await page.goto(url, { waitUntil: "networkidle2", timeout: 45000 });
    if (!resp || !resp.ok()) {
      result.errors.push(`HTTP ${resp ? resp.status() : "?"}`);
      return result;
    }
    // Disable smooth-scroll animations + close any nav overlays
    await page.addStyleTag({ content: "*,*::before,*::after{transition:none!important;animation:none!important;scroll-behavior:auto!important}" });

    // Collect diagnostics in the page context
    const diag = await page.evaluate(() => {
      const vw = window.innerWidth;
      const docW = document.documentElement.scrollWidth;
      const horizontalScroll = docW > vw + 1; // 1px tolerance for sub-pixel rendering

      const issues = {
        overflow: [],   // elements wider than viewport
        smallTap: [],   // links/buttons under 40x40
        smallText: [],  // visible text < 12px
        offscreen: [],  // elements that extend right of viewport
      };

      // Helper: short selector
      const sel = (el) => {
        if (!el) return "?";
        let s = el.tagName.toLowerCase();
        if (el.id) s += "#" + el.id;
        if (el.className && typeof el.className === "string") {
          const c = el.className.trim().split(/\s+/).slice(0, 3).join(".");
          if (c) s += "." + c;
        }
        return s;
      };

      const seen = new Set();
      const all = document.querySelectorAll("body *");
      for (const el of all) {
        const cs = getComputedStyle(el);
        if (cs.display === "none" || cs.visibility === "hidden") continue;
        const r = el.getBoundingClientRect();
        if (r.width === 0 && r.height === 0) continue;

        // Off-screen-right detection — element extends past viewport
        if (r.right > vw + 2 && r.width < vw * 2) {
          // Skip if parent is also offscreen (we want the source, not children)
          const parent = el.parentElement;
          if (parent && parent.getBoundingClientRect().right > vw + 2) continue;
          const key = sel(el);
          if (!seen.has("off:" + key)) {
            seen.add("off:" + key);
            issues.offscreen.push({ sel: key, right: Math.round(r.right), width: Math.round(r.width) });
            if (issues.offscreen.length > 25) break;
          }
        }
      }

      // Wide elements (overflow source)
      const all2 = document.querySelectorAll("body *");
      for (const el of all2) {
        const r = el.getBoundingClientRect();
        if (r.width > vw + 1 && r.width < 4000) {
          const key = sel(el);
          if (!seen.has("wide:" + key)) {
            seen.add("wide:" + key);
            issues.overflow.push({ sel: key, width: Math.round(r.width) });
            if (issues.overflow.length > 25) break;
          }
        }
      }

      // Small tap targets — links / buttons / inputs
      const tapEls = document.querySelectorAll("a, button, input[type=submit], input[type=button], [role=button]");
      for (const el of tapEls) {
        const cs = getComputedStyle(el);
        if (cs.display === "none" || cs.visibility === "hidden") continue;
        const r = el.getBoundingClientRect();
        if (r.width === 0 || r.height === 0) continue;
        if (r.width < 40 || r.height < 36) {
          // Filter out trivially-small inline icons inside larger tap targets
          const inSidePadding = el.closest("nav,header,footer");
          if (r.width < 24 && r.height < 24 && inSidePadding) continue;
          const key = sel(el);
          if (!seen.has("tap:" + key)) {
            seen.add("tap:" + key);
            issues.smallTap.push({ sel: key, w: Math.round(r.width), h: Math.round(r.height), text: (el.textContent||"").trim().slice(0,40) });
            if (issues.smallTap.length > 20) break;
          }
        }
      }

      // Small text on body content
      const textEls = document.querySelectorAll("p, li, span, a, td, th, label, h1, h2, h3, h4, h5, h6, .btn-primary, .btn-outline, .btn-white");
      for (const el of textEls) {
        const cs = getComputedStyle(el);
        if (cs.display === "none" || cs.visibility === "hidden") continue;
        const fs = parseFloat(cs.fontSize);
        if (fs > 0 && fs < 12) {
          const r = el.getBoundingClientRect();
          if (r.width === 0 || r.height === 0) continue;
          // Must contain real text
          const txt = (el.textContent || "").trim();
          if (txt.length < 2) continue;
          const key = sel(el);
          if (!seen.has("txt:" + key)) {
            seen.add("txt:" + key);
            issues.smallText.push({ sel: key, fs: fs.toFixed(1), text: txt.slice(0, 50) });
            if (issues.smallText.length > 15) break;
          }
        }
      }

      return {
        vw,
        docW,
        horizontalScroll,
        title: document.title,
        h1: (document.querySelector("h1")||{}).innerText || null,
        issues,
      };
    });

    result.stats = diag;

    // Save full-page screenshot
    const safe = label.replace(/[^a-z0-9-]/gi, "-");
    const shotPath = path.join(OUT, `${safe}.png`);
    await page.screenshot({ path: shotPath, fullPage: true });
    result.screenshot = shotPath;
  } catch (e) {
    result.errors.push("EXCEPTION: " + e.message);
  }
  return result;
}

(async () => {
  const browser = await puppeteer.launch({ headless: "new", args: ["--no-sandbox"] });
  const page = await browser.newPage();
  await page.setViewport(VIEWPORT);
  await page.setUserAgent(
    "Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1"
  );

  const results = [];
  for (const p of PAGES) {
    process.stdout.write(`Auditing ${p.label} ...`);
    const r = await audit(page, p.slug, p.label);
    results.push(r);
    const counts = r.stats && r.stats.issues ? Object.fromEntries(Object.entries(r.stats.issues).map(([k,v])=>[k,v.length])) : {};
    console.log(" hScroll=" + (r.stats && r.stats.horizontalScroll ? "YES" : "no"), counts, r.errors.length ? r.errors : "");
  }

  await browser.close();
  fs.writeFileSync(path.join(__dirname, "results.json"), JSON.stringify(results, null, 2));
  console.log("\nDone. Results -> mobile-audit/results.json");
})().catch((e) => { console.error(e); process.exit(1); });
