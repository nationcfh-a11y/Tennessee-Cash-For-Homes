<?php
/**
 * Template Name: County — Cocke County
 *
 * WordPress setup:
 *   Slug:     cocke-county  (under county-pages/ parent)
 *   Template: County — Cocke County
 */

$county = [
    'slug'          => 'cocke-county',
    'name'          => 'Cocke County',
    'county_id'     => 'cocke',
    'h1'            => 'Sell Your House Fast For Cash in Cocke County TN',
    'meta_title'    => 'We Buy Houses in Cocke County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Cocke County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$210,000',
    'homes_sold'    => '28',
    'avg_days'      => '90',
    'desc1'         => 'Cocke County sits at the gateway to the Great Smoky Mountains, where the Pigeon River and French Broad River carve through some of East Tennessee\'s most dramatic scenery. Newport, the county seat, has seen renewed interest as both local buyers and out-of-state investors discover its proximity to Gatlinburg, Pigeon Forge, the Foothills Parkway, and the Appalachian Trail. Whitewater rafting on the Pigeon River, off-grid mountain properties, and affordable entry-level homes have all contributed to a Cocke County real estate market that saw median prices rise over 16 percent year-over-year recently. Communities like Parrottsville, Del Rio, and Hartford add to the county\'s mix of mountain hideaways and small-town neighborhoods.',
    'desc2'         => 'Despite rising Cocke County home values, selling a house here through traditional methods is not always straightforward. Properties that need updates -- and many in Newport and the surrounding hollows do -- can struggle to attract financed buyers who want move-in-ready homes. Mountain properties with well water, septic systems, or unpaved access roads face additional hurdles during inspections and appraisals. With homes averaging 90 days on market, sellers dealing with code violations, deferred maintenance, or complicated title histories often find themselves stuck. As cash home buyers in Cocke County, we purchase as-is and handle those complexities directly.',
    'desc3'         => 'From a fixer-upper in Newport to a mountain cabin near the Smokies, Tennessee Cash For Homes buys houses throughout all of Cocke County in any condition. Whether you are behind on payments, managing an inherited property, or simply ready to move on, we are here to make the process simple and stress-free.',
    'land_para'     => 'Cocke County offers mountain land with river access and Smoky Mountain views at affordable prices. Tennessee Cash For Homes buys Cocke County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Newport', 'slug' => 'newport', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Newport or Parrottsville in Cocke County?', 'a' => 'Yes. We purchase homes throughout Cocke County including Newport, Parrottsville, and the surrounding areas near the Smoky Mountains. All property conditions are welcome.'],
        ['q' => 'Can I sell a property in Cocke County that has code violations?', 'a' => 'Absolutely. We buy homes in Cocke County even if they have code violations, liens, or other legal issues. We are experienced in handling complex situations and will work through any obstacles.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
