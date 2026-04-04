<?php
/**
 * Template Name: County — Wayne County
 *
 * WordPress setup:
 *   Slug:     wayne-county  (under county-pages/ parent)
 *   Template: County — Wayne County
 */

$county = [
    'slug'          => 'wayne-county',
    'name'          => 'Wayne County',
    'county_id'     => 'wayne',
    'h1'            => 'Sell Your House Fast For Cash in Wayne County TN',
    'meta_title'    => 'We Buy Houses in Wayne County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Wayne County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$165,000',
    'homes_sold'    => '12',
    'avg_days'      => '102',
    'desc1'         => 'Wayne County is a rural Southern Middle Tennessee county home to Waynesboro along the Buffalo River. The county offers some of the most affordable real estate in the state along with beautiful countryside and access to the Natchez Trace Parkway. Tennessee Cash For Homes buys houses across all of Wayne County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial difficulties, or need to sell quickly we are here to help. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Wayne County offers affordable rural land along the Buffalo River and Natchez Trace Parkway. Tennessee Cash For Homes buys Wayne County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Waynesboro', 'slug' => 'waynesboro', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
