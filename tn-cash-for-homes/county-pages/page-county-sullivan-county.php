<?php
/**
 * Template Name: County — Sullivan County
 *
 * WordPress setup:
 *   Slug:     sullivan-county  (under county-pages/ parent)
 *   Template: County — Sullivan County
 */

$county = [
    'slug'          => 'sullivan-county',
    'name'          => 'Sullivan County',
    'county_id'     => 'sullivan',
    'h1'            => 'Sell Your House Fast For Cash in Sullivan County',
    'meta_title'    => 'We Buy Houses in Sullivan County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Sullivan County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '142',
    'avg_days'      => '76',
    'desc1'         => 'Sullivan County is a major Northeast Tennessee county home to Bristol and Kingsport, two of the Tri-Cities region\'s anchor cities. With a strong manufacturing heritage, vibrant music scene, and access to the Appalachian Mountains, the county offers an excellent quality of life. Tennessee Cash For Homes buys houses across all of Sullivan County fast and for cash.',
    'desc2'         => 'Whether you are in Bristol, Kingsport, or anywhere else in Sullivan County and need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Sullivan County offers diverse land options from residential lots in growing suburbs to rural mountain acreage. Tennessee Cash For Homes buys Sullivan County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Bristol', 'slug' => 'bristol', 'has_page' => false],
        ['name' => 'Kingsport', 'slug' => 'kingsport', 'has_page' => false],
        ['name' => 'Blountville', 'slug' => 'blountville', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
