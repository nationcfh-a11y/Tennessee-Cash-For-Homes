<?php
/**
 * Template Name: County — Scott County
 *
 * WordPress setup:
 *   Slug:     scott-county  (under county-pages/ parent)
 *   Template: County — Scott County
 */

$county = [
    'slug'          => 'scott-county',
    'name'          => 'Scott County',
    'county_id'     => 'scott',
    'h1'            => 'Sell Your House Fast For Cash in Scott County TN',
    'meta_title'    => 'We Buy Houses in Scott County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Scott County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$145,000',
    'homes_sold'    => '16',
    'avg_days'      => '102',
    'desc1'         => 'Scott County is a mountain county on the Cumberland Plateau in Northeast Tennessee home to Huntsville and Oneida. Known for the Big South Fork National Recreation Area, the county offers outdoor adventure and affordable mountain living. Tennessee Cash For Homes buys houses across all of Scott County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, are facing financial difficulties, or simply need to sell fast we are here to help. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Scott County offers affordable mountain land near the Big South Fork with wooded tracts and scenic acreage. Tennessee Cash For Homes buys Scott County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Huntsville', 'slug' => 'huntsville-tn', 'has_page' => false],
        ['name' => 'Oneida', 'slug' => 'oneida', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Oneida or Huntsville in Scott County?', 'a' => 'Yes. We buy homes throughout Scott County including Oneida, Huntsville, and Winfield. We are experienced with properties in the Cumberland Plateau region.'],
        ['q' => 'Can I sell a property in Scott County near the Big South Fork?', 'a' => 'We buy properties near the Big South Fork and throughout Scott County. Mountain homes, cabins, and rural residential properties are all welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
