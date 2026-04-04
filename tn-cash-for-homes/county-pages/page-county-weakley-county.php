<?php
/**
 * Template Name: County — Weakley County
 *
 * WordPress setup:
 *   Slug:     weakley-county  (under county-pages/ parent)
 *   Template: County — Weakley County
 */

$county = [
    'slug'          => 'weakley-county',
    'name'          => 'Weakley County',
    'county_id'     => 'weakley',
    'h1'            => 'Sell Your House Fast For Cash in Weakley County TN',
    'meta_title'    => 'We Buy Houses in Weakley County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Weakley County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '24',
    'avg_days'      => '92',
    'desc1'         => 'Weakley County is a Northwest Tennessee county home to Dresden and Martin, where the University of Tennessee at Martin brings a college town energy to the region. The county offers affordable living and a welcoming community atmosphere. Tennessee Cash For Homes buys houses across all of Weakley County fast and for cash.',
    'desc2'         => 'Whether you are relocating, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Weakley County offers affordable farmland and residential lots in a growing Northwest Tennessee community. Tennessee Cash For Homes buys Weakley County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dresden', 'slug' => 'dresden', 'has_page' => false],
        ['name' => 'Martin', 'slug' => 'martin', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
