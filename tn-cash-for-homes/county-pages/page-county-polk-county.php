<?php
/**
 * Template Name: County — Polk County
 *
 * WordPress setup:
 *   Slug:     polk-county  (under county-pages/ parent)
 *   Template: County — Polk County
 */

$county = [
    'slug'          => 'polk-county',
    'name'          => 'Polk County',
    'county_id'     => 'polk',
    'h1'            => 'Sell Your House Fast For Cash in Polk County TN',
    'meta_title'    => 'We Buy Houses in Polk County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Polk County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '14',
    'avg_days'      => '94',
    'desc1'         => 'Polk County occupies the southeastern corner of Tennessee where it borders both North Carolina and Georgia, split geographically by the Ocoee River Gorge and Chilhowee Mountain into distinct East Polk and West Polk communities. Benton, the county seat on the western side, serves as the government and commercial center, while Copperhill and Ducktown on the eastern side carry the legacy of a copper mining industry that shaped the Copper Basin landscape beginning in 1843. Today the Ocoee and Hiwassee Rivers, the Cherokee National Forest, and three TVA hydroelectric plants define the county\'s character, drawing whitewater rafters, hikers, and second-home buyers to this rugged mountain region.',
    'desc2'         => 'The Polk County real estate market is a mixed picture. Vacation properties and mountain cabins near Copperhill can list at premium prices, while more modest homes in Benton and Ducktown sit at lower price points, and the gap between the two can make it hard to price a home competitively. If you want to sell your house in Polk County without navigating that complexity, a direct cash sale makes sense. We buy homes as-is throughout the county, with no agent commissions, no staging, and no waiting months for a buyer who may need financing approval for a rural or mountain property.',
    'desc3'         => 'Whatever has brought you to this decision, whether it is a seasonal cabin you no longer visit, a home in Benton that needs foundation work, or a property in Ducktown you inherited and do not want to manage, we buy houses throughout all of Polk County in any condition. Tennessee Cash For Homes serves sellers across East Tennessee\'s mountain communities and we are committed to making every transaction fair and straightforward.',
    'land_para'     => 'Polk County offers mountain land near the Cherokee National Forest and Ocoee River at affordable prices. Tennessee Cash For Homes buys Polk County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Benton', 'slug' => 'benton', 'has_page' => false],
        ['name' => 'Copperhill', 'slug' => 'copperhill', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Benton, Copperhill, or Ducktown in Polk County?', 'a' => 'Yes. We buy homes throughout Polk County including Benton, Copperhill, and Ducktown. Mountain properties and homes near the Ocoee River are all ones we purchase.'],
        ['q' => 'Can I sell a cabin or vacation property in Polk County?', 'a' => 'We buy cabins and vacation properties in Polk County. The Ocoee River and Cherokee National Forest make this area popular for second homes, and we purchase them in any condition.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
