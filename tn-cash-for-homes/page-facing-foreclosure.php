<?php
/**
 * Template Name: Facing Foreclosure
 *
 * Main foreclosure landing page — /facing-foreclosure/
 */

$meta_title       = 'Facing Foreclosure in Tennessee? We Can Help | Tennessee Cash For Homes';
$meta_description = 'Facing foreclosure in Tennessee? You have options. Tennessee Cash For Homes buys houses fast for cash, helping homeowners stop foreclosure and protect their credit. Get a free cash offer today.';

add_filter( 'pre_get_document_title', function() use ( $meta_title ) {
    return $meta_title;
}, 99 );

if ( ! empty( $meta_description ) ) {
    add_action( 'wp_head', function() use ( $meta_description ) {
        echo '<meta name="description" content="' . esc_attr( $meta_description ) . '" />' . "\n";
    }, 0 );
}

get_header();

/* ── City list for the preview section ── */
$fc_cities = [
    ['name' => 'Nashville',      'slug' => 'nashville'],
    ['name' => 'Murfreesboro',   'slug' => 'murfreesboro'],
    ['name' => 'Knoxville',      'slug' => 'knoxville'],
    ['name' => 'Memphis',        'slug' => 'memphis'],
    ['name' => 'Clarksville',    'slug' => 'clarksville'],
    ['name' => 'Chattanooga',    'slug' => 'chattanooga'],
    ['name' => 'Franklin',       'slug' => 'franklin'],
    ['name' => 'Shelbyville',    'slug' => 'shelbyville'],
    ['name' => 'Antioch',        'slug' => 'antioch'],
    ['name' => 'Smyrna',         'slug' => 'smyrna'],
    ['name' => 'La Vergne',      'slug' => 'la-vergne'],
    ['name' => 'Gallatin',       'slug' => 'gallatin'],
    ['name' => 'Columbia',       'slug' => 'columbia'],
    ['name' => 'Spring Hill',    'slug' => 'spring-hill'],
    ['name' => 'Lebanon',        'slug' => 'lebanon'],
    ['name' => 'Jackson',        'slug' => 'jackson'],
    ['name' => 'Hendersonville', 'slug' => 'hendersonville'],
    ['name' => 'Crossville',     'slug' => 'crossville'],
    ['name' => 'McMinnville',    'slug' => 'mcminnville'],
    ['name' => 'Old Hickory',    'slug' => 'old-hickory'],
    ['name' => 'Woodbury',       'slug' => 'woodbury'],
    ['name' => 'Chapel Hill',    'slug' => 'chapel-hill'],
];
?>

<!-- ══════════════════════════════════════════════
     1. HERO SECTION
     ══════════════════════════════════════════════ -->
<section class="fc-hero">
  <div class="fc-hero__overlay"></div>
  <div class="container">
    <div class="fc-hero__inner">
      <div class="fc-hero__content">
        <span class="fc-hero__eyebrow">TENNESSEE FORECLOSURE HELP</span>
        <h1 class="fc-hero__h1">Facing Foreclosure in Tennessee? We Can Help.</h1>
        <p class="fc-hero__sub">You have options. Tennessee Cash For Homes buys houses fast for cash &mdash; helping homeowners stop foreclosure before it&rsquo;s too late.</p>
        <ul class="fc-hero__checks">
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Stop the foreclosure process</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Get a fair cash offer in 24 hours</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Close in as little as 7 days</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Walk away with cash in hand</li>
        </ul>
        <div class="fc-hero__ctas">
          <a href="#fc-form" class="btn-primary">Get My Free Cash Offer &rarr;</a>
          <a href="tel:+16158018126" class="btn-outline">Call (615) 801-8126</a>
        </div>
        <div class="fc-hero__trust">
          <div class="fc-hero__trust-stars">
            <span class="fc-hero__stars-icons">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
            <span class="fc-hero__stars-label"><strong>5.0</strong> Google Rating</span>
          </div>
          <a href="https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick" target="_blank" rel="nofollow noopener" class="bbb-seal"><img src="https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png" alt="Tennessee Cash For Homes BBB A+ Rating" width="200" height="42" loading="lazy" decoding="async" /></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     2. EMPATHY STATEMENT
     ══════════════════════════════════════════════ -->
<section class="fc-empathy">
  <div class="container">
    <blockquote class="fc-empathy__quote">
      &ldquo;Foreclosure doesn&rsquo;t happen overnight. If you&rsquo;re behind on payments, you still have time to act &mdash; and selling for cash may be your fastest path forward.&rdquo;
    </blockquote>
    <div class="fc-empathy__body">
      <p>Every year thousands of Tennessee homeowners fall behind on their mortgage payments. It can happen to anyone &mdash; job loss, unexpected medical bills, a costly divorce, or an inherited property with a mortgage you simply cannot afford. The notices start arriving, the phone calls become relentless, and the weight of the situation can feel paralyzing.</p>
      <p>The most important thing to understand is that you are not out of options. Tennessee law gives homeowners time between the first missed payment and the actual foreclosure sale, and during that window a cash sale can stop the entire process. By selling your home before the auction date you pay off the outstanding mortgage, protect your credit from the lasting damage of a completed foreclosure, and walk away with whatever equity remains &mdash; in cash.</p>
      <p>At Tennessee Cash For Homes we have worked with homeowners at every stage of the foreclosure process. We move quickly because we understand that every day matters when a sale date is approaching.</p>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     3. TENNESSEE FORECLOSURE TIMELINE
     ══════════════════════════════════════════════ -->
