<?php
/**
 * Template Name: County — Greene County
 *
 * WordPress setup:
 *   Slug:     greene-county  (under county-pages/ parent)
 *   Template: County — Greene County
 */

$county = [
    'slug'          => 'greene-county',
    'name'          => 'Greene County',
    'county_id'     => 'greene',
    'h1'            => 'Sell Your House Fast For Cash in Greene County TN',
    'meta_title'    => 'We Buy Houses in Greene County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Greene County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$245,000',
    'homes_sold'    => '52',
    'avg_days'      => '82',
    'desc1'         => 'Greene County is one of East Tennessee\'s oldest and most economically diverse communities, anchored by Greeneville, where President Andrew Johnson once kept his tailor shop on Main Street. Today the county blends that deep history with a surprisingly robust manufacturing sector. John Deere builds its D100 lawn tractors here, ARTAZN in Tusculum is the sole supplier of zinc penny blanks for the U.S. Mint, and American Greetings operates a major facility employing over 500 workers. Ballad Health, Forward Air Corporation, and Takahata Precision round out the top employers. Living costs run about 13 percent below the national average, and Greene County home values reflect that affordability, with median prices roughly half the national figure. New residential development is underway, including a 384-unit subdivision, and a new Tennessee College of Applied Technology campus in Tusculum is expected to open in 2026.',
    'desc2'         => 'Greene County\'s affordable housing stock is a draw for buyers, but sellers face a market where older homes, particularly those needing cosmetic or structural updates, can sit for weeks without serious offers. Properties outside Greeneville proper, including homes near Mosheim, Baileyton, and the rural stretches toward the Nolichucky River, often need the right buyer willing to take on deferred maintenance. Agent commissions on a lower-priced home can feel disproportionately steep, and repair estimates can quickly exceed what makes financial sense. Cash home buyers in Greene County like Tennessee Cash For Homes offer a practical alternative when you need to sell your house in Greene County on a predictable timeline without gambling on the traditional market.',
    'desc3'         => 'Whether you own a historic property in downtown Greeneville, a former tobacco farm with acreage, or a home near Tusculum that needs more work than you can manage, Tennessee Cash For Homes buys houses throughout all of Greene County in any condition. We are here to give you a fair offer and a clear path forward, regardless of your circumstances.',
    'land_para'     => 'Greene County offers a mix of fertile valley farmland and scenic mountain tracts in the foothills of the Appalachians. Tennessee Cash For Homes buys Greene County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Greeneville', 'slug' => 'greeneville', 'has_page' => false],
        ['name' => 'Mosheim', 'slug' => 'mosheim', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Greeneville or Tusculum in Greene County?', 'a' => 'Yes. We purchase homes throughout Greene County including Greeneville, Tusculum, Mosheim, and all surrounding areas. Whether historic downtown or rural, we buy in any condition.'],
        ['q' => 'Can I sell a tobacco farm or agricultural property in Greene County?', 'a' => 'Greene County has a rich agricultural history and we buy all types of properties including former farms, homes with acreage, and agricultural land. We handle the details.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
