<?php
/**
 * Shared display template for all county pages.
 * Include from each page-county-[slug].php after defining $county[].
 *
 * Required $county keys:
 *   slug, name, county_id (SVG path id), h1, meta_title, meta_desc,
 *   cities (array of ['name'=>'...','slug'=>'...','has_page'=>true/false]),
 *   desc1, desc2, land_para
 */

$meta_title = ! empty( $county['meta_title'] ) ? $county['meta_title'] : '';
$meta_desc  = ! empty( $county['meta_desc'] )  ? $county['meta_desc']  : '';

add_filter( 'pre_get_document_title', function( $title ) use ( $meta_title ) {
    if ( ! empty( $meta_title ) ) {
        return $meta_title;
    }
    return $title;
}, 99 );

// Store meta desc for the SEO function in functions.php
if ( $meta_desc ) {
    update_post_meta( get_the_ID(), '_tcfh_meta_desc', $meta_desc );
}

// LocalBusiness JSON-LD for this county page.
$county_name_for_schema = $county['name'];
add_action( 'wp_head', function() use ( $county_name_for_schema ) {
    if ( ! function_exists( 'tcfh_build_localbusiness_schema' ) ) return;
    $schema = tcfh_build_localbusiness_schema( array(
        'area_served' => array( $county_name_for_schema . ' County', 'Tennessee' ),
    ) );
    tcfh_print_jsonld( $schema );
} );

get_header();

$slug         = $county['slug'];
$name         = $county['name'];
$county_id    = $county['county_id'];
$h1           = $county['h1'];
$cities       = $county['cities'];
$desc1        = $county['desc1'];
$desc2        = $county['desc2'];
$desc3        = ! empty( $county['desc3'] ) ? $county['desc3'] : '';
$land_para    = $county['land_para'];

$check20 = '<svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
?>

<?php
get_template_part( 'location-hero', null, array(
    'type'     => 'county',
    'slug'     => $slug,
    'name'     => $name,
    'h1'       => $h1,
    'id_prefix'=> 'co',
) );
?>

<?php get_template_part('stats-strip'); ?>

<?php
// ── Market Stats Overview (inserted between stat bar and about section)
$ms_name = $name;
$ms_slug = $slug;
$ms_type = 'county';
include get_template_directory() . '/market-stats-section.php';

// ── The Tennessee Cash For Homes Difference (shared with the homepage)
get_template_part( 'difference-section', null, array( 'place' => $name ) );

include get_template_directory() . '/who-we-help-section.php';
?>

<!-- ── CITIES WE BUY IN ── -->
<?php if ( ! empty( $cities ) ) : ?>
<section class="section county-cities-section" style="background:#FFFFFF;">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow"><?php echo esc_html( $name ); ?></p>
      <h2 class="section__title">Cities We Buy Houses In</h2>
      <p class="section__subtitle">We purchase homes throughout <?php echo esc_html( $name ); ?>. Click your city to learn more.</p>
    </div>
    <div class="county-cities-grid">
      <?php foreach ( $cities as $city ) :
        $coming_soon = empty( $city['has_page'] );
        $city_url    = home_url( '/where-we-buy/' . $city['slug'] . '/' );
      ?>
      <?php if ( $coming_soon ) : ?>
      <span class="city-link-btn city-link-btn--coming-soon" data-coming-soon="true" aria-disabled="true">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
        <?php echo esc_html( $city['name'] ); ?>
        <span class="city-link-btn__soon">Soon</span>
      </span>
      <?php else : ?>
      <a href="<?php echo esc_url( $city_url ); ?>" class="city-link-btn">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
        <?php echo esc_html( $city['name'] ); ?>
      </a>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
include get_template_directory() . '/reviews-section.php';
?>

