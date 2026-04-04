<?php
/**
 * Template Name: County — Benton County
 *
 * WordPress setup:
 *   Slug:     benton-county  (under county-pages/ parent)
 *   Template: County — Benton County
 */

$county = [
    'slug'          => 'benton-county',
    'name'          => 'Benton County',
    'county_id'     => 'benton',
    'h1'            => 'Sell Your House Fast For Cash in Benton County TN',
    'meta_title'    => 'We Buy Houses in Benton County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Benton County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$179,000',
    'homes_sold'    => '12',
    'avg_days'      => '105',
    'desc1'         => 'Benton County is a peaceful rural county in West Tennessee centered around the town of Camden along the Tennessee River. Known for its access to Kentucky Lake and outdoor recreation, the county offers affordable living and small town charm. Tennessee Cash For Homes buys houses across all of Benton County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, relocating, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Benton County offers affordable rural land with excellent access to Kentucky Lake and the Tennessee River. Tennessee Cash For Homes buys Benton County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Camden', 'slug' => 'camden', 'has_page' => false],
        ['name' => 'Big Sandy', 'slug' => 'big-sandy', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
