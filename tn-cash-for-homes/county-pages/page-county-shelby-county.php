<?php
/**
 * Template Name: County - Shelby County
 *
 * WordPress setup:
 *   Slug:     shelby-county  (under county-pages/ parent)
 *   Template: County - Shelby County
 */

$county = [
    'slug'          => 'shelby-county',
    'name'          => 'Shelby County',
    'county_id'     => 'shelby',
    'h1'            => 'Sell Your House Fast For Cash in Shelby County',
    'meta_title'    => 'We Buy Houses in Shelby County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Shelby County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '585',
    'avg_days'      => '72',
    'desc1'         => 'Shelby County is the most populous county in Tennessee, anchored by Memphis - a city known worldwide for Beale Street blues, championship barbecue, and the global headquarters of FedEx. The county\'s neighborhoods span an enormous range, from the tree-lined estates of East Memphis and the family-friendly suburbs of Germantown, Bartlett, and Collierville to the historic character of Midtown, the revitalizing energy of the Crosstown Concourse district, and the deeply rooted communities of Whitehaven and Orange Mound. With roughly 585 homes selling each month and a median price around $245,000, the Shelby County real estate market is one of the most active and affordable metro markets in the Southeast.',
    'desc2'         => 'That volume and diversity also mean Shelby County sellers face real challenges. Property tax rates in Memphis run about $2.58 per $100 of assessed value - among the highest in Tennessee - which can make holding an unwanted property expensive fast. Over 30 percent of listings countywide have had to cut their asking price, and tax sale foreclosures on delinquent properties remain a persistent issue. Older homes in South Memphis, Frayser, and Raleigh often need major repairs that eliminate most financed buyers from the picture. If you want to sell your house in Shelby County without pouring money into renovations or waiting through months of price reductions, cash home buyers in Shelby County like Tennessee Cash For Homes provide a reliable alternative - a fair offer, no agent commissions, and a closing date you choose.',
    'desc3'         => 'Whether you own a bungalow in Cooper-Young, a suburban split-level in Bartlett, a rental property in Whitehaven, or a home anywhere else across Shelby County, we buy houses in any condition and any situation. Reach out today for a no-obligation cash offer and let us handle the rest.',
    'land_para'     => 'Shelby County\'s large population and ongoing suburban development keep land in high demand. Tennessee Cash For Homes buys Shelby County land quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Memphis', 'slug' => 'memphis', 'has_page' => true],
        ['name' => 'Germantown', 'slug' => 'germantown', 'has_page' => false],
        ['name' => 'Bartlett', 'slug' => 'bartlett', 'has_page' => false],
        ['name' => 'Collierville', 'slug' => 'collierville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'How does Memphis\'s real estate market in Shelby County affect your offers?', 'a' => 'Shelby County and Memphis have a diverse real estate market with significant variation by neighborhood. Our offers are based on comparable sales and current conditions specific to your property\'s location. We provide fair offers across all Memphis neighborhoods.'],
        ['q' => 'Do you buy homes in distressed neighborhoods in Shelby County?', 'a' => 'Yes. We buy homes throughout all of Shelby County including neighborhoods that other buyers avoid. Whether your property is in Midtown, South Memphis, Whitehaven, Cordova, or anywhere else, we will make you an offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
