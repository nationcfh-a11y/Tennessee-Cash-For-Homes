<?php
/**
 * Template Name: County - Sevier County
 *
 * WordPress setup:
 *   Slug:     sevier-county  (under county-pages/ parent)
 *   Template: County - Sevier County
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
    'desc1'         => 'Sevier County is the tourism engine of East Tennessee. Gatlinburg and Pigeon Forge draw millions of visitors a year to Dollywood, The Island, and the gateway to Great Smoky Mountains National Park, while Sevierville - the county seat and Dolly Parton\'s birthplace - has grown into a commercial hub of its own. The area ranked third nationally in total Airbnb revenue in 2024-2025, generating nearly $4 billion in annual visitor spending. That tourism economy has pushed Sevier County home values sharply upward, with average sale prices climbing over 20 percent year-over-year as demand for cabins, chalets, and short-term rental properties continues to outpace supply.',
    'desc2'         => 'But the Sevier County real estate market is unlike anywhere else in Tennessee, and that creates unique challenges for sellers. Cabin properties often carry high HOA fees and require expensive maintenance on hot tubs, decks, and gravel roads. Short-term rental occupancy has normalized to 53-58 percent, leaving some owners with underperforming investments. Wildfire risk, steep terrain, and well-and-septic systems can complicate traditional sales. If you need to sell your house in Sevier County - whether it is a primary residence in Sevierville or a cabin in the Smokies that is no longer cash-flowing - cash home buyers in Sevier County like Tennessee Cash For Homes can take the property off your hands quickly, with no repairs, no commissions, and no financing contingencies.',
    'desc3'         => 'From a chalet in Gatlinburg to a ranch home in Sevierville to a multi-unit cabin resort in Pigeon Forge, we buy properties throughout all of Sevier County in any condition. Whatever your situation, reach out for a fair, no-obligation cash offer and choose a closing date that works for you.',
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
