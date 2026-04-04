<?php
/**
 * Template Name: County — Cannon County
 *
 * WordPress setup:
 *   Slug:     cannon-county  (under county-pages/ parent)
 *   Template: County — Cannon County
 */

$county = [
    'slug'          => 'cannon-county',
    'name'          => 'Cannon County',
    'county_id'     => 'cannon',
    'h1'            => 'Sell Your House Fast For Cash in Cannon County TN',
    'meta_title'    => 'We Buy Houses in Cannon County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Cannon County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$260,000',
    'homes_sold'    => '4',
    'avg_days'      => '52',
    'desc1'         => 'Cannon County is a small rural county in Middle Tennessee known for its peaceful lifestyle and close proximity to Murfreesboro and Nashville. Home to Woodbury, the county offers affordable real estate and a tight knit community. Tennessee Cash For Homes buys houses across all of Cannon County fast and for cash.',
    'desc2'         => 'Whether you need to sell quickly due to relocation, financial hardship, or an inherited property we make the process simple. No repairs needed, no agent commissions, and we close when you are ready with a fair cash offer.',
    'land_para'     => 'Cannon County offers rolling hills, wooded acreage, and rural lots at very competitive prices. As growth expands outward from Murfreesboro land in Cannon County is becoming increasingly attractive. Tennessee Cash For Homes buys Cannon County land quickly with no commissions.',
    'cities'        => [
        ['name' => 'Woodbury', 'slug' => 'woodbury', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'Is it hard to sell a home in a small county like Cannon County?', 'a' => 'Selling on the traditional market in a small county like Cannon County can be challenging due to limited buyer demand. That is where we come in. We buy homes directly for cash in Woodbury and throughout Cannon County, eliminating the uncertainty of waiting for a buyer.'],
        ['q' => 'Do you buy homes with well water and septic systems in Cannon County?', 'a' => 'Yes. Many rural Cannon County homes use well water and septic systems. We buy these properties regardless of the condition of the well or septic system.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
