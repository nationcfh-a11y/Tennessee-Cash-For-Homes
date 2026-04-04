<?php
/**
 * Template Name: County — Carroll County
 *
 * WordPress setup:
 *   Slug:     carroll-county  (under county-pages/ parent)
 *   Template: County — Carroll County
 */

$county = [
    'slug'          => 'carroll-county',
    'name'          => 'Carroll County',
    'county_id'     => 'carroll',
    'h1'            => 'Sell Your House Fast For Cash in Carroll County TN',
    'meta_title'    => 'We Buy Houses in Carroll County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Carroll County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$145,000',
    'homes_sold'    => '18',
    'avg_days'      => '102',
    'desc1'         => 'Carroll County is a rural West Tennessee county with a rich agricultural heritage. Home to Huntingdon and McKenzie, the county offers peaceful country living and affordable real estate. Tennessee Cash For Homes buys houses across all of Carroll County fast and for cash in any condition.',
    'desc2'         => 'Whether you need to sell due to relocation, financial hardship, or an inherited property we make the process easy. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Carroll County offers productive farmland and rural residential lots at very affordable prices. Tennessee Cash For Homes buys Carroll County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Huntingdon', 'slug' => 'huntingdon', 'has_page' => false],
        ['name' => 'McKenzie', 'slug' => 'mckenzie', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
