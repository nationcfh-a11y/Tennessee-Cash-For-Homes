<?php
/**
 * Template Name: County — Hamblen County
 *
 * WordPress setup:
 *   Slug:     hamblen-county  (under county-pages/ parent)
 *   Template: County — Hamblen County
 */

$county = [
    'slug'          => 'hamblen-county',
    'name'          => 'Hamblen County',
    'county_id'     => 'hamblen',
    'h1'            => 'Sell Your House Fast For Cash in Hamblen County TN',
    'meta_title'    => 'We Buy Houses in Hamblen County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hamblen County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '48',
    'avg_days'      => '79',
    'desc1'         => 'Hamblen County punches well above its weight as an East Tennessee employment hub. Morristown, the county seat and heart of the Lakeway area, draws over 19,000 commuters daily to nearly 100 manufacturing operations that account for more than a quarter of the local workforce. Howmet Aerospace recently expanded to become the county\'s top employer, adding over 200 jobs, and industries spanning automotive parts, plastics, and advanced manufacturing keep the economy humming. Cherokee Lake and Panther Creek State Park give residents easy access to outdoor recreation, and Morristown\'s position along I-81 puts Knoxville less than an hour away. New residential development is active, including the 455-lot Morristown Meadows subdivision, yet the overall cost of living remains about 11 percent below the national average.',
    'desc2'         => 'That growth and affordability are good news for Hamblen County as a whole, but they do not solve every seller\'s problem. The local market has a significant share of older housing stock from the mid-20th century that can be tough to move without updates, and a poverty rate near 26 percent means the buyer pool for higher-priced or as-is properties is limited. Homes in Hamblen County average around 79 days on market, and agent commissions on a median sale price 22 percent below the national average can take a painful bite out of your proceeds. If you need to sell your house in Hamblen County without investing in repairs or waiting for the right buyer, cash home buyers in Hamblen County like us offer a clean, fast alternative with no fees and no contingencies.',
    'desc3'         => 'Whether you have a ranch home near Cherokee Lake, a duplex off Andrew Johnson Highway, or a property in Morristown that has been sitting vacant, Tennessee Cash For Homes buys houses throughout all of Hamblen County in any condition. We work with homeowners in every situation, and our goal is to make your sale as simple as possible.',
    'land_para'     => 'Hamblen County offers affordable residential and commercial land in a growing East Tennessee market. Tennessee Cash For Homes buys Hamblen County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Morristown', 'slug' => 'morristown', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Morristown in Hamblen County?', 'a' => 'Yes. Morristown is the county seat and we actively buy homes throughout Morristown and all of Hamblen County. Whether near the lakefront or in a residential neighborhood, we purchase all types of properties.'],
        ['q' => 'Can I sell a duplex or multi-family property in Hamblen County?', 'a' => 'We buy duplexes, triplexes, and multi-family properties in Hamblen County. Whether occupied or vacant, we will evaluate the property and make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
