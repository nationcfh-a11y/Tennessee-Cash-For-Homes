<?php
/**
 * Template Name: County — Madison County
 *
 * WordPress setup:
 *   Slug:     madison-county  (under county-pages/ parent)
 *   Template: County — Madison County
 */

$county = [
    'slug'          => 'madison-county',
    'name'          => 'Madison County',
    'county_id'     => 'madison',
    'h1'            => 'Sell Your House Fast For Cash in Madison County',
    'meta_title'    => 'We Buy Houses in Madison County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Madison County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '132',
    'avg_days'      => '76',
    'desc1'         => 'Madison County is the commercial hub of West Tennessee, home to Jackson and a thriving economy built around healthcare, manufacturing, and education. The county offers a great quality of life with affordable housing and big city amenities. Tennessee Cash For Homes buys houses across all of Madison County fast and for cash.',
    'desc2'         => 'Whether you are in Jackson or anywhere else in Madison County, facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are ready with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Madison County\'s strong economy and central West Tennessee location make land a valuable asset. Tennessee Cash For Homes buys Madison County land quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Jackson', 'slug' => 'jackson', 'has_page' => true],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
