<?php
/**
 * Template Name: County — Smith County
 *
 * WordPress setup:
 *   Slug:     smith-county  (under county-pages/ parent)
 *   Template: County — Smith County
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
    'desc1'         => 'Smith County sits along the Cumberland River in Middle Tennessee offering rural living with easy access to Nashville. Home to Carthage, the county has a rich history and a growing real estate market. Tennessee Cash For Homes buys houses across all of Smith County fast and for cash.',
    'desc2'         => 'Whether you need to sell quickly due to relocation, financial reasons, or an inherited property we make the process simple and stress free. No repairs needed, no agent commissions, and we close on your schedule.',
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
