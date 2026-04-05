<?php
/**
 * Template Name: County - Clay County
 *
 * WordPress setup:
 *   Slug:     clay-county  (under county-pages/ parent)
 *   Template: County - Clay County
 */

$county = [
    'slug'          => 'clay-county',
    'name'          => 'Clay County',
    'county_id'     => 'clay',
    'h1'            => 'Sell Your House Fast For Cash in Clay County TN',
    'meta_title'    => 'We Buy Houses in Clay County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Clay County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$135,000',
    'homes_sold'    => '8',
    'avg_days'      => '115',
    'desc1'         => 'Clay County is where the Upper Cumberland region meets some of Tennessee\'s most pristine waterways. The small town of Celina sits just five miles from Dale Hollow Lake - home of the world-record smallmouth bass and consistently ranked among the cleanest lakes in the Southeast. The Obey and Cumberland Rivers converge here, making the area a destination for fishing, boating, and outdoor recreation that drives much of the local economy. With fiber-optic internet reaching parts of the county, Celina has quietly attracted remote workers looking for an affordable lakeside lifestyle. Despite this interest, Clay County home values remain well below state averages, and the overall pace of life stays distinctly rural.',
    'desc2'         => 'Selling a house in Clay County through traditional channels is one of the slowest processes in the state. With only around 8 homes selling per month and properties averaging 115 days on market, the buyer pool is extremely limited. Lakefront properties may attract seasonal interest, but in-town homes and rural residences in Celina often sit for months without a showing. Low transaction volume also makes accurate appraisals difficult, which can derail financed deals. As cash home buyers in Clay County, we do not depend on appraisals or bank approvals - we make direct offers and close when you are ready.',
    'desc3'         => 'Whether you own a cabin near Dale Hollow Lake, a home in Celina, or a rural property anywhere in the county, Tennessee Cash For Homes buys houses throughout all of Clay County in any condition. No matter your situation, we provide a fair cash offer and handle everything from paperwork to closing.',
    'land_para'     => 'Clay County offers affordable lakefront and rural land along Dale Hollow Lake, one of Tennessee\'s most pristine bodies of water. Tennessee Cash For Homes buys Clay County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Celina', 'slug' => 'celina', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is it difficult to sell a home in a rural county like Clay County?', 'a' => 'Selling on the open market in Clay County can be slow due to low population density and limited buyer demand. We eliminate that problem by buying your home directly for cash. No waiting, no showings, no uncertainty.'],
        ['q' => 'Do you buy properties near Dale Hollow Lake in Clay County?', 'a' => 'Yes. Dale Hollow Lake attracts property owners throughout Clay County. We buy lakefront properties, cabins, and any residential property near the lake regardless of condition.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
