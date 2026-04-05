<?php
/**
 * Template Name: County — Haywood County
 *
 * WordPress setup:
 *   Slug:     haywood-county  (under county-pages/ parent)
 *   Template: County — Haywood County
 */

$county = [
    'slug'          => 'haywood-county',
    'name'          => 'Haywood County',
    'county_id'     => 'haywood',
    'h1'            => 'Sell Your House Fast For Cash in Haywood County TN',
    'meta_title'    => 'We Buy Houses in Haywood County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Haywood County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$148,000',
    'homes_sold'    => '14',
    'avg_days'      => '98',
    'desc1'         => 'Haywood County is the heart of the West Tennessee Delta, a landscape defined by cotton fields, rich bottomland, and a cultural legacy that resonates far beyond its borders. Brownsville, the county seat, is home to the West Tennessee Delta Heritage Center, which houses the Tina Turner Museum at Flagg Grove School, honoring the icon who grew up in the nearby Nutbush community. Blues legends like Sleepy John Estes also called this area home. Agriculture remains the economic backbone, with Haywood County harvesting more cotton than any other county in Tennessee, alongside soybeans and corn across hundreds of farms. The area is also positioned for major economic change as the Ford Blue Oval City electric vehicle complex takes shape in neighboring Stanton, bringing thousands of jobs to the immediate region.',
    'desc2'         => 'Despite the promise of new development nearby, selling a home in Haywood County today still comes with real challenges. The population has been declining, the buyer pool is limited, and many properties, particularly older homes in Brownsville and rural farmhouses throughout the county, need updates that can be expensive to tackle. Haywood County home values remain well below the state median, and homes often sit on the market for close to 100 days. If you need to sell your house in Haywood County without the wait or the expense of repairs, cash home buyers in Haywood County like Tennessee Cash For Homes offer a direct path forward with a fair offer and no hidden fees.',
    'desc3'         => 'Whether your property is a historic home in Brownsville, a farmhouse on acreage near Nutbush, or a house in Stanton that has seen better days, we buy houses throughout all of Haywood County in any condition. No matter your situation, from inherited property to financial hardship to simply being ready to move on, our team is here to make the sale simple and fast.',
    'land_para'     => 'Haywood County offers fertile farmland and affordable residential lots in the West Tennessee Delta region. Tennessee Cash For Homes buys Haywood County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Brownsville', 'slug' => 'brownsville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Brownsville or Stanton in Haywood County?', 'a' => 'Yes. We purchase homes throughout Haywood County including Brownsville and Stanton. We buy in any condition and close quickly for cash.'],
        ['q' => 'Can I sell agricultural land or a farm property in Haywood County?', 'a' => 'Haywood County is largely agricultural and we buy farmland, homes on acreage, and all types of rural properties. We handle the details and close on your schedule.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
