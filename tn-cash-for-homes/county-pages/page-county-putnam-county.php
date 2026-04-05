<?php
/**
 * Template Name: County — Putnam County
 *
 * WordPress setup:
 *   Slug:     putnam-county  (under county-pages/ parent)
 *   Template: County — Putnam County
 */

$county = [
    'slug'          => 'putnam-county',
    'name'          => 'Putnam County',
    'county_id'     => 'putnam',
    'h1'            => 'Sell Your House Fast For Cash in Putnam County TN',
    'meta_title'    => 'We Buy Houses in Putnam County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Putnam County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$285,000',
    'homes_sold'    => '68',
    'avg_days'      => '76',
    'desc1'         => 'Putnam County is one of Tennessee\'s fastest-growing areas, anchored by Cookeville and fueled by Tennessee Tech University, a strong manufacturing sector, and an increasingly attractive cost of living. Major employers like Cummins, FedEx, Ficosa, and Ceco Building Systems provide well-paying jobs, while the county issued over 650 new and renewed business licenses in 2025 alone. Housing units have grown from about 35,000 in 2020 to over 38,000 in 2025, with building permits in unincorporated areas nearly doubling in value over that same period. Communities like Algood, Baxter, and Monterey each bring their own character to a county where median household income has risen roughly 41 percent since 2020.',
    'desc2'         => 'Putnam County home values have climbed steadily with all this growth, and while that is good news for long-term equity, it can complicate a sale if your property does not fit the mold of what today\'s buyers want. Homes that need updating, properties with storm damage from the severe weather events that have hit the area, or houses near Tennessee Tech that served as rentals can all be harder to move through traditional listings. Cash home buyers in Putnam County like us remove those obstacles. We buy as-is, cover closing costs, and can close in as little as two weeks, so you do not have to spend money on repairs or wait for bank-financed offers to clear.',
    'desc3'         => 'Regardless of what is driving your decision, whether it is a job relocation, a divorce, an inherited property in Cookeville, or a home that took damage in a tornado, we buy houses throughout all of Putnam County in any condition. From subdivisions off South Willow to rural acreage outside Baxter, Tennessee Cash For Homes is here to provide a fair cash offer and a closing process that works on your timeline.',
    'land_para'     => 'Putnam County\'s rapid growth has increased demand for land across the county. Tennessee Cash For Homes buys Putnam County land quickly with no commissions, no surveys required, and flexible closing.',
    'cities'        => [
        ['name' => 'Cookeville', 'slug' => 'cookeville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Cookeville or near Tennessee Tech in Putnam County?', 'a' => 'Yes. We purchase homes throughout Putnam County including Cookeville, Baxter, Algood, and Monterey. Properties near Tennessee Tech, student housing, and family homes are all welcome.'],
        ['q' => 'Can I sell a property in Putnam County that was damaged by severe weather?', 'a' => 'Putnam County has experienced severe tornado and storm events. We buy weather-damaged homes as-is with no repairs needed. We can close quickly so you can move forward.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
