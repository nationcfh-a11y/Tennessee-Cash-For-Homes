// Render /contact-us/ in puppeteer, find the actual form, attempt empty submit,
// and confirm validation kicks in. We do NOT actually submit a real lead.
const puppeteer = require("puppeteer");
const URL = "https://nationcfh.wpcomstaging.com/contact-us/";

(async () => {
  const browser = await puppeteer.launch({ headless: "new", args: ["--no-sandbox"] });
  const page = await browser.newPage();
  await page.setDefaultTimeout(45000);

  const consoleErrs = [];
  page.on("console", (m) => { if (m.type() === "error") consoleErrs.push(m.text()); });
  page.on("pageerror", (e) => consoleErrs.push("PAGEERROR: " + e.message));

  const reqs = [];
  page.on("request", (r) => reqs.push({ url: r.url(), method: r.method() }));
  page.on("response", async (r) => {
    if (/sureforms|contact-form-7|nf-submission|formspark|wp-admin\/admin-ajax/.test(r.url())) {
      try {
        const t = await r.text();
        reqs.push({ url: r.url(), status: r.status(), body: t.slice(0, 400) });
      } catch (_) {}
    }
  });

  const resp = await page.goto(URL, { waitUntil: "networkidle2" });
  console.log("Page status:", resp && resp.status());

  // Find the form
  const formInfo = await page.evaluate(() => {
    const forms = Array.from(document.querySelectorAll("form"));
    return forms.map((f) => ({
      id: f.id || null,
      classes: f.className || null,
      action: f.action || null,
      method: f.method || null,
      inputs: Array.from(f.querySelectorAll("input,textarea,select"))
        .map((el) => ({ name: el.name || null, type: el.type || el.tagName.toLowerCase(), required: el.required })),
      submitBtn: (f.querySelector('button[type=submit],input[type=submit]')||{}).outerHTML?.slice(0,200) || null,
    }));
  });
  console.log("Forms found:", JSON.stringify(formInfo, null, 2));

  // Attempt to submit empty
  const submitResult = await page.evaluate(async () => {
    const f = document.querySelector("form");
    if (!f) return { ok: false, reason: "no form" };
    const btn = f.querySelector('button[type=submit],input[type=submit]');
    if (!btn) return { ok: false, reason: "no submit button" };
    btn.click();
    await new Promise((r) => setTimeout(r, 2500));
    // Look for validation messages
    const errs = Array.from(document.querySelectorAll(
      ".srfm-error-message,.wpcf7-not-valid-tip,[role=alert],.error-message,.field-error,.srfm-error,.srfm-block-error,[aria-invalid=true]"
    )).map(e => e.textContent.trim()).filter(Boolean);
    return { ok: true, errors_visible: errs };
  });
  console.log("Empty submit result:", JSON.stringify(submitResult, null, 2));

  await page.waitForTimeout(2000);
  console.log("Console errors during load:", consoleErrs.slice(0, 10));

  // Save a screenshot for visual review
  await page.screenshot({ path: "/Users/karsoncarmichael/Claude Code Website Creator/seo-audit/contact-form.png", fullPage: true });

  await browser.close();
  console.log("Done");
})().catch((e) => { console.error("FATAL:", e); process.exit(1); });
