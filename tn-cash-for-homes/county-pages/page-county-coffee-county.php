<?php
/**
 * Template Name: County — Coffee County
 *
 * WordPress setup:
 *   Slug:     coffee-county  (under county-pages/ parent)
 *   Template: County — Coffee County
 */

$county = [
    'slug'          => 'coffee-county',
    'name'          => 'Coffee County',
    'county_id'     => 'coffee',
    'h1'            => 'Sell Your House Fast For Cash in Coffee County TN',
    'meta_title'    => 'We Buy Houses in Coffee County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Coffee County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$289,000',
    'homes_sold'    => '42',
    'avg_days'      => '78',
    'desc1'         => 'Coffee County is a growing Middle Tennessee county home to Manchester and Tullahoma offering affordable living with easy access to Nashville and Chattanooga. Tennessee Cash For Homes buys houses across all of Coffee County fast and for cash in any condition.',
    'desc2'         => 'Whether you need to sell quickly due to relocation, financial reasons, or an inherited property we make the process simple and stress free. No repairs needed, no agent commissions, and we close on your schedule with a fair cash offer.',
    'land_para'     => 'Coffee County offers rural farmland, residential lots, and wooded acreage at competitive prices. Tennessee Cash For Homes buys Coffee County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Manchester',  'slug' => 'manchester',  'has_page' => false],
        ['name' => 'Tullahoma',   'slug' => 'tullahoma',   'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Tullahoma or Manchester in Coffee County?', 'a' => 'Yes. We actively purchase homes throughout Coffee County including Tullahoma, Manchester, and surrounding communities. Whether near Arnold Air Force Base or in town, we buy in any condition.'],
        ['q' => 'Can I sell a house in Coffee County if I am relocating for military orders?', 'a' => 'We work with military families near Arnold Air Force Base in Coffee County frequently. If you need to sell quickly due to PCS orders or deployment, we can close on your timeline — often in under two weeks.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
