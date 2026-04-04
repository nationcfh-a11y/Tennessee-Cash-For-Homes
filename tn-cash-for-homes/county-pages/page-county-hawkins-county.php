<?php
/**
 * Template Name: County — Hawkins County
 *
 * WordPress setup:
 *   Slug:     hawkins-county  (under county-pages/ parent)
 *   Template: County — Hawkins County
 */

$county = [
    'slug'          => 'hawkins-county',
    'name'          => 'Hawkins County',
    'county_id'     => 'hawkins',
    'h1'            => 'Sell Your House Fast For Cash in Hawkins County TN',
    'meta_title'    => 'We Buy Houses in Hawkins County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hawkins County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '42',
    'avg_days'      => '86',
    'desc1'         => 'Hawkins County is a scenic Northeast Tennessee county home to Rogersville, one of the oldest towns in the state. The county offers mountain views, affordable housing, and access to Cherokee Lake. Tennessee Cash For Homes buys houses across all of Hawkins County fast and for cash.',
    'desc2'         => 'Whether you are facing financial difficulties, dealing with an inherited property, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Hawkins County offers lakefront land on Cherokee Lake, rolling farmland, and affordable mountain tracts. Tennessee Cash For Homes buys Hawkins County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Rogersville', 'slug' => 'rogersville', 'has_page' => false],
        ['name' => 'Church Hill', 'slug' => 'church-hill', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Rogersville or Church Hill in Hawkins County?', 'a' => 'Yes. We purchase homes throughout Hawkins County including Rogersville, Church Hill, Mount Carmel, Surgoinsville, and all surrounding areas.'],
        ['q' => 'Can I sell a home in Hawkins County that has been damaged by water or mold?', 'a' => 'We buy homes in Hawkins County with water damage, mold issues, or any other condition. No repairs or remediation are needed on your part before selling to us.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
