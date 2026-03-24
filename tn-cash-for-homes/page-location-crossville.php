<?php
/**
 * Template Name: Location - Crossville
 *
 * SEO — enter in Yoast / RankMath:
 *   Meta Title:       We Buy Houses in Crossville | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Crossville for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.
 */
get_header();

$city = [
    'slug'          => 'crossville',
    'name'          => 'Crossville',
    'image_file'    => 'Crossville.webp',
    'h1'            => 'Sell Your House For Cash In Crossville',
    'meta_title'    => 'We Buy Houses in Crossville | Get a Fast Cash Offer Today',
    'meta_desc'     => 'We buy houses in Crossville for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.',
    'median_price'  => '$299,000',
    'homes_sold'    => '73',
    'avg_days'      => '77',
    'desc1'         => 'Crossville, with its outdoor activities and peaceful lifestyle, offers a unique real estate market. If you\'re ready to sell your house in Crossville for cash, Tennessee Cash For Homes is here to help. We offer fair cash offers that reflect the true value of your property. Our process eliminates the need for a real estate agent, which means no commissions or fees. We buy homes in any condition in Crossville, making it easy for homeowners to sell quickly and without the stress of the traditional market.',
    'desc2'         => 'Known as the Golf Capital of Tennessee, Crossville offers residents a serene lifestyle. If you need to sell your home quickly, Tennessee Cash For Homes makes it easy with a fast, fair cash offer. We understand the unique challenges that come with selling a home in smaller markets, and we\'re equipped to handle them efficiently. Our team is dedicated to providing you with the best possible service, ensuring you get a fair deal and a quick closing.',
    'land_para'     => 'Crossville\'s location on the Cumberland Plateau and its reputation as the "Golf Capital of Tennessee" make it attractive to retirees and outdoor enthusiasts alike. Landowners in Crossville can benefit from steady interest in recreational parcels, wooded acreage, and residential lots — but finding the right buyer at the right price can take time. Tennessee Cash For Homes offers a direct path to sell your Crossville land fast for cash, with no listing fees, no waiting periods, and no agent commissions.',
];

include( get_template_directory() . '/location-template.php' );

get_footer();
