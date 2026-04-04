<?php
/**
 * Template Name: County — Bradley County
 *
 * WordPress setup:
 *   Slug:     bradley-county  (under county-pages/ parent)
 *   Template: County — Bradley County
 */

$county = [
    'slug'          => 'bradley-county',
    'name'          => 'Bradley County',
    'county_id'     => 'bradley',
    'h1'            => 'Sell Your House Fast For Cash in Bradley County TN',
    'meta_title'    => 'We Buy Houses in Bradley County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Bradley County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$295,000',
    'homes_sold'    => '89',
    'avg_days'      => '74',
    'desc1'         => 'Bradley County is a growing Southeast Tennessee county anchored by Cleveland. With easy access to Chattanooga and the Ocoee River region, the county offers affordable housing and a strong local economy. Tennessee Cash For Homes buys houses across all of Bradley County fast and for cash in any condition.',
    'desc2'         => 'Whether you are facing foreclosure, dealing with a difficult tenant situation, or simply need to sell fast we are ready to make you a fair cash offer today. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Bradley County offers a mix of residential lots, farmland, and wooded tracts at competitive prices. Tennessee Cash For Homes buys Bradley County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Cleveland', 'slug' => 'cleveland', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Cleveland, Tennessee in Bradley County?', 'a' => 'Yes. Cleveland is the largest city in Bradley County and we actively purchase homes throughout the area. Whether your home is near downtown Cleveland or in the surrounding communities, we make fair cash offers.'],
        ['q' => 'Can I sell a rental property in Bradley County?', 'a' => 'We buy rental properties in Bradley County whether they are occupied with tenants or vacant. You do not need to wait for a lease to expire. We handle tenant situations regularly.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
