<?php
/**
 * Template Name: County — Sevier County
 *
 * WordPress setup:
 *   Slug:     sevier-county  (under county-pages/ parent)
 *   Template: County — Sevier County
 */

$county = [
    'slug'          => 'sevier-county',
    'name'          => 'Sevier County',
    'county_id'     => 'sevier',
    'h1'            => 'Sell Your House Fast For Cash in Sevier County',
    'meta_title'    => 'We Buy Houses in Sevier County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Sevier County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$425,000',
    'homes_sold'    => '185',
    'avg_days'      => '70',
    'desc1'         => 'Sevier County is one of Tennessee\'s most visited counties, home to Sevierville, Pigeon Forge, and Gatlinburg at the gateway to the Great Smoky Mountains National Park. The county\'s tourism driven economy and stunning mountain scenery make it one of the most unique real estate markets in the state. Tennessee Cash For Homes buys houses across all of Sevier County fast and for cash.',
    'desc2'         => 'Whether you own a cabin, a primary residence, or an investment property that you need to sell quickly we are ready to make you a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Sevier County mountain land is highly sought after for cabin development and tourism investment. Tennessee Cash For Homes buys Sevier County land quickly with no commissions, no surveys required, and flexible closing.',
    'cities'        => [
        ['name' => 'Sevierville', 'slug' => 'sevierville', 'has_page' => false],
        ['name' => 'Pigeon Forge', 'slug' => 'pigeon-forge', 'has_page' => false],
        ['name' => 'Gatlinburg', 'slug' => 'gatlinburg', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy vacation rental properties or cabins in Sevier County?', 'a' => 'Yes. Sevier County is Tennessee\'s tourism capital, home to Gatlinburg, Pigeon Forge, and Sevierville. We buy vacation rentals, cabins, short-term rental properties, and all residential properties throughout the county.'],
        ['q' => 'Can I sell a Sevier County cabin that is underperforming as a rental?', 'a' => 'We buy cabins in Sevier County regardless of rental performance. If your vacation rental is not generating the income you expected, we will purchase it for cash and handle everything.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
