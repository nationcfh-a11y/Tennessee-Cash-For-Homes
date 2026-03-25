<?php
/**
 * Template Name: Where We Buy
 *
 * Main landing page showcasing all 23 city location pages.
 *
 * WordPress setup:
 *   Slug:     where-we-buy
 *   Template: Where We Buy  (select in Page Attributes)
 *   Menu:     Add the page to your nav under Appearance → Menus
 */
get_header(); ?>

<?php
$cities = [
  ['name'=>'Nashville',      'slug'=>'nashville',      'desc'=>'Music City\'s booming market means we can close fast.',                  'price'=>'$480,000'],
  ['name'=>'Murfreesboro',   'slug'=>'murfreesboro',   'desc'=>'One of Tennessee\'s fastest-growing cities.',                            'price'=>'$379,900'],
  ['name'=>'Franklin',       'slug'=>'franklin',       'desc'=>'Historic charm meets one of Tennessee\'s hottest real estate markets.',   'price'=>'$700,000'],
  ['name'=>'Chattanooga',    'slug'=>'chattanooga',    'desc'=>'Scenic city with a fast-growing urban core and outdoor lifestyle.',       'price'=>'$330,000'],
  ['name'=>'Knoxville',      'slug'=>'knoxville',      'desc'=>'Gateway to the Smoky Mountains with a strong housing market.',           'price'=>'$300,000'],
  ['name'=>'Memphis',        'slug'=>'memphis',        'desc'=>'Home of Beale Street — we make fast cash deals happen here too.',        'price'=>'$210,000'],
  ['name'=>'Clarksville',    'slug'=>'clarksville',    'desc'=>'A growing city with a strong military community and steady demand.',     'price'=>'$299,000'],
  ['name'=>'Spring Hill',    'slug'=>'spring-hill',    'desc'=>'Family-friendly suburb near Nashville with rapid growth.',               'price'=>'$450,000'],
  ['name'=>'Hendersonville', 'slug'=>'hendersonville', 'desc'=>'Stunning lakeside community with strong schools and great neighbors.',   'price'=>'$430,000'],
  ['name'=>'Columbia',       'slug'=>'columbia',       'desc'=>'Charming downtown with rich history and a thriving community.',          'price'=>'$365,000'],
  ['name'=>'Smyrna',         'slug'=>'smyrna',         'desc'=>'Fast-growing community southeast of Nashville with great access.',       'price'=>'$349,900'],
  ['name'=>'Gallatin',       'slug'=>'gallatin',       'desc'=>'Small-town feel with big-city access, right outside Nashville.',        'price'=>'$399,900'],
  ['name'=>'Lebanon',        'slug'=>'lebanon',        'desc'=>'Small-town charm with convenient I-40 access close to Nashville.',       'price'=>'$389,900'],
  ['name'=>'Antioch',        'slug'=>'antioch',        'desc'=>'A growing Nashville suburb with strong residential demand.',             'price'=>'$330,500'],
  ['name'=>'La Vergne',      'slug'=>'la-vergne',      'desc'=>'Southeast of Nashville and growing fast with new developments.',         'price'=>'$325,000'],
  ['name'=>'Jackson',        'slug'=>'jackson',        'desc'=>'The regional hub for West Tennessee with a diverse housing market.',     'price'=>'$215,000'],
  ['name'=>'Crossville',     'slug'=>'crossville',     'desc'=>'Known as the Golf Capital of Tennessee with a peaceful lifestyle.',      'price'=>'$299,000'],
  ['name'=>'McMinnville',    'slug'=>'mcminnville',    'desc'=>'A peaceful agricultural community with scenic beauty and rural charm.',  'price'=>'$275,000'],
  ['name'=>'Old Hickory',    'slug'=>'old-hickory',    'desc'=>'Historic community with river access and proximity to Nashville.',       'price'=>'$335,000'],
  ['name'=>'Shelbyville',    'slug'=>'shelbyville',    'desc'=>'The Walking Horse Capital of the World with farmland and rural charm.',  'price'=>'$305,000'],
  ['name'=>'Woodbury',       'slug'=>'woodbury',       'desc'=>'Quiet small town with rolling hills and peaceful rural living.',         'price'=>'$270,000'],
  ['name'=>'Chapel Hill',    'slug'=>'chapel-hill',    'desc'=>'Quaint rural town with Southern charm and a tight-knit community.',     'price'=>'$339,600'],
  ['name'=>'Tennessee',      'slug'=>'tennessee',      'desc'=>'Serving the entire state — wherever you are, we can help.',             'price'=>'$350,000'],
];
?>

