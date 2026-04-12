<?php
/**
 * Blog Home Page Template
 * Displays at /blog/ — the WordPress "Posts page"
 */
get_header();

// Pagination
$paged         = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;
$is_first_page = ( $paged === 1 );

// Category filter tabs — slugs must match real WP category slugs
$filter_categories = array(
    'all'             => 'All',
    'market-trends'   => 'Market Trends',
    'home-tips'       => 'Home Tips',
    'selling-guide'   => 'Selling Guide',
    'education'       => 'Education',
    'success-stories' => 'Success Stories',
);

// Detect active category from ?category_name=<slug>. Validate against the
// known filter slugs so a bogus value falls back to "All" instead of
// returning an empty query.
$active_category = '';
if ( isset( $_GET['category_name'] ) ) {
    $requested = sanitize_title( wp_unslash( $_GET['category_name'] ) );
    if ( $requested && $requested !== 'all' && isset( $filter_categories[ $requested ] ) ) {
        $active_category = $requested;
    }
}
$is_all_view = ( $active_category === '' );

// Featured post: always the single most recent published post. Only shown
// on the "All" view, page 1.
$featured_post = null;
$show_featured = ( $is_all_view && $is_first_page );
$featured_query = new WP_Query( array(
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
if ( $featured_query->have_posts() ) {
    $featured_query->the_post();
    $featured_post = get_post();
    if ( $show_featured ) {
        $f_content    = get_the_content( null, false, $featured_post );
        $f_word_count = str_word_count( wp_strip_all_tags( $f_content ) );
        $f_read_time  = max( 1, ceil( $f_word_count / 200 ) );
        $f_categories = get_the_category( $featured_post->ID );
        $f_cat_name   = ! empty( $f_categories ) ? $f_categories[0]->name : 'Blog';
        $f_cat_slug   = ! empty( $f_categories ) ? $f_categories[0]->slug : '';
    }
}
wp_reset_postdata();

// Grid query. For the "All" view, exclude the featured post from every
// page so pagination is tight. For a category view, do not exclude —
// pagination should reflect every post in that category.
$grid_args = array(
    'posts_per_page' => 9,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'paged'          => $paged,
);

if ( $is_all_view ) {
    if ( $featured_post ) {
        $grid_args['post__not_in'] = array( $featured_post->ID );
    }
} else {
    $grid_args['category_name'] = $active_category;
}

$grid_query = new WP_Query( $grid_args );

// Helper: build a URL for a given page number that preserves the active
// category filter.
$build_page_url = function( $n ) use ( $active_category ) {
    $url = get_pagenum_link( $n );
    if ( $active_category !== '' ) {
        $url = add_query_arg( 'category_name', $active_category, $url );
    }
    return $url;
};

// Helper: URL for a category filter tab (resets paged to 1).
$build_cat_url = function( $slug ) {
    $base = get_permalink( get_option( 'page_for_posts' ) );
    if ( ! $base ) $base = home_url( '/blog/' );
    if ( $slug === 'all' ) return $base;
    return add_query_arg( 'category_name', $slug, $base );
};

// Total published posts count
$total_posts = wp_count_posts()->publish;
?>

<!-- ── BLOG HERO ── -->
<section class="blog-hero">
  <div class="blog-hero__overlay"></div>
  <div class="container blog-hero__content">
    <span class="blog-hero__eyebrow">Tennessee Cash For Homes</span>
    <h1 class="blog-hero__title">Insights &amp; Resources</h1>
    <p class="blog-hero__subtitle">Expert guidance on selling your Tennessee home fast &mdash; market trends, tips, and real stories from homeowners like you.</p>
  </div>
</section>

<?php if ( $show_featured && $featured_post ) : ?>
<!-- ── FEATURED POST ── -->
<section class="blog-featured">
  <div class="container">
    <a href="<?php echo esc_url( get_permalink( $featured_post->ID ) ); ?>" class="blog-featured__card">
      <div class="blog-featured__img-wrap">
        <?php if ( has_post_thumbnail( $featured_post->ID ) ) : ?>
          <?php echo get_the_post_thumbnail( $featured_post->ID, 'large', array( 'class' => 'blog-featured__img', 'alt' => esc_attr( get_the_title( $featured_post->ID ) ) ) ); ?>
        <?php else : ?>
          <div class="blog-featured__img-placeholder">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
          </div>
        <?php endif; ?>
      </div>
      <div class="blog-featured__body">
        <?php if ( $f_cat_name ) : ?>
          <span class="blog-featured__cat" data-category="<?php echo esc_attr( $f_cat_slug ); ?>"><?php echo esc_html( $f_cat_name ); ?></span>
        <?php endif; ?>
        <h2 class="blog-featured__title"><?php echo esc_html( get_the_title( $featured_post->ID ) ); ?></h2>
        <p class="blog-featured__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $featured_post->ID ), 40, '...' ) ); ?></p>
        <div class="blog-featured__meta">
          <span class="blog-featured__author"><?php echo esc_html( get_the_author_meta( 'display_name', $featured_post->post_author ) ); ?></span>
          <span class="blog-featured__sep">&middot;</span>
          <time datetime="<?php echo esc_attr( get_the_date( 'c', $featured_post ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y', $featured_post ) ); ?></time>
          <span class="blog-featured__sep">&middot;</span>
          <span><?php echo esc_html( $f_read_time ); ?> min read</span>
        </div>
        <span class="blog-featured__link">
          Read Article
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
        </span>
      </div>
    </a>
  </div>
</section>
<?php endif; ?>

<!-- ── LATEST ARTICLES ── -->
<section class="blog-articles">
  <div class="container">
    <h2 class="blog-articles__heading">Latest Articles</h2>

    <!-- Category Filter Tabs (server-side: each tab is a real link) -->
    <div class="blog-filter" role="tablist">
      <?php
      foreach ( $filter_categories as $slug => $label ) :
          $is_active = ( $slug === 'all' && $is_all_view ) || ( $slug !== 'all' && $slug === $active_category );
      ?>
        <a href="<?php echo esc_url( $build_cat_url( $slug ) ); ?>"
           class="blog-filter__tab<?php echo $is_active ? ' blog-filter__tab--active' : ''; ?>"
           role="tab"
           aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
           data-filter="<?php echo esc_attr( $slug ); ?>">
          <?php echo esc_html( $label ); ?>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Articles Grid -->
    <?php if ( $grid_query->have_posts() ) : ?>
      <div class="blog-grid" id="blogGrid">
        <?php while ( $grid_query->have_posts() ) : $grid_query->the_post();
          $content    = get_the_content();
          $word_count = str_word_count( wp_strip_all_tags( $content ) );
          $read_time  = max( 1, ceil( $word_count / 200 ) );
          $cats       = get_the_category();
          $cat_name   = ! empty( $cats ) ? $cats[0]->name : 'Blog';
        ?>
          <a href="<?php the_permalink(); ?>" class="blog-card">
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="blog-card__img-wrap">
                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'blog-card__img', 'alt' => esc_attr( get_the_title() ) ) ); ?>
              </div>
            <?php else : ?>
              <div class="blog-card__img-placeholder">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
              </div>
            <?php endif; ?>
            <div class="blog-card__body">
              <span class="blog-card__cat"><?php echo esc_html( $cat_name ); ?></span>
              <h3 class="blog-card__title"><?php the_title(); ?></h3>
              <p class="blog-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?></p>
              <div class="blog-card__meta">
                <span><?php echo esc_html( get_the_author() ); ?> &middot; <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?> &middot; <?php echo esc_html( $read_time ); ?> min</span>
                <span class="blog-card__read-more">Read &rarr;</span>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
      </div>

      <!-- Pagination -->
      <?php
      $total_pages = (int) $grid_query->max_num_pages;
      if ( $total_pages > 1 ) :
      ?>
        <nav class="blog-pagination" aria-label="Blog pagination">
          <?php if ( $paged > 1 ) : ?>
            <a href="<?php echo esc_url( $build_page_url( $paged - 1 ) ); ?>" class="blog-pagination__btn">&larr; Previous</a>
          <?php else : ?>
            <span class="blog-pagination__btn blog-pagination__btn--disabled">&larr; Previous</span>
          <?php endif; ?>

          <div class="blog-pagination__numbers">
            <?php
            $range = 2;
            $start = max( 1, $paged - $range );
            $end   = min( $total_pages, $paged + $range );

            if ( $start > 1 ) {
                echo '<a href="' . esc_url( $build_page_url( 1 ) ) . '" class="blog-pagination__num">1</a>';
                if ( $start > 2 ) echo '<span class="blog-pagination__dots">&hellip;</span>';
            }

            for ( $i = $start; $i <= $end; $i++ ) {
                if ( $i === $paged ) {
                    echo '<span class="blog-pagination__num blog-pagination__num--active">' . $i . '</span>';
                } else {
                    echo '<a href="' . esc_url( $build_page_url( $i ) ) . '" class="blog-pagination__num">' . $i . '</a>';
                }
            }

            if ( $end < $total_pages ) {
                if ( $end < $total_pages - 1 ) echo '<span class="blog-pagination__dots">&hellip;</span>';
                echo '<a href="' . esc_url( $build_page_url( $total_pages ) ) . '" class="blog-pagination__num">' . $total_pages . '</a>';
            }
            ?>
          </div>

          <?php if ( $paged < $total_pages ) : ?>
            <a href="<?php echo esc_url( $build_page_url( $paged + 1 ) ); ?>" class="blog-pagination__btn">Next &rarr;</a>
          <?php else : ?>
            <span class="blog-pagination__btn blog-pagination__btn--disabled">Next &rarr;</span>
          <?php endif; ?>
        </nav>
      <?php endif; ?>

    <?php else : ?>
      <div class="blog-no-results">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <?php if ( ! $is_all_view ) : ?>
          <p>No articles found in <strong><?php echo esc_html( $filter_categories[ $active_category ] ); ?></strong> yet. Try <a href="<?php echo esc_url( $build_cat_url( 'all' ) ); ?>"><strong>All</strong></a> to see everything.</p>
        <?php else : ?>
          <p>No blog posts published yet. Check back soon!</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</section>

<?php get_footer(); ?>
