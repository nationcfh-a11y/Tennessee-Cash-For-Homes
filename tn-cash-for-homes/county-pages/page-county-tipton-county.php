<?php
/**
 * Template Name: County - Tipton County
 *
 * WordPress setup:
 *   Slug:     tipton-county  (under county-pages/ parent)
 *   Template: County - Tipton County
 */

$county = [
    'slug'          => 'tipton-county',
    'name'          => 'Tipton County',
    'county_id'     => 'tipton',
    'h1'            => 'Sell Your House Fast For Cash in Tipton County TN',
    'meta_title'    => 'We Buy Houses in Tipton County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Tipton County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '48',
    'avg_days'      => '80',
    'desc1'         => 'Tipton County has earned its reputation as the \'sweet spot in West Tennessee\' for good reason. Anchored by the historic county seat of Covington and the fast-growing communities of Munford, Atoka, and Brighton, this county blends small-town charm with easy access to the Memphis metro. Major employers like Unilever, Mueller Industries, and CSC Sugar have invested heavily here, drawn by the county\'s skilled workforce and strong transportation corridors. Atoka has been named one of Tennessee\'s safest cities and most affordable places to live, and Munford continues to attract young families looking for quality schools and tight-knit community events.',
    'desc2'         => 'Even with Tipton County home values holding steady and new development pushing into areas around Atoka and Munford, selling through traditional channels can still be a slow process. If you need to sell your house in Tipton County quickly, waiting months for a buyer while covering property taxes, insurance, and maintenance on a Covington bungalow or a larger lot in Brighton is not always realistic. Cash home buyers in Tipton County like us eliminate that uncertainty - we make a fair offer based on current Tipton County real estate market conditions and close when you are ready, with no repairs or agent commissions.',
    'desc3'         => 'No matter what your situation looks like - whether you are navigating an inherited property, dealing with a home that needs work, going through a divorce, or simply want a fresh start - Tennessee Cash For Homes buys houses throughout all of Tipton County in any condition. From older homes along the Covington square to newer builds in Munford and everything in between, we are here to help.',
    'land_para'     => 'Tipton County\'s suburban growth from Memphis has made land increasingly valuable for residential development. Tennessee Cash For Homes buys Tipton County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Covington', 'slug' => 'covington', 'has_page' => false],
        ['name' => 'Munford', 'slug' => 'munford', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Covington, Munford, or Atoka in Tipton County?', 'a' => 'Yes. We buy homes throughout Tipton County including Covington, Munford, Atoka, Brighton, and Mason. We are active in the Memphis suburban market.'],
        ['q' => 'Is Tipton County growing enough to support strong home values?', 'a' => 'Tipton County has benefited from Memphis suburban growth, particularly in Atoka and Munford. Our cash offers reflect the area\'s strong and increasing demand.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
