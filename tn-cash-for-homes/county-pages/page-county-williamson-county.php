<?php
/**
 * Template Name: County — Williamson County
 *
 * WordPress setup:
 *   Slug:     williamson-county  (under county-pages/ parent)
 *   Template: County — Williamson County
 */

$county = [
    'slug'          => 'williamson-county',
    'name'          => 'Williamson County',
    'county_id'     => 'williamson',
    'h1'            => 'Sell Your House Fast For Cash in Williamson County',
    'meta_title'    => 'We Buy Houses in Williamson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Williamson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$819,000',
    'homes_sold'    => '94',
    'avg_days'      => '75',
    'desc1'         => 'Williamson County is one of the wealthiest and fastest growing counties in Tennessee. Home to Franklin, Brentwood, and Spring Hill, the county attracts homeowners from across the state. Tennessee Cash For Homes buys houses in any condition across all of Williamson County.',
    'desc2'         => 'Whether you need to sell quickly due to relocation, inheritance, or financial reasons we make the process simple and stress free. No repairs, no agent commissions, and we close on your schedule.',
    'land_para'     => 'Williamson County is one of Tennessee\'s most desirable areas for land development. As growth continues to stretch outward from Nashville landowners have a strong opportunity to sell. Tennessee Cash For Homes buys Williamson County land quickly with no commissions or hidden fees.',
    'cities'        => [
        ['name' => 'Franklin',    'slug' => 'franklin',    'has_page' => true],
        ['name' => 'Spring Hill', 'slug' => 'spring-hill', 'has_page' => true],
        ['name' => 'Brentwood',   'slug' => 'brentwood',   'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
