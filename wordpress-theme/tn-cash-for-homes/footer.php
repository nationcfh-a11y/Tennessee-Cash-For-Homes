<!-- ── FOOTER ── -->
<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <div>
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/brand_assets/Tennessee%20Cash%20For%20Homes%20Logo.png" alt="Tennessee Cash For Homes - We Buy Houses Fast For Cash" class="footer__logo" loading="lazy" />
        <p class="footer__about">Tennessee Cash For Homes is a locally owned, 5-star rated cash home buying company. We help Tennessee homeowners sell their houses fast. Any condition, any situation, zero fees.</p>
        <div style="margin-top:16px;">
          <a href="https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick" target="_blank" rel="nofollow">
            <img src="https://seal-nashville.bbb.org/seals/blue-seal-200-42-whitetxt-bbb-37373815.png" style="border: 0; height: 42px; width: auto;" alt="Tennessee Cash For Homes BBB Business Review" loading="lazy" />
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
          <div>Murfreesboro, Tennessee</div>
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

  // Resources dropdown
  (function() {
    const dropdown = document.querySelector('.nav__dropdown');
    if (!dropdown) return;
    const toggle = dropdown.querySelector('.nav__dropdown-toggle');
    const menu   = dropdown.querySelector('.nav__dropdown-menu');
    let hoverTimeout;

    function open()  { dropdown.classList.add('open');    toggle.setAttribute('aria-expanded', 'true'); }
    function close() { dropdown.classList.remove('open'); toggle.setAttribute('aria-expanded', 'false'); }

    // Desktop: hover
    dropdown.addEventListener('mouseenter', () => { clearTimeout(hoverTimeout); open(); });
    dropdown.addEventListener('mouseleave', () => { hoverTimeout = setTimeout(close, 200); });

    // Click/tap toggle (mobile + desktop fallback)
    toggle.addEventListener('click', e => { e.preventDefault(); dropdown.classList.contains('open') ? close() : open(); });

    // Keyboard navigation
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

    // Close on outside click
    document.addEventListener('click', e => { if (!dropdown.contains(e.target)) close(); });
  })();

  // ══════════════════════════════════════════════
  // MULTI-STEP FORM ENGINE
  // ══════════════════════════════════════════════
  (function() {
    const form = document.getElementById('multiStepForm');
    if (!form) return;

    const formData = {};
    const uploadedFiles = [];
    let currentStep = parseInt(sessionStorage.getItem('msfStep') || '1', 10);

    // Restore step from sessionStorage
    if (currentStep > 1 && currentStep <= 6) {
      showStep(currentStep);
    }

    // Option card selection
    form.querySelectorAll('.msf-option-card').forEach(card => {
      card.addEventListener('click', function() {
        const field = this.dataset.field;
        const value = this.dataset.value;
        // Deselect siblings
        this.closest('.msf-card-grid').querySelectorAll('.msf-option-card').forEach(c => c.classList.remove('selected'));
        this.classList.add('selected');
        formData[field] = value;
      });
    });

    // Pill selection
    form.querySelectorAll('.msf-pill').forEach(pill => {
      pill.addEventListener('click', function() {
        const field = this.dataset.field || this.closest('.msf-toggle-group')?.dataset.field;
        const value = this.dataset.value;
        // Deselect siblings in same row/group
        const parent = this.closest('.msf-pill-row') || this.closest('.msf-toggle-group');
        parent.querySelectorAll('.msf-pill').forEach(p => p.classList.remove('selected'));
        this.classList.add('selected');
        if (field) formData[field] = value;
      });
    });

    // File upload
    const uploadZone = document.getElementById('msfUploadZone');
    const fileInput = document.getElementById('msfFileInput');
    const thumbnails = document.getElementById('msfThumbnails');

    if (uploadZone) {
      uploadZone.addEventListener('click', () => fileInput.click());
      uploadZone.addEventListener('dragover', e => { e.preventDefault(); uploadZone.style.borderColor = '#84CC9C'; });
      uploadZone.addEventListener('dragleave', () => { uploadZone.style.borderColor = ''; });
      uploadZone.addEventListener('drop', e => {
        e.preventDefault();
        uploadZone.style.borderColor = '';
        handleFiles(e.dataTransfer.files);
      });
      fileInput.addEventListener('change', () => handleFiles(fileInput.files));
    }

    function handleFiles(files) {
      Array.from(files).forEach(file => {
        if (file.size > 10 * 1024 * 1024) return;
        uploadedFiles.push(file);
        const reader = new FileReader();
        reader.onload = e => {
          const wrap = document.createElement('div');
          wrap.className = 'msf-thumb-wrap';
          wrap.innerHTML = '<img class="msf-thumb" src="' + e.target.result + '" alt="Property photo upload" /><button type="button" class="msf-thumb-remove">&times;</button>';
          wrap.querySelector('.msf-thumb-remove').addEventListener('click', function() {
            const idx = Array.from(thumbnails.children).indexOf(wrap);
            uploadedFiles.splice(idx, 1);
            wrap.remove();
          });
          thumbnails.appendChild(wrap);
        };
        reader.readAsDataURL(file);
      });
    }

    // Step navigation
    window.msfNext = function(step) {
      // Validate
      if (step === 1) {
        const addr = document.getElementById('msfAddress');
        if (!addr.value.trim()) {
          addr.style.borderColor = '#dc2626';
          addr.focus();
          return;
        }
        formData.address = addr.value.trim();
      }
      if (step === 6) return; // submit handles step 6
      showStep(step + 1);
    };

    window.msfBack = function(step) {
      showStep(step - 1);
    };

    function showStep(step) {
      currentStep = step;
      sessionStorage.setItem('msfStep', step);
      form.querySelectorAll('.msf-step').forEach(s => s.classList.remove('active'));
      const target = form.querySelector('[data-step="' + step + '"]');
      if (target) {
        target.classList.add('active');
        target.style.display = '';
      }
      // Update progress
      const label = document.getElementById('msfStepNum');
      const fill = document.getElementById('msfProgressFill');
      if (label) label.textContent = step;
      if (fill) fill.style.width = ((step / 6) * 100) + '%';
    }

    // Form submit
    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      const name = document.getElementById('msfName').value.trim();
      const phone = document.getElementById('msfPhone').value.trim();
      const email = document.getElementById('msfEmail').value.trim();

      if (!name || !phone || !email) {
        if (!name) document.getElementById('msfName').style.borderColor = '#dc2626';
        if (!phone) document.getElementById('msfPhone').style.borderColor = '#dc2626';
        if (!email) document.getElementById('msfEmail').style.borderColor = '#dc2626';
        return;
      }

      formData.name = name;
      formData.phone = phone;
      formData.email = email;

      const submitBtn = form.querySelector('[type="submit"]');
      submitBtn.textContent = 'Sending\u2026';
      submitBtn.disabled = true;

      try {
        const fd = new FormData();
        fd.append('action', 'tcfh_submit_lead');
        fd.append('nonce', (typeof tcfh_ajax !== 'undefined') ? tcfh_ajax.nonce : '');

        // Append all form data
        Object.keys(formData).forEach(key => fd.append(key, formData[key]));

        const ajaxUrl = (typeof tcfh_ajax !== 'undefined') ? tcfh_ajax.ajax_url : '/wp-admin/admin-ajax.php';
        const res = await fetch(ajaxUrl, { method: 'POST', body: fd });
        const data = await res.json();

        if (!data.success) throw new Error(data.data?.error || 'Submission failed');

        // Show success
        sessionStorage.removeItem('msfStep');
        form.querySelectorAll('.msf-step').forEach(s => { s.classList.remove('active'); s.style.display = 'none'; });
        const successStep = form.querySelector('[data-step="success"]');
        successStep.style.display = 'block';
        successStep.classList.add('active');

        const firstName = name.split(' ')[0];
        document.getElementById('msfFirstName').textContent = firstName;

        // Hide progress
        document.querySelector('.msf-progress').style.display = 'none';
      } catch (err) {
        console.error(err);
        submitBtn.textContent = 'Something went wrong. Please call us at (615) 801-8126';
        submitBtn.style.background = '#dc2626';
        submitBtn.disabled = false;
      }
    });
  })();

  // ══════════════════════════════════════════════
  // NEW FAQ ACCORDION
  // ══════════════════════════════════════════════
  (function() {
    const items = document.querySelectorAll('.faq-acc-item');
    if (!items.length) return;

    items.forEach(item => {
      const btn = item.querySelector('.faq-acc-btn');
      btn.addEventListener('click', () => {
        const isOpen = item.classList.contains('open');
        // Close all
        items.forEach(i => i.classList.remove('open'));
        // Toggle current
        if (!isOpen) item.classList.add('open');
      });
    });
  })();

  // ── LEGACY FAQ (for other pages) ──
  function toggleFaq(el) {
    const item   = el.closest('.faq-item');
    if (!item) return;
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

  // Smooth nav highlight on scroll
  const sections   = document.querySelectorAll('section[id]');
  const navAnchors = document.querySelectorAll('.nav__links a[href*="#"]');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navAnchors.forEach(a => a.classList.remove('active'));
        const active = document.querySelector('.nav__links a[href*="#' + entry.target.id + '"]');
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
      const duration = 1800;
      const start = performance.now();

      function step(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target).toLocaleString();
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target.toLocaleString();
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
