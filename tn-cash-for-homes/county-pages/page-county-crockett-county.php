<?php
/**
 * Template Name: County — Crockett County
 *
 * WordPress setup:
 *   Slug:     crockett-county  (under county-pages/ parent)
 *   Template: County — Crockett County
 */

$county = [
    'slug'          => 'crockett-county',
    'name'          => 'Crockett County',
    'county_id'     => 'crockett',
    'h1'            => 'Sell Your House Fast For Cash in Crockett County TN',
    'meta_title'    => 'We Buy Houses in Crockett County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Crockett County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$138,000',
    'homes_sold'    => '10',
    'avg_days'      => '104',
    'desc1'         => 'Crockett County is a quiet agricultural county in West Tennessee named after the legendary Davy Crockett. Home to Alamo, the county offers affordable small town living and rich farmland. Tennessee Cash For Homes buys houses across all of Crockett County fast and for cash.',
    'desc2'         => 'Whether you need to sell an inherited property, are behind on payments, or want a quick hassle free sale we are here to help. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Crockett County offers productive farmland and affordable rural lots in the heart of West Tennessee. Tennessee Cash For Homes buys Crockett County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Alamo', 'slug' => 'alamo', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy farm homes or properties with agricultural land in Crockett County?', 'a' => 'Yes. Crockett County has a strong agricultural heritage and we buy homes on farmland, rural residential properties, and homes in Alamo and surrounding communities.'],
        ['q' => 'Can I sell a house in Crockett County that has been on the market for a long time?', 'a' => 'If your Crockett County home has been sitting on the market without offers, we can help. We buy homes directly regardless of how long they have been listed, and we close quickly for cash.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
