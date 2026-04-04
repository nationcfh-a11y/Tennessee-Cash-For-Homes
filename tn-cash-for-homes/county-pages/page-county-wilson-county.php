<?php
/**
 * Template Name: County — Wilson County
 *
 * WordPress setup:
 *   Slug:     wilson-county  (under county-pages/ parent)
 *   Template: County — Wilson County
 */

$county = [
    'slug'          => 'wilson-county',
    'name'          => 'Wilson County',
    'county_id'     => 'wilson',
    'h1'            => 'Sell Your House Fast For Cash in Wilson County',
    'meta_title'    => 'We Buy Houses in Wilson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Wilson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$399,050',
    'homes_sold'    => '89',
    'avg_days'      => '55',
    'desc1'         => 'Wilson County offers the perfect blend of small town charm and Nashville convenience. Home to Lebanon and Mt. Juliet, the county is growing rapidly as families seek more space outside the city. Tennessee Cash For Homes buys houses across Wilson County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, going through a divorce, or simply need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Wilson County\'s location along I-40 and its expanding communities make it a hotspot for residential and commercial growth. Tennessee Cash For Homes buys Wilson County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Lebanon',   'slug' => 'lebanon',   'has_page' => true],
        ['name' => 'Mt. Juliet', 'slug' => 'mt-juliet', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is Wilson County part of the Nashville metro for property values?', 'a' => 'Yes. Wilson County — including Lebanon, Mt. Juliet, and Watertown — is one of Nashville\'s fastest-growing suburban counties. Our cash offers reflect strong Nashville-area demand and current market conditions.'],
        ['q' => 'Do you buy homes in Mt. Juliet or Providence in Wilson County?', 'a' => 'We buy homes throughout Wilson County including Mt. Juliet, Lebanon, Watertown, and the Providence master-planned community. New construction and older homes are all welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
