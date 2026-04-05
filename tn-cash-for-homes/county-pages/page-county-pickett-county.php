<?php
/**
 * Template Name: County — Pickett County
 *
 * WordPress setup:
 *   Slug:     pickett-county  (under county-pages/ parent)
 *   Template: County — Pickett County
 */

$county = [
    'slug'          => 'pickett-county',
    'name'          => 'Pickett County',
    'county_id'     => 'pickett',
    'h1'            => 'Sell Your House Fast For Cash in Pickett County TN',
    'meta_title'    => 'We Buy Houses in Pickett County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Pickett County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '6',
    'avg_days'      => '112',
    'desc1'         => 'Pickett County is the least populous county in Tennessee, home to roughly 5,000 residents in and around Byrdstown along the Kentucky border. What the county lacks in population it makes up for in natural beauty, with Dale Hollow Lake providing world-class smallmouth bass fishing and drawing thousands of vacationers each year to the resorts and marinas that line its shores. Manufacturing and healthcare are the largest local employers, supporting about 800 jobs between them. With a homeownership rate above 83 percent, most families here have deep roots and long ties to their property.',
    'desc2'         => 'The Pickett County real estate market moves slowly by any measure. With only a handful of home sales each month and a limited buyer pool, selling through a traditional listing can mean waiting six months or longer. For owners who need to sell a home in Pickett County on a shorter timeline, that reality is frustrating. Cash home buyers in Pickett County like us offer a practical alternative. We make a fair offer quickly, buy as-is with no inspections or repair demands, and close on your schedule so you can move forward without the uncertainty.',
    'desc3'         => 'No matter what your situation looks like, whether you own a lakefront cabin on Dale Hollow that needs updating, a family home in Byrdstown you have inherited, or a vacant property you are tired of maintaining from a distance, we buy houses throughout all of Pickett County in any condition. Tennessee Cash For Homes works with sellers across Tennessee\'s smallest communities, and we understand the unique challenges that come with a rural market.',
    'land_para'     => 'Pickett County offers affordable lakefront land on Dale Hollow Lake and scenic rural acreage. Tennessee Cash For Homes buys Pickett County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Byrdstown', 'slug' => 'byrdstown', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is it possible to sell a home quickly in Tennessee\'s smallest counties like Pickett County?', 'a' => 'Pickett County has a very small population, which makes traditional home sales extremely difficult. We buy homes directly for cash in Byrdstown and throughout Pickett County, eliminating the need to wait months or years for a buyer.'],
        ['q' => 'Do you buy properties near Dale Hollow Lake in Pickett County?', 'a' => 'Yes. Dale Hollow Lake is Pickett County\'s biggest attraction. We buy lakefront homes, cabins, and all types of properties in the Dale Hollow area.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
