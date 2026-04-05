<?php
/**
 * Template Name: County — Fayette County
 *
 * WordPress setup:
 *   Slug:     fayette-county  (under county-pages/ parent)
 *   Template: County — Fayette County
 */

$county = [
    'slug'          => 'fayette-county',
    'name'          => 'Fayette County',
    'county_id'     => 'fayette',
    'h1'            => 'Sell Your House Fast For Cash in Fayette County TN',
    'meta_title'    => 'We Buy Houses in Fayette County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Fayette County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$325,000',
    'homes_sold'    => '38',
    'avg_days'      => '80',
    'desc1'         => 'Fayette County has transformed over the past decade from quiet farmland east of Memphis into one of the fastest-growing suburban corridors in the state. Oakland in particular has exploded with new subdivisions like Buckingham Farms, Chapel Creek, and Windsor Place, drawing families who want Shelby County job access with a small-town feel. Somerville, the county seat, retains its historic courthouse square charm while newer neighborhoods spread along Highway 64. Manufacturing and distribution employers anchor the local economy, and Fayette County home values have held steady even as the broader Memphis market has fluctuated.',
    'desc2'         => 'That rapid growth has created a unique challenge in the Fayette County real estate market. Newer homes in Oakland sell relatively quickly, but older properties in Somerville, Rossville, and the rural stretches between can sit for months, especially if they need cosmetic updates or repairs. With homes averaging around 90 days on market countywide and agent commissions eating into already moderate sale prices, a traditional listing is not always the best path. If you want to sell your house in Fayette County without the uncertainty, cash home buyers in Fayette County like us can close in as little as two weeks with no inspections, no staging, and no waiting.',
    'desc3'         => 'No matter what your situation looks like, whether it is a dated ranch home off Highway 196, a property near the Shelby County line that needs foundation work, or a family home in Oakland you have outgrown, Tennessee Cash For Homes purchases houses throughout all of Fayette County in any condition. We handle the details so you can move forward on your terms.',
    'land_para'     => 'Fayette County\'s proximity to Memphis has made land increasingly valuable as development pushes eastward. Tennessee Cash For Homes buys Fayette County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Somerville', 'slug' => 'somerville', 'has_page' => false],
        ['name' => 'Oakland', 'slug' => 'oakland', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is Fayette County part of the Memphis metro area for real estate?', 'a' => 'Yes. Fayette County sits east of Memphis and has seen significant suburban growth. We buy homes throughout Fayette County including Somerville, Oakland, and Piperton, and our offers reflect the area\'s connection to the Memphis market.'],
        ['q' => 'Do you buy new construction or recently built homes in Fayette County?', 'a' => 'We buy homes of all ages in Fayette County, including newer construction. If you need to sell quickly for any reason, we provide cash offers on homes regardless of when they were built.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
