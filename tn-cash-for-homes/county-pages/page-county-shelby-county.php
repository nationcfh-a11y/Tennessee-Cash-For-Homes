<?php
/**
 * Template Name: County — Shelby County
 *
 * WordPress setup:
 *   Slug:     shelby-county  (under county-pages/ parent)
 *   Template: County — Shelby County
 */

$county = [
    'slug'          => 'shelby-county',
    'name'          => 'Shelby County',
    'county_id'     => 'shelby',
    'h1'            => 'Sell Your House Fast For Cash in Shelby County',
    'meta_title'    => 'We Buy Houses in Shelby County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Shelby County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '585',
    'avg_days'      => '72',
    'desc1'         => 'Shelby County is home to Memphis, Tennessee\'s largest city and a global center of music, culture, and barbecue. The county\'s diverse neighborhoods range from historic to modern, offering housing options for every budget. Tennessee Cash For Homes buys houses across all of Shelby County fast and for cash in any condition.',
    'desc2'         => 'Whether you are in Memphis, Germantown, Bartlett, Collierville, or anywhere else in Shelby County we are ready to make you a fair cash offer today. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Shelby County\'s large population and ongoing suburban development keep land in high demand. Tennessee Cash For Homes buys Shelby County land quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Memphis', 'slug' => 'memphis', 'has_page' => true],
        ['name' => 'Germantown', 'slug' => 'germantown', 'has_page' => false],
        ['name' => 'Bartlett', 'slug' => 'bartlett', 'has_page' => false],
        ['name' => 'Collierville', 'slug' => 'collierville', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
