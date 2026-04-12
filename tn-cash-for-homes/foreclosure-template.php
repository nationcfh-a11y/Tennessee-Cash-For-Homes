<?php
/**
 * Shared Foreclosure City Page Template
 * Included by each foreclosure-pages/page-foreclosure-*.php after setting variables.
 *
 * Required variables:
 *   $fc_city_name, $fc_city_slug, $fc_county, $fc_county_slug,
 *   $fc_meta_title, $fc_meta_desc, $fc_courthouse,
 *   $fc_local_desc_1, $fc_local_desc_2, $fc_local_desc_3
 */

add_filter( 'pre_get_document_title', function() use ( $fc_meta_title ) {
    return $fc_meta_title;
}, 99 );

if ( ! empty( $fc_meta_desc ) ) {
    add_action( 'wp_head', function() use ( $fc_meta_desc ) {
        echo '<meta name="description" content="' . esc_attr( $fc_meta_desc ) . '" />' . "\n";
    }, 0 );
}

get_header();

/* Remove em dashes from local descriptions if any slipped through */
$fc_desc1 = str_replace( [ '&mdash;', '—' ], ',', $fc_local_desc_1 );
$fc_desc2 = str_replace( [ '&mdash;', '—' ], ',', $fc_local_desc_2 );
$fc_desc3 = isset( $fc_local_desc_3 ) ? str_replace( [ '&mdash;', '—' ], ',', $fc_local_desc_3 ) : '';

/* Statewide flag and derived phrases */
$fc_is_statewide     = ! empty( $fc_is_statewide );
$fc_state_suffix     = $fc_is_statewide ? '' : ' TN';
$fc_location_in      = $fc_is_statewide ? 'Tennessee' : $fc_city_name . ', Tennessee';
$fc_county_phrase    = $fc_is_statewide ? 'your county' : $fc_county . ' County';
$fc_newspaper_phrase = $fc_is_statewide ? 'the county where the property is located' : $fc_county . ' County';
$fc_area_phrase      = $fc_is_statewide ? 'statewide' : 'in ' . $fc_county . ' County';
$fc_hud_serves       = $fc_is_statewide ? 'all of Tennessee' : $fc_city_name . ' and ' . $fc_county . ' County';

/* ── FAQ data ── */
if ( $fc_is_statewide ) {
    $fc_faqs = [
        [
            'q' => 'How long does foreclosure take in Tennessee?',
            'a' => 'Tennessee is a non-judicial foreclosure state, so the process does not require court involvement. From the first missed payment to the foreclosure sale, the typical timeline is 4 to 6 months. Once the Notice of Sale is published in your county, the auction can happen in as little as 21 days. The exact timeline depends on your lender and how quickly they move through each step.',
        ],
        [
            'q' => 'Can I sell my house to stop foreclosure in Tennessee?',
            'a' => 'Yes. At any point before the foreclosure sale date, you have the right to sell your Tennessee home. If the sale proceeds are enough to pay off your outstanding mortgage balance, the foreclosure stops and the lien is released. A cash sale is often the fastest way to accomplish this because there are no financing contingencies or inspection delays.',
        ],
        [
            'q' => 'What happens to my credit if my Tennessee house goes to foreclosure?',
            'a' => 'A completed foreclosure can drop your credit score by 100 to 160 points or more, and it stays on your credit report for 7 years. During that time it can make it very difficult to qualify for a new mortgage, rent an apartment, or get certain jobs. Selling your home before the foreclosure is finalized can significantly reduce this credit damage.',
        ],
        [
            'q' => 'How fast can you close if I am facing foreclosure in Tennessee?',
            'a' => 'We can close in as little as 7 days in urgent foreclosure situations anywhere in Tennessee. We work directly with title companies and your lender to coordinate a fast closing that meets your county courthouse deadline.',
        ],
        [
            'q' => 'Do you buy houses that are already in foreclosure in Tennessee?',
            'a' => 'Yes. We regularly work with Tennessee homeowners who have already received a Notice of Default or Notice of Sale. As long as the foreclosure auction has not taken place at the county courthouse where your property is located, we can still make a cash offer and close quickly.',
        ],
        [
            'q' => 'Will I owe money after a foreclosure sale in Tennessee?',
            'a' => 'In Tennessee, lenders may pursue a deficiency judgment if the foreclosure sale price is less than what you owe on the mortgage. This means you could still owe the difference. By selling your Tennessee home for cash before the auction, you have more control over the sale price and can potentially avoid a deficiency balance.',
        ],
        [
            'q' => 'What if my foreclosure sale date has already been set?',
            'a' => 'If a Notice of Sale has been published but the auction has not happened yet, there is still time to act. Contact us immediately. We have closed on properties just days before scheduled auction dates at courthouses across Tennessee. The sooner you reach out, the more options we have.',
        ],
    ];
} else {
    $fc_faqs = [
        [
            'q' => 'How long does foreclosure take in ' . $fc_city_name . ', Tennessee?',
            'a' => 'Tennessee is a non-judicial foreclosure state, so the process does not require court involvement. From the first missed payment to the foreclosure sale, the typical timeline is 4 to 6 months. Once the Notice of Sale is published in ' . $fc_county . ' County, the auction can happen in as little as 21 days. The exact timeline depends on your lender and how quickly they move through each step.',
        ],
        [
            'q' => 'Can I sell my house to stop foreclosure in ' . $fc_city_name . '?',
            'a' => 'Yes. At any point before the foreclosure sale date, you have the right to sell your ' . $fc_city_name . ' home. If the sale proceeds are enough to pay off your outstanding mortgage balance, the foreclosure stops and the lien is released. A cash sale is often the fastest way to accomplish this because there are no financing contingencies or inspection delays.',
        ],
        [
            'q' => 'What happens to my credit if my ' . $fc_city_name . ' house goes to foreclosure?',
            'a' => 'A completed foreclosure can drop your credit score by 100 to 160 points or more, and it stays on your credit report for 7 years. During that time it can make it very difficult to qualify for a new mortgage, rent an apartment, or get certain jobs. Selling your home before the foreclosure is finalized can significantly reduce this credit damage.',
        ],
        [
            'q' => 'How fast can you close if I am facing foreclosure in ' . $fc_city_name . '?',
            'a' => 'We can close in as little as 7 days in urgent foreclosure situations in ' . $fc_city_name . '. We work directly with title companies and your lender to coordinate a fast closing that meets your ' . $fc_county . ' County courthouse deadline.',
        ],
        [
            'q' => 'Do you buy houses that are already in foreclosure in ' . $fc_city_name . '?',
            'a' => 'Yes. We regularly work with ' . $fc_city_name . ' homeowners who have already received a Notice of Default or Notice of Sale. As long as the foreclosure auction has not taken place at ' . $fc_courthouse . ', we can still make a cash offer and close quickly.',
        ],
        [
            'q' => 'Will I owe money after a foreclosure sale in ' . $fc_city_name . '?',
            'a' => 'In Tennessee, lenders may pursue a deficiency judgment if the foreclosure sale price is less than what you owe on the mortgage. This means you could still owe the difference. By selling your ' . $fc_city_name . ' home for cash before the auction, you have more control over the sale price and can potentially avoid a deficiency balance.',
        ],
        [
            'q' => 'What if my foreclosure sale date in ' . $fc_county . ' County has already been set?',
            'a' => 'If a Notice of Sale has been published but the auction has not happened yet, there is still time to act. Contact us immediately. We have closed on properties just days before scheduled auction dates at ' . $fc_courthouse . '. The sooner you reach out, the more options we have.',
        ],
    ];
}
?>

