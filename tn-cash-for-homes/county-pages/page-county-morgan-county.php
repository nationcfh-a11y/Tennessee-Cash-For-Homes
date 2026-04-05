<?php
/**
 * Template Name: County — Morgan County
 *
 * WordPress setup:
 *   Slug:     morgan-county  (under county-pages/ parent)
 *   Template: County — Morgan County
 */

$county = [
    'slug'          => 'morgan-county',
    'name'          => 'Morgan County',
    'county_id'     => 'morgan',
    'h1'            => 'Sell Your House Fast For Cash in Morgan County TN',
    'meta_title'    => 'We Buy Houses in Morgan County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Morgan County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$165,000',
    'homes_sold'    => '15',
    'avg_days'      => '100',
    'desc1'         => 'Morgan County is a place defined by its landscape -- the rugged Cumberland Plateau, the Obed Wild and Scenic River, Frozen Head State Park\'s 24,000 acres of wilderness, and the historic Brushy Mountain State Penitentiary in Petros, which has been reborn as a tourism destination with guided tours, a restaurant, and a distillery. Wartburg, the county seat founded by German and Swiss immigrants in the 1840s, retains its small-town character, while communities like Sunbright, Oakdale, and Deer Lodge dot the plateau. Manufacturing has long provided employment here, with firms like VF Workwear and Advance Transformer operating facilities in Wartburg. Morgan County home values remain among the most affordable in East Tennessee, with a median around $165,000 that attracts buyers looking for mountain living without a mountain price tag.',
    'desc2'         => 'That affordability comes with trade-offs when it is time to sell. The Morgan County real estate market moves slowly -- homes average 100 days on market, and many properties here are on well water and septic systems, which can complicate traditional financing for buyers. Older homes in Wartburg or cabins scattered across the plateau may need updates that financed buyers are not willing to overlook. If you want to sell your house in Morgan County without the expense and uncertainty of a traditional listing, cash home buyers in Morgan County like Tennessee Cash For Homes provide a direct path to closing. No lender requirements, no inspection demands, no agent fees.',
    'desc3'         => 'Whatever has brought you to the decision to sell -- an inherited property in Wartburg, a cabin near Frozen Head you no longer visit, financial pressures, or a home that has simply become more than you can maintain -- we buy houses throughout all of Morgan County in any condition. Off-grid homes, properties on gravel roads, and houses that need significant repairs are all ones we purchase. You will get a fair cash offer with no strings attached.',
    'land_para'     => 'Morgan County offers affordable mountain land near the Obed River and Frozen Head State Park. Tennessee Cash For Homes buys Morgan County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Wartburg', 'slug' => 'wartburg', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Wartburg or Sunbright in Morgan County?', 'a' => 'Yes. We buy homes throughout Morgan County including Wartburg, Sunbright, Oakdale, and Deer Lodge. All property types and conditions are welcome.'],
        ['q' => 'Can I sell a home in Morgan County if the property has no city utilities?', 'a' => 'We buy homes in Morgan County with well water, septic systems, and no city utility access. Off-grid and rural properties are no problem for our team.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
