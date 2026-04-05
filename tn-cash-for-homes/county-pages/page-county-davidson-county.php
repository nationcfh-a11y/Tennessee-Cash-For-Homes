<?php
/**
 * Template Name: County — Davidson County
 *
 * WordPress setup:
 *   Slug:     davidson-county  (under county-pages/ parent)
 *   Template: County — Davidson County
 */

$county = [
    'slug'          => 'davidson-county',
    'name'          => 'Davidson County',
    'county_id'     => 'davidson',
    'h1'            => 'Sell Your House Fast For Cash in Davidson County',
    'meta_title'    => 'We Buy Houses in Davidson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Davidson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$470,200',
    'homes_sold'    => '686',
    'avg_days'      => '84',
    'desc1'         => 'Davidson County is Nashville -- Music City, a boomtown that has transformed from a regional capital into one of America\'s most sought-after cities. But behind the cranes in The Gulch and the bidding wars in Germantown, the Davidson County real estate market has grown more complex and segmented than ever. With a median sale price around $485,000, nearly 4 months of inventory, and homes averaging 84 days on market, the frenzy of recent years has given way to a more deliberate, price-sensitive landscape. Neighborhoods like East Nashville, Charlotte Park, Madison, and Inglewood each carry their own dynamics, and sellers in Antioch and Old Hickory face different challenges than those in the urban core. Rising property taxes, new construction competition, and shifting buyer expectations mean that not every home sells quickly -- even in Nashville.',
    'desc2'         => 'If you want to sell your house in Davidson County, the conventional path now involves navigating a market where buyers have more leverage than they did a few years ago. Homes that need updates compete against a wave of new townhome and duplex construction that builders are pricing aggressively. Properties with foundation issues, outdated systems, or cosmetic wear can sit for months while nearby new builds attract all the attention. Add in Nashville\'s rising property taxes and the cost of maintaining a home during a long listing period, and many Davidson County homeowners find that a traditional sale costs more than they expected. As cash home buyers in Davidson County, we purchase homes in any neighborhood and any condition -- no staging, no open houses, no waiting on a buyer\'s financing to come through.',
    'desc3'         => 'Whether you own a rental property in Antioch, a family home in Madison, an investment property in Old Hickory, or a house anywhere else in the county, Tennessee Cash For Homes buys houses throughout all of Davidson County in any condition. Your situation is your business -- we are simply here to make you a fair cash offer and close when you are ready.',
    'land_para'     => 'Nashville and Davidson County booming economy and population growth have made land ownership more valuable than ever. Zoning changes, development pressures, and property taxes are causing many owners to cash out. Tennessee Cash For Homes buys land in Davidson County quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Nashville',   'slug' => 'nashville',   'has_page' => true],
        ['name' => 'Antioch',     'slug' => 'antioch',     'has_page' => true],
        ['name' => 'Old Hickory', 'slug' => 'old-hickory', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'How does Nashville\'s competitive market in Davidson County affect your cash offers?', 'a' => 'Davidson County is one of Tennessee\'s hottest real estate markets. Our cash offers reflect current Nashville market conditions. Selling to us means you avoid months of showings, inspections, and buyer negotiations while still receiving a fair offer.'],
        ['q' => 'Do you buy investment properties or rentals in Davidson County?', 'a' => 'Yes. We buy all types of properties in Davidson County including rental homes, multi-family units, and investment properties — whether they are occupied or vacant, performing or distressed.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
