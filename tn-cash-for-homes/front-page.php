<?php get_header(); ?>

<!-- ── HERO ── -->
<section class="hero" id="hero-form">
  <div class="hero__overlay" style="background: linear-gradient(135deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.40) 100%);"></div>
  <div class="container">
    <div class="hero__inner">
      <div class="hero__content">
        <div class="hero__badge">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
            <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Trusted Tennessee Cash Buyers
        </div>
        <h1 class="hero__title">
          <span class="hero__title--white">Sell Your House Fast in Tennessee</span>
          <span class="hero__title--green"> for Cash</span>
        </h1>
        <p class="hero__subtitle">
          We buy houses as-is across Tennessee. As local cash home buyers in Tennessee, we make a fair cash offer in as little as 24 hours, with no repairs, commissions, or fees, and we close on your timeline.
        </p>
        <div class="hero__cta-row">
          <a href="#get-offer" class="hero__btn-primary">Get My Cash Offer</a>
          <a href="tel:+16158018126" class="hero__btn-outline">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            Call Us Today - (615) 801-8126
          </a>
        </div>
        <div class="hero__trust-row">
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            No Agent Fees
          </span>
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Close in 7 Days
          </span>
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Any Condition
          </span>
        </div>
      </div>

      <div class="hero__form-card" id="get-offer">
        <h2 class="form-card__title">Get Your Free Cash Offer</h2>
        <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
        <form id="leadForm" onsubmit="handleSubmit(event)">
          <input type="hidden" name="lead_source" value="Homepage" />
          <div class="form-group">
            <label for="address">Property Address</label>
            <input type="text" id="address" name="address" placeholder="123 Main St, Nashville, TN" required />
          </div>
          <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="John Smith" required />
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="(615) 555-0123" required />
          </div>
          <button type="submit" class="btn-primary btn-primary--block">
            Get My Cash Offer &rarr;
          </button>
        </form>
        <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
      </div>
    </div>
  </div>
</section>

<?php get_template_part('stats-strip'); ?>

<!-- ── HOW IT WORKS ── -->
<section class="section" id="how-it-works">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Fast &amp; Simple Process</p>
      <h2 class="section__title">How to Sell Your House Fast for Cash in Tennessee</h2>
      <p class="section__subtitle">No showings, no open houses, no waiting around. Selling your Tennessee home for cash has never been this simple.</p>
    </div>
    <div class="steps">
      <div class="step">
        <div class="step__num">1</div>
        <h3 class="step__title">Tell Us About Your Tennessee Property</h3>
        <p class="step__body">Fill out our quick form or give us a call. Share your property address and a few basic details. It takes less than 60 seconds and there is no obligation.</p>
      </div>
      <div class="step">
        <div class="step__num">2</div>
        <h3 class="step__title">Receive Your Free Cash Offer in 24 Hours</h3>
        <p class="step__body">We evaluate your property and send you a no-obligation, all-cash offer fast. Usually within 24 hours. No hidden fees, no lowball tactics, no pressure.</p>
      </div>
      <div class="step">
        <div class="step__num">3</div>
        <h3 class="step__title">Pick Your Closing Date &amp; Get Paid</h3>
        <p class="step__body">Accept the offer and choose a closing date that works for you. We can close in as little as 7 days or give you more time if you need it. We handle all the paperwork and cover the closing costs.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── HOUSE TO CASH ANIMATION ── -->
