<?php
/**
 * Template Name: County — Bedford County
 *
 * WordPress setup:
 *   Slug:     bedford-county  (under county-pages/ parent)
 *   Template: County — Bedford County
 */

$county = [
    'slug'          => 'bedford-county',
    'name'          => 'Bedford County',
    'county_id'     => 'bedford',
    'h1'            => 'Sell Your House Fast For Cash in Bedford County TN',
    'meta_title'    => 'We Buy Houses in Bedford County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Bedford County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$315,990',
    'homes_sold'    => '27',
    'avg_days'      => '88',
    'desc1'         => 'Bedford County is known as the Walking Horse Capital of the World and is home to Shelbyville, one of Middle Tennessee\'s most charming cities. Whether you are downsizing, relocating, or facing financial difficulties Tennessee Cash For Homes makes fair cash offers with no repairs needed and no agent fees.',
    'desc2'         => 'We have helped Bedford County homeowners sell their houses fast for cash regardless of condition or situation. Our team understands the local market and is ready to make you a fair offer today. No repairs, no fees, and we close on your timeline.',
    'land_para'     => 'Bedford County offers beautiful equestrian properties, farmland, and rural lots at competitive prices. As Middle Tennessee continues to grow Bedford County land is becoming increasingly valuable. Tennessee Cash For Homes buys Bedford County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Shelbyville', 'slug' => 'shelbyville', 'has_page' => true],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
