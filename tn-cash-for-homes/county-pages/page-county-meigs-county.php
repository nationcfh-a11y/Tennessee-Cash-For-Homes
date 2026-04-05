<?php
/**
 * Template Name: County — Meigs County
 *
 * WordPress setup:
 *   Slug:     meigs-county  (under county-pages/ parent)
 *   Template: County — Meigs County
 */

$county = [
    'slug'          => 'meigs-county',
    'name'          => 'Meigs County',
    'county_id'     => 'meigs',
    'h1'            => 'Sell Your House Fast For Cash in Meigs County TN',
    'meta_title'    => 'We Buy Houses in Meigs County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Meigs County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '10',
    'avg_days'      => '98',
    'desc1'         => 'Meigs County is one of East Tennessee\'s hidden gems -- a rural county of roughly 13,000 residents bordered by nearly 75 miles of shoreline along Watts Bar Lake and Chickamauga Lake. The county seat of Decatur sits where the Tennessee River bends, and most of the community\'s economy is built around manufacturing, which employs over a quarter of the local workforce, along with agriculture that includes nearly 100 cattle farms. With a median age above 45 and a strong homeownership rate, Meigs County home values reflect a community where people put down roots and stay. The land market has been heating up too, with appreciation rates above 12% drawing attention from investors looking for affordable waterfront and rural parcels.',
    'desc2'         => 'But the flip side of Meigs County\'s small size is a limited buyer pool. Homes here can sit on the market for well over 100 days, and the median price has fluctuated significantly year to year, making it hard to time a traditional sale. If you want to sell your house in Meigs County without the uncertainty of waiting for a buyer who may never come -- especially for older homes, properties on well and septic, or lakefront cabins that need updating -- cash home buyers in Meigs County like Tennessee Cash For Homes offer a straightforward alternative. No listing, no showings, no agent fees.',
    'desc3'         => 'Whatever your reason for selling -- whether you have inherited a family property in Decatur, own a lake cabin near Ten Mile that you no longer use, or need to sell quickly due to financial pressures -- we buy houses throughout all of Meigs County in any condition. Our team understands rural East Tennessee properties and will give you a fair, no-obligation cash offer.',
    'land_para'     => 'Meigs County offers unique lakefront land surrounded by the Tennessee River on multiple sides. Tennessee Cash For Homes buys Meigs County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Decatur', 'slug' => 'decatur', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties near Watts Bar Lake in Meigs County?', 'a' => 'Yes. Meigs County borders Watts Bar Lake and we buy homes, lake properties, and land throughout the county including Decatur and Ten Mile.'],
        ['q' => 'Is it hard to sell a home in a small county like Meigs County?', 'a' => 'Traditional home sales in Meigs County can be slow due to limited buyer activity. We eliminate that challenge by buying your home directly for cash with a quick, certain closing.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
