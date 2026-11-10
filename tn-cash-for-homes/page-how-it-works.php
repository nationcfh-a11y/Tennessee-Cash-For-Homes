<?php
/**
 * Template Name: How It Works
 * Template for the How It Works page
 */
get_header(); ?>

<!-- ── HERO ── -->
<section class="hero" id="hero-form">
  <div class="hero__overlay"></div>
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
          <span class="hero__title--white">How It Works to Sell Your House</span>
          <span class="hero__title--green"> As-Is for Cash in Tennessee</span>
        </h1>
        <p class="hero__subtitle">No repairs. No commissions. No stress. Here's exactly what happens when you sell your Tennessee home to us.</p>
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
            Close as Fast as 7 Days
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
          <input type="hidden" name="lead_source" value="How It Works" />
          <div class="form-group">
            <label for="hiw-address">Property Address</label>
            <input type="text" id="hiw-address" name="address" placeholder="123 Main St, Nashville, TN" required />
          </div>
          <div class="form-group">
            <label for="hiw-name">Your Name</label>
            <input type="text" id="hiw-name" name="name" placeholder="John Smith" required />
          </div>
          <div class="form-group">
            <label for="hiw-phone">Phone Number</label>
            <input type="tel" id="hiw-phone" name="phone" placeholder="(615) 555-0123" required />
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

<!-- ── SECTION 1: HOW IT WORKS INTRO ── -->
<section class="section section--alt hiw-intro">
  <div class="container">
    <div class="section__header section__header--center">
      <div class="hiw-badge">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        Trusted Tennessee Cash Buyers
      </div>
      <h2 class="section__title">How It Works to Sell Your House As Is for Cash in Tennessee</h2>
      <p class="section__subtitle">Tennessee Cash For Homes is a trusted cash home buyer in Tennessee. We understand that selling a house can be stressful, which is why we make the process simple and straightforward. There are no commissions, no hidden fees, and absolutely no pressure. If you need to sell your house fast in Tennessee, we provide a fair and transparent process from start to finish.</p>
    </div>

    <div class="hiw-feature-cards">
      <div class="hiw-feature-card">
        <div class="hiw-feature-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3 class="hiw-feature-title">No Hidden Fees</h3>
        <p class="hiw-feature-body">Zero commissions, zero closing costs. What we offer is what you get.</p>
      </div>
      <div class="hiw-feature-card">
        <div class="hiw-feature-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <h3 class="hiw-feature-title">Local Experts</h3>
        <p class="hiw-feature-body">We live and work in Tennessee. We know every market and neighborhood.</p>
      </div>
      <div class="hiw-feature-card">
        <div class="hiw-feature-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </div>
        <h3 class="hiw-feature-title">No Pressure</h3>
        <p class="hiw-feature-body">Our offer is yours to consider with no obligation, no deadline, and no stress.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── SECTION 2: 4-STEP PROCESS ── -->
<section class="section hiw-steps-section">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title">Our Simple 4-Step Process</h2>
      <p class="section__subtitle">Selling your house for cash in Tennessee has never been easier. Here's exactly how it works.</p>
    </div>

    <div class="hiw-timeline">

      <div class="hiw-timeline-item">
        <div class="hiw-timeline-icon">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <div class="hiw-timeline-content">
          <p class="hiw-timeline-step">STEP 01</p>
          <h3 class="hiw-timeline-title">Reach Out to Us</h3>
          <p class="hiw-timeline-body">Fill out our simple online form or give us a call. Tell us about your property, including its condition, location, and your timeline. There is no commitment, just a friendly conversation to better understand your situation.</p>
        </div>
      </div>

      <div class="hiw-timeline-item">
        <div class="hiw-timeline-icon">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <div class="hiw-timeline-content">
          <p class="hiw-timeline-step">STEP 02</p>
          <h3 class="hiw-timeline-title">Quick Property Review</h3>
          <p class="hiw-timeline-body">We will review your property details and may schedule a brief, flexible walkthrough. There is no need to make any repairs or clean up. We buy houses as is in any condition across Tennessee.</p>
        </div>
      </div>

      <div class="hiw-timeline-item">
        <div class="hiw-timeline-icon">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <div class="hiw-timeline-content">
          <p class="hiw-timeline-step">STEP 03</p>
          <h3 class="hiw-timeline-title">Receive a Fair Cash Offer</h3>
          <p class="hiw-timeline-body">Within 24 to 48 hours, you will receive a no obligation cash offer based on honest and transparent numbers. There are no hidden deductions and no surprises, just a straightforward offer you can trust.</p>
        </div>
      </div>

      <div class="hiw-timeline-item">
        <div class="hiw-timeline-icon">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div class="hiw-timeline-content">
          <p class="hiw-timeline-step">STEP 04</p>
          <h3 class="hiw-timeline-title">Close on Your Timeline</h3>
          <p class="hiw-timeline-body">You choose the closing date that works for you. We can close in as little as 7 days, or take up to 30 days if you need more time. We handle the paperwork and pay all closing costs.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ── WHAT TO EXPECT AT CLOSING ── -->
