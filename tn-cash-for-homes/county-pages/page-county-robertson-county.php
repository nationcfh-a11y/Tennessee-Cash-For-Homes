<?php
/**
 * Template Name: County — Robertson County
 *
 * WordPress setup:
 *   Slug:     robertson-county  (under county-pages/ parent)
 *   Template: County — Robertson County
 */

$county = [
    'slug'          => 'robertson-county',
    'name'          => 'Robertson County',
    'county_id'     => 'robertson',
    'h1'            => 'Sell Your House Fast For Cash in Robertson County',
    'meta_title'    => 'We Buy Houses in Robertson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Robertson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$310,000',
    'homes_sold'    => '41',
    'avg_days'      => '72',
    'desc1'         => 'Robertson County has deep roots in Middle Tennessee agriculture -- once known as the home of the world\'s finest dark-fired tobacco -- and today it is one of Nashville\'s fastest-growing northern suburbs. Springfield, the county seat, blends historic downtown charm with modern manufacturing employers, while communities like Greenbrier and White House attract families looking for quality schools and a quieter pace just 30 minutes from downtown Nashville. Robertson County home values have climbed steadily as buyers discover what locals already know: you get more land, more house, and more community here than almost anywhere else in the metro.',
    'desc2'         => 'That rising demand is great news if you want to sell your house in Robertson County, but the traditional listing process can still be a challenge. Many Springfield and Greenbrier homes were built in the 1970s through 1990s and need roof, HVAC, or foundation work that scares off financed buyers. With average days on market stretching past two months in the Robertson County real estate market, waiting for the right retail offer can feel like a gamble. Cash home buyers in Robertson County like Tennessee Cash For Homes eliminate that uncertainty -- no repair requests, no agent commissions, and no deals falling through at the last minute.',
    'desc3'         => 'No matter what situation you are facing -- whether it is an inherited farmhouse on the edge of Springfield, a rental property in White House that has become more trouble than it is worth, or a home anywhere in between -- we buy houses throughout all of Robertson County in any condition. Just reach out for a no-obligation cash offer and close on the timeline that works for you.',
    'land_para'     => 'Robertson County\'s proximity to Nashville and its expanding suburban communities make land increasingly valuable. Tennessee Cash For Homes buys Robertson County land quickly with no commissions and no surveys required.',
    'cities'        => [
        ['name' => 'Springfield', 'slug' => 'springfield',  'has_page' => false],
        ['name' => 'White House', 'slug' => 'white-house',  'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is Robertson County part of the Nashville market for home values?', 'a' => 'Yes. Robertson County is part of the Nashville metropolitan area and has seen significant growth. Our cash offers reflect Nashville-area market conditions for Springfield, Greenbrier, White House, and all of Robertson County.'],
        ['q' => 'Do you buy homes affected by Robertson County\'s agricultural zoning?', 'a' => 'We buy properties in Robertson County regardless of zoning, including agricultural-zoned parcels with homes. We handle any zoning complexities as part of the purchase process.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
