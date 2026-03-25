<?php
/**
 * Template Name: Where We Buy
 *
 * WordPress setup:
 *   Slug:     where-we-buy
 *   Template: Where We Buy  (select in Page Attributes)
 *   Menu:     Add under Appearance > Menus
 */
get_header();

$cities = [
  ['name'=>'Nashville',      'slug'=>'nashville',      'image'=>'Nashville.webp',      'price'=>'$480,000'],
  ['name'=>'Murfreesboro',   'slug'=>'murfreesboro',   'image'=>'Murfreesboro.webp',   'price'=>'$379,900'],
  ['name'=>'Franklin',       'slug'=>'franklin',       'image'=>'Franklin.webp',       'price'=>'$700,000'],
  ['name'=>'Chattanooga',    'slug'=>'chattanooga',    'image'=>'Chattanooga.webp',    'price'=>'$330,000'],
  ['name'=>'Knoxville',      'slug'=>'knoxville',      'image'=>'Knoxville.webp',      'price'=>'$300,000'],
  ['name'=>'Memphis',        'slug'=>'memphis',        'image'=>'Memphis.webp',        'price'=>'$210,000'],
  ['name'=>'Clarksville',    'slug'=>'clarksville',    'image'=>'Clarksville.webp',    'price'=>'$299,000'],
  ['name'=>'Spring Hill',    'slug'=>'spring-hill',    'image'=>'Spring Hill.webp',    'price'=>'$450,000'],
  ['name'=>'Hendersonville', 'slug'=>'hendersonville', 'image'=>'Hendersonville.webp', 'price'=>'$430,000'],
  ['name'=>'Columbia',       'slug'=>'columbia',       'image'=>'Columbia.webp',       'price'=>'$365,000'],
  ['name'=>'Smyrna',         'slug'=>'smyrna',         'image'=>'Smyrna.webp',         'price'=>'$349,900'],
  ['name'=>'Gallatin',       'slug'=>'gallatin',       'image'=>'Gallatin.webp',       'price'=>'$399,900'],
  ['name'=>'Lebanon',        'slug'=>'lebanon',        'image'=>'Lebanon.webp',        'price'=>'$389,900'],
  ['name'=>'Antioch',        'slug'=>'antioch',        'image'=>'Antioch.webp',        'price'=>'$330,500'],
  ['name'=>'La Vergne',      'slug'=>'la-vergne',      'image'=>'La Vergne.webp',      'price'=>'$325,000'],
  ['name'=>'Jackson',        'slug'=>'jackson',        'image'=>'Jackson.webp',        'price'=>'$215,000'],
  ['name'=>'Crossville',     'slug'=>'crossville',     'image'=>'Crossville.webp',     'price'=>'$299,000'],
  ['name'=>'McMinnville',    'slug'=>'mcminnville',    'image'=>'McMinnville.webp',    'price'=>'$275,000'],
  ['name'=>'Old Hickory',    'slug'=>'old-hickory',    'image'=>'Old Hickory.webp',    'price'=>'$335,000'],
  ['name'=>'Shelbyville',    'slug'=>'shelbyville',    'image'=>'Shelbyville.webp',    'price'=>'$305,000'],
  ['name'=>'Woodbury',       'slug'=>'woodbury',       'image'=>'Woodbury.webp',       'price'=>'$270,000'],
  ['name'=>'Chapel Hill',    'slug'=>'chapel-hill',    'image'=>'Chapel Hill.webp',    'price'=>'$339,600'],
  ['name'=>'Tennessee',      'slug'=>'tennessee',      'image'=>'Tennessee.webp',      'price'=>'$350,000'],
];

$img_base = get_template_directory_uri() . '/brand_assets/Where%20We%20Buy%20Pages/Where%20We%20Buy%20Images/';
$tn_hero  = esc_url( $img_base . 'Tennessee.webp' );
?>

<!-- ════════════════════════════════════════════
     HERO
