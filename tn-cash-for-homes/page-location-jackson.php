<?php
/**
 * Template Name: Location - Jackson
 * City location page for Jackson, TN
 *
 * SEO (enter in Yoast / RankMath):
 *   Meta Title:       We Buy Houses in Jackson | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Jackson for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.
 */
get_header(); ?>

<!-- ── LOCATION HERO ── -->
<section class="location-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/brand_assets/Where%20We%20Buy%20Pages/Where%20We%20Buy%20Images/Jackson.webp');">
  <div class="location-hero__overlay"></div>
  <div class="container">
    <div class="location-hero__inner">
      <div class="location-hero__content">
        <nav class="breadcrumb breadcrumb--light">
          <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
          <span>&rsaquo;</span>
          <a href="<?php echo esc_url( home_url('/where-we-buy/') ); ?>">Where We Buy</a>
          <span>&rsaquo;</span>
          <span>Jackson</span>
        </nav>
        <div class="hero__badge">Jackson Cash Home Buyers</div>
        <h1 class="location-hero__title">Sell Your House For Cash In Jackson</h1>
        <p class="location-hero__subtitle">No repairs. No commissions. No fees. Get a fair cash offer for your Jackson home in as little as 24 hours. We close on your timeline.</p>
        <div class="hero__trust">
          <div class="hero__trust-item">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Zero fees or commissions
          </div>
          <div class="hero__trust-item">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Close in 7 days
          </div>
          <div class="hero__trust-item">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Buy as-is, any condition
          </div>
          <div class="hero__trust-item">
            <svg width="18" height="18" fill="#FBBC05" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            5-Star Rated on Google
          </div>
        </div>
        <div class="location-hero__cta-row">
          <a href="#get-offer" class="btn-primary">Get My Free Cash Offer &rarr;</a>
          <a href="tel:+16158018126" class="btn-outline">Call (615) 801-8126</a>
        </div>
      </div>

      <!-- LEAD FORM -->
      <div class="hero__form-card" id="get-offer">
        <h2 class="form-card__title">Get Your Free Cash Offer</h2>
        <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
        <form onsubmit="handleSubmit(event)">
          <div class="form-group">
            <label for="loc-address-jackson">Property Address</label>
            <input type="text" id="loc-address-jackson" name="address" placeholder="123 Main St, Jackson, TN" required />
          </div>
          <div class="form-group">
            <label for="loc-name-jackson">Your Name</label>
            <input type="text" id="loc-name-jackson" name="name" placeholder="John Smith" required />
          </div>
          <div class="form-group">
            <label for="loc-phone-jackson">Phone Number</label>
            <input type="tel" id="loc-phone-jackson" name="phone" placeholder="(615) 555-0123" required />
          </div>
          <button type="submit" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</button>
        </form>
        <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── MARKET STATS BAR ── -->
<div class="loc-stats-bar">
  <div class="container">
    <div class="loc-stats-bar__inner">
      <div class="loc-stat">
        <div class="loc-stat__num">$215,000</div>
        <div class="loc-stat__label">Median Sale Price</div>
      </div>
      <div class="loc-stat-divider"></div>
      <div class="loc-stat">
        <div class="loc-stat__num">110</div>
        <div class="loc-stat__label">Homes Sold</div>
      </div>
      <div class="loc-stat-divider"></div>
      <div class="loc-stat">
        <div class="loc-stat__num">60 Days</div>
        <div class="loc-stat__label">Avg Days on Market</div>
      </div>
    </div>
  </div>
</div>

