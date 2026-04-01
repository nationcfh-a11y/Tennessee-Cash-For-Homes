<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/brand_assets/Favicon.png" />
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/brand_assets/Favicon.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="dns-prefetch" href="https://seal-nashville.bbb.org" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ── NAVBAR ── -->
<nav class="nav">
  <div class="container">
    <div class="nav__inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/brand_assets/Tennessee%20Cash%20For%20Homes%20Logo.png" alt="Tennessee Cash For Homes" width="1024" height="1024" decoding="async" />
      </a>
      <ul class="nav__links" id="navLinks">
        <li><a href="<?php echo esc_url( home_url( '/how-it-works/' ) ); ?>" <?php if ( is_page( 'how-it-works' ) ) echo 'class="active"'; ?>>How It Works</a></li>
        <li><a href="<?php echo esc_url( home_url( '/where-we-buy/' ) ); ?>" <?php if ( is_page( 'where-we-buy' ) ) echo 'class="active"'; ?>>Where We Buy</a></li>
        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" <?php if ( is_page( 'about' ) ) echo 'class="active"'; ?>>About</a></li>
        <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" <?php if ( is_page( 'faq' ) ) echo 'class="active"'; ?>>FAQ</a></li>
        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" <?php if ( is_home() || is_archive() || is_single() ) echo 'class="active"'; ?>>Blog</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#hero-form' ) ); ?>" class="nav__cta">Get My Cash Offer</a></li>
      </ul>
      <div class="nav__hamburger" id="hamburger" aria-label="Menu" role="button" tabindex="0">
        <span></span><span></span><span></span>
      </div>
    </div>
  </div>
</nav>
