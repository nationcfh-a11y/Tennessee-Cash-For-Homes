<?php
/*
Template Name: Sell Your Land for Cash
*/

// SEO meta
$meta_title = 'Sell Your Land for Cash in Tennessee | Tennessee Cash For Homes';
$meta_description = 'We buy land in Tennessee for cash. Vacant lots, rural acreage, farm land, inherited land - any size, any condition. Get a fair cash offer in 24 hours. No fees or commissions.';

add_filter( 'pre_get_document_title', function( $title ) use ( $meta_title ) {
    return $meta_title;
}, 99 );

if ( ! empty( $meta_description ) ) {
    update_post_meta( get_the_ID(), '_tcfh_meta_desc', $meta_description );
}

get_header();
?>

<!-- ── HERO ── -->
<section class="land-hero">
  <div class="container">
    <div class="land-hero__inner">
      <div class="land-hero__content">
        <span class="land-hero__eyebrow">TENNESSEE LAND BUYERS</span>
        <h1 class="land-hero__h1">Sell Your Land in Tennessee for Cash</h1>
        <p class="land-hero__sub">No commissions. No fees. No hassle. Get a fair cash offer for your Tennessee land in as little as 24 hours.</p>
        <ul class="land-hero__checks">
          <li>
            <svg width="20" height="20" fill="#4CAF7D" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Vacant lots and acreage
          </li>
          <li>
            <svg width="20" height="20" fill="#4CAF7D" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Rural and farm land
          </li>
          <li>
            <svg width="20" height="20" fill="#4CAF7D" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Any size any condition
          </li>
          <li>
            <svg width="20" height="20" fill="#4CAF7D" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Close on your timeline
          </li>
        </ul>
        <div class="land-hero__cta-row">
          <a href="#get-offer" class="hero__btn-primary">Get My Free Cash Offer &rarr;</a>
          <a href="tel:+16158018126" class="hero__btn-outline">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            Call (615) 801-8126
          </a>
        </div>
        <div class="land-hero__trust-row">
          <a href='https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick' target='_blank' rel='nofollow noopener noreferrer' class='bbb-seal'><img src='https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png' style='border: 0;' alt='Tennessee Cash For Homes BBB Business Review' width='200' height='42' loading='lazy' decoding='async' /></a>
          <div class="land-hero__stars">
            <div class="land-hero__stars-icons">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <div class="land-hero__stars-label"><strong>5.0</strong> Google Rating</div>
          </div>
        </div>
      </div>
      <div class="hero__form-card" id="get-offer">
        <h2 class="form-card__title">Get Your Free Cash Offer</h2>
        <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
        <form id="leadForm" onsubmit="handleSubmit(event)">
          <input type="hidden" name="lead_source" value="Sell Your Land" />
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

<!-- ── STATS STRIP ── -->
<div class="proof-bar" style="background: var(--charcoal); border-bottom: none;">
  <div class="container">
    <div class="proof-bar__inner">
      <div class="proof-stat">
        <div class="proof-stat__num" style="color: #84CC9C;">24 Hours</div>
        <div class="proof-stat__label" style="color: rgba(255,255,255,0.7);">Cash offer timeline</div>
      </div>
      <div class="proof-divider" style="background: rgba(255,255,255,0.15);"></div>
      <div class="proof-stat">
        <div class="proof-stat__num" style="color: #84CC9C;">$0</div>
        <div class="proof-stat__label" style="color: rgba(255,255,255,0.7);">Fees or commissions</div>
      </div>
      <div class="proof-divider" style="background: rgba(255,255,255,0.15);"></div>
      <div class="proof-stat">
        <div class="proof-stat__num" style="color: #84CC9C;">7 Days</div>
        <div class="proof-stat__label" style="color: rgba(255,255,255,0.7);">To close</div>
      </div>
      <div class="proof-divider" style="background: rgba(255,255,255,0.15);"></div>
      <div class="proof-stat">
        <div class="proof-stat__num" style="color: #84CC9C;">Any Size</div>
        <div class="proof-stat__label" style="color: rgba(255,255,255,0.7);">Lot or acreage</div>
      </div>
    </div>
  </div>
