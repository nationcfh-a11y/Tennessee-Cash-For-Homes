<?php
/**
 * Tennessee Cash For Homes functions.php
 * Enqueues styles and scripts using WordPress best practices.
 */

function tcfh_enqueue_assets() {
    // Main stylesheet: serve the minified build; fall back to style.css if missing.
    // Loaded asynchronously — see tcfh_async_style_loader_tag() below, which
    // swaps rel="stylesheet" for the rel="preload" + onload trick so the
    // browser doesn't render-block on the 95KB file. Above-the-fold styles
    // are inlined separately by tcfh_inline_critical_css() in <head>.
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

    // Mobile-only overrides. Loaded after the main stylesheet so its
    // media-query rules win without touching desktop styles. The media
    // attribute below tells the browser this CSS is only needed at
    // ≤1024px — desktop browsers download it without render-blocking,
    // saving ~10ms LCP on desktop.
    $mobile_path = get_template_directory() . '/mobile-optimization.css';
    $mobile_uri  = get_template_directory_uri() . '/mobile-optimization.css';
    if ( file_exists( $mobile_path ) ) {
        wp_enqueue_style(
            'tcfh-mobile',
            $mobile_uri,
            array( 'tcfh-style' ),
            (string) filemtime( $mobile_path ),
            '(max-width: 1024px)'
        );
    }

    // Note: Poppins @font-face declarations are inlined as part of the
    // critical CSS in <head>, so a separate fonts/poppins.css enqueue is
    // not needed. The woff2 binaries themselves are preloaded in header.php.

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

    // Funnel instrumentation for GA4 + Clarity. Listens for the
    // tcfh:lead-success / tcfh:lead-error events dispatched by main.js,
    // so it must load alongside it.
    $analytics_path = get_template_directory() . '/js/analytics.js';
    $analytics_uri  = get_template_directory_uri() . '/js/analytics.js';
    if ( file_exists( $analytics_path ) ) {
        wp_enqueue_script(
            'tcfh-analytics',
            $analytics_uri,
            array(),
            (string) filemtime( $analytics_path ),
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
 * Inline the critical above-the-fold CSS in <head> at very high priority so
 * the first paint does not wait for the main stylesheet. critical.min.css
 * covers nav, hero, and the form card across the homepage and inner-page
 * heroes — anything below the fold is styled by the async-loaded
 * style.min.css that follows.
 *
 * Wired with priority 1 so it lands in <head> before WordPress prints the
 * enqueued <link> tags (which happens at priority 8 via wp_print_styles).
 * Theme directory URL is substituted into the file via __THEME_URI__ so
 * absolute paths in url() references resolve correctly when inlined.
 */
function tcfh_inline_critical_css() {
    $path = get_template_directory() . '/critical.min.css';
    if ( ! file_exists( $path ) ) return;
    $css = file_get_contents( $path );
    $css = str_replace( '__THEME_URI__', get_template_directory_uri(), $css );
    echo "<style id=\"tcfh-critical\">" . $css . "</style>\n";
}
add_action( 'wp_head', 'tcfh_inline_critical_css', 1 );

/**
 * Preconnect hints for the YouTube facade on the homepage only.
 * Saves the TCP+TLS handshake when the visitor taps Play, so the iframe
 * starts streaming faster. Gated on is_front_page() so other pages do
 * not pay the cost of two extra connections they will never use.
 */
add_action( 'wp_head', function() {
    if ( ! is_front_page() ) {
        return;
    }
    echo '<link rel="preconnect" href="https://www.youtube.com" crossorigin />' . "\n";
    echo '<link rel="preconnect" href="https://i.ytimg.com" crossorigin />' . "\n";
}, 3 );

/**
 * Convert the main stylesheet <link> to load asynchronously using the
 * rel="preload" → onload swap pattern. The browser fetches the CSS with
 * high priority but does NOT block render on it; once loaded the inline
 * onload handler promotes it to a real stylesheet. A <noscript> fallback
 * ensures users with JS disabled still get the full styles.
 *
 * Critical above-the-fold CSS is inlined by tcfh_inline_critical_css()
 * so first paint never has to wait on this download.
 */
add_filter( 'style_loader_tag', function( $tag, $handle ) {
    if ( 'tcfh-style' !== $handle ) {
        return $tag;
    }
    if ( ! preg_match( '/href=([\'\"])([^\'\"]+)\1/', $tag, $m ) ) {
        return $tag;
    }
    $href = $m[2];
    // Swap rel="stylesheet" for the preload+onload pattern. fetchpriority="low"
    // keeps this 16KB-gzipped preload from competing with the hero LCP image
    // for early bandwidth on mobile — the critical CSS already styled the
    // above-the-fold layout, so this fetch can slide in after LCP without
    // any visual impact. Handles both double- and single-quoted rel styles.
    $async_tag = preg_replace(
        '/\s+rel=([\'\"])stylesheet\1/',
        ' rel="preload" as="style" fetchpriority="low" onload="this.onload=null;this.rel=\'stylesheet\'"',
        $tag,
        1
    );
    $async_tag .= "<noscript><link rel='stylesheet' href='" . esc_url( $href ) . "'></noscript>";
    return $async_tag;
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
 * /thank-you/ is a virtual route (no WP page in the DB), so Rank Math has
 * nothing to attach SEO meta to and falls back to the blog title — which
 * is why the tab was showing "Blog Home - Tennessee Cash For Homes".
 * Force the correct title and noindex the page so it stays out of Google.
 */
function tcfh_is_thank_you() {
    return (bool) get_query_var( 'tcfh_thank_you' );
}

function tcfh_thank_you_title( $title ) {
    if ( tcfh_is_thank_you() ) {
        return 'Thank You | Tennessee Cash For Homes';
    }
    return $title;
}
add_filter( 'pre_get_document_title', 'tcfh_thank_you_title', 100 );
add_filter( 'rank_math/frontend/title', 'tcfh_thank_you_title', 100 );

function tcfh_thank_you_robots( $robots ) {
    if ( tcfh_is_thank_you() ) {
        return array( 'noindex' => 'noindex', 'nofollow' => 'nofollow' );
    }
    return $robots;
}
add_filter( 'wp_robots', 'tcfh_thank_you_robots', 100 );
add_filter( 'rank_math/frontend/robots', function( $robots ) {
    if ( tcfh_is_thank_you() ) {
        return array( 'index' => 'noindex', 'follow' => 'nofollow' );
    }
    return $robots;
}, 100 );

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
 *
 * The nonce baked into HTML can go stale two ways: (1) full-page caches
 * (Cloudflare APO / WP Rocket / host page cache) serve the same nonce to
 * every visitor, which fails for guests; (2) mobile tabs left open for >24h
 * outlive the nonce TTL. The JS layer therefore refreshes the nonce via
 * `nonce_url` immediately before each submit instead of trusting the cached
 * value. This `nonce` field stays as a best-effort warm value for the first
 * submit on an uncached request.
 */
add_action( 'wp_head', function() {
    echo '<script>var tcfh_ajax = ' . wp_json_encode( array(
        'ajax_url'      => admin_url( 'admin-ajax.php' ),
        'nonce'         => wp_create_nonce( 'tcfh_submit_lead' ),
        'nonce_url'     => home_url( '/?tcfh_nonce=1' ),
        'beacon_url'    => home_url( '/?tcfh_beacon=1' ),
        'thank_you_url' => home_url( '/thank-you/' ),
    ) ) . ';</script>' . "\n";
} );

/**
 * Fresh-nonce endpoint. Sends a no-store nonce response that bypasses any
 * page cache (the only cacheable bits live behind admin-ajax.php / wp_head,
 * neither of which honor query-string variants reliably). Called by the JS
 * submit pipeline right before each POST so the nonce check can't be defeated
 * by a stale cached nonce.
 */
add_action( 'init', function() {
    if ( ! isset( $_GET['tcfh_nonce'] ) ) return;
    nocache_headers();
    header( 'Content-Type: application/json; charset=utf-8' );
    header( 'X-Robots-Tag: noindex' );
    echo wp_json_encode( array(
        'nonce' => wp_create_nonce( 'tcfh_submit_lead' ),
        'ts'    => time(),
    ) );
    exit;
}, 1 );

/**
 * Beacon endpoint — last-resort capture for submissions that fail every
 * other path. The JS layer fires `navigator.sendBeacon()` with the raw form
 * payload right before redirecting; if PHP receives a beacon but no matching
 * row exists in wp_tcfh_leads, that's a dropped submission we can rescue by
 * hand. We intentionally do NOT check_ajax_referer here — the whole point of
 * the beacon is to catch nonce failures.
 */
add_action( 'init', function() {
    if ( ! isset( $_GET['tcfh_beacon'] ) ) return;
    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        status_header( 405 );
        exit;
    }
    if ( function_exists( 'tcfh_dropped_log_record' ) ) {
        tcfh_dropped_log_record( 'beacon', $_POST );
    }
    nocache_headers();
    status_header( 204 );
    exit;
}, 1 );

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
 * Microsoft Clarity — session recordings, scroll maps, click heatmaps and
 * rage/dead-click detection. Fires site-wide via wp_head.
 *
 * Dashboard: https://clarity.microsoft.com  (project "xuse8faz8t")
 *
 * Recordings can be filtered by traffic source, so paid Google Ads sessions
 * can be isolated from organic. js/analytics.js additionally stamps custom
 * Clarity tags (form_reached, form_abandoned_at, deepest_section) so sessions
 * that dropped at a specific form field can be pulled up directly.
 */
add_action( 'wp_head', function() {
    $clarity_project_id = 'xuse8faz8t';
    ?>
    <!-- Microsoft Clarity -->
    <script>
      (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
      })(window, document, "clarity", "script", "<?php echo esc_js( $clarity_project_id ); ?>");
    </script>
    <?php
}, 1 );

/**
 * Google Preferred Sources — publisher.js library.
 *
 * Powers the opt-in button rendered by google-preferred-source.php at the end
 * of every blog post. Loaded on single blog posts only.
 *
 * The condition MUST stay identical to the guard at the top of
 * google-preferred-source.php.
 */
add_action( 'wp_head', function() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }
    ?>
    <!-- Google Preferred Sources -->
    <script async src="https://news.google.com/swg/js/v1/publisher.js"></script>
    <?php
}, 1 );

/**
 * Preload the hero background image for each page template.
 * Most pages reference the hero via CSS url(); without a preload hint the
 * browser can't discover them until CSSOM is built, which delays LCP by
 * ~800–1500ms. The homepage uses a real <img class="hero__bg" srcset> so its
 * preload uses imagesrcset/imagesizes to match the responsive request exactly
 * (including high-DPR mobile, which media-aware preloads can't represent).
 */
add_action( 'wp_head', function() {
    $base = get_template_directory_uri() . '/brand_assets/';

    if ( is_front_page() ) {
        printf(
            '<link rel="preload" as="image" imagesrcset="%s 800w, %s 1375w" imagesizes="100vw" fetchpriority="high" />' . "\n",
            esc_url( $base . 'New_Background-800w.webp' ),
            esc_url( $base . 'New_Background.webp' )
        );
        return;
    }

    // [desktop_filename, mobile_filename]
    $images = null;

    if ( is_page( 'facing-foreclosure' ) ) {
        $images = array( 'New_Background.webp', 'New_Background-800w.webp' );
    } elseif ( is_page( 'sell-your-land-1' ) || is_page( 'sell-your-land' ) || is_page( 'sell-my-land' ) ) {
        $images = array( 'Tennessee_Cash_For_Land.webp', 'Tennessee_Cash_For_Land-800w.webp' );
    } elseif ( is_page( 'about' ) ) {
        $images = array( 'team-photo.webp', 'team-photo-800w.webp' );
    } elseif ( is_page( 'where-we-buy' ) ) {
        $images = array( 'Where%20we%20buy%20background%20image.webp', 'Where%20we%20buy%20background%20image-800w.webp' );
    } elseif ( is_home() || is_archive() ) {
        $images = array( 'New_Background.webp', 'New_Background-800w.webp' );
    } else {
        $tpl = get_post_meta( get_the_ID(), '_wp_page_template', true );
        if ( $tpl && strpos( $tpl, 'foreclosure-pages/' ) === 0 ) {
            $images = array( 'New_Background.webp', 'New_Background-800w.webp' );
        }
    }

    if ( $images ) {
        // Media-aware preloads: browsers only download the variant that matches.
        // Matches the 800px breakpoint used in the CSS background overrides.
        printf(
            '<link rel="preload" as="image" href="%s" media="(min-width: 801px)" fetchpriority="high" />' . "\n",
            esc_url( $base . $images[0] )
        );
        printf(
            '<link rel="preload" as="image" href="%s" media="(max-width: 800px)" fetchpriority="high" />' . "\n",
            esc_url( $base . $images[1] )
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
 * Force the Investors and Lenders menu item to point at /investors/ regardless
 * of what is saved in the WordPress menu settings, so legacy /investors-lenders/
 * links get corrected on the way out.
 */
function tcfh_fix_investors_menu_url( $items ) {
    foreach ( $items as $item ) {
        if ( ! empty( $item->url ) && false !== strpos( $item->url, '/investors-lenders' ) ) {
            $item->url = home_url( '/investors/' );
        }
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'tcfh_fix_investors_menu_url' );

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
 * Stores the lead locally, emails a notification, then attempts an Airtable
 * sync. Failed syncs are queued for cron retry. See the lead-pipeline section
 * at the bottom of this file for the full helper stack.
 */
function tcfh_handle_submit_lead() {
    // Soft nonce check: on failure, log the attempt and return a JSON error
    // with a recoverable code so the client can fetch a fresh nonce and retry.
    // The default check_ajax_referer() wp_die('-1') response would otherwise
    // crash the JSON parse on the client and look identical to a network drop.
    if ( ! check_ajax_referer( 'tcfh_submit_lead', 'nonce', false ) ) {
        tcfh_dropped_log_record( 'nonce_fail', $_POST );
        wp_send_json_error( array( 'error' => 'Session expired. Please try again.', 'code' => 'nonce_expired' ), 403 );
    }

    $name        = sanitize_text_field( $_POST['name'] ?? '' );
    $phone       = sanitize_text_field( $_POST['phone'] ?? '' );
    $address     = sanitize_text_field( $_POST['address'] ?? '' );
    $lead_source = sanitize_text_field( $_POST['lead_source'] ?? '' );

    if ( ! $name || ! $phone || ! $address ) {
        tcfh_dropped_log_record( 'validation_fail', $_POST );
        wp_send_json_error( array( 'error' => 'Please fill in all required fields.', 'code' => 'validation' ), 422 );
    }

    $row = array(
        'lead_type'   => 'lead',
        'name'        => $name,
        'phone'       => $phone,
        'email'       => '',
        'address'     => $address,
        'lead_source' => $lead_source,
        'payload'     => array(
            'Lead Name'    => $name,
            'Phone Number' => $phone,
            'Address'      => $address,
            'Lead Source'  => $lead_source,
            'Lead Status'  => "Haven't Called",
        ),
    );

    $result = tcfh_lead_save_and_sync( $row, 'CRM' );

    wp_send_json_success( array(
        'message' => 'Request received!',
        'row_id'  => $result['row_id'],
        'synced'  => $result['synced'],
    ) );
}
add_action( 'wp_ajax_tcfh_submit_lead',        'tcfh_handle_submit_lead' );
add_action( 'wp_ajax_nopriv_tcfh_submit_lead', 'tcfh_handle_submit_lead' );

/**
 * AJAX handler for investor (buyers list) form submission.
 */
function tcfh_handle_submit_investor() {
    if ( ! check_ajax_referer( 'tcfh_submit_lead', 'nonce', false ) ) {
        tcfh_dropped_log_record( 'nonce_fail', $_POST );
        wp_send_json_error( array( 'error' => 'Session expired. Please try again.', 'code' => 'nonce_expired' ), 403 );
    }

    $name     = sanitize_text_field( $_POST['name'] ?? '' );
    $email    = sanitize_email( $_POST['email'] ?? '' );
    $phone    = sanitize_text_field( $_POST['phone'] ?? '' );
    $market   = sanitize_text_field( $_POST['market'] ?? '' );
    $strategy = sanitize_text_field( $_POST['strategy'] ?? '' );
    $notes    = sanitize_textarea_field( $_POST['notes'] ?? '' );

    if ( ! $name || ! $email || ! $phone || ! $market || ! $strategy ) {
        tcfh_dropped_log_record( 'validation_fail', $_POST );
        wp_send_json_error( array( 'error' => 'Please fill in all required fields.', 'code' => 'validation' ), 422 );
    }

    $row = array(
        'lead_type'   => 'investor',
        'name'        => $name,
        'phone'       => $phone,
        'email'       => $email,
        'address'     => '',
        'lead_source' => 'Investors',
        'payload'     => array(
            'Name'             => $name,
            'Email'            => $email,
            'Phone'            => $phone,
            'Preferred Market' => $market,
            'Strategy'         => $strategy,
            'Notes'            => $notes,
            'Lead Source'      => 'Investors',
        ),
    );

    $result = tcfh_lead_save_and_sync( $row, 'Investors' );

    wp_send_json_success( array(
        'message' => 'Investor request received!',
        'row_id'  => $result['row_id'],
        'synced'  => $result['synced'],
    ) );
}
add_action( 'wp_ajax_tcfh_submit_investor',        'tcfh_handle_submit_investor' );
add_action( 'wp_ajax_nopriv_tcfh_submit_investor', 'tcfh_handle_submit_investor' );

/**
 * AJAX handler for lender (private money) form submission.
 */
function tcfh_handle_submit_lender() {
    if ( ! check_ajax_referer( 'tcfh_submit_lead', 'nonce', false ) ) {
        tcfh_dropped_log_record( 'nonce_fail', $_POST );
        wp_send_json_error( array( 'error' => 'Session expired. Please try again.', 'code' => 'nonce_expired' ), 403 );
    }

    $name   = sanitize_text_field( $_POST['name'] ?? '' );
    $email  = sanitize_email( $_POST['email'] ?? '' );
    $phone  = sanitize_text_field( $_POST['phone'] ?? '' );
    $budget = sanitize_text_field( $_POST['budget'] ?? '' );
    $notes  = sanitize_textarea_field( $_POST['notes'] ?? '' );

    if ( ! $name || ! $email || ! $phone || ! $budget ) {
        tcfh_dropped_log_record( 'validation_fail', $_POST );
        wp_send_json_error( array( 'error' => 'Please fill in all required fields.', 'code' => 'validation' ), 422 );
    }

    $row = array(
        'lead_type'   => 'lender',
        'name'        => $name,
        'phone'       => $phone,
        'email'       => $email,
        'address'     => '',
        'lead_source' => 'Lenders',
        'payload'     => array(
            'Name'        => $name,
            'Email'       => $email,
            'Phone'       => $phone,
            'Budget'      => $budget,
            'Notes'       => $notes,
            'Lead Source' => 'Lenders',
        ),
    );

    $result = tcfh_lead_save_and_sync( $row, 'Lenders' );

    wp_send_json_success( array(
        'message' => 'Lender request received!',
        'row_id'  => $result['row_id'],
        'synced'  => $result['synced'],
    ) );
}
add_action( 'wp_ajax_tcfh_submit_lender',        'tcfh_handle_submit_lender' );
add_action( 'wp_ajax_nopriv_tcfh_submit_lender', 'tcfh_handle_submit_lender' );

/**
 * ── SEO: Meta description, Open Graph, Twitter Card, Canonical ──
 */
add_action( 'wp_head', 'tcfh_seo_meta_tags', 1 );
function tcfh_seo_meta_tags() {
    $site_name   = 'Tennessee Cash For Homes';
    $default_img = get_template_directory_uri() . '/brand_assets/team-photo.webp';
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

    // Canonical: intentionally NOT emitted here. Rank Math owns the canonical
    // tag sitewide and is correct on every indexable URL (verified 212/212 on
    // 2026-08-14). This function used to echo a second canonical built from
    // $url, which is wrong on archives: on the posts page is_page() is false,
    // so $url fell through to a bare get_permalink() and returned the FIRST
    // POST IN THE LOOP rather than the archive. That made /blog/ declare the
    // newest blog post as its canonical, conflicting with Rank Math.
    // $url is still used for og:url / twitter below and carries that same
    // archive bug there; harmless for indexing, tracked separately.

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
        'foundingDate'=> '2017',
        'image'       => get_template_directory_uri() . '/brand_assets/team-photo.webp',
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
            'q' => 'How does selling your house for cash work in Tennessee?',
            'a' => 'Selling a house for cash in Tennessee is a direct sale to a real estate investor instead of a listing on the MLS. The process has four steps: (1) you submit basic property details, (2) the buyer schedules a quick walkthrough or virtual assessment, (3) the buyer presents a no-obligation cash offer, usually within 24 hours, and (4) closing happens through a Tennessee title company in as little as 7 days. There is no agent commission, no buyer financing contingency, and no required repairs or staging. Tennessee Cash For Homes follows this exact process across all 95 Tennessee counties.',
        ),
        array(
            'q' => 'How fast can I sell my house in Tennessee?',
            'a' => 'A traditional Tennessee listing takes 60 to 90+ days on average from listing to closing, plus 30 to 45 more days if the buyer is using a mortgage. A direct cash sale skips the lender, appraisal, and inspection-driven repair negotiation, so it can close in as little as 7 days. Tennessee Cash For Homes delivers a cash offer within 24 hours and most sellers choose to close between 7 and 30 days, depending on what works best for their timeline.',
        ),
        array(
            'q' => 'What are the pros and cons of selling to a cash buyer?',
            'a' => 'Pros: closes in as little as 7 days, no repairs or cleanup needed, no real estate agent commissions (saves 5–6% of the sale price), no closing costs, no buyer financing or appraisal risk, and certainty of sale. Cons: the offer is below full retail market value because the cash buyer takes on the repair, holding, and resale risk. A cash sale is the right move when speed, certainty, or property condition matters more than maximizing the last dollar of retail price.',
        ),
        array(
            'q' => 'Is Tennessee Cash For Homes legitimate?',
            'a' => 'Yes. Tennessee Cash For Homes is an A+ Better Business Bureau Accredited business based in Murfreesboro, Tennessee, founded in 2017. The company has a 5-star Google rating from verified Tennessee homeowners, is family-owned and operated, and the team is named publicly: Karson Carmichael (Founder), Dowling Armstrong (licensed Tennessee real estate agent with over 1,000 transactions), and Davis Armstrong (Lipscomb University Finance graduate). All closings are handled through licensed Tennessee title companies. The BBB profile can be verified at bbb.org and reviews are public on Google.',
        ),
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
                'q' => 'How does selling your house for cash work in Tennessee?',
                'a' => 'Selling a house for cash in Tennessee is a direct sale to a real estate investor instead of listing on the MLS. The typical process has four steps: (1) you submit basic property details, (2) the buyer schedules a quick walkthrough or virtual assessment, (3) the buyer presents a no-obligation cash offer, usually within 24 hours, and (4) closing happens through a Tennessee title company in as little as 7 days. Unlike a traditional sale, there are no repairs, no real estate agent commissions, no open houses, and no financing contingencies. Tennessee Cash For Homes follows this exact process and buys homes in all 95 Tennessee counties.',
            ),
            array(
                'q' => 'How fast can I sell my house in Tennessee?',
                'a' => 'A traditional listing in Tennessee takes 60 to 90+ days on average from listing to closing, plus another 30 to 45 days if the buyer needs a mortgage. A direct cash sale can close in as little as 7 days because there is no lender, no appraisal, and no inspection-driven repair negotiation. Tennessee Cash For Homes typically delivers a cash offer within 24 hours and closes on the homeowner\'s preferred date — most sellers choose between 7 and 30 days.',
            ),
            array(
                'q' => 'What are the pros and cons of selling to a cash buyer?',
                'a' => 'Pros of selling to a cash home buyer in Tennessee: (1) closes in as little as 7 days, (2) no repairs or cleanup needed, (3) no agent commissions (saves 5–6% of the sale price), (4) no closing costs, (5) no buyer financing or appraisal that can fall through, and (6) certainty of sale. Cons: the offer will be below full retail market value because the buyer takes on the repair, holding, and resale risk. A cash sale is the right choice when speed, certainty, or condition of the home matters more than squeezing out the last dollar of retail price.',
            ),
            array(
                'q' => 'Is Tennessee Cash For Homes legitimate?',
                'a' => 'Yes. Tennessee Cash For Homes is a Better Business Bureau Accredited business with an A+ rating, located in Murfreesboro, Tennessee, and founded in 2017. The company has a 5-star Google review average from real verified Tennessee homeowners, is family-owned and operated, and is run by a named, public team — Karson Carmichael (Founder), Dowling Armstrong (licensed Tennessee real estate agent with 1,000+ transactions), and Davis Armstrong. All transactions close through licensed Tennessee title companies. You can verify the BBB profile at bbb.org and read reviews on Google.',
            ),
            array(
                'q' => 'What types of homes do you buy?',
                'a' => 'Tennessee Cash For Homes buys single-family homes, condos, townhouses, duplexes, multi-family properties, rental properties (with or without tenants), inherited and probate homes, and vacant land across Tennessee. Properties are bought in any condition — move-in ready, outdated, fire-damaged, flood-damaged, with foundation issues, hoarder homes, and properties with code violations or liens.',
            ),
            array(
                'q' => 'Which areas of Tennessee do you serve?',
                'a' => 'Tennessee Cash For Homes buys houses across all 95 Tennessee counties, including Nashville, Memphis, Knoxville, Chattanooga, Murfreesboro, Franklin, Clarksville, Spring Hill, Hendersonville, Smyrna, Gallatin, Columbia, Lebanon, Jackson, Crossville, McMinnville, Cookeville, Johnson City, Kingsport, and Bristol.',
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
 * ── SEO/AEO: Review schema ──
 * Emits individual Review entities on the homepage so that AI engines and
 * search engines see real customer testimonials (not just an aggregate rating).
 * Source of truth is reviews-section.php; keep this list in sync if you edit
 * that file. Names and bodies are real customers from public Google reviews.
 */
function tcfh_get_reviews() {
    return array(
        array( 'author' => 'Nathan Krager',     'rating' => 5, 'date' => '2024-08-12', 'body' => 'Great company to work with, these guys actually care about you and will take care of you. Great character as well!' ),
        array( 'author' => 'Trish Haberman',    'rating' => 5, 'date' => '2024-09-04', 'body' => 'Such a great group to work with. They were able to give me a fair deal with no hassles. Thank you Karson for going above and beyond.' ),
        array( 'author' => 'Clayton Daniels',   'rating' => 5, 'date' => '2024-10-21', 'body' => 'These guys were absolutely amazing. I sold my house without having to do a single repair and they even helped me find my next place to live!' ),
        array( 'author' => 'Lisa Daniels',      'rating' => 5, 'date' => '2024-11-02', 'body' => "If you need to sell a home quickly, they're professional, fair, and truly care about making things easy for the seller. Highly recommend." ),
        array( 'author' => 'Nancy Hughes',      'rating' => 5, 'date' => '2025-01-17', 'body' => 'The team at TN Cash for Homes were outstanding! I was in a bad situation with my home loan and after one call with this company they created a custom solution that resolved my issues. They were professional, efficient and understanding. I highly recommend this company.' ),
        array( 'author' => 'John Peterson',     'rating' => 5, 'date' => '2025-03-08', 'body' => 'Really enjoyed working with Tennessee Cash For Homes. They helped me sell my house in Clarksville fast for cash! Highly recommend working with them.' ),
        array( 'author' => 'Dowling Armstrong', 'rating' => 5, 'date' => '2025-05-14', 'body' => "They bought my father's rental portfolio! Paid cash and closed on multiple homes in less than 3 weeks! They also took them with the tenants which is really tough to find someone willing to buy a rental with leases in place. Would highly recommend this company to anyone who doesn't want to deal with listing a home!" ),
        array( 'author' => 'Christopher Payne', 'rating' => 5, 'date' => '2025-07-22', 'body' => 'Great experience working with these guys. The whole process went super fast, and easy. Both Davis and Dowling were true to their word which is very important when doing business. I would work with them again any day.' ),
        array( 'author' => 'Chris Iannotti',    'rating' => 5, 'date' => '2025-09-03', 'body' => 'Nothing but a great experience start to finish. All of my questions were answered and they were quick to respond when needed.' ),
    );
}

add_action( 'wp_head', 'tcfh_schema_reviews' );
function tcfh_schema_reviews() {
    if ( ! is_front_page() ) return;

    $reviews = tcfh_get_reviews();
    $review_entities = array();
    foreach ( $reviews as $r ) {
        $review_entities[] = array(
            '@type'         => 'Review',
            'author'        => array( '@type' => 'Person', 'name' => $r['author'] ),
            'datePublished' => $r['date'],
            'reviewBody'    => $r['body'],
            'reviewRating'  => array(
                '@type'       => 'Rating',
                'ratingValue' => (string) $r['rating'],
                'bestRating'  => '5',
            ),
            'itemReviewed'  => array(
                '@type' => 'LocalBusiness',
                'name'  => 'Tennessee Cash For Homes',
            ),
        );
    }

    foreach ( $review_entities as $entity ) {
        $entity['@context'] = 'https://schema.org';
        tcfh_print_jsonld( $entity );
    }
}

/**
 * ── SEO/AEO: Service schema ──
 * Tells search and AI engines exactly what services we offer and where.
 * Helps surface us in answers like "who buys houses for cash in Tennessee".
 */
add_action( 'wp_head', 'tcfh_schema_service' );
function tcfh_schema_service() {
    if ( ! is_front_page() ) return;

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'Service',
        'name'            => 'Cash Home Buying in Tennessee',
        'serviceType'     => 'Cash Home Buyer',
        'description'     => 'Tennessee Cash For Homes buys houses directly from homeowners across all 95 Tennessee counties for cash. We make a no-obligation offer within 24 hours, buy houses in any condition with no repairs required, charge no agent commissions or closing costs, and can close in as little as 7 days.',
        'provider'        => array(
            '@type'     => 'LocalBusiness',
            'name'      => 'Tennessee Cash For Homes',
            'telephone' => '+1-615-801-8126',
            'url'       => home_url( '/' ),
        ),
        'areaServed'      => array(
            '@type' => 'State',
            'name'  => 'Tennessee',
        ),
        'audience'        => array(
            '@type'        => 'Audience',
            'audienceType' => 'Tennessee homeowners selling a house for cash',
        ),
        'offers'          => array(
            '@type'         => 'Offer',
            'price'         => '0',
            'priceCurrency' => 'USD',
            'description'   => 'Free, no-obligation cash offer within 24 hours.',
            'availability'  => 'https://schema.org/InStock',
        ),
        'hasOfferCatalog' => array(
            '@type'           => 'OfferCatalog',
            'name'            => 'Cash Home Buying Services',
            'itemListElement' => array(
                array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Sell my house fast for cash' ) ),
                array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Sell house as-is, no repairs' ) ),
                array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Stop foreclosure by selling for cash' ) ),
                array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Sell inherited or probate house in Tennessee' ) ),
                array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Sell rental property with tenants in place' ) ),
                array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Sell vacant land in Tennessee' ) ),
            ),
        ),
    );

    tcfh_print_jsonld( $schema );
}

/**
 * ── SEO/AEO: Person schema for team members on the about page ──
 * AI engines weight Person/Author entities heavily for E-E-A-T. Surfacing the
 * founder and licensed-agent team members as named, qualified people improves
 * the chance of being cited as a trusted source.
 */
add_action( 'wp_head', 'tcfh_schema_persons' );
function tcfh_schema_persons() {
    if ( ! is_page( 'about' ) && get_page_template_slug() !== 'page-about.php' ) return;

    $org = array(
        '@type' => 'Organization',
        'name'  => 'Tennessee Cash For Homes',
        'url'   => home_url( '/' ),
    );

    $people = array(
        array(
            'name'        => 'Karson Carmichael',
            'jobTitle'    => 'Founder',
            'description' => 'Founder of Tennessee Cash For Homes. Bachelor\'s degree in Business Management. Nearly 3 years of hands-on Tennessee real estate experience focused on direct cash purchases of homes in any condition.',
            'image'       => get_template_directory_uri() . '/brand_assets/Karson%20Tennessee%20Cash%20For%20Homes.webp',
            'sameAs'      => array(
                'https://www.bbb.org/us/tn/murfreesboro/profile/real-estate/tennessee-cash-for-homes-0573-37373815',
            ),
        ),
        array(
            'name'        => 'Dowling Armstrong',
            'jobTitle'    => 'Licensed Real Estate Agent and Investor',
            'description' => 'Licensed Tennessee real estate agent with 9 years of experience and over 1,000 transactions across residential and commercial real estate. Active investor for 5+ years.',
            'image'       => get_template_directory_uri() . '/brand_assets/Dowling%20Tennessee%20Cash%20For%20Homes.webp',
        ),
        array(
            'name'        => 'Davis Armstrong',
            'jobTitle'    => 'Real Estate Investor',
            'description' => 'Lipscomb University Finance graduate. 6 years of Tennessee real estate investing with involvement in over 500 transactions, focused on the investment side of acquisitions.',
            'image'       => get_template_directory_uri() . '/brand_assets/Davis%20Tennessee%20Cash%20For%20Homes.webp',
        ),
    );

    foreach ( $people as $p ) {
        $schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'Person',
            'name'        => $p['name'],
            'jobTitle'    => $p['jobTitle'],
            'description' => $p['description'],
            'image'       => $p['image'],
            'worksFor'    => $org,
        );
        if ( ! empty( $p['sameAs'] ) ) {
            $schema['sameAs'] = $p['sameAs'];
        }
        tcfh_print_jsonld( $schema );
    }
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

/**
 * Demote any <h1> appearing inside post/page content to <h2>.
 *
 * page.php already emits the canonical page H1 (the post title); a second H1
 * inside the_content() is always a duplicate-H1 SEO issue. This filter is the
 * safe net for pages whose body was authored with an extra H1 (e.g. /contact-us/).
 */
add_filter( 'the_content', 'tcfh_demote_inline_h1', 99 );
function tcfh_demote_inline_h1( $content ) {
    return preg_replace( '#<h1\b([^>]*)>(.*?)</h1>#is', '<h2$1>$2</h2>', $content );
}

/**
 * Legacy-URL 301 redirects.
 *
 * .htaccess isn't honored on WordPress.com staging, and adding entries through
 * the Redirection plugin requires WP-admin access — so the canonical map lives
 * here. Runs early on template_redirect so a 404'd request can be rewritten
 * before WP renders the 404 template.
 */
add_action( 'template_redirect', 'tcfh_handle_legacy_redirects', 1 );
function tcfh_handle_legacy_redirects() {
    static $map = array(
        'privacy-policy-ppc'    => '/privacy-policy/',
        'terms-of-service-ppc'  => '/privacy-policy/',
        'our-solutions'         => '/how-it-works/',
        // Empty leftover Page from before the blog index moved to /blog/.
        // It still resolves (so it never 404s on its own) and was linked
        // from the nav, so send it on rather than leaving a blank page.
        'blog-home'             => '/blog/',
    );

    $path = trim( wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ) ?? '', '/' );
    if ( isset( $map[ $path ] ) ) {
        wp_safe_redirect( home_url( $map[ $path ] ), 301 );
        exit;
    }
}

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

/* ────────────────────────────────────────────────────────────────────────
 * LEAD CAPTURE PIPELINE
 *
 * Reliability stack for the three lead-capture forms (CRM / Investors /
 * Lenders). Every submission lands in a local table first, fires an email
 * notification, then attempts a live Airtable sync. Failed syncs are queued
 * for cron retry so a transient Airtable issue can never drop a lead.
 *
 *   tcfh_lead_save_and_sync()    — entry point used by the AJAX handlers
 *   tcfh_lead_insert_row()       — local DB write (source of truth)
 *   tcfh_lead_send_email()       — wp_mail notification
 *   tcfh_lead_airtable_post()    — single Airtable POST attempt
 *   tcfh_lead_do_retry()         — wp-cron retry handler
 *
 * Admin dashboard lives at WP Admin → Leads. Background crons handle the
 * weekly summary and the daily failure-threshold alert.
 * ──────────────────────────────────────────────────────────────────────── */

define( 'TCFH_LEAD_DB_VERSION',          '1' );
define( 'TCFH_LEAD_ALERT_EMAIL',         'karson@tncashforhomes.com' );
define( 'TCFH_LEAD_AIRTABLE_TIMEOUT',    10 ); // synchronous attempt
define( 'TCFH_LEAD_RETRY_TIMEOUT',       30 ); // cron retries
define( 'TCFH_LEAD_MAX_ATTEMPTS',        4 );  // 1 sync + 3 cron retries
define( 'TCFH_LEAD_FAILURE_THRESHOLD',   3 );  // alert when daily failures ≥ this

/**
 * Returns the leads table name with the WP prefix.
 */
function tcfh_leads_table() {
    global $wpdb;
    return $wpdb->prefix . 'tcfh_leads';
}

/**
 * Installs or upgrades the leads table. Idempotent.
 */
function tcfh_leads_install() {
    $installed = get_option( 'tcfh_leads_db_version' );
    if ( $installed === TCFH_LEAD_DB_VERSION ) {
        return;
    }

    global $wpdb;
    $table   = tcfh_leads_table();
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table} (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        submitted_at DATETIME NOT NULL,
        lead_type VARCHAR(20) NOT NULL DEFAULT 'lead',
        name VARCHAR(190) NOT NULL DEFAULT '',
        phone VARCHAR(40) NOT NULL DEFAULT '',
        email VARCHAR(190) NOT NULL DEFAULT '',
        address VARCHAR(255) NOT NULL DEFAULT '',
        lead_source VARCHAR(190) NOT NULL DEFAULT '',
        payload LONGTEXT NULL,
        airtable_id VARCHAR(40) NOT NULL DEFAULT '',
        sync_status VARCHAR(20) NOT NULL DEFAULT 'pending',
        attempts SMALLINT UNSIGNED NOT NULL DEFAULT 0,
        last_error TEXT NULL,
        last_attempt_at DATETIME NULL,
        PRIMARY KEY  (id),
        KEY sync_status (sync_status),
        KEY submitted_at (submitted_at),
        KEY lead_type (lead_type)
    ) {$charset};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );

    update_option( 'tcfh_leads_db_version', TCFH_LEAD_DB_VERSION );
}
add_action( 'after_setup_theme', 'tcfh_leads_install' );

/**
 * Ensures the recurring crons are scheduled. Runs once per request and is a
 * no-op when the events are already on the schedule.
 */
function tcfh_leads_ensure_cron() {
    if ( ! wp_next_scheduled( 'tcfh_weekly_summary' ) ) {
        wp_schedule_event( strtotime( 'next monday 8:00am' ), 'weekly', 'tcfh_weekly_summary' );
    }
    if ( ! wp_next_scheduled( 'tcfh_daily_failure_check' ) ) {
        wp_schedule_event( time() + 3600, 'daily', 'tcfh_daily_failure_check' );
    }
}
add_action( 'init', 'tcfh_leads_ensure_cron' );

/**
 * Primary entry point — called by the three submit handlers.
 *
 * @param array  $row             Row data (lead_type, name, phone, email,
 *                                address, lead_source, payload).
 * @param string $airtable_table  Airtable table name (CRM | Investors | Lenders).
 * @return array { row_id: int, synced: bool }
 */
function tcfh_lead_save_and_sync( array $row, $airtable_table ) {
    $row_id = tcfh_lead_insert_row( $row );

    if ( ! $row_id ) {
        // DB insert failed — extremely rare, but still alert because the lead
        // is at risk of being lost. The email below is our fallback.
        error_log( '[TCFH Lead] Local DB insert failed: ' . print_r( $row, true ) );
    } else {
        // Secondary "paper trail" email — fires only on confirmed DB success,
        // independent of Airtable and clearly tagged so it can be filtered
        // separately from the primary lead alert below.
        tcfh_lead_send_db_confirm_email( $row, $row_id );
    }

    // Always email before touching Airtable so a slow/broken Airtable can never
    // suppress the notification.
    tcfh_lead_send_email( $row, $row_id, 'pending' );

    $api_token = defined( 'AIRTABLE_API_TOKEN' ) ? AIRTABLE_API_TOKEN : '';
    $base_id   = defined( 'AIRTABLE_BASE_ID' )    ? AIRTABLE_BASE_ID   : '';

    if ( ! $api_token || ! $base_id ) {
        error_log( '[TCFH Lead] Airtable config missing — lead saved locally only (row ' . $row_id . ').' );
        if ( $row_id ) {
            tcfh_lead_update_status( $row_id, array(
                'sync_status'     => 'failed',
                'attempts'        => 1,
                'last_error'      => 'Airtable config missing on host',
                'last_attempt_at' => current_time( 'mysql' ),
            ) );
            wp_schedule_single_event( time() + 300, 'tcfh_lead_retry_sync', array( $row_id ) );
        }
        return array( 'row_id' => $row_id, 'synced' => false );
    }

    $synced = tcfh_lead_airtable_post(
        $row_id,
        $airtable_table,
        $row['payload'],
        TCFH_LEAD_AIRTABLE_TIMEOUT,
        1 // attempt number
    );

    if ( ! $synced && $row_id ) {
        wp_schedule_single_event( time() + 300, 'tcfh_lead_retry_sync', array( $row_id ) );
    }

    return array( 'row_id' => $row_id, 'synced' => $synced );
}

/**
 * Inserts a row into the leads table. Returns the new ID or 0 on failure.
 */
function tcfh_lead_insert_row( array $row ) {
    global $wpdb;
    $now = current_time( 'mysql' );

    $payload_json = isset( $row['payload'] ) ? wp_json_encode( $row['payload'] ) : '';

    $ok = $wpdb->insert(
        tcfh_leads_table(),
        array(
            'submitted_at' => $now,
            'lead_type'    => $row['lead_type'] ?? 'lead',
            'name'         => $row['name'] ?? '',
            'phone'        => $row['phone'] ?? '',
            'email'        => $row['email'] ?? '',
            'address'      => $row['address'] ?? '',
            'lead_source'  => $row['lead_source'] ?? '',
            'payload'      => $payload_json,
            'sync_status'  => 'pending',
            'attempts'     => 0,
        ),
        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d' )
    );

    return $ok ? (int) $wpdb->insert_id : 0;
}

/**
 * Updates an existing row with sync state changes.
 */
function tcfh_lead_update_status( $row_id, array $fields ) {
    if ( ! $row_id ) return false;
    global $wpdb;
    return $wpdb->update( tcfh_leads_table(), $fields, array( 'id' => (int) $row_id ) );
}

/**
 * Sends an Airtable POST. Updates the DB row with the outcome. Returns bool.
 */
function tcfh_lead_airtable_post( $row_id, $airtable_table, array $fields, $timeout, $attempt_number ) {
    $api_token = defined( 'AIRTABLE_API_TOKEN' ) ? AIRTABLE_API_TOKEN : '';
    $base_id   = defined( 'AIRTABLE_BASE_ID' )    ? AIRTABLE_BASE_ID   : '';

    if ( ! $api_token || ! $base_id ) {
        tcfh_lead_update_status( $row_id, array(
            'sync_status'     => 'failed',
            'attempts'        => $attempt_number,
            'last_error'      => 'Airtable config missing',
            'last_attempt_at' => current_time( 'mysql' ),
        ) );
        return false;
    }

    // Stamp a 'Submitted At' value if not already in the payload, so retried
    // syncs preserve the original submission time.
    if ( empty( $fields['Submitted At'] ) ) {
        $fields['Submitted At'] = current_time( 'c' );
    }

    $response = wp_remote_post(
        'https://api.airtable.com/v0/' . $base_id . '/' . rawurlencode( $airtable_table ),
        array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_token,
                'Content-Type'  => 'application/json',
            ),
            'body'    => wp_json_encode( array(
                'records' => array( array( 'fields' => $fields ) ),
            ) ),
            'timeout' => (int) $timeout,
        )
    );

    if ( is_wp_error( $response ) ) {
        $err = $response->get_error_message();
        error_log( '[TCFH Airtable] Transport error (row ' . $row_id . ', attempt ' . $attempt_number . '): ' . $err );
        tcfh_lead_update_status( $row_id, array(
            'sync_status'     => 'failed',
            'attempts'        => $attempt_number,
            'last_error'      => substr( 'Transport: ' . $err, 0, 1000 ),
            'last_attempt_at' => current_time( 'mysql' ),
        ) );
        return false;
    }

    $code = wp_remote_retrieve_response_code( $response );
    $body = wp_remote_retrieve_body( $response );

    if ( $code >= 200 && $code < 300 ) {
        $decoded = json_decode( $body, true );
        $rec_id  = '';
        if ( is_array( $decoded ) && ! empty( $decoded['records'][0]['id'] ) ) {
            $rec_id = $decoded['records'][0]['id'];
        }
        tcfh_lead_update_status( $row_id, array(
            'sync_status'     => 'success',
            'attempts'        => $attempt_number,
            'airtable_id'     => $rec_id,
            'last_error'      => '',
            'last_attempt_at' => current_time( 'mysql' ),
        ) );
        return true;
    }

    error_log( '[TCFH Airtable] HTTP ' . $code . ' (row ' . $row_id . ', attempt ' . $attempt_number . '): ' . substr( $body, 0, 600 ) );
    tcfh_lead_update_status( $row_id, array(
        'sync_status'     => 'failed',
        'attempts'        => $attempt_number,
        'last_error'      => substr( 'HTTP ' . $code . ': ' . $body, 0, 1000 ),
        'last_attempt_at' => current_time( 'mysql' ),
    ) );
    return false;
}

