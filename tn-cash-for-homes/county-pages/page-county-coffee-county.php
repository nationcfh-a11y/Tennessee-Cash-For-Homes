<?php
/**
 * Template Name: County - Coffee County
 *
 * WordPress setup:
 *   Slug:     coffee-county  (under county-pages/ parent)
 *   Template: County - Coffee County
 */

$county = [
    'slug'          => 'coffee-county',
    'name'          => 'Coffee County',
    'county_id'     => 'coffee',
    'h1'            => 'Sell Your House Fast For Cash in Coffee County TN',
    'meta_title'    => 'We Buy Houses in Coffee County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Coffee County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$289,000',
    'homes_sold'    => '42',
    'avg_days'      => '78',
    'desc1'         => 'Coffee County is a Middle Tennessee community shaped by two distinct towns with their own identities. Tullahoma is home to Arnold Air Force Base and the Arnold Engineering Development Complex - one of the world\'s most advanced aerospace testing facilities - bringing military families and defense contractors to the area. Manchester, the county seat, is known worldwide as the home of the Bonnaroo Music and Arts Festival and serves as a crossroads between Nashville and Chattanooga along Interstate 24. Together these communities support a Coffee County real estate market where home prices remain well below the state median, attracting both military personnel and families seeking affordable space in a growing region.',
    'desc2'         => 'Selling your house in Coffee County can be complicated by the area\'s unique buyer dynamics. Military families near Arnold Air Force Base often rent rather than buy due to PCS transfer cycles, which limits the local buyer pool for certain neighborhoods in Tullahoma. In Manchester, older homes and properties that need updates can sit on market for weeks while buyers hold out for newer construction. With homes averaging 78 days on market countywide, sellers who need to move quickly - especially those facing relocation orders or managing a property from out of state - often find the traditional process too slow. As cash home buyers in Coffee County, we close in as little as two weeks with no repairs and no agent commissions.',
    'desc3'         => 'Whether you own a home near Arnold Air Force Base in Tullahoma, a property in Manchester, or a house anywhere else in the county, Tennessee Cash For Homes buys houses throughout all of Coffee County in any condition. Your situation does not change our offer - we are here to help you move forward on your schedule.',
    'land_para'     => 'Coffee County offers rural farmland, residential lots, and wooded acreage at competitive prices. Tennessee Cash For Homes buys Coffee County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Manchester',  'slug' => 'manchester',  'has_page' => false],
        ['name' => 'Tullahoma',   'slug' => 'tullahoma',   'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Tullahoma or Manchester in Coffee County?', 'a' => 'Yes. We actively purchase homes throughout Coffee County including Tullahoma, Manchester, and surrounding communities. Whether near Arnold Air Force Base or in town, we buy in any condition.'],
        ['q' => 'Can I sell a house in Coffee County if I am relocating for military orders?', 'a' => 'We work with military families near Arnold Air Force Base in Coffee County frequently. If you need to sell quickly due to PCS orders or deployment, we can close on your timeline - often in under two weeks.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
