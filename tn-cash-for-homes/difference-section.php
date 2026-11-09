<?php
/**
 * "The Tennessee Cash For Homes Difference": team photo on the left, then the
 * checklist, the Google reviews link, the BBB seal and the chamber badges.
 *
 * Shared by the homepage and every city and county page, so a change here
 * shows up everywhere.
 *
 * Args (get_template_part( 'difference-section', null, $args )):
 *   place  a city or county name (optional). The heading and first sentence
 *          then name that place, so the section is not word for word the
 *          same on every page. Without it, the homepage wording is used.
 */
$tcfh_place = ! empty( $args['place'] ) ? $args['place'] : '';
$tcfh_theme = get_template_directory_uri();
$tcfh_check = '<svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
$tcfh_items = array(
    'Based Right Here in Middle Tennessee',
    'Family Owned and Relationship Focused',
    'Fair and Straightforward Cash Offers',
    'No Cleaning, No Repairs, No Hidden Fees',
    'Flexible Closing on Your Timeline',
);
?>
<!-- ── DIFFERENCE ── -->
<section class="difference-section">
  <div class="difference__img-wrap">
    <img
      src="<?php echo esc_url( $tcfh_theme ); ?>/brand_assets/team-photo.webp"
      srcset="<?php echo esc_url( $tcfh_theme ); ?>/brand_assets/team-photo-800w.webp 800w,
              <?php echo esc_url( $tcfh_theme ); ?>/brand_assets/team-photo.webp 1280w"
      sizes="(max-width: 768px) 100vw, 50vw"
      alt="Tennessee Cash For Homes team"
      width="1280" height="720" loading="lazy" decoding="async" />
  </div>
  <div class="difference__content-wrap">
    <div class="difference__content">
      <?php if ( $tcfh_place ) : ?>
      <h2 class="difference__title">Why <?php echo esc_html( $tcfh_place ); ?> Homeowners Choose <span>Tennessee Cash For Homes</span></h2>
      <p class="difference__intro">When you sell your <?php echo esc_html( $tcfh_place ); ?> house to us, you work with real people, not a big out-of-state corporation or an automated system. We are a Middle Tennessee family owned business that believes in doing business the right way.</p>
      <?php else : ?>
      <h2 class="difference__title">The <span>Tennessee Cash For Homes</span> Difference</h2>
      <p class="difference__intro">We are not a big out-of-state corporation or an automated system. We are a Middle Tennessee family owned business that believes in doing business the right way.</p>
      <?php endif; ?>
      <ul class="difference__list">
        <?php foreach ( $tcfh_items as $tcfh_item ) : ?>
        <li class="diff-item">
          <?php echo $tcfh_check; ?>
          <?php echo esc_html( $tcfh_item ); ?>
        </li>
        <?php endforeach; ?>
      </ul>
      <div class="difference__trust-row">
        <div class="difference__stars">
          <div class="difference__stars-icons">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
          <div class="difference__stars-label"><?php echo tcfh_google_reviews_link(); ?></div>
        </div>
        <a href='https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick' target='_blank' rel='nofollow noopener noreferrer' class='bbb-seal'><img src='https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png' style='border: 0;' alt='Tennessee Cash For Homes BBB Business Review' width='200' height='42' loading='lazy' decoding='async' /></a>
      </div>
      <?php get_template_part( 'chamber-badges', null, array( 'chambers' => array( 'spring-hill', 'maury' ), 'size' => 'small' ) ); ?>
    </div>
  </div>
</section>
