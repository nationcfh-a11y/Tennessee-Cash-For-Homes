<?php
/**
 * Template Name: County — Crockett County
 *
 * WordPress setup:
 *   Slug:     crockett-county  (under county-pages/ parent)
 *   Template: County — Crockett County
 */

$county = [
    'slug'          => 'crockett-county',
    'name'          => 'Crockett County',
    'county_id'     => 'crockett',
    'h1'            => 'Sell Your House Fast For Cash in Crockett County TN',
    'meta_title'    => 'We Buy Houses in Crockett County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Crockett County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$138,000',
    'homes_sold'    => '10',
    'avg_days'      => '104',
    'desc1'         => 'Crockett County is deep agricultural West Tennessee -- the second-largest cotton-producing county in the state, with tens of thousands of acres also devoted to soybeans, corn, and grain sorghum each year. The county seat of Alamo anchors a community of about 14,000 residents spread across small towns like Bells, Gadsden, Maury City, and Friendship. Employers such as Hitachi Energy USA provide manufacturing jobs alongside the farming economy, but Crockett County remains one of the most rural and affordable places to live in Tennessee. Just a short drive from Jackson, the county offers a pace of life that appeals to families who want land, space, and genuine small-town roots.',
    'desc2'         => 'If you are trying to sell your house in Crockett County, the numbers tell the story of a challenging market. With only around 10 homes selling per month and properties averaging over 100 days on market, finding a qualified buyer through traditional channels takes real patience. The county\'s 100-percent rural classification means appraisers have limited comparable sales to work with, which frequently causes financed deals to fall through. Older farmhouses and homes in Alamo that need updates face an even steeper climb. As cash home buyers in Crockett County, we do not require appraisals or inspections -- we buy directly and close fast.',
    'desc3'         => 'Whether it is a farmhouse on acreage outside Bells, a home in Alamo that has sat on the market too long, or a property in any corner of the county, Tennessee Cash For Homes buys houses throughout all of Crockett County in any condition. We are here to offer a fair price and a simple closing, no matter your circumstances.',
    'land_para'     => 'Crockett County offers productive farmland and affordable rural lots in the heart of West Tennessee. Tennessee Cash For Homes buys Crockett County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Alamo', 'slug' => 'alamo', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy farm homes or properties with agricultural land in Crockett County?', 'a' => 'Yes. Crockett County has a strong agricultural heritage and we buy homes on farmland, rural residential properties, and homes in Alamo and surrounding communities.'],
        ['q' => 'Can I sell a house in Crockett County that has been on the market for a long time?', 'a' => 'If your Crockett County home has been sitting on the market without offers, we can help. We buy homes directly regardless of how long they have been listed, and we close quickly for cash.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
