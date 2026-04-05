<?php
/**
 * Template Name: County — Monroe County
 *
 * WordPress setup:
 *   Slug:     monroe-county  (under county-pages/ parent)
 *   Template: County — Monroe County
 */

$county = [
    'slug'          => 'monroe-county',
    'name'          => 'Monroe County',
    'county_id'     => 'monroe',
    'h1'            => 'Sell Your House Fast For Cash in Monroe County TN',
    'meta_title'    => 'We Buy Houses in Monroe County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Monroe County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '34',
    'avg_days'      => '86',
    'desc1'         => 'Monroe County stretches from the fertile valley towns of Madisonville and Sweetwater up into the Cherokee National Forest and the foothills of the Great Smoky Mountains. Tellico Lake draws retirees and second-home buyers to Vonore, where lakefront properties can top $750,000, while Madisonville and Sweetwater offer starter and family homes in the $200,000 to $350,000 range. Tellico Plains, tucked against the mountains at the end of the Cherohala Skyway, has its own quiet appeal. Monroe County home values climbed over 9% year-over-year in late 2025, and the county saw nearly double the number of home sales compared to the prior year -- a sign of growing demand across this diverse real estate market.',
    'desc2'         => 'Despite that momentum, the Monroe County real estate market is not equally strong everywhere. Homes are now averaging around 90 days on market, up sharply from the prior year, and properties that need work -- especially mountain cabins with deferred maintenance or older homes in Sweetwater\'s historic blocks -- can struggle to attract financed buyers. If you need to sell your house in Monroe County without investing in repairs or waiting out a slow listing period, a cash offer from Tennessee Cash For Homes lets you move forward on your own timeline. No agent commissions, no appraisal contingencies, no drawn-out negotiations.',
    'desc3'         => 'We buy houses throughout all of Monroe County regardless of your situation or the property\'s condition. Whether you own a lakefront home on Tellico that needs a new dock, a family house in Madisonville you inherited, or a mountain retreat in Tellico Plains you are ready to let go of, we will make you a fair cash offer with zero obligation. Every property and every situation gets our full attention.',
    'land_para'     => 'Monroe County offers lakefront land on Tellico Lake, mountain tracts near the Cherokee National Forest, and rural farmland. Tennessee Cash For Homes buys Monroe County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Madisonville', 'slug' => 'madisonville', 'has_page' => false],
        ['name' => 'Sweetwater', 'slug' => 'sweetwater', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Madisonville, Sweetwater, or Tellico Plains in Monroe County?', 'a' => 'Yes. We buy homes throughout Monroe County including Madisonville, Sweetwater, Tellico Plains, and Vonore. All property types and conditions are welcome.'],
        ['q' => 'Can I sell a mountain property or cabin in Monroe County?', 'a' => 'Monroe County borders the Cherokee National Forest and we buy mountain cabins, homes, and properties throughout the county. Remote or hard-to-access properties are fine.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
