<?php
/**
 * Template Name: Sell As-Is vs Fix Up
 * Template for /sell-as-is-vs-fix-up-tennessee/ (also assigned to the page directly).
 * Comparison page: selling a house as-is vs fixing it up and listing it.
 * Same layout, styles and rules as page-cash-buyer-vs-agent-tennessee.php:
 * company voice ("we"), no em or en dashes, no made-up numbers or stories.
 * Topic split (approved Nov 18 2026): this page targets the decision
 * ("sell as is or fix up", "is it worth fixing before selling", "what repairs
 * to make before selling"). /sell-house-as-is-tennessee/ keeps "sell my house
 * as is" and selling to us; keep that phrase out of titles and headings here.
 * Real stories come from recent-homes-data.php (Columbia, April and August 2026).
 */

$cva_url = function ( $path ) { return esc_url( home_url( $path ) ); };

$cva_pill = function ( $type, $label ) {
	$icons = array(
		'good'    => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'bad'     => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>',
		'neutral' => '',
	);
	$sr = array( 'good' => 'Advantage: ', 'bad' => 'Drawback: ', 'neutral' => '' );
	return '<span class="cva-pill cva-pill--' . $type . '">' . $icons[ $type ]
		. ( $sr[ $type ] ? '<span class="visually-hidden">' . $sr[ $type ] . '</span>' : '' )
		. esc_html( $label ) . '</span>';
};

$cva_col_us    = 'Sell As-Is to Us';
$cva_col_agent = 'Fix Up, Then List';

/* factor, [type, label, short line] for selling as-is to us, same for fixing up and listing */
$cva_rows = array(
	array( 'Upfront cost',
		array( 'good', 'Nothing upfront',      'We pay the closing costs' ),
		array( 'bad',  'You pay first',        'Repairs before any sale' ) ),
	array( 'Time before you sell',
		array( 'good', 'No repair wait',       'You pick the closing date' ),
		array( 'bad',  'Repairs come first',   'Then market time and the buyer\'s loan' ) ),
	array( 'Stress',
		array( 'good', 'Nothing to manage',    'No contractors or bids' ),
		array( 'bad',  'You run the project',  'Bids, schedules, permits' ) ),
	array( 'Risk',
		array( 'good', 'Price set up front',   'No budget to overrun' ),
		array( 'bad',  'Costs can grow',       'Hidden damage and delays' ) ),
	array( 'Showings',
		array( 'good', 'One walkthrough',      '' ),
		array( 'bad',  'Many showings',        'Plus photos and open houses' ) ),
	array( 'Inspection surprises',
		array( 'good', 'No repair requests',   'We buy it as it stands' ),
		array( 'bad',  'New requests likely',  'The buyer\'s inspector can find more' ) ),
	array( 'Buyers who can bid',
		array( 'bad',  'One offer to weigh',   'Get more than one if you want to compare' ),
		array( 'good', 'Most buyers',          'Lenders finance a house in good repair' ) ),
	array( 'Sale price',
		array( 'bad',  'Lower price',          'Priced for the repairs we take on' ),
		array( 'good', 'Higher price',         'If the work is done well' ) ),
	array( 'What you walk away with',
		array( 'neutral', 'Lower price, nothing spent on repairs or listing', '' ),
		array( 'neutral', 'Higher price, minus repairs and costs', '' ) ),
);

$cva_faqs = array(
	array( 'Should I fix up my house or sell it as-is in Tennessee?',
		'It depends on how much work the house needs and how soon you need to sell. Light cosmetic work and time to wait usually favor fixing it up and listing it. Major repairs, a tight budget or a deadline usually favor selling as-is.' ),
	array( 'Is it worth fixing up a house before selling?',
		'Small fixes, cleaning and fresh paint usually are, because they help a house show well for little money. Large remodels usually aren\'t: they rarely add back their full cost at sale, and they add weeks or months before you can list.' ),
	array( 'What repairs should I make before selling my house?',
		'Start with what buyers and lenders notice: leaks, broken fixtures, worn paint, safety hazards and anything that can hold up a buyer\'s loan, like a leaking roof or a dead HVAC system. Then clean, declutter and tidy the yard.' ),
	array( 'What repairs are not worth doing before selling?',
		'Full kitchen and bath remodels, luxury upgrades, additions and cosmetic work on a house with major problems usually cost more than they add. A half-finished project can hurt more than it helps.' ),
	array( 'Do I have to fix what the buyer\'s inspection finds in Tennessee?',
		'No law makes you, but the buyer can ask for repairs or a credit, and many contracts let them walk away if you can\'t agree during the inspection period. If the buyer is using an FHA or VA loan, the lender may require some repairs before closing. More in our guide to <a href="' . $cva_url( '/selling-a-house-after-a-failed-inspection-in-tennessee-your-guide-to-moving-forward/' ) . '">selling after a failed inspection</a>.' ),
	array( 'Can I sell a house as-is with a real estate agent?',
		'Yes. The listing says the price reflects the condition and that you won\'t make repairs. You still pay commission and host showings, and buyers can still inspect and negotiate. Our <a href="' . $cva_url( '/cash-buyer-vs-agent-tennessee/' ) . '">cash buyer vs agent comparison</a> covers both routes.' ),
	array( 'Do I still have to disclose problems if I sell as-is?',
		'Usually, yes. Tennessee\'s disclosure law (TCA 66-5-201 and following) applies whether or not you make repairs. You give the buyer the property disclosure unless an exemption applies or the buyer waives it in writing. More in our <a href="' . $cva_url( '/selling-as-is-in-tennessee-disclosure-requirements/' ) . '">as-is disclosure guide</a>.' ),
	array( 'Do I need a permit to make repairs before selling in Tennessee?',
		'Often. Electrical, plumbing, HVAC and structural work usually needs a permit and inspection. Work done without one can come up when you sell. Here\'s what to know about <a href="' . $cva_url( '/selling-a-house-with-unpermitted-work-in-tennessee-a-complete-guide-to-your-options/' ) . '">selling a house with unpermitted work</a>.' ),
	array( 'How much less will I get if I sell as-is?',
		'There\'s no set amount. An as-is price starts from what the house would be worth fixed up, then takes off the repairs, the months to do them, resale costs and the buyer\'s margin. Compare it with what you\'d keep after paying for repairs and listing yourself. Here\'s <a href="' . $cva_url( '/how-do-cash-home-buyers-calculate-their-offer-in-tennessee/' ) . '">how cash buyers calculate an offer</a>.' ),
);

/* By the Numbers: hand-updated figures in asis-market-numbers.json. The monthly
 * Market Stats workflow flags newer reports (market-stats/check_redfin_reports.py).
 * A figure that is missing is left out, never guessed. */
$cva_numbers  = array();
$cva_num_note = '';
$cva_num_file = get_template_directory() . '/asis-market-numbers.json';
$cva_num_data = file_exists( $cva_num_file ) ? json_decode( file_get_contents( $cva_num_file ), true ) : array();
if ( ! empty( $cva_num_data['figures'] ) ) {
	foreach ( $cva_num_data['figures'] as $cva_n ) {
		if ( empty( $cva_n['value'] ) || empty( $cva_n['label'] ) || empty( $cva_n['source'] ) ) continue;
		$cva_numbers[] = $cva_n;
	}
	$cva_num_note = isset( $cva_num_data['footnote'] ) ? $cva_num_data['footnote'] : '';
}

