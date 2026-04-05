<?php
/**
 * Template Name: County - Fentress County
 *
 * WordPress setup:
 *   Slug:     fentress-county  (under county-pages/ parent)
 *   Template: County - Fentress County
 */

$county = [
    'slug'          => 'fentress-county',
    'name'          => 'Fentress County',
    'county_id'     => 'fentress',
    'h1'            => 'Sell Your House Fast For Cash in Fentress County TN',
    'meta_title'    => 'We Buy Houses in Fentress County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Fentress County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$175,000',
    'homes_sold'    => '15',
    'avg_days'      => '100',
    'desc1'         => 'Perched on the Upper Cumberland Plateau along the Kentucky border, Fentress County is defined by wooded ridges, clear streams, and the kind of quiet that draws people to the mountains in the first place. Jamestown serves as the county seat and the gateway to the Big South Fork National River and Recreation Area, making the area a destination for hiking, horseback riding, and paddling. The local economy runs on timber, agriculture, small businesses, and the steady flow of outdoor recreation visitors. Fentress County home values remain among the most affordable in the state, with a slower real estate pace that reflects the area\'s rural, independent character.',
    'desc2'         => 'That affordability is a strength for buyers, but it creates real challenges when you need to sell your house in Fentress County. The market here is firmly buyer-friendly, with homes sitting on the market for months and a limited pool of qualified local purchasers. Properties on gravel roads, cabins with well water, or older homes that need roof or septic work can be especially hard to move through traditional listings. Cash home buyers in Fentress County like us bypass all of that. We make fair offers regardless of condition, we do not require inspections or appraisals, and we can close on a timeline that works for you.',
    'desc3'         => 'Whether you own a cabin near the Big South Fork, a family home in Jamestown, or a wooded tract with a house that has sat vacant for years, Tennessee Cash For Homes buys properties throughout all of Fentress County in any condition. Your situation does not need to be perfect for us to help. We are here to make the process simple and certain.',
    'land_para'     => 'Fentress County offers affordable mountain land near the Big South Fork National Recreation Area. Tennessee Cash For Homes buys Fentress County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Jamestown', 'slug' => 'jamestown', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties near Big South Fork in Fentress County?', 'a' => 'Yes. Fentress County borders the Big South Fork National River and Recreation Area. We buy homes, cabins, and properties throughout the county including Jamestown and surrounding communities.'],
        ['q' => 'Can I sell a remote or off-grid property in Fentress County?', 'a' => 'We buy remote and off-grid properties in Fentress County. Gravel road access, well water, or lack of utilities do not prevent us from making you a fair cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
