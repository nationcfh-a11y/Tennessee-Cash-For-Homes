<?php
/**
 * Template Name: County — Campbell County
 *
 * WordPress setup:
 *   Slug:     campbell-county  (under county-pages/ parent)
 *   Template: County — Campbell County
 */

$county = [
    'slug'          => 'campbell-county',
    'name'          => 'Campbell County',
    'county_id'     => 'campbell',
    'h1'            => 'Sell Your House Fast For Cash in Campbell County TN',
    'meta_title'    => 'We Buy Houses in Campbell County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Campbell County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '32',
    'avg_days'      => '95',
    'desc1'         => 'Campbell County sits in the Cumberland Mountains of East Tennessee, just off I-75, where 750 miles of Norris Lake shoreline draw boaters, fishermen, and retirees from across the region. La Follette and Jacksboro serve as the county\'s main towns, with Jellico and Caryville rounding out the community. The local economy has evolved from its coal mining heritage into a mix of tourism, light manufacturing, and services driven by the lake and the interstate corridor. Campbell County housing is among the most affordable in East Tennessee, with La Follette listings averaging around $227,000 and Jacksboro properties ranging higher depending on proximity to the lake.',
    'desc2'         => 'Affordability is a draw, but it also means the Campbell County real estate market can move slowly for sellers. Homes here average 95 days or more on the market, and properties that need work — which is common with the county\'s older housing stock and vacant homes — face an even longer wait for a qualified buyer. Lakefront and lake-view properties attract seasonal interest, but year-round demand is limited. Cash home buyers in Campbell County like us step in where the traditional market falls short. We buy homes as-is in La Follette, Jacksboro, Caryville, Jellico, and everywhere in between, with no agent fees, no inspection requirements, and no financing delays. If you need to sell your house in Campbell County, we make a fair offer and close quickly.',
    'desc3'         => 'No matter what your situation looks like — a vacant property that has sat empty for years, a home you inherited in the mountains, or a lakeside place you can no longer afford to maintain — Tennessee Cash For Homes buys houses throughout all of Campbell County in any condition. We are familiar with this area and ready to help you move forward.',
    'land_para'     => 'Campbell County offers stunning mountain and lakefront land along Norris Lake at some of the most affordable prices in East Tennessee. Tennessee Cash For Homes buys Campbell County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Jacksboro', 'slug' => 'jacksboro', 'has_page' => false],
        ['name' => 'La Follette', 'slug' => 'la-follette', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in La Follette or Jellico in Campbell County?', 'a' => 'Yes. We buy homes throughout Campbell County including La Follette, Jellico, Jacksboro, and Caryville. No matter where your property is located in the county, we will make you a cash offer.'],
        ['q' => 'Can I sell a property in Campbell County that has been sitting vacant?', 'a' => 'Absolutely. Vacant properties are common in Campbell County and we buy them regularly. Even if the home has been unoccupied for years and has fallen into disrepair, we will purchase it as-is.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
