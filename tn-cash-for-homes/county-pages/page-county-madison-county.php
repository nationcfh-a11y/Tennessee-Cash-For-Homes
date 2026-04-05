<?php
/**
 * Template Name: County — Madison County
 *
 * WordPress setup:
 *   Slug:     madison-county  (under county-pages/ parent)
 *   Template: County — Madison County
 */

$county = [
    'slug'          => 'madison-county',
    'name'          => 'Madison County',
    'county_id'     => 'madison',
    'h1'            => 'Sell Your House Fast For Cash in Madison County',
    'meta_title'    => 'We Buy Houses in Madison County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Madison County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '132',
    'avg_days'      => '76',
    'desc1'         => 'Madison County is the economic engine of West Tennessee, centered around Jackson -- a city where West Tennessee Healthcare employs over 6,000 people and anchors a Level I Trauma Center serving 21 surrounding counties. From the established neighborhoods near Union University and Lambuth to the newer subdivisions off the Highway 45 Bypass, Madison County home values have climbed steadily as the Jackson MSA posted a 4% quarterly price increase in late 2025, the strongest gain of any Tennessee metro that quarter. Manufacturing, logistics, and education round out a diversified economy that keeps drawing families to neighborhoods like Bemis, North Jackson, and the Old Hickory Mall corridor.',
    'desc2'         => 'Even with rising Madison County home values, selling your house in Madison County through a traditional listing can be a slow process -- homes here average over 80 days on market, more than double the pace from just a year ago. If you are dealing with a property that needs roof work or foundation repairs common in Jackson\'s older housing stock, the cost of getting listing-ready can eat into your equity fast. Cash home buyers in Madison County like Tennessee Cash For Homes eliminate that burden entirely. We buy houses in any condition with no agent commissions, no repair requests, and a closing date you choose.',
    'desc3'         => 'No matter what is happening in your life -- whether you are navigating a divorce, settling an estate, behind on property taxes, or simply ready to move on -- we purchase homes throughout all of Madison County. From downtown Jackson bungalows to rural acreage out past Beech Bluff, our team is ready with a fair, no-obligation cash offer.',
    'land_para'     => 'Madison County\'s strong economy and central West Tennessee location make land a valuable asset. Tennessee Cash For Homes buys Madison County land quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Jackson', 'slug' => 'jackson', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Jackson or the greater Madison County area?', 'a' => 'Yes. Jackson is the largest city in West Tennessee and we actively buy homes throughout Madison County. Whether your home is near downtown Jackson or in the surrounding suburbs, we provide fair cash offers.'],
        ['q' => 'Can I sell a rental property with problem tenants in Madison County?', 'a' => 'We buy rental properties in Madison County regardless of tenant situations. You do not need to evict tenants or wait for leases to end. We handle everything.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
