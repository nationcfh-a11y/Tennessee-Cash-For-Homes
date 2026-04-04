<?php
/**
 * Template Name: County — Polk County
 *
 * WordPress setup:
 *   Slug:     polk-county  (under county-pages/ parent)
 *   Template: County — Polk County
 */

$county = [
    'slug'          => 'polk-county',
    'name'          => 'Polk County',
    'county_id'     => 'polk',
    'h1'            => 'Sell Your House Fast For Cash in Polk County TN',
    'meta_title'    => 'We Buy Houses in Polk County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Polk County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '14',
    'avg_days'      => '94',
    'desc1'         => 'Polk County is a scenic Southeast Tennessee county along the Ocoee River, famous for hosting the 1996 Olympic whitewater events. Home to Benton and Copperhill, the county offers stunning mountain scenery and world class outdoor recreation. Tennessee Cash For Homes buys houses across all of Polk County fast and for cash.',
    'desc2'         => 'Whether you need to sell due to relocation, an inherited property, or financial hardship we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Polk County offers mountain land near the Cherokee National Forest and Ocoee River at affordable prices. Tennessee Cash For Homes buys Polk County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Benton', 'slug' => 'benton', 'has_page' => false],
        ['name' => 'Copperhill', 'slug' => 'copperhill', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
