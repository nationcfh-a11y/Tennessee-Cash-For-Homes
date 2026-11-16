<?php
/**
 * "The Tennessee Cash For Homes Difference": the team photo centered on top,
 * then two balanced columns. Left: logo, heading, intro, Google reviews link
 * and BBB seal. Right: the checklist and the chamber badges, with the badge
 * row level with the reviews and BBB row. Styles for this layout live at the
 * bottom of this file (printed once per page) so the minified stylesheet does
 * not need rebuilding.
 *
 * Shared by the homepage and every city, county and situation page, so a
 * change here shows up everywhere.
 *
 * Args (get_template_part( 'difference-section', null, $args )), all optional.
 * Without any, the homepage wording is used. The heading and first sentence
 * change per page so the section is not word for word the same everywhere.
 *   place     a city or county name: "Why Columbia Homeowners Choose ...",
 *             "When you sell your Columbia house to us, ..."
 *   audience  who the page is for (situation pages): "Why <audience> Choose ..."
 *   lead      first sentence of the intro, used with audience
 */
$tcfh_place    = ! empty( $args['place'] ) ? $args['place'] : '';
$tcfh_audience = ! empty( $args['audience'] ) ? $args['audience'] : '';
$tcfh_lead     = ! empty( $args['lead'] ) ? $args['lead'] : '';
if ( $tcfh_place ) {
    $tcfh_audience = $tcfh_place . ' Homeowners';
    $tcfh_lead     = 'When you sell your ' . $tcfh_place . ' house to us, you work with real people, not a big out-of-state corporation or an automated system.';
}
$tcfh_theme = get_template_directory_uri();
$tcfh_check = '<svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
$tcfh_items = array(
    'Based right here in Middle Tennessee',
    'Family owned and relationship focused',
    'Fair, straightforward cash offers',
    'No cleaning, no repairs, no hidden fees',
    'Flexible closing on your timeline',
);
?>
<!-- ── DIFFERENCE ── -->
<section class="difference-section difference-section--grid">
  <div class="container">
    <div class="difference__img-wrap">
      <img
        src="<?php echo esc_url( $tcfh_theme ); ?>/brand_assets/team-photo.webp"
        srcset="<?php echo esc_url( $tcfh_theme ); ?>/brand_assets/team-photo-800w.webp 800w,
                <?php echo esc_url( $tcfh_theme ); ?>/brand_assets/team-photo.webp 1280w"
        sizes="(max-width: 860px) 100vw, 820px"
        alt="Tennessee Cash For Homes team"
        width="1280" height="720" loading="lazy" decoding="async" />
    </div>
    <div class="difference__content">
      <div class="difference__col difference__col--intro">
        <div class="difference__heading">
          <img class="difference__logo"
            src="<?php echo esc_url( $tcfh_theme ); ?>/brand_assets/Tennessee%20Cash%20For%20Homes%20Logo.webp"
            alt="Tennessee Cash For Homes logo" width="112" height="112" loading="lazy" decoding="async" />
        <?php if ( $tcfh_audience ) : ?>
          <h2 class="difference__title">Why <?php echo esc_html( $tcfh_audience ); ?> Choose <span>Tennessee Cash For Homes</span></h2>
        </div>
        <p class="difference__intro"><?php echo esc_html( trim( $tcfh_lead . ' We are a Middle Tennessee family owned business that believes in doing business the right way.' ) ); ?></p>
        <?php else : ?>
          <h2 class="difference__title">The <span>Tennessee Cash For Homes</span> Difference</h2>
        </div>
        <p class="difference__intro">We are not a big out-of-state corporation or an automated system. We are a Middle Tennessee family owned business that believes in doing business the right way.</p>
        <?php endif; ?>
      </div>
      <div class="difference__col difference__col--list">
        <ul class="difference__list">
          <?php foreach ( $tcfh_items as $tcfh_item ) : ?>
          <li class="diff-item">
            <?php echo $tcfh_check; ?>
            <?php echo esc_html( $tcfh_item ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="difference__trust-row">
        <div class="difference__stars">
          <div class="difference__stars-icons">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
          <div class="difference__stars-label"><?php echo tcfh_google_reviews_link(); ?></div>
        </div>
        <a href='https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick' target='_blank' rel='nofollow noopener noreferrer' class='bbb-seal'><img src='https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png' style='border: 0;' alt='Tennessee Cash For Homes BBB Business Review' width='200' height='42' loading='lazy' decoding='async' /></a>
      </div>
      <div class="difference__badges">
        <?php get_template_part( 'chamber-badges', null, array( 'chambers' => array( 'spring-hill', 'maury' ), 'size' => 'small' ) ); ?>
      </div>
    </div>
  </div>
</section>
<?php if ( empty( $GLOBALS['tcfh_difference_css_printed'] ) ) : $GLOBALS['tcfh_difference_css_printed'] = true; ?>
<style>
  .difference-section--grid { display: block; min-height: 0; background: var(--white); padding: 40px 0 72px; }
  .difference-section--grid .difference__img-wrap { max-width: 820px; height: auto; margin: 0 auto 36px; overflow: visible; }
  .difference-section--grid .difference__img-wrap { aspect-ratio: 1280 / 640; overflow: hidden; }
  .difference-section--grid .difference__img-wrap img { width: 100%; height: 100%; object-fit: cover; object-position: center bottom; }
  .difference-section--grid .difference__content { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); column-gap: 56px; row-gap: 28px; max-width: 1080px; margin: 0 auto; }
  .difference-section--grid .difference__col--intro { grid-column: 1; grid-row: 1; }
  .difference-section--grid .difference__col--list { grid-column: 2; grid-row: 1; display: flex; }
  .difference-section--grid .difference__trust-row { grid-column: 1; grid-row: 2; align-self: center; margin: 0; }
  .difference-section--grid .difference__badges { grid-column: 2; grid-row: 2; align-self: center; }
  .difference-section--grid .difference__badges .chamber-badges { margin-top: 0; }
  .difference-section--grid .difference__heading { display: flex; align-items: center; gap: 18px; margin-bottom: 16px; }
  .difference-section--grid .difference__heading .difference__title { margin: 0; }
  .difference-section--grid .difference__logo { flex-shrink: 0; width: 112px; height: 112px; margin: 0 0 0 -10px; }
  .difference-section--grid .difference__intro { margin-bottom: 0; }
  .difference-section--grid .difference__list { display: flex; flex-direction: column; justify-content: space-between; gap: 10px; width: 100%; margin: 0; padding: 0; }
  .difference-section--grid .difference__list li { margin: 0; padding: 12px 16px; background: var(--bg-light); border-radius: 10px; }
  @media (max-width: 768px) {
    .difference-section--grid { padding: 40px 0 !important; }
    .difference-section--grid .difference__img-wrap { margin-bottom: 20px; }
    .difference-section--grid .difference__heading { gap: 12px; }
    .difference-section--grid .difference__logo { width: 76px; height: 76px; margin-left: -6px; }
    .difference-section--grid .difference__content { grid-template-columns: 1fr; row-gap: 20px; }
    .difference-section--grid .difference__col--intro,
    .difference-section--grid .difference__col--list,
    .difference-section--grid .difference__trust-row,
    .difference-section--grid .difference__badges { grid-column: 1; grid-row: auto; }
    .difference-section--grid .difference__list li { margin: 0 !important; }
    .difference-section--grid .difference__trust-row { margin-top: 0 !important; }
  }
</style>
<?php endif; ?>