<!-- ── ABOUT [COUNTY] ── -->
<?php
$_parts = preg_split( '/(?<=[.!?])\s+/', $desc2, 3 );
$market_insight = isset( $_parts[0] ) ? $_parts[0] : '';
?>
<section class="section loc-about">
  <div class="container">
    <div class="loc-about__grid">

      <!-- LEFT COLUMN -->
      <div class="loc-about__left">
        <p class="section__eyebrow">We Buy Houses in <?php echo esc_html( $name ); ?></p>
        <h2 class="section__title"><?php echo esc_html( $h1 ); ?></h2>

        <p class="loc-about__lead"><?php echo esc_html( $desc1 ); ?></p>
        <p class="loc-about__body"><?php echo esc_html( $desc2 ); ?></p>

        <?php if ( $desc3 ) : ?>
        <div class="loc-about__more" id="loc-more-wrap">
          <div class="loc-about__more-body" id="loc-more-body">
            <p class="loc-about__body"><?php echo esc_html( $desc3 ); ?></p>
          </div>
          <button class="loc-about__toggle" id="loc-toggle" type="button" aria-expanded="false">
            <span class="loc-about__toggle-text">Read more</span>
            <svg class="loc-about__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
        </div>
        <?php endif; ?>

        <?php if ( ! empty( $cities ) ) : ?>
        <div class="loc-about__pills">
          <?php foreach ( $cities as $_c ) : ?>
            <span class="loc-about__pill"><?php echo esc_html( $_c['name'] ); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="loc-about__right">
        <div class="loc-about__insight">
          <span class="loc-about__insight-label">Market Insight</span>
          <p class="loc-about__insight-text"><?php echo esc_html( $market_insight ); ?></p>
        </div>

        <?php
        // Same figures as the Market Stats section (market-stats-data.php).
        $ms_price = tcfh_market_card( $slug, 'median_sale_price' );
        $ms_dom   = tcfh_market_card( $slug, 'median_dom' );
        $ms_sold  = tcfh_market_card( $slug, 'homes_sold' );
        ?>
        <?php if ( $ms_price ) : ?>
        <div class="loc-about__hero-stat">
          <span class="loc-about__hero-stat-value"><?php echo esc_html( $ms_price['value'] ); ?></span>
          <span class="loc-about__hero-stat-label">Median Sale Price</span>
        </div>
        <?php endif; ?>

        <div class="loc-about__mini-stats">
          <?php if ( $ms_dom ) : ?>
          <div class="loc-about__mini-card">
            <span class="loc-about__mini-value"><?php echo esc_html( (int) $ms_dom['value'] ); ?></span>
            <span class="loc-about__mini-label">Median Days on Market</span>
          </div>
          <?php endif; ?>
          <?php if ( $ms_sold ) : ?>
          <div class="loc-about__mini-card">
            <span class="loc-about__mini-value"><?php echo esc_html( $ms_sold['value'] ); ?></span>
            <span class="loc-about__mini-label">Homes Sold</span>
          </div>
          <?php endif; ?>
          <div class="loc-about__mini-card">
            <span class="loc-about__mini-value">7</span>
            <span class="loc-about__mini-label">Days to Close With Us</span>
          </div>
          <div class="loc-about__mini-card">
            <span class="loc-about__mini-value">$0</span>
            <span class="loc-about__mini-label">Fees &amp; Commissions</span>
          </div>
        </div>
        <?php if ( $ms_price || $ms_dom || $ms_sold ) : ?>
        <p class="loc-about__stat-source"><?php echo esc_html( tcfh_market_card_source( $ms_price ?: ( $ms_dom ?: $ms_sold ) ) ); ?></p>
        <?php endif; ?>

      </div>

    </div>
  </div>
</section>
<script>
(function(){
  var btn=document.getElementById('loc-toggle');if(!btn)return;
  var body=document.getElementById('loc-more-body');
  var txt=btn.querySelector('.loc-about__toggle-text');
  btn.addEventListener('click',function(){
    var open=body.classList.toggle('is-open');
    btn.setAttribute('aria-expanded',open);
    txt.textContent=open?'Read less':'Read more';
  });
})();
</script>

<!-- ── TRUST CARDS ── -->
<section class="section loc-trust-section">
  <div class="container">
    <div class="loc-about__cards">
      <div class="loc-trust-card">
        <div class="loc-trust-icon"><?php echo $check20; ?></div>
        <h3>No Repairs Needed</h3>
        <p>We buy houses as-is in any condition. Don&rsquo;t spend a dime fixing up your home.</p>
      </div>
      <div class="loc-trust-card">
        <div class="loc-trust-icon"><?php echo $check20; ?></div>
        <h3>Fast Cash Offer</h3>
        <p>Receive a fair, no-obligation cash offer within 24&ndash;48 hours.</p>
      </div>
      <div class="loc-trust-card">
        <div class="loc-trust-icon"><?php echo $check20; ?></div>
        <h3>Close on Your Timeline</h3>
        <p>We can close in as little as 7 days or on a date that works best for you.</p>
      </div>
      <div class="loc-trust-card">
        <div class="loc-trust-icon"><?php echo $check20; ?></div>
        <h3>Zero Fees or Commissions</h3>
        <p>No agent fees, no closing costs, no hidden charges. What we offer is what you get.</p>
      </div>
    </div>
  </div>
</section>

