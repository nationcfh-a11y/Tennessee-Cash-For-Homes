<?php
/**
 * Template Name: County - Williamson County
 *
 * WordPress setup:
 *   Slug:     williamson-county  (under county-pages/ parent)
 *   Template: County - Williamson County
 */

$county = [
    'slug'          => 'williamson-county',
    'name'          => 'Williamson County',
    'county_id'     => 'williamson',
    'h1'            => 'Sell Your House Fast For Cash in Williamson County',
    'meta_title'    => 'We Buy Houses in Williamson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Williamson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$819,000',
    'homes_sold'    => '94',
    'avg_days'      => '75',
    'desc1'         => 'Williamson County is Tennessee\'s premier residential market and one of the most sought-after counties in the entire Southeast. Franklin\'s walkable historic downtown, Brentwood\'s estate neighborhoods, and Spring Hill\'s rapidly expanding master-planned communities along U.S. 31 and Duplex Road have all contributed to a county where the median sale price now approaches $975,000. Top-tier Williamson County Schools remain a primary draw, and with 63 percent of Nashville-area professionals now working from home at least part-time, the county has become even more attractive to families who prioritize school quality and community character over a short commute. First-time buyers and young families are increasingly flocking to Spring Hill for relative affordability, while Franklin and Brentwood command premium prices that reflect their established appeal.',
    'desc2'         => 'In a market this strong, you might assume every home sells quickly - but that is not always the case. Williamson County home values are high, which means the buyer pool narrows, especially for properties above the median. Homes in Brentwood with average listing prices exceeding $2.4 million require buyers with significant cash or jumbo financing. Even in Franklin, the shift toward more long-term homeowners over speculative investors has made the market more deliberate. If you need to sell your house in Williamson County and want to skip months of staging, showings, and price negotiations, cash home buyers in Williamson County like us can make a competitive offer that reflects the premium Williamson County real estate market - and close on your schedule without agent commissions or contingencies.',
    'desc3'         => 'Whatever your situation - a luxury home you have inherited, an estate property that needs updating, a relocation timeline that does not allow for a lengthy listing, or a financial change that requires fast liquidity - Tennessee Cash For Homes buys houses throughout all of Williamson County in any condition. From historic homes along Franklin\'s Main Street to new construction in Spring Hill and established estates in Brentwood, we are ready to make you an offer.',
    'land_para'     => 'Williamson County is one of Tennessee\'s most desirable areas for land development. As growth continues to stretch outward from Nashville landowners have a strong opportunity to sell. Tennessee Cash For Homes buys Williamson County land quickly with no commissions or hidden fees.',
    'cities'        => [
        ['name' => 'Franklin',    'slug' => 'franklin',    'has_page' => true],
        ['name' => 'Spring Hill', 'slug' => 'spring-hill', 'has_page' => true],
        ['name' => 'Brentwood',   'slug' => 'brentwood',   'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is now a good time to sell my Williamson County home given the market growth?', 'a' => 'Williamson County is one of Tennessee\'s most expensive and fastest-growing counties. Property values in Franklin, Brentwood, and Spring Hill remain strong. Selling to us for cash means you can take advantage of current values without months of showings and negotiations.'],
        ['q' => 'Do you buy luxury or high-value homes in Williamson County?', 'a' => 'Yes. We buy homes at all price points in Williamson County, including higher-value properties in Franklin and Brentwood. Our cash offers are competitive and reflect the premium market in this area.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
