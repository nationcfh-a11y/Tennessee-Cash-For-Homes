<?php
/**
 * Template Name: County — Unicoi County
 *
 * WordPress setup:
 *   Slug:     unicoi-county  (under county-pages/ parent)
 *   Template: County — Unicoi County
 */

$county = [
    'slug'          => 'unicoi-county',
    'name'          => 'Unicoi County',
    'county_id'     => 'unicoi',
    'h1'            => 'Sell Your House Fast For Cash in Unicoi County TN',
    'meta_title'    => 'We Buy Houses in Unicoi County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Unicoi County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '14',
    'avg_days'      => '90',
    'desc1'         => 'Unicoi County is a small mountain county in Northeast Tennessee home to Erwin and the scenic Nolichucky River. Surrounded by the Cherokee National Forest and Unaka Mountains, the county offers stunning Appalachian scenery and affordable mountain living. Tennessee Cash For Homes buys houses across all of Unicoi County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, need to relocate, or want a quick hassle free sale we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Unicoi County offers affordable mountain land with river access and stunning views of the Unaka Mountains. Tennessee Cash For Homes buys Unicoi County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Erwin', 'slug' => 'erwin', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
