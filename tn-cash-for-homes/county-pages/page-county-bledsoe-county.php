<?php
/**
 * Template Name: County - Bledsoe County
 *
 * WordPress setup:
 *   Slug:     bledsoe-county  (under county-pages/ parent)
 *   Template: County - Bledsoe County
 */

$county = [
    'slug'          => 'bledsoe-county',
    'name'          => 'Bledsoe County',
    'county_id'     => 'bledsoe',
    'h1'            => 'Sell Your House Fast For Cash in Bledsoe County TN',
    'meta_title'    => 'We Buy Houses in Bledsoe County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Bledsoe County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$189,000',
    'homes_sold'    => '10',
    'avg_days'      => '108',
    'desc1'         => 'Bledsoe County stretches across the Sequatchie Valley and up onto the Cumberland Plateau, offering some of the most dramatic scenery in Tennessee. Pikeville, the county seat, serves as the hub for a community of about 15,000 residents who value the rural pace of life and proximity to outdoor attractions like Fall Creek Falls State Park. The local economy centers on public administration, small-scale agriculture, and the tourism dollars that flow in from visitors to the state park and the surrounding plateau. Bledsoe County home values remain among the most affordable in the state, with a median well below the Tennessee average, making the area attractive to first-time buyers and investors looking for value on the plateau.',
    'desc2'         => 'While affordability is one of Bledsoe County\'s strengths, it also means the local real estate market moves slowly. With a small population and limited buyer demand, homes in Pikeville and the outlying rural areas can linger on the market for months. Many properties in the county sit on large lots with well water and septic systems, which can complicate traditional sales that depend on bank financing and inspections. As cash home buyers in Bledsoe County, we handle these situations every day. We do not require appraisals, we do not ask for repairs, and we close quickly so you can sell your house in Bledsoe County without the uncertainty of waiting for a conventional buyer.',
    'desc3'         => 'Regardless of your circumstances - whether you are managing an inherited property in Pikeville, dealing with a home that has fallen into disrepair, or simply ready to move on from a property in the Sequatchie Valley - Tennessee Cash For Homes buys houses throughout all of Bledsoe County in any condition. We are here to make the process as simple as possible.',
    'land_para'     => 'Bledsoe County offers scenic mountain and valley land at some of the most affordable prices in Tennessee. Tennessee Cash For Homes buys Bledsoe County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Pikeville', 'slug' => 'pikeville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy rural properties or homes on large lots in Bledsoe County?', 'a' => 'Yes. Bledsoe County is one of Tennessee\'s most rural counties and we are experienced in purchasing properties on large lots, unimproved land, and homes in remote areas. Distance from a major city does not affect our ability to make you an offer.'],
        ['q' => 'Can I sell an inherited property in Bledsoe County?', 'a' => 'Absolutely. Many homeowners in Bledsoe County inherit properties they cannot maintain. We buy inherited homes in any condition and can help navigate the process even if probate is still in progress.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
