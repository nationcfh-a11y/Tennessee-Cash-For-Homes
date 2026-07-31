/**
 * Funnel instrumentation for GA4 + Microsoft Clarity.
 *
 * Answers "where do people drop off?" with numbers (GA4) that pair with the
 * session recordings (Clarity). Every event below also stamps a Clarity custom
 * tag, so a GA4 number like "62% abandon at the phone field" can be turned
 * straight into a filtered list of recordings showing exactly that.
 *
 * PRIVACY: only field *names* and section *labels* are ever sent. No field
 * values, no address, no name, no phone number leaves the page.
 */
(function () {
  'use strict';

  // ── Transport helpers ───────────────────────────────────────────────
  // Both tags load async, so neither is guaranteed present at call time.
  // gtag() is defined synchronously in <head> and queues into dataLayer,
  // so calls made before gtag.js finishes loading are still delivered.

  function ga(name, params) {
    if (typeof window.gtag === 'function') window.gtag('event', name, params || {});
  }

  function clarityTag(key, value) {
    if (typeof window.clarity === 'function') {
      try { window.clarity('set', key, String(value)); } catch (_) {}
    }
  }

  // Records to both sinks at once: a GA4 event for aggregate counts, and a
  // Clarity tag for filtering recordings down to the sessions that did it.
  function record(eventName, params, tagKey, tagValue) {
    ga(eventName, params);
    if (tagKey) clarityTag(tagKey, tagValue);
  }

  // ── Lead form funnel ────────────────────────────────────────────────
  // The form is the whole point of the site. Three fields, in DOM order:
  // address → name → phone. Knowing which one someone stalled on is the
  // single most actionable signal available.

  var FIELD_ORDER = ['address', 'name', 'phone'];

  var formStarted   = false;  // has the visitor touched any field?
  var formSubmitted = false;  // did they get all the way through?
  var deepestField  = null;   // furthest field they engaged with
  var deepestIndex  = -1;

  function noteFieldEngagement(fieldName) {
    var index = FIELD_ORDER.indexOf(fieldName);
    if (index === -1) return;

    if (!formStarted) {
      formStarted = true;
      record('form_start', { form_id: 'leadForm', first_field: fieldName },
             'form_reached', 'yes');
    }

    // Only report forward progress; clicking back into an earlier field
    // shouldn't walk the funnel backwards.
    if (index > deepestIndex) {
      deepestIndex = index;
      deepestField = fieldName;
      record('form_field_progress',
             { form_id: 'leadForm', field: fieldName, step: index + 1 },
             'form_deepest_field', fieldName);
    }
  }

  // Delegated so it covers every lead form on every template without each
  // one needing its own wiring.
  document.addEventListener('focusin', function (e) {
    var el = e.target;
    if (!el || !el.name) return;
    if (!el.form || el.form.id !== 'leadForm') return;
    noteFieldEngagement(el.name);
  }, true);

  // main.js owns the actual submit pipeline and fires this once the server
  // has confirmed the lead, just before the redirect to /thank-you/.
  document.addEventListener('tcfh:lead-success', function () {
    formSubmitted = true;
    record('generate_lead',
           { form_id: 'leadForm', currency: 'USD', value: 1 },
           'converted', 'yes');
  });

  document.addEventListener('tcfh:lead-error', function () {
    // A visitor who filled everything in and hit a submit failure is a lost
    // lead that looks identical to an abandon in the raw numbers. Separate it.
    record('form_submit_error', { form_id: 'leadForm' }, 'submit_failed', 'yes');
  });

  // ── Section reach ───────────────────────────────────────────────────
  // Which parts of the page did they actually see? Pairs with Clarity's
  // scroll map: GA4 gives the percentage, Clarity shows what it looked like.

  var sectionsSeen  = {};
  var deepestSection = null;

  function labelForSection(section, index) {
    if (section.id) return section.id;
    var cls = (section.className || '').split(/\s+/).filter(function (c) {
      return c && c !== 'section' && c !== 'section--alt';
    })[0];
    return cls || 'section-' + (index + 1);
  }

  function observeSections() {
    var sections = document.querySelectorAll('main section, .site-main section, section');
    if (!sections.length || !('IntersectionObserver' in window)) return;

    var labels = [];
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;

        var label = entry.target.getAttribute('data-analytics-section');
        if (!label || sectionsSeen[label]) return;

        sectionsSeen[label] = true;
        deepestSection = label;
        ga('section_view', { section: label, position: labels.indexOf(label) + 1 });
        observer.unobserve(entry.target);
      });
    }, {
      // Half the section must be on screen before it counts as "seen",
      // so fast scrolling past doesn't register as engagement.
      threshold: 0.5
    });

    Array.prototype.forEach.call(sections, function (section, i) {
      var label = labelForSection(section, i);
      labels.push(label);
      section.setAttribute('data-analytics-section', label);
      observer.observe(section);
    });
  }

  // ── Scroll depth ────────────────────────────────────────────────────
  // GA4 enhanced measurement only reports the 90% mark, which is too coarse
  // to locate a drop-off. These fill in the earlier thresholds.

  var DEPTHS = [25, 50, 75, 90];
  var depthsFired = {};
  var maxDepth = 0;

  function checkScrollDepth() {
    var doc = document.documentElement;
    var scrollable = doc.scrollHeight - window.innerHeight;
    if (scrollable <= 0) return;

    var percent = Math.min(100, Math.round(((window.scrollY || 0) / scrollable) * 100));
    if (percent > maxDepth) maxDepth = percent;

    DEPTHS.forEach(function (threshold) {
      if (percent >= threshold && !depthsFired[threshold]) {
        depthsFired[threshold] = true;
        ga('scroll_depth', { percent_scrolled: threshold });
      }
    });
  }

  var scrollQueued = false;
  window.addEventListener('scroll', function () {
    if (scrollQueued) return;
    scrollQueued = true;
    requestAnimationFrame(function () {
      scrollQueued = false;
      checkScrollDepth();
    });
  }, { passive: true });

  // ── Phone / CTA clicks ──────────────────────────────────────────────
  // A call is a conversion the form never sees. Without this, every visitor
  // who phoned instead of submitting looks like a bounce.

  document.addEventListener('click', function (e) {
    var link = e.target.closest && e.target.closest('a[href^="tel:"]');
    if (link) {
      record('phone_click',
             { link_location: nearestSectionLabel(link) },
             'called', 'yes');
      return;
    }

    var cta = e.target.closest && e.target.closest('a[href*="#get-offer"], a[href*="#hero-form"]');
    if (cta) {
      ga('cta_click', { link_location: nearestSectionLabel(cta) });
    }
  }, true);

  function nearestSectionLabel(el) {
    var section = el.closest && el.closest('section');
    if (section && section.getAttribute('data-analytics-section')) {
      return section.getAttribute('data-analytics-section');
    }
    return el.closest && el.closest('nav') ? 'navbar'
         : el.closest && el.closest('footer') ? 'footer'
         : 'unknown';
  }

  // ── Exit snapshot ───────────────────────────────────────────────────
  // Fires once as the visitor leaves. This is the event that actually answers
  // "where did they click off": the last section they reached, how far they
  // scrolled, and — if they started the form — which field they stalled on.

  var exitReported = false;

  function reportExit() {
    if (exitReported) return;
    exitReported = true;

    if (formStarted && !formSubmitted) {
      record('form_abandon',
             { form_id: 'leadForm', abandoned_at: deepestField || 'unknown' },
             'form_abandoned_at', deepestField || 'unknown');
    }

    ga('exit_snapshot', {
      deepest_section:  deepestSection || 'none',
      max_scroll:       maxDepth,
      reached_form:     formStarted ? 'yes' : 'no',
      converted:        formSubmitted ? 'yes' : 'no'
    });

    clarityTag('deepest_section', deepestSection || 'none');
    clarityTag('max_scroll_bucket', maxDepth >= 90 ? '90+'
                                  : maxDepth >= 75 ? '75-89'
                                  : maxDepth >= 50 ? '50-74'
                                  : maxDepth >= 25 ? '25-49'
                                  : '0-24');
  }

  // visibilitychange is the only exit signal that fires reliably on mobile
  // Safari; pagehide covers desktop back/forward navigation.
  document.addEventListener('visibilitychange', function () {
    if (document.visibilityState === 'hidden') reportExit();
  });
  window.addEventListener('pagehide', reportExit);

  // ── Init ────────────────────────────────────────────────────────────

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      observeSections();
      checkScrollDepth();
    });
  } else {
    observeSections();
    checkScrollDepth();
  }
})();
