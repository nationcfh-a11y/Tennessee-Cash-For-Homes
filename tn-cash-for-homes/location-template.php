<?php
/**
 * Shared display template for all city location pages.
 * Include this from each page-location-[slug].php after defining $city[].
 *
 * Required $city keys:
 *   slug, name, image_file, h1, meta_title, meta_desc,
 *   median_price, homes_sold, avg_days,
 *   desc1, desc2, land_para
 */

$meta_title = ! empty( $city['meta_title'] ) ? $city['meta_title'] : '';
add_filter( 'pre_get_document_title', function( $title ) use ( $meta_title ) {
    if ( ! empty( $meta_title ) ) {
        return $meta_title;
    }
    return $title;
}, 99 );

get_header();

$slug         = $city['slug'];
$name         = $city['name'];
$h1           = $city['h1'];
$median_price = $city['median_price'];
$homes_sold   = $city['homes_sold'];
$avg_days     = $city['avg_days'];
$desc1        = $city['desc1'];
$desc2        = $city['desc2'];
$land_para    = $city['land_para'];
$county_slug  = ! empty( $city['county_slug'] ) ? $city['county_slug'] : '';

// Determine which SVG map to display: city SVG first, fall back to county SVG
$city_svg_path   = get_template_directory() . '/brand_assets/city-svgs/' . $slug . '.svg';
$county_svg_path = $county_slug ? get_template_directory() . '/brand_assets/county-svgs/' . $county_slug . '.svg' : '';
$map_svg_path    = '';
$map_label       = $name;

if ( file_exists( $city_svg_path ) ) {
    $map_svg_path = $city_svg_path;
    $map_label    = $name;
} elseif ( $county_svg_path && file_exists( $county_svg_path ) ) {
    $map_svg_path = $county_svg_path;
    $map_label    = str_replace( '-', ' ', ucwords( str_replace( '-county', ' County', $county_slug ), '- ' ) );
}
$has_map = ! empty( $map_svg_path );

$check18 = '<svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
$check20 = '<svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
?>

<!-- ── LOCATION HERO ── -->
<section class="county-hero">
  <div class="container">
    <div class="county-hero__inner">

      <!-- LEFT: Content + Trust -->
      <div class="county-hero__content">
        <nav class="breadcrumb">
          <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
          <span>&rsaquo;</span>
          <a href="<?php echo esc_url( home_url('/where-we-buy/') ); ?>">Where We Buy</a>
          <span>&rsaquo;</span>
          <span><?php echo esc_html( $name ); ?></span>
        </nav>
        <div class="hero__badge county-hero__badge"><?php echo esc_html( $name ); ?> Cash Home Buyers</div>
        <h1 class="county-hero__title"><?php echo esc_html( $h1 ); ?></h1>
        <p class="county-hero__subtitle">No repairs. No commissions. No fees. Get a fair cash offer for your <?php echo esc_html( $name ); ?> home in as little as 24 hours. We close on your timeline.</p>
        <div class="hero__trust county-hero__trust">
          <div class="hero__trust-item">
            <?php echo $check18; ?>
            Zero fees or commissions
          </div>
          <div class="hero__trust-item">
            <?php echo $check18; ?>
            Close in 7 days
          </div>
          <div class="hero__trust-item">
            <?php echo $check18; ?>
            Buy as-is, any condition
          </div>
          <div class="hero__trust-item">
            <svg width="18" height="18" fill="#FBBC05" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            5-Star Rated on Google
          </div>
          <div class="hero__trust-item">
            <a href='https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick' target='_blank' rel='nofollow' class='bbb-seal'><img src='https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png' style='border: 0;' alt='Tennessee Cash For Homes BBB Business Review' /></a>
          </div>
        </div>
        <div class="county-hero__cta-row">
          <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>" class="btn-primary">Get My Free Cash Offer &rarr;</a>
          <a href="tel:+16158018126" class="btn-outline">Call (615) 801-8126</a>
        </div>
      </div>

      <!-- RIGHT: Map + Form -->
      <div class="county-hero__map-col">
        <?php if ( $has_map ) : ?>
        <div class="county-map-hero-wrap">
          <div class="county-map-hero-svg">
            <?php echo file_get_contents( $map_svg_path ); ?>
          </div>
          <div class="county-map-label">
            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
            <?php echo esc_html( $map_label ); ?>, Tennessee
          </div>
        </div>
        <?php endif; ?>

        <!-- LEAD FORM -->
        <div class="hero__form-card county-hero__form" id="get-offer">
          <h2 class="form-card__title">Get Your Free Cash Offer</h2>
          <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
          <form onsubmit="handleSubmit(event)">
            <div class="form-group">
              <label for="loc-address-<?php echo esc_attr( $slug ); ?>">Property Address</label>
              <input type="text" id="loc-address-<?php echo esc_attr( $slug ); ?>" name="address" placeholder="123 Main St, <?php echo esc_attr( $name ); ?>, TN" required />
            </div>
            <div class="form-group">
              <label for="loc-name-<?php echo esc_attr( $slug ); ?>">Your Name</label>
              <input type="text" id="loc-name-<?php echo esc_attr( $slug ); ?>" name="name" placeholder="John Smith" required />
            </div>
            <div class="form-group">
              <label for="loc-phone-<?php echo esc_attr( $slug ); ?>">Phone Number</label>
              <input type="tel" id="loc-phone-<?php echo esc_attr( $slug ); ?>" name="phone" placeholder="(615) 555-0123" required />
            </div>
            <button type="submit" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</button>
          </form>
          <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
        </div>

      </div><!-- /.county-hero__map-col -->
    </div><!-- /.county-hero__inner -->
  </div>
