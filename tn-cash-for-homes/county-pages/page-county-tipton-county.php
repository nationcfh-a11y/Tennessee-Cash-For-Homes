<?php
/**
 * Template Name: County — Tipton County
 *
 * WordPress setup:
 *   Slug:     tipton-county  (under county-pages/ parent)
 *   Template: County — Tipton County
 */

$county = [
    'slug'          => 'tipton-county',
    'name'          => 'Tipton County',
    'county_id'     => 'tipton',
    'h1'            => 'Sell Your House Fast For Cash in Tipton County TN',
    'meta_title'    => 'We Buy Houses in Tipton County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Tipton County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '48',
    'avg_days'      => '80',
    'desc1'         => 'Tipton County is a growing suburban county north of Memphis home to Covington and the fast expanding community of Munford. The county offers affordable housing with easy access to Memphis employment and amenities. Tennessee Cash For Homes buys houses across all of Tipton County fast and for cash.',
    'desc2'         => 'Whether you are dealing with an inherited property, facing financial challenges, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Tipton County\'s suburban growth from Memphis has made land increasingly valuable for residential development. Tennessee Cash For Homes buys Tipton County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Covington', 'slug' => 'covington', 'has_page' => false],
        ['name' => 'Munford', 'slug' => 'munford', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Covington, Munford, or Atoka in Tipton County?', 'a' => 'Yes. We buy homes throughout Tipton County including Covington, Munford, Atoka, Brighton, and Mason. We are active in the Memphis suburban market.'],
        ['q' => 'Is Tipton County growing enough to support strong home values?', 'a' => 'Tipton County has benefited from Memphis suburban growth, particularly in Atoka and Munford. Our cash offers reflect the area\'s strong and increasing demand.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
