(function () {
  'use strict';

  const DEBUG = false;

  // ── Mobile nav toggle ──
  const hamburger = document.getElementById('hamburger');
  const navLinks  = document.getElementById('navLinks');
  if (hamburger && navLinks) {
    const syncExpanded = () => hamburger.setAttribute('aria-expanded', navLinks.classList.contains('open') ? 'true' : 'false');
    hamburger.addEventListener('click', () => { navLinks.classList.toggle('open'); syncExpanded(); });
    hamburger.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); navLinks.classList.toggle('open'); syncExpanded(); }
    });
    navLinks.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => { navLinks.classList.remove('open'); syncExpanded(); });
    });
  }

  // ── Resources dropdown ──
  (function () {
    const dropdown = document.querySelector('.nav__dropdown');
    if (!dropdown) return;
    const toggle = dropdown.querySelector('.nav__dropdown-toggle');
    const menu   = dropdown.querySelector('.nav__dropdown-menu');
    let hoverTimeout;

    function open()  { dropdown.classList.add('open');    toggle.setAttribute('aria-expanded', 'true'); }
    function close() { dropdown.classList.remove('open'); toggle.setAttribute('aria-expanded', 'false'); }

    dropdown.addEventListener('mouseenter', () => { clearTimeout(hoverTimeout); open(); });
    dropdown.addEventListener('mouseleave', () => { hoverTimeout = setTimeout(close, 200); });
    toggle.addEventListener('click', e => { e.preventDefault(); dropdown.classList.contains('open') ? close() : open(); });
    toggle.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ' || e.key === 'ArrowDown') {
        e.preventDefault();
        open();
        menu.querySelector('a')?.focus();
      }
      if (e.key === 'Escape') close();
    });
    menu.addEventListener('keydown', e => {
      const items = [...menu.querySelectorAll('a')];
      const idx   = items.indexOf(document.activeElement);
      if (e.key === 'ArrowDown') { e.preventDefault(); items[(idx + 1) % items.length]?.focus(); }
      if (e.key === 'ArrowUp')   { e.preventDefault(); items[(idx - 1 + items.length) % items.length]?.focus(); }
      if (e.key === 'Escape')    { close(); toggle.focus(); }
    });
    document.addEventListener('click', e => { if (!dropdown.contains(e.target)) close(); });
  })();

  // ── FAQ accordion (referenced inline via onclick) ──
  window.toggleFaq = function (el) {
    const item   = el.closest('.faq-item');
    const answer = item.querySelector('.faq-answer');
    const isOpen = item.classList.contains('open');

    document.querySelectorAll('.faq-item').forEach(i => {
      i.classList.remove('open');
      i.querySelector('.faq-answer')?.classList.remove('open');
    });

    if (!isOpen) {
      item.classList.add('open');
      answer.classList.add('open');
    }
  };

  // ── Lead form submit pipeline ─────────────────────────────────────────
  //
  // Reliability stack, layered from most-likely to least-likely path:
  //   1. Refresh the nonce from /?tcfh_nonce=1 (defeats stale cached HTML)
  //   2. POST via fetch() with keepalive:true (survives page unload on iOS)
  //   3. Validate the JSON response is { success: true } before redirecting
  //   4. On failure: retry once with a fresh nonce
  //   5. On second failure: fire navigator.sendBeacon() to the rescue endpoint
  //      so the server records the attempt even if every other path failed
  //   6. Stash payload in localStorage and replay on the next pageview
  //   7. Only redirect to /thank-you/ once *something* has confirmed receipt
  //
  // The old code redirected to /thank-you/ no matter what — silent loss.
  // This code shows an inline error and keeps the form visible if every
  // path fails, so the visitor knows to retry.

  const TCFH = window.tcfh = window.tcfh || {};

  const STASH_KEY     = 'tcfh_pending_submissions';
  const NONCE_TTL_MS  = 10 * 60 * 1000;
  let   cachedNonce   = null;
  let   cachedNonceAt = 0;

  function ajaxConfig() {
    return (typeof tcfh_ajax !== 'undefined') ? tcfh_ajax : {};
  }

  async function getFreshNonce(forceRefresh) {
    const cfg = ajaxConfig();
    const now = Date.now();
    if (!forceRefresh && cachedNonce && (now - cachedNonceAt) < NONCE_TTL_MS) {
      return cachedNonce;
    }
    if (!cfg.nonce_url) {
      return cfg.nonce || '';
    }
    try {
      const res = await fetch(cfg.nonce_url, { credentials: 'same-origin', cache: 'no-store' });
      if (res.ok) {
        const data = await res.json();
        if (data && data.nonce) {
          cachedNonce   = data.nonce;
          cachedNonceAt = now;
          return cachedNonce;
        }
      }
    } catch (_) { /* fall through to baked-in nonce */ }
    return cfg.nonce || '';
  }

  function buildFormData(action, fields, nonce) {
    const fd = new FormData();
    fd.append('action', action);
    fd.append('nonce',  nonce || '');
    Object.keys(fields).forEach(function (k) {
      if (fields[k] != null && fields[k] !== '') fd.append(k, fields[k]);
    });
    return fd;
  }

  // sendBeacon is the only API guaranteed to complete during page unload,
  // so it's our rescue path for fetches the browser kills mid-flight.
  function fireBeacon(fields) {
    const cfg = ajaxConfig();
    if (!cfg.beacon_url) return;
    try {
      const fd = new FormData();
      Object.keys(fields).forEach(function (k) {
        if (fields[k] != null && fields[k] !== '') fd.append(k, fields[k]);
      });
      if (navigator.sendBeacon) {
        navigator.sendBeacon(cfg.beacon_url, fd);
      } else {
        fetch(cfg.beacon_url, { method: 'POST', body: fd, keepalive: true, credentials: 'same-origin' });
      }
    } catch (_) { /* best-effort */ }
  }

  function stashPending(action, fields) {
    try {
      const list = JSON.parse(localStorage.getItem(STASH_KEY) || '[]');
      list.push({ action: action, fields: fields, ts: Date.now() });
      while (list.length > 10) list.shift();
      localStorage.setItem(STASH_KEY, JSON.stringify(list));
    } catch (_) {}
  }

  function clearPending() {
    try { localStorage.removeItem(STASH_KEY); } catch (_) {}
  }

  function readPending() {
    try { return JSON.parse(localStorage.getItem(STASH_KEY) || '[]'); }
    catch (_) { return []; }
  }

  async function postOnce(action, fields, nonce) {
    const cfg = ajaxConfig();
    const url = cfg.ajax_url || '/wp-admin/admin-ajax.php';
    try {
      const res  = await fetch(url, {
        method: 'POST',
        body: buildFormData(action, fields, nonce),
        credentials: 'same-origin',
        keepalive: true,
      });
      let data = null;
      try { data = await res.json(); } catch (_) { /* non-JSON body */ }
      return { ok: res.ok && data && data.success === true, status: res.status, data: data, networkError: false };
    } catch (err) {
      return { ok: false, status: 0, data: null, networkError: true, error: String(err) };
    }
  }

  TCFH.submit = async function (action, fields) {
    let nonce  = await getFreshNonce(false);
    let result = await postOnce(action, fields, nonce);

    const code = result.data && result.data.data && result.data.data.code;
    if (!result.ok && (result.networkError || result.status === 403 || code === 'nonce_expired')) {
      nonce  = await getFreshNonce(true);
      result = await postOnce(action, fields, nonce);
    }

    if (result.ok) return { ok: true };

    fireBeacon(Object.assign({ action: action }, fields));
    stashPending(action, fields);
    return { ok: false, result: result };
  };

  window.handleSubmit = async function (e) {
    e.preventDefault();
    const form = e.target;
    const btn  = form.querySelector('.btn-primary');
    const originalLabel = btn ? btn.textContent : '';

    if (btn) { btn.textContent = 'Sending…'; btn.disabled = true; }

    const fields = {
      name:    (form.name    && form.name.value    || '').trim(),
      phone:   (form.phone   && form.phone.value   || '').trim(),
      address: (form.address && form.address.value || '').trim(),
    };
    const leadSource = form.lead_source && form.lead_source.value ? form.lead_source.value.trim() : '';
    if (leadSource) fields.lead_source = leadSource;

    const outcome = await TCFH.submit('tcfh_submit_lead', fields);

    if (outcome.ok) {
      // Let analytics.js record the conversion before we navigate away.
      // gtag uses sendBeacon, so the event survives the redirect.
      document.dispatchEvent(new CustomEvent('tcfh:lead-success'));
      window.location.href = (ajaxConfig().thank_you_url) || '/thank-you/';
      return;
    }

    document.dispatchEvent(new CustomEvent('tcfh:lead-error'));

    showInlineError(form, btn, originalLabel,
      'We couldn’t confirm your submission. Please check your connection and tap Send again — your information has been saved on this device and will retry automatically.');
  };

  function showInlineError(form, btn, originalLabel, message) {
    if (btn) { btn.textContent = originalLabel || 'Send'; btn.disabled = false; }
    let note = form.querySelector('.tcfh-submit-error');
    if (!note) {
      note = document.createElement('div');
      note.className = 'tcfh-submit-error';
      note.setAttribute('role', 'alert');
      note.style.cssText = 'margin-top:12px;padding:10px 12px;border:1px solid #c44;background:#fff5f5;color:#8a1a1a;border-radius:6px;font-size:14px;line-height:1.4;';
      form.appendChild(note);
    }
    note.textContent = message;
  }

  // ── Replay any submissions stashed during a previous failed attempt ──
  // Runs once per pageload. Each pending row is retried via the same
  // hardened path; on confirmed success it is dropped from the stash.
  // Anything that still fails stays for the next pageview to try again.
  (async function replayPending() {
    if (typeof tcfh_ajax === 'undefined') return;
    const pending = readPending();
    if (!pending.length) return;
    const survivors = [];
    for (let i = 0; i < pending.length; i++) {
      const item = pending[i];
      if (Date.now() - (item.ts || 0) > 7 * 24 * 60 * 60 * 1000) continue;
      const r = await TCFH.submit(item.action, item.fields);
      if (!r.ok) survivors.push(item);
    }
    try {
      if (survivors.length) localStorage.setItem(STASH_KEY, JSON.stringify(survivors));
      else clearPending();
    } catch (_) {}
  })();

  // ── Smooth nav highlight on scroll ──
  const sections   = document.querySelectorAll('section[id]');
  const navAnchors = document.querySelectorAll('.nav__links a[href*="#"]');
  if (sections.length && navAnchors.length) {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          navAnchors.forEach(a => a.classList.remove('active'));
          const active = document.querySelector(`.nav__links a[href*="#${entry.target.id}"]`);
          if (active) active.classList.add('active');
        }
      });
    }, { threshold: 0.4 });
    sections.forEach(s => observer.observe(s));
  }

  // ── Reviews Carousel ──
  (function () {
    const track    = document.getElementById('reviewsTrack');
    const outer    = document.getElementById('reviewsOuter');
    const dotsWrap = document.getElementById('revDots');
    const btnPrev  = document.getElementById('revPrev');
    const btnNext  = document.getElementById('revNext');
    const TOTAL    = track ? track.children.length : 0;
    if (!TOTAL || !outer || !dotsWrap || !btnPrev || !btnNext) return;

    let current = 0;
    let autoTimer;

    for (let i = 0; i < TOTAL; i++) {
      const dot = document.createElement('button');
      dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
      dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
      dot.addEventListener('click', () => { goTo(i); resetTimer(); });
      dotsWrap.appendChild(dot);
    }

    function goTo(n) {
      current = (n + TOTAL) % TOTAL;
      track.style.transform = 'translateX(-' + (current * 20) + '%)';
      dotsWrap.querySelectorAll('.carousel-dot').forEach((d, i) => {
        d.classList.toggle('active', i === current);
      });
    }
    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    btnNext.addEventListener('click', () => { next(); resetTimer(); });
    btnPrev.addEventListener('click', () => { prev(); resetTimer(); });
    outer.addEventListener('mouseenter', () => clearInterval(autoTimer));
    outer.addEventListener('mouseleave', startTimer);

    let touchStartX = 0;
    outer.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
    outer.addEventListener('touchend', e => {
      const dx = e.changedTouches[0].clientX - touchStartX;
      if (Math.abs(dx) > 40) { dx < 0 ? next() : prev(); resetTimer(); }
    }, { passive: true });

    function startTimer() { autoTimer = setInterval(next, 5000); }
    function resetTimer() { clearInterval(autoTimer); startTimer(); }
    startTimer();
  })();

  // ── Review Expand / Collapse ──
  // Performance: layout reads (scrollHeight/clientHeight) are batched after
  // writes inside a single rAF tick. Resize handlers are coalesced with rAF
  // so a continuous resize fires checkClamp once per frame, not per event.
  (function () {
    const cards = document.querySelectorAll('.testimonial-card');
    if (!cards.length) return;

    const entries = [];
    cards.forEach(function (card) {
      const body = card.querySelector('.testimonial-body');
      if (!body) return;
      const btn = document.createElement('button');
      btn.className = 'testimonial-toggle hidden';
      btn.textContent = 'View Full Review';
      body.insertAdjacentElement('afterend', btn);
      btn.addEventListener('click', function () {
        const isExpanded = card.classList.toggle('expanded');
        btn.textContent = isExpanded ? 'Show Less' : 'View Full Review';
      });
      entries.push({ card: card, body: body, btn: btn });
    });

    function runCheck() {
      // Write phase: reset every card to the un-expanded state.
      entries.forEach(function (e) {
        e.card.classList.remove('expanded');
        e.btn.textContent = 'View Full Review';
      });
      // Read phase: now do all layout reads together (one synchronous reflow).
      const overflow = entries.map(function (e) {
        return e.body.scrollHeight > e.body.clientHeight + 1;
      });
      // Write phase: toggle button visibility based on the reads.
      entries.forEach(function (e, i) {
        e.btn.classList.toggle('hidden', !overflow[i]);
      });
    }

    let scheduled = false;
    function scheduleCheck() {
      if (scheduled) return;
      scheduled = true;
      requestAnimationFrame(function () { scheduled = false; runCheck(); });
    }

    runCheck();
    window.addEventListener('resize', scheduleCheck, { passive: true });
  })();

  // ── Count-Up Animation ──
  (function () {
    const countEls = document.querySelectorAll('.count-up');
    if (!countEls.length) return;

    function animateCount(el) {
      const target = parseInt(el.dataset.target, 10);
      const duration = 3200;
      const start = performance.now();
      function step(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target).toLocaleString() + '+';
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target.toLocaleString() + '+';
      }
      requestAnimationFrame(step);
    }

    const countObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCount(entry.target);
          countObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });
    countEls.forEach(el => countObserver.observe(el));
  })();

  // ── Difference List Scroll Appear Animation ──
  (function () {
    const diffItems = document.querySelectorAll('.diff-item');
    if (!diffItems.length) return;

    const diffObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          diffObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    diffItems.forEach((item, i) => {
      item.style.transitionDelay = (i * 120) + 'ms';
      diffObserver.observe(item);
    });
  })();

  // ── Back-to-top button (mobile) ──
  // Shows after the user scrolls 300px from the top, smooth-scrolls to 0
  // when tapped. CSS handles the fade transitions and desktop hiding.
  (function () {
    const btn = document.querySelector('.back-to-top');
    if (!btn) return;
    const SHOW_AFTER = 300;
    let ticking = false;

    function update() {
      ticking = false;
      if (window.scrollY > SHOW_AFTER) btn.classList.add('is-visible');
      else btn.classList.remove('is-visible');
    }
    function onScroll() {
      if (!ticking) {
        window.requestAnimationFrame(update);
        ticking = true;
      }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    update(); // set initial state on load
  })();
})();