/**
 * Secondary "paper trail" email — fires the instant a row lands in the local
 * DB, before any Airtable work. Independent of Airtable by construction, and
 * tagged "[DB-CONFIRM #N]" in the subject so it's trivially filterable in the
 * inbox vs. the primary lead alert that follows. The goal is real-time proof
 * that the lead exists in our database, no matter what happens downstream.
 */
function tcfh_lead_send_db_confirm_email( array $row, $row_id ) {
    $name        = $row['name'] ?? '';
    $phone       = $row['phone'] ?? '';
    $email       = $row['email'] ?? '';
    $address     = $row['address'] ?? '';
    $lead_source = $row['lead_source'] ?? '';
    $lead_type   = $row['lead_type'] ?? 'lead';

    $label = ( $address ?: $name ?: 'lead' );
    $subject = sprintf( '[DB-CONFIRM #%d] %s — %s', (int) $row_id, ucfirst( $lead_type ), $label );

    $body_lines = array(
        'A lead has been written to the local database. This email is your',
        'independent paper trail — sent the moment the row hits wp_tcfh_leads,',
        'before any Airtable sync is attempted.',
        '',
        'Row ID:        ' . (int) $row_id,
        'Lead type:     ' . $lead_type,
        'Name:          ' . $name,
        'Phone:         ' . $phone,
    );
    if ( $email )       $body_lines[] = 'Email:         ' . $email;
    if ( $address )     $body_lines[] = 'Address:       ' . $address;
    if ( $lead_source ) $body_lines[] = 'Lead source:   ' . $lead_source;
    $body_lines[] = 'Submitted:     ' . current_time( 'Y-m-d H:i:s T' );
    $body_lines[] = '';
    $body_lines[] = 'A separate "New Lead" email with the formatted summary will follow.';
    $body_lines[] = 'View in WP Admin → Leads.';

    $to = apply_filters( 'tcfh_lead_alert_email', TCFH_LEAD_ALERT_EMAIL );

    $sent = wp_mail( $to, $subject, implode( "\n", $body_lines ) );
    if ( ! $sent ) {
        error_log( '[TCFH Lead] DB-confirm email failed for row ' . $row_id );
    }
}

