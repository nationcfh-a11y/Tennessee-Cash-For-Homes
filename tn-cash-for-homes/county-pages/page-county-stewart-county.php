<?php
/**
 * Template Name: County — Stewart County
 *
 * WordPress setup:
 *   Slug:     stewart-county  (under county-pages/ parent)
 *   Template: County — Stewart County
 */

$county = [
    'slug'          => 'stewart-county',
    'name'          => 'Stewart County',
    'county_id'     => 'stewart',
    'h1'            => 'Sell Your House Fast For Cash in Stewart County TN',
    'meta_title'    => 'We Buy Houses in Stewart County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Stewart County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$210,000',
    'homes_sold'    => '12',
    'avg_days'      => '95',
    'desc1'         => 'Stewart County sits in northwestern Middle Tennessee along the Cumberland River offering rural living and beautiful waterfront properties. Home to Dover and the Land Between the Lakes area, the county attracts outdoor enthusiasts and retirees. Tennessee Cash For Homes buys houses across all of Stewart County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial difficulties, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline with a fair cash offer.',
    'land_para'     => 'Stewart County offers exceptional waterfront and rural land along the Cumberland River and Lake Barkley. Tennessee Cash For Homes buys Stewart County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dover', 'slug' => 'dover', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties near Land Between the Lakes in Stewart County?', 'a' => 'Yes. Stewart County borders the Land Between the Lakes National Recreation Area and we buy homes, cabins, and properties throughout the county including Dover and Indian Mound.'],
        ['q' => 'Can I sell a seasonal property or hunting cabin in Stewart County?', 'a' => 'We buy seasonal homes, hunting cabins, and recreational properties in Stewart County. Whether used part-time or fully vacant, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