get_header(); ?>

<!-- ── HERO: same photo hero and overlay as the city pages (house photo 2) ── -->
<?php
$cva_hero_n   = 2;
$cva_hero_ph  = include get_template_directory() . '/hero-placeholders.php';
$cva_hero_url = get_template_directory_uri() . '/brand_assets/hero-house-' . $cva_hero_n;
$cva_check    = '<svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
?>
<section class="county-hero county-hero--photo" id="hero-form">
  <picture>
    <source media="(max-width: 768px)" srcset="<?php echo esc_url( $cva_hero_url . '-mobile.webp' ); ?>" width="1232" height="1120" />
    <img class="county-hero__bg"
      src="<?php echo esc_url( $cva_hero_url . '.webp' ); ?>"
      srcset="<?php echo esc_url( $cva_hero_url . '-800w.webp' ); ?> 800w, <?php echo esc_url( $cva_hero_url . '.webp' ); ?> 1600w, <?php echo esc_url( $cva_hero_url . '-2048w.webp' ); ?> 2048w"
      sizes="100vw" width="1600" height="1069"
      style="object-position: 50% 45%; background: url(data:image/webp;base64,<?php echo esc_attr( $cva_hero_ph[ $cva_hero_n ] ); ?>) 50% 45% / cover no-repeat"
      alt="A house Tennessee Cash For Homes bought in Middle Tennessee"
      fetchpriority="high" decoding="async" />
  </picture>
  <div class="hero__overlay"></div>
  <div class="container">
    <div class="county-hero__inner">
      <div class="county-hero__content">
        <nav class="breadcrumb">
          <a href="<?php echo $cva_url( '/' ); ?>">Home</a>
          <span>&rsaquo;</span>
          <span>Sell As-Is vs Fix Up</span>
        </nav>
        <div class="hero__badge county-hero__badge">As-Is or Fix Up?</div>
        <h1 class="county-hero__title">Sell As-Is or Fix Up First in Tennessee</h1>
        <p class="county-hero__subtitle">What fixing up really costs, which repairs pay off, and when selling as-is leaves you with more.</p>
        <p class="cva-byline"><span class="cva-byline__long">By the Tennessee Cash For Homes team <span aria-hidden="true">&middot;</span> Last updated <?php echo esc_html( get_the_modified_date( 'F j, Y' ) ); ?></span><span class="cva-byline__short">Updated <?php echo esc_html( get_the_modified_date( 'M j, Y' ) ); ?></span></p>
        <div class="hero__trust county-hero__trust">
          <div class="hero__trust-item"><?php echo $cva_check; ?>Zero fees or commissions</div>
          <div class="hero__trust-item"><?php echo $cva_check; ?>Buy as-is, any condition</div>
          <div class="hero__trust-item"><?php echo $cva_check; ?>Close as fast as 7 days</div>
          <div class="hero__trust-item"><?php echo $cva_check; ?>You pick the closing date</div>
        </div>
        <div class="county-hero__cta-row">
          <a href="#get-offer" class="btn-primary">Get My Free Cash Offer &rarr;</a>
          <a href="#compare" class="btn-outline">See the Comparison</a>
        </div>
      </div>
      <div class="county-hero__map-col">
        <div class="hero__form-card county-hero__form" id="get-offer">
          <h2 class="form-card__title">Get Your Free Cash Offer</h2>
          <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
          <form id="leadForm" onsubmit="handleSubmit(event)">
            <input type="hidden" name="lead_source" value="Sell As-Is vs Fix Up" />
            <div class="form-group">
              <label for="afx-address">Property Address</label>
              <input type="text" id="afx-address" name="address" placeholder="123 Main St, Nashville, TN" autocomplete="street-address" required />
            </div>
            <div class="form-group">
              <label for="afx-name">Your Name</label>
              <input type="text" id="afx-name" name="name" placeholder="John Smith" autocomplete="name" required />
            </div>
            <div class="form-group">
              <label for="afx-phone">Phone Number</label>
              <input type="tel" id="afx-phone" name="phone" placeholder="(615) 555-0123" autocomplete="tel" required />
            </div>
            <button type="submit" class="btn-primary btn-primary--block">
              Get My Cash Offer &rarr;
            </button>
          </form>
          <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part( 'stats-strip' ); ?>


<!-- ── SHORT ANSWER + KEY TAKEAWAYS ── -->
<section class="section cva-section" id="short-answer">
  <div class="container">
    <div class="cva-layout">
      <div class="cva-main">
        <p class="section__eyebrow">The Short Answer</p>
        <h2 class="section__title">Should You Fix Up Your House or Sell It As-Is?</h2>
        <div class="cva-answer">
          <p>If your house needs only cleaning, paint and small fixes, and you can wait a few months, fixing it up and listing it will usually net you more. If it needs major repairs, you don't have the cash for them, or you need to sell soon, selling as-is often comes out close or ahead once the repair bills, months of payments and listing costs are counted. Compare what you'd keep, not the sale price.</p>
        </div>
        <p><a href="<?php echo $cva_url( '/' ); ?>">Tennessee Cash For Homes</a> buys houses as-is, so you know where we stand. When light work and a listing would pay you more, we'll say so.</p>
        <p>The math has four parts: the price after repairs, minus what the repairs cost, minus the months of mortgage, taxes, insurance and utilities while the work and the listing happen, minus commission and closing costs. Fixing up loses when the repairs cost more than they add, or take longer than planned.</p>
        <p>Price isn't the only factor. One recent Columbia seller's house needed paint, flooring, landscaping and minor repairs, all doable work. They chose the speed and convenience of a cash sale over paying for repairs and waiting on the market, and we closed in about a month.</p>
      </div>
      <aside class="cva-side">
        <div class="cva-takeaways">
          <p class="cva-takeaways__title">Key Takeaways</p>
          <ul>
            <li>Cleaning, paint and small fixes usually pay for themselves.</li>
            <li>Big remodels rarely add back what they cost.</li>
            <li>Every month of repairs adds payments and risk.</li>
            <li>Compare what you'd keep each way.</li>
          </ul>
        </div>
        <div class="cva-offer-card">
          <p class="cva-offer-card__title">Get Your As-Is Offer</p>
          <p class="cva-offer-card__text">Free, no obligation, usually within 24 hours. Compare it with what the house would sell for after repairs.</p>
          <a href="#get-offer" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</a>
          <a href="tel:+16158018126" class="cva-offer-card__phone">Or call (615) 801-8126</a>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ── PHOTO: house photo 3, lazy loaded ── -->
