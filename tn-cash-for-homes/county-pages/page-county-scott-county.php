<?php
/**
 * Template Name: County - Scott County
 *
 * WordPress setup:
 *   Slug:     scott-county  (under county-pages/ parent)
 *   Template: County - Scott County
 */

$county = [
    'slug'          => 'scott-county',
    'name'          => 'Scott County',
    'county_id'     => 'scott',
    'h1'            => 'Sell Your House Fast For Cash in Scott County TN',
    'meta_title'    => 'We Buy Houses in Scott County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Scott County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$145,000',
    'homes_sold'    => '16',
    'avg_days'      => '102',
    'desc1'         => 'Scott County sits atop the northern Cumberland Plateau along the Tennessee-Kentucky border, home to the Big South Fork National River and Recreation Area - the fifth-largest national park in the eastern United States. Huntsville serves as the county seat and houses the consolidated high school, while Oneida is the commercial hub along U.S. Highway 27 and Winfield anchors the county\'s northern end. Manufacturers like Great Dane Trailers and Takahata Precision Tennessee have provided industrial jobs, but Scott County\'s real draw is its affordable mountain living, with median home prices well below $150,000 and thousands of acres of public forest just outside the door.',
    'desc2'         => 'That affordability comes with a trade-off: the Scott County real estate market moves slowly, with homes averaging over 100 days on market. Buyer pools are small, financing can be tricky on older mountain homes and cabins, and many properties sit on well water and septic systems that complicate inspections. If you need to sell your house in Scott County without waiting months for a qualified buyer, cash home buyers in Scott County like Tennessee Cash For Homes can close in as little as two weeks - no appraisals, no repair negotiations, and no agent fees eating into your proceeds.',
    'desc3'         => 'From a cabin near the Big South Fork to a family home in Oneida or Huntsville, we buy houses throughout all of Scott County in any condition. Whether you are dealing with an inherited property, deferred maintenance, or simply want a fast and certain sale, we are here to help with a fair cash offer on your timeline.',
    'land_para'     => 'Scott County offers affordable mountain land near the Big South Fork with wooded tracts and scenic acreage. Tennessee Cash For Homes buys Scott County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Huntsville', 'slug' => 'huntsville-tn', 'has_page' => false],
        ['name' => 'Oneida', 'slug' => 'oneida', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Oneida or Huntsville in Scott County?', 'a' => 'Yes. We buy homes throughout Scott County including Oneida, Huntsville, and Winfield. We are experienced with properties in the Cumberland Plateau region.'],
        ['q' => 'Can I sell a property in Scott County near the Big South Fork?', 'a' => 'We buy properties near the Big South Fork and throughout Scott County. Mountain homes, cabins, and rural residential properties are all welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
