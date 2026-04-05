<?php
/**
 * Template Name: County - Carroll County
 *
 * WordPress setup:
 *   Slug:     carroll-county  (under county-pages/ parent)
 *   Template: County - Carroll County
 */

$county = [
    'slug'          => 'carroll-county',
    'name'          => 'Carroll County',
    'county_id'     => 'carroll',
    'h1'            => 'Sell Your House Fast For Cash in Carroll County TN',
    'meta_title'    => 'We Buy Houses in Carroll County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Carroll County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$145,000',
    'homes_sold'    => '18',
    'avg_days'      => '102',
    'desc1'         => 'Carroll County is a West Tennessee community where small-town values meet educational opportunity. McKenzie is home to Bethel University - with over 5,000 students - and the Tennessee College of Applied Technology, both of which anchor the local economy alongside agriculture and small manufacturing. Huntingdon, the county seat, and the smaller community of Hollow Rock round out a county that offers genuinely affordable housing in a rural setting. Carroll County home values range widely, from modest ranch-style homes in Huntingdon starting around $150,000 to larger properties on acreage in the outlying areas. The market here tends to favor buyers, with homes often taking 60 to over 100 days to sell and plenty of room for negotiation.',
    'desc2'         => 'That buyer-friendly pace can be frustrating if you are a Carroll County homeowner who needs to sell. Listings that require updates, mobile homes on land, and rural properties with limited road access can sit for months without a serious offer. Cash home buyers in Carroll County like us exist to solve that exact problem. We purchase homes and properties directly, in as-is condition, with no agent commissions and no lender requirements to slow things down. If you need to sell your house in Carroll County, we provide a fair cash offer based on current Carroll County home values and close on a timeline that works for you - often in as little as two weeks.',
    'desc3'         => 'Your reason for selling does not change our willingness to buy. Whether you are managing a family estate in Huntingdon, leaving a rental property in McKenzie behind, or holding a piece of land in Hollow Rock you no longer need, Tennessee Cash For Homes purchases houses throughout all of Carroll County in any condition. We keep the process straightforward so you can move on.',
    'land_para'     => 'Carroll County offers productive farmland and rural residential lots at very affordable prices. Tennessee Cash For Homes buys Carroll County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Huntingdon', 'slug' => 'huntingdon', 'has_page' => false],
        ['name' => 'McKenzie', 'slug' => 'mckenzie', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Huntingdon or McKenzie in Carroll County?', 'a' => 'Yes. We purchase homes throughout Carroll County including Huntingdon, McKenzie, Hollow Rock, and all surrounding areas. We are familiar with the local market and provide fair cash offers.'],
        ['q' => 'Can I sell a mobile home on land in Carroll County?', 'a' => 'We buy mobile homes on owned land in Carroll County. Whether it is a single-wide or double-wide, we will evaluate the property and make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
