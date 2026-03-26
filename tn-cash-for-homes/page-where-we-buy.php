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
  ['name'=>'Tennessee',      'slug'=>'tennessee',      'image'=>'Tennessee.webp',      'price'=>'$350,000'],
];

$img_base    = get_template_directory_uri() . '/brand_assets/Where%20We%20Buy%20Pages/Where%20We%20Buy%20Images/';
?>

<!-- ════════════════════════════════════════════
     HERO
════════════════════════════════════════════ -->
<section class="wwb-hero" style="background: url('https://nationcfh.wpcomstaging.com/wp-content/uploads/2026/03/Where-we-buy-background-image.webp') center center / cover no-repeat;">
  <div class="wwb-hero__overlay"></div>
  <div class="container wwb-hero__container">
    <div class="wwb-hero__inner wwb-animate-hero">
      <p class="wwb-hero__eyebrow">Tennessee Cash Home Buyers</p>
      <h1 class="wwb-hero__title">Where We Buy<br><span>Houses in Tennessee</span></h1>
      <div class="wwb-hero__accent"></div>
      <p class="wwb-hero__sub">We buy homes across all of Tennessee. Whether you are in a big city or a small town, we make selling your house simple, fast, and stress-free.</p>
      <div class="wwb-hero__btns">
        <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>" class="wwb-btn-hero-primary">Get Your Free Cash Offer &rarr;</a>
        <a href="#city-cards" class="wwb-btn-hero-outline">See All 23 Cities &darr;</a>
      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     STATS BAR (white)
════════════════════════════════════════════ -->
<div class="wwb-stats-bar-white">
  <div class="container">
    <div class="wwb-stats-bar-white__inner">

      <div class="wwb-stat-white wwb-fade">
        <div class="wwb-stat-white__num">1,200+</div>
        <div class="wwb-stat-white__label">Homes Purchased</div>
      </div>

      <div class="wwb-stat-white-divider"></div>

      <div class="wwb-stat-white wwb-fade">
        <div class="wwb-stat-white__num">23</div>
        <div class="wwb-stat-white__label">Cities Served</div>
      </div>

      <div class="wwb-stat-white-divider"></div>

      <div class="wwb-stat-white wwb-fade">
        <div class="wwb-stat-white__num">5.0 &#9733;</div>
        <div class="wwb-stat-white__label">Google Rated</div>
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
        <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>" class="btn-primary" style="margin-top:32px;display:inline-block;">Get My Free Cash Offer &rarr;</a>
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
     TENNESSEE COUNTY MAP
