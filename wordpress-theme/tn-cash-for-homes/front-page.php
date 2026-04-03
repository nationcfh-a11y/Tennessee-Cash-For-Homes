<?php get_header(); ?>

<!-- ── HERO ── -->
<section class="hero" id="get-offer">
  <div class="container">
    <div class="hero__inner">
      <div class="hero__badge-pill">&#11088; Tennessee's #1 Rated Cash Home Buyer</div>
      <h1 class="hero__title">Get a Fair Cash Offer For Your <span class="green">Tennessee</span> Home.</h1>
      <p class="hero__subtitle">No repairs. No agent fees. Close in as little as 14 days.</p>

      <!-- MULTI-STEP FORM -->
      <div class="msf-card">
        <div class="msf-progress">
          <span class="msf-progress__label">Step <span id="msfStepNum">1</span> of 6</span>
          <div class="msf-progress__bar"><div class="msf-progress__fill" id="msfProgressFill" style="width:16.66%"></div></div>
        </div>

        <form id="multiStepForm" novalidate>
          <!-- Step 1: Address -->
          <div class="msf-step active" data-step="1">
            <div class="msf-address-row">
              <div class="msf-input-icon">
                <svg width="20" height="20" fill="none" stroke="#6B7280" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                <input type="text" id="msfAddress" name="address" placeholder="Enter your Tennessee property address" required />
              </div>
              <button type="button" class="msf-btn msf-btn--primary" onclick="msfNext(1)">Get My Offer &rarr;</button>
            </div>
            <p class="msf-privacy">&#128274; Your information is 100% private and never shared</p>
          </div>

          <!-- Step 2: Property Details -->
          <div class="msf-step" data-step="2">
            <h3 class="msf-step__title">Tell us about your property</h3>
            <p class="msf-step__label">Property Type</p>
            <div class="msf-card-grid msf-card-grid--2x2">
              <button type="button" class="msf-option-card" data-field="property_type" data-value="Single Family Home">&#127968; Single Family Home</button>
              <button type="button" class="msf-option-card" data-field="property_type" data-value="Condo or Townhouse">&#127970; Condo or Townhouse</button>
              <button type="button" class="msf-option-card" data-field="property_type" data-value="Multi-Family">&#127960; Multi-Family</button>
              <button type="button" class="msf-option-card" data-field="property_type" data-value="Land or Lot">&#127807; Land or Lot</button>
            </div>
            <p class="msf-step__label">Bedrooms</p>
            <div class="msf-pill-row">
              <button type="button" class="msf-pill" data-field="bedrooms" data-value="1">1</button>
              <button type="button" class="msf-pill" data-field="bedrooms" data-value="2">2</button>
              <button type="button" class="msf-pill" data-field="bedrooms" data-value="3">3</button>
              <button type="button" class="msf-pill" data-field="bedrooms" data-value="4">4</button>
              <button type="button" class="msf-pill" data-field="bedrooms" data-value="5+">5+</button>
            </div>
            <p class="msf-step__label">Bathrooms</p>
            <div class="msf-pill-row">
              <button type="button" class="msf-pill" data-field="bathrooms" data-value="1">1</button>
              <button type="button" class="msf-pill" data-field="bathrooms" data-value="1.5">1.5</button>
              <button type="button" class="msf-pill" data-field="bathrooms" data-value="2">2</button>
              <button type="button" class="msf-pill" data-field="bathrooms" data-value="3+">3+</button>
            </div>
            <div class="msf-nav">
              <button type="button" class="msf-btn msf-btn--back" onclick="msfBack(2)">&larr; Back</button>
              <button type="button" class="msf-btn msf-btn--primary" onclick="msfNext(2)">Next &rarr;</button>
            </div>
          </div>

          <!-- Step 3: Property Condition -->
          <div class="msf-step" data-step="3">
            <h3 class="msf-step__title">What is the condition of the home?</h3>
            <div class="msf-card-grid msf-card-grid--2x2">
              <button type="button" class="msf-option-card" data-field="condition" data-value="Needs Major Work">&#128296; Needs Major Work<small>Major repairs or gut renovation needed</small></button>
              <button type="button" class="msf-option-card" data-field="condition" data-value="Needs Some Work">&#128295; Needs Some Work<small>Minor repairs or cosmetic updates</small></button>
              <button type="button" class="msf-option-card" data-field="condition" data-value="Good Condition">&#9989; Good Condition<small>Well maintained, move-in ready</small></button>
              <button type="button" class="msf-option-card" data-field="condition" data-value="Excellent">&#11088; Excellent<small>Updated and in great shape</small></button>
            </div>
            <p class="msf-step__label">Additional Details</p>
            <div class="msf-toggle-row">
              <span>Does the roof need replacement?</span>
              <div class="msf-toggle-group" data-field="roof_issue">
                <button type="button" class="msf-pill" data-value="Yes">Yes</button>
                <button type="button" class="msf-pill" data-value="No">No</button>
              </div>
            </div>
            <div class="msf-toggle-row">
              <span>Are there any foundation issues?</span>
              <div class="msf-toggle-group" data-field="foundation_issue">
                <button type="button" class="msf-pill" data-value="Yes">Yes</button>
                <button type="button" class="msf-pill" data-value="No">No</button>
              </div>
            </div>
            <div class="msf-toggle-row">
              <span>Any fire or water damage?</span>
              <div class="msf-toggle-group" data-field="damage">
                <button type="button" class="msf-pill" data-value="Yes">Yes</button>
                <button type="button" class="msf-pill" data-value="No">No</button>
              </div>
            </div>
            <div class="msf-nav">
              <button type="button" class="msf-btn msf-btn--back" onclick="msfBack(3)">&larr; Back</button>
              <button type="button" class="msf-btn msf-btn--primary" onclick="msfNext(3)">Next &rarr;</button>
            </div>
          </div>

          <!-- Step 4: Your Situation -->
          <div class="msf-step" data-step="4">
            <h3 class="msf-step__title">What best describes your situation?</h3>
            <div class="msf-card-grid msf-card-grid--2x3">
              <button type="button" class="msf-option-card" data-field="situation" data-value="Relocating">&#128230; Relocating or Moving</button>
              <button type="button" class="msf-option-card" data-field="situation" data-value="Divorce">&#9878;&#65039; Going Through Divorce</button>
              <button type="button" class="msf-option-card" data-field="situation" data-value="Inherited">&#127962; Inherited Property</button>
              <button type="button" class="msf-option-card" data-field="situation" data-value="Financial Hardship">&#128176; Financial Hardship</button>
              <button type="button" class="msf-option-card" data-field="situation" data-value="Foreclosure">&#128200; Facing Foreclosure</button>
              <button type="button" class="msf-option-card" data-field="situation" data-value="Tired Landlord">&#128273; Tired Landlord</button>
            </div>
            <p class="msf-step__label">How soon do you need to sell?</p>
            <div class="msf-pill-row msf-pill-row--wide">
              <button type="button" class="msf-pill" data-field="timeline" data-value="ASAP">As Soon As Possible</button>
              <button type="button" class="msf-pill" data-field="timeline" data-value="1-3 Months">Within 1 to 3 Months</button>
              <button type="button" class="msf-pill" data-field="timeline" data-value="3-6 Months">Within 3 to 6 Months</button>
              <button type="button" class="msf-pill" data-field="timeline" data-value="Exploring">Just Exploring Options</button>
            </div>
            <p class="msf-step__label">Is there an HOA?</p>
            <div class="msf-pill-row">
              <button type="button" class="msf-pill" data-field="hoa" data-value="Yes">Yes</button>
              <button type="button" class="msf-pill" data-field="hoa" data-value="No">No</button>
              <button type="button" class="msf-pill" data-field="hoa" data-value="Not Sure">Not Sure</button>
            </div>
            <p class="msf-step__label">Is the property currently occupied?</p>
            <div class="msf-pill-row">
              <button type="button" class="msf-pill" data-field="occupied" data-value="Yes">Yes</button>
              <button type="button" class="msf-pill" data-field="occupied" data-value="No">No</button>
            </div>
            <div class="msf-nav">
              <button type="button" class="msf-btn msf-btn--back" onclick="msfBack(4)">&larr; Back</button>
              <button type="button" class="msf-btn msf-btn--primary" onclick="msfNext(4)">Next &rarr;</button>
            </div>
          </div>

          <!-- Step 5: Upload Photos -->
          <div class="msf-step" data-step="5">
            <h3 class="msf-step__title">Add photos for a more accurate offer</h3>
            <p class="msf-step__sub">Photos are completely optional but help us make a stronger offer faster</p>
            <div class="msf-upload-zone" id="msfUploadZone">
              <svg width="40" height="40" fill="none" stroke="#6B7280" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
              <p>Drag photos here or click to upload</p>
              <small>JPG, PNG, HEIC up to 10MB each</small>
              <input type="file" id="msfFileInput" multiple accept=".jpg,.jpeg,.png,.heic" style="display:none" />
            </div>
            <div class="msf-thumbnails" id="msfThumbnails"></div>
            <a href="javascript:void(0)" class="msf-skip" onclick="msfNext(5)">Skip This Step &rarr;</a>
            <div class="msf-nav">
              <button type="button" class="msf-btn msf-btn--back" onclick="msfBack(5)">&larr; Back</button>
              <button type="button" class="msf-btn msf-btn--primary" onclick="msfNext(5)">Next &rarr;</button>
            </div>
          </div>

          <!-- Step 6: Contact Information -->
          <div class="msf-step" data-step="6">
            <h3 class="msf-step__title">Where should we send your cash offer?</h3>
            <div class="form-group">
              <label for="msfName">Full Name</label>
              <input type="text" id="msfName" name="name" placeholder="John Smith" required />
            </div>
            <div class="form-group">
              <label for="msfPhone">Phone Number</label>
              <input type="tel" id="msfPhone" name="phone" placeholder="(615) 555-0123" required />
            </div>
            <div class="form-group">
              <label for="msfEmail">Email Address</label>
              <input type="email" id="msfEmail" name="email" placeholder="john@example.com" required />
            </div>
            <button type="submit" class="msf-btn msf-btn--primary msf-btn--block">Get My Free Cash Offer &rarr;</button>
            <p class="msf-privacy">&#128274; We respect your privacy. No spam ever. We will call within 24 hours.</p>
            <div class="msf-trust-badges">
              <span>BBB Accredited</span>
              <span class="msf-trust-dot">&middot;</span>
              <span>5 Star Google Rating</span>
              <span class="msf-trust-dot">&middot;</span>
              <span>1,200+ Homes Bought</span>
            </div>
            <div class="msf-nav msf-nav--single">
              <button type="button" class="msf-btn msf-btn--back" onclick="msfBack(6)">&larr; Back</button>
            </div>
          </div>

          <!-- Success Message -->
          <div class="msf-step msf-success" data-step="success" style="display:none;">
            <div class="msf-success__icon">&#9989;</div>
            <h3 class="msf-step__title">Thank you <span id="msfFirstName"></span>!</h3>
            <p>We received your information and will call you within 24 hours with your cash offer.</p>
          </div>
        </form>
      </div><!-- /msf-card -->

      <!-- Trust indicators below form -->
      <div class="hero__trust-row">
        <div class="hero__trust-item">
          <svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          1,200+ Homes Purchased Across Tennessee
        </div>
        <div class="hero__trust-item">
          <svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Zero Fees Zero Commissions Zero Closing Costs
        </div>
        <div class="hero__trust-item">
          <svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Close in as Little as 14 Days on Your Schedule
        </div>
      </div>
    </div><!-- /hero__inner -->
  </div>
