<?php
/**
 * Template Name: County - Loudon County
 *
 * WordPress setup:
 *   Slug:     loudon-county  (under county-pages/ parent)
 *   Template: County - Loudon County
 */

$county = [
    'slug'          => 'loudon-county',
    'name'          => 'Loudon County',
    'county_id'     => 'loudon',
    'h1'            => 'Sell Your House Fast For Cash in Loudon County TN',
    'meta_title'    => 'We Buy Houses in Loudon County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Loudon County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$345,000',
    'homes_sold'    => '52',
    'avg_days'      => '74',
    'desc1'         => 'Loudon County is one of East Tennessee\'s fastest-growing areas, powered by its strategic position between Knoxville and the Tennessee River lakes. Lenoir City has emerged as a major commercial hub known as the "Lakeway to the Smokies," drawing new development with strong traffic counts and excellent highway access. Over sixty manufacturing plants call Loudon County home, and the active-adult community of Tellico Village on Tellico Lake has become one of the most recognized retirement destinations in the Southeast. Whether it is a lakefront home on Fort Loudoun Lake, a newer subdivision in Lenoir City, or a property in the town of Loudon itself, Loudon County home values have seen consistent appreciation as steady population growth and expanding development reshape the area.',
    'desc2'         => 'In a Loudon County real estate market where median prices have climbed over 13 percent year-over-year in areas like Lenoir City, you might assume every home sells quickly. But the reality is more nuanced. Rising inventory means buyers have more choices and more negotiating power, and homes that need updates or repairs often get passed over in favor of newer construction. Sellers in Tellico Village dealing with estate situations or health-related downsizing face the added pressure of HOA fees and maintenance costs that pile up every month a home sits unsold. Cash home buyers in Loudon County like Tennessee Cash For Homes cut through all of that - no staging, no open houses, no waiting for a buyer\'s mortgage approval. We make a fair offer and close on your schedule.',
    'desc3'         => 'Whatever has brought you to this point - whether you are a retiree looking to downsize from Tellico Village, handling a family estate in Greenback, managing a rental property in Lenoir City that has run its course, or dealing with any other life change - we buy houses throughout all of Loudon County in any condition. Tennessee Cash For Homes is here to give you a straightforward cash offer with no obligation and no hassle.',
    'land_para'     => 'Loudon County offers desirable lakefront land on Tellico Lake and Fort Loudoun Lake along with growing residential development areas. Tennessee Cash For Homes buys Loudon County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Loudon', 'slug' => 'loudon', 'has_page' => false],
        ['name' => 'Lenoir City', 'slug' => 'lenoir-city', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes near Tellico Lake or Fort Loudoun Lake in Loudon County?', 'a' => 'Yes. Loudon County has extensive lakefront along Tellico Lake and Fort Loudoun Lake. We buy lake homes, retirement properties, and all residential properties in Loudon, Lenoir City, and Greenback.'],
        ['q' => 'Can I sell a retirement home in Tellico Village in Loudon County?', 'a' => 'We buy homes in Tellico Village and other Loudon County communities. Whether you are downsizing, relocating, or handling an estate, we make the process simple and fast.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
