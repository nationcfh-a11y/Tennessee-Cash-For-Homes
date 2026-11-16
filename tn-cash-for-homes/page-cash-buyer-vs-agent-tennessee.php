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

/* Worked examples. EXAMPLE NUMBERS ONLY. Our column never states a price. */
$cva_examples = array(
	array(
		'id'    => 'example-1',
		'title' => 'Example 1: A House in Good Condition',
		'intro' => 'A move-in ready house that would sell for $300,000 on the open market after light preparation. Holding costs are $1,500 a month.',
		'rows'  => array(
			array( 'Sale price',                       'Your written offer',     '$300,000' ),
			array( 'Repairs and preparation',          '$0',                     'minus $8,000' ),
			array( 'Commission (example 5 percent)',   '$0',                     'minus $15,000' ),
			array( 'Seller closing costs',             '$0 (we pay them)',       'minus $2,500' ),
			array( 'Repair credit after inspection',   '$0',                     'minus $4,000' ),
			array( 'Holding costs',                    'minus $1,500 (1 month)', 'minus $6,000 (4 months)' ),
		),
		'net'   => array( 'Your offer minus $1,500', '$264,500' ),
		'even'  => '$266,000',
		'after' => 'On a house in this shape, a cash offer will often come in below that number, which is why listing usually comes out ahead here. If your house is move-in ready and you can wait, an agent is likely the better route.',
	),
	array(
		'id'    => 'example-2',
		'title' => 'Example 2: A House That Needs Major Repairs',
		'intro' => 'The same $300,000 house, but it is only worth that after an example $40,000 in repairs, such as a roof and HVAC system. Fixing it takes 2 months before it can be listed, then 4 months to sell and close. An inherited house sitting vacant often looks like this too.',
		'rows'  => array(
			array( 'Sale price',                       'Your written offer (as-is)', '$300,000 (after repairs)' ),
			array( 'Repairs before listing',           '$0',                         'minus $40,000' ),
			array( 'Commission (example 5 percent)',   '$0',                         'minus $15,000' ),
			array( 'Seller closing costs',             '$0 (we pay them)',           'minus $2,500' ),
			array( 'Repair credit after inspection',   '$0',                         'minus $4,000' ),
			array( 'Holding costs',                    'minus $1,500 (1 month)',     'minus $9,000 (6 months)' ),
		),
		'net'   => array( 'Your offer minus $1,500', '$229,500' ),
		'even'  => '$231,000',
		'after' => 'The bar a cash offer has to clear is $35,000 lower than in example 1, and that is before the risks no table can price: repair bids that run over, a contractor who falls behind, months of paying for a house nobody lives in, or a buyer who walks after inspection.',
	),
);

$cva_faqs = array(
	array( 'Is it better to sell my house for cash or list it with a realtor in Tennessee?',
		'It depends on your house and your timeline. If the home is in good condition and you can wait a few months, listing with an agent usually nets more. If it needs major repairs, you need a firm closing date, or you cannot carry the costs of a long sale, a cash sale often leaves you with as much or more once every cost is counted.' ),
	array( 'How much less is a cash offer than market value?',
		'There is no fixed percentage. A cash offer reflects the house\'s value after repairs, minus the repair costs, holding costs, resale costs, and the buyer\'s margin. The worse the condition, the larger the gap. The useful comparison is your net from the cash offer against your net from a listing, not the offer against the list price.' ),
	array( 'How long does it take to sell a house with an agent compared to a cash buyer?',
		'A listing takes however long it takes to find a buyer, plus the buyer\'s loan closing period, which often adds up to a few months. We can close in as little as 7 days, and about 30 days is typical, because there is no loan to approve. Our guide on <a href="' . $cva_url( '/how-long-does-it-take-to-sell-a-house-in-tennessee/' ) . '">how long it takes to sell a house in Tennessee</a> breaks down each stage.' ),
	array( 'Who pays the transfer tax when I sell my house in Tennessee?',
		'Tennessee\'s statute (TCA Section 67-4-409) places the realty transfer tax, 37 cents per $100 of the price or value, whichever is greater, on the buyer. That is the same whether you list or sell for cash, though a contract can assign costs differently, so read yours closely.' ),
	array( 'Do I still have to fill out a disclosure form if I sell to a cash buyer?',
		'Usually, yes. Tennessee\'s disclosure law applies whether or not an agent is involved. You give the buyer the residential property disclosure unless an exemption applies or the buyer waives it in writing and accepts a disclaimer statement. See our guide to <a href="' . $cva_url( '/selling-as-is-in-tennessee-disclosure-requirements/' ) . '">Tennessee disclosure rules when selling as-is</a>.' ),
	array( 'Can I get a cash offer and still list my house with an agent?',
		'Yes. Our cash offer is free and does not commit you to anything. Many sellers get one first so they have a real number to compare against an agent\'s net sheet. If you have already signed a listing agreement, check its terms with your agent before selling to anyone directly.' ),
	array( 'Will I pay Tennessee state tax on the profit from selling my house?',
		'No. Tennessee does not tax the profit from a home sale. Federal capital gains rules can still apply whichever way you sell. Our guide on <a href="' . $cva_url( '/do-i-have-to-pay-taxes-on-money-made-from-selling-my-home-a-guide-for-tennessee-homeowners/' ) . '">taxes when you sell a home in Tennessee</a> explains the federal exclusion. Confirm your own situation with a CPA.' ),
);

