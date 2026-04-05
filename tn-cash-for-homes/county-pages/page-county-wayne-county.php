<?php
/**
 * Template Name: County — Wayne County
 *
 * WordPress setup:
 *   Slug:     wayne-county  (under county-pages/ parent)
 *   Template: County — Wayne County
 */

$county = [
    'slug'          => 'wayne-county',
    'name'          => 'Wayne County',
    'county_id'     => 'wayne',
    'h1'            => 'Sell Your House Fast For Cash in Wayne County TN',
    'meta_title'    => 'We Buy Houses in Wayne County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Wayne County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$165,000',
    'homes_sold'    => '12',
    'avg_days'      => '102',
    'desc1'         => 'Wayne County is a deeply rural stretch of Southern Middle Tennessee where the Buffalo River flows through rolling countryside and the Natchez Trace Parkway passes just east of Waynesboro. The county\'s three main towns -- Waynesboro, Clifton along the Tennessee River, and Collinwood near the Alabama line -- each have their own character, shaped by generations of timber, farming, and river commerce. Clifton saw a revival with the construction of a Tennessee River bridge and the establishment of Mousetail Landing State Park, while Waynesboro is home to the remarkable Natural Bridge formation. With fair market rents ranging from $700 to about $1,300 and a homeownership rate near 79 percent, this is a county where most people own their homes -- and where selling one on the open market can take real patience.',
    'desc2'         => 'Wayne County home values are among the most affordable in Tennessee, but that low price point can actually work against sellers. Traditional buyers in this market often need rural financing or USDA loans, which come with appraisal hurdles and longer timelines. With limited buyer activity and properties that can sit for months, the Wayne County real estate market rewards patience that not every homeowner has. If you need to sell your house in Wayne County without waiting indefinitely, cash home buyers in Wayne County like us provide a realistic alternative: a fair cash offer, no agent fees, no repair requirements, and a closing schedule that fits your life.',
    'desc3'         => 'No matter what has brought you to this point -- an inherited property in Waynesboro, a cabin along the Buffalo River, a home in Clifton or Collinwood that you no longer need, or a house that has fallen into disrepair -- Tennessee Cash For Homes buys houses throughout all of Wayne County in any condition. Rural properties, in-town homes, and everything in between are all welcome.',
    'land_para'     => 'Wayne County offers affordable rural land along the Buffalo River and Natchez Trace Parkway. Tennessee Cash For Homes buys Wayne County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Waynesboro', 'slug' => 'waynesboro', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Waynesboro or Clifton in Wayne County?', 'a' => 'Yes. We buy homes throughout Wayne County including Waynesboro, Clifton, and all surrounding communities along the Tennessee River. Rural and remote properties are welcome.'],
        ['q' => 'Can I sell a hunting property or cabin in Wayne County?', 'a' => 'We buy hunting properties, cabins, and recreational land in Wayne County. Whether it is a seasonal cabin or a year-round home, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
