<?php
/**
 * Template Name: County — Overton County
 *
 * WordPress setup:
 *   Slug:     overton-county  (under county-pages/ parent)
 *   Template: County — Overton County
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
    'desc1'         => 'Overton County is an Upper Cumberland county in Middle Tennessee home to Livingston. The county offers affordable housing, scenic countryside, and a growing community near the shores of Center Hill Lake. Tennessee Cash For Homes buys houses across all of Overton County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, are facing foreclosure, or simply need to sell fast we are here to help. No repairs needed, no agent fees, and we close when you are ready.',
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
