<?php
/**
 * Template Name: County — Montgomery County
 *
 * WordPress setup:
 *   Slug:     montgomery-county  (under county-pages/ parent)
 *   Template: County — Montgomery County
 */

$county = [
    'slug'          => 'montgomery-county',
    'name'          => 'Montgomery County',
    'county_id'     => 'montgomery',
    'h1'            => 'Sell Your House Fast For Cash in Montgomery County',
    'meta_title'    => 'We Buy Houses in Montgomery County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Montgomery County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$309,900',
    'homes_sold'    => '256',
    'avg_days'      => '83',
    'desc1'         => 'Montgomery County is home to roughly 250,000 residents, making Clarksville one of Tennessee\'s largest and fastest-growing cities. Fort Campbell -- with about 30,000 active duty soldiers plus their families -- drives a significant share of the local economy, but the growth story goes well beyond the military. Nashville spillover has turned Clarksville into a magnet for families and young professionals priced out of Davidson County, drawn by homes that offer more square footage at a fraction of Nashville\'s cost. Neighborhoods like Sango, St. Bethlehem, and the Exit 11 corridor have seen rapid development, while established areas near Austin Peay State University and downtown Clarksville maintain their own distinct character.',
    'desc2'         => 'The Montgomery County real estate market has been hot, with median prices rising 13% and multiple-offer situations becoming common on well-priced listings. But that intensity does not help every seller equally. Military families on PCS orders often cannot wait months for the right buyer. Homeowners with properties that need updating in older Clarksville neighborhoods near Kraft Street or the inner loop may struggle against shiny new construction. If you need to sell your house in Montgomery County quickly and without investing in renovations, cash home buyers in Montgomery County like Tennessee Cash For Homes provide a reliable alternative -- a fair offer, no agent fees, and a closing date matched to your timeline.',
    'desc3'         => 'We understand the unique pressures Montgomery County homeowners face, from military relocations and deployment timelines to managing rental properties in a fast-changing market. Whether your home is a brick ranch near Fort Campbell, a townhouse in the Exit 4 area, or a fixer-upper off Tiny Town Road, we buy houses throughout all of Montgomery County in any condition. Our offers are fair, fast, and come with absolutely no obligation.',
    'land_para'     => 'Montgomery County\'s booming economy and proximity to Nashville have made land increasingly valuable. Tennessee Cash For Homes buys Montgomery County land quickly with no commissions, no surveys required, and a flexible closing timeline.',
    'cities'        => [
        ['name' => 'Clarksville', 'slug' => 'clarksville', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes near Fort Campbell in Montgomery County?', 'a' => 'Yes. Montgomery County is home to Fort Campbell and we regularly work with military families who need to sell quickly. We buy homes in Clarksville and throughout the county and can close fast to match your PCS timeline.'],
        ['q' => 'Is Clarksville\'s rapid growth in Montgomery County good for sellers?', 'a' => 'Clarksville is one of Tennessee\'s fastest-growing cities, which means strong property values. Our cash offers reflect Montgomery County\'s growth. You can take advantage of the market without the delays of a traditional sale.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
