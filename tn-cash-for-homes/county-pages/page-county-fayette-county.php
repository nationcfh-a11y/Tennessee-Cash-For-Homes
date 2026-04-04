<?php
/**
 * Template Name: County — Fayette County
 *
 * WordPress setup:
 *   Slug:     fayette-county  (under county-pages/ parent)
 *   Template: County — Fayette County
 */

$county = [
    'slug'          => 'fayette-county',
    'name'          => 'Fayette County',
    'county_id'     => 'fayette',
    'h1'            => 'Sell Your House Fast For Cash in Fayette County TN',
    'meta_title'    => 'We Buy Houses in Fayette County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Fayette County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$325,000',
    'homes_sold'    => '38',
    'avg_days'      => '80',
    'desc1'         => 'Fayette County is a growing suburban county east of Memphis offering a blend of rural charm and modern conveniences. Home to Somerville and the fast growing community of Oakland, the county has seen significant residential development in recent years. Tennessee Cash For Homes buys houses across all of Fayette County fast and for cash.',
    'desc2'         => 'Whether you are relocating, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Fayette County\'s proximity to Memphis has made land increasingly valuable as development pushes eastward. Tennessee Cash For Homes buys Fayette County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Somerville', 'slug' => 'somerville', 'has_page' => false],
        ['name' => 'Oakland', 'slug' => 'oakland', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
