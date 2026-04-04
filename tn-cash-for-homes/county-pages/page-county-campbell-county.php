<?php
/**
 * Template Name: County — Campbell County
 *
 * WordPress setup:
 *   Slug:     campbell-county  (under county-pages/ parent)
 *   Template: County — Campbell County
 */

$county = [
    'slug'          => 'campbell-county',
    'name'          => 'Campbell County',
    'county_id'     => 'campbell',
    'h1'            => 'Sell Your House Fast For Cash in Campbell County TN',
    'meta_title'    => 'We Buy Houses in Campbell County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Campbell County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '32',
    'avg_days'      => '95',
    'desc1'         => 'Campbell County is a mountain county in Northeast Tennessee known for Norris Lake, the Cumberland Mountains, and a strong sense of community. Home to Jacksboro and La Follette, the county offers affordable living surrounded by natural beauty. Tennessee Cash For Homes buys houses across all of Campbell County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, are behind on payments, or just need to sell quickly we can help. No repairs needed, no agent fees, and we close on your schedule with a fair cash offer.',
    'land_para'     => 'Campbell County offers stunning mountain and lakefront land along Norris Lake at some of the most affordable prices in East Tennessee. Tennessee Cash For Homes buys Campbell County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Jacksboro', 'slug' => 'jacksboro', 'has_page' => false],
        ['name' => 'La Follette', 'slug' => 'la-follette', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