</div>

<!-- ── ABOUT / WHY SELL YOUR LAND TO US ── -->
<section class="land-about">
  <div class="container">
    <h2 class="land-about__title">We Buy Tennessee Land Fast for Cash</h2>
    <div class="land-about__grid">
      <div class="land-about__copy">
        <p>Tennessee land values have been steadily rising over the past several years, driven by population growth, new infrastructure projects, and expanding suburban development across the state. While that is great news for landowners, many still struggle to find qualified buyers willing to pay a fair price in a reasonable timeframe. Listing land on the traditional market often means months of waiting, hefty agent commissions, and uncertainty about when or if a deal will close.</p>
        <p>At Tennessee Cash For Homes, we specialize in buying Tennessee land directly from owners for cash. Whether you own rural acreage in East Tennessee, a <a href="<?php echo esc_url( home_url( '/sell-your-land-1/' ) ); ?>">vacant lot</a> near a growing suburb, farm land that has been in the family for generations, inherited land you no longer need, or timber land you are ready to liquidate, we make a fair, no-obligation cash offer and can close in as little as 7 days.</p>
        <p>There are no real estate agents involved, no listing fees, and no commissions deducted from your sale. We handle all the paperwork and closing costs so you can walk away with cash in hand without the headaches of a traditional land sale. Whether your property is 1 acre or 100 acres, we are ready to make you an offer.</p>
      </div>
      <div class="land-about__features">
        <div class="sit-feature-card">
          <div class="sit-feature-icon">
            <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </div>
          <h3>No Repairs or Clearing Required</h3>
          <p>We buy your land exactly as it is. No clearing, grading, or improvements needed before closing.</p>
        </div>
        <div class="sit-feature-card">
          <div class="sit-feature-icon">
            <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <h3>Cash Offer in 24 Hours</h3>
          <p>We research your land and present a fair, no-obligation cash offer within 24 hours of your inquiry.</p>
        </div>
        <div class="sit-feature-card">
          <div class="sit-feature-icon">
            <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          </div>
          <h3>Close in as Little as 7 Days</h3>
          <p>Choose your closing date. We can close in as few as 7 days or work on your schedule.</p>
        </div>
        <div class="sit-feature-card">
          <div class="sit-feature-icon">
            <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          </div>
          <h3>Zero Fees or Commissions</h3>
          <p>No agent fees, no closing costs, no hidden charges. The offer we make is what you walk away with.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── WHAT TYPES OF LAND WE BUY ── -->
