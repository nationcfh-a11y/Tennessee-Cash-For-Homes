<?php
/**
 * Template Name: Cash Buyer vs Agent
 * Template for /cash-buyer-vs-agent-tennessee/ (also assigned to the page directly).
 * Standalone comparison page: selling to Tennessee Cash For Homes vs
 * listing with an agent. Copy rule: no em or en dashes anywhere.
 * Table, example, and FAQ content live in the arrays below so the desktop
 * tables, the phone cards, and the FAQPage schema all come from one source.
 * Written as the company ("we"), never as one person. Worked examples were
 * removed on Nov 16 2026 at the owner's request.
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

$cva_col_us    = 'Tennessee Cash For Homes';
$cva_col_agent = 'Listing With an Agent';

/* factor, [type, label, short line] for us, same for agent */
$cva_rows = array(
	array( 'Sale price',
		array( 'bad',  'Lower price',        'Priced for repairs and risk' ),
		array( 'good', 'Higher price',       'Best for move-in ready homes' ) ),
	array( 'Agent commission',
		array( 'good', 'No commission',      '' ),
		array( 'bad',  'You pay commission', 'Negotiable, often the biggest cost' ) ),
	array( 'Other fees and closing costs',
		array( 'good', 'We pay them all',    'All closing costs. No fees.' ),
		array( 'bad',  'You pay your share', 'Plus any repair credits you agree to' ) ),
	array( 'Repairs',
		array( 'good', 'No repairs',         'Bought as-is, any condition' ),
		array( 'bad',  'Often required',     'Before listing and after inspection' ) ),
	array( 'Showings',
		array( 'good', 'One walkthrough',    '' ),
		array( 'bad',  'Many showings',      'Plus photos and open houses' ) ),
	array( 'Timeline',
		array( 'good', '7 to 30 days',       'You pick the closing date' ),
		array( 'bad',  'Often months',       'Market time plus loan closing' ) ),
	array( 'Certainty',
		array( 'good', 'No financing risk',  'No loan, no appraisal' ),
		array( 'bad',  'Can fall through',   'Financing, appraisal, or inspection' ) ),
	array( 'Typical net proceeds',
		array( 'neutral', 'Lower price, no costs taken out',   '' ),
		array( 'neutral', 'Higher price, many costs taken out', '' ) ),
);

$cva_faqs = array(
	array( 'Is it better to sell my house for cash or list it with a realtor in Tennessee?',
		'It depends on the house and your timeline. A move-in ready house with time to wait usually nets more with an agent. A house that needs major work, a hard deadline, or payments you can\'t keep making usually tips it toward cash.' ),
	array( 'How much less is a cash offer than market value?',
		'There\'s no set percentage. A cash offer starts from what the house is worth fixed up, then subtracts repairs, carrying costs, resale costs and the buyer\'s margin. Compare what you\'d walk away with from each option, not the offer against the list price.' ),
	array( 'How long does it take to sell a house with an agent compared to a cash buyer?',
		'A listing takes as long as it takes to find a buyer, plus their loan closing, which often adds up to a few months. We can close in as little as 7 days, and about 30 is typical. Here\'s <a href="' . $cva_url( '/how-long-does-it-take-to-sell-a-house-in-tennessee/' ) . '">how long it takes to sell a house in Tennessee</a>, stage by stage.' ),
	array( 'Who pays the transfer tax when I sell my house in Tennessee?',
		'The buyer, by statute. Tennessee\'s transfer tax is 37 cents per $100 of the price or value, whichever is greater (TCA 67-4-409). A contract can shift it, so read yours.' ),
	array( 'Do I still have to fill out a disclosure form if I sell to a cash buyer?',
		'Usually, yes. Tennessee\'s disclosure law applies with or without an agent. You give the buyer the property disclosure unless an exemption applies or the buyer waives it in writing. More in our <a href="' . $cva_url( '/selling-as-is-in-tennessee-disclosure-requirements/' ) . '">as-is disclosure guide</a>.' ),
	array( 'Can I get a cash offer and still list my house with an agent?',
		'Yes. Our offer is free and doesn\'t commit you to anything, so plenty of sellers get one to compare against an agent\'s net sheet. If you\'ve already signed a listing agreement, check its terms with your agent first.' ),
	array( 'Will I pay Tennessee state tax on the profit from selling my house?',
		'No. Tennessee doesn\'t tax the profit from a home sale. Federal capital gains rules can still apply either way, so check with a CPA. Our <a href="' . $cva_url( '/do-i-have-to-pay-taxes-on-money-made-from-selling-my-home-a-guide-for-tennessee-homeowners/' ) . '">home sale tax guide</a> covers the federal exclusion.' ),
);

