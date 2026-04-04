<?php
/**
 * Template Name: County — Hancock County
 *
 * WordPress setup:
 *   Slug:     hancock-county  (under county-pages/ parent)
 *   Template: County — Hancock County
 */

$county = [
    'slug'          => 'hancock-county',
    'name'          => 'Hancock County',
    'county_id'     => 'hancock',
    'h1'            => 'Sell Your House Fast For Cash in Hancock County TN',
    'meta_title'    => 'We Buy Houses in Hancock County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hancock County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$110,000',
    'homes_sold'    => '6',
    'avg_days'      => '120',
    'desc1'         => 'Hancock County is one of Tennessee\'s most remote and rural counties, nestled in the Appalachian Mountains near the Virginia border. Home to Sneedville, the county offers rugged mountain beauty and an extremely affordable cost of living. Tennessee Cash For Homes buys houses across all of Hancock County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, need to relocate, or simply want to sell we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Hancock County offers some of the most affordable mountain land in Tennessee with wooded tracts and scenic acreage. Tennessee Cash For Homes buys Hancock County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Sneedville', 'slug' => 'sneedville', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
