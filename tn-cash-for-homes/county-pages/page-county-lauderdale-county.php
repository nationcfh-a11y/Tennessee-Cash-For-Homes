<?php
/**
 * Template Name: County - Lauderdale County
 *
 * WordPress setup:
 *   Slug:     lauderdale-county  (under county-pages/ parent)
 *   Template: County - Lauderdale County
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
    'desc1'         => 'Lauderdale County sits along the Mississippi River bluffs in West Tennessee, where the county seat of Ripley anchors a community built on agriculture, manufacturing, and genuine small-town pride. Marvin Windows and Doors employs over 500 skilled workers here as the largest private employer, while American Greetings runs its printing operation exclusively in Lauderdale County. Global companies like Komatsu and FAIST Light Metals have also found a home here, drawn by the county\'s proximity to major ports, railways, and interstate highways. Ripley itself is a town of about 8,400 people where the housing stock largely consists of single-family homes built between the 1960s and 1980s - solid, affordable houses that reflect the area\'s working-class roots.',
    'desc2'         => 'The Lauderdale County real estate market can be a tough place to sell through traditional channels. With a smaller buyer pool and homes that often need updating to attract today\'s mortgage-backed purchasers, properties in Ripley and Halls can linger on the market for three months or more. Many Lauderdale County homeowners find themselves stuck with older homes that need roof repairs, foundation work, or full renovations before a conventional buyer will even make an offer. Cash home buyers in Lauderdale County like Tennessee Cash For Homes buy properties exactly as they are - no repairs, no staging, no agent commissions - so you can sell your house in Lauderdale County without spending another dollar on a property you are ready to leave behind.',
    'desc3'         => 'No matter what is driving your decision to sell - job loss, divorce, an inherited home you cannot maintain from a distance, or simply the desire to move on - we buy houses throughout all of Lauderdale County in any condition. From the neighborhoods of Ripley to the community of Halls and every rural road along the Mississippi River corridor, Tennessee Cash For Homes will make you a fair, no-obligation cash offer.',
    'land_para'     => 'Lauderdale County offers fertile farmland and affordable rural lots along the Mississippi River corridor. Tennessee Cash For Homes buys Lauderdale County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Ripley', 'slug' => 'ripley', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Ripley or Halls in Lauderdale County?', 'a' => 'Yes. We buy homes throughout Lauderdale County including Ripley, Halls, and surrounding areas. Whether your property is in town or along the Mississippi River bluffs, we are interested.'],
        ['q' => 'Can I sell a property in Lauderdale County if it needs major structural work?', 'a' => 'We buy homes in Lauderdale County that need major structural repairs including foundation issues, roof replacement, and more. No repair is too big - we buy completely as-is.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