<section class="fc-timeline">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="fc-section-title">Understanding the Tennessee Foreclosure Process</h2>
      <p class="fc-section-subtitle">Tennessee is a <strong>non-judicial foreclosure state</strong>, meaning lenders can foreclose without going through court. Here is the typical timeline and what you can expect at each stage.</p>
    </div>

    <div class="fc-timeline__steps">
      <!-- Step 1 -->
      <div class="fc-timeline__step">
        <div class="fc-timeline__num">1</div>
        <div class="fc-timeline__body">
          <h3>Missed Payments</h3>
          <p>After missing one or more mortgage payments, your lender will begin contacting you by phone and mail. Most lenders wait 3 to 6 months of missed payments before formally starting the foreclosure process, though federal regulations require a 120-day delinquency period before filing.</p>
          <p class="fc-timeline__time"><strong>Typical window:</strong> 90 to 180 days from first missed payment</p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="fc-timeline__step">
        <div class="fc-timeline__num">2</div>
        <div class="fc-timeline__body">
          <h3>Notice of Default</h3>
          <p>The lender records a formal notice that you are in default on the loan. Under Tennessee Code Annotated &sect; 35-5-101 through 35-5-111, the deed of trust gives the lender (or a trustee acting on their behalf) the power to sell the property without court involvement. Once this notice is recorded, the foreclosure clock officially starts.</p>
          <p class="fc-timeline__time"><strong>Typical window:</strong> 30 to 60 days after default is declared</p>
        </div>
      </div>

      <!-- CALLOUT BOX -->
      <div class="fc-timeline__callout">
        <svg width="24" height="24" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
        <p>At any point before the foreclosure sale date, you may be able to sell your home for cash and stop the process entirely.</p>
      </div>

      <!-- Step 3 -->
      <div class="fc-timeline__step">
        <div class="fc-timeline__num">3</div>
        <div class="fc-timeline__body">
          <h3>Notice of Sale</h3>
          <p>The trustee must publish a notice of the foreclosure sale in a newspaper in the county where the property is located for three consecutive weeks before the sale date, as required by Tennessee law. Additionally, the borrower must be sent a written notice at least 20 days before the scheduled sale. The notice includes the date, time, and location of the auction (typically the county courthouse).</p>
          <p class="fc-timeline__time"><strong>Typical window:</strong> 21 to 30 days from publication to sale</p>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="fc-timeline__step">
        <div class="fc-timeline__num">4</div>
        <div class="fc-timeline__body">
          <h3>Foreclosure Sale</h3>
          <p>The property is sold at public auction, usually on the courthouse steps in the county where the property is located. The highest bidder takes ownership. In many cases the lender places the opening bid at the outstanding loan balance, and if no outside bidders appear, the lender takes possession of the home as a bank-owned or REO property.</p>
          <p class="fc-timeline__time"><strong>This is the final deadline.</strong> Once the sale occurs, the homeowner loses all rights to the property.</p>
        </div>
      </div>

      <!-- Step 5 -->
      <div class="fc-timeline__step">
        <div class="fc-timeline__num">5</div>
        <div class="fc-timeline__body">
          <h3>Eviction</h3>
          <p>If the home is sold at auction, Tennessee does not provide a statutory right of redemption for non-judicial foreclosures. The new owner can begin eviction proceedings immediately. In most cases the former homeowner must vacate the property within a matter of weeks after the sale is confirmed.</p>
          <p class="fc-timeline__time"><strong>Note:</strong> Tennessee is one of the faster foreclosure states. The entire process can take as little as 60 days from notice of sale to eviction.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     4. YOUR OPTIONS
     ══════════════════════════════════════════════ -->
