<?php
/*
Template Name: Location - Nashville
*/
/*
 * SEO — enter in Yoast / RankMath:
 *   Meta Title:       We Buy Houses in Nashville | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Nashville for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.
 */
get_header();

$city = [
    'slug'          => 'nashville',
    'name'          => 'Nashville',
    'image_file'    => 'Nashville.webp',
    'h1'            => 'Sell Your House For Cash In Nashville',
    'meta_title'    => 'We Buy Houses in Nashville | Get a Fast Cash Offer Today',
    'meta_desc'     => 'We buy houses in Nashville for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.',
    'median_price'  => '$480,000',
    'homes_sold'    => '655',
    'avg_days'      => '52',
    'desc1'         => 'Nashville, known as "Music City," is a hotspot for those looking to sell their home quickly in a booming real estate market. If you need to sell your house in Nashville due to relocation, foreclosure, or simply wanting a fast, hassle-free sale, Tennessee Cash For Homes is your answer. We buy houses in Nashville in any condition, offering cash deals that skip the traditional market, saving you time and money on repairs and agent fees.',
    'desc2'         => 'In Nashville\'s dynamic market, our local experts understand the challenges you face when selling your home. Whether you\'re in the heart of downtown or the surrounding areas, Tennessee Cash For Homes delivers a seamless home-selling experience. We provide fair cash offers that reflect the market value of your Nashville property. Our team handles all aspects of the sale, from making the offer to managing closing, so you can focus on your next steps without worry.',
    'land_para'     => 'Nashville\'s booming economy and population growth have made land ownership more valuable than ever. However, zoning changes, development pressures, and property taxes are causing many owners to cash out now. Whether you own a lot in a developing neighborhood or acreage on the outskirts of the city, Tennessee Cash For Homes offers fast cash purchases for land in Nashville — no agents, no delays, and no uncertainty.',
];

include( get_template_directory() . '/location-template.php' );

get_footer();