<!-- ══════════════════════════════════════════════
     1. HERO SECTION (with form)
     ══════════════════════════════════════════════ -->
<section class="fc-hero">
  <div class="fc-hero__overlay"></div>
  <div class="container">
    <div class="fc-hero__grid">

      <!-- LEFT: Content -->
      <div class="fc-hero__content">
        <span class="fc-hero__eyebrow"><?php echo esc_html( $fc_city_name ); ?> Foreclosure Help</span>
        <h1 class="fc-hero__h1">Facing Foreclosure in <?php echo esc_html( $fc_city_name . $fc_state_suffix ); ?>? We Can Help.</h1>
        <p class="fc-hero__sub">You have options. Tennessee Cash For Homes buys houses fast for cash to help <?php echo esc_html( $fc_city_name ); ?> homeowners stop foreclosure before it is too late.</p>
        <ul class="fc-hero__checks">
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Stop the foreclosure process</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Get a fair cash offer in 24 hours</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Close in as little as 7 days</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Walk away with cash in hand</li>
        </ul>
        <div class="fc-hero__ctas">
          <a href="tel:+16158018126" class="fc-hero__call">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            Call (615) 801-8126
          </a>
          <div class="fc-hero__trust-stars">
            <span class="fc-hero__stars-icons">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
            <span class="fc-hero__stars-label"><strong>5.0</strong> on Google</span>
          </div>
          <a href="https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick" target="_blank" rel="nofollow noopener" class="bbb-seal"><img src="https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png" alt="Tennessee Cash For Homes BBB A+ Rating" width="200" height="42" loading="lazy" decoding="async" /></a>
        </div>
      </div>

      <!-- RIGHT: Form Card -->
      <div class="fc-hero__form-wrap">
        <div class="fc-hero__form-card">
          <h2 class="fc-hero__form-title">Get Your Free Cash Offer</h2>
          <p class="fc-hero__form-sub">Stop foreclosure. No obligation. Takes 60 seconds.</p>
          <form onsubmit="handleSubmit(event)">
            <div class="form-group">
              <label for="hero-address">Property Address</label>
              <input type="text" id="hero-address" name="address" placeholder="123 Main St, <?php echo esc_attr( $fc_city_name ); ?>, TN" required />
            </div>
            <div class="form-group">
              <label for="hero-name">Your Name</label>
              <input type="text" id="hero-name" name="name" placeholder="John Smith" required />
            </div>
            <div class="form-group">
              <label for="hero-phone">Phone Number</label>
              <input type="tel" id="hero-phone" name="phone" placeholder="(615) 555-0123" required />
            </div>
            <button type="submit" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</button>
          </form>
          <p class="form-disclaimer">&#128274; Your information is private and never shared.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     2. LOCAL CONTEXT
     ══════════════════════════════════════════════ -->
