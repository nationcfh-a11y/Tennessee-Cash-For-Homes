<?php
/**
 * Template Name: County — Perry County
 *
 * WordPress setup:
 *   Slug:     perry-county  (under county-pages/ parent)
 *   Template: County — Perry County
 */

$county = [
    'slug'          => 'perry-county',
    'name'          => 'Perry County',
    'county_id'     => 'perry',
    'h1'            => 'Sell Your House Fast For Cash in Perry County TN',
    'meta_title'    => 'We Buy Houses in Perry County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Perry County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$198,000',
    'homes_sold'    => '9',
    'avg_days'      => '112',
    'desc1'         => 'Perry County is one of Tennessee\'s most rural and sparsely populated counties, with just over 8,000 residents spread across rolling hills and river bottoms along the Buffalo River. Linden, the county seat, sits at the crossroads of US 412 and State Route 13, serving as the hub for a community rooted in agriculture, forestry, and outdoor tourism. The Buffalo River meanders more than 43 miles through the county, drawing paddlers and anglers year-round. After years without a local hospital, the recent reopening of Perry Community Hospital in 2025 brought renewed optimism to a county that has long valued self-reliance.',
    'desc2'         => 'Selling a home in Perry County through traditional channels can be a real test of patience. With one of the smallest buyer pools in the state and average days on market stretching well past 100, listings here can sit for months without a serious offer. Meanwhile, property taxes, insurance, and upkeep continue to add up. If you want to sell your house in Perry County without the long wait, we provide a direct cash offer with no agent fees, no repair requirements, and a closing date that fits your needs.',
    'desc3'         => 'Whatever your situation may be, whether you have inherited a family property in Linden, own a cabin along the Buffalo River that you no longer use, or are dealing with a home that needs more work than you can take on, we buy houses throughout all of Perry County in any condition. Tennessee Cash For Homes understands the unique challenges of selling in a small rural market and we are here to make the process simple.',
    'land_para'     => 'Perry County offers exceptional rural land along the Buffalo River corridor including wooded tracts, river access properties, and farmland. Tennessee Cash For Homes buys Perry County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Linden', 'slug' => 'linden', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Linden or rural Perry County?', 'a' => 'Yes. Perry County is one of Tennessee\'s more rural and less populated counties. We buy homes in Linden and throughout Perry County regardless of the challenges that come with a smaller market.'],
        ['q' => 'Can I sell a property along the Buffalo River in Perry County?', 'a' => 'We buy properties along the Buffalo River and throughout Perry County. Whether it is a home, cabin, or vacant land, we will evaluate the property and make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
