<?php
/**
 * Template Name: County — Weakley County
 *
 * WordPress setup:
 *   Slug:     weakley-county  (under county-pages/ parent)
 *   Template: County — Weakley County
 */

$county = [
    'slug'          => 'weakley-county',
    'name'          => 'Weakley County',
    'county_id'     => 'weakley',
    'h1'            => 'Sell Your House Fast For Cash in Weakley County TN',
    'meta_title'    => 'We Buy Houses in Weakley County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Weakley County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '24',
    'avg_days'      => '92',
    'desc1'         => 'Weakley County is a Northwest Tennessee community of roughly 33,000 residents where the University of Tennessee at Martin provides college-town energy alongside the quieter rhythms of Dresden, the county seat, and smaller towns like Gleason and Greenfield. UT Martin is the county\'s economic anchor, supporting local businesses, rental housing demand, and a steady flow of students and faculty. Weakley County home values remain remarkably affordable -- the median property value sits well below the state average, making it one of the more accessible markets in Tennessee for first-time buyers and investors alike. With projected appreciation of around 4 percent through 2026, there is genuine upward momentum here.',
    'desc2'         => 'That affordability, however, can make selling through traditional channels more challenging than homeowners expect. With a median household income around $49,500 and a smaller buyer pool outside of the UT Martin rental market, homes in Dresden or Greenfield may sit for weeks without strong offers. Average rents near $942 a month attract landlords, but if you are ready to exit the Weakley County real estate market rather than manage tenants, the timeline on a traditional sale can stretch. Cash home buyers in Weakley County like us offer a faster path -- we buy based on real Weakley County home values, with no agent fees, no financing delays, and a closing date you choose.',
    'desc3'         => 'Whatever your reason for selling -- an inherited home in Dresden, a rental property near the UT Martin campus that has become a burden, financial hardship, or a house that needs more work than you want to put into it -- Tennessee Cash For Homes buys houses throughout all of Weakley County in any condition. From student rentals in Martin to family homes in Greenfield and Gleason, we are ready to help.',
    'land_para'     => 'Weakley County offers affordable farmland and residential lots in a growing Northwest Tennessee community. Tennessee Cash For Homes buys Weakley County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dresden', 'slug' => 'dresden', 'has_page' => false],
        ['name' => 'Martin', 'slug' => 'martin', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Martin, Dresden, or Greenfield in Weakley County?', 'a' => 'Yes. We purchase homes throughout Weakley County including Martin (home of UT Martin), Dresden, and Greenfield. Student housing and family homes are all welcome.'],
        ['q' => 'Can I sell a property near UT Martin in Weakley County?', 'a' => 'We buy properties near the University of Tennessee at Martin campus and throughout Weakley County. Investment properties, rentals, and owner-occupied homes are all ones we purchase.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
