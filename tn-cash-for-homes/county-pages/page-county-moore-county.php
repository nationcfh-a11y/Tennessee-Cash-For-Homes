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
    'desc1'         => 'Moore County is Tennessee\'s smallest county by population, best known as the home of Lynchburg and the Jack Daniel\'s Distillery. Despite its small size, the county draws visitors from around the world and offers charming small town living. Tennessee Cash For Homes buys houses across all of Moore County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, are looking to downsize, or need to sell quickly we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
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
