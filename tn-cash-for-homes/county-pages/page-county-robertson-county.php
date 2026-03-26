<?php
/**
 * Template Name: County — Robertson County
 *
 * WordPress setup:
 *   Slug:     robertson-county  (under county-pages/ parent)
 *   Template: County — Robertson County
 */

$county = [
    'slug'          => 'robertson-county',
    'name'          => 'Robertson County',
    'county_id'     => 'robertson',
    'h1'            => 'Sell Your House Fast For Cash in Robertson County',
    'meta_title'    => 'We Buy Houses in Robertson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Robertson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$310,000',
    'homes_sold'    => '41',
    'avg_days'      => '72',
    'desc1'         => 'Robertson County sits north of Nashville offering a mix of small town communities and rural living. Tennessee Cash For Homes buys houses across all of Robertson County fast and for cash in any condition.',
    'desc2'         => 'Whether you need to sell quickly due to relocation, financial reasons, or an inherited property we make the process simple. No repairs, no agent commissions, and we close on your schedule.',
    'land_para'     => 'Robertson County\'s proximity to Nashville and its expanding suburban communities make land increasingly valuable. Tennessee Cash For Homes buys Robertson County land quickly with no commissions and no surveys required.',
    'cities'        => [
        ['name' => 'Springfield', 'slug' => 'springfield',  'has_page' => false],
        ['name' => 'White House', 'slug' => 'white-house',  'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