════════════════════════════════════════════ -->
<section class="section tn-map-section" id="county-map">
  <div class="container">
    <div class="section__header section__header--center wwb-fade">
      <p class="section__eyebrow">Statewide Coverage</p>
      <h2 class="section__title">We Buy Houses in Every Tennessee County</h2>
      <p class="section__subtitle">Hover over any county to see where we buy. Click to learn more about selling your house in that area.</p>
    </div>
  </div>
  <div class="tn-map-wrapper">
    <div class="tn-map-svg-wrap">
      <svg viewBox="1.32 0.99 88.28 23.64" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" aria-label="Interactive map of Tennessee counties" role="img">
        <g transform="matrix(1, 0.11538, 0, 1, 0, -10.0385)">
        <g class="county-group" data-county="Sullivan" data-slug="sullivan-county">
          <path class="county-path" id="sullivan" d="m 87.262059,2.2064028 -1.393,1.601 -3.011,1.906 -0.473,0.062 -0.162,-0.048 -0.51,-0.371 -0.355,-0.072 -0.614,0.194 -1.266,0.249 -0.568,0.089 0.433,-2.19 3.205,-0.478 0.513,-0.077 0.992,-0.135 2.158,-0.311 0.072,-0.302 0.979,-0.117" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Sullivan County</title></path>
        </g>
        <g class="county-group" data-county="Johnson" data-slug="johnson-county">
          <path class="county-path" id="johnson" d="m 87.262059,2.2064028 1.834,-0.248 -0.266,0.353 -0.049,2.644 0.039,0.614 -0.215,0.072 -0.019,0 -0.161,0.008 -0.27,-0.086 -0.064,-0.148 -0.054,0.031 -0.013,0.01 -0.514,0.352 -0.474,0.531 -0.076,0.207 -0.108,0.311 -0.181,0.069 -0.343,-0.293 -0.703,-0.732 -0.157,-0.31 0.798,-1.348 0,-0.04 -0.397,-0.396 1.393,-1.601" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Johnson County</title></path>
        </g>
        <g class="county-group" data-county="McNairy" data-slug="mcnairy-county">
          <path class="county-path" id="mcnairy" d="m 21.823059,25.859401 0.216,5.003 -4.249,0.338 -0.199,-3.271 0.784,-0.388 0.117,-0.496 0.19,-0.343 0.266,-0.347 0.505,-0.252 0.193,-0.082 0.577,-0.09 1.6,-0.072" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>McNairy County</title></path>
        </g>
        <g class="county-group" data-county="Chester" data-slug="chester-county">
          <path class="county-path" id="chester" d="m 19.002059,23.385401 2.803,1.982 0.018,0.492 -1.6,0.072 -0.577,0.09 -0.193,0.082 -0.505,0.252 -0.266,0.347 -0.19,0.343 -0.117,0.496 -0.784,0.388 -0.217,-0.965 -0.546,-0.758 -0.039,-0.562 2.213,-2.259" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Chester County</title></path>
        </g>
        <g class="county-group" data-county="Hardeman" data-slug="hardeman-county">
          <path class="county-path" id="hardeman" d="m 14.315059,25.783401 2.474,-0.139 0.039,0.562 0.546,0.758 0.217,0.965 0.199,3.271 -0.383,0.032 -2.034,0.158 -1.892,0.139 -0.225,-5.223 1.059,-0.523" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Hardeman County</title></path>
        </g>
        <g class="county-group" data-county="Fayette" data-slug="fayette-county">
          <path class="county-path" id="fayette" d="m 10.227059,26.440401 3.029,-0.134 0.225,5.223 -1.618,0.114 -3.0560001,0.198 -0.063,-1.736 -0.104,-1.685 -0.045,-1.515 1.6320001,-0.465" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Fayette County</title></path>
        </g>
        <g class="county-group" data-county="Haywood" data-slug="haywood-county">
          <path class="county-path" id="haywood" d="m 11.078059,20.987401 0.004,0.045 0.149,0.19 0.113,0.117 0.259,0.188 0.444,0.208 0.217,0.005 1.113,0.348 0.789,0.301 0.149,3.394 -1.059,0.523 -3.029,0.134 -0.4550001,-2.279 0.081,-0.037 0.2430001,-0.176 0.311,-1.906 -0.004,-0.095 -0.131,0 -0.009,-0.176 0.058,-0.225 0.28,-0.595 0.477,0.036" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Haywood County</title></path>
        </g>
        <g class="county-group" data-county="Madison" data-slug="madison-county">
          <path class="county-path" id="madison" d="m 18.871059,20.775401 0.131,2.61 -2.213,2.259 -2.474,0.139 -0.149,-3.394 1.493,-1.469 2.17,-0.086 1.042,-0.059" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Madison County</title></path>
        </g>
        <g class="county-group" data-county="Crockett" data-slug="crockett-county">
          <path class="county-path" id="crockett" d="m 12.642059,18.504401 0.578,0.37 0.107,0.697 0.104,0.258 0.2,0.397 1.346,0.31 0.682,0.384 -1.493,1.469 -0.789,-0.301 -1.113,-0.348 -0.217,-0.005 -0.444,-0.208 -0.259,-0.188 -0.113,-0.117 -0.149,-0.19 -0.004,-0.045 0.081,-0.834 1.483,-1.649" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Crockett County</title></path>
        </g>
        <g class="county-group" data-county="Gibson" data-slug="gibson-county">
          <path class="county-path" id="gibson" d="m 12.805059,15.822401 1.992,-0.383 0.302,0.346 0.77,0.681 0.077,0.037 0.081,-0.019 0.924,0.271 0.757,0.55 0.121,3.529 -2.17,0.086 -0.682,-0.384 -1.346,-0.31 -0.2,-0.397 -0.104,-0.258 -0.107,-0.697 -0.578,-0.37 0.163,-2.682" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Gibson County</title></path>
        </g>
        <g class="county-group" data-county="Carroll" data-slug="carroll-county">
          <path class="county-path" id="carroll" d="m 19.294059,16.038401 3.31,0.127 0.647,3.523 0.019,0.379 -4.051,0.221 -0.154,0.145 -0.135,0.175 -0.059,0.167 -1.042,0.059 -0.121,-3.529 1.586,-1.267" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Carroll County</title></path>
        </g>
        <g class="county-group" data-county="Weakley" data-slug="weakley-county">
          <path class="county-path" id="weakley" d="m 16.000059,11.703402 3.079,-0.222 0.215,4.556999 -1.586,1.267 -0.757,-0.55 -0.924,-0.271 -0.081,0.019 -0.077,-0.037 -0.77,-0.681 -0.302,-0.346 -0.082,-2.42 0.033,-0.041 0.193,0.009 0.148,0.036 0.145,0.14 0.157,0.018 0.699,-0.284 -0.036,-0.775 -0.166,-0.409999 0.112,-0.009" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Weakley County</title></path>
        </g>
        <g class="county-group" data-county="Obion" data-slug="obion-county">
          <path class="county-path" id="obion" d="m 15.811059,11.716402 0.077,-0.004 0.166,0.409999 0.036,0.775 -0.699,0.284 -0.157,-0.018 -0.145,-0.14 -0.148,-0.036 -0.193,-0.009 -0.033,0.041 0.082,2.42 -1.992,0.383 -3.3890001,0.135 1.1440001,-3.862 5.251,-0.378999" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Obion County</title></path>
        </g>
        <g class="county-group" data-county="Lake" data-slug="lake-county">
          <path class="county-path" id="lake" d="m 10.560059,12.095401 -1.1440001,3.862 -1.489,0.455 0.736,-2.019 -0.082,-2.096 0.555,-0.03 0.698,-0.069 0.7260001,-0.103" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Lake County</title></path>
        </g>
        <g class="county-group" data-county="Dyer" data-slug="dyer-county">
          <path class="county-path" id="dyer" d="m 9.4160589,15.957401 3.3890001,-0.135 -0.163,2.682 -1.483,1.649 -0.129,-0.229 -0.086,-0.109 -0.514,-0.464 -0.8650001,0.044 -1.489,0.57 -0.508,0.13 -0.551,-1.217 0.91,-2.466 1.489,-0.455" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Dyer County</title></path>
        </g>
        <g class="county-group" data-county="Lauderdale" data-slug="lauderdale-county">
          <path class="county-path" id="lauderdale" d="m 7.5680589,20.095401 0.508,-0.13 1.489,-0.57 0.8650001,-0.044 0.514,0.464 0.086,0.109 0.129,0.229 -0.081,0.834 -0.477,-0.036 -0.28,0.595 -0.058,0.225 0.009,0.176 0.131,0 0.004,0.095 -0.311,1.906 -0.2430001,0.176 -0.081,0.037 -0.456,-0.325 -0.834,-0.446 -1.432,0.144 -0.311,0.112 -0.244,0.181 -0.536,0.495 -0.199,0.239 -0.185,0.433 0.285,-2.731 0.91,-1.943 0.066,-0.058 0.034,-0.023 0.225,-0.117 0.188,-0.032 0.285,0.005" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Lauderdale County</title></path>
        </g>
        <g class="county-group" data-county="Tipton" data-slug="tipton-county">
          <path class="county-path" id="tipton" d="m 9.7720589,24.161401 0.4550001,2.279 -1.6320001,0.465 -0.203,-0.144 -0.55,-0.23 -0.071,-0.01 -3.452,0.393 -0.492,0.238 -0.699,-0.688 2.447,-1.47 0.185,-0.433 0.199,-0.239 0.536,-0.495 0.244,-0.181 0.311,-0.112 1.432,-0.144 0.834,0.446 0.456,0.325" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Tipton County</title></path>
        </g>
        <g class="county-group" data-county="Shelby" data-slug="shelby-county">
          <path class="county-path" id="shelby" d="m 3.8270589,27.152401 0.492,-0.238 3.452,-0.393 0.071,0.01 0.55,0.23 0.203,0.144 0.045,1.515 0.104,1.685 0.063,1.736 -0.838,0.062 -6.13,0.375 -0.018,-0.18 0.126,-0.402 1.05,-0.346 1.105,-0.849 0.157,-0.193 0.019,-0.029 0.004,-0.008 0,-0.012 0.004,-0.014 -0.419,-2.957 -0.04,-0.136" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Shelby County</title></path>
        </g>
        <g class="county-group" data-county="Henderson" data-slug="henderson-county">
          <path class="county-path" id="henderson" d="m 23.270059,20.067401 0.104,2.697 -0.461,1.085 0.06,1.366 0.067,-0.006 -1.235,0.158 -2.803,-1.982 -0.131,-2.61 0.059,-0.167 0.135,-0.175 0.154,-0.145 4.051,-0.221" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Henderson County</title></path>
        </g>
        <g class="county-group" data-county="Henry" data-slug="henry-county">
          <path class="county-path" id="henry" d="m 19.358059,11.463402 4.475,-0.311 0.799,1.707999 -1.064,0.095 -0.014,0.018 -0.041,0.428 0.023,0.203 0.226,0.726 -0.808,1.398 -0.35,0.437 -3.31,-0.127 -0.215,-4.556999 0.279,-0.018" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Henry County</title></path>
        </g>
        <g class="county-group" data-county="Benton" data-slug="benton-county">
          <path class="county-path" id="benton" d="m 24.632059,12.860401 0.099,0.086 0.446,1.402 0.432,1.005 0.158,3.024 0,0.248 -0.068,0.545 -0.048,0.145 -0.168,0.252 -0.055,0.334 -2.177,-0.213 -0.647,-3.523 0.35,-0.437 0.808,-1.398 -0.226,-0.726 -0.023,-0.203 0.041,-0.428 0.014,-0.018 1.064,-0.095" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Benton County</title></path>
        </g>
        <g class="county-group" data-county="Decatur" data-slug="decatur-county">
          <path class="county-path" id="decatur" d="m 23.251059,19.688401 2.177,0.213 -0.332,0.951 -0.168,0.585 0.145,3.282 0.099,0.176 0.077,0.089 0.072,0.036 0.153,-0.012 -0.145,0.419 -2.289,-0.218 -0.067,0.006 -0.06,-1.366 0.461,-1.085 -0.104,-2.697 -0.019,-0.379" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Decatur County</title></path>
        </g>
        <g class="county-group" data-county="Hardin" data-slug="hardin-county">
          <path class="county-path" id="hardin" d="m 21.805059,25.367401 1.235,-0.158 2.289,0.218 0.019,0.22 0.171,0.853 0.472,1.631 0.177,2.254 -2.241,0.324 -1.712,0.141 -0.176,0.012 -0.216,-5.003 -0.018,-0.492" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Hardin County</title></path>
        </g>
        <g class="county-group" data-county="Lawrence" data-slug="lawrence-county">
          <path class="county-path" id="lawrence" d="m 32.865059,24.079401 0.929,0.064 -0.022,0.346 -0.005,0.333 0.315,3.457 0.06,1.489 -4.008,0.31 -0.135,-5.139 0.424,-0.04 0.87,-0.36 -0.042,-0.482 1.276,-0.1 0.338,0.122" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Lawrence County</title></path>
        </g>
        <g class="county-group" data-county="Wayne" data-slug="wayne-county">
          <path class="county-path" id="wayne" d="m 28.426059,23.976401 1.573,0.963 0.135,5.139 -3.966,0.307 -0.177,-2.254 -0.472,-1.631 -0.171,-0.853 -0.019,-0.22 0.145,-0.419 2.952,-1.032" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Wayne County</title></path>
        </g>
        <g class="county-group" data-county="Lewis" data-slug="lewis-county">
          <path class="county-path" id="lewis" d="m 32.150059,21.349401 -0.096,0.548 0.01,0.266 0.036,0.162 0.157,0.14 0.252,0.046 0.285,0.23 0.26,0.523 -0.035,0.468 -0.031,0.153 -0.123,0.194 -0.338,-0.122 -1.276,0.1 0.042,0.482 -0.87,0.36 -0.424,0.04 -1.573,-0.963 0.474,-1.686 0.401,-0.266 0.702,-0.104 0.946,0.113 0.078,-0.018 0.423,-0.22 0.7,-0.446" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Lewis County</title></path>
        </g>
        <g class="county-group" data-county="Perry" data-slug="perry-county">
          <path class="county-path" id="perry" d="m 28.030059,19.374401 0.87,2.916 -0.474,1.686 -2.952,1.032 -0.153,0.012 -0.072,-0.036 -0.077,-0.089 -0.099,-0.176 -0.145,-3.282 0.168,-0.585 0.332,-0.951 0.055,-0.334 1.249,0.158 0.257,-0.216 0.184,-0.036 0.857,-0.099" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Perry County</title></path>
        </g>
        <g class="county-group" data-county="Hickman" data-slug="hickman-county">
          <path class="county-path" id="hickman" d="m 33.186059,17.341401 0.017,1.416 -1.053,2.592 -0.7,0.446 -0.423,0.22 -0.078,0.018 -0.946,-0.113 -0.702,0.104 -0.401,0.266 -0.87,-2.916 1.708,-2.164 3.448,0.131" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Hickman County</title></path>
        </g>
        <g class="county-group" data-county="Humphreys" data-slug="humphreys-county">
          <path class="county-path" id="humphreys" d="m 29.193059,14.849401 0.545,2.361 -1.708,2.164 -0.857,0.099 -0.184,0.036 -0.257,0.216 -1.249,-0.158 0.168,-0.252 0.048,-0.145 0.068,-0.545 0,-0.248 -0.158,-3.024 -0.432,-1.005 1.189,0.041 0.366,-0.194 0.42,0.005 1.82,0.414 0.221,0.235" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Humphreys County</title></path>
        </g>
        <g class="county-group" data-county="Houston" data-slug="houston-county">
          <path class="county-path" id="houston" d="m 28.710059,12.419401 0.848,0.351 -0.365,2.079 -0.221,-0.235 -1.82,-0.414 -0.42,-0.005 -0.366,0.194 -1.189,-0.041 -0.446,-1.402 1.117,0.19 0.203,0.013 0.303,-0.017 0.201,-0.036 0.222,-0.069 0.279,-0.139 0.184,-0.13 0.141,-0.127 1.329,-0.212" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Houston County</title></path>
        </g>
        <g class="county-group" data-county="Stewart" data-slug="stewart-county">
          <path class="county-path" id="stewart" d="m 27.363059,9.0254027 0.541,-0.062 0.806,3.4559983 -1.329,0.212 -0.141,0.127 -0.184,0.13 -0.279,0.139 -0.222,0.069 -0.201,0.036 -0.303,0.017 -0.203,-0.013 -1.117,-0.19 -0.099,-0.086 -0.799,-1.707999 -0.37,-2.3299992 0.601,-0.036 1.676,0.032 -0.004,0.3969999 1.627,-0.19" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Stewart County</title></path>
        </g>
        <g class="county-group" data-county="Montgomery" data-slug="montgomery-county">
          <path class="county-path" id="montgomery" d="m 33.280059,8.4174028 0.172,2.4249992 -1.546,1.883999 -2.348,0.044 -0.848,-0.351 -0.806,-3.4559983 3.119,-0.3249999 2.257,-0.221" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Montgomery County</title></path>
        </g>
        <g class="county-group" data-county="Robertson" data-slug="robertson-county">
          <path class="county-path" id="robertson" d="m 36.867059,7.9894028 2.056,0 -0.266,0.685 -0.568,1.7029992 -0.229,0.506 -0.595,0.248 -1.601,0.445 -2.212,-0.734 -0.172,-2.4249992 0.554,-0.064 3.033,-0.364" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Robertson County</title></path>
        </g>
        <g class="county-group" data-county="Cheatham" data-slug="cheatham-county">
          <path class="county-path" id="cheatham" d="m 33.452059,10.842402 2.212,0.734 -1.032,4.502999 -1.328,0.067 0.08,-1.843 -0.144,-0.483 -0.208,-0.152 0.28,-0.433 0.018,-0.347 -0.032,-0.073 -0.238,-0.089 -0.533,-0.068 -0.621,0.068 1.546,-1.883999 z m -0.077,2.121999 -0.05,0.063 0.13,-0.058 -0.03,-0.027 -0.018,0.036 -0.032,-0.014" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Cheatham County</title></path>
        </g>
        <g class="county-group" data-county="Dickson" data-slug="dickson-county">
          <path class="county-path" id="dickson" d="m 29.558059,12.770401 2.348,-0.044 0.621,-0.068 0.533,0.068 0.238,0.089 0.032,0.073 -0.018,0.347 -0.28,0.433 0.208,0.152 0.144,0.483 -0.08,1.843 -0.118,1.195 -3.448,-0.131 -0.545,-2.361 0.365,-2.079" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Dickson County</title></path>
        </g>
        <g class="county-group" data-county="Williamson" data-slug="williamson-county">
          <path class="county-path" id="williamson" d="m 33.304059,16.146401 1.328,-0.067 0.207,0.716 0.136,-0.018 0.937,-0.914 1.484,0.076 1.82,0.707 -0.365,3.404 -0.986,0.139 -4.662,-1.432 -0.017,-1.416 0.118,-1.195" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Williamson County</title></path>
        </g>
        <g class="county-group" data-county="Maury" data-slug="maury-county">
          <path class="county-path" id="maury" d="m 33.203059,18.757401 4.662,1.432 -1.498,3.921 -2.573,0.033 -0.929,-0.064 0.123,-0.194 0.031,-0.153 0.035,-0.468 -0.26,-0.523 -0.285,-0.23 -0.252,-0.046 -0.157,-0.14 -0.036,-0.162 -0.01,-0.266 0.096,-0.548 1.053,-2.592" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Maury County</title></path>
        </g>
        <g class="county-group" data-county="Marshall" data-slug="marshall-county">
          <path class="county-path" id="marshall" d="m 37.865059,20.189401 0.986,-0.139 0.514,0.265 -0.009,2.534 0.032,0.46 0.103,0.261 0.506,0.847 0.156,0.019 0.036,-0.015 -2.253,1.543 -1.569,-1.854 1.498,-3.921" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Marshall County</title></path>
        </g>
        <g class="county-group" data-county="Giles" data-slug="giles-county">
          <path class="county-path" id="giles" d="m 33.794059,24.143401 2.573,-0.033 1.569,1.854 0.258,3.519 -3.922,0.275 -0.13,0.01 -0.06,-1.489 -0.315,-3.457 0.005,-0.333 0.022,-0.346" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Giles County</title></path>
        </g>
        <g class="county-group" data-county="Lincoln" data-slug="lincoln-county">
          <path class="county-path" id="lincoln" d="m 40.974059,24.476401 2.456,2.717 0.173,1.758 -4.861,0.479 -0.548,0.053 -0.258,-3.519 2.253,-1.543 0.785,0.055" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Lincoln County</title></path>
        </g>
        <g class="county-group" data-county="Moore" data-slug="moore-county">
          <path class="county-path" id="moore" d="m 43.682059,23.447401 0.063,1.025 -0.315,2.721 -2.456,-2.717 2.708,-1.029" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Moore County</title></path>
        </g>
        <g class="county-group" data-county="Bedford" data-slug="bedford-county">
          <path class="county-path" id="bedford" d="m 43.520059,20.600401 0.162,2.847 -2.708,1.029 -0.785,-0.055 -0.036,0.015 -0.156,-0.019 -0.506,-0.847 -0.103,-0.261 -0.032,-0.46 0.009,-2.534 0.013,-0.211 0.15,-0.027 0.82,-0.015 2.569,0.29 0.603,0.248" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Bedford County</title></path>
        </g>
        <g class="county-group" data-county="Rutherford" data-slug="rutherford-county">
          <path class="county-path" id="rutherford" d="m 40.114059,14.826401 0.45,0.302 1.65,0.996 0.171,0.067 0.685,0.167 0.968,-0.022 -0.219,3.295 -0.299,0.969 -0.603,-0.248 -2.569,-0.29 -0.82,0.015 -0.15,0.027 -0.013,0.211 -0.514,-0.265 0.365,-3.404 0.898,-1.82" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Rutherford County</title></path>
        </g>
        <g class="county-group" data-county="Davidson" data-slug="davidson-county">
          <path class="county-path" id="davidson" d="m 35.664059,11.576402 1.601,-0.445 1.851,1.908999 0.998,1.786 -0.898,1.82 -1.82,-0.707 -1.484,-0.076 -0.937,0.914 -0.136,0.018 -0.207,-0.716 1.032,-4.502999" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Davidson County</title></path>
        </g>
        <g class="county-group" data-county="Sumner" data-slug="sumner-county">
          <path class="county-path" id="sumner" d="m 40.465059,7.6104028 2.127,-0.076 -0.04,1.9909999 -0.374,1.8699993 -0.127,0.47 -0.355,-0.045 -0.141,-0.133 -0.026,-0.197 -0.055,-0.085 -0.112,-0.063 -0.055,0.005 -0.842,0.378 -1.051,0.729999 -0.298,0.585 -1.851,-1.908999 0.595,-0.248 0.229,-0.506 0.568,-1.7029992 0.266,-0.685 1.542,-0.379" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Sumner County</title></path>
        </g>
        <g class="county-group" data-county="Wilson" data-slug="wilson-county">
          <path class="county-path" id="wilson" d="m 43.750059,11.905401 1.073,2.628 0.635,1.569 -1.42,0.234 -0.968,0.022 -0.685,-0.167 -0.171,-0.067 -1.65,-0.996 -0.45,-0.302 -0.998,-1.786 0.298,-0.585 1.051,-0.729999 0.842,-0.378 0.055,-0.005 0.112,0.063 0.055,0.085 0.026,0.197 0.141,0.133 0.355,0.045 0.127,-0.47 1.572,0.509999" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Wilson County</title></path>
        </g>
        <g class="county-group" data-county="Cannon" data-slug="cannon-county">
          <path class="county-path" id="cannon" d="m 45.458059,16.102401 1.501,1.424 -0.784,2.429 -2.356,-0.324 0.219,-3.295 1.42,-0.234" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Cannon County</title></path>
        </g>
        <g class="county-group" data-county="Coffee" data-slug="coffee-county">
          <path class="county-path" id="coffee" d="m 46.175059,19.955401 1.308,1.636 -0.033,0.023 -0.022,0.068 0.036,0.96 0.122,0.648 0.166,0.149 -0.072,0.418 -0.197,0.696 -0.059,0.117 -1.351,-0.572 -1.277,-0.118 -0.947,0.333 -0.099,0.104 -0.005,0.055 -0.063,-1.025 -0.162,-2.847 0.299,-0.969 2.356,0.324" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Coffee County</title></path>
        </g>
        <g class="county-group" data-county="Franklin" data-slug="franklin-county">
          <path class="county-path" id="franklin" d="m 43.745059,24.472401 0.005,-0.055 0.099,-0.104 0.947,-0.333 1.277,0.118 1.351,0.572 0.514,0.798 0.419,3.024 -4.675,0.455 -0.079,0.004 -0.173,-1.758 0.315,-2.721" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Franklin County</title></path>
        </g>
        <g class="county-group" data-county="Marion" data-slug="marion-county">
          <path class="county-path" id="marion" d="m 47.938059,25.468401 3.136,-1.592 0.122,0.181 0.892,0.36 0.267,0.067 0.424,0.424 0.157,0.226 0.157,0.653 0.009,0.108 -0.649,2.209 -1.388,0.144 -2.708,0.244 -0.419,-3.024" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Marion County</title></path>
        </g>
        <g class="county-group" data-county="Sequatchie" data-slug="sequatchie-county">
          <path class="county-path" id="sequatchie" d="m 52.115059,20.518401 2.362,2.52 -1.375,2.857 -0.009,-0.108 -0.157,-0.653 -0.157,-0.226 -0.424,-0.424 -0.267,-0.067 -0.892,-0.36 -0.122,-0.181 -0.806,-2.687 0.513,-0.071 1.334,-0.6" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Sequatchie County</title></path>
        </g>
        <g class="county-group" data-county="Grundy" data-slug="grundy-county">
          <path class="county-path" id="grundy" d="m 50.268059,21.189401 0.806,2.687 -3.136,1.592 -0.514,-0.798 0.059,-0.117 0.197,-0.696 0.072,-0.418 -0.166,-0.149 -0.122,-0.648 -0.036,-0.96 0.022,-0.068 0.033,-0.023 0.468,0.068 0.163,0.004 0.644,-0.212 0.519,-0.112 0.991,-0.15" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Grundy County</title></path>
        </g>
        <g class="county-group" data-county="Van Buren" data-slug="van-buren-county">
          <path class="county-path" id="van-buren" d="m 53.382059,17.431401 -0.022,0.068 0.225,0.248 0,0.018 -1.47,2.753 -1.334,0.6 -0.842,-3.331 3.443,-0.356" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Van Buren County</title></path>
        </g>
        <g class="county-group" data-county="Warren" data-slug="warren-county">
          <path class="county-path" id="warren" d="m 49.069059,17.409401 0.87,0.378 0.842,3.331 -0.513,0.071 -0.991,0.15 -0.519,0.112 -0.644,0.212 -0.163,-0.004 -0.468,-0.068 -1.308,-1.636 0.784,-2.429 2.11,-0.117" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Warren County</title></path>
        </g>
        <g class="county-group" data-county="White" data-slug="white-county">
          <path class="county-path" id="white" d="m 53.165059,15.020401 0.217,2.411 -3.443,0.356 -0.87,-0.378 0.126,-2.417 0.004,-0.076 0.045,-0.095 0.185,-0.193 0.551,-0.486 0.148,-0.073 0.383,-0.094 1.438,0.225 0.509,0.193 0.158,0.123 0.549,0.504" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>White County</title></path>
        </g>
        <g class="county-group" data-county="DeKalb" data-slug="dekalb-county">
          <path class="county-path" id="dekalb" d="m 47.356059,13.668401 1.839,1.324 -0.126,2.417 -2.11,0.117 -1.501,-1.424 -0.635,-1.569 2.533,-0.865" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>DeKalb County</title></path>
        </g>
        <g class="county-group" data-county="Putnam" data-slug="putnam-county">
          <path class="county-path" id="putnam" d="m 47.491059,12.267401 1.501,0.107 0.65,-0.198 0.319,-0.154 0.068,-0.098 0.297,-0.509999 0,-0.298 0.87,0.767 2.335,0.829999 0.879,0 0.207,0.057 -0.482,0.564 -0.861,0.019 -0.103,0.076 -0.006,1.591 -0.549,-0.504 -0.158,-0.123 -0.509,-0.193 -1.438,-0.225 -0.383,0.094 -0.148,0.073 -0.551,0.486 -0.185,0.193 -0.045,0.095 -0.004,0.076 -1.839,-1.324 0.135,-1.401" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Putnam County</title></path>
        </g>
        <g class="county-group" data-county="Trousdale" data-slug="trousdale-county">
          <path class="county-path" id="trousdale" d="m 45.193059,10.053402 -1.443,1.851999 -1.572,-0.509999 0.374,-1.8699993 2.641,0.5279993" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Trousdale County</title></path>
        </g>
        <g class="county-group" data-county="Macon" data-slug="macon-county">
          <path class="county-path" id="macon" d="m 44.940059,7.4354028 1.929,-0.118 -0.09,1.6099999 -0.021,1.1429993 -1.565,-0.017 -2.641,-0.5279993 0.04,-1.9909999 2.348,-0.099" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Macon County</title></path>
        </g>
        <g class="county-group" data-county="Smith" data-slug="smith-county">
          <path class="county-path" id="smith" d="m 45.193059,10.053402 1.565,0.017 0.733,2.196999 -0.135,1.401 -2.533,0.865 -1.073,-2.628 1.443,-1.851999" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Smith County</title></path>
        </g>
        <g class="county-group" data-county="Jackson" data-slug="jackson-county">
          <path class="county-path" id="jackson" d="m 46.779059,8.9274027 0.455,-0.2849999 1.321,0.208 0.694,0.1699999 0.523,0.384 0.406,0.406 0.148,1.3059993 0,0.298 -0.297,0.509999 -0.068,0.098 -0.319,0.154 -0.65,0.198 -1.501,-0.107 -0.733,-2.196999 0.021,-1.1429993" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Jackson County</title></path>
        </g>
        <g class="county-group" data-county="Overton" data-slug="overton-county">
          <path class="county-path" id="overton" d="m 52.143059,7.9174028 1.869,1.4109999 0.132,1.3239993 0.176,0.46 0.396,0.892999 -0.306,0.708 -0.879,0 -2.335,-0.829999 -0.87,-0.767 -0.148,-1.3059993 1.965,-1.8929999" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Overton County</title></path>
        </g>
        <g class="county-group" data-county="Clay" data-slug="clay-county">
          <path class="county-path" id="clay" d="m 52.093059,6.6784028 0.05,1.239 -1.965,1.8929999 -0.406,-0.406 -0.523,-0.384 -0.694,-0.1699999 -1.321,-0.208 -0.455,0.2849999 0.09,-1.6099999 3.601,-0.346 1.425,-0.258 0.198,-0.035" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Clay County</title></path>
        </g>
        <g class="county-group" data-county="Pickett" data-slug="pickett-county">
          <path class="county-path" id="pickett" d="m 55.257059,6.4794028 1.884,-0.086 0.667,0.952 -1.401,-0.424 -0.443,-0.068 -0.4,0.018 -0.632,0.198 -0.387,0.383 -0.234,0.384 -0.109,0.252 -0.19,1.2399999 -1.869,-1.4109999 -0.05,-1.239 3.164,-0.199" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Pickett County</title></path>
        </g>
        <g class="county-group" data-county="Bledsoe" data-slug="bledsoe-county">
          <path class="county-path" id="bledsoe" d="m 53.585059,17.765401 1.243,-0.194 0.487,0.049 0.573,0.005 0.401,-0.022 0.789,-0.19 -1.095,1.911 -0.6,0.771 -0.279,1.077 0.153,0.424 -0.78,1.442 -2.362,-2.52 1.47,-2.753" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Bledsoe County</title></path>
        </g>
        <g class="county-group" data-county="Fentress" data-slug="fentress-county">
          <path class="county-path" id="fentress" d="m 57.808059,7.3454028 0.555,1.9469999 -1.577,1.2069993 -0.083,0.107 -0.279,1.042 0.15,0.662999 -1.957,0.459 -0.207,-0.057 0.306,-0.708 -0.396,-0.892999 -0.176,-0.46 -0.132,-1.3239993 0.19,-1.2399999 0.109,-0.252 0.234,-0.384 0.387,-0.383 0.632,-0.198 0.4,-0.018 0.443,0.068 1.401,0.424" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Fentress County</title></path>
        </g>
        <g class="county-group" data-county="Cumberland" data-slug="cumberland-county">
          <path class="county-path" id="cumberland" d="m 54.617059,12.770401 1.957,-0.459 2.708,2.92 -0.915,1.2 -1.289,0.982 -0.789,0.19 -0.401,0.022 -0.573,-0.005 -0.487,-0.049 -1.243,0.194 0,-0.018 -0.225,-0.248 0.022,-0.068 -0.217,-2.411 0.006,-1.591 0.103,-0.076 0.861,-0.019 0.482,-0.564" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Cumberland County</title></path>
        </g>
        <g class="county-group" data-county="Rhea" data-slug="rhea-county">
          <path class="county-path" id="rhea" d="m 59.079059,17.292401 0.13,0.202 0.032,0.077 -0.041,0.505 -0.558,1.906 -1.068,1.569 -0.069,0.045 -0.931,0.482 -1.317,-0.482 -0.153,-0.424 0.279,-1.077 0.6,-0.771 1.095,-1.911 1.289,-0.982 0.712,0.861" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Rhea County</title></path>
        </g>
        <g class="county-group" data-county="Meigs" data-slug="meigs-county">
          <path class="county-path" id="meigs" d="m 60.319059,18.558401 -2.038,4.093 -0.802,0.91 -0.905,-1.483 0.931,-0.482 0.069,-0.045 1.068,-1.569 0.558,-1.906 0.041,-0.505 -0.032,-0.077 -0.13,-0.202 1.24,1.266" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Meigs County</title></path>
        </g>
        <g class="county-group" data-county="Hamilton" data-slug="hamilton-county">
          <path class="county-path" id="hamilton" d="m 56.574059,22.078401 0.905,1.483 -0.424,1.176 -0.063,0.235 -0.093,0.756 0.372,1.019 0.344,0.717 -0.032,0.005 -2.971,0.373 -1.027,0.14 -1.132,0.122 0.649,-2.209 1.375,-2.857 0.78,-1.442 1.317,0.482" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Hamilton County</title></path>
        </g>
        <g class="county-group" data-county="Bradley" data-slug="bradley-county">
          <path class="county-path" id="bradley" d="m 58.281059,22.651401 1.793,1.212 -0.365,3.353 -0.359,0.045 -1.735,0.203 -0.344,-0.717 -0.372,-1.019 0.093,-0.756 0.063,-0.235 0.424,-1.176 0.802,-0.91" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Bradley County</title></path>
        </g>
        <g class="county-group" data-county="Polk" data-slug="polk-county">
          <path class="county-path" id="polk" d="m 62.166059,23.028401 2.237,0.758 0.039,2.849 -3.123,0.384 -1.61,0.197 0.365,-3.353 0.285,-0.248 0.492,-0.194 1.131,-0.117 0.184,-0.276" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Polk County</title></path>
        </g>
        <g class="county-group" data-county="Monroe" data-slug="monroe-county">
          <path class="county-path" id="monroe" d="m 64.834059,18.448401 0.086,0.142 1.086,0.617 0.51,-0.095 1.087,0.582 0.012,0.013 -0.012,0.05 -0.177,0.284 -0.423,2.312 -0.244,0.333 -0.395,0.325 -1.111,0.027 -0.85,0.748 -2.237,-0.758 0.811,-0.684 -0.094,-0.879 -1.067,-1.866 -0.434,-0.689 -0.014,-0.14 -0.044,-0.068 0.347,-0.451 0.298,-0.171 0.233,-0.107 0.072,-0.015 1.042,-0.031 1.461,0.428 0.057,0.093 z" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Monroe County</title></path>
        </g>
        <g class="county-group" data-county="McMinn" data-slug="mcminn-county">
          <path class="county-path" id="mcminn" d="m 60.684059,18.518401 0.64,0.184 0.044,0.068 0.014,0.14 0.434,0.689 1.067,1.866 0.094,0.879 -0.811,0.684 -0.184,0.276 -1.131,0.117 -0.492,0.194 -0.285,0.248 -1.793,-1.212 2.038,-4.093 0.365,-0.04" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>McMinn County</title></path>
        </g>
        <g class="county-group" data-county="Roane" data-slug="roane-county">
          <path class="county-path" id="roane" d="m 61.102059,18.125401 -0.418,0.393 -0.365,0.04 -1.24,-1.266 -0.712,-0.861 0.915,-1.2 1.497,-1.045 0.796,-0.249 0.343,-0.305 0.631,-0.636 0.942,1.7 0.109,0.161 -0.194,-0.058 -0.487,0.193 -1.64,2.57 -0.177,0.563 z m 0,0 0,0" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Roane County</title></path>
        </g>
        <g class="county-group" data-county="Morgan" data-slug="morgan-county">
          <path class="county-path" id="morgan" d="m 61.351059,11.644402 1.198,1.351999 -0.631,0.636 -0.343,0.305 -0.796,0.249 -1.497,1.045 -2.708,-2.92 -0.15,-0.662999 0.279,-1.042 0.083,-0.107 1.577,-1.2069993 1.077,1.1849993 0.482,0.361 1.054,0.395 0.375,0.411" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Morgan County</title></path>
        </g>
        <g class="county-group" data-county="Scott" data-slug="scott-county">
          <path class="county-path" id="scott" d="m 57.217059,6.3894028 5.292,-0.496 -0.063,1.131 -0.434,3.1009992 -0.043,0.749 -0.618,0.77 -0.375,-0.411 -1.054,-0.395 -0.482,-0.361 -1.077,-1.1849993 -0.555,-1.9469999 -0.667,-0.952 0.076,-0.004" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Scott County</title></path>
        </g>
        <g class="county-group" data-county="Campbell" data-slug="campbell-county">
          <path class="county-path" id="campbell" d="m 65.304059,5.5734028 1.117,2.077 -0.248,0.37 -0.252,1.2899999 -0.113,0.22 -0.153,0.181 -3.686,1.1629993 0.043,-0.749 0.434,-3.1009992 0.063,-1.131 0.352,-0.04 2.443,-0.28" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Campbell County</title></path>
        </g>
        <g class="county-group" data-county="Anderson" data-slug="anderson-county">
          <path class="county-path" id="anderson" d="m 65.655059,9.7114027 0.779,0.9999993 -0.027,0 -0.18,0.167 -1.095,1.451999 0.014,0.166 0.229,0.401 -1.703,1.681 -0.181,0.118 -0.942,-1.7 -1.198,-1.351999 0.618,-0.77 3.686,-1.1629993" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Anderson County</title></path>
        </g>
        <g class="county-group" data-county="Loudon" data-slug="loudon-county">
          <path class="county-path" id="loudon" d="m 63.600059,14.857401 1.149,1.055 0.085,2.536 -0.057,-0.093 -1.461,-0.428 -1.042,0.031 -0.072,0.015 -0.233,0.107 -0.298,0.171 -0.347,0.451 -0.64,-0.184 0.418,-0.393 0.177,-0.563 1.64,-2.57 0.487,-0.193 0.194,0.058" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Loudon County</title></path>
        </g>
        <g class="county-group" data-county="Blount" data-slug="blount-county">
          <path class="county-path" id="blount" d="m 68.445059,14.371401 0.879,1.52 0.441,0.662 0.36,0.171 0.203,1.563 -2.816,1.784 -0.086,-0.03 0.177,-0.284 0.012,-0.05 -0.012,-0.013 -1.087,-0.582 -0.51,0.095 -1.086,-0.617 -0.086,-0.142 -0.085,-2.536 0.158,-0.51 1.451,-0.724 0.549,0.04 0.65,0.325 0.149,0 0.739,-0.672" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Blount County</title></path>
        </g>
        <g class="county-group" data-county="Sevier" data-slug="sevier-county">
          <path class="county-path" id="sevier" d="m 73.403059,13.604401 0.882,2.249 0.045,0.245 -0.374,0.548 -1.789,1.416 -0.127,0.082 -1.473,0.152 -0.189,-0.004 -0.05,-0.005 -0.203,-1.563 -0.36,-0.171 -0.441,-0.662 -0.879,-1.52 0.991,-2.109 0.713,0.202 2.104,0.839 1.15,0.301" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Sevier County</title></path>
        </g>
        <g class="county-group" data-county="Knox" data-slug="knox-county">
          <path class="county-path" id="knox" d="m 68.617059,10.715402 0.806,0.992 0.013,0.554999 -0.991,2.109 -0.739,0.672 -0.149,0 -0.65,-0.325 -0.549,-0.04 -1.451,0.724 -0.158,0.51 -1.149,-1.055 -0.109,-0.161 0.181,-0.118 1.703,-1.681 -0.229,-0.401 -0.014,-0.166 1.095,-1.451999 0.18,-0.167 0.027,0 2.183,0.004" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Knox County</title></path>
        </g>
        <g class="county-group" data-county="Union" data-slug="union-county">
          <path class="county-path" id="union" d="m 66.421059,7.6504028 0.288,-0.13 0.708,-0.203 0.059,0.032 0.689,0.744 0.816,0.215 -0.364,2.4069992 -2.183,-0.004 -0.779,-0.9999993 0.153,-0.181 0.113,-0.22 0.252,-1.2899999 0.248,-0.37" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Union County</title></path>
        </g>
        <g class="county-group" data-county="Claiborne" data-slug="claiborne-county">
          <path class="county-path" id="claiborne" d="m 68.468059,5.0194028 2.077,-0.23 1.191,2.258 -2.755,1.261 -0.816,-0.215 -0.689,-0.744 -0.059,-0.032 -0.708,0.203 -0.288,0.13 -1.117,-2.077 0.581,-0.058 2.583,-0.496" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Claiborne County</title></path>
        </g>
        <g class="county-group" data-county="Hancock" data-slug="hancock-county">
          <path class="county-path" id="hancock" d="m 77.089059,3.9464028 -1.131,0.824 -0.266,-0.031 -0.342,-0.158 -0.045,0.009 -0.374,0.265 -0.496,0.403 -0.469,0.558 -1.118,1.321 -1.112,-0.09 -1.191,-2.258 4.971,-0.627 1.573,-0.216" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Hancock County</title></path>
        </g>
        <g class="county-group" data-county="Grainger" data-slug="grainger-county">
          <path class="county-path" id="grainger" d="m 71.736059,7.0474028 1.112,0.09 0.442,1.325 -1.968,1.7669992 -1.899,1.478 -0.806,-0.992 0.364,-2.4069992 2.755,-1.261" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Grainger County</title></path>
        </g>
        <g class="county-group" data-county="Hamblen" data-slug="hamblen-county">
          <path class="county-path" id="hamblen" d="m 75.143059,8.8274028 -0.749,0.9049999 -0.536,1.3299993 -2.536,-0.833 1.968,-1.7669992 1.853,0.365" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Hamblen County</title></path>
        </g>
        <g class="county-group" data-county="Jefferson" data-slug="jefferson-county">
          <path class="county-path" id="jefferson" d="m 73.858059,11.062402 -0.455,2.541999 -1.15,-0.301 -2.104,-0.839 -0.713,-0.202 -0.013,-0.554999 1.899,-1.478 2.536,0.833" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Jefferson County</title></path>
        </g>
        <g class="county-group" data-county="Cocke" data-slug="cocke-county">
          <path class="county-path" id="cocke" d="m 74.394059,9.7324027 -0.027,0.3069993 0.073,0.082 0.404,0.298 0.897,0.481 1.145,0.893 0.666,0.599999 -0.399,2.033 -2.868,1.427 -0.882,-2.249 0.455,-2.541999 0.536,-1.3299993" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Cocke County</title></path>
        </g>
        <g class="county-group" data-county="Unicoi" data-slug="unicoi-county">
          <path class="county-path" id="unicoi" d="m 82.714059,7.6244028 1.389,1.055 -1.839,1.3699992 -0.734,1.343 -1.11,-0.645 -0.022,-0.739 0.59,-0.7759993 0.401,-0.144 0.239,-0.027 0.446,-0.2879999 0.324,-0.482 0.316,-0.667" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Unicoi County</title></path>
        </g>
        <g class="county-group" data-county="Hawkins" data-slug="hawkins-county">
          <path class="county-path" id="hawkins" d="m 79.343059,3.6264028 -0.433,2.19 -0.185,0.307 -1.077,0.748 -0.495,0.145 -0.19,0.103 -0.522,0.333 -0.231,0.267 -0.193,0.346 -0.239,0.276 -0.437,0.391 -0.113,0.086 -0.085,0.009 -1.853,-0.365 -0.442,-1.325 1.118,-1.321 0.469,-0.558 0.496,-0.403 0.374,-0.265 0.045,-0.009 0.342,0.158 0.266,0.031 1.131,-0.824 2.254,-0.32" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Hawkins County</title></path>
        </g>
        <g class="county-group" data-county="Greene" data-slug="greene-county">
          <path class="county-path" id="greene" d="m 78.725059,6.1234028 0.709,-0.207 0.03,0.09 0.235,2.74 0.108,0.7119999 0.591,0.5499993 0.022,0.739 -0.197,-0.189 0,-0.005 -0.155,-0.098 -0.049,0.008 -0.262,0.189 -0.181,0.131 -0.648,0.64 -0.91,0.851999 -0.466,0.118 -0.666,-0.599999 -1.145,-0.893 -0.897,-0.481 -0.404,-0.298 -0.073,-0.082 0.027,-0.3069993 0.749,-0.9049999 0.085,-0.009 0.113,-0.086 0.437,-0.391 0.239,-0.276 0.193,-0.346 0.231,-0.267 0.522,-0.333 0.19,-0.103 0.495,-0.145 1.077,-0.748" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Greene County</title></path>
        </g>
        <g class="county-group" data-county="Washington" data-slug="washington-county">
          <path class="county-path" id="washington" d="m 78.910059,5.8164028 0.568,-0.089 1.266,-0.249 0.614,-0.194 0.355,0.072 0.51,0.371 0.162,0.048 0.473,-0.062 -0.144,1.911 -0.316,0.667 -0.324,0.482 -0.446,0.2879999 -0.239,0.027 -0.401,0.144 -0.59,0.7759993 -0.591,-0.5499993 -0.108,-0.7119999 -0.235,-2.74 -0.03,-0.09 -0.709,0.207 0.185,-0.307" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Washington County</title></path>
        </g>
        <g class="county-group" data-county="Carter" data-slug="carter-county">
          <path class="county-path" id="carter" d="m 85.869059,3.8074028 0.397,0.396 0,0.04 -0.798,1.348 0.157,0.31 0.703,0.732 0.343,0.293 0.181,-0.069 -1.212,2.2669999 -1.537,-0.4449999 -1.389,-1.055 0.144,-1.911 3.011,-1.906" fill="#E8E8E8" stroke="#FFFFFF" stroke-width="0.12" stroke-linejoin="round"><title>Carter County</title></path>
        </g>
        </g>
      </svg>
    </div>
  </div>

  <!-- Tooltip -->
  <div id="county-tooltip" role="tooltip" aria-hidden="true">
    <span class="county-tooltip__dot"></span>
    <span id="county-tooltip-name"></span>
  </div>

  <script>
  (function () {
    var svg = document.querySelector('.tn-map-svg-wrap svg');
    if (!svg) return;

    /* ── Counties with pages already built ── */
    var activeSlugs = {
      'davidson-county':    true,
      'rutherford-county':  true,
      'williamson-county':  true,
      'montgomery-county':  true,
      'wilson-county':      true,
      'sumner-county':      true,
      'maury-county':       true,
      'cheatham-county':    true,
      'robertson-county':   true,
      'dickson-county':     true
    };

    /* Base URL from WordPress — works on staging and live */
    var siteUrl = '<?php echo esc_js( home_url() ); ?>';

    /* ── 1. Dynamically place county name labels ── */
    function createCountyLabels() {
      // Remove any existing county labels before adding new ones
      var existingLabels = svg.querySelectorAll('.county-label');
      existingLabels.forEach(function(label) { label.remove(); });

      // Remove existing label layer if present
      var existingLayer = svg.querySelector('.county-labels-layer');
      if (existingLayer) existingLayer.remove();

      var labelLayer = document.createElementNS('http://www.w3.org/2000/svg', 'g');
      labelLayer.setAttribute('class', 'county-labels-layer');
      svg.appendChild(labelLayer);

      var svgCtmInverse = svg.getScreenCTM().inverse();

      svg.querySelectorAll('.county-path').forEach(function (path) {
        var bbox = path.getBBox();
        var cx   = bbox.x + bbox.width  / 2;
        var cy   = bbox.y + bbox.height / 2;

        var pt = svg.createSVGPoint();
        pt.x = cx;
        pt.y = cy;
        var rootPt = pt.matrixTransform(path.getCTM()).matrixTransform(svgCtmInverse);

        var countyName = path.parentElement && path.parentElement.getAttribute('data-county');
        if (!countyName) return;

        var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', rootPt.x);
        text.setAttribute('y', rootPt.y);
        text.setAttribute('text-anchor',      'middle');
        text.setAttribute('dominant-baseline','middle');
        text.setAttribute('font-size',        '0.72');
        text.setAttribute('font-family',      'Inter, sans-serif');
        text.setAttribute('font-weight',      '500');
        text.setAttribute('fill',             '#555555');
        text.setAttribute('pointer-events',   'none');
        text.setAttribute('class',            'county-label');
        text.setAttribute('data-for',         path.id);
        text.textContent = countyName;
        labelLayer.appendChild(text);
      });
    }

    createCountyLabels();

    // Re-run label creation when page is restored from bfcache
    window.addEventListener('pageshow', function(event) {
      if (event.persisted) {
        createCountyLabels();
      }
    });

    /* ── 2. Tooltip + hover + click ── */
    var tooltip     = document.getElementById('county-tooltip');
    var tooltipName = document.getElementById('county-tooltip-name');

    function positionTooltip(e) {
      var tw = tooltip.offsetWidth, th = tooltip.offsetHeight, vw = window.innerWidth;
      var left = e.clientX - tw / 2, top = e.clientY - th - 14;
      if (left < 8) left = 8;
      if (left + tw > vw - 8) left = vw - tw - 8;
      if (top < 8) top = e.clientY + 20;
      tooltip.style.left = left + 'px';
      tooltip.style.top  = top  + 'px';
    }

    svg.querySelectorAll('.county-group').forEach(function (g) {
      var pathEl   = g.querySelector('.county-path');
      var label    = pathEl ? svg.querySelector('[data-for="' + pathEl.id + '"]') : null;
      var slug     = g.getAttribute('data-slug');
      var name     = g.getAttribute('data-county');
      var isActive = slug && activeSlugs[slug];

      g.addEventListener('mouseenter', function (e) {
        tooltipName.textContent = name + ' County';
        tooltip.setAttribute('aria-hidden', 'false');
        positionTooltip(e);
        tooltip.classList.add('visible');
        if (label) label.setAttribute('fill', '#ffffff');
      });
      g.addEventListener('mousemove', positionTooltip);
      g.addEventListener('mouseleave', function () {
        tooltip.classList.remove('visible');
        tooltip.setAttribute('aria-hidden', 'true');
        if (label) label.setAttribute('fill', '#555555');
      });
      g.addEventListener('click', function () {
        if (slug) {
          window.location.href = siteUrl + '/where-we-buy/' + slug;
        }
      });
    });
  })();
  </script>
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
        $url       = esc_url( home_url('/where-we-buy/' . $c['slug']) );
        $img       = esc_url( $img_base . rawurlencode($c['image']) );
        $full_class = ( $c['slug'] === 'tennessee' ) ? ' wwb-photo-card--full' : '';
      ?>
      <a href="<?php echo $url; ?>" class="wwb-photo-card<?php echo $full_class; ?> wwb-fade" style="background-image:url('<?php echo $img; ?>');">
        <div class="wwb-photo-card__gradient"></div>
        <div class="wwb-photo-card__footer">
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

