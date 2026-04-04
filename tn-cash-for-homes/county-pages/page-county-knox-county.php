<?php
/**
 * Template Name: County — Knox County
 *
 * WordPress setup:
 *   Slug:     knox-county  (under county-pages/ parent)
 *   Template: County — Knox County
 */

$county = [
    'slug'          => 'knox-county',
    'name'          => 'Knox County',
    'county_id'     => 'knox',
    'h1'            => 'Sell Your House Fast For Cash in Knox County',
    'meta_title'    => 'We Buy Houses in Knox County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Knox County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$355,000',
    'homes_sold'    => '342',
    'avg_days'      => '62',
    'desc1'         => 'Knox County is home to Knoxville, Tennessee\'s third largest city and a vibrant hub of culture, education, and commerce in East Tennessee. With the University of Tennessee, a revitalized downtown, and proximity to the Great Smoky Mountains, the county is one of the state\'s most desirable places to live. Tennessee Cash For Homes buys houses across all of Knox County fast and for cash.',
    'desc2'         => 'Whether you are in Knoxville, Farragut, Powell, or anywhere else in Knox County we are ready to make you a fair cash offer today. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Knox County\'s growing population and strong economy have driven land values up across the county. Tennessee Cash For Homes buys Knox County land quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Knoxville', 'slug' => 'knoxville', 'has_page' => true],
        ['name' => 'Farragut', 'slug' => 'farragut', 'has_page' => false],
        ['name' => 'Powell', 'slug' => 'powell', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