/* Sidebar cash offer card (sticky on desktop, hidden on phones where the hero form and final CTA cover it). */
$cva_offer_card = function () {
	?>
	<div class="cva-offer-card">
	  <p class="cva-offer-card__title">Get Your Cash Offer</p>
	  <p class="cva-offer-card__text">Free, no obligation, usually within 24 hours. Compare it against any listing.</p>
	  <a href="#get-offer" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</a>
	  <a href="tel:+16158018126" class="cva-offer-card__phone">Or call (615) 801-8126</a>
	</div>
	<?php
};

get_header(); ?>

<!-- ── HERO ── -->
<section class="hero" id="hero-form">
  <div class="hero__overlay"></div>
  <div class="container">
    <div class="hero__inner">
      <div class="hero__content">
        <nav class="breadcrumb">
          <a href="<?php echo $cva_url( '/' ); ?>">Home</a>
          <span>&rsaquo;</span>
          <span>Cash Buyer vs Agent</span>
        </nav>
        <h1 class="hero__title">
          <span class="hero__title--white">Cash Buyer vs Agent</span>
          <span class="hero__title--green"> in Tennessee</span>
        </h1>
        <p class="hero__subtitle">An honest side by side look at costs, repairs, timeline, certainty, and what you actually keep, including when listing with an agent is the better choice.</p>
        <div class="hero__cta-row">
          <a href="#get-offer" class="hero__btn-primary">Get My Cash Offer</a>
          <a href="#compare" class="hero__btn-outline">See the Comparison</a>
        </div>
        <div class="hero__trust-row">
          <?php foreach ( array( 'No Agent Fees', 'We Pay Closing Costs', 'Any Condition' ) as $cva_trust ) : ?>
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <?php echo esc_html( $cva_trust ); ?>
          </span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="hero__form-card" id="get-offer">
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
          <p>Selling to a cash buyer usually means a lower price, but no commission, no repairs, no showings, and a closing in days or weeks instead of months. Listing with an agent usually brings a higher price for a house in good condition, but commission, repairs, concessions, and months of holding costs come out of that price, and a financed deal can still fall through. Compare the net amount you keep, not the headline price.</p>
        </div>
        <p>If you own a house in Tennessee and need to sell, you have two main paths: list it on the open market with a real estate agent, or sell it directly to a cash buyer. Both are legitimate, and both are the right answer for some homeowners. We are <a href="<?php echo $cva_url( '/' ); ?>">Tennessee Cash For Homes</a>, a cash buyer, so you know where we stand. We will still tell you when an agent will net you more.</p>
        <p>When you list, you are selling to a retail buyer, usually someone who will live in the house and pay with a mortgage. That sale depends on the buyer's loan approval, a home inspection, and an appraisal that supports the price. When you sell to us, we pay with our own funds, so there is no lender, no loan approval, and no lender appraisal. A retail buyer pays more because they are buying a finished home. A cash buyer pays less because they take on the repairs, holding costs, resale costs, and risk. What matters is what is left for you at the closing table.</p>
      </div>
      <aside class="cva-side">
        <div class="cva-takeaways">
          <p class="cva-takeaways__title">Key Takeaways</p>
          <ul>
            <li>Listing usually brings a higher price on a move-in ready house.</li>
            <li>A cash sale skips commission, repairs, showings, and closing costs.</li>
            <li>The more repairs and months a listing needs, the better a cash sale looks.</li>
            <li>Compare what you keep, not the headline price.</li>
          </ul>
        </div>
      </aside>
    </div>
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
    <p class="cva-table-note">Your mortgage payoff and any liens are paid from the sale either way. Which route nets more depends on condition, repairs, and time, as the <a href="#examples">worked examples</a> show.</p>
  </div>
