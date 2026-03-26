<?php
/**
 * Template Name: County — Hickman County
 *
 * WordPress setup:
 *   Slug:     hickman-county  (under county-pages/ parent)
 *   Template: County — Hickman County
 */

$county = [
    'slug'          => 'hickman-county',
    'name'          => 'Hickman County',
    'county_id'     => 'hickman',
    'h1'            => 'Sell Your House Fast For Cash in Hickman County TN',
    'meta_title'    => 'We Buy Houses in Hickman County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hickman County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$249,000',
    'homes_sold'    => '22',
    'avg_days'      => '91',
    'desc1'         => 'Hickman County is a rural Middle Tennessee county known for its scenic beauty and peaceful lifestyle. Home to Centerville, the county offers affordable living within driving distance of Nashville. Tennessee Cash For Homes buys houses across all of Hickman County fast and for cash regardless of condition.',
    'desc2'         => 'Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are ready to help with a fair no obligation cash offer. No repairs needed and no agent fees. We close when you are ready.',
    'land_para'     => 'Hickman County offers beautiful rural land including wooded tracts, farmland, and residential lots at affordable prices. Tennessee Cash For Homes buys Hickman County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Centerville', 'slug' => 'centerville', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
