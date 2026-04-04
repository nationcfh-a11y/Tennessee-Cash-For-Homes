<?php
/**
 * Template Name: County — Cumberland County
 *
 * WordPress setup:
 *   Slug:     cumberland-county  (under county-pages/ parent)
 *   Template: County — Cumberland County
 */

$county = [
    'slug'          => 'cumberland-county',
    'name'          => 'Cumberland County',
    'county_id'     => 'cumberland',
    'h1'            => 'Sell Your House Fast For Cash in Cumberland County TN',
    'meta_title'    => 'We Buy Houses in Cumberland County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Cumberland County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$265,000',
    'homes_sold'    => '72',
    'avg_days'      => '82',
    'desc1'         => 'Cumberland County sits atop the Cumberland Plateau and is home to Crossville, known as the Golf Capital of Tennessee. The county attracts retirees and outdoor enthusiasts with its mild climate, scenic beauty, and affordable cost of living. Tennessee Cash For Homes buys houses across all of Cumberland County fast and for cash.',
    'desc2'         => 'Whether you are downsizing, dealing with an inherited property, or need to sell quickly for any reason we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Cumberland County is one of Tennessee\'s largest counties by area with diverse land options from mountain tracts to lakefront lots. Tennessee Cash For Homes buys Cumberland County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Crossville', 'slug' => 'crossville', 'has_page' => true],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