<section class="fc-options">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="fc-section-title">Your Options When Facing Foreclosure in Tennessee</h2>
      <p class="fc-section-subtitle">Every situation is different. Here are the most common paths homeowners take when facing foreclosure, along with the pros and cons of each.</p>
    </div>
    <div class="fc-options__grid">

      <!-- Option 1: Sell for Cash (highlighted) -->
      <div class="fc-option-card fc-option-card--highlighted">
        <div class="fc-option-card__badge">Fastest Option</div>
        <h3 class="fc-option-card__title">Sell for Cash</h3>
        <p class="fc-option-card__desc">Sell your home directly to a cash buyer before the foreclosure sale date.</p>
        <div class="fc-option-card__pros">
          <h4>Pros</h4>
          <ul>
            <li>Can close in as little as 7 days</li>
            <li>Stops foreclosure immediately</li>
            <li>Protects your credit score</li>
            <li>No repairs, fees, or commissions</li>
            <li>Walk away with cash in hand</li>
          </ul>
        </div>
        <div class="fc-option-card__cons">
          <h4>Cons</h4>
          <ul>
            <li>Offer may be below full retail market value</li>
            <li>Must have enough equity to cover loan payoff</li>
          </ul>
        </div>
        <a href="#fc-form" class="btn-primary">Get My Cash Offer &rarr;</a>
      </div>

      <!-- Option 2: Loan Modification -->
      <div class="fc-option-card">
        <h3 class="fc-option-card__title">Loan Modification</h3>
        <p class="fc-option-card__desc">Work with your lender to restructure loan terms, lower payments, or extend the loan.</p>
        <div class="fc-option-card__pros">
          <h4>Pros</h4>
          <ul>
            <li>May keep your home</li>
            <li>Could lower monthly payment</li>
            <li>Less credit damage than foreclosure</li>
          </ul>
        </div>
        <div class="fc-option-card__cons">
          <h4>Cons</h4>
          <ul>
            <li>Lengthy application process (30-90 days)</li>
            <li>Approval is not guaranteed</li>
            <li>Foreclosure may continue during review</li>
            <li>May extend total loan cost significantly</li>
          </ul>
        </div>
      </div>

      <!-- Option 3: Deed in Lieu -->
      <div class="fc-option-card">
        <h3 class="fc-option-card__title">Deed in Lieu of Foreclosure</h3>
        <p class="fc-option-card__desc">Voluntarily transfer ownership of the property to the lender to avoid foreclosure.</p>
        <div class="fc-option-card__pros">
          <h4>Pros</h4>
          <ul>
            <li>Avoids public foreclosure auction</li>
            <li>Less credit damage than full foreclosure</li>
            <li>May include relocation assistance</li>
          </ul>
        </div>
        <div class="fc-option-card__cons">
          <h4>Cons</h4>
          <ul>
            <li>You lose the home and all equity</li>
            <li>Still appears on credit report</li>
            <li>Lender must agree to accept</li>
            <li>May owe taxes on forgiven debt</li>
          </ul>
        </div>
      </div>

      <!-- Option 4: Bankruptcy -->
      <div class="fc-option-card">
        <h3 class="fc-option-card__title">Bankruptcy</h3>
        <p class="fc-option-card__desc">Filing Chapter 7 or Chapter 13 bankruptcy triggers an automatic stay that temporarily halts foreclosure.</p>
        <div class="fc-option-card__pros">
          <h4>Pros</h4>
          <ul>
            <li>Immediate automatic stay stops foreclosure</li>
            <li>Chapter 13 may allow catch-up payments</li>
            <li>Protects other assets from creditors</li>
          </ul>
        </div>
        <div class="fc-option-card__cons">
          <h4>Cons</h4>
          <ul>
            <li>Severe credit impact (7-10 years)</li>
            <li>Expensive legal process</li>
            <li>Chapter 7 may not save the home</li>
            <li>Public record that affects future borrowing</li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     5. HOW WE HELP
     ══════════════════════════════════════════════ -->
<section class="fc-how">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="fc-section-title fc-section-title--light">How Tennessee Cash For Homes Stops Foreclosure</h2>
    </div>
    <div class="fc-how__steps">
      <div class="fc-how__step">
        <div class="fc-how__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </div>
        <h3>Submit Your Info</h3>
        <p>Fill out our quick form or call us. Tell us about your property and your timeline. It takes less than 60 seconds.</p>
      </div>
      <div class="fc-how__arrow">
        <svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </div>
      <div class="fc-how__step">
        <div class="fc-how__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3>Receive Cash Offer in 24 Hours</h3>
        <p>We evaluate your property and present a fair, no-obligation cash offer. No hidden fees, no lowball tactics.</p>
      </div>
      <div class="fc-how__arrow">
        <svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </div>
      <div class="fc-how__step">
        <div class="fc-how__icon">
          <svg width="32" height="32" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3>Close Before Your Sale Date</h3>
        <p>Accept the offer and we handle everything. We can close in as little as 7 days to meet your courthouse deadline.</p>
      </div>
    </div>
    <p class="fc-how__bottom">We work with homeowners at every stage of the foreclosure process &mdash; from the first missed payment to days before the sale date. Our team coordinates directly with title companies and lenders to ensure a fast, clean closing that satisfies your outstanding mortgage and stops the foreclosure in its tracks.</p>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     6. FORECLOSURE RESOURCES
     ══════════════════════════════════════════════ -->
