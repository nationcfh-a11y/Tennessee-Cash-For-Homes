<?php
/**
 * Template Name: County — Chester County
 *
 * WordPress setup:
 *   Slug:     chester-county  (under county-pages/ parent)
 *   Template: County — Chester County
 */

$county = [
    'slug'          => 'chester-county',
    'name'          => 'Chester County',
    'county_id'     => 'chester',
    'h1'            => 'Sell Your House Fast For Cash in Chester County TN',
    'meta_title'    => 'We Buy Houses in Chester County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Chester County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '14',
    'avg_days'      => '96',
    'desc1'         => 'Chester County is a small rural county in West Tennessee centered around Henderson. The county offers quiet country living, affordable real estate, and proximity to Jackson. Tennessee Cash For Homes buys houses across all of Chester County fast and for cash in any condition.',
    'desc2'         => 'Whether you are dealing with an inherited property, going through a divorce, or need to sell quickly we are ready to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Chester County offers affordable farmland and rural residential lots in a quiet West Tennessee setting. Tennessee Cash For Homes buys Chester County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Henderson', 'slug' => 'henderson', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties in Henderson or other parts of Chester County?', 'a' => 'Yes. We purchase homes throughout Chester County including Henderson and all surrounding areas. Whether your home is in town or on a rural lot, we buy properties in any condition.'],
        ['q' => 'Can I sell a house in Chester County if I live out of state?', 'a' => 'Absolutely. Many Chester County property owners live out of state and need a hassle-free sale. We handle all the details and can close remotely so you never need to travel to Tennessee.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
