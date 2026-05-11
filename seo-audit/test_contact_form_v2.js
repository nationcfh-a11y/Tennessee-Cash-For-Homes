// Better contact-form test — wait longer, check raw HTML for shortcode leak.
const puppeteer = require("puppeteer");
const URL = "https://nationcfh.wpcomstaging.com/contact-us/";

const sleep = (ms) => new Promise((r) => setTimeout(r, ms));

(async () => {
  const browser = await puppeteer.launch({ headless: "new", args: ["--no-sandbox"] });
  const page = await browser.newPage();
  await page.setDefaultTimeout(60000);

  const consoleErrs = [];
  page.on("console", (m) => { if (m.type() === "error") consoleErrs.push(m.text()); });
  page.on("pageerror", (e) => consoleErrs.push("PAGEERROR: " + e.message));

  const resp = await page.goto(URL, { waitUntil: "networkidle2" });
  console.log("Page status:", resp && resp.status());

  // Wait up to 8 seconds for the form to appear
  let formReady = false;
  for (let i = 0; i < 16; i++) {
    await sleep(500);
    const has = await page.$("form");
    if (has) { formReady = true; break; }
  }
  console.log("Form appeared within 8s:", formReady);

  // Also: check for the literal shortcode bleeding through (means render failed)
  const rawHtml = await page.content();
  const shortcodeLeaked = rawHtml.includes("[sureforms");
  console.log("Shortcode visible in DOM (render failed):", shortcodeLeaked);
  if (shortcodeLeaked) {
    const idx = rawHtml.indexOf("[sureforms");
    console.log("  context:", rawHtml.slice(Math.max(0, idx - 80), idx + 200));
  }

  // List forms again
  const formInfo = await page.evaluate(() => {
    const forms = Array.from(document.querySelectorAll("form"));
    return forms.map((f) => ({
      id: f.id || null,
      classes: f.className || null,
      action: f.action || null,
      method: f.method || null,
      inputCount: f.querySelectorAll("input,textarea,select").length,
      inputs: Array.from(f.querySelectorAll("input,textarea,select"))
        .map((el) => ({ name: el.name || null, type: el.type || el.tagName.toLowerCase() })).slice(0, 12),
      submitText: (f.querySelector('button[type=submit],button,input[type=submit]')||{}).innerText || null,
    }));
  });
  console.log("Forms:", JSON.stringify(formInfo, null, 2));

  // If form exists, click submit empty and see what happens
  if (formReady) {
    const r = await page.evaluate(async () => {
      const f = document.querySelector("form");
      const btn = f.querySelector('button[type=submit],input[type=submit]');
      if (!btn) return { ok: false, reason: "no submit btn" };
      btn.click();
      await new Promise(r => setTimeout(r, 3000));
      const errs = Array.from(document.querySelectorAll(".srfm-error-message,.srfm-error,[aria-invalid=true]")).map(e=>e.textContent.trim());
      const succ = !!document.querySelector(".srfm-success-message,.srfm-success");
      const submitDisabled = btn.disabled;
      return { ok: true, errors_visible: errs.slice(0, 8), success_shown: succ, submit_disabled: submitDisabled };
    });
    console.log("Empty-submit response:", JSON.stringify(r, null, 2));
  }

  console.log("Console errors:", consoleErrs.slice(0, 10));

  await page.screenshot({ path: "/Users/karsoncarmichael/Claude Code Website Creator/seo-audit/contact-form.png", fullPage: true });
  await browser.close();
  console.log("Done");
})().catch((e) => { console.error("FATAL:", e); process.exit(1); });
