<?php
/**
 * Template Name: County — Dyer County
 *
 * WordPress setup:
 *   Slug:     dyer-county  (under county-pages/ parent)
 *   Template: County — Dyer County
 */

$county = [
    'slug'          => 'dyer-county',
    'name'          => 'Dyer County',
    'county_id'     => 'dyer',
    'h1'            => 'Sell Your House Fast For Cash in Dyer County TN',
    'meta_title'    => 'We Buy Houses in Dyer County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Dyer County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$168,000',
    'homes_sold'    => '35',
    'avg_days'      => '88',
    'desc1'         => 'Dyer County is the economic engine of Northwest Tennessee, with Dyersburg serving as a regional hub that punches well above its weight. Major manufacturers like ERMCO (the county\'s largest employer with nearly 900 workers building distribution transformers), Tyson, NSK, Caterpillar, and Nortek Global HVAC provide a manufacturing base that few rural Tennessee counties can match. The city also supports a 225-bed regional hospital, a regional mall, and Dyersburg State Community College. Beyond Dyersburg, communities like Newbern and Trimble maintain the county\'s agricultural roots in cotton, soybeans, and corn. Dyer County home values remain affordable -- the median sits around $195,000 -- making it accessible for the workforce that drives the local economy.',
    'desc2'         => 'Despite Dyer County\'s strong employment base, selling your house in Dyer County through traditional channels still takes time and patience. Properties average 88 days on market, and homes needing updates compete for attention against affordably priced newer listings. The Forked Deer River floodplain runs through parts of the county, and flood-damaged or flood-zone properties face serious resistance from buyers dependent on conventional financing and flood insurance requirements. In Dyersburg\'s older neighborhoods, homes with deferred maintenance, outdated electrical or plumbing, or cosmetic wear can sit for months. As cash home buyers in Dyer County, we purchase properties regardless of flood history, condition, or location -- no inspections, no insurance contingencies, and no delays.',
    'desc3'         => 'Whether you own a home in downtown Dyersburg, a property near the Forked Deer River, or a house in Newbern or anywhere else in the county, Tennessee Cash For Homes buys houses throughout all of Dyer County in any condition. We are here to provide a straightforward cash offer and close on whatever timeline works best for you.',
    'land_para'     => 'Dyer County offers productive farmland and affordable residential lots in the heart of Northwest Tennessee. Tennessee Cash For Homes buys Dyer County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dyersburg', 'slug' => 'dyersburg', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Dyersburg in Dyer County?', 'a' => 'Yes. Dyersburg is the county seat and we actively buy homes throughout Dyersburg and all of Dyer County. Whether your home is downtown or in a rural area, we will make you a cash offer.'],
        ['q' => 'Can I sell a property in Dyer County that has flood damage?', 'a' => 'We buy homes in Dyer County that have experienced flooding from the Forked Deer River or other sources. Flood-damaged properties are purchased as-is with no repairs required.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
