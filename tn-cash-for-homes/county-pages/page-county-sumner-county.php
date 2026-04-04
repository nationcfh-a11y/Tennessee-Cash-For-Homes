<?php
/**
 * Template Name: County — Sumner County
 *
 * WordPress setup:
 *   Slug:     sumner-county  (under county-pages/ parent)
 *   Template: County — Sumner County
 */

$county = [
    'slug'          => 'sumner-county',
    'name'          => 'Sumner County',
    'county_id'     => 'sumner',
    'h1'            => 'Sell Your House Fast For Cash in Sumner County',
    'meta_title'    => 'We Buy Houses in Sumner County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Sumner County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$511,900',
    'homes_sold'    => '68',
    'avg_days'      => '93',
    'desc1'         => 'Sumner County is known for its stunning lakeside communities, strong schools, and growing population. Home to Hendersonville, Gallatin, and White House, the county attracts families from across Middle Tennessee. Tennessee Cash For Homes buys houses across Sumner County fast and for cash.',
    'desc2'         => 'Whether you need to sell quickly due to relocation, downsizing, or financial reasons we are ready to help. No repairs needed, no agent commissions, and we close on your schedule with a fair cash offer.',
    'land_para'     => 'Sumner County\'s scenic lakeside living and booming population have made land a valuable asset. Tennessee Cash For Homes helps Sumner County landowners sell quickly with no commissions or delays.',
    'cities'        => [
        ['name' => 'Hendersonville', 'slug' => 'hendersonville', 'has_page' => true],
        ['name' => 'Gallatin',       'slug' => 'gallatin',       'has_page' => true],
        ['name' => 'White House',    'slug' => 'white-house',    'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is Sumner County considered part of the Nashville metro for home values?', 'a' => 'Yes. Sumner County is one of Nashville\'s most desirable suburban counties. Our cash offers for Gallatin, Hendersonville, and surrounding areas reflect strong Nashville-area market values.'],
        ['q' => 'Do you buy lakefront homes on Old Hickory Lake in Sumner County?', 'a' => 'We buy lakefront properties on Old Hickory Lake and throughout Sumner County. Whether your home needs dock repairs, has an aging seawall, or is in perfect condition, we are interested.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
