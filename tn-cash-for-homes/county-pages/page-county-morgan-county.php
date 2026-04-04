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
    'desc1'         => 'Morgan County is a rugged mountain county on the Cumberland Plateau in East Tennessee. Home to Wartburg and bordered by the Obed Wild and Scenic River, the county offers affordable living surrounded by some of the state\'s most pristine wilderness. Tennessee Cash For Homes buys houses across all of Morgan County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial challenges, or need a quick sale we make the process easy. No repairs needed, no agent fees, and we close on your timeline.',
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
