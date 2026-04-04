<?php
/**
 * Template Name: County — Carter County
 *
 * WordPress setup:
 *   Slug:     carter-county  (under county-pages/ parent)
 *   Template: County — Carter County
 */

$county = [
    'slug'          => 'carter-county',
    'name'          => 'Carter County',
    'county_id'     => 'carter',
    'h1'            => 'Sell Your House Fast For Cash in Carter County TN',
    'meta_title'    => 'We Buy Houses in Carter County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Carter County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '42',
    'avg_days'      => '85',
    'desc1'         => 'Carter County is a scenic mountain county in Northeast Tennessee home to Elizabethton and the Watauga River. With easy access to the Appalachian Trail and Cherokee National Forest, the county offers stunning natural beauty and affordable mountain living. Tennessee Cash For Homes buys houses across all of Carter County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial challenges, or simply want a quick stress free sale we are here to help. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Carter County offers beautiful mountain land with stunning views and access to the Cherokee National Forest. Tennessee Cash For Homes buys Carter County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Elizabethton', 'slug' => 'elizabethton', 'has_page' => false],
        ['name' => 'Watauga', 'slug' => 'watauga', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
