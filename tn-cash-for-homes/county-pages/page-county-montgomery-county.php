<?php
/**
 * Template Name: County — Montgomery County
 *
 * WordPress setup:
 *   Slug:     montgomery-county  (under county-pages/ parent)
 *   Template: County — Montgomery County
 */

$county = [
    'slug'          => 'montgomery-county',
    'name'          => 'Montgomery County',
    'county_id'     => 'montgomery',
    'h1'            => 'Sell Your House Fast For Cash in Montgomery County',
    'meta_title'    => 'We Buy Houses in Montgomery County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Montgomery County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$309,900',
    'homes_sold'    => '256',
    'avg_days'      => '83',
    'desc1'         => 'Montgomery County is home to Clarksville, one of Tennessee\'s fastest growing cities with strong ties to Fort Campbell and a booming population. Tennessee Cash For Homes buys houses across all of Montgomery County fast and for cash.',
    'desc2'         => 'Whether you are a military family relocating, facing foreclosure, or simply need to sell quickly we are here to help with a fair no obligation cash offer. We close on your timeline with no repairs and no fees.',
    'land_para'     => 'Montgomery County\'s booming economy and proximity to Nashville have made land increasingly valuable. Tennessee Cash For Homes buys Montgomery County land quickly with no commissions, no surveys required, and a flexible closing timeline.',
    'cities'        => [
        ['name' => 'Clarksville', 'slug' => 'clarksville', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes near Fort Campbell in Montgomery County?', 'a' => 'Yes. Montgomery County is home to Fort Campbell and we regularly work with military families who need to sell quickly. We buy homes in Clarksville and throughout the county and can close fast to match your PCS timeline.'],
        ['q' => 'Is Clarksville\'s rapid growth in Montgomery County good for sellers?', 'a' => 'Clarksville is one of Tennessee\'s fastest-growing cities, which means strong property values. Our cash offers reflect Montgomery County\'s growth. You can take advantage of the market without the delays of a traditional sale.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
