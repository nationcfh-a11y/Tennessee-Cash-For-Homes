<?php
/**
 * Template Name: County - Hardin County
 *
 * WordPress setup:
 *   Slug:     hardin-county  (under county-pages/ parent)
 *   Template: County - Hardin County
 */

$county = [
    'slug'          => 'hardin-county',
    'name'          => 'Hardin County',
    'county_id'     => 'hardin',
    'h1'            => 'Sell Your House Fast For Cash in Hardin County TN',
    'meta_title'    => 'We Buy Houses in Hardin County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hardin County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$185,000',
    'homes_sold'    => '22',
    'avg_days'      => '94',
    'desc1'         => 'Hardin County sits along the Tennessee River in the southwestern corner of the state, anchored by the city of Savannah and shaped by landmarks like the Shiloh National Military Park and Pickwick Lake. The area has earned recognition as one of the top retirement destinations in Tennessee, thanks to its waterfront lifestyle, award-winning schools, and low tax burden. From the upscale homes in The Preserve at Pickwick Lake to modest river cabins near Counce, the Hardin County real estate market spans a wide range. Tourism fuels much of the local economy, with the annual National Catfish Derby and world-class bass fishing drawing visitors year-round, while healthcare and manufacturing round out the employment base.',
    'desc2'         => 'Selling a home in Hardin County can be complicated, especially when your property is a seasonal lake house, a vacation cabin that has sat empty, or a home that needs significant repairs before it could attract a traditional buyer. Hardin County home values vary widely between waterfront properties and inland homes, and listings here can take well over 90 days to move. If you want to sell your house in Hardin County without the uncertainty of a long listing period, Tennessee Cash For Homes offers a direct cash sale with no agent commissions, no repair demands, and a closing date you choose.',
    'desc3'         => 'Whether you own a riverfront property in Savannah, a cabin near Pickwick Dam, or a family home anywhere in Hardin County, we buy houses throughout the entire county in any condition. Inherited properties, homes with deferred maintenance, or places you simply need to move on from, our team handles it all with a fair cash offer and a simple process.',
    'land_para'     => 'Hardin County offers beautiful riverfront land along the Tennessee River, Pickwick Lake access, and affordable rural acreage. Tennessee Cash For Homes buys Hardin County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Savannah', 'slug' => 'savannah', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties near Pickwick Lake or Shiloh in Hardin County?', 'a' => 'Yes. Hardin County is home to Pickwick Lake and the Shiloh National Military Park. We buy homes, lake properties, and residential land throughout the county including Savannah and Counce.'],
        ['q' => 'Can I sell a seasonal or vacation home in Hardin County?', 'a' => 'We buy seasonal and vacation homes in Hardin County. Whether your lake house or cabin is used part-time or has been sitting empty, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
