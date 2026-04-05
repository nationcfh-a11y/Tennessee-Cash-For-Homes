<?php
/**
 * Template Name: County - McNairy County
 *
 * WordPress setup:
 *   Slug:     mcnairy-county  (under county-pages/ parent)
 *   Template: County - McNairy County
 */

$county = [
    'slug'          => 'mcnairy-county',
    'name'          => 'McNairy County',
    'county_id'     => 'mcnairy',
    'h1'            => 'Sell Your House Fast For Cash in McNairy County TN',
    'meta_title'    => 'We Buy Houses in McNairy County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in McNairy County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '18',
    'avg_days'      => '96',
    'desc1'         => 'McNairy County is a tight-knit community in southwest Tennessee where small-town values and affordable living define everyday life. Selmer, the county seat, anchors the local economy with a healthy downtown and more manufacturing employment per capita than most neighboring towns. Adamsville to the west carries its own identity, long associated with the legacy of Sheriff Buford Pusser and the Walking Tall story that put McNairy County on the map. With home prices among the lowest in the state - fixer-uppers starting around $30,000 and renovated cottages in the $75,000 to $150,000 range - McNairy County attracts buyers looking for affordability, but the trade-off is a smaller pool of traditional purchasers.',
    'desc2'         => 'The McNairy County real estate market is firmly a buyer\'s market, with over half of homes selling below asking price and properties averaging close to 100 days on market. For sellers, that means long waits, price reductions, and uncertainty. If your property in Selmer, Adamsville, Michie, or the rural stretches along the Mississippi state line needs work or just is not attracting offers, a cash sale through Tennessee Cash For Homes can save you months of frustration. We buy houses across McNairy County in any condition - no agent commissions, no repair demands, and a closing date that fits your schedule.',
    'desc3'         => 'No matter what situation brought you here - an inherited family home, a property with deferred maintenance, tax troubles, or simply a desire to move on - we purchase homes throughout all of McNairy County. From houses on Selmer\'s tree-lined streets to rural properties on gravel roads outside Stantonville, every home gets a fair, honest cash offer from our team.',
    'land_para'     => 'McNairy County offers affordable farmland and rural residential tracts near the Mississippi border. Tennessee Cash For Homes buys McNairy County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Selmer', 'slug' => 'selmer', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Selmer or Adamsville in McNairy County?', 'a' => 'Yes. We buy homes throughout McNairy County including Selmer, Adamsville, and Michie. We are experienced with properties in this part of Southwest Tennessee.'],
        ['q' => 'Can I sell a property in McNairy County that is in a remote location?', 'a' => 'We buy properties in remote areas of McNairy County. Gravel roads, long driveways, and distance from town do not prevent us from making you an offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
