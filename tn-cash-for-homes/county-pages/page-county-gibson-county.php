<?php
/**
 * Template Name: County - Gibson County
 *
 * WordPress setup:
 *   Slug:     gibson-county  (under county-pages/ parent)
 *   Template: County - Gibson County
 */

$county = [
    'slug'          => 'gibson-county',
    'name'          => 'Gibson County',
    'county_id'     => 'gibson',
    'h1'            => 'Sell Your House Fast For Cash in Gibson County TN',
    'meta_title'    => 'We Buy Houses in Gibson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Gibson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$155,000',
    'homes_sold'    => '38',
    'avg_days'      => '90',
    'desc1'         => 'Gibson County is one of the largest counties in West Tennessee by area, and its three main towns each bring something different to the table. Trenton, the county seat, is known for its world-record collection of porcelain night-light teapots and the annual Teapot Festival that draws visitors from across the region. Humboldt hosts the West Tennessee Strawberry Festival each May, a tradition since 1934. Milan sits near the former Milan Army Ammunition Plant, where American Ordnance remains one of the county\'s largest private employers with over a thousand workers. Agriculture, particularly row crops and livestock, still anchors much of the rural economy, and Gibson County home values reflect an affordable market where the median hovers well below state averages.',
    'desc2'         => 'Affordability makes Gibson County a great place to live, but it can work against you when it is time to sell. With median home values around $110,000 in towns like Humboldt and properties averaging 90 days or more on market, agent commissions and repair costs can consume a significant share of your equity. Older housing stock in Trenton and Humboldt frequently needs roof, plumbing, or HVAC work that traditional buyers are not willing to take on. If you need to sell your house in Gibson County without sinking money into repairs, cash home buyers in Gibson County like us purchase properties as-is, pay closing costs, and can finalize the sale in as little as two weeks.',
    'desc3'         => 'Whether you have a farmhouse outside Medina, a duplex in Humboldt, or a home in Milan that has been sitting vacant, Tennessee Cash For Homes buys houses throughout all of Gibson County in any condition. Your circumstances do not change our willingness to help. Reach out and let us show you how simple selling can be.',
    'land_para'     => 'Gibson County offers some of West Tennessee\'s most productive farmland along with affordable residential lots. Tennessee Cash For Homes buys Gibson County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Trenton', 'slug' => 'trenton', 'has_page' => false],
        ['name' => 'Humboldt', 'slug' => 'humboldt', 'has_page' => false],
        ['name' => 'Milan', 'slug' => 'milan', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Trenton, Humboldt, or Milan in Gibson County?', 'a' => 'Yes. We purchase homes throughout Gibson County including Trenton, Humboldt, Milan, Medina, and all surrounding communities. We are familiar with the local market and provide fair offers.'],
        ['q' => 'Can I sell a home in Gibson County that needs a new roof?', 'a' => 'Absolutely. We buy homes in Gibson County as-is, including those needing major repairs like a new roof. You do not need to spend money on repairs before selling to us.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
