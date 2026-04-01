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
              // ── Specific topics (most specific first) ──

              // Foreclosure
              'foreclosure'       => 'IDxGsjY08N0',  // Top 3 Things If You're Facing Foreclosure

              // Liens
              'lien'              => '9HHtMiOHO6A',  // Can I Sell My House With a Lien?

              // Foundation / Structural (before 'damage' to prevent wrong match)
              'foundation'        => 'C8TnMxC2Qc4',  // Selling Your House With Foundation Problems
              'structural'        => 'C8TnMxC2Qc4',

              // Inherited / Probate
              'inherit'           => 'W7_w-8opgd4',  // Inherited Property: Sell, Rent, or Keep?
              'probate'           => 'W7_w-8opgd4',

              // Septic
              'septic'            => 'Qb-0jFgtG-w',  // Sewer vs Septic System

              // Inspection / Code violations / Unpermitted work
              'inspection'        => '5suLXLUtYJs',  // What Happens If Your House Fails Inspection?
              'code violation'    => '5suLXLUtYJs',
              'unpermitted'       => '5suLXLUtYJs',

              // Mobile home
              'mobile home'       => 'ygFO12fzqKQ',  // Why Mobile Homes Are Valued DIFFERENT
              'manufactured'      => 'ygFO12fzqKQ',

              // Land (use specific phrases to avoid matching "landscape")
              'sell land'         => 'F11zLCR3l2M',  // Sell Your Land for Cash
              'buy land'          => 'F11zLCR3l2M',
              'your land'         => 'F11zLCR3l2M',

              // Realtor / Agent
              'realtor'           => '72xU0pZ4BtM',  // Realtor or Cash Buyer?
              'vs agent'          => 'LUl0b-G4QIQ',  // Sell for Cash or List With an Agent?
              'vs. agent'         => 'LUl0b-G4QIQ',
              'direct sale'       => 'LUl0b-G4QIQ',

              // MLS
              'mls'               => 'a3c18Ini_dA',  // Top 5 Reasons Sellers Skip the MLS

              // Zillow / Appraisal / Value
              'zillow'            => 'GUpDj7ZrR6A',  // Zillow Is Lying About Your Home's Value
              'zestimate'         => 'GUpDj7ZrR6A',
              'appraisal'         => '5j9Oiu4tuSs',  // Is Your House Actually Worth the Appraisal Price?
              'home value'        => '5j9Oiu4tuSs',
              'home worth'        => '5j9Oiu4tuSs',

              // As-Is / Poor condition / Distressed / Ugly / Junk
              'as-is'             => 'YgRuGOhM8zk',  // Sell Your House As-Is
              'as is'             => 'YgRuGOhM8zk',
              'poor condition'    => 'YgRuGOhM8zk',
              'distressed'        => 'YgRuGOhM8zk',
              'ugly house'        => 'YgRuGOhM8zk',
              'ugly home'         => 'YgRuGOhM8zk',
              'junk removal'      => 'YgRuGOhM8zk',
              'vacant house'      => 'YgRuGOhM8zk',

              // Ice storm
              'ice storm'         => 'sUGAiTM20SE',  // Tennessee Braces for a Historic Ice Storm

              // Hazards (radon, asbestos, carbon monoxide)
              'carbon monoxide'   => '858IzWw8IHU',  // DO NOT Make This Mistake With Old Houses
              'radon'             => '858IzWw8IHU',
              'asbestos'          => '858IzWw8IHU',

              // Market / Interest rates / Seasonal / Cost of living
              'interest rate'     => '74DTSxQ1uns',  // 2026 Interest Rates Could Flip the Market
              'cost of living'    => 'b7JS8shRScE',  // Is the TN Housing Market Freezing?
              'market'            => 'b7JS8shRScE',
              'season'            => 'b7JS8shRScE',

              // Tax
              'tax'               => '_5GxlxHQ7Rs',  // Back Taxes Destroying Your Home Sale?

              // Home improvements / Renovation
              'improvement'       => 'NNPUfezM9z0',  // Top 10 Home Improvements That Boost Value
              'renovating'        => 'NNPUfezM9z0',
              'renovation'        => 'NNPUfezM9z0',
              'upgrade'           => '6IrVcW45WnU',  // Trim & Door Upgrades That Add Value

              // Locations
              'nashville'         => 'tuL8IzAJ5Ac',  // Sell House Fast in Nashville
              'spring hill'       => '4Fsf797FA3w',  // Sell House Fast in Spring Hill
              'clarksville'       => 'b7JS8shRScE',  // Market video (closest match)
              'murfreesboro'      => 'sBB5PPFSazU',  // Why TN Cash For Homes Is the Best

              // Mortgage / Loan
              'mortgage'          => 'c-G5-jta0xc',  // When Do You Stop Paying Mortgage
              'home loan'         => 'c-G5-jta0xc',

              // Financial situations
              'bankruptcy'        => '9z7igZ_EXOI',  // This Seller Waited Too Long
              'financial hardship'=> '9z7igZ_EXOI',
              'divorce'           => 'lG64DriT_PU',  // Do You Need to Sell Fast?
              'relocat'           => 'lG64DriT_PU',  // matches relocate, relocating, relocation
              'downsizing'        => 'lG64DriT_PU',

              // Damage types (tenant damage before generic 'damage')
              'tenant damage'     => 'u20Simtyhzg',  // 3 Most Important Things for Your Property
              'tenant'            => 'u20Simtyhzg',
              'rental property'   => 'u20Simtyhzg',
              'hoarder'           => 'YgRuGOhM8zk',  // As-Is
              'water damage'      => '858IzWw8IHU',  // DO NOT Make This Mistake With Old Houses
              'fire-damaged'      => '858IzWw8IHU',
              'fire damage'       => '858IzWw8IHU',
              'damage'            => '858IzWw8IHU',

              // Mold / Lead
              'mold'              => '858IzWw8IHU',
              'lead paint'        => '858IzWw8IHU',

              // Squatters
              'squatter'          => 'BYgds4l58_c',  // Squatters Rights in Tennessee

              // Offers / Fair / Lowball
              'lowball'           => 'PzFyt0EbKsE',  // Tired of Lowball Offers?
              'fair offer'        => 'PzFyt0EbKsE',
              'fair cash'         => 'PzFyt0EbKsE',

              // Walkthrough
              'walkthrough'       => 'BOBXwRFRX6Y',  // Property Walkthrough

              // How long / Timeline
              'how long'          => 'knZptdwZyto',  // How Long Does It Take to Sell?
              'timeline'          => 'knZptdwZyto',

              // Subject-to / Owner financing / Promissory
              'subject-to'        => '6ryN8tqQ5r4',  // What's the Process to Sell for Cash?
              'subject to'        => '6ryN8tqQ5r4',
              'owner financing'   => '6ryN8tqQ5r4',
              'seller financing'  => '6ryN8tqQ5r4',
              'promissory'        => '6ryN8tqQ5r4',
              'title transfer'    => '6ryN8tqQ5r4',

              // TN Cash For Homes branding
              'tennessee cash for homes is' => 'sBB5PPFSazU',  // Why TN Cash For Homes Is the Best
              'we buy house'      => 'sBB5PPFSazU',
              'we buy home'       => 'sBB5PPFSazU',

              // Hidden costs / Mistakes
              'hidden cost'       => 'Xfpv_PyfBjM',  // Top 3 Ways to Get $15,000 More
              'mistake'           => '1TA3YAFyHQM',  // 5 Things Homeowners Get Wrong
              'what not to say'   => '1TA3YAFyHQM',

              // ── Broad matches (keep near bottom) ──

              // Cash-related
              'cash offer'        => '1TA3YAFyHQM',  // 5 Things Every Homeowner Gets Wrong
              'cash buyer'        => 'wwLeprx8vAA',  // Top 5 Reasons to Sell For Cash
              'cash home'         => 'wwLeprx8vAA',
              'cash sale'         => '1TA3YAFyHQM',
              'for cash'          => '0ygQa20keYo',  // HOW TO SELL YOUR HOUSE FOR CASH

              // Selling variations (broadest - keep at very bottom)
              'sell your house'   => 'lG64DriT_PU',  // Do You Need to Sell Fast in TN?
              'sell my house'     => 'lG64DriT_PU',
              'sell your home'    => 'lG64DriT_PU',
              'sell a home'       => 'lG64DriT_PU',
              'sell a house'      => 'lG64DriT_PU',
              'sell your property'=> 'lG64DriT_PU',
              'sell house'        => 'lG64DriT_PU',
              'how to sell'       => '0ygQa20keYo',  // HOW TO SELL YOUR HOUSE FOR CASH
              'selling'           => '6ryN8tqQ5r4',  // What's the Process to Sell for Cash?
              'home sale'         => '6ryN8tqQ5r4',
              'property sale'     => '6ryN8tqQ5r4',
              'homebuying'        => 'lG64DriT_PU',  // Do You Need to Sell Fast?
              'home search'       => 'lG64DriT_PU',
              'emotional'         => 'lG64DriT_PU',
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

          <!-- How It Works Steps (injected above middle by JS) -->
          <div class="blog-steps" id="blogSteps" style="display:none;">
            <h3 class="blog-steps__title">How It Works</h3>
            <ol class="blog-steps__list">
              <li class="blog-steps__item">
                <span class="blog-steps__num">1</span>
                <div class="blog-steps__text">
                  <h4>Contact Us</h4>
                  <p>Fill out our simple form or call us directly. Tell us about your property and situation.</p>
                </div>
              </li>
              <li class="blog-steps__item">
                <span class="blog-steps__num">2</span>
                <div class="blog-steps__text">
                  <h4>Get Your Offer</h4>
                  <p>We'll evaluate your home and present a fair, no-obligation cash offer within 24 hours.</p>
                </div>
              </li>
              <li class="blog-steps__item">
                <span class="blog-steps__num">3</span>
                <div class="blog-steps__text">
                  <h4>Choose Your Closing Date</h4>
                  <p>Accept the offer and pick a closing date that works for your schedule.</p>
                </div>
              </li>
              <li class="blog-steps__item">
                <span class="blog-steps__num">4</span>
                <div class="blog-steps__text">
                  <h4>Get Paid</h4>
                  <p>Close at a local title company and walk away with cash in hand.</p>
                </div>
              </li>
            </ol>
          </div>

          <!-- Related Posts with Thumbnails -->
          <div class="related-posts-bottom">
            <h3 class="related-posts-bottom__title">Related Posts</h3>
            <div class="related-posts-bottom__grid">
              <?php
              $related_bottom = new WP_Query( array(
                'posts_per_page' => 3,
                'post__not_in'   => array( get_the_ID() ),
                'category__in'   => wp_get_post_categories( get_the_ID() ),
                'orderby'        => 'rand',
              ) );
              if ( ! $related_bottom->have_posts() ) {
                $related_bottom = new WP_Query( array(
                  'posts_per_page' => 3,
                  'post__not_in'   => array( get_the_ID() ),
                ) );
              }
              while ( $related_bottom->have_posts() ) : $related_bottom->the_post();
              ?>
                <a href="<?php the_permalink(); ?>" class="related-posts-bottom__card">
                  <div class="related-posts-bottom__thumb">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'medium', array( 'class' => 'related-posts-bottom__img' ) ); ?>
                    <?php else : ?>
                      <div class="related-posts-bottom__placeholder"></div>
                    <?php endif; ?>
                  </div>
                  <h4 class="related-posts-bottom__card-title"><?php the_title(); ?></h4>
                </a>
              <?php
              endwhile;
              wp_reset_postdata();
              ?>
            </div>
          </div>

        </article>

        <!-- Sidebar -->
        <aside class="single-post__sidebar">

          <!-- Free Guide CTA -->
          <div class="sidebar-cta">
            <span class="sidebar-cta__badge">
              <svg width="18" height="18" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
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

  headings.forEach(function(h, i) {
    const id = 'section-' + i;
    h.setAttribute('id', id);
    const link = document.createElement('a');
    link.href = '#' + id;
    link.textContent = h.textContent;
    link.className = 'sidebar-toc__link';
    tocNav.appendChild(link);
  });

  // Inject "How It Works" steps above the middle of the article
  var stepsEl = document.getElementById('blogSteps');
  if (stepsEl) {
    stepsEl.style.display = '';
    if (headings.length >= 4) {
      // Insert before the heading just above the midpoint
      var midIndex = Math.floor(headings.length / 2);
      content.insertBefore(stepsEl, headings[midIndex]);
    } else if (headings.length >= 2) {
      // Insert before the 2nd heading
      content.insertBefore(stepsEl, headings[1]);
    } else {
      // Few or no headings — insert after roughly half the child elements
      var children = content.children;
      var midChild = Math.floor(children.length / 2);
      if (midChild < children.length) {
        content.insertBefore(stepsEl, children[midChild]);
      } else {
        content.appendChild(stepsEl);
      }
    }
  }

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
