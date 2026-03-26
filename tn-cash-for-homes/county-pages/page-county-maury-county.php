<?php
/**
 * Template Name: County — Maury County
 *
 * WordPress setup:
 *   Slug:     maury-county  (under county-pages/ parent)
 *   Template: County — Maury County
 */

$county = [
    'slug'          => 'maury-county',
    'name'          => 'Maury County',
    'county_id'     => 'maury',
    'h1'            => 'Sell Your House Fast For Cash in Maury County',
    'meta_title'    => 'We Buy Houses in Maury County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Maury County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$367,500',
    'homes_sold'    => '49',
    'avg_days'      => '96',
    'desc1'         => 'Maury County has grown rapidly as Nashville\'s influence stretches southward. Home to Columbia and parts of Spring Hill, the county offers a mix of historic charm and modern development. Tennessee Cash For Homes buys houses across Maury County fast and for cash.',
    'desc2'         => 'Whether you are relocating, dealing with an inherited property, or simply need to sell quickly we make the process simple and stress free. No repairs, no agent fees, and we close on your timeline.',
    'land_para'     => 'Maury County\'s growing popularity among homebuyers and businesses has made land ownership more valuable than ever. Tennessee Cash For Homes buys Maury County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Columbia',    'slug' => 'columbia',    'has_page' => true],
        ['name' => 'Spring Hill', 'slug' => 'spring-hill', 'has_page' => true],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
