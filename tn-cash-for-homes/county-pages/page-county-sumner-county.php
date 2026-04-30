<?php
/**
 * Template Name: County - Sumner County
 *
 * WordPress setup:
 *   Slug:     sumner-county  (under county-pages/ parent)
 *   Template: County - Sumner County
 */

$county = [
    'slug'          => 'sumner-county',
    'name'          => 'Sumner County',
    'county_id'     => 'sumner',
    'h1'            => 'Sell Your House Fast For Cash in Sumner County',
    'meta_title'    => 'We Buy Houses in Sumner County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Sumner County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$511,900',
    'homes_sold'    => '68',
    'avg_days'      => '93',
    'desc1'         => 'Sumner County is one of Nashville\'s most desirable suburban counties, shaped by the shores of Old Hickory Lake - one of the top ten most-visited Army Corps lakes in the entire country. Hendersonville, the county\'s largest city, was transformed by the lake\'s creation in the 1950s and has been attracting families, professionals, and retirees ever since. Gallatin has emerged as a commercial and healthcare hub to the northeast, while White House and Westmoreland offer more affordable entry points into the county. Sumner County home values climbed over 6 percent last year, with a median sale price around $442,000, and Hendersonville\'s lakeside neighborhoods consistently rank among Middle Tennessee\'s most sought-after addresses.',
    'desc2'         => 'Strong appreciation is great for equity, but it also means the cost of holding an unwanted property in the Sumner County real estate market adds up quickly - and homes are averaging 89 days on market, up from 78 a year ago. Lakefront homes can carry seawall, dock, and flood insurance complications that make traditional buyers cautious. Older homes in Gallatin\'s established neighborhoods often need updates that stretch renovation budgets. If you want to sell your house in Sumner County without the drawn-out listing cycle, the repair requests, and the agent commissions, cash home buyers in Sumner County like Tennessee Cash For Homes offer a simpler path - one fair offer, no contingencies, and a closing date you control.',
    'desc3'         => 'Whether you own a lakefront property on Old Hickory Lake, a family home in Gallatin, a starter house in Westmoreland, or a residence anywhere else across Sumner County, we buy houses in any condition and any situation. Contact us today for a no-obligation cash offer and move forward on your own timeline.',
    'land_para'     => 'Sumner County\'s scenic lakeside living and booming population have made land a valuable asset. Tennessee Cash For Homes helps Sumner County landowners sell quickly with no commissions or delays.',
    'cities'        => [
        ['name' => 'Hendersonville', 'slug' => 'hendersonville', 'has_page' => true],
        ['name' => 'Gallatin',       'slug' => 'gallatin',       'has_page' => true],
        ['name' => 'White House',    'slug' => 'white-house',    'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is Sumner County considered part of the Nashville metro for home values?', 'a' => 'Yes. Sumner County is one of Nashville\'s most desirable suburban counties. Our cash offers for Gallatin, Hendersonville, and surrounding areas reflect strong Nashville-area market values.'],
        ['q' => 'Do you buy lakefront homes on Old Hickory Lake in Sumner County?', 'a' => 'We buy lakefront properties on Old Hickory Lake and throughout Sumner County. Whether your home needs dock repairs, has an aging seawall, or is in perfect condition, we are interested.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
