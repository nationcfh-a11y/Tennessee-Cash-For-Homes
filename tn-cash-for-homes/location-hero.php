<?php
/**
 * Hero for the city and county pages: a photo of a house we bought behind
 * the same dark overlay as the homepage hero, with the breadcrumb, label, H1,
 * intro, a 2x2 checklist, buttons and the cash offer form on top.
 *
 * The photo is a real <img> (not a CSS background) so it has alt text and the
 * browser finds it in the HTML right away. Phones get their own crop of the
 * middle of the house (the hero shows the photo 560px tall there), so they
 * load a sharp file without downloading the full width. It is the first thing on the page,
 * so it is never lazy loaded. Styles live in critical.css.
 *
 * Args (get_template_part( 'location-hero', null, $args )):
 *   type      'city' or 'county'
 *   slug      page slug: picks the photo and goes in the form field ids
 *   name      city or county name
 *   h1        the page H1
 *   subtitle  optional, replaces the default intro
 *   link      optional [ 'url' => ..., 'text' => ... ], a text link under the intro
 *   id_prefix optional prefix for the form field ids (default 'loc')
 */
$tcfh_type     = ( isset( $args['type'] ) && 'county' === $args['type'] ) ? 'county' : 'city';
$tcfh_slug     = $args['slug'];
$tcfh_name     = $args['name'];
$tcfh_prefix   = ! empty( $args['id_prefix'] ) ? $args['id_prefix'] : 'loc';
$tcfh_subtitle = ! empty( $args['subtitle'] )
    ? $args['subtitle']
    : 'No repairs. No commissions. No fees. Get a fair cash offer for your ' . $tcfh_name . ' home in as little as 24 hours. We close on your timeline.';

// Which house photo each page uses (brand_assets/hero-house-N*.webp). Spread
// out so a county page, its cities and the counties next to it never share
// a photo. Pages not listed (a new city, say) fall back to photo 10.
$tcfh_hero_by_slug = array(
    'davidson-county'   => 8, 'nashville'      => 4,
    'williamson-county' => 2, 'franklin'       => 1, 'brentwood' => 5,
    'rutherford-county' => 3, 'murfreesboro'   => 10, 'smyrna' => 6, 'la-vergne' => 7,
    'wilson-county'     => 2, 'lebanon'        => 9, 'mt-juliet' => 5,
    'sumner-county'     => 1, 'gallatin'       => 6, 'hendersonville' => 7,
    'robertson-county'  => 3, 'springfield'    => 10,
    'montgomery-county' => 2, 'clarksville'    => 6,
    'dickson-county'    => 9, 'dickson'        => 8,
    'maury-county'      => 6, 'columbia'       => 10, 'spring-hill' => 7,
    'bedford-county'    => 9, 'shelbyville'    => 1,
    'coffee-county'     => 5, 'tullahoma'      => 4,
    'putnam-county'     => 8, 'cookeville'     => 4,
    'tennessee'         => 3,
);
// Photo N => [height of the 1600w file, focus x %, focus y %]. The focus
// keeps the house in frame when the hero crops the photo. Every photo has
// -800w, 1600w (no suffix) and -2048w files, plus a -mobile crop of the
// middle of the house for phones (about 1232x1120).
$tcfh_hero_photos = array(
    1  => array( 849, 49, 44 ),
    2  => array( 1069, 50, 45 ),
    3  => array( 1067, 50, 49 ),
    4  => array( 1068, 50, 46 ),
    5  => array( 969, 50, 50 ),
    6  => array( 1067, 46, 50 ),
    7  => array( 1068, 50, 60 ),
    8  => array( 882, 48, 47 ),
    9  => array( 919, 52, 53 ),
    10 => array( 969, 50, 48 ),
);
$tcfh_n     = isset( $tcfh_hero_by_slug[ $tcfh_slug ] ) ? $tcfh_hero_by_slug[ $tcfh_slug ] : 10;
$tcfh_photo = $tcfh_hero_photos[ $tcfh_n ];
$tcfh_base  = get_template_directory_uri() . '/brand_assets/hero-house-' . $tcfh_n;