<section class="section" id="land-types">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title">We Buy All Types of Tennessee Land</h2>
    </div>
    <div class="land-types__grid">
      <div class="land-type-card">
        <div class="land-type-card__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 3v18"/></svg>
        </div>
        <h3 class="land-type-card__title">Vacant Lots</h3>
        <p class="land-type-card__desc">Residential or commercial vacant lots in any Tennessee city or county. No improvements needed - we buy them as-is.</p>
      </div>
      <div class="land-type-card">
        <div class="land-type-card__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11"/><line x1="8" y1="14" x2="8" y2="17"/><line x1="12" y1="14" x2="12" y2="17"/><line x1="16" y1="14" x2="16" y2="17"/></svg>
        </div>
        <h3 class="land-type-card__title">Farm and Agricultural Land</h3>
        <p class="land-type-card__desc">Active or inactive farm land, crop land, and agricultural parcels throughout Tennessee. We understand farm valuations.</p>
      </div>
      <div class="land-type-card">
        <div class="land-type-card__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3 class="land-type-card__title">Rural Acreage</h3>
        <p class="land-type-card__desc">Large or small rural parcels in any part of Tennessee. Whether it is 5 acres or 500, we make competitive cash offers.</p>
      </div>
      <div class="land-type-card">
        <div class="land-type-card__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0v-2M5 21H3m2 0v-2m4-14h2m-2 4h2m4-4h2m-2 4h2"/></svg>
        </div>
        <h3 class="land-type-card__title">Inherited Land</h3>
        <p class="land-type-card__desc">Inherited a parcel you do not need? We buy <a href="<?php echo esc_url( home_url( '/sell-inherited-house-tennessee/' ) ); ?>">inherited land</a> at any stage of probate and handle the complexity for you.</p>
      </div>
      <div class="land-type-card">
        <div class="land-type-card__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        </div>
        <h3 class="land-type-card__title">Timber Land</h3>
        <p class="land-type-card__desc">Wooded and timber properties across Tennessee. We evaluate the land and timber value together for a fair offer.</p>
      </div>
      <div class="land-type-card">
        <div class="land-type-card__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M2 20h20M5 20V8l7-5 7 5v12"/><rect x="9" y="12" width="6" height="8"/></svg>
        </div>
        <h3 class="land-type-card__title">Commercial Land</h3>
        <p class="land-type-card__desc">Commercially zoned parcels, development sites, and mixed-use land. We buy commercial land in any Tennessee market.</p>
      </div>
      <div class="land-type-card">
        <div class="land-type-card__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M3 15c2.483 0 4.345-3 6-3s3.517 3 6 3 4.345-3 6-3"/><path d="M3 20c2.483 0 4.345-3 6-3s3.517 3 6 3 4.345-3 6-3"/><path d="M3 10c2.483 0 4.345-3 6-3s3.517 3 6 3 4.345-3 6-3"/></svg>
        </div>
        <h3 class="land-type-card__title">Waterfront Property</h3>
        <p class="land-type-card__desc">Lakefront, riverfront, and creek-side parcels. Tennessee waterfront land holds strong value and we pay accordingly.</p>
      </div>
      <div class="land-type-card">
        <div class="land-type-card__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0v-6a1 1 0 011-1h2a1 1 0 011 1v6m-4 0h4"/></svg>
        </div>
        <h3 class="land-type-card__title">Mobile Home Lots</h3>
        <p class="land-type-card__desc">Land with or without a mobile home on it. We buy mobile home lots and parcels in any condition throughout Tennessee.</p>
      </div>
      <div class="land-type-card">
        <div class="land-type-card__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="land-type-card__title">Land with Liens or Back Taxes</h3>
        <p class="land-type-card__desc">Owe <a href="<?php echo esc_url( home_url( '/sell-house-behind-on-taxes-tennessee/' ) ); ?>">back taxes</a> or have liens on your property? We work through the title issues and can still make a cash offer.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── HOW IT WORKS ── -->
<section class="land-steps-section">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title">How to Sell Your Tennessee Land for Cash</h2>
    </div>
    <div class="steps">
      <div class="step">
        <div class="step__num">1</div>
        <h3 class="step__title">Tell Us About Your Land</h3>
        <p class="step__body">Submit the form or call us at <a href="tel:+16158018126">(615) 801-8126</a>. Share your property address, acreage, and a few basic details. It takes less than 60 seconds and there is no obligation.</p>
      </div>
      <div class="step">
        <div class="step__num">2</div>
        <h3 class="step__title">Receive Your Cash Offer</h3>
        <p class="step__body">We research your land including comparable sales, zoning, access, and market conditions and make a fair, no-obligation cash offer within 24 hours. No hidden fees and no pressure.</p>
      </div>
      <div class="step">
        <div class="step__num">3</div>
        <h3 class="step__title">Close and Get Paid</h3>
        <p class="step__body">Choose your closing date and receive your cash. We can close in as little as 7 days or work on your timeline. We handle all the paperwork and cover the closing costs.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── WHO WE HELP ── -->
