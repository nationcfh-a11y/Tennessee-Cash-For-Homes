<?php
/**
 * Template Name: County - Giles County
 *
 * WordPress setup:
 *   Slug:     giles-county  (under county-pages/ parent)
 *   Template: County - Giles County
 */

$county = [
    'slug'          => 'giles-county',
    'name'          => 'Giles County',
    'county_id'     => 'giles',
    'h1'            => 'Sell Your House Fast For Cash in Giles County TN',
    'meta_title'    => 'We Buy Houses in Giles County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Giles County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '24',
    'avg_days'      => '88',
    'desc1'         => 'Giles County sits in the rolling hills of southern Middle Tennessee along the Alabama border, with Pulaski as its county seat and commercial center. The area has built a remarkably strong manufacturing base, with more than 40 manufacturers including Fortune 500 companies choosing Giles County for its skilled workforce and favorable business climate. Smaller communities like Lynnville, Elkton, and Minor Hill add to the county\'s rural character, and agriculture, particularly soybeans, corn, and cattle, remains a vital part of the local economy. Housing and land costs are well below state averages, making Giles County attractive to homeowners who want more space for less money.',
    'desc2'         => 'While the cost of living is low, selling a home in Giles County through traditional channels can be a slow and uncertain process. The local market has a notable share of older homes that need significant updates, and many listings are priced optimistically relative to their condition. With a vacancy rate above 11 percent and homes often sitting for close to 90 days, sellers who need to move quickly, especially those managing an inherited property or dealing with deferred maintenance, can find themselves stuck. Cash home buyers in Giles County like Tennessee Cash For Homes eliminate that uncertainty. We buy as-is, skip the inspections, and let you choose the closing date when you sell your house in Giles County.',
    'desc3'         => 'From a historic home near the Pulaski square to a rural property along Elkton Pike to a manufactured home outside Minor Hill, Tennessee Cash For Homes buys houses throughout all of Giles County in any condition. Whatever situation has brought you here, we are ready to make you a fair cash offer and handle the rest.',
    'land_para'     => 'Giles County offers beautiful rolling farmland and rural residential tracts in Southern Middle Tennessee. Tennessee Cash For Homes buys Giles County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Pulaski', 'slug' => 'pulaski', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Pulaski or other towns in Giles County?', 'a' => 'Yes. We buy homes throughout Giles County including Pulaski, Lynnville, Elkton, and Minor Hill. Town or country, we purchase properties in any condition.'],
        ['q' => 'Can I sell a historic home in Giles County?', 'a' => 'We buy historic homes in Giles County regardless of the restoration work they may need. You do not need to worry about historic preservation requirements when selling to us.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
