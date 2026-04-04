<?php
/**
 * Template Name: County — Franklin County
 *
 * WordPress setup:
 *   Slug:     franklin-county  (under county-pages/ parent)
 *   Template: County — Franklin County
 */

$county = [
    'slug'          => 'franklin-county',
    'name'          => 'Franklin County',
    'county_id'     => 'franklin',
    'h1'            => 'Sell Your House Fast For Cash in Franklin County TN',
    'meta_title'    => 'We Buy Houses in Franklin County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Franklin County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$265,000',
    'homes_sold'    => '34',
    'avg_days'      => '84',
    'desc1'         => 'Franklin County is a scenic Southern Middle Tennessee county home to Winchester and the University of the South in nearby Sewanee. Nestled against the Cumberland Plateau, the county offers beautiful landscapes, historic charm, and a welcoming community. Tennessee Cash For Homes buys houses across all of Franklin County fast and for cash.',
    'desc2'         => 'Whether you need to sell due to relocation, inheritance, or financial reasons we make the process simple and stress free. No repairs, no agent commissions, and we close on your schedule.',
    'land_para'     => 'Franklin County offers diverse land from valley farmland to mountain tracts near the Cumberland Plateau. Tennessee Cash For Homes buys Franklin County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Winchester', 'slug' => 'winchester', 'has_page' => false],
        ['name' => 'Cowan', 'slug' => 'cowan', 'has_page' => false],
        ['name' => 'Decherd', 'slug' => 'decherd', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