$tcfh_check = '<svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
$tcfh_star  = '<svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
$tcfh_id    = $tcfh_prefix . '-%s-' . $tcfh_slug;
?>
<!-- ── LOCATION HERO ── -->
<section class="county-hero county-hero--photo<?php echo 'city' === $tcfh_type ? ' city-page' : ''; ?>">
  <picture>
    <source media="(max-width: 768px)" srcset="<?php echo esc_url( $tcfh_base . '-mobile.webp' ); ?>" width="1232" height="1120" />
    <img class="county-hero__bg"
      src="<?php echo esc_url( $tcfh_base . '.webp' ); ?>"
      srcset="<?php echo esc_url( $tcfh_base . '-800w.webp' ); ?> 800w, <?php echo esc_url( $tcfh_base . '.webp' ); ?> 1600w, <?php echo esc_url( $tcfh_base . '-2048w.webp' ); ?> 2048w"
      sizes="100vw"
      width="1600" height="<?php echo (int) $tcfh_photo[0]; ?>"
      style="object-position: <?php echo (int) $tcfh_photo[1]; ?>% <?php echo (int) $tcfh_photo[2]; ?>%"
      alt="A house Tennessee Cash For Homes bought in Middle Tennessee"
      fetchpriority="high" decoding="async" />
  </picture>
  <div class="hero__overlay"></div>
  <div class="container">
    <div class="county-hero__inner">

      <!-- LEFT: Content + Trust -->
      <div class="county-hero__content">
        <nav class="breadcrumb">
          <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
          <span>&rsaquo;</span>
          <a href="<?php echo esc_url( home_url('/where-we-buy/') ); ?>">Where We Buy</a>
          <span>&rsaquo;</span>
          <span><?php echo esc_html( $tcfh_name ); ?></span>
        </nav>
        <div class="hero__badge county-hero__badge"><?php echo esc_html( $tcfh_name ); ?> Cash Home Buyers</div>
        <h1 class="county-hero__title"><?php echo esc_html( $args['h1'] ); ?></h1>
        <p class="county-hero__subtitle"><?php echo esc_html( $tcfh_subtitle ); ?></p>
        <?php if ( ! empty( $args['link'] ) ) : ?>
        <p class="county-hero__link"><a href="<?php echo esc_url( $args['link']['url'] ); ?>"><?php echo esc_html( $args['link']['text'] ); ?> &rarr;</a></p>
        <?php endif; ?>
        <!-- 2x2: left column fees / 7 days, right column as-is / 5 stars.
             Phones show one star and "5-Star Rated" so the grid stays even. -->
        <div class="hero__trust county-hero__trust">
          <div class="hero__trust-item"><?php echo $tcfh_check; ?>Zero fees or commissions</div>
          <div class="hero__trust-item"><?php echo $tcfh_check; ?>Buy as-is, any condition</div>
          <div class="hero__trust-item"><?php echo $tcfh_check; ?>Close in 7 days</div>
          <div class="hero__trust-item hero__trust-item--stars">
            <span class="county-hero__stars" aria-hidden="true"><?php echo str_repeat( $tcfh_star, 5 ); ?></span>
            <span>5-Star Rated<span class="county-hero__on-google"> on Google</span></span>
          </div>
        </div>
        <div class="county-hero__cta-row">
          <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>" class="btn-primary">Get My Free Cash Offer &rarr;</a>
          <a href="tel:+16158018126" class="btn-outline">Call Us Today - (615) 801-8126</a>
        </div>
      </div>

      <!-- RIGHT: Form -->
      <div class="county-hero__map-col">
        <div class="hero__form-card county-hero__form" id="get-offer">
          <h2 class="form-card__title">Get Your Free Cash Offer</h2>
          <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
          <form onsubmit="handleSubmit(event)">
            <input type="hidden" name="lead_source" value="<?php echo esc_attr( $tcfh_name ); ?>" />
            <div class="form-group">
              <label for="<?php echo esc_attr( sprintf( $tcfh_id, 'address' ) ); ?>">Property Address</label>
              <input type="text" id="<?php echo esc_attr( sprintf( $tcfh_id, 'address' ) ); ?>" name="address" placeholder="123 Main St, <?php echo esc_attr( $tcfh_name ); ?>, TN" required />
            </div>
            <div class="form-group">
              <label for="<?php echo esc_attr( sprintf( $tcfh_id, 'name' ) ); ?>">Your Name</label>
              <input type="text" id="<?php echo esc_attr( sprintf( $tcfh_id, 'name' ) ); ?>" name="name" placeholder="John Smith" required />
            </div>
            <div class="form-group">
              <label for="<?php echo esc_attr( sprintf( $tcfh_id, 'phone' ) ); ?>">Phone Number</label>
              <input type="tel" id="<?php echo esc_attr( sprintf( $tcfh_id, 'phone' ) ); ?>" name="phone" placeholder="(615) 555-0123" required />
            </div>
            <button type="submit" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</button>
          </form>
          <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
        </div>
      </div><!-- /.county-hero__map-col -->

    </div><!-- /.county-hero__inner -->
  </div>
</section>
