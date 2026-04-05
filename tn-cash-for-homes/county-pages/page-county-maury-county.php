<?php
/**
 * Template Name: County - Maury County
 *
 * WordPress setup:
 *   Slug:     maury-county  (under county-pages/ parent)
 *   Template: County - Maury County
 */

$county = [
    'slug'          => 'maury-county',
    'name'          => 'Maury County',
    'county_id'     => 'maury',
    'h1'            => 'Sell Your House Fast For Cash in Maury County',
    'meta_title'    => 'We Buy Houses in Maury County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Maury County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$367,500',
    'homes_sold'    => '49',
    'avg_days'      => '96',
    'desc1'         => 'Maury County is the fastest-growing county in Tennessee, and the numbers tell the story. General Motors and LG Energy Solution invested $2.3 billion in an Ultium Cells battery plant in Spring Hill, creating over 1,300 manufacturing jobs on top of GM\'s existing assembly operations. Columbia\'s historic downtown along the Duck River is experiencing a renaissance of restaurants and shops, while nearly 6,000 new rooftops are planned across the county. The population has surged past 96,000, and Maury County home values now reflect that demand - median prices have climbed to around $415,000, though that is still roughly 30% below Nashville and less than half of neighboring Williamson County.',
    'desc2'         => 'Rapid growth means opportunity, but it also creates complications for sellers. Average days on market in Maury County have stretched past 90, and homes that need cosmetic or structural work often get passed over in favor of new construction in Spring Hill or the Saturn Parkway corridor. If your property in the older neighborhoods of Columbia, along Hampshire Pike, or out toward Santa Fe does not show like a model home, a traditional listing can drag on for months. Cash home buyers in Maury County like Tennessee Cash For Homes skip the hassle entirely - no staging, no inspections, no agent commissions.',
    'desc3'         => 'We understand that life does not always wait for the perfect market conditions. Whether you are a longtime Columbia resident ready to downsize, a military family relocating from the area, or managing an inherited property in Mount Pleasant, we buy houses throughout all of Maury County in any condition. Our cash offers are fair, fast, and come with absolutely no obligation.',
    'land_para'     => 'Maury County\'s growing popularity among homebuyers and businesses has made land ownership more valuable than ever. Tennessee Cash For Homes buys Maury County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Columbia',    'slug' => 'columbia',    'has_page' => true],
        ['name' => 'Spring Hill', 'slug' => 'spring-hill', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'How is the real estate market in Columbia and Maury County right now?', 'a' => 'Maury County is one of Tennessee\'s fastest-growing counties, driven by major employers and Nashville spillover. Our cash offers reflect this strong market. Selling to us means you can capitalize on the growth without the hassle of listing.'],
        ['q' => 'Do you buy homes affected by new development in Maury County?', 'a' => 'Yes. Rapid development in Maury County has created unique situations for existing homeowners. Whether your neighborhood is changing or you want to sell ahead of construction, we buy homes in any situation.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
