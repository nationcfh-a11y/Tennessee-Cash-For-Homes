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
 * Register templates in city_pages/ and county_pages/ subfolders so they
 * appear in the WordPress Page Attributes → Template dropdown.
 * WordPress only auto-discovers templates in the theme root, so we scan
 * each subfolder manually and inject them into the template list.
 */
function tcfh_register_subfolder_templates( $templates ) {
    $subdirs = array(
        'city_pages'   => 'page-location-*.php',
        'county_pages' => 'page-county-*.php',
    );

    foreach ( $subdirs as $subdir => $glob_pattern ) {
        $files = glob( get_template_directory() . '/' . $subdir . '/' . $glob_pattern );
        if ( empty( $files ) ) {
            continue;
        }
        foreach ( $files as $file ) {
            $headers = get_file_data( $file, array( 'Template Name' => 'Template Name' ) );
            if ( ! empty( $headers['Template Name'] ) ) {
                // Key is path relative to theme root — what WP stores in _wp_page_template.
                $templates[ $subdir . '/' . basename( $file ) ] = $headers['Template Name'];
            }
        }
    }

    return $templates;
}
add_filter( 'theme_page_templates', 'tcfh_register_subfolder_templates' );

/**
 * When a page uses a subfolder template, resolve the full path so WordPress
 * loads the correct file instead of falling back to page.php.
 */
function tcfh_load_subfolder_template( $template ) {
    if ( ! is_page() ) {
        return $template;
    }

    $chosen = get_post_meta( get_the_ID(), '_wp_page_template', true );

    if ( strpos( $chosen, 'city_pages/' ) === 0 || strpos( $chosen, 'county_pages/' ) === 0 ) {
        $file = get_template_directory() . '/' . $chosen;
        if ( file_exists( $file ) ) {
            return $file;
        }
    }

    return $template;
}
add_filter( 'template_include', 'tcfh_load_subfolder_template' );

/**
 * Register templates that live in city_pages/ and county_pages/ subfolders
 * so they appear in the WordPress Page Attributes → Template dropdown.
 *
 * WordPress only auto-discovers templates in the theme root, so we scan
 * each subfolder manually and inject them into the template list.
 */
function tcfh_register_subfolder_templates( $templates ) {
    $subdirs = array(
        'city_pages'   => 'page-location-*.php',
        'county_pages' => 'page-county-*.php',
    );

    foreach ( $subdirs as $subdir => $glob_pattern ) {
        $dir   = get_template_directory() . '/' . $subdir . '/';
        $files = glob( $dir . $glob_pattern );
        if ( empty( $files ) ) {
            continue;
        }
        foreach ( $files as $file ) {
            $headers = get_file_data( $file, array( 'Template Name' => 'Template Name' ) );
            if ( ! empty( $headers['Template Name'] ) ) {
                // Key is the path relative to the theme root — that's what WP stores in post meta.
                $templates[ $subdir . '/' . basename( $file ) ] = $headers['Template Name'];
            }
        }
    }

    return $templates;
}
add_filter( 'theme_page_templates', 'tcfh_register_subfolder_templates' );

/**
 * When a page uses a subfolder template, resolve the full path so WordPress
 * actually loads the right file instead of falling back to page.php.
 */
function tcfh_load_subfolder_template( $template ) {
    if ( ! is_page() ) {
        return $template;
    }

    $chosen = get_post_meta( get_the_ID(), '_wp_page_template', true );

    if ( strpos( $chosen, 'city_pages/' ) === 0 || strpos( $chosen, 'county_pages/' ) === 0 ) {
        $file = get_template_directory() . '/' . $chosen;
        if ( file_exists( $file ) ) {
            return $file;
        }
    }

    return $template;
}
add_filter( 'template_include', 'tcfh_load_subfolder_template' );
