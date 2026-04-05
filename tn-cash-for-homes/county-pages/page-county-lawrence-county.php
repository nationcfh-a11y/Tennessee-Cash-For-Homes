<?php
/**
 * Template Name: County - Lawrence County
 *
 * WordPress setup:
 *   Slug:     lawrence-county  (under county-pages/ parent)
 *   Template: County - Lawrence County
 */

$county = [
    'slug'          => 'lawrence-county',
    'name'          => 'Lawrence County',
    'county_id'     => 'lawrence',
    'h1'            => 'Sell Your House Fast For Cash in Lawrence County TN',
    'meta_title'    => 'We Buy Houses in Lawrence County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Lawrence County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '35',
    'avg_days'      => '85',
    'desc1'         => 'Lawrence County carries a history as rich as any place in Tennessee. David Crockett himself settled along Shoal Creek in 1817, and the 1,100-acre state park bearing his name still draws visitors to the spot where he ran his grist mill and distillery. Today, Lawrenceburg\'s economy is driven by roughly 62 manufacturing firms - including Plasman, Modine Manufacturing, and AOC Metal Works - that provide around 2,200 jobs, while agriculture remains the leading industry with over $65 million in annual production. North of town near Ethridge, one of the largest Old Order Amish communities in the Southeast adds a distinctive cultural layer, with approximately 300 families farming the countryside and selling handmade goods.',
    'desc2'         => 'The Lawrence County real estate market offers genuine affordability, with median home values around $180,000 and a cost of living well below the national average. But affordability does not always mean easy selling. Homes here range from older ranch-style houses on small lots to properties with significant acreage, and many need updates that conventional buyers expect before closing. Listing with an agent means paying commissions, waiting through inspections, and hoping a buyer\'s financing comes through - a process that can drag on for months in a market this size. Cash home buyers in Lawrence County like Tennessee Cash For Homes remove every one of those obstacles. We buy your house as-is, with no agent fees and no repair demands, so you can sell your house in Lawrence County on your own terms.',
    'desc3'         => 'Whatever has brought you to this decision - whether you are managing a loved one\'s estate, facing mortgage difficulties, relocating for work, or simply ready to move on from a property that has become a burden - we buy houses throughout all of Lawrence County in any condition. From the neighborhoods around the Lawrenceburg square to the farmland near Ethridge and every community in between, Tennessee Cash For Homes is here with a fair cash offer and a flexible closing date.',
    'land_para'     => 'Lawrence County offers rural farmland, wooded acreage, and residential lots at competitive prices. Tennessee Cash For Homes buys Lawrence County land quickly with no commissions, no surveys required, and a flexible closing timeline.',
    'cities'        => [
        ['name' => 'Lawrenceburg', 'slug' => 'lawrenceburg', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Lawrenceburg in Lawrence County?', 'a' => 'Yes. Lawrenceburg is the county seat and we actively buy homes throughout Lawrenceburg and all of Lawrence County. We are familiar with the local market and provide competitive cash offers.'],
        ['q' => 'Can I sell a property in Lawrence County if I am behind on my mortgage?', 'a' => 'We work with homeowners in Lawrence County who are behind on their mortgage or facing foreclosure. We can often close fast enough to help you avoid foreclosure and protect your credit.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