</section>

<!-- ── WHAT EACH ROUTE COSTS ── -->
<section class="section cva-section">
  <div class="container">
    <div class="cva-layout">
      <div class="cva-main">
        <p class="section__eyebrow">Where the Money Goes</p>
        <h2 class="section__title">What Listing With an Agent Really Costs in Tennessee</h2>
        <p>A good agent earns their fee. They price from recent comparable sales, put your home in front of every buyer searching the MLS, handle negotiation, and know the paperwork. For the right house, that work produces a higher price. But several costs come out of that price before you see it.</p>
        <p><strong>Commission.</strong> Commission is negotiable, and no Tennessee law sets a rate. Since August 2024, under the national rule changes that followed the National Association of Realtors settlement, offers to pay the buyer's agent are no longer posted on the MLS and are negotiated separately, so ask any listing agent to explain in writing what you will pay on both sides.</p>
        <p><strong>Repairs and preparation.</strong> Most listed homes need cleaning, paint, and small fixes to show well. Bigger problems such as a failing roof, foundation movement, or a dead HVAC system can block a buyer's financing until they are fixed.</p>
        <p><strong>Concessions after inspection.</strong> Once you are under contract, the buyer's inspection often leads to a request for repairs or a credit at closing. That money comes off your net even after you thought the price was settled.</p>
        <p><strong>Closing costs.</strong> You will usually pay your share of closing costs along with your mortgage payoff and prorated property taxes. Under Tennessee Code Annotated Section 67-4-409(a), the state realty transfer tax of 37 cents per $100 is placed on the buyer, though a contract can shift costs. Our guide to <a href="<?php echo $cva_url( '/do-you-pay-closing-costs-when-you-sell-your-house-for-cash-in-tennessee/' ); ?>">closing costs when you sell for cash in Tennessee</a> covers the full list.</p>
        <p><strong>Holding costs.</strong> Every month the house sits, you keep paying mortgage interest, property taxes, insurance, utilities, and upkeep. These never show up on the settlement statement, but they come out of your pocket just the same.</p>
        <p>One thing does not change between the two routes: Tennessee's disclosure law. The Tennessee Residential Property Disclosure Act (TCA Section 66-5-201 and the sections after it) applies to the sale of a one to four unit home whether or not an agent is involved.</p>

        <h2 class="section__title cva-subtitle">What a Cash Buyer Takes Off the Price Instead</h2>
        <p>A cash buyer does not charge commission, but the offer is lower than retail for real reasons: it covers the repairs you are not making, the months of holding costs while the house is renovated and resold, the resale costs, and a margin for the risk. To see that math step by step, read <a href="<?php echo $cva_url( '/how-do-cash-home-buyers-calculate-their-offer-in-tennessee/' ); ?>">how cash home buyers calculate their offer in Tennessee</a>.</p>
        <p>In exchange, you get speed, simplicity, and certainty. There is no staging, no open house, and no waiting on a buyer's lender, which removes the two most common ways a listed sale dies late: a loan that is not approved and an appraisal that comes in low. The trade off is real, too. You are not exposing the house to every buyer on the open market, so you give up the chance of a bidding war.</p>
        <p>We buy houses as-is, charge no commissions or fees, pay all closing costs, and can close in as little as 7 days, with about 30 days being typical. You can see each step on our <a href="<?php echo $cva_url( '/how-it-works/' ); ?>">how it works</a> page.</p>
      </div>
      <aside class="cva-side">
        <div class="cva-sticky"><?php $cva_offer_card(); ?></div>
      </aside>
    </div>
  </div>
</section>

