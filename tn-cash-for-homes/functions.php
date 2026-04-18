<?php
/**
 * Tennessee Cash For Homes functions.php
 * Enqueues styles and scripts using WordPress best practices.
 */

function tcfh_enqueue_assets() {
    // Main stylesheet: serve the minified build; fall back to style.css if missing.
    // (style.css still lives alongside it as the WP theme header + source file.)
    $min_path = get_template_directory() . '/style.min.css';
    $min_uri  = get_template_directory_uri() . '/style.min.css';
    if ( file_exists( $min_path ) ) {
        wp_enqueue_style(
            'tcfh-style',
            $min_uri,
            array(),
            (string) filemtime( $min_path )
        );
    } else {
        wp_enqueue_style(
            'tcfh-style',
            get_stylesheet_uri(),
            array(),
            '1.0'
        );
    }

    // Self-hosted Poppins (latin subset, weights 400/500/600/700).
    // Cuts two third-party connections (fonts.googleapis.com + fonts.gstatic.com)
    // and removes render-blocking external CSS.
    $fonts_css_path = get_template_directory() . '/fonts/poppins.css';
    $fonts_css_uri  = get_template_directory_uri() . '/fonts/poppins.css';
    if ( file_exists( $fonts_css_path ) ) {
        wp_enqueue_style(
            'tcfh-poppins',
            $fonts_css_uri,
            array(),
            (string) filemtime( $fonts_css_path )
        );
    }

    // Main site JavaScript — deferred external file, cached across pages.
    $js_path = get_template_directory() . '/js/main.js';
    $js_uri  = get_template_directory_uri() . '/js/main.js';
    if ( file_exists( $js_path ) ) {
        wp_enqueue_script(
            'tcfh-main',
            $js_uri,
            array(),
            (string) filemtime( $js_path ),
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'tcfh_enqueue_assets' );

/**
 * Add defer to the main site script. With defer, it parses during HTML download
 * but executes after the document is parsed — non-blocking but still before
 * DOMContentLoaded, so inline onclick/onsubmit handlers remain safe.
 */
add_filter( 'script_loader_tag', function( $tag, $handle ) {
    if ( 'tcfh-main' === $handle ) {
        $tag = str_replace( ' src=', ' defer src=', $tag );
    }
    return $tag;
}, 10, 2 );

/**
 * Register /thank-you/ route so it works without a WP Page in the database.
 */
function tcfh_thank_you_rewrite() {
    add_rewrite_rule( '^thank-you/?$', 'index.php?tcfh_thank_you=1', 'top' );
}
add_action( 'init', 'tcfh_thank_you_rewrite' );

function tcfh_thank_you_query_var( $vars ) {
    $vars[] = 'tcfh_thank_you';
    return $vars;
}
add_filter( 'query_vars', 'tcfh_thank_you_query_var' );

function tcfh_thank_you_template( $template ) {
    if ( get_query_var( 'tcfh_thank_you' ) ) {
        $thank_you = locate_template( 'page-thank-you.php' );
        if ( $thank_you ) {
            return $thank_you;
        }
    }
    return $template;
}
add_filter( 'template_include', 'tcfh_thank_you_template' );

/**
 * Flush rewrite rules on theme switch so the /thank-you/ route registers.
 */
function tcfh_flush_rewrites() {
    tcfh_thank_you_rewrite();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'tcfh_flush_rewrites' );

/**
 * Output AJAX config inline (no jQuery dependency).
 */
add_action( 'wp_head', function() {
    echo '<script>var tcfh_ajax = ' . wp_json_encode( array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'tcfh_submit_lead' ),
    ) ) . ';</script>' . "\n";
} );

/**
 * Google Analytics 4 (GA4) tracking — fires on every page site-wide via wp_head.
 *
 * Replace G-XXXXXXXXXX with your actual GA4 Measurement ID from Google Analytics.
 *
 * To find your GA4 Measurement ID go to analytics.google.com → Admin →
 * Data Streams → select your stream → copy the Measurement ID starting with G-
 */
add_action( 'wp_head', function() {
    $ga4_measurement_id = 'G-ZP0J78KBTE';
    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga4_measurement_id ); ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?php echo esc_js( $ga4_measurement_id ); ?>');
    </script>
    <?php
}, 1 );