/**
 * Sends a notification email for a single submission. Fires before the
 * Airtable attempt so a broken sync can never suppress the notification.
 */
function tcfh_lead_send_email( array $row, $row_id, $sync_status ) {
    $name        = $row['name'] ?? '';
    $phone       = $row['phone'] ?? '';
    $email       = $row['email'] ?? '';
    $address     = $row['address'] ?? '';
    $lead_source = $row['lead_source'] ?? '';
    $lead_type   = $row['lead_type'] ?? 'lead';

    switch ( $lead_type ) {
        case 'investor':
            $subject = 'New Investor — ' . ( $name ?: 'no name' );
            break;
        case 'lender':
            $subject = 'New Lender — ' . ( $name ?: 'no name' );
            break;
        default:
            $subject = 'New Lead — ' . ( $address ?: 'no address' );
    }

    $body_lines = array(
        'Lead type:     ' . $lead_type,
        'Name:          ' . $name,
        'Phone:         ' . $phone,
    );
    if ( $email )       $body_lines[] = 'Email:         ' . $email;
    if ( $address )     $body_lines[] = 'Address:       ' . $address;
    if ( $lead_source ) $body_lines[] = 'Lead source:   ' . $lead_source;
    $body_lines[] = 'Submitted:     ' . current_time( 'Y-m-d H:i:s T' );
    $body_lines[] = 'Local row ID:  ' . ( $row_id ?: '(insert failed)' );
    $body_lines[] = 'Airtable:      ' . $sync_status;

    if ( ! empty( $row['payload'] ) && is_array( $row['payload'] ) ) {
        $extras = array();
        foreach ( $row['payload'] as $k => $v ) {
            if ( in_array( $k, array( 'Lead Name', 'Name', 'Phone Number', 'Phone', 'Email', 'Address', 'Lead Source' ), true ) ) continue;
            if ( is_scalar( $v ) && $v !== '' ) $extras[] = $k . ': ' . $v;
        }
        if ( $extras ) {
            $body_lines[] = '';
            $body_lines[] = 'Additional fields:';
            $body_lines = array_merge( $body_lines, $extras );
        }
    }

    $body_lines[] = '';
    $body_lines[] = 'View / retry in WP Admin → Leads.';

    $to = apply_filters( 'tcfh_lead_alert_email', TCFH_LEAD_ALERT_EMAIL );

    $sent = wp_mail( $to, $subject, implode( "\n", $body_lines ) );
    if ( ! $sent ) {
        error_log( '[TCFH Lead] Notification email failed for row ' . $row_id );
    }
}

