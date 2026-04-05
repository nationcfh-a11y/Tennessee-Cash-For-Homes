<?php
/**
 * Template Name: County — Lincoln County
 *
 * WordPress setup:
 *   Slug:     lincoln-county  (under county-pages/ parent)
 *   Template: County — Lincoln County
 */

$county = [
    'slug'          => 'lincoln-county',
    'name'          => 'Lincoln County',
    'county_id'     => 'lincoln',
    'h1'            => 'Sell Your House Fast For Cash in Lincoln County TN',
    'meta_title'    => 'We Buy Houses in Lincoln County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Lincoln County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$275,000',
    'homes_sold'    => '28',
    'avg_days'      => '84',
    'desc1'         => 'Lincoln County stretches across the rolling hills of Southern Middle Tennessee, where Fayetteville\'s historic courthouse square serves as the center of a community that has been thriving since 1809. Manufacturing is the backbone of the local economy -- Amana runs a major heating and cooling systems plant here as the county\'s largest employer, Frito-Lay operates a snack foods facility, and dozens of smaller manufacturers produce everything from automotive parts to fiberglass swimming pools. With a cost of living nearly 15 percent below the national average and communities like Petersburg, Flintville, Kelso, and Mulberry dotting the countryside, Lincoln County attracts families and retirees looking for affordable Southern living with room to breathe.',
    'desc2'         => 'While Lincoln County home values remain accessible compared to much of Tennessee, selling a property here through traditional channels is not always straightforward. About a third of the local workforce is in manufacturing and warehousing, and economic shifts at any single employer can quickly change how many qualified buyers are in the market. Many homes in Fayetteville and the surrounding towns sit on large rural lots that complicate appraisals and narrow the pool of lender-approved buyers. Cash home buyers in Lincoln County like Tennessee Cash For Homes simplify the entire process -- no appraisal contingencies, no lender delays, no agent commissions that shrink your proceeds. You get a fair offer based on real Lincoln County real estate market conditions, and you close when you are ready.',
    'desc3'         => 'No matter what your situation looks like -- a family home in Fayetteville you have outgrown, an inherited property in Petersburg, a vacant house that needs more repair than you can afford, or any other reason -- we buy houses throughout all of Lincoln County in any condition. From the town square to the farthest corners of the county, Tennessee Cash For Homes is here to make the process simple with a fair cash offer and a closing date on your terms.',
    'land_para'     => 'Lincoln County offers beautiful rolling farmland and rural residential tracts in the heart of Southern Middle Tennessee. Tennessee Cash For Homes buys Lincoln County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Fayetteville', 'slug' => 'fayetteville', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Fayetteville or other towns in Lincoln County?', 'a' => 'Yes. We buy homes throughout Lincoln County including Fayetteville, Petersburg, and Flintville. All property types and conditions are welcome.'],
        ['q' => 'Can I sell a home in Lincoln County that is on a large rural lot?', 'a' => 'Absolutely. Many Lincoln County properties sit on several acres. We buy homes on large lots and do not require you to subdivide or survey the property before selling.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
