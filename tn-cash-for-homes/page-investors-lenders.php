<?php
/*
 * Template Name: Investors and Lenders
 */
get_header(); ?>

<!-- ── PAGE HERO ── -->
<section class="hero" id="hero-top">
  <div class="container">
    <div class="hero__inner hero__inner--center">
      <div class="hero__content hero__content--center">
        <nav class="breadcrumb">
          <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
          <span>&rsaquo;</span>
          <span>Investors &amp; Lenders</span>
        </nav>
        <h1 class="hero__title" style="text-align:center;">
          <span class="hero__title--white">Work With</span>
          <span class="hero__title--green"> Tennessee Cash For Homes</span>
        </h1>
        <p class="hero__subtitle" style="text-align:center; max-width:680px; margin-left:auto; margin-right:auto;">Whether you are looking to acquire more properties or put your capital to work, we want to hear from you. We move fast, operate with integrity, and create win-win deals.</p>
        <div class="hero__trust-row" style="justify-content:center;">
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Off-Market Deals
          </span>
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Win-Win Partnerships
          </span>
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Fast, Transparent Deals
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── INVESTOR SECTION ── -->
<section class="section il-section" id="investors">
  <div class="container">
    <div class="il-section__inner">

      <!-- Left: Benefits -->
      <div class="il-section__content">
        <p class="section__eyebrow">For Investors</p>
        <h2 class="section__title">Join Our Buyers List</h2>
        <p class="section__subtitle">We source off-market deals across Middle Tennessee. If you are an investor looking for wholesale, fix and flip, or buy and hold opportunities, get on our list and be the first to know when a new deal is available.</p>

        <div class="il-benefits">
          <div class="il-benefit">
            <div class="il-benefit__icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
            </div>
            <div>
              <strong>Off-Market Deals</strong>
              <p>Access properties before they hit the MLS</p>
            </div>
          </div>

          <div class="il-benefit">
            <div class="il-benefit__icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                <line x1="3" y1="9" x2="21" y2="9"/>
                <line x1="9" y1="21" x2="9" y2="9"/>
              </svg>
            </div>
            <div>
              <strong>Properties Across Middle Tennessee</strong>
              <p>Nashville, Clarksville, Murfreesboro, and beyond</p>
            </div>
          </div>

          <div class="il-benefit">
            <div class="il-benefit__icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
              </svg>
            </div>
            <div>
              <strong>Any Strategy Welcome</strong>
              <p>Wholesale, fix and flip, buy and hold, BRRRR, and more</p>
            </div>
          </div>

          <div class="il-benefit">
            <div class="il-benefit__icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
              </svg>
            </div>
            <div>
              <strong>Fast, Transparent Transactions</strong>
              <p>No surprises. Clear communication from start to finish.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: Form -->
      <div class="il-section__form">
        <div class="hero__form-card">
          <h2 class="form-card__title">Join Our Buyers List</h2>
          <p class="form-card__sub">Be the first to know when a new deal drops.</p>
          <form id="investorForm" onsubmit="handleInvestorSubmit(event)">
            <div class="form-group">
              <label for="inv-name">Full Name</label>
              <input type="text" id="inv-name" name="name" placeholder="John Smith" required />
            </div>
            <div class="form-group">
              <label for="inv-email">Email Address</label>
              <input type="email" id="inv-email" name="email" placeholder="john@example.com" required />
            </div>
            <div class="form-group">
              <label for="inv-phone">Phone Number</label>
              <input type="tel" id="inv-phone" name="phone" placeholder="(615) 555-0123" required />
            </div>
            <div class="form-group">
              <label for="inv-market">Preferred Market</label>
              <input type="text" id="inv-market" name="market" placeholder="Nashville, Clarksville, Murfreesboro" required />
            </div>
            <div class="form-group">
              <label for="inv-strategy">Primary Strategy</label>
              <select id="inv-strategy" name="strategy" required>
                <option value="" disabled selected>Select your strategy</option>
                <option value="Wholesale">Wholesale</option>
                <option value="Wholetail">Wholetail</option>
                <option value="Fix and Flip">Fix and Flip</option>
                <option value="Buy and Hold">Buy and Hold</option>
                <option value="BRRRR">BRRRR</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label for="inv-notes">Anything else we should know? <span style="font-weight:400; color:var(--charcoal-light);">(optional)</span></label>
              <textarea id="inv-notes" name="notes" rows="3" placeholder="Tell us about your investment goals..."></textarea>
            </div>
            <button type="submit" class="btn-primary btn-primary--block">
              Join the Buyers List &rarr;
            </button>
          </form>
          <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ── LENDER SECTION ── -->
