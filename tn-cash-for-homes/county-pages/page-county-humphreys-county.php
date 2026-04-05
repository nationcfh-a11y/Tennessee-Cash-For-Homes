<?php
/**
 * Template Name: County — Humphreys County
 *
 * WordPress setup:
 *   Slug:     humphreys-county  (under county-pages/ parent)
 *   Template: County — Humphreys County
 */

$county = [
    'slug'          => 'humphreys-county',
    'name'          => 'Humphreys County',
    'county_id'     => 'humphreys',
    'h1'            => 'Sell Your House Fast For Cash in Humphreys County TN',
    'meta_title'    => 'We Buy Houses in Humphreys County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Humphreys County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '18',
    'avg_days'      => '88',
    'desc1'         => 'Humphreys County has a story of resilience that few Tennessee communities can match. The county seat of Waverly was devastated by catastrophic flooding in August 2021, when 17 inches of rain fell in less than 24 hours, destroying over 270 homes and damaging hundreds more. The community has rebuilt with determination, though some scars remain. Beyond Waverly, the county includes New Johnsonville, where the TVA\'s combustion turbine plant sits on 720 acres and powers hundreds of thousands of homes, and McEwen, which is seeing new industrial investment from companies like Nashville Wire Products. The Tennessee River defines much of the county\'s western border, and the TVA\'s presence since the 1930s transformed the local economy from agriculture to a mix of manufacturing, energy, and services.',
    'desc2'         => 'The Humphreys County real estate market is shaped by both opportunity and complication. Flood history in parts of Waverly can make traditional sales difficult, with buyers wary of risk and insurance costs adding uncertainty. In New Johnsonville and McEwen, older industrial-era housing may need significant updates that sellers cannot afford. Homes across the county average around 88 days on market, and properties with damage, deferred maintenance, or complicated histories can take much longer. If you want to sell your house in Humphreys County without navigating those hurdles, cash home buyers in Humphreys County like Tennessee Cash For Homes buy properties in any condition. No repairs, no agent fees, and no waiting for buyers who may never come.',
    'desc3'         => 'Whether your home was affected by flooding in Waverly, you have a property near the Tennessee River in New Johnsonville, or you own a house in McEwen that simply needs to be sold, we buy houses throughout all of Humphreys County in any condition. Flood damage, fire damage, vacancy, liens, or just years of wear, none of it changes our willingness to make you a fair cash offer and close on your timeline.',
    'land_para'     => 'Humphreys County offers waterfront and rural land along the Tennessee River at competitive prices. Tennessee Cash For Homes buys Humphreys County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Waverly', 'slug' => 'waverly', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Waverly or New Johnsonville in Humphreys County?', 'a' => 'Yes. We buy homes throughout Humphreys County including Waverly, New Johnsonville, and McEwen. We are familiar with the area and provide fair cash offers.'],
        ['q' => 'Can I sell a flood-damaged home in Humphreys County?', 'a' => 'Humphreys County experienced devastating flooding in recent years. We buy flood-damaged homes as-is in Waverly and throughout the county. You do not need to make any repairs.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
