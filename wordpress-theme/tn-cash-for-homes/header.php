<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>" />
  <meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>" />
  <meta property="og:description" content="<?php echo esc_attr( get_the_excerpt() ); ?>" />
  <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/brand_assets/Where%20we%20buy%20background%20image.webp" />
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "RealEstateAgent",
    "name": "Tennessee Cash For Homes",
    "url": "https://www.tennesseecashforhomes.com",
    "description": "Tennessee Cash For Homes buys houses fast for cash across Middle Tennessee. No repairs, no fees, no commissions. Get a fair cash offer in 24 hours.",
    "telephone": "+16158018126",
    "email": "info@tncashforhomes.com",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Murfreesboro",
      "addressRegion": "TN",
      "addressCountry": "US"
    },
    "areaServed": [
      "Nashville TN",
      "Murfreesboro TN",
      "Franklin TN",
      "Clarksville TN",
      "Chattanooga TN",
      "Knoxville TN",
      "Memphis TN",
      "Middle Tennessee",
      "Tennessee"
    ],
    "priceRange": "$$",
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "5.0",
      "reviewCount": "47"
    }
  }
  </script>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ── NAVBAR ── -->
<nav class="nav">
  <div class="container">
    <div class="nav__inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/brand_assets/Tennessee%20Cash%20For%20Homes%20Logo.png" alt="Tennessee Cash For Homes - We Buy Houses Fast For Cash" fetchpriority="high" />
      </a>
      <ul class="nav__links" id="navLinks">
        <li><a href="<?php echo esc_url( home_url( '/how-it-works/' ) ); ?>" <?php if ( is_page( 'how-it-works' ) ) echo 'class="active"'; ?>>How It Works</a></li>
        <li><a href="<?php echo esc_url( home_url( '/where-we-buy/' ) ); ?>" <?php if ( is_page( 'where-we-buy' ) ) echo 'class="active"'; ?>>Where We Buy</a></li>
        <li><a href="<?php echo esc_url( home_url( '/sell-your-land/' ) ); ?>" <?php if ( is_page( 'sell-your-land' ) ) echo 'class="active"'; ?>>Sell Your Land</a></li>
        <li class="nav__dropdown">
          <button class="nav__dropdown-toggle" aria-expanded="false" aria-haspopup="true">Resources <svg class="nav__dropdown-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
          <ul class="nav__dropdown-menu" role="menu">
            <li role="none"><a role="menuitem" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" <?php if ( is_page( 'faq' ) ) echo 'class="active"'; ?>>FAQ</a></li>
            <li role="none"><a role="menuitem" href="<?php echo esc_url( home_url( '/about/' ) ); ?>" <?php if ( is_page( 'about' ) ) echo 'class="active"'; ?>>About</a></li>
            <li role="none"><a role="menuitem" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" <?php if ( is_home() || is_archive() ) echo 'class="active"'; ?>>Blog</a></li>
            <li role="none"><a role="menuitem" href="<?php echo esc_url( home_url( '/facing-foreclosure/' ) ); ?>" <?php if ( is_page( 'facing-foreclosure' ) ) echo 'class="active"'; ?>>Facing Foreclosure</a></li>
            <li role="none"><a role="menuitem" href="<?php echo esc_url( home_url( '/investors-and-lenders/' ) ); ?>" <?php if ( is_page( 'investors-and-lenders' ) ) echo 'class="active"'; ?>>Investors &amp; Lenders</a></li>
          </ul>
        </li>
        <li><a href="<?php echo esc_url( home_url( '/#get-offer' ) ); ?>" class="nav__cta">Get My Cash Offer</a></li>
      </ul>
      <div class="nav__hamburger" id="hamburger" aria-label="Menu" role="button" tabindex="0">
        <span></span><span></span><span></span>
      </div>
    </div>
  </div>
</nav>