get_header(); ?>

<!-- ── HERO: same photo hero and overlay as the city pages (house photo 8) ── -->
<?php
$cva_hero_n   = 8;
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
      sizes="100vw" width="1600" height="882"
      style="object-position: 48% 47%; background: url(data:image/webp;base64,<?php echo esc_attr( $cva_hero_ph[ $cva_hero_n ] ); ?>) 48% 47% / cover no-repeat"
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
          <span>Cash Buyer vs Agent</span>
        </nav>
        <div class="hero__badge county-hero__badge">Cash Sale or Listing?</div>
        <h1 class="county-hero__title">Cash Buyer vs Agent in Tennessee</h1>
        <p class="county-hero__subtitle">What each option costs, how long it takes and what you'd walk away with, including when listing is the better call.</p>
        <p class="cva-byline">By the Tennessee Cash For Homes team <span aria-hidden="true">&middot;</span> Last updated <time datetime="<?php echo esc_attr( get_the_modified_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_modified_date( 'F j, Y' ) ); ?></time></p>
        <div class="hero__trust county-hero__trust">
          <div class="hero__trust-item"><?php echo $cva_check; ?>Zero fees or commissions</div>
          <div class="hero__trust-item"><?php echo $cva_check; ?>Buy as-is, any condition</div>
          <div class="hero__trust-item"><?php echo $cva_check; ?>Close as fast as 7 days</div>
          <div class="hero__trust-item"><?php echo $cva_check; ?>We pay closing costs</div>
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
            <input type="hidden" name="lead_source" value="Cash Buyer vs Agent" />
            <div class="form-group">
              <label for="cva-address">Property Address</label>
              <input type="text" id="cva-address" name="address" placeholder="123 Main St, Nashville, TN" required />
            </div>
            <div class="form-group">
              <label for="cva-name">Your Name</label>
              <input type="text" id="cva-name" name="name" placeholder="John Smith" required />
            </div>
            <div class="form-group">
              <label for="cva-phone">Phone Number</label>
              <input type="tel" id="cva-phone" name="phone" placeholder="(615) 555-0123" required />
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
        <h2 class="section__title">Should You Sell for Cash or List With an Agent?</h2>
        <div class="cva-answer">
          <p>If your house is in good shape and you can wait a few months, listing with an agent will usually put more money in your pocket. If it needs major repairs, you're on a deadline, or you can't keep paying for it while it sits, a cash sale often comes out close or ahead once every cost is counted. Compare what you'd walk away with, not the sale price.</p>
        </div>
        <p><a href="<?php echo $cva_url( '/' ); ?>">Tennessee Cash For Homes</a> buys houses for cash, so you know where we stand. We still tell people to list when that's the better move, and one of those sellers left a review further down this page.</p>
        <p>The difference comes down to who's buying. A retail buyer is usually a family with a mortgage, so the sale depends on their loan, an inspection and an appraisal. We pay cash, so none of that applies.</p>
        <p>They pay more because they're buying a finished home. We pay less because we take on the repairs, the carrying costs and the risk of reselling it.</p>
      </div>
      <aside class="cva-side">
        <div class="cva-takeaways">
          <p class="cva-takeaways__title">Key Takeaways</p>
          <ul>
            <li>A move-in ready house usually nets more with an agent.</li>
            <li>A cash sale skips commission, repairs, showings and closing costs.</li>
            <li>The more repairs and months a listing needs, the better cash looks.</li>
            <li>Compare what you'd walk away with, not the sale price.</li>
          </ul>
        </div>
        <div class="cva-offer-card">
          <p class="cva-offer-card__title">Get Your Cash Offer</p>
          <p class="cva-offer-card__text">Free, no obligation, usually within 24 hours. Put it next to any agent's net sheet.</p>
          <a href="#get-offer" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</a>
          <a href="tel:+16158018126" class="cva-offer-card__phone">Or call (615) 801-8126</a>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ── PHOTO: house photo 6 (white house used on the county pages), lazy loaded ── -->
