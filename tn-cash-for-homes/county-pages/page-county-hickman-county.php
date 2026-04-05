<?php
/**
 * Template Name: County - Hickman County
 *
 * WordPress setup:
 *   Slug:     hickman-county  (under county-pages/ parent)
 *   Template: County - Hickman County
 */

$county = [
    'slug'          => 'hickman-county',
    'name'          => 'Hickman County',
    'county_id'     => 'hickman',
    'h1'            => 'Sell Your House Fast For Cash in Hickman County TN',
    'meta_title'    => 'We Buy Houses in Hickman County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hickman County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$249,000',
    'homes_sold'    => '22',
    'avg_days'      => '91',
    'desc1'         => 'Hickman County has quietly become one of Middle Tennessee\'s most appealing rural counties for people seeking affordable land and a slower pace of life within reach of Nashville. With a population that has grown steadily since the 1990s and now sits above 25,000, the county is part of the Nashville metropolitan statistical area, and over a thousand residents make the 35-minute average commute to Davidson County for work. Centerville, the county seat, anchors the community with employers like Ascension St. Thomas Hickman Hospital and Agrana Fruit, while the surrounding countryside of Lyles, Bon Aqua, and Nunnelly draws homesteaders, small farmers, and remote workers drawn by the county\'s expanding fiber internet access.',
    'desc2'         => 'Rising home prices in Nashville, Williamson, and Dickson counties have pushed more buyers into Hickman County, but the local market still moves at its own pace. Many properties here are older homes on large lots or rural acreage with wells and septic systems that traditional buyers find intimidating. Hickman County home values have been climbing, yet sellers dealing with deferred maintenance, difficult road access, or unique rural properties can struggle to find qualified buyers. If you want to sell your house in Hickman County without waiting months or spending money on updates, cash home buyers in Hickman County like Tennessee Cash For Homes offer a direct sale with no agent fees and no repair requirements.',
    'desc3'         => 'Whether you own a home in Centerville, a cabin near the Duck River, a farmhouse in Lyles, or a property on a gravel road deep in the county, we buy houses throughout all of Hickman County in any condition. Whatever your circumstances, from an inherited property to a home that needs more work than it is worth investing in, we are here to provide a fair cash offer and a closing process that works on your terms.',
    'land_para'     => 'Hickman County offers beautiful rural land including wooded tracts, farmland, and residential lots at affordable prices. Tennessee Cash For Homes buys Hickman County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Centerville', 'slug' => 'centerville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy rural homes on acreage in Hickman County?', 'a' => 'Yes. Hickman County is one of Middle Tennessee\'s most rural counties and we regularly buy homes on large lots and acreage. Properties in Centerville, Lyles, and all unincorporated areas are welcome.'],
        ['q' => 'Can I sell a property in Hickman County if the road access is poor?', 'a' => 'We buy properties in Hickman County regardless of road conditions, access issues, or remote locations. Our team evaluates every property on its own merits.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
