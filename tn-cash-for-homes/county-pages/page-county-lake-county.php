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
    'desc1'         => 'Lake County is unlike anywhere else in Tennessee. Formed by the catastrophic New Madrid earthquakes of 1811-1812, Reelfoot Lake dominates the landscape and defines the local way of life in this far northwest corner of the state. Tiptonville, the county seat, serves a tight-knit community of roughly 7,000 residents who depend on agriculture -- cotton and soybean farming on some of Tennessee\'s most fertile bottomland -- and a tourism economy that brings over 600,000 visitors annually for fishing, birdwatching, and the popular Reelfoot Arts and Crafts Festival. New economic development, including the Sinova Global silicon metal facility, is bringing fresh employment to an area that has long relied on the land and the lake.',
    'desc2'         => 'Selling a home in the Lake County real estate market is genuinely difficult through traditional channels. With one of the lowest populations in Tennessee and very few homes trading hands in any given month, properties can sit on the market for four months or longer with no serious offers. Lake County home values remain among the most affordable in the state, which means agent commissions and closing costs consume a larger share of your sale price. Cash home buyers in Lake County like Tennessee Cash For Homes provide a dependable alternative -- a guaranteed sale without the uncertainty of waiting for a local buyer in a market where buyers are scarce.',
    'desc3'         => 'Whatever your situation -- an inherited family home in Tiptonville, a fishing cabin near Reelfoot Lake you no longer use, or a property that has sat vacant and needs extensive repairs -- we buy houses throughout all of Lake County in any condition. Tennessee Cash For Homes understands the unique challenges of selling in a small rural market, and we are here to make the process simple with a fair cash offer and a closing timeline that fits your needs.',
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
