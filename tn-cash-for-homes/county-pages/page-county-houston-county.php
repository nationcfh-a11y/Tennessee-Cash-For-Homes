<?php
/**
 * Template Name: County - Houston County
 *
 * WordPress setup:
 *   Slug:     houston-county  (under county-pages/ parent)
 *   Template: County - Houston County
 */

$county = [
    'slug'          => 'houston-county',
    'name'          => 'Houston County',
    'county_id'     => 'houston',
    'h1'            => 'Sell Your House Fast For Cash in Houston County TN',
    'meta_title'    => 'We Buy Houses in Houston County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Houston County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$189,000',
    'homes_sold'    => '8',
    'avg_days'      => '105',
    'desc1'         => 'Houston County is Tennessee\'s smallest county by population, with just over 8,200 residents spread across 200 square miles of hilly terrain along the Cumberland River. Named for Sam Houston, the former Tennessee governor and Texas independence hero, the county was carved from parts of Dickson, Humphreys, Montgomery, and Stewart counties in 1871. Erin, the county seat, has a population of about 1,220 and serves as the commercial center for the area. Manufacturing employs over 650 residents and forms the economic backbone alongside retail, healthcare, and a growing recreational sector tied to the county\'s river access, parks, and trails. With a median household income around $54,000 and housing costs nearly 20 percent below the state average, Houston County offers some of the most affordable living in Middle Tennessee.',
    'desc2'         => 'That affordability, however, creates a challenge when it comes time to sell. With so few residents and a limited pool of local buyers, homes in Houston County can sit on the market for well over 100 days. The median household income in Erin itself is significantly lower, meaning many potential buyers struggle to qualify for traditional financing. If your property needs repairs or sits on a rural lot outside of Erin, the wait can be even longer. Cash home buyers in Houston County like Tennessee Cash For Homes take those obstacles off the table. We make a fair offer on your property as-is, with no agent commissions, no repair requests, and a closing date that fits your needs.',
    'desc3'         => 'Whether you own a home in Erin, a property along the Cumberland River, or a house on a quiet back road anywhere in Houston County, we buy houses throughout the entire county in any condition. From inherited properties and vacant homes to houses with foundation issues or outdated systems, no situation is too complicated for our team. We are here to give you a simple, honest path to selling your home.',
    'land_para'     => 'Houston County offers affordable rural land along the Cumberland River including wooded tracts and residential lots. Tennessee Cash For Homes buys Houston County land quickly with no commissions and no surveys required.',
    'cities'        => [
        ['name' => 'Erin', 'slug' => 'erin', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is it hard to find buyers for homes in a small county like Houston County?', 'a' => 'Houston County is Tennessee\'s smallest county by population, which can make traditional home sales challenging. We buy homes directly for cash in Erin and throughout Houston County, giving you a guaranteed sale without waiting for a buyer.'],
        ['q' => 'Do you buy homes along the Cumberland River in Houston County?', 'a' => 'Yes. We buy properties throughout Houston County including those along the Cumberland River. Riverfront homes and rural properties are all ones we purchase.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
