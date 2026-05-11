// Lab perf snapshot using puppeteer — TTFB, FCP, LCP, total bytes, request count.
// Not a full Lighthouse score, but enough to flag obvious issues per page.
const puppeteer = require("puppeteer");
const fs = require("fs");

const PAGES = [
  { url: "https://nationcfh.wpcomstaging.com/", label: "homepage" },
  { url: "https://nationcfh.wpcomstaging.com/where-we-buy/nashville/", label: "nashville" },
  { url: "https://nationcfh.wpcomstaging.com/where-we-buy/franklin/", label: "franklin" },
  { url: "https://nationcfh.wpcomstaging.com/where-we-buy/murfreesboro/", label: "murfreesboro" },
  { url: "https://nationcfh.wpcomstaging.com/where-we-buy/clarksville/", label: "clarksville" },
  { url: "https://nationcfh.wpcomstaging.com/where-we-buy/columbia/", label: "columbia" },
];

const sleep = (ms) => new Promise((r) => setTimeout(r, ms));

(async () => {
  const browser = await puppeteer.launch({ headless: "new", args: ["--no-sandbox"] });
  const out = [];

  for (const p of PAGES) {
    const page = await browser.newPage();
    // Throttle to "Slow 4G" to roughly approximate mobile field conditions
    const client = await page.target().createCDPSession();
    await client.send("Network.enable");
    await client.send("Network.emulateNetworkConditions", {
      offline: false,
      latency: 150,
      downloadThroughput: (1.6 * 1024 * 1024) / 8,  // 1.6 Mbps
      uploadThroughput: (750 * 1024) / 8,
    });
    await client.send("Emulation.setCPUThrottlingRate", { rate: 4 });
    await page.setViewport({ width: 375, height: 812, deviceScaleFactor: 2, isMobile: true });

    let totalBytes = 0;
    let reqCount = 0;
    page.on("response", async (resp) => {
      reqCount++;
      try {
        const buf = await resp.buffer();
        totalBytes += buf.length;
      } catch (_) {}
    });

    const t0 = Date.now();
    let resp;
    try {
      resp = await page.goto(p.url, { waitUntil: "load", timeout: 60000 });
    } catch (e) {
      out.push({ ...p, error: e.message });
      await page.close();
      continue;
    }
    // Give some time for LCP element to settle
    await sleep(3000);

    const metrics = await page.evaluate(() => {
      const nav = performance.getEntriesByType("navigation")[0] || {};
      const fcp = (performance.getEntriesByName("first-contentful-paint")[0] || {}).startTime;
      // LCP via PerformanceObserver isn't available retroactively; we approximate w/ largestContentfulPaint final value
      const lcpEntries = performance.getEntriesByType("largest-contentful-paint");
      const lcp = lcpEntries.length ? lcpEntries[lcpEntries.length - 1].startTime : null;
      return {
        ttfb_ms: nav.responseStart != null ? Math.round(nav.responseStart) : null,
        domLoaded_ms: nav.domContentLoadedEventEnd != null ? Math.round(nav.domContentLoadedEventEnd) : null,
        load_ms: nav.loadEventEnd != null ? Math.round(nav.loadEventEnd) : null,
        fcp_ms: fcp != null ? Math.round(fcp) : null,
        lcp_ms: lcp != null ? Math.round(lcp) : null,
      };
    });

    out.push({
      ...p,
      status: resp.status(),
      total_kb: Math.round(totalBytes / 1024),
      requests: reqCount,
      ...metrics,
    });
    console.log(`${p.label.padEnd(14)}  status=${resp.status()}  TTFB=${metrics.ttfb_ms}ms  FCP=${metrics.fcp_ms}ms  LCP=${metrics.lcp_ms}ms  size=${Math.round(totalBytes/1024)}KB  reqs=${reqCount}`);

    await page.close();
  }

  await browser.close();
  fs.writeFileSync(
    "/Users/karsoncarmichael/Claude Code Website Creator/seo-audit/final_perf.json",
    JSON.stringify(out, null, 2)
  );
  console.log("Saved final_perf.json");
})().catch((e) => { console.error("FATAL:", e); process.exit(1); });
