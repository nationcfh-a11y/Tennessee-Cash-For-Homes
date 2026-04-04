<?php
/**
 * Template Name: County — Henry County
 *
 * WordPress setup:
 *   Slug:     henry-county  (under county-pages/ parent)
 *   Template: County — Henry County
 */

$county = [
    'slug'          => 'henry-county',
    'name'          => 'Henry County',
    'county_id'     => 'henry',
    'h1'            => 'Sell Your House Fast For Cash in Henry County TN',
    'meta_title'    => 'We Buy Houses in Henry County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Henry County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$195,000',
    'homes_sold'    => '28',
    'avg_days'      => '92',
    'desc1'         => 'Henry County is a beautiful West Tennessee county home to Paris and the shores of Kentucky Lake, one of the largest man made lakes in the eastern United States. The county is a popular destination for fishing, boating, and lakeside living. Tennessee Cash For Homes buys houses across all of Henry County fast and for cash.',
    'desc2'         => 'Whether you are downsizing, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
    'land_para'     => 'Henry County offers sought after lakefront land on Kentucky Lake along with affordable farmland and rural acreage. Tennessee Cash For Homes buys Henry County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Paris', 'slug' => 'paris', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes or lake properties near Paris Landing in Henry County?', 'a' => 'Yes. Henry County is home to Kentucky Lake and Paris Landing State Park. We buy lakefront homes, cabins, and all residential properties throughout Henry County including Paris.'],
        ['q' => 'Can I sell a property in Henry County if it has a lien on it?', 'a' => 'We buy properties in Henry County with liens, judgments, or other encumbrances. Our team works with the title company to resolve these issues at closing.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