<section class="section cva-section cva-photo-section">
  <div class="container">
    <figure class="cva-photo">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/brand_assets/hero-house-3-800w.webp' ); ?>"
        srcset="<?php echo esc_url( get_template_directory_uri() . '/brand_assets/hero-house-3-800w.webp' ); ?> 800w, <?php echo esc_url( get_template_directory_uri() . '/brand_assets/hero-house-3.webp' ); ?> 1600w"
        sizes="(max-width: 1128px) 100vw, 1080px" width="1600" height="1067"
        alt="A house Tennessee Cash For Homes bought in Middle Tennessee"
        loading="lazy" decoding="async" />
      <figcaption>We buy houses in any condition across Middle Tennessee.</figcaption>
      <p class="cva-photo__blurb">That includes houses that need a new roof, foundation work, new systems or just a lot of cleaning. If you've already decided not to fix it, here's how we <a href="<?php echo $cva_url( '/sell-house-as-is-tennessee/' ); ?>">buy houses as-is in Tennessee</a>.</p>
    </figure>
  </div>
</section>

<!-- ── BY THE NUMBERS: sourced figures from asis-market-numbers.json ── -->
<?php if ( count( $cva_numbers ) >= 2 ) : ?>
<section class="section cva-section cva-numbers" id="by-the-numbers" aria-labelledby="cva-numbers-title">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">By the Numbers</p>
      <h2 class="section__title" id="cva-numbers-title">What Repairs Return and What You're Up Against</h2>
      <p class="section__subtitle">Recent figures for Nashville and the area around it. Each one shows its source and the period it covers.</p>
    </div>
    <ul class="cva-numbers__grid">
      <?php foreach ( $cva_numbers as $cva_num ) : ?>
      <li class="cva-numbers__card">
        <span class="cva-numbers__value"><?php echo esc_html( $cva_num['value'] ); ?></span>
        <p class="cva-numbers__label"><?php echo esc_html( $cva_num['label'] ); ?></p>
        <p class="cva-numbers__source">Source: <a href="<?php echo esc_url( $cva_num['url'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $cva_num['source'] ); ?></a></p>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php if ( $cva_num_note ) : ?><p class="cva-numbers__note"><?php echo esc_html( $cva_num_note ); ?></p><?php endif; ?>
  </div>
</section>
<?php endif; ?>

<!-- ── COMPARISON TABLE ── -->
<section class="section section--alt cva-section" id="compare">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Side by Side</p>
      <h2 class="section__title">Sell As-Is vs Fix Up: How the Two Options Compare</h2>
      <p class="section__subtitle">Green marks the better option on each factor. Red marks the drawback.</p>
    </div>

    <div class="cva-table-wrap">
      <table class="cva-table cva-table--compare">
        <colgroup><col class="cva-col-factor"><col class="cva-col-option"><col class="cva-col-option"></colgroup>
        <thead>
          <tr>
            <th scope="col">Factor</th>
            <th scope="col" class="cva-us"><?php echo esc_html( $cva_col_us ); ?><span class="cva-badge">Any condition, no repairs</span></th>
            <th scope="col"><?php echo esc_html( $cva_col_agent ); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $cva_rows as $row ) : ?>
          <tr>
            <th scope="row"><?php echo esc_html( $row[0] ); ?></th>
            <?php foreach ( array( array( $row[1], $cva_col_us, 'cva-us' ), array( $row[2], $cva_col_agent, '' ) ) as $cell ) : list( $c, $col, $cls ) = $cell; ?>
            <td data-label="<?php echo esc_attr( $col ); ?>" data-short="<?php echo $cls ? 'As-is to us' : 'Fix up, then list'; ?>"<?php echo $cls ? ' class="' . $cls . '"' : ''; ?>>
              <?php echo $cva_pill( $c[0], $c[1] ); ?>
              <?php if ( $c[2] ) : ?><span class="cva-cell__text"><?php echo esc_html( $c[2] ); ?></span><?php endif; ?>
            </td>
            <?php endforeach; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <p class="cva-table-note">Your mortgage payoff and any liens come out of the sale either way.</p>
  </div>
</section>

