<?php
/**
 * Tennessee Cash For Homes — functions.php
 * Enqueues styles and scripts using WordPress best practices.
 */

function tcfh_enqueue_assets() {
    // Main stylesheet (style.css in theme root — also serves as WP theme header)
    wp_enqueue_style(
        'tcfh-style',
        get_stylesheet_uri(),
        array(),
        '2.0'
    );

    // Google Fonts — Poppins (added weight 800 for hero headline)
    wp_enqueue_style(
        'tcfh-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Pass the AJAX URL and nonce to JavaScript for form submission
    wp_enqueue_script( 'jquery' );
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
 * Receives form data from multi-step form and forwards to backend.
 */
function tcfh_handle_submit_lead() {
    check_ajax_referer( 'tcfh_submit_lead', 'nonce' );

    $name             = sanitize_text_field( $_POST['name'] ?? '' );
    $phone            = sanitize_text_field( $_POST['phone'] ?? '' );
    $email            = sanitize_email( $_POST['email'] ?? '' );
    $address          = sanitize_text_field( $_POST['address'] ?? '' );
    $property_type    = sanitize_text_field( $_POST['property_type'] ?? '' );
    $bedrooms         = sanitize_text_field( $_POST['bedrooms'] ?? '' );
    $bathrooms        = sanitize_text_field( $_POST['bathrooms'] ?? '' );
    $condition        = sanitize_text_field( $_POST['condition'] ?? '' );
    $roof_issue       = sanitize_text_field( $_POST['roof_issue'] ?? '' );
    $foundation_issue = sanitize_text_field( $_POST['foundation_issue'] ?? '' );
    $damage           = sanitize_text_field( $_POST['damage'] ?? '' );
    $situation        = sanitize_text_field( $_POST['situation'] ?? '' );
    $timeline         = sanitize_text_field( $_POST['timeline'] ?? '' );
    $hoa              = sanitize_text_field( $_POST['hoa'] ?? '' );
    $occupied         = sanitize_text_field( $_POST['occupied'] ?? '' );

    if ( ! $name || ! $phone || ! $address ) {
        wp_send_json_error( array( 'error' => 'Please fill in all required fields.' ), 422 );
    }

    // Send email notification
    $to      = get_option( 'admin_email' );
    $subject = 'New Cash Offer Request — ' . $name;
    $message = "=== New Lead from Multi-Step Form ===\n\n";
    $message .= "Name: $name\n";
    $message .= "Phone: $phone\n";
    $message .= "Email: $email\n";
    $message .= "Address: $address\n\n";
    $message .= "--- Property Details ---\n";
    $message .= "Property Type: $property_type\n";
    $message .= "Bedrooms: $bedrooms\n";
    $message .= "Bathrooms: $bathrooms\n\n";
    $message .= "--- Condition ---\n";
    $message .= "Condition: $condition\n";
    $message .= "Roof Issue: $roof_issue\n";
    $message .= "Foundation Issue: $foundation_issue\n";
    $message .= "Fire/Water Damage: $damage\n\n";
    $message .= "--- Situation ---\n";
    $message .= "Situation: $situation\n";
    $message .= "Timeline: $timeline\n";
    $message .= "HOA: $hoa\n";
    $message .= "Occupied: $occupied\n";

    wp_mail( $to, $subject, $message );

    wp_send_json_success( array( 'message' => 'Request received!' ) );
}
add_action( 'wp_ajax_tcfh_submit_lead',        'tcfh_handle_submit_lead' );
add_action( 'wp_ajax_nopriv_tcfh_submit_lead', 'tcfh_handle_submit_lead' );
