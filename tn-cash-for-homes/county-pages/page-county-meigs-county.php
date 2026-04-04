<?php
/**
 * Template Name: County — Meigs County
 *
 * WordPress setup:
 *   Slug:     meigs-county  (under county-pages/ parent)
 *   Template: County — Meigs County
 */

$county = [
    'slug'          => 'meigs-county',
    'name'          => 'Meigs County',
    'county_id'     => 'meigs',
    'h1'            => 'Sell Your House Fast For Cash in Meigs County TN',
    'meta_title'    => 'We Buy Houses in Meigs County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Meigs County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '10',
    'avg_days'      => '98',
    'desc1'         => 'Meigs County is a small rural county in East Tennessee along the Tennessee River. Home to Decatur and surrounded by water on three sides, the county offers lakefront living on Watts Bar Lake and Chickamauga Lake. Tennessee Cash For Homes buys houses across all of Meigs County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, need to relocate, or want a quick hassle free sale we are here with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Meigs County offers unique lakefront land surrounded by the Tennessee River on multiple sides. Tennessee Cash For Homes buys Meigs County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Decatur', 'slug' => 'decatur', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties near Watts Bar Lake in Meigs County?', 'a' => 'Yes. Meigs County borders Watts Bar Lake and we buy homes, lake properties, and land throughout the county including Decatur and Ten Mile.'],
        ['q' => 'Is it hard to sell a home in a small county like Meigs County?', 'a' => 'Traditional home sales in Meigs County can be slow due to limited buyer activity. We eliminate that challenge by buying your home directly for cash with a quick, certain closing.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
