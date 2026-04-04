<?php
/**
 * Template Name: County — Perry County
 *
 * WordPress setup:
 *   Slug:     perry-county  (under county-pages/ parent)
 *   Template: County — Perry County
 */

$county = [
    'slug'          => 'perry-county',
    'name'          => 'Perry County',
    'county_id'     => 'perry',
    'h1'            => 'Sell Your House Fast For Cash in Perry County TN',
    'meta_title'    => 'We Buy Houses in Perry County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Perry County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$198,000',
    'homes_sold'    => '9',
    'avg_days'      => '112',
    'desc1'         => 'Perry County sits along the Buffalo River in Middle Tennessee offering stunning natural beauty and a quiet rural lifestyle. Home to Linden, the county attracts outdoor enthusiasts and those seeking peaceful country living. Tennessee Cash For Homes buys houses across all of Perry County fast and for cash.',
    'desc2'         => 'Whether you are facing financial difficulties, dealing with an inherited property, or simply need to sell quickly we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Perry County offers exceptional rural land along the Buffalo River corridor including wooded tracts, river access properties, and farmland. Tennessee Cash For Homes buys Perry County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Linden', 'slug' => 'linden', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Linden or rural Perry County?', 'a' => 'Yes. Perry County is one of Tennessee\'s more rural and less populated counties. We buy homes in Linden and throughout Perry County regardless of the challenges that come with a smaller market.'],
        ['q' => 'Can I sell a property along the Buffalo River in Perry County?', 'a' => 'We buy properties along the Buffalo River and throughout Perry County. Whether it is a home, cabin, or vacant land, we will evaluate the property and make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