</section>

<!-- ── PROOF BAR ── -->
<div class="proof-bar">
  <div class="container">
    <div class="proof-bar__inner">
      <div class="proof-stat">
        <div class="proof-stat__num"><span class="count-up" data-target="1200">0</span></div>
        <div class="proof-stat__label">Homes Purchased</div>
      </div>
      <div class="proof-divider"></div>
      <div class="proof-stat">
        <div class="proof-stat__num">14 Days</div>
        <div class="proof-stat__label">Average Close Time</div>
      </div>
      <div class="proof-divider"></div>
      <div class="proof-stat">
        <div class="proof-stat__num">$0</div>
        <div class="proof-stat__label">Agent Fees or Commissions</div>
      </div>
      <div class="proof-divider"></div>
      <div class="proof-stat">
        <div class="proof-stat__num">5.0 &#9733;</div>
        <div class="proof-stat__label">Google Rating</div>
      </div>
    </div>
  </div>
</div>

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

<!-- ── DIFFERENCE ── -->
<section class="difference-section">
  <div class="difference__img-wrap">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/brand_assets/Company%20Photo.png" alt="Tennessee Cash For Homes team - local Middle Tennessee cash home buyers" loading="lazy" />
  </div>
  <div class="difference__content-wrap">
    <div class="difference__content">
      <h2 class="difference__title">The <span>Tennessee Cash For Homes</span> Difference</h2>
      <p class="difference__intro">We are not a big out-of-state corporation or an automated system. We are a Middle Tennessee family owned business that believes in doing business the right way.</p>
      <ul class="difference__list">
        <li class="diff-item">
          <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Based Right Here in Middle Tennessee
        </li>
        <li class="diff-item">
          <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Family Owned and Relationship Focused
        </li>
        <li class="diff-item">
          <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Fair and Straightforward Cash Offers
        </li>
        <li class="diff-item">
          <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          No Cleaning, No Repairs, No Hidden Fees
        </li>
        <li class="diff-item">
          <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Flexible Closing on Your Timeline
        </li>
      </ul>
      <div class="difference__trust-row">
        <div class="difference__stars">
          <div class="difference__stars-icons">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
          <div class="difference__stars-label"><strong>5 out of 5</strong> on Google</div>
        </div>
        <a href="https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick" target="_blank" rel="nofollow">
          <img src="https://seal-nashville.bbb.org/seals/blue-seal-200-42-whitetxt-bbb-37373815.png" style="border: 0; height: 42px; width: auto;" alt="Tennessee Cash For Homes BBB Business Review" loading="lazy" />
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ── BENEFITS / SITUATIONS ── -->
<section class="section section--alt" id="benefits">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Why Tennessee Homeowners Choose Us</p>
      <h2 class="section__title">The Fastest, Easiest Way to Sell Your Tennessee House for Cash</h2>
      <p class="section__subtitle">No agents, no repairs, no delays. Just an honest, all-cash offer from a 5-star rated local Tennessee home buyer.</p>
    </div>
    <div class="benefits-grid benefits-grid--redesign">
      <a href="<?php echo esc_url( home_url( '/sell-my-house-foreclosure-tennessee/' ) ); ?>" class="benefit-card benefit-card--redesign">
        <div class="benefit-icon benefit-icon--redesign">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3>Facing Foreclosure</h3>
        <p>Behind on payments? We can close fast enough to stop the foreclosure process and put cash in your hand before it is too late.</p>
        <span class="benefit-link">Learn More &rarr;</span>
      </a>
      <a href="<?php echo esc_url( home_url( '/sell-my-house-divorce-tennessee/' ) ); ?>" class="benefit-card benefit-card--redesign">
        <div class="benefit-icon benefit-icon--redesign">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h3>Going Through Divorce</h3>
        <p>Simplify property division with a fast, fair cash sale. No drawn-out listings, no disagreements over repairs or staging.</p>
        <span class="benefit-link">Learn More &rarr;</span>
      </a>
      <a href="<?php echo esc_url( home_url( '/sell-inherited-house-tennessee/' ) ); ?>" class="benefit-card benefit-card--redesign">
        <div class="benefit-icon benefit-icon--redesign">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <h3>Inherited Property</h3>
        <p>Skip the stress of managing an inherited home from afar. We buy as-is so you never have to clean, repair, or list it.</p>
        <span class="benefit-link">Learn More &rarr;</span>
      </a>
      <a href="<?php echo esc_url( home_url( '/sell-my-house-relocating-tennessee/' ) ); ?>" class="benefit-card benefit-card--redesign">
        <div class="benefit-icon benefit-icon--redesign">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 3 20 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        </div>
        <h3>Relocating</h3>
        <p>Moving for a job, family, or fresh start? Sell your Tennessee house fast for cash and move on your timeline, not the market's.</p>
        <span class="benefit-link">Learn More &rarr;</span>
      </a>
      <a href="<?php echo esc_url( home_url( '/sell-house-as-is-tennessee/' ) ); ?>" class="benefit-card benefit-card--redesign">
        <div class="benefit-icon benefit-icon--redesign">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h3>Sell As-Is</h3>
        <p>No repairs, no staging, no cleaning. We buy houses in any condition. Fire damage, foundation issues, outdated everything. We handle it.</p>
        <span class="benefit-link">Learn More &rarr;</span>
      </a>
      <a href="<?php echo esc_url( home_url( '/sell-rental-property-tennessee/' ) ); ?>" class="benefit-card benefit-card--redesign">
        <div class="benefit-icon benefit-icon--redesign">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 11-7.778 7.778 5.5 5.5 0 017.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>
        </div>
        <h3>Tired Landlord</h3>
        <p>Done dealing with tenants, maintenance calls, and headaches? Sell your rental property fast for cash, even with tenants still in place.</p>
        <span class="benefit-link">Learn More &rarr;</span>
      </a>
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
            <th></th>
            <th>Tennessee Cash For Homes</th>
            <th>Traditional Listing</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Closing timeline</td>
            <td><span class="check">&#10004;</span> As fast as 7 days</td>
            <td><span class="cross">60 to 90+ days</span></td>
          </tr>
          <tr>
            <td>Repairs required</td>
            <td><span class="check">&#10004;</span> None &mdash; buy as-is</td>
            <td><span class="cross">Often required</span></td>
          </tr>
          <tr>
            <td>Agent commissions</td>
            <td><span class="check">&#10004;</span> $0</td>
            <td><span class="cross">5 to 6% of sale price</span></td>
          </tr>
          <tr>
            <td>Closing costs</td>
            <td><span class="check">&#10004;</span> We cover them</td>
            <td><span class="cross">2 to 3% of sale price</span></td>
          </tr>
          <tr>
            <td>Showings &amp; open houses</td>
            <td><span class="check">&#10004;</span> None</td>
            <td><span class="cross">Many required</span></td>
          </tr>
          <tr>
            <td>Financing contingencies</td>
            <td><span class="check">&#10004;</span> No &mdash; all cash</td>
            <td><span class="cross">Deals can fall through</span></td>
          </tr>
          <tr>
            <td>Certainty of sale</td>
            <td><span class="check">&#10004;</span> Guaranteed</td>
            <td><span class="cross">Not guaranteed</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ── TESTIMONIALS CAROUSEL ── -->
