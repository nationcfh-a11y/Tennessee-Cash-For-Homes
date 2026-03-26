<?php
/**
 * Template Name: County — Trousdale County
 *
 * WordPress setup:
 *   Slug:     trousdale-county  (under county-pages/ parent)
 *   Template: County — Trousdale County
 */

$county = [
    'slug'          => 'trousdale-county',
    'name'          => 'Trousdale County',
    'county_id'     => 'trousdale',
    'h1'            => 'Sell Your House Fast For Cash in Trousdale County TN',
    'meta_title'    => 'We Buy Houses in Trousdale County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Trousdale County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$265,000',
    'homes_sold'    => '11',
    'avg_days'      => '79',
    'desc1'         => 'Trousdale County is Tennessee\'s smallest county by area but has a big heart and a growing community. Home to Hartsville, the county sits northeast of Nashville offering affordable real estate and a peaceful lifestyle. Tennessee Cash For Homes buys houses across all of Trousdale County fast and for cash.',
    'desc2'         => 'Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are ready to help with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Trousdale County offers affordable rural land and residential lots northeast of Nashville. As the greater Nashville area continues to grow land in Trousdale County is becoming increasingly valuable. Tennessee Cash For Homes buys Trousdale County land quickly with no commissions.',
    'cities'        => [
        ['name' => 'Hartsville', 'slug' => 'hartsville', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
