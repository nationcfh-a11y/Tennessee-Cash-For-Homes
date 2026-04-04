<?php
/**
 * Template Name: County — Decatur County
 *
 * WordPress setup:
 *   Slug:     decatur-county  (under county-pages/ parent)
 *   Template: County — Decatur County
 */

$county = [
    'slug'          => 'decatur-county',
    'name'          => 'Decatur County',
    'county_id'     => 'decatur',
    'h1'            => 'Sell Your House Fast For Cash in Decatur County TN',
    'meta_title'    => 'We Buy Houses in Decatur County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Decatur County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$165,000',
    'homes_sold'    => '11',
    'avg_days'      => '108',
    'desc1'         => 'Decatur County is a small rural county along the Tennessee River in West Tennessee. Home to Decaturville and Parsons, the county offers peaceful country living and access to excellent fishing and boating. Tennessee Cash For Homes buys houses across all of Decatur County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, are facing financial hardship, or simply need to sell fast we are ready to make you a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Decatur County offers affordable rural land along the Tennessee River including riverfront tracts, farmland, and wooded acreage. Tennessee Cash For Homes buys Decatur County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Decaturville', 'slug' => 'decaturville', 'has_page' => false],
        ['name' => 'Parsons', 'slug' => 'parsons', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