<section class="section section--alt">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Closing Day Details</p>
      <h2 class="section__title">What to Expect on Closing Day</h2>
      <p class="section__subtitle">Most closings take less than an hour. Here is exactly what happens once you accept our offer.</p>
    </div>

    <div class="hiw-closing-grid">
      <div class="hiw-closing-card">
        <div class="hiw-closing-num">1</div>
        <h3 class="hiw-closing-title">Title Company Handles Everything</h3>
        <p class="hiw-closing-body">A licensed Tennessee title company manages all the paperwork, title search, and legal details. You do not need to hire an attorney or do anything on your own.</p>
      </div>
      <div class="hiw-closing-card">
        <div class="hiw-closing-num">2</div>
        <h3 class="hiw-closing-title">Review &amp; Sign Documents</h3>
        <p class="hiw-closing-body">You will review and sign the closing documents. Everything is straightforward and our team will walk you through each page so there are no surprises.</p>
      </div>
      <div class="hiw-closing-card">
        <div class="hiw-closing-num">3</div>
        <h3 class="hiw-closing-title">Get Paid Immediately</h3>
        <p class="hiw-closing-body">Once signing is complete, you receive your cash. Funds are typically available the same day via wire transfer or certified check. The amount you were offered is the amount you receive.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── WHAT MAKES OUR PROCESS DIFFERENT ── -->
<section class="section hiw-different">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Why Homeowners Choose Us</p>
      <h2 class="section__title">What Makes Our Process Different</h2>
      <p class="section__subtitle">We remove every obstacle between you and a fast home sale in Tennessee.</p>
    </div>

    <div class="hiw-diff-grid">

      <div class="hiw-diff-card">
        <div class="hiw-diff-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        </div>
        <h3 class="hiw-diff-title">No Repairs Needed</h3>
        <p class="hiw-diff-body">Sell your house exactly as it is. We buy homes in any condition, whether damaged, outdated, or unfinished. You never lift a finger.</p>
      </div>

      <div class="hiw-diff-card">
        <div class="hiw-diff-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h3 class="hiw-diff-title">Zero Commissions or Fees</h3>
        <p class="hiw-diff-body">No agent commissions, no closing costs, no hidden deductions. The number we offer is the number you receive at closing.</p>
      </div>

      <div class="hiw-diff-card">
        <div class="hiw-diff-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <h3 class="hiw-diff-title">Close on Your Schedule</h3>
        <p class="hiw-diff-body">Need to close in 7 days? No problem. Need 30 or 60? That works too. You pick the date that fits your life.</p>
      </div>

      <div class="hiw-diff-card">
        <div class="hiw-diff-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <h3 class="hiw-diff-title">Local Decision Makers</h3>
        <p class="hiw-diff-body">We are a family-owned Tennessee business. You talk directly to the people making the decisions, not call centers or runarounds.</p>
      </div>

      <div class="hiw-diff-card">
        <div class="hiw-diff-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h3 class="hiw-diff-title">Guaranteed Sale</h3>
        <p class="hiw-diff-body">No financing contingencies, no buyer backing out at the last minute. When we make an offer and you accept, the sale is happening.</p>
      </div>

      <div class="hiw-diff-card">
        <div class="hiw-diff-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </div>
        <h3 class="hiw-diff-title">No Pressure, Ever</h3>
        <p class="hiw-diff-body">Our offer comes with zero obligation. Take your time, ask questions, sleep on it. We are here when you are ready. No hard sell, ever.</p>
      </div>

    </div>
  </div>
</section>

