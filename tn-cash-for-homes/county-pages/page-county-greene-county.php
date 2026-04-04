<?php
/**
 * Template Name: County — Greene County
 *
 * WordPress setup:
 *   Slug:     greene-county  (under county-pages/ parent)
 *   Template: County — Greene County
 */

$county = [
    'slug'          => 'greene-county',
    'name'          => 'Greene County',
    'county_id'     => 'greene',
    'h1'            => 'Sell Your House Fast For Cash in Greene County TN',
    'meta_title'    => 'We Buy Houses in Greene County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Greene County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '52',
    'avg_days'      => '82',
    'desc1'         => 'Greene County is one of East Tennessee\'s oldest and most historic counties, home to Greeneville where President Andrew Johnson lived and worked. The county offers affordable mountain living, rich history, and a strong agricultural tradition. Tennessee Cash For Homes buys houses across all of Greene County fast and for cash.',
    'desc2'         => 'Whether you are facing financial challenges, dealing with an inherited property, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your schedule.',
    'land_para'     => 'Greene County offers a mix of fertile valley farmland and scenic mountain tracts in the foothills of the Appalachians. Tennessee Cash For Homes buys Greene County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Greeneville', 'slug' => 'greeneville', 'has_page' => false],
        ['name' => 'Mosheim', 'slug' => 'mosheim', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Greeneville or Tusculum in Greene County?', 'a' => 'Yes. We purchase homes throughout Greene County including Greeneville, Tusculum, Mosheim, and all surrounding areas. Whether historic downtown or rural, we buy in any condition.'],
        ['q' => 'Can I sell a tobacco farm or agricultural property in Greene County?', 'a' => 'Greene County has a rich agricultural history and we buy all types of properties including former farms, homes with acreage, and agricultural land. We handle the details.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