<!-- ── HERO ── -->
<section class="wwb-hero">
  <div class="container">
    <div class="wwb-hero__inner">
      <p class="section__eyebrow">Tennessee Cash Home Buyers</p>
      <h1 class="wwb-hero__title">Where We Buy Houses<br><span>in Tennessee</span></h1>
      <p class="wwb-hero__sub">We proudly buy homes across Middle Tennessee and beyond. Whether you are in a big city or a small town, we make selling your house simple, fast, and stress-free.</p>
      <div class="wwb-hero__btns">
        <a href="<?php echo esc_url( home_url('/#get-offer') ); ?>" class="btn-primary">Get Your Cash Offer &rarr;</a>
        <a href="#city-cards" class="btn-outline-green">See Cities We Serve</a>
      </div>
    </div>
  </div>
</section>

<!-- ── STATS BAR ── -->
<div class="proof-bar wwb-stats">
  <div class="container">
    <div class="proof-bar__inner">
      <div class="proof-stat wwb-fade">
        <div class="proof-stat__num">1,200+</div>
        <div class="proof-stat__label">Homes Purchased</div>
      </div>
      <div class="proof-divider"></div>
      <div class="proof-stat wwb-fade">
        <div class="proof-stat__num">23</div>
        <div class="proof-stat__label">Cities Served</div>
      </div>
      <div class="proof-divider"></div>
      <div class="proof-stat wwb-fade">
        <div class="proof-stat__num">5.0 &#9733;</div>
        <div class="proof-stat__label">Google Rated</div>
      </div>
    </div>
  </div>
</div>

<!-- ── CITY SEARCH ── -->
<section class="section section--alt wwb-search-section">
  <div class="container">
    <div class="wwb-search-wrap wwb-fade">
      <p class="section__eyebrow" style="text-align:center;">Find Your City</p>
      <h2 class="section__title" style="text-align:center; margin-bottom:28px;">Is Your City on Our List?</h2>
      <div class="wwb-search-box">
        <svg class="wwb-search-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" id="wwbCitySearch" class="wwb-search-input" placeholder="Type your city name..." autocomplete="off" aria-label="Search cities" />
        <div id="wwbDropdown" class="wwb-dropdown" role="listbox" aria-label="City suggestions"></div>
      </div>
      <div id="wwbResult" class="wwb-result" aria-live="polite"></div>
    </div>
  </div>
</section>

<!-- ── CITY CARDS ── -->
<section class="section wwb-cards-section" id="city-cards">
  <div class="container">
    <div class="section__header section__header--center wwb-fade">
      <p class="section__eyebrow">All Locations</p>
      <h2 class="section__title">Cities We Serve Across Tennessee</h2>
      <p class="section__subtitle">Click any city below to learn more about selling your house for cash in that area.</p>
    </div>
    <div class="wwb-cards-grid">
      <?php foreach ( $cities as $c ) :
        $url = esc_url( home_url( '/where-we-buy/' . $c['slug'] ) );
      ?>
      <a href="<?php echo $url; ?>" class="wwb-card wwb-fade">
        <div class="wwb-card__inner">
          <div class="wwb-card__pin">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
          </div>
          <h3 class="wwb-card__city"><?php echo esc_html( $c['name'] ); ?></h3>
          <p class="wwb-card__desc"><?php echo esc_html( $c['desc'] ); ?></p>
          <div class="wwb-card__stat">
            <span class="wwb-card__stat-label">Median Sale Price</span>
            <span class="wwb-card__stat-val"><?php echo esc_html( $c['price'] ); ?></span>
          </div>
          <span class="wwb-card__btn">Sell My House in <?php echo esc_html( $c['name'] ); ?> &rarr;</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── WHY CHOOSE US ── -->
<section class="section section--alt wwb-why">
  <div class="container">
    <div class="section__header section__header--center wwb-fade">
      <p class="section__eyebrow">Why Us</p>
      <h2 class="section__title">Why Tennessee Homeowners Choose Us</h2>
    </div>
    <div class="hiw-feature-cards wwb-fade">
      <div class="hiw-feature-card">
        <div class="hiw-feature-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <h3 class="hiw-feature-title">Fast Closings</h3>
        <p class="hiw-feature-body">Close in as little as 14 days, on your schedule. We work around your timeline — not ours.</p>
      </div>
      <div class="hiw-feature-card">
        <div class="hiw-feature-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <h3 class="hiw-feature-title">No Repairs Needed</h3>
        <p class="hiw-feature-body">We buy houses in any condition, as-is. Don't spend a single dollar on repairs or cleaning.</p>
      </div>
      <div class="hiw-feature-card">
        <div class="hiw-feature-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h3 class="hiw-feature-title">No Commissions</h3>
        <p class="hiw-feature-body">Zero agent fees, zero hidden costs. The offer we make is the amount you walk away with.</p>
      </div>
      <div class="hiw-feature-card">
        <div class="hiw-feature-icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <h3 class="hiw-feature-title">Local Tennessee Company</h3>
        <p class="hiw-feature-body">We live and work here too. We know every market across the state and truly care about our neighbors.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── CTA BAND ── -->
