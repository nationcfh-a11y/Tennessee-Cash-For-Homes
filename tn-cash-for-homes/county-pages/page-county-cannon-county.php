<?php
/**
 * Template Name: County — Cannon County
 *
 * WordPress setup:
 *   Slug:     cannon-county  (under county-pages/ parent)
 *   Template: County — Cannon County
 */

$county = [
    'slug'          => 'cannon-county',
    'name'          => 'Cannon County',
    'county_id'     => 'cannon',
    'h1'            => 'Sell Your House Fast For Cash in Cannon County TN',
    'meta_title'    => 'We Buy Houses in Cannon County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Cannon County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$260,000',
    'homes_sold'    => '4',
    'avg_days'      => '52',
    'desc1'         => 'Cannon County is a small, tight-knit community in Middle Tennessee where the arts scene punches well above its weight. The Arts Center of Cannon County in Woodbury draws tens of thousands of visitors annually for live theatre, concerts, and gallery exhibitions, and the Off the Beaten Path Studio Tour each October opens local artists\' studios across the rolling countryside. Woodbury, the county seat, sits just a short drive from Murfreesboro and about an hour from Nashville, giving residents access to urban amenities while preserving the rural character that defines the area. As growth radiates outward from Murfreesboro, Cannon County home values have been climbing — the median recently crossed $300,000 — and properties here are selling near asking price, signaling growing interest from buyers seeking affordable land and small-town living.',
    'desc2'         => 'Despite rising values, selling a home in Cannon County through traditional channels has its challenges. With only a handful of homes selling each month, the buyer pool is small, and listings that need updates or sit on well water and septic systems — which describes much of the housing stock here — can face longer timelines and tighter financing options. If you want to sell your house in Cannon County without the wait, cash home buyers in Cannon County like us offer a faster path. We buy homes as-is in Woodbury and throughout the county with no agent commissions, no repair requests, and no lender delays. Our offers reflect the real value of your property in today\'s local market.',
    'desc3'         => 'Whatever has brought you to this decision — an inherited property you cannot maintain from a distance, a home that needs more work than you are willing to invest, or simply a desire for a fresh start — Tennessee Cash For Homes buys houses throughout all of Cannon County in any condition. From Woodbury to the quiet back roads of the county, we are here to help you sell on your terms.',
    'land_para'     => 'Cannon County offers rolling hills, wooded acreage, and rural lots at very competitive prices. As growth expands outward from Murfreesboro land in Cannon County is becoming increasingly attractive. Tennessee Cash For Homes buys Cannon County land quickly with no commissions.',
    'cities'        => [
        ['name' => 'Woodbury', 'slug' => 'woodbury', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'Is it hard to sell a home in a small county like Cannon County?', 'a' => 'Selling on the traditional market in a small county like Cannon County can be challenging due to limited buyer demand. That is where we come in. We buy homes directly for cash in Woodbury and throughout Cannon County, eliminating the uncertainty of waiting for a buyer.'],
        ['q' => 'Do you buy homes with well water and septic systems in Cannon County?', 'a' => 'Yes. Many rural Cannon County homes use well water and septic systems. We buy these properties regardless of the condition of the well or septic system.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