<section class="section section--alt" id="testimonials">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">5-Star Google Reviews</p>
      <h2 class="section__title">What Tennessee Homeowners Are Saying About Us</h2>
      <p class="section__subtitle">We have helped hundreds of Tennessee homeowners sell their houses fast for cash with zero stress and no surprises.</p>
    </div>

    <div class="reviews-outer" id="reviewsOuter">
      <div class="reviews-track" id="reviewsTrack">

        <!-- Slide 1 -->
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Great company to work with, these guys actually care about you and will take care of you. Great character as well!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">NK</div>
              <div>
                <div class="testimonial-name">Nathan Krager</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">We couldn't recommend Karson any higher! We contacted him when we were preparing to sell our home and he was so honest to tell us that in our particular case, it would make more sense to sell with a traditional agent. He set us up with Chris, who we really like, and decided to go that route. Thanks for the honest assessment and referral! I'll definitely recommend Tennessee Cash for Homes to anyone that needs to get a property sold quickly.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">JP</div>
              <div>
                <div class="testimonial-name">JP JP</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Such a great group to work with. They were able to give me a fair deal with no hassles. Thank you Karson for going above and beyond.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">TH</div>
              <div>
                <div class="testimonial-name">Trish Haberman</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">These guys were absolutely amazing. I sold my house without having to do a single repair and they even helped me find my next place to live!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">CD</div>
              <div>
                <div class="testimonial-name">Clayton Daniels</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">I've known and worked with TN Cash for Homes and the people behind it for many years. I greatly appreciate their integrity and attention to detail. They genuinely want to help the homeowners they work with and always do everything in their power to create win-win situations for their investors. Best of all, they consistently think outside the box to come up with innovative solutions for those whom they serve. I cannot recommend them highly enough.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">JH</div>
              <div>
                <div class="testimonial-name">Joe Hafner</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">If you need to sell a home quickly, they're professional, fair, and truly care about making things easy for the seller. Highly recommend.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">LD</div>
              <div>
                <div class="testimonial-name">Lisa Daniels</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">The team at TN Cash for Homes were outstanding! I was in a bad situation with my home loan and after one call with this company they created a custom solution that resolved my issues. They were professional, efficient and understanding. I highly recommend this company.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">NH</div>
              <div>
                <div class="testimonial-name">Nancy Hughes</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Really enjoyed working with Tennessee Cash For Homes. They helped me sell my house in <a href="<?php echo esc_url( home_url( '/where-we-buy/clarksville/' ) ); ?>" class="city-link">Clarksville</a> fast for cash! Highly recommend working with them.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">JP</div>
              <div>
                <div class="testimonial-name">John Peterson</div>
                <div class="testimonial-location">Clarksville, TN</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">They bought my father's rental portfolio! Paid cash and closed on multiple homes in less than 3 weeks! They also took them with the tenants which is really tough to find someone willing to buy a rental with leases in place. Would highly recommend this company to anyone who doesn't want to deal with listing a home!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">DA</div>
              <div>
                <div class="testimonial-name">Dowling Armstrong</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
        </div>

        <!-- Slide 4 -->
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Great experience working with these guys. The whole process went super fast, and easy. Both Davis and Dowling were true to their word which is very important when doing business. I would work with them again any day.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">CP</div>
              <div>
                <div class="testimonial-name">Christopher Payne</div>
                <div class="testimonial-location">Middle Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Working with Karson at Tennessee Cash for Homes has been an absolute pleasure. From the very beginning, he was professional, honest, and genuinely cared about helping me find the best solution for selling my house. He made the entire process simple and stress-free, explaining everything clearly and being there every step of the way. It's rare to find someone in this business who is not only knowledgeable but also truly compassionate. I highly recommend Karson and his team to anyone looking to sell their home quickly and with confidence.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">TB</div>
              <div>
                <div class="testimonial-name">Taylor Broyles</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">I inherited a property that needed a lot of work and didn't know what to do with it. Karson walked me through all my options and made a fair cash offer that saved me time and stress. He handled everything and made the process incredibly smooth. Super grateful I found him.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">JT</div>
              <div>
                <div class="testimonial-name">Josh Tully</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
        </div>

        <!-- Slide 5 -->
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">I had an amazing experience with this company. My sisters and I were selling our mother's home who had passed. They made it very easy, we got a fair offer and they even allowed us to get a few of our mother's belongings we forgot after the closing. I highly recommend this company — the folks there are great to work with, unlike a lot of the scammy companies we had tried to sell to before.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">KW</div>
              <div>
                <div class="testimonial-name">Kayla Wright</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Very professional. Karson was absolutely amazing to work with and helped me and my family out tremendously! We were able to get a cash offer and move to our new residence without having to do any repairs to our old house! He closed in less than two weeks and was honest and open about the process the entire time. He was also extremely communicative throughout the entire process.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">TO</div>
              <div>
                <div class="testimonial-name">Tsms Official</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Karson is wonderful! Honest and up front about the offer he gave. I got quotes from other companies and they all came back to renegotiate the numbers. Highly recommend Tennessee Cash For Homes!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">K</div>
              <div>
                <div class="testimonial-name">Kylie</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
        </div>

      </div><!-- /reviews-track -->
    </div><!-- /reviews-outer -->

    <div class="carousel-controls">
      <button class="carousel-btn" id="revPrev" aria-label="Previous reviews">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <div class="carousel-dots" id="revDots"></div>
      <button class="carousel-btn" id="revNext" aria-label="Next reviews">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>

  </div>
