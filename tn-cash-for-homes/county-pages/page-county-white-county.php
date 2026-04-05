<?php
/**
 * Template Name: County — White County
 *
 * WordPress setup:
 *   Slug:     white-county  (under county-pages/ parent)
 *   Template: County — White County
 */

$county = [
    'slug'          => 'white-county',
    'name'          => 'White County',
    'county_id'     => 'white',
    'h1'            => 'Sell Your House Fast For Cash in White County TN',
    'meta_title'    => 'We Buy Houses in White County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in White County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '28',
    'avg_days'      => '86',
    'desc1'         => 'White County sits on the edge of the Cumberland Plateau in the Upper Cumberland region, and it is a place unlike anywhere else in Tennessee. Sparta, the county seat, anchors a community that claims more caves, waterfalls, and scenic overlooks per square mile than any other area in the state, along with over 100 miles of paddleable water on the Caney Fork, Calfkiller, Rocky, and Collins rivers. Burgess Falls and Virgin Falls draw hikers and photographers from across the Southeast, while Center Hill Lake provides year-round recreation. As part of the \'Highlands of Tennessee\' economic development region alongside Putnam, Overton, and Jackson counties, White County offers a low cost of living with convenient access to Cookeville and Crossville.',
    'desc2'         => 'White County home values remain well below the state median, which makes the area attractive to buyers but can also mean that sellers face a smaller pool of qualified purchasers, especially for older homes in Sparta or rural properties along the plateau. Financing hurdles for rural land, the cost of well and septic inspections, and longer days on market all add friction to traditional sales in the White County real estate market. If you want to sell your house in White County without those complications, cash home buyers in White County like us provide a direct solution -- a fair cash offer based on local conditions, no repair demands, no agent commissions, and a closing timeline that works for you.',
    'desc3'         => 'No matter what your circumstances are -- an inherited property near Sparta, a home along the Calfkiller River that needs work, a lakeside cabin you have outgrown, or a financial situation that requires a quick resolution -- Tennessee Cash For Homes buys houses throughout all of White County in any condition. Properties in town, near the state parks, and across the rural plateau are all ones we purchase.',
    'land_para'     => 'White County offers lakefront land near Center Hill Lake, farmland, and scenic rural acreage at affordable prices. Tennessee Cash For Homes buys White County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Sparta', 'slug' => 'sparta', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Sparta or Doyle in White County?', 'a' => 'Yes. We buy homes throughout White County including Sparta, Doyle, and all surrounding communities. We are familiar with the Cumberland Plateau market.'],
        ['q' => 'Can I sell a property in White County near Burgess Falls or the Calfkiller River?', 'a' => 'We buy properties throughout White County including those near Burgess Falls State Park and along the Calfkiller River. Location and condition do not matter.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
