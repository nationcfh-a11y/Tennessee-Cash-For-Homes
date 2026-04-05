<?php
/**
 * Template Name: County — Carter County
 *
 * WordPress setup:
 *   Slug:     carter-county  (under county-pages/ parent)
 *   Template: County — Carter County
 */

$county = [
    'slug'          => 'carter-county',
    'name'          => 'Carter County',
    'county_id'     => 'carter',
    'h1'            => 'Sell Your House Fast For Cash in Carter County TN',
    'meta_title'    => 'We Buy Houses in Carter County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Carter County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '42',
    'avg_days'      => '85',
    'desc1'         => 'Carter County is one of Northeast Tennessee\'s most distinctive communities, anchored by the city of Elizabethton along the banks of the Watauga River. With a population of over 56,000 and a cost of living well below the national average, the county draws residents who want affordable mountain living without sacrificing access to jobs -- employers like Snap-on Incorporated and the growing Tennessee College of Applied Technology campus help keep the local economy steady. From the trail communities around Roan Mountain to the established neighborhoods in Elizabethton and Hampton, Carter County home values have remained accessible even as surrounding areas have climbed, making it a popular choice for first-time buyers and retirees alike.',
    'desc2'         => 'If you are looking to sell your house in Carter County, the traditional route can mean months of waiting. With homes averaging 85 days on market, many sellers in Elizabethton, Watauga, and the surrounding communities find themselves stuck paying property taxes, insurance, and maintenance on a house they no longer want. Older housing stock throughout the county -- many homes date back decades and need significant updates -- can make it even harder to attract financed buyers who want move-in-ready properties. As cash home buyers in Carter County, we skip the inspections, appraisals, and repair negotiations that slow down conventional sales.',
    'desc3'         => 'No matter what situation you are facing -- whether it is an inherited property near Roan Mountain, a house in Elizabethton that needs a new roof, or a home you simply need to move on from -- Tennessee Cash For Homes buys houses throughout all of Carter County in any condition. We handle the details so you can close on your timeline and move forward with confidence.',
    'land_para'     => 'Carter County offers beautiful mountain land with stunning views and access to the Cherokee National Forest. Tennessee Cash For Homes buys Carter County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Elizabethton', 'slug' => 'elizabethton', 'has_page' => false],
        ['name' => 'Watauga', 'slug' => 'watauga', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Elizabethton or the Watauga Lake area of Carter County?', 'a' => 'Yes. We buy homes throughout Carter County including Elizabethton, Hampton, and the Watauga Lake area. Mountain properties, lake homes, and in-town residences are all properties we purchase.'],
        ['q' => 'Can I sell a fixer-upper in Carter County?', 'a' => 'Absolutely. Carter County has many older homes that need work, and we buy them all as-is. You will not need to invest in any repairs or updates before selling to us.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
