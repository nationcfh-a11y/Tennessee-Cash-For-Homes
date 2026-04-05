<?php
/**
 * Template Name: County - Hawkins County
 *
 * WordPress setup:
 *   Slug:     hawkins-county  (under county-pages/ parent)
 *   Template: County - Hawkins County
 */

$county = [
    'slug'          => 'hawkins-county',
    'name'          => 'Hawkins County',
    'county_id'     => 'hawkins',
    'h1'            => 'Sell Your House Fast For Cash in Hawkins County TN',
    'meta_title'    => 'We Buy Houses in Hawkins County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hawkins County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '42',
    'avg_days'      => '86',
    'desc1'         => 'Hawkins County is one of the oldest counties in Tennessee, established in 1761, with its seat of Rogersville dating to 1787. Nestled in the Tri-Cities region of Northeast Tennessee, the county blends mountain scenery with Cherokee Lake access and a countryside dotted with small farms, hay fields, and homesteads. Church Hill is the largest incorporated town, while communities like Mount Carmel, Surgoinsville, and Bulls Gap each offer their own quiet neighborhoods. The local economy has roots in agriculture and manufacturing that trace back through salt production, railroad expansion, and the influence of the Tennessee Valley Authority, and today the county remains a place where affordable housing and rural character are the main draw.',
    'desc2'         => 'The Hawkins County real estate market offers some of the most accessible home prices in the Tri-Cities area, but that does not always make selling easy. With an average of 86 days on market and many older homes that need foundation work, roof repairs, or updates to outdated systems, traditional buyers often pass or demand costly concessions. If you want to sell your house in Hawkins County without investing in renovations or waiting months for an offer, cash home buyers in Hawkins County like Tennessee Cash For Homes provide a straightforward alternative. We buy as-is, cover closing costs, and work on your schedule.',
    'desc3'         => 'From lakefront properties on Cherokee Lake to farmhouses outside Rogersville, older homes in Church Hill, or rural parcels near Surgoinsville, we buy houses throughout all of Hawkins County in any condition. Whatever your reason for selling, whether it is a job relocation, an inherited property, financial pressure, or simply wanting a fresh start, we are here to make it happen quickly and fairly.',
    'land_para'     => 'Hawkins County offers lakefront land on Cherokee Lake, rolling farmland, and affordable mountain tracts. Tennessee Cash For Homes buys Hawkins County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Rogersville', 'slug' => 'rogersville', 'has_page' => false],
        ['name' => 'Church Hill', 'slug' => 'church-hill', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Rogersville or Church Hill in Hawkins County?', 'a' => 'Yes. We purchase homes throughout Hawkins County including Rogersville, Church Hill, Mount Carmel, Surgoinsville, and all surrounding areas.'],
        ['q' => 'Can I sell a home in Hawkins County that has been damaged by water or mold?', 'a' => 'We buy homes in Hawkins County with water damage, mold issues, or any other condition. No repairs or remediation are needed on your part before selling to us.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
