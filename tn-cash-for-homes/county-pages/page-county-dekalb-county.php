<?php
/**
 * Template Name: County - DeKalb County
 *
 * WordPress setup:
 *   Slug:     dekalb-county  (under county-pages/ parent)
 *   Template: County - DeKalb County
 */

$county = [
    'slug'          => 'dekalb-county',
    'name'          => 'DeKalb County',
    'county_id'     => 'dekalb',
    'h1'            => 'Sell Your House Fast For Cash in DeKalb County TN',
    'meta_title'    => 'We Buy Houses in DeKalb County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in DeKalb County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$255,000',
    'homes_sold'    => '16',
    'avg_days'      => '89',
    'desc1'         => 'DeKalb County is Middle Tennessee\'s lakefront gem, defined by Center Hill Lake and its 415 miles of shoreline that make it one of the state\'s top twenty lake-home markets. Smithville, the county seat, serves as the hub for over 18,000 residents and is known for its charming mix of historic 19th-century homes and newer lakeside developments. Smaller communities like Alexandria, Liberty, Dowelltown, and Temperance Hall round out the county\'s rural character. Located about 60 miles southeast of Nashville via I-40, DeKalb County attracts weekend visitors, retirees, and remote workers drawn to the combination of lake living and Nashville accessibility. DeKalb County home values have climbed as demand for Center Hill Lake property has grown, but the area remains far more affordable than comparable lake communities in East Tennessee.',
    'desc2'         => 'If you are looking to sell your house in DeKalb County, the market can be surprisingly uneven. Turnkey lakefront homes near Center Hill attract strong interest, but properties in Smithville\'s older neighborhoods, rural residences around Dowelltown, and homes needing significant updates can sit for months without a serious offer. Manufactured homes on owned land - common throughout the county - face particular financing challenges that limit the buyer pool. With homes averaging 89 days on market countywide, sellers who need a quick resolution often find themselves trapped between market expectations and the reality of their property\'s condition. As cash home buyers in DeKalb County, we purchase all property types without the complications of appraisals, inspections, or lender requirements.',
    'desc3'         => 'Whether you own a lake house on Center Hill, a historic home in Smithville, or a rural property in any corner of the county, Tennessee Cash For Homes buys houses throughout all of DeKalb County in any condition. We handle the paperwork and close on your timeline - your situation does not change our willingness to make a fair offer.',
    'land_para'     => 'DeKalb County offers exceptional waterfront and rural land around Center Hill Lake including residential lots and wooded tracts. Tennessee Cash For Homes buys DeKalb County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Smithville', 'slug' => 'smithville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Smithville or near Center Hill Lake in DeKalb County?', 'a' => 'Yes. We buy homes throughout DeKalb County including Smithville and the Center Hill Lake area. Lake properties, in-town homes, and rural residences are all properties we purchase for cash.'],
        ['q' => 'Can I sell a manufactured home in DeKalb County?', 'a' => 'We buy manufactured and mobile homes in DeKalb County when they are on owned land. Contact us with your property details and we will provide a fair cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