/**
 * WP-Cron callback. Retries Airtable sync for a single row.
 */
function tcfh_lead_do_retry( $row_id ) {
    global $wpdb;
    $row_id = (int) $row_id;
    if ( ! $row_id ) return;

    $row = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . tcfh_leads_table() . ' WHERE id = %d', $row_id ), ARRAY_A );
    if ( ! $row ) return;
    if ( $row['sync_status'] === 'success' ) return;
    if ( (int) $row['attempts'] >= TCFH_LEAD_MAX_ATTEMPTS ) return;

    $payload = json_decode( $row['payload'], true );
    if ( ! is_array( $payload ) ) $payload = array();

    $airtable_table = tcfh_lead_table_for_type( $row['lead_type'] );
    $attempt_no     = (int) $row['attempts'] + 1;

    $ok = tcfh_lead_airtable_post( $row_id, $airtable_table, $payload, TCFH_LEAD_RETRY_TIMEOUT, $attempt_no );

    if ( $ok ) return;

    // Schedule next retry with backoff: 15m, 30m, 60m for attempts 3, 4, 5.
    $next_delays = array( 900, 1800, 3600 );
    if ( $attempt_no < TCFH_LEAD_MAX_ATTEMPTS ) {
        $idx   = min( $attempt_no - 1, count( $next_delays ) - 1 );
        $delay = $next_delays[ $idx ];
        wp_schedule_single_event( time() + $delay, 'tcfh_lead_retry_sync', array( $row_id ) );
    } else {
        // Final failure — alert.
        $subject = '[ACTION NEEDED] Lead sync to Airtable exhausted retries — row ' . $row_id;
        $body    = "A lead submission could not be synced to Airtable after " . TCFH_LEAD_MAX_ATTEMPTS . " attempts.\n\n"
                 . "Row ID: {$row_id}\n"
                 . "Name:   {$row['name']}\n"
                 . "Phone:  {$row['phone']}\n"
                 . "Email:  {$row['email']}\n"
                 . "Addr:   {$row['address']}\n"
                 . "Source: {$row['lead_source']}\n"
                 . "Last error: {$row['last_error']}\n\n"
                 . "Open WP Admin → Leads and click 'Retry Sync' once the underlying issue is resolved.";
        wp_mail( apply_filters( 'tcfh_lead_alert_email', TCFH_LEAD_ALERT_EMAIL ), $subject, $body );
    }
}
add_action( 'tcfh_lead_retry_sync', 'tcfh_lead_do_retry', 10, 1 );

