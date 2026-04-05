<?php
/**
 * Template Name: County - Henry County
 *
 * WordPress setup:
 *   Slug:     henry-county  (under county-pages/ parent)
 *   Template: County - Henry County
 */

$county = [
    'slug'          => 'henry-county',
    'name'          => 'Henry County',
    'county_id'     => 'henry',
    'h1'            => 'Sell Your House Fast For Cash in Henry County TN',
    'meta_title'    => 'We Buy Houses in Henry County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Henry County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '28',
    'avg_days'      => '92',
    'desc1'         => 'Henry County borders Kentucky to the north and wraps around the shores of Kentucky Lake, one of the largest man-made lakes in the eastern United States. Paris, the county seat, proudly calls itself the capital city of Kentucky Lake and celebrates that identity with a 70-foot replica of the Eiffel Tower in its downtown park. The local economy is supported by healthcare at Henry County Hospital, manufacturing at employers like Dana Inc. and Tosh Farms, and a strong tourism sector driven by fishing, boating, and the Paris Landing State Park area. The Henry County real estate market ranges from affordable starter homes in Paris to lakefront properties that can exceed $600,000, creating a diverse landscape for both residents and investors.',
    'desc2'         => 'That wide range in property types means selling in Henry County can be unpredictable. Lakefront homes attract seasonal interest, but in-town properties and older homes in Paris can sit on the market for 90 days or more, especially when they need updates. Vacation cabins and second homes that have been sitting empty present their own challenges with deferred maintenance and limited buyer appeal outside of peak season. If you need to sell your house in Henry County, whether it is a lake cottage or a home in town, cash home buyers in Henry County like Tennessee Cash For Homes skip the complications entirely. We buy as-is, handle closing costs, and let you set the timeline.',
    'desc3'         => 'From waterfront properties near Paris Landing to homes in the neighborhoods of Paris, rural houses outside Puryear, or cabins tucked along the lakeshore, we buy houses throughout all of Henry County in any condition. Regardless of whether you are dealing with an inherited lake house, a property with a lien, or a home you simply need to move on from, our team provides a fair cash offer and a process designed to be as easy as possible.',
    'land_para'     => 'Henry County offers sought after lakefront land on Kentucky Lake along with affordable farmland and rural acreage. Tennessee Cash For Homes buys Henry County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Paris', 'slug' => 'paris', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes or lake properties near Paris Landing in Henry County?', 'a' => 'Yes. Henry County is home to Kentucky Lake and Paris Landing State Park. We buy lakefront homes, cabins, and all residential properties throughout Henry County including Paris.'],
        ['q' => 'Can I sell a property in Henry County if it has a lien on it?', 'a' => 'We buy properties in Henry County with liens, judgments, or other encumbrances. Our team works with the title company to resolve these issues at closing.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
