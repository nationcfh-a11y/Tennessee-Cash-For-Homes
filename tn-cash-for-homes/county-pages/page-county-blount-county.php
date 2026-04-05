<?php
/**
 * Template Name: County - Blount County
 *
 * WordPress setup:
 *   Slug:     blount-county  (under county-pages/ parent)
 *   Template: County - Blount County
 */

$county = [
    'slug'          => 'blount-county',
    'name'          => 'Blount County',
    'county_id'     => 'blount',
    'h1'            => 'Sell Your House Fast For Cash in Blount County TN',
    'meta_title'    => 'We Buy Houses in Blount County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Blount County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$365,000',
    'homes_sold'    => '112',
    'avg_days'      => '72',
    'desc1'         => 'Blount County is one of East Tennessee\'s most sought-after places to live, anchored by Maryville and Alcoa and bordered by the Great Smoky Mountains National Park to the south. The county\'s economy is powered by over 100 manufacturing plants, led by major employers like Arconic, Denso Manufacturing, and Blount Memorial Hospital. Neighborhoods range from the dense suburban feel of Maryville - where families and young professionals drive steady demand - to the Springbrook and Vose areas of Alcoa, the quiet community of Friendsville, and the gateway town of Townsend at the edge of the Smokies. Blount County home values have climbed steadily, with the average now approaching $380,000, and the market consistently favors sellers with homes moving in roughly 50 to 55 days.',
    'desc2'         => 'Even in a strong seller\'s market, not every Blount County homeowner is in a position to list traditionally. Preparing a home for showings, managing inspections, and waiting weeks for a buyer\'s financing to clear can be stressful - especially if you are dealing with storm damage common in the foothills, a property that needs significant updates, or a situation that requires a fast closing. Cash home buyers in Blount County like us offer a direct alternative. We buy homes as-is across the county, from older ranches near downtown Maryville to mountain properties outside Townsend, and we close on your timeline without agent commissions or repair negotiations. If you want to sell your house in Blount County without the hassle of the traditional process, we are ready to make a fair offer.',
    'desc3'         => 'No matter what has brought you to this point - relocation, divorce, financial pressure, an inherited property, or a house that simply needs more work than you want to invest - Tennessee Cash For Homes purchases homes throughout all of Blount County in any condition. From Alcoa and Louisville to Rockford and the mountain communities, we buy houses so you can move forward on your terms.',
    'land_para'     => 'Blount County land is highly sought after for its mountain views and proximity to the Smokies. Tennessee Cash For Homes buys Blount County land quickly with no commissions, no surveys required, and flexible closing.',
    'cities'        => [
        ['name' => 'Maryville', 'slug' => 'maryville', 'has_page' => false],
        ['name' => 'Alcoa', 'slug' => 'alcoa', 'has_page' => false],
        ['name' => 'Townsend', 'slug' => 'townsend', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes near the Great Smoky Mountains in Blount County?', 'a' => 'Yes. Blount County borders the Great Smoky Mountains National Park, and we buy homes throughout the county including Maryville, Alcoa, and Townsend. Whether it is a primary residence or a mountain getaway, we are interested.'],
        ['q' => 'Can I sell a property in Blount County that needs major repairs after storm damage?', 'a' => 'Absolutely. Blount County properties can face weather-related damage from storms moving through the foothills. We buy storm-damaged homes as-is with no repairs needed on your part.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
