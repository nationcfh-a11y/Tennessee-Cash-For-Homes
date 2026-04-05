<?php
/**
 * Template Name: County - Dickson County
 *
 * WordPress setup:
 *   Slug:     dickson-county  (under county-pages/ parent)
 *   Template: County - Dickson County
 */

$county = [
    'slug'          => 'dickson-county',
    'name'          => 'Dickson County',
    'county_id'     => 'dickson',
    'h1'            => 'Sell Your House Fast For Cash in Dickson County',
    'meta_title'    => 'We Buy Houses in Dickson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Dickson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$299,000',
    'homes_sold'    => '38',
    'avg_days'      => '81',
    'desc1'         => 'Dickson County has become one of Nashville\'s most popular westward expansion corridors, and the numbers reflect it - median home prices in the city of Dickson have climbed to around $400,000 as more buyers discover its small-town character and manageable commute along I-40 and Highway 70. The county seat of Dickson anchors a population of over 15,500, while White Bluff, Burns, and Charlotte each offer their own personality. Montgomery Bell State Park in Burns provides hiking, camping, boating, and the Clement Golf Course, making the area attractive to outdoor enthusiasts. Dickson County home values continue to benefit from Nashville spillover demand, particularly as families and first-time buyers seek more space at prices still below Davidson and Williamson county levels.',
    'desc2'         => 'Even in a market with Nashville-driven demand, selling your house in Dickson County is not always fast or easy. White Bluff\'s status as a seller\'s market helps homes in newer subdivisions, but older properties in Dickson, Burns, and Charlotte that need roof work, foundation repairs, or cosmetic updates often struggle to compete with new construction. Homes on rural lots can face appraisal challenges when comparable sales are scarce, and properties with well and septic systems add inspection hurdles that delay or kill deals. With homes averaging 81 days on market countywide, sellers who cannot wait or afford pre-sale repairs need a different path. As cash home buyers in Dickson County, we skip the appraisals, inspections, and lender timelines entirely.',
    'desc3'         => 'From a home in a Dickson subdivision to a rural property near Burns or White Bluff, Tennessee Cash For Homes buys houses throughout all of Dickson County in any condition. Whatever is motivating your sale - relocation, financial pressure, an inherited home, or anything else - we are ready to make a fair offer and close on your schedule.',
    'land_para'     => 'Dickson County offers rural land and residential lots at competitive prices. As Nashville\'s growth spreads westward land in Dickson County is becoming increasingly valuable. Tennessee Cash For Homes buys land quickly with no commissions.',
    'cities'        => [
        ['name' => 'Dickson', 'slug' => 'dickson', 'has_page' => false],
        ['name' => 'Burns',   'slug' => 'burns',   'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is Dickson County close enough to Nashville to get strong cash offers?', 'a' => 'Yes. Dickson County is part of the Nashville commuter belt and property values reflect its proximity to the metro area. Our cash offers account for Dickson County\'s growing demand and convenient location.'],
        ['q' => 'Do you buy homes in Dickson, White Bluff, or Burns in Dickson County?', 'a' => 'We purchase homes throughout Dickson County including the cities of Dickson, White Bluff, Burns, and Charlotte. All conditions and situations are welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
