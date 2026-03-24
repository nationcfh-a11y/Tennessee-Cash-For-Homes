<?php
/**
 * Template Name: Location - Jackson
 *
 * SEO — enter in Yoast / RankMath:
 *   Meta Title:       We Buy Houses in Jackson | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Jackson for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.
 */
get_header();

$city = [
    'slug'          => 'jackson',
    'name'          => 'Jackson',
    'image_file'    => 'Jackson.webp',
    'h1'            => 'Sell Your House For Cash In Jackson',
    'meta_title'    => 'We Buy Houses in Jackson | Get a Fast Cash Offer Today',
    'meta_desc'     => 'We buy houses in Jackson for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.',
    'median_price'  => '$215,000',
    'homes_sold'    => '110',
    'avg_days'      => '60',
    'desc1'         => 'Jackson, a regional hub for West Tennessee, is a great place for homeowners looking to sell their Jackson home fast for cash. Tennessee Cash For Homes offers competitive cash offers that make selling your home in Jackson straightforward and stress-free. We buy homes in any condition, from outdated properties to modern homes, and our process ensures you get a fair and fast offer without the complications of the traditional real estate market.',
    'desc2'         => 'Jackson, a hub of West Tennessee, combines urban amenities with a suburban feel. If you are looking to sell your Jackson home fast, Tennessee Cash For Homes offers a quick and efficient selling process. We provide fair cash offers that reflect the market value of your property, with no repairs needed and no agent fees. Our team is dedicated to providing you with the best possible service, ensuring a seamless and stress-free transaction.',
    'land_para'     => 'Jackson serves as a major commercial and residential hub for West Tennessee, making land ownership increasingly valuable across the city and surrounding counties. Whether you own residential lots, farmland, or commercial acreage, there are buyers in the market. However, land listings can sit for months without the right exposure or buyer. Tennessee Cash For Homes makes selling land in Jackson simple — we pay cash, move fast, and handle all the paperwork so you can close on your schedule.',
];

include( get_template_directory() . '/location-template.php' );

get_footer();
