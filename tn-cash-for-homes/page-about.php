<?php
/*
Template Name: About
*/

// SEO meta
$meta_title = 'About Tennessee Cash For Homes | Family Owned Tennessee Cash Home Buyers';
$meta_description = 'Tennessee Cash For Homes is a Christian based, family owned cash home buying company with 9+ years of experience, a 5-Star Google rating, and an A+ BBB accreditation. Serving all of Tennessee.';

add_filter( 'pre_get_document_title', function( $title ) use ( $meta_title ) {
    return $meta_title;
}, 99 );

if ( ! empty( $meta_description ) ) {
    update_post_meta( get_the_ID(), '_tcfh_meta_desc', $meta_description );
}

// LocalBusiness schema
add_action( 'wp_head', function() {
    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        'name'        => 'Tennessee Cash For Homes',
        'description' => 'Family-owned, Christian based Tennessee cash home buyers with 9+ years of experience. We buy houses in any condition for a fair cash price. No repairs, no fees, no commissions.',
        'url'         => home_url( '/about/' ),
        'telephone'   => '+1-615-801-8126',
        'email'       => 'info@tncashforhomes.com',
        'image'       => get_template_directory_uri() . '/brand_assets/Company%20Photo.webp',
        'logo'        => get_template_directory_uri() . '/brand_assets/Tennessee%20Cash%20For%20Homes%20Logo.png',
        'foundingDate' => '2017',
        'address'     => array(
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Murfreesboro',
            'addressRegion'   => 'TN',
            'addressCountry'  => 'US',
        ),
        'areaServed' => array(
            '@type' => 'State',
            'name'  => 'Tennessee',
        ),
        'aggregateRating' => array(
            '@type'       => 'AggregateRating',
            'ratingValue' => '5.0',
            'reviewCount' => '50',
            'bestRating'  => '5',
        ),
        'sameAs' => array(
            'https://www.instagram.com/tennesseecashforhomes/',
            'https://www.facebook.com/profile.php?id=61557645432215',
            'https://www.youtube.com/@TennesseeCashForHomes',
            'https://www.tiktok.com/@tennesseecashforhomes',
            'https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815',
        ),
    );
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
} );

get_header();

