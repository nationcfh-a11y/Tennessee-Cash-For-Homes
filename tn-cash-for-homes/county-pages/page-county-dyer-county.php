<?php
/**
 * Template Name: County — Dyer County
 *
 * WordPress setup:
 *   Slug:     dyer-county  (under county-pages/ parent)
 *   Template: County — Dyer County
 */

$county = [
    'slug'          => 'dyer-county',
    'name'          => 'Dyer County',
    'county_id'     => 'dyer',
    'h1'            => 'Sell Your House Fast For Cash in Dyer County TN',
    'meta_title'    => 'We Buy Houses in Dyer County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Dyer County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$168,000',
    'homes_sold'    => '35',
    'avg_days'      => '88',
    'desc1'         => 'Dyer County is a thriving West Tennessee county anchored by Dyersburg. Known for its agricultural roots and growing economy, the county offers affordable living and a strong sense of community. Tennessee Cash For Homes buys houses across all of Dyer County fast and for cash in any condition.',
    'desc2'         => 'Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are here with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Dyer County offers productive farmland and affordable residential lots in the heart of Northwest Tennessee. Tennessee Cash For Homes buys Dyer County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dyersburg', 'slug' => 'dyersburg', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
