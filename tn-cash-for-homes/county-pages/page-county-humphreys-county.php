<?php
/**
 * Template Name: County — Humphreys County
 *
 * WordPress setup:
 *   Slug:     humphreys-county  (under county-pages/ parent)
 *   Template: County — Humphreys County
 */

$county = [
    'slug'          => 'humphreys-county',
    'name'          => 'Humphreys County',
    'county_id'     => 'humphreys',
    'h1'            => 'Sell Your House Fast For Cash in Humphreys County TN',
    'meta_title'    => 'We Buy Houses in Humphreys County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Humphreys County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '18',
    'avg_days'      => '88',
    'desc1'         => 'Humphreys County sits along the Tennessee River in Middle Tennessee offering affordable living and beautiful river access. Home to Waverly, the county has a resilient community and a growing real estate market. Tennessee Cash For Homes buys houses across all of Humphreys County fast and for cash in any condition.',
    'desc2'         => 'Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly we make the process simple. No repairs needed, no agent commissions, and we close on your schedule with a fair cash offer.',
    'land_para'     => 'Humphreys County offers waterfront and rural land along the Tennessee River at competitive prices. Tennessee Cash For Homes buys Humphreys County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Waverly', 'slug' => 'waverly', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Waverly or New Johnsonville in Humphreys County?', 'a' => 'Yes. We buy homes throughout Humphreys County including Waverly, New Johnsonville, and McEwen. We are familiar with the area and provide fair cash offers.'],
        ['q' => 'Can I sell a flood-damaged home in Humphreys County?', 'a' => 'Humphreys County experienced devastating flooding in recent years. We buy flood-damaged homes as-is in Waverly and throughout the county. You do not need to make any repairs.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
