<?php
/**
 * "Recent Homes We've Bought": real local case studies from recent-homes-data.php.
 * Shown only on pages listed there; nothing renders anywhere else.
 *
 * Expected variables before include:
 *   $rh_slug  page slug ("columbia", "maury-county")
 *   $rh_name  display name ("Columbia", "Maury County")
 *
 * Quotes print as plain text. No review schema: a quote gets schema only once
 * it is confirmed as a Google review.
 */
$rh_data = include get_template_directory() . '/recent-homes-data.php';
if ( empty( $rh_data['pages'][ $rh_slug ] ) ) return;

$rh_page    = $rh_data['pages'][ $rh_slug ];
$rh_stories = array_filter( array_map( function( $id ) use ( $rh_data ) {
    return isset( $rh_data['stories'][ $id ] ) ? $rh_data['stories'][ $id ] : null;
}, $rh_page['stories'] ) );
if ( ! $rh_stories ) return;
$rh_count = count( $rh_stories );
?>
<!-- ── RECENT HOMES WE'VE BOUGHT ── -->
<section class="section recent-homes" id="recent-homes">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Local Proof</p>
      <h2 class="section__title">Recent Homes We&rsquo;ve Bought in <?php echo esc_html( $rh_name ); ?></h2>
      <p class="section__subtitle">Real sales from the past few months. We leave out names and addresses to protect our sellers&rsquo; privacy.</p>
    </div>

    <?php if ( ! empty( $rh_page['facts'] ) ) : ?>
    <div class="recent-homes__facts">
      <?php foreach ( $rh_page['facts'] as $rh_fact ) : ?>
      <div class="recent-homes__fact">
        <span class="recent-homes__fact-value"><?php echo esc_html( $rh_fact['value'] ); ?></span>
        <span class="recent-homes__fact-label"><?php echo esc_html( $rh_fact['label'] ); ?></span>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="recent-homes__grid recent-homes__grid--<?php echo (int) min( $rh_count, 2 ); ?>">
      <?php foreach ( $rh_stories as $rh_story ) : ?>
      <article class="recent-homes__card">
        <p class="recent-homes__date"><?php echo esc_html( $rh_story['date'] ); ?></p>
        <h3 class="recent-homes__title"><?php echo esc_html( $rh_story['title'] ); ?></h3>
        <p class="recent-homes__body"><?php echo esc_html( $rh_story['body'] ); ?></p>
        <?php if ( ! empty( $rh_story['quote'] ) ) : ?>
        <blockquote class="recent-homes__quote">
          <p>&ldquo;<?php echo esc_html( $rh_story['quote']['text'] ); ?>&rdquo;</p>
          <cite><?php echo esc_html( $rh_story['quote']['by'] ); ?></cite>
        </blockquote>
        <?php endif; ?>
      </article>
      <?php endforeach; ?>
    </div>

    <?php if ( ! empty( $rh_page['more'] ) ) : ?>
    <p class="recent-homes__more">Read more recent sales on our
      <?php
      $rh_links = array_map( function( $l ) {
          return '<a href="' . esc_url( home_url( $l['url'] ) ) . '">' . esc_html( $l['text'] ) . '</a>';
      }, $rh_page['more'] );
      echo implode( ' and ', $rh_links );
      ?>
      pages.</p>
    <?php endif; ?>
  </div>
</section>