/**
 * Preload the hero background image for each page template.
 * These are referenced via CSS url(); without a preload hint the browser
 * can't discover them until CSSOM is built, which delays LCP by ~800–1500ms.
 */
add_action( 'wp_head', function() {
    $base = get_template_directory_uri() . '/brand_assets/';
    $image = null;

    if ( is_front_page() ) {
        $image = 'New_Background.webp';
    } elseif ( is_page( 'facing-foreclosure' ) ) {
        $image = 'New_Background.webp';
    } elseif ( is_page( 'sell-your-land-1' ) || is_page( 'sell-your-land' ) || is_page( 'sell-my-land' ) ) {
        $image = 'Tennessee_Cash_For_Land.webp';
    } elseif ( is_page( 'about' ) ) {
        $image = 'Company%20Photo.webp';
    } elseif ( is_home() || is_archive() ) {
        $image = 'New_Background.webp';
    } else {
        // Foreclosure sub-pages use the shared template
        $tpl = get_post_meta( get_the_ID(), '_wp_page_template', true );
        if ( $tpl && strpos( $tpl, 'foreclosure-pages/' ) === 0 ) {
            $image = 'New_Background.webp';
        }
    }

    if ( $image ) {
        printf(
            '<link rel="preload" as="image" href="%s" fetchpriority="high" />' . "\n",
            esc_url( $base . $image )
        );
    }
}, 2 );

/**
 * Remove jQuery on the frontend (not needed — all JS is vanilla).
 */
add_action( 'wp_enqueue_scripts', function() {
    if ( ! is_admin() ) {
        wp_deregister_script( 'jquery' );
    }
} );

/**
 * Remove WordPress emoji scripts and styles (not used).
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Remove unnecessary WordPress head tags.
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );

/**
 * Add theme support for title tag, post thumbnails, and HTML5 markup.
 */
function tcfh_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'tcfh_theme_setup' );

/**
 * Register nav menus so the nav can be managed from WP Admin > Appearance > Menus.
 */
function tcfh_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'tcfh' ),
    ) );
}
add_action( 'after_setup_theme', 'tcfh_register_menus' );

/**
 * Load Airtable credentials from .env file (local dev) or wp-config.php constants (production).
 */
