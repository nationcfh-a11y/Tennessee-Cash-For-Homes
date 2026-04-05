<?php
/**
 * Template Name: County — Knox County
 *
 * WordPress setup:
 *   Slug:     knox-county  (under county-pages/ parent)
 *   Template: County — Knox County
 */

$county = [
    'slug'          => 'knox-county',
    'name'          => 'Knox County',
    'county_id'     => 'knox',
    'h1'            => 'Sell Your House Fast For Cash in Knox County',
    'meta_title'    => 'We Buy Houses in Knox County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Knox County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$355,000',
    'homes_sold'    => '342',
    'avg_days'      => '62',
    'desc1'         => 'Knox County is the beating heart of East Tennessee, home to Knoxville and a metropolitan area that continues to attract thousands of new residents each year from high-cost states like California, New York, and Illinois. The University of Tennessee fuels both the economy and the culture here, while major employers in healthcare, advanced manufacturing, and logistics keep the job market strong. From the historic Victorian homes of Fourth and Gill to the mid-century estates along Sequoyah Hills, the tree-lined streets of West Hills, the revitalized urban energy of the Old City, and the rapidly growing suburbs of Farragut and Powell, Knox County home values reflect a market that has seen steady appreciation driven by genuine demand.',
    'desc2'         => 'In a competitive Knox County real estate market where homes still move relatively quickly, you might wonder why anyone would choose a cash sale. The truth is that many sellers face situations where a traditional listing does not make sense -- a property near the UT campus that needs significant updates, a South Knoxville home with deferred maintenance, or a rental property in North Knoxville that has become more hassle than it is worth. Agent commissions on a median-priced Knox County home can easily exceed $20,000, and the weeks of showings, inspections, and buyer negotiations add stress that many sellers simply do not need. Cash home buyers in Knox County like Tennessee Cash For Homes offer a direct alternative: a fair offer, no repair requirements, and a closing date you choose.',
    'desc3'         => 'Regardless of your circumstances -- whether you are downsizing from a family home in Bearden, handling an estate in Halls Crossroads, or walking away from a property that needs more work than you can take on -- we buy houses throughout all of Knox County in any condition. From downtown Knoxville to Farragut, Powell, Karns, and every neighborhood in between, Tennessee Cash For Homes is ready to make you a no-obligation cash offer today.',
    'land_para'     => 'Knox County\'s growing population and strong economy have driven land values up across the county. Tennessee Cash For Homes buys Knox County land quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Knoxville', 'slug' => 'knoxville', 'has_page' => true],
        ['name' => 'Farragut', 'slug' => 'farragut', 'has_page' => false],
        ['name' => 'Powell', 'slug' => 'powell', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'How does Knoxville\'s real estate market in Knox County affect your offers?', 'a' => 'Knox County and Knoxville have a strong and growing real estate market. Our cash offers are based on current market conditions and comparable sales in the area. You get a fair offer without the hassle of listing, staging, and waiting for buyers.'],
        ['q' => 'Do you buy homes near the University of Tennessee in Knox County?', 'a' => 'Yes. We buy homes in all Knoxville neighborhoods including the UT campus area, West Knoxville, South Knoxville, Farragut, and Powell. Student housing, rental properties, and family homes are all welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