<!-- ── AREAS WE SERVE ── -->
<section class="section section--alt">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Statewide Coverage</p>
      <h2 class="section__title">Areas We Serve Across Tennessee</h2>
      <p class="section__subtitle">We buy houses throughout the entire state of Tennessee. Whether you are in a major metro or a small town, we can make you a cash offer.</p>
    </div>
    <div class="cities-grid">
      <a href="<?php echo esc_url( home_url('/where-we-buy/nashville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Nashville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/murfreesboro') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Murfreesboro</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/knoxville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Knoxville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/memphis') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Memphis</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/clarksville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Clarksville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/chattanooga') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Chattanooga</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/franklin') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Franklin</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/shelbyville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Shelbyville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/antioch') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Antioch</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/smyrna') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Smyrna</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/la-vergne') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>La Vergne</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/gallatin') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Gallatin</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/columbia') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Columbia</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/spring-hill') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Spring Hill</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/lebanon') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Lebanon</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/jackson') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Jackson</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/hendersonville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Hendersonville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/crossville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Crossville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/mcminnville') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>McMinnville</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/old-hickory') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Old Hickory</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/woodbury') ); ?>" class="city-chip"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Woodbury</span></a>
      <a href="<?php echo esc_url( home_url('/where-we-buy/tennessee') ); ?>" class="city-chip city-chip--full"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Anywhere in Tennessee &mdash; We Serve All Areas</span></a>
    </div>
    <p class="areas-footnote">Don&rsquo;t see your city? We serve <a href="<?php echo esc_url( home_url('/#hero-form') ); ?>">all of Tennessee</a>. Contact us for your cash offer today.</p>
  </div>
