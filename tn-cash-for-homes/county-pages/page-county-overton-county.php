<?php
/**
 * Template Name: County - Overton County
 *
 * WordPress setup:
 *   Slug:     overton-county  (under county-pages/ parent)
 *   Template: County - Overton County
 */

$county = [
    'slug'          => 'overton-county',
    'name'          => 'Overton County',
    'county_id'     => 'overton',
    'h1'            => 'Sell Your House Fast For Cash in Overton County TN',
    'meta_title'    => 'We Buy Houses in Overton County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Overton County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '18',
    'avg_days'      => '92',
    'desc1'         => 'Overton County sits in the heart of Tennessee\'s Upper Cumberland region, where Livingston serves as both the county seat and the commercial center for surrounding communities like Hilham and Alpine. Manufacturing drives the local economy, with nearly 2,000 residents working at operations that supply parts for Nissan, Caterpillar, and Honda. Companies like Hutchinson, BR Metal Products, and ABC INOAC provide a stable employment base, while Standing Stone State Park and the rolling countryside along Dale Hollow attract retirees and outdoor enthusiasts looking for a quieter pace of life.',
    'desc2'         => 'Overton County home values have softened recently, with median sale prices dipping and listings sitting on the market longer than they did a year ago. For homeowners who need to sell, that shift can feel discouraging, especially if the property needs updating or you are managing it from out of town. Cash home buyers in Overton County offer an alternative that bypasses the wait. We purchase homes as-is in Livingston, Hilham, and throughout the county, with no agent commissions, no repair requests, and a closing timeline you control.',
    'desc3'         => 'Regardless of your circumstances, whether you are settling an estate, relocating for work, or simply ready to move on from a property you no longer need, we buy houses throughout all of Overton County in any condition. From older homes near the Livingston square to lakeside cabins and rural farmhouses, Tennessee Cash For Homes makes selling straightforward and fair.',
    'land_para'     => 'Overton County offers affordable rural land with rolling hills, farmland, and proximity to Center Hill Lake. Tennessee Cash For Homes buys Overton County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Livingston', 'slug' => 'livingston', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Livingston or Hilham in Overton County?', 'a' => 'Yes. We buy homes throughout Overton County including Livingston, Hilham, and all surrounding communities. Rural properties and in-town homes are equally welcome.'],
        ['q' => 'Can I sell a property in Overton County near Standing Stone State Park?', 'a' => 'We buy properties throughout Overton County including areas near Standing Stone State Park and Dale Hollow Lake. We purchase homes in any condition.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
