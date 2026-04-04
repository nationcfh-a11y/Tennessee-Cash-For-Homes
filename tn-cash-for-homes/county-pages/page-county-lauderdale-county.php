<?php
/**
 * Template Name: County — Lauderdale County
 *
 * WordPress setup:
 *   Slug:     lauderdale-county  (under county-pages/ parent)
 *   Template: County — Lauderdale County
 */

$county = [
    'slug'          => 'lauderdale-county',
    'name'          => 'Lauderdale County',
    'county_id'     => 'lauderdale',
    'h1'            => 'Sell Your House Fast For Cash in Lauderdale County TN',
    'meta_title'    => 'We Buy Houses in Lauderdale County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Lauderdale County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$135,000',
    'homes_sold'    => '16',
    'avg_days'      => '98',
    'desc1'         => 'Lauderdale County is a West Tennessee county along the Mississippi River home to Ripley. The county has a rich agricultural heritage and offers affordable small town living with access to outdoor recreation. Tennessee Cash For Homes buys houses across all of Lauderdale County fast and for cash.',
    'desc2'         => 'Whether you are facing financial hardship, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Lauderdale County offers fertile farmland and affordable rural lots along the Mississippi River corridor. Tennessee Cash For Homes buys Lauderdale County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Ripley', 'slug' => 'ripley', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Ripley or Halls in Lauderdale County?', 'a' => 'Yes. We buy homes throughout Lauderdale County including Ripley, Halls, and surrounding areas. Whether your property is in town or along the Mississippi River bluffs, we are interested.'],
        ['q' => 'Can I sell a property in Lauderdale County if it needs major structural work?', 'a' => 'We buy homes in Lauderdale County that need major structural repairs including foundation issues, roof replacement, and more. No repair is too big — we buy completely as-is.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
