<?php
/**
 * Template Name: County — Cocke County
 *
 * WordPress setup:
 *   Slug:     cocke-county  (under county-pages/ parent)
 *   Template: County — Cocke County
 */

$county = [
    'slug'          => 'cocke-county',
    'name'          => 'Cocke County',
    'county_id'     => 'cocke',
    'h1'            => 'Sell Your House Fast For Cash in Cocke County TN',
    'meta_title'    => 'We Buy Houses in Cocke County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Cocke County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$210,000',
    'homes_sold'    => '28',
    'avg_days'      => '90',
    'desc1'         => 'Cocke County is an East Tennessee county at the doorstep of the Great Smoky Mountains. Home to Newport and the French Broad River, the county offers scenic mountain living and a growing outdoor recreation economy. Tennessee Cash For Homes buys houses across all of Cocke County fast and for cash in any condition.',
    'desc2'         => 'Whether you are facing foreclosure, dealing with a difficult property, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline with a fair cash offer.',
    'land_para'     => 'Cocke County offers mountain land with river access and Smoky Mountain views at affordable prices. Tennessee Cash For Homes buys Cocke County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Newport', 'slug' => 'newport', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Newport or Parrottsville in Cocke County?', 'a' => 'Yes. We purchase homes throughout Cocke County including Newport, Parrottsville, and the surrounding areas near the Smoky Mountains. All property conditions are welcome.'],
        ['q' => 'Can I sell a property in Cocke County that has code violations?', 'a' => 'Absolutely. We buy homes in Cocke County even if they have code violations, liens, or other legal issues. We are experienced in handling complex situations and will work through any obstacles.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
