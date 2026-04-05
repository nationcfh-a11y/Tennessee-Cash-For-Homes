<?php
/**
 * Template Name: County — Macon County
 *
 * WordPress setup:
 *   Slug:     macon-county  (under county-pages/ parent)
 *   Template: County — Macon County
 */

$county = [
    'slug'          => 'macon-county',
    'name'          => 'Macon County',
    'county_id'     => 'macon',
    'h1'            => 'Sell Your House Fast For Cash in Macon County TN',
    'meta_title'    => 'We Buy Houses in Macon County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Macon County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '20',
    'avg_days'      => '88',
    'desc1'         => 'Macon County sits in the Upper Cumberland region of Middle Tennessee, where the county seat of Lafayette serves a community of about 25,000 residents who enjoy a rural lifestyle within reasonable driving distance of Nashville, Gallatin, and the broader metro area. Major employers like Fleetwood Homes, Community Hospital, and North Central Telecom provide a stable local job base, while agriculture continues to anchor much of the county\'s identity -- the rolling farmland and mini-farms that surround Lafayette are a defining feature of the landscape. Macon County home values remain about 1 percent below the national average, making it an attractive option for families, retirees, and first-time buyers looking for space and affordability that the Nashville suburbs can no longer offer.',
    'desc2'         => 'The Macon County real estate market offers a wide range of properties -- from established single-family homes in Lafayette to new construction and large rural tracts -- but selling here is not always quick or simple. Properties typically stay on the market for 40 to 60 days under ideal conditions, and homes that need updating, have deferred maintenance, or sit on large parcels with complicated access can take significantly longer. Traditional sales also mean agent commissions, buyer inspections, and the ever-present risk of financing falling through at the last minute. Cash home buyers in Macon County like Tennessee Cash For Homes eliminate those headaches entirely. We buy your home as-is, cover closing costs, and let you sell your house in Macon County without spending another dime on repairs or waiting for the right buyer to come along.',
    'desc3'         => 'No matter what your reason for selling -- an inherited property you cannot maintain, a vacant home that has fallen into disrepair, a financial situation that requires a fast resolution, or simply the desire to move on -- we buy houses throughout all of Macon County in any condition. From Lafayette to the farmland along the Kentucky border and every community in between, Tennessee Cash For Homes will provide a fair, no-obligation cash offer on your timeline.',
    'land_para'     => 'Macon County offers affordable farmland and rural residential lots in the Upper Cumberland region. Tennessee Cash For Homes buys Macon County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Lafayette', 'slug' => 'lafayette', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Lafayette or rural Macon County?', 'a' => 'Yes. We buy homes throughout Macon County including Lafayette and all surrounding rural communities. We are experienced with properties in smaller Tennessee markets.'],
        ['q' => 'Can I sell a home in Macon County if it has been vacant and neglected?', 'a' => 'We buy vacant and neglected homes in Macon County regularly. Even if the property has significant deterioration, we purchase as-is and handle all the cleanup after closing.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
