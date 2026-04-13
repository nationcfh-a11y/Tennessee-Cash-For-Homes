(function () {
  'use strict';

  // ── Mobile nav toggle ──
  const hamburger = document.getElementById('hamburger');
  const navLinks  = document.getElementById('navLinks');
  if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => navLinks.classList.toggle('open'));
    hamburger.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') navLinks.classList.toggle('open');
    });
    navLinks.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => navLinks.classList.remove('open'));
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

  // ── Lead form submit → WordPress AJAX (referenced inline via onsubmit) ──
  window.handleSubmit = async function (e) {
    e.preventDefault();
    const form = e.target;
    const btn  = form.querySelector('.btn-primary');

    btn.textContent = 'Sending\u2026';
    btn.disabled = true;

    const formData = new FormData();
    formData.append('action',  'tcfh_submit_lead');
    formData.append('nonce',   (typeof tcfh_ajax !== 'undefined') ? tcfh_ajax.nonce : '');
    formData.append('name',    form.name.value.trim());
    formData.append('phone',   form.phone.value.trim());
    formData.append('address', form.address.value.trim());
    const ajaxUrl = (typeof tcfh_ajax !== 'undefined')
      ? tcfh_ajax.ajax_url
      : '/wp-admin/admin-ajax.php';

    try {
      const res  = await fetch(ajaxUrl, { method: 'POST', body: formData });
      const data = await res.json();
      if (!data.success) console.error('Lead submission error:', data.data?.error);
    } catch (err) {
      console.error('Lead submission failed:', err);
    }

    window.location.href = '/thank-you/';
  };

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
  document.querySelectorAll('.testimonial-card').forEach(function (card) {
    const body = card.querySelector('.testimonial-body');
    if (!body) return;

    const btn = document.createElement('button');
    btn.className = 'testimonial-toggle hidden';
    btn.textContent = 'View Full Review';
    body.insertAdjacentElement('afterend', btn);

    function checkClamp() {
      card.classList.remove('expanded');
      btn.textContent = 'View Full Review';
      if (body.scrollHeight > body.clientHeight + 1) {
        btn.classList.remove('hidden');
      } else {
        btn.classList.add('hidden');
      }
    }
    checkClamp();
    window.addEventListener('resize', checkClamp);
    btn.addEventListener('click', function () {
      const isExpanded = card.classList.toggle('expanded');
      btn.textContent = isExpanded ? 'Show Less' : 'View Full Review';
    });
  });

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
})();
