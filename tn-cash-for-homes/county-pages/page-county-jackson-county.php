<?php
/**
 * Template Name: County — Jackson County
 *
 * WordPress setup:
 *   Slug:     jackson-county  (under county-pages/ parent)
 *   Template: County — Jackson County
 */

$county = [
    'slug'          => 'jackson-county',
    'name'          => 'Jackson County',
    'county_id'     => 'jackson',
    'h1'            => 'Sell Your House Fast For Cash in Jackson County TN',
    'meta_title'    => 'We Buy Houses in Jackson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Jackson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$175,000',
    'homes_sold'    => '10',
    'avg_days'      => '105',
    'desc1'         => 'Jackson County sits in the Upper Cumberland region of Middle Tennessee, a landscape of rolling hills, pristine waterfalls, and state-protected natural areas that has remained deeply rural since the county was first settled. Gainesboro, the county seat, is a small town where the Cumberland River bends through the valley, while the community of Granville, nearly surrounded by the waters of Cordell Hull Lake, preserves its heritage through landmarks like the T.B. Sutton General Store, built in 1880 and listed on the National Register of Historic Places. Timber harvesting, farming, and lake-based tourism form the economic foundation, with many residents commuting to nearby Cookeville in Putnam County for additional employment and services.',
    'desc2'         => 'The Jackson County real estate market offers genuine value, with median prices well below the state average and property types ranging from lakefront homes on Cordell Hull Lake to traditional farmhouses and wooded tracts. But selling here means working within a very small buyer pool. Homes average over 100 days on market, and rural properties with well and septic systems, gravel road access, or deferred maintenance can take much longer to move through traditional channels. If you need to sell your house in Jackson County without the long wait, cash home buyers in Jackson County like Tennessee Cash For Homes provide a direct alternative. We make fair offers on properties as they are, with no agent commissions and no repair expectations.',
    'desc3'         => 'From homes along the Cumberland River in Gainesboro to lakefront properties near Granville, farmsteads in Whitleyville, or houses on remote tracts anywhere in the county, we buy houses throughout all of Jackson County in any condition. Whether you are managing an inherited property, facing financial pressure, or simply ready for a change, our team will work with you to make the sale as simple and fair as possible.',
    'land_para'     => 'Jackson County offers affordable rural land along the Cumberland River and Cordell Hull Lake. Tennessee Cash For Homes buys Jackson County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Gainesboro', 'slug' => 'gainesboro', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Gainesboro or rural Jackson County?', 'a' => 'Yes. We buy homes throughout Jackson County including Gainesboro and all surrounding rural areas. Low population density does not affect our interest in purchasing your property.'],
        ['q' => 'Can I sell a property in Jackson County near Cordell Hull Lake?', 'a' => 'Absolutely. Jackson County borders Cordell Hull Lake and we buy lake area properties, homes, and land throughout the county.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
