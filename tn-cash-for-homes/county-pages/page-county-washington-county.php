<?php
/**
 * Template Name: County — Washington County
 *
 * WordPress setup:
 *   Slug:     washington-county  (under county-pages/ parent)
 *   Template: County — Washington County
 */

$county = [
    'slug'          => 'washington-county',
    'name'          => 'Washington County',
    'county_id'     => 'washington',
    'h1'            => 'Sell Your House Fast For Cash in Washington County',
    'meta_title'    => 'We Buy Houses in Washington County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Washington County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$295,000',
    'homes_sold'    => '98',
    'avg_days'      => '72',
    'desc1'         => 'Washington County is a major Northeast Tennessee county home to Jonesborough, the state\'s oldest town, and Johnson City. As part of the Tri-Cities region, the county offers a growing economy, excellent healthcare, and a vibrant arts and culture scene. Tennessee Cash For Homes buys houses across all of Washington County fast and for cash.',
    'desc2'         => 'Whether you are in Johnson City, Jonesborough, or anywhere else in Washington County and need to sell quickly we are ready with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Washington County\'s growing population and strong economy have made land increasingly desirable. Tennessee Cash For Homes buys Washington County land quickly with no commissions, no surveys required, and flexible closing.',
    'cities'        => [
        ['name' => 'Johnson City', 'slug' => 'johnson-city', 'has_page' => false],
        ['name' => 'Jonesborough', 'slug' => 'jonesborough', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Johnson City or Jonesborough in Washington County?', 'a' => 'Yes. We buy homes throughout Washington County including Johnson City, Jonesborough (Tennessee\'s oldest town), and all surrounding areas. We are active in the Tri-Cities market.'],
        ['q' => 'Can I sell a historic home in Jonesborough in Washington County?', 'a' => 'We buy historic homes in Jonesborough and throughout Washington County. You do not need to worry about restoration costs or historic district regulations when selling to us.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
