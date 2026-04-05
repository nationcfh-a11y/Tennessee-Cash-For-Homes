<?php
/**
 * Template Name: County - Anderson County
 *
 * WordPress setup:
 *   Slug:     anderson-county  (under county-pages/ parent)
 *   Template: County - Anderson County
 */

$county = [
    'slug'          => 'anderson-county',
    'name'          => 'Anderson County',
    'county_id'     => 'anderson',
    'h1'            => 'Sell Your House Fast For Cash in Anderson County TN',
    'meta_title'    => 'We Buy Houses in Anderson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Anderson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '68',
    'avg_days'      => '78',
    'desc1'         => 'Anderson County is defined by Oak Ridge, the Secret City born during World War II that remains a powerhouse of scientific research and federal employment. Oak Ridge National Laboratory and the Y-12 National Security Complex anchor the local economy, and neighborhoods like Woodland, the historic Scarboro community, and newer developments such as Forest Creek Village and Summit Place reflect a housing stock that spans 1940s-era cottages to modern construction. Clinton, the county seat along the Clinch River, adds small-town character while Norris preserves its planned-community roots from the TVA era. Anderson County home values sit well below the national median, yet strong job growth from the federal sector keeps demand steady across the area.',
    'desc2'         => 'If you are looking to sell your house in Anderson County, the local real estate market presents some unique challenges. Many Oak Ridge homes were built in the 1940s and 1950s with outdated floor plans, aluminum wiring, or deferred maintenance that can scare off traditional buyers who need financing. Homes in Clinton and the surrounding rural areas can sit on the market for weeks waiting for the right offer. As cash home buyers in Anderson County, we skip the inspection negotiations, appraisal contingencies, and drawn-out closing timelines that slow down conventional sales. Whether your property is a mid-century ranch off the Oak Ridge Turnpike or a lakeside cabin on Norris Lake, we make a fair offer and close when you are ready.',
    'desc3'         => 'No matter what situation you are facing - relocation for work at the lab, an inherited home you cannot maintain, or a property that simply needs more work than you can take on - Tennessee Cash For Homes purchases houses throughout all of Anderson County in any condition. From the neighborhoods of Oak Ridge and Clinton to the rural stretches near Norris and Marlow, we are ready to help you move forward.',
    'land_para'     => 'Anderson County offers diverse land opportunities from wooded mountain tracts to lakefront properties along Norris Lake and Melton Hill Lake. Tennessee Cash For Homes buys Anderson County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Clinton', 'slug' => 'clinton', 'has_page' => false],
        ['name' => 'Oak Ridge', 'slug' => 'oak-ridge', 'has_page' => false],
        ['name' => 'Norris', 'slug' => 'norris', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Can I sell an older home near Oak Ridge in Anderson County?', 'a' => 'Yes. Many homes in the Oak Ridge area were built in the 1940s and 1950s and may need significant updates. We buy older homes in Anderson County regardless of age or condition, including those with outdated electrical, plumbing, or foundation issues.'],
        ['q' => 'Do you buy houses affected by environmental concerns in Anderson County?', 'a' => 'We understand that Anderson County has a unique history tied to the Oak Ridge National Laboratory. We evaluate every property individually and buy homes in all situations across Anderson County.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
