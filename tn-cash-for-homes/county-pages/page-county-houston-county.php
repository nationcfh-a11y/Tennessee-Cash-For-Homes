<?php
/**
 * Template Name: County — Houston County
 *
 * WordPress setup:
 *   Slug:     houston-county  (under county-pages/ parent)
 *   Template: County — Houston County
 */

$county = [
    'slug'          => 'houston-county',
    'name'          => 'Houston County',
    'county_id'     => 'houston',
    'h1'            => 'Sell Your House Fast For Cash in Houston County TN',
    'meta_title'    => 'We Buy Houses in Houston County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Houston County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$189,000',
    'homes_sold'    => '8',
    'avg_days'      => '105',
    'desc1'         => 'Houston County is one of Tennessee\'s smallest counties offering affordable rural living in the heart of Middle Tennessee. Home to Erin, the county sits along the Cumberland River and offers a peaceful lifestyle away from the city. Tennessee Cash For Homes buys houses across all of Houston County fast and for cash.',
    'desc2'         => 'Whether you need to sell quickly due to financial reasons, relocation, or an inherited property we make the process simple and stress free. No repairs needed, no agent commissions, and we close when you are ready.',
    'land_para'     => 'Houston County offers affordable rural land along the Cumberland River including wooded tracts and residential lots. Tennessee Cash For Homes buys Houston County land quickly with no commissions and no surveys required.',
    'cities'        => [
        ['name' => 'Erin', 'slug' => 'erin', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
