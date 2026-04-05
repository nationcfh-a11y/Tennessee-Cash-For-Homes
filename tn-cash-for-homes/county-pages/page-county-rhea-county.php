<?php
/**
 * Template Name: County — Rhea County
 *
 * WordPress setup:
 *   Slug:     rhea-county  (under county-pages/ parent)
 *   Template: County — Rhea County
 */

$county = [
    'slug'          => 'rhea-county',
    'name'          => 'Rhea County',
    'county_id'     => 'rhea',
    'h1'            => 'Sell Your House Fast For Cash in Rhea County TN',
    'meta_title'    => 'We Buy Houses in Rhea County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Rhea County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '28',
    'avg_days'      => '86',
    'desc1'         => 'Rhea County sits along the Tennessee River between Chattanooga and Knoxville, centered on Dayton, the county seat best known for the historic 1925 Scopes Trial and the annual Tennessee Strawberry Festival. Manufacturing remains a major economic driver, with La-Z-Boy, Nokian Tyres, TenCate, and Baltimore Air Coil all operating facilities in the Dayton area. Spring City, nestled between Watts Bar Lake and Walden Ridge, is home to TVA\'s Watts Bar Nuclear Plant and employers like General Shale Brick and SSM Industries. With Dayton currently expanding its wastewater capacity to support future growth, the Rhea County real estate market is positioned for continued development.',
    'desc2'         => 'Despite that growth potential, selling a home in Rhea County through a traditional listing is not always straightforward. Days on market have stretched considerably compared to recent years, and homes that need work or sit in less desirable locations can linger without offers. If you are carrying the cost of a property you need to sell, those extra months of taxes, insurance, and maintenance add up fast. Cash home buyers in Rhea County offer a way to skip the wait. We buy homes as-is in Dayton, Spring City, Graysville, and everywhere in between, with no agent fees and a closing date you choose.',
    'desc3'         => 'Whatever your reason for selling, whether you have a lakefront home on Watts Bar that needs updating, a rental property in Dayton you want to offload, or a family house in Spring City you inherited, we buy houses throughout all of Rhea County in any condition. Tennessee Cash For Homes is here to give you a fair cash offer and a process that respects your time.',
    'land_para'     => 'Rhea County offers lakefront land on Watts Bar Lake and affordable rural acreage in a growing market. Tennessee Cash For Homes buys Rhea County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Dayton', 'slug' => 'dayton', 'has_page' => false],
        ['name' => 'Spring City', 'slug' => 'spring-city', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Dayton or Spring City in Rhea County?', 'a' => 'Yes. We buy homes throughout Rhea County including Dayton, Spring City, and Graysville. Lake properties near Watts Bar and Chickamauga Lake are also welcome.'],
        ['q' => 'Can I sell a home in Rhea County near the lake?', 'a' => 'Rhea County has extensive lake frontage and we buy lakefront homes, nearby residences, and all property types throughout the county. Condition does not matter.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