<section class="section cva-section cva-photo-section">
  <div class="container">
    <figure class="cva-photo">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/brand_assets/hero-house-6-800w.webp' ); ?>"
        srcset="<?php echo esc_url( get_template_directory_uri() . '/brand_assets/hero-house-6-800w.webp' ); ?> 800w, <?php echo esc_url( get_template_directory_uri() . '/brand_assets/hero-house-6.webp' ); ?> 1600w"
        sizes="(max-width: 1128px) 100vw, 1080px" width="1600" height="1067"
        alt="A house Tennessee Cash For Homes bought in Middle Tennessee"
        loading="lazy" decoding="async" />
      <figcaption>We buy houses as-is across Middle Tennessee.</figcaption>
    </figure>
  </div>
</section>

<!-- ── COMPARISON TABLE ── -->
<section class="section section--alt cva-section" id="compare">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Side by Side</p>
      <h2 class="section__title">Cash Buyer vs Agent: How the Two Options Compare</h2>
      <p class="section__subtitle">Green marks the better option on each factor. Red marks the drawback.</p>
    </div>

    <div class="cva-table-wrap">
      <table class="cva-table cva-table--compare">
        <colgroup><col class="cva-col-factor"><col class="cva-col-option"><col class="cva-col-option"></colgroup>
        <thead>
          <tr>
            <th scope="col">Factor</th>
            <th scope="col" class="cva-us"><?php echo esc_html( $cva_col_us ); ?><span class="cva-badge">Best for speed and certainty</span></th>
            <th scope="col"><?php echo esc_html( $cva_col_agent ); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $cva_rows as $row ) : ?>
          <tr>
            <th scope="row"><?php echo esc_html( $row[0] ); ?></th>
            <?php foreach ( array( array( $row[1], $cva_col_us, 'cva-us' ), array( $row[2], $cva_col_agent, '' ) ) as $cell ) : list( $c, $col, $cls ) = $cell; ?>
            <td data-label="<?php echo esc_attr( $col ); ?>"<?php echo $cls ? ' class="' . $cls . '"' : ''; ?>>
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

