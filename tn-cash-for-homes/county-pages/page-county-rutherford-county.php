<?php
/**
 * Template Name: County — Rutherford County
 *
 * WordPress setup:
 *   Slug:     rutherford-county  (under county-pages/ parent)
 *   Template: County — Rutherford County
 */

$county = [
    'slug'          => 'rutherford-county',
    'name'          => 'Rutherford County',
    'county_id'     => 'rutherford',
    'h1'            => 'Sell Your House Fast For Cash in Rutherford County',
    'meta_title'    => 'We Buy Houses in Rutherford County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Rutherford County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$418,450',
    'homes_sold'    => '142',
    'avg_days'      => '65',
    'desc1'         => 'Rutherford County is one of the fastest growing counties in Tennessee, anchored by Murfreesboro and surrounded by thriving communities. Tennessee Cash For Homes has helped hundreds of Rutherford County homeowners sell their houses fast for cash regardless of condition or situation.',
    'desc2'         => 'Whether you are in Murfreesboro, Smyrna, La Vergne, or anywhere else in Rutherford County we are ready to make you a fair cash offer today. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Rutherford County has seen explosive growth in housing and commercial development. As the county expands outward landowners are finding strong opportunities to sell. Tennessee Cash For Homes helps Rutherford County landowners sell their lots and acreage quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Murfreesboro', 'slug' => 'murfreesboro', 'has_page' => true],
        ['name' => 'Smyrna',       'slug' => 'smyrna',       'has_page' => true],
        ['name' => 'La Vergne',    'slug' => 'la-vergne',    'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'How does Murfreesboro\'s fast growth in Rutherford County affect your offers?', 'a' => 'Rutherford County is Tennessee\'s fastest-growing county and Murfreesboro is now one of the state\'s largest cities. Our cash offers reflect this strong market demand. You get a competitive price without the lengthy listing process.'],
        ['q' => 'Do you buy homes near MTSU or in new Murfreesboro developments?', 'a' => 'Yes. We buy homes throughout Rutherford County including near Middle Tennessee State University, in Smyrna, La Vergne, Eagleville, and all new and established neighborhoods.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
