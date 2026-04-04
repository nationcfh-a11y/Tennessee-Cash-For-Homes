<?php
/**
 * Template Name: County — Bledsoe County
 *
 * WordPress setup:
 *   Slug:     bledsoe-county  (under county-pages/ parent)
 *   Template: County — Bledsoe County
 */

$county = [
    'slug'          => 'bledsoe-county',
    'name'          => 'Bledsoe County',
    'county_id'     => 'bledsoe',
    'h1'            => 'Sell Your House Fast For Cash in Bledsoe County TN',
    'meta_title'    => 'We Buy Houses in Bledsoe County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Bledsoe County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$189,000',
    'homes_sold'    => '10',
    'avg_days'      => '108',
    'desc1'         => 'Bledsoe County is a quiet rural county on the Cumberland Plateau in East Tennessee. Home to Pikeville, the county is known for its natural beauty including Fall Creek Falls State Park and the Sequatchie Valley. Tennessee Cash For Homes buys houses across all of Bledsoe County fast and for cash.',
    'desc2'         => 'Whether you are facing financial hardship, dealing with an inherited property, or simply want a quick hassle free sale we are here to help with a fair cash offer. No repairs needed and no agent fees.',
    'land_para'     => 'Bledsoe County offers scenic mountain and valley land at some of the most affordable prices in Tennessee. Tennessee Cash For Homes buys Bledsoe County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Pikeville', 'slug' => 'pikeville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy rural properties or homes on large lots in Bledsoe County?', 'a' => 'Yes. Bledsoe County is one of Tennessee\'s most rural counties and we are experienced in purchasing properties on large lots, unimproved land, and homes in remote areas. Distance from a major city does not affect our ability to make you an offer.'],
        ['q' => 'Can I sell an inherited property in Bledsoe County?', 'a' => 'Absolutely. Many homeowners in Bledsoe County inherit properties they cannot maintain. We buy inherited homes in any condition and can help navigate the process even if probate is still in progress.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
