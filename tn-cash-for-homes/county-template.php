<?php
/**
 * Shared display template for all county pages.
 * Include from each page-county-[slug].php after defining $county[].
 *
 * Required $county keys:
 *   slug, name, county_id (SVG path id), h1, meta_title, meta_desc,
 *   cities (array of ['name'=>'...','slug'=>'...','has_page'=>true/false]),
 *   median_price, homes_sold, avg_days,
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

get_header();

$slug         = $county['slug'];
$name         = $county['name'];
$county_id    = $county['county_id'];
$h1           = $county['h1'];
$cities       = $county['cities'];
$median_price = $county['median_price'];
$homes_sold   = $county['homes_sold'];
$avg_days     = $county['avg_days'];
$desc1        = $county['desc1'];
$desc2        = $county['desc2'];
$desc3        = ! empty( $county['desc3'] ) ? $county['desc3'] : '';
$land_para    = $county['land_para'];

$check18 = '<svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
$check20 = '<svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
?>

<!-- ── COUNTY HERO ── -->
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
            <a href='https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick' target='_blank' rel='nofollow' class='bbb-seal'><img src='https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png' style='border: 0;' alt='Tennessee Cash For Homes BBB Business Review' width='200' height='42' loading='lazy' decoding='async' /></a>
          </div>
        </div>
        <div class="county-hero__cta-row">
          <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>" class="btn-primary">Get My Free Cash Offer &rarr;</a>
          <a href="tel:+16158018126" class="btn-outline">Call (615) 801-8126</a>
        </div>
      </div>

      <!-- RIGHT: Map + Form -->
      <div class="county-hero__map-col">
        <?php
        $county_svg_path = get_template_directory() . '/brand_assets/county-svgs/' . $slug . '.svg';
        if ( file_exists( $county_svg_path ) ) :
        ?>
        <div class="county-map-hero-wrap">
          <div class="county-map-hero-svg">
            <?php
            $svg_content = file_get_contents( $county_svg_path );
            // For county pages: hide zoomed detail, show only state outline
            if ( strpos( $svg_content, 'id="statelayer"' ) !== false ) {
                $svg_content = str_replace( '<defs>', '<defs><style>#countylayer,#placelayer{display:none}</style>', $svg_content );
                $svg_content = preg_replace( '/viewBox="[^"]*"/', 'viewBox="220 55 290 130"', $svg_content );
            }
            echo $svg_content;
            ?>
          </div>
          <div class="county-map-label">
            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
            <?php echo esc_html( $name ); ?>, Tennessee
          </div>
        </div>
        <?php else :
          // Fallback to old inline map if SVG file not found
          $county_name = $name;
          include get_template_directory() . '/county-map-hero.php';
        endif;
        ?>

        <!-- LEAD FORM -->
        <div class="hero__form-card county-hero__form" id="get-offer">
          <h2 class="form-card__title">Get Your Free Cash Offer</h2>
          <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
          <form onsubmit="handleSubmit(event)">
            <div class="form-group">
              <label for="co-address-<?php echo esc_attr( $slug ); ?>">Property Address</label>
              <input type="text" id="co-address-<?php echo esc_attr( $slug ); ?>" name="address" placeholder="123 Main St, <?php echo esc_attr( $name ); ?>, TN" required />
            </div>
            <div class="form-group">
              <label for="co-name-<?php echo esc_attr( $slug ); ?>">Your Name</label>
              <input type="text" id="co-name-<?php echo esc_attr( $slug ); ?>" name="name" placeholder="John Smith" required />
            </div>
            <div class="form-group">
              <label for="co-phone-<?php echo esc_attr( $slug ); ?>">Phone Number</label>
              <input type="tel" id="co-phone-<?php echo esc_attr( $slug ); ?>" name="phone" placeholder="(615) 555-0123" required />
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

<?php
// ── Market Stats Overview (inserted between stat bar and about section)
$ms_name = $name;
$ms_slug = $slug;
$ms_type = 'county';
include get_template_directory() . '/market-stats-section.php';
include get_template_directory() . '/who-we-help-section.php';
include get_template_directory() . '/reviews-section.php';
?>

<!-- ── ABOUT [COUNTY] ── -->
<section class="section loc-about">
  <div class="container">
    <div class="loc-about__inner">
      <div class="loc-about__content">
        <p class="section__eyebrow">We Buy Houses in <?php echo esc_html( $name ); ?></p>
        <h2 class="section__title">Sell Your <?php echo esc_html( $name ); ?> House Fast for Cash</h2>
        <p class="loc-about__body"><?php echo esc_html( $desc1 ); ?></p>
        <p class="loc-about__body"><?php echo esc_html( $desc2 ); ?></p>
        <?php if ( $desc3 ) : ?><p class="loc-about__body"><?php echo esc_html( $desc3 ); ?></p><?php endif; ?>
        <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>" class="btn-primary">Get My Free Cash Offer &rarr;</a>
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

<!-- ── CITIES WE BUY IN ── -->
<?php if ( ! empty( $cities ) ) : ?>
<section class="section section--alt county-cities-section">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow"><?php echo esc_html( $name ); ?></p>
      <h2 class="section__title">Cities We Buy Houses In</h2>
      <p class="section__subtitle">We purchase homes throughout <?php echo esc_html( $name ); ?>. Click your city to learn more.</p>
    </div>
    <div class="county-cities-grid">
      <?php foreach ( $cities as $city ) :
        $city_url = home_url( '/where-we-buy/' . $city['slug'] );
        $coming_soon = empty( $city['has_page'] );
      ?>
      <a
        href="<?php echo esc_url( $city_url ); ?>"
        class="city-link-btn<?php echo $coming_soon ? ' city-link-btn--coming-soon' : ''; ?>"
        <?php echo $coming_soon ? 'data-coming-soon="true"' : ''; ?>
      >
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
        <?php echo esc_html( $city['name'] ); ?>
        <?php if ( $coming_soon ) : ?><span class="city-link-btn__soon">Soon</span><?php endif; ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

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

<!-- ── AREAS WE SERVE ── -->
<section class="section">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Statewide Coverage</p>
      <h2 class="section__title">Areas We Serve Across Tennessee</h2>
      <p class="section__subtitle">We buy houses throughout all of Tennessee. Whether you are in a major metro or a small town, we can make you a cash offer.</p>
    </div>
    <div class="cities-grid">
      <a href="<?php echo esc_url( home_url('/where-we-buy/nashville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Nashville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/murfreesboro') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Murfreesboro</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/franklin') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Franklin</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/clarksville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Clarksville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/hendersonville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Hendersonville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/columbia') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Columbia</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/gallatin') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Gallatin</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/lebanon') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Lebanon</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/smyrna') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Smyrna</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/spring-hill') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Spring Hill</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/antioch') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Antioch</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/old-hickory') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Old Hickory</span></a>
    </div>
    <p class="areas-footnote">Don&rsquo;t see your city? We serve <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>">all of Tennessee</a>. Contact us for your cash offer today.</p>
  </div>
</section>

<style>
/* ── County Hero ── */
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
  margin-bottom: 20px;
}
.county-hero__title {
  font-size: clamp(1.75rem, 3.5vw, 2.5rem);
  font-weight: 700;
  color: #1a1a1a;
  line-height: 1.15;
  margin: 0 0 20px;
}
.county-hero__subtitle {
  font-size: 1.05rem;
  color: #555;
  margin: 0 0 28px;
  line-height: 1.6;
}
.county-hero__trust {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 32px;
}
.county-hero__cta-row {
  display: flex;
  gap: 16px;
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
}
.city-link-btn--coming-soon:hover {
  background: #aaa;
  border-color: #aaa;
  color: #fff;
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

/* ── Hero text overrides (light bg) ── */
.county-hero .hero__trust-item {
  color: #3D3D3D;
}
.county-hero .hero__trust-item svg {
  color: #84CC9C;
}
.county-hero .btn-outline {
  border: 2px solid #3D3D3D;
  color: #3D3D3D;
  background: transparent;
}
.county-hero .btn-outline:hover {
  background: #3D3D3D;
  color: #fff;
  border-color: #3D3D3D;
}

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
