<?php
/**
 * Template Name: Location - Lebanon
 *
 * SEO — enter in Yoast / RankMath:
 *   Meta Title:       We Buy Houses in Lebanon | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Lebanon for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.
 */
get_header();

$city = [
    'slug'          => 'lebanon',
    'name'          => 'Lebanon',
    'image_file'    => 'Lebanon.webp',
    'h1'            => 'Sell Your House For Cash In Lebanon',
    'meta_title'    => 'We Buy Houses in Lebanon | Get a Fast Cash Offer Today',
    'meta_desc'     => 'We buy houses in Lebanon for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.',
    'median_price'  => '$389,900',
    'homes_sold'    => '102',
    'avg_days'      => '51',
    'desc1'         => 'Lebanon is known for its small-town feel and proximity to Nashville, making it a desirable location for home sellers. If you\'re looking to sell your house for cash in Lebanon, Tennessee Cash For Homes provides an easy and efficient process. We buy homes in Lebanon in any condition, which means you won\'t need to spend money on repairs or renovations. Our team offers fair cash offers and a streamlined process to ensure you can sell your Lebanon home quickly and without stress.',
    'desc2'         => 'In Lebanon, where community and convenience meet, Tennessee Cash For Homes helps homeowners sell their properties swiftly and without hassle. Whether you are looking to sell quickly due to financial reasons, relocation, or personal circumstances, we have the expertise and resources to help. We provide fair cash offers that take into account the condition and market value of your home, ensuring that you get the best possible deal. Our team handles all the details, from offer to closing, so you can focus on what matters most.',
    'land_para'     => 'Lebanon\'s location along I-40 and its expanding suburban communities make it a hotspot for residential and commercial growth. With new developments constantly rising, landowners in Lebanon have strong selling opportunities — but navigating the land market alone can be slow and complicated. Tennessee Cash For Homes offers a simple, fast solution for selling land in Lebanon for cash, bypassing agents, commissions, and months of waiting.',
];

include( get_template_directory() . '/location-template.php' );

get_footer();
