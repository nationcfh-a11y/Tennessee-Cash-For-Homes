<?php
/**
 * Template Name: County — Claiborne County
 *
 * WordPress setup:
 *   Slug:     claiborne-county  (under county-pages/ parent)
 *   Template: County — Claiborne County
 */

$county = [
    'slug'          => 'claiborne-county',
    'name'          => 'Claiborne County',
    'county_id'     => 'claiborne',
    'h1'            => 'Sell Your House Fast For Cash in Claiborne County TN',
    'meta_title'    => 'We Buy Houses in Claiborne County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Claiborne County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$165,000',
    'homes_sold'    => '25',
    'avg_days'      => '99',
    'desc1'         => 'Claiborne County sits in the far northeast corner of Tennessee near the Cumberland Gap, one of America\'s most historic landmarks. Home to Tazewell and Harrogate, the county offers affordable mountain living with beautiful scenery. Tennessee Cash For Homes buys houses across all of Claiborne County fast and for cash.',
    'desc2'         => 'Whether you are facing financial difficulties, dealing with an inherited property, or need to relocate quickly we make the selling process simple. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Claiborne County offers affordable mountain land near the Cumberland Gap with wooded tracts and rural acreage. Tennessee Cash For Homes buys Claiborne County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Tazewell', 'slug' => 'tazewell', 'has_page' => false],
        ['name' => 'Harrogate', 'slug' => 'harrogate', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Tazewell or New Tazewell in Claiborne County?', 'a' => 'Yes. We buy homes throughout Claiborne County including Tazewell, New Tazewell, Cumberland Gap, and Harrogate. No matter the location or condition, we are interested in making you an offer.'],
        ['q' => 'Can I sell an inherited property in Claiborne County that needs major repairs?', 'a' => 'We regularly buy inherited properties in Claiborne County that need significant work. You do not need to make any repairs. We buy as-is and can work with you through probate if needed.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
