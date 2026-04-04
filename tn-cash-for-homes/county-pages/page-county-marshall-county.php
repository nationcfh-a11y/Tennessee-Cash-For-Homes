<?php
/**
 * Template Name: County — Marshall County
 *
 * WordPress setup:
 *   Slug:     marshall-county  (under county-pages/ parent)
 *   Template: County — Marshall County
 */

$county = [
    'slug'          => 'marshall-county',
    'name'          => 'Marshall County',
    'county_id'     => 'marshall',
    'h1'            => 'Sell Your House Fast For Cash in Marshall County TN',
    'meta_title'    => 'We Buy Houses in Marshall County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Marshall County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$285,000',
    'homes_sold'    => '28',
    'avg_days'      => '72',
    'desc1'         => 'Marshall County is a charming Middle Tennessee county anchored by Lewisburg and known for its agricultural roots and tight knit community. Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly Tennessee Cash For Homes makes fair cash offers with no repairs needed, no agent fees, and no stress.',
    'desc2'         => 'We have helped homeowners across Marshall County sell their houses fast for cash. Our team understands the local market and is ready to make you a fair offer today. No matter what condition your home is in or what situation you are facing we can help.',
    'land_para'     => 'Marshall County offers peaceful rural living with rolling farmland and residential lots at affordable prices. As Nashville\'s growth spreads southward land in Marshall County is becoming increasingly attractive to buyers and developers. Tennessee Cash For Homes buys Marshall County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Lewisburg', 'slug' => 'lewisburg', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Lewisburg or Chapel Hill in Marshall County?', 'a' => 'Yes. We purchase homes throughout Marshall County including Lewisburg, Chapel Hill, Cornersville, and all surrounding areas. We are active buyers in this growing part of Middle Tennessee.'],
        ['q' => 'Is Marshall County growing fast enough to sell my home for a good price?', 'a' => 'Marshall County has seen growth as Nashville\'s suburbs expand southward. Our cash offers reflect current market trends and the county\'s increasing desirability. You get a fair price without the wait of a traditional listing.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
