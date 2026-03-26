<?php
/**
 * Template Name: County — Cheatham County
 *
 * WordPress setup:
 *   Slug:     cheatham-county  (under county-pages/ parent)
 *   Template: County — Cheatham County
 */

$county = [
    'slug'          => 'cheatham-county',
    'name'          => 'Cheatham County',
    'county_id'     => 'cheatham',
    'h1'            => 'Sell Your House Fast For Cash in Cheatham County',
    'meta_title'    => 'We Buy Houses in Cheatham County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Cheatham County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$325,000',
    'homes_sold'    => '32',
    'avg_days'      => '78',
    'desc1'         => 'Cheatham County sits just west of Nashville offering rural living with easy access to the city. Tennessee Cash For Homes buys houses across all of Cheatham County fast and for cash regardless of condition.',
    'desc2'         => 'Whether you are facing financial difficulties, dealing with an inherited property, or simply need to sell quickly we are here to help with a fair no obligation cash offer. No repairs needed and no agent fees.',
    'land_para'     => 'Cheatham County offers peaceful rural living and affordable land options that attract buyers seeking space outside Nashville. Tennessee Cash For Homes buys Cheatham County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Ashland City', 'slug' => 'ashland-city', 'has_page' => false],
    ],
];

add_filter( 'pre_get_document_title', function() use ( $county ) {
    return $county['meta_title'];
}, 20 );

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

get_header();
include get_template_directory() . '/county-template.php';
get_footer();
