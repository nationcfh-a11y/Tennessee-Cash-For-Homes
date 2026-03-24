<?php
/**
 * Template Name: Location - Knoxville
 *
 * SEO — enter in Yoast / RankMath:
 *   Meta Title:       We Buy Houses in Knoxville | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Knoxville for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.
 */
get_header();

$city = [
    'slug'          => 'knoxville',
    'name'          => 'Knoxville',
    'image_file'    => 'Knoxville.webp',
    'h1'            => 'Sell Your House For Cash In Knoxville',
    'meta_title'    => 'We Buy Houses in Knoxville | Get a Fast Cash Offer Today',
    'meta_desc'     => 'We buy houses in Knoxville for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.',
    'median_price'  => '$300,000',
    'homes_sold'    => '344',
    'avg_days'      => '53',
    'desc1'         => 'Nestled in the foothills of the Smoky Mountains, Knoxville is a beautiful city with a growing real estate market. Whether you\'re dealing with foreclosure, downsizing, or relocating, Tennessee Cash For Homes offers cash offers for homes in Knoxville that make the selling process easy. We buy homes in any condition, from older properties needing extensive repairs to newer homes in great shape. Our streamlined process allows you to sell quickly without the hassle of listing with an agent.',
    'desc2'         => 'Knoxville homeowners looking to sell quickly can rely on Tennessee Cash For Homes for a stress-free selling experience. We understand the local market and are prepared to make you an offer that allows you to sell your Knoxville home fast. Our team handles all aspects of the transaction, from the initial offer to closing, ensuring a smooth and efficient process. With no agent fees or commissions, you keep more of your money while still selling your home in a timely manner.',
    'land_para'     => 'Knoxville offers a unique blend of urban amenities and outdoor adventure, making land in and around the city highly desirable. Whether your property is near downtown, close to the Smoky Mountains, or in a growing suburban area, there\'s demand for land in Knoxville. However, selling land without the right connections can be a slow and frustrating process. Tennessee Cash For Homes provides a direct path to sell your Knoxville land for cash — fast, fair, and without agent fees or complicated paperwork.',
];

include( get_template_directory() . '/location-template.php' );

get_footer();
