<?php
/**
 * Template Name: County — Marion County
 *
 * WordPress setup:
 *   Slug:     marion-county  (under county-pages/ parent)
 *   Template: County — Marion County
 */

$county = [
    'slug'          => 'marion-county',
    'name'          => 'Marion County',
    'county_id'     => 'marion',
    'h1'            => 'Sell Your House Fast For Cash in Marion County TN',
    'meta_title'    => 'We Buy Houses in Marion County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Marion County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '24',
    'avg_days'      => '88',
    'desc1'         => 'Marion County sits at the crossroads of some of Tennessee\'s most dramatic scenery and a quietly strengthening economy. Lodge Manufacturing -- the iconic cast iron cookware maker -- has called South Pittsburg home for over a century, while Mueller Water Products in Kimball and Valmont Industries in Jasper provide steady manufacturing employment across the county. With the Tennessee River Gorge to the east and Nickajack Lake stretching along its southern border, Marion County draws both longtime residents and newcomers looking for affordable living within a short commute of Chattanooga. The Marion County real estate market has been active, with South Pittsburg median sale prices climbing over 16% year-over-year.',
    'desc2'         => 'That appreciation is great news for homeowners sitting on equity, but the Marion County real estate market can still be unpredictable. With only about two dozen homes selling per month countywide and average days on market pushing toward 90, finding the right traditional buyer is no guarantee -- especially for older homes in Whitwell or properties up on the plateau that need updates. Cash home buyers in Marion County like Tennessee Cash For Homes take the guesswork out of selling. We buy houses in any condition, cover closing costs, and let you pick the timeline that works for your situation.',
    'desc3'         => 'Whatever your circumstances -- job relocation, an inherited family home in Jasper, a vacant rental in Kimball, or a property you just need to let go of -- we buy houses throughout all of Marion County. From riverfront cabins to homes in the heart of South Pittsburg, no property is too big or too small for us to make a fair cash offer.',
    'land_para'     => 'Marion County offers scenic river and mountain land including lakefront properties on Nickajack Lake. Tennessee Cash For Homes buys Marion County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Jasper', 'slug' => 'jasper', 'has_page' => false],
        ['name' => 'South Pittsburg', 'slug' => 'south-pittsburg', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Jasper, Kimball, or South Pittsburg in Marion County?', 'a' => 'Yes. We buy homes throughout Marion County including Jasper, Kimball, South Pittsburg, and Whitwell. All property conditions are welcome.'],
        ['q' => 'Can I sell a property in Marion County near the Tennessee River Gorge?', 'a' => 'We buy properties throughout Marion County including those near the Tennessee River Gorge and Nickajack Lake. Mountain and riverside properties are all ones we purchase.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
