<?php
/**
 * Template Name: County — Lawrence County
 *
 * WordPress setup:
 *   Slug:     lawrence-county  (under county-pages/ parent)
 *   Template: County — Lawrence County
 */

$county = [
    'slug'          => 'lawrence-county',
    'name'          => 'Lawrence County',
    'county_id'     => 'lawrence',
    'h1'            => 'Sell Your House Fast For Cash in Lawrence County TN',
    'meta_title'    => 'We Buy Houses in Lawrence County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Lawrence County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '35',
    'avg_days'      => '85',
    'desc1'         => 'Lawrence County sits in southern Middle Tennessee offering affordable living and a strong sense of community. Home to Lawrenceburg, the county is known for its historic downtown and hardworking residents. Tennessee Cash For Homes buys houses across all of Lawrence County fast and for cash in any condition.',
    'desc2'         => 'Whether you need to sell quickly due to relocation, financial reasons, or an inherited property we make the process simple and stress free. No repairs needed, no agent commissions, and we close on your schedule with a fair cash offer.',
    'land_para'     => 'Lawrence County offers rural farmland, wooded acreage, and residential lots at competitive prices. Tennessee Cash For Homes buys Lawrence County land quickly with no commissions, no surveys required, and a flexible closing timeline.',
    'cities'        => [
        ['name' => 'Lawrenceburg', 'slug' => 'lawrenceburg', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
