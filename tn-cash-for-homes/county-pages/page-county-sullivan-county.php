<?php
/**
 * Template Name: County — Sullivan County
 *
 * WordPress setup:
 *   Slug:     sullivan-county  (under county-pages/ parent)
 *   Template: County — Sullivan County
 */

$county = [
    'slug'          => 'sullivan-county',
    'name'          => 'Sullivan County',
    'county_id'     => 'sullivan',
    'h1'            => 'Sell Your House Fast For Cash in Sullivan County',
    'meta_title'    => 'We Buy Houses in Sullivan County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Sullivan County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '142',
    'avg_days'      => '76',
    'desc1'         => 'Sullivan County is the heart of the Tri-Cities region in Northeast Tennessee, home to both Kingsport -- built around Eastman Chemical Company\'s massive manufacturing campus -- and Bristol, the Birthplace of Country Music. With a combined metro population exceeding 500,000, the Tri-Cities offer Appalachian mountain living alongside no state income tax, affordable housing, and fiber internet that has drawn a wave of remote workers in recent years. Blountville, the county seat, sits between the two cities and hosts the Bristol Motor Speedway corridor. Sullivan County home values hover around a median of $260,000, making it one of the most affordable markets in the region even as demand intensifies and inventory tightens.',
    'desc2'         => 'That tightening market creates an interesting dynamic for Sullivan County sellers. Single-family home sales across the Tri-Cities rose nearly 6 percent last year, and median prices climbed over 4 percent. But older Kingsport neighborhoods near the Eastman plant and Bristol homes built in the mid-20th century often need updates that financed buyers are reluctant to take on. Homes that are not move-in ready can stall on the market while turnkey listings sell quickly. If you want to sell your house in Sullivan County without investing in renovations or paying agent commissions, cash home buyers in Sullivan County like Tennessee Cash For Homes can close in days rather than months -- giving you certainty and cash in hand.',
    'desc3'         => 'Whether you own a craftsman in Kingsport\'s historic neighborhoods, a home along the Bristol commercial corridor, a property in Bluff City or Blountville, or a house anywhere else in Sullivan County, we buy in any condition. Whatever your reason for selling, reach out for a no-obligation cash offer and pick the closing date that works best for you.',
    'land_para'     => 'Sullivan County offers diverse land options from residential lots in growing suburbs to rural mountain acreage. Tennessee Cash For Homes buys Sullivan County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Bristol', 'slug' => 'bristol', 'has_page' => false],
        ['name' => 'Kingsport', 'slug' => 'kingsport', 'has_page' => false],
        ['name' => 'Blountville', 'slug' => 'blountville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Kingsport, Bristol, or Bluff City in Sullivan County?', 'a' => 'Yes. We buy homes throughout Sullivan County including Kingsport, Bristol, and Bluff City. Whether your home is in the Tri-Cities metro or a rural area, we purchase all types and conditions.'],
        ['q' => 'Can I sell a property in Sullivan County if it is near an industrial area?', 'a' => 'We buy properties in Sullivan County regardless of proximity to industrial zones. Location does not deter us from making a fair cash offer on your home.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
