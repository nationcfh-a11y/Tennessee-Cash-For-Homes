<?php
/**
 * Template Name: County — Fentress County
 *
 * WordPress setup:
 *   Slug:     fentress-county  (under county-pages/ parent)
 *   Template: County — Fentress County
 */

$county = [
    'slug'          => 'fentress-county',
    'name'          => 'Fentress County',
    'county_id'     => 'fentress',
    'h1'            => 'Sell Your House Fast For Cash in Fentress County TN',
    'meta_title'    => 'We Buy Houses in Fentress County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Fentress County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$175,000',
    'homes_sold'    => '15',
    'avg_days'      => '100',
    'desc1'         => 'Fentress County is a scenic Upper Cumberland county home to Jamestown and the headwaters of the Big South Fork. The county is known for its outdoor recreation, natural beauty, and affordable mountain living. Tennessee Cash For Homes buys houses across all of Fentress County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial challenges, or need a quick sale we are here to help. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Fentress County offers affordable mountain land near the Big South Fork National Recreation Area. Tennessee Cash For Homes buys Fentress County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Jamestown', 'slug' => 'jamestown', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
