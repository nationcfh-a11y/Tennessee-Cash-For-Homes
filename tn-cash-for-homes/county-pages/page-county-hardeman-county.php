<?php
/**
 * Template Name: County — Hardeman County
 *
 * WordPress setup:
 *   Slug:     hardeman-county  (under county-pages/ parent)
 *   Template: County — Hardeman County
 */

$county = [
    'slug'          => 'hardeman-county',
    'name'          => 'Hardeman County',
    'county_id'     => 'hardeman',
    'h1'            => 'Sell Your House Fast For Cash in Hardeman County TN',
    'meta_title'    => 'We Buy Houses in Hardeman County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hardeman County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$145,000',
    'homes_sold'    => '16',
    'avg_days'      => '100',
    'desc1'         => 'Hardeman County is a rural West Tennessee county home to Bolivar and rich in history. The county offers affordable living, scenic countryside, and a close knit community. Tennessee Cash For Homes buys houses across all of Hardeman County fast and for cash in any condition.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial hardship, or need to sell quickly we make the process easy. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Hardeman County offers affordable farmland, wooded tracts, and rural residential lots in West Tennessee. Tennessee Cash For Homes buys Hardeman County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Bolivar', 'slug' => 'bolivar', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Bolivar or surrounding areas in Hardeman County?', 'a' => 'Yes. We buy homes throughout Hardeman County including Bolivar, Middleton, Grand Junction, and all rural areas. We are experienced with properties in this part of West Tennessee.'],
        ['q' => 'Can I sell a property in Hardeman County that has been in my family for generations?', 'a' => 'We regularly work with families in Hardeman County who have inherited multi-generational properties. We make the selling process simple and respectful of your family\'s legacy.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
