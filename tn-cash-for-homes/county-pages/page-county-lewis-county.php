<?php
/**
 * Template Name: County — Lewis County
 *
 * WordPress setup:
 *   Slug:     lewis-county  (under county-pages/ parent)
 *   Template: County — Lewis County
 */

$county = [
    'slug'          => 'lewis-county',
    'name'          => 'Lewis County',
    'county_id'     => 'lewis',
    'h1'            => 'Sell Your House Fast For Cash in Lewis County TN',
    'meta_title'    => 'We Buy Houses in Lewis County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Lewis County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$219,000',
    'homes_sold'    => '14',
    'avg_days'      => '98',
    'desc1'         => 'Lewis County is one of Tennessee\'s smaller rural counties offering quiet country living and affordable real estate. Home to Hohenwald, the county has a tight knit community and scenic landscape. Tennessee Cash For Homes buys houses across all of Lewis County fast and for cash in any condition.',
    'desc2'         => 'Whether you need to sell quickly due to relocation, financial hardship, or an inherited property we make the process simple. No repairs needed, no agent fees, and we close on your timeline with a fair cash offer.',
    'land_para'     => 'Lewis County offers peaceful rural land including farmland, wooded acreage, and undeveloped lots at very competitive prices. Tennessee Cash For Homes buys Lewis County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Hohenwald', 'slug' => 'hohenwald', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Hohenwald or rural Lewis County?', 'a' => 'Yes. We purchase homes throughout Lewis County including Hohenwald and all surrounding rural areas. Lewis County\'s small market size is not a barrier for us.'],
        ['q' => 'Can I sell a property in Lewis County near the Meriwether Lewis Monument?', 'a' => 'We buy homes and properties throughout Lewis County including areas near the Natchez Trace Parkway and Meriwether Lewis Monument. Location within the county does not matter.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
