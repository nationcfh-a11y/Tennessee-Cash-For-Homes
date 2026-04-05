<?php
/**
 * Template Name: County - Grainger County
 *
 * WordPress setup:
 *   Slug:     grainger-county  (under county-pages/ parent)
 *   Template: County - Grainger County
 */

$county = [
    'slug'          => 'grainger-county',
    'name'          => 'Grainger County',
    'county_id'     => 'grainger',
    'h1'            => 'Sell Your House Fast For Cash in Grainger County TN',
    'meta_title'    => 'We Buy Houses in Grainger County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Grainger County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$235,000',
    'homes_sold'    => '18',
    'avg_days'      => '92',
    'desc1'         => 'Grainger County is tucked between the Clinch Mountains and the shores of Cherokee Lake in East Tennessee, offering the kind of rural beauty and low-key living that has drawn homesteaders, retirees, and lake enthusiasts for generations. Rutledge, the county seat, sits in the Richland Valley at the base of Clinch Mountain with its classic southern-style homes on large tree-shaded lots. Cherokee Lake drives much of the area\'s real estate activity, with gated communities like Bayside and Shiloh Springs attracting buyers who want waterfront or seasonal lake views. The county is also famous for its Grainger County tomatoes, a summertime staple at markets across East Tennessee, and low property taxes keep living costs well below the Knoxville metro average.',
    'desc2'         => 'The Grainger County real estate market can be a mixed bag for sellers. Lake properties and homes in established communities like Bean Station tend to attract interest, but the broader market is small, with only a handful of sales closing each month and homes averaging over 90 days on market. Older homes, properties with well water or septic systems, and houses that need cosmetic or structural work can be especially difficult to sell through a traditional listing. If you want to sell your house in Grainger County without waiting months for a buyer or investing in costly repairs, cash home buyers in Grainger County like us provide a direct path to closing with no agent commissions, no appraisals, and no surprises.',
    'desc3'         => 'Whether it is a lakefront cabin on Cherokee, a farmhouse near Washburn, or a home in Rutledge you inherited and do not plan to keep, Tennessee Cash For Homes buys houses throughout all of Grainger County in any condition. Your property does not need to be updated or move-in ready. We handle the details and close when you are ready.',
    'land_para'     => 'Grainger County offers lakefront land on Cherokee Lake and affordable rural acreage with mountain views. Tennessee Cash For Homes buys Grainger County land quickly with no commissions and flexible closing.',
    'cities'        => [
        ['name' => 'Rutledge', 'slug' => 'rutledge', 'has_page' => false],
        ['name' => 'Bean Station', 'slug' => 'bean-station', 'has_page' => false],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy properties near Cherokee Lake in Grainger County?', 'a' => 'Yes. Grainger County borders Cherokee Lake and we buy homes and lake properties throughout the county including Rutledge, Bean Station, and Washburn.'],
        ['q' => 'Can I sell a property in Grainger County that has title issues?', 'a' => 'We buy properties in Grainger County even when there are title complications. Our team works with title companies to resolve issues as part of the closing process.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
