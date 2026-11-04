<?php
/**
 * Shared Market Stats section for city and county pages.
 *
 * Every figure comes from market-stats-data.php, which
 * market-stats/build_market_stats.py generates from Redfin, Zillow, and the
 * U.S. Census Bureau. Each card prints its own source and period, and a card
 * that uses county figures for a city says so. Nothing here is hand-entered.
 *
 * Expected variables before include:
 *   $ms_name  – display name ("Davidson County" or "Nashville")
 *   $ms_slug  – lookup key in the data file (e.g. "davidson-county" or "nashville")
 *   $ms_type  – "county" or "city"
 */

$ms_data_file = get_template_directory() . '/market-stats-data.php';
if ( ! file_exists( $ms_data_file ) ) return;

$ms_all = include $ms_data_file;
if ( empty( $ms_all['pages'][ $ms_slug ]['cards'] ) ) return;

$ms_cards = $ms_all['pages'][ $ms_slug ]['cards'];
$ms_by    = array_column( $ms_cards, null, 'key' );

// When every card is county data (Antioch, Old Hickory), say so once under the
// heading instead of on all eight cards.
$ms_scopes    = array_unique( array_map( function( $c ) { return isset( $c['scope'] ) ? $c['scope'] : ''; }, $ms_cards ) );
$ms_all_scope = ( 1 === count( $ms_scopes ) && '' !== reset( $ms_scopes ) ) ? reset( $ms_scopes ) : '';
?>

<!-- ── MARKET STATS ── -->
<section class="section market-overview" id="market-stats">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow"><?php echo esc_html( $ms_name ); ?> Housing Market</p>
      <h2 class="section__title"><?php echo esc_html( $ms_name ); ?> Real Estate Market Overview</h2>
    </div>
    <p class="market-overview__intro">Here is the <?php echo esc_html( $ms_name ); ?> housing market in the latest public data from Redfin, Zillow, and the U.S. Census Bureau. Each figure shows its source and the period it covers.</p>
    <p class="market-overview__updated">Updated <?php echo esc_html( $ms_all['updated'] ); ?></p>
    <?php if ( $ms_all_scope ) : ?>
    <p class="market-overview__scope-note">Figures for <?php echo esc_html( $ms_name ); ?> are <?php echo esc_html( $ms_all_scope ); ?>.</p>
    <?php endif; ?>

    <div class="market-overview__grid">
      <?php foreach ( $ms_cards as $ms_card ) : ?>
      <div class="market-card">
        <div class="market-card__value"><?php echo esc_html( $ms_card['value'] ); ?></div>
        <div class="market-card__label"><?php echo esc_html( $ms_card['label'] ); ?></div>
        <?php if ( ! empty( $ms_card['change'] ) ) : ?>
        <div class="market-card__change"><?php echo esc_html( $ms_card['change'] ); ?></div>
        <?php endif; ?>
        <?php if ( ! empty( $ms_card['scope'] ) && ! $ms_all_scope ) : ?>
        <div class="market-card__scope"><?php echo esc_html( $ms_card['scope'] ); ?></div>
        <?php endif; ?>
        <p class="market-card__source"><?php echo esc_html( $ms_card['source'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="market-overview__closing">Market figures describe typical homes. If yours needs work, or you need a firm closing date, a cash sale to Tennessee Cash For Homes takes the listing, the repairs, and the buyer's financing out of the picture.</p>
  </div>
</section>

<?php
// FAQ schema built only from figures shown above, with their sources.
$ms_faq = array();
if ( isset( $ms_by['median_sale_price'] ) ) {
    $c = $ms_by['median_sale_price'];
    $ms_faq[] = array(
        'q' => "What is the median home sale price in {$ms_name}?",
        'a' => "The median sale price in {$ms_name} was {$c['value']}" . ( ! empty( $c['scope'] ) ? " ({$c['scope']})" : '' ) . '. ' . $c['source'] . '.',
    );
}
if ( isset( $ms_by['median_dom'] ) ) {
    $c = $ms_by['median_dom'];
    $ms_faq[] = array(
        'q' => "How long do homes take to sell in {$ms_name}?",
        'a' => "The median home in {$ms_name} spent {$c['value']} on the market" . ( ! empty( $c['scope'] ) ? " ({$c['scope']})" : '' ) . '. ' . $c['source'] . '. Tennessee Cash For Homes can make a cash offer in 24 hours and close in as little as 7 days.',
    );
}
$ms_faq[] = array(
    'q' => "Can I sell my house fast for cash in {$ms_name}?",
    'a' => "Yes. Tennessee Cash For Homes buys houses in {$ms_name} for cash in any condition. We make fair offers within 24 hours, charge no fees or commissions, and can close in as little as 7 days.",
);
$ms_schema = array(
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map( function( $f ) {
        return array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
    }, $ms_faq ),
);
?>
<script type="application/ld+json"><?php echo wp_json_encode( $ms_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>

<style>
/* ── Market Stats Section ── */
.market-overview {
  padding: 64px 0 56px;
}
.market-overview__intro {
  max-width: 820px;
  margin: 0 auto 8px;
  text-align: center;
  font-size: 1.05rem;
  color: #555;
  line-height: 1.7;
}
.market-overview__updated {
  text-align: center;
  font-size: 13px;
  font-weight: 600;
  color: #2D6A4F;
  margin: 0 0 32px;
}
.market-overview__scope-note {
  text-align: center;
  font-size: 14px;
  font-weight: 600;
  color: #92400E;
  background: #FEF3C7;
  border-radius: 8px;
  padding: 8px 16px;
  max-width: 560px;
  margin: -16px auto 32px;
}
.market-overview__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-bottom: 40px;
}
.market-card {
  background: #fff;
  border: 1px solid #e8e8e8;
  border-radius: 12px;
  padding: 24px 20px 20px;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.market-card__value {
  font-size: 1.6rem;
  font-weight: 700;
  color: #1a1a1a;
  margin-bottom: 4px;
}
.market-card__label {
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: #4B5563;
  margin-bottom: 8px;
}
.market-card__change {
  font-size: 13px;
  font-weight: 600;
  color: #374151;
  background: #F3F4F6;
  border-radius: 12px;
  padding: 3px 10px;
  margin-bottom: 8px;
}
.market-card__scope {
  font-size: 12px;
  font-weight: 700;
  color: #92400E;
  background: #FEF3C7;
  border-radius: 12px;
  padding: 2px 10px;
  margin-bottom: 8px;
}
.market-card__source {
  font-size: 12px;
  color: #6B7280;
  line-height: 1.5;
  margin: auto 0 0;
  padding-top: 6px;
}
.market-overview__closing {
  max-width: 820px;
  margin: 0 auto;
  text-align: center;
  font-size: 1.05rem;
  color: #444;
  line-height: 1.7;
  font-weight: 500;
}

/* ── Responsive ── */
@media (max-width: 1024px) {
  .market-overview__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
  .market-overview__grid { grid-template-columns: 1fr; }
  .market-card__value { font-size: 1.35rem; }
}
</style>
