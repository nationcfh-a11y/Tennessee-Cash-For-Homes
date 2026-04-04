<?php
/**
 * Template Name: County — Anderson County
 *
 * WordPress setup:
 *   Slug:     anderson-county  (under county-pages/ parent)
 *   Template: County — Anderson County
 */

$county = [
    'slug'          => 'anderson-county',
    'name'          => 'Anderson County',
    'county_id'     => 'anderson',
    'h1'            => 'Sell Your House Fast For Cash in Anderson County TN',
    'meta_title'    => 'We Buy Houses in Anderson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Anderson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '68',
    'avg_days'      => '78',
    'desc1'         => 'Anderson County is home to Oak Ridge, the historic Secret City that played a pivotal role in American history. Today the county offers a unique mix of scientific innovation, natural beauty, and affordable living in East Tennessee. Tennessee Cash For Homes buys houses across all of Anderson County fast and for cash in any condition.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial difficulties, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your schedule with a fair cash offer.',
    'land_para'     => 'Anderson County offers diverse land opportunities from wooded mountain tracts to lakefront properties along Norris Lake and Melton Hill Lake. Tennessee Cash For Homes buys Anderson County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Clinton', 'slug' => 'clinton', 'has_page' => false],
        ['name' => 'Oak Ridge', 'slug' => 'oak-ridge', 'has_page' => false],
        ['name' => 'Norris', 'slug' => 'norris', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Can I sell an older home near Oak Ridge in Anderson County?', 'a' => 'Yes. Many homes in the Oak Ridge area were built in the 1940s and 1950s and may need significant updates. We buy older homes in Anderson County regardless of age or condition, including those with outdated electrical, plumbing, or foundation issues.'],
        ['q' => 'Do you buy houses affected by environmental concerns in Anderson County?', 'a' => 'We understand that Anderson County has a unique history tied to the Oak Ridge National Laboratory. We evaluate every property individually and buy homes in all situations across Anderson County.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