<!-- ── COMPARISON TABLE ── -->
<section class="section">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">See the Difference</p>
      <h2 class="section__title">Selling to Us vs. Listing With a Real Estate Agent</h2>
      <p class="section__subtitle">The traditional listing route works for some people. But if speed, certainty, and zero out-of-pocket costs matter to you, here's how the two options compare.</p>
    </div>
    <div class="compare-wrap">
      <table class="compare-table">
        <thead>
          <tr>
            <th></th>
            <th>Tennessee Cash For Homes</th>
            <th>Traditional Listing</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Closing timeline</td>
            <td><span class="check">&check;</span> As fast as 7 days</td>
            <td><span class="cross">60 to 90+ days</span></td>
          </tr>
          <tr>
            <td>Repairs required</td>
            <td><span class="check">&check;</span> None, buy as-is</td>
            <td><span class="cross">Often required</span></td>
          </tr>
          <tr>
            <td>Agent commissions</td>
            <td><span class="check">&check;</span> $0</td>
            <td><span class="cross">5 to 6% of sale price</span></td>
          </tr>
          <tr>
            <td>Closing costs</td>
            <td><span class="check">&check;</span> We cover them</td>
            <td><span class="cross">2 to 3% of sale price</span></td>
          </tr>
          <tr>
            <td>Showings &amp; open houses</td>
            <td><span class="check">&check;</span> None</td>
            <td><span class="cross">Many required</span></td>
          </tr>
          <tr>
            <td>Financing contingencies</td>
            <td><span class="check">&check;</span> No, all cash</td>
            <td><span class="cross">Deals can fall through</span></td>
          </tr>
          <tr>
            <td>Certainty of sale</td>
            <td><span class="check">&check;</span> Guaranteed</td>
            <td><span class="cross">Not guaranteed</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ── VIDEO SECTION ── -->
<section class="section section--alt video-section">
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
        <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>" class="btn-primary">Get My Free Cash Offer &rarr;</a>
      </div>
      <div class="video-section__media">
        <div class="video-section__embed">
          <iframe src="https://www.youtube.com/embed/lG64DriT_PU" title="Tennessee Cash For Homes" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part( 'reviews-section', null, array( 'carousel' => 'home' ) ); ?>

<!-- ── COMMON SITUATIONS ── -->
<section class="section section--alt" id="situations">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Whatever Your Situation</p>
      <h2 class="section__title">This Process Works No Matter Your Situation</h2>
      <p class="section__subtitle">Whether you are facing a tough situation or simply want a faster, easier way to sell, our process is designed to help.</p>
    </div>
    <div class="hiw-situations-grid">

      <a href="<?php echo esc_url( home_url('/sell-my-house-foreclosure-tennessee/') ); ?>" class="hiw-situation-card">
        <div class="hiw-situation-icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><line x1="9" y1="22" x2="9" y2="12"/><line x1="15" y1="22" x2="15" y2="12"/><line x1="9" y1="12" x2="15" y2="12"/></svg></div>
        <h3 class="hiw-situation-title">Facing Foreclosure</h3>
        <p class="hiw-situation-desc">We can close fast enough to stop the process and protect your credit.</p>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-my-house-divorce-tennessee/') ); ?>" class="hiw-situation-card">
        <div class="hiw-situation-icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M12 1v22"/><path d="M5 5l14 14"/><path d="M19 5L5 19"/></svg></div>
        <h3 class="hiw-situation-title">Going Through Divorce</h3>
        <p class="hiw-situation-desc">A fast fair sale without months of showings and negotiations.</p>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-inherited-house-tennessee/') ); ?>" class="hiw-situation-card">
        <div class="hiw-situation-icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
        <h3 class="hiw-situation-title">Inherited a Property</h3>
        <p class="hiw-situation-desc">We buy as-is with contents included and work with probate attorneys.</p>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-my-house-relocating-tennessee/') ); ?>" class="hiw-situation-card">
        <div class="hiw-situation-icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg></div>
        <h3 class="hiw-situation-title">Relocating or Moving</h3>
        <p class="hiw-situation-desc">Sell fast and avoid double mortgage payments or carrying costs.</p>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-house-as-is-tennessee/') ); ?>" class="hiw-situation-card">
        <div class="hiw-situation-icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
        <h3 class="hiw-situation-title">Major Repairs Needed</h3>
        <p class="hiw-situation-desc">We buy houses in any condition. No repairs, no contractors, no hassle.</p>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-rental-property-tennessee/') ); ?>" class="hiw-situation-card">
        <div class="hiw-situation-icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg></div>
        <h3 class="hiw-situation-title">Tired Landlord</h3>
        <p class="hiw-situation-desc">We buy rental properties with tenants in place for a fast clean exit.</p>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-house-behind-on-taxes-tennessee/') ); ?>" class="hiw-situation-card">
        <div class="hiw-situation-icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg></div>
        <h3 class="hiw-situation-title">Behind On Taxes</h3>
        <p class="hiw-situation-desc">Owing back taxes doesn't have to mean losing your home. We can close fast and help you resolve the situation.</p>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-my-house-downsizing-tennessee/') ); ?>" class="hiw-situation-card">
        <div class="hiw-situation-icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
        <h3 class="hiw-situation-title">Downsizing</h3>
        <p class="hiw-situation-desc">Ready for a simpler life? We make it easy to sell quickly so you can move into something that fits your next chapter.</p>
      </a>

      <a href="<?php echo esc_url( home_url('/sell-house-probate-tennessee/') ); ?>" class="hiw-situation-card">
        <div class="hiw-situation-icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></div>
        <h3 class="hiw-situation-title">Probate Sale</h3>
        <p class="hiw-situation-desc">Navigating probate is stressful enough. We work with probate attorneys and buy as-is so you can settle the estate quickly.</p>
      </a>

    </div>
  </div>
