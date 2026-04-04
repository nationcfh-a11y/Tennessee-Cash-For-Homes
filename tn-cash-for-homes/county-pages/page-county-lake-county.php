<?php
/**
 * Template Name: County — Lake County
 *
 * WordPress setup:
 *   Slug:     lake-county  (under county-pages/ parent)
 *   Template: County — Lake County
 */

$county = [
    'slug'          => 'lake-county',
    'name'          => 'Lake County',
    'county_id'     => 'lake',
    'h1'            => 'Sell Your House Fast For Cash in Lake County TN',
    'meta_title'    => 'We Buy Houses in Lake County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Lake County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$95,000',
    'homes_sold'    => '5',
    'avg_days'      => '125',
    'desc1'         => 'Lake County is Tennessee\'s smallest county by population, located in the far northwest corner along the Mississippi River and Reelfoot Lake. Home to Tiptonville, the county is known for its world class fishing and unique earthquake formed lake. Tennessee Cash For Homes buys houses across all of Lake County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, need to relocate, or want a quick sale we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Lake County offers unique lakefront and farmland near Reelfoot Lake at extremely affordable prices. Tennessee Cash For Homes buys Lake County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Tiptonville', 'slug' => 'tiptonville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is it possible to sell a home quickly in a rural county like Lake County?', 'a' => 'Lake County is Tennessee\'s least populated county, which makes traditional sales very difficult. We buy homes in Tiptonville and throughout Lake County for cash, giving you a guaranteed sale without the uncertainty of waiting for a local buyer.'],
        ['q' => 'Do you buy properties near Reelfoot Lake in Lake County?', 'a' => 'Yes. Reelfoot Lake is Lake County\'s biggest draw and we buy homes, cabins, and properties throughout the Reelfoot Lake area. All conditions are welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