<!-- ── WHAT EACH ROUTE COSTS: full-width card grid + matching "what we take off" panel ── -->
<?php
$cva_ico = array(
	'percent'  => '<path d="M19 5L5 19"/><circle cx="7" cy="7" r="2.5"/><circle cx="17" cy="17" r="2.5"/>',
	'wrench'   => '<path d="M14.7 6.3a4 4 0 00-5.4 5.4L4 17v3h3l5.3-5.3a4 4 0 005.4-5.4l-2.6 2.6-2.4-.6-.6-2.4 2.6-2.6z"/>',
	'receipt'  => '<path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3z"/><path d="M9 8h6M9 12h6"/>',
	'document' => '<path d="M14 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V8l-5-5z"/><path d="M14 3v5h5M9 13h6M9 17h4"/>',
	'calendar' => '<rect x="4" y="5" width="16" height="16" rx="2"/><path d="M8 3v4M16 3v4M4 10h16"/>',
);
$cva_costs = array(
	array( 'percent',  'Commission',     'Negotiable, and no Tennessee law sets the rate. Since August 2024, what you pay a buyer\'s agent is negotiated separately instead of posted on the MLS.' ),
	array( 'wrench',   'Repairs',        'Paint, cleaning and small fixes so the house shows well. A bad roof or a dead HVAC system can hold up a buyer\'s loan until it\'s fixed.' ),
	array( 'receipt',  'Repair credits', 'After the inspection, buyers usually ask for repairs or a credit at closing. It comes off after the price feels settled.' ),
	array( 'document', 'Closing costs',  'Your share of closing costs, plus your payoff and prorated taxes. Tennessee\'s transfer tax falls on the buyer by statute (TCA 67-4-409).' ),
	array( 'calendar', 'Holding costs',  'Mortgage, taxes, insurance and utilities keep running every month the house sits. None of it shows on the settlement statement.' ),
);
?>
<section class="section cva-section" id="costs">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Where the Money Goes</p>
      <h2 class="section__title">What Listing With an Agent Costs You</h2>
      <p class="section__subtitle">A good agent earns their fee: pricing from real sales, MLS exposure and negotiating. On the right house that brings a higher price. Here's what comes out of it before you see a check.</p>
    </div>
    <div class="cva-costs">
      <?php foreach ( $cva_costs as $cva_c ) : ?>
      <div class="cva-cost">
        <span class="cva-cost__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $cva_ico[ $cva_c[0] ]; ?></svg></span>
        <h3 class="cva-cost__title"><?php echo esc_html( $cva_c[1] ); ?></h3>
        <p class="cva-cost__text"><?php echo esc_html( $cva_c[2] ); ?></p>
      </div>
      <?php endforeach; ?>
      <div class="cva-cost cva-cost--note">
        <h3 class="cva-cost__title">Same either way</h3>
        <p class="cva-cost__text">Tennessee's disclosure law (TCA 66-5-201 and following) applies with or without an agent. Our <a href="<?php echo $cva_url( '/do-you-pay-closing-costs-when-you-sell-your-house-for-cash-in-tennessee/' ); ?>">closing costs guide</a> has the full list of seller costs.</p>
      </div>
    </div>

    <div class="cva-takeoff">
      <h2 class="cva-takeoff__title">What We Take Off the Price Instead</h2>
      <div class="cva-takeoff__grid">
        <div class="cva-takeoff__item">
          <h3>What our price covers</h3>
          <p>The repairs, the months we carry the house while we fix it, the cost of reselling it and the risk. Here's <a href="<?php echo $cva_url( '/how-do-cash-home-buyers-calculate-their-offer-in-tennessee/' ); ?>">how cash buyers calculate an offer</a>.</p>
        </div>
        <div class="cva-takeoff__item">
          <h3>What you get back</h3>
          <p>Speed and certainty. With no lender, a loan denial or a low appraisal can't sink the deal late. You do give up the chance of a bidding war.</p>
        </div>
        <div class="cva-takeoff__item">
          <h3>What we pay</h3>
          <p>All closing costs, with no fees and no commission. We <a href="<?php echo $cva_url( '/sell-house-as-is-tennessee/' ); ?>">buy as-is</a> and can close in as little as 7 days, about 30 typical. See <a href="<?php echo $cva_url( '/how-it-works/' ); ?>">how it works</a>.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── WHY HOMEOWNERS CHOOSE (shared section), on a gray band on this page ── -->
<div class="cva-diff">
<?php
get_template_part( 'difference-section', null, array(
	'audience' => 'Homeowners',
	'lead'     => 'When you call, you talk to us, not a call center or an out-of-state company. We have been buying houses in Maury County for 7+ years and have bought over 100 homes there.',
) );
?>
</div>

