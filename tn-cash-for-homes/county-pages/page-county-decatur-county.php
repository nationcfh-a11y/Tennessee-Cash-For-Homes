<?php
/**
 * Template Name: County — Decatur County
 *
 * WordPress setup:
 *   Slug:     decatur-county  (under county-pages/ parent)
 *   Template: County — Decatur County
 */

$county = [
    'slug'          => 'decatur-county',
    'name'          => 'Decatur County',
    'county_id'     => 'decatur',
    'h1'            => 'Sell Your House Fast For Cash in Decatur County TN',
    'meta_title'    => 'We Buy Houses in Decatur County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Decatur County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$165,000',
    'homes_sold'    => '11',
    'avg_days'      => '108',
    'desc1'         => 'Decatur County is a quiet Tennessee River community where the water has shaped life for generations. The Tennessee River forms the county\'s eastern and southern borders, creating a sportsman\'s paradise for fishing, boating, and waterskiing that draws seasonal visitors and second-home owners alike. Parsons, a small river town of just over 2,000 people, and Decaturville serve as the county\'s main communities, supported by employers in healthcare -- including Decatur County Health Care and Tennessee Health Management -- and light manufacturing. Agriculture remains a foundation of the local economy, with cotton, corn, and soybean operations dotting the landscape. Nearby Natchez Trace State Park adds another draw for outdoor recreation. Decatur County home values remain among the most affordable in the state, reflecting the area\'s rural pace and limited commercial development.',
    'desc2'         => 'Selling your house in Decatur County can be one of the most challenging real estate experiences in Tennessee. With only about 11 homes selling per month and properties averaging 108 days on market -- some in Decaturville sitting for over 180 days -- the buyer pool is thin and financing obstacles are real. Waterfront properties may attract seasonal interest, but in-town homes and rural residences often struggle to find qualified buyers. Older housing stock, delinquent property taxes, and the difficulties of appraising homes in a low-volume market all add friction to traditional sales. As cash home buyers in Decatur County, we bypass every one of those hurdles -- no appraisals, no lender delays, and no repair requirements.',
    'desc3'         => 'From a riverfront property along the Tennessee River to a home in Parsons or Decaturville, Tennessee Cash For Homes buys houses throughout all of Decatur County in any condition. Whether you are dealing with back taxes, an inherited property, or simply need to sell, we make the process simple and fair.',
    'land_para'     => 'Decatur County offers affordable rural land along the Tennessee River including riverfront tracts, farmland, and wooded acreage. Tennessee Cash For Homes buys Decatur County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Decaturville', 'slug' => 'decaturville', 'has_page' => false],
        ['name' => 'Parsons', 'slug' => 'parsons', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties near the Tennessee River in Decatur County?', 'a' => 'Yes. Decatur County runs along the Tennessee River and we buy properties throughout the county including Decaturville, Parsons, and riverfront areas. Waterfront or rural, we purchase all types.'],
        ['q' => 'Can I sell a home in Decatur County if I owe back taxes?', 'a' => 'We buy homes in Decatur County even if there are delinquent property taxes. We can work with you to resolve tax issues as part of the closing process.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
