<?php
/**
 * Template Name: Location - Chattanooga
 *
 * SEO — enter in Yoast / RankMath:
 *   Meta Title:       We Buy Houses in Chattanooga | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Chattanooga for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.
 */
get_header();

$city = [
    'slug'          => 'chattanooga',
    'name'          => 'Chattanooga',
    'image_file'    => 'Chattanooga.webp',
    'h1'            => 'Sell Your House For Cash In Chattanooga',
    'meta_title'    => 'We Buy Houses in Chattanooga | Get a Fast Cash Offer Today',
    'meta_desc'     => 'We buy houses in Chattanooga for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.',
    'median_price'  => '$330,000',
    'homes_sold'    => '240',
    'avg_days'      => '66',
    'desc1'         => 'Chattanooga is known for its outdoor beauty and fast-growing urban core. Whether you\'re downsizing, relocating, or facing financial difficulties, Tennessee Cash For Homes is ready to make a fair offer on your Chattanooga property. We buy homes in any condition, from fixer-uppers to move-in ready homes. Our streamlined process means you won\'t have to deal with listing your property, hosting open houses, or waiting months for a buyer. We\'re committed to making your home-selling experience in Chattanooga as smooth and quick as possible.',
    'desc2'         => 'Chattanooga\'s growth and desirability mean opportunities for homeowners to sell — but sometimes you need to sell fast. Tennessee Cash For Homes is here to ensure you can sell your home quickly in Chattanooga without sacrificing value. We offer fair cash prices based on the current market and the condition of your property. Our team handles everything from the initial offer to closing, ensuring a stress-free and efficient process for you. Trust us to provide you with the best possible service, making your home sale in Chattanooga seamless and swift.',
    'land_para'     => 'Chattanooga\'s booming tech sector and outdoor lifestyle are attracting more growth and development, making local land increasingly valuable. From vacant residential lots to larger tracts near the mountains, buyers and developers are actively seeking land in and around the city. But selling land through traditional channels can be slow and complex. Tennessee Cash For Homes offers a faster option — we buy land in Chattanooga for cash, with no commissions, no waiting, and no hassle.',
];

include( get_template_directory() . '/location-template.php' );

get_footer();
