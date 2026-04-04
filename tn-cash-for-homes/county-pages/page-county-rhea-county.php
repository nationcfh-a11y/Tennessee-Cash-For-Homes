<?php
/**
 * Template Name: County — Rhea County
 *
 * WordPress setup:
 *   Slug:     rhea-county  (under county-pages/ parent)
 *   Template: County — Rhea County
 */

$county = [
    'slug'          => 'rhea-county',
    'name'          => 'Rhea County',
    'county_id'     => 'rhea',
    'h1'            => 'Sell Your House Fast For Cash in Rhea County TN',
    'meta_title'    => 'We Buy Houses in Rhea County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Rhea County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '28',
    'avg_days'      => '86',
    'desc1'         => 'Rhea County is an East Tennessee county home to Dayton, famous for the historic Scopes Trial. Located along the Tennessee River and Watts Bar Lake, the county offers affordable waterfront living and a growing community. Tennessee Cash For Homes buys houses across all of Rhea County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial hardship, or need to sell quickly we make the process easy. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Rhea County offers lakefront land on Watts Bar Lake and affordable rural acreage in a growing market. Tennessee Cash For Homes buys Rhea County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Dayton', 'slug' => 'dayton', 'has_page' => false],
        ['name' => 'Spring City', 'slug' => 'spring-city', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
