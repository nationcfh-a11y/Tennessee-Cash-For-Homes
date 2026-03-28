<?php
/**
 * Shared Situation Page Template
 * Included by each page-situation-*.php after setting variables.
 */

if ( ! isset( $situation_color ) ) $situation_color = '#84CC9C';

// SEO: Title tag
add_filter( 'pre_get_document_title', function( $title ) use ( $meta_title ) {
    return ! empty( $meta_title ) ? $meta_title : $title;
}, 99 );

// SEO: Meta tags handled by functions.php tcfh_seo_meta_tags via _tcfh_meta_desc
if ( ! empty( $meta_description ) ) {
    update_post_meta( get_the_ID(), '_tcfh_meta_desc', $meta_description );
}

get_header();
?>

<!-- ── SITUATION HERO ── -->
<section class="sit-hero">
  <div class="container">
    <div class="sit-hero__inner">
      <div class="sit-hero__content">
        <span class="sit-hero__badge">Tennessee Cash For Homes</span>
        <h1 class="sit-hero__h1"><?php echo esc_html( $situation_h1 ); ?></h1>
        <p class="sit-hero__sub"><?php echo esc_html( $situation_subheadline ); ?></p>
        <ul class="sit-hero__checks">
          <?php foreach ( array_slice( $situation_bullets, 0, 3 ) as $b ): ?>
          <li>
            <svg width="20" height="20" fill="#84CC9C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <?php echo esc_html( $b['title'] ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <a href="/#hero-form" class="btn-primary">Get My Free Cash Offer &rarr;</a>
        <p class="sit-hero__phone">Or call us now: <a href="tel:+16158018126">(615) 801-8126</a></p>
      </div>
      <div class="sit-hero__form-wrap">
        <div class="sit-hero__form-card">
          <h2 class="sit-hero__form-title">Get Your Free Cash Offer</h2>
          <p class="sit-hero__form-sub">Takes less than 60 seconds. No obligation.</p>
          <form onsubmit="handleSubmit(event)">
            <div class="form-group">
              <label for="sit-address">Property Address</label>
              <input type="text" id="sit-address" name="address" placeholder="123 Main St, Nashville, TN" required />
            </div>
            <div class="form-group">
              <label for="sit-name">Your Name</label>
              <input type="text" id="sit-name" name="name" placeholder="John Smith" required />
            </div>
            <div class="form-group">
              <label for="sit-phone">Phone Number</label>
              <input type="tel" id="sit-phone" name="phone" placeholder="(615) 555-0123" required />
            </div>
            <button type="submit" class="btn-primary btn-primary--block">Get My Cash Offer &rarr;</button>
          </form>
          <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── WE UNDERSTAND ── -->
<section class="sit-understand">
  <div class="container">
    <h2 class="sit-section-title">We Understand What You Are Going Through</h2>
    <div class="sit-understand__body">
      <p><?php echo esc_html( $situation_description_1 ); ?></p>
      <p><?php echo esc_html( $situation_description_2 ); ?></p>
    </div>
    <div class="sit-features">
      <div class="sit-feature-card">
        <div class="sit-feature-icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3>No Repairs Needed</h3>
        <p>We buy your home exactly as it is. No fixing, no cleaning, no updates required.</p>
      </div>
      <div class="sit-feature-card">
        <div class="sit-feature-icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h3>No Agent Fees</h3>
        <p>Zero commissions, zero closing costs. The offer we make is what you walk away with.</p>
      </div>
      <div class="sit-feature-card">
        <div class="sit-feature-icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <h3>Close in 14 Days</h3>
        <p>We can close in as little as 14 days or on your schedule. You pick the date.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── HOW WE HELP ── -->
