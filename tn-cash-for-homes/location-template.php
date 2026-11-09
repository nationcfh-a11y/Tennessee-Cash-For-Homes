<?php
/**
 * Shared display template for all city location pages.
 * Include this from each page-location-[slug].php after defining $city[].
 *
 * Required $city keys:
 *   slug, name, image_file, h1, meta_title, meta_desc,
 *   desc1, desc2, land_para
 *
 * Optional:
 *   hero_subtitle  plain text, replaces the default hero subtitle
 *   hero_link      [ 'url' => ..., 'text' => ... ], a text link under the subtitle
 */

$meta_title = ! empty( $city['meta_title'] ) ? $city['meta_title'] : '';
$meta_desc  = ! empty( $city['meta_desc'] )  ? $city['meta_desc']  : '';

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

// LocalBusiness JSON-LD for this city page.
$city_name_for_schema = $city['name'];
add_action( 'wp_head', function() use ( $city_name_for_schema ) {
    if ( ! function_exists( 'tcfh_build_localbusiness_schema' ) ) return;
    $schema = tcfh_build_localbusiness_schema( array(
        'area_served' => array( $city_name_for_schema, 'Tennessee' ),
    ) );
    tcfh_print_jsonld( $schema );
} );

get_header();

$slug         = $city['slug'];
$name         = $city['name'];
$h1           = $city['h1'];
$desc1        = $city['desc1'];
$desc2        = $city['desc2'];
$desc3        = ! empty( $city['desc3'] ) ? $city['desc3'] : '';
$land_para      = $city['land_para'];
$neighborhoods  = ! empty( $city['neighborhoods'] ) ? $city['neighborhoods'] : [];

$check20 = '<svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
?>

<?php
get_template_part( 'location-hero', null, array(
    'type'     => 'city',
    'slug'     => $slug,
    'name'     => $name,
    'h1'       => $h1,
    'subtitle' => ! empty( $city['hero_subtitle'] ) ? $city['hero_subtitle'] : '',
    'link'     => ! empty( $city['hero_link'] ) ? $city['hero_link'] : null,
    'id_prefix'=> 'loc',
) );
?>

<?php get_template_part('stats-strip'); ?>

<?php
// ── Market Stats Overview (inserted between stat bar and about section)
$ms_name = $name;
$ms_slug = $slug;
$ms_type = 'city';
include get_template_directory() . '/market-stats-section.php';

// ── The Tennessee Cash For Homes Difference (shared with the homepage)
get_template_part( 'difference-section', null, array( 'place' => $name ) );

include get_template_directory() . '/who-we-help-section.php';
?>

<!-- ── ABOUT [CITY] ── -->
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

        <?php if ( ! empty( $neighborhoods ) ) : ?>
        <div class="loc-about__pills">
          <?php foreach ( $neighborhoods as $_n ) : ?>
            <span class="loc-about__pill"><?php echo esc_html( $_n ); ?></span>
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
<section class="land-section">
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
// ── Reviews Section (shared partial used across county, city, foreclosure, and situation pages)
get_template_part( 'reviews-section' );

// ── FAQ Section
$faq_name  = $name;
$faq_extra = ! empty( $city['faq_extra'] ) ? $city['faq_extra'] : [];
include get_template_directory() . '/faq-section.php';

// ── Government Resources Section
$gov_name       = $name;
$gov_county_key = ! empty( $city['county'] ) ? $city['county'] : '';
$gov_type       = 'city';
include get_template_directory() . '/gov-resources-section.php';

// ── Nearby areas: 3 to 5 geographically close city pages, keyed by $city['slug'].
// Values are URL slugs (Mt. Juliet's page lives at /mount-juliet/).
$nearby_cities = tcfh_area_pages()['cities'];
$nearby_map = array(
    'nashville'      => array( 'brentwood', 'la-vergne', 'hendersonville', 'mount-juliet', 'franklin' ),
    'franklin'       => array( 'brentwood', 'spring-hill', 'nashville', 'columbia' ),
    'brentwood'      => array( 'franklin', 'nashville', 'spring-hill', 'smyrna' ),
    'spring-hill'    => array( 'columbia', 'franklin', 'brentwood', 'shelbyville' ),
    'columbia'       => array( 'spring-hill', 'franklin', 'shelbyville', 'dickson' ),
    'murfreesboro'   => array( 'smyrna', 'la-vergne', 'shelbyville', 'tullahoma', 'lebanon' ),
    'smyrna'         => array( 'la-vergne', 'murfreesboro', 'nashville', 'brentwood' ),
    'la-vergne'      => array( 'smyrna', 'murfreesboro', 'nashville', 'mount-juliet' ),
    'clarksville'    => array( 'springfield', 'dickson', 'nashville' ),
    'hendersonville' => array( 'gallatin', 'nashville', 'mount-juliet', 'springfield' ),
    'gallatin'       => array( 'hendersonville', 'lebanon', 'springfield', 'mount-juliet' ),
    'lebanon'        => array( 'mount-juliet', 'gallatin', 'murfreesboro', 'cookeville' ),
    'mt-juliet'      => array( 'lebanon', 'hendersonville', 'la-vergne', 'nashville' ),
    'springfield'    => array( 'clarksville', 'hendersonville', 'gallatin', 'nashville' ),
    'dickson'        => array( 'clarksville', 'franklin', 'columbia', 'nashville' ),
    'shelbyville'    => array( 'tullahoma', 'murfreesboro', 'columbia' ),
    'tullahoma'      => array( 'shelbyville', 'murfreesboro', 'columbia' ),
    'cookeville'     => array( 'lebanon', 'mount-juliet', 'murfreesboro' ),
);
$nearby = ! empty( $nearby_map[ $slug ] ) ? $nearby_map[ $slug ] : array();
?>

<?php if ( $nearby ) : ?>
<!-- ── NEARBY AREAS ── -->
<section class="section nearby-areas">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Near <?php echo esc_html( $name ); ?></p>
      <h2 class="section__title">Nearby Areas We Buy In</h2>
      <p class="section__subtitle">We also buy houses for cash in these communities near <?php echo esc_html( $name ); ?>.</p>
    </div>
    <div class="area-chips<?php echo 4 === count( $nearby ) ? ' area-chips--pairs' : ''; ?>">
      <?php foreach ( $nearby as $nearby_slug ) : ?>
        <?php echo tcfh_area_chip( $nearby_slug, $nearby_cities[ $nearby_slug ]['anchor'] ); ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_template_part( 'areas-we-serve' ); ?>


<style>
/* Hero styles: critical.css (above the fold, inlined in <head>). */

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