<section class="house-to-cash-section" id="house-to-cash">
  <div class="htc-inner">
    <div class="htc-label-row">
      <span class="htc-label htc-label-house">Your House</span>
      <span class="htc-arrow">&rarr;</span>
      <span class="htc-label htc-label-cash">Your Cash</span>
    </div>
    <div class="htc-image-container">
      <img
        src="<?php echo get_template_directory_uri(); ?>/brand_assets/House_Image.webp"
        srcset="<?php echo get_template_directory_uri(); ?>/brand_assets/House_Image-550w.webp 550w,
                <?php echo get_template_directory_uri(); ?>/brand_assets/House_Image-800w.webp 800w,
                <?php echo get_template_directory_uri(); ?>/brand_assets/House_Image.webp 1100w"
        sizes="(max-width: 550px) 88vw, (max-width: 900px) 800px, 900px"
        alt="Sell your house fast for cash in Tennessee"
        class="htc-img htc-house-img"
        width="1100" height="516" loading="lazy" decoding="async" />
      <img
        src="<?php echo get_template_directory_uri(); ?>/brand_assets/money_image2.webp"
        srcset="<?php echo get_template_directory_uri(); ?>/brand_assets/money_image2-550w.webp 550w,
                <?php echo get_template_directory_uri(); ?>/brand_assets/money_image2-800w.webp 800w,
                <?php echo get_template_directory_uri(); ?>/brand_assets/money_image2.webp 1100w"
        sizes="(max-width: 550px) 88vw, (max-width: 900px) 800px, 900px"
        alt="Get cash for your Tennessee home"
        class="htc-img htc-cash-img"
        width="1100" height="665" loading="lazy" decoding="async" />
    </div>
    <div class="htc-headline-wrap">
      <p class="htc-eyebrow">No Repairs. No Fees. No Hassle.</p>
      <h2 class="htc-headline">Get a Fair Cash Offer in 24 Hours</h2>
    </div>
  </div>
  <script>
  (function() {
      var section, houseImg, cashImg, headlineWrap, pinned = false, sectionTop = 0, pinHeight = 150, scrollY = 0;
      var resizeRaf = 0;

      function init() {
          section  = document.querySelector('.house-to-cash-section');
          houseImg = document.querySelector('.htc-house-img');
          cashImg  = document.querySelector('.htc-cash-img');
          headlineWrap = document.querySelector('.htc-headline-wrap');
          if (!section || !houseImg || !cashImg) return;
          measure();
          window.addEventListener('scroll', onScroll, { passive: true });
          window.addEventListener('resize', onResize, { passive: true });
          onScroll();
      }

      // Coalesce resize events to one rAF tick so we don't getBoundingClientRect
      // on every event (each call would force a synchronous layout).
      function onResize() {
          if (resizeRaf) return;
          resizeRaf = requestAnimationFrame(function () {
              resizeRaf = 0;
              measure();
          });
      }

      function measure() {
          if (section.style.position === 'fixed') {
              section.style.position = '';
              section.style.top = '';
              section.style.left = '';
              section.style.width = '';
          }
          sectionTop = section.getBoundingClientRect().top + window.pageYOffset;
          section._placeholder && section._placeholder.remove();
      }

      function onScroll() {
          scrollY = window.pageYOffset;
          if (!pinned) requestAnimationFrame(render);
          pinned = true;
      }

      function render() {
          pinned = false;
          var start = sectionTop;
          var end = start + pinHeight;
          var y = scrollY;

          if (y >= start && y <= end) {
              if (section.style.position !== 'fixed') {
                  if (!section._placeholder) {
                      var ph = document.createElement('div');
                      ph.style.height = section.offsetHeight + pinHeight + 'px';
                      section.parentNode.insertBefore(ph, section);
                      section._placeholder = ph;
                  }
                  section.style.position = 'fixed';
                  section.style.top = '0';
                  section.style.left = '0';
                  section.style.width = '100%';
                  section.style.zIndex = '10';
              }
              var p = (y - start) / pinHeight;
              var imgP = Math.min(p / 0.6, 1);
              var textP = p > 0.6 ? (p - 0.6) / 0.4 : 0;
              houseImg.style.opacity = (1 - imgP);
              cashImg.style.opacity = imgP;
              if (headlineWrap) headlineWrap.style.opacity = textP;
          } else {
              if (section.style.position === 'fixed') {
                  section.style.position = '';
                  section.style.top = '';
                  section.style.left = '';
                  section.style.width = '';
                  section.style.zIndex = '';
              }
              if (y > end) {
                  houseImg.style.opacity = '0';
                  cashImg.style.opacity = '1';
                  if (headlineWrap) headlineWrap.style.opacity = '1';
              } else {
                  houseImg.style.opacity = '1';
                  cashImg.style.opacity = '0';
                  if (headlineWrap) headlineWrap.style.opacity = '0';
              }
              if (section._placeholder) {
                  section._placeholder.remove();
                  section._placeholder = null;
              }
          }
      }

      if (document.readyState === 'complete') init();
      else window.addEventListener('load', init);
  })();
  </script>
</section>

<?php get_template_part( 'difference-section' ); ?>