<?php
// ── Recent Homes We've Bought (only on pages listed in recent-homes-data.php)
$rh_slug = $slug;
$rh_name = $name;
include get_template_directory() . '/recent-homes-section.php';
?>

<!-- ── SELL YOUR LAND ── -->
<section class="land-section land-section--lazy">
  <div class="land-section__overlay"></div>
  <div class="container land-section__inner">
    <div class="land-section__content">
      <p class="section__eyebrow land-section__eyebrow"><?php echo esc_html( $name ); ?> Land Buyers</p>
      <h2 class="land-section__title">Sell Your Land in <?php echo esc_html( $name ); ?> for Cash</h2>
      <p class="land-section__body"><?php echo esc_html( $land_para ); ?></p>
      <ul class="land-section__list">
        <li><?php echo $check20; ?> Vacant lots, acreage, and rural land</li>
        <li><?php echo $check20; ?> Cash offer within 24 hours</li>
        <li><?php echo $check20; ?> Zero commissions or closing costs</li>
        <li><?php echo $check20; ?> Close on your timeline</li>
      </ul>
    </div>
    <div class="land-section__form-wrap">
      <div class="hero__form-card">
        <h2 class="form-card__title">Get Your Land Cash Offer</h2>
        <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
        <form onsubmit="handleSubmit(event)">
          <input type="hidden" name="lead_source" value="<?php echo esc_attr( $name ); ?>" />
          <div class="form-group">
            <label for="land-address-<?php echo esc_attr( $slug ); ?>">Property Address</label>
            <input type="text" id="land-address-<?php echo esc_attr( $slug ); ?>" name="address" placeholder="123 Acres Rd, <?php echo esc_attr( $name ); ?>, TN" required />
          </div>
          <div class="form-group">
            <label for="land-name-<?php echo esc_attr( $slug ); ?>">Your Name</label>
            <input type="text" id="land-name-<?php echo esc_attr( $slug ); ?>" name="name" placeholder="John Smith" required />
          </div>
          <div class="form-group">
            <label for="land-phone-<?php echo esc_attr( $slug ); ?>">Phone Number</label>
            <input type="tel" id="land-phone-<?php echo esc_attr( $slug ); ?>" name="phone" placeholder="(615) 555-0123" required />
          </div>
          <button type="submit" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</button>
        </form>
        <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
      </div>
    </div>
  </div>
</section>

<?php
// ── FAQ Section
$faq_name  = $name;
$faq_extra = ! empty( $county['faq_extra'] ) ? $county['faq_extra'] : [];
include get_template_directory() . '/faq-section.php';

// ── Government Resources Section
$gov_name       = $name;
$gov_county_key = str_replace( ' County', '', $name );
$gov_type       = 'county';
include get_template_directory() . '/gov-resources-section.php';
?>

<?php get_template_part( 'areas-we-serve', null, array( 'background' => 'white' ) ); ?>

<style>
/* Hero styles: critical.css (above the fold, inlined in <head>). */

/* ── City Link Buttons ── */
.county-cities-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
  margin-top: 32px;
}
.city-link-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 10px 18px;
  border-radius: 8px;
  border: 1.5px solid #84CC9C;
  background: rgba(132, 204, 156, 0.17);
  color: #2D6A4F;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  transition: background 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}
.city-link-btn:hover {
  background: #84CC9C;
  color: #fff;
  border-color: #84CC9C;
}
.city-link-btn--coming-soon {
  border-color: #ccc;
  background: rgba(0,0,0,0.04);
  color: #999;
  cursor: default;
}
.city-link-btn--coming-soon:hover {
  background: rgba(0,0,0,0.04);
  border-color: #ccc;
  color: #999;
}
.city-link-btn__soon {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  background: #ccc;
  color: #fff;
  padding: 2px 5px;
  border-radius: 4px;
  margin-left: 2px;
}
.city-link-btn:hover .city-link-btn__soon {
  background: rgba(255,255,255,0.3);
}

/* ── Land Section Overrides ── */
.land-section__overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.25);
  pointer-events: none;
}
.land-section__content {
  flex-direction: column;
  gap: 0;
}
.land-section__eyebrow {
  color: var(--green);
  margin-bottom: 12px;
}
.land-section__list {
  flex-direction: column;
  gap: 10px;
}
.land-section__list li {
  color: rgba(255,255,255,0.9);
  font-size: 15px;
  font-weight: 500;
  gap: 8px;
}
.land-section__list li svg {
  color: var(--green);
  flex-shrink: 0;
}

</style>

<?php get_footer(); ?>
