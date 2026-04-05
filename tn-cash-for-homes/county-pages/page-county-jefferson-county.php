<?php
/**
 * Template Name: County - Jefferson County
 *
 * WordPress setup:
 *   Slug:     jefferson-county  (under county-pages/ parent)
 *   Template: County - Jefferson County
 */

$county = [
    'slug'          => 'jefferson-county',
    'name'          => 'Jefferson County',
    'county_id'     => 'jefferson',
    'h1'            => 'Sell Your House Fast For Cash in Jefferson County TN',
    'meta_title'    => 'We Buy Houses in Jefferson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Jefferson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$295,000',
    'homes_sold'    => '42',
    'avg_days'      => '78',
    'desc1'         => 'Jefferson County is one of East Tennessee\'s most distinctive places to call home, anchored by Dandridge - the second oldest town in the state and a charming lakeside community on the shores of Douglas Lake. From the workers at Bush Brothers and Company, whose canning operation has been a local institution for over a century, to the families settling into neighborhoods near Jefferson City and Baneberry, the county blends small-town heritage with steady growth. Jefferson County home values have been climbing as buyers discover the combination of Smoky Mountain proximity, lakefront living, and a cost of living well below nearby Knoxville.',
    'desc2'         => 'If you are looking to sell your house in Jefferson County, the local real estate market can present real challenges. Lakefront and near-lake properties along Douglas Lake often sit on the market for 90 to 160 days depending on price and season, and inland homes near White Pine or New Market can take even longer without the waterfront appeal. Cash home buyers in Jefferson County like Tennessee Cash For Homes eliminate the uncertainty of waiting for a qualified buyer, dealing with inspection contingencies, or paying agent commissions that eat into your proceeds. Whether your property is a vacation cabin that has become a burden or a family home near the Jefferson County courthouse, a cash offer lets you move forward on your timeline.',
    'desc3'         => 'No matter what situation brought you here - relocation, an inherited property, financial pressure, or simply wanting a fresh start - we buy houses throughout all of Jefferson County in any condition. From Dandridge and Jefferson City to White Pine and every rural road in between, Tennessee Cash For Homes is ready to make you a fair, no-obligation cash offer today.',
    'land_para'     => 'Jefferson County offers lakefront land on Douglas Lake, mountain view properties, and growing residential development. Tennessee Cash For Homes buys Jefferson County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dandridge', 'slug' => 'dandridge', 'has_page' => false],
        ['name' => 'Jefferson City', 'slug' => 'jefferson-city', 'has_page' => false],
        ['name' => 'White Pine', 'slug' => 'white-pine', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Dandridge or Jefferson City in Jefferson County?', 'a' => 'Yes. We purchase homes throughout Jefferson County including Dandridge, Jefferson City, White Pine, and New Market. All conditions are welcome.'],
        ['q' => 'Can I sell a home in Jefferson County near Douglas Lake?', 'a' => 'We buy homes and lake properties near Douglas Lake in Jefferson County. Whether it is a full-time residence or a vacation property, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
