<?php
/**
 * Template Name: County — Warren County
 *
 * WordPress setup:
 *   Slug:     warren-county  (under county-pages/ parent)
 *   Template: County — Warren County
 */

$county = [
    'slug'          => 'warren-county',
    'name'          => 'Warren County',
    'county_id'     => 'warren',
    'h1'            => 'Sell Your House Fast For Cash in Warren County TN',
    'meta_title'    => 'We Buy Houses in Warren County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Warren County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$250,000',
    'homes_sold'    => '19',
    'avg_days'      => '104',
    'desc1'         => 'Warren County is known for its nursery industry and beautiful Highland Rim scenery. Home to McMinnville, the county offers a peaceful lifestyle with affordable real estate. Tennessee Cash For Homes buys houses across all of Warren County fast and for cash regardless of condition.',
    'desc2'         => 'Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline with a fair cash offer.',
    'land_para'     => 'Warren County offers beautiful rural land on the Highland Rim including farmland, nursery properties, and wooded acreage. Tennessee Cash For Homes buys Warren County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'McMinnville', 'slug' => 'mcminnville', 'has_page' => true],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