<section class="fc-resources">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="fc-section-title">Tennessee Foreclosure Resources and Legal Help</h2>
      <p class="fc-section-subtitle">These organizations provide free or low-cost foreclosure prevention assistance, housing counseling, and legal help for Tennessee homeowners.</p>
    </div>
    <div class="fc-resources__grid">

      <div class="fc-resource-card">
        <div class="fc-resource-card__icon">
          <svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/></svg>
        </div>
        <h3 class="fc-resource-card__title">Tennessee Housing Development Agency (THDA)</h3>
        <p class="fc-resource-card__desc">Statewide foreclosure prevention programs, homeowner assistance, and housing counseling services for Tennessee residents.</p>
        <span class="fc-resource-card__tag">Helpful for: Foreclosure Prevention</span>
        <a href="https://thda.org" target="_blank" rel="noopener noreferrer" class="fc-resource-card__link">Visit Website &rarr;</a>
      </div>

      <div class="fc-resource-card">
        <div class="fc-resource-card__icon">
          <svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
        </div>
        <h3 class="fc-resource-card__title">Tennessee Bar Association Lawyer Referral</h3>
        <p class="fc-resource-card__desc">Connect with a licensed Tennessee attorney who specializes in foreclosure defense, real estate law, or bankruptcy.</p>
        <span class="fc-resource-card__tag">Helpful for: Legal Representation</span>
        <a href="https://www.tba.org/public-resources/hiring-a-lawyer/" target="_blank" rel="noopener noreferrer" class="fc-resource-card__link">Visit Website &rarr;</a>
      </div>

      <div class="fc-resource-card">
        <div class="fc-resource-card__icon">
          <svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3 class="fc-resource-card__title">HUD-Approved Housing Counselors in Tennessee</h3>
        <p class="fc-resource-card__desc">Free foreclosure avoidance counseling from HUD-certified agencies. Counselors can help you understand your options and negotiate with your lender.</p>
        <span class="fc-resource-card__tag">Helpful for: Free Counseling</span>
        <a href="https://www.hud.gov/i_want_to/talk_to_a_housing_counselor" target="_blank" rel="noopener noreferrer" class="fc-resource-card__link">Visit Website &rarr;</a>
      </div>

      <div class="fc-resource-card">
        <div class="fc-resource-card__icon">
          <svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <h3 class="fc-resource-card__title">Tennessee Legal Aid Organizations</h3>
        <p class="fc-resource-card__desc">Free legal assistance for qualifying Tennessee homeowners facing foreclosure. Services include foreclosure defense, loan modification help, and tenant rights.</p>
        <span class="fc-resource-card__tag">Helpful for: Free Legal Help</span>
        <a href="https://www.las.org" target="_blank" rel="noopener noreferrer" class="fc-resource-card__link">Visit Website &rarr;</a>
      </div>

      <div class="fc-resource-card">
        <div class="fc-resource-card__icon">
          <svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
        <h3 class="fc-resource-card__title">Consumer Financial Protection Bureau (CFPB)</h3>
        <p class="fc-resource-card__desc">Federal consumer protection resources including foreclosure guides, sample letters to lenders, and tools to submit complaints against servicers.</p>
        <span class="fc-resource-card__tag">Helpful for: Know Your Rights</span>
        <a href="https://www.consumerfinance.gov/housing/housing-insecurity/help-for-homeowners/foreclosure/" target="_blank" rel="noopener noreferrer" class="fc-resource-card__link">Visit Website &rarr;</a>
      </div>

      <div class="fc-resource-card">
        <div class="fc-resource-card__icon">
          <svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
        </div>
        <h3 class="fc-resource-card__title">Tennessee County Courts &mdash; Foreclosure Sale Schedules</h3>
        <p class="fc-resource-card__desc">Find your county courthouse schedule for upcoming foreclosure sales, trustee sale notices, and public auction information across Tennessee.</p>
        <span class="fc-resource-card__tag">Helpful for: Sale Date Lookup</span>
        <a href="https://www.tncourts.gov" target="_blank" rel="noopener noreferrer" class="fc-resource-card__link">Visit Website &rarr;</a>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     7. FORM SECTION
     ══════════════════════════════════════════════ -->
<section class="fc-form-section" id="fc-form">
  <div class="container">
    <div class="fc-form__inner">
      <div class="fc-form__copy">
        <h2 class="fc-section-title">Get Your Free Cash Offer and Stop Foreclosure</h2>
        <p>We understand this is a stressful time. Our process is simple, confidential, and there is no obligation. We have helped Tennessee homeowners stop foreclosure and walk away with dignity and cash in hand.</p>
        <ul class="fc-form__reassure">
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> No obligation &mdash; ever</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> 100% confidential</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Cash offer within 24 hours</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Close before your sale date</li>
        </ul>
      </div>
      <div class="fc-form__card">
        <form onsubmit="handleSubmit(event)">
          <div class="form-group">
            <label for="fc-address">Property Address</label>
            <input type="text" id="fc-address" name="address" placeholder="123 Main St, Nashville, TN" required />
          </div>
          <div class="form-group">
            <label for="fc-name">Your Name</label>
            <input type="text" id="fc-name" name="name" placeholder="John Smith" required />
          </div>
          <div class="form-group">
            <label for="fc-phone">Phone Number</label>
            <input type="tel" id="fc-phone" name="phone" placeholder="(615) 555-0123" required />
          </div>
          <div class="form-group">
            <label for="fc-email">Email Address</label>
            <input type="email" id="fc-email" name="email" placeholder="john@example.com" />
          </div>
          <div class="form-group">
            <label for="fc-urgency">How soon is your foreclosure sale date?</label>
            <select id="fc-urgency" name="urgency">
              <option value="">Select one...</option>
              <option value="unknown">I don't know yet</option>
              <option value="90+">More than 90 days</option>
              <option value="30-90">30 &ndash; 90 days</option>
              <option value="<30">Less than 30 days</option>
              <option value="set">Sale date already set</option>
            </select>
          </div>
          <button type="submit" class="btn-primary btn-primary--block">Get My Cash Offer and Stop Foreclosure &rarr;</button>
        </form>
        <p class="form-disclaimer">&#128274; Your information is private and never shared.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     8. CITY PAGES PREVIEW
     ══════════════════════════════════════════════ -->
