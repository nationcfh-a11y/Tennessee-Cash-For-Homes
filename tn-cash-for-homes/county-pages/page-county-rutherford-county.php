<?php
/**
 * Template Name: County - Rutherford County
 *
 * WordPress setup:
 *   Slug:     rutherford-county  (under county-pages/ parent)
 *   Template: County - Rutherford County
 */

$county = [
    'slug'          => 'rutherford-county',
    'name'          => 'Rutherford County',
    'county_id'     => 'rutherford',
    'h1'            => 'Sell Your House Fast For Cash in Rutherford County',
    'meta_title'    => 'We Buy Houses in Rutherford County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Rutherford County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$418,450',
    'homes_sold'    => '142',
    'avg_days'      => '65',
    'desc1'         => 'Rutherford County is Tennessee\'s fastest-growing county by population, and it is easy to see why. Murfreesboro - now one of the state\'s largest cities - anchors a corridor of development along I-24 that includes Smyrna\'s Nissan assembly plant, La Vergne\'s expanding logistics parks, and the 22,000-student campus of Middle Tennessee State University. Neighborhoods like Blackman, Salem, and the historic Bottoms district each have their own character, and new subdivisions seem to break ground every month. Rutherford County home values have risen steadily as buyers priced out of Franklin and Brentwood look southeast for more affordable options without sacrificing proximity to Nashville.',
    'desc2'         => 'All that growth makes the Rutherford County real estate market competitive, but it also creates headaches for sellers who cannot - or do not want to - go through a traditional listing. Homes that need cosmetic updates or major repairs can sit on the market for weeks while buyers chase newer construction. Agent commissions on a median-priced Murfreesboro home can top $25,000, and appraisal gaps are common when financed offers fall short. If you need to sell your house in Rutherford County without the stress of showings, inspections, and uncertain timelines, cash home buyers in Rutherford County like Tennessee Cash For Homes offer a straightforward alternative.',
    'desc3'         => 'Whether you own a 1980s ranch in Smyrna, a student rental near MTSU, a home in a newer La Vergne subdivision, or a property anywhere else in Rutherford County, we buy houses in any condition and any situation. Reach out today for a fair, no-obligation cash offer and choose your own closing date.',
    'land_para'     => 'Rutherford County has seen explosive growth in housing and commercial development. As the county expands outward landowners are finding strong opportunities to sell. Tennessee Cash For Homes helps Rutherford County landowners sell their lots and acreage quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Murfreesboro', 'slug' => 'murfreesboro', 'has_page' => true],
        ['name' => 'Smyrna',       'slug' => 'smyrna',       'has_page' => true],
        ['name' => 'La Vergne',    'slug' => 'la-vergne',    'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'How does Murfreesboro\'s fast growth in Rutherford County affect your offers?', 'a' => 'Rutherford County is Tennessee\'s fastest-growing county and Murfreesboro is now one of the state\'s largest cities. Our cash offers reflect this strong market demand. You get a competitive price without the lengthy listing process.'],
        ['q' => 'Do you buy homes near MTSU or in new Murfreesboro developments?', 'a' => 'Yes. We buy homes throughout Rutherford County including near Middle Tennessee State University, in Smyrna, La Vergne, Eagleville, and all new and established neighborhoods.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
