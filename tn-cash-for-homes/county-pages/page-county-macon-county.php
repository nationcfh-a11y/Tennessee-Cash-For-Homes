<?php
/**
 * Template Name: County — Macon County
 *
 * WordPress setup:
 *   Slug:     macon-county  (under county-pages/ parent)
 *   Template: County — Macon County
 */

$county = [
    'slug'          => 'macon-county',
    'name'          => 'Macon County',
    'county_id'     => 'macon',
    'h1'            => 'Sell Your House Fast For Cash in Macon County TN',
    'meta_title'    => 'We Buy Houses in Macon County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Macon County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '20',
    'avg_days'      => '88',
    'desc1'         => 'Macon County is a rural Upper Cumberland county in Middle Tennessee home to Lafayette. The county offers affordable living, rolling farmland, and a welcoming small town atmosphere near the Kentucky border. Tennessee Cash For Homes buys houses across all of Macon County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial difficulties, or need to sell quickly we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Macon County offers affordable farmland and rural residential lots in the Upper Cumberland region. Tennessee Cash For Homes buys Macon County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Lafayette', 'slug' => 'lafayette', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Lafayette or rural Macon County?', 'a' => 'Yes. We buy homes throughout Macon County including Lafayette and all surrounding rural communities. We are experienced with properties in smaller Tennessee markets.'],
        ['q' => 'Can I sell a home in Macon County if it has been vacant and neglected?', 'a' => 'We buy vacant and neglected homes in Macon County regularly. Even if the property has significant deterioration, we purchase as-is and handle all the cleanup after closing.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
