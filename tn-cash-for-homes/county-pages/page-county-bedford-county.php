<?php
/**
 * Template Name: County — Bedford County
 *
 * WordPress setup:
 *   Slug:     bedford-county  (under county-pages/ parent)
 *   Template: County — Bedford County
 */

$county = [
    'slug'          => 'bedford-county',
    'name'          => 'Bedford County',
    'county_id'     => 'bedford',
    'h1'            => 'Sell Your House Fast For Cash in Bedford County TN',
    'meta_title'    => 'We Buy Houses in Bedford County TN | Fast Cash Offers',
    'meta_desc'     => 'We buy houses in Bedford County Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.',
    'median_price'  => '$315,990',
    'homes_sold'    => '27',
    'avg_days'      => '88',
    'desc1'         => 'Bedford County is the Walking Horse Capital of the World, and that equestrian heritage shapes everything from the sprawling breeding farms along Highway 231 to the annual Tennessee Walking Horse National Celebration that draws visitors from across the country each summer. Shelbyville, the county seat, blends historic charm with steady growth fueled by Nashville\'s expanding influence just 50 miles to the northwest. Communities like Unionville and Wartrace are seeing renewed interest as buyers look for affordable alternatives to Murfreesboro and the Nashville suburbs. Bedford County home values have appreciated significantly over the past decade, with Shelbyville alone seeing over 130 percent growth, yet the median price still sits well below neighboring Rutherford and Williamson counties.',
    'desc2'         => 'That growth is good news for Bedford County homeowners, but selling through the traditional market here is not always straightforward. Many properties in the county are older homes in Shelbyville\'s established neighborhoods or rural houses on acreage that require specialized buyers, and the Bedford County real estate market can move slowly for listings that need updates or sit outside of town. Cash home buyers in Bedford County like us eliminate the hurdles — no waiting months for a buyer who can finance a horse property, no negotiating repairs on an aging farmhouse, and no agent commissions eating into your proceeds. We understand the local market and make fair offers that reflect what your property is actually worth.',
    'desc3'         => 'Whatever your reason for selling — whether you have inherited a family property in Wartrace, need to downsize from a large home in Shelbyville, or own a rural lot you no longer use — Tennessee Cash For Homes buys houses throughout all of Bedford County in any condition. We are here to make the process simple so you can move on with confidence.',
    'land_para'     => 'Bedford County offers beautiful equestrian properties, farmland, and rural lots at competitive prices. As Middle Tennessee continues to grow Bedford County land is becoming increasingly valuable. Tennessee Cash For Homes buys Bedford County land quickly with no commissions and no hidden fees.',
    'cities'        => [
        ['name' => 'Shelbyville', 'slug' => 'shelbyville', 'has_page' => true],
    ],
    'faq_extra'    => [
        ['q' => 'Do you buy homes in the Shelbyville area of Bedford County?', 'a' => 'Absolutely. Shelbyville is the county seat and we actively purchase homes throughout Shelbyville and all of Bedford County. Whether your home is in town or on a rural lot, we will make you a fair cash offer.'],
        ['q' => 'Can I sell a horse farm or property with acreage in Bedford County?', 'a' => 'Yes. Bedford County is known as the Walking Horse Capital of the World, and we buy all types of properties including farms, homes with acreage, and equestrian properties. We handle the complexity so you do not have to.'],
    ],

];

add_action( 'wp_head', function() use ( $county ) {
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\n";
} );

include get_template_directory() . '/county-template.php';
