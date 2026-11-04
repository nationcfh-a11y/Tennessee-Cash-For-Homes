<?php
/**
 * 404 page. Without this file WordPress falls back to index.php, which
 * printed the full content of recent posts on every missing URL.
 */
get_header();
?>

<section class="not-found">
  <div class="container">
    <div class="not-found__inner">
      <p class="section__eyebrow">Error 404</p>
      <h1 class="not-found__title">Page Not Found</h1>
      <p class="not-found__text">The page you were looking for has moved or no longer exists. You can still get a fair cash offer on your Tennessee house, or find the area you need below.</p>
      <div class="not-found__actions">
        <a href="<?php echo esc_url( home_url( '/#hero-form' ) ); ?>" class="btn-primary">Get My Free Cash Offer &rarr;</a>
        <a href="<?php echo esc_url( home_url( '/where-we-buy/' ) ); ?>" class="btn-outline btn-outline--dark">See Where We Buy</a>
      </div>
      <p class="not-found__home"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; Back to the homepage</a></p>
    </div>
  </div>
</section>

<?php get_footer(); ?>
