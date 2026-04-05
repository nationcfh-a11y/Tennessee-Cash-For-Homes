<?php
/**
 * Template Name: County - Washington County
 *
 * WordPress setup:
 *   Slug:     washington-county  (under county-pages/ parent)
 *   Template: County - Washington County
 */

$county = [
    'slug'          => 'washington-county',
    'name'          => 'Washington County',
    'county_id'     => 'washington',
    'h1'            => 'Sell Your House Fast For Cash in Washington County',
    'meta_title'    => 'We Buy Houses in Washington County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Washington County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$295,000',
    'homes_sold'    => '98',
    'avg_days'      => '72',
    'desc1'         => 'Washington County is the economic heart of Northeast Tennessee\'s Tri-Cities region, home to both Johnson City and Jonesborough - Tennessee\'s oldest town, founded in 1779. With a population exceeding 133,000, the county benefits from major employers in healthcare, education, and an expanding tech sector. East Tennessee State University brings 15,000 students and significant research investment, while the area\'s healthcare systems continue to grow. Johnson City regularly ranks among the nation\'s top small metros for families, retirees, and business-friendly climate, and the county consistently maintains one of the 10 lowest unemployment rates among Tennessee\'s 95 counties.',
    'desc2'         => 'The Washington County real estate market moves at a solid pace, but even in a healthy market, individual circumstances can make a traditional sale impractical. Historic homes in downtown Jonesborough may come with renovation costs and historic district requirements that scare off conventional buyers. Older neighborhoods in Johnson City near ETSU can have deferred maintenance that makes financing difficult. If you want to sell your house in Washington County without navigating months of showings and contingencies, cash home buyers in Washington County like us offer a direct alternative - a fair offer based on actual Washington County home values, no repair demands, and a closing date on your terms.',
    'desc3'         => 'Whatever your situation - whether you have inherited a property in Jonesborough, own a rental near the ETSU campus that has become more trouble than it is worth, or need to relocate quickly for work - Tennessee Cash For Homes buys houses throughout all of Washington County in any condition. From historic homes on Jonesborough\'s Main Street to subdivisions across Johnson City, we are ready to help.',
    'land_para'     => 'Washington County\'s growing population and strong economy have made land increasingly desirable. Tennessee Cash For Homes buys Washington County land quickly with no commissions, no surveys required, and flexible closing.',
    'cities'        => [
        ['name' => 'Johnson City', 'slug' => 'johnson-city', 'has_page' => false],
        ['name' => 'Jonesborough', 'slug' => 'jonesborough', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Johnson City or Jonesborough in Washington County?', 'a' => 'Yes. We buy homes throughout Washington County including Johnson City, Jonesborough (Tennessee\'s oldest town), and all surrounding areas. We are active in the Tri-Cities market.'],
        ['q' => 'Can I sell a historic home in Jonesborough in Washington County?', 'a' => 'We buy historic homes in Jonesborough and throughout Washington County. You do not need to worry about restoration costs or historic district regulations when selling to us.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
