<?php
/**
 * Google reviews carousel. Cards come from tcfh_get_reviews().
 * Pass array( 'carousel' => 'home' ) for the 15-review carousel; the default
 * is the 9-review 'section' set. Keep this in step with the schema counts in
 * functions.php (tcfh_review_count), which assume these two sets.
 */
$tcfh_reviews = tcfh_reviews_for( ! empty( $args['carousel'] ) ? $args['carousel'] : 'section' );
?>
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
        <?php foreach ( array_chunk( $tcfh_reviews, 3 ) as $tcfh_slide ) : ?>
        <div class="reviews-slide">
          <?php foreach ( $tcfh_slide as $tcfh_review ) : ?>
          <div class="testimonial-card">
            <div class="testimonial-stars"><?php echo str_repeat( '&#9733;', (int) $tcfh_review['rating'] ); ?></div>
            <p class="testimonial-body"><?php echo esc_html( $tcfh_review['body'] ); ?></p>
            <div class="testimonial-author">
              <div class="testimonial-avatar"><?php echo esc_html( $tcfh_review['initials'] ); ?></div>
              <div>
                <div class="testimonial-name"><?php echo esc_html( $tcfh_review['author'] ); ?></div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
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

    <p class="reviews-footnote">Read all <?php echo tcfh_google_reviews_link(); ?>.</p>

  </div>
</section>