<!-- ── WORKED EXAMPLES ── -->
<section class="section section--alt cva-section" id="examples">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Run the Numbers</p>
      <h2 class="section__title">Two Worked Examples With Example Numbers</h2>
      <p class="section__subtitle">These are example numbers only. They are not real deals, not quotes, and not Tennessee averages. Each one shows what a listing costs and the break-even point: the cash offer at which both routes leave you with the same amount.</p>
    </div>

    <?php foreach ( $cva_examples as $ex ) : ?>
    <div class="cva-example" id="<?php echo esc_attr( $ex['id'] ); ?>">
      <div class="cva-example__head">
        <span class="cva-example__tag">Example numbers</span>
        <h3 class="cva-example__title"><?php echo esc_html( $ex['title'] ); ?></h3>
        <p class="cva-example__intro"><?php echo esc_html( $ex['intro'] ); ?></p>
      </div>
      <div class="cva-table-wrap">
        <table class="cva-table cva-table--example">
          <colgroup><col class="cva-col-factor"><col class="cva-col-option"><col class="cva-col-option"></colgroup>
          <thead>
            <tr>
              <th scope="col">Example line item</th>
              <th scope="col" class="cva-us">Selling to <?php echo esc_html( $cva_col_us ); ?></th>
              <th scope="col"><?php echo esc_html( $cva_col_agent ); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $ex['rows'] as $r ) : ?>
            <tr>
              <th scope="row"><?php echo esc_html( $r[0] ); ?></th>
              <td class="cva-us" data-label="<?php echo esc_attr( $cva_col_us ); ?>"><?php echo esc_html( $r[1] ); ?></td>
              <td data-label="<?php echo esc_attr( $cva_col_agent ); ?>"><?php echo esc_html( $r[2] ); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="cva-total">
              <th scope="row">Example net before mortgage payoff</th>
              <td class="cva-us" data-label="<?php echo esc_attr( $cva_col_us ); ?>"><?php echo esc_html( $ex['net'][0] ); ?></td>
              <td data-label="<?php echo esc_attr( $cva_col_agent ); ?>"><?php echo esc_html( $ex['net'][1] ); ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="cva-breakeven">
        <p class="cva-breakeven__line">Break-even: a cash offer above about <strong><?php echo esc_html( $ex['even'] ); ?></strong> nets you more than this listing. Below that, the listing comes out ahead.</p>
        <p><?php echo esc_html( $ex['after'] ); ?></p>
      </div>
    </div>
    <?php endforeach; ?>

    <p class="cva-table-note">The mortgage payoff and prorated property taxes are left out of both examples because they are the same either way. Run the same math with an agent's written net sheet and a written cash offer for your own house.</p>
  </div>
</section>

<!-- ── WHICH ROUTE FITS ── -->
<section class="section cva-section">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">An Honest Answer</p>
      <h2 class="section__title">When Each Option Is the Better Choice</h2>
    </div>
    <div class="cva-fit">
      <div class="cva-fit__card">
        <h3 class="cva-fit__title">Listing with an agent is usually better when</h3>
        <ul>
          <li>The house is move-in ready or close to it, with no major roof, foundation, or system problems.</li>
          <li>Similar homes in your neighborhood sell quickly to buyers using mortgages.</li>
          <li>You have several months and can comfortably cover the payments while it is listed.</li>
          <li>Your top priority is the highest possible price, and you are fine with showings and negotiation.</li>
          <li>The title is clean, with no liens, estate questions, or tenants to work around.</li>
        </ul>
        <p>If that describes you, interview two or three agents, ask each for a written net sheet, and negotiate the commission. If we look at your house and think a listing will net you more, we will tell you. Start with our guide on <a href="<?php echo $cva_url( '/how-to-get-the-most-money-when-you-sell-your-house-in-tennessee/' ); ?>">how to get the most money when you sell your house in Tennessee</a>.</p>
      </div>
      <div class="cva-fit__card cva-fit__card--us">
        <h3 class="cva-fit__title">A cash sale usually makes more sense when</h3>
        <ul>
          <li>The house needs repairs you cannot afford or do not want to manage.</li>
          <li>You need to close by a specific date.</li>
          <li>You are carrying two house payments, or the home is inherited or vacant.</li>
          <li>There are tenants in place.</li>
          <li>A previous listing already fell through.</li>
        </ul>
        <p>In those cases the commission is not the biggest cost. Time, repairs, and uncertainty are. See how we <a href="<?php echo $cva_url( '/sell-house-as-is-tennessee/' ); ?>">buy houses as-is in Tennessee</a>, including in <a href="<?php echo $cva_url( '/where-we-buy/nashville/' ); ?>">Nashville</a>, <a href="<?php echo $cva_url( '/where-we-buy/murfreesboro/' ); ?>">Murfreesboro</a>, and <a href="<?php echo $cva_url( '/where-we-buy/clarksville/' ); ?>">Clarksville</a>, or see every area on our <a href="<?php echo $cva_url( '/where-we-buy/' ); ?>">where we buy</a> page.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── HOW TO DECIDE ── -->