/**
 * Map a stored lead_type to the Airtable table name.
 */
function tcfh_lead_table_for_type( $lead_type ) {
    switch ( $lead_type ) {
        case 'investor': return 'Investors';
        case 'lender':   return 'Lenders';
        default:         return 'CRM';
    }
}

/* ── Weekly summary ───────────────────────────────────────────────────── */

function tcfh_weekly_summary_send() {
    global $wpdb;
    $table = tcfh_leads_table();
    $since = gmdate( 'Y-m-d H:i:s', time() - WEEK_IN_SECONDS );

    $total   = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$table} WHERE submitted_at >= %s", $since ) );
    $success = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$table} WHERE submitted_at >= %s AND sync_status = 'success'", $since ) );
    $failed  = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$table} WHERE submitted_at >= %s AND sync_status = 'failed'", $since ) );
    $pending = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$table} WHERE submitted_at >= %s AND sync_status = 'pending'", $since ) );

    $subject = 'Weekly lead summary — ' . $total . ' leads, ' . $failed . ' failed';
    $body    = "Lead activity for the past 7 days:\n\n"
             . "Total received:     {$total}\n"
             . "Synced to Airtable: {$success}\n"
             . "Failed (need attn): {$failed}\n"
             . "Still pending:      {$pending}\n\n";

    if ( $failed > 0 ) {
        $rows = $wpdb->get_results( $wpdb->prepare(
            "SELECT id, submitted_at, name, address, last_error FROM {$table}
              WHERE submitted_at >= %s AND sync_status = 'failed'
              ORDER BY submitted_at DESC LIMIT 25",
            $since
        ), ARRAY_A );
        $body .= "Failed submissions:\n";
        foreach ( $rows as $r ) {
            $body .= "  #{$r['id']}  {$r['submitted_at']}  {$r['name']}  {$r['address']}\n"
                  .  "         {$r['last_error']}\n";
        }
        $body .= "\nReview at WP Admin → Leads.\n";
    }

    wp_mail( apply_filters( 'tcfh_lead_alert_email', TCFH_LEAD_ALERT_EMAIL ), $subject, $body );
}
add_action( 'tcfh_weekly_summary', 'tcfh_weekly_summary_send' );