// County data for service area pills
$counties = [
    ['name'=>'Anderson County','slug'=>'anderson-county'],
    ['name'=>'Bedford County','slug'=>'bedford-county'],
    ['name'=>'Benton County','slug'=>'benton-county'],
    ['name'=>'Bledsoe County','slug'=>'bledsoe-county'],
    ['name'=>'Blount County','slug'=>'blount-county'],
    ['name'=>'Bradley County','slug'=>'bradley-county'],
    ['name'=>'Campbell County','slug'=>'campbell-county'],
    ['name'=>'Cannon County','slug'=>'cannon-county'],
    ['name'=>'Carroll County','slug'=>'carroll-county'],
    ['name'=>'Carter County','slug'=>'carter-county'],
    ['name'=>'Cheatham County','slug'=>'cheatham-county'],
    ['name'=>'Chester County','slug'=>'chester-county'],
    ['name'=>'Claiborne County','slug'=>'claiborne-county'],
    ['name'=>'Clay County','slug'=>'clay-county'],
    ['name'=>'Cocke County','slug'=>'cocke-county'],
    ['name'=>'Coffee County','slug'=>'coffee-county'],
    ['name'=>'Crockett County','slug'=>'crockett-county'],
    ['name'=>'Cumberland County','slug'=>'cumberland-county'],
    ['name'=>'Davidson County','slug'=>'davidson-county'],
    ['name'=>'Decatur County','slug'=>'decatur-county'],
    ['name'=>'DeKalb County','slug'=>'dekalb-county'],
    ['name'=>'Dickson County','slug'=>'dickson-county'],
    ['name'=>'Dyer County','slug'=>'dyer-county'],
    ['name'=>'Fayette County','slug'=>'fayette-county'],
    ['name'=>'Fentress County','slug'=>'fentress-county'],
    ['name'=>'Franklin County','slug'=>'franklin-county'],
    ['name'=>'Gibson County','slug'=>'gibson-county'],
    ['name'=>'Giles County','slug'=>'giles-county'],
    ['name'=>'Grainger County','slug'=>'grainger-county'],
    ['name'=>'Greene County','slug'=>'greene-county'],
    ['name'=>'Grundy County','slug'=>'grundy-county'],
    ['name'=>'Hamblen County','slug'=>'hamblen-county'],
    ['name'=>'Hamilton County','slug'=>'hamilton-county'],
    ['name'=>'Hancock County','slug'=>'hancock-county'],
    ['name'=>'Hardeman County','slug'=>'hardeman-county'],
    ['name'=>'Hardin County','slug'=>'hardin-county'],
    ['name'=>'Hawkins County','slug'=>'hawkins-county'],
    ['name'=>'Haywood County','slug'=>'haywood-county'],
    ['name'=>'Henderson County','slug'=>'henderson-county'],
    ['name'=>'Henry County','slug'=>'henry-county'],
    ['name'=>'Hickman County','slug'=>'hickman-county'],
    ['name'=>'Houston County','slug'=>'houston-county'],
    ['name'=>'Humphreys County','slug'=>'humphreys-county'],
    ['name'=>'Jackson County','slug'=>'jackson-county'],
    ['name'=>'Jefferson County','slug'=>'jefferson-county'],
    ['name'=>'Johnson County','slug'=>'johnson-county'],
    ['name'=>'Knox County','slug'=>'knox-county'],
    ['name'=>'Lake County','slug'=>'lake-county'],
    ['name'=>'Lauderdale County','slug'=>'lauderdale-county'],
    ['name'=>'Lawrence County','slug'=>'lawrence-county'],
    ['name'=>'Lewis County','slug'=>'lewis-county'],
    ['name'=>'Lincoln County','slug'=>'lincoln-county'],
    ['name'=>'Loudon County','slug'=>'loudon-county'],
    ['name'=>'Macon County','slug'=>'macon-county'],
    ['name'=>'Madison County','slug'=>'madison-county'],
    ['name'=>'Marion County','slug'=>'marion-county'],
    ['name'=>'Marshall County','slug'=>'marshall-county'],
    ['name'=>'Maury County','slug'=>'maury-county'],
    ['name'=>'McMinn County','slug'=>'mcminn-county'],
    ['name'=>'McNairy County','slug'=>'mcnairy-county'],
    ['name'=>'Meigs County','slug'=>'meigs-county'],
    ['name'=>'Monroe County','slug'=>'monroe-county'],
    ['name'=>'Montgomery County','slug'=>'montgomery-county'],
    ['name'=>'Moore County','slug'=>'moore-county'],
    ['name'=>'Morgan County','slug'=>'morgan-county'],
    ['name'=>'Obion County','slug'=>'obion-county'],
    ['name'=>'Overton County','slug'=>'overton-county'],
    ['name'=>'Perry County','slug'=>'perry-county'],
    ['name'=>'Pickett County','slug'=>'pickett-county'],
    ['name'=>'Polk County','slug'=>'polk-county'],
    ['name'=>'Putnam County','slug'=>'putnam-county'],
    ['name'=>'Rhea County','slug'=>'rhea-county'],
    ['name'=>'Roane County','slug'=>'roane-county'],
    ['name'=>'Robertson County','slug'=>'robertson-county'],
    ['name'=>'Rutherford County','slug'=>'rutherford-county'],
    ['name'=>'Scott County','slug'=>'scott-county'],
    ['name'=>'Sequatchie County','slug'=>'sequatchie-county'],
    ['name'=>'Sevier County','slug'=>'sevier-county'],
    ['name'=>'Shelby County','slug'=>'shelby-county'],
    ['name'=>'Smith County','slug'=>'smith-county'],
    ['name'=>'Stewart County','slug'=>'stewart-county'],
    ['name'=>'Sullivan County','slug'=>'sullivan-county'],
    ['name'=>'Sumner County','slug'=>'sumner-county'],
    ['name'=>'Tipton County','slug'=>'tipton-county'],
    ['name'=>'Trousdale County','slug'=>'trousdale-county'],
    ['name'=>'Unicoi County','slug'=>'unicoi-county'],
    ['name'=>'Union County','slug'=>'union-county'],
    ['name'=>'Van Buren County','slug'=>'van-buren-county'],
    ['name'=>'Warren County','slug'=>'warren-county'],
    ['name'=>'Washington County','slug'=>'washington-county'],
    ['name'=>'Wayne County','slug'=>'wayne-county'],
    ['name'=>'Weakley County','slug'=>'weakley-county'],
    ['name'=>'White County','slug'=>'white-county'],
    ['name'=>'Williamson County','slug'=>'williamson-county'],
    ['name'=>'Wilson County','slug'=>'wilson-county'],
];

