<?php
/**
 * Template Name: Location - Spring Hill
 *
 * SEO — enter in Yoast / RankMath:
 *   Meta Title:       We Buy Houses in Spring Hill | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Spring Hill for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.
 */
get_header();

$city = [
    'slug'          => 'spring-hill',
    'name'          => 'Spring Hill',
    'image_file'    => 'Spring Hill.webp',
    'h1'            => 'Sell Your House For Cash In Spring Hill',
    'meta_title'    => 'We Buy Houses in Spring Hill | Get a Fast Cash Offer Today',
    'meta_desc'     => 'We buy houses in Spring Hill for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today.',
    'median_price'  => '$450,000',
    'homes_sold'    => '138',
    'avg_days'      => '56',
    'desc1'         => 'Spring Hill\'s proximity to Nashville and family-friendly atmosphere makes it an attractive market for real estate. If you\'re asking, "How do I sell my Spring Hill home fast for cash?" Tennessee Cash For Homes has the answer. We offer competitive cash offers that provide a fast alternative to the traditional home-selling process. Our team is experienced in handling a wide range of properties and is committed to providing you with the best possible service, ensuring a quick and stress-free transaction.',
    'desc2'         => 'Spring Hill\'s thriving community is an excellent place for families, but when it\'s time to sell quickly, Tennessee Cash For Homes is your go-to resource. We make it easy to sell your Spring Hill home fast by providing fair cash offers that reflect the market value of your property. Our process is simple and transparent, with no hidden fees or complications. Whether you\'re relocating, downsizing, or dealing with a difficult property situation, we\'re here to help you sell your home quickly and efficiently.',
    'land_para'     => 'Spring Hill\'s rapid growth has turned once-rural farmland into thriving residential and commercial developments. Landowners in Spring Hill are in an excellent position to sell, as builders and investors continue searching for developable land in the area. However, listing land can be slow without the right buyer. Tennessee Cash For Homes offers a fast, cash-based solution to sell your Spring Hill land — skip the agents, avoid delays, and close on a timeline that works for you.',
];

include( get_template_directory() . '/location-template.php' );

get_footer();
