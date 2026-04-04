<?php
/**
 * Template Name: County — Hardin County
 *
 * WordPress setup:
 *   Slug:     hardin-county  (under county-pages/ parent)
 *   Template: County — Hardin County
 */

$county = [
    'slug'          => 'hardin-county',
    'name'          => 'Hardin County',
    'county_id'     => 'hardin',
    'h1'            => 'Sell Your House Fast For Cash in Hardin County TN',
    'meta_title'    => 'We Buy Houses in Hardin County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hardin County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$185,000',
    'homes_sold'    => '22',
    'avg_days'      => '94',
    'desc1'         => 'Hardin County is a historic West Tennessee county home to Savannah and the Shiloh National Military Park. Located along the Tennessee River, the county offers scenic waterfront living and a deep connection to American history. Tennessee Cash For Homes buys houses across all of Hardin County fast and for cash.',
    'desc2'         => 'Whether you need to sell due to relocation, inheritance, or financial reasons we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Hardin County offers beautiful riverfront land along the Tennessee River, Pickwick Lake access, and affordable rural acreage. Tennessee Cash For Homes buys Hardin County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Savannah', 'slug' => 'savannah', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties near Pickwick Lake or Shiloh in Hardin County?', 'a' => 'Yes. Hardin County is home to Pickwick Lake and the Shiloh National Military Park. We buy homes, lake properties, and residential land throughout the county including Savannah and Counce.'],
        ['q' => 'Can I sell a seasonal or vacation home in Hardin County?', 'a' => 'We buy seasonal and vacation homes in Hardin County. Whether your lake house or cabin is used part-time or has been sitting empty, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
