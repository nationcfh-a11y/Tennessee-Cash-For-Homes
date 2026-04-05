<?php
/**
 * Template Name: County — Cumberland County
 *
 * WordPress setup:
 *   Slug:     cumberland-county  (under county-pages/ parent)
 *   Template: County — Cumberland County
 */

$county = [
    'slug'          => 'cumberland-county',
    'name'          => 'Cumberland County',
    'county_id'     => 'cumberland',
    'h1'            => 'Sell Your House Fast For Cash in Cumberland County TN',
    'meta_title'    => 'We Buy Houses in Cumberland County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Cumberland County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$265,000',
    'homes_sold'    => '72',
    'avg_days'      => '82',
    'desc1'         => 'Cumberland County is Tennessee\'s retirement destination, perched atop the Cumberland Plateau where mild summers and four distinct seasons draw thousands of new residents each year. Crossville, the county seat, anchors the region, while Fairfield Glade -- a 12,500-acre master-planned community named one of the 50 Best Master-Planned Communities by Where to Retire magazine -- is home to over 9,000 residents enjoying five championship golf courses, eleven spring-fed lakes, and resort-style amenities. Cumberland County home values offer a compelling value proposition: retirees get the lifestyle of a destination community at a fraction of the cost they would pay in Florida or the Carolinas. With 72 homes selling monthly, this is one of the more active markets on the Plateau.',
    'desc2'         => 'While Cumberland County\'s popularity with retirees keeps demand steady, selling your house here is not always simple. The county\'s large geographic footprint -- one of the biggest in Tennessee -- means properties outside the Crossville and Fairfield Glade corridors can be difficult to market to a buyer pool that skews toward planned-community amenities. Homes in older subdivisions or those needing roof, HVAC, or foundation work can struggle when buyers are comparing them to turnkey options in the golf communities. HOA complications in Fairfield Glade and other developments add another layer of complexity. As cash home buyers in Cumberland County, we handle all of that -- no HOA negotiations, no repair demands, and no waiting on a retiree buyer\'s home sale to fund their purchase.',
    'desc3'         => 'From a golf-community home in Fairfield Glade to a cabin in the woods outside Crossville, Tennessee Cash For Homes buys houses throughout all of Cumberland County in any condition. Whatever your reason for selling -- downsizing, relocating, managing an estate, or anything else -- we make it straightforward and stress-free.',
    'land_para'     => 'Cumberland County is one of Tennessee\'s largest counties by area with diverse land options from mountain tracts to lakefront lots. Tennessee Cash For Homes buys Cumberland County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Crossville', 'slug' => 'crossville', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy retirement or second homes in Cumberland County?', 'a' => 'Yes. Cumberland County — especially the Crossville and Fairfield Glade areas — is popular with retirees. We buy primary residences, second homes, and retirement properties throughout the county.'],
        ['q' => 'Can I sell a home in a Crossville golf community in Cumberland County?', 'a' => 'Absolutely. We purchase homes in Crossville\'s planned communities and golf neighborhoods. HOA properties are no problem, and we handle all the details of the sale.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