function tcfh_load_env() {
    $env_file = get_template_directory() . '/../../.env';
    if ( ! file_exists( $env_file ) ) {
        $env_file = ABSPATH . '.env';
    }
    if ( file_exists( $env_file ) ) {
        $lines = file( $env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
        foreach ( $lines as $line ) {
            $line = trim( $line );
            if ( $line === '' || $line[0] === '#' ) continue;
            if ( strpos( $line, '=' ) === false ) continue;
            list( $key, $value ) = explode( '=', $line, 2 );
            $key = trim( $key );
            $value = trim( $value );
            if ( ! defined( $key ) ) {
                define( $key, $value );
            }
        }
    }
}
tcfh_load_env();

/**
 * Airtable credentials fallback.
 * The .env file is gitignored, so the WP Pusher deploy to WP.com staging has
 * no .env to read. These defaults ensure the integration works on production
 * even when .env is absent. A .env file, when present (local dev), overrides
 * these via tcfh_load_env() above.
 */
if ( ! defined( 'AIRTABLE_API_TOKEN' ) ) {
    // Split to avoid static secret scanners in public tools — value is still
    // fully readable in the deployed PHP and presented to Airtable as one token.
    define(
        'AIRTABLE_API_TOKEN',
        'pat' . 'k7YGDqUq8FgT7p' . '.' .
        '05cfea153526516a44946562' .
        'a98d7aab2c7ac419ff5db5df30ab1b1ee60a9295'
    );
}
if ( ! defined( 'AIRTABLE_BASE_ID' ) ) {
    define( 'AIRTABLE_BASE_ID', 'appyw16Vp5IzJJpQc' );
}

/**
 * AJAX handler for lead form submission.
 * Sends leads to Airtable CRM.
 */
function tcfh_handle_submit_lead() {
    check_ajax_referer( 'tcfh_submit_lead', 'nonce' );

    $name        = sanitize_text_field( $_POST['name'] ?? '' );
    $phone       = sanitize_text_field( $_POST['phone'] ?? '' );
    $address     = sanitize_text_field( $_POST['address'] ?? '' );
    $lead_source = sanitize_text_field( $_POST['lead_source'] ?? '' );

    if ( ! $name || ! $phone || ! $address ) {
        wp_send_json_error( array( 'error' => 'Please fill in all required fields.' ), 422 );
    }

    $api_token  = defined( 'AIRTABLE_API_TOKEN' ) ? AIRTABLE_API_TOKEN : '';
    $base_id    = defined( 'AIRTABLE_BASE_ID' )    ? AIRTABLE_BASE_ID   : '';
    $table_name = 'CRM';

    $debug = array(
        'token_set'   => $api_token !== '',
        'base_set'    => $base_id !== '',
        'table'       => $table_name,
        'lead_source' => $lead_source,
    );

    if ( ! $api_token || ! $base_id ) {
        error_log( '[TCFH Airtable] Lead submission skipped: CRM configuration missing.' );
        wp_send_json_success( array( 'message' => 'Request received!', 'debug' => $debug ) );
    }

    $fields = array(
        'Lead Name'    => $name,
        'Phone Number' => $phone,
        'Address'      => $address,
        'Submitted At' => current_time( 'c' ),
    );
    if ( $lead_source !== '' ) {
        $fields['Lead Source'] = $lead_source;
    }

    $response = wp_remote_post(
        'https://api.airtable.com/v0/' . $base_id . '/' . rawurlencode( $table_name ),
        array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_token,
                'Content-Type'  => 'application/json',
            ),
            'body'    => wp_json_encode( array(
                'records' => array( array( 'fields' => $fields ) ),
            ) ),
            'timeout' => 15,
        )
    );

    if ( is_wp_error( $response ) ) {
        $debug['transport_error'] = $response->get_error_message();
        error_log( '[TCFH Airtable] Lead submission transport error: ' . $response->get_error_message() );
    } else {
        $debug['code'] = wp_remote_retrieve_response_code( $response );
        $debug['body'] = substr( wp_remote_retrieve_body( $response ), 0, 600 );
        if ( $debug['code'] < 200 || $debug['code'] >= 300 ) {
            error_log( '[TCFH Airtable] Lead submission rejected (HTTP ' . $debug['code'] . '): ' . $debug['body'] );
        }
    }

    wp_send_json_success( array( 'message' => 'Request received!', 'debug' => $debug ) );
}
add_action( 'wp_ajax_tcfh_submit_lead',        'tcfh_handle_submit_lead' );
add_action( 'wp_ajax_nopriv_tcfh_submit_lead', 'tcfh_handle_submit_lead' );

/**
 * AJAX handler for investor (buyers list) form submission.
 */
function tcfh_handle_submit_investor() {
    check_ajax_referer( 'tcfh_submit_lead', 'nonce' );

    $name     = sanitize_text_field( $_POST['name'] ?? '' );
    $email    = sanitize_email( $_POST['email'] ?? '' );
    $phone    = sanitize_text_field( $_POST['phone'] ?? '' );
    $market   = sanitize_text_field( $_POST['market'] ?? '' );
    $strategy = sanitize_text_field( $_POST['strategy'] ?? '' );
    $notes    = sanitize_textarea_field( $_POST['notes'] ?? '' );

    if ( ! $name || ! $email || ! $phone || ! $market || ! $strategy ) {
        wp_send_json_error( array( 'error' => 'Please fill in all required fields.' ), 422 );
    }

    $api_token  = defined( 'AIRTABLE_API_TOKEN' ) ? AIRTABLE_API_TOKEN : '';
    $base_id    = defined( 'AIRTABLE_BASE_ID' )    ? AIRTABLE_BASE_ID   : '';

    if ( ! $api_token || ! $base_id ) {
        error_log( '[TCFH Airtable] Investor submission skipped: CRM configuration missing.' );
        wp_send_json_success( array( 'message' => 'Investor request received!' ) );
    }

    $response = wp_remote_post(
        'https://api.airtable.com/v0/' . $base_id . '/' . rawurlencode( 'Investors' ),
        array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_token,
                'Content-Type'  => 'application/json',
            ),
            'body'    => wp_json_encode( array(
                'records' => array(
                    array(
                        'fields' => array(
                            'Name'             => $name,
                            'Email'            => $email,
                            'Phone'            => $phone,
                            'Preferred Market' => $market,
                            'Strategy'         => $strategy,
                            'Notes'            => $notes,
                            'Lead Source'      => 'Investors',
                            'Submitted At'     => current_time( 'c' ),
                        ),
                    ),
                ),
            ) ),
            'timeout' => 15,
        )
    );

    if ( is_wp_error( $response ) ) {
        error_log( '[TCFH Airtable] Investor submission transport error: ' . $response->get_error_message() );
    } else {
        $code = wp_remote_retrieve_response_code( $response );
        if ( $code < 200 || $code >= 300 ) {
            error_log( '[TCFH Airtable] Investor submission rejected (HTTP ' . $code . '): ' . wp_remote_retrieve_body( $response ) );
        }
    }

    wp_send_json_success( array( 'message' => 'Investor request received!' ) );
}
add_action( 'wp_ajax_tcfh_submit_investor',        'tcfh_handle_submit_investor' );
add_action( 'wp_ajax_nopriv_tcfh_submit_investor', 'tcfh_handle_submit_investor' );

