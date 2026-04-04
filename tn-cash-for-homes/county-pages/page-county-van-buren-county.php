<?php
/**
 * Template Name: County — Van Buren County
 *
 * WordPress setup:
 *   Slug:     van-buren-county  (under county-pages/ parent)
 *   Template: County — Van Buren County
 */

$county = [
    'slug'          => 'van-buren-county',
    'name'          => 'Van Buren County',
    'county_id'     => 'van-buren',
    'h1'            => 'Sell Your House Fast For Cash in Van Buren County TN',
    'meta_title'    => 'We Buy Houses in Van Buren County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Van Buren County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$175,000',
    'homes_sold'    => '6',
    'avg_days'      => '110',
    'desc1'         => 'Van Buren County is one of Tennessee\'s smallest counties, a quiet Cumberland Plateau community home to Spencer and Fall Creek Falls State Park. The park\'s stunning waterfalls and gorges make the county a hidden gem. Tennessee Cash For Homes buys houses across all of Van Buren County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, need to relocate, or simply want to sell we make the process easy. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Van Buren County offers scenic plateau land near Fall Creek Falls State Park at very affordable prices. Tennessee Cash For Homes buys Van Buren County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Spencer', 'slug' => 'spencer', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Spencer or rural Van Buren County?', 'a' => 'Yes. Van Buren County is one of Tennessee\'s least populated counties and we buy homes in Spencer and throughout the county. We specialize in helping homeowners who struggle to sell in small markets.'],
        ['q' => 'Can I sell a property near Fall Creek Falls in Van Buren County?', 'a' => 'We buy properties near Fall Creek Falls State Park and throughout Van Buren County. Whether it is a home, cabin, or rural property, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