<section class="section" id="land-situations">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title">We Help Tennessee Land Owners in Any Situation</h2>
    </div>
    <div class="land-types__grid">
      <div class="land-sit-card land-sit-card--no-link">
        <div class="land-type-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0v-2M5 21H3m2 0v-2m4-14h2m-2 4h2m4-4h2m-2 4h2"/></svg>
        </div>
        <h3 class="land-type-card__title">Inherited Land You Don't Want</h3>
        <p class="land-type-card__desc">Skip the burden of maintaining inherited land. We buy it fast so you can settle the estate.</p>
      </div>
      <div class="land-sit-card land-sit-card--no-link">
        <div class="land-type-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M3 21h18l-9-16-9 16z"/></svg>
        </div>
        <h3 class="land-type-card__title">Behind on Property Taxes</h3>
        <p class="land-type-card__desc">Avoid a tax lien sale. We can pay off your back taxes at closing and put cash in your pocket.</p>
      </div>
      <div class="land-sit-card land-sit-card--no-link">
        <div class="land-type-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/><line x1="6" y1="2" x2="18" y2="22"/></svg>
        </div>
        <h3 class="land-type-card__title">Going Through a Divorce</h3>
        <p class="land-type-card__desc">Divide the asset cleanly. We buy the land so both parties can split the cash and move forward.</p>
      </div>
      <div class="land-sit-card land-sit-card--no-link">
        <div class="land-type-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
        </div>
        <h3 class="land-type-card__title">Relocating Out of State</h3>
        <p class="land-type-card__desc">Do not manage vacant land from across the country. We buy it quickly so you can focus on your move.</p>
      </div>
      <div class="land-sit-card land-sit-card--no-link">
        <div class="land-type-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h3 class="land-type-card__title">Tired of Paying Taxes on Vacant Land</h3>
        <p class="land-type-card__desc">Stop paying annual property taxes on land you are not using. Convert it to cash instead.</p>
      </div>
      <div class="land-sit-card land-sit-card--no-link">
        <div class="land-type-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="land-type-card__title">Land with Title Issues or Liens</h3>
        <p class="land-type-card__desc">We work through title complications, liens, and encumbrances so you can still sell your land for cash.</p>
      </div>
      <div class="land-sit-card land-sit-card--no-link">
        <div class="land-type-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h3 class="land-type-card__title">Need Cash Quickly</h3>
        <p class="land-type-card__desc">Life happens. We can have cash in your hands in as little as 7 days from your first call.</p>
      </div>
      <div class="land-sit-card land-sit-card--no-link">
        <div class="land-type-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
        </div>
        <h3 class="land-type-card__title">Land That Won't Sell on the Market</h3>
        <p class="land-type-card__desc">Tired of waiting? We buy land that has been sitting on the market with no offers.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── REVIEWS ── -->
<?php include( get_template_directory() . '/reviews-section.php' ); ?>

