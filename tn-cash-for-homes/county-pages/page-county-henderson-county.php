<?php
/**
 * Template Name: County — Henderson County
 *
 * WordPress setup:
 *   Slug:     henderson-county  (under county-pages/ parent)
 *   Template: County — Henderson County
 */

$county = [
    'slug'          => 'henderson-county',
    'name'          => 'Henderson County',
    'county_id'     => 'henderson',
    'h1'            => 'Sell Your House Fast For Cash in Henderson County TN',
    'meta_title'    => 'We Buy Houses in Henderson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Henderson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '22',
    'avg_days'      => '90',
    'desc1'         => 'Henderson County is a West Tennessee county centered around Lexington with a strong sense of community and affordable housing. Home to Natchez Trace State Park, the county offers outdoor recreation and a relaxed rural lifestyle. Tennessee Cash For Homes buys houses across all of Henderson County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing foreclosure, or need a quick sale we are here to help. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Henderson County offers affordable farmland, wooded tracts, and lakefront properties near Natchez Trace State Park. Tennessee Cash For Homes buys Henderson County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Lexington', 'slug' => 'lexington', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