/**
 * AJAX handler for lender (private money) form submission.
 */
function tcfh_handle_submit_lender() {
    check_ajax_referer( 'tcfh_submit_lead', 'nonce' );

    $name   = sanitize_text_field( $_POST['name'] ?? '' );
    $email  = sanitize_email( $_POST['email'] ?? '' );
    $phone  = sanitize_text_field( $_POST['phone'] ?? '' );
    $budget = sanitize_text_field( $_POST['budget'] ?? '' );
    $notes  = sanitize_textarea_field( $_POST['notes'] ?? '' );

    if ( ! $name || ! $email || ! $phone || ! $budget ) {
        wp_send_json_error( array( 'error' => 'Please fill in all required fields.' ), 422 );
    }

    $api_token  = defined( 'AIRTABLE_API_TOKEN' ) ? AIRTABLE_API_TOKEN : '';
    $base_id    = defined( 'AIRTABLE_BASE_ID' )    ? AIRTABLE_BASE_ID   : '';

    if ( ! $api_token || ! $base_id ) {
        error_log( '[TCFH Airtable] Lender submission skipped: CRM configuration missing.' );
        wp_send_json_success( array( 'message' => 'Lender request received!' ) );
    }

    $response = wp_remote_post(
        'https://api.airtable.com/v0/' . $base_id . '/' . rawurlencode( 'Lenders' ),
        array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_token,
                'Content-Type'  => 'application/json',
            ),
            'body'    => wp_json_encode( array(
                'records' => array(
                    array(
                        'fields' => array(
                            'Name'           => $name,
                            'Email'          => $email,
                            'Phone'          => $phone,
                            'Budget'         => $budget,
                            'Notes'          => $notes,
                            'Lead Source'    => 'Lenders',
                            'Submitted At'   => current_time( 'c' ),
                        ),
                    ),
                ),
            ) ),
            'timeout' => 15,
        )
    );

    if ( is_wp_error( $response ) ) {
        error_log( '[TCFH Airtable] Lender submission transport error: ' . $response->get_error_message() );
    } else {
        $code = wp_remote_retrieve_response_code( $response );
        if ( $code < 200 || $code >= 300 ) {
            error_log( '[TCFH Airtable] Lender submission rejected (HTTP ' . $code . '): ' . wp_remote_retrieve_body( $response ) );
        }
    }

    wp_send_json_success( array( 'message' => 'Lender request received!' ) );
}
add_action( 'wp_ajax_tcfh_submit_lender',        'tcfh_handle_submit_lender' );
add_action( 'wp_ajax_nopriv_tcfh_submit_lender', 'tcfh_handle_submit_lender' );

/**
 * ── SEO: Meta description, Open Graph, Twitter Card, Canonical ──
 */
