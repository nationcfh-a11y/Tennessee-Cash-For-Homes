<?php
/**
 * Template Name: County — Sequatchie County
 *
 * WordPress setup:
 *   Slug:     sequatchie-county  (under county-pages/ parent)
 *   Template: County — Sequatchie County
 */

$county = [
    'slug'          => 'sequatchie-county',
    'name'          => 'Sequatchie County',
    'county_id'     => 'sequatchie',
    'h1'            => 'Sell Your House Fast For Cash in Sequatchie County TN',
    'meta_title'    => 'We Buy Houses in Sequatchie County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Sequatchie County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '12',
    'avg_days'      => '92',
    'desc1'         => 'Sequatchie County is a small scenic county in the Sequatchie Valley of Southeast Tennessee. Home to Dunlap, the county is known for hang gliding at Dunlap and beautiful valley and mountain views. Tennessee Cash For Homes buys houses across all of Sequatchie County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, need to relocate, or want a quick hassle free sale we make the process simple. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Sequatchie County offers scenic valley and mountain land at affordable prices in a quiet Tennessee setting. Tennessee Cash For Homes buys Sequatchie County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dunlap', 'slug' => 'dunlap', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
