<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<?php
  // Get categories
  $categories = get_the_category();
  $cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Blog';
  $cat_link   = ! empty( $categories ) ? get_category_link( $categories[0]->term_id ) : home_url( '/blog/' );

  // Reading time estimate
  $content    = get_the_content();
  $word_count = str_word_count( wp_strip_all_tags( $content ) );
  $read_time  = max( 1, ceil( $word_count / 250 ) );
?>

<main class="single-post">

  <!-- ── HEADER ── -->
  <header class="single-post__header">
    <div class="container">
      <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="single-post__back">&larr; Back to Blog</a>
      <span class="single-post__cat"><?php echo esc_html( strtoupper( $cat_name ) ); ?></span>
      <h1 class="single-post__title"><?php the_title(); ?></h1>
      <?php if ( has_excerpt() ) : ?>
        <p class="single-post__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
      <?php endif; ?>
      <div class="single-post__meta">
        <span class="single-post__meta-item">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <?php echo esc_html( get_the_author() ); ?>
        </span>
        <span class="single-post__meta-item">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          <?php echo get_the_date( 'F j, Y' ); ?>
        </span>
        <span class="single-post__meta-item">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <?php echo $read_time; ?> min read
        </span>
      </div>
    </div>
  </header>

  <!-- ── FEATURED IMAGE ── -->
  <?php if ( has_post_thumbnail() ) : ?>
    <div class="single-post__hero-img">
      <div class="container">
        <?php the_post_thumbnail( 'full', array( 'class' => 'single-post__featured' ) ); ?>
      </div>
    </div>
  <?php endif; ?>

  <!-- ── BODY: Content + Sidebar ── -->
  <div class="single-post__body">
    <div class="container">
      <div class="single-post__grid">

        <!-- Main content -->
        <article class="single-post__content prose" id="post-content">
          <?php the_content(); ?>
        </article>

        <!-- Sidebar -->
        <aside class="single-post__sidebar">

          <!-- Free Guide CTA -->
          <div class="sidebar-cta">
            <span class="sidebar-cta__badge">
              <svg width="18" height="18" fill="none" stroke="#F5A623" stroke-width="2" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
              FREE GUIDE
            </span>
            <h3 class="sidebar-cta__title">The Homeowner's Guide to Selling Fast in Tennessee</h3>
            <p class="sidebar-cta__text">Learn the exact steps to get top dollar for your home &mdash; without the stress.</p>
            <a href="<?php echo esc_url( home_url( '/#hero-form' ) ); ?>" class="sidebar-cta__btn">Download Free Guide &rarr;</a>
          </div>

          <!-- Related Articles -->
          <div class="sidebar-related">
            <h4 class="sidebar-related__title">RELATED ARTICLES</h4>
            <ul class="sidebar-related__list">
              <?php
              $related = new WP_Query( array(
                'posts_per_page' => 4,
                'post__not_in'   => array( get_the_ID() ),
                'category__in'   => wp_get_post_categories( get_the_ID() ),
                'orderby'        => 'rand',
              ) );
              if ( $related->have_posts() ) :
                while ( $related->have_posts() ) : $related->the_post();
              ?>
                <li><a href="<?php the_permalink(); ?>">&rarr; <?php the_title(); ?></a></li>
              <?php
                endwhile;
                wp_reset_postdata();
              else :
                // Fallback: latest posts
                $latest = new WP_Query( array(
                  'posts_per_page' => 4,
                  'post__not_in'   => array( get_the_ID() ),
                ) );
                while ( $latest->have_posts() ) : $latest->the_post();
              ?>
                <li><a href="<?php the_permalink(); ?>">&rarr; <?php the_title(); ?></a></li>
              <?php
                endwhile;
                wp_reset_postdata();
              endif;
              ?>
            </ul>
          </div>

          <!-- Table of Contents -->
          <div class="sidebar-toc">
            <h4 class="sidebar-toc__title">IN THIS ARTICLE</h4>
            <nav class="sidebar-toc__nav" id="tocNav">
              <!-- Populated by JS from h2 headings -->
            </nav>
          </div>

        </aside>
      </div>
    </div>
  </div>

  <!-- ── BOTTOM CTA ── -->
  <section class="single-post__cta">
    <div class="container">
      <div class="single-post__cta-box">
        <h2>Ready to Sell Your Tennessee Home?</h2>
        <p>Skip the hassle of listing, repairs, and waiting months. Get a fair, no-obligation cash offer within 24 hours.</p>
        <a href="<?php echo esc_url( home_url( '/#hero-form' ) ); ?>" class="single-post__cta-btn">Get Your Free Cash Offer &rarr;</a>
      </div>
    </div>
  </section>

</main>

<?php endwhile; ?>

<script>
// ── Table of Contents Generator ──
(function() {
  const content = document.getElementById('post-content');
  const tocNav  = document.getElementById('tocNav');
  if (!content || !tocNav) return;

  const headings = content.querySelectorAll('h2');
  if (!headings.length) return;

  headings.forEach(function(h, i) {
    const id = 'section-' + i;
    h.setAttribute('id', id);
    const link = document.createElement('a');
    link.href = '#' + id;
    link.textContent = h.textContent;
    link.className = 'sidebar-toc__link';
    tocNav.appendChild(link);
  });
})();
</script>

<?php get_footer(); ?>
