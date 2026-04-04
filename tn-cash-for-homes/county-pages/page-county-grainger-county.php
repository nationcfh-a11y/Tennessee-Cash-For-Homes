<?php
/**
 * Template Name: County — Grainger County
 *
 * WordPress setup:
 *   Slug:     grainger-county  (under county-pages/ parent)
 *   Template: County — Grainger County
 */

$county = [
    'slug'          => 'grainger-county',
    'name'          => 'Grainger County',
    'county_id'     => 'grainger',
    'h1'            => 'Sell Your House Fast For Cash in Grainger County TN',
    'meta_title'    => 'We Buy Houses in Grainger County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Grainger County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '18',
    'avg_days'      => '92',
    'desc1'         => 'Grainger County is a rural East Tennessee county known for its tomato farming heritage and beautiful views of Cherokee Lake and the Clinch Mountains. Home to Rutledge, the county offers quiet country living within reach of Knoxville. Tennessee Cash For Homes buys houses across all of Grainger County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, need to relocate, or want a quick hassle free sale we are here to help with a fair cash offer. No repairs needed and no agent fees.',
    'land_para'     => 'Grainger County offers lakefront land on Cherokee Lake and affordable rural acreage with mountain views. Tennessee Cash For Homes buys Grainger County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Rutledge', 'slug' => 'rutledge', 'has_page' => false],
        ['name' => 'Bean Station', 'slug' => 'bean-station', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
