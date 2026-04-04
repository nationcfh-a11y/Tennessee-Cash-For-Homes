<?php
/**
 * Template Name: County — Dickson County
 *
 * WordPress setup:
 *   Slug:     dickson-county  (under county-pages/ parent)
 *   Template: County — Dickson County
 */

$county = [
    'slug'          => 'dickson-county',
    'name'          => 'Dickson County',
    'county_id'     => 'dickson',
    'h1'            => 'Sell Your House Fast For Cash in Dickson County',
    'meta_title'    => 'We Buy Houses in Dickson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Dickson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$299,000',
    'homes_sold'    => '38',
    'avg_days'      => '81',
    'desc1'         => 'Dickson County offers affordable living west of Nashville with a growing community and strong local economy. Tennessee Cash For Homes buys houses across all of Dickson County fast and for cash regardless of condition.',
    'desc2'         => 'Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are ready to help with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Dickson County offers rural land and residential lots at competitive prices. As Nashville\'s growth spreads westward land in Dickson County is becoming increasingly valuable. Tennessee Cash For Homes buys land quickly with no commissions.',
    'cities'        => [
        ['name' => 'Dickson', 'slug' => 'dickson', 'has_page' => false],
        ['name' => 'Burns',   'slug' => 'burns',   'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is Dickson County close enough to Nashville to get strong cash offers?', 'a' => 'Yes. Dickson County is part of the Nashville commuter belt and property values reflect its proximity to the metro area. Our cash offers account for Dickson County\'s growing demand and convenient location.'],
        ['q' => 'Do you buy homes in Dickson, White Bluff, or Burns in Dickson County?', 'a' => 'We purchase homes throughout Dickson County including the cities of Dickson, White Bluff, Burns, and Charlotte. All conditions and situations are welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
