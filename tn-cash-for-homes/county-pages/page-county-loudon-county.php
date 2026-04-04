<?php
/**
 * Template Name: County — Loudon County
 *
 * WordPress setup:
 *   Slug:     loudon-county  (under county-pages/ parent)
 *   Template: County — Loudon County
 */

$county = [
    'slug'          => 'loudon-county',
    'name'          => 'Loudon County',
    'county_id'     => 'loudon',
    'h1'            => 'Sell Your House Fast For Cash in Loudon County TN',
    'meta_title'    => 'We Buy Houses in Loudon County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Loudon County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$345,000',
    'homes_sold'    => '52',
    'avg_days'      => '74',
    'desc1'         => 'Loudon County is a growing East Tennessee county situated between Knoxville and the Tennessee River. Home to Loudon and the rapidly growing city of Lenoir City, the county offers lakefront living on Tellico Lake and Fort Loudoun Lake. Tennessee Cash For Homes buys houses across all of Loudon County fast and for cash.',
    'desc2'         => 'Whether you are downsizing, dealing with an inherited property, or need to sell quickly we make the process simple and stress free. No repairs, no agent commissions, and we close on your schedule.',
    'land_para'     => 'Loudon County offers desirable lakefront land on Tellico Lake and Fort Loudoun Lake along with growing residential development areas. Tennessee Cash For Homes buys Loudon County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Loudon', 'slug' => 'loudon', 'has_page' => false],
        ['name' => 'Lenoir City', 'slug' => 'lenoir-city', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes near Tellico Lake or Fort Loudoun Lake in Loudon County?', 'a' => 'Yes. Loudon County has extensive lakefront along Tellico Lake and Fort Loudoun Lake. We buy lake homes, retirement properties, and all residential properties in Loudon, Lenoir City, and Greenback.'],
        ['q' => 'Can I sell a retirement home in Tellico Village in Loudon County?', 'a' => 'We buy homes in Tellico Village and other Loudon County communities. Whether you are downsizing, relocating, or handling an estate, we make the process simple and fast.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
