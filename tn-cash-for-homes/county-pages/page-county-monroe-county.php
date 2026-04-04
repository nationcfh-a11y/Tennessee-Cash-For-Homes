<?php
/**
 * Template Name: County — Monroe County
 *
 * WordPress setup:
 *   Slug:     monroe-county  (under county-pages/ parent)
 *   Template: County — Monroe County
 */

$county = [
    'slug'          => 'monroe-county',
    'name'          => 'Monroe County',
    'county_id'     => 'monroe',
    'h1'            => 'Sell Your House Fast For Cash in Monroe County TN',
    'meta_title'    => 'We Buy Houses in Monroe County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Monroe County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '34',
    'avg_days'      => '86',
    'desc1'         => 'Monroe County is a scenic East Tennessee county home to Madisonville and Sweetwater. With access to Tellico Lake, the Cherokee National Forest, and the foothills of the Smoky Mountains, the county offers outstanding natural beauty. Tennessee Cash For Homes buys houses across all of Monroe County fast and for cash.',
    'desc2'         => 'Whether you need to sell due to relocation, inheritance, or financial reasons we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Monroe County offers lakefront land on Tellico Lake, mountain tracts near the Cherokee National Forest, and rural farmland. Tennessee Cash For Homes buys Monroe County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Madisonville', 'slug' => 'madisonville', 'has_page' => false],
        ['name' => 'Sweetwater', 'slug' => 'sweetwater', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