<section class="section il-section il-section--alt" id="lenders">
  <div class="container">
    <div class="il-section__inner il-section__inner--reverse">

      <!-- Left: Form -->
      <div class="il-section__form">
        <div class="hero__form-card">
          <h2 class="form-card__title">Become a Private Money Lender</h2>
          <p class="form-card__sub">Put your capital to work with real estate backed returns.</p>
          <form id="lenderForm" onsubmit="handleLenderSubmit(event)">
            <div class="form-group">
              <label for="lend-name">Full Name</label>
              <input type="text" id="lend-name" name="name" placeholder="John Smith" required />
            </div>
            <div class="form-group">
              <label for="lend-email">Email Address</label>
              <input type="email" id="lend-email" name="email" placeholder="john@example.com" required />
            </div>
            <div class="form-group">
              <label for="lend-phone">Phone Number</label>
              <input type="tel" id="lend-phone" name="phone" placeholder="(615) 555-0123" required />
            </div>
            <div class="form-group">
              <label for="lend-budget">Maximum Lending Budget</label>
              <select id="lend-budget" name="budget" required>
                <option value="" disabled selected>Select your budget range</option>
                <option value="Under $50,000">Under $50,000</option>
                <option value="$50,000 to $100,000">$50,000 to $100,000</option>
                <option value="$100,000 to $250,000">$100,000 to $250,000</option>
                <option value="$250,000 to $500,000">$250,000 to $500,000</option>
                <option value="$500,000 and above">$500,000 and above</option>
              </select>
            </div>
            <div class="form-group">
              <label for="lend-notes">Anything else we should know? <span style="font-weight:400; color:var(--charcoal-light);">(optional)</span></label>
              <textarea id="lend-notes" name="notes" rows="3" placeholder="Tell us about your lending experience or goals..."></textarea>
            </div>
            <button type="submit" class="btn-primary btn-primary--block">
              Connect With Our Team &rarr;
            </button>
          </form>
          <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
        </div>
      </div>

      <!-- Right: Benefits -->
      <div class="il-section__content">
        <p class="section__eyebrow">For Lenders</p>
        <h2 class="section__title">Become a Private Money Lender</h2>
        <p class="section__subtitle">We are always looking for private capital partners to fund our deals. If you have capital sitting in a savings account or self-directed IRA earning minimal returns, we should talk. We offer competitive returns backed by real Tennessee real estate.</p>

        <div class="il-benefits">
          <div class="il-benefit">
            <div class="il-benefit__icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="1" x2="12" y2="23"/>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
              </svg>
            </div>
            <div>
              <strong>Competitive Returns</strong>
              <p>Backed by real Tennessee real estate assets</p>
            </div>
          </div>

          <div class="il-benefit">
            <div class="il-benefit__icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
            </div>
            <div>
              <strong>Short-Term Lending Opportunities</strong>
              <p>Vetted deals with clear timelines and exit strategies</p>
            </div>
          </div>

          <div class="il-benefit">
            <div class="il-benefit__icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
              </svg>
            </div>
            <div>
              <strong>Transparent Communication</strong>
              <p>Regular updates from start to finish on every deal</p>
            </div>
          </div>

          <div class="il-benefit">
            <div class="il-benefit__icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
            </div>
            <div>
              <strong>Work Directly With Decision Makers</strong>
              <p>No middlemen, no runaround. Deal directly with our team.</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ── PAGE STYLES ── -->
