<?php
/**
 * Template Name: County — Johnson County
 *
 * WordPress setup:
 *   Slug:     johnson-county  (under county-pages/ parent)
 *   Template: County — Johnson County
 */

$county = [
    'slug'          => 'johnson-county',
    'name'          => 'Johnson County',
    'county_id'     => 'johnson',
    'h1'            => 'Sell Your House Fast For Cash in Johnson County TN',
    'meta_title'    => 'We Buy Houses in Johnson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Johnson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '14',
    'avg_days'      => '96',
    'desc1'         => 'Johnson County is Tennessee\'s easternmost county, a mountain community home to Mountain City and surrounded by the Cherokee National Forest. The county offers stunning Appalachian scenery, affordable living, and a strong sense of community. Tennessee Cash For Homes buys houses across all of Johnson County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial challenges, or need a quick sale we are here to help. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Johnson County offers affordable mountain land with stunning views and access to the Appalachian Trail and Cherokee National Forest. Tennessee Cash For Homes buys Johnson County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Mountain City', 'slug' => 'mountain-city', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Mountain City or Appalachian areas of Johnson County?', 'a' => 'Yes. Johnson County is in Tennessee\'s far northeast corner and we buy homes throughout including Mountain City. Mountain properties, rural homes, and small-town residences are all welcome.'],
        ['q' => 'Can I sell a cabin or mountain property in Johnson County?', 'a' => 'We buy cabins, mountain homes, and all types of residential properties in Johnson County. Whether your property is on a mountainside or in a valley, we are interested.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
