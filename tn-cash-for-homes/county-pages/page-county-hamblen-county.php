<?php
/**
 * Template Name: County — Hamblen County
 *
 * WordPress setup:
 *   Slug:     hamblen-county  (under county-pages/ parent)
 *   Template: County — Hamblen County
 */

$county = [
    'slug'          => 'hamblen-county',
    'name'          => 'Hamblen County',
    'county_id'     => 'hamblen',
    'h1'            => 'Sell Your House Fast For Cash in Hamblen County TN',
    'meta_title'    => 'We Buy Houses in Hamblen County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hamblen County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '48',
    'avg_days'      => '79',
    'desc1'         => 'Hamblen County is an East Tennessee county anchored by Morristown, one of the region\'s key commercial centers. The county offers affordable housing, a growing job market, and easy access to the Smoky Mountains. Tennessee Cash For Homes buys houses across all of Hamblen County fast and for cash.',
    'desc2'         => 'Whether you are relocating, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your schedule with a fair cash offer.',
    'land_para'     => 'Hamblen County offers affordable residential and commercial land in a growing East Tennessee market. Tennessee Cash For Homes buys Hamblen County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Morristown', 'slug' => 'morristown', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