<style>
  /* Hero center variant */
  .hero__inner--center {
    justify-content: center;
  }
  .hero__content--center {
    max-width: 780px;
    text-align: center;
    margin: 0 auto;
  }

  /* IL Section Layout */
  .il-section {
    padding: 80px 0;
  }
  .il-section--alt {
    background: var(--bg-light);
  }
  .il-section__inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
  }
  .il-section__inner--reverse {
    direction: rtl;
  }
  .il-section__inner--reverse > * {
    direction: ltr;
  }

  /* Eyebrow */
  .section__eyebrow {
    font-family: 'Poppins', sans-serif;
    font-size: 12px;
    font-weight: 700;
    color: var(--green);
    letter-spacing: 0.12em;
    text-transform: uppercase;
    margin: 0 0 8px;
  }
  .section__title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(26px, 4vw, 36px);
    font-weight: 700;
    color: var(--charcoal);
    margin: 0 0 16px;
    line-height: 1.2;
  }
  .section__subtitle {
    font-family: Tahoma, Geneva, Verdana, sans-serif;
    font-size: 16px;
    line-height: 1.7;
    color: var(--charcoal-light);
    margin: 0 0 32px;
  }

  /* Benefit Cards */
  .il-benefits {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  .il-benefit {
    display: flex;
    align-items: flex-start;
    gap: 16px;
  }
  .il-benefit__icon {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--green-light);
    border-radius: 10px;
  }
  .il-benefit strong {
    display: block;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 15px;
    color: var(--charcoal);
    margin-bottom: 2px;
  }
  .il-benefit p {
    font-family: Tahoma, Geneva, Verdana, sans-serif;
    font-size: 14px;
    color: var(--charcoal-light);
    line-height: 1.5;
    margin: 0;
  }

  /* Form card adjustments */
  .il-section .hero__form-card {
    position: relative;
    animation: none;
  }

  /* Select styling */
  .form-group select {
    width: 100%;
    padding: 12px 14px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: Tahoma, sans-serif;
    font-size: 15px;
    color: var(--charcoal);
    background: var(--white);
    transition: border-color .2s, box-shadow .2s;
    outline: none;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%235a5a5a' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
  }
  .form-group select:focus {
    border-color: var(--green);
    box-shadow: 0 0 0 3px rgba(132,204,156,.2);
  }

  /* Textarea styling */
  .form-group textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: Tahoma, sans-serif;
    font-size: 15px;
    color: var(--charcoal);
    background: var(--white);
    transition: border-color .2s, box-shadow .2s;
    outline: none;
    resize: vertical;
    min-height: 80px;
  }
  .form-group textarea:focus {
    border-color: var(--green);
    box-shadow: 0 0 0 3px rgba(132,204,156,.2);
  }
  .form-group textarea::placeholder {
    color: #aaa;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .il-section {
      padding: 48px 0;
    }
    .il-section__inner {
      grid-template-columns: 1fr;
      gap: 40px;
    }
    .il-section__inner--reverse {
      direction: ltr;
    }
    .il-section__form {
      order: 2;
    }
    .il-section__content {
      order: 1;
    }
  }
</style>

<!-- ── FORM SUBMISSION JS ── -->
<script>
  var DEBUG = false;

  async function handleInvestorSubmit(e) {
    e.preventDefault();
    var form = e.target;
    var btn = form.querySelector('.btn-primary');

    btn.textContent = 'Sending\u2026';
    btn.disabled = true;

    var formData = new FormData();
    formData.append('action', 'tcfh_submit_investor');
    formData.append('nonce', (typeof tcfh_ajax !== 'undefined') ? tcfh_ajax.nonce : '');
    formData.append('name', form.name.value.trim());
    formData.append('email', form.email.value.trim());
    formData.append('phone', form.phone.value.trim());
    formData.append('market', form.market.value.trim());
    formData.append('strategy', form.strategy.value);
    formData.append('notes', form.notes.value.trim());

    var ajaxUrl = (typeof tcfh_ajax !== 'undefined') ? tcfh_ajax.ajax_url : '/wp-admin/admin-ajax.php';

    try {
      var res = await fetch(ajaxUrl, { method: 'POST', body: formData });
      var data = await res.json();
      if (!data.success && DEBUG) console.error('Investor form error:', data.data?.error);
    } catch (err) {
      if (DEBUG) console.error('Investor form failed:', err);
    }

    window.location.href = '/thank-you/';
  }

  async function handleLenderSubmit(e) {
    e.preventDefault();
    var form = e.target;
    var btn = form.querySelector('.btn-primary');

    btn.textContent = 'Sending\u2026';
    btn.disabled = true;

    var formData = new FormData();
    formData.append('action', 'tcfh_submit_lender');
    formData.append('nonce', (typeof tcfh_ajax !== 'undefined') ? tcfh_ajax.nonce : '');
    formData.append('name', form.name.value.trim());
    formData.append('email', form.email.value.trim());
    formData.append('phone', form.phone.value.trim());
    formData.append('budget', form.budget.value);
    formData.append('notes', form.notes.value.trim());

    var ajaxUrl = (typeof tcfh_ajax !== 'undefined') ? tcfh_ajax.ajax_url : '/wp-admin/admin-ajax.php';

    try {
      var res = await fetch(ajaxUrl, { method: 'POST', body: formData });
      var data = await res.json();
      if (!data.success && DEBUG) console.error('Lender form error:', data.data?.error);
    } catch (err) {
      if (DEBUG) console.error('Lender form failed:', err);
    }

    window.location.href = '/thank-you/';
  }
</script>

<?php get_footer(); ?>