</section>

<!-- ── SELL YOUR LAND ── -->
<section class="land-section">
  <div class="container">
    <div class="land__inner">
      <div class="land__content">
        <h2 class="land__title">We Also Buy Tennessee Land For Cash</h2>
        <p class="land__sub">Vacant lots, rural acreage, undeveloped land &mdash; any size, any condition, anywhere in Tennessee. No surveys required and no cleanup needed.</p>
        <ul class="land__list">
          <li>
            <svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            No surveys or inspections required
          </li>
          <li>
            <svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            No cleanup or clearing needed
          </li>
          <li>
            <svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Fair cash offers within 24 hours
          </li>
          <li>
            <svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Close in as little as 14 days
          </li>
        </ul>
        <a href="#get-offer" class="msf-btn msf-btn--primary">Get a Land Cash Offer &rarr;</a>
      </div>
      <div class="land__visual">
        <svg viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="land__illustration" aria-label="Tennessee rolling hills illustration">
          <rect width="400" height="300" fill="#F8F9FA"/>
          <path d="M0 220 Q50 180 100 200 Q150 160 200 180 Q250 140 300 170 Q350 150 400 160 L400 300 L0 300 Z" fill="#E5E7EB"/>
          <path d="M0 240 Q80 200 160 220 Q240 190 320 210 Q360 200 400 205 L400 300 L0 300 Z" fill="#84CC9C" opacity="0.3"/>
          <path d="M0 260 Q100 230 200 250 Q300 230 400 240 L400 300 L0 300 Z" fill="#84CC9C" opacity="0.5"/>
          <circle cx="280" cy="140" r="6" fill="#84CC9C"/>
          <path d="M280 146 L280 170" stroke="#84CC9C" stroke-width="2"/>
          <circle cx="280" cy="140" r="12" fill="#84CC9C" opacity="0.2"/>
        </svg>
      </div>
    </div>
  </div>
