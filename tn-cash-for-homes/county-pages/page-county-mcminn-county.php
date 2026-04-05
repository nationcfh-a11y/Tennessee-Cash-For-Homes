<?php
/**
 * Template Name: County - McMinn County
 *
 * WordPress setup:
 *   Slug:     mcminn-county  (under county-pages/ parent)
 *   Template: County - McMinn County
 */

$county = [
    'slug'          => 'mcminn-county',
    'name'          => 'McMinn County',
    'county_id'     => 'mcminn',
    'h1'            => 'Sell Your House Fast For Cash in McMinn County TN',
    'meta_title'    => 'We Buy Houses in McMinn County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in McMinn County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '42',
    'avg_days'      => '82',
    'desc1'         => 'McMinn County has built a strong manufacturing identity along the I-75 corridor between Knoxville and Chattanooga. DENSO, the county\'s largest employer with over 1,400 workers, recently announced a $100 million expansion of its Athens automotive components plant, while Starr Regional Medical Center provides healthcare jobs and services to the surrounding area. With more than 1,600 businesses employing nearly 20,000 workers countywide, McMinn County\'s economy punches well above its weight. Athens\' walkable downtown, Etowah\'s historic L&N Depot district, and the farms and river properties along the Hiwassee create a county with real character and McMinn County home values that remain genuinely affordable compared to the larger cities an hour away.',
    'desc2'         => 'Affordability has kept the McMinn County real estate market active, but selling through traditional channels still presents challenges. Homes here average over 80 days on market, and older properties in Etowah or the rural stretches toward Englewood and Niota often need updates that buyers expect sellers to cover. If you want to sell your house in McMinn County without sinking money into repairs or waiting months for the right offer, a direct cash sale is the fastest path forward. Tennessee Cash For Homes buys houses across McMinn County in as-is condition - no agent fees, no inspection contingencies, and no surprises.',
    'desc3'         => 'Life changes do not always come with a convenient timeline. Whether you are behind on payments, managing a property you inherited in Athens, dealing with a difficult tenant situation, or simply need to relocate quickly, we buy houses throughout all of McMinn County. From Etowah cottages to countryside properties off Highway 30, we make fair cash offers on homes in any condition.',
    'land_para'     => 'McMinn County offers a mix of farmland, residential lots, and commercial properties along the I-75 corridor. Tennessee Cash For Homes buys McMinn County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Athens', 'slug' => 'athens', 'has_page' => false],
        ['name' => 'Etowah', 'slug' => 'etowah', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Athens or Etowah in McMinn County?', 'a' => 'Yes. We purchase homes throughout McMinn County including Athens, Etowah, Niota, and Englewood. All property types and conditions are welcome.'],
        ['q' => 'Can I sell a home near the Hiwassee River in McMinn County?', 'a' => 'We buy properties throughout McMinn County including those near the Hiwassee River. Whether your home is riverside or in town, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
