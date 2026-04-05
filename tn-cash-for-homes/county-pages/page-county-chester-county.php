<?php
/**
 * Template Name: County - Chester County
 *
 * WordPress setup:
 *   Slug:     chester-county  (under county-pages/ parent)
 *   Template: County - Chester County
 */

$county = [
    'slug'          => 'chester-county',
    'name'          => 'Chester County',
    'county_id'     => 'chester',
    'h1'            => 'Sell Your House Fast For Cash in Chester County TN',
    'meta_title'    => 'We Buy Houses in Chester County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Chester County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '14',
    'avg_days'      => '96',
    'desc1'         => 'Chester County is a tight-knit West Tennessee community where Freed-Hardeman University shapes much of daily life in Henderson, the county seat. With over 18,000 residents and just 18 miles separating Henderson from Jackson, the county balances true rural character with convenient access to regional shopping, healthcare, and employment. Chickasaw State Park draws visitors to its rolling woodlands and golf course, while the annual Chester County Barbeque Festival brings the whole community together each September. Chester County home values remain among the most affordable in the state, attracting families and investors looking for value in a stable small-town setting.',
    'desc2'         => 'Selling a house in Chester County through traditional channels can be a patience game. With only a handful of homes changing hands each month and properties averaging 96 days on market, the limited buyer pool means many listings sit without serious offers. Homes on rural lots can be especially difficult to sell when buyers need financing - appraisals in low-volume markets often come in below asking price, killing deals at the last minute. As cash home buyers in Chester County, we eliminate those obstacles entirely. No appraisals, no lender delays, and no repair demands.',
    'desc3'         => 'Whether you own a property near Freed-Hardeman\'s campus, a farmhouse on the outskirts of Henderson, or a home anywhere else in the county, Tennessee Cash For Homes buys houses throughout all of Chester County in any condition. We are here to give you a straightforward path to selling, no matter your situation.',
    'land_para'     => 'Chester County offers affordable farmland and rural residential lots in a quiet West Tennessee setting. Tennessee Cash For Homes buys Chester County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Henderson', 'slug' => 'henderson', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties in Henderson or other parts of Chester County?', 'a' => 'Yes. We purchase homes throughout Chester County including Henderson and all surrounding areas. Whether your home is in town or on a rural lot, we buy properties in any condition.'],
        ['q' => 'Can I sell a house in Chester County if I live out of state?', 'a' => 'Absolutely. Many Chester County property owners live out of state and need a hassle-free sale. We handle all the details and can close remotely so you never need to travel to Tennessee.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
