<?php
/**
 * Template Name: County — Unicoi County
 *
 * WordPress setup:
 *   Slug:     unicoi-county  (under county-pages/ parent)
 *   Template: County — Unicoi County
 */

$county = [
    'slug'          => 'unicoi-county',
    'name'          => 'Unicoi County',
    'county_id'     => 'unicoi',
    'h1'            => 'Sell Your House Fast For Cash in Unicoi County TN',
    'meta_title'    => 'We Buy Houses in Unicoi County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Unicoi County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$215,000',
    'homes_sold'    => '14',
    'avg_days'      => '90',
    'desc1'         => 'Unicoi County is a close-knit mountain community in upper East Tennessee where the Nolichucky River cuts through one of the most dramatic gorges on the Appalachian Trail. Erwin, the county seat with a population just over 6,000, serves as the gateway to the Cherokee National Forest and the Unaka Mountains. The local economy is more diverse than many realize -- alongside outdoor recreation and tourism, Unicoi County is home to employers in defense, automotive, nuclear fuel, and manufacturing sectors, plus the Unicoi County Memorial Hospital and a strong school system. With average home values around $165,000, the area offers genuinely affordable mountain living that draws retirees, outdoor enthusiasts, and families alike.',
    'desc2'         => 'Selling a home in Unicoi County\'s small market presents real challenges. Limited buyer pools, older housing stock, and mountain properties that can be difficult to appraise or finance traditionally all contribute to longer days on market. If you are looking to sell your house in Unicoi County without the hassle of repairs, showings, and uncertain timelines, cash home buyers in Unicoi County like us offer a reliable path forward. We base our offers on actual Unicoi County real estate market conditions -- not generic statewide formulas -- and we handle all the details so you can move on.',
    'desc3'         => 'Regardless of your situation -- whether it is an inherited cabin near the Nolichucky, a home in Erwin that needs foundation work, or a property you simply want to sell without delay -- Tennessee Cash For Homes buys houses throughout all of Unicoi County in any condition. Mountain homes, river properties, in-town residences, and everything in between are all welcome.',
    'land_para'     => 'Unicoi County offers affordable mountain land with river access and stunning views of the Unaka Mountains. Tennessee Cash For Homes buys Unicoi County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Erwin', 'slug' => 'erwin', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Erwin or near the Appalachian Trail in Unicoi County?', 'a' => 'Yes. We buy homes throughout Unicoi County including Erwin and areas near the Appalachian Trail and Unaka Mountains. Mountain properties in any condition are welcome.'],
        ['q' => 'Can I sell a home in Unicoi County after a natural disaster or landslide?', 'a' => 'Unicoi County\'s mountain terrain can make properties vulnerable to flooding and landslides. We buy damaged properties as-is and handle all the complications so you do not have to.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