<!-- ── ABOUT JACKSON ── -->
<section class="section loc-about">
  <div class="container">
    <div class="loc-about__inner">
      <div class="loc-about__content">
        <p class="section__eyebrow">We Buy Houses in Jackson</p>
        <h2 class="section__title">Sell Your Jackson House Fast for Cash</h2>
        <p class="loc-about__body">Jackson, a regional hub for West Tennessee, is a great place for homeowners looking to sell their Jackson home fast for cash. Tennessee Cash For Homes offers competitive cash offers that make selling your home in Jackson straightforward and stress-free. We buy homes in any condition, from outdated properties to modern homes, and our process ensures you get a fair and fast offer without the complications of the traditional real estate market.</p>
        <p class="loc-about__body">Jackson, a hub of West Tennessee, combines urban amenities with a suburban feel. If you are looking to sell your Jackson home fast, Tennessee Cash For Homes offers a quick and efficient selling process. We provide fair cash offers that reflect the market value of your property, with no repairs needed and no agent fees. Our team is dedicated to providing you with the best possible service, ensuring a seamless and stress-free transaction.</p>
        <a href="#get-offer" class="btn-primary">Get My Free Cash Offer &rarr;</a>
      </div>
      <div class="loc-about__cards">
        <div class="loc-trust-card">
          <div class="loc-trust-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          </div>
          <h3>No Repairs Needed</h3>
          <p>We buy houses as-is in any condition. Don&rsquo;t spend a dime fixing up your home.</p>
        </div>
        <div class="loc-trust-card">
          <div class="loc-trust-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          </div>
          <h3>Fast Cash Offer</h3>
          <p>Receive a fair, no-obligation cash offer within 24&ndash;48 hours.</p>
        </div>
        <div class="loc-trust-card">
          <div class="loc-trust-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          </div>
          <h3>Close on Your Timeline</h3>
          <p>We can close in as little as 7 days or on a date that works best for you.</p>
        </div>
        <div class="loc-trust-card">
          <div class="loc-trust-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          </div>
          <h3>Zero Fees or Commissions</h3>
          <p>No agent fees, no closing costs, no hidden charges. What we offer is what you get.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── SELL YOUR LAND ── -->
<section class="land-section">
  <div class="land-section__overlay"></div>
  <div class="container land-section__inner">
    <div class="land-section__content">
      <p class="section__eyebrow land-section__eyebrow">Jackson Land Buyers</p>
      <h2 class="land-section__title">Sell Your Land in Jackson for Cash</h2>
      <p class="land-section__body">Jackson serves as a major commercial and residential hub for West Tennessee, making land ownership increasingly valuable across the city and surrounding counties. Whether you own residential lots, farmland, or commercial acreage, there are buyers in the market. However, land listings can sit for months without the right exposure or buyer. Tennessee Cash For Homes makes selling land in Jackson simple — we pay cash, move fast, and handle all the paperwork so you can close on your schedule.</p>
      <ul class="land-section__list">
        <li>
          <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Vacant lots, acreage, and rural land
        </li>
        <li>
          <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Cash offer within 24 hours
        </li>
        <li>
          <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Zero commissions or closing costs
        </li>
        <li>
          <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Close on your timeline
        </li>
      </ul>
    </div>
    <div class="land-section__form-wrap">
      <div class="hero__form-card">
        <h2 class="form-card__title">Get Your Land Cash Offer</h2>
        <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
        <form onsubmit="handleSubmit(event)">
          <div class="form-group">
            <label for="land-address-jackson">Property Address</label>
            <input type="text" id="land-address-jackson" name="address" placeholder="123 Acres Rd, Jackson, TN" required />
          </div>
          <div class="form-group">
            <label for="land-name-jackson">Your Name</label>
            <input type="text" id="land-name-jackson" name="name" placeholder="John Smith" required />
          </div>
          <div class="form-group">
            <label for="land-phone-jackson">Phone Number</label>
            <input type="tel" id="land-phone-jackson" name="phone" placeholder="(615) 555-0123" required />
          </div>
          <button type="submit" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</button>
        </form>
        <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── CTA BAND ── -->
<section class="cta-band">
  <div class="container">
    <h2>Ready to Sell Your Jackson House Fast for Cash?</h2>
    <p>Get your free, no-obligation cash offer today from Tennessee&rsquo;s 5-star rated home buyers. No repairs, no fees, no waiting.</p>
    <a href="#get-offer" class="btn-white">Get My Free Cash Offer Today</a>
    <span class="cta-phone">Or call us directly: <a href="tel:+16158018126">(615) 801-8126</a></span>
  </div>
</section>

<?php get_footer(); ?>