<!-- ── COMMON SITUATIONS ── -->
<section class="common-situations" id="situations">
  <div class="container">
    <div class="common-situations__header">
      <p class="section__eyebrow">Whatever Your Situation</p>
      <h2 class="common-situations__title">Common Reasons Tennessee Homeowners Sell For Cash</h2>
      <p class="common-situations__sub">Whatever your situation we have a fast fair solution. Click your situation below to learn more.</p>
      <div class="common-situations__divider"></div>
    </div>
    <div class="common-situations__grid">

      <a href="<?php echo esc_url( home_url('/sell-my-house-foreclosure-tennessee/') ); ?>" class="situation-card">
        <div class="situation-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><line x1="9" y1="22" x2="9" y2="12"/><line x1="15" y1="22" x2="15" y2="12"/><line x1="9" y1="12" x2="15" y2="12"/></svg></div>
        <h3 class="situation-card__title">Facing Foreclosure</h3>
        <p class="situation-card__desc">Received foreclosure notices or falling behind on payments? We can close fast enough to stop the process.</p>
        <span class="situation-card__link">Learn More &rarr;</span>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-my-house-divorce-tennessee/') ); ?>" class="situation-card">
        <div class="situation-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M12 1v22"/><path d="M5 5l14 14"/><path d="M19 5L5 19"/></svg></div>
        <h3 class="situation-card__title">Going Through Divorce</h3>
        <p class="situation-card__desc">Need a fast fair sale without months of showings and negotiations? We make divorce home sales simple.</p>
        <span class="situation-card__link">Learn More &rarr;</span>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-inherited-house-tennessee/') ); ?>" class="situation-card">
        <div class="situation-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
        <h3 class="situation-card__title">Inherited a Property</h3>
        <p class="situation-card__desc">Inherited a home you do not want to manage? We buy as-is with contents included and work with probate attorneys.</p>
        <span class="situation-card__link">Learn More &rarr;</span>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-my-house-relocating-tennessee/') ); ?>" class="situation-card">
        <div class="situation-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg></div>
        <h3 class="situation-card__title">Relocating or Moving</h3>
        <p class="situation-card__desc">Moving for work or family? Sell fast and avoid double mortgage payments or carrying costs from out of state.</p>
        <span class="situation-card__link">Learn More &rarr;</span>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-house-as-is-tennessee/') ); ?>" class="situation-card">
        <div class="situation-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
        <h3 class="situation-card__title">Major Repairs Needed</h3>
        <p class="situation-card__desc">Home needs major work? We buy houses in any condition, with no repairs, no contractors, and no hassle.</p>
        <span class="situation-card__link">Learn More &rarr;</span>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-rental-property-tennessee/') ); ?>" class="situation-card">
        <div class="situation-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg></div>
        <h3 class="situation-card__title">Tired Landlord</h3>
        <p class="situation-card__desc">Done with tenants and maintenance? We buy rental properties with tenants in place for a fast clean exit.</p>
        <span class="situation-card__link">Learn More &rarr;</span>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-house-behind-on-taxes-tennessee/') ); ?>" class="situation-card">
        <div class="situation-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
        <h3 class="situation-card__title">Behind on Taxes</h3>
        <p class="situation-card__desc">Delinquent property taxes growing? Sell fast and pay off the tax debt at closing before it becomes a lien.</p>
        <span class="situation-card__link">Learn More &rarr;</span>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-my-house-downsizing-tennessee/') ); ?>" class="situation-card">
        <div class="situation-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg></div>
        <h3 class="situation-card__title">Downsizing</h3>
        <p class="situation-card__desc">Ready for a simpler smaller life? We make downsizing easy with flexible closing dates and no repairs required.</p>
        <span class="situation-card__link">Learn More &rarr;</span>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-house-probate-tennessee/') ); ?>" class="situation-card">
        <div class="situation-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M12 18v-6"/><path d="M9 15h6"/></svg></div>
        <h3 class="situation-card__title">Probate Sale</h3>
        <p class="situation-card__desc">Selling an estate through probate? We work with attorneys and close fast once the court approves the sale.</p>
        <span class="situation-card__link">Learn More &rarr;</span>
      </a>

    </div>
  </div>
</section>

<!-- ── VIDEO ── -->
<section class="section video-section">
  <div class="container">
    <div class="video-section__inner">
      <div class="video-section__content">
        <p class="section__eyebrow">See Us in Action</p>
        <h2 class="video-section__title">
          <span style="display:block;">Watch How We Help</span>
          <span style="display:block; white-space:nowrap;" class="video-section__title--green">Tennessee Homeowners</span>
          <span style="display:block;">Sell Fast for Cash</span>
        </h2>
        <p class="video-section__body">Hear directly from homeowners just like you who sold their Tennessee house fast, with no repairs, no fees, and no stress. See exactly what the process looks like from your first call all the way to closing day.</p>
        <a href="<?php echo esc_url( home_url( '/#hero-form' ) ); ?>" class="btn-primary">Get My Free Cash Offer &rarr;</a>
      </div>
      <div class="video-section__media">
        <div class="video-section__embed">
          <iframe src="https://www.youtube.com/embed/lG64DriT_PU" title="Tennessee Cash For Homes" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── COMPARISON ── -->