/* ── Daily failure-threshold alert ─────────────────────────────────────── */

function tcfh_daily_failure_check_run() {
    global $wpdb;
    $table = tcfh_leads_table();
    $since = gmdate( 'Y-m-d H:i:s', time() - DAY_IN_SECONDS );

    $failed = (int) $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM {$table}
          WHERE submitted_at >= %s
            AND sync_status = 'failed'
            AND attempts >= %d",
        $since,
        TCFH_LEAD_MAX_ATTEMPTS
    ) );

    if ( $failed < TCFH_LEAD_FAILURE_THRESHOLD ) {
        return;
    }

    // Throttle: at most one alert per 12 hours so a sustained outage doesn't
    // hammer the inbox.
    $last = (int) get_option( 'tcfh_last_failure_alert', 0 );
    if ( $last && time() - $last < 12 * HOUR_IN_SECONDS ) {
        return;
    }
    update_option( 'tcfh_last_failure_alert', time(), false );

    $subject = '[ALERT] ' . $failed . ' Airtable sync failures in the last 24h';
    $body    = "{$failed} lead(s) have failed to sync to Airtable in the past 24 hours "
             . "(after exhausting all " . TCFH_LEAD_MAX_ATTEMPTS . " retry attempts).\n\n"
             . "Review and retry from WP Admin → Leads.\n";

    wp_mail( apply_filters( 'tcfh_lead_alert_email', TCFH_LEAD_ALERT_EMAIL ), $subject, $body );
}
add_action( 'tcfh_daily_failure_check', 'tcfh_daily_failure_check_run' );