<section class="fc-cities">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="fc-section-title">Facing Foreclosure? We Help Homeowners Across Tennessee</h2>
      <p class="fc-section-subtitle">Select your city below to find local foreclosure resources and get help specific to your area.</p>
    </div>
    <div class="fc-cities__grid">
      <?php foreach ( $fc_cities as $c ) : ?>
      <a href="<?php echo esc_url( home_url( '/facing-foreclosure/' . $c['slug'] ) ); ?>" class="city-chip">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
        <span><?php echo esc_html( $c['name'] ); ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     9. FAQ SECTION
     ══════════════════════════════════════════════ -->
<?php
$fc_faqs = [
    [
        'q' => 'How long does foreclosure take in Tennessee?',
        'a' => 'Tennessee is a non-judicial foreclosure state, meaning the process does not require court involvement. From the first missed payment to the foreclosure sale, the typical timeline is 4 to 6 months. However, once the Notice of Sale is published, the auction can happen in as little as 21 days. The exact timeline depends on your lender and how quickly they move through each step.',
    ],
    [
        'q' => 'Can I sell my house to stop foreclosure in Tennessee?',
        'a' => 'Yes. At any point before the foreclosure sale date, you have the right to sell your home. If the sale proceeds are enough to pay off your outstanding mortgage balance, the foreclosure stops and the lien is released. A cash sale is often the fastest way to accomplish this because there are no financing contingencies, appraisals, or inspection delays that could slow the process.',
    ],
    [
        'q' => 'What happens to my credit if my house goes to foreclosure?',
        'a' => 'A completed foreclosure can drop your credit score by 100 to 160 points or more, and it stays on your credit report for 7 years. During that time it can make it very difficult to qualify for a new mortgage, rent an apartment, or even get certain jobs. Selling your home before the foreclosure is finalized can significantly reduce this credit damage.',
    ],
    [
        'q' => 'How fast can you close if I am facing foreclosure?',
        'a' => 'We can close in as little as 7 days in urgent foreclosure situations. We work directly with title companies and your lender to coordinate a fast closing that meets your courthouse deadline. In most cases we can move faster than any traditional buyer or real estate agent.',
    ],
    [
        'q' => 'Do you buy houses that are already in foreclosure?',
        'a' => 'Yes. We regularly work with homeowners who have already received a Notice of Default or Notice of Sale. As long as the foreclosure auction has not taken place, we can still make a cash offer and close quickly. Even if your sale date is only weeks away, contact us immediately so we can evaluate your situation.',
    ],
    [
        'q' => 'Will I owe money after a foreclosure sale in Tennessee?',
        'a' => 'In Tennessee, lenders may pursue a deficiency judgment if the foreclosure sale price is less than what you owe on the mortgage. This means you could still owe the difference. By selling your home for cash before the auction, you have more control over the sale price and can potentially avoid a deficiency balance entirely.',
    ],
    [
        'q' => 'What if I am already past the notice of sale stage?',
        'a' => 'If a Notice of Sale has been published but the auction has not happened yet, there is still time to act. Contact us immediately. We have closed on properties just days before scheduled auction dates. The sooner you reach out, the more options we have to help you.',
    ],
];
?>
<section class="fc-faq">
  <div class="container">
    <h2 class="fc-section-title" style="text-align:center;margin-bottom:40px;">Frequently Asked Questions About Foreclosure in Tennessee</h2>
    <div class="sit-faq-list">
      <?php foreach ( $fc_faqs as $faq ) : ?>
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
echo wp_json_encode( [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map( function( $faq ) {
        return [
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }, $fc_faqs ),
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>

<!-- LocalBusiness Schema -->
<script type="application/ld+json">
<?php
echo wp_json_encode( [
    '@context'    => 'https://schema.org',
    '@type'       => 'LocalBusiness',
    'name'        => 'Tennessee Cash For Homes',
    'description' => 'Tennessee Cash For Homes helps homeowners facing foreclosure by buying houses fast for cash. Stop foreclosure, protect your credit, and walk away with cash in hand.',
    'url'         => home_url( '/facing-foreclosure/' ),
    'telephone'   => '+1-615-801-8126',
    'email'       => 'info@tncashforhomes.com',
    'address'     => [
        '@type'           => 'PostalAddress',
        'addressLocality' => 'Murfreesboro',
        'addressRegion'   => 'TN',
        'addressCountry'  => 'US',
    ],
    'areaServed' => [
        '@type' => 'State',
        'name'  => 'Tennessee',
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>

<!-- ══════════════════════════════════════════════
     10. FINAL CTA
     ══════════════════════════════════════════════ -->
<section class="fc-final-cta">
  <div class="container">
    <h2 class="fc-final-cta__title">Time is Critical. Let&rsquo;s Talk Today.</h2>
    <p class="fc-final-cta__sub">The sooner you reach out the more options you have. Get a no-obligation cash offer within 24 hours.</p>
    <a href="#fc-form" class="btn-primary btn-primary--lg">Get My Free Cash Offer &rarr;</a>
    <p class="fc-final-cta__phone">Or call now: <a href="tel:+16158018126">(615) 801-8126</a></p>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     INLINE STYLES
     ══════════════════════════════════════════════ -->
<style>
/* ── Variables ── */
:root {
  --fc-green: #84CC9C;
  --fc-green-dark: #2D6A4F;
  --fc-charcoal: #3D3D3D;
  --fc-light-charcoal: #5a5a5a;
  --fc-off-white: #FAF9F7;
  --fc-light-bg: #F2F2F2;
  --fc-white: #FFFFFF;
  --fc-green-tint: #f0f9f3;
}

/* ── 1. HERO ── */
.fc-hero {
  position: relative;
  background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/brand_assets/New_Background.webp') center/cover no-repeat;
  padding: 120px 0 80px;
  min-height: 520px;
  display: flex;
  align-items: center;
}
.fc-hero__overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.65);
}
.fc-hero__inner {
  position: relative;
  z-index: 2;
  max-width: 720px;
}
.fc-hero__eyebrow {
  display: inline-block;
  background: rgba(132, 204, 156, 0.18);
  color: var(--fc-green);
  font-family: 'Poppins', sans-serif;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.12em;
  padding: 6px 16px;
  border-radius: 4px;
  margin-bottom: 20px;
  text-transform: uppercase;
}
.fc-hero__h1 {
  font-family: 'Poppins', sans-serif;
  font-size: clamp(2rem, 4.5vw, 3rem);
  font-weight: 800;
  color: var(--fc-white);
  line-height: 1.15;
  margin: 0 0 16px;
}
.fc-hero__sub {
  font-size: 1.1rem;
  color: rgba(255,255,255,0.88);
  line-height: 1.6;
  margin: 0 0 24px;
  max-width: 600px;
}
.fc-hero__checks {
  list-style: none;
  padding: 0;
  margin: 0 0 28px;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.fc-hero__checks li {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--fc-white);
  font-size: 1rem;
  font-weight: 500;
}
.fc-hero__ctas {
  display: flex;
  gap: 14px;
  flex-wrap: wrap;
  margin-bottom: 28px;
}
.fc-hero__ctas .btn-outline {
  border: 2px solid rgba(255,255,255,0.7);
  color: var(--fc-white);
  padding: 12px 28px;
  border-radius: 8px;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 0.95rem;
  text-decoration: none;
  transition: all 0.2s ease;
  background: transparent;
}
.fc-hero__ctas .btn-outline:hover {
  background: rgba(255,255,255,0.12);
  border-color: var(--fc-white);
}
.fc-hero__trust {
  display: flex;
  align-items: center;
  gap: 20px;
  flex-wrap: wrap;
}
.fc-hero__trust-stars {
  display: flex;
  align-items: center;
  gap: 8px;
}
.fc-hero__stars-icons {
  color: #F59E0B;
  font-size: 1.2rem;
  letter-spacing: 2px;
}
.fc-hero__stars-label {
  color: rgba(255,255,255,0.85);
  font-size: 0.9rem;
}

/* ── 2. EMPATHY ── */
.fc-empathy {
  background: var(--fc-off-white);
  padding: 72px 0;
}
.fc-empathy__quote {
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1.15rem, 2.2vw, 1.5rem);
  font-weight: 600;
  color: var(--fc-charcoal);
  line-height: 1.55;
  text-align: center;
  max-width: 820px;
  margin: 0 auto 40px;
  border: none;
  padding: 0;
  quotes: none;
}
.fc-empathy__body {
  max-width: 780px;
  margin: 0 auto;
}
.fc-empathy__body p {
  font-size: 1.05rem;
  color: var(--fc-light-charcoal);
  line-height: 1.75;
  margin: 0 0 20px;
}
.fc-empathy__body p:last-child {
  margin-bottom: 0;
}

/* ── 3. TIMELINE ── */
.fc-timeline {
  background: var(--fc-white);
  padding: 72px 0;
}
.fc-section-title {
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1.5rem, 3vw, 2rem);
  font-weight: 700;
  color: var(--fc-charcoal);
  margin: 0 0 12px;
  line-height: 1.25;
}
.fc-section-title--light {
  color: var(--fc-white);
}
.fc-section-subtitle {
  font-size: 1.05rem;
  color: var(--fc-light-charcoal);
  line-height: 1.65;
  margin: 0 0 40px;
  max-width: 700px;
}
.section__header--center .fc-section-subtitle {
  margin-left: auto;
  margin-right: auto;
}
.fc-timeline__steps {
  max-width: 780px;
  margin: 0 auto;
}
.fc-timeline__step {
  display: flex;
  gap: 24px;
  margin-bottom: 36px;
}
.fc-timeline__num {
  flex-shrink: 0;
  width: 44px;
  height: 44px;
  background: var(--fc-green);
  color: var(--fc-white);
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  font-size: 1.2rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 2px;
}
.fc-timeline__body h3 {
  font-family: 'Poppins', sans-serif;
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--fc-charcoal);
  margin: 0 0 8px;
}
.fc-timeline__body p {
  font-size: 0.98rem;
  color: var(--fc-light-charcoal);
  line-height: 1.7;
  margin: 0 0 8px;
}
.fc-timeline__time {
  font-size: 0.88rem;
  color: var(--fc-green-dark);
  font-weight: 600;
}
.fc-timeline__callout {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  background: var(--fc-green-tint);
  border-left: 4px solid var(--fc-green);
  padding: 20px 24px;
  border-radius: 0 8px 8px 0;
  margin: 8px 0 36px;
}
.fc-timeline__callout svg {
  flex-shrink: 0;
  margin-top: 2px;
}
.fc-timeline__callout p {
  font-size: 1rem;
  font-weight: 600;
  color: var(--fc-green-dark);
  line-height: 1.55;
  margin: 0;
}

/* ── 4. OPTIONS ── */
.fc-options {
  background: var(--fc-green-tint);
  padding: 72px 0;
}
.fc-options__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}
.fc-option-card {
  background: var(--fc-white);
  border: 1px solid #e0e0e0;
  border-radius: 12px;
  padding: 28px 24px;
  position: relative;
  transition: box-shadow 0.2s ease;
}
.fc-option-card:hover {
  box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}