<section class="section section--alt cva-section">
  <div class="container">
    <div class="cva-layout">
      <div class="cva-main">
        <p class="section__eyebrow">Making the Call</p>
        <h2 class="section__title">How to Decide Between an Agent and a Cash Buyer</h2>
        <p>Four questions settle most decisions. First, your timeline: do you need to be done by a certain date, or can you wait for the market? Second, your finances: can you cover payments, repairs, and concessions for several months? Third, the condition of the house: will it pass a buyer's inspection and a lender's appraisal as it is? Fourth, the local market: are similar homes near you selling quickly, or sitting?</p>
        <p>Then get real numbers for both routes. Ask an agent for a written net sheet that includes commission, closing costs, and a realistic estimate of repairs and time on market. Ask any cash buyer for a written offer that states who pays closing costs and whether there are fees. Research any buyer before you sign, and if you get more than one cash offer, our guide on <a href="<?php echo $cva_url( '/how-to-compare-two-cash-offers-tennessee/' ); ?>">how to compare two cash offers</a> shows what to look for. If you are weighing an offer you already have, read <a href="<?php echo $cva_url( '/should-i-accept-a-cash-offer-for-my-house/' ); ?>">should I accept a cash offer for my house</a>.</p>
        <p>Talk with a Tennessee real estate attorney or your CPA if your situation involves an estate, a divorce, or tax questions. This page is general information, not legal or tax advice.</p>
      </div>
      <aside class="cva-side">
        <div class="cva-sticky"><?php $cva_offer_card(); ?></div>
      </aside>
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