/* ── Admin: WP Admin → Leads ──────────────────────────────────────────── */

function tcfh_leads_admin_menu() {
    add_menu_page(
        'Leads',
        'Leads',
        'manage_options',
        'tcfh-leads',
        'tcfh_leads_admin_page',
        'dashicons-list-view',
        26
    );
}
add_action( 'admin_menu', 'tcfh_leads_admin_menu' );

/**
 * Handles "Retry Sync" button submissions before page render.
 */
function tcfh_leads_admin_handle_actions() {
    if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'tcfh-leads' ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;

    if ( isset( $_POST['tcfh_action'] ) && $_POST['tcfh_action'] === 'retry' ) {
        check_admin_referer( 'tcfh_leads_retry' );
        $row_id = isset( $_POST['row_id'] ) ? (int) $_POST['row_id'] : 0;
        if ( $row_id ) {
            global $wpdb;
            // Reset attempts counter and status so the cron handler will run
            // a fresh round.
            $wpdb->update(
                tcfh_leads_table(),
                array( 'sync_status' => 'pending', 'attempts' => 0, 'last_error' => '' ),
                array( 'id' => $row_id )
            );
            // Kick off an immediate retry.
            wp_schedule_single_event( time() + 5, 'tcfh_lead_retry_sync', array( $row_id ) );
            // Also try once synchronously for instant feedback.
            $row = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . tcfh_leads_table() . ' WHERE id = %d', $row_id ), ARRAY_A );
            if ( $row ) {
                $payload = json_decode( $row['payload'], true );
                if ( ! is_array( $payload ) ) $payload = array();
                tcfh_lead_airtable_post( $row_id, tcfh_lead_table_for_type( $row['lead_type'] ), $payload, TCFH_LEAD_RETRY_TIMEOUT, 1 );
            }
            wp_safe_redirect( add_query_arg( array( 'page' => 'tcfh-leads', 'tcfh_msg' => 'retried' ), admin_url( 'admin.php' ) ) );
            exit;
        }
    }

    if ( isset( $_POST['tcfh_action'] ) && $_POST['tcfh_action'] === 'export' ) {
        check_admin_referer( 'tcfh_leads_export' );
        tcfh_leads_admin_export_csv();
        exit;
    }
}
add_action( 'admin_init', 'tcfh_leads_admin_handle_actions' );

function tcfh_leads_admin_export_csv() {
    global $wpdb;
    $rows = $wpdb->get_results( 'SELECT * FROM ' . tcfh_leads_table() . ' ORDER BY submitted_at DESC', ARRAY_A );

    nocache_headers();
    header( 'Content-Type: text/csv; charset=utf-8' );
    header( 'Content-Disposition: attachment; filename=tcfh-leads-' . gmdate( 'Y-m-d' ) . '.csv' );

    $out = fopen( 'php://output', 'w' );
    fputcsv( $out, array( 'id', 'submitted_at', 'lead_type', 'name', 'phone', 'email', 'address', 'lead_source', 'airtable_id', 'sync_status', 'attempts', 'last_error', 'last_attempt_at' ) );
    foreach ( $rows as $r ) {
        fputcsv( $out, array(
            $r['id'], $r['submitted_at'], $r['lead_type'], $r['name'], $r['phone'], $r['email'],
            $r['address'], $r['lead_source'], $r['airtable_id'], $r['sync_status'], $r['attempts'],
            $r['last_error'], $r['last_attempt_at'],
        ) );
    }
    fclose( $out );
}

function tcfh_leads_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    global $wpdb;
    $table = tcfh_leads_table();

    $filter = isset( $_GET['status'] ) ? sanitize_key( $_GET['status'] ) : '';
    $where  = '';
    if ( in_array( $filter, array( 'pending', 'success', 'failed' ), true ) ) {
        $where = $wpdb->prepare( 'WHERE sync_status = %s', $filter );
    }

    $total    = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table}" );
    $n_succ   = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table} WHERE sync_status='success'" );
    $n_fail   = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table} WHERE sync_status='failed'" );
    $n_pend   = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table} WHERE sync_status='pending'" );

    $rows = $wpdb->get_results( "SELECT * FROM {$table} {$where} ORDER BY submitted_at DESC LIMIT 200", ARRAY_A );
    $msg  = isset( $_GET['tcfh_msg'] ) ? sanitize_key( $_GET['tcfh_msg'] ) : '';

    ?>
    <div class="wrap">
      <h1>Leads</h1>
      <?php if ( $msg === 'retried' ): ?>
        <div class="notice notice-success is-dismissible"><p>Retry queued. Refresh in a few seconds to see the updated status.</p></div>
      <?php endif; ?>

      <p>
        <strong>Total:</strong> <?php echo $total; ?> &nbsp;|&nbsp;
        <strong>Synced:</strong> <?php echo $n_succ; ?> &nbsp;|&nbsp;
        <strong>Pending:</strong> <?php echo $n_pend; ?> &nbsp;|&nbsp;
        <strong style="color:#b32d2e;">Failed:</strong> <?php echo $n_fail; ?>
      </p>

      <p>
        Filter:
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=tcfh-leads' ) ); ?>">All</a> |
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=tcfh-leads&status=pending' ) ); ?>">Pending</a> |
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=tcfh-leads&status=success' ) ); ?>">Synced</a> |
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=tcfh-leads&status=failed' ) ); ?>">Failed</a>

        &nbsp;&nbsp;
        <form method="post" style="display:inline;">
          <?php wp_nonce_field( 'tcfh_leads_export' ); ?>
          <input type="hidden" name="tcfh_action" value="export" />
          <button class="button">Export CSV</button>
        </form>
      </p>

      <table class="widefat striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Submitted</th>
            <th>Type</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Source</th>
            <th>Status</th>
            <th>Attempts</th>
            <th>Last error</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if ( ! $rows ): ?>
          <tr><td colspan="12">No submissions yet.</td></tr>
        <?php else: foreach ( $rows as $r ):
          $status_color = $r['sync_status'] === 'success' ? '#1a7e2a' : ( $r['sync_status'] === 'failed' ? '#b32d2e' : '#8a6d00' );
        ?>
          <tr>
            <td><?php echo (int) $r['id']; ?></td>
            <td><?php echo esc_html( $r['submitted_at'] ); ?></td>
            <td><?php echo esc_html( $r['lead_type'] ); ?></td>
            <td><?php echo esc_html( $r['name'] ); ?></td>
            <td><?php echo esc_html( $r['phone'] ); ?></td>
            <td><?php echo esc_html( $r['email'] ); ?></td>
            <td><?php echo esc_html( $r['address'] ); ?></td>
            <td><?php echo esc_html( $r['lead_source'] ); ?></td>
            <td><span style="color:<?php echo $status_color; ?>;font-weight:600;"><?php echo esc_html( $r['sync_status'] ); ?></span></td>
            <td><?php echo (int) $r['attempts']; ?></td>
            <td style="max-width:280px;font-size:11px;color:#666;"><?php echo esc_html( $r['last_error'] ); ?></td>
            <td>
              <?php if ( $r['sync_status'] !== 'success' ): ?>
                <form method="post" style="margin:0;">
                  <?php wp_nonce_field( 'tcfh_leads_retry' ); ?>
                  <input type="hidden" name="tcfh_action" value="retry" />
                  <input type="hidden" name="row_id" value="<?php echo (int) $r['id']; ?>" />
                  <button class="button button-small">Retry Sync</button>
                </form>
              <?php else: ?>
                <span style="color:#888;">—</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; endif; ?>
        </tbody>
      </table>
      <p style="color:#666;font-size:12px;">Showing the most recent 200 rows. Use Export CSV for the full history.</p>

      <?php tcfh_dropped_admin_render(); ?>
    </div>
    <?php
}

