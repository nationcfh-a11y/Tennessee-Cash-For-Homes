<?php
/**
 * Template Name: County - Roane County
 *
 * WordPress setup:
 *   Slug:     roane-county  (under county-pages/ parent)
 *   Template: County - Roane County
 */

$county = [
    'slug'          => 'roane-county',
    'name'          => 'Roane County',
    'county_id'     => 'roane',
    'h1'            => 'Sell Your House Fast For Cash in Roane County TN',
    'meta_title'    => 'We Buy Houses in Roane County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Roane County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$225,000',
    'homes_sold'    => '42',
    'avg_days'      => '82',
    'desc1'         => 'Roane County is one of East Tennessee\'s fastest-growing areas, benefiting from its position in the Knoxville-Oak Ridge Innovation Valley corridor. Kingston, the county seat, overlooks Watts Bar Lake and has seen significant residential development at communities like Whitestone and Ladd Landing. Harriman is known for its Cornstalk Heights Historic District, home to over 100 Victorian-era houses, while Rockwood and Oliver Springs each contribute their own small-town identity to the county. With TVA\'s Kingston plant, proximity to Oak Ridge National Laboratory, and a cost of living 14 percent below the national average, Roane County attracts everyone from young professionals to semi-retired buyers looking for lakefront access without Knoxville prices.',
    'desc2'         => 'The growth happening in Roane County has pushed home values upward, with the county remaining a seller\'s market overall. But not every property benefits equally from that trend. Older homes in Harriman or Rockwood that need updating, properties with deferred maintenance, or houses outside the lakefront corridors can still be difficult to sell through traditional listings. If you want to sell your house in Roane County without investing in renovations or waiting for the right buyer, a cash sale is the most direct path. We purchase homes as-is throughout the county, handle all closing costs, and can close in as little as two weeks.',
    'desc3'         => 'No matter what your situation involves, whether you are downsizing from a lakefront home on Watts Bar, managing a property in Kingston from out of state, or dealing with a house in Rockwood that needs more work than you want to take on, we buy houses throughout all of Roane County in any condition. Tennessee Cash For Homes provides fair cash offers and a straightforward process that lets you move forward on your own terms.',
    'land_para'     => 'Roane County offers lakefront land on Watts Bar Lake, riverfront properties, and affordable residential lots. Tennessee Cash For Homes buys Roane County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Kingston', 'slug' => 'kingston', 'has_page' => false],
        ['name' => 'Harriman', 'slug' => 'harriman', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in Harriman, Kingston, or Rockwood in Roane County?', 'a' => 'Yes. We purchase homes throughout Roane County including Harriman, Kingston, Rockwood, and Oliver Springs. We buy in all conditions and close quickly.'],
        ['q' => 'Can I sell a property in Roane County near Watts Bar Lake?', 'a' => 'We buy properties near Watts Bar Lake and throughout Roane County. Whether your home is lakefront, in a subdivision, or on rural land, we will make you a fair cash offer.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
