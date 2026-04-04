<?php
/**
 * Template Name: County — Clay County
 *
 * WordPress setup:
 *   Slug:     clay-county  (under county-pages/ parent)
 *   Template: County — Clay County
 */

$county = [
    'slug'          => 'clay-county',
    'name'          => 'Clay County',
    'county_id'     => 'clay',
    'h1'            => 'Sell Your House Fast For Cash in Clay County TN',
    'meta_title'    => 'We Buy Houses in Clay County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Clay County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$135,000',
    'homes_sold'    => '8',
    'avg_days'      => '115',
    'desc1'         => 'Clay County is one of Tennessee\'s smallest and most rural counties, nestled along the Kentucky border in the Upper Cumberland region. Home to Celina on the shores of Dale Hollow Lake, the county is a hidden gem for outdoor enthusiasts. Tennessee Cash For Homes buys houses across all of Clay County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, need to relocate, or simply want a quick hassle free sale we are here to help. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Clay County offers affordable lakefront and rural land along Dale Hollow Lake, one of Tennessee\'s most pristine bodies of water. Tennessee Cash For Homes buys Clay County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Celina', 'slug' => 'celina', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is it difficult to sell a home in a rural county like Clay County?', 'a' => 'Selling on the open market in Clay County can be slow due to low population density and limited buyer demand. We eliminate that problem by buying your home directly for cash. No waiting, no showings, no uncertainty.'],
        ['q' => 'Do you buy properties near Dale Hollow Lake in Clay County?', 'a' => 'Yes. Dale Hollow Lake attracts property owners throughout Clay County. We buy lakefront properties, cabins, and any residential property near the lake regardless of condition.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