<section class="fc-local">
  <div class="container">
    <div class="fc-section-header fc-section-header--left">
      <p class="fc-section-eyebrow">Local Context</p>
      <h2 class="fc-section-title">Foreclosure in <?php echo $fc_is_statewide ? 'Tennessee' : esc_html( $fc_city_name ) . ', Tennessee'; ?></h2>
    </div>
    <div class="fc-local__body">
      <p><?php echo esc_html( $fc_desc1 ); ?></p>
      <p><?php echo esc_html( $fc_desc2 ); ?></p>
      <?php if ( ! empty( $fc_desc3 ) ) : ?>
      <p><?php echo esc_html( $fc_desc3 ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     3. FORECLOSURE TIMELINE
     ══════════════════════════════════════════════ -->
<section class="fc-timeline">
  <div class="container">
    <div class="fc-section-header">
      <p class="fc-section-eyebrow">The Process</p>
      <h2 class="fc-section-title">Understanding the Tennessee Foreclosure Process</h2>
      <p class="fc-section-subtitle">Tennessee is a <strong>non-judicial foreclosure state</strong>. <?php if ( $fc_is_statewide ) : ?>Foreclosure sales take place at the county courthouse where your property is located.<?php else : ?>In <?php echo esc_html( $fc_city_name ); ?>, foreclosure sales take place at <?php echo esc_html( $fc_courthouse ); ?>.<?php endif; ?></p>
    </div>

    <div class="fc-process-steps">
      <!-- Step 1 -->
      <article class="fc-process-step" data-reveal>
        <header class="fc-process-step__head">
          <span class="fc-process-step__num">1</span>
          <h3 class="fc-process-step__title">Missed Payments</h3>
        </header>
        <p class="fc-process-step__body">After missing one or more mortgage payments, your lender will begin contacting you. Most lenders wait 3 to 6 months before formally starting the foreclosure process, and federal regulations require a 120-day delinquency period before filing.</p>
        <div class="fc-process-step__meta">
          <span class="fc-process-pill">
            <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
            Typical window: 90 to 180 days from first missed payment
          </span>
        </div>
      </article>

      <!-- Step 2 -->
      <article class="fc-process-step" data-reveal>
        <header class="fc-process-step__head">
          <span class="fc-process-step__num">2</span>
          <h3 class="fc-process-step__title">Notice of Default</h3>
        </header>
        <p class="fc-process-step__body">The lender records a formal notice of default. Under Tennessee law (TCA &sect; 35-5-101), the deed of trust gives the trustee the power to sell the property without court involvement. The foreclosure clock officially starts.</p>
        <div class="fc-process-step__meta">
          <span class="fc-process-pill">
            <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
            Typical window: 30 to 60 days after default is declared
          </span>
        </div>
      </article>

      <!-- KEY CALLOUT -->
      <aside class="fc-process-callout" data-reveal>
        <div class="fc-process-callout__icon">
          <svg width="26" height="26" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
        </div>
        <div class="fc-process-callout__body">
          <p class="fc-process-callout__eyebrow">Key Takeaway</p>
          <p class="fc-process-callout__text">At any point before the foreclosure sale date, you may be able to sell your <?php echo esc_html( $fc_is_statewide ? 'Tennessee' : $fc_city_name ); ?> home for cash and stop the process entirely.</p>
        </div>
      </aside>

      <!-- Step 3 -->
      <article class="fc-process-step" data-reveal>
        <header class="fc-process-step__head">
          <span class="fc-process-step__num">3</span>
          <h3 class="fc-process-step__title">Notice of Sale</h3>
        </header>
        <p class="fc-process-step__body">The trustee must publish a notice of the foreclosure sale in a newspaper in <?php echo esc_html( $fc_newspaper_phrase ); ?> for three consecutive weeks before the sale date. The borrower must also receive written notice at least 20 days before the scheduled sale.</p>
        <div class="fc-process-step__meta">
          <span class="fc-process-pill">
            <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
            Typical window: 21 to 30 days from publication to sale
          </span>
        </div>
      </article>

      <!-- Step 4 -->
      <article class="fc-process-step" data-reveal>
        <header class="fc-process-step__head">
          <span class="fc-process-step__num">4</span>
          <h3 class="fc-process-step__title">Foreclosure Sale</h3>
        </header>
        <p class="fc-process-step__body">The property is sold at public auction at <?php echo $fc_is_statewide ? 'the county courthouse' : esc_html( $fc_courthouse ); ?>. The highest bidder takes ownership. If no outside bidders appear, the lender typically takes possession as an REO property.</p>
        <div class="fc-process-step__meta">
          <span class="fc-process-pill fc-process-pill--warning">
            <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            Final deadline: once the sale occurs, the homeowner loses all rights to the property
          </span>
        </div>
      </article>

      <!-- Step 5 -->
      <article class="fc-process-step" data-reveal>
        <header class="fc-process-step__head">
          <span class="fc-process-step__num">5</span>
          <h3 class="fc-process-step__title">Eviction</h3>
        </header>
        <p class="fc-process-step__body">Tennessee does not provide a statutory right of redemption for non-judicial foreclosures. The new owner can begin eviction proceedings immediately after the sale is confirmed.</p>
        <div class="fc-process-step__meta">
          <span class="fc-process-pill fc-process-pill--note">
            <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
            The entire process from notice of sale to eviction can take as little as 60 days
          </span>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     4. LOCAL FORECLOSURE RESOURCES
     ══════════════════════════════════════════════ -->
<?php
include_once get_template_directory() . '/gov-resources-data.php';
$fc_gov_resources = function_exists( 'tcfh_get_gov_resources' ) ? tcfh_get_gov_resources( $fc_county ) : [];
?>
<section class="fc-resources">
  <div class="container">
    <div class="fc-section-header">
      <p class="fc-section-eyebrow">Helpful Resources</p>
      <h2 class="fc-section-title">Foreclosure Resources for <?php echo esc_html( $fc_city_name ); ?> Homeowners</h2>
      <p class="fc-section-subtitle"><?php if ( $fc_is_statewide ) : ?>Free and low-cost foreclosure prevention assistance, housing counseling, and legal help available to Tennessee homeowners statewide.<?php else : ?>Free and low-cost foreclosure prevention assistance, housing counseling, and legal help available to <?php echo esc_html( $fc_city_name ); ?> residents in <?php echo esc_html( $fc_county ); ?> County.<?php endif; ?></p>
    </div>
    <div class="fc-resources__grid">
      <?php if ( ! empty( $fc_gov_resources['assessor'] ) ) : ?>
      <a href="<?php echo esc_url( $fc_gov_resources['assessor'] ); ?>" target="_blank" rel="noopener noreferrer" class="fc-resource-card">
        <div class="fc-resource-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/></svg></div>
        <h3 class="fc-resource-card__title"><?php echo esc_html( $fc_county ); ?> County Property Assessor</h3>
        <p class="fc-resource-card__desc">Look up your assessed home value, property tax history, and ownership records for your <?php echo esc_html( $fc_county ); ?> County property.</p>
        <span class="fc-resource-card__tag">Property Records</span>
        <span class="fc-resource-card__link">Visit Website &rarr;</span>
      </a>
      <?php endif; ?>

      <?php if ( ! empty( $fc_gov_resources['trustee'] ) ) : ?>
      <a href="<?php echo esc_url( $fc_gov_resources['trustee'] ); ?>" target="_blank" rel="noopener noreferrer" class="fc-resource-card">
        <div class="fc-resource-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
        <h3 class="fc-resource-card__title"><?php echo esc_html( $fc_county ); ?> County Trustee</h3>
        <p class="fc-resource-card__desc">Check your property tax balance, find out if you are delinquent, or learn about upcoming tax sales in <?php echo esc_html( $fc_county ); ?> County.</p>
        <span class="fc-resource-card__tag">Taxes, Foreclosure</span>
        <span class="fc-resource-card__link">Visit Website &rarr;</span>
      </a>
      <?php endif; ?>

      <?php if ( ! empty( $fc_gov_resources['chancery'] ) ) : ?>
      <a href="<?php echo esc_url( $fc_gov_resources['chancery'] ); ?>" target="_blank" rel="noopener noreferrer" class="fc-resource-card">
        <div class="fc-resource-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg></div>
        <h3 class="fc-resource-card__title"><?php echo esc_html( $fc_county ); ?> County Chancery Court</h3>
        <p class="fc-resource-card__desc">Handles foreclosure filings, trustee sale schedules, and related property matters in <?php echo esc_html( $fc_county ); ?> County.</p>
        <span class="fc-resource-card__tag">Foreclosure Sales</span>
        <span class="fc-resource-card__link">Visit Website &rarr;</span>
      </a>
      <?php endif; ?>

      <a href="https://thda.org" target="_blank" rel="noopener noreferrer" class="fc-resource-card">
        <div class="fc-resource-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/></svg></div>
        <h3 class="fc-resource-card__title">Tennessee Housing Development Agency (THDA)</h3>
        <p class="fc-resource-card__desc">Statewide foreclosure prevention programs, homeowner assistance, and housing counseling services for Tennessee residents.</p>
        <span class="fc-resource-card__tag">Foreclosure Prevention</span>
        <span class="fc-resource-card__link">Visit Website &rarr;</span>
      </a>

      <a href="https://www.hud.gov/i_want_to/talk_to_a_housing_counselor" target="_blank" rel="noopener noreferrer" class="fc-resource-card">
        <div class="fc-resource-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
        <h3 class="fc-resource-card__title">HUD-Approved Housing Counselors</h3>
        <p class="fc-resource-card__desc">Free foreclosure avoidance counseling from HUD-certified agencies serving <?php echo esc_html( $fc_hud_serves ); ?>.</p>
        <span class="fc-resource-card__tag">Free Counseling</span>
        <span class="fc-resource-card__link">Visit Website &rarr;</span>
      </a>

      <a href="https://www.consumerfinance.gov/housing/housing-insecurity/help-for-homeowners/foreclosure/" target="_blank" rel="noopener noreferrer" class="fc-resource-card">
        <div class="fc-resource-card__icon"><svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
        <h3 class="fc-resource-card__title">Consumer Financial Protection Bureau (CFPB)</h3>
        <p class="fc-resource-card__desc">Federal foreclosure guides, sample letters to lenders, and tools to submit complaints against loan servicers.</p>
        <span class="fc-resource-card__tag">Know Your Rights</span>
        <span class="fc-resource-card__link">Visit Website &rarr;</span>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     5. FORM SECTION
     ══════════════════════════════════════════════ -->
<section class="fc-form-section" id="fc-form">
  <div class="container">
    <div class="fc-form__inner">
      <div class="fc-form__copy">
        <p class="fc-section-eyebrow">Get Started</p>
        <h2 class="fc-section-title">Get Your Free Cash Offer in <?php echo esc_html( $fc_city_name ); ?></h2>
        <p class="fc-form__lead">We understand this is a stressful time. Our process is simple, confidential, and there is no obligation. We have helped Tennessee homeowners stop foreclosure and walk away with dignity and cash in hand.</p>
        <ul class="fc-form__reassure">
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> No obligation, ever</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> 100% confidential</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Cash offer within 24 hours</li>
          <li><svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Close before your sale date</li>
        </ul>
      </div>
      <div class="fc-form__card">
        <form onsubmit="handleSubmit(event)">
          <div class="form-group">
            <label for="fc-address">Property Address</label>
            <input type="text" id="fc-address" name="address" placeholder="123 Main St, <?php echo esc_attr( $fc_city_name ); ?>, TN" required />
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
              <option value="30-90">30 to 90 days</option>
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
     6. FAQ SECTION
     ══════════════════════════════════════════════ -->
<section class="fc-faq">
  <div class="container">
    <div class="fc-section-header">
      <p class="fc-section-eyebrow">Common Questions</p>
      <h2 class="fc-section-title">Frequently Asked Questions About Foreclosure in <?php echo esc_html( $fc_city_name ); ?></h2>
    </div>
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
    'description' => 'Tennessee Cash For Homes helps ' . $fc_city_name . ' homeowners facing foreclosure by buying houses fast for cash.',
    'url'         => home_url( '/facing-foreclosure/' . $fc_city_slug ),
    'telephone'   => '+1-615-801-8126',
    'email'       => 'info@tncashforhomes.com',
    'address'     => [
        '@type'           => 'PostalAddress',
        'addressLocality' => $fc_city_name,
        'addressRegion'   => 'TN',
        'addressCountry'  => 'US',
    ],
    'areaServed' => [
        '@type' => 'City',
        'name'  => $fc_city_name . ', TN',
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>

<!-- ══════════════════════════════════════════════
     7. INTERNAL LINKS
     ══════════════════════════════════════════════ -->
<section class="fc-links">
  <div class="container">
    <div class="fc-section-header">
      <p class="fc-section-eyebrow">Related Resources</p>
      <h2 class="fc-section-title">Keep Exploring</h2>
    </div>
    <div class="fc-links__grid">
      <a href="<?php echo esc_url( home_url( '/facing-foreclosure/tennessee' ) ); ?>" class="fc-link-card">
        <svg width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span>Facing Foreclosure in Tennessee</span>
      </a>
      <?php if ( ! $fc_is_statewide ) : ?>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/' . $fc_county_slug ) ); ?>" class="fc-link-card">
        <svg width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span>Sell Your House in <?php echo esc_html( $fc_county ); ?> County</span>
      </a>
      <?php endif; ?>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/' . $fc_city_slug ) ); ?>" class="fc-link-card">
        <svg width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span><?php echo $fc_is_statewide ? 'We Buy Houses Across Tennessee' : 'We Buy Houses in ' . esc_html( $fc_city_name ); ?></span>
      </a>
      <a href="<?php echo esc_url( home_url( '/sell-my-house-divorce-tennessee/' ) ); ?>" class="fc-link-card">
        <svg width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span>Selling During Divorce in Tennessee</span>
      </a>
      <a href="<?php echo esc_url( home_url( '/sell-house-behind-on-taxes-tennessee' ) ); ?>" class="fc-link-card">
        <svg width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span>Behind on Property Taxes in Tennessee</span>
      </a>
      <a href="<?php echo esc_url( home_url( '/sell-inherited-house-tennessee' ) ); ?>" class="fc-link-card">
        <svg width="20" height="20" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span>Selling an Inherited Property in Tennessee</span>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     INLINE STYLES
     ══════════════════════════════════════════════ -->
<style>
:root {
  --fc-green: #84CC9C;
  --fc-green-dark: #2D6A4F;
  --fc-green-darker: #1f5139;
  --fc-charcoal: #2a2a2a;
  --fc-charcoal-mid: #3D3D3D;
  --fc-text: #4a5568;
  --fc-text-muted: #6b7280;
  --fc-border: #e5e7eb;
  --fc-off-white: #FAF9F7;
  --fc-light-bg: #F7F7F5;
  --fc-white: #FFFFFF;
  --fc-green-tint: #f0f9f3;
  --fc-radius: 14px;
  --fc-radius-sm: 10px;
  --fc-shadow-sm: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.03);
  --fc-shadow: 0 4px 12px rgba(0,0,0,0.06), 0 2px 4px rgba(0,0,0,0.04);
  --fc-shadow-lg: 0 16px 40px rgba(0,0,0,0.09), 0 8px 16px rgba(0,0,0,0.05);
}

/* ── Shared Section Header ── */
.fc-section-header {
  max-width: 720px;
  margin: 0 auto 48px;
  text-align: center;
}
.fc-section-header--left {
  margin-left: 0;
  text-align: left;
}
.fc-section-eyebrow {
  display: inline-block;
  font-family: 'Poppins', sans-serif;
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--fc-green-dark);
  margin: 0 0 12px;
}
.fc-section-title {
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1.6rem, 3vw, 2.25rem);
  font-weight: 700;
  color: var(--fc-charcoal);
  margin: 0 0 14px;
  line-height: 1.2;
  letter-spacing: -0.01em;
}
.fc-section-subtitle {
  font-size: 1.05rem;
  color: var(--fc-text);
  line-height: 1.7;
  margin: 0;
}

