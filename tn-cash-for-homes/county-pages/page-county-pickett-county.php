<?php
/**
 * Template Name: County — Pickett County
 *
 * WordPress setup:
 *   Slug:     pickett-county  (under county-pages/ parent)
 *   Template: County — Pickett County
 */

$county = [
    'slug'          => 'pickett-county',
    'name'          => 'Pickett County',
    'county_id'     => 'pickett',
    'h1'            => 'Sell Your House Fast For Cash in Pickett County TN',
    'meta_title'    => 'We Buy Houses in Pickett County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Pickett County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '6',
    'avg_days'      => '112',
    'desc1'         => 'Pickett County is one of Tennessee\'s smallest and most peaceful counties, home to Byrdstown and the stunning Dale Hollow Lake. Known for world class fishing and natural beauty, the county offers an escape from the hustle of city life. Tennessee Cash For Homes buys houses across all of Pickett County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, need to relocate, or want a quick hassle free sale we are here with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Pickett County offers affordable lakefront land on Dale Hollow Lake and scenic rural acreage. Tennessee Cash For Homes buys Pickett County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Byrdstown', 'slug' => 'byrdstown', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