$cities = [
    ['name'=>'Nashville','slug'=>'nashville'],
    ['name'=>'Murfreesboro','slug'=>'murfreesboro'],
    ['name'=>'Franklin','slug'=>'franklin'],
    ['name'=>'Chattanooga','slug'=>'chattanooga'],
    ['name'=>'Knoxville','slug'=>'knoxville'],
    ['name'=>'Memphis','slug'=>'memphis'],
    ['name'=>'Clarksville','slug'=>'clarksville'],
    ['name'=>'Spring Hill','slug'=>'spring-hill'],
    ['name'=>'Hendersonville','slug'=>'hendersonville'],
    ['name'=>'Columbia','slug'=>'columbia'],
    ['name'=>'Smyrna','slug'=>'smyrna'],
    ['name'=>'Gallatin','slug'=>'gallatin'],
    ['name'=>'Lebanon','slug'=>'lebanon'],
    ['name'=>'Antioch','slug'=>'antioch'],
    ['name'=>'La Vergne','slug'=>'la-vergne'],
    ['name'=>'Jackson','slug'=>'jackson'],
    ['name'=>'Crossville','slug'=>'crossville'],
    ['name'=>'McMinnville','slug'=>'mcminnville'],
    ['name'=>'Old Hickory','slug'=>'old-hickory'],
    ['name'=>'Shelbyville','slug'=>'shelbyville'],
    ['name'=>'Woodbury','slug'=>'woodbury'],
    ['name'=>'Chapel Hill','slug'=>'chapel-hill'],
];
?>

<!-- ══════════════════════════════════════════
     1. HERO SECTION
══════════════════════════════════════════ -->
<section class="about-hero">
  <div class="about-hero__overlay"></div>
  <div class="container about-hero__container">
    <div class="about-hero__inner">
      <span class="about-hero__eyebrow">ABOUT US</span>
      <h1 class="about-hero__h1">A Tennessee Company Built on Trust, Faith, and Family</h1>
      <p class="about-hero__sub">For over 9 years, Tennessee Cash For Homes has helped homeowners across the state sell their houses fast, fairly, and without the stress of the traditional market.</p>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     2. MISSION STATEMENT SECTION
══════════════════════════════════════════ -->
<section class="about-mission">
  <div class="container">
    <blockquote class="about-mission__quote">
      &ldquo;We started this company because we believe every Tennessee homeowner deserves a fair, honest, and stress-free way to sell their home &mdash; regardless of their situation.&rdquo;
    </blockquote>
    <div class="about-mission__copy">
      <p>Tennessee Cash For Homes is locally owned and operated right here in Tennessee. We are not a franchise, a call center, or a faceless corporation. We are a family that has built deep roots in the Tennessee community, and we are proud to serve the homeowners who live here.</p>
      <p>As a <a href="<?php echo esc_url( home_url('/') ); ?>">Christian based cash home buying company</a>, our values are more than just words on a page. They guide every transaction, every conversation, and every offer we make. We treat every homeowner with honesty, integrity, and genuine care because it is the right thing to do.</p>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     3. WHO WE ARE SECTION