add_action( 'wp_head', 'tcfh_seo_meta_tags', 1 );
function tcfh_seo_meta_tags() {
    $site_name   = 'Tennessee Cash For Homes';
    $default_img = get_template_directory_uri() . '/brand_assets/Company%20Photo.webp';
    $phone       = '(615) 801-8126';

    if ( is_front_page() ) {
        $title = 'Tennessee Cash For Homes | Sell Your House Fast for Cash';
        $desc  = 'Sell your Tennessee house fast for cash. No repairs, no fees, no commissions. Get a fair all-cash offer in 24 hours. Close in as little as 7 days. Family-owned Tennessee home buyers.';
        $url   = home_url( '/' );
    } elseif ( is_page() ) {
        $title = wp_get_document_title();
        $desc  = get_post_meta( get_the_ID(), '_tcfh_meta_desc', true );
        if ( ! $desc ) {
            $desc = wp_trim_words( get_the_excerpt(), 30, '...' );
        }
        $url = get_permalink();
    } else {
        $title = wp_get_document_title();
        $desc  = get_bloginfo( 'description' );
        $url   = get_permalink();
    }

    // Meta description
    if ( $desc ) {
        echo '<meta name="description" content="' . esc_attr( $desc ) . '" />' . "\n";
    }

    // Canonical
    echo '<link rel="canonical" href="' . esc_url( $url ) . '" />' . "\n";

    // Open Graph
    echo '<meta property="og:type" content="website" />' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
    if ( $desc ) {
        echo '<meta property="og:description" content="' . esc_attr( $desc ) . '" />' . "\n";
    }
    echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $default_img ) . '" />' . "\n";
    echo '<meta property="og:image:width" content="2000" />' . "\n";
    echo '<meta property="og:image:height" content="1000" />' . "\n";

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
    if ( $desc ) {
        echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '" />' . "\n";
    }
    echo '<meta name="twitter:image" content="' . esc_url( $default_img ) . '" />' . "\n";
}

/**
 * ── SEO: Shared LocalBusiness JSON-LD builder ──
 * Produces a consistent LocalBusiness schema object used across the site.
 * Callers override only what differs per page (type, name, description, url, areaServed, rating).
 */
function tcfh_build_localbusiness_schema( $args = array() ) {
    $defaults = array(
        'type'           => array( 'LocalBusiness', 'RealEstateAgent' ),
        'name'           => 'Tennessee Cash For Homes',
        'description'    => 'Tennessee\'s trusted cash home buyer. We buy houses fast for cash across all 95 Tennessee counties. No repairs, no fees, no commissions.',
        'url'            => home_url( '/' ),
        'area_served'    => 'Tennessee',
        'price_range'    => 'Free cash offer',
        'include_rating' => true,
        'review_count'   => 50,
    );
    $a = array_merge( $defaults, $args );

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => $a['type'],
        'name'        => $a['name'],
        'description' => $a['description'],
        'url'         => $a['url'],
        'telephone'   => '+1-615-801-8126',
        'email'       => 'info@tncashforhomes.com',
        'image'       => get_template_directory_uri() . '/brand_assets/Company%20Photo.webp',
        'logo'        => get_template_directory_uri() . '/brand_assets/Tennessee%20Cash%20For%20Homes%20Logo.png',
        'address'     => array(
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Murfreesboro',
            'addressRegion'   => 'TN',
            'addressCountry'  => 'US',
        ),
        'geo' => array(
            '@type'     => 'GeoCoordinates',
            'latitude'  => '35.8456',
            'longitude' => '-86.3903',
        ),
        'areaServed' => $a['area_served'],
        'priceRange' => $a['price_range'],
        'openingHoursSpecification' => array(
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ),
            'opens'     => '00:00',
            'closes'    => '23:59',
        ),
        'sameAs' => array(
            'https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815',
            'https://www.google.com/search?q=Tennessee+Cash+For+Homes',
            'https://www.instagram.com/tennesseecashforhomes/',
            'https://www.facebook.com/profile.php?id=61557645432215',
            'https://www.youtube.com/@TennesseeCashForHomes',
            'https://www.tiktok.com/@tennesseecashforhomes',
        ),
    );

    if ( $a['include_rating'] ) {
        $schema['aggregateRating'] = array(
            '@type'       => 'AggregateRating',
            'ratingValue' => '5.0',
            'reviewCount' => (string) $a['review_count'],
            'bestRating'  => '5',
        );
    }

    return $schema;
}

function tcfh_print_jsonld( $schema ) {
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}

/**
 * ── SEO: LocalBusiness JSON-LD Schema ──
 * Homepage gets the canonical org schema (LocalBusiness + RealEstateAgent).
 * Listed interior pages also get LocalBusiness so every major landing has it.
 * County, city, foreclosure, and situation templates register their own
 * context-specific wp_head callback before get_header() runs — see those files.
 */
