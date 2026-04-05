<?php
/**
 * Template Name: County — Hancock County
 *
 * WordPress setup:
 *   Slug:     hancock-county  (under county-pages/ parent)
 *   Template: County — Hancock County
 */

$county = [
    'slug'          => 'hancock-county',
    'name'          => 'Hancock County',
    'county_id'     => 'hancock',
    'h1'            => 'Sell Your House Fast For Cash in Hancock County TN',
    'meta_title'    => 'We Buy Houses in Hancock County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hancock County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$110,000',
    'homes_sold'    => '6',
    'avg_days'      => '120',
    'desc1'         => 'Hancock County is one of the most remote and tightly knit communities in all of Tennessee. Known locally as OverHome, this small Appalachian county near the Virginia border is home to just over 6,600 residents, with Sneedville as its only incorporated town. The landscape is defined by steep mountain ridges, narrow hollows, and the kind of privacy that is increasingly hard to find anywhere in the Southeast. Local industry includes furniture manufacturing, a roof truss factory, an electric motor plant, and a concrete operation, and a newer call center from Allied Dispatch has brought welcome jobs to an area where the median household income sits around $32,000. Hancock County home values are among the lowest in the state, and property taxes are minimal, making it an area where land ownership remains within reach for working families.',
    'desc2'         => 'The same remoteness that gives Hancock County its character also makes selling a home here uniquely difficult. With only a handful of sales closing each month and homes averaging 120 days on market, the traditional real estate process can feel like it was not designed for a county this small. Nearly 23 percent of housing units are vacant, the local buyer pool is limited, and properties that need work, which many do, can sit indefinitely without an offer. Agent commissions on a low-value home can wipe out what little equity remains. If you need to sell your house in Hancock County, cash home buyers in Hancock County like Tennessee Cash For Homes offer a realistic alternative. We come to you, assess the property as-is, and present a fair offer without requiring repairs, inspections, or mortgage approval.',
    'desc3'         => 'Whether it is a family home in Sneedville, a mountain property up a gravel road, or a house you inherited and cannot maintain from a distance, Tennessee Cash For Homes buys houses throughout all of Hancock County in any condition. We understand this area and we do not let location or condition stand in the way of making a deal. Your situation is welcome here.',
    'land_para'     => 'Hancock County offers some of the most affordable mountain land in Tennessee with wooded tracts and scenic acreage. Tennessee Cash For Homes buys Hancock County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Sneedville', 'slug' => 'sneedville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Sneedville or rural areas of Hancock County?', 'a' => 'Yes. Hancock County is one of Tennessee\'s most rural counties and we buy properties throughout including Sneedville. Distance from a major city does not affect our ability to purchase your home.'],
        ['q' => 'Can I sell a property in Hancock County if I cannot afford to maintain it?', 'a' => 'Many homeowners in Hancock County sell to us because maintaining a property has become too costly. We buy homes as-is so you can walk away without spending another dollar on upkeep.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
