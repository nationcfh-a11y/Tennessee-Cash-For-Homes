<?php
/**
 * Template Name: County — Hamilton County
 *
 * WordPress setup:
 *   Slug:     hamilton-county  (under county-pages/ parent)
 *   Template: County — Hamilton County
 */

$county = [
    'slug'          => 'hamilton-county',
    'name'          => 'Hamilton County',
    'county_id'     => 'hamilton',
    'h1'            => 'Sell Your House Fast For Cash in Hamilton County',
    'meta_title'    => 'We Buy Houses in Hamilton County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hamilton County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$345,000',
    'homes_sold'    => '298',
    'avg_days'      => '68',
    'desc1'         => 'Hamilton County is home to Chattanooga, one of Tennessee\'s most dynamic and revitalized cities. With a booming tech scene, world class outdoor recreation, and a thriving downtown, the county has become one of the state\'s most desirable places to live. Tennessee Cash For Homes buys houses across all of Hamilton County fast and for cash.',
    'desc2'         => 'Whether you are in Chattanooga, Signal Mountain, Red Bank, or anywhere else in Hamilton County we are ready to make you a fair cash offer today. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Hamilton County\'s growing economy and desirable location have made land increasingly valuable. Tennessee Cash For Homes buys Hamilton County land quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Chattanooga', 'slug' => 'chattanooga', 'has_page' => true],
        ['name' => 'Signal Mountain', 'slug' => 'signal-mountain', 'has_page' => false],
        ['name' => 'Red Bank', 'slug' => 'red-bank', 'has_page' => false],
        ['name' => 'Soddy-Daisy', 'slug' => 'soddy-daisy', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