════════════════════════════════════════════ -->
<section class="wwb-hero" style="background-image:url('<?php echo $tn_hero; ?>');">
  <div class="wwb-hero__overlay"></div>
  <div class="container wwb-hero__container">
    <div class="wwb-hero__inner wwb-animate-hero">
      <p class="wwb-hero__eyebrow">Tennessee Cash Home Buyers</p>
      <h1 class="wwb-hero__title">Where We Buy<br><span>Houses in Tennessee</span></h1>
      <div class="wwb-hero__accent"></div>
      <p class="wwb-hero__sub">We buy homes across all of Tennessee. Whether you are in a big city or a small town, we make selling your house simple, fast, and stress-free.</p>
      <div class="wwb-hero__btns">
        <a href="<?php echo esc_url( home_url('/#get-offer') ); ?>" class="wwb-btn-hero-primary">Get Your Free Cash Offer &rarr;</a>
        <a href="#city-cards" class="wwb-btn-hero-outline">See All 23 Cities &darr;</a>
      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     STATS BAR
════════════════════════════════════════════ -->
<div class="wwb-stats-bar">
  <div class="container">
    <div class="wwb-stats-bar__inner">

      <div class="wwb-stat wwb-fade">
        <div class="wwb-stat__icon">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <div class="wwb-stat__num">1,200+</div>
        <div class="wwb-stat__label">Homes Purchased</div>
      </div>

      <div class="wwb-stat-divider"></div>

      <div class="wwb-stat wwb-fade">
        <div class="wwb-stat__icon">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9z"/><circle cx="10" cy="10" r="3" fill="currentColor" opacity=".3"/></svg>
        </div>
        <div class="wwb-stat__num">23</div>
        <div class="wwb-stat__label">Cities Served</div>
      </div>

      <div class="wwb-stat-divider"></div>

      <div class="wwb-stat wwb-fade">
        <div class="wwb-stat__icon">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <div class="wwb-stat__num">5.0 &#9733;</div>
        <div class="wwb-stat__label">Google Rated</div>
      </div>

    </div>
  </div>
</div>

<!-- ════════════════════════════════════════════
     MISSION SPLIT
════════════════════════════════════════════ -->
<section class="section wwb-mission" id="city-cards">
  <div class="container">
    <div class="wwb-mission__inner">

      <div class="wwb-mission__text wwb-fade">
        <p class="section__eyebrow">Who We Are</p>
        <h2 class="wwb-mission__title">Our Mission at <span>Tennessee Cash For Homes</span></h2>
        <p class="wwb-mission__body">At Tennessee Cash For Homes, our mission is simple: make selling your home as stress-free and straightforward as possible. We believe every homeowner deserves a fair offer, a fast closing, and a team that truly has their best interests at heart, no matter the condition of the property or the circumstances behind the sale.</p>
        <p class="wwb-mission__body">We are a locally owned Tennessee company, not a national chain. We live in the same communities we serve, which means we understand the local market and genuinely care about the people we work with. From Nashville to Memphis to small towns across the state, we are proud to be your trusted neighbor in real estate.</p>
        <div class="wwb-mission__badges">
          <div class="wwb-mission__badge">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span>No repairs required</span>
          </div>
          <div class="wwb-mission__badge">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span>Zero agent fees or commissions</span>
          </div>
          <div class="wwb-mission__badge">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span>Close in as little as 7 days</span>
          </div>
          <div class="wwb-mission__badge">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span>Locally owned and operated</span>
          </div>
        </div>
        <a href="<?php echo esc_url( home_url('/#get-offer') ); ?>" class="btn-primary" style="margin-top:32px;display:inline-block;">Get My Free Cash Offer &rarr;</a>
      </div>

      <div class="wwb-mission__photo-grid wwb-fade">
        <?php foreach ( array_slice($cities, 0, 4) as $f ) :
          $furl = esc_url( home_url('/where-we-buy/' . $f['slug']) );
          $fimg = esc_url( $img_base . rawurlencode($f['image']) );
        ?>
        <a href="<?php echo $furl; ?>" class="wwb-mini-card" style="background-image:url('<?php echo $fimg; ?>');">
          <div class="wwb-mini-card__overlay"></div>
          <span class="wwb-mini-card__name"><?php echo esc_html($f['name']); ?></span>
        </a>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     CITY PHOTO CARDS
