<?php
/**
 * Areas We Serve: city chips, then county chips, linking every page under
 * /where-we-buy/. Used on the homepage and the city, county, situation, and
 * Where We Buy pages.
 *
 * $args (get_template_part):
 *   background  'alt' (default, light gray) or 'white', to alternate with the
 *               section above it.
 *
 * On phones only the first 6 cities and 4 counties show until the visitor
 * taps "Show all areas we serve". It is a CSS checkbox toggle, so every link
 * is in the page HTML from the start.
 */
$tcfh_areas = tcfh_area_pages();
$tcfh_bg    = ( ! empty( $args['background'] ) && 'white' === $args['background'] ) ? '' : ' section--alt';
?>
<!-- ── AREAS WE SERVE ── -->
<section class="section areas-serve<?php echo esc_attr( $tcfh_bg ); ?>" id="areas-we-serve">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Statewide Coverage</p>
      <h2 class="section__title">We Buy Houses for Cash Across Middle Tennessee</h2>
      <p class="section__subtitle">Sell your house fast for cash in any of these cities and counties. Pick your area for local details, or reach out from anywhere in the state.</p>
    </div>

    <input type="checkbox" id="areas-serve-toggle" class="areas-serve__toggle">

    <h3 class="areas-serve__subhead">Cities We Serve</h3>
    <div class="area-chips area-chips--cities">
      <?php foreach ( $tcfh_areas['cities'] as $slug => $city ) : ?>
        <?php echo tcfh_area_chip( $slug, $city['anchor'] ); ?>
      <?php endforeach; ?>
    </div>

    <h3 class="areas-serve__subhead">Counties We Serve</h3>
    <div class="area-chips area-chips--counties">
      <?php foreach ( $tcfh_areas['counties'] as $slug => $anchor ) : ?>
        <?php echo tcfh_area_chip( $slug, $anchor ); ?>
      <?php endforeach; ?>
    </div>

    <label for="areas-serve-toggle" class="areas-serve__more">
      <span class="areas-serve__more-open">Show all areas we serve</span>
      <span class="areas-serve__more-close">Show fewer</span>
    </label>

    <p class="areas-footnote">Don&rsquo;t see your city? <a href="<?php echo esc_url( home_url( '/where-we-buy/tennessee/' ) ); ?>">See every area we serve in Tennessee</a>, or <a href="<?php echo esc_url( home_url( '/#hero-form' ) ); ?>">request your cash offer</a> today.</p>
  </div>
</section>
