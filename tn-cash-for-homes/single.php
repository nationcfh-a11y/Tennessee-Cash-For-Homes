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
          <?php
            // Remove the first image from content (it duplicates the featured image)
            $post_content = apply_filters( 'the_content', get_the_content() );
            $post_content = preg_replace( '/<figure[^>]*>.*?<\/figure>/s', '', $post_content, 1 );
            // Remove embedded CTA section ("Ready to Sell Your Tennessee Home?") from migrated Wix content
            $post_content = preg_replace( '/<div[^>]*>(\s*<div[^>]*>)*\s*<h2[^>]*>\s*<strong>Ready to Sell Your Tennessee Home\?<\/strong>\s*<\/h2>.*?Get Your Free Cash Offer.*?<\/div>(\s*<\/div>)*/s', '', $post_content );
            echo $post_content;
          ?>
          <!-- YouTube Video Embed (injected by JS after relevant heading) -->
          <?php
            // Map keywords in post titles to the most relevant YouTube video
            $video_map = array(
              // Foreclosure
              'foreclosure'       => 'IDxGsjY08N0',
              // Liens
              'lien'              => '9HHtMiOHO6A',
              // Foundation
              'foundation'        => 'C8TnMxC2Qc4',
              // Inherited / Probate
              'inherit'           => 'W7_w-8opgd4',
              'probate'           => 'W7_w-8opgd4',
              // Septic
              'septic'            => 'Qb-0jFgtG-w',
              // Inspection
              'inspection'        => '5suLXLUtYJs',
              'inspect'           => '5suLXLUtYJs',
              // Mobile home
              'mobile home'       => 'ygFO12fzqKQ',
              'manufactured'      => 'ygFO12fzqKQ',
              // Land
              'land'              => 'F11zLCR3l2M',
              // Realtor / Agent
              'realtor'           => '72xU0pZ4BtM',
              'agent'             => '72xU0pZ4BtM',
              'list with'         => '72xU0pZ4BtM',
              // MLS
              'mls'               => 'a3c18Ini_dA',
              // Appraisal / Value
              'appraisal'         => '5j9Oiu4tuSs',
              'zillow'            => 'GUpDj7ZrR6A',
              'home value'        => '5j9Oiu4tuSs',
              'home worth'        => '5j9Oiu4tuSs',
              // As-is
              'as-is'             => 'YgRuGOhM8zk',
              'as is'             => 'YgRuGOhM8zk',
              // Market trends
              'market'            => 'b7JS8shRScE',
              'interest rate'     => '74DTSxQ1uns',
              // Back taxes
              'tax'               => '_5GxlxHQ7Rs',
              // Home improvements
              'improvement'       => 'NNPUfezM9z0',
              'renovation'        => 'NNPUfezM9z0',
              'upgrade'           => '6IrVcW45WnU',
              'repair'            => 'NNPUfezM9z0',
              // Nashville
              'nashville'         => 'tuL8IzAJ5Ac',
              // Spring Hill
              'spring hill'       => '4Fsf797FA3w',
              // Mortgage
              'mortgage'          => 'c-G5-jta0xc',
              // Bankruptcy
              'bankruptcy'        => '9z7igZ_EXOI',
              // Divorce
              'divorce'           => 'lG64DriT_PU',
              // Hoarder
              'hoarder'           => 'YgRuGOhM8zk',
              // Water damage / Fire damage
              'water damage'      => '858IzWw8IHU',
              'fire damage'       => '858IzWw8IHU',
              'damage'            => '858IzWw8IHU',
              // Mold / Lead
              'mold'              => '858IzWw8IHU',
              'lead paint'        => '858IzWw8IHU',
              // Squatters
              'squatter'          => 'BYgds4l58_c',
              // Lowball / Fair offer
              'lowball'           => 'PzFyt0EbKsE',
              'fair offer'        => 'PzFyt0EbKsE',
              'fair cash'         => 'PzFyt0EbKsE',
              // Walkthrough
              'walkthrough'       => 'BOBXwRFRX6Y',
              // How long to sell
              'how long'          => 'knZptdwZyto',
              // Cash offer / Cash sale (broad match - keep near bottom)
              'cash offer'        => '1TA3YAFyHQM',
              'cash sale'         => '1TA3YAFyHQM',
              'sell for cash'     => '0ygQa20keYo',
              'sell your house'   => 'lG64DriT_PU',
              'sell my house'     => 'lG64DriT_PU',
              'selling'           => '6ryN8tqQ5r4',
            );

            $post_title = strtolower( get_the_title() );
            $matched_video = 'lG64DriT_PU'; // Default: "Do You Need to Sell Your House Fast for Cash in Tennessee?"

            foreach ( $video_map as $keyword => $vid_id ) {
              if ( strpos( $post_title, $keyword ) !== false ) {
                $matched_video = $vid_id;
                break;
              }
            }
          ?>
          <div class="video-embed" id="videoEmbed" style="display:none;">
            <div class="video-embed__wrapper">
              <iframe
                src="https://www.youtube.com/embed/<?php echo esc_attr( $matched_video ); ?>?rel=0"
                title="Tennessee Cash For Homes – Related Video"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                loading="lazy"
              ></iframe>
            </div>
            <p class="video-embed__caption">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              Watch: Learn more from Tennessee Cash For Homes on YouTube
            </p>
          </div>

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

  // Inject YouTube video embed after the best heading
  var videoEl = document.getElementById('videoEmbed');
  if (videoEl && headings.length > 1) {
    var targetHeading = null;

    // Try to find "Understanding Cash Offers" or similar heading
    for (var j = 0; j < headings.length; j++) {
      var txt = headings[j].textContent.toLowerCase();
      if (txt.indexOf('cash offer') !== -1 || txt.indexOf('understanding') !== -1) {
        targetHeading = headings[j];
        break;
      }
    }

    // Fallback: insert after the 2nd h2 heading
    if (!targetHeading) {
      targetHeading = headings[Math.min(1, headings.length - 1)];
    }

    // Find the next sibling section boundary (next h2 or end of content)
    // and insert the video just before it
    var insertBefore = targetHeading.nextElementSibling;
    // Walk past the heading's related paragraphs/lists to find a good spot
    while (insertBefore && insertBefore.tagName !== 'H2') {
      insertBefore = insertBefore.nextElementSibling;
    }

    videoEl.style.display = '';
    if (insertBefore) {
      content.insertBefore(videoEl, insertBefore);
    } else {
      content.appendChild(videoEl);
    }
  }
})();
</script>

<?php get_footer(); ?>
