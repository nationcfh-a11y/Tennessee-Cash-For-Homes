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
      <svg viewBox="0 0 960 370" xmlns="http://www.w3.org/2000/svg" aria-label="Interactive map of Tennessee counties" role="img">
        <!-- WEST TENNESSEE -->
        <polygon class="county-path" id="lake" data-county="Lake" data-slug="lake-county" points="74,52 118,52 118,96 74,96"><title>Lake County</title></polygon>
        <polygon class="county-path" id="obion" data-county="Obion" data-slug="obion-county" points="125,47 177,47 177,91 125,91"><title>Obion County</title></polygon>
        <polygon class="county-path" id="weakley" data-county="Weakley" data-slug="weakley-county" points="155,55 207,55 207,101 155,101"><title>Weakley County</title></polygon>
        <polygon class="county-path" id="henry" data-county="Henry" data-slug="henry-county" points="199,53 251,53 251,103 199,103"><title>Henry County</title></polygon>
        <polygon class="county-path" id="lauderdale" data-county="Lauderdale" data-slug="lauderdale-county" points="51,175 95,175 95,219 51,219"><title>Lauderdale County</title></polygon>
        <polygon class="county-path" id="dyer" data-county="Dyer" data-slug="dyer-county" points="109,111 159,111 159,157 109,157"><title>Dyer County</title></polygon>
        <polygon class="county-path" id="gibson" data-county="Gibson" data-slug="gibson-county" points="163,122 213,122 213,168 163,168"><title>Gibson County</title></polygon>
        <polygon class="county-path" id="crockett" data-county="Crockett" data-slug="crockett-county" points="108,161 152,161 152,205 108,205"><title>Crockett County</title></polygon>
        <polygon class="county-path" id="haywood" data-county="Haywood" data-slug="haywood-county" points="106,209 156,209 156,253 106,253"><title>Haywood County</title></polygon>
        <polygon class="county-path" id="tipton" data-county="Tipton" data-slug="tipton-county" points="39,219 85,219 85,269 39,269"><title>Tipton County</title></polygon>
        <polygon class="county-path" id="shelby" data-county="Shelby" data-slug="shelby-county" points="10,278 84,278 84,350 10,350"><title>Shelby County</title></polygon>
        <polygon class="county-path" id="fayette" data-county="Fayette" data-slug="fayette-county" points="75,292 127,292 127,342 75,342"><title>Fayette County</title></polygon>
        <polygon class="county-path" id="madison" data-county="Madison" data-slug="madison-county" points="139,201 191,201 191,245 139,245"><title>Madison County</title></polygon>
        <polygon class="county-path" id="chester" data-county="Chester" data-slug="chester-county" points="165,238 209,238 209,282 165,282"><title>Chester County</title></polygon>
        <polygon class="county-path" id="hardeman" data-county="Hardeman" data-slug="hardeman-county" points="121,282 173,282 173,332 121,332"><title>Hardeman County</title></polygon>
        <polygon class="county-path" id="mcnairy" data-county="McNairy" data-slug="mcnairy-county" points="189,290 239,290 239,340 189,340"><title>McNairy County</title></polygon>
        <polygon class="county-path" id="henderson" data-county="Henderson" data-slug="henderson-county" points="191,192 235,192 235,236 191,236"><title>Henderson County</title></polygon>
        <polygon class="county-path" id="hardin" data-county="Hardin" data-slug="hardin-county" points="193,277 243,277 243,327 193,327"><title>Hardin County</title></polygon>
        <polygon class="county-path" id="decatur" data-county="Decatur" data-slug="decatur-county" points="226,207 270,207 270,251 226,251"><title>Decatur County</title></polygon>
        <polygon class="county-path" id="carroll" data-county="Carroll" data-slug="carroll-county" points="188,124 240,124 240,170 188,170"><title>Carroll County</title></polygon>
        <!-- WEST-MIDDLE TENNESSEE -->
        <polygon class="county-path" id="benton" data-county="Benton" data-slug="benton-county" points="230,105 282,105 282,151 230,151"><title>Benton County</title></polygon>
        <polygon class="county-path" id="stewart" data-county="Stewart" data-slug="stewart-county" points="248,19 298,19 298,65 248,65"><title>Stewart County</title></polygon>
        <polygon class="county-path" id="houston" data-county="Houston" data-slug="houston-county" points="264,60 308,60 308,104 264,104"><title>Houston County</title></polygon>
        <polygon class="county-path" id="humphreys" data-county="Humphreys" data-slug="humphreys-county" points="252,147 298,147 298,193 252,193"><title>Humphreys County</title></polygon>
        <polygon class="county-path" id="perry" data-county="Perry" data-slug="perry-county" points="248,201 294,201 294,245 248,245"><title>Perry County</title></polygon>
        <polygon class="county-path" id="wayne" data-county="Wayne" data-slug="wayne-county" points="245,275 297,275 297,325 245,325"><title>Wayne County</title></polygon>
        <polygon class="county-path" id="montgomery" data-county="Montgomery" data-slug="montgomery-county" points="291,11 353,11 353,61 291,61"><title>Montgomery County</title></polygon>
        <polygon class="county-path" id="dickson" data-county="Dickson" data-slug="dickson-county" points="298,101 352,101 352,151 298,151"><title>Dickson County</title></polygon>
        <polygon class="county-path" id="hickman" data-county="Hickman" data-slug="hickman-county" points="294,168 344,168 344,218 294,218"><title>Hickman County</title></polygon>
        <polygon class="county-path" id="lewis" data-county="Lewis" data-slug="lewis-county" points="293,220 337,220 337,264 293,264"><title>Lewis County</title></polygon>
        <polygon class="county-path" id="lawrence" data-county="Lawrence" data-slug="lawrence-county" points="296,273 348,273 348,323 296,323"><title>Lawrence County</title></polygon>
        <!-- MIDDLE TENNESSEE -->
        <polygon class="county-path" id="robertson" data-county="Robertson" data-slug="robertson-county" points="356,9 406,9 406,55 356,55"><title>Robertson County</title></polygon>
        <polygon class="county-path" id="cheatham" data-county="Cheatham" data-slug="cheatham-county" points="329,59 379,59 379,105 329,105"><title>Cheatham County</title></polygon>
        <polygon class="county-path" id="davidson" data-county="Davidson" data-slug="davidson-county" points="360,77 424,77 424,137 360,137"><title>Davidson County</title></polygon>
        <polygon class="county-path" id="williamson" data-county="Williamson" data-slug="williamson-county" points="353,137 405,137 405,187 353,187"><title>Williamson County</title></polygon>
        <polygon class="county-path" id="maury" data-county="Maury" data-slug="maury-county" points="334,187 388,187 388,237 334,237"><title>Maury County</title></polygon>
        <polygon class="county-path" id="giles" data-county="Giles" data-slug="giles-county" points="338,282 390,282 390,332 338,332"><title>Giles County</title></polygon>
        <polygon class="county-path" id="marshall" data-county="Marshall" data-slug="marshall-county" points="371,226 421,226 421,270 371,270"><title>Marshall County</title></polygon>
        <polygon class="county-path" id="lincoln" data-county="Lincoln" data-slug="lincoln-county" points="380,296 432,296 432,346 380,346"><title>Lincoln County</title></polygon>
        <polygon class="county-path" id="sumner" data-county="Sumner" data-slug="sumner-county" points="400,21 452,21 452,67 400,67"><title>Sumner County</title></polygon>
        <polygon class="county-path" id="wilson" data-county="Wilson" data-slug="wilson-county" points="419,82 471,82 471,132 419,132"><title>Wilson County</title></polygon>
        <polygon class="county-path" id="rutherford" data-county="Rutherford" data-slug="rutherford-county" points="406,154 458,154 458,204 406,204"><title>Rutherford County</title></polygon>
        <polygon class="county-path" id="bedford" data-county="Bedford" data-slug="bedford-county" points="401,221 453,221 453,267 401,267"><title>Bedford County</title></polygon>
        <polygon class="county-path" id="moore" data-county="Moore" data-slug="moore-county" points="422,273 458,273 458,311 422,311"><title>Moore County</title></polygon>
        <polygon class="county-path" id="franklin" data-county="Franklin" data-slug="franklin-county" points="442,286 492,286 492,336 442,336"><title>Franklin County</title></polygon>
        <polygon class="county-path" id="trousdale" data-county="Trousdale" data-slug="trousdale-county" points="441,41 479,41 479,77 441,77"><title>Trousdale County</title></polygon>
        <polygon class="county-path" id="macon" data-county="Macon" data-slug="macon-county" points="455,10 499,10 499,48 455,48"><title>Macon County</title></polygon>
        <polygon class="county-path" id="smith" data-county="Smith" data-slug="smith-county" points="462,74 508,74 508,120 462,120"><title>Smith County</title></polygon>
        <polygon class="county-path" id="cannon" data-county="Cannon" data-slug="cannon-county" points="449,167 491,167 491,211 449,211"><title>Cannon County</title></polygon>
        <polygon class="county-path" id="coffee" data-county="Coffee" data-slug="coffee-county" points="439,223 489,223 489,269 439,269"><title>Coffee County</title></polygon>
        <!-- UPPER MIDDLE / PLATEAU -->
        <polygon class="county-path" id="clay" data-county="Clay" data-slug="clay-county" points="510,11 550,11 550,47 510,47"><title>Clay County</title></polygon>
        <polygon class="county-path" id="jackson" data-county="Jackson" data-slug="jackson-county" points="493,41 537,41 537,85 493,85"><title>Jackson County</title></polygon>
        <polygon class="county-path" id="dekalb" data-county="DeKalb" data-slug="dekalb-county" points="476,124 524,124 524,170 476,170"><title>DeKalb County</title></polygon>
        <polygon class="county-path" id="warren" data-county="Warren" data-slug="warren-county" points="479,195 529,195 529,241 479,241"><title>Warren County</title></polygon>
        <polygon class="county-path" id="grundy" data-county="Grundy" data-slug="grundy-county" points="487,252 531,252 531,302 487,302"><title>Grundy County</title></polygon>
        <polygon class="county-path" id="putnam" data-county="Putnam" data-slug="putnam-county" points="508,90 556,90 556,136 508,136"><title>Putnam County</title></polygon>
        <polygon class="county-path" id="white" data-county="White" data-slug="white-county" points="514,135 564,135 564,181 514,181"><title>White County</title></polygon>
        <polygon class="county-path" id="van-buren" data-county="Van Buren" data-slug="van-buren-county" points="522,186 560,186 560,230 522,230"><title>Van Buren County</title></polygon>
        <polygon class="county-path" id="sequatchie" data-county="Sequatchie" data-slug="sequatchie-county" points="527,231 565,231 565,277 527,277"><title>Sequatchie County</title></polygon>
        <polygon class="county-path" id="marion" data-county="Marion" data-slug="marion-county" points="498,304 548,304 548,348 498,348"><title>Marion County</title></polygon>
        <polygon class="county-path" id="hamilton" data-county="Hamilton" data-slug="hamilton-county" points="536,300 598,300 598,352 536,352"><title>Hamilton County</title></polygon>
        <polygon class="county-path" id="overton" data-county="Overton" data-slug="overton-county" points="536,49 584,49 584,93 536,93"><title>Overton County</title></polygon>
        <polygon class="county-path" id="pickett" data-county="Pickett" data-slug="pickett-county" points="561,9 597,9 597,45 561,45"><title>Pickett County</title></polygon>
        <polygon class="county-path" id="fentress" data-county="Fentress" data-slug="fentress-county" points="574,41 618,41 618,85 574,85"><title>Fentress County</title></polygon>
        <polygon class="county-path" id="cumberland" data-county="Cumberland" data-slug="cumberland-county" points="564,133 616,133 616,183 564,183"><title>Cumberland County</title></polygon>
        <polygon class="county-path" id="bledsoe" data-county="Bledsoe" data-slug="bledsoe-county" points="548,204 590,204 590,250 548,250"><title>Bledsoe County</title></polygon>
        <!-- EAST MIDDLE / VALLEY -->
        <polygon class="county-path" id="scott" data-county="Scott" data-slug="scott-county" points="620,28 668,28 668,72 620,72"><title>Scott County</title></polygon>
        <polygon class="county-path" id="morgan" data-county="Morgan" data-slug="morgan-county" points="606,91 654,91 654,141 606,141"><title>Morgan County</title></polygon>
        <polygon class="county-path" id="roane" data-county="Roane" data-slug="roane-county" points="619,149 667,149 667,195 619,195"><title>Roane County</title></polygon>
        <polygon class="county-path" id="rhea" data-county="Rhea" data-slug="rhea-county" points="569,206 613,206 613,252 569,252"><title>Rhea County</title></polygon>
        <polygon class="county-path" id="meigs" data-county="Meigs" data-slug="meigs-county" points="592,220 632,220 632,264 592,264"><title>Meigs County</title></polygon>
        <polygon class="county-path" id="mcminn" data-county="McMinn" data-slug="mcminn-county" points="607,235 655,235 655,285 607,285"><title>McMinn County</title></polygon>
        <polygon class="county-path" id="polk" data-county="Polk" data-slug="polk-county" points="617,307 667,307 667,353 617,353"><title>Polk County</title></polygon>
        <polygon class="county-path" id="bradley" data-county="Bradley" data-slug="bradley-county" points="578,297 630,297 630,341 578,341"><title>Bradley County</title></polygon>
        <polygon class="county-path" id="loudon" data-county="Loudon" data-slug="loudon-county" points="642,175 690,175 690,219 642,219"><title>Loudon County</title></polygon>
        <polygon class="county-path" id="monroe" data-county="Monroe" data-slug="monroe-county" points="645,229 697,229 697,279 645,279"><title>Monroe County</title></polygon>
        <polygon class="county-path" id="campbell" data-county="Campbell" data-slug="campbell-county" points="659,30 711,30 711,76 659,76"><title>Campbell County</title></polygon>
        <polygon class="county-path" id="anderson" data-county="Anderson" data-slug="anderson-county" points="653,95 705,95 705,141 653,141"><title>Anderson County</title></polygon>
        <polygon class="county-path" id="knox" data-county="Knox" data-slug="knox-county" points="680,118 740,118 740,172 680,172"><title>Knox County</title></polygon>
        <polygon class="county-path" id="blount" data-county="Blount" data-slug="blount-county" points="687,189 739,189 739,235 687,235"><title>Blount County</title></polygon>
        <!-- EAST TENNESSEE -->
        <polygon class="county-path" id="claiborne" data-county="Claiborne" data-slug="claiborne-county" points="712,20 764,20 764,64 712,64"><title>Claiborne County</title></polygon>
        <polygon class="county-path" id="union" data-county="Union" data-slug="union-county" points="697,56 741,56 741,100 697,100"><title>Union County</title></polygon>
        <polygon class="county-path" id="grainger" data-county="Grainger" data-slug="grainger-county" points="730,62 774,62 774,106 730,106"><title>Grainger County</title></polygon>
        <polygon class="county-path" id="jefferson" data-county="Jefferson" data-slug="jefferson-county" points="739,94 787,94 787,138 739,138"><title>Jefferson County</title></polygon>
        <polygon class="county-path" id="sevier" data-county="Sevier" data-slug="sevier-county" points="727,149 777,149 777,195 727,195"><title>Sevier County</title></polygon>
        <polygon class="county-path" id="hamblen" data-county="Hamblen" data-slug="hamblen-county" points="760,73 804,73 804,117 760,117"><title>Hamblen County</title></polygon>
        <polygon class="county-path" id="cocke" data-county="Cocke" data-slug="cocke-county" points="774,132 824,132 824,178 774,178"><title>Cocke County</title></polygon>
        <polygon class="county-path" id="hancock" data-county="Hancock" data-slug="hancock-county" points="765,14 805,14 805,50 765,50"><title>Hancock County</title></polygon>
        <polygon class="county-path" id="hawkins" data-county="Hawkins" data-slug="hawkins-county" points="791,26 845,26 845,70 791,70"><title>Hawkins County</title></polygon>
        <polygon class="county-path" id="greene" data-county="Greene" data-slug="greene-county" points="801,82 855,82 855,132 801,132"><title>Greene County</title></polygon>
        <polygon class="county-path" id="washington" data-county="Washington" data-slug="washington-county" points="839,49 893,49 893,99 839,99"><title>Washington County</title></polygon>
        <polygon class="county-path" id="sullivan" data-county="Sullivan" data-slug="sullivan-county" points="852,13 906,13 906,59 852,59"><title>Sullivan County</title></polygon>
        <polygon class="county-path" id="unicoi" data-county="Unicoi" data-slug="unicoi-county" points="852,80 898,80 898,126 852,126"><title>Unicoi County</title></polygon>
        <polygon class="county-path" id="carter" data-county="Carter" data-slug="carter-county" points="884,61 934,61 934,107 884,107"><title>Carter County</title></polygon>
        <polygon class="county-path" id="johnson" data-county="Johnson" data-slug="johnson-county" points="916,28 958,28 958,78 916,78"><title>Johnson County</title></polygon>
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
    var tooltip     = document.getElementById('county-tooltip');
    var tooltipName = document.getElementById('county-tooltip-name');
    var counties    = document.querySelectorAll('.county-path');

    function positionTooltip(e) {
      var tw = tooltip.offsetWidth;
      var th = tooltip.offsetHeight;
      var vw = window.innerWidth;
      var vh = window.innerHeight;
      var x  = e.clientX;
      var y  = e.clientY;
      var left = x - tw / 2;
      var top  = y - th - 14;
      if (left < 8)           left = 8;
      if (left + tw > vw - 8) left = vw - tw - 8;
      if (top < 8)            top  = y + 20;
      if (top + th > vh - 8)  top  = y - th - 14;
      tooltip.style.left = left + 'px';
      tooltip.style.top  = top  + 'px';
    }

    counties.forEach(function (c) {
      c.addEventListener('mouseenter', function (e) {
        var name = this.getAttribute('data-county');
        tooltipName.textContent = name + ' County';
        tooltip.setAttribute('aria-hidden', 'false');
        positionTooltip(e);
        tooltip.classList.add('visible');
      });
      c.addEventListener('mousemove', positionTooltip);
      c.addEventListener('mouseleave', function () {
        tooltip.classList.remove('visible');
        tooltip.setAttribute('aria-hidden', 'true');
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