<section class="cta-band">
  <div class="container">
    <h2>Ready to Sell Your Tennessee House Fast?</h2>
    <p>Get a fair cash offer from a trusted local Tennessee home buyer. No repairs, no fees, no stress.</p>
    <a href="<?php echo esc_url( home_url('/#get-offer') ); ?>" class="btn-white">Get My Cash Offer &rarr;</a>
    <span class="cta-phone">Or call us directly: <a href="tel:+16158018126">(615) 801-8126</a></span>
  </div>
</section>

<script>
(function () {
  /* ── City search data ── */
  var cities = <?php
    $js_cities = array_map(function($c) {
      return ['name' => $c['name'], 'slug' => $c['slug'], 'url' => home_url('/where-we-buy/' . $c['slug'])];
    }, $cities);
    echo json_encode($js_cities);
  ?>;

  var input    = document.getElementById('wwbCitySearch');
  var dropdown = document.getElementById('wwbDropdown');
  var result   = document.getElementById('wwbResult');
  var selected = null;

  function norm(s) { return s.toLowerCase().replace(/[-\s]/g, ''); }

  function renderDropdown(matches) {
    if (!matches.length) { dropdown.innerHTML = ''; dropdown.classList.remove('wwb-dropdown--open'); return; }
    dropdown.innerHTML = matches.map(function(c) {
      return '<div class="wwb-dropdown__item" role="option" tabindex="0" data-slug="' + c.slug + '" data-url="' + c.url + '">' +
             '<svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>' +
             '<span>' + c.name + '</span></div>';
    }).join('');
    dropdown.classList.add('wwb-dropdown--open');
  }

  function showResult(city) {
    selected = city;
    result.innerHTML =
      '<div class="wwb-result__inner">' +
        '<p class="wwb-result__yes">&#10003;&nbsp; Yes! We buy houses in <strong>' + city.name + '</strong></p>' +
        '<a href="' + city.url + '" class="btn-primary wwb-result__btn">Get My Cash Offer in ' + city.name + ' &rarr;</a>' +
      '</div>';
    result.classList.add('wwb-result--visible');
    dropdown.innerHTML = '';
    dropdown.classList.remove('wwb-dropdown--open');
  }

  input.addEventListener('input', function () {
    var q = norm(this.value.trim());
    result.classList.remove('wwb-result--visible');
    if (!q) { renderDropdown([]); return; }
    var matches = cities.filter(function(c) { return norm(c.name).indexOf(q) === 0; });
    if (!matches.length) matches = cities.filter(function(c) { return norm(c.name).indexOf(q) !== -1; });
    renderDropdown(matches.slice(0, 6));
  });

  dropdown.addEventListener('click', function (e) {
    var item = e.target.closest('.wwb-dropdown__item');
    if (!item) return;
    var city = cities.find(function(c) { return c.slug === item.dataset.slug; });
    if (city) { input.value = city.name; showResult(city); }
  });

  dropdown.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
      var item = e.target.closest('.wwb-dropdown__item');
      if (!item) return;
      var city = cities.find(function(c) { return c.slug === item.dataset.slug; });
      if (city) { input.value = city.name; showResult(city); }
    }
  });

  document.addEventListener('click', function (e) {
    if (!e.target.closest('.wwb-search-box')) {
      dropdown.classList.remove('wwb-dropdown--open');
    }
  });

  /* ── Smooth scroll for hero anchor link ── */
  document.querySelectorAll('a[href="#city-cards"]').forEach(function(a) {
    a.addEventListener('click', function(e) {
      e.preventDefault();
      var target = document.getElementById('city-cards');
      if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });

  /* ── Intersection Observer fade-ins ── */
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('wwb-fade--in');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    document.querySelectorAll('.wwb-fade').forEach(function(el) { io.observe(el); });
  } else {
    document.querySelectorAll('.wwb-fade').forEach(function(el) { el.classList.add('wwb-fade--in'); });
  }
}());
</script>

<?php get_footer(); ?>
