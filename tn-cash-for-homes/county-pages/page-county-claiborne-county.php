<?php
/**
 * Template Name: County — Claiborne County
 *
 * WordPress setup:
 *   Slug:     claiborne-county  (under county-pages/ parent)
 *   Template: County — Claiborne County
 */

$county = [
    'slug'          => 'claiborne-county',
    'name'          => 'Claiborne County',
    'county_id'     => 'claiborne',
    'h1'            => 'Sell Your House Fast For Cash in Claiborne County TN',
    'meta_title'    => 'We Buy Houses in Claiborne County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Claiborne County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$165,000',
    'homes_sold'    => '25',
    'avg_days'      => '99',
    'desc1'         => 'Claiborne County sits at the historic crossroads where Tennessee, Virginia, and Kentucky meet at the Cumberland Gap -- the same mountain pass that opened the western frontier centuries ago. Today the county\'s four communities of Tazewell, New Tazewell, Harrogate, and Cumberland Gap are home to a hardworking population supported by employers like DeRoyal Industries, England Furniture, and several other manufacturers that keep the local economy grounded. Lincoln Memorial University in Harrogate adds an educational anchor, while over 400 square miles of mountain scenery give the county a quality of life that Claiborne County home values still reflect at well below state averages.',
    'desc2'         => 'If you want to sell your house in Claiborne County, the traditional real estate market can work against you. With homes averaging 99 days on market and a limited pool of local buyers, many sellers in Tazewell and the surrounding towns wait months without a firm offer. The county\'s older housing stock -- including many homes that need foundation work, roof replacement, or updated electrical systems -- can be nearly impossible to sell to buyers relying on conventional financing. As cash home buyers in Claiborne County, we purchase properties as-is with no inspections, no lender requirements, and no drawn-out timelines.',
    'desc3'         => 'From a family home in New Tazewell to a mountain property near Cumberland Gap, Tennessee Cash For Homes buys houses throughout all of Claiborne County in any condition. Whether you are dealing with an inherited estate, a property with deferred maintenance, or any other situation, we will work with you to close on your schedule.',
    'land_para'     => 'Claiborne County offers affordable mountain land near the Cumberland Gap with wooded tracts and rural acreage. Tennessee Cash For Homes buys Claiborne County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Tazewell', 'slug' => 'tazewell', 'has_page' => false],
        ['name' => 'Harrogate', 'slug' => 'harrogate', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Tazewell or New Tazewell in Claiborne County?', 'a' => 'Yes. We buy homes throughout Claiborne County including Tazewell, New Tazewell, Cumberland Gap, and Harrogate. No matter the location or condition, we are interested in making you an offer.'],
        ['q' => 'Can I sell an inherited property in Claiborne County that needs major repairs?', 'a' => 'We regularly buy inherited properties in Claiborne County that need significant work. You do not need to make any repairs. We buy as-is and can work with you through probate if needed.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
