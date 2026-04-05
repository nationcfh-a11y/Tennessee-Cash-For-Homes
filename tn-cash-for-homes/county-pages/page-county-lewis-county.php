<?php
/**
 * Template Name: County — Lewis County
 *
 * WordPress setup:
 *   Slug:     lewis-county  (under county-pages/ parent)
 *   Template: County — Lewis County
 */

$county = [
    'slug'          => 'lewis-county',
    'name'          => 'Lewis County',
    'county_id'     => 'lewis',
    'h1'            => 'Sell Your House Fast For Cash in Lewis County TN',
    'meta_title'    => 'We Buy Houses in Lewis County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Lewis County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$219,000',
    'homes_sold'    => '14',
    'avg_days'      => '98',
    'desc1'         => 'Lewis County is a small, distinctive community about 80 miles southwest of Nashville, centered around Hohenwald -- a town whose name means "high forest" in German, reflecting the Swiss and German settlers who shaped its early character. Today the county is perhaps best known as home to The Elephant Sanctuary, the largest African and Asian elephant refuge in the country, where visitors can learn about the residents at the downtown Elephant Discovery Center. The Natchez Trace Parkway cuts through the county, bringing tourists to the Meriwether Lewis National Monument and providing a scenic corridor that connects Lewis County to Nashville and points south. The local economy relies on a mix of textile manufacturing, rubber hose production, and boot-making factories, along with the steady tourist traffic the Trace generates.',
    'desc2'         => 'Lewis County home values remain among the most affordable in Middle Tennessee, but that affordability comes with a tradeoff for sellers: a very small buyer pool. With only a handful of homes selling each month, properties can sit on the market for well over three months, and many of the older homes in Hohenwald and the surrounding countryside need substantial work that traditional buyers are reluctant to take on. Agent commissions and carrying costs -- property taxes, insurance, maintenance -- add up quickly when a home is not moving. Cash home buyers in Lewis County like Tennessee Cash For Homes offer a direct solution: we buy your property as-is, handle our own due diligence, and close on your schedule without the fees and delays of a conventional sale.',
    'desc3'         => 'Regardless of why you need to sell -- an inherited property you cannot manage from out of town, a home that has been sitting vacant, financial pressure, or any other life circumstance -- we buy houses throughout all of Lewis County in any condition. From Hohenwald to Summertown and the rural stretches along the Natchez Trace, Tennessee Cash For Homes is ready to provide a fair cash offer with zero obligation.',
    'land_para'     => 'Lewis County offers peaceful rural land including farmland, wooded acreage, and undeveloped lots at very competitive prices. Tennessee Cash For Homes buys Lewis County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Hohenwald', 'slug' => 'hohenwald', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Hohenwald or rural Lewis County?', 'a' => 'Yes. We purchase homes throughout Lewis County including Hohenwald and all surrounding rural areas. Lewis County\'s small market size is not a barrier for us.'],
        ['q' => 'Can I sell a property in Lewis County near the Meriwether Lewis Monument?', 'a' => 'We buy homes and properties throughout Lewis County including areas near the Natchez Trace Parkway and Meriwether Lewis Monument. Location within the county does not matter.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