<section class="sit-help">
  <div class="container">
    <h2 class="sit-section-title">How Tennessee Cash For Homes Helps With <?php echo esc_html( $situation_title ); ?></h2>
    <div class="sit-help__grid">
      <?php foreach ( $situation_bullets as $bullet ): ?>
      <div class="sit-help__card">
        <h3><?php echo esc_html( $bullet['title'] ); ?></h3>
        <p><?php echo esc_html( $bullet['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── OUR SIMPLE PROCESS ── -->
<section class="section section--alt">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Fast &amp; Simple Process</p>
      <h2 class="section__title">How to Sell Your Tennessee House Fast</h2>
      <p class="section__subtitle">No showings, no open houses, no waiting around. Selling your Tennessee home for cash has never been this simple.</p>
    </div>
    <div class="steps">
      <div class="step">
        <div class="step__num">1</div>
        <h3 class="step__title">Tell Us About Your Tennessee Property</h3>
        <p class="step__body">Fill out our quick form or give us a call. Share your property address and a few basic details. It takes less than 60 seconds and there is no obligation.</p>
      </div>
      <div class="step">
        <div class="step__num">2</div>
        <h3 class="step__title">Receive Your Free Cash Offer in 24 Hours</h3>
        <p class="step__body">We evaluate your property and send you a no-obligation, all-cash offer fast. Usually within 24 hours. No hidden fees, no lowball tactics, no pressure.</p>
      </div>
      <div class="step">
        <div class="step__num">3</div>
        <h3 class="step__title">Pick Your Closing Date &amp; Get Paid</h3>
        <p class="step__body">Accept the offer and choose a closing date that works for you. We can close in as little as 7 days or give you more time if you need it. We handle all the paperwork and cover the closing costs.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── WHY CHOOSE US ── -->
<section class="difference-section">
  <div class="difference__img-wrap">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/brand_assets/Company%20Photo.webp" alt="Tennessee Cash For Homes team" width="2000" height="1000" loading="lazy" decoding="async" />
  </div>
  <div class="difference__content-wrap">
    <div class="difference__content">
      <h2 class="difference__title">The <span>Tennessee Cash For Homes</span> Difference</h2>
      <p class="difference__intro">We are not a big out-of-state corporation or an automated system. We are a Middle Tennessee family owned business that believes in doing business the right way.</p>
      <ul class="difference__list">
        <li class="diff-item"><svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Based Right Here in Middle Tennessee</li>
        <li class="diff-item"><svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Family Owned and Relationship Focused</li>
        <li class="diff-item"><svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Fair and Straightforward Cash Offers</li>
        <li class="diff-item"><svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> No Cleaning, No Repairs, No Hidden Fees</li>
        <li class="diff-item"><svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Flexible Closing on Your Timeline</li>
      </ul>
      <div class="difference__trust-row">
        <div class="difference__stars">
          <div class="difference__stars-icons">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
          <div class="difference__stars-label"><strong>5 out of 5</strong> on Google</div>
        </div>
        <a href='https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick' target='_blank' rel='nofollow' class='bbb-seal'><img src='https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png' style='border: 0;' alt='Tennessee Cash For Homes BBB Business Review' width='200' height='42' loading='lazy' decoding='async' /></a>
      </div>
    </div>
  </div>
</section>

<!-- ── REVIEWS ── -->
<section class="section section--alt" id="testimonials">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">5-Star Google Reviews</p>
      <h2 class="section__title">What Tennessee Homeowners Are Saying About Us</h2>
    </div>
    <div class="reviews-outer" id="reviewsOuter">
      <div class="reviews-track" id="reviewsTrack">
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Such a great group to work with. They were able to give me a fair deal with no hassles. Thank you Karson for going above and beyond.</p>
            <div class="testimonial-author"><div class="testimonial-avatar">TH</div><div><div class="testimonial-name">Trish Haberman</div><div class="testimonial-location">Tennessee</div></div></div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">These guys were absolutely amazing. I sold my house without having to do a single repair and they even helped me find my next place to live!</p>
            <div class="testimonial-author"><div class="testimonial-avatar">CD</div><div><div class="testimonial-name">Clayton Daniels</div><div class="testimonial-location">Tennessee</div></div></div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Had a great experience with these guys. Very experienced and I would definitely work with them again!</p>
            <div class="testimonial-author"><div class="testimonial-avatar">SS</div><div><div class="testimonial-name">Sam Skare</div><div class="testimonial-location">Tennessee</div></div></div>
          </div>
        </div>
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">If you need to sell a home quickly, they're professional, fair, and truly care about making things easy for the seller. Highly recommend.</p>
            <div class="testimonial-author"><div class="testimonial-avatar">LD</div><div><div class="testimonial-name">Lisa Daniels</div><div class="testimonial-location">Tennessee</div></div></div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Great experience working with these guys. Both Davis and Dowling were true to their word. I would work with them again any day.</p>
            <div class="testimonial-author"><div class="testimonial-avatar">CP</div><div><div class="testimonial-name">Christopher Payne</div><div class="testimonial-location">Middle Tennessee</div></div></div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">The best to work with yet. Answered every question and very supportive! 10/10 recommend.</p>
            <div class="testimonial-author"><div class="testimonial-avatar">KB</div><div><div class="testimonial-name">Kelsie Balfour</div><div class="testimonial-location">Tennessee</div></div></div>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-controls">
      <button class="carousel-btn" id="revPrev" aria-label="Previous reviews"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
      <div class="carousel-dots" id="revDots"></div>
      <button class="carousel-btn" id="revNext" aria-label="Next reviews"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></button>
    </div>
  </div>
</section>

<!-- ── FAQ ── -->
<section class="sit-faq-section">
  <div class="container">
    <h2 class="sit-section-title">Common Questions About <?php echo esc_html( $situation_title ); ?></h2>
    <div class="sit-faq-list">
      <?php foreach ( $situation_faq as $faq ): ?>
      <div class="sit-faq-item">
        <div class="situation-faq-question">
          <h3><?php echo esc_html( $faq['q'] ); ?></h3>
          <span class="faq-icon">+</span>
        </div>
        <div class="situation-faq-answer">
          <p><?php echo esc_html( $faq['a'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FAQ Schema -->
<script type="application/ld+json">
<?php
echo wp_json_encode( array(
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map( function( $faq ) {
        return array(
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ),
        );
    }, $situation_faq ),
), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>

<!-- Service Schema -->
<script type="application/ld+json">
<?php
echo wp_json_encode( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    'name'        => $situation_title,
    'provider'    => array(
        '@type'     => 'RealEstateAgent',
        'name'      => 'Tennessee Cash For Homes',
        'telephone' => '+16158018126',
        'url'       => home_url( '/' ),
        'areaServed'=> 'Tennessee',
    ),
    'description' => $meta_description,
    'url'         => home_url( '/' . $situation_slug ),
), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>

<!-- ── AREAS WE SERVE ── -->
<section class="section section--alt">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Statewide Coverage</p>
      <h2 class="section__title">Areas We Serve Across Tennessee</h2>
      <p class="section__subtitle">We buy houses throughout the entire state of Tennessee. Whether you are in a major metro or a small town, we can make you a cash offer.</p>
    </div>
    <div class="cities-grid">
      <?php
      $cities = array(
          'Nashville','Murfreesboro','Knoxville','Memphis','Clarksville','Chattanooga',
          'Franklin','Shelbyville','Antioch','Smyrna','La Vergne','Gallatin',
          'Columbia','Spring Hill','Lebanon','Jackson','Hendersonville','Crossville',
          'McMinnville','Old Hickory','Woodbury'
      );
      foreach ( $cities as $c ):
          $slug = strtolower( str_replace( ' ', '-', $c ) );
      ?>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/' . $slug ) ); ?>" class="city-chip">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
        <span><?php echo esc_html( $c ); ?></span>
      </a>
      <?php endforeach; ?>
      <a href="<?php echo esc_url( home_url( '/where-we-buy/tennessee' ) ); ?>" class="city-chip city-chip--full">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
        <span>Anywhere in Tennessee &mdash; We Serve All Areas</span>
      </a>
    </div>
  </div>
</section>

<!-- ── FINAL CTA ── -->
<section class="sit-cta">
  <div class="container" style="text-align:center;">
    <h2 class="sit-cta__title"><?php echo esc_html( $situation_cta_headline ); ?></h2>
    <p class="sit-cta__sub">Get a fair cash offer in 24 hours. No repairs. No fees. No stress.</p>
    <a href="/#hero-form" class="btn-primary sit-cta__btn">Get My Free Cash Offer &rarr;</a>
    <p class="sit-cta__phone">Or call us now: <a href="tel:+16158018126">(615) 801-8126</a></p>
  </div>
</section>

<script>
// FAQ Accordion
document.addEventListener('DOMContentLoaded', function() {
    var questions = document.querySelectorAll('.situation-faq-question');
    questions.forEach(function(question) {
        question.addEventListener('click', function() {
            var answer = this.nextElementSibling;
            var icon = this.querySelector('.faq-icon');
            var isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
            document.querySelectorAll('.situation-faq-answer').forEach(function(a) {
                a.style.maxHeight = '0px';
                a.style.opacity = '0';
            });
            document.querySelectorAll('.sit-faq-item .faq-icon').forEach(function(i) {
                i.textContent = '+';
            });
            if (!isOpen) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                answer.style.opacity = '1';
                icon.textContent = '\u2212';
            }
        });
    });

    // Reviews carousel for situation pages
    var track = document.getElementById('reviewsTrack');
    var outer = document.getElementById('reviewsOuter');
    var dotsWrap = document.getElementById('revDots');
    var btnPrev = document.getElementById('revPrev');
    var btnNext = document.getElementById('revNext');
    if (!track) return;
    var TOTAL = track.children.length;
    var current = 0;
    for (var i = 0; i < TOTAL; i++) {
        var dot = document.createElement('button');
        dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
        dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
        (function(idx) { dot.addEventListener('click', function() { goTo(idx); }); })(i);
        dotsWrap.appendChild(dot);
    }
    function goTo(n) {
        current = (n + TOTAL) % TOTAL;
        track.style.transform = 'translateX(-' + (current * (100 / TOTAL)) + '%)';
        dotsWrap.querySelectorAll('.carousel-dot').forEach(function(d, idx) {
            d.classList.toggle('active', idx === current);
        });
    }
    btnNext.addEventListener('click', function() { goTo(current + 1); });
    btnPrev.addEventListener('click', function() { goTo(current - 1); });
});
</script>

<?php get_footer(); ?>
