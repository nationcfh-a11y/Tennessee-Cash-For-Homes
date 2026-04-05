<?php
/**
 * Template Name: County — Moore County
 *
 * WordPress setup:
 *   Slug:     moore-county  (under county-pages/ parent)
 *   Template: County — Moore County
 */

$county = [
    'slug'          => 'moore-county',
    'name'          => 'Moore County',
    'county_id'     => 'moore',
    'h1'            => 'Sell Your House Fast For Cash in Moore County TN',
    'meta_title'    => 'We Buy Houses in Moore County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Moore County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$285,000',
    'homes_sold'    => '6',
    'avg_days'      => '92',
    'desc1'         => 'Moore County is one of the most distinctive places in Tennessee -- a county of just 6,400 residents that happens to be home to the oldest registered distillery in the United States. Jack Daniel\'s is the county\'s largest employer and economic engine, drawing over 250,000 visitors annually to Lynchburg\'s town square, which has remained remarkably well-preserved with its courthouse, iron-front storefronts, and locally owned shops. In a characteristic bit of Tennessee irony, Moore County is officially dry, even as the world\'s most famous whiskey is produced here. Moore County home values range widely -- from modest homes in the $160,000s to multi-acre properties near Tims Ford Lake that can reach well over $500,000.',
    'desc2'         => 'With only about six homes changing hands in a typical month, the Moore County real estate market is one of the smallest and slowest in the state. That means sellers face a genuine challenge: limited buyer traffic, long wait times, and few comparable sales to anchor pricing. If you need to sell your house in Moore County and do not want to gamble on when the right buyer will come along, a cash sale offers certainty that a traditional listing simply cannot. Tennessee Cash For Homes buys houses in Moore County regardless of condition -- no repairs, no agent commissions, and no months of waiting.',
    'desc3'         => 'Whether you have inherited a family home near the Lynchburg square, own a rural property outside town that needs significant work, or are ready to downsize from acreage you no longer maintain, we buy houses throughout all of Moore County. Every situation is different, and we approach each one with a fair offer and zero pressure to accept.',
    'land_para'     => 'Moore County offers scenic rural land and small acreage tracts in one of Tennessee\'s most iconic communities. Tennessee Cash For Homes buys Moore County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Lynchburg', 'slug' => 'lynchburg', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Lynchburg or rural Moore County?', 'a' => 'Yes. Moore County is Tennessee\'s smallest county and we buy homes in Lynchburg and throughout the county. Small market size does not affect our ability to make you a fair cash offer.'],
        ['q' => 'Can I sell a property in Moore County near the Jack Daniel\'s Distillery?', 'a' => 'We buy properties throughout Moore County including Lynchburg. Whether your home is near the famous distillery or in the surrounding countryside, we are interested.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