</section>

<!-- ── FAQ ── -->
<section class="section" id="faq">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Got Questions?</p>
      <h2 class="section__title">Frequently Asked Questions About the Process</h2>
    </div>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          How quickly can I get a cash offer?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">In most cases, we can present you with a fair cash offer within 24 to 48 hours of learning about your property. All we need is some basic information about the home and your situation.</div>
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
          Do I need to make any repairs before selling?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">No. We buy houses in any condition across Tennessee. Whether your home needs a new roof, has foundation issues, or just needs a deep clean, we will buy it as-is. You do not need to spend a dime on repairs.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          Who pays the closing costs?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">We do. Tennessee Cash For Homes covers all standard closing costs. The cash offer we present is the amount you walk away with at closing. No surprise deductions.</div>
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
        <div class="faq-answer">No. You can take what you want and leave the rest. We handle all cleanout after closing at no cost to you. This is especially helpful for inherited properties or situations where clearing everything out just is not practical.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          Can I choose my own closing date?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">Yes. You pick the closing date that works best for your situation. We can close in as little as 7 days if you need speed, or push it out to 30 days or more if you need extra time to plan your move.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          What if my house has liens or title issues?
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer">We work with experienced title companies who can help resolve liens, judgments, and other title issues. In many cases, these can be cleared at closing using proceeds from the sale. We will walk you through the options.</div>
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


<script>
/* Timeline scroll animation */
(function () {
  if (!window.IntersectionObserver) return;
  var items = document.querySelectorAll('.hiw-timeline-item');
  if (!items.length) return;

  items.forEach(function (item) {
    item.classList.add('hiw-step-pre');
  });

  items.forEach(function (item, index) {
    var observer = new IntersectionObserver(function (entries) {
      if (!entries[0].isIntersecting) return;

      if (index > 0) {
        var prevIcon = items[index - 1].querySelector('.hiw-timeline-icon');
        if (prevIcon) prevIcon.classList.add('line-drawn');
      }

      var delay = index > 0 ? 300 : 200;
      setTimeout(function () {
        item.classList.add('hiw-step-visible');
      }, delay);

      observer.unobserve(item);
    }, { threshold: 0.3 });

    observer.observe(item);
  });
})();

/* Count-up animation for proof bar */
(function () {
  var countEls = document.querySelectorAll('.count-up');
  if (!countEls.length) return;

  function animateCount(el) {
    var target = parseInt(el.dataset.target, 10);
    var duration = 3200;
    var start = performance.now();

    function step(now) {
      var elapsed = now - start;
      var progress = Math.min(elapsed / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(eased * target).toLocaleString() + '+';
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = target.toLocaleString() + '+';
    }

    requestAnimationFrame(step);
  }

  var countObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        animateCount(entry.target);
        countObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  countEls.forEach(function (el) { countObserver.observe(el); });
})();
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Sell Your House Fast for Cash in Tennessee",
  "description": "A simple 4-step process to sell your Tennessee home for cash with no repairs, no commissions, and no fees.",
  "totalTime": "P7D",
  "estimatedCost": { "@type": "MonetaryAmount", "currency": "USD", "value": "0" },
  "supply": [],
  "tool": [],
  "step": [
    {
      "@type": "HowToStep",
      "position": 1,
      "name": "Contact Us",
      "text": "Call us at (615) 801-8126 or fill out our online form with your property address. We will respond within 24 hours.",
      "url": "https://tennesseecashforhomes.com/how-it-works/#step-1"
    },
    {
      "@type": "HowToStep",
      "position": 2,
      "name": "Get Your Cash Offer",
      "text": "We will review your property and present you with a fair no-obligation cash offer within 24 hours. No repairs or cleaning required.",
      "url": "https://tennesseecashforhomes.com/how-it-works/#step-2"
    },
    {
      "@type": "HowToStep",
      "position": 3,
      "name": "Choose Your Closing Date",
      "text": "Accept the offer and pick a closing date that works for you. We can close in as little as 7 days or on your timeline.",
      "url": "https://tennesseecashforhomes.com/how-it-works/#step-3"
    },
    {
      "@type": "HowToStep",
      "position": 4,
      "name": "Get Paid",
      "text": "We handle all the paperwork and cover the closing costs. You walk away with cash in hand on your chosen closing date.",
      "url": "https://tennesseecashforhomes.com/how-it-works/#step-4"
    }
  ]
}
</script>

<?php get_footer(); ?>
