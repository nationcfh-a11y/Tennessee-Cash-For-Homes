<?php
/**
 * Template Name: County — Giles County
 *
 * WordPress setup:
 *   Slug:     giles-county  (under county-pages/ parent)
 *   Template: County — Giles County
 */

$county = [
    'slug'          => 'giles-county',
    'name'          => 'Giles County',
    'county_id'     => 'giles',
    'h1'            => 'Sell Your House Fast For Cash in Giles County TN',
    'meta_title'    => 'We Buy Houses in Giles County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Giles County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '24',
    'avg_days'      => '88',
    'desc1'         => 'Giles County is a historic Southern Middle Tennessee county home to Pulaski. Known for its beautiful antebellum architecture and rolling countryside, the county offers affordable living near the Alabama border. Tennessee Cash For Homes buys houses across all of Giles County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, are facing foreclosure, or simply need to sell quickly we make the process easy. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Giles County offers beautiful rolling farmland and rural residential tracts in Southern Middle Tennessee. Tennessee Cash For Homes buys Giles County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Pulaski', 'slug' => 'pulaski', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