</section>

<!-- ── FAQ SCHEMA ── -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How quickly can you make me an offer?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We can make you a fair cash offer within 24 hours of receiving your property information. Simply fill out our form and we will be in touch same day."
      }
    },
    {
      "@type": "Question",
      "name": "Do I need to make repairs before selling?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Absolutely not. We buy houses in any condition — fire damage, foundation issues, outdated kitchens, hoarder homes. You do not need to fix or clean a single thing."
      }
    },
    {
      "@type": "Question",
      "name": "Are there any fees or commissions?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Zero fees. Zero commissions. Zero closing costs. The offer we make is the amount you walk away with. We cover all closing costs."
      }
    },
    {
      "@type": "Question",
      "name": "How is the cash offer price determined?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We look at the location, condition, and comparable sales in your area. We factor in any repairs needed and make you a fair transparent offer based on real market data."
      }
    },
    {
      "@type": "Question",
      "name": "What types of properties do you buy?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We buy single family homes, condos, townhouses, multi-family properties, inherited properties, vacant land, and lots across all of Tennessee."
      }
    },
    {
      "@type": "Question",
      "name": "What if I am behind on payments or facing foreclosure?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We specialize in helping homeowners facing foreclosure. We can often close quickly enough to stop the foreclosure process and get you cash in hand."
      }
    },
    {
      "@type": "Question",
      "name": "Can I sell if the house has tenants?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. We buy tenant occupied properties regularly. You do not need to evict anyone before selling to us."
      }
    },
    {
      "@type": "Question",
      "name": "How long does the closing process take?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We can close in as little as 14 days. If you need more time we are flexible and can close on a schedule that works for you."
      }
    },
    {
      "@type": "Question",
      "name": "Is there any obligation when I request an offer?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "None whatsoever. Our cash offer is completely free and comes with zero obligation. You can take the offer, decline it, or simply use it as information — no pressure ever."
      }
    },
    {
      "@type": "Question",
      "name": "Do you buy land and vacant lots?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. We buy vacant lots, rural acreage, and undeveloped land across all of Tennessee. Any size, any condition, any location."
      }
    }
  ]
}
</script>

