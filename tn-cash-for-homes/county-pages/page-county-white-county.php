<?php
/**
 * Template Name: County — White County
 *
 * WordPress setup:
 *   Slug:     white-county  (under county-pages/ parent)
 *   Template: County — White County
 */

$county = [
    'slug'          => 'white-county',
    'name'          => 'White County',
    'county_id'     => 'white',
    'h1'            => 'Sell Your House Fast For Cash in White County TN',
    'meta_title'    => 'We Buy Houses in White County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in White County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '28',
    'avg_days'      => '86',
    'desc1'         => 'White County is an Upper Cumberland county in Middle Tennessee home to Sparta. The county offers affordable living, scenic countryside, and access to Center Hill Lake and Rock Island State Park. Tennessee Cash For Homes buys houses across all of White County fast and for cash.',
    'desc2'         => 'Whether you are facing financial difficulties, dealing with an inherited property, or need to sell quickly we are ready to help with a fair cash offer. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'White County offers lakefront land near Center Hill Lake, farmland, and scenic rural acreage at affordable prices. Tennessee Cash For Homes buys White County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Sparta', 'slug' => 'sparta', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
