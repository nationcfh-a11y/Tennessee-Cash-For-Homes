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
    'desc1'         => 'Marshall County has quietly become one of Middle Tennessee\'s most dynamic small economies. Named the 14th Most Dynamic Micropolitan Economy in the entire country, Lewisburg\'s industrial base spans automotive parts manufacturing by Marelli, aerospace and defense electronics, and a growing food production sector. The population of Lewisburg has jumped over 13% since 2020, and Chapel Hill to the north is feeling the pull of Nashville\'s southward expansion. Despite the growth, Marshall County home values remain well below the Nashville metro average, giving the area a rare combination of economic momentum and genuine affordability.',
    'desc2'         => 'That growth is a double-edged sword for sellers. Marshall County home values are rising, but the market here moves at a different pace than Nashville -- homes can sit for weeks, and buyers often expect concessions on older properties that need updating. If you need to sell your house in Marshall County without investing in repairs, staging, or months of showings, a cash sale makes real sense. Tennessee Cash For Homes buys houses across Marshall County in any condition, with no agent fees and no drawn-out negotiations.',
    'desc3'         => 'Whether you are dealing with an inherited farmhouse in Cornersville, a rental property in Lewisburg that has become more trouble than it is worth, or a home in Chapel Hill you need to sell before a move, we are here to help. We buy houses throughout all of Marshall County regardless of condition or situation, and our offers come with zero obligation.',
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
