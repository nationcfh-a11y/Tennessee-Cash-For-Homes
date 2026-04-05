<?php
/**
 * Template Name: County - Trousdale County
 *
 * WordPress setup:
 *   Slug:     trousdale-county  (under county-pages/ parent)
 *   Template: County - Trousdale County
 */

$county = [
    'slug'          => 'trousdale-county',
    'name'          => 'Trousdale County',
    'county_id'     => 'trousdale',
    'h1'            => 'Sell Your House Fast For Cash in Trousdale County TN',
    'meta_title'    => 'We Buy Houses in Trousdale County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Trousdale County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$265,000',
    'homes_sold'    => '11',
    'avg_days'      => '79',
    'desc1'         => 'Trousdale County may be Tennessee\'s smallest county by area, but its location about 50 miles northeast of Nashville along Highway 25 and I-40 has made it increasingly attractive to commuters seeking affordability. Hartsville, the consolidated city-county seat, offers a median household income around $72,000 and a cost of living well below the national average. With a roughly 28-minute average commute and Trousdale County home values still a fraction of what you would pay closer to downtown Nashville, the area has drawn steady interest from buyers looking to stretch their dollar in a quiet, welcoming community.',
    'desc2'         => 'That said, the Trousdale County real estate market is small - with limited inventory and fewer active buyers at any given time, homes here can sit longer than sellers expect. If you need to sell your house in Trousdale County quickly, finding a qualified buyer through traditional listings can be unpredictable in a market this size. Cash home buyers in Trousdale County like us understand these dynamics and offer a straightforward alternative: a fair cash offer based on honest local market analysis, with no agent fees, no repair requests, and a closing date that works for you.',
    'desc3'         => 'Whatever your circumstances - an inherited home in Hartsville, a property that needs significant repairs, financial pressure, or a life change that requires a fast sale - Tennessee Cash For Homes purchases houses throughout all of Trousdale County in any condition. We work with homeowners across the county, from homes near the town square to properties on the rural outskirts.',
    'land_para'     => 'Trousdale County offers affordable rural land and residential lots northeast of Nashville. As the greater Nashville area continues to grow land in Trousdale County is becoming increasingly valuable. Tennessee Cash For Homes buys Trousdale County land quickly with no commissions.',
    'cities'        => [
        ['name' => 'Hartsville', 'slug' => 'hartsville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Hartsville or rural Trousdale County?', 'a' => 'Yes. Trousdale County is Tennessee\'s smallest county by area but we buy homes throughout including Hartsville. Small county size does not affect our ability to make fair cash offers.'],
        ['q' => 'Is Trousdale County close enough to Nashville for good property values?', 'a' => 'Trousdale County is within commuting distance of Nashville and has seen increasing interest from Nashville-area buyers. Our offers reflect this growing connection to the metro area.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
