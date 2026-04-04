<?php
/**
 * Template Name: County — Jefferson County
 *
 * WordPress setup:
 *   Slug:     jefferson-county  (under county-pages/ parent)
 *   Template: County — Jefferson County
 */

$county = [
    'slug'          => 'jefferson-county',
    'name'          => 'Jefferson County',
    'county_id'     => 'jefferson',
    'h1'            => 'Sell Your House Fast For Cash in Jefferson County TN',
    'meta_title'    => 'We Buy Houses in Jefferson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Jefferson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$295,000',
    'homes_sold'    => '42',
    'avg_days'      => '78',
    'desc1'         => 'Jefferson County is a scenic East Tennessee county home to Dandridge, one of the oldest towns in the state, and the shores of Douglas Lake. The county offers mountain views, lake living, and proximity to both Knoxville and the Smoky Mountains. Tennessee Cash For Homes buys houses across all of Jefferson County fast and for cash.',
    'desc2'         => 'Whether you need to sell due to relocation, inheritance, or financial reasons we make the process easy. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Jefferson County offers lakefront land on Douglas Lake, mountain view properties, and growing residential development. Tennessee Cash For Homes buys Jefferson County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dandridge', 'slug' => 'dandridge', 'has_page' => false],
        ['name' => 'Jefferson City', 'slug' => 'jefferson-city', 'has_page' => false],
        ['name' => 'White Pine', 'slug' => 'white-pine', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Dandridge or Jefferson City in Jefferson County?', 'a' => 'Yes. We purchase homes throughout Jefferson County including Dandridge, Jefferson City, White Pine, and New Market. All conditions are welcome.'],
        ['q' => 'Can I sell a home in Jefferson County near Douglas Lake?', 'a' => 'We buy homes and lake properties near Douglas Lake in Jefferson County. Whether it is a full-time residence or a vacation property, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
