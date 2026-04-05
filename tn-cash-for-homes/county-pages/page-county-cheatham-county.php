<?php
/**
 * Template Name: County — Cheatham County
 *
 * WordPress setup:
 *   Slug:     cheatham-county  (under county-pages/ parent)
 *   Template: County — Cheatham County
 */

$county = [
    'slug'          => 'cheatham-county',
    'name'          => 'Cheatham County',
    'county_id'     => 'cheatham',
    'h1'            => 'Sell Your House Fast For Cash in Cheatham County',
    'meta_title'    => 'We Buy Houses in Cheatham County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Cheatham County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$325,000',
    'homes_sold'    => '32',
    'avg_days'      => '78',
    'desc1'         => 'Cheatham County offers something rare in the Nashville metro -- genuine rural character with a manageable commute to the city. Ashland City sits along Highway 12 with a straight shot to downtown Nashville, while Pleasant View connects easily via Interstate 24 toward Clarksville. With a population over 40,000, the county has grown steadily as buyers priced out of Davidson and Williamson counties discover its rolling hills, scenic Cumberland River frontage, and neighborhoods in Kingston Springs and Pegram that still feel like small-town Tennessee. Cheatham County home values have risen alongside Nashville\'s expansion, yet the area remains significantly more affordable than the urban core.',
    'desc2'         => 'For homeowners looking to sell your house in Cheatham County, that Nashville-adjacent demand does not always translate into a quick sale. Properties along the Cumberland River may sit in flood zones that scare off traditional buyers, and rural homes on acreage often struggle to appraise for financed purchases. Homes in Ashland City and Pleasant View typically spend 30 to 45 days on market under ideal conditions, but properties needing repairs or carrying complicated histories can linger much longer. As cash home buyers in Cheatham County, we purchase directly -- no appraisal contingencies, no repair requests, and no waiting on a buyer\'s loan approval.',
    'desc3'         => 'Whatever your circumstances -- an inherited home in Kingston Springs, a flood-affected property along the Cumberland, or a house in Pleasant View you simply need to sell -- Tennessee Cash For Homes buys houses throughout all of Cheatham County in any condition. We work on your timeline and handle every detail from offer to closing.',
    'land_para'     => 'Cheatham County offers peaceful rural living and affordable land options that attract buyers seeking space outside Nashville. Tennessee Cash For Homes buys Cheatham County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Ashland City', 'slug' => 'ashland-city', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Is Cheatham County considered part of the Nashville market for home sales?', 'a' => 'Yes. Cheatham County is part of the greater Nashville metropolitan area, and many residents commute to Nashville. We buy homes throughout Cheatham County including Ashland City and Pleasant View, and our offers reflect the regional market.'],
        ['q' => 'Do you buy homes on flood-prone land in Cheatham County?', 'a' => 'We buy properties in Cheatham County including those in flood zones or that have experienced flooding from the Cumberland River. Flood history does not prevent us from making you an offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
