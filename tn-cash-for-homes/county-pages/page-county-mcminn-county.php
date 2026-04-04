<?php
/**
 * Template Name: County — McMinn County
 *
 * WordPress setup:
 *   Slug:     mcminn-county  (under county-pages/ parent)
 *   Template: County — McMinn County
 */

$county = [
    'slug'          => 'mcminn-county',
    'name'          => 'McMinn County',
    'county_id'     => 'mcminn',
    'h1'            => 'Sell Your House Fast For Cash in McMinn County TN',
    'meta_title'    => 'We Buy Houses in McMinn County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in McMinn County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '42',
    'avg_days'      => '82',
    'desc1'         => 'McMinn County is a growing East Tennessee county anchored by Athens and Etowah. Situated between Knoxville and Chattanooga along Interstate 75, the county offers affordable living with convenient access to both major cities. Tennessee Cash For Homes buys houses across all of McMinn County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial hardship, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'McMinn County offers a mix of farmland, residential lots, and commercial properties along the I-75 corridor. Tennessee Cash For Homes buys McMinn County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Athens', 'slug' => 'athens', 'has_page' => false],
        ['name' => 'Etowah', 'slug' => 'etowah', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Athens or Etowah in McMinn County?', 'a' => 'Yes. We purchase homes throughout McMinn County including Athens, Etowah, Niota, and Englewood. All property types and conditions are welcome.'],
        ['q' => 'Can I sell a home near the Hiwassee River in McMinn County?', 'a' => 'We buy properties throughout McMinn County including those near the Hiwassee River. Whether your home is riverside or in town, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
