<?php
/**
 * Template Name: County — Jackson County
 *
 * WordPress setup:
 *   Slug:     jackson-county  (under county-pages/ parent)
 *   Template: County — Jackson County
 */

$county = [
    'slug'          => 'jackson-county',
    'name'          => 'Jackson County',
    'county_id'     => 'jackson',
    'h1'            => 'Sell Your House Fast For Cash in Jackson County TN',
    'meta_title'    => 'We Buy Houses in Jackson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Jackson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$175,000',
    'homes_sold'    => '10',
    'avg_days'      => '105',
    'desc1'         => 'Jackson County is a rural Upper Cumberland county in Middle Tennessee home to Gainesboro. Situated along the Cumberland River, the county offers peaceful country living and access to Cordell Hull Lake. Tennessee Cash For Homes buys houses across all of Jackson County fast and for cash.',
    'desc2'         => 'Whether you have an inherited property, need to relocate, or want a quick hassle free sale we are here with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
    'land_para'     => 'Jackson County offers affordable rural land along the Cumberland River and Cordell Hull Lake. Tennessee Cash For Homes buys Jackson County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Gainesboro', 'slug' => 'gainesboro', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Gainesboro or rural Jackson County?', 'a' => 'Yes. We buy homes throughout Jackson County including Gainesboro and all surrounding rural areas. Low population density does not affect our interest in purchasing your property.'],
        ['q' => 'Can I sell a property in Jackson County near Cordell Hull Lake?', 'a' => 'Absolutely. Jackson County borders Cordell Hull Lake and we buy lake area properties, homes, and land throughout the county.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
