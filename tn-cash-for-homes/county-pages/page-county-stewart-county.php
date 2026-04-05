<?php
/**
 * Template Name: County - Stewart County
 *
 * WordPress setup:
 *   Slug:     stewart-county  (under county-pages/ parent)
 *   Template: County - Stewart County
 */

$county = [
    'slug'          => 'stewart-county',
    'name'          => 'Stewart County',
    'county_id'     => 'stewart',
    'h1'            => 'Sell Your House Fast For Cash in Stewart County TN',
    'meta_title'    => 'We Buy Houses in Stewart County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Stewart County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$210,000',
    'homes_sold'    => '12',
    'avg_days'      => '95',
    'desc1'         => 'Stewart County occupies a unique place in Tennessee history and geography. Dover, the county seat, was once the second-largest steamboat port on the Cumberland River and the site of Fort Donelson - where the first major Union victory of the Civil War changed the course of the conflict. Today, the county draws a different kind of visitor: anglers and boaters on Lake Barkley, hikers exploring the Cross Creek National Wildlife Refuge, and history buffs touring the Fort Donelson National Battlefield. Communities like Indian Mound and Big Rock add to the county\'s rural character, and the recent rollout of fiber-optic internet through Cumberland Connect has made Stewart County increasingly attractive to remote workers looking for affordable, scenic living.',
    'desc2'         => 'The flip side of Stewart County\'s peaceful setting is a real estate market with a small buyer pool. Homes average close to 95 days on market, and properties priced outside the $200,000 to $300,000 sweet spot can sit even longer. Many homes here are older, seasonal, or on lake lots that carry flood zone complications - all factors that make traditional financed sales difficult. If you want to sell your house in Stewart County without months of waiting and uncertainty, cash home buyers in Stewart County like Tennessee Cash For Homes offer a direct solution - no repairs, no agent commissions, and no deals contingent on a buyer\'s loan approval.',
    'desc3'         => 'Whether you own a lakefront cabin on Lake Barkley, a historic home in Dover, a hunting property near Indian Mound, or a house anywhere else in Stewart County, we buy in any condition and any situation. Get in touch for a fair, no-obligation cash offer and close on whatever timeline works for you.',
    'land_para'     => 'Stewart County offers exceptional waterfront and rural land along the Cumberland River and Lake Barkley. Tennessee Cash For Homes buys Stewart County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Dover', 'slug' => 'dover', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties near Land Between the Lakes in Stewart County?', 'a' => 'Yes. Stewart County borders the Land Between the Lakes National Recreation Area and we buy homes, cabins, and properties throughout the county including Dover and Indian Mound.'],
        ['q' => 'Can I sell a seasonal property or hunting cabin in Stewart County?', 'a' => 'We buy seasonal homes, hunting cabins, and recreational properties in Stewart County. Whether used part-time or fully vacant, we will make you a cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
