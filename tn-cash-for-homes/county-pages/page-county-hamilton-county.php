<?php
/**
 * Template Name: County — Hamilton County
 *
 * WordPress setup:
 *   Slug:     hamilton-county  (under county-pages/ parent)
 *   Template: County — Hamilton County
 */

$county = [
    'slug'          => 'hamilton-county',
    'name'          => 'Hamilton County',
    'county_id'     => 'hamilton',
    'h1'            => 'Sell Your House Fast For Cash in Hamilton County',
    'meta_title'    => 'We Buy Houses in Hamilton County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Hamilton County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$345,000',
    'homes_sold'    => '298',
    'avg_days'      => '68',
    'desc1'         => 'Hamilton County is the engine of southeastern Tennessee, powered by Chattanooga\'s remarkable transformation from a struggling industrial city into one of the South\'s most sought-after places to live. Home values across greater Chattanooga have risen 73 percent since 2019, and the county\'s population is projected to approach half a million residents over the coming decades, generating demand for tens of thousands of new housing units. Neighborhoods tell distinct stories: North Shore homes move in as little as 12 days thanks to walkability and restaurant culture, Signal Mountain draws families with top-rated schools and mountain living, and communities like Ooltewah, East Brainerd, and Hixson offer newer construction at more accessible price points. Manufacturing, healthcare, and a tech sector that employs more computer and math professionals per capita than 95 percent of U.S. cities all contribute to a diversified economy.',
    'desc2'         => 'In a market this competitive, you might expect every home to sell instantly, but that is not the reality for every Hamilton County seller. Properties that need cosmetic work, older homes in Red Bank or St. Elmo that have not been updated, and houses with foundation, roof, or code issues can still languish while move-in-ready listings fly off the shelf. Sellers dealing with divorce, probate, tenant problems, or relocation deadlines often cannot afford to wait for the right traditional buyer. Cash home buyers in Hamilton County like Tennessee Cash For Homes step in where the conventional process falls short. We buy as-is, skip the appraisal and inspection contingencies, and let you choose the closing date when you sell your house in Hamilton County.',
    'desc3'         => 'From a bungalow in St. Elmo to a split-level in Soddy-Daisy to a rental property in East Brainerd you are ready to offload, Tennessee Cash For Homes buys houses throughout all of Hamilton County in any condition. Chattanooga\'s growth does not have to mean a complicated sale. We are here to give you a fair offer and a straightforward closing, no matter what your situation looks like.',
    'land_para'     => 'Hamilton County\'s growing economy and desirable location have made land increasingly valuable. Tennessee Cash For Homes buys Hamilton County land quickly with no commissions, no closing costs, and a flexible timeline.',
    'cities'        => [
        ['name' => 'Chattanooga', 'slug' => 'chattanooga', 'has_page' => true],
        ['name' => 'Signal Mountain', 'slug' => 'signal-mountain', 'has_page' => false],
        ['name' => 'Red Bank', 'slug' => 'red-bank', 'has_page' => false],
        ['name' => 'Soddy-Daisy', 'slug' => 'soddy-daisy', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'How does Chattanooga\'s growing market affect cash offers in Hamilton County?', 'a' => 'Chattanooga and Hamilton County are experiencing significant growth and development. Our cash offers reflect current market conditions in the area. Selling to us lets you skip the competitive listing process while still receiving a fair price.'],
        ['q' => 'Do you buy homes on Lookout Mountain or Signal Mountain in Hamilton County?', 'a' => 'Yes. We buy homes in all Hamilton County neighborhoods including Lookout Mountain, Signal Mountain, Red Bank, East Brainerd, and downtown Chattanooga. Location and condition do not matter.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
