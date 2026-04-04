<?php
/**
 * Template Name: County — Lincoln County
 *
 * WordPress setup:
 *   Slug:     lincoln-county  (under county-pages/ parent)
 *   Template: County — Lincoln County
 */

$county = [
    'slug'          => 'lincoln-county',
    'name'          => 'Lincoln County',
    'county_id'     => 'lincoln',
    'h1'            => 'Sell Your House Fast For Cash in Lincoln County TN',
    'meta_title'    => 'We Buy Houses in Lincoln County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Lincoln County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$275,000',
    'homes_sold'    => '28',
    'avg_days'      => '84',
    'desc1'         => 'Lincoln County is a scenic Southern Middle Tennessee county home to Fayetteville. Known for its historic downtown, rolling hills, and the annual Tennessee Walking Horse celebration, the county offers affordable living and rich heritage. Tennessee Cash For Homes buys houses across all of Lincoln County fast and for cash.',
    'desc2'         => 'Whether you need to sell due to relocation, an inherited property, or financial reasons we are here to help. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Lincoln County offers beautiful rolling farmland and rural residential tracts in the heart of Southern Middle Tennessee. Tennessee Cash For Homes buys Lincoln County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Fayetteville', 'slug' => 'fayetteville', 'has_page' => false],
    ],
];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