══════════════════════════════════════════ -->
<section class="about-who">
  <div class="container">
    <h2 class="about-who__h2">Who We Are</h2>
    <div class="about-who__grid">
      <div class="about-who__copy">
        <p>Tennessee Cash For Homes is a <strong>family owned and operated business</strong> that has been serving Tennessee homeowners for over 9 years. What started as a passion for helping people in difficult situations has grown into one of the most trusted <a href="<?php echo esc_url( home_url('/how-it-works/') ); ?>">cash home buying companies</a> in the state. We have purchased hundreds of homes and helped countless families move forward with their lives.</p>
        <p>We are a <strong>Christian based company</strong> whose values of honesty, fairness, and compassion are at the core of every offer we make. We do not believe in high-pressure tactics or lowball offers. We believe in treating people the way we would want to be treated, and that starts with a fair cash offer and a transparent process from start to finish.</p>
        <p>As a <strong>locally owned Tennessee business</strong>, we understand the Tennessee real estate market, the communities, and the real situations homeowners face. Whether you are <a href="<?php echo esc_url( home_url('/facing-foreclosure/') ); ?>">facing foreclosure</a>, dealing with an inherited property, going through a divorce, or simply need to sell your house fast, we have seen it all and we know how to help.</p>
      </div>
      <div class="about-who__credentials">
        <div class="about-cred-card">
          <span class="about-cred-card__number">9+</span>
          <span class="about-cred-card__label">Years</span>
          <span class="about-cred-card__desc">In the Tennessee real estate market</span>
        </div>
        <div class="about-cred-card">
          <span class="about-cred-card__number">5-Star</span>
          <span class="about-cred-card__label">Rated</span>
          <span class="about-cred-card__desc">On Google Reviews</span>
        </div>
        <div class="about-cred-card">
          <span class="about-cred-card__number">A+</span>
          <span class="about-cred-card__label">Rating</span>
          <span class="about-cred-card__desc">Accredited by the Better Business Bureau</span>
        </div>
        <div class="about-cred-card">
          <svg class="about-cred-card__icon" width="28" height="28" fill="none" stroke="var(--green)" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          <span class="about-cred-card__number">Family</span>
          <span class="about-cred-card__label">Owned</span>
          <span class="about-cred-card__desc">Locally owned and operated in Tennessee</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     3b. MEET THE TEAM SECTION
══════════════════════════════════════════ -->
<section class="about-team">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title">Meet the Team</h2>
      <p class="section__subtitle">The family behind Tennessee Cash For Homes &mdash; experienced investors and agents who live, work, and raise their families right here in Tennessee.</p>
    </div>
    <div class="about-team__grid">
      <article class="about-team__card">
        <div class="about-team__photo-wrap">
          <img class="about-team__photo" src="<?php echo esc_url( get_template_directory_uri() . '/brand_assets/Dowling%20Tennessee%20Cash%20For%20Homes.webp' ); ?>" alt="Dowling Armstrong, Tennessee Cash For Homes" width="320" height="320" loading="lazy" decoding="async" />
        </div>
        <h3 class="about-team__name">Dowling Armstrong</h3>
        <p class="about-team__bio">With 9 years in real estate and over 1,000 transactions under his belt, Dowling has seen just about every side of the industry. From complex commercial deals to residential closings, his breadth of experience gives him a perspective most agents never develop. As a licensed real estate agent and active investor for the past 5 years, he brings both the knowledge of a seasoned professional and the instincts of someone who puts his own money on the line. When he steps away from the closing table, you&rsquo;ll find him hunting, spearfishing, or soaking up time with his wife and kids.</p>
      </article>
      <article class="about-team__card">
        <div class="about-team__photo-wrap">
          <img class="about-team__photo" src="<?php echo esc_url( get_template_directory_uri() . '/brand_assets/Davis%20Tennessee%20Cash%20For%20Homes.webp' ); ?>" alt="Davis Armstrong, Tennessee Cash For Homes" width="320" height="320" loading="lazy" decoding="async" />
        </div>
        <h3 class="about-team__name">Davis Armstrong</h3>
        <p class="about-team__bio">Raised in a small town outside Valdosta, Georgia, Davis relocated to Nashville in 2010 and went on to play collegiate golf at Lipscomb University, where he earned a degree in Finance. He took that competitive mindset straight into real estate investing after graduation and hasn&rsquo;t looked back. In 6 years he has been part of over 500 transactions, with a sharp focus on the investment side of the business. He knows the numbers, he knows the market, and he knows how to get deals done. Outside of work, Davis is an avid outdoorsman with a passion for hunting deer, turkeys, and ducks.</p>
      </article>
      <article class="about-team__card">
        <div class="about-team__photo-wrap">
          <img class="about-team__photo" src="<?php echo esc_url( get_template_directory_uri() . '/brand_assets/Karson%20Tennessee%20Cash%20For%20Homes.webp' ); ?>" alt="Karson Carmichael, Founder of Tennessee Cash For Homes" width="320" height="320" loading="lazy" decoding="async" />
        </div>
        <h3 class="about-team__name">Karson Carmichael</h3>
        <p class="about-team__bio">Karson founded Tennessee Cash For Homes with one goal in mind: helping families find solutions that everyone else says aren&rsquo;t possible. He relocated from Murfreesboro to Spring Hill to be closer to family, and that same sense of loyalty and community carries into every deal he works. Armed with a Bachelor&rsquo;s degree in Business Management and nearly 3 years of hands-on real estate experience, Karson brings a fresh energy and genuine care to every transaction. On weekends you&rsquo;ll find him riding his Harley, spending time with his wife Grace, or out back with his best friend, a black Labrador named Hank.</p>
      </article>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     4. OUR VALUES SECTION
