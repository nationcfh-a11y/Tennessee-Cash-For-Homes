<?php
/**
 * Template Name: County — Union County
 *
 * WordPress setup:
 *   Slug:     union-county  (under county-pages/ parent)
 *   Template: County — Union County
 */

$county = [
    'slug'          => 'union-county',
    'name'          => 'Union County',
    'county_id'     => 'union',
    'h1'            => 'Sell Your House Fast For Cash in Union County TN',
    'meta_title'    => 'We Buy Houses in Union County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Union County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '14',
    'avg_days'      => '92',
    'desc1'         => 'Union County is a rural East Tennessee county home to Maynardville and bordered by Norris Lake to the north. The county offers affordable housing, beautiful lake access, and a quiet rural lifestyle within commuting distance of Knoxville. Tennessee Cash For Homes buys houses across all of Union County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial hardship, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Union County offers lakefront land on Norris Lake and affordable rural acreage near Knoxville. Tennessee Cash For Homes buys Union County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Maynardville', 'slug' => 'maynardville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Maynardville or Luttrell in Union County?', 'a' => 'Yes. We buy homes throughout Union County including Maynardville and Luttrell. Rural properties and homes near Norris Lake are all ones we purchase.'],
        ['q' => 'Can I sell a property near Norris Lake in Union County?', 'a' => 'We buy properties near Norris Lake and throughout Union County. Lake homes, cabins, and residential properties in any condition are welcome.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
