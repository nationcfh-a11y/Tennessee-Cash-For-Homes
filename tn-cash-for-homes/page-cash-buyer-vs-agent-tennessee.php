<?php
/**
 * Template Name: Cash Buyer vs Agent
 * Template for /cash-buyer-vs-agent-tennessee/ (also assigned to the page directly).
 * Standalone comparison page: selling to Tennessee Cash For Homes vs
 * listing with an agent. Copy rule: no em or en dashes anywhere.
 * Table, example, and FAQ content live in the arrays below so the desktop
 * tables, the phone cards, and the FAQPage schema all come from one source.
 * The worked examples never state an offer price: they show what a listing
 * costs and the break-even cash offer (owner's decision, Nov 16 2026).
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

/* Worked examples: EXAMPLE NUMBERS ONLY. A listing net sheet, then the cash
   offer it would take to match it (listing net plus one month of holding
   costs while a cash sale closes). We never state what we would offer. */
$cva_examples = array(
	array(
		'id'    => 'example-1',
		'title' => 'Example 1: A Move-In Ready House',
		'intro' => 'A house that would sell for $300,000 on the open market, with $1,500 a month in payments while it is listed.',
		'rows'  => array(
			array( 'Sale price',                          '$300,000' ),
			array( 'Repairs and prep',                    'minus $8,000' ),
			array( 'Agent commission (5 percent here)',   'minus $15,000' ),
			array( 'Your closing costs',                  'minus $2,500' ),
			array( 'Repair credit after inspection',      'minus $4,000' ),
			array( 'Holding costs (4 months)',            'minus $6,000' ),
		),
		'net'   => '$264,500',
		'even'  => '$266,000',
		'means' => 'Anything above that beats the listing, after the one month of payments you would still make while a cash sale closes.',
		'after' => 'On a move-in ready house where you have time to wait, listing usually wins. If that is your house, I will tell you so.',
	),
	array(
		'id'    => 'example-2',
		'title' => 'Example 2: A House That Needs Major Repairs',
		'intro' => 'The same house, but it is only worth $300,000 after a $40,000 roof and HVAC replacement. That takes about 2 months, then 4 more to sell and close. Inherited houses that sit empty often look like this.',
		'rows'  => array(
			array( 'Sale price after repairs',            '$300,000' ),
			array( 'Roof and HVAC before listing',        'minus $40,000' ),
			array( 'Agent commission (5 percent here)',   'minus $15,000' ),
			array( 'Your closing costs',                  'minus $2,500' ),
			array( 'Repair credit after inspection',      'minus $4,000' ),
			array( 'Holding costs (6 months)',            'minus $9,000' ),
		),
		'net'   => '$229,500',
		'even'  => '$231,000',
		'means' => 'Anything above that beats fixing it up and listing, after the one month of payments you would still make while a cash sale closes.',
		'after' => 'Even when the numbers are close, a lot of sellers choose cash here. Listing means paying $40,000 out of pocket before the house hits the market, carrying six months of payments, and counting on a contractor to finish on time and on budget. A cash sale skips all of that and closes on a date you pick.',
	),
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
        <p>I'm Karson, and <a href="<?php echo $cva_url( '/' ); ?>">Tennessee Cash For Homes</a> buys houses for cash, so you know where I stand. We still tell people to list when that's the better move. One of those sellers left a review further down this page.</p>
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
    <p class="cva-table-note">Your mortgage payoff and any liens come out of the sale either way. The <a href="#examples">examples below</a> show how the rest adds up.</p>
  </div>
</section>

<!-- ── WHAT EACH ROUTE COSTS (the one sticky offer card lives here) ── -->
<section class="section cva-section">
  <div class="container">
    <div class="cva-layout">
      <div class="cva-main">
        <p class="section__eyebrow">Where the Money Goes</p>
        <h2 class="section__title">What Listing With an Agent Costs You</h2>
        <p>A good agent earns their fee. They price the house from real sales, get it in front of every buyer on the MLS and handle the negotiating. On the right house, that gets you a higher price.</p>
        <p>Here's what comes out of that price before you see a check.</p>
        <p><strong>Commission.</strong> It's negotiable, and no Tennessee law sets the rate. Since August 2024, what you pay a buyer's agent is negotiated separately instead of posted on the MLS, so get both sides in writing.</p>
        <p><strong>Repairs.</strong> Most houses need paint, cleaning and small fixes to show well. A bad roof, foundation movement or a dead HVAC system can hold up a buyer's loan until it's fixed.</p>
        <p><strong>Repair credits.</strong> After the inspection, buyers usually ask for repairs or a credit at closing. That comes off your number after you thought the price was settled.</p>
        <p><strong>Closing costs.</strong> You pay your share, plus your payoff and prorated property taxes. Tennessee's transfer tax (37 cents per $100, TCA 67-4-409) falls on the buyer unless the contract says otherwise. Our <a href="<?php echo $cva_url( '/do-you-pay-closing-costs-when-you-sell-your-house-for-cash-in-tennessee/' ); ?>">closing costs guide</a> has the full list.</p>
        <p><strong>Holding costs.</strong> Every month the house sits, you keep paying the mortgage, taxes, insurance and utilities. None of that shows up on the settlement statement.</p>
        <p>One thing is the same either way: Tennessee's disclosure law (TCA 66-5-201 and following) applies whether or not you use an agent.</p>

        <h2 class="section__title cva-subtitle">What We Take Off the Price Instead</h2>
        <p>We don't charge commission, but our offer is below retail for real reasons. It covers the repairs, the months we carry the house while we fix it, the cost of reselling it and the risk. Here's <a href="<?php echo $cva_url( '/how-do-cash-home-buyers-calculate-their-offer-in-tennessee/' ); ?>">how cash buyers calculate an offer</a>, step by step.</p>
        <p>What you get back is speed and certainty. With no lender, a loan denial or a low appraisal can't sink the deal late. You do give up the chance of a bidding war.</p>
        <p>We buy as-is, charge no fees and pay all closing costs. We can close in as little as 7 days, and about 30 is typical. You can see each step on our <a href="<?php echo $cva_url( '/how-it-works/' ); ?>">how it works</a> page.</p>
      </div>
      <aside class="cva-side">
        <div class="cva-sticky">
          <div class="cva-offer-card">
            <p class="cva-offer-card__title">Get Your Cash Offer</p>
            <p class="cva-offer-card__text">Free, no obligation, usually within 24 hours. Put it next to any agent's net sheet.</p>
            <a href="#get-offer" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</a>
            <a href="tel:+16158018126" class="cva-offer-card__phone">Or call (615) 801-8126</a>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ── WORKED EXAMPLES: listing net sheet + what a cash offer would need to be ── -->
<section class="section section--alt cva-section" id="examples">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Run the Numbers</p>
      <h2 class="section__title">What You'd Actually Walk Away With</h2>
      <p class="section__subtitle">Example numbers to show the math, not a quote or Tennessee averages.</p>
    </div>

    <?php foreach ( $cva_examples as $ex ) : ?>
    <div class="cva-example" id="<?php echo esc_attr( $ex['id'] ); ?>">
      <h3 class="cva-example__title"><?php echo esc_html( $ex['title'] ); ?></h3>
      <p class="cva-example__intro"><?php echo esc_html( $ex['intro'] ); ?></p>
      <div class="cva-example__grid">
        <table class="cva-net">
          <caption>Listing with an agent</caption>
          <tbody>
            <?php foreach ( $ex['rows'] as $i => $r ) : ?>
            <tr<?php echo 0 === $i ? ' class="cva-net__start"' : ''; ?>>
              <th scope="row"><?php echo esc_html( $r[0] ); ?></th>
              <td><?php echo esc_html( $r[1] ); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="cva-net__total">
              <th scope="row">What you'd walk away with by listing</th>
              <td><?php echo esc_html( $ex['net'] ); ?></td>
            </tr>
          </tbody>
        </table>
        <div class="cva-result">
          <p class="cva-result__label">To match this, a cash offer would need to be about</p>
          <p class="cva-result__number"><?php echo esc_html( $ex['even'] ); ?></p>
          <p class="cva-result__text"><?php echo esc_html( $ex['means'] ); ?></p>
        </div>
      </div>
      <p class="cva-example__after"><?php echo esc_html( $ex['after'] ); ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ── WHY HOMEOWNERS CHOOSE (shared section), framed to the content width ── -->
<section class="section cva-section cva-diff">
  <div class="container">
    <div class="cva-diff__frame">
      <?php
      get_template_part( 'difference-section', null, array(
          'audience' => 'Homeowners',
          'lead'     => 'When you call, you talk to us, not a call center or an out-of-state company. We have been buying houses in Maury County for 7+ years and have bought over 100 homes there.',
      ) );
      ?>
    </div>
  </div>
</section>

<!-- ── WHICH ROUTE FITS + HOW TO COMPARE ── -->
<section class="section section--alt cva-section">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Which One Fits</p>
      <h2 class="section__title">When Each Option Is the Better Choice</h2>
    </div>
    <div class="cva-fit">
      <div class="cva-fit__card">
        <h3 class="cva-fit__title">Listing with an agent is usually better when</h3>
        <ul>
          <li>The house is move-in ready, with no major roof, foundation or system problems.</li>
          <li>Similar homes near you sell quickly to buyers using mortgages.</li>
          <li>You have a few months and can cover the payments while it's listed.</li>
          <li>You want the top price and don't mind showings and negotiating.</li>
          <li>The title is clean, with no liens, estate questions or tenants.</li>
        </ul>
        <p>If that's you, interview two or three agents and ask each for a written net sheet. Our guide on <a href="<?php echo $cva_url( '/how-to-get-the-most-money-when-you-sell-your-house-in-tennessee/' ); ?>">getting the most money for your house</a> is a good place to start.</p>
      </div>
      <div class="cva-fit__card cva-fit__card--us">
        <h3 class="cva-fit__title">A cash sale usually makes more sense when</h3>
        <ul>
          <li>The house needs repairs you can't afford or don't want to manage.</li>
          <li>You need to close by a certain date.</li>
          <li>You're carrying two payments, or the house is inherited or vacant.</li>
          <li>There are tenants in place.</li>
          <li>A listing already fell through or isn't getting the price you need.</li>
        </ul>
        <p>In September 2026 we bought a house in Columbia from a widow whose home needed more repairs than she could afford. We worked with her son, handled the title still being in her late husband's name, and closed in about a month, as-is.</p>
        <p>See how we <a href="<?php echo $cva_url( '/sell-house-as-is-tennessee/' ); ?>">buy houses as-is</a> in <a href="<?php echo $cva_url( '/where-we-buy/nashville/' ); ?>">Nashville</a>, <a href="<?php echo $cva_url( '/where-we-buy/murfreesboro/' ); ?>">Murfreesboro</a>, <a href="<?php echo $cva_url( '/where-we-buy/clarksville/' ); ?>">Clarksville</a> and the rest of the <a href="<?php echo $cva_url( '/where-we-buy/' ); ?>">areas we serve</a>.</p>
      </div>
    </div>
    <div class="cva-compare-how">
      <h3 class="cva-fit__title">Get Both Numbers in Writing</h3>
      <p>Ask an agent for a net sheet that includes commission, closing costs, likely repairs and time on market. Ask any cash buyer for a written offer that says who pays closing costs. Then compare what you'd walk away with.</p>
      <p>It doesn't have to be one or the other. In April 2026, a Columbia seller with a family emergency called us together with her agent, because the listing wasn't getting the price she needed. We closed in under three weeks.</p>
      <p>Holding more than one cash offer? Here's <a href="<?php echo $cva_url( '/how-to-compare-two-cash-offers-tennessee/' ); ?>">how to compare two cash offers</a>. Weighing one now? Read <a href="<?php echo $cva_url( '/should-i-accept-a-cash-offer-for-my-house/' ); ?>">should I accept a cash offer</a>. For an estate, divorce or tax question, talk to a Tennessee attorney or CPA. This page is general information, not legal or tax advice.</p>
    </div>
  </div>
</section>

<!-- ── FAQ ── -->
<section class="section cva-section" id="faq">
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
<section class="section section--alt cva-section cva-reviews" id="testimonials">
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
  .cva-main p:not(.section__eyebrow) { font-size: 17px; line-height: 1.75; margin-bottom: 18px; color: var(--charcoal); }
  .cva-main a, .cva-table-note a, .cva-fit a, .cva-section .faq-answer a { color: var(--green-dark); font-weight: 600; text-decoration: underline; text-underline-offset: 2px; }
  .cva-subtitle { margin-top: 48px; }
  .cva-answer { background: var(--green-light); border-left: 4px solid var(--green-dark); border-radius: 0 12px 12px 0; padding: 20px 24px; margin: 8px 0 24px; }
  .cva-answer p { margin: 0; font-weight: 500; }
  .cva-side { height: 100%; }
  .cva-sticky { position: sticky; top: 110px; }
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
  .cva-table--example td { font-variant-numeric: tabular-nums; }
  .cva-table tbody tr.cva-total th, .cva-table tbody tr.cva-total td { background: var(--green-light); font-weight: 700; color: var(--charcoal); border-top: 2px solid var(--green-dark); }
  .cva-table-note { max-width: 1080px; margin: 20px auto 0; text-align: center; color: var(--charcoal-light); font-size: 15px; }

  /* ── Worked examples: listing net sheet + result card ── */
  .cva-example { max-width: 1080px; margin: 0 auto 48px; }
  .cva-example:last-child { margin-bottom: 0; }
  .cva-example__title { font-size: 24px; font-weight: 700; margin-bottom: 8px; }
  .cva-example__intro { max-width: 760px; color: var(--charcoal-light); font-size: 16px; line-height: 1.65; margin-bottom: 20px; }
  .cva-example__grid { display: grid; grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr); gap: 24px; align-items: center; }
  .cva-net { width: 100%; border-collapse: collapse; background: var(--white); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow); font-size: 16px; font-variant-numeric: tabular-nums; }
  .cva-net caption { caption-side: top; text-align: left; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 15px; color: var(--charcoal); background: var(--bg-light); border: 1px solid var(--border); border-bottom: 0; border-radius: 12px 12px 0 0; padding: 14px 22px; }
  .cva-net { border-radius: 0 0 12px 12px; }
  .cva-net th, .cva-net td { padding: 13px 22px; border-top: 1px solid var(--border); text-align: left; font-weight: 400; color: var(--charcoal); }
  .cva-net td { text-align: right; white-space: nowrap; }
  .cva-net tr:first-child th, .cva-net tr:first-child td { border-top: 0; font-weight: 700; }
  .cva-net .cva-net__total th, .cva-net .cva-net__total td { font-family: 'Poppins', sans-serif; font-weight: 700; background: var(--bg-light); border-top: 2px solid var(--charcoal); }
  .cva-result { display: flex; flex-direction: column; justify-content: center; background: var(--green-light); border: 2px solid var(--green-dark); border-radius: 12px; padding: 28px 26px; }
  .cva-result p { margin: 0; }
  .cva-result__label { font-size: 16px; font-weight: 600; color: var(--charcoal); }
  .cva-result__number { font-family: 'Poppins', sans-serif; font-size: 44px; font-weight: 700; color: var(--green-dark); line-height: 1.1; margin: 8px 0 12px !important; }
  .cva-result__text { font-size: 15px; line-height: 1.6; color: var(--charcoal); }
  .cva-example__after { max-width: 760px; margin-top: 20px; font-size: 17px; line-height: 1.7; color: var(--charcoal); }

  /* ── Get both numbers in writing ── */
  .cva-compare-how { max-width: 1080px; margin: 28px auto 0; background: var(--white); border: 1px solid var(--border); border-radius: 12px; padding: 32px; }
  .cva-compare-how p { max-width: 820px; line-height: 1.7; color: var(--charcoal); margin-bottom: 14px; }
  .cva-compare-how p:last-child { margin-bottom: 0; }
  .cva-compare-how a { color: var(--green-dark); font-weight: 600; text-decoration: underline; text-underline-offset: 2px; }

  /* ── Photo after the short answer ── */
  .cva-photo-section { padding-top: 0; }
  .cva-photo { max-width: 1080px; margin: 0 auto; }
  .cva-photo img { display: block; width: 100%; height: 420px; object-fit: cover; object-position: 50% 55%; border-radius: 12px; box-shadow: var(--shadow); background: var(--bg-light); }
  .cva-photo figcaption { margin-top: 12px; text-align: center; font-size: 15px; color: var(--charcoal-light); }

  /* ── Reviews: line up with the content width ── */
  .cva-reviews .reviews-outer, .cva-reviews .carousel-controls, .cva-reviews .reviews-footnote { max-width: 1080px; margin-left: auto; margin-right: auto; }

  /* ── Shared "Why Homeowners Choose" section, framed to the content width ── */
  .cva-diff__frame { max-width: 1080px; margin: 0 auto; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow); }
  .cva-diff .difference-section { display: block; min-height: 0; padding-top: 0 !important; }
  .cva-diff .difference__img-wrap { margin: 0 !important; }
  .cva-diff .difference__img-wrap img { width: 100%; height: 420px; object-fit: cover; object-position: 50% 22%; }
  .cva-diff .difference__content-wrap { display: block; padding: 40px 44px; }
  .cva-diff .difference__content { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); column-gap: 48px; align-items: start; max-width: none; }
  .cva-diff .difference__title { grid-column: 1; grid-row: 1; }
  .cva-diff .difference__intro { grid-column: 1; grid-row: 2; }
  .cva-diff .difference__trust-row { grid-column: 1; grid-row: 3; }
  .cva-diff .difference__list { grid-column: 2; grid-row: 1 / span 2; margin-top: 8px; }
  .cva-diff .chamber-badges { grid-column: 2; grid-row: 3; }

  /* ── Fit cards ── */
  .cva-fit { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; max-width: 1080px; margin: 0 auto; }
  .cva-fit__card { background: var(--white); border: 1px solid var(--border); border-radius: 12px; padding: 32px; }
  .cva-fit__card--us { border-color: var(--green); box-shadow: var(--shadow); }
  .cva-fit__title { font-size: 20px; font-weight: 700; margin-bottom: 16px; }
  .cva-fit ul { margin: 0 0 18px 20px; padding: 0; }
  .cva-fit li { margin-bottom: 10px; line-height: 1.6; list-style: disc; }
  .cva-fit p { line-height: 1.7; color: var(--charcoal-light); margin: 0; }
  .cva-fit p + p { margin-top: 12px; }

  @media (max-width: 1024px) {
    .cva-layout { grid-template-columns: 1fr; gap: 28px; }
    .cva-main { max-width: none; }
    .cva-side .cva-sticky { display: none; }
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
    .cva-fit { grid-template-columns: 1fr; }
    .cva-fit__card { padding: 24px; }
    .cva-main p:not(.section__eyebrow) { font-size: 16px; }
    .cva-table tbody tr:last-child td.cva-us { border-bottom: 0; }
    .cva-example__title { font-size: 21px; }
    .cva-example__grid { grid-template-columns: 1fr; }
    .cva-net, .cva-net tbody, .cva-net tr { display: table; width: 100%; }
    .cva-net tbody { display: table-row-group; }
    .cva-net tr { display: table-row; }
    .cva-net th, .cva-net td { padding: 12px 16px; font-size: 15px; }
    .cva-result__number { font-size: 38px; }
    .cva-compare-how { padding: 24px; }
    .cva-diff .difference__content-wrap { padding: 28px 22px; }
    .cva-diff .difference__img-wrap img { height: 240px; }
    .cva-diff .difference__content { display: block; }
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