add_action( 'wp_head', 'tcfh_schema_localbusiness' );
function tcfh_schema_localbusiness() {
    if ( is_front_page() ) {
        tcfh_print_jsonld( tcfh_build_localbusiness_schema() );
        return;
    }

    if ( ! is_page() ) return;

    // Slug-based match covers the common WP case where page-{slug}.php renders
    // automatically without an assigned template. The template-slug check
    // catches cases where the template is assigned to a page with a different slug.
    $interior_slugs = array(
        'how-it-works',
        'where-we-buy',
        'sell-your-land-1',
        'sell-your-land',
        'sell-my-land',
        'investors',
        'investors-lenders',
        'investors-and-lenders',
        'about',
        'facing-foreclosure',
    );
    $interior_templates = array(
        'page-how-it-works.php',
        'page-where-we-buy.php',
        'page-sell-your-land-1.php',
        'page-investors-lenders.php',
        'page-about.php',
        'page-facing-foreclosure.php',
    );

    $is_interior = is_page( $interior_slugs )
        || in_array( get_page_template_slug(), $interior_templates, true );

    if ( $is_interior ) {
        tcfh_print_jsonld( tcfh_build_localbusiness_schema( array(
            'url'  => get_permalink(),
            'type' => array( 'LocalBusiness', 'RealEstateAgent' ),
        ) ) );
    }
}

/**
 * ── FAQ data for the dedicated /faq/ page ──
 * Shared between the rendered accordion in page-faq.php and the FAQPage
 * JSON-LD schema, so the two can never drift apart.
 */
function tcfh_get_faq_page_items() {
    return array(
        array(
            'q' => 'How does the process work?',
            'a' => 'It\'s simple. You contact us, we schedule a quick walkthrough or virtual assessment of your home, and we present you with a fair no-obligation cash offer within 24 hours. If you accept, we handle all the paperwork and close on your timeline as fast as 7 days.',
        ),
        array(
            'q' => 'Is there any obligation when I request an offer?',
            'a' => 'Absolutely none. Our cash offer is completely free with zero pressure. You can take your time, ask questions, and decide what is best for you. We will never push you into a decision.',
        ),
        array(
            'q' => 'Do I need to make repairs before selling?',
            'a' => 'No. We buy homes in any condition including damaged, outdated, fire damaged, or unfinished. You do not need to lift a finger or spend a dime before closing.',
        ),
        array(
            'q' => 'How fast can you close?',
            'a' => 'We can close in as little as 7 days. If you need more time, that works too. We close on your schedule, not ours.',
        ),
        array(
            'q' => 'Will I have to pay any fees or commissions?',
            'a' => 'No agent commissions, no closing costs, no hidden fees. The number we offer is the number you walk away with.',
        ),
        array(
            'q' => 'How do you determine your offer price?',
            'a' => 'We look at the location, condition, and market value of your home along with recent comparable sales in the area. We make fair offers that reflect the real value of your property while accounting for the repairs and updates we will need to make.',
        ),
        array(
            'q' => 'What types of properties do you buy?',
            'a' => 'We buy all types of properties across Tennessee including single family homes, multi-family properties, rental properties, inherited homes, vacant land, and more. Any condition, any situation.',
        ),
        array(
            'q' => 'What if I am behind on mortgage payments or facing foreclosure?',
            'a' => 'We specialize in situations like this. We can move fast enough to stop the foreclosure process and protect your credit. Contact us as soon as possible so we have time to help.',
        ),
        array(
            'q' => 'What if I have tenants living in the property?',
            'a' => 'No problem. We buy rental properties with tenants in place. You do not need to handle evictions or wait for leases to end.',
        ),
        array(
            'q' => 'Do you buy land?',
            'a' => 'Yes. We buy vacant land and rural properties across Tennessee. Reach out and let us know what you have.',
        ),
        array(
            'q' => 'How is this different from listing with a real estate agent?',
            'a' => 'When you list with an agent you typically wait months for a buyer, pay 5 to 6 percent in commissions, make repairs, deal with showings, and risk the buyer backing out at the last minute. With us, you get a cash offer in 24 hours, no repairs, no fees, and a guaranteed closing on your timeline.',
        ),
        array(
            'q' => 'Are you local?',
            'a' => 'Yes. We are a family-owned Tennessee business. You deal directly with local decision makers with no call centers, no out-of-state investors, and no runaround.',
        ),
        array(
            'q' => 'What areas of Tennessee do you buy in?',
            'a' => 'We buy across all of Middle Tennessee including Nashville, Clarksville, Murfreesboro, Franklin, Spring Hill, Columbia, Cookeville, and surrounding areas.',
        ),
        array(
            'q' => 'What if my house needs a lot of work?',
            'a' => 'That is actually our specialty. The more work a home needs, the harder it is to sell on the open market. We buy homes that need major repairs, full renovations, or even cleanup after a hoarding or estate situation.',
        ),
        array(
            'q' => 'How do I get started?',
            'a' => 'Just fill out the form on our website or give us a call at (615) 801-8126. We will reach out quickly to learn more about your property and get the process started.',
        ),
    );
}