<!-- ── WHICH REPAIRS PAY OFF: two full-width card grids ── -->
<?php
$cva_ico = array(
	'sparkle'  => '<path d="M12 3v4M12 17v4M3 12h4M17 12h4M6 6l2.5 2.5M15.5 15.5L18 18M6 18l2.5-2.5M15.5 8.5L18 6"/>',
	'brush'    => '<path d="M18 3l3 3-9 9-3-3 9-9z"/><path d="M9 12c-2 0-4 1.5-4 4 0 1.5-1 2.5-2 3 3 1 7 0 7-4"/>',
	'wrench'   => '<path d="M14.7 6.3a4 4 0 00-5.4 5.4L4 17v3h3l5.3-5.3a4 4 0 005.4-5.4l-2.6 2.6-2.4-.6-.6-2.4 2.6-2.6z"/>',
	'floor'    => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v6M15 9v6M9 15v6"/>',
	'home'     => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M10 20v-5h4v5"/>',
	'shield'   => '<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/><path d="M9 12l2 2 4-4"/>',
	'kitchen'  => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M4 10h16M9 6h2M9 14v3"/>',
	'gem'      => '<path d="M6 3h12l3 6-9 12L3 9l3-6z"/><path d="M3 9h18"/>',
	'addition' => '<rect x="3" y="8" width="12" height="13"/><path d="M15 13h6v8h-6M18 3v6M15 6h6"/>',
	'crack'    => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M12 10l-2 3 3 2-2 3"/>',
	'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
	'calendar' => '<rect x="4" y="5" width="16" height="16" rx="2"/><path d="M8 3v4M16 3v4M4 10h16"/>',
	'document' => '<path d="M14 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V8l-5-5z"/><path d="M14 3v5h5M9 13h6M9 17h4"/>',
	'coins'    => '<ellipse cx="12" cy="6" rx="7" ry="3"/><path d="M5 6v6c0 1.7 3.1 3 7 3s7-1.3 7-3V6M5 12v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"/>',
	'search'   => '<circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/>',
);
$cva_worth = array(
	array( 'sparkle', 'Cleaning and decluttering', 'The cheapest thing that helps. Buyers notice the house, not your belongings, and it helps even if you sell as-is.' ),
	array( 'brush',   'Fresh paint where it\'s worn', 'Neutral paint in scuffed or bold rooms makes a house look cared for. Touch-ups often do as much as repainting everything.' ),
	array( 'wrench',  'Small fixes buyers notice', 'Leaky faucets, cracked tiles, sticking doors, dead outlets. Left alone, small problems make buyers guess at bigger ones and offer less.' ),
	array( 'floor',   'Floors you can refresh', 'Professional carpet cleaning or refinishing hardwood often does more for the money than replacing floors.' ),
	array( 'home',    'Curb appeal basics', 'A mowed lawn, trimmed shrubs, fresh mulch and a clean front door. It\'s the first thing buyers see, in person and in photos.' ),
	array( 'shield',  'Repairs a buyer\'s loan needs', 'A leaking roof, a dead HVAC system or a safety hazard can hold up FHA or VA financing until it\'s fixed. Ask an agent what lenders near you flag.' ),
);
$cva_skip = array(
	array( 'kitchen',  'Full kitchen or bath remodels', 'Big remodels rarely add back their full cost at sale, and they push your listing back by weeks or months.' ),
	array( 'gem',      'High-end upgrades', 'Luxury finishes and premium appliances are a matter of taste. Buyers often won\'t pay extra for choices they didn\'t make.' ),
	array( 'addition', 'Additions and finished basements', 'Large, permitted projects with long timelines and the most room for overruns.' ),
	array( 'crack',    'Cosmetics over major problems', 'New paint won\'t help if the roof, foundation or systems need work. The buyer\'s inspector will find it.' ),
	array( 'clock',    'Anything you can\'t finish', 'A half-done project can look worse to buyers than the original.' ),
);
$cva_risks = array(
	array( 'calendar', 'Contractor delays', 'Good contractors are booked out, and one late trade holds up the next. Every week of delay is another week of payments.' ),
	array( 'document', 'Permits and inspections', 'Electrical, plumbing, HVAC and structural work usually needs a permit and an inspection, which add time. Work done without one can come up when you sell.' ),
	array( 'coins',    'Budget overruns', 'Opening a wall or pulling up a floor can uncover rot, water damage, old wiring or termite damage. Plan for the bid to grow.' ),
	array( 'home',     'Carrying costs', 'Mortgage, property taxes, insurance and utilities keep running while the work happens and while the house is listed. If it sits empty, check what your insurance covers.' ),
	array( 'search',   'Inspection surprises', 'Even after repairs, the buyer\'s inspector can find something new. Buyers usually ask for repairs or a credit, and the price you counted on can shrink.' ),
);
?>
<section class="section cva-section" id="repairs">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">If You Do Fix It Up</p>
      <h2 class="section__title">Which Repairs Usually Pay Off Before Listing</h2>
      <p class="section__subtitle">General guidance, not a rule: every house and market is different. An agent can tell you what buyers near you expect.</p>
    </div>
    <h3 class="afx-group afx-group--good"><span aria-hidden="true">&check;</span> Usually worth doing</h3>
    <div class="cva-costs">
      <?php foreach ( $cva_worth as $cva_c ) : ?>
      <div class="cva-cost">
        <span class="cva-cost__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $cva_ico[ $cva_c[0] ]; ?></svg></span>
        <h4 class="cva-cost__title"><?php echo esc_html( $cva_c[1] ); ?></h4>
        <p class="cva-cost__text"><?php echo esc_html( $cva_c[2] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <h3 class="afx-group afx-group--skip"><span aria-hidden="true">&times;</span> Usually not worth it right before selling</h3>
    <div class="cva-costs">
      <?php foreach ( $cva_skip as $cva_c ) : ?>
      <div class="cva-cost">
        <span class="cva-cost__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $cva_ico[ $cva_c[0] ]; ?></svg></span>
        <h4 class="cva-cost__title"><?php echo esc_html( $cva_c[1] ); ?></h4>
        <p class="cva-cost__text"><?php echo esc_html( $cva_c[2] ); ?></p>
      </div>
      <?php endforeach; ?>
      <div class="cva-cost cva-cost--note">
        <h4 class="cva-cost__title">Not sure which list it's on?</h4>
        <p class="cva-cost__text">Ask an agent what the house would sell for with and without the repair, and compare the difference with a written bid. Our guide to <a href="<?php echo $cva_url( '/how-to-get-the-most-money-when-you-sell-your-house-in-tennessee/' ); ?>">getting the most money</a> has more.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── HIDDEN RISKS OF FIXING UP: white cards on the gray band ── -->
<section class="section section--alt cva-section" id="risks">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">What Can Go Wrong</p>
      <h2 class="section__title">The Hidden Risks of Fixing Up First</h2>
      <p class="section__subtitle">A repair bid is a starting point. Here's what tends to add time and money once the work begins.</p>
    </div>
    <div class="cva-costs">
      <?php foreach ( $cva_risks as $cva_c ) : ?>
      <div class="cva-cost">
        <span class="cva-cost__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $cva_ico[ $cva_c[0] ]; ?></svg></span>
        <h3 class="cva-cost__title"><?php echo esc_html( $cva_c[1] ); ?></h3>
        <p class="cva-cost__text"><?php echo esc_html( $cva_c[2] ); ?></p>
      </div>
      <?php endforeach; ?>
      <div class="cva-cost cva-cost--note">
        <h3 class="cva-cost__title">Same either way</h3>
        <p class="cva-cost__text">Tennessee's disclosure law (TCA 66-5-201 and following) applies whether you fix the house or not. More in our <a href="<?php echo $cva_url( '/selling-as-is-in-tennessee-disclosure-requirements/' ); ?>">as-is disclosure guide</a>, and on <a href="<?php echo $cva_url( '/selling-a-house-with-unpermitted-work-in-tennessee-a-complete-guide-to-your-options/' ); ?>">unpermitted work</a>.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── WHICH ONE FITS: two mirrored cards on one shared grid ── -->
<?php
$cva_tick = '<svg class="cva-tick" width="18" height="18" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
$cva_cards = array(
	array(
		'mod'   => '',
		'icon'  => $cva_ico['wrench'],
		'title' => 'Fixing it up usually makes sense when',
		'items' => array(
			'The work is mostly cosmetic: cleaning, paint and small fixes.',
			'You can pay for the repairs without straining your budget.',
			'You can cover the payments through the work and the listing.',
			'You have a contractor you trust and time to oversee the job.',
			'Homes like yours near you sell quickly once they show well.',
		),
		'quote' => 'Get a written repair bid and ask an agent what the house would sell for after the work. If the price gain is smaller than the bid plus a few months of costs, the repairs don\'t pay.',
		'by'    => 'Check before you start',
		'note'  => 'The smaller and more predictable the work, the more fixing up tends to pay.',
		'links' => 'Listing guides: <a href="' . $cva_url( '/how-to-get-the-most-money-when-you-sell-your-house-in-tennessee/' ) . '">get the most money</a> &middot; <a href="' . $cva_url( '/how-long-does-it-take-to-sell-a-house-in-tennessee/' ) . '">how long it takes</a>',
	),
	array(
		'mod'   => ' cva-fit__card--us',
		'icon'  => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M9 15l2 2 4-4"/>',
		'title' => 'Selling as-is usually makes more sense when',
		'items' => array(
			'The house needs major work: roof, foundation, HVAC, plumbing or wiring.',
			'You don\'t know what the repairs would cost, or can\'t pay for them.',
			'You need to sell by a certain date.',
			'The house is inherited, vacant or far from where you live.',
			'An inspection already turned up problems, or a sale fell through.',
		),
		'quote' => 'Get a written as-is offer and set it next to the after-repair price, minus the repairs, the months of costs and the listing costs. Go with what you\'d keep.',
		'by'    => 'Check before you decide',
		'note'  => 'The bigger and less certain the repairs, the more selling as-is tends to make sense.',
		'links' => 'We buy in <a href="' . $cva_url( '/where-we-buy/columbia/' ) . '">Columbia</a> &middot; <a href="' . $cva_url( '/where-we-buy/murfreesboro/' ) . '">Murfreesboro</a> &middot; <a href="' . $cva_url( '/where-we-buy/franklin/' ) . '">Franklin</a> &middot; <a href="' . $cva_url( '/where-we-buy/' ) . '">all areas</a>',
	),
);
?>
<section class="section cva-section" id="which-fits">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Which One Fits</p>
      <h2 class="section__title">When Each Option Is the Better Choice</h2>
    </div>
    <div class="cva-fit">
      <?php foreach ( $cva_cards as $cva_card ) : ?>
      <div class="cva-fit__card<?php echo $cva_card['mod']; ?>">
        <div class="cva-fit__head">
          <span class="cva-fit__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $cva_card['icon']; ?></svg></span>
          <h3 class="cva-fit__title"><?php echo esc_html( $cva_card['title'] ); ?></h3>
        </div>
        <ul class="cva-checks">
          <?php foreach ( $cva_card['items'] as $cva_li ) : ?><li><?php echo $cva_tick; ?><span><?php echo esc_html( $cva_li ); ?></span></li><?php endforeach; ?>
        </ul>
        <div class="cva-quote cva-quote--tip">
          <p><?php echo esc_html( $cva_card['quote'] ); ?></p>
          <footer><?php echo esc_html( $cva_card['by'] ); ?></footer>
        </div>
        <p class="cva-fit__note"><?php echo esc_html( $cva_card['note'] ); ?></p>
        <p class="cva-fit__links"><?php echo $cva_card['links']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── AS-IS WITH AN AGENT vs AS-IS TO A CASH BUYER ── -->
<section class="section section--alt cva-section" id="as-is-routes">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Two Ways to Sell As-Is</p>
      <h2 class="section__title">Selling As-Is With an Agent or to a Cash Buyer</h2>
    </div>
    <div class="afx-routes">
      <div class="afx-route">
        <h3 class="afx-route__title">As-is with an agent</h3>
        <p>You can list a house as-is. The listing says the price reflects the condition and that you won't make repairs. You still pay commission, host showings and wait on the buyer's inspection and loan.</p>
        <p>Many lenders won't finance a house with major problems, so your buyers are often cash buyers, investors and people with renovation loans.</p>
      </div>
      <div class="afx-route afx-route--us">
        <h3 class="afx-route__title">As-is to a cash buyer</h3>
        <p>No repairs, no showings and no lender. We make a written offer, pay the closing costs and charge no commission, and you pick the closing date.</p>
        <p>The price is lower than a fixed-up sale would bring, because it covers the repairs and risk we take on. Here's how we <a href="<?php echo $cva_url( '/sell-house-as-is-tennessee/' ); ?>">buy houses as-is</a>.</p>
      </div>
    </div>
    <blockquote class="afx-story">
      <p>&ldquo;A seller who had bought a Columbia home with cash a year earlier had a family emergency back home and needed to sell immediately. Her agent's listing wasn't getting the price she needed, so she and her agent reached out to us. The house only needed paint and landscaping. We closed in under three weeks and handled the belongings she left behind.&rdquo;</p>
      <footer>One of our purchases in Columbia, April 2026</footer>
    </blockquote>
    <p class="afx-routes__more">For costs, timelines and when listing nets more, see our full <a href="<?php echo $cva_url( '/cash-buyer-vs-agent-tennessee/' ); ?>">cash buyer vs agent comparison</a>.</p>
    <p class="cva-disclaimer">This page is general information, not legal or tax advice. For an estate, divorce or tax question, talk to a Tennessee attorney or CPA.</p>
  </div>
</section>

<!-- ── WHY HOMEOWNERS CHOOSE (shared section) ── -->
<div class="cva-diff">
<?php
get_template_part( 'difference-section', null, array(
	'audience' => 'Homeowners',
	'lead'     => 'When you call, you talk to us, not a call center or an out-of-state company. We have been buying houses in Maury County for 7+ years and have bought over 100 homes there.',
) );
?>
</div>

<!-- ── FAQ ── -->
<section class="section section--alt cva-section" id="faq">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Common Questions</p>
      <h2 class="section__title">Sell As-Is or Fix Up: Frequently Asked Questions</h2>
    </div>
    <div class="faq-list">
      <?php foreach ( $cva_faqs as $faq ) : ?>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
          <?php echo esc_html( $faq[0] ); ?>
          <div class="faq-icon"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-answer"><?php echo wp_kses( $faq[1], array( 'a' => array( 'href' => array() ) ) ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── GOOGLE REVIEWS: real reviews word for word from tcfh_get_reviews(), first name and last initial only ── -->
<?php
$cva_review_authors = array( 'Clayton Daniels', 'Josh Tully', 'JP JP', 'Kylie', 'Kayla Wright', 'Trish Haberman' );
$cva_reviews = array();
foreach ( $cva_review_authors as $cva_a ) {
	foreach ( tcfh_get_reviews() as $cva_r ) {
		if ( $cva_r['author'] === $cva_a ) { $cva_reviews[] = $cva_r; break; }
	}
}
$cva_short_name = function ( $name ) {
	$parts = preg_split( '/\s+/', trim( $name ) );
	return count( $parts ) > 1 ? $parts[0] . ' ' . strtoupper( substr( end( $parts ), 0, 1 ) ) . '.' : $parts[0];
};
?>
<section class="section cva-section cva-reviews" id="testimonials">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">5-Star Google Reviews</p>
      <h2 class="section__title">What Sellers Say About Working With Us</h2>
    </div>
    <div class="reviews-outer" id="reviewsOuter">
      <div class="reviews-track" id="reviewsTrack">
        <?php foreach ( array_chunk( $cva_reviews, 3 ) as $cva_slide ) : ?>
        <div class="reviews-slide">
          <?php foreach ( $cva_slide as $cva_r ) : $cva_n = $cva_short_name( $cva_r['author'] ); ?>
          <div class="testimonial-card">
            <div class="testimonial-stars"><?php echo str_repeat( '&#9733;', (int) $cva_r['rating'] ); ?></div>
            <p class="testimonial-body"><?php echo esc_html( $cva_r['body'] ); ?></p>
            <div class="testimonial-author">
              <div class="testimonial-avatar"><?php echo esc_html( $cva_r['initials'] ); ?></div>
              <div>
                <div class="testimonial-name"><?php echo esc_html( $cva_n ); ?></div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="carousel-controls">
      <button class="carousel-btn" id="revPrev" aria-label="Previous reviews">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <div class="carousel-dots" id="revDots"></div>
      <button class="carousel-btn" id="revNext" aria-label="Next reviews">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>
    <p class="reviews-footnote">Read all <?php echo tcfh_google_reviews_link(); ?>.</p>
  </div>
</section>

<style>
  /* ── Two column layout: readable text column + sidebar ── */
  .cva-layout { display: grid; grid-template-columns: minmax(0, 1fr) 300px; gap: 56px; max-width: 1080px; margin: 0 auto; align-items: start; }
  .cva-main { max-width: 700px; }
  .cva-main p:not(.section__eyebrow) { font-size: 16px; line-height: 1.75; margin-bottom: 18px; color: var(--charcoal); }
  .cva-main a, .cva-table-note a, .cva-fit a, .cva-section .faq-answer a { color: var(--green-dark); font-weight: 600; text-decoration: underline; text-underline-offset: 2px; }
  .cva-subtitle { margin-top: 48px; }
  .cva-answer { background: var(--green-light); border-left: 4px solid var(--green-dark); border-radius: 0 12px 12px 0; padding: 20px 24px; margin: 8px 0 24px; }
  .cva-answer p { margin: 0; font-weight: 500; }
  .cva-side { height: 100%; }
  .cva-takeaways { background: var(--white); border: 1px solid var(--border); border-top: 4px solid var(--green-dark); border-radius: 12px; padding: 24px; box-shadow: var(--shadow); }
  .cva-takeaways__title, .cva-offer-card__title { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 18px; margin-bottom: 12px; color: var(--charcoal); }
  .cva-takeaways ul { margin: 0; padding: 0; list-style: none; }
  .cva-takeaways li { position: relative; padding-left: 26px; margin-bottom: 12px; font-size: 15px; line-height: 1.55; }
  .cva-takeaways li::before { content: ""; position: absolute; left: 0; top: 3px; width: 16px; height: 16px; border-radius: 50%; background: var(--green-dark) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M6 12.5l4 4L18 8.5' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") center/12px no-repeat; }
  .cva-offer-card { background: var(--white); color: var(--charcoal); border: 1px solid var(--border); border-top: 4px solid var(--green-dark); border-radius: 12px; padding: 26px 24px; box-shadow: var(--shadow); }
  .cva-offer-card__text { font-size: 15px; line-height: 1.55; color: var(--charcoal-light); margin-bottom: 18px; }
  .cva-offer-card__phone { display: block; text-align: center; margin-top: 14px; color: var(--green-dark); font-weight: 600; font-size: 15px; }

  /* ── Tables ── */
  .cva-table-wrap { max-width: 1080px; margin: 0 auto; background: var(--white); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow); }
  .cva-table { width: 100%; border-collapse: collapse; table-layout: fixed; font-size: 15px; line-height: 1.45; }
  .cva-col-factor { width: 24%; }
  .cva-col-option { width: 38%; }
  .cva-table thead th { background: var(--bg-light); color: var(--charcoal); font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 16px; text-align: left; padding: 18px 24px; vertical-align: middle; }
  .cva-table thead th.cva-us { background: var(--green-dark); color: var(--white); }
  .cva-badge { display: block; width: max-content; margin-top: 6px; background: var(--white); color: var(--green-dark); font-size: 12px; font-weight: 700; letter-spacing: .02em; padding: 3px 10px; border-radius: 999px; }
  .cva-table tbody th, .cva-table tbody td { padding: 16px 24px; border-top: 1px solid var(--border); text-align: left; vertical-align: middle; }
  .cva-table tbody th { font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--charcoal); }
  .cva-table tbody tr:nth-child(even) th, .cva-table tbody tr:nth-child(even) td { background: var(--bg-light); }
  .cva-table tbody td.cva-us { background: color-mix(in srgb, var(--green-light) 40%, var(--white)); border-left: 2px solid var(--green); border-right: 2px solid var(--green); }
  .cva-table tbody tr:nth-child(even) td.cva-us { background: color-mix(in srgb, var(--green-light) 65%, var(--white)); }
  .cva-table tbody tr:last-child td.cva-us { border-bottom: 2px solid var(--green); }
  .cva-pill { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 999px; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 14px; line-height: 1.3; }
  .cva-pill--good { background: var(--green-light); color: color-mix(in srgb, var(--green-dark) 65%, var(--charcoal)); }
  .cva-pill--bad { background: #F7E9E7; color: #8F3B32; }
  .cva-pill--neutral { background: var(--bg-light); color: var(--charcoal); border: 1px solid var(--border); }
  .cva-cell__text { display: block; margin-top: 6px; font-size: 14px; color: var(--charcoal-light); }
  .cva-table tbody tr.cva-total th, .cva-table tbody tr.cva-total td { background: var(--green-light); font-weight: 700; color: var(--charcoal); border-top: 2px solid var(--green-dark); }
  .cva-table-note { max-width: 1080px; margin: 20px auto 0; text-align: center; color: var(--charcoal-light); font-size: 15px; }

  /* ── Photo after the short answer ── */
  .cva-photo-section { padding-top: 0; }
  /* ── By the Numbers ── */
  .cva-numbers { padding-top: 8px; }
  .cva-numbers__grid { list-style: none; margin: 0 auto; padding: 0; max-width: 1080px; display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 20px; }
  .cva-numbers__card { display: flex; flex-direction: column; background: var(--white); border: 1px solid var(--border); border-top: 4px solid var(--green-dark); border-radius: 12px; padding: 22px 20px 18px; box-shadow: var(--shadow); }
  .cva-numbers__value { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 34px; line-height: 1.1; color: var(--green-dark); }
  .cva-numbers__label { margin: 10px 0 14px; font-size: 15px; line-height: 1.55; color: var(--charcoal); }
  .cva-numbers__source { margin: auto 0 0; padding-top: 12px; border-top: 1px solid var(--border); font-size: 13px; line-height: 1.5; color: var(--charcoal-light); }
  .cva-numbers__source a { color: var(--charcoal-light); text-decoration: underline; text-underline-offset: 2px; }
  @media (max-width: 1024px) { .cva-numbers__grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
  @media (max-width: 600px) { .cva-numbers__grid { grid-template-columns: 1fr; gap: 14px; } .cva-numbers__card { padding: 18px 16px 14px; } .cva-numbers__value { font-size: 28px; } }
  .cva-photo { max-width: 1080px; margin: 0 auto; }
  .cva-photo img { display: block; width: 100%; height: 280px; object-fit: cover; object-position: 50% 55%; border-radius: 12px; box-shadow: var(--shadow); background: var(--bg-light); }
  .cva-photo figcaption { margin-top: 12px; text-align: center; font-size: 15px; color: var(--charcoal-light); }

  /* ── Photo blurb ── */
  .cva-photo__blurb { max-width: 760px; margin: 10px auto 0; text-align: center; font-size: 16px; line-height: 1.7; color: var(--charcoal); }
  .cva-photo__blurb a { color: var(--green-dark); font-weight: 600; text-decoration: underline; text-underline-offset: 2px; }

  /* ── Side by side: whole section fits one desktop screen after "See the Comparison".
        html has scroll-padding-top: 120px; the fixed header is 73px, so pull the
        target up by 47px and it lands right under the header. ── */
  @media (min-width: 769px) {
    #compare { scroll-margin-top: -47px; padding-top: 40px; }
    #compare .section__header { margin-bottom: 20px; }
    #compare .section__eyebrow { margin-bottom: 6px; }
    #compare .section__title { margin-bottom: 6px; }
    #compare .section__subtitle { margin: 0 auto; }
    #compare .cva-table thead th { padding: 12px 24px; }
    #compare .cva-badge { margin-top: 4px; }
    #compare .cva-table tbody th, #compare .cva-table tbody td { padding: 9px 24px; }
    #compare .cva-pill { padding: 3px 10px; }
    #compare .cva-cell__text { margin-top: 2px; }
    #compare .cva-table-note { margin-top: 12px; }
  }

  /* ── Reviews: line up with the content width ── */
  .cva-reviews .reviews-outer, .cva-reviews .carousel-controls, .cva-reviews .reviews-footnote { max-width: 1080px; margin-left: auto; margin-right: auto; }

  /* ── Shared "Why Homeowners Choose" section on a gray band ── */

  /* ── Reviews on white: give the cards an edge ── */
  .cva-reviews .testimonial-card { border: 1px solid var(--border); box-shadow: var(--shadow); }

  /* ── Listing costs: full-width card grid ── */
  .cva-costs { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; max-width: 1080px; margin: 0 auto; }
  .cva-cost { background: var(--white); border: 1px solid var(--border); border-radius: 12px; padding: 24px; box-shadow: var(--shadow); }
  .cva-cost__icon { display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: 50%; background: var(--bg-light); color: var(--charcoal); margin-bottom: 14px; }
  .cva-cost__title { font-size: 18px; font-weight: 700; margin: 0 0 8px; }
  .cva-cost__text { margin: 0; color: var(--charcoal-light); line-height: 1.6; }
  .cva-cost--note { background: var(--bg-light); box-shadow: none; padding-top: 82px; }
  .cva-cost a, .cva-takeoff a { color: var(--green-dark); font-weight: 600; text-decoration: underline; text-underline-offset: 2px; }
  .cva-takeoff { max-width: 1080px; margin: 28px auto 0; background: var(--green-light); border: 1px solid var(--green); border-radius: 12px; padding: 32px; }
  .cva-takeoff__title { font-size: clamp(22px, 2.6vw, 28px); font-weight: 700; margin: 0 0 20px; text-align: center; }
  .cva-takeoff__grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
  .cva-takeoff__item { background: var(--white); border-radius: 12px; padding: 22px; }
  .cva-takeoff__item h3 { font-size: 17px; font-weight: 700; margin: 0 0 8px; color: var(--green-dark); }
  .cva-takeoff__item p { margin: 0; color: var(--charcoal); line-height: 1.6; }

  /* ── Fit cards: one shared grid so every row lines up across both cards ── */
  .cva-fit { display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: repeat(9, auto); column-gap: 28px; max-width: 1080px; margin: 0 auto; }
  .cva-fit__card { grid-row: span 9; display: grid; grid-template-rows: subgrid; row-gap: 0; background: var(--white); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow); }
  .cva-fit__head { display: flex; align-items: center; gap: 12px; padding: 18px 24px; background: var(--bg-light); border-bottom: 1px solid var(--border); }
  .cva-fit__card--us .cva-fit__head { background: var(--green-dark); border-bottom-color: var(--green-dark); }
  .cva-fit__icon { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: var(--white); color: var(--charcoal-light); flex-shrink: 0; }
  .cva-fit__card--us .cva-fit__icon { color: var(--green-dark); }
  .cva-fit__title { font-size: 18px; font-weight: 700; margin: 0; color: var(--charcoal); line-height: 1.3; }
  .cva-fit__card--us .cva-fit__title { color: var(--white); }
  /* Each checklist stacks on its own (no per-item shared rows), so a short item never leaves a gap; the quote, note and links rows below still line up. */
  .cva-checks { grid-row: span 5; display: flex; flex-direction: column; list-style: none; margin: 0; padding: 20px 24px 8px; }
  .cva-checks li { display: flex; gap: 10px; align-items: flex-start; padding-bottom: 12px; line-height: 1.55; color: var(--charcoal); }
  .cva-tick { flex-shrink: 0; margin-top: 3px; color: var(--charcoal-light); }
  .cva-fit__card--us .cva-tick { color: var(--green-dark); }
  .cva-quote { margin: 0 24px; padding: 18px 20px; background: var(--bg-light); border-left: 4px solid var(--charcoal-light); border-radius: 0 12px 12px 0; display: flex; flex-direction: column; justify-content: space-between; }
  .cva-fit__card--us .cva-quote { border-left-color: var(--green-dark); }
  .cva-quote p { margin: 0 0 10px; line-height: 1.65; color: var(--charcoal); font-style: italic; }
  .cva-quote footer { font-size: 13px; font-weight: 600; color: var(--charcoal-light); }
  .cva-fit__note { margin: 0; padding: 18px 24px 0; line-height: 1.6; color: var(--charcoal); }
  .cva-fit__links { margin: 0; padding: 12px 24px 22px; align-self: end; font-size: 15px; color: var(--charcoal-light); }
  .cva-fit a, .cva-steps a { color: var(--green-dark); font-weight: 600; text-decoration: underline; text-underline-offset: 2px; }

  /* ── 3 steps, story callout, related guides ── */
  .cva-steps { max-width: 1080px; margin: 0 auto; }
  .cva-steps__title { font-size: clamp(22px, 2.6vw, 28px); font-weight: 700; margin: 0 0 24px; text-align: center; }
  .cva-steps__list { position: relative; list-style: none; margin: 0 0 28px; padding: 0; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
  .cva-steps__list::before { content: ""; position: absolute; top: 22px; left: calc(100% / 6); right: calc(100% / 6); height: 2px; background: var(--green); z-index: 0; }
  .cva-step { position: relative; z-index: 1; display: flex; flex-direction: column; align-items: center; }
  .cva-step__num { display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: 50%; background: var(--green-dark); color: var(--white); font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 18px; box-shadow: 0 0 0 6px var(--bg-light); margin-bottom: 16px; }
  .cva-step__card { flex: 1; width: 100%; background: var(--white); border: 1px solid var(--border); border-radius: 12px; padding: 22px; text-align: center; box-shadow: var(--shadow); }
  .cva-step__title { display: block; font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--charcoal); margin-bottom: 8px; }
  .cva-step__text { display: block; line-height: 1.6; color: var(--charcoal-light); }
  .cva-guides__label { font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--green-dark); margin: 0 0 12px; text-align: center; }
  .cva-guides { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }
  .cva-steps a.cva-guide { position: relative; display: block; background: var(--white); border: 1px solid var(--border); border-radius: 12px; padding: 20px 52px 20px 22px; text-decoration: none; box-shadow: var(--shadow); transition: border-color .2s; }
  .cva-steps a.cva-guide:hover { border-color: var(--green); }
  .cva-guide__title { display: block; font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--charcoal); margin-bottom: 4px; }
  .cva-guide__text { display: block; font-weight: 400; color: var(--charcoal-light); }
  .cva-guide__arrow { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 20px; color: var(--green-dark); }
  .cva-disclaimer { margin: 0; font-size: 13px; color: var(--charcoal-light); text-align: left; }

  .cva-side .cva-offer-card { margin-top: 20px; }

  /* ── Byline in the hero ── */
  .cva-byline { margin: 14px 0 0; font-size: 14px; color: rgba(255,255,255,.85); text-shadow: 0 1px 8px rgba(0,0,0,.3); }
  .cva-byline__short { display: none; }

  #short-answer, #repairs, #risks, #which-fits, #as-is-routes, #faq { scroll-margin-top: 110px; }

  /* ── What about selling it yourself? ── */
  .cva-fsbo { background: var(--bg-light); padding: 48px 0; }
  .cva-fsbo__box { max-width: 1080px; margin: 0 auto; background: var(--white); border: 1px solid var(--border); border-left: 4px solid var(--green-dark); border-radius: 0 12px 12px 0; padding: 24px 28px; }
  .cva-fsbo__title { font-size: 20px; font-weight: 700; margin: 0 0 8px; }
  .cva-fsbo__box p { margin: 0; line-height: 1.7; color: var(--charcoal); }
  .cva-fsbo__box a { color: var(--green-dark); font-weight: 600; text-decoration: underline; text-underline-offset: 2px; }

  /* ── Call to action after the steps ── */
  .cva-steps__cta { text-align: center; margin: 0 0 32px; }
  .cva-steps a.btn-primary { display: inline-block; text-decoration: none; color: var(--white); }

  /* ── Review names readable ── */
  .cva-reviews .testimonial-name { font-size: 15px; }
  .cva-reviews .testimonial-location { font-size: 13px; }

  @media (max-width: 1024px) {
    .cva-layout { grid-template-columns: 1fr; gap: 28px; }
    .cva-main { max-width: none; }
  }

  /* ── Phones: each row becomes a stacked card ── */
  @media (max-width: 768px) {
    .cva-table-wrap { background: none; border: 0; border-radius: 0; box-shadow: none; overflow: visible; }
    .cva-table, .cva-table tbody, .cva-table tr, .cva-table th, .cva-table td { display: block; width: 100%; }
    .cva-table colgroup, .cva-table thead { display: none; }
    .cva-table tbody tr { display: grid; grid-template-columns: 1fr 1fr; background: var(--white); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; margin-bottom: 12px; box-shadow: var(--shadow); }
    .cva-table tbody tr th { grid-column: 1 / -1; }
    .cva-table tbody tr th { background: var(--bg-light) !important; color: var(--charcoal); border-top: 0; padding: 12px 18px; font-size: 16px; }
    .cva-table tbody tr td { background: var(--white) !important; padding: 12px 12px 14px; border-top: 0; border-left: 0; border-right: 0; }
    .cva-table .cva-pill { font-size: 13px; padding: 4px 10px; }
    .cva-table tbody tr td.cva-us { background: color-mix(in srgb, var(--green-light) 40%, var(--white)) !important; border: 0; border-right: 1px solid var(--border); }
    .cva-table tbody td::before { content: attr(data-short); display: block; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--charcoal-light); margin-bottom: 8px; }
    .cva-table tbody td.cva-us::before { color: var(--green-dark); }
    .cva-table tbody tr.cva-total th { background: var(--green-dark) !important; color: var(--white); }
    .cva-table tbody tr.cva-total td { font-weight: 700; }
    .cva-costs, .cva-takeoff__grid, .cva-guides { grid-template-columns: 1fr; }
    .cva-cost { display: grid; grid-template-columns: 44px 1fr; column-gap: 14px; align-items: center; padding: 20px; }
    .cva-cost__icon { margin-bottom: 0; }
    .cva-cost__title { margin: 0; }
    .cva-cost__text { grid-column: 1 / -1; margin-top: 10px; }
    .cva-cost--note { display: block; padding-top: 20px; }
    .cva-byline { margin-bottom: 16px; }
    .cva-byline__long { display: none; }
    .cva-byline__short { display: inline; }
    .cva-fsbo { padding: 32px 0; }
    .cva-fsbo__box { padding: 20px; }
    .cva-takeoff { padding: 22px; }
    .cva-fit { grid-template-columns: 1fr; grid-template-rows: none; row-gap: 20px; }
    .cva-fit__card { grid-row: auto; display: flex; flex-direction: column; }
    .cva-checks { display: block; }
    .cva-steps__list { grid-template-columns: 1fr; gap: 16px; }
    .cva-steps__list::before { top: 22px; bottom: 22px; left: 21px; right: auto; width: 2px; height: auto; }
    .cva-step { flex-direction: row; align-items: flex-start; gap: 16px; }
    .cva-step__num { flex-shrink: 0; margin-bottom: 0; }
    .cva-step__card { text-align: left; padding: 18px; }
    .cva-table tbody tr:last-child td.cva-us { border-bottom: 0; }
    .cva-photo img { height: 200px; }
  }

  /* ── Sell As-Is vs Fix Up additions ── */
  @media (min-width: 1025px) { .cva-side .cva-offer-card { position: sticky; top: 96px; } }
  .cva-numbers__note { max-width: 1080px; margin: 16px auto 0; text-align: center; font-size: 14px; color: var(--charcoal-light); }
  .afx-group { max-width: 1080px; margin: 0 auto 16px; display: flex; align-items: center; gap: 10px; font-size: 20px; font-weight: 700; color: var(--charcoal); }
  .afx-group span { display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 50%; font-size: 16px; font-weight: 700; }
  .afx-group--good span { background: var(--green-light); color: var(--green-dark); }
  .afx-group--skip span { background: #F7E9E7; color: #8F3B32; }
  .cva-costs + .afx-group { margin-top: 40px; }
  #repairs .cva-cost__title { font-family: 'Poppins', sans-serif; }
  .cva-quote--tip p { font-style: normal; }
  .afx-routes { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; max-width: 1080px; margin: 0 auto; }
  .afx-route { background: var(--white); border: 1px solid var(--border); border-top: 4px solid var(--charcoal-light); border-radius: 12px; padding: 24px 26px; box-shadow: var(--shadow); }
  .afx-route--us { border-top-color: var(--green-dark); }
  .afx-route__title { font-size: 19px; font-weight: 700; margin: 0 0 10px; }
  .afx-route p { margin: 0 0 12px; line-height: 1.65; color: var(--charcoal); }
  .afx-route p:last-child { margin-bottom: 0; }
  .afx-route a, .afx-routes__more a { color: var(--green-dark); font-weight: 600; text-decoration: underline; text-underline-offset: 2px; }
  .afx-story { max-width: 1080px; margin: 24px auto 0; background: var(--white); border: 1px solid var(--border); border-left: 4px solid var(--green-dark); border-radius: 0 12px 12px 0; padding: 22px 26px; }
  .afx-story p { margin: 0 0 10px; line-height: 1.65; color: var(--charcoal); font-style: italic; }
  .afx-story footer { font-size: 13px; font-weight: 600; color: var(--charcoal-light); }
  .afx-routes__more { max-width: 1080px; margin: 20px auto 14px; text-align: center; font-size: 16px; color: var(--charcoal); }
  #as-is-routes .cva-disclaimer { max-width: 1080px; margin: 0 auto; }
  @media (max-width: 768px) {
    .afx-routes { grid-template-columns: 1fr; }
    .afx-route, .afx-story { padding: 20px; }
    .afx-group { font-size: 18px; }
  }
</style>

<script type="application/ld+json">
<?php
$cva_faq_schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => array_map( function ( $f ) {
		return array(
			'@type'          => 'Question',
			'name'           => $f[0],
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $f[1] ) ),
		);
	}, $cva_faqs ),
);
echo wp_json_encode( $cva_faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
?>
</script>

<?php get_footer(); ?>
