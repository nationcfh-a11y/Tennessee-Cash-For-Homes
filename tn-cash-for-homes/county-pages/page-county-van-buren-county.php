<?php
/**
 * Template Name: County — Van Buren County
 *
 * WordPress setup:
 *   Slug:     van-buren-county  (under county-pages/ parent)
 *   Template: County — Van Buren County
 */

$county = [
    'slug'          => 'van-buren-county',
    'name'          => 'Van Buren County',
    'county_id'     => 'van-buren',
    'h1'            => 'Sell Your House Fast For Cash in Van Buren County TN',
    'meta_title'    => 'We Buy Houses in Van Buren County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Van Buren County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$175,000',
    'homes_sold'    => '6',
    'avg_days'      => '110',
    'desc1'         => 'Van Buren County is a quiet Cumberland Plateau community where Spencer, the county seat with a population around 1,700, serves as the gateway to Fall Creek Falls State Park -- Tennessee\'s largest and most visited state park, drawing over one million visitors each year. The park\'s dramatic waterfalls and gorges have put this small county on the map for vacation homes, homesteads, and investment properties. Despite the tourist draw, Van Buren County maintains a genuinely low cost of living and an unhurried pace of life that appeals to retirees, remote workers, and anyone looking to trade city stress for plateau serenity.',
    'desc2'         => 'The flip side of Van Buren County\'s small size is a real estate market with very limited activity -- only a handful of homes sell in any given month, and properties can linger on the market far longer than the state average. If you need to sell your house in Van Buren County, finding a traditional buyer willing to navigate rural financing and appraisal challenges can be a real test of patience. Cash home buyers in Van Buren County like us remove those obstacles entirely. We understand Van Buren County home values and plateau property conditions, and we provide straightforward cash offers with no agent commissions, no repair demands, and a closing timeline you control.',
    'desc3'         => 'No matter what is driving your decision to sell -- an inherited property near Spencer, a vacation cabin you no longer use, deferred maintenance you cannot afford, or simply a desire to move on -- Tennessee Cash For Homes buys houses throughout all of Van Buren County in any condition. From homes in town to rural properties scattered across the plateau, we are here to help.',
    'land_para'     => 'Van Buren County offers scenic plateau land near Fall Creek Falls State Park at very affordable prices. Tennessee Cash For Homes buys Van Buren County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Spencer', 'slug' => 'spencer', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Spencer or rural Van Buren County?', 'a' => 'Yes. Van Buren County is one of Tennessee\'s least populated counties and we buy homes in Spencer and throughout the county. We specialize in helping homeowners who struggle to sell in small markets.'],
        ['q' => 'Can I sell a property near Fall Creek Falls in Van Buren County?', 'a' => 'We buy properties near Fall Creek Falls State Park and throughout Van Buren County. Whether it is a home, cabin, or rural property, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