<!-- ── FAQ ── -->
<?php
$land_faq = [
    ['q' => 'How do you determine what my land is worth?', 'a' => 'We evaluate your land based on comparable sales in the area, current market conditions, zoning, access, topography, and development potential. Our goal is to make a fair offer that reflects the true value of your Tennessee land.'],
    ['q' => 'Do I need to clear or prepare the land before selling?', 'a' => 'No. We buy land in any condition including overgrown, wooded, landlocked, or fully cleared. You do not need to make any improvements or invest any money before selling to us.'],
    ['q' => 'How fast can you close on my Tennessee land?', 'a' => 'We can close in as little as 7 days in most cases. If you need more time, we will work on your schedule. You pick the closing date that works best for you.'],
    ['q' => 'Do you buy land with back taxes or liens?', 'a' => 'Yes. We regularly purchase properties with outstanding tax liens, title issues, and other encumbrances. We work through the complications so you do not have to.'],
    ['q' => 'What types of land do you buy in Tennessee?', 'a' => 'We buy all types including vacant lots, rural acreage, farm and agricultural land, timber land, waterfront property, commercial parcels, mobile home lots, inherited land, and more. Any size, any condition, anywhere in Tennessee.'],
    ['q' => 'Are there any fees or commissions when selling my land to you?', 'a' => 'Absolutely not. There are zero fees, zero commissions, and we cover the closing costs. The cash offer we make is the amount you receive at closing.'],
];
?>
<section class="sit-faq-section">
  <div class="container">
    <h2 class="sit-section-title">Frequently Asked Questions About Selling Your Tennessee Land</h2>
    <div class="sit-faq-list">
      <?php foreach ( $land_faq as $faq ): ?>
      <div class="sit-faq-item">
        <div class="situation-faq-question">
          <h3><?php echo esc_html( $faq['q'] ); ?></h3>
          <span class="faq-icon">+</span>
        </div>
        <div class="situation-faq-answer">
          <p><?php echo esc_html( $faq['a'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- FAQ Schema -->
<script type="application/ld+json">
<?php
echo wp_json_encode( array(
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map( function( $faq ) {
        return array(
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ),
        );
    }, $land_faq ),
), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>

<!-- LocalBusiness Schema -->
<script type="application/ld+json">
<?php
echo wp_json_encode( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'LocalBusiness',
    'name'        => 'Tennessee Cash For Homes',
    'description' => $meta_description,
    'url'         => home_url( '/sell-your-land-1' ),
    'telephone'   => '+16158018126',
    'email'       => 'info@tncashforhomes.com',
    'address'     => array(
        '@type'           => 'PostalAddress',
        'addressLocality' => 'Murfreesboro',
        'addressRegion'   => 'TN',
        'addressCountry'  => 'US',
    ),
    'areaServed'  => array(
        '@type' => 'State',
        'name'  => 'Tennessee',
    ),
    'aggregateRating' => array(
        '@type'       => 'AggregateRating',
        'ratingValue' => '5.0',
        'reviewCount' => '50',
    ),
    'sameAs' => array(
        'https://www.facebook.com/tennesseecashforhomes',
        'https://www.instagram.com/tennesseecashforhomes/',
    ),
), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>

<!-- Service Schema -->
<script type="application/ld+json">
<?php
echo wp_json_encode( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    'name'        => 'Sell Your Land for Cash in Tennessee',
    'provider'    => array(
        '@type'     => 'RealEstateAgent',
        'name'      => 'Tennessee Cash For Homes',
        'telephone' => '+16158018126',
        'url'       => home_url( '/' ),
        'areaServed'=> 'Tennessee',
    ),
    'description' => $meta_description,
    'url'         => home_url( '/sell-your-land-1' ),
), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>

<script>
// FAQ Accordion
document.addEventListener('DOMContentLoaded', function() {
    var questions = document.querySelectorAll('.situation-faq-question');
    questions.forEach(function(question) {
        question.addEventListener('click', function() {
            var answer = this.nextElementSibling;
            var icon = this.querySelector('.faq-icon');
            var isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
            document.querySelectorAll('.situation-faq-answer').forEach(function(a) {
                a.style.maxHeight = '0px';
                a.style.opacity = '0';
            });
            document.querySelectorAll('.sit-faq-item .faq-icon').forEach(function(i) {
                i.textContent = '+';
            });
            if (!isOpen) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                answer.style.opacity = '1';
                icon.textContent = '\u2212';
            }
        });
    });

    // Reviews carousel
    var track = document.getElementById('reviewsTrack');
    var outer = document.getElementById('reviewsOuter');
    var dotsWrap = document.getElementById('revDots');
    var btnPrev = document.getElementById('revPrev');
    var btnNext = document.getElementById('revNext');
    if (!track) return;
    var TOTAL = track.children.length;
    var current = 0;
    for (var i = 0; i < TOTAL; i++) {
        var dot = document.createElement('button');
        dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
        dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
        (function(idx) { dot.addEventListener('click', function() { goTo(idx); }); })(i);
        dotsWrap.appendChild(dot);
    }
    function goTo(n) {
        current = (n + TOTAL) % TOTAL;
        track.style.transform = 'translateX(-' + (current * (100 / TOTAL)) + '%)';
        dotsWrap.querySelectorAll('.carousel-dot').forEach(function(d, idx) {
            d.classList.toggle('active', idx === current);
        });
    }
    btnNext.addEventListener('click', function() { goTo(current + 1); });
    btnPrev.addEventListener('click', function() { goTo(current - 1); });
});
</script>

<?php get_footer(); ?>