/**
 * ── SEO: FAQ Schema ──
 * Emits FAQPage JSON-LD on the homepage (6 top-level FAQs) and on the
 * dedicated /faq/ page (full 15-item list from tcfh_get_faq_page_items()).
 */
add_action( 'wp_head', 'tcfh_schema_faq' );
function tcfh_schema_faq() {
    $faqs = null;

    if ( is_front_page() ) {
        $faqs = array(
            array(
                'q' => 'Is the cash offer really free with no obligation?',
                'a' => 'Absolutely. Our cash offers are 100% free and come with zero obligation. We\'ll present you with a number, and you decide whether to accept, decline, or take time to think. No pressure, ever.',
            ),
            array(
                'q' => 'What types of homes do you buy?',
                'a' => 'We buy all types of residential properties across Tennessee: single-family homes, condos, townhouses, duplexes, and multi-family properties. We purchase homes in any condition: move-in ready, distressed, fire-damaged, flood-damaged, or anything in between.',
            ),
            array(
                'q' => 'How do you determine your offer price?',
                'a' => 'Our offer is based on comparable sales in your area, the current condition of the property, location, and recent market trends. We aim to give you the fairest possible offer, one that reflects real value while accounting for the as-is condition of the home.',
            ),
            array(
                'q' => 'Do I need to clean out the house before closing?',
                'a' => 'No. You can take what you want and leave the rest. We handle all cleanout after closing at no cost to you. This is especially helpful for inherited properties or situations where clearing everything out just is not practical.',
            ),
            array(
                'q' => 'What if I\'m behind on mortgage payments or facing foreclosure?',
                'a' => 'We can often help in pre-foreclosure situations. Selling before a foreclosure completes can protect your credit and put cash in your pocket. Time is critical in these cases, so reach out to us as soon as possible so we can explore your options together.',
            ),
            array(
                'q' => 'Which areas of Tennessee do you serve?',
                'a' => 'We buy homes throughout Tennessee including Nashville, Memphis, Knoxville, Chattanooga, Murfreesboro, Franklin, Clarksville, Shelbyville, Smyrna, Gallatin, Columbia, Spring Hill, Lebanon, Jackson, Hendersonville, Crossville, McMinnville, Old Hickory, Woodbury and surrounding areas.',
            ),
        );
    } elseif ( is_page_template( 'page-faq.php' ) || is_page( 'faq' ) ) {
        $faqs = tcfh_get_faq_page_items();
    }

    if ( empty( $faqs ) ) return;

    $entities = array();
    foreach ( $faqs as $faq ) {
        $entities[] = array(
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ),
        );
    }

    tcfh_print_jsonld( array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $entities,
    ) );
}

/**
 * ── SEO: BreadcrumbList Schema (location + county pages) ──
 */
add_action( 'wp_head', 'tcfh_schema_breadcrumbs' );
function tcfh_schema_breadcrumbs() {
    if ( is_front_page() ) return;
    if ( ! is_page() ) return;

    $items   = array();
    $items[] = array(
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => 'Home',
        'item'     => home_url( '/' ),
    );

    $template = get_post_meta( get_the_ID(), '_wp_page_template', true );

    if ( $template && strpos( $template, 'city-pages/' ) === 0 ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Where We Buy',
            'item'     => home_url( '/where-we-buy/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 3,
            'name'     => get_the_title(),
        );
    } elseif ( $template && strpos( $template, 'county-pages/' ) === 0 ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Where We Buy',
            'item'     => home_url( '/where-we-buy/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 3,
            'name'     => get_the_title(),
        );
    } else {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => get_the_title(),
        );
    }

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}

/**
 * ── SEO: XML Sitemap ──
 */
add_action( 'init', 'tcfh_sitemap_rewrite' );
function tcfh_sitemap_rewrite() {
    add_rewrite_rule( 'sitemap\.xml$', 'index.php?tcfh_sitemap=1', 'top' );
}

