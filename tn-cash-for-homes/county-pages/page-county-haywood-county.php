<?php
/**
 * Template Name: County — Haywood County
 *
 * WordPress setup:
 *   Slug:     haywood-county  (under county-pages/ parent)
 *   Template: County — Haywood County
 */

$county = [
    'slug'          => 'haywood-county',
    'name'          => 'Haywood County',
    'county_id'     => 'haywood',
    'h1'            => 'Sell Your House Fast For Cash in Haywood County TN',
    'meta_title'    => 'We Buy Houses in Haywood County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Haywood County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$148,000',
    'homes_sold'    => '14',
    'avg_days'      => '98',
    'desc1'         => 'Haywood County is a West Tennessee county with deep agricultural roots centered around Brownsville. Known for its rich Delta heritage and connection to blues music history, the county offers affordable living and a warm community. Tennessee Cash For Homes buys houses across all of Haywood County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, are behind on payments, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Haywood County offers fertile farmland and affordable residential lots in the West Tennessee Delta region. Tennessee Cash For Homes buys Haywood County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Brownsville', 'slug' => 'brownsville', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