══════════════════════════════════════════ -->
<section class="about-values">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title">What We Stand For</h2>
    </div>
    <div class="about-values__grid">
      <div class="about-values__card">
        <div class="about-values__icon">
          <svg width="32" height="32" fill="none" stroke="var(--green)" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
        </div>
        <h3 class="about-values__title">Faith</h3>
        <p class="about-values__desc">As a Christian based company, our faith guides every decision we make. We treat every homeowner the way we would want to be treated &mdash; with honesty, compassion, and respect.</p>
      </div>
      <div class="about-values__card">
        <div class="about-values__icon">
          <svg width="32" height="32" fill="none" stroke="var(--green)" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3 class="about-values__title">Integrity</h3>
        <p class="about-values__desc">We never pressure, mislead, or lowball. Our offers are fair, our process is transparent, and we mean what we say. If we make you an offer, we honor it.</p>
      </div>
      <div class="about-values__card">
        <div class="about-values__icon">
          <svg width="32" height="32" fill="none" stroke="var(--green)" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <h3 class="about-values__title">Family</h3>
        <p class="about-values__desc">We are a family business serving Tennessee families. We understand that selling a home is one of the biggest decisions you will ever make, and we take that responsibility seriously.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     5. WHY CHOOSE US SECTION
══════════════════════════════════════════ -->
<section class="about-why">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title" style="color: var(--white);">Why Tennessee Homeowners Choose Us</h2>
    </div>
    <div class="about-why__grid">
      <div class="about-why__item">
        <div class="about-why__accent"></div>
        <div>
          <h3 class="about-why__item-title">Locally Owned and Operated</h3>
          <p class="about-why__item-desc">We live and work in Tennessee. This is our home too.</p>
        </div>
      </div>
      <div class="about-why__item">
        <div class="about-why__accent"></div>
        <div>
          <h3 class="about-why__item-title">Christian Based Company</h3>
          <p class="about-why__item-desc">Our values of honesty and integrity are non-negotiable.</p>
        </div>
      </div>
      <div class="about-why__item">
        <div class="about-why__accent"></div>
        <div>
          <h3 class="about-why__item-title">9+ Years of Experience</h3>
          <p class="about-why__item-desc">We have seen every situation and we know how to help.</p>
        </div>
      </div>
      <div class="about-why__item">
        <div class="about-why__accent"></div>
        <div>
          <h3 class="about-why__item-title">5-Star Google Rating</h3>
          <p class="about-why__item-desc">Our reputation is built on happy homeowners, not promises.</p>
        </div>
      </div>
      <div class="about-why__item">
        <div class="about-why__accent"></div>
        <div>
          <h3 class="about-why__item-title">A+ BBB Accredited</h3>
          <p class="about-why__item-desc">Independently verified. You can trust who you are working with.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     6. OUR PROCESS SECTION
