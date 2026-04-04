<?php
/**
 * Template Name: County — Blount County
 *
 * WordPress setup:
 *   Slug:     blount-county  (under county-pages/ parent)
 *   Template: County — Blount County
 */

$county = [
    'slug'          => 'blount-county',
    'name'          => 'Blount County',
    'county_id'     => 'blount',
    'h1'            => 'Sell Your House Fast For Cash in Blount County TN',
    'meta_title'    => 'We Buy Houses in Blount County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Blount County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$365,000',
    'homes_sold'    => '112',
    'avg_days'      => '72',
    'desc1'         => 'Blount County is one of East Tennessee\'s most desirable counties, home to Maryville and serving as a gateway to the Great Smoky Mountains National Park. The county offers a perfect blend of mountain living, outdoor recreation, and proximity to Knoxville. Tennessee Cash For Homes buys houses across all of Blount County fast and for cash.',
    'desc2'         => 'Whether you need to sell due to relocation, inheritance, financial hardship, or any other reason we make the process simple and stress free. No repairs, no agent commissions, and we close on your schedule.',
    'land_para'     => 'Blount County land is highly sought after for its mountain views and proximity to the Smokies. Tennessee Cash For Homes buys Blount County land quickly with no commissions, no surveys required, and flexible closing.',
    'cities'        => [
        ['name' => 'Maryville', 'slug' => 'maryville', 'has_page' => false],
        ['name' => 'Alcoa', 'slug' => 'alcoa', 'has_page' => false],
        ['name' => 'Townsend', 'slug' => 'townsend', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes near the Great Smoky Mountains in Blount County?', 'a' => 'Yes. Blount County borders the Great Smoky Mountains National Park, and we buy homes throughout the county including Maryville, Alcoa, and Townsend. Whether it is a primary residence or a mountain getaway, we are interested.'],
        ['q' => 'Can I sell a property in Blount County that needs major repairs after storm damage?', 'a' => 'Absolutely. Blount County properties can face weather-related damage from storms moving through the foothills. We buy storm-damaged homes as-is with no repairs needed on your part.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
