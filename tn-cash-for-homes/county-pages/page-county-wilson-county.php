<?php
/**
 * Template Name: County - Wilson County
 *
 * WordPress setup:
 *   Slug:     wilson-county  (under county-pages/ parent)
 *   Template: County - Wilson County
 */

$county = [
    'slug'          => 'wilson-county',
    'name'          => 'Wilson County',
    'county_id'     => 'wilson',
    'h1'            => 'Sell Your House Fast For Cash in Wilson County',
    'meta_title'    => 'We Buy Houses in Wilson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Wilson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$399,050',
    'homes_sold'    => '89',
    'avg_days'      => '55',
    'desc1'         => 'Wilson County has emerged as one of Middle Tennessee\'s most dynamic housing markets, sitting squarely along the I-40 corridor east of Nashville. Mt. Juliet, with a population approaching 40,000, is frequently ranked among Tennessee\'s fastest-growing cities and draws steady buyer traffic for homes under $600,000. Lebanon has attracted substantial industrial investment that supports employment growth and residential demand, while Watertown preserves a more rural, small-town character. Home prices across Wilson County typically range from $325,000 to $650,000, with new construction, lake-access properties near Old Hickory Lake, and luxury homes commanding higher figures. With roughly 3.9 months of supply, it is the most balanced market in Middle Tennessee.',
    'desc2'         => 'Even in a balanced market, a traditional sale in Wilson County is not always the right fit. Homes here often sell in 20 to 35 days when priced well, but if your property needs repairs, has title complications, or you simply cannot wait through the listing-showing-negotiation cycle, that timeline stretches. Lebanon buyers tend to be more rate-sensitive, which means financing contingencies can fall through at the last minute. If you want to sell your house in Wilson County on a predictable schedule, cash home buyers in Wilson County like us offer certainty: a fair cash offer reflecting current Wilson County home values, no agent commissions, no inspection demands, and a closing date you pick.',
    'desc3'         => 'Whatever your reason for selling - an inherited property in Lebanon, a rental in Mt. Juliet that no longer cash-flows, a home near Old Hickory Lake that needs work, or a personal situation that calls for a fast, clean sale - Tennessee Cash For Homes buys houses throughout all of Wilson County in any condition. From the Providence master-planned community to historic homes in Watertown and everything across the county, we are here to help.',
    'land_para'     => 'Wilson County\'s location along I-40 and its expanding communities make it a hotspot for residential and commercial growth. Tennessee Cash For Homes buys Wilson County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Lebanon',   'slug' => 'lebanon',   'has_page' => true],
        ['name' => 'Mt. Juliet', 'slug' => 'mt-juliet', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is Wilson County part of the Nashville metro for property values?', 'a' => 'Yes. Wilson County - including Lebanon, Mt. Juliet, and Watertown - is one of Nashville\'s fastest-growing suburban counties. Our cash offers reflect strong Nashville-area demand and current market conditions.'],
        ['q' => 'Do you buy homes in Mt. Juliet or Providence in Wilson County?', 'a' => 'We buy homes throughout Wilson County including Mt. Juliet, Lebanon, Watertown, and the Providence master-planned community. New construction and older homes are all welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
