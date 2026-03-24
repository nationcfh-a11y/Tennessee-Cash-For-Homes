<?php
/**
 * Template Name: Location - Columbia
 *
 * SEO — enter in Yoast / RankMath:
 *   Meta Title:       We Buy Houses in Columbia | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Columbia for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.
 */
get_header();

$city = [
    'slug'          => 'columbia',
    'name'          => 'Columbia',
    'image_file'    => 'Columbia.webp',
    'h1'            => 'Sell Your House For Cash In Columbia',
    'meta_title'    => 'We Buy Houses in Columbia | Get a Fast Cash Offer Today',
    'meta_desc'     => 'We buy houses in Columbia for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.',
    'median_price'  => '$365,000',
    'homes_sold'    => '75',
    'avg_days'      => '56',
    'desc1'         => 'Columbia, with its charming downtown and rich history, is a great place for those looking to sell their Columbia home for cash. Tennessee Cash For Homes offers homeowners fast cash offers that make selling stress-free and straightforward. We buy homes in any condition, which means you can skip costly repairs and sell your home exactly as-is. Our process is simple and transparent, with no hidden fees or complicated contracts. If you need to sell your Columbia home quickly, we\'re ready to help.',
    'desc2'         => 'Columbia\'s historic charm and vibrant community make it a desirable place for homeowners. At Tennessee Cash For Homes, we understand the nuances of the Columbia market and provide tailored solutions to homeowners looking to sell fast. We offer cash offers that are fair and reflective of the property\'s worth, so you can sell your home without the usual hassle. Whether you\'re dealing with an estate sale, financial difficulties, or just want to move on quickly, our team is here to assist you every step of the way.',
    'land_para'     => 'Columbia\'s growing popularity among homebuyers and businesses has made land ownership in the area more valuable than ever. As Nashville\'s influence stretches southward, residential and agricultural land in Columbia is attracting new development interest. Landowners looking to cash out quickly often find that traditional listing methods move slowly in rural areas. Tennessee Cash For Homes buys land in Columbia for cash, providing a fast and straightforward sale without commissions, realtor fees, or lengthy delays.',
];

include( get_template_directory() . '/location-template.php' );

get_footer();
