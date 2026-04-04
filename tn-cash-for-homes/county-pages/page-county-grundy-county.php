<?php
/**
 * Template Name: County — Grundy County
 *
 * WordPress setup:
 *   Slug:     grundy-county  (under county-pages/ parent)
 *   Template: County — Grundy County
 */

$county = [
    'slug'          => 'grundy-county',
    'name'          => 'Grundy County',
    'county_id'     => 'grundy',
    'h1'            => 'Sell Your House Fast For Cash in Grundy County TN',
    'meta_title'    => 'We Buy Houses in Grundy County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Grundy County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$175,000',
    'homes_sold'    => '12',
    'avg_days'      => '105',
    'desc1'         => 'Grundy County sits atop the Cumberland Plateau in Southern Tennessee and is home to Tracy City, Monteagle, and Altamont. The county is known for its dramatic gorges, waterfalls, and access to South Cumberland State Park. Tennessee Cash For Homes buys houses across all of Grundy County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, are facing financial difficulties, or simply want a quick sale we are here to help. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Grundy County offers unique plateau land with stunning overlooks, wooded tracts, and affordable mountain acreage. Tennessee Cash For Homes buys Grundy County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Altamont', 'slug' => 'altamont', 'has_page' => false],
        ['name' => 'Tracy City', 'slug' => 'tracy-city', 'has_page' => false],
        ['name' => 'Monteagle', 'slug' => 'monteagle', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes on the Cumberland Plateau in Grundy County?', 'a' => 'Yes. Grundy County sits atop the Cumberland Plateau and we buy properties throughout the county including Tracy City, Altamont, Coalmont, and Palmer. Mountain properties are no problem.'],
        ['q' => 'Can I sell a property in Grundy County if the local market is slow?', 'a' => 'Grundy County\'s traditional market can be slow due to its rural nature. We buy directly for cash regardless of local market conditions, giving you a fast and certain sale.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
