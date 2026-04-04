<?php
/**
 * Template Name: County — Obion County
 *
 * WordPress setup:
 *   Slug:     obion-county  (under county-pages/ parent)
 *   Template: County — Obion County
 */

$county = [
    'slug'          => 'obion-county',
    'name'          => 'Obion County',
    'county_id'     => 'obion',
    'h1'            => 'Sell Your House Fast For Cash in Obion County TN',
    'meta_title'    => 'We Buy Houses in Obion County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Obion County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$135,000',
    'homes_sold'    => '22',
    'avg_days'      => '94',
    'desc1'         => 'Obion County is a Northwest Tennessee county centered around Union City with a strong agricultural economy. The county offers affordable living and a welcoming small town atmosphere near the Kentucky border. Tennessee Cash For Homes buys houses across all of Obion County fast and for cash.',
    'desc2'         => 'Whether you are facing financial difficulties, dealing with an inherited property, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Obion County offers productive farmland and affordable residential lots in Northwest Tennessee. Tennessee Cash For Homes buys Obion County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Union City', 'slug' => 'union-city', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