<!-- ── FAQ ── -->
<section class="faq-section" id="faq">
  <div class="container">
    <div class="faq__inner">
      <div class="faq__left">
        <span class="faq__badge">FAQ</span>
        <h2 class="faq__title">Common Questions About Selling Your House For Cash in Tennessee</h2>
        <p class="faq__sub">Get answers to the most common questions we hear from Tennessee homeowners.</p>
        <a href="#get-offer" class="msf-btn msf-btn--primary">Get Your Cash Offer &rarr;</a>
      </div>
      <div class="faq__right">
        <div class="faq-accordion">
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>How quickly can you make me an offer?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">We can make you a fair cash offer within 24 hours of receiving your property information. Simply fill out our form and we will be in touch same day.</div>
          </div>
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>Do I need to make repairs before selling?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">Absolutely not. We buy houses in any condition &mdash; fire damage, foundation issues, outdated kitchens, hoarder homes. You do not need to fix or clean a single thing.</div>
          </div>
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>Are there any fees or commissions?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">Zero fees. Zero commissions. Zero closing costs. The offer we make is the amount you walk away with. We cover all closing costs.</div>
          </div>
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>How is the cash offer price determined?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">We look at the location, condition, and comparable sales in your area. We factor in any repairs needed and make you a fair transparent offer based on real market data.</div>
          </div>
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>What types of properties do you buy?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">We buy single family homes, condos, townhouses, multi-family properties, inherited properties, vacant land, and lots across all of Tennessee.</div>
          </div>
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>What if I am behind on payments or facing foreclosure?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">We specialize in helping homeowners facing foreclosure. We can often close quickly enough to stop the foreclosure process and get you cash in hand.</div>
          </div>
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>Can I sell if the house has tenants?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">Yes. We buy tenant occupied properties regularly. You do not need to evict anyone before selling to us.</div>
          </div>
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>How long does the closing process take?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">We can close in as little as 14 days. If you need more time we are flexible and can close on a schedule that works for you.</div>
          </div>
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>Is there any obligation when I request an offer?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">None whatsoever. Our cash offer is completely free and comes with zero obligation. You can take the offer, decline it, or simply use it as information &mdash; no pressure ever.</div>
          </div>
          <div class="faq-acc-item">
            <button class="faq-acc-btn" type="button" aria-expanded="false">
              <h3>Do you buy land and vacant lots?</h3>
              <svg class="faq-acc-icon" width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="faq-acc-answer">Yes. We buy vacant lots, rural acreage, and undeveloped land across all of Tennessee. Any size, any condition, any location.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── AREAS WE SERVE ── -->
