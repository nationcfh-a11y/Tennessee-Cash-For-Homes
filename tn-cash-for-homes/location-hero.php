<?php
/**
 * Hero for the city and county pages: a photo of a house we bought behind
 * the same dark overlay as the homepage hero, with the breadcrumb, label, H1,
 * intro, checklist, BBB seal, buttons and the cash offer form on top.
 *
 * The photo is a real <img> (not a CSS background) so it has alt text and the
 * browser finds it in the HTML right away. It is the first thing on the page,
 * so it is never lazy loaded. Styles live in critical.css.
 *
 * Args (get_template_part( 'location-hero', null, $args )):
 *   type      'city' or 'county' (picks the photo)
 *   slug      page slug, used in the form field ids
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

// [file, width, height] for the large and 800w versions of each photo.
$tcfh_photos = array(
    'city'   => array( 'city-hero-house', 1600, 932 ),
    'county' => array( 'county-hero-house', 1600, 839 ),
);
$tcfh_photo = $tcfh_photos[ $tcfh_type ];
$tcfh_base  = get_template_directory_uri() . '/brand_assets/' . $tcfh_photo[0];

$tcfh_check = '<svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
$tcfh_id    = $tcfh_prefix . '-%s-' . $tcfh_slug;
?>
<!-- ── LOCATION HERO ── -->
<section class="county-hero county-hero--photo<?php echo 'city' === $tcfh_type ? ' city-page' : ''; ?>">
  <img class="county-hero__bg"
    src="<?php echo esc_url( $tcfh_base . '.webp' ); ?>"
    srcset="<?php echo esc_url( $tcfh_base . '-800w.webp' ); ?> 800w, <?php echo esc_url( $tcfh_base . '.webp' ); ?> 1600w"
    sizes="100vw"
    width="<?php echo (int) $tcfh_photo[1]; ?>" height="<?php echo (int) $tcfh_photo[2]; ?>"
    alt="A house Tennessee Cash For Homes bought in Middle Tennessee"
    fetchpriority="high" decoding="async" />
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
        <div class="hero__trust county-hero__trust">
          <div class="hero__trust-item">
            <?php echo $tcfh_check; ?>
            Zero fees or commissions
          </div>
          <div class="hero__trust-item">
            <?php echo $tcfh_check; ?>
            Close in 7 days
          </div>
          <div class="hero__trust-item">
            <?php echo $tcfh_check; ?>
            Buy as-is, any condition
          </div>
          <div class="hero__trust-item">
            <svg width="18" height="18" fill="#FBBC05" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            5-Star Rated on Google
          </div>
          <div class="hero__trust-item">
            <a href='https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick' target='_blank' rel='nofollow noopener noreferrer' class='bbb-seal'><img src='https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png' style='border: 0;' alt='Tennessee Cash For Homes BBB Business Review' width='200' height='42' loading='lazy' decoding='async' /></a>
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
