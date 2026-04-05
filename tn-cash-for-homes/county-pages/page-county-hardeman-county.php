<?php
/**
 * Template Name: County - Hardeman County
 *
 * WordPress setup:
 *   Slug:     hardeman-county  (under county-pages/ parent)
 *   Template: County - Hardeman County
 */

$county = [
    'slug'          => 'hardeman-county',
    'name'          => 'Hardeman County',
    'county_id'     => 'hardeman',
    'h1'            => 'Sell Your House Fast For Cash in Hardeman County TN',
    'meta_title'    => 'We Buy Houses in Hardeman County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hardeman County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$145,000',
    'homes_sold'    => '16',
    'avg_days'      => '100',
    'desc1'         => 'Hardeman County stretches across 668 square miles of southwestern Tennessee, making it one of the largest counties in the state. The county seat of Bolivar sits along the Hatchie River and is steeped in history dating back to the 1820s, from the landmark Pillars house museum to the Little Courthouse that now serves as the county museum. Communities like Middleton, Grand Junction, Whiteville, and Toone each carry their own character, shaped by generations of farming families and a landscape bisected by the scenic Hatchie. With a largely blue-collar workforce and a per capita income well below the state average, Hardeman County home values remain some of the most affordable in Tennessee, drawing buyers looking for space and quiet living.',
    'desc2'         => 'If you are looking to sell your house in Hardeman County, the local real estate market presents real challenges. Homes here often sit on the market for three months or longer, and with a smaller buyer pool spread across such a large rural county, finding a qualified traditional buyer can be frustrating. Older housing stock in Bolivar and the surrounding towns may need costly updates that many sellers simply cannot afford. Cash home buyers in Hardeman County like Tennessee Cash For Homes eliminate those hurdles entirely. We make a fair offer on your property regardless of its condition, cover all closing costs, and let you pick the timeline.',
    'desc3'         => 'No matter what situation has brought you here, whether it is an inherited family property in Grand Junction, a home behind on taxes in Middleton, or a house in Bolivar that needs more work than you can take on, we are ready to help. We buy houses throughout all of Hardeman County in any condition, and our goal is to make the process as straightforward and stress-free as possible for you.',
    'land_para'     => 'Hardeman County offers affordable farmland, wooded tracts, and rural residential lots in West Tennessee. Tennessee Cash For Homes buys Hardeman County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Bolivar', 'slug' => 'bolivar', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Bolivar or surrounding areas in Hardeman County?', 'a' => 'Yes. We buy homes throughout Hardeman County including Bolivar, Middleton, Grand Junction, and all rural areas. We are experienced with properties in this part of West Tennessee.'],
        ['q' => 'Can I sell a property in Hardeman County that has been in my family for generations?', 'a' => 'We regularly work with families in Hardeman County who have inherited multi-generational properties. We make the selling process simple and respectful of your family\'s legacy.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
