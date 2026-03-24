<!-- ── FOOTER ── -->
<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <div>
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/brand_assets/Tennessee%20Cash%20For%20Homes%20Logo.png" alt="Tennessee Cash For Homes" class="footer__logo" />
        <p class="footer__about">Tennessee Cash For Homes is a locally owned, 5-star rated cash home buying company. We help Tennessee homeowners sell their houses fast. Any condition, any situation, zero fees.</p>
        <div style="margin-top:16px;">
          <a href="https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick" target="_blank" rel="nofollow">
            <img src="https://seal-nashville.bbb.org/seals/blue-seal-200-42-whitetxt-bbb-37373815.png" style="border: 0; height: 42px; width: auto;" alt="Tennessee Cash For Homes BBB Business Review" />
          </a>
        </div>
      </div>
      <div class="footer__col">
        <h4>Company</h4>
        <ul class="footer__links">
          <li><a href="<?php echo esc_url( home_url( '/how-it-works/' ) ); ?>">How It Works</a></li>
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a></li>
          <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
          <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
          <li><a href="<?php echo esc_url( home_url( '/investors-and-lenders/' ) ); ?>">Investors &amp; Lenders</a></li>
        </ul>
      </div>
      <div class="footer__col">
        <h4>Contact Us</h4>
        <div class="footer__contact">
          <div><a href="tel:+16158018126">(615) 801-8126</a></div>
          <div><a href="mailto:info@tncashforhomes.com">info@tncashforhomes.com</a></div>
          <div>Nashville, Tennessee</div>
        </div>
      </div>
    </div>
    <div class="footer__bottom">
      <span>&copy; <?php echo date( 'Y' ); ?> Tennessee Cash For Homes. All rights reserved.</span>
      <div style="display:flex;gap:20px;">
        <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
        <a href="#">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>

<script>
  // Mobile nav toggle
  const hamburger = document.getElementById('hamburger');
  const navLinks  = document.getElementById('navLinks');
  hamburger.addEventListener('click', () => navLinks.classList.toggle('open'));
  hamburger.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') navLinks.classList.toggle('open');
  });

  // Close mobile nav on link click
  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => navLinks.classList.remove('open'));
  });

  // FAQ accordion
  function toggleFaq(el) {
    const item   = el.closest('.faq-item');
    const answer = item.querySelector('.faq-answer');
    const isOpen = item.classList.contains('open');

    document.querySelectorAll('.faq-item').forEach(i => {
      i.classList.remove('open');
      i.querySelector('.faq-answer').classList.remove('open');
    });

    if (!isOpen) {
      item.classList.add('open');
      answer.classList.add('open');
    }
  }

  // Lead form submits to WordPress AJAX endpoint
  async function handleSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const btn  = form.querySelector('.btn-primary');

    btn.textContent = 'Sending\u2026';
    btn.disabled = true;

    try {
      const formData = new FormData();
      formData.append('action',    'tcfh_submit_lead');
      formData.append('nonce',     (typeof tcfh_ajax !== 'undefined') ? tcfh_ajax.nonce : '');
      formData.append('name',      form.name.value.trim());
      formData.append('phone',     form.phone.value.trim());
      formData.append('address',   form.address.value.trim());
      const ajaxUrl = (typeof tcfh_ajax !== 'undefined')
        ? tcfh_ajax.ajax_url
        : '/wp-admin/admin-ajax.php';

      const res  = await fetch(ajaxUrl, { method: 'POST', body: formData });
      const data = await res.json();

      if (!data.success) throw new Error(data.data?.error || 'Submission failed');

      btn.textContent = '\u2714 Request Received! We\'ll call you shortly.';
      btn.style.background = '#3d8c5e';
      form.reset();
    } catch (err) {
      console.error(err);
      btn.textContent = 'Something went wrong. Please call us directly.';
      btn.style.background = '#c0392b';
      btn.disabled = false;
    }
  }

  // Smooth nav highlight on scroll
  const sections   = document.querySelectorAll('section[id]');
  const navAnchors = document.querySelectorAll('.nav__links a[href*="#"]');

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

  // ── Reviews Carousel ──
  (function () {
    const track    = document.getElementById('reviewsTrack');
    const outer    = document.getElementById('reviewsOuter');
    const dotsWrap = document.getElementById('revDots');
    const btnPrev  = document.getElementById('revPrev');
    const btnNext  = document.getElementById('revNext');
    const TOTAL    = track ? track.children.length : 0;
    if (!TOTAL) return;

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
</script>

<?php wp_footer(); ?>
</body>
</html>
