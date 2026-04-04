<?php
/**
 * Template Name: County — Putnam County
 *
 * WordPress setup:
 *   Slug:     putnam-county  (under county-pages/ parent)
 *   Template: County — Putnam County
 */

$county = [
    'slug'          => 'putnam-county',
    'name'          => 'Putnam County',
    'county_id'     => 'putnam',
    'h1'            => 'Sell Your House Fast For Cash in Putnam County TN',
    'meta_title'    => 'We Buy Houses in Putnam County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Putnam County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$285,000',
    'homes_sold'    => '68',
    'avg_days'      => '76',
    'desc1'         => 'Putnam County is a thriving Upper Cumberland county home to Cookeville and Tennessee Technological University. The county has become one of the state\'s fastest growing areas with a strong economy, excellent schools, and affordable cost of living. Tennessee Cash For Homes buys houses across all of Putnam County fast and for cash.',
    'desc2'         => 'Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline with a fair cash offer.',
    'land_para'     => 'Putnam County\'s rapid growth has increased demand for land across the county. Tennessee Cash For Homes buys Putnam County land quickly with no commissions, no surveys required, and flexible closing.',
    'cities'        => [
        ['name' => 'Cookeville', 'slug' => 'cookeville', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