════════════════════════════════════════════ -->
<section class="section section--alt wwb-cards-section">
  <div class="container">
    <div class="section__header section__header--center wwb-fade">
      <p class="section__eyebrow">All Locations</p>
      <h2 class="section__title">Cities We Serve Across Tennessee</h2>
      <p class="section__subtitle">Click any city to learn more about selling your house for cash in that area.</p>
    </div>
    <div class="wwb-photo-grid">
      <?php foreach ( $cities as $c ) :
        $url = esc_url( home_url('/where-we-buy/' . $c['slug']) );
        $img = esc_url( $img_base . rawurlencode($c['image']) );
      ?>
      <a href="<?php echo $url; ?>" class="wwb-photo-card wwb-fade" style="background-image:url('<?php echo $img; ?>');">
        <div class="wwb-photo-card__gradient"></div>
        <div class="wwb-photo-card__hover"></div>
        <div class="wwb-photo-card__footer">
          <span class="wwb-photo-card__price"><?php echo esc_html($c['price']); ?></span>
          <h3 class="wwb-photo-card__name"><?php echo esc_html($c['name']); ?></h3>
        </div>
        <div class="wwb-photo-card__cta">
          <span>Sell My House in <?php echo esc_html($c['name']); ?> &rarr;</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     WHY CHOOSE US
════════════════════════════════════════════ -->
<section class="section wwb-why">
  <div class="container">
    <div class="section__header section__header--center wwb-fade">
      <p class="section__eyebrow">Why Us</p>
      <h2 class="section__title">Why Tennessee Homeowners Choose Us</h2>
    </div>
    <div class="wwb-why__grid">

      <div class="wwb-why__card wwb-fade">
        <div class="wwb-why__icon">
          <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <h3 class="wwb-why__title">Fast Closings</h3>
        <p class="wwb-why__body">Close in as little as 14 days, on your schedule. We work around your timeline and move at whatever pace works best for you.</p>
      </div>

      <div class="wwb-why__card wwb-fade">
        <div class="wwb-why__icon">
          <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <h3 class="wwb-why__title">No Repairs Needed</h3>
        <p class="wwb-why__body">We buy houses in any condition, completely as-is. Do not spend a single dollar on repairs, cleaning, or staging before you sell.</p>
      </div>

      <div class="wwb-why__card wwb-fade">
        <div class="wwb-why__icon">
          <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h3 class="wwb-why__title">No Commissions</h3>
        <p class="wwb-why__body">Zero agent fees and zero hidden costs. The offer we make is exactly the amount you walk away with at closing.</p>
      </div>

      <div class="wwb-why__card wwb-fade">
        <div class="wwb-why__icon">
          <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <h3 class="wwb-why__title">Local Tennessee Company</h3>
        <p class="wwb-why__body">We live and work in Tennessee too. We know every market across the state and genuinely care about the neighbors we serve.</p>
      </div>

    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     CTA BAND
════════════════════════════════════════════ -->
<section class="wwb-cta-band">
  <div class="wwb-cta-band__bg"></div>
  <div class="container wwb-cta-band__content wwb-fade">
    <p class="wwb-cta-band__eyebrow">Get Started Today</p>
    <h2 class="wwb-cta-band__title">Ready to Sell Your Tennessee House Fast?</h2>
    <p class="wwb-cta-band__sub">Get a fair cash offer from a trusted local Tennessee home buyer. No repairs, no fees, no stress. Close on your schedule.</p>
    <a href="<?php echo esc_url( home_url('/#get-offer') ); ?>" class="wwb-cta-band__btn">Get My Free Cash Offer &rarr;</a>
    <div class="wwb-cta-band__phone">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.9 1.17h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 5.99 5.99l1.2-1.2a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
      <span>Or call us now: <a href="tel:+16158018126">(615) 801-8126</a></span>
    </div>
  </div>
</section>

<script>
(function () {
  /* ── Smooth scroll for anchor links ── */
  document.querySelectorAll('a[href^="#"]').forEach(function (a) {
    a.addEventListener('click', function (e) {
      var id = this.getAttribute('href').slice(1);
      var target = document.getElementById(id);
      if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    });
  });

  /* ── Hero animate-in on load ── */
  var hero = document.querySelector('.wwb-animate-hero');
  if (hero) { requestAnimationFrame(function () { hero.classList.add('wwb-animate-hero--in'); }); }

  /* ── Intersection Observer fade-ins ── */
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('wwb-fade--in');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    document.querySelectorAll('.wwb-fade').forEach(function (el) { io.observe(el); });
  } else {
    document.querySelectorAll('.wwb-fade').forEach(function (el) { el.classList.add('wwb-fade--in'); });
  }
}());
</script>

<?php get_footer(); ?>
