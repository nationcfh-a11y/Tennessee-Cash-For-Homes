<?php
/**
 * Template Name: County — Gibson County
 *
 * WordPress setup:
 *   Slug:     gibson-county  (under county-pages/ parent)
 *   Template: County — Gibson County
 */

$county = [
    'slug'          => 'gibson-county',
    'name'          => 'Gibson County',
    'county_id'     => 'gibson',
    'h1'            => 'Sell Your House Fast For Cash in Gibson County TN',
    'meta_title'    => 'We Buy Houses in Gibson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Gibson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '38',
    'avg_days'      => '90',
    'desc1'         => 'Gibson County is one of West Tennessee\'s largest counties with a strong agricultural economy. Home to Trenton, Humboldt, and Milan, the county offers affordable living and a tight knit community atmosphere. Tennessee Cash For Homes buys houses across all of Gibson County fast and for cash in any condition.',
    'desc2'         => 'Whether you are facing financial difficulties, dealing with an inherited property, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Gibson County offers some of West Tennessee\'s most productive farmland along with affordable residential lots. Tennessee Cash For Homes buys Gibson County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Trenton', 'slug' => 'trenton', 'has_page' => false],
        ['name' => 'Humboldt', 'slug' => 'humboldt', 'has_page' => false],
        ['name' => 'Milan', 'slug' => 'milan', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Trenton, Humboldt, or Milan in Gibson County?', 'a' => 'Yes. We purchase homes throughout Gibson County including Trenton, Humboldt, Milan, Medina, and all surrounding communities. We are familiar with the local market and provide fair offers.'],
        ['q' => 'Can I sell a home in Gibson County that needs a new roof?', 'a' => 'Absolutely. We buy homes in Gibson County as-is, including those needing major repairs like a new roof. You do not need to spend money on repairs before selling to us.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