/* ── HERO ── */
.fc-hero {
  position: relative;
  background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/brand_assets/New_Background.webp') center/cover no-repeat;
  padding: 120px 0 80px;
}
.fc-hero__overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(0,0,0,0.78) 0%, rgba(0,0,0,0.62) 100%);
}
.fc-hero__grid {
  position: relative;
  z-index: 2;
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 56px;
  align-items: center;
}
.fc-hero__eyebrow {
  display: inline-block;
  background: rgba(132, 204, 156, 0.22);
  color: var(--fc-green);
  font-family: 'Poppins', sans-serif;
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  padding: 7px 18px;
  border-radius: 6px;
  margin-bottom: 22px;
  text-transform: uppercase;
}
.fc-hero__h1 {
  font-family: 'Poppins', sans-serif;
  font-size: clamp(2rem, 4.2vw, 2.9rem);
  font-weight: 800;
  color: var(--fc-white);
  line-height: 1.12;
  margin: 0 0 18px;
  letter-spacing: -0.015em;
}
.fc-hero__sub {
  font-size: 1.08rem;
  color: rgba(255,255,255,0.88);
  line-height: 1.65;
  margin: 0 0 28px;
  max-width: 560px;
}
.fc-hero__checks {
  list-style: none;
  padding: 0;
  margin: 0 0 32px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px 20px;
}
.fc-hero__checks li {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--fc-white);
  font-size: 0.98rem;
  font-weight: 500;
}
.fc-hero__checks svg { flex-shrink: 0; }
.fc-hero__ctas {
  display: flex;
  align-items: center;
  gap: 24px;
  flex-wrap: wrap;
}
.fc-hero__call {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  color: var(--fc-white);
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 1rem;
  text-decoration: none;
  padding: 10px 20px 10px 16px;
  border: 1.5px solid rgba(255,255,255,0.35);
  border-radius: 8px;
  transition: all 0.2s ease;
}
.fc-hero__call:hover {
  background: rgba(255,255,255,0.1);
  border-color: rgba(255,255,255,0.6);
}
.fc-hero__call svg { color: var(--fc-green); }
.fc-hero__trust-stars {
  display: flex;
  align-items: center;
  gap: 8px;
}
.fc-hero__stars-icons {
  color: #F59E0B;
  font-size: 1.1rem;
  letter-spacing: 2px;
}
.fc-hero__stars-label {
  color: rgba(255,255,255,0.9);
  font-size: 0.9rem;
}
.fc-hero .bbb-seal img {
  display: block;
  opacity: 0.95;
}