</section>

<!-- ── MARKET STATS BAR ── -->
<div class="loc-stats-bar">
  <div class="container">
    <div class="loc-stats-bar__inner">
      <div class="loc-stat">
        <div class="loc-stat__num"><?php echo esc_html( $median_price ); ?></div>
        <div class="loc-stat__label">Median Sale Price</div>
      </div>
      <div class="loc-stat-divider"></div>
      <div class="loc-stat">
        <div class="loc-stat__num"><?php echo esc_html( $homes_sold ); ?></div>
        <div class="loc-stat__label">Homes Sold</div>
      </div>
      <div class="loc-stat-divider"></div>
      <div class="loc-stat">
        <div class="loc-stat__num"><?php echo esc_html( $avg_days ); ?> Days</div>
        <div class="loc-stat__label">Avg Days on Market</div>
      </div>
    </div>
  </div>
</div>

<!-- ── ABOUT [CITY] ── -->
<section class="section loc-about">
  <div class="container">
    <div class="loc-about__inner">
      <div class="loc-about__content">
        <p class="section__eyebrow">We Buy Houses in <?php echo esc_html( $name ); ?></p>
        <h2 class="section__title">Sell Your <?php echo esc_html( $name ); ?> House Fast for Cash</h2>
        <p class="loc-about__body"><?php echo esc_html( $desc1 ); ?></p>
        <p class="loc-about__body"><?php echo esc_html( $desc2 ); ?></p>
        <a href="/#hero-form" class="btn-primary">Get My Free Cash Offer &rarr;</a>
      </div>
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
  </div>
</section>

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

<!-- ── AREAS WE SERVE ── -->
<section class="section section--alt">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Statewide Coverage</p>
      <h2 class="section__title">Areas We Serve Across Tennessee</h2>
      <p class="section__subtitle">We buy houses throughout the entire state of Tennessee. Whether you are in a major metro or a small town, we can make you a cash offer.</p>
    </div>
    <div class="cities-grid">
      <a href="<?php echo esc_url( home_url('/where-we-buy/nashville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Nashville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/murfreesboro') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Murfreesboro</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/knoxville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Knoxville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/memphis') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Memphis</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/clarksville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Clarksville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/chattanooga') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Chattanooga</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/franklin') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Franklin</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/shelbyville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Shelbyville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/antioch') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Antioch</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/smyrna') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Smyrna</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/la-vergne') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>La Vergne</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/gallatin') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Gallatin</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/columbia') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Columbia</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/spring-hill') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Spring Hill</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/lebanon') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Lebanon</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/jackson') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Jackson</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/hendersonville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Hendersonville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/crossville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Crossville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/mcminnville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>McMinnville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/old-hickory') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Old Hickory</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/woodbury') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Woodbury</span></a>
    </div>
    <p class="areas-footnote">Don&rsquo;t see your city? We serve <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>">all of Tennessee</a>. Contact us for your cash offer today.</p>
  </div>