<section class="section">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">See the Difference</p>
      <h2 class="section__title">Selling to a Cash Buyer vs. Listing with a Tennessee Real Estate Agent</h2>
      <p class="section__subtitle">The traditional listing route works for some people. But if speed, certainty, and zero out-of-pocket costs matter to you, we are the smarter choice.</p>
    </div>
    <div class="compare-wrap">
      <table class="compare-table">
        <thead>
          <tr>
            <th scope="col"><span class="visually-hidden">Feature</span></th>
            <th scope="col">Tennessee Cash For Homes</th>
            <th scope="col">Traditional Listing</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Closing timeline</th>
            <td><span class="check">✔</span> As fast as 7 days</td>
            <td><span class="cross">60 to 90+ days</span></td>
          </tr>
          <tr>
            <th scope="row">Repairs required</th>
            <td><span class="check">✔</span> None, buy as-is</td>
            <td><span class="cross">Often required</span></td>
          </tr>
          <tr>
            <th scope="row">Agent commissions</th>
            <td><span class="check">✔</span> $0</td>
            <td><span class="cross">5 to 6% of sale price</span></td>
          </tr>
          <tr>
            <th scope="row">Closing costs</th>
            <td><span class="check">✔</span> We cover them</td>
            <td><span class="cross">2 to 3% of sale price</span></td>
          </tr>
          <tr>
            <th scope="row">Showings &amp; open houses</th>
            <td><span class="check">✔</span> None</td>
            <td><span class="cross">Many required</span></td>
          </tr>
          <tr>
            <th scope="row">Financing contingencies</th>
            <td><span class="check">✔</span> No, all cash</td>
            <td><span class="cross">Deals can fall through</span></td>
          </tr>
          <tr>
            <th scope="row">Certainty of sale</th>
            <td><span class="check">✔</span> Guaranteed</td>
            <td><span class="cross">Not guaranteed</span></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Mobile-only comparison table (hidden on desktop via mobile-optimization.css) -->
    <div class="compare-mobile-wrap" aria-hidden="false">
      <table class="compare-mobile">
        <thead>
          <tr>
            <th scope="col" class="compare-mobile__corner"><span class="visually-hidden">Feature</span></th>
            <th scope="col" class="compare-mobile__brand-head">Tennessee Cash For Homes</th>
            <th scope="col" class="compare-mobile__trad-head">Traditional</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Commissions</th>
            <td class="compare-mobile__brand">$0</td>
            <td class="compare-mobile__trad">5–6%</td>
          </tr>
          <tr>
            <th scope="row">Repair Costs</th>
            <td class="compare-mobile__brand">$0</td>
            <td class="compare-mobile__trad">Varies</td>
          </tr>
          <tr>
            <th scope="row">Closing Costs</th>
            <td class="compare-mobile__brand">We Cover Them</td>
            <td class="compare-mobile__trad">2–3%</td>
          </tr>
          <tr>
            <th scope="row">Avg. Days to Close</th>
            <td class="compare-mobile__brand">7 Days</td>
            <td class="compare-mobile__trad">60–90 Days</td>
          </tr>
          <tr>
            <th scope="row">Showings</th>
            <td class="compare-mobile__brand">None</td>
            <td class="compare-mobile__trad">Multiple</td>
          </tr>
          <tr>
            <th scope="row">As-Is Sale</th>
            <td class="compare-mobile__brand">Yes</td>
            <td class="compare-mobile__trad">No</td>
          </tr>
          <tr>
            <th scope="row">Certainty of Sale</th>
            <td class="compare-mobile__brand">Guaranteed</td>
            <td class="compare-mobile__trad">Not Guaranteed</td>
          </tr>
          <tr>
            <th scope="row">Financing Contingencies</th>
            <td class="compare-mobile__brand">None</td>
            <td class="compare-mobile__trad">Common</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php get_template_part( 'reviews-section', null, array( 'carousel' => 'home' ) ); ?>

