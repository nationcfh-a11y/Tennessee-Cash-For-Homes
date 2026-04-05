<?php
/**
 * Template Name: County — Franklin County
 *
 * WordPress setup:
 *   Slug:     franklin-county  (under county-pages/ parent)
 *   Template: County — Franklin County
 */

$county = [
    'slug'          => 'franklin-county',
    'name'          => 'Franklin County',
    'county_id'     => 'franklin',
    'h1'            => 'Sell Your House Fast For Cash in Franklin County TN',
    'meta_title'    => 'We Buy Houses in Franklin County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Franklin County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$265,000',
    'homes_sold'    => '34',
    'avg_days'      => '84',
    'desc1'         => 'Franklin County stretches from the fertile valley floor around Winchester up to the Cumberland Plateau, where the University of the South in Sewanee has shaped the area\'s culture for more than 150 years. Tims Ford Lake, built in the early 1970s, brought waterfront living and recreation that continues to drive development in communities like Twin Creeks Village and the neighborhoods along the eastern shore. Winchester, the county seat, has a population around 10,000 and a diverse housing stock that ranges from mid-century suburbs to newer lakefront properties with private docks. Agriculture, manufacturing, tourism, and the university all contribute to a stable local economy, and attractions like South Cumberland State Park keep Franklin County on the map for visitors and prospective residents alike.',
    'desc2'         => 'The Franklin County real estate market has been trending upward, but not every seller benefits equally. Lakefront homes near Tims Ford attract strong buyer interest, while older properties in Winchester, Cowan, Decherd, and Huntland can linger for weeks or months, particularly if they need updates. Sellers dealing with deferred maintenance, outdated interiors, or inherited homes they have never lived in often find the traditional listing process frustrating and expensive. If you want to sell your house in Franklin County without repairs, staging, or agent commissions, cash home buyers in Franklin County like us offer a straightforward alternative. We evaluate the property as-is and present a fair offer, typically within 24 hours.',
    'desc3'         => 'From a cottage in Cowan to a split-level near Decherd to a lakeside property you no longer use, Tennessee Cash For Homes buys houses throughout all of Franklin County in any condition. Whatever has brought you to the decision to sell, we are here to make it as simple and stress-free as possible.',
    'land_para'     => 'Franklin County offers diverse land from valley farmland to mountain tracts near the Cumberland Plateau. Tennessee Cash For Homes buys Franklin County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Winchester', 'slug' => 'winchester', 'has_page' => false],
        ['name' => 'Cowan', 'slug' => 'cowan', 'has_page' => false],
        ['name' => 'Decherd', 'slug' => 'decherd', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Winchester or Cowan in Franklin County?', 'a' => 'Yes. We buy homes throughout Franklin County including Winchester, Cowan, Decherd, and Huntland. All property conditions and types are welcome.'],
        ['q' => 'Can I sell a property in Franklin County near Tims Ford Lake?', 'a' => 'Absolutely. Tims Ford Lake properties in Franklin County are among those we purchase. Whether it is a lakefront home or a property nearby, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
