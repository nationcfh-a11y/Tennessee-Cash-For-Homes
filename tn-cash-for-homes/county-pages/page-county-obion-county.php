<?php
/**
 * Template Name: County - Obion County
 *
 * WordPress setup:
 *   Slug:     obion-county  (under county-pages/ parent)
 *   Template: County - Obion County
 */

$county = [
    'slug'          => 'obion-county',
    'name'          => 'Obion County',
    'county_id'     => 'obion',
    'h1'            => 'Sell Your House Fast For Cash in Obion County TN',
    'meta_title'    => 'We Buy Houses in Obion County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Obion County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$135,000',
    'homes_sold'    => '22',
    'avg_days'      => '94',
    'desc1'         => 'Obion County anchors the northwest corner of Tennessee, where Union City serves as the economic hub for a region built on agriculture and food processing. Major employers like Tyson Foods, Williams Sausage Company, and Titan Tire provide steady jobs, while Baptist Memorial Hospital supports healthcare needs across the area. From the well-kept family homes along Union City\'s West End to the affordable neighborhoods on the East Side, Obion County home values remain well below state averages, offering genuinely affordable living near the Kentucky border.',
    'desc2'         => 'If you are looking to sell your house in Obion County, the local real estate market presents some real challenges. Homes here spend an average of 80 to 100 days on the market, and the buyer pool is smaller than in Tennessee\'s metro areas. That extended timeline means months of carrying costs, property taxes, insurance, and maintenance while you wait. Cash home buyers in Obion County like us eliminate that uncertainty entirely. We make a fair offer within 24 hours, cover all closing costs, and let you pick the closing date that works for your schedule.',
    'desc3'         => 'No matter what has brought you to this point, whether it is a job transfer, a house you inherited in Union City, or a property that needs more repairs than it is worth, we buy houses throughout all of Obion County in any condition. From homes in the North Side neighborhoods to rural properties outside South Fulton, Tennessee Cash For Homes is ready to make the process simple and stress-free.',
    'land_para'     => 'Obion County offers productive farmland and affordable residential lots in Northwest Tennessee. Tennessee Cash For Homes buys Obion County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Union City', 'slug' => 'union-city', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Union City or South Fulton in Obion County?', 'a' => 'Yes. We buy homes throughout Obion County including Union City, South Fulton, and surrounding communities in Northwest Tennessee.'],
        ['q' => 'Can I sell a farm or agricultural property in Obion County?', 'a' => 'Obion County has a strong farming heritage and we buy all types of properties including farm homes, houses on agricultural land, and rural residential properties.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
