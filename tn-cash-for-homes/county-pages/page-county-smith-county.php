<?php
/**
 * Template Name: County - Smith County
 *
 * WordPress setup:
 *   Slug:     smith-county  (under county-pages/ parent)
 *   Template: County - Smith County
 */

$county = [
    'slug'          => 'smith-county',
    'name'          => 'Smith County',
    'county_id'     => 'smith',
    'h1'            => 'Sell Your House Fast For Cash in Smith County TN',
    'meta_title'    => 'We Buy Houses in Smith County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Smith County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$275,000',
    'homes_sold'    => '21',
    'avg_days'      => '82',
    'desc1'         => 'Smith County is a quiet, river-laced corner of Middle Tennessee where the Caney Fork meets the Cumberland - a junction that made Carthage one of the state\'s most important steamboat ports in the 1800s and later the hometown of Vice President Al Gore. Today, the county seat retains its small-town courthouse-square charm while Gordonsville, just to the east, hosts a surprisingly strong manufacturing base that includes Graphic Packaging International, Taiho Manufacturing, and Nyrstar Tennessee Mines. Smith County home values typically range from $180,000 to $375,000, and the area\'s low cost of living continues to attract commuters, retirees, and families who want breathing room without being far from Nashville, Lebanon, or Cookeville.',
    'desc2'         => 'The Smith County real estate market has been trending upward, but Carthage still functions largely as a buyer\'s market - meaning homes can linger for 40 to 50 days or more, and sellers often compete against newer construction in neighboring counties. Older properties along the Cumberland frequently need updates that make financed buyers hesitant, and rural parcels with well-and-septic systems add inspection hurdles. If you need to sell your house in Smith County without the wait, the showings, or the repair negotiations, cash home buyers in Smith County like Tennessee Cash For Homes make the process simple - one fair offer, no commissions, and a closing date that fits your schedule.',
    'desc3'         => 'Whether it is a riverfront home in Carthage, a property near the manufacturers in Gordonsville, or a rural homestead anywhere else in Smith County, we buy houses in any condition and any situation. Contact us for a no-obligation cash offer and move forward on your terms.',
    'land_para'     => 'Smith County offers beautiful rural land along the Cumberland River including farmland, wooded tracts, and residential lots. Tennessee Cash For Homes buys Smith County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Carthage', 'slug' => 'carthage', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Carthage or South Carthage in Smith County?', 'a' => 'Yes. We buy homes throughout Smith County including Carthage, South Carthage, Gordonsville, and all surrounding areas. We buy in any condition.'],
        ['q' => 'Can I sell a property on the Cumberland River in Smith County?', 'a' => 'We buy properties along the Cumberland River and throughout Smith County. Riverfront homes, rural properties, and in-town residences are all welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