.fc-option-card--highlighted {
  border: 2px solid var(--fc-green);
  box-shadow: 0 8px 24px rgba(132, 204, 156, 0.18);
  transform: translateY(-4px);
}
.fc-option-card__badge {
  position: absolute;
  top: -12px;
  left: 50%;
  transform: translateX(-50%);
  background: var(--fc-green);
  color: var(--fc-white);
  font-family: 'Poppins', sans-serif;
  font-size: 0.75rem;
  font-weight: 700;
  padding: 4px 16px;
  border-radius: 20px;
  white-space: nowrap;
  letter-spacing: 0.04em;
}
.fc-option-card__title {
  font-family: 'Poppins', sans-serif;
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--fc-charcoal);
  margin: 8px 0 8px;
}
.fc-option-card__desc {
  font-size: 0.9rem;
  color: var(--fc-light-charcoal);
  line-height: 1.55;
  margin: 0 0 16px;
}
.fc-option-card__pros h4,
.fc-option-card__cons h4 {
  font-family: 'Poppins', sans-serif;
  font-size: 0.82rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  margin: 0 0 8px;
}
.fc-option-card__pros h4 { color: var(--fc-green-dark); }
.fc-option-card__cons h4 { color: #b91c1c; }
.fc-option-card__pros ul,
.fc-option-card__cons ul {
  list-style: none;
  padding: 0;
  margin: 0 0 16px;
}
.fc-option-card__pros li,
.fc-option-card__cons li {
  font-size: 0.88rem;
  color: var(--fc-light-charcoal);
  line-height: 1.5;
  padding: 3px 0 3px 20px;
  position: relative;
}
.fc-option-card__pros li::before {
  content: '\2713';
  position: absolute;
  left: 0;
  color: var(--fc-green);
  font-weight: 700;
}
.fc-option-card__cons li::before {
  content: '\2717';
  position: absolute;
  left: 0;
  color: #b91c1c;
  font-weight: 700;
}
.fc-option-card .btn-primary {
  width: 100%;
  text-align: center;
  margin-top: 8px;
}

/* ── 5. HOW WE HELP ── */
.fc-how {
  background: var(--fc-charcoal);
  padding: 72px 0;
}
.fc-how__steps {
  display: flex;
  align-items: flex-start;
  justify-content: center;
  gap: 16px;
  margin-bottom: 40px;
}
.fc-how__step {
  text-align: center;
  flex: 1;
  max-width: 280px;
}
.fc-how__icon {
  width: 64px;
  height: 64px;
  background: rgba(132, 204, 156, 0.12);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 16px;
}
.fc-how__step h3 {
  font-family: 'Poppins', sans-serif;
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--fc-white);
  margin: 0 0 8px;
}
.fc-how__step p {
  font-size: 0.92rem;
  color: rgba(255,255,255,0.75);
  line-height: 1.6;
  margin: 0;
}
.fc-how__arrow {
  display: flex;
  align-items: center;
  padding-top: 28px;
}
.fc-how__bottom {
  text-align: center;
  max-width: 700px;
  margin: 0 auto;
  font-size: 1rem;
  color: rgba(255,255,255,0.8);
  line-height: 1.7;
}

