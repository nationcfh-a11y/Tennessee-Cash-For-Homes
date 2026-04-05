<?php
/**
 * Template Name: County - Union County
 *
 * WordPress setup:
 *   Slug:     union-county  (under county-pages/ parent)
 *   Template: County - Union County
 */

$county = [
    'slug'          => 'union-county',
    'name'          => 'Union County',
    'county_id'     => 'union',
    'h1'            => 'Sell Your House Fast For Cash in Union County TN',
    'meta_title'    => 'We Buy Houses in Union County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Union County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '14',
    'avg_days'      => '92',
    'desc1'         => 'Union County sits just northeast of Knoxville in the rolling hills of East Tennessee, offering a peaceful rural lifestyle with the convenience of metro access. Maynardville, the county seat, has seen impressive property appreciation - homes here have grown from a median around $114,000 to over $270,000 in recent years, with particularly strong gains during the 2021-2022 boom. The northern part of the county borders Norris Lake, where waterfront properties in communities like Sharps Chapel can command prices well above $400,000. For homeowners throughout Union County, that appreciation represents real equity - and sometimes a reason to sell.',
    'desc2'         => 'Despite rising Union County home values, selling here is not always simple. The market is relatively small, and many properties - especially older homes in Maynardville or rural acreage off the main corridors - can take time to move through traditional listings. Lakefront homes near Norris Lake attract seasonal interest, but non-waterfront properties may sit longer than sellers anticipate. If you want to sell your house in Union County without months of waiting, cash home buyers in Union County like us can provide a fair offer and close on your schedule, with no agent commissions and no repair requirements.',
    'desc3'         => 'Whatever has brought you to the decision to sell - an inherited property, a home that needs costly updates, financial changes, or a desire to downsize - Tennessee Cash For Homes buys houses throughout all of Union County in any condition. From lakeside cabins in Sharps Chapel to family homes in Maynardville and Luttrell, we are ready to make you an offer.',
    'land_para'     => 'Union County offers lakefront land on Norris Lake and affordable rural acreage near Knoxville. Tennessee Cash For Homes buys Union County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Maynardville', 'slug' => 'maynardville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Maynardville or Luttrell in Union County?', 'a' => 'Yes. We buy homes throughout Union County including Maynardville and Luttrell. Rural properties and homes near Norris Lake are all ones we purchase.'],
        ['q' => 'Can I sell a property near Norris Lake in Union County?', 'a' => 'We buy properties near Norris Lake and throughout Union County. Lake homes, cabins, and residential properties in any condition are welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