<!-- ── CTA ── -->
<section class="section section--alt cva-section">
  <div class="container">
    <div class="section__header section__header--center cva-cta">
      <p class="section__eyebrow">Ready to Compare?</p>
      <h2 class="section__title">Get a Real Number to Put Next to a Listing</h2>
      <p class="section__subtitle">We will look at your property and give you a fair, no obligation cash offer, usually within 24 hours. No commissions, no repairs, no fees, and you pick the closing date.</p>
      <a href="#get-offer" class="btn-primary">Get My Cash Offer &rarr;</a>
    </div>
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
  .cva-takeaways { background: var(--white); border: 1px solid var(--border); border-top: 4px solid var(--green-dark); border-radius: 12px; padding: 24px; box-shadow: 0 4px 16px rgba(0,0,0,.06); }
  .cva-takeaways__title, .cva-offer-card__title { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 18px; margin-bottom: 12px; color: var(--charcoal); }
  .cva-takeaways ul { margin: 0; padding: 0; list-style: none; }
  .cva-takeaways li { position: relative; padding-left: 26px; margin-bottom: 12px; font-size: 15px; line-height: 1.55; }
  .cva-takeaways li::before { content: ""; position: absolute; left: 0; top: 3px; width: 16px; height: 16px; border-radius: 50%; background: var(--green-dark) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M6 12.5l4 4L18 8.5' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") center/12px no-repeat; }
  .cva-offer-card { background: var(--charcoal); color: var(--white); border-radius: 14px; padding: 26px 24px; box-shadow: 0 8px 24px rgba(0,0,0,.15); }
  .cva-offer-card__title { color: var(--white); }
  .cva-offer-card__text { font-size: 15px; line-height: 1.55; color: #e5e5e5; margin-bottom: 18px; }
  .cva-offer-card__phone { display: block; text-align: center; margin-top: 14px; color: var(--green); font-weight: 600; font-size: 15px; }
  .cva-cta .btn-primary { display: inline-block; }

  /* ── Tables ── */
  .cva-table-wrap { max-width: 1080px; margin: 0 auto; background: var(--white); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,.06); }
  .cva-table { width: 100%; border-collapse: collapse; table-layout: fixed; font-size: 15px; line-height: 1.45; }
  .cva-col-factor { width: 24%; }
  .cva-col-option { width: 38%; }
  .cva-table thead th { background: #4B5563; color: var(--white); font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 16px; text-align: left; padding: 18px 24px; vertical-align: middle; }
  .cva-table thead th:first-child { background: var(--charcoal); }
  .cva-table thead th.cva-us { background: var(--green-dark); }
  .cva-badge { display: block; width: max-content; margin-top: 6px; background: var(--white); color: var(--green-dark); font-size: 12px; font-weight: 700; letter-spacing: .02em; padding: 3px 10px; border-radius: 999px; }
  .cva-table tbody th, .cva-table tbody td { padding: 16px 24px; border-top: 1px solid var(--border); text-align: left; vertical-align: middle; }
  .cva-table tbody th { font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--charcoal); }
  .cva-table tbody tr:nth-child(even) th, .cva-table tbody tr:nth-child(even) td { background: #f7f7f7; }
  .cva-table tbody td.cva-us { background: #EFF8F2; border-left: 2px solid var(--green); border-right: 2px solid var(--green); }
  .cva-table tbody tr:nth-child(even) td.cva-us { background: #E5F3EA; }
  .cva-table tbody tr:last-child td.cva-us { border-bottom: 2px solid var(--green); }
  .cva-pill { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 999px; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 14px; line-height: 1.3; }
  .cva-pill--good { background: #D6EFDF; color: #1F6B43; }
  .cva-pill--bad { background: #F7E9E7; color: #8F3B32; }
  .cva-pill--neutral { background: #E9EDF2; color: #374151; }
  .cva-cell__text { display: block; margin-top: 6px; font-size: 13px; color: #6B7280; }
  .cva-table--example td { font-variant-numeric: tabular-nums; }
  .cva-table tbody tr.cva-total th, .cva-table tbody tr.cva-total td { background: var(--green-light); font-weight: 700; color: var(--charcoal); border-top: 2px solid var(--green-dark); }
  .cva-table-note { max-width: 1080px; margin: 20px auto 0; text-align: center; color: var(--charcoal-light); font-size: 15px; }

  /* ── Worked examples ── */
  .cva-example { max-width: 1080px; margin: 0 auto 56px; }
  .cva-example__head { max-width: 760px; margin-bottom: 20px; }
  .cva-example__tag { display: inline-block; background: #FFF4D6; color: #7A5A00; font-size: 12px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; padding: 4px 10px; border-radius: 6px; margin-bottom: 10px; }
  .cva-example__title { font-size: 24px; font-weight: 700; margin-bottom: 8px; }
  .cva-example__intro { color: var(--charcoal-light); font-size: 16px; line-height: 1.65; }
  .cva-breakeven { background: var(--white); border: 1px solid var(--border); border-left: 4px solid var(--green-dark); border-radius: 0 12px 12px 0; padding: 18px 22px; margin-top: 18px; }
  .cva-breakeven p { font-size: 15px; line-height: 1.65; color: var(--charcoal-light); margin: 0; }
  .cva-breakeven .cva-breakeven__line { font-size: 17px; color: var(--charcoal); margin-bottom: 8px; }
  .cva-breakeven strong { color: var(--green-dark); }

  /* ── Fit cards ── */
  .cva-fit { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; max-width: 1080px; margin: 0 auto; }
  .cva-fit__card { background: var(--white); border: 1px solid var(--border); border-radius: 14px; padding: 32px; }
  .cva-fit__card--us { border-color: var(--green); box-shadow: 0 4px 16px rgba(47,133,90,.10); }
  .cva-fit__title { font-size: 20px; font-weight: 700; margin-bottom: 16px; }
  .cva-fit ul { margin: 0 0 18px 20px; padding: 0; }
  .cva-fit li { margin-bottom: 10px; line-height: 1.6; list-style: disc; }
  .cva-fit p { line-height: 1.7; color: var(--charcoal-light); margin: 0; }

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
    .cva-table tbody tr { background: var(--white); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; margin-bottom: 14px; box-shadow: 0 2px 10px rgba(0,0,0,.05); }
    .cva-table tbody tr th { background: var(--charcoal) !important; color: var(--white); border-top: 0; padding: 12px 18px; font-size: 16px; }
    .cva-table tbody tr td { background: var(--white) !important; padding: 14px 18px; border-top: 1px solid var(--border); border-left: 0; border-right: 0; }
    .cva-table tbody tr td.cva-us { background: #EFF8F2 !important; border: 0; border-left: 4px solid var(--green-dark); }
    .cva-table tbody td::before { content: attr(data-label); display: block; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: #6B7280; margin-bottom: 8px; }
    .cva-table tbody td.cva-us::before { color: var(--green-dark); }
    .cva-table tbody tr.cva-total th { background: var(--green-dark) !important; }
    .cva-table tbody tr.cva-total td { font-weight: 700; }
    .cva-fit { grid-template-columns: 1fr; }
    .cva-fit__card { padding: 24px; }
    .cva-main p:not(.section__eyebrow) { font-size: 16px; }
    .cva-table tbody tr:last-child td.cva-us { border-bottom: 0; }
    .cva-example__title { font-size: 21px; }
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