</section>

<!-- ── GOOGLE REVIEWS ── -->
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
            <p class="testimonial-body">Had a great experience with these guys. I worked with Karson, Davis and Dowling and we got creative to make a couple transactions go through. They are very experienced and I would definitely work with them again!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">SS</div>
              <div>
                <div class="testimonial-name">Sam Skare</div>
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
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Great experience working with these guys. The whole process went super fast and easy. Both Davis and Dowling were true to their word, which is very important when doing business. I would work with them again any day.</p>
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
            <p class="testimonial-body">The best to work with yet. Answered every question and very supportive! 10/10 recommend. Timely responses, very knowledgeable, and professional. Can't go wrong!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">KB</div>
              <div>
                <div class="testimonial-name">Kelsie Balfour</div>
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
            <p class="testimonial-body">They bought my father's rental portfolio! Paid cash and closed on multiple homes in less than 3 weeks. Incredibly smooth from start to finish. Would not hesitate to work with them again.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">DA</div>
              <div>
                <div class="testimonial-name">Dowling Armstrong</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Really enjoyed working with Tennessee Cash For Homes. They helped me sell my house in Clarksville fast for cash! Highly recommend working with them.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">BT</div>
              <div>
                <div class="testimonial-name">Blake Thompson</div>
                <div class="testimonial-location">Clarksville, TN</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">You won't find a better group to do business with. Honest, fast, and easy!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">DH</div>
              <div>
                <div class="testimonial-name">Drew Holliday</div>
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

<style>
/* ── City/Location Hero (matches county hero layout) ── */
.county-hero {
  background: #F2F2F2;
  padding: 60px 0 48px;
}
.county-hero__inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: start;
}
.county-hero__badge {
  display: inline-block;
  background: rgba(132, 204, 156, 0.2);
  color: #2D6A4F;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  padding: 6px 14px;
  border-radius: 20px;
  margin-bottom: 16px;
}
.county-hero__title {
  font-size: clamp(1.5rem, 3vw, 2.25rem);
  font-weight: 700;
  color: #1a1a1a;
  line-height: 1.2;
  margin: 0 0 16px;
}
.county-hero__subtitle {
  font-size: 1rem;
  color: #555;
  margin: 0 0 20px;
  line-height: 1.6;
}
.county-hero__trust {
  margin-bottom: 24px;
}
.county-hero__cta-row {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}
.county-hero__map-col {
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.county-hero__form {
  margin-top: 0;
}
.breadcrumb {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  color: #888;
  margin-bottom: 16px;
}
.breadcrumb a {
  color: #2D6A4F;
  text-decoration: none;
}
.breadcrumb a:hover { text-decoration: underline; }

/* ── Map Hero SVG ── */
.county-map-hero-wrap {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
}
.county-map-hero-svg {
  width: 100%;
  max-width: 460px;
  border-radius: 12px;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 4px 24px rgba(0,0,0,0.08);
  padding: 12px;
}
.county-map-hero-svg svg {
  width: 100%;
  height: auto;
  display: block;
  pointer-events: none;
}
.county-map-label {
  font-size: 13px;
  font-weight: 600;
  color: #2D6A4F;
  letter-spacing: 0.04em;
  text-align: center;
  display: flex;
  align-items: center;
  gap: 6px;
}

/* ── Responsive ── */
@media (max-width: 768px) {
  .county-hero__inner {
    grid-template-columns: 1fr;
    gap: 32px;
  }
  .county-hero__map-col {
    order: -1;
  }
  .county-hero {
    padding: 40px 0 32px;
  }
}
</style>

<?php get_footer(); ?>
