<?php
/**
 * Tennessee Cash For Homes functions.php
 * Enqueues styles and scripts using WordPress best practices.
 */

function tcfh_enqueue_assets() {
    // Main stylesheet (style.css in theme root, also serves as WP theme header)
    wp_enqueue_style(
        'tcfh-style',
        get_stylesheet_uri(),
        array(),
        '1.0'
    );

    // Google Fonts: Poppins
    wp_enqueue_style(
        'tcfh-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Main site JavaScript (inline in footer, no separate JS file needed)
    // If you later extract JS to a file, enqueue it here like:
    // wp_enqueue_script(
    //     'tcfh-main',
    //     get_template_directory_uri() . '/js/main.js',
    //     array(),
    //     '1.0',
    //     true  // load in footer
    // );

}
add_action( 'wp_enqueue_scripts', 'tcfh_enqueue_assets' );

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
            wp_enqueue_style( 'calendly-widget', 'https://assets.calendly.com/assets/external/widget.css', array(), null );
            wp_enqueue_script( 'calendly-widget', 'https://assets.calendly.com/assets/external/widget.js', array(), null, true );
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
 * AJAX handler for lead form submission.
 * Sends leads to Airtable CRM.
 */
function tcfh_handle_submit_lead() {
    check_ajax_referer( 'tcfh_submit_lead', 'nonce' );

    $name      = sanitize_text_field( $_POST['name'] ?? '' );
    $phone     = sanitize_text_field( $_POST['phone'] ?? '' );
    $address   = sanitize_text_field( $_POST['address'] ?? '' );

    if ( ! $name || ! $phone || ! $address ) {
        wp_send_json_error( array( 'error' => 'Please fill in all required fields.' ), 422 );
    }

    $api_token  = defined( 'AIRTABLE_API_TOKEN' )  ? AIRTABLE_API_TOKEN  : '';
    $base_id    = defined( 'AIRTABLE_BASE_ID' )     ? AIRTABLE_BASE_ID    : '';
    $table_name = defined( 'AIRTABLE_TABLE_NAME' )  ? AIRTABLE_TABLE_NAME : '';

    if ( ! $api_token || ! $base_id || ! $table_name ) {
        wp_send_json_error( array( 'error' => 'CRM configuration missing.' ), 500 );
    }

    $submitted_at = current_time( 'c' );

    $response = wp_remote_post(
        'https://api.airtable.com/v0/' . $base_id . '/' . rawurlencode( $table_name ),
        array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_token,
                'Content-Type'  => 'application/json',
            ),
            'body'    => wp_json_encode( array(
                'records' => array(
                    array(
                        'fields' => array(
                            'Lead Name'    => $name,
                            'Phone Number' => $phone,
                            'Address'      => $address,
                            'Submitted At' => $submitted_at,
                        ),
                    ),
                ),
            ) ),
            'timeout' => 15,
        )
    );

    if ( is_wp_error( $response ) ) {
        wp_send_json_error( array( 'error' => 'Failed to connect to CRM.' ), 500 );
    }

    $code = wp_remote_retrieve_response_code( $response );
    if ( $code < 200 || $code >= 300 ) {
        wp_send_json_error( array( 'error' => 'CRM rejected the submission.' ), 500 );
    }

    wp_send_json_success( array( 'message' => 'Request received!' ) );
}
add_action( 'wp_ajax_tcfh_submit_lead',        'tcfh_handle_submit_lead' );
add_action( 'wp_ajax_nopriv_tcfh_submit_lead', 'tcfh_handle_submit_lead' );

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
 * ── SEO: LocalBusiness JSON-LD Schema (homepage) ──
 */
add_action( 'wp_head', 'tcfh_schema_localbusiness' );
function tcfh_schema_localbusiness() {
    if ( ! is_front_page() ) return;

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        'name'        => 'Tennessee Cash For Homes',
        'description' => 'Family-owned Tennessee cash home buyers. We buy houses in any condition for a fair cash price. No repairs, no fees, no commissions. Close in as little as 7 days.',
        'url'         => home_url( '/' ),
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
        'areaServed' => array(
            '@type' => 'State',
            'name'  => 'Tennessee',
        ),
        'priceRange'        => '$$',
        'openingHoursSpecification' => array(
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ),
            'opens'     => '00:00',
            'closes'    => '23:59',
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
}

/**
 * ── SEO: FAQ Schema (homepage) ──
 */
add_action( 'wp_head', 'tcfh_schema_faq' );
function tcfh_schema_faq() {
    if ( ! is_front_page() ) return;

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

    $schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $entities,
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
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
    $subdirs = [ 'city-pages', 'county-pages' ];
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
    $subdirs = [ 'city-pages', 'county-pages' ];
    foreach ( $subdirs as $subdir ) {
        if ( strpos( $page_template, $subdir . '/' ) === 0 ) {
            $full_path = get_template_directory() . '/' . $page_template;
            if ( file_exists( $full_path ) ) return $full_path;
        }
    }
    return $template;
} );
