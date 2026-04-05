<?php
/**
 * Template Name: County — Benton County
 *
 * WordPress setup:
 *   Slug:     benton-county  (under county-pages/ parent)
 *   Template: County — Benton County
 */

$county = [
    'slug'          => 'benton-county',
    'name'          => 'Benton County',
    'county_id'     => 'benton',
    'h1'            => 'Sell Your House Fast For Cash in Benton County TN',
    'meta_title'    => 'We Buy Houses in Benton County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Benton County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$179,000',
    'homes_sold'    => '12',
    'avg_days'      => '105',
    'desc1'         => 'Benton County sits along the Tennessee River in West Tennessee, serving as the southern gateway to the Kentucky Lake recreation area. Camden, the county seat on the banks of the river, anchors a local economy built on tourism, farming, and proximity to the DuPont plant in nearby New Johnsonville. The county is also home to Big Sandy and the unique Tennessee Freshwater Pearl Farm at Birdsong Resort, the only freshwater pearl farm in North America. With Kentucky Lake forming the eastern border, Benton County attracts vacation homeowners, retirees, and outdoor enthusiasts — but the year-round population of about 16,000 keeps the area feeling genuinely small-town and unhurried.',
    'desc2'         => 'Selling a home in the Benton County real estate market can be a slow process. With a high vacancy rate and many seasonal or vacation properties, homes here often sit on the market for over 100 days waiting for the right buyer. Properties near Kentucky Lake may appeal to a niche audience, while homes in Camden or Big Sandy compete in a market with limited local demand. Cash home buyers in Benton County like us remove those obstacles entirely — no waiting for a seasonal buyer, no lender-required appraisals falling short, and no agent fees. If you need to sell your house in Benton County, we provide a fair cash offer and close on your schedule.',
    'desc3'         => 'Whether you own a lakefront cabin that needs repairs, a family home in Camden you have inherited, or a property in Big Sandy you can no longer maintain, Tennessee Cash For Homes purchases houses throughout all of Benton County in any condition. Your situation does not matter to us — what matters is giving you a straightforward path to selling your home.',
    'land_para'     => 'Benton County offers affordable rural land with excellent access to Kentucky Lake and the Tennessee River. Tennessee Cash For Homes buys Benton County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Camden', 'slug' => 'camden', 'has_page' => false],
        ['name' => 'Big Sandy', 'slug' => 'big-sandy', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy lakefront or vacation properties in Benton County?', 'a' => 'Yes. Benton County is home to Kentucky Lake and many seasonal or vacation properties. We buy lakefront homes, cabins, and all types of properties in Benton County regardless of condition or occupancy status.'],
        ['q' => 'Can I sell a house in Camden or other small towns in Benton County?', 'a' => 'We buy homes throughout all of Benton County including Camden, Big Sandy, and surrounding communities. Small-town properties are no problem for us.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
