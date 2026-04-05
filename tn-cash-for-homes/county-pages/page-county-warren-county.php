<?php
/**
 * Template Name: County — Warren County
 *
 * WordPress setup:
 *   Slug:     warren-county  (under county-pages/ parent)
 *   Template: County — Warren County
 */

$county = [
    'slug'          => 'warren-county',
    'name'          => 'Warren County',
    'county_id'     => 'warren',
    'h1'            => 'Sell Your House Fast For Cash in Warren County TN',
    'meta_title'    => 'We Buy Houses in Warren County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Warren County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$250,000',
    'homes_sold'    => '19',
    'avg_days'      => '104',
    'desc1'         => 'Warren County is proudly known as the \'Nursery Capital of the World,\' with over 400 nurseries generating more than $300 million in annual revenue from the Highland Rim\'s near-perfect growing conditions. McMinnville, the county seat, anchors a community where agriculture and small-town character define daily life. Warren County home values remain well below the national average -- the median sale price recently came in around $271,000, which is roughly 37 percent lower than the national median -- and the overall cost of living runs about 12 percent below the U.S. average. That affordability, combined with the scenic countryside around Morrison and Viola, continues to attract new residents.',
    'desc2'         => 'While Warren County real estate has seen encouraging momentum -- home prices were up nearly 18 percent year-over-year recently and days on market have dropped from 96 to around 78 -- selling through traditional channels still means weeks of showings, inspections, and negotiations. For homeowners who need to sell a house in Warren County on a tighter timeline, whether it is a property near the nursery district or an older home in McMinnville, that wait can be costly. Cash home buyers in Warren County like us cut through the process: we make a fair offer based on current local conditions, handle everything as-is, and close without agent fees or drawn-out financing contingencies.',
    'desc3'         => 'Whatever your reason for selling -- an inherited property, financial pressure, a home that needs extensive repairs, or a life change that calls for a quick transition -- Tennessee Cash For Homes buys houses throughout all of Warren County in any condition. From homes along the McMinnville square to farmhouses in Morrison and Viola, we purchase properties across the entire county.',
    'land_para'     => 'Warren County offers beautiful rural land on the Highland Rim including farmland, nursery properties, and wooded acreage. Tennessee Cash For Homes buys Warren County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'McMinnville', 'slug' => 'mcminnville', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in McMinnville or Morrison in Warren County?', 'a' => 'Yes. We purchase homes throughout Warren County including McMinnville, Morrison, and Viola. We are familiar with the local nursery and agriculture community and buy all property types.'],
        ['q' => 'Can I sell a property in Warren County that is near the nursery district?', 'a' => 'Warren County is known as the Nursery Capital of the World and we buy all types of properties in the area including homes near nursery operations, farms, and residential properties.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
