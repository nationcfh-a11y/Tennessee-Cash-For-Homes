<?php
/**
 * Template Name: County — Bradley County
 *
 * WordPress setup:
 *   Slug:     bradley-county  (under county-pages/ parent)
 *   Template: County — Bradley County
 */

$county = [
    'slug'          => 'bradley-county',
    'name'          => 'Bradley County',
    'county_id'     => 'bradley',
    'h1'            => 'Sell Your House Fast For Cash in Bradley County TN',
    'meta_title'    => 'We Buy Houses in Bradley County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Bradley County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$295,000',
    'homes_sold'    => '89',
    'avg_days'      => '74',
    'desc1'         => 'Bradley County is one of Southeast Tennessee\'s fastest-growing areas, centered around Cleveland and supported by a diverse industrial base that includes Cleveland-Cliffs, Amaero International, Snap-on, and dozens of manufacturers representing over $800 million in recent investment. Home to Lee University and the Church of God international headquarters, Cleveland blends a college-town energy with strong blue-collar roots. The county\'s location along I-75 between Knoxville and Chattanooga gives residents easy access to two major metro areas while keeping the cost of living well below either city. Bradley County home values have seen steady appreciation, with the median sitting around $230,000 to $295,000 depending on the area and property type.',
    'desc2'         => 'Despite the growth, the Bradley County real estate market is not without its challenges for sellers. City and county officials have identified workforce housing as a pressing need, which means many existing homes — particularly older properties near downtown Cleveland or in the rural stretches toward the Ocoee — can sit on the market if they need updates or do not fit the mold that conventional buyers are looking for. If you need to sell your house in Bradley County quickly, cash home buyers in Bradley County like us provide a straightforward alternative. We purchase homes as-is with no agent commissions, no repair requests, and no appraisal contingencies, so you avoid the weeks of showings and negotiations that come with a traditional listing.',
    'desc3'         => 'Whatever your situation — whether you are a landlord tired of managing a rental property, facing financial difficulties, relocating for a new job, or holding an inherited home you cannot maintain — Tennessee Cash For Homes buys houses throughout all of Bradley County in any condition. From the neighborhoods around Lee University to the rural communities outside Cleveland, we are ready to help.',
    'land_para'     => 'Bradley County offers a mix of residential lots, farmland, and wooded tracts at competitive prices. Tennessee Cash For Homes buys Bradley County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Cleveland', 'slug' => 'cleveland', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Cleveland, Tennessee in Bradley County?', 'a' => 'Yes. Cleveland is the largest city in Bradley County and we actively purchase homes throughout the area. Whether your home is near downtown Cleveland or in the surrounding communities, we make fair cash offers.'],
        ['q' => 'Can I sell a rental property in Bradley County?', 'a' => 'We buy rental properties in Bradley County whether they are occupied with tenants or vacant. You do not need to wait for a lease to expire. We handle tenant situations regularly.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