<!-- ── WHICH ROUTE FITS: two mirrored cards on one shared grid, then the 3 steps ── -->
<?php
$cva_tick = '<svg class="cva-tick" width="18" height="18" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
$cva_cards = array(
	array(
		'mod'   => '',
		'icon'  => '<path d="M5 21V3"/><path d="M5 5h14v9H5"/><path d="M9 9.5h6"/>',
		'title' => 'Listing with an agent is usually better when',
		'items' => array(
			'The house is move-in ready, with no major roof, foundation or system problems.',
			'Similar homes near you sell quickly to buyers using mortgages.',
			'You have a few months and can cover the payments while it\'s listed.',
			'You want the top price and don\'t mind showings and negotiating.',
			'The title is clean, with no liens, estate questions or tenants.',
		),
		'quote' => '&ldquo;&hellip;he was so honest to tell us that in our particular case, it would make more sense to sell with a traditional agent. He set us up with Chris, who we really like, and decided to go that route.&rdquo;',
		'by'    => 'JP J., Google review',
		'note'  => 'In a hot market with multiple offers, listing tends to win by more.',
		'links' => 'Listing guides: <a href="' . $cva_url( '/how-to-get-the-most-money-when-you-sell-your-house-in-tennessee/' ) . '">get the most money</a> &middot; <a href="' . $cva_url( '/how-long-does-it-take-to-sell-a-house-in-tennessee/' ) . '">how long it takes</a>',
	),
	array(
		'mod'   => ' cva-fit__card--us',
		'icon'  => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M9 15l2 2 4-4"/>',
		'title' => 'A cash sale usually makes more sense when',
		'items' => array(
			'The house needs repairs you can\'t afford or don\'t want to manage.',
			'You need to close by a certain date.',
			'You\'re carrying two payments, or the house is inherited or vacant.',
			'There are tenants in place.',
			'A listing already fell through or isn\'t getting the price you need.',
		),
		'quote' => '&ldquo;An elderly Columbia homeowner had lost her husband, and the house needed more repairs than she could afford. We worked closely with her son, handled the title still being in her late husband\'s name, and closed in about a month, as-is.&rdquo;',
		'by'    => 'One of our purchases in Columbia, September 2026',
		'note'  => 'In a slow market, or when time matters more than price, cash tends to win.',
		'links' => 'We buy in <a href="' . $cva_url( '/where-we-buy/nashville/' ) . '">Nashville</a> &middot; <a href="' . $cva_url( '/where-we-buy/murfreesboro/' ) . '">Murfreesboro</a> &middot; <a href="' . $cva_url( '/where-we-buy/clarksville/' ) . '">Clarksville</a> &middot; <a href="' . $cva_url( '/where-we-buy/' ) . '">all areas</a>',
	),
);
$cva_steps = array(
	array( 'Get an agent\'s net sheet', 'Ask two or three agents with a track record in your area for commission, closing costs, likely repairs and time on market, in writing.' ),
	array( 'Get a written cash offer', 'Make sure it says who pays closing costs and lists any fees or contingencies. Check the buyer\'s reviews.' ),
	array( 'Compare what you\'d walk away with', 'Put the two numbers side by side and go with what you keep, not the bigger sale price.' ),
);
$cva_guides = array(
	array( '/how-to-compare-two-cash-offers-tennessee/', 'How to Compare Two Cash Offers', 'What to check besides the price.' ),
	array( '/should-i-accept-a-cash-offer-for-my-house/', 'Should I Accept a Cash Offer for My House?', 'How to weigh an offer you already have.' ),
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
        <blockquote class="cva-quote">
          <p><?php echo $cva_card['quote']; ?></p>
          <footer><?php echo esc_html( $cva_card['by'] ); ?></footer>
        </blockquote>
        <p class="cva-fit__note"><?php echo esc_html( $cva_card['note'] ); ?></p>
        <p class="cva-fit__links"><?php echo $cva_card['links']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="cva-steps">
      <h3 class="cva-steps__title">Get Both Numbers in Writing</h3>
      <ol class="cva-steps__list">
        <?php foreach ( $cva_steps as $n => $cva_step ) : ?>
        <li class="cva-step">
          <span class="cva-step__num" aria-hidden="true"><?php echo (int) $n + 1; ?></span>
          <div class="cva-step__card">
            <span class="cva-step__title"><?php echo esc_html( $cva_step[0] ); ?></span>
            <span class="cva-step__text"><?php echo esc_html( $cva_step[1] ); ?></span>
          </div>
        </li>
        <?php endforeach; ?>
      </ol>

      <div class="cva-callout">
        <p class="cva-callout__title">It doesn't have to be one or the other</p>
        <p>In April 2026, a Columbia seller with a family emergency reached out to us together with her agent, because the listing wasn't getting the price she needed. We closed in under three weeks.</p>
      </div>

      <p class="cva-guides__label">Related guides</p>
      <div class="cva-guides">
        <?php foreach ( $cva_guides as $cva_g ) : ?>
        <a class="cva-guide" href="<?php echo $cva_url( $cva_g[0] ); ?>">
          <span class="cva-guide__title"><?php echo esc_html( $cva_g[1] ); ?></span>
          <span class="cva-guide__text"><?php echo esc_html( $cva_g[2] ); ?></span>
          <span class="cva-guide__arrow" aria-hidden="true">&rarr;</span>
        </a>
        <?php endforeach; ?>
      </div>

      <p class="cva-disclaimer">This page is general information, not legal or tax advice. For an estate, divorce or tax question, talk to a Tennessee attorney or CPA.</p>
    </div>
  </div>
</section>

<!-- ── FAQ ── -->
<section class="section section--alt cva-section" id="faq">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Common Questions</p>
      <h2 class="section__title">Cash Buyer vs Agent: Frequently Asked Questions</h2>
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
$cva_review_authors = array( 'JP JP', 'Josh Tully', 'Clayton Daniels', 'Kylie', 'Kayla Wright', 'Trish Haberman' );
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
  .cva-pill--good { background: var(--green-light); color: var(--green-dark); }
  .cva-pill--bad { background: #F7E9E7; color: #8F3B32; }
  .cva-pill--neutral { background: var(--bg-light); color: var(--charcoal); border: 1px solid var(--border); }
  .cva-cell__text { display: block; margin-top: 6px; font-size: 13px; color: var(--charcoal-light); }
  .cva-table tbody tr.cva-total th, .cva-table tbody tr.cva-total td { background: var(--green-light); font-weight: 700; color: var(--charcoal); border-top: 2px solid var(--green-dark); }
  .cva-table-note { max-width: 1080px; margin: 20px auto 0; text-align: center; color: var(--charcoal-light); font-size: 15px; }

  /* ── Photo after the short answer ── */
  .cva-photo-section { padding-top: 0; }
  .cva-photo { max-width: 1080px; margin: 0 auto; }
  .cva-photo img { display: block; width: 100%; height: 420px; object-fit: cover; object-position: 50% 55%; border-radius: 12px; box-shadow: var(--shadow); background: var(--bg-light); }
  .cva-photo figcaption { margin-top: 12px; text-align: center; font-size: 15px; color: var(--charcoal-light); }

  /* ── Reviews: line up with the content width ── */
  .cva-reviews .reviews-outer, .cva-reviews .carousel-controls, .cva-reviews .reviews-footnote { max-width: 1080px; margin-left: auto; margin-right: auto; }

  /* ── Shared "Why Homeowners Choose" section on a gray band ── */
  .cva-diff .difference-section--grid { background: var(--bg-light); }
  .cva-diff .difference-section--grid .difference__list li { background: var(--white); }

  /* ── Reviews on white: give the cards an edge ── */
  .cva-reviews .testimonial-card { border: 1px solid var(--border); box-shadow: var(--shadow); }

  /* ── Listing costs: full-width card grid ── */
  .cva-costs { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; max-width: 1080px; margin: 0 auto; }
  .cva-cost { background: var(--white); border: 1px solid var(--border); border-radius: 12px; padding: 24px; box-shadow: var(--shadow); }
  .cva-cost__icon { display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: 50%; background: var(--bg-light); color: var(--charcoal); margin-bottom: 14px; }
  .cva-cost__title { font-size: 18px; font-weight: 700; margin: 0 0 8px; }
  .cva-cost__text { margin: 0; color: var(--charcoal-light); line-height: 1.6; }
  .cva-cost--note { background: var(--bg-light); box-shadow: none; display: flex; flex-direction: column; justify-content: center; }
  .cva-cost a, .cva-takeoff a { color: var(--green-dark); font-weight: 600; text-decoration: underline; text-underline-offset: 2px; }
  .cva-takeoff { max-width: 1080px; margin: 28px auto 0; background: var(--green-light); border: 1px solid var(--green); border-radius: 12px; padding: 32px; }
  .cva-takeoff__title { font-size: clamp(22px, 2.6vw, 28px); font-weight: 700; margin: 0 0 20px; }
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
  .cva-checks { grid-row: span 5; display: grid; grid-template-rows: subgrid; list-style: none; margin: 0; padding: 20px 24px 8px; }
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
  .cva-steps { max-width: 1080px; margin: 40px auto 0; }
  .cva-steps__title { font-size: clamp(22px, 2.6vw, 28px); font-weight: 700; margin: 0 0 24px; text-align: center; }
  .cva-steps__list { position: relative; list-style: none; margin: 0 0 28px; padding: 0; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
  .cva-steps__list::before { content: ""; position: absolute; top: 22px; left: calc(100% / 6); right: calc(100% / 6); height: 2px; background: var(--green); z-index: 0; }
  .cva-step { position: relative; z-index: 1; display: flex; flex-direction: column; align-items: center; }
  .cva-step__num { display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: 50%; background: var(--green-dark); color: var(--white); font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 18px; box-shadow: 0 0 0 6px var(--white); margin-bottom: 16px; }
  .cva-step__card { flex: 1; width: 100%; background: var(--white); border: 1px solid var(--border); border-radius: 12px; padding: 22px; text-align: center; box-shadow: var(--shadow); }
  .cva-step__title { display: block; font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--charcoal); margin-bottom: 8px; }
  .cva-step__text { display: block; line-height: 1.6; color: var(--charcoal-light); }
  .cva-callout { background: var(--bg-light); border-left: 4px solid var(--green-dark); border-radius: 0 12px 12px 0; padding: 18px 22px; margin-bottom: 28px; }
  .cva-callout p { margin: 0; line-height: 1.65; color: var(--charcoal); }
  .cva-callout .cva-callout__title { font-family: 'Poppins', sans-serif; font-weight: 700; margin-bottom: 6px; }
  .cva-guides__label { font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--green-dark); margin: 0 0 12px; }
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

  @media (max-width: 1024px) {
    .cva-layout { grid-template-columns: 1fr; gap: 28px; }
    .cva-main { max-width: none; }
  }

  /* ── Phones: each row becomes a stacked card ── */
  @media (max-width: 768px) {
    .cva-table-wrap { background: none; border: 0; border-radius: 0; box-shadow: none; overflow: visible; }
    .cva-table, .cva-table tbody, .cva-table tr, .cva-table th, .cva-table td { display: block; width: 100%; }
    .cva-table colgroup, .cva-table thead { display: none; }
    .cva-table tbody tr { background: var(--white); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; margin-bottom: 14px; box-shadow: var(--shadow); }
    .cva-table tbody tr th { background: var(--bg-light) !important; color: var(--charcoal); border-top: 0; padding: 12px 18px; font-size: 16px; }
    .cva-table tbody tr td { background: var(--white) !important; padding: 14px 18px; border-top: 1px solid var(--border); border-left: 0; border-right: 0; }
    .cva-table tbody tr td.cva-us { background: color-mix(in srgb, var(--green-light) 40%, var(--white)) !important; border: 0; border-left: 4px solid var(--green-dark); }
    .cva-table tbody td::before { content: attr(data-label); display: block; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--charcoal-light); margin-bottom: 8px; }
    .cva-table tbody td.cva-us::before { color: var(--green-dark); }
    .cva-table tbody tr.cva-total th { background: var(--green-dark) !important; color: var(--white); }
    .cva-table tbody tr.cva-total td { font-weight: 700; }
    .cva-costs, .cva-takeoff__grid, .cva-guides { grid-template-columns: 1fr; }
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
    .cva-photo img { height: 240px; }
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
