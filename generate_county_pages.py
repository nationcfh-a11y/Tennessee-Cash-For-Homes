#!/usr/bin/env python3
"""Generate the 70 missing Tennessee county pages for the WordPress theme."""

import os, textwrap

OUTPUT_DIR = "tn-cash-for-homes/county-pages"

# Cities that already have a page-location-*.php file
CITIES_WITH_PAGES = {
    'chattanooga', 'jackson', 'knoxville', 'memphis', 'crossville',
    'antioch', 'chapel-hill', 'clarksville', 'columbia', 'franklin',
    'gallatin', 'hendersonville', 'la-vergne', 'lebanon', 'mcminnville',
    'murfreesboro', 'nashville', 'old-hickory', 'shelbyville', 'smyrna',
    'spring-hill', 'woodbury',
}

# fmt: off
COUNTIES = [
    {
        'name': 'Anderson County', 'county_id': 'anderson',
        'median_price': '$215,000', 'homes_sold': '68', 'avg_days': '78',
        'desc1': 'Anderson County is home to Oak Ridge, the historic Secret City that played a pivotal role in American history. Today the county offers a unique mix of scientific innovation, natural beauty, and affordable living in East Tennessee. Tennessee Cash For Homes buys houses across all of Anderson County fast and for cash in any condition.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial difficulties, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your schedule with a fair cash offer.',
        'land_para': 'Anderson County offers diverse land opportunities from wooded mountain tracts to lakefront properties along Norris Lake and Melton Hill Lake. Tennessee Cash For Homes buys Anderson County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Clinton', 'clinton', False),
            ('Oak Ridge', 'oak-ridge', False),
            ('Norris', 'norris', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Benton County', 'county_id': 'benton',
        'median_price': '$179,000', 'homes_sold': '12', 'avg_days': '105',
        'desc1': 'Benton County is a peaceful rural county in West Tennessee centered around the town of Camden along the Tennessee River. Known for its access to Kentucky Lake and outdoor recreation, the county offers affordable living and small town charm. Tennessee Cash For Homes buys houses across all of Benton County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, relocating, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Benton County offers affordable rural land with excellent access to Kentucky Lake and the Tennessee River. Tennessee Cash For Homes buys Benton County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Camden', 'camden', False),
            ('Big Sandy', 'big-sandy', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Bledsoe County', 'county_id': 'bledsoe',
        'median_price': '$189,000', 'homes_sold': '10', 'avg_days': '108',
        'desc1': 'Bledsoe County is a quiet rural county on the Cumberland Plateau in East Tennessee. Home to Pikeville, the county is known for its natural beauty including Fall Creek Falls State Park and the Sequatchie Valley. Tennessee Cash For Homes buys houses across all of Bledsoe County fast and for cash.',
        'desc2': 'Whether you are facing financial hardship, dealing with an inherited property, or simply want a quick hassle free sale we are here to help with a fair cash offer. No repairs needed and no agent fees.',
        'land_para': 'Bledsoe County offers scenic mountain and valley land at some of the most affordable prices in Tennessee. Tennessee Cash For Homes buys Bledsoe County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Pikeville', 'pikeville', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Blount County', 'county_id': 'blount',
        'median_price': '$365,000', 'homes_sold': '112', 'avg_days': '72',
        'desc1': 'Blount County is one of East Tennessee\'s most desirable counties, home to Maryville and serving as a gateway to the Great Smoky Mountains National Park. The county offers a perfect blend of mountain living, outdoor recreation, and proximity to Knoxville. Tennessee Cash For Homes buys houses across all of Blount County fast and for cash.',
        'desc2': 'Whether you need to sell due to relocation, inheritance, financial hardship, or any other reason we make the process simple and stress free. No repairs, no agent commissions, and we close on your schedule.',
        'land_para': 'Blount County land is highly sought after for its mountain views and proximity to the Smokies. Tennessee Cash For Homes buys Blount County land quickly with no commissions, no surveys required, and flexible closing.',
        'cities': [
            ('Maryville', 'maryville', False),
            ('Alcoa', 'alcoa', False),
            ('Townsend', 'townsend', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Bradley County', 'county_id': 'bradley',
        'median_price': '$295,000', 'homes_sold': '89', 'avg_days': '74',
        'desc1': 'Bradley County is a growing Southeast Tennessee county anchored by Cleveland. With easy access to Chattanooga and the Ocoee River region, the county offers affordable housing and a strong local economy. Tennessee Cash For Homes buys houses across all of Bradley County fast and for cash in any condition.',
        'desc2': 'Whether you are facing foreclosure, dealing with a difficult tenant situation, or simply need to sell fast we are ready to make you a fair cash offer today. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Bradley County offers a mix of residential lots, farmland, and wooded tracts at competitive prices. Tennessee Cash For Homes buys Bradley County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Cleveland', 'cleveland', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Campbell County', 'county_id': 'campbell',
        'median_price': '$155,000', 'homes_sold': '32', 'avg_days': '95',
        'desc1': 'Campbell County is a mountain county in Northeast Tennessee known for Norris Lake, the Cumberland Mountains, and a strong sense of community. Home to Jacksboro and La Follette, the county offers affordable living surrounded by natural beauty. Tennessee Cash For Homes buys houses across all of Campbell County fast and for cash.',
        'desc2': 'Whether you have an inherited property, are behind on payments, or just need to sell quickly we can help. No repairs needed, no agent fees, and we close on your schedule with a fair cash offer.',
        'land_para': 'Campbell County offers stunning mountain and lakefront land along Norris Lake at some of the most affordable prices in East Tennessee. Tennessee Cash For Homes buys Campbell County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Jacksboro', 'jacksboro', False),
            ('La Follette', 'la-follette', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Carroll County', 'county_id': 'carroll',
        'median_price': '$145,000', 'homes_sold': '18', 'avg_days': '102',
        'desc1': 'Carroll County is a rural West Tennessee county with a rich agricultural heritage. Home to Huntingdon and McKenzie, the county offers peaceful country living and affordable real estate. Tennessee Cash For Homes buys houses across all of Carroll County fast and for cash in any condition.',
        'desc2': 'Whether you need to sell due to relocation, financial hardship, or an inherited property we make the process easy. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Carroll County offers productive farmland and rural residential lots at very affordable prices. Tennessee Cash For Homes buys Carroll County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Huntingdon', 'huntingdon', False),
            ('McKenzie', 'mckenzie', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Carter County', 'county_id': 'carter',
        'median_price': '$225,000', 'homes_sold': '42', 'avg_days': '85',
        'desc1': 'Carter County is a scenic mountain county in Northeast Tennessee home to Elizabethton and the Watauga River. With easy access to the Appalachian Trail and Cherokee National Forest, the county offers stunning natural beauty and affordable mountain living. Tennessee Cash For Homes buys houses across all of Carter County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial challenges, or simply want a quick stress free sale we are here to help. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Carter County offers beautiful mountain land with stunning views and access to the Cherokee National Forest. Tennessee Cash For Homes buys Carter County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Elizabethton', 'elizabethton', False),
            ('Watauga', 'watauga', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Chester County', 'county_id': 'chester',
        'median_price': '$195,000', 'homes_sold': '14', 'avg_days': '96',
        'desc1': 'Chester County is a small rural county in West Tennessee centered around Henderson. The county offers quiet country living, affordable real estate, and proximity to Jackson. Tennessee Cash For Homes buys houses across all of Chester County fast and for cash in any condition.',
        'desc2': 'Whether you are dealing with an inherited property, going through a divorce, or need to sell quickly we are ready to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Chester County offers affordable farmland and rural residential lots in a quiet West Tennessee setting. Tennessee Cash For Homes buys Chester County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Henderson', 'henderson', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Claiborne County', 'county_id': 'claiborne',
        'median_price': '$165,000', 'homes_sold': '25', 'avg_days': '99',
        'desc1': 'Claiborne County sits in the far northeast corner of Tennessee near the Cumberland Gap, one of America\'s most historic landmarks. Home to Tazewell and Harrogate, the county offers affordable mountain living with beautiful scenery. Tennessee Cash For Homes buys houses across all of Claiborne County fast and for cash.',
        'desc2': 'Whether you are facing financial difficulties, dealing with an inherited property, or need to relocate quickly we make the selling process simple. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Claiborne County offers affordable mountain land near the Cumberland Gap with wooded tracts and rural acreage. Tennessee Cash For Homes buys Claiborne County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Tazewell', 'tazewell', False),
            ('Harrogate', 'harrogate', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Clay County', 'county_id': 'clay',
        'median_price': '$135,000', 'homes_sold': '8', 'avg_days': '115',
        'desc1': 'Clay County is one of Tennessee\'s smallest and most rural counties, nestled along the Kentucky border in the Upper Cumberland region. Home to Celina on the shores of Dale Hollow Lake, the county is a hidden gem for outdoor enthusiasts. Tennessee Cash For Homes buys houses across all of Clay County fast and for cash.',
        'desc2': 'Whether you have an inherited property, need to relocate, or simply want a quick hassle free sale we are here to help. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Clay County offers affordable lakefront and rural land along Dale Hollow Lake, one of Tennessee\'s most pristine bodies of water. Tennessee Cash For Homes buys Clay County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Celina', 'celina', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Cocke County', 'county_id': 'cocke',
        'median_price': '$210,000', 'homes_sold': '28', 'avg_days': '90',
        'desc1': 'Cocke County is an East Tennessee county at the doorstep of the Great Smoky Mountains. Home to Newport and the French Broad River, the county offers scenic mountain living and a growing outdoor recreation economy. Tennessee Cash For Homes buys houses across all of Cocke County fast and for cash in any condition.',
        'desc2': 'Whether you are facing foreclosure, dealing with a difficult property, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline with a fair cash offer.',
        'land_para': 'Cocke County offers mountain land with river access and Smoky Mountain views at affordable prices. Tennessee Cash For Homes buys Cocke County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Newport', 'newport', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Crockett County', 'county_id': 'crockett',
        'median_price': '$138,000', 'homes_sold': '10', 'avg_days': '104',
        'desc1': 'Crockett County is a quiet agricultural county in West Tennessee named after the legendary Davy Crockett. Home to Alamo, the county offers affordable small town living and rich farmland. Tennessee Cash For Homes buys houses across all of Crockett County fast and for cash.',
        'desc2': 'Whether you need to sell an inherited property, are behind on payments, or want a quick hassle free sale we are here to help. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Crockett County offers productive farmland and affordable rural lots in the heart of West Tennessee. Tennessee Cash For Homes buys Crockett County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Alamo', 'alamo', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Cumberland County', 'county_id': 'cumberland',
        'median_price': '$265,000', 'homes_sold': '72', 'avg_days': '82',
        'desc1': 'Cumberland County sits atop the Cumberland Plateau and is home to Crossville, known as the Golf Capital of Tennessee. The county attracts retirees and outdoor enthusiasts with its mild climate, scenic beauty, and affordable cost of living. Tennessee Cash For Homes buys houses across all of Cumberland County fast and for cash.',
        'desc2': 'Whether you are downsizing, dealing with an inherited property, or need to sell quickly for any reason we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Cumberland County is one of Tennessee\'s largest counties by area with diverse land options from mountain tracts to lakefront lots. Tennessee Cash For Homes buys Cumberland County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Crossville', 'crossville', True),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Decatur County', 'county_id': 'decatur',
        'median_price': '$165,000', 'homes_sold': '11', 'avg_days': '108',
        'desc1': 'Decatur County is a small rural county along the Tennessee River in West Tennessee. Home to Decaturville and Parsons, the county offers peaceful country living and access to excellent fishing and boating. Tennessee Cash For Homes buys houses across all of Decatur County fast and for cash.',
        'desc2': 'Whether you have an inherited property, are facing financial hardship, or simply need to sell fast we are ready to make you a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Decatur County offers affordable rural land along the Tennessee River including riverfront tracts, farmland, and wooded acreage. Tennessee Cash For Homes buys Decatur County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Decaturville', 'decaturville', False),
            ('Parsons', 'parsons', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Dyer County', 'county_id': 'dyer',
        'median_price': '$168,000', 'homes_sold': '35', 'avg_days': '88',
        'desc1': 'Dyer County is a thriving West Tennessee county anchored by Dyersburg. Known for its agricultural roots and growing economy, the county offers affordable living and a strong sense of community. Tennessee Cash For Homes buys houses across all of Dyer County fast and for cash in any condition.',
        'desc2': 'Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are here with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Dyer County offers productive farmland and affordable residential lots in the heart of Northwest Tennessee. Tennessee Cash For Homes buys Dyer County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Dyersburg', 'dyersburg', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Fayette County', 'county_id': 'fayette',
        'median_price': '$325,000', 'homes_sold': '38', 'avg_days': '80',
        'desc1': 'Fayette County is a growing suburban county east of Memphis offering a blend of rural charm and modern conveniences. Home to Somerville and the fast growing community of Oakland, the county has seen significant residential development in recent years. Tennessee Cash For Homes buys houses across all of Fayette County fast and for cash.',
        'desc2': 'Whether you are relocating, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Fayette County\'s proximity to Memphis has made land increasingly valuable as development pushes eastward. Tennessee Cash For Homes buys Fayette County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Somerville', 'somerville', False),
            ('Oakland', 'oakland', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Fentress County', 'county_id': 'fentress',
        'median_price': '$175,000', 'homes_sold': '15', 'avg_days': '100',
        'desc1': 'Fentress County is a scenic Upper Cumberland county home to Jamestown and the headwaters of the Big South Fork. The county is known for its outdoor recreation, natural beauty, and affordable mountain living. Tennessee Cash For Homes buys houses across all of Fentress County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial challenges, or need a quick sale we are here to help. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Fentress County offers affordable mountain land near the Big South Fork National Recreation Area. Tennessee Cash For Homes buys Fentress County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Jamestown', 'jamestown', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Franklin County', 'county_id': 'franklin',
        'median_price': '$265,000', 'homes_sold': '34', 'avg_days': '84',
        'desc1': 'Franklin County is a scenic Southern Middle Tennessee county home to Winchester and the University of the South in nearby Sewanee. Nestled against the Cumberland Plateau, the county offers beautiful landscapes, historic charm, and a welcoming community. Tennessee Cash For Homes buys houses across all of Franklin County fast and for cash.',
        'desc2': 'Whether you need to sell due to relocation, inheritance, or financial reasons we make the process simple and stress free. No repairs, no agent commissions, and we close on your schedule.',
        'land_para': 'Franklin County offers diverse land from valley farmland to mountain tracts near the Cumberland Plateau. Tennessee Cash For Homes buys Franklin County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Winchester', 'winchester', False),
            ('Cowan', 'cowan', False),
            ('Decherd', 'decherd', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Gibson County', 'county_id': 'gibson',
        'median_price': '$155,000', 'homes_sold': '38', 'avg_days': '90',
        'desc1': 'Gibson County is one of West Tennessee\'s largest counties with a strong agricultural economy. Home to Trenton, Humboldt, and Milan, the county offers affordable living and a tight knit community atmosphere. Tennessee Cash For Homes buys houses across all of Gibson County fast and for cash in any condition.',
        'desc2': 'Whether you are facing financial difficulties, dealing with an inherited property, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Gibson County offers some of West Tennessee\'s most productive farmland along with affordable residential lots. Tennessee Cash For Homes buys Gibson County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Trenton', 'trenton', False),
            ('Humboldt', 'humboldt', False),
            ('Milan', 'milan', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Giles County', 'county_id': 'giles',
        'median_price': '$225,000', 'homes_sold': '24', 'avg_days': '88',
        'desc1': 'Giles County is a historic Southern Middle Tennessee county home to Pulaski. Known for its beautiful antebellum architecture and rolling countryside, the county offers affordable living near the Alabama border. Tennessee Cash For Homes buys houses across all of Giles County fast and for cash.',
        'desc2': 'Whether you have an inherited property, are facing foreclosure, or simply need to sell quickly we make the process easy. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Giles County offers beautiful rolling farmland and rural residential tracts in Southern Middle Tennessee. Tennessee Cash For Homes buys Giles County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Pulaski', 'pulaski', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Grainger County', 'county_id': 'grainger',
        'median_price': '$235,000', 'homes_sold': '18', 'avg_days': '92',
        'desc1': 'Grainger County is a rural East Tennessee county known for its tomato farming heritage and beautiful views of Cherokee Lake and the Clinch Mountains. Home to Rutledge, the county offers quiet country living within reach of Knoxville. Tennessee Cash For Homes buys houses across all of Grainger County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, need to relocate, or want a quick hassle free sale we are here to help with a fair cash offer. No repairs needed and no agent fees.',
        'land_para': 'Grainger County offers lakefront land on Cherokee Lake and affordable rural acreage with mountain views. Tennessee Cash For Homes buys Grainger County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Rutledge', 'rutledge', False),
            ('Bean Station', 'bean-station', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Greene County', 'county_id': 'greene',
        'median_price': '$245,000', 'homes_sold': '52', 'avg_days': '82',
        'desc1': 'Greene County is one of East Tennessee\'s oldest and most historic counties, home to Greeneville where President Andrew Johnson lived and worked. The county offers affordable mountain living, rich history, and a strong agricultural tradition. Tennessee Cash For Homes buys houses across all of Greene County fast and for cash.',
        'desc2': 'Whether you are facing financial challenges, dealing with an inherited property, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Greene County offers a mix of fertile valley farmland and scenic mountain tracts in the foothills of the Appalachians. Tennessee Cash For Homes buys Greene County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Greeneville', 'greeneville', False),
            ('Mosheim', 'mosheim', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Grundy County', 'county_id': 'grundy',
        'median_price': '$175,000', 'homes_sold': '12', 'avg_days': '105',
        'desc1': 'Grundy County sits atop the Cumberland Plateau in Southern Tennessee and is home to Tracy City, Monteagle, and Altamont. The county is known for its dramatic gorges, waterfalls, and access to South Cumberland State Park. Tennessee Cash For Homes buys houses across all of Grundy County fast and for cash.',
        'desc2': 'Whether you have an inherited property, are facing financial difficulties, or simply want a quick sale we are here to help. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Grundy County offers unique plateau land with stunning overlooks, wooded tracts, and affordable mountain acreage. Tennessee Cash For Homes buys Grundy County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Altamont', 'altamont', False),
            ('Tracy City', 'tracy-city', False),
            ('Monteagle', 'monteagle', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Hamblen County', 'county_id': 'hamblen',
        'median_price': '$235,000', 'homes_sold': '48', 'avg_days': '79',
        'desc1': 'Hamblen County is an East Tennessee county anchored by Morristown, one of the region\'s key commercial centers. The county offers affordable housing, a growing job market, and easy access to the Smoky Mountains. Tennessee Cash For Homes buys houses across all of Hamblen County fast and for cash.',
        'desc2': 'Whether you are relocating, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your schedule with a fair cash offer.',
        'land_para': 'Hamblen County offers affordable residential and commercial land in a growing East Tennessee market. Tennessee Cash For Homes buys Hamblen County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Morristown', 'morristown', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Hamilton County', 'county_id': 'hamilton',
        'median_price': '$345,000', 'homes_sold': '298', 'avg_days': '68',
        'desc1': 'Hamilton County is home to Chattanooga, one of Tennessee\'s most dynamic and revitalized cities. With a booming tech scene, world class outdoor recreation, and a thriving downtown, the county has become one of the state\'s most desirable places to live. Tennessee Cash For Homes buys houses across all of Hamilton County fast and for cash.',
        'desc2': 'Whether you are in Chattanooga, Signal Mountain, Red Bank, or anywhere else in Hamilton County we are ready to make you a fair cash offer today. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Hamilton County\'s growing economy and desirable location have made land increasingly valuable. Tennessee Cash For Homes buys Hamilton County land quickly with no commissions, no closing costs, and a flexible timeline.',
        'cities': [
            ('Chattanooga', 'chattanooga', True),
            ('Signal Mountain', 'signal-mountain', False),
            ('Red Bank', 'red-bank', False),
            ('Soddy-Daisy', 'soddy-daisy', False),
        ],
        'h1_suffix': '',
    },
    {
        'name': 'Hancock County', 'county_id': 'hancock',
        'median_price': '$110,000', 'homes_sold': '6', 'avg_days': '120',
        'desc1': 'Hancock County is one of Tennessee\'s most remote and rural counties, nestled in the Appalachian Mountains near the Virginia border. Home to Sneedville, the county offers rugged mountain beauty and an extremely affordable cost of living. Tennessee Cash For Homes buys houses across all of Hancock County fast and for cash.',
        'desc2': 'Whether you have an inherited property, need to relocate, or simply want to sell we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Hancock County offers some of the most affordable mountain land in Tennessee with wooded tracts and scenic acreage. Tennessee Cash For Homes buys Hancock County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Sneedville', 'sneedville', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Hardeman County', 'county_id': 'hardeman',
        'median_price': '$145,000', 'homes_sold': '16', 'avg_days': '100',
        'desc1': 'Hardeman County is a rural West Tennessee county home to Bolivar and rich in history. The county offers affordable living, scenic countryside, and a close knit community. Tennessee Cash For Homes buys houses across all of Hardeman County fast and for cash in any condition.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial hardship, or need to sell quickly we make the process easy. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Hardeman County offers affordable farmland, wooded tracts, and rural residential lots in West Tennessee. Tennessee Cash For Homes buys Hardeman County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Bolivar', 'bolivar', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Hardin County', 'county_id': 'hardin',
        'median_price': '$185,000', 'homes_sold': '22', 'avg_days': '94',
        'desc1': 'Hardin County is a historic West Tennessee county home to Savannah and the Shiloh National Military Park. Located along the Tennessee River, the county offers scenic waterfront living and a deep connection to American history. Tennessee Cash For Homes buys houses across all of Hardin County fast and for cash.',
        'desc2': 'Whether you need to sell due to relocation, inheritance, or financial reasons we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Hardin County offers beautiful riverfront land along the Tennessee River, Pickwick Lake access, and affordable rural acreage. Tennessee Cash For Homes buys Hardin County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Savannah', 'savannah', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Hawkins County', 'county_id': 'hawkins',
        'median_price': '$225,000', 'homes_sold': '42', 'avg_days': '86',
        'desc1': 'Hawkins County is a scenic Northeast Tennessee county home to Rogersville, one of the oldest towns in the state. The county offers mountain views, affordable housing, and access to Cherokee Lake. Tennessee Cash For Homes buys houses across all of Hawkins County fast and for cash.',
        'desc2': 'Whether you are facing financial difficulties, dealing with an inherited property, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Hawkins County offers lakefront land on Cherokee Lake, rolling farmland, and affordable mountain tracts. Tennessee Cash For Homes buys Hawkins County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Rogersville', 'rogersville', False),
            ('Church Hill', 'church-hill', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Haywood County', 'county_id': 'haywood',
        'median_price': '$148,000', 'homes_sold': '14', 'avg_days': '98',
        'desc1': 'Haywood County is a West Tennessee county with deep agricultural roots centered around Brownsville. Known for its rich Delta heritage and connection to blues music history, the county offers affordable living and a warm community. Tennessee Cash For Homes buys houses across all of Haywood County fast and for cash.',
        'desc2': 'Whether you have an inherited property, are behind on payments, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Haywood County offers fertile farmland and affordable residential lots in the West Tennessee Delta region. Tennessee Cash For Homes buys Haywood County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Brownsville', 'brownsville', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Henderson County', 'county_id': 'henderson',
        'median_price': '$195,000', 'homes_sold': '22', 'avg_days': '90',
        'desc1': 'Henderson County is a West Tennessee county centered around Lexington with a strong sense of community and affordable housing. Home to Natchez Trace State Park, the county offers outdoor recreation and a relaxed rural lifestyle. Tennessee Cash For Homes buys houses across all of Henderson County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing foreclosure, or need a quick sale we are here to help. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Henderson County offers affordable farmland, wooded tracts, and lakefront properties near Natchez Trace State Park. Tennessee Cash For Homes buys Henderson County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Lexington', 'lexington', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Henry County', 'county_id': 'henry',
        'median_price': '$195,000', 'homes_sold': '28', 'avg_days': '92',
        'desc1': 'Henry County is a beautiful West Tennessee county home to Paris and the shores of Kentucky Lake, one of the largest man made lakes in the eastern United States. The county is a popular destination for fishing, boating, and lakeside living. Tennessee Cash For Homes buys houses across all of Henry County fast and for cash.',
        'desc2': 'Whether you are downsizing, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Henry County offers sought after lakefront land on Kentucky Lake along with affordable farmland and rural acreage. Tennessee Cash For Homes buys Henry County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Paris', 'paris', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Jackson County', 'county_id': 'jackson',
        'median_price': '$175,000', 'homes_sold': '10', 'avg_days': '105',
        'desc1': 'Jackson County is a rural Upper Cumberland county in Middle Tennessee home to Gainesboro. Situated along the Cumberland River, the county offers peaceful country living and access to Cordell Hull Lake. Tennessee Cash For Homes buys houses across all of Jackson County fast and for cash.',
        'desc2': 'Whether you have an inherited property, need to relocate, or want a quick hassle free sale we are here with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Jackson County offers affordable rural land along the Cumberland River and Cordell Hull Lake. Tennessee Cash For Homes buys Jackson County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Gainesboro', 'gainesboro', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Jefferson County', 'county_id': 'jefferson',
        'median_price': '$295,000', 'homes_sold': '42', 'avg_days': '78',
        'desc1': 'Jefferson County is a scenic East Tennessee county home to Dandridge, one of the oldest towns in the state, and the shores of Douglas Lake. The county offers mountain views, lake living, and proximity to both Knoxville and the Smoky Mountains. Tennessee Cash For Homes buys houses across all of Jefferson County fast and for cash.',
        'desc2': 'Whether you need to sell due to relocation, inheritance, or financial reasons we make the process easy. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Jefferson County offers lakefront land on Douglas Lake, mountain view properties, and growing residential development. Tennessee Cash For Homes buys Jefferson County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Dandridge', 'dandridge', False),
            ('Jefferson City', 'jefferson-city', False),
            ('White Pine', 'white-pine', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Johnson County', 'county_id': 'johnson',
        'median_price': '$195,000', 'homes_sold': '14', 'avg_days': '96',
        'desc1': 'Johnson County is Tennessee\'s easternmost county, a mountain community home to Mountain City and surrounded by the Cherokee National Forest. The county offers stunning Appalachian scenery, affordable living, and a strong sense of community. Tennessee Cash For Homes buys houses across all of Johnson County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial challenges, or need a quick sale we are here to help. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Johnson County offers affordable mountain land with stunning views and access to the Appalachian Trail and Cherokee National Forest. Tennessee Cash For Homes buys Johnson County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Mountain City', 'mountain-city', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Knox County', 'county_id': 'knox',
        'median_price': '$355,000', 'homes_sold': '342', 'avg_days': '62',
        'desc1': 'Knox County is home to Knoxville, Tennessee\'s third largest city and a vibrant hub of culture, education, and commerce in East Tennessee. With the University of Tennessee, a revitalized downtown, and proximity to the Great Smoky Mountains, the county is one of the state\'s most desirable places to live. Tennessee Cash For Homes buys houses across all of Knox County fast and for cash.',
        'desc2': 'Whether you are in Knoxville, Farragut, Powell, or anywhere else in Knox County we are ready to make you a fair cash offer today. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Knox County\'s growing population and strong economy have driven land values up across the county. Tennessee Cash For Homes buys Knox County land quickly with no commissions, no closing costs, and a flexible timeline.',
        'cities': [
            ('Knoxville', 'knoxville', True),
            ('Farragut', 'farragut', False),
            ('Powell', 'powell', False),
        ],
        'h1_suffix': '',
    },
    {
        'name': 'Lake County', 'county_id': 'lake',
        'median_price': '$95,000', 'homes_sold': '5', 'avg_days': '125',
        'desc1': 'Lake County is Tennessee\'s smallest county by population, located in the far northwest corner along the Mississippi River and Reelfoot Lake. Home to Tiptonville, the county is known for its world class fishing and unique earthquake formed lake. Tennessee Cash For Homes buys houses across all of Lake County fast and for cash.',
        'desc2': 'Whether you have an inherited property, need to relocate, or want a quick sale we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Lake County offers unique lakefront and farmland near Reelfoot Lake at extremely affordable prices. Tennessee Cash For Homes buys Lake County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Tiptonville', 'tiptonville', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Lauderdale County', 'county_id': 'lauderdale',
        'median_price': '$135,000', 'homes_sold': '16', 'avg_days': '98',
        'desc1': 'Lauderdale County is a West Tennessee county along the Mississippi River home to Ripley. The county has a rich agricultural heritage and offers affordable small town living with access to outdoor recreation. Tennessee Cash For Homes buys houses across all of Lauderdale County fast and for cash.',
        'desc2': 'Whether you are facing financial hardship, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Lauderdale County offers fertile farmland and affordable rural lots along the Mississippi River corridor. Tennessee Cash For Homes buys Lauderdale County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Ripley', 'ripley', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Lincoln County', 'county_id': 'lincoln',
        'median_price': '$275,000', 'homes_sold': '28', 'avg_days': '84',
        'desc1': 'Lincoln County is a scenic Southern Middle Tennessee county home to Fayetteville. Known for its historic downtown, rolling hills, and the annual Tennessee Walking Horse celebration, the county offers affordable living and rich heritage. Tennessee Cash For Homes buys houses across all of Lincoln County fast and for cash.',
        'desc2': 'Whether you need to sell due to relocation, an inherited property, or financial reasons we are here to help. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Lincoln County offers beautiful rolling farmland and rural residential tracts in the heart of Southern Middle Tennessee. Tennessee Cash For Homes buys Lincoln County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Fayetteville', 'fayetteville', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Loudon County', 'county_id': 'loudon',
        'median_price': '$345,000', 'homes_sold': '52', 'avg_days': '74',
        'desc1': 'Loudon County is a growing East Tennessee county situated between Knoxville and the Tennessee River. Home to Loudon and the rapidly growing city of Lenoir City, the county offers lakefront living on Tellico Lake and Fort Loudoun Lake. Tennessee Cash For Homes buys houses across all of Loudon County fast and for cash.',
        'desc2': 'Whether you are downsizing, dealing with an inherited property, or need to sell quickly we make the process simple and stress free. No repairs, no agent commissions, and we close on your schedule.',
        'land_para': 'Loudon County offers desirable lakefront land on Tellico Lake and Fort Loudoun Lake along with growing residential development areas. Tennessee Cash For Homes buys Loudon County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Loudon', 'loudon', False),
            ('Lenoir City', 'lenoir-city', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Macon County', 'county_id': 'macon',
        'median_price': '$245,000', 'homes_sold': '20', 'avg_days': '88',
        'desc1': 'Macon County is a rural Upper Cumberland county in Middle Tennessee home to Lafayette. The county offers affordable living, rolling farmland, and a welcoming small town atmosphere near the Kentucky border. Tennessee Cash For Homes buys houses across all of Macon County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial difficulties, or need to sell quickly we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Macon County offers affordable farmland and rural residential lots in the Upper Cumberland region. Tennessee Cash For Homes buys Macon County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Lafayette', 'lafayette', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Madison County', 'county_id': 'madison',
        'median_price': '$235,000', 'homes_sold': '132', 'avg_days': '76',
        'desc1': 'Madison County is the commercial hub of West Tennessee, home to Jackson and a thriving economy built around healthcare, manufacturing, and education. The county offers a great quality of life with affordable housing and big city amenities. Tennessee Cash For Homes buys houses across all of Madison County fast and for cash.',
        'desc2': 'Whether you are in Jackson or anywhere else in Madison County, facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are ready with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Madison County\'s strong economy and central West Tennessee location make land a valuable asset. Tennessee Cash For Homes buys Madison County land quickly with no commissions, no closing costs, and a flexible timeline.',
        'cities': [
            ('Jackson', 'jackson', True),
        ],
        'h1_suffix': '',
    },
    {
        'name': 'Marion County', 'county_id': 'marion',
        'median_price': '$225,000', 'homes_sold': '24', 'avg_days': '88',
        'desc1': 'Marion County is a scenic Southeast Tennessee county home to Jasper and the dramatic gorges of the Tennessee River. Bordering Chattanooga to the south, the county offers stunning natural beauty, affordable housing, and access to Nickajack Lake. Tennessee Cash For Homes buys houses across all of Marion County fast and for cash.',
        'desc2': 'Whether you need to sell due to relocation, an inherited property, or financial challenges we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Marion County offers scenic river and mountain land including lakefront properties on Nickajack Lake. Tennessee Cash For Homes buys Marion County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Jasper', 'jasper', False),
            ('South Pittsburg', 'south-pittsburg', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'McMinn County', 'county_id': 'mcminn',
        'median_price': '$235,000', 'homes_sold': '42', 'avg_days': '82',
        'desc1': 'McMinn County is a growing East Tennessee county anchored by Athens and Etowah. Situated between Knoxville and Chattanooga along Interstate 75, the county offers affordable living with convenient access to both major cities. Tennessee Cash For Homes buys houses across all of McMinn County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial hardship, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'McMinn County offers a mix of farmland, residential lots, and commercial properties along the I-75 corridor. Tennessee Cash For Homes buys McMinn County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Athens', 'athens', False),
            ('Etowah', 'etowah', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'McNairy County', 'county_id': 'mcnairy',
        'median_price': '$155,000', 'homes_sold': '18', 'avg_days': '96',
        'desc1': 'McNairy County is a rural West Tennessee county home to Selmer and known for its connection to the legendary Sheriff Buford Pusser. The county offers affordable living, rolling countryside, and a strong sense of community. Tennessee Cash For Homes buys houses across all of McNairy County fast and for cash.',
        'desc2': 'Whether you have an inherited property, are facing financial difficulties, or simply need to sell fast we are here to help. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'McNairy County offers affordable farmland and rural residential tracts near the Mississippi border. Tennessee Cash For Homes buys McNairy County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Selmer', 'selmer', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Meigs County', 'county_id': 'meigs',
        'median_price': '$195,000', 'homes_sold': '10', 'avg_days': '98',
        'desc1': 'Meigs County is a small rural county in East Tennessee along the Tennessee River. Home to Decatur and surrounded by water on three sides, the county offers lakefront living on Watts Bar Lake and Chickamauga Lake. Tennessee Cash For Homes buys houses across all of Meigs County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, need to relocate, or want a quick hassle free sale we are here with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Meigs County offers unique lakefront land surrounded by the Tennessee River on multiple sides. Tennessee Cash For Homes buys Meigs County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Decatur', 'decatur', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Monroe County', 'county_id': 'monroe',
        'median_price': '$245,000', 'homes_sold': '34', 'avg_days': '86',
        'desc1': 'Monroe County is a scenic East Tennessee county home to Madisonville and Sweetwater. With access to Tellico Lake, the Cherokee National Forest, and the foothills of the Smoky Mountains, the county offers outstanding natural beauty. Tennessee Cash For Homes buys houses across all of Monroe County fast and for cash.',
        'desc2': 'Whether you need to sell due to relocation, inheritance, or financial reasons we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Monroe County offers lakefront land on Tellico Lake, mountain tracts near the Cherokee National Forest, and rural farmland. Tennessee Cash For Homes buys Monroe County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Madisonville', 'madisonville', False),
            ('Sweetwater', 'sweetwater', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Moore County', 'county_id': 'moore',
        'median_price': '$285,000', 'homes_sold': '6', 'avg_days': '92',
        'desc1': 'Moore County is Tennessee\'s smallest county by population, best known as the home of Lynchburg and the Jack Daniel\'s Distillery. Despite its small size, the county draws visitors from around the world and offers charming small town living. Tennessee Cash For Homes buys houses across all of Moore County fast and for cash.',
        'desc2': 'Whether you have an inherited property, are looking to downsize, or need to sell quickly we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Moore County offers scenic rural land and small acreage tracts in one of Tennessee\'s most iconic communities. Tennessee Cash For Homes buys Moore County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Lynchburg', 'lynchburg', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Morgan County', 'county_id': 'morgan',
        'median_price': '$165,000', 'homes_sold': '15', 'avg_days': '100',
        'desc1': 'Morgan County is a rugged mountain county on the Cumberland Plateau in East Tennessee. Home to Wartburg and bordered by the Obed Wild and Scenic River, the county offers affordable living surrounded by some of the state\'s most pristine wilderness. Tennessee Cash For Homes buys houses across all of Morgan County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial challenges, or need a quick sale we make the process easy. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Morgan County offers affordable mountain land near the Obed River and Frozen Head State Park. Tennessee Cash For Homes buys Morgan County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Wartburg', 'wartburg', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Obion County', 'county_id': 'obion',
        'median_price': '$135,000', 'homes_sold': '22', 'avg_days': '94',
        'desc1': 'Obion County is a Northwest Tennessee county centered around Union City with a strong agricultural economy. The county offers affordable living and a welcoming small town atmosphere near the Kentucky border. Tennessee Cash For Homes buys houses across all of Obion County fast and for cash.',
        'desc2': 'Whether you are facing financial difficulties, dealing with an inherited property, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Obion County offers productive farmland and affordable residential lots in Northwest Tennessee. Tennessee Cash For Homes buys Obion County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Union City', 'union-city', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Overton County', 'county_id': 'overton',
        'median_price': '$195,000', 'homes_sold': '18', 'avg_days': '92',
        'desc1': 'Overton County is an Upper Cumberland county in Middle Tennessee home to Livingston. The county offers affordable housing, scenic countryside, and a growing community near the shores of Center Hill Lake. Tennessee Cash For Homes buys houses across all of Overton County fast and for cash.',
        'desc2': 'Whether you have an inherited property, are facing foreclosure, or simply need to sell fast we are here to help. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Overton County offers affordable rural land with rolling hills, farmland, and proximity to Center Hill Lake. Tennessee Cash For Homes buys Overton County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Livingston', 'livingston', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Pickett County', 'county_id': 'pickett',
        'median_price': '$155,000', 'homes_sold': '6', 'avg_days': '112',
        'desc1': 'Pickett County is one of Tennessee\'s smallest and most peaceful counties, home to Byrdstown and the stunning Dale Hollow Lake. Known for world class fishing and natural beauty, the county offers an escape from the hustle of city life. Tennessee Cash For Homes buys houses across all of Pickett County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, need to relocate, or want a quick hassle free sale we are here with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Pickett County offers affordable lakefront land on Dale Hollow Lake and scenic rural acreage. Tennessee Cash For Homes buys Pickett County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Byrdstown', 'byrdstown', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Polk County', 'county_id': 'polk',
        'median_price': '$215,000', 'homes_sold': '14', 'avg_days': '94',
        'desc1': 'Polk County is a scenic Southeast Tennessee county along the Ocoee River, famous for hosting the 1996 Olympic whitewater events. Home to Benton and Copperhill, the county offers stunning mountain scenery and world class outdoor recreation. Tennessee Cash For Homes buys houses across all of Polk County fast and for cash.',
        'desc2': 'Whether you need to sell due to relocation, an inherited property, or financial hardship we make the process simple. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Polk County offers mountain land near the Cherokee National Forest and Ocoee River at affordable prices. Tennessee Cash For Homes buys Polk County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Benton', 'benton', False),
            ('Copperhill', 'copperhill', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Putnam County', 'county_id': 'putnam',
        'median_price': '$285,000', 'homes_sold': '68', 'avg_days': '76',
        'desc1': 'Putnam County is a thriving Upper Cumberland county home to Cookeville and Tennessee Technological University. The county has become one of the state\'s fastest growing areas with a strong economy, excellent schools, and affordable cost of living. Tennessee Cash For Homes buys houses across all of Putnam County fast and for cash.',
        'desc2': 'Whether you are facing foreclosure, dealing with an inherited property, or simply need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline with a fair cash offer.',
        'land_para': 'Putnam County\'s rapid growth has increased demand for land across the county. Tennessee Cash For Homes buys Putnam County land quickly with no commissions, no surveys required, and flexible closing.',
        'cities': [
            ('Cookeville', 'cookeville', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Rhea County', 'county_id': 'rhea',
        'median_price': '$225,000', 'homes_sold': '28', 'avg_days': '86',
        'desc1': 'Rhea County is an East Tennessee county home to Dayton, famous for the historic Scopes Trial. Located along the Tennessee River and Watts Bar Lake, the county offers affordable waterfront living and a growing community. Tennessee Cash For Homes buys houses across all of Rhea County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial hardship, or need to sell quickly we make the process easy. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Rhea County offers lakefront land on Watts Bar Lake and affordable rural acreage in a growing market. Tennessee Cash For Homes buys Rhea County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Dayton', 'dayton', False),
            ('Spring City', 'spring-city', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Roane County', 'county_id': 'roane',
        'median_price': '$225,000', 'homes_sold': '42', 'avg_days': '82',
        'desc1': 'Roane County is an East Tennessee county home to Kingston and Harriman, situated at the confluence of the Tennessee and Clinch Rivers. The county offers lakefront living on Watts Bar Lake, affordable housing, and easy access to Knoxville. Tennessee Cash For Homes buys houses across all of Roane County fast and for cash.',
        'desc2': 'Whether you need to sell due to relocation, an inherited property, or financial reasons we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Roane County offers lakefront land on Watts Bar Lake, riverfront properties, and affordable residential lots. Tennessee Cash For Homes buys Roane County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Kingston', 'kingston', False),
            ('Harriman', 'harriman', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Scott County', 'county_id': 'scott',
        'median_price': '$145,000', 'homes_sold': '16', 'avg_days': '102',
        'desc1': 'Scott County is a mountain county on the Cumberland Plateau in Northeast Tennessee home to Huntsville and Oneida. Known for the Big South Fork National Recreation Area, the county offers outdoor adventure and affordable mountain living. Tennessee Cash For Homes buys houses across all of Scott County fast and for cash.',
        'desc2': 'Whether you have an inherited property, are facing financial difficulties, or simply need to sell fast we are here to help. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Scott County offers affordable mountain land near the Big South Fork with wooded tracts and scenic acreage. Tennessee Cash For Homes buys Scott County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Huntsville', 'huntsville-tn', False),
            ('Oneida', 'oneida', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Sequatchie County', 'county_id': 'sequatchie',
        'median_price': '$215,000', 'homes_sold': '12', 'avg_days': '92',
        'desc1': 'Sequatchie County is a small scenic county in the Sequatchie Valley of Southeast Tennessee. Home to Dunlap, the county is known for hang gliding at Dunlap and beautiful valley and mountain views. Tennessee Cash For Homes buys houses across all of Sequatchie County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, need to relocate, or want a quick hassle free sale we make the process simple. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Sequatchie County offers scenic valley and mountain land at affordable prices in a quiet Tennessee setting. Tennessee Cash For Homes buys Sequatchie County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Dunlap', 'dunlap', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Sevier County', 'county_id': 'sevier',
        'median_price': '$425,000', 'homes_sold': '185', 'avg_days': '70',
        'desc1': 'Sevier County is one of Tennessee\'s most visited counties, home to Sevierville, Pigeon Forge, and Gatlinburg at the gateway to the Great Smoky Mountains National Park. The county\'s tourism driven economy and stunning mountain scenery make it one of the most unique real estate markets in the state. Tennessee Cash For Homes buys houses across all of Sevier County fast and for cash.',
        'desc2': 'Whether you own a cabin, a primary residence, or an investment property that you need to sell quickly we are ready to make you a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Sevier County mountain land is highly sought after for cabin development and tourism investment. Tennessee Cash For Homes buys Sevier County land quickly with no commissions, no surveys required, and flexible closing.',
        'cities': [
            ('Sevierville', 'sevierville', False),
            ('Pigeon Forge', 'pigeon-forge', False),
            ('Gatlinburg', 'gatlinburg', False),
        ],
        'h1_suffix': '',
    },
    {
        'name': 'Shelby County', 'county_id': 'shelby',
        'median_price': '$245,000', 'homes_sold': '585', 'avg_days': '72',
        'desc1': 'Shelby County is home to Memphis, Tennessee\'s largest city and a global center of music, culture, and barbecue. The county\'s diverse neighborhoods range from historic to modern, offering housing options for every budget. Tennessee Cash For Homes buys houses across all of Shelby County fast and for cash in any condition.',
        'desc2': 'Whether you are in Memphis, Germantown, Bartlett, Collierville, or anywhere else in Shelby County we are ready to make you a fair cash offer today. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Shelby County\'s large population and ongoing suburban development keep land in high demand. Tennessee Cash For Homes buys Shelby County land quickly with no commissions, no closing costs, and a flexible timeline.',
        'cities': [
            ('Memphis', 'memphis', True),
            ('Germantown', 'germantown', False),
            ('Bartlett', 'bartlett', False),
            ('Collierville', 'collierville', False),
        ],
        'h1_suffix': '',
    },
    {
        'name': 'Sullivan County', 'county_id': 'sullivan',
        'median_price': '$245,000', 'homes_sold': '142', 'avg_days': '76',
        'desc1': 'Sullivan County is a major Northeast Tennessee county home to Bristol and Kingsport, two of the Tri-Cities region\'s anchor cities. With a strong manufacturing heritage, vibrant music scene, and access to the Appalachian Mountains, the county offers an excellent quality of life. Tennessee Cash For Homes buys houses across all of Sullivan County fast and for cash.',
        'desc2': 'Whether you are in Bristol, Kingsport, or anywhere else in Sullivan County and need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Sullivan County offers diverse land options from residential lots in growing suburbs to rural mountain acreage. Tennessee Cash For Homes buys Sullivan County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Bristol', 'bristol', False),
            ('Kingsport', 'kingsport', False),
            ('Blountville', 'blountville', False),
        ],
        'h1_suffix': '',
    },
    {
        'name': 'Tipton County', 'county_id': 'tipton',
        'median_price': '$235,000', 'homes_sold': '48', 'avg_days': '80',
        'desc1': 'Tipton County is a growing suburban county north of Memphis home to Covington and the fast expanding community of Munford. The county offers affordable housing with easy access to Memphis employment and amenities. Tennessee Cash For Homes buys houses across all of Tipton County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial challenges, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Tipton County\'s suburban growth from Memphis has made land increasingly valuable for residential development. Tennessee Cash For Homes buys Tipton County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Covington', 'covington', False),
            ('Munford', 'munford', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Unicoi County', 'county_id': 'unicoi',
        'median_price': '$215,000', 'homes_sold': '14', 'avg_days': '90',
        'desc1': 'Unicoi County is a small mountain county in Northeast Tennessee home to Erwin and the scenic Nolichucky River. Surrounded by the Cherokee National Forest and Unaka Mountains, the county offers stunning Appalachian scenery and affordable mountain living. Tennessee Cash For Homes buys houses across all of Unicoi County fast and for cash.',
        'desc2': 'Whether you have an inherited property, need to relocate, or want a quick hassle free sale we are here to help with a fair cash offer. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Unicoi County offers affordable mountain land with river access and stunning views of the Unaka Mountains. Tennessee Cash For Homes buys Unicoi County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Erwin', 'erwin', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Union County', 'county_id': 'union',
        'median_price': '$215,000', 'homes_sold': '14', 'avg_days': '92',
        'desc1': 'Union County is a rural East Tennessee county home to Maynardville and bordered by Norris Lake to the north. The county offers affordable housing, beautiful lake access, and a quiet rural lifestyle within commuting distance of Knoxville. Tennessee Cash For Homes buys houses across all of Union County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial hardship, or need to sell quickly we are ready to help. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Union County offers lakefront land on Norris Lake and affordable rural acreage near Knoxville. Tennessee Cash For Homes buys Union County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Maynardville', 'maynardville', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Van Buren County', 'county_id': 'van-buren',
        'median_price': '$175,000', 'homes_sold': '6', 'avg_days': '110',
        'desc1': 'Van Buren County is one of Tennessee\'s smallest counties, a quiet Cumberland Plateau community home to Spencer and Fall Creek Falls State Park. The park\'s stunning waterfalls and gorges make the county a hidden gem. Tennessee Cash For Homes buys houses across all of Van Buren County fast and for cash.',
        'desc2': 'Whether you have an inherited property, need to relocate, or simply want to sell we make the process easy. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'Van Buren County offers scenic plateau land near Fall Creek Falls State Park at very affordable prices. Tennessee Cash For Homes buys Van Buren County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Spencer', 'spencer', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Washington County', 'county_id': 'washington',
        'median_price': '$295,000', 'homes_sold': '98', 'avg_days': '72',
        'desc1': 'Washington County is a major Northeast Tennessee county home to Jonesborough, the state\'s oldest town, and Johnson City. As part of the Tri-Cities region, the county offers a growing economy, excellent healthcare, and a vibrant arts and culture scene. Tennessee Cash For Homes buys houses across all of Washington County fast and for cash.',
        'desc2': 'Whether you are in Johnson City, Jonesborough, or anywhere else in Washington County and need to sell quickly we are ready with a fair cash offer. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Washington County\'s growing population and strong economy have made land increasingly desirable. Tennessee Cash For Homes buys Washington County land quickly with no commissions, no surveys required, and flexible closing.',
        'cities': [
            ('Johnson City', 'johnson-city', False),
            ('Jonesborough', 'jonesborough', False),
        ],
        'h1_suffix': '',
    },
    {
        'name': 'Wayne County', 'county_id': 'wayne',
        'median_price': '$165,000', 'homes_sold': '12', 'avg_days': '102',
        'desc1': 'Wayne County is a rural Southern Middle Tennessee county home to Waynesboro along the Buffalo River. The county offers some of the most affordable real estate in the state along with beautiful countryside and access to the Natchez Trace Parkway. Tennessee Cash For Homes buys houses across all of Wayne County fast and for cash.',
        'desc2': 'Whether you are dealing with an inherited property, facing financial difficulties, or need to sell quickly we are here to help. No repairs needed, no agent fees, and we close when you are ready.',
        'land_para': 'Wayne County offers affordable rural land along the Buffalo River and Natchez Trace Parkway. Tennessee Cash For Homes buys Wayne County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Waynesboro', 'waynesboro', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'Weakley County', 'county_id': 'weakley',
        'median_price': '$155,000', 'homes_sold': '24', 'avg_days': '92',
        'desc1': 'Weakley County is a Northwest Tennessee county home to Dresden and Martin, where the University of Tennessee at Martin brings a college town energy to the region. The county offers affordable living and a welcoming community atmosphere. Tennessee Cash For Homes buys houses across all of Weakley County fast and for cash.',
        'desc2': 'Whether you are relocating, dealing with an inherited property, or need to sell quickly we make the process simple. No repairs needed, no agent fees, and we close on your timeline.',
        'land_para': 'Weakley County offers affordable farmland and residential lots in a growing Northwest Tennessee community. Tennessee Cash For Homes buys Weakley County land quickly with no commissions and flexible closing.',
        'cities': [
            ('Dresden', 'dresden', False),
            ('Martin', 'martin', False),
        ],
        'h1_suffix': 'TN',
    },
    {
        'name': 'White County', 'county_id': 'white',
        'median_price': '$235,000', 'homes_sold': '28', 'avg_days': '86',
        'desc1': 'White County is an Upper Cumberland county in Middle Tennessee home to Sparta. The county offers affordable living, scenic countryside, and access to Center Hill Lake and Rock Island State Park. Tennessee Cash For Homes buys houses across all of White County fast and for cash.',
        'desc2': 'Whether you are facing financial difficulties, dealing with an inherited property, or need to sell quickly we are ready to help with a fair cash offer. No repairs needed, no agent fees, and we close on your schedule.',
        'land_para': 'White County offers lakefront land near Center Hill Lake, farmland, and scenic rural acreage at affordable prices. Tennessee Cash For Homes buys White County land quickly with no commissions and no hidden fees.',
        'cities': [
            ('Sparta', 'sparta', False),
        ],
        'h1_suffix': 'TN',
    },
]
# fmt: on

TEMPLATE = '''\
<?php
/**
 * Template Name: County — {name}
 *
 * WordPress setup:
 *   Slug:     {slug}  (under county-pages/ parent)
 *   Template: County — {name}
 */

$county = [
    'slug'          => '{slug}',
    'name'          => '{name}',
    'county_id'     => '{county_id}',
    'h1'            => '{h1}',
    'meta_title'    => '{meta_title}',
    'meta_desc'     => '{meta_desc}',
    'median_price'  => '{median_price}',
    'homes_sold'    => '{homes_sold}',
    'avg_days'      => '{avg_days}',
    'desc1'         => '{desc1}',
    'desc2'         => '{desc2}',
    'land_para'     => '{land_para}',
    'cities'        => [
{cities_php}    ],
];

add_action( 'wp_head', function() use ( $county ) {{
    echo '<meta name="description" content="' . esc_attr( $county['meta_desc'] ) . '">' . "\\n";
}} );

include get_template_directory() . '/county-template.php';
'''


def make_city_line(city_name, city_slug, has_page):
    hp = 'true' if has_page else 'false'
    # Align like existing pages
    return f"        [\'name\' => \'{city_name}\', \'slug\' => \'{city_slug}\', \'has_page\' => {hp}],\n"


def generate():
    os.makedirs(OUTPUT_DIR, exist_ok=True)
    count = 0
    for c in COUNTIES:
        name = c['name']
        county_id = c['county_id']
        slug = county_id + '-county' if 'county' not in county_id else county_id.replace(' ', '-') + '-county'
        # Handle van-buren special case
        if county_id == 'van-buren':
            slug = 'van-buren-county'

        suffix = c.get('h1_suffix', 'TN')
        h1 = f'Sell Your House Fast For Cash in {name}'
        if suffix:
            h1 += f' {suffix}'

        meta_title = f'We Buy Houses in {name} TN | Fast Cash Offers'
        meta_desc = f'We buy houses in {name} Tennessee for cash. No repairs, no agents, no fees. Get a fair cash offer in 24 hours and close on your timeline.'

        # Build cities PHP
        cities_php = ''
        for city_name, city_slug, has_page in c['cities']:
            cities_php += make_city_line(city_name, city_slug, has_page)

        # Escape single quotes for PHP strings
        desc1 = c['desc1'].replace("'", "\\'")
        desc2 = c['desc2'].replace("'", "\\'")
        land_para = c['land_para'].replace("'", "\\'")
        meta_desc_escaped = meta_desc.replace("'", "\\'")

        content = TEMPLATE.format(
            name=name,
            slug=slug,
            county_id=county_id,
            h1=h1,
            meta_title=meta_title,
            meta_desc=meta_desc_escaped,
            median_price=c['median_price'],
            homes_sold=c['homes_sold'],
            avg_days=c['avg_days'],
            desc1=desc1,
            desc2=desc2,
            land_para=land_para,
            cities_php=cities_php,
        )

        filename = f"page-county-{slug}.php"
        filepath = os.path.join(OUTPUT_DIR, filename)
        with open(filepath, 'w') as f:
            f.write(content)
        count += 1
        print(f"  Created: {filename}")

    print(f"\nDone! Generated {count} county pages in {OUTPUT_DIR}/")


if __name__ == '__main__':
    generate()