/* ── 6. RESOURCES ── */
.fc-resources {
  background: var(--fc-white);
  padding: 72px 0;
}
.fc-resources__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}
.fc-resource-card {
  background: var(--fc-light-bg);
  border-radius: 12px;
  padding: 28px 24px;
  display: flex;
  flex-direction: column;
  transition: box-shadow 0.2s ease;
}
.fc-resource-card:hover {
  box-shadow: 0 6px 20px rgba(0,0,0,0.06);
}
.fc-resource-card__icon {
  width: 48px;
  height: 48px;
  background: var(--fc-white);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 16px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.fc-resource-card__title {
  font-family: 'Poppins', sans-serif;
  font-size: 1rem;
  font-weight: 700;
  color: var(--fc-charcoal);
  margin: 0 0 8px;
  line-height: 1.35;
}
.fc-resource-card__desc {
  font-size: 0.9rem;
  color: var(--fc-light-charcoal);
  line-height: 1.55;
  margin: 0 0 14px;
  flex: 1;
}
.fc-resource-card__tag {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 0.78rem;
  font-weight: 600;
  color: var(--fc-green-dark);
  background: rgba(132, 204, 156, 0.15);
  padding: 4px 12px;
  border-radius: 20px;
  margin-bottom: 14px;
  width: fit-content;
}
.fc-resource-card__link {
  font-size: 0.88rem;
  font-weight: 600;
  color: var(--fc-green-dark);
  text-decoration: none;
  transition: color 0.2s ease;
}
.fc-resource-card__link:hover {
  color: var(--fc-green);
}

/* ── 7. FORM ── */
.fc-form-section {
  background: var(--fc-off-white);
  padding: 72px 0;
  scroll-margin-top: 100px;
}
.fc-form__inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: start;
}
.fc-form__copy h2 {
  margin-bottom: 20px;
}
.fc-form__copy > p {
  font-size: 1.05rem;
  color: var(--fc-light-charcoal);
  line-height: 1.7;
  margin: 0 0 24px;
}
.fc-form__reassure {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.fc-form__reassure li {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 1rem;
  color: var(--fc-charcoal);
  font-weight: 500;
}
.fc-form__card {
  background: var(--fc-white);
  border-radius: 14px;
  padding: 32px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}
.fc-form__card .form-group {
  margin-bottom: 16px;
}
.fc-form__card label {
  display: block;
  font-family: 'Poppins', sans-serif;
  font-size: 0.88rem;
  font-weight: 600;
  color: var(--fc-charcoal);
  margin-bottom: 6px;
}
.fc-form__card input,
.fc-form__card select {
  width: 100%;
  padding: 12px 14px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  font-size: 0.95rem;
  color: var(--fc-charcoal);
  background: var(--fc-white);
  transition: border-color 0.2s ease;
  box-sizing: border-box;
}
.fc-form__card input:focus,
.fc-form__card select:focus {
  outline: none;
  border-color: var(--fc-green);
  box-shadow: 0 0 0 3px rgba(132, 204, 156, 0.2);
}
.fc-form__card input::placeholder {
  color: #9ca3af;
}
.fc-form__card .btn-primary--block {
  width: 100%;
  text-align: center;
  padding: 14px 24px;
  margin-top: 8px;
}
.fc-form__card .form-disclaimer {
  text-align: center;
  font-size: 0.82rem;
  color: #9ca3af;
  margin: 12px 0 0;
}

/* ── 8. CITY PAGES PREVIEW ── */
.fc-cities {
  background: var(--fc-white);
  padding: 72px 0;
}
.fc-cities__grid {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
}

/* ── 9. FAQ ── */
.fc-faq {
  background: var(--fc-off-white);
  padding: 72px 0;
}

/* ── 10. FINAL CTA ── */
.fc-final-cta {
  background: var(--fc-charcoal);
  padding: 72px 0;
  text-align: center;
}
.fc-final-cta__title {
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1.5rem, 3vw, 2.2rem);
  font-weight: 800;
  color: var(--fc-white);
  margin: 0 0 16px;
}
.fc-final-cta__sub {
  font-size: 1.1rem;
  color: rgba(255,255,255,0.8);
  margin: 0 0 28px;
  max-width: 560px;
  margin-left: auto;
  margin-right: auto;
  line-height: 1.6;
}
.fc-final-cta .btn-primary--lg {
  padding: 16px 36px;
  font-size: 1.05rem;
}
.fc-final-cta__phone {
  margin: 20px 0 0;
  font-size: 1.1rem;
  color: rgba(255,255,255,0.7);
}
.fc-final-cta__phone a {
  color: var(--fc-green);
  text-decoration: none;
  font-weight: 600;
}
.fc-final-cta__phone a:hover {
  text-decoration: underline;
}

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
  .fc-options__grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .fc-resources__grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .fc-form__inner {
    grid-template-columns: 1fr;
  }
}
@media (max-width: 768px) {
  .fc-hero { padding: 100px 0 60px; }
  .fc-hero__ctas { flex-direction: column; }
  .fc-hero__ctas .btn-outline { text-align: center; }
  .fc-how__steps { flex-direction: column; align-items: center; }
  .fc-how__arrow { transform: rotate(90deg); padding-top: 0; }
  .fc-options__grid { grid-template-columns: 1fr; }
  .fc-option-card--highlighted { transform: none; }
  .fc-resources__grid { grid-template-columns: 1fr; }
  .fc-timeline__step { flex-direction: column; gap: 12px; }
  .fc-empathy, .fc-timeline, .fc-options, .fc-how,
  .fc-resources, .fc-form-section, .fc-cities, .fc-faq, .fc-final-cta {
    padding: 48px 0;
  }
}
</style>

<script>
// FAQ Accordion for foreclosure page
document.addEventListener('DOMContentLoaded', function() {
    var questions = document.querySelectorAll('.fc-faq .situation-faq-question');
    questions.forEach(function(question) {
        question.addEventListener('click', function() {
            var answer = this.nextElementSibling;
            var icon = this.querySelector('.faq-icon');
            var isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
            document.querySelectorAll('.fc-faq .situation-faq-answer').forEach(function(a) {
                a.style.maxHeight = '0px';
                a.style.opacity = '0';
            });
            document.querySelectorAll('.fc-faq .sit-faq-item .faq-icon').forEach(function(i) {
                i.textContent = '+';
            });
            if (!isOpen) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                answer.style.opacity = '1';
                icon.textContent = '\u2212';
            }
        });
    });
});
</script>

<?php get_footer(); ?>
