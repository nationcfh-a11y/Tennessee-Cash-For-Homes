<?php
/**
 * Template Name: County — Marion County
 *
 * WordPress setup:
 *   Slug:     marion-county  (under county-pages/ parent)
 *   Template: County — Marion County
 */

$county = [
    'slug'          => 'marion-county',
    'name'          => 'Marion County',
    'county_id'     => 'marion',
    'h1'            => 'Sell Your House Fast For Cash in Marion County TN',
    'meta_title'    => 'We Buy Houses in Marion County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Marion County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '24',
    'avg_days'      => '88',
    'desc1'         => 'Marion County is a scenic Southeast Tennessee county home to Jasper and the dramatic gorges of the Tennessee River. Bordering Chattanooga to the south, the county offers stunning natural beauty, affordable housing, and access to Nickajack Lake. Tennessee Cash For Homes buys houses across all of Marion County fast and for cash.',
    'desc2'         => 'Whether you need to sell due to relocation, an inherited property, or financial challenges we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Marion County offers scenic river and mountain land including lakefront properties on Nickajack Lake. Tennessee Cash For Homes buys Marion County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Jasper', 'slug' => 'jasper', 'has_page' => false],
        ['name' => 'South Pittsburg', 'slug' => 'south-pittsburg', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