.fc-hero__form-card {
  background: var(--fc-white);
  border-radius: 16px;
  padding: 32px 30px;
  box-shadow: var(--fc-shadow-lg);
}
.fc-hero__form-title {
  font-family: 'Poppins', sans-serif;
  font-size: 1.45rem;
  font-weight: 700;
  color: var(--fc-charcoal);
  margin: 0 0 6px;
  letter-spacing: -0.01em;
}
.fc-hero__form-sub {
  font-size: 0.92rem;
  color: var(--fc-text-muted);
  margin: 0 0 22px;
}
.fc-hero__form-card .form-group { margin-bottom: 14px; }
.fc-hero__form-card label {
  display: block;
  font-family: 'Poppins', sans-serif;
  font-size: 0.82rem;
  font-weight: 600;
  color: var(--fc-charcoal);
  margin-bottom: 5px;
}
.fc-hero__form-card input {
  width: 100%;
  padding: 11px 14px;
  border: 1px solid var(--fc-border);
  border-radius: 8px;
  font-size: 0.95rem;
  color: var(--fc-charcoal);
  background: var(--fc-white);
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
  box-sizing: border-box;
  font-family: inherit;
}
.fc-hero__form-card input:focus {
  outline: none;
  border-color: var(--fc-green);
  box-shadow: 0 0 0 3px rgba(132,204,156,0.2);
}
.fc-hero__form-card input::placeholder { color: #9ca3af; }
.fc-hero__form-card .btn-primary--block {
  width: 100%;
  text-align: center;
  padding: 13px 20px;
  margin-top: 6px;
  font-size: 0.98rem;
}
.fc-hero__form-card .form-disclaimer {
  text-align: center;
  font-size: 0.8rem;
  color: var(--fc-text-muted);
  margin: 14px 0 0;
}

/* ── LOCAL CONTEXT ── */
.fc-local {
  background: var(--fc-off-white);
  padding: 88px 0;
}
.fc-local__body { max-width: 780px; }
.fc-local__body p {
  font-size: 1.05rem;
  color: var(--fc-text);
  line-height: 1.8;
  margin: 0 0 22px;
}
.fc-local__body p:last-child { margin-bottom: 0; }

/* ── TIMELINE / FORECLOSURE PROCESS ── */
.fc-timeline {
  background: var(--fc-white);
  padding: 88px 0;
}
.fc-process-steps {
  max-width: 820px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 18px;
}
.fc-process-step {
  background: var(--fc-white);
  border: 1px solid var(--fc-border);
  border-radius: 16px;
  padding: 28px 30px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.02);
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}
.fc-process-step:hover {
  transform: translateY(-2px);
  box-shadow: var(--fc-shadow);
  border-color: rgba(132,204,156,0.55);
}
.fc-process-step__head {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 14px;
}
.fc-process-step__num {
  flex-shrink: 0;
  width: 42px;
  height: 42px;
  background: linear-gradient(135deg, var(--fc-green) 0%, #6ab585 100%);
  color: var(--fc-white);
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  font-size: 1.05rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 6px 14px rgba(132,204,156,0.4);
  letter-spacing: -0.01em;
}
.fc-process-step__title {
  font-family: 'Poppins', sans-serif;
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--fc-charcoal);
  margin: 0;
  letter-spacing: -0.005em;
  line-height: 1.25;
}
.fc-process-step__body {
  font-size: 0.98rem;
  color: var(--fc-text);
  line-height: 1.7;
  margin: 0 0 16px;
}
.fc-process-step__meta {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.fc-process-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 0.84rem;
  font-weight: 600;
  color: var(--fc-green-dark);
  background: var(--fc-green-tint);
  padding: 7px 14px;
  border-radius: 999px;
  line-height: 1.4;
  max-width: 100%;
}
.fc-process-pill svg { flex-shrink: 0; color: currentColor; }
.fc-process-pill--warning { color: #92400e; background: #fef3c7; }
.fc-process-pill--note    { color: #1e40af; background: #dbeafe; }

.fc-process-callout {
  background: linear-gradient(135deg, var(--fc-green-dark) 0%, var(--fc-green-darker) 100%);
  color: var(--fc-white);
  border-radius: 16px;
  padding: 26px 30px;
  display: flex;
  align-items: center;
  gap: 20px;
  box-shadow: 0 10px 28px rgba(45,106,79,0.22);
  margin: 2px 0;
  position: relative;
  overflow: hidden;
}
.fc-process-callout::before {
  content: '';
  position: absolute;
  top: 0; bottom: 0; left: 0;
  width: 4px;
  background: var(--fc-green);
}
.fc-process-callout__icon {
  flex-shrink: 0;
  width: 52px;
  height: 52px;
  background: rgba(255,255,255,0.12);
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--fc-green);
}
.fc-process-callout__body { min-width: 0; }
.fc-process-callout__eyebrow {
  font-family: 'Poppins', sans-serif;
  font-size: 0.72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.14em;
  color: var(--fc-green);
  margin: 0 0 4px;
}
.fc-process-callout__text {
  font-family: 'Poppins', sans-serif;
  font-size: 1.05rem;
  font-weight: 600;
  line-height: 1.5;
  margin: 0;
  color: var(--fc-white);
  letter-spacing: -0.005em;
}

[data-reveal] {
  opacity: 0;
  transform: translateY(28px);
  will-change: opacity, transform;
}
[data-reveal].is-visible {
  opacity: 1;
  transform: translateY(0);
  transition: opacity 0.7s cubic-bezier(.22,.61,.36,1), transform 0.7s cubic-bezier(.22,.61,.36,1);
}
@media (prefers-reduced-motion: reduce) {
  [data-reveal] { opacity: 1; transform: none; transition: none; }
}

/* ── RESOURCES ── */
.fc-resources {
  background: var(--fc-light-bg);
  padding: 88px 0;
}
.fc-resources__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 22px;
}
.fc-resource-card {
  background: var(--fc-white);
  border: 1px solid var(--fc-border);
  border-radius: var(--fc-radius);
  padding: 28px 26px;
  display: flex;
  flex-direction: column;
  text-decoration: none;
  color: inherit;
  transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.fc-resource-card:hover {
  transform: translateY(-3px);
  box-shadow: var(--fc-shadow);
  border-color: var(--fc-green);
}
.fc-resource-card__icon {
  width: 52px;
  height: 52px;
  background: var(--fc-green-tint);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 18px;
}
.fc-resource-card__title {
  font-family: 'Poppins', sans-serif;
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--fc-charcoal);
  margin: 0 0 10px;
  line-height: 1.35;
  letter-spacing: -0.005em;
}
.fc-resource-card__desc {
  font-size: 0.92rem;
  color: var(--fc-text);
  line-height: 1.6;
  margin: 0 0 16px;
  flex: 1;
}
.fc-resource-card__tag {
  display: inline-flex;
  align-items: center;
  font-size: 0.76rem;
  font-weight: 600;
  color: var(--fc-green-dark);
  background: var(--fc-green-tint);
  padding: 5px 12px;
  border-radius: 999px;
  margin-bottom: 14px;
  width: fit-content;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}
