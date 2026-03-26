<?php
/**
 * Template Name: County — DeKalb County
 *
 * WordPress setup:
 *   Slug:     dekalb-county  (under county-pages/ parent)
 *   Template: County — DeKalb County
 */

$county = [
    'slug'          => 'dekalb-county',
    'name'          => 'DeKalb County',
    'county_id'     => 'dekalb',
    'h1'            => 'Sell Your House Fast For Cash in DeKalb County TN',
    'meta_title'    => 'We Buy Houses in DeKalb County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in DeKalb County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$255,000',
    'homes_sold'    => '16',
    'avg_days'      => '89',
    'desc1'         => 'DeKalb County is home to Center Hill Lake and Smithville, offering beautiful waterfront living and a peaceful rural lifestyle in Middle Tennessee. Tennessee Cash For Homes buys houses across all of DeKalb County fast and for cash in any condition.',
    'desc2'         => 'Whether you are facing financial difficulties, dealing with an inherited property, or simply need to sell quickly we are here to help. No repairs needed, no agent fees, and we close on your timeline with a fair cash offer.',
    'land_para'     => 'DeKalb County offers exceptional waterfront and rural land around Center Hill Lake including residential lots and wooded tracts. Tennessee Cash For Homes buys DeKalb County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Smithville', 'slug' => 'smithville', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