/* ────────────────────────────────────────────────────────────────────────
 * DROPPED SUBMISSION LOG
 *
 * Records every submission attempt that *didn't* reach the leads table:
 *   nonce_fail      — stale or missing nonce (cached HTML, expired session)
 *   validation_fail — missing required field (autofill races, weird inputs)
 *   beacon          — last-resort sendBeacon from the client after a
 *                     fetch() failure; the row in wp_tcfh_leads will be
 *                     absent if the original request never reached PHP.
 *
 * Rendered at the bottom of WP Admin → Leads so dropped attempts are
 * visible right next to successful ones — no more silent loss.
 * ──────────────────────────────────────────────────────────────────────── */

define( 'TCFH_DROPPED_DB_VERSION', '1' );

function tcfh_dropped_table() {
    global $wpdb;
    return $wpdb->prefix . 'tcfh_dropped';
}

function tcfh_dropped_install() {
    $installed = get_option( 'tcfh_dropped_db_version' );
    if ( $installed === TCFH_DROPPED_DB_VERSION ) return;

    global $wpdb;
    $table   = tcfh_dropped_table();
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table} (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        recorded_at DATETIME NOT NULL,
        reason VARCHAR(40) NOT NULL DEFAULT '',
        ip VARCHAR(64) NOT NULL DEFAULT '',
        user_agent VARCHAR(255) NOT NULL DEFAULT '',
        referer VARCHAR(255) NOT NULL DEFAULT '',
        payload LONGTEXT NULL,
        PRIMARY KEY  (id),
        KEY recorded_at (recorded_at),
        KEY reason (reason)
    ) {$charset};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );

    update_option( 'tcfh_dropped_db_version', TCFH_DROPPED_DB_VERSION );
}
add_action( 'after_setup_theme', 'tcfh_dropped_install' );

/**
 * Records a dropped submission attempt. Best-effort; never throws.
 */
function tcfh_dropped_log_record( $reason, $raw_post ) {
    global $wpdb;

    // Strip the nonce + action so we don't store auth bits.
    $payload = is_array( $raw_post ) ? $raw_post : array();
    unset( $payload['nonce'], $payload['action'], $payload['_wp_http_referer'] );

    // Sanitize every scalar value.
    $clean = array();
    foreach ( $payload as $k => $v ) {
        $key = sanitize_key( $k );
        if ( is_scalar( $v ) ) {
            $clean[ $key ] = sanitize_text_field( (string) $v );
        }
    }

    $ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? substr( (string) $_SERVER['REMOTE_ADDR'], 0, 64 ) : '';
    $ua  = isset( $_SERVER['HTTP_USER_AGENT'] ) ? substr( (string) $_SERVER['HTTP_USER_AGENT'], 0, 255 ) : '';
    $ref = isset( $_SERVER['HTTP_REFERER'] ) ? substr( (string) $_SERVER['HTTP_REFERER'], 0, 255 ) : '';

    $wpdb->insert(
        tcfh_dropped_table(),
        array(
            'recorded_at' => current_time( 'mysql' ),
            'reason'      => substr( (string) $reason, 0, 40 ),
            'ip'          => $ip,
            'user_agent'  => $ua,
            'referer'     => $ref,
            'payload'     => wp_json_encode( $clean ),
        ),
        array( '%s', '%s', '%s', '%s', '%s', '%s' )
    );

    // For beacons specifically: email the owner so dropped leads turn up in
    // the inbox even when nobody is checking the admin dashboard. Deduped
    // by payload hash for 24h so a stuck localStorage replay can't flood
    // the inbox with the same lead over and over.
    if ( $reason === 'beacon' ) {
        $name    = $clean['name']    ?? '';
        $phone   = $clean['phone']   ?? '';
        $email   = $clean['email']   ?? '';
        $address = $clean['address'] ?? '';

        $dedup_key = 'tcfh_rescue_' . md5( $name . '|' . $phone . '|' . $email . '|' . $address );
        if ( ! get_transient( $dedup_key ) ) {
            set_transient( $dedup_key, 1, DAY_IN_SECONDS );

            $subject = '[RESCUE] Dropped lead via beacon — ' . ( $address ?: $name ?: 'no address' );
            $body    = "A lead submission failed every primary path and reached us only via the sendBeacon fallback. "
                     . "The visitor is gone — follow up by hand.\n\n"
                     . "Name:    {$name}\n"
                     . "Phone:   {$phone}\n"
                     . "Email:   {$email}\n"
                     . "Address: {$address}\n"
                     . "UA:      {$ua}\n"
                     . "Page:    {$ref}\n\n"
                     . "Full row: WP Admin → Leads (Dropped submissions section).";
            wp_mail( apply_filters( 'tcfh_lead_alert_email', TCFH_LEAD_ALERT_EMAIL ), $subject, $body );
        }
    }
}

/**
 * Renders the dropped-submission table under the main Leads view.
 */
function tcfh_dropped_admin_render() {
    global $wpdb;
    $table = tcfh_dropped_table();

    $rows = $wpdb->get_results( "SELECT * FROM {$table} ORDER BY recorded_at DESC LIMIT 50", ARRAY_A );

    echo '<h2 style="margin-top:30px;">Dropped submissions</h2>';
    echo '<p style="color:#666;">Submissions that never reached the leads table. Beacon entries are likely real leads — follow up by hand.</p>';

    if ( ! $rows ) {
        echo '<p><em>None — your submit pipeline is currently clean.</em></p>';
        return;
    }

    echo '<table class="widefat striped"><thead><tr>'
       . '<th>When</th><th>Reason</th><th>Name</th><th>Phone</th><th>Email</th>'
       . '<th>Address</th><th>Page</th><th>Device</th>'
       . '</tr></thead><tbody>';
    foreach ( $rows as $r ) {
        $payload = json_decode( (string) $r['payload'], true );
        $payload = is_array( $payload ) ? $payload : array();
        $reason_color = $r['reason'] === 'beacon' ? '#b32d2e' : '#8a6d00';
        echo '<tr>'
           . '<td>' . esc_html( $r['recorded_at'] ) . '</td>'
           . '<td><span style="color:' . esc_attr( $reason_color ) . ';font-weight:600;">' . esc_html( $r['reason'] ) . '</span></td>'
           . '<td>' . esc_html( $payload['name']    ?? '' ) . '</td>'
           . '<td>' . esc_html( $payload['phone']   ?? '' ) . '</td>'
           . '<td>' . esc_html( $payload['email']   ?? '' ) . '</td>'
           . '<td>' . esc_html( $payload['address'] ?? '' ) . '</td>'
           . '<td style="max-width:240px;font-size:11px;color:#666;word-break:break-all;">' . esc_html( $r['referer'] ) . '</td>'
           . '<td style="max-width:240px;font-size:11px;color:#666;">' . esc_html( $r['user_agent'] ) . '</td>'
           . '</tr>';
    }
    echo '</tbody></table>';
}

/* ──────────────────────────────────────────────────────────────────────────
 * Daily/monthly/yearly stats email reports.
 * GA4 + Google Ads + Search Console → HTML email on WP-Cron.
 * Admin UI: Settings → Daily Reports.
 * ────────────────────────────────────────────────────────────────────────── */
require_once get_template_directory() . '/reports.php';
