<?php
/**
 * Template Name: County — Roane County
 *
 * WordPress setup:
 *   Slug:     roane-county  (under county-pages/ parent)
 *   Template: County — Roane County
 */

$county = [
    'slug'          => 'roane-county',
    'name'          => 'Roane County',
    'county_id'     => 'roane',
    'h1'            => 'Sell Your House Fast For Cash in Roane County TN',
    'meta_title'    => 'We Buy Houses in Roane County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Roane County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '42',
    'avg_days'      => '82',
    'desc1'         => 'Roane County is an East Tennessee county home to Kingston and Harriman, situated at the confluence of the Tennessee and Clinch Rivers. The county offers lakefront living on Watts Bar Lake, affordable housing, and easy access to Knoxville. Tennessee Cash For Homes buys houses across all of Roane County fast and for cash.',
    'desc2'         => 'Whether you need to sell due to relocation, an inherited property, or financial reasons we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Roane County offers lakefront land on Watts Bar Lake, riverfront properties, and affordable residential lots. Tennessee Cash For Homes buys Roane County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Kingston', 'slug' => 'kingston', 'has_page' => false],
        ['name' => 'Harriman', 'slug' => 'harriman', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
