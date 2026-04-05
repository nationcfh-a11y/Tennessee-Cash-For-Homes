<?php
/**
 * Template Name: County - Grundy County
 *
 * WordPress setup:
 *   Slug:     grundy-county  (under county-pages/ parent)
 *   Template: County - Grundy County
 */

$county = [
    'slug'          => 'grundy-county',
    'name'          => 'Grundy County',
    'county_id'     => 'grundy',
    'h1'            => 'Sell Your House Fast For Cash in Grundy County TN',
    'meta_title'    => 'We Buy Houses in Grundy County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Grundy County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$175,000',
    'homes_sold'    => '12',
    'avg_days'      => '105',
    'desc1'         => 'Often called the crown jewel of the Cumberland Plateau, Grundy County offers some of the most dramatic scenery in Tennessee, from the gorges and waterfalls of South Cumberland State Park to the quiet ridgelines above Tracy City and Coalmont. Altamont serves as the county seat, while Monteagle sits at the intersection of I-24 and Highway 41, drawing travelers and retirees. The local economy includes poultry operations, a growing nursery and greenhouse industry, and several hundred broiler houses scattered across the plateau. Beersheba Springs, Gruetli-Laager, and Palmer add to the county\'s small-town character. Grundy County is classified as an Appalachian Regional Commission distressed county, which means economic challenges are real, but it also means property here is among the most affordable in the state.',
    'desc2'         => 'The Grundy County real estate market is firmly a buyer\'s market, and that creates genuine difficulty for anyone trying to sell. Homes sit on the market well over 100 days on average, the buyer pool is small, and many properties, particularly older homes and mountain cabins, need the kind of updates that traditional buyers are unwilling to finance. Low median incomes in the area mean fewer local buyers can qualify for conventional mortgages. If you want to sell your house in Grundy County without months of waiting and uncertainty, cash home buyers in Grundy County like Tennessee Cash For Homes provide a direct sale with no agent fees, no repair requirements, and a closing date you choose.',
    'desc3'         => 'From a mountaintop cabin outside Tracy City to a home in Monteagle near the interstate to a property in Palmer you have not visited in years, Tennessee Cash For Homes buys houses throughout all of Grundy County in any condition. We understand the local market and we are not deterred by the challenges that come with plateau living. Whatever your situation, we are ready to help.',
    'land_para'     => 'Grundy County offers unique plateau land with stunning overlooks, wooded tracts, and affordable mountain acreage. Tennessee Cash For Homes buys Grundy County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Altamont', 'slug' => 'altamont', 'has_page' => false],
        ['name' => 'Tracy City', 'slug' => 'tracy-city', 'has_page' => false],
        ['name' => 'Monteagle', 'slug' => 'monteagle', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes on the Cumberland Plateau in Grundy County?', 'a' => 'Yes. Grundy County sits atop the Cumberland Plateau and we buy properties throughout the county including Tracy City, Altamont, Coalmont, and Palmer. Mountain properties are no problem.'],
        ['q' => 'Can I sell a property in Grundy County if the local market is slow?', 'a' => 'Grundy County\'s traditional market can be slow due to its rural nature. We buy directly for cash regardless of local market conditions, giving you a fast and certain sale.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