<section class="section section--alt">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Statewide Coverage</p>
      <h2 class="section__title">Areas We Serve Across Tennessee</h2>
      <p class="section__subtitle">We buy houses throughout the entire state of Tennessee. Whether you are in a major metro or a small town, we can make you a cash offer.</p>
    </div>
    <div class="cities-grid">
      <a href="<?php echo esc_url( home_url( '/where-we-buy/nashville/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Nashville</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/murfreesboro/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Murfreesboro</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/knoxville/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Knoxville</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/memphis/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Memphis</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/clarksville/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Clarksville</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/chattanooga/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Chattanooga</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/franklin/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Franklin</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/shelbyville/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Shelbyville</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/antioch/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Antioch</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/smyrna/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Smyrna</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/la-vergne/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>La Vergne</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/gallatin/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Gallatin</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/columbia/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Columbia</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/spring-hill/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Spring Hill</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/lebanon/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Lebanon</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/jackson/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Jackson</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/hendersonville/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Hendersonville</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/crossville/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Crossville</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/mcminnville/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>McMinnville</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/old-hickory/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Old Hickory</span></a>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/woodbury/' ) ); ?>" class="city-chip city-chip--link"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Woodbury</span></a>
    </div>
    <p class="areas-footnote">Don't see your city? We serve <a href="#get-offer">all of Tennessee</a>. Contact us for your cash offer today.</p>
  </div>
</section>

<!-- ── CTA BAND ── -->
<section class="cta-band">
  <div class="container">
    <h2>Ready to Sell Your Tennessee House Fast for Cash?</h2>
    <p>Get your free, no-obligation cash offer today from Tennessee's 5-star rated home buyers. No repairs, no fees, no waiting.</p>
    <a href="#get-offer" class="btn-white">Get My Free Cash Offer Today</a>
    <span class="cta-phone">Or call us directly: <a href="tel:+16158018126">(615) 801-8126</a></span>
  </div>
</section>

<?php get_footer(); ?>
