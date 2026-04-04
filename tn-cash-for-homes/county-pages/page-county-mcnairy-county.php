<?php
/**
 * Template Name: County — McNairy County
 *
 * WordPress setup:
 *   Slug:     mcnairy-county  (under county-pages/ parent)
 *   Template: County — McNairy County
 */

$county = [
    'slug'          => 'mcnairy-county',
    'name'          => 'McNairy County',
    'county_id'     => 'mcnairy',
    'h1'            => 'Sell Your House Fast For Cash in McNairy County TN',
    'meta_title'    => 'We Buy Houses in McNairy County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in McNairy County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '18',
    'avg_days'      => '96',
    'desc1'         => 'McNairy County is a rural West Tennessee county home to Selmer and known for its connection to the legendary Sheriff Buford Pusser. The county offers affordable living, rolling countryside, and a strong sense of community. Tennessee Cash For Homes buys houses across all of McNairy County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, are facing financial difficulties, or simply need to sell fast we are here to help. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'McNairy County offers affordable farmland and rural residential tracts near the Mississippi border. Tennessee Cash For Homes buys McNairy County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Selmer', 'slug' => 'selmer', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