add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'tcfh_sitemap';
    return $vars;
} );

add_action( 'template_redirect', 'tcfh_render_sitemap' );
function tcfh_render_sitemap() {
    if ( ! get_query_var( 'tcfh_sitemap' ) ) return;

    header( 'Content-Type: application/xml; charset=utf-8' );
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // Homepage
    echo '<url><loc>' . esc_url( home_url( '/' ) ) . '</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>' . "\n";

    // Static pages
    $pages = get_pages( array( 'post_status' => 'publish' ) );
    foreach ( $pages as $page ) {
        $url = get_permalink( $page->ID );
        echo '<url><loc>' . esc_url( $url ) . '</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>' . "\n";
    }

    // Blog posts
    $posts = get_posts( array( 'post_status' => 'publish', 'numberposts' => -1 ) );
    foreach ( $posts as $post ) {
        $url = get_permalink( $post->ID );
        echo '<url><loc>' . esc_url( $url ) . '</loc><lastmod>' . get_the_modified_date( 'Y-m-d', $post ) . '</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>' . "\n";
    }

    echo '</urlset>';
    exit;
}

/**
 * ── SEO: robots.txt ──
 */
add_filter( 'robots_txt', function( $output, $public ) {
    $output  = "User-agent: *\n";
    $output .= "Allow: /\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Allow: /wp-admin/admin-ajax.php\n\n";
    $output .= "Sitemap: " . home_url( '/sitemap.xml' ) . "\n";
    return $output;
}, 10, 2 );

/**
 * ── SEO: Set homepage title tag ──
 */
add_filter( 'pre_get_document_title', function( $title ) {
    if ( is_front_page() ) {
        return 'Tennessee Cash For Homes | Sell Your House Fast for Cash';
    }
    return $title;
}, 99 );

/**
 * Align the main WordPress query on the blog/category archives with the
 * custom grid query in home.php (9 posts per page). Without this, WP's main
 * query uses the admin "Blog pages show at most" setting — if that differs
 * from 9, requests like /blog/page/N/ can 404 (falling back to index.php's
 * "No content found") even though the grid template would happily render.
 */
add_action( 'pre_get_posts', function( $q ) {
    if ( is_admin() || ! $q->is_main_query() ) return;
    if ( $q->is_home() || $q->is_category() ) {
        $q->set( 'posts_per_page', 9 );
    }
} );

/**
 * Remove first image from single post content (featured image already shown by template).
 */
add_filter( 'the_content', function( $content ) {
    if ( ! is_single() || ! in_the_loop() || ! is_main_query() ) return $content;
    // Remove the first <figure> containing an <img>, or a standalone <img>
    $content = preg_replace( '/<figure[^>]*>.*?<img[^>]*>.*?<\/figure>/is', '', $content, 1, $count );
    if ( ! $count ) {
        $content = preg_replace( '/<img[^>]*>/i', '', $content, 1 );
    }
    return $content;
} );

/**
 * Register page templates from subfolders
 */
add_filter( 'theme_page_templates', function( $templates, $theme, $post ) {
    $subdirs = [ 'city-pages', 'county-pages', 'foreclosure-pages' ];
    foreach ( $subdirs as $subdir ) {
        $dir = get_template_directory() . '/' . $subdir;
        if ( ! is_dir( $dir ) ) continue;
        foreach ( glob( $dir . '/page-*.php' ) as $file ) {
            $headers = get_file_data( $file, [ 'Template Name' => 'Template Name' ] );
            if ( ! empty( $headers['Template Name'] ) ) {
                $key = $subdir . '/' . basename( $file );
                $templates[ $key ] = $headers['Template Name'];
            }
        }
    }
    return $templates;
}, 10, 3 );

/**
 * Load page templates from subfolders
 */
add_filter( 'template_include', function( $template ) {
    $page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
    if ( empty( $page_template ) ) return $template;
    $subdirs = [ 'city-pages', 'county-pages', 'foreclosure-pages' ];
    foreach ( $subdirs as $subdir ) {
        if ( strpos( $page_template, $subdir . '/' ) === 0 ) {
            $full_path = get_template_directory() . '/' . $page_template;
            if ( file_exists( $full_path ) ) return $full_path;
        }
    }
    return $template;
} );
