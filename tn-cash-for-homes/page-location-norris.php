<?php
/**
 * Template Name: Location - Norris
 *
 * SEO - enter in Yoast / RankMath:
 *   Meta Title:       We Buy Houses in Norris TN | Get a Fast Cash Offer Today
 *   Meta Description: We buy houses in Norris for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today, with offers built around Norris\'s historic TVA-planned community market.
 */

$city = [
    'slug'          => 'norris',
    'county'        => 'Anderson',
    'name'          => 'Norris',
    'image_file'    => 'Norris.webp',
    'h1'            => 'Sell Your House For Cash In Norris',
    'meta_title'    => 'We Buy Houses in Norris TN | Get a Fast Cash Offer Today',
    'meta_desc'     => 'We buy houses in Norris for cash. No repairs, no agents, no fees. Just a fast, hassle-free sale. Get a cash offer on your home today, with offers built around Norris\'s historic TVA-planned community market.',
    'median_price'  => '$295,000',
    'homes_sold'    => '14',
    'avg_days'      => '65',
    'desc1'         => 'Norris is one of Tennessee\'s most distinctive small towns - a fully planned community designed by the Tennessee Valley Authority in the 1930s as housing for workers building Norris Dam, the agency\'s first major project. The town of about 1,500 still carries that original character: tree-lined streets, original TVA-era cottages, walking paths connecting to the Norris Watershed and the Museum of Appalachia, and a town center that has stayed remarkably preserved. Sitting just 25 minutes north of Knoxville along I-75, Norris draws Oak Ridge National Laboratory employees, Y-12 workers, and Knoxville-area professionals who want a historic, walkable address with quick metro access. Norris home values track noticeably higher than the broader Anderson County average, and well-preserved TVA cottages can move quickly when they hit the market.',
    'desc2'         => 'Even with that demand, the Norris real estate market presents real challenges for some sellers. Original TVA-era cottages often need historically appropriate updates - knob-and-tube wiring, old plumbing, lead paint considerations - that financed buyers and conventional inspectors flag immediately. Inherited homes from longtime Norris families, properties with deferred maintenance, and houses on the wooded outer streets can take longer than the in-town average. Cash home buyers in Norris like Tennessee Cash For Homes give those owners a faster path. We base offers on real Anderson County and Norris-specific comps, buy as-is regardless of historical-update needs, and close on the date you choose.',
    'desc3'         => 'Whether your home is an original TVA cottage in the Norris Town Center, on the wooded streets near the Norris Watershed, or near the Museum of Appalachia, Tennessee Cash For Homes buys throughout all of Norris in any condition. Inherited TVA-era homes and properties with significant deferred maintenance are all ones we purchase.',
    'land_para'     => 'Norris and the surrounding Anderson County area offer rare wooded residential lots and small parcels in a historic planned community with mature tree canopy and Norris Lake access. Tennessee Cash For Homes buys Norris land for cash with no commissions and a flexible closing timeline.',
    'neighborhoods'  => ['Norris Town Center', 'TVA Cottage District', 'Norris Watershed Edge', 'East Norris', 'Highway 441 Side'],
    'faq_extra'    => [
        ['q' => 'Do you buy original TVA-era cottages in Norris?', 'a' => 'Yes. The original 1930s TVA cottages in Norris are a defining part of the town\'s character. We buy them as-is, including homes that still have original wiring, plumbing, or other historic systems. Updating those is our problem, not yours.'],
        ['q' => 'Can I sell a Norris home if I have inherited it from a longtime resident?', 'a' => 'Absolutely. Many Norris homes pass to heirs who live elsewhere and have no plans to relocate. We work with executors, handle the title coordination, and can run the transaction entirely from your end.'],
    ],

];

include( get_template_directory() . '/location-template.php' );
