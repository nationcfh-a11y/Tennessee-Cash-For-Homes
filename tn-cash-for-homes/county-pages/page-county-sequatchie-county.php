<?php
/**
 * Template Name: County - Sequatchie County
 *
 * WordPress setup:
 *   Slug:     sequatchie-county  (under county-pages/ parent)
 *   Template: County - Sequatchie County
 */

$county = [
    'slug'          => 'sequatchie-county',
    'name'          => 'Sequatchie County',
    'county_id'     => 'sequatchie',
    'h1'            => 'Sell Your House Fast For Cash in Sequatchie County TN',
    'meta_title'    => 'We Buy Houses in Sequatchie County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Sequatchie County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '12',
    'avg_days'      => '92',
    'desc1'         => 'Sequatchie County is a small, tight-knit community tucked into one of Tennessee\'s most scenic landscapes - the Sequatchie Valley, a narrow corridor between the Cumberland Plateau and Walden Ridge. Dunlap, the county seat, earned its reputation as the Hang Gliding Capital of the East thanks to the thermals rising off the valley\'s dramatic bluffs. The area\'s heritage runs through shuttered coal mines and historic coke ovens, celebrated each year at the Coke Ovens Bluegrass Festival. Sequatchie County home values have been climbing - median sale prices rose over 17 percent in the past year - as remote workers and retirees discover what roughly 5,500 Dunlap residents have long enjoyed: affordable living in a breathtaking setting.',
    'desc2'         => 'Despite rising values, selling a home in the Sequatchie County real estate market through traditional channels can be a slow process. With only a handful of sales each month, buyer pools are small and homes can sit for 90 days or more. Many properties in the valley are older, with the kind of foundation, roofing, or septic issues that make financed buyers walk away at inspection. If you want to sell your house in Sequatchie County without the uncertainty, cash home buyers in Sequatchie County like Tennessee Cash For Homes offer a direct path to closing - no repairs, no commissions, and no deals falling apart.',
    'desc3'         => 'Whether your property is a valley farmhouse outside Dunlap, a mountain home on the plateau, or a residence anywhere else in Sequatchie County, we buy houses in any condition and any situation. Reach out for a no-obligation cash offer and close whenever you are ready.',
    'land_para'     => 'Sequatchie County offers scenic valley and mountain land at affordable prices in a quiet Tennessee setting. Tennessee Cash For Homes buys Sequatchie County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dunlap', 'slug' => 'dunlap', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Dunlap or the Sequatchie Valley?', 'a' => 'Yes. We buy homes throughout Sequatchie County including Dunlap and the beautiful Sequatchie Valley. Mountain and valley properties are welcome in any condition.'],
        ['q' => 'Can I sell a home in Sequatchie County if the market is slow?', 'a' => 'The traditional market in Sequatchie County can be slower than metro areas. We buy directly for cash regardless of market conditions, giving you a fast, guaranteed sale.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
