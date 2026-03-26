<?php
/**
 * Template Name: County — Davidson County
 *
 * WordPress setup:
 *   Slug:     davidson-county  (under county-pages/ parent)
 *   Template: County — Davidson County
 */

$county = [
    'slug'          => 'davidson-county',
    'name'          => 'Davidson County',
    'county_id'     => 'davidson',
    'h1'            => 'Sell Your House Fast For Cash in Davidson County',
    'meta_title'    => 'We Buy Houses in Davidson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Davidson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$470,200',
    'homes_sold'    => '686',
    'avg_days'      => '84',
    'desc1'         => 'Davidson County is home to Nashville, one of the fastest growing cities in the United States. Whether you are facing foreclosure, going through a divorce, dealing with an inherited property, or simply need to sell quickly, Tennessee Cash For Homes makes fair cash offers with no repairs needed, no agent fees, and no stress.',
    'desc2'         => 'We have helped hundreds of Davidson County homeowners sell their houses fast for cash. Our team knows the local market inside and out and we are ready to make you a fair offer today. No matter what condition your home is in or what situation you are facing we can help.',
    'land_para'     => 'Nashville and Davidson County booming economy and population growth have made land ownership more valuable than ever. Zoning changes, development pressures, and property taxes are causing many owners to cash out. Tennessee Cash For Homes buys land in Davidson County quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Nashville',   'slug' => 'nashville',   'has_page' => true],
        ['name' => 'Antioch',     'slug' => 'antioch',     'has_page' => true],
        ['name' => 'Old Hickory', 'slug' => 'old-hickory', 'has_page' => true],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
