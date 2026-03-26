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

    // Pass the AJAX URL and nonce to JavaScript for form submission
    wp_localize_script( 'jquery', 'tcfh_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'tcfh_submit_lead' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'tcfh_enqueue_assets' );

/**
 * Output favicon link tags in <head>.
 */
add_action( 'wp_head', function() {
    echo '<link rel="icon" type="image/png" href="' . get_template_directory_uri() . '/brand_assets/Favicon.png" />' . "\n";
    echo '<link rel="shortcut icon" type="image/png" href="' . get_template_directory_uri() . '/brand_assets/Favicon.png" />' . "\n";
    echo '<link rel="apple-touch-icon" href="' . get_template_directory_uri() . '/brand_assets/Favicon.png" />' . "\n";
} );

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
 * AJAX handler for lead form submission.
 * Receives form data and forwards to your backend (Airtable, CRM, email, etc.).
 *
 * NOTE: Replace the logic inside with your actual integration.
 *       The Netlify function (/.netlify/functions/submit-lead) no longer exists
 *       in WordPress. This WP AJAX action takes its place.
 */
function tcfh_handle_submit_lead() {
    check_ajax_referer( 'tcfh_submit_lead', 'nonce' );

    $name      = sanitize_text_field( $_POST['name'] ?? '' );
    $phone     = sanitize_text_field( $_POST['phone'] ?? '' );
    $address   = sanitize_text_field( $_POST['address'] ?? '' );
    $condition = sanitize_text_field( $_POST['condition'] ?? '' );

    if ( ! $name || ! $phone || ! $address ) {
        wp_send_json_error( array( 'error' => 'Please fill in all required fields.' ), 422 );
    }

    // TODO: Replace this block with your real CRM/Airtable integration.
    // Example: send an email notification until you wire up the real backend.
    $to      = get_option( 'admin_email' );
    $subject = 'New Cash Offer Request: ' . $name;
    $message = "Name: $name\nPhone: $phone\nAddress: $address\nCondition: $condition";
    wp_mail( $to, $subject, $message );

    wp_send_json_success( array( 'message' => 'Request received!' ) );
}
add_action( 'wp_ajax_tcfh_submit_lead',        'tcfh_handle_submit_lead' );
add_action( 'wp_ajax_nopriv_tcfh_submit_lead', 'tcfh_handle_submit_lead' );

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