.fc-resource-card__link {
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--fc-green-dark);
  transition: color 0.2s ease;
}
.fc-resource-card:hover .fc-resource-card__link { color: var(--fc-green); }

/* ── FORM ── */
.fc-form-section {
  background: var(--fc-off-white);
  padding: 88px 0;
  scroll-margin-top: 100px;
}
.fc-form__inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 56px;
  align-items: start;
}
.fc-form__copy .fc-section-eyebrow { margin-bottom: 14px; }
.fc-form__copy .fc-section-title { text-align: left; }
.fc-form__lead {
  font-size: 1.05rem;
  color: var(--fc-text);
  line-height: 1.75;
  margin: 14px 0 26px;
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
  border-radius: 16px;
  padding: 36px 32px;
  box-shadow: var(--fc-shadow);
  border: 1px solid var(--fc-border);
}
.fc-form__card .form-group { margin-bottom: 16px; }
.fc-form__card label {
  display: block;
  font-family: 'Poppins', sans-serif;
  font-size: 0.85rem;
  font-weight: 600;
  color: var(--fc-charcoal);
  margin-bottom: 6px;
}
.fc-form__card input,
.fc-form__card select {
  width: 100%;
  padding: 12px 14px;
  border: 1px solid var(--fc-border);
  border-radius: 8px;
  font-size: 0.95rem;
  color: var(--fc-charcoal);
  background: var(--fc-white);
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
  box-sizing: border-box;
  font-family: inherit;
}
.fc-form__card input:focus,
.fc-form__card select:focus {
  outline: none;
  border-color: var(--fc-green);
  box-shadow: 0 0 0 3px rgba(132,204,156,0.2);
}
.fc-form__card input::placeholder { color: #9ca3af; }
.fc-form__card .btn-primary--block {
  width: 100%;
  text-align: center;
  padding: 14px 22px;
  margin-top: 8px;
  font-size: 0.98rem;
}
.fc-form__card .form-disclaimer {
  text-align: center;
  font-size: 0.82rem;
  color: var(--fc-text-muted);
  margin: 14px 0 0;
}

/* ── FAQ ── */
.fc-faq {
  background: var(--fc-white);
  padding: 88px 0;
}

/* ── INTERNAL LINKS ── */
.fc-links {
  background: var(--fc-light-bg);
  padding: 88px 0;
}
.fc-links__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  max-width: 960px;
  margin: 0 auto;
}
.fc-link-card {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 18px 22px;
  background: var(--fc-white);
  border: 1px solid var(--fc-border);
  border-radius: var(--fc-radius-sm);
  text-decoration: none;
  color: var(--fc-charcoal);
  font-size: 0.94rem;
  font-weight: 500;
  transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.fc-link-card:hover {
  transform: translateY(-2px);
  box-shadow: var(--fc-shadow);
  border-color: var(--fc-green);
}
.fc-link-card svg { flex-shrink: 0; }

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
  .fc-hero__grid { grid-template-columns: 1fr; gap: 40px; }
  .fc-hero__form-wrap { max-width: 480px; }
  .fc-resources__grid { grid-template-columns: repeat(2, 1fr); }
  .fc-form__inner { grid-template-columns: 1fr; gap: 40px; }
  .fc-links__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
  .fc-hero { padding: 92px 0 56px; }
  .fc-hero__checks { grid-template-columns: 1fr; gap: 10px; }
  .fc-hero__ctas { gap: 14px; }
  .fc-hero__form-card { padding: 26px 22px; }
  .fc-local, .fc-timeline, .fc-resources,
  .fc-form-section, .fc-faq, .fc-links { padding: 60px 0; }
  .fc-resources__grid { grid-template-columns: 1fr; }
  .fc-links__grid { grid-template-columns: 1fr; }
  .fc-process-step { padding: 22px 22px; }
  .fc-process-step__head { gap: 14px; }
  .fc-process-step__num { width: 36px; height: 36px; font-size: 0.98rem; }
  .fc-process-step__title { font-size: 1.05rem; }
  .fc-process-callout { padding: 22px 22px 22px 26px; gap: 16px; }
  .fc-process-callout__icon { width: 44px; height: 44px; }
  .fc-process-callout__text { font-size: 0.98rem; }
  .fc-form__card { padding: 26px 22px; }
  .fc-section-header { margin-bottom: 36px; }
}
</style>

<script>
// Scroll-reveal animation for timeline cards and callout
(function() {
    var els = document.querySelectorAll('.fc-timeline [data-reveal]');
    if (!els.length) return;
    if (!('IntersectionObserver' in window)) {
        els.forEach(function(el){ el.classList.add('is-visible'); });
        return;
    }
    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    els.forEach(function(el, i) {
        el.style.transitionDelay = (i * 70) + 'ms';
        obs.observe(el);
    });
})();

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