</section>

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

        <!-- Slide 1 -->
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Such a great group to work with. They were able to give me a fair deal with no hassles. Thank you Karson for going above and beyond.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">TH</div>
              <div>
                <div class="testimonial-name">Trish Haberman</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">These guys were absolutely amazing. I sold my house without having to do a single repair and they even helped me find my next place to live!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">CD</div>
              <div>
                <div class="testimonial-name">Clayton Daniels</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Had a great experience with these guys. I worked with Karson, Davis and Dowling and we got creative to make a couple transactions go through. They are very experienced and I would definitely work with them again!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">SS</div>
              <div>
                <div class="testimonial-name">Sam Skare</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">If you need to sell a home quickly, they're professional, fair, and truly care about making things easy for the seller. Highly recommend.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">LD</div>
              <div>
                <div class="testimonial-name">Lisa Daniels</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Great experience working with these guys. The whole process went super fast and easy. Both Davis and Dowling were true to their word, which is very important when doing business. I would work with them again any day.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">CP</div>
              <div>
                <div class="testimonial-name">Christopher Payne</div>
                <div class="testimonial-location">Middle Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">The best to work with yet. Answered every question and very supportive! 10/10 recommend. Timely responses, very knowledgeable, and professional. Can't go wrong!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">KB</div>
              <div>
                <div class="testimonial-name">Kelsie Balfour</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="reviews-slide">
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">They bought my father's rental portfolio! Paid cash and closed on multiple homes in less than 3 weeks. Incredibly smooth from start to finish. Would not hesitate to work with them again.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">DA</div>
              <div>
                <div class="testimonial-name">Dowling Armstrong</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">Really enjoyed working with Tennessee Cash For Homes. They helped me sell my house in Clarksville fast for cash! Highly recommend working with them.</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">BT</div>
              <div>
                <div class="testimonial-name">Blake Thompson</div>
                <div class="testimonial-location">Clarksville, TN</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
          <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-body">You won't find a better group to do business with. Honest, fast, and easy!</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">DH</div>
              <div>
                <div class="testimonial-name">Drew Holliday</div>
                <div class="testimonial-location">Tennessee</div>
              </div>
              <div class="testimonial-google"><svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google</div>
            </div>
          </div>
        </div>

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