══════════════════════════════════════════ -->
<section class="about-process">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title">How We Work With You</h2>
    </div>
    <div class="about-process__steps">
      <div class="about-process__step">
        <span class="about-process__num">1</span>
        <h3 class="about-process__step-title">Tell Us About Your Home</h3>
        <p class="about-process__step-desc">Submit our simple form or give us a call. No obligation, no pressure.</p>
      </div>
      <div class="about-process__step">
        <span class="about-process__num">2</span>
        <h3 class="about-process__step-title">Receive a Fair Cash Offer</h3>
        <p class="about-process__step-desc">We do our research and make you an honest cash offer within 24 hours.</p>
      </div>
      <div class="about-process__step">
        <span class="about-process__num">3</span>
        <h3 class="about-process__step-title">Close on Your Timeline</h3>
        <p class="about-process__step-desc">You pick the closing date. We handle the paperwork. You get your cash.</p>
      </div>
    </div>
    <p class="about-process__note">There are no fees, no commissions, no repairs, and no surprises. Just a straightforward process built on trust.</p>
  </div>
</section>

<!-- ══════════════════════════════════════════
     7. BBB AND GOOGLE BADGE SECTION
══════════════════════════════════════════ -->
<section class="about-badges">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title">Independently Verified and Trusted</h2>
      <p class="section__subtitle">Our A+ Better Business Bureau accreditation and 5-Star Google rating are not just badges &mdash; they are the result of 9 years of treating Tennessee homeowners with fairness and respect.</p>
    </div>
    <div class="about-badges__row">
      <a href="https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815/#sealclick" target="_blank" rel="nofollow" class="about-badges__badge">
        <img src="https://seal-nashville.bbb.org/seals/darkgray-seal-200-42-bbb-37373815.png" alt="Tennessee Cash For Homes BBB Business Review" width="200" height="42" loading="lazy" decoding="async" />
      </a>
      <div class="about-badges__badge about-badges__google">
        <div class="about-badges__stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
        <span class="about-badges__google-label">
          <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
          5.0 Rating on Google
        </span>
      </div>
    </div>
    <p class="about-badges__sub">Accredited, rated, and trusted by Tennessee homeowners since 2017.</p>
  </div>
</section>

<!-- ══════════════════════════════════════════
     8. SERVICE AREA SECTION
══════════════════════════════════════════ -->
<section class="about-service">
  <div class="container">
    <div class="section__header section__header--center">
      <h2 class="section__title">Proudly Serving All of Tennessee</h2>
      <p class="section__subtitle">From Memphis to Bristol, from Nashville to the smallest rural county, Tennessee Cash For Homes buys houses and land throughout the entire state.</p>
    </div>

    <div class="about-service__columns">
      <div class="about-service__col">
        <h3 class="about-service__col-title">Cities We Serve</h3>
        <ul class="about-service__list">
          <?php foreach ( $cities as $c ) : ?>
            <li><a class="about-service__link" href="<?php echo esc_url( home_url( '/where-we-buy/' . $c['slug'] ) ); ?>"><?php echo esc_html( $c['name'] ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="about-service__col">
        <h3 class="about-service__col-title">Counties We Serve</h3>
        <ul class="about-service__list">
          <?php foreach ( $counties as $c ) : ?>
            <li><a class="about-service__link" href="<?php echo esc_url( home_url( '/where-we-buy/' . $c['slug'] ) ); ?>"><?php echo esc_html( $c['name'] ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     9. TESTIMONIALS SECTION
══════════════════════════════════════════ -->
<?php include( get_template_directory() . '/reviews-section.php' ); ?>

<?php get_footer(); ?>
