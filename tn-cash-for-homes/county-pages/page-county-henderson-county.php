<?php
/**
 * Template Name: County - Henderson County
 *
 * WordPress setup:
 *   Slug:     henderson-county  (under county-pages/ parent)
 *   Template: County - Henderson County
 */

$county = [
    'slug'          => 'henderson-county',
    'name'          => 'Henderson County',
    'county_id'     => 'henderson',
    'h1'            => 'Sell Your House Fast For Cash in Henderson County TN',
    'meta_title'    => 'We Buy Houses in Henderson County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Henderson County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '22',
    'avg_days'      => '90',
    'desc1'         => 'Henderson County sits at the crossroads of West Tennessee, with its county seat of Lexington positioned about 30 minutes east of Jackson along the I-40 corridor between Nashville and Memphis. The county is drained by the Beech, White Oak, and Forked Deer rivers and is home to Natchez Trace State Park and seven recreational lakes that draw outdoor enthusiasts throughout the year. Civil War history runs deep here, with the preserved battlefields at Parker\'s Crossroads and Lexington marking significant engagements from 1862. Major employers like Johnson Controls and Leroy-Somer provide a manufacturing employment base of over 1,800 jobs, giving Lexington an economic stability that many rural Tennessee counties lack.',
    'desc2'         => 'Henderson County home values have been climbing, with median prices rising meaningfully in recent years, but the market still moves slowly for many sellers. Older homes in Lexington, rural properties near Sardis or Scotts Hill, and houses that need repairs can linger on the market for months while buyers wait for lower prices or better condition. If you want to sell your house in Henderson County without the hassle of staging, showings, and repair negotiations, cash home buyers in Henderson County like Tennessee Cash For Homes buy directly from you. No agent commissions, no repair requirements, and you choose the closing date.',
    'desc3'         => 'From bungalows in downtown Lexington to homes on acreage near Parker\'s Crossroads, farmhouses along the Beech River, or properties anywhere in between, we buy houses throughout all of Henderson County in any condition. Whatever is motivating your sale, whether it is a life change, an inherited property, tax concerns, or a home that needs more work than you can manage, we will treat you fairly and move at whatever pace works best for you.',
    'land_para'     => 'Henderson County offers affordable farmland, wooded tracts, and lakefront properties near Natchez Trace State Park. Tennessee Cash For Homes buys Henderson County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Lexington', 'slug' => 'lexington', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Lexington or other towns in Henderson County?', 'a' => 'Yes. We buy homes throughout Henderson County including Lexington, Sardis, Scotts Hill, and Parker\'s Crossroads. All property types and conditions are welcome.'],
        ['q' => 'Can I sell a home in Henderson County without a real estate agent?', 'a' => 'That is exactly what we offer. When you sell to Tennessee Cash For Homes in Henderson County, there is no agent involved. You deal directly with us, saving you thousands in commissions.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