<!-- ── FAQ ── -->
<section class="section" id="faq">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Got Questions?</p>
      <h2 class="section__title">Frequently Asked Questions About Selling Your House for Cash in Tennessee</h2>
    </div>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          Who can buy my house fast in Tennessee?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">Three kinds of buyers can actually close quickly, and they are not equally fast. A cash home buying company like Tennessee Cash For Homes makes all-cash offers with no bank financing contingency, so there is no lender, no appraisal contingency, and nothing to fall through at underwriting. An individual investor can also pay cash, though the timeline depends on whether their money is liquid. A traditional buyer using a mortgage is the slowest, usually 30 to 45 days, and that sale can still collapse late. We are a Middle Tennessee family owned business, we buy directly, and we can close in as little as 7 days on the date you choose.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          Is the cash offer really free with no obligation?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">Absolutely. Our cash offers are 100% free and come with zero obligation. We'll present you with a number, and you decide whether to accept, decline, or take time to think. No pressure, ever.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          What types of homes do you buy?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">We buy all types of residential properties across Tennessee: single-family homes, condos, townhouses, duplexes, and multi-family properties. We purchase homes in any condition: move-in ready, distressed, fire-damaged, flood-damaged, or anything in between.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          How do you determine your offer price?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">Our offer is based on comparable sales in your area, the current condition of the property, location, and recent market trends. We aim to give you the fairest possible offer, one that reflects real value while accounting for the as-is condition of the home.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          Do I need to clean out the house before closing?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">No. You can take what you want and leave the rest. We handle all cleanout after closing at no cost to you. This is one of the biggest conveniences we offer, and it is especially helpful for inherited properties or situations where clearing everything out just is not practical.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          What if I'm behind on mortgage payments or facing foreclosure?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">We can often help in pre-foreclosure situations. Selling before a foreclosure completes can protect your credit and put cash in your pocket. Time is critical in these cases, so reach out to us as soon as possible so we can explore your options together.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          Which areas of Tennessee do you serve?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">We buy homes throughout Tennessee including Nashville, Memphis, Knoxville, Chattanooga, Murfreesboro, Franklin, Clarksville, Shelbyville, Smyrna, Gallatin, Columbia, Spring Hill, Lebanon, Jackson, Hendersonville, Crossville, McMinnville, Old Hickory, Woodbury and surrounding areas. If you are not sure whether we cover your area, just reach out and we will let you know.</div>
      </div>
    </div>
  </div>
</section>

<!-- ── SELL YOUR LAND ── -->
<section class="land-section" id="sell-land">
  <div class="container land-section__inner">
    <div class="land-section__content">
      <div class="land-section__accent"></div>
      <div class="land-section__text">
        <span class="land-section__badge">Tennessee Land Buyers</span>
        <h2 class="land-section__title">Sell Your Land for Cash<br>Fast &amp; Easy</h2>
        <p class="land-section__body">We buy vacant land, rural acreage, wooded lots, and unwanted property all across Tennessee. No commissions, no delays, and no hassle.</p>
        <ul class="land-section__list">
          <li><span class="land-section__pill">Vacant Lots &amp; Acreage</span></li>
          <li><span class="land-section__pill">24-Hour Cash Offers</span></li>
          <li><span class="land-section__pill">Zero Commissions</span></li>
        </ul>
      </div>
    </div>
    <div class="land-section__form-wrap">
      <div class="land-section__form-card">
        <h2 class="land-section__form-title">Get Your Land Cash Offer</h2>
        <p class="land-section__form-sub">Takes less than 60 seconds. No obligation.</p>
        <form onsubmit="handleSubmit(event)">
          <input type="hidden" name="lead_source" value="Homepage" />
          <div class="form-group">
            <label for="land-address">Property Address</label>
            <input type="text" id="land-address" name="address" placeholder="123 Acres Rd, Nashville, TN" required />
          </div>
          <div class="form-group">
            <label for="land-name">Your Name</label>
            <input type="text" id="land-name" name="name" placeholder="John Smith" required />
          </div>
          <div class="form-group">
            <label for="land-phone">Phone Number</label>
            <input type="tel" id="land-phone" name="phone" placeholder="(615) 555-0123" required />
          </div>
          <button type="submit" class="btn-primary btn-primary--block">
            Get My Cash Offer &rarr;
          </button>
        </form>
        <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
      </div>
    </div>
  </div>
</section>

<?php get_template_part( 'areas-we-serve' ); ?>


<script>
(function () {
  if (!window.IntersectionObserver) return;
  var steps = document.querySelectorAll('.steps .step');
  if (!steps.length) return;

  steps.forEach(function (step) {
    step.classList.add('step-pre');
  });

  steps.forEach(function (step, index) {
    var observer = new IntersectionObserver(function (entries) {
      if (!entries[0].isIntersecting) return;
      setTimeout(function () {
        step.classList.add('step-visible');
      }, 100 + index * 150);
      observer.unobserve(step);
    }, { threshold: 0.3 });
    observer.observe(step);
  });
})();
</script>

<?php get_footer(); ?>
