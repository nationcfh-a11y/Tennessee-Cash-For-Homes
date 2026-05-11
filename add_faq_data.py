#!/usr/bin/env python3
"""
Inject faq_extra data into every county and city page file.
Each location gets 1-2 unique, location-specific FAQ questions.
"""

import os, re, sys

BASE = os.path.dirname(os.path.abspath(__file__))
COUNTY_DIR = os.path.join(BASE, 'tn-cash-for-homes', 'county-pages')
CITY_DIR = os.path.join(BASE, 'tn-cash-for-homes')

# ── UNIQUE FAQ DATA FOR ALL 95 COUNTIES ──
COUNTY_FAQS = {
    'anderson': [
        {'q': 'Can I sell an older home near Oak Ridge in Anderson County?', 'a': 'Yes. Many homes in the Oak Ridge area were built in the 1940s and 1950s and may need significant updates. We buy older homes in Anderson County regardless of age or condition, including those with outdated electrical, plumbing, or foundation issues.'},
        {'q': 'Do you buy houses affected by environmental concerns in Anderson County?', 'a': 'We understand that Anderson County has a unique history tied to the Oak Ridge National Laboratory. We evaluate every property individually and buy homes in all situations across Anderson County.'},
    ],
    'bedford': [
        {'q': 'Do you buy homes in the Shelbyville area of Bedford County?', 'a': 'Absolutely. Shelbyville is the county seat and we actively purchase homes throughout Shelbyville and all of Bedford County. Whether your home is in town or on a rural lot, we will make you a fair cash offer.'},
        {'q': 'Can I sell a horse farm or property with acreage in Bedford County?', 'a': 'Yes. Bedford County is known as the Walking Horse Capital of the World, and we buy all types of properties including farms, homes with acreage, and equestrian properties. We handle the complexity so you do not have to.'},
    ],
    'benton': [
        {'q': 'Do you buy lakefront or vacation properties in Benton County?', 'a': 'Yes. Benton County is home to Kentucky Lake and many seasonal or vacation properties. We buy lakefront homes, cabins, and all types of properties in Benton County regardless of condition or occupancy status.'},
        {'q': 'Can I sell a house in Camden or other small towns in Benton County?', 'a': 'We buy homes throughout all of Benton County including Camden, Big Sandy, and surrounding communities. Small-town properties are no problem for us.'},
    ],
    'bledsoe': [
        {'q': 'Do you buy rural properties or homes on large lots in Bledsoe County?', 'a': 'Yes. Bledsoe County is one of Tennessee\'s most rural counties and we are experienced in purchasing properties on large lots, unimproved land, and homes in remote areas. Distance from a major city does not affect our ability to make you an offer.'},
        {'q': 'Can I sell an inherited property in Bledsoe County?', 'a': 'Absolutely. Many homeowners in Bledsoe County inherit properties they cannot maintain. We buy inherited homes in any condition and can help navigate the process even if probate is still in progress.'},
    ],
    'blount': [
        {'q': 'Do you buy homes near the Great Smoky Mountains in Blount County?', 'a': 'Yes. Blount County borders the Great Smoky Mountains National Park, and we buy homes throughout the county including Maryville, Alcoa, and Townsend. Whether it is a primary residence or a mountain getaway, we are interested.'},
        {'q': 'Can I sell a property in Blount County that needs major repairs after storm damage?', 'a': 'Absolutely. Blount County properties can face weather-related damage from storms moving through the foothills. We buy storm-damaged homes as-is with no repairs needed on your part.'},
    ],
    'bradley': [
        {'q': 'Do you buy homes in Cleveland, Tennessee in Bradley County?', 'a': 'Yes. Cleveland is the largest city in Bradley County and we actively purchase homes throughout the area. Whether your home is near downtown Cleveland or in the surrounding communities, we make fair cash offers.'},
        {'q': 'Can I sell a rental property in Bradley County?', 'a': 'We buy rental properties in Bradley County whether they are occupied with tenants or vacant. You do not need to wait for a lease to expire. We handle tenant situations regularly.'},
    ],
    'campbell': [
        {'q': 'Do you buy homes in La Follette or Jellico in Campbell County?', 'a': 'Yes. We buy homes throughout Campbell County including La Follette, Jellico, Jacksboro, and Caryville. No matter where your property is located in the county, we will make you a cash offer.'},
        {'q': 'Can I sell a property in Campbell County that has been sitting vacant?', 'a': 'Absolutely. Vacant properties are common in Campbell County and we buy them regularly. Even if the home has been unoccupied for years and has fallen into disrepair, we will purchase it as-is.'},
    ],
    'cannon': [
        {'q': 'Is it hard to sell a home in a small county like Cannon County?', 'a': 'Selling on the traditional market in a small county like Cannon County can be challenging due to limited buyer demand. That is where we come in. We buy homes directly for cash in Woodbury and throughout Cannon County, eliminating the uncertainty of waiting for a buyer.'},
        {'q': 'Do you buy homes with well water and septic systems in Cannon County?', 'a': 'Yes. Many rural Cannon County homes use well water and septic systems. We buy these properties regardless of the condition of the well or septic system.'},
    ],
    'carroll': [
        {'q': 'Do you buy homes in Huntingdon or McKenzie in Carroll County?', 'a': 'Yes. We purchase homes throughout Carroll County including Huntingdon, McKenzie, Hollow Rock, and all surrounding areas. We are familiar with the local market and provide fair cash offers.'},
        {'q': 'Can I sell a mobile home on land in Carroll County?', 'a': 'We buy mobile homes on owned land in Carroll County. Whether it is a single-wide or double-wide, we will evaluate the property and make you a cash offer.'},
    ],
    'carter': [
        {'q': 'Do you buy homes in Elizabethton or the Watauga Lake area of Carter County?', 'a': 'Yes. We buy homes throughout Carter County including Elizabethton, Hampton, and the Watauga Lake area. Mountain properties, lake homes, and in-town residences are all properties we purchase.'},
        {'q': 'Can I sell a fixer-upper in Carter County?', 'a': 'Absolutely. Carter County has many older homes that need work, and we buy them all as-is. You will not need to invest in any repairs or updates before selling to us.'},
    ],
    'cheatham': [
        {'q': 'Is Cheatham County considered part of the Nashville market for home sales?', 'a': 'Yes. Cheatham County is part of the greater Nashville metropolitan area, and many residents commute to Nashville. We buy homes throughout Cheatham County including Ashland City and Pleasant View, and our offers reflect the regional market.'},
        {'q': 'Do you buy homes on flood-prone land in Cheatham County?', 'a': 'We buy properties in Cheatham County including those in flood zones or that have experienced flooding from the Cumberland River. Flood history does not prevent us from making you an offer.'},
    ],
    'chester': [
        {'q': 'Do you buy properties in Henderson or other parts of Chester County?', 'a': 'Yes. We purchase homes throughout Chester County including Henderson and all surrounding areas. Whether your home is in town or on a rural lot, we buy properties in any condition.'},
        {'q': 'Can I sell a house in Chester County if I live out of state?', 'a': 'Absolutely. Many Chester County property owners live out of state and need a hassle-free sale. We handle all the details and can close remotely so you never need to travel to Tennessee.'},
    ],
    'claiborne': [
        {'q': 'Do you buy homes in Tazewell or New Tazewell in Claiborne County?', 'a': 'Yes. We buy homes throughout Claiborne County including Tazewell, New Tazewell, Cumberland Gap, and Harrogate. No matter the location or condition, we are interested in making you an offer.'},
        {'q': 'Can I sell an inherited property in Claiborne County that needs major repairs?', 'a': 'We regularly buy inherited properties in Claiborne County that need significant work. You do not need to make any repairs. We buy as-is and can work with you through probate if needed.'},
    ],
    'clay': [
        {'q': 'Is it difficult to sell a home in a rural county like Clay County?', 'a': 'Selling on the open market in Clay County can be slow due to low population density and limited buyer demand. We eliminate that problem by buying your home directly for cash. No waiting, no showings, no uncertainty.'},
        {'q': 'Do you buy properties near Dale Hollow Lake in Clay County?', 'a': 'Yes. Dale Hollow Lake attracts property owners throughout Clay County. We buy lakefront properties, cabins, and any residential property near the lake regardless of condition.'},
    ],
    'cocke': [
        {'q': 'Do you buy homes in Newport or Parrottsville in Cocke County?', 'a': 'Yes. We purchase homes throughout Cocke County including Newport, Parrottsville, and the surrounding areas near the Smoky Mountains. All property conditions are welcome.'},
        {'q': 'Can I sell a property in Cocke County that has code violations?', 'a': 'Absolutely. We buy homes in Cocke County even if they have code violations, liens, or other legal issues. We are experienced in handling complex situations and will work through any obstacles.'},
    ],
    'coffee': [
        {'q': 'Do you buy homes in Tullahoma or Manchester in Coffee County?', 'a': 'Yes. We actively purchase homes throughout Coffee County including Tullahoma, Manchester, and surrounding communities. Whether near Arnold Air Force Base or in town, we buy in any condition.'},
        {'q': 'Can I sell a house in Coffee County if I am relocating for military orders?', 'a': 'We work with military families near Arnold Air Force Base in Coffee County frequently. If you need to sell quickly due to PCS orders or deployment, we can close on your timeline — often in under two weeks.'},
    ],
    'crockett': [
        {'q': 'Do you buy farm homes or properties with agricultural land in Crockett County?', 'a': 'Yes. Crockett County has a strong agricultural heritage and we buy homes on farmland, rural residential properties, and homes in Alamo and surrounding communities.'},
        {'q': 'Can I sell a house in Crockett County that has been on the market for a long time?', 'a': 'If your Crockett County home has been sitting on the market without offers, we can help. We buy homes directly regardless of how long they have been listed, and we close quickly for cash.'},
    ],
    'cumberland': [
        {'q': 'Do you buy retirement or second homes in Cumberland County?', 'a': 'Yes. Cumberland County — especially the Crossville and Fairfield Glade areas — is popular with retirees. We buy primary residences, second homes, and retirement properties throughout the county.'},
        {'q': 'Can I sell a home in a Crossville golf community in Cumberland County?', 'a': 'Absolutely. We purchase homes in Crossville\'s planned communities and golf neighborhoods. HOA properties are no problem, and we handle all the details of the sale.'},
    ],
    'davidson': [
        {'q': 'How does Nashville\'s competitive market in Davidson County affect your cash offers?', 'a': 'Davidson County is one of Tennessee\'s hottest real estate markets. Our cash offers reflect current Nashville market conditions. Selling to us means you avoid months of showings, inspections, and buyer negotiations while still receiving a fair offer.'},
        {'q': 'Do you buy investment properties or rentals in Davidson County?', 'a': 'Yes. We buy all types of properties in Davidson County including rental homes, multi-family units, and investment properties — whether they are occupied or vacant, performing or distressed.'},
    ],
    'decatur': [
        {'q': 'Do you buy properties near the Tennessee River in Decatur County?', 'a': 'Yes. Decatur County runs along the Tennessee River and we buy properties throughout the county including Decaturville, Parsons, and riverfront areas. Waterfront or rural, we purchase all types.'},
        {'q': 'Can I sell a home in Decatur County if I owe back taxes?', 'a': 'We buy homes in Decatur County even if there are delinquent property taxes. We can work with you to resolve tax issues as part of the closing process.'},
    ],
    'dekalb': [
        {'q': 'Do you buy homes in Smithville or near Center Hill Lake in DeKalb County?', 'a': 'Yes. We buy homes throughout DeKalb County including Smithville and the Center Hill Lake area. Lake properties, in-town homes, and rural residences are all properties we purchase for cash.'},
        {'q': 'Can I sell a manufactured home in DeKalb County?', 'a': 'We buy manufactured and mobile homes in DeKalb County when they are on owned land. Contact us with your property details and we will provide a fair cash offer.'},
    ],
    'dickson': [
        {'q': 'Is Dickson County close enough to Nashville to get strong cash offers?', 'a': 'Yes. Dickson County is part of the Nashville commuter belt and property values reflect its proximity to the metro area. Our cash offers account for Dickson County\'s growing demand and convenient location.'},
        {'q': 'Do you buy homes in Dickson, White Bluff, or Burns in Dickson County?', 'a': 'We purchase homes throughout Dickson County including the cities of Dickson, White Bluff, Burns, and Charlotte. All conditions and situations are welcome.'},
    ],
    'dyer': [
        {'q': 'Do you buy homes in Dyersburg in Dyer County?', 'a': 'Yes. Dyersburg is the county seat and we actively buy homes throughout Dyersburg and all of Dyer County. Whether your home is downtown or in a rural area, we will make you a cash offer.'},
        {'q': 'Can I sell a property in Dyer County that has flood damage?', 'a': 'We buy homes in Dyer County that have experienced flooding from the Forked Deer River or other sources. Flood-damaged properties are purchased as-is with no repairs required.'},
    ],
    'fayette': [
        {'q': 'Is Fayette County part of the Memphis metro area for real estate?', 'a': 'Yes. Fayette County sits east of Memphis and has seen significant suburban growth. We buy homes throughout Fayette County including Somerville, Oakland, and Piperton, and our offers reflect the area\'s connection to the Memphis market.'},
        {'q': 'Do you buy new construction or recently built homes in Fayette County?', 'a': 'We buy homes of all ages in Fayette County, including newer construction. If you need to sell quickly for any reason, we provide cash offers on homes regardless of when they were built.'},
    ],
    'fentress': [
        {'q': 'Do you buy properties near Big South Fork in Fentress County?', 'a': 'Yes. Fentress County borders the Big South Fork National River and Recreation Area. We buy homes, cabins, and properties throughout the county including Jamestown and surrounding communities.'},
        {'q': 'Can I sell a remote or off-grid property in Fentress County?', 'a': 'We buy remote and off-grid properties in Fentress County. Gravel road access, well water, or lack of utilities do not prevent us from making you a fair cash offer.'},
    ],
    'franklin': [
        {'q': 'Do you buy homes in Winchester or Cowan in Franklin County?', 'a': 'Yes. We buy homes throughout Franklin County including Winchester, Cowan, Decherd, and Huntland. All property conditions and types are welcome.'},
        {'q': 'Can I sell a property in Franklin County near Tims Ford Lake?', 'a': 'Absolutely. Tims Ford Lake properties in Franklin County are among those we purchase. Whether it is a lakefront home or a property nearby, we will make you a cash offer.'},
    ],
    'gibson': [
        {'q': 'Do you buy homes in Trenton, Humboldt, or Milan in Gibson County?', 'a': 'Yes. We purchase homes throughout Gibson County including Trenton, Humboldt, Milan, Medina, and all surrounding communities. We are familiar with the local market and provide fair offers.'},
        {'q': 'Can I sell a home in Gibson County that needs a new roof?', 'a': 'Absolutely. We buy homes in Gibson County as-is, including those needing major repairs like a new roof. You do not need to spend money on repairs before selling to us.'},
    ],
    'giles': [
        {'q': 'Do you buy homes in Pulaski or other towns in Giles County?', 'a': 'Yes. We buy homes throughout Giles County including Pulaski, Lynnville, Elkton, and Minor Hill. Town or country, we purchase properties in any condition.'},
        {'q': 'Can I sell a historic home in Giles County?', 'a': 'We buy historic homes in Giles County regardless of the restoration work they may need. You do not need to worry about historic preservation requirements when selling to us.'},
    ],
    'grainger': [
        {'q': 'Do you buy properties near Cherokee Lake in Grainger County?', 'a': 'Yes. Grainger County borders Cherokee Lake and we buy homes and lake properties throughout the county including Rutledge, Bean Station, and Washburn.'},
        {'q': 'Can I sell a property in Grainger County that has title issues?', 'a': 'We buy properties in Grainger County even when there are title complications. Our team works with title companies to resolve issues as part of the closing process.'},
    ],
    'greene': [
        {'q': 'Do you buy homes in Greeneville or Tusculum in Greene County?', 'a': 'Yes. We purchase homes throughout Greene County including Greeneville, Tusculum, Mosheim, and all surrounding areas. Whether historic downtown or rural, we buy in any condition.'},
        {'q': 'Can I sell a tobacco farm or agricultural property in Greene County?', 'a': 'Greene County has a rich agricultural history and we buy all types of properties including former farms, homes with acreage, and agricultural land. We handle the details.'},
    ],
    'grundy': [
        {'q': 'Do you buy homes on the Cumberland Plateau in Grundy County?', 'a': 'Yes. Grundy County sits atop the Cumberland Plateau and we buy properties throughout the county including Tracy City, Altamont, Coalmont, and Palmer. Mountain properties are no problem.'},
        {'q': 'Can I sell a property in Grundy County if the local market is slow?', 'a': 'Grundy County\'s traditional market can be slow due to its rural nature. We buy directly for cash regardless of local market conditions, giving you a fast and certain sale.'},
    ],
    'hamblen': [
        {'q': 'Do you buy homes in Morristown in Hamblen County?', 'a': 'Yes. Morristown is the county seat and we actively buy homes throughout Morristown and all of Hamblen County. Whether near the lakefront or in a residential neighborhood, we purchase all types of properties.'},
        {'q': 'Can I sell a duplex or multi-family property in Hamblen County?', 'a': 'We buy duplexes, triplexes, and multi-family properties in Hamblen County. Whether occupied or vacant, we will evaluate the property and make you a cash offer.'},
    ],
    'hamilton': [
        {'q': 'How does Chattanooga\'s growing market affect cash offers in Hamilton County?', 'a': 'Chattanooga and Hamilton County are experiencing significant growth and development. Our cash offers reflect current market conditions in the area. Selling to us lets you skip the competitive listing process while still receiving a fair price.'},
        {'q': 'Do you buy homes on Lookout Mountain or Signal Mountain in Hamilton County?', 'a': 'Yes. We buy homes in all Hamilton County neighborhoods including Lookout Mountain, Signal Mountain, Red Bank, East Brainerd, and downtown Chattanooga. Location and condition do not matter.'},
    ],
    'hancock': [
        {'q': 'Do you buy homes in Sneedville or rural areas of Hancock County?', 'a': 'Yes. Hancock County is one of Tennessee\'s most rural counties and we buy properties throughout including Sneedville. Distance from a major city does not affect our ability to purchase your home.'},
        {'q': 'Can I sell a property in Hancock County if I cannot afford to maintain it?', 'a': 'Many homeowners in Hancock County sell to us because maintaining a property has become too costly. We buy homes as-is so you can walk away without spending another dollar on upkeep.'},
    ],
    'hardeman': [
        {'q': 'Do you buy homes in Bolivar or surrounding areas in Hardeman County?', 'a': 'Yes. We buy homes throughout Hardeman County including Bolivar, Middleton, Grand Junction, and all rural areas. We are experienced with properties in this part of West Tennessee.'},
        {'q': 'Can I sell a property in Hardeman County that has been in my family for generations?', 'a': 'We regularly work with families in Hardeman County who have inherited multi-generational properties. We make the selling process simple and respectful of your family\'s legacy.'},
    ],
    'hardin': [
        {'q': 'Do you buy properties near Pickwick Lake or Shiloh in Hardin County?', 'a': 'Yes. Hardin County is home to Pickwick Lake and the Shiloh National Military Park. We buy homes, lake properties, and residential land throughout the county including Savannah and Counce.'},
        {'q': 'Can I sell a seasonal or vacation home in Hardin County?', 'a': 'We buy seasonal and vacation homes in Hardin County. Whether your lake house or cabin is used part-time or has been sitting empty, we will make you a cash offer.'},
    ],
    'hawkins': [
        {'q': 'Do you buy homes in Rogersville or Church Hill in Hawkins County?', 'a': 'Yes. We purchase homes throughout Hawkins County including Rogersville, Church Hill, Mount Carmel, Surgoinsville, and all surrounding areas.'},
        {'q': 'Can I sell a home in Hawkins County that has been damaged by water or mold?', 'a': 'We buy homes in Hawkins County with water damage, mold issues, or any other condition. No repairs or remediation are needed on your part before selling to us.'},
    ],
    'haywood': [
        {'q': 'Do you buy homes in Brownsville or Stanton in Haywood County?', 'a': 'Yes. We purchase homes throughout Haywood County including Brownsville and Stanton. We buy in any condition and close quickly for cash.'},
        {'q': 'Can I sell agricultural land or a farm property in Haywood County?', 'a': 'Haywood County is largely agricultural and we buy farmland, homes on acreage, and all types of rural properties. We handle the details and close on your schedule.'},
    ],
    'henderson': [
        {'q': 'Do you buy homes in Lexington or other towns in Henderson County?', 'a': 'Yes. We buy homes throughout Henderson County including Lexington, Sardis, Scotts Hill, and Parker\'s Crossroads. All property types and conditions are welcome.'},
        {'q': 'Can I sell a home in Henderson County without a real estate agent?', 'a': 'That is exactly what we offer. When you sell to Tennessee Cash For Homes in Henderson County, there is no agent involved. You deal directly with us, saving you thousands in commissions.'},
    ],
    'henry': [
        {'q': 'Do you buy homes or lake properties near Paris Landing in Henry County?', 'a': 'Yes. Henry County is home to Kentucky Lake and Paris Landing State Park. We buy lakefront homes, cabins, and all residential properties throughout Henry County including Paris.'},
        {'q': 'Can I sell a property in Henry County if it has a lien on it?', 'a': 'We buy properties in Henry County with liens, judgments, or other encumbrances. Our team works with the title company to resolve these issues at closing.'},
    ],
    'hickman': [
        {'q': 'Do you buy rural homes on acreage in Hickman County?', 'a': 'Yes. Hickman County is one of Middle Tennessee\'s most rural counties and we regularly buy homes on large lots and acreage. Properties in Centerville, Lyles, and all unincorporated areas are welcome.'},
        {'q': 'Can I sell a property in Hickman County if the road access is poor?', 'a': 'We buy properties in Hickman County regardless of road conditions, access issues, or remote locations. Our team evaluates every property on its own merits.'},
    ],
    'houston': [
        {'q': 'Is it hard to find buyers for homes in a small county like Houston County?', 'a': 'Houston County is Tennessee\'s smallest county by population, which can make traditional home sales challenging. We buy homes directly for cash in Erin and throughout Houston County, giving you a guaranteed sale without waiting for a buyer.'},
        {'q': 'Do you buy homes along the Cumberland River in Houston County?', 'a': 'Yes. We buy properties throughout Houston County including those along the Cumberland River. Riverfront homes and rural properties are all ones we purchase.'},
    ],
    'humphreys': [
        {'q': 'Do you buy homes in Waverly or New Johnsonville in Humphreys County?', 'a': 'Yes. We buy homes throughout Humphreys County including Waverly, New Johnsonville, and McEwen. We are familiar with the area and provide fair cash offers.'},
        {'q': 'Can I sell a flood-damaged home in Humphreys County?', 'a': 'Humphreys County experienced devastating flooding in recent years. We buy flood-damaged homes as-is in Waverly and throughout the county. You do not need to make any repairs.'},
    ],
    'jackson': [
        {'q': 'Do you buy homes in Gainesboro or rural Jackson County?', 'a': 'Yes. We buy homes throughout Jackson County including Gainesboro and all surrounding rural areas. Low population density does not affect our interest in purchasing your property.'},
        {'q': 'Can I sell a property in Jackson County near Cordell Hull Lake?', 'a': 'Absolutely. Jackson County borders Cordell Hull Lake and we buy lake area properties, homes, and land throughout the county.'},
    ],
    'jefferson': [
        {'q': 'Do you buy homes in Dandridge or Jefferson City in Jefferson County?', 'a': 'Yes. We purchase homes throughout Jefferson County including Dandridge, Jefferson City, White Pine, and New Market. All conditions are welcome.'},
        {'q': 'Can I sell a home in Jefferson County near Douglas Lake?', 'a': 'We buy homes and lake properties near Douglas Lake in Jefferson County. Whether it is a full-time residence or a vacation property, we will make you a cash offer.'},
    ],
    'johnson': [
        {'q': 'Do you buy homes in Mountain City or Appalachian areas of Johnson County?', 'a': 'Yes. Johnson County is in Tennessee\'s far northeast corner and we buy homes throughout including Mountain City. Mountain properties, rural homes, and small-town residences are all welcome.'},
        {'q': 'Can I sell a cabin or mountain property in Johnson County?', 'a': 'We buy cabins, mountain homes, and all types of residential properties in Johnson County. Whether your property is on a mountainside or in a valley, we are interested.'},
    ],
    'knox': [
        {'q': 'How does Knoxville\'s real estate market in Knox County affect your offers?', 'a': 'Knox County and Knoxville have a strong and growing real estate market. Our cash offers are based on current market conditions and comparable sales in the area. You get a fair offer without the hassle of listing, staging, and waiting for buyers.'},
        {'q': 'Do you buy homes near the University of Tennessee in Knox County?', 'a': 'Yes. We buy homes in all Knoxville neighborhoods including the UT campus area, West Knoxville, South Knoxville, Farragut, and Powell. Student housing, rental properties, and family homes are all welcome.'},
    ],
    'lake': [
        {'q': 'Is it possible to sell a home quickly in a rural county like Lake County?', 'a': 'Lake County is Tennessee\'s least populated county, which makes traditional sales very difficult. We buy homes in Tiptonville and throughout Lake County for cash, giving you a guaranteed sale without the uncertainty of waiting for a local buyer.'},
        {'q': 'Do you buy properties near Reelfoot Lake in Lake County?', 'a': 'Yes. Reelfoot Lake is Lake County\'s biggest draw and we buy homes, cabins, and properties throughout the Reelfoot Lake area. All conditions are welcome.'},
    ],
    'lauderdale': [
        {'q': 'Do you buy homes in Ripley or Halls in Lauderdale County?', 'a': 'Yes. We buy homes throughout Lauderdale County including Ripley, Halls, and surrounding areas. Whether your property is in town or along the Mississippi River bluffs, we are interested.'},
        {'q': 'Can I sell a property in Lauderdale County if it needs major structural work?', 'a': 'We buy homes in Lauderdale County that need major structural repairs including foundation issues, roof replacement, and more. No repair is too big — we buy completely as-is.'},
    ],
    'lawrence': [
        {'q': 'Do you buy homes in Lawrenceburg in Lawrence County?', 'a': 'Yes. Lawrenceburg is the county seat and we actively buy homes throughout Lawrenceburg and all of Lawrence County. We are familiar with the local market and provide competitive cash offers.'},
        {'q': 'Can I sell a property in Lawrence County if I am behind on my mortgage?', 'a': 'We work with homeowners in Lawrence County who are behind on their mortgage or facing foreclosure. We can often close fast enough to help you avoid foreclosure and protect your credit.'},
    ],
    'lewis': [
        {'q': 'Do you buy homes in Hohenwald or rural Lewis County?', 'a': 'Yes. We purchase homes throughout Lewis County including Hohenwald and all surrounding rural areas. Lewis County\'s small market size is not a barrier for us.'},
        {'q': 'Can I sell a property in Lewis County near the Meriwether Lewis Monument?', 'a': 'We buy homes and properties throughout Lewis County including areas near the Natchez Trace Parkway and Meriwether Lewis Monument. Location within the county does not matter.'},
    ],
    'lincoln': [
        {'q': 'Do you buy homes in Fayetteville or other towns in Lincoln County?', 'a': 'Yes. We buy homes throughout Lincoln County including Fayetteville, Petersburg, and Flintville. All property types and conditions are welcome.'},
        {'q': 'Can I sell a home in Lincoln County that is on a large rural lot?', 'a': 'Absolutely. Many Lincoln County properties sit on several acres. We buy homes on large lots and do not require you to subdivide or survey the property before selling.'},
    ],
    'loudon': [
        {'q': 'Do you buy homes near Tellico Lake or Fort Loudoun Lake in Loudon County?', 'a': 'Yes. Loudon County has extensive lakefront along Tellico Lake and Fort Loudoun Lake. We buy lake homes, retirement properties, and all residential properties in Loudon, Lenoir City, and Greenback.'},
        {'q': 'Can I sell a retirement home in Tellico Village in Loudon County?', 'a': 'We buy homes in Tellico Village and other Loudon County communities. Whether you are downsizing, relocating, or handling an estate, we make the process simple and fast.'},
    ],
    'macon': [
        {'q': 'Do you buy homes in Lafayette or rural Macon County?', 'a': 'Yes. We buy homes throughout Macon County including Lafayette and all surrounding rural communities. We are experienced with properties in smaller Tennessee markets.'},
        {'q': 'Can I sell a home in Macon County if it has been vacant and neglected?', 'a': 'We buy vacant and neglected homes in Macon County regularly. Even if the property has significant deterioration, we purchase as-is and handle all the cleanup after closing.'},
    ],
    'madison': [
        {'q': 'Do you buy homes in Jackson or the greater Madison County area?', 'a': 'Yes. Jackson is the largest city in West Tennessee and we actively buy homes throughout Madison County. Whether your home is near downtown Jackson or in the surrounding suburbs, we provide fair cash offers.'},
        {'q': 'Can I sell a rental property with problem tenants in Madison County?', 'a': 'We buy rental properties in Madison County regardless of tenant situations. You do not need to evict tenants or wait for leases to end. We handle everything.'},
    ],
    'marion': [
        {'q': 'Do you buy homes in Jasper, Kimball, or South Pittsburg in Marion County?', 'a': 'Yes. We buy homes throughout Marion County including Jasper, Kimball, South Pittsburg, and Whitwell. All property conditions are welcome.'},
        {'q': 'Can I sell a property in Marion County near the Tennessee River Gorge?', 'a': 'We buy properties throughout Marion County including those near the Tennessee River Gorge and Nickajack Lake. Mountain and riverside properties are all ones we purchase.'},
    ],
    'marshall': [
        {'q': 'Do you buy homes in Lewisburg or Chapel Hill in Marshall County?', 'a': 'Yes. We purchase homes throughout Marshall County including Lewisburg, Chapel Hill, Cornersville, and all surrounding areas. We are active buyers in this growing part of Middle Tennessee.'},
        {'q': 'Is Marshall County growing fast enough to sell my home for a good price?', 'a': 'Marshall County has seen growth as Nashville\'s suburbs expand southward. Our cash offers reflect current market trends and the county\'s increasing desirability. You get a fair price without the wait of a traditional listing.'},
    ],
    'maury': [
        {'q': 'How is the real estate market in Columbia and Maury County right now?', 'a': 'Maury County is one of Tennessee\'s fastest-growing counties, driven by major employers and Nashville spillover. Our cash offers reflect this strong market. Selling to us means you can capitalize on the growth without the hassle of listing.'},
        {'q': 'Do you buy homes affected by new development in Maury County?', 'a': 'Yes. Rapid development in Maury County has created unique situations for existing homeowners. Whether your neighborhood is changing or you want to sell ahead of construction, we buy homes in any situation.'},
    ],
    'mcminn': [
        {'q': 'Do you buy homes in Athens or Etowah in McMinn County?', 'a': 'Yes. We purchase homes throughout McMinn County including Athens, Etowah, Niota, and Englewood. All property types and conditions are welcome.'},
        {'q': 'Can I sell a home near the Hiwassee River in McMinn County?', 'a': 'We buy properties throughout McMinn County including those near the Hiwassee River. Whether your home is riverside or in town, we will make you a cash offer.'},
    ],
    'mcnairy': [
        {'q': 'Do you buy homes in Selmer or Adamsville in McNairy County?', 'a': 'Yes. We buy homes throughout McNairy County including Selmer, Adamsville, and Michie. We are experienced with properties in this part of Southwest Tennessee.'},
        {'q': 'Can I sell a property in McNairy County that is in a remote location?', 'a': 'We buy properties in remote areas of McNairy County. Gravel roads, long driveways, and distance from town do not prevent us from making you an offer.'},
    ],
    'meigs': [
        {'q': 'Do you buy properties near Watts Bar Lake in Meigs County?', 'a': 'Yes. Meigs County borders Watts Bar Lake and we buy homes, lake properties, and land throughout the county including Decatur and Ten Mile.'},
        {'q': 'Is it hard to sell a home in a small county like Meigs County?', 'a': 'Traditional home sales in Meigs County can be slow due to limited buyer activity. We eliminate that challenge by buying your home directly for cash with a quick, certain closing.'},
    ],
    'monroe': [
        {'q': 'Do you buy homes in Madisonville, Sweetwater, or Tellico Plains in Monroe County?', 'a': 'Yes. We buy homes throughout Monroe County including Madisonville, Sweetwater, Tellico Plains, and Vonore. All property types and conditions are welcome.'},
        {'q': 'Can I sell a mountain property or cabin in Monroe County?', 'a': 'Monroe County borders the Cherokee National Forest and we buy mountain cabins, homes, and properties throughout the county. Remote or hard-to-access properties are fine.'},
    ],
    'montgomery': [
        {'q': 'Do you buy homes near Fort Campbell in Montgomery County?', 'a': 'Yes. Montgomery County is home to Fort Campbell and we regularly work with military families who need to sell quickly. We buy homes in Clarksville and throughout the county and can close fast to match your PCS timeline.'},
        {'q': 'Is Clarksville\'s rapid growth in Montgomery County good for sellers?', 'a': 'Clarksville is one of Tennessee\'s fastest-growing cities, which means strong property values. Our cash offers reflect Montgomery County\'s growth. You can take advantage of the market without the delays of a traditional sale.'},
    ],
    'moore': [
        {'q': 'Do you buy homes in Lynchburg or rural Moore County?', 'a': 'Yes. Moore County is Tennessee\'s smallest county and we buy homes in Lynchburg and throughout the county. Small market size does not affect our ability to make you a fair cash offer.'},
        {'q': 'Can I sell a property in Moore County near the Jack Daniel\'s Distillery?', 'a': 'We buy properties throughout Moore County including Lynchburg. Whether your home is near the famous distillery or in the surrounding countryside, we are interested.'},
    ],
    'morgan': [
        {'q': 'Do you buy homes in Wartburg or Sunbright in Morgan County?', 'a': 'Yes. We buy homes throughout Morgan County including Wartburg, Sunbright, Oakdale, and Deer Lodge. All property types and conditions are welcome.'},
        {'q': 'Can I sell a home in Morgan County if the property has no city utilities?', 'a': 'We buy homes in Morgan County with well water, septic systems, and no city utility access. Off-grid and rural properties are no problem for our team.'},
    ],
    'obion': [
        {'q': 'Do you buy homes in Union City or South Fulton in Obion County?', 'a': 'Yes. We buy homes throughout Obion County including Union City, South Fulton, and surrounding communities in Northwest Tennessee.'},
        {'q': 'Can I sell a farm or agricultural property in Obion County?', 'a': 'Obion County has a strong farming heritage and we buy all types of properties including farm homes, houses on agricultural land, and rural residential properties.'},
    ],
    'overton': [
        {'q': 'Do you buy homes in Livingston or Hilham in Overton County?', 'a': 'Yes. We buy homes throughout Overton County including Livingston, Hilham, and all surrounding communities. Rural properties and in-town homes are equally welcome.'},
        {'q': 'Can I sell a property in Overton County near Standing Stone State Park?', 'a': 'We buy properties throughout Overton County including areas near Standing Stone State Park and Dale Hollow Lake. We purchase homes in any condition.'},
    ],
    'perry': [
        {'q': 'Do you buy homes in Linden or rural Perry County?', 'a': 'Yes. Perry County is one of Tennessee\'s more rural and less populated counties. We buy homes in Linden and throughout Perry County regardless of the challenges that come with a smaller market.'},
        {'q': 'Can I sell a property along the Buffalo River in Perry County?', 'a': 'We buy properties along the Buffalo River and throughout Perry County. Whether it is a home, cabin, or vacant land, we will evaluate the property and make you a cash offer.'},
    ],
    'pickett': [
        {'q': 'Is it possible to sell a home quickly in Tennessee\'s smallest counties like Pickett County?', 'a': 'Pickett County has a very small population, which makes traditional home sales extremely difficult. We buy homes directly for cash in Byrdstown and throughout Pickett County, eliminating the need to wait months or years for a buyer.'},
        {'q': 'Do you buy properties near Dale Hollow Lake in Pickett County?', 'a': 'Yes. Dale Hollow Lake is Pickett County\'s biggest attraction. We buy lakefront homes, cabins, and all types of properties in the Dale Hollow area.'},
    ],
    'polk': [
        {'q': 'Do you buy homes in Benton, Copperhill, or Ducktown in Polk County?', 'a': 'Yes. We buy homes throughout Polk County including Benton, Copperhill, and Ducktown. Mountain properties and homes near the Ocoee River are all ones we purchase.'},
        {'q': 'Can I sell a cabin or vacation property in Polk County?', 'a': 'We buy cabins and vacation properties in Polk County. The Ocoee River and Cherokee National Forest make this area popular for second homes, and we purchase them in any condition.'},
    ],
    'putnam': [
        {'q': 'Do you buy homes in Cookeville or near Tennessee Tech in Putnam County?', 'a': 'Yes. We purchase homes throughout Putnam County including Cookeville, Baxter, Algood, and Monterey. Properties near Tennessee Tech, student housing, and family homes are all welcome.'},
        {'q': 'Can I sell a property in Putnam County that was damaged by severe weather?', 'a': 'Putnam County has experienced severe tornado and storm events. We buy weather-damaged homes as-is with no repairs needed. We can close quickly so you can move forward.'},
    ],
    'rhea': [
        {'q': 'Do you buy homes in Dayton or Spring City in Rhea County?', 'a': 'Yes. We buy homes throughout Rhea County including Dayton, Spring City, and Graysville. Lake properties near Watts Bar and Chickamauga Lake are also welcome.'},
        {'q': 'Can I sell a home in Rhea County near the lake?', 'a': 'Rhea County has extensive lake frontage and we buy lakefront homes, nearby residences, and all property types throughout the county. Condition does not matter.'},
    ],
    'roane': [
        {'q': 'Do you buy homes in Harriman, Kingston, or Rockwood in Roane County?', 'a': 'Yes. We purchase homes throughout Roane County including Harriman, Kingston, Rockwood, and Oliver Springs. We buy in all conditions and close quickly.'},
        {'q': 'Can I sell a property in Roane County near Watts Bar Lake?', 'a': 'We buy properties near Watts Bar Lake and throughout Roane County. Whether your home is lakefront, in a subdivision, or on rural land, we will make you a fair cash offer.'},
    ],
    'robertson': [
        {'q': 'Is Robertson County part of the Nashville market for home values?', 'a': 'Yes. Robertson County is part of the Nashville metropolitan area and has seen significant growth. Our cash offers reflect Nashville-area market conditions for Springfield, Greenbrier, White House, and all of Robertson County.'},
        {'q': 'Do you buy homes affected by Robertson County\'s agricultural zoning?', 'a': 'We buy properties in Robertson County regardless of zoning, including agricultural-zoned parcels with homes. We handle any zoning complexities as part of the purchase process.'},
    ],
    'rutherford': [
        {'q': 'How does Murfreesboro\'s fast growth in Rutherford County affect your offers?', 'a': 'Rutherford County is Tennessee\'s fastest-growing county and Murfreesboro is now one of the state\'s largest cities. Our cash offers reflect this strong market demand. You get a competitive price without the lengthy listing process.'},
        {'q': 'Do you buy homes near MTSU or in new Murfreesboro developments?', 'a': 'Yes. We buy homes throughout Rutherford County including near Middle Tennessee State University, in Smyrna, La Vergne, Eagleville, and all new and established neighborhoods.'},
    ],
    'scott': [
        {'q': 'Do you buy homes in Oneida or Huntsville in Scott County?', 'a': 'Yes. We buy homes throughout Scott County including Oneida, Huntsville, and Winfield. We are experienced with properties in the Cumberland Plateau region.'},
        {'q': 'Can I sell a property in Scott County near the Big South Fork?', 'a': 'We buy properties near the Big South Fork and throughout Scott County. Mountain homes, cabins, and rural residential properties are all welcome.'},
    ],
    'sequatchie': [
        {'q': 'Do you buy homes in Dunlap or the Sequatchie Valley?', 'a': 'Yes. We buy homes throughout Sequatchie County including Dunlap and the beautiful Sequatchie Valley. Mountain and valley properties are welcome in any condition.'},
        {'q': 'Can I sell a home in Sequatchie County if the market is slow?', 'a': 'The traditional market in Sequatchie County can be slower than metro areas. We buy directly for cash regardless of market conditions, giving you a fast, guaranteed sale.'},
    ],
    'sevier': [
        {'q': 'Do you buy vacation rental properties or cabins in Sevier County?', 'a': 'Yes. Sevier County is Tennessee\'s tourism capital, home to Gatlinburg, Pigeon Forge, and Sevierville. We buy vacation rentals, cabins, short-term rental properties, and all residential properties throughout the county.'},
        {'q': 'Can I sell a Sevier County cabin that is underperforming as a rental?', 'a': 'We buy cabins in Sevier County regardless of rental performance. If your vacation rental is not generating the income you expected, we will purchase it for cash and handle everything.'},
    ],
    'shelby': [
        {'q': 'How does Memphis\'s real estate market in Shelby County affect your offers?', 'a': 'Shelby County and Memphis have a diverse real estate market with significant variation by neighborhood. Our offers are based on comparable sales and current conditions specific to your property\'s location. We provide fair offers across all Memphis neighborhoods.'},
        {'q': 'Do you buy homes in distressed neighborhoods in Shelby County?', 'a': 'Yes. We buy homes throughout all of Shelby County including neighborhoods that other buyers avoid. Whether your property is in Midtown, South Memphis, Whitehaven, Cordova, or anywhere else, we will make you an offer.'},
    ],
    'smith': [
        {'q': 'Do you buy homes in Carthage or South Carthage in Smith County?', 'a': 'Yes. We buy homes throughout Smith County including Carthage, South Carthage, Gordonsville, and all surrounding areas. We buy in any condition.'},
        {'q': 'Can I sell a property on the Cumberland River in Smith County?', 'a': 'We buy properties along the Cumberland River and throughout Smith County. Riverfront homes, rural properties, and in-town residences are all welcome.'},
    ],
    'stewart': [
        {'q': 'Do you buy properties near Land Between the Lakes in Stewart County?', 'a': 'Yes. Stewart County borders the Land Between the Lakes National Recreation Area and we buy homes, cabins, and properties throughout the county including Dover and Indian Mound.'},
        {'q': 'Can I sell a seasonal property or hunting cabin in Stewart County?', 'a': 'We buy seasonal homes, hunting cabins, and recreational properties in Stewart County. Whether used part-time or fully vacant, we will make you a cash offer.'},
    ],
    'sullivan': [
        {'q': 'Do you buy homes in Kingsport, Bristol, or Bluff City in Sullivan County?', 'a': 'Yes. We buy homes throughout Sullivan County including Kingsport, Bristol, and Bluff City. Whether your home is in the Tri-Cities metro or a rural area, we purchase all types and conditions.'},
        {'q': 'Can I sell a property in Sullivan County if it is near an industrial area?', 'a': 'We buy properties in Sullivan County regardless of proximity to industrial zones. Location does not deter us from making a fair cash offer on your home.'},
    ],
    'sumner': [
        {'q': 'Is Sumner County considered part of the Nashville metro for home values?', 'a': 'Yes. Sumner County is one of Nashville\'s most desirable suburban counties. Our cash offers for Gallatin, Hendersonville, and surrounding areas reflect strong Nashville-area market values.'},
        {'q': 'Do you buy lakefront homes on Old Hickory Lake in Sumner County?', 'a': 'We buy lakefront properties on Old Hickory Lake and throughout Sumner County. Whether your home needs dock repairs, has an aging seawall, or is in perfect condition, we are interested.'},
    ],
    'tipton': [
        {'q': 'Do you buy homes in Covington, Munford, or Atoka in Tipton County?', 'a': 'Yes. We buy homes throughout Tipton County including Covington, Munford, Atoka, Brighton, and Mason. We are active in the Memphis suburban market.'},
        {'q': 'Is Tipton County growing enough to support strong home values?', 'a': 'Tipton County has benefited from Memphis suburban growth, particularly in Atoka and Munford. Our cash offers reflect the area\'s strong and increasing demand.'},
    ],
    'trousdale': [
        {'q': 'Do you buy homes in Hartsville or rural Trousdale County?', 'a': 'Yes. Trousdale County is Tennessee\'s smallest county by area but we buy homes throughout including Hartsville. Small county size does not affect our ability to make fair cash offers.'},
        {'q': 'Is Trousdale County close enough to Nashville for good property values?', 'a': 'Trousdale County is within commuting distance of Nashville and has seen increasing interest from Nashville-area buyers. Our offers reflect this growing connection to the metro area.'},
    ],
    'unicoi': [
        {'q': 'Do you buy homes in Erwin or near the Appalachian Trail in Unicoi County?', 'a': 'Yes. We buy homes throughout Unicoi County including Erwin and areas near the Appalachian Trail and Unaka Mountains. Mountain properties in any condition are welcome.'},
        {'q': 'Can I sell a home in Unicoi County after a natural disaster or landslide?', 'a': 'Unicoi County\'s mountain terrain can make properties vulnerable to flooding and landslides. We buy damaged properties as-is and handle all the complications so you do not have to.'},
    ],
    'union': [
        {'q': 'Do you buy homes in Maynardville or Luttrell in Union County?', 'a': 'Yes. We buy homes throughout Union County including Maynardville and Luttrell. Rural properties and homes near Norris Lake are all ones we purchase.'},
        {'q': 'Can I sell a property near Norris Lake in Union County?', 'a': 'We buy properties near Norris Lake and throughout Union County. Lake homes, cabins, and residential properties in any condition are welcome.'},
    ],
    'van-buren': [
        {'q': 'Do you buy homes in Spencer or rural Van Buren County?', 'a': 'Yes. Van Buren County is one of Tennessee\'s least populated counties and we buy homes in Spencer and throughout the county. We specialize in helping homeowners who struggle to sell in small markets.'},
        {'q': 'Can I sell a property near Fall Creek Falls in Van Buren County?', 'a': 'We buy properties near Fall Creek Falls State Park and throughout Van Buren County. Whether it is a home, cabin, or rural property, we will make you a cash offer.'},
    ],
    'warren': [
        {'q': 'Do you buy homes in McMinnville or Morrison in Warren County?', 'a': 'Yes. We purchase homes throughout Warren County including McMinnville, Morrison, and Viola. We are familiar with the local nursery and agriculture community and buy all property types.'},
        {'q': 'Can I sell a property in Warren County that is near the nursery district?', 'a': 'Warren County is known as the Nursery Capital of the World and we buy all types of properties in the area including homes near nursery operations, farms, and residential properties.'},
    ],
    'washington': [
        {'q': 'Do you buy homes in Johnson City or Jonesborough in Washington County?', 'a': 'Yes. We buy homes throughout Washington County including Johnson City, Jonesborough (Tennessee\'s oldest town), and all surrounding areas. We are active in the Tri-Cities market.'},
        {'q': 'Can I sell a historic home in Jonesborough in Washington County?', 'a': 'We buy historic homes in Jonesborough and throughout Washington County. You do not need to worry about restoration costs or historic district regulations when selling to us.'},
    ],
    'wayne': [
        {'q': 'Do you buy homes in Waynesboro or Clifton in Wayne County?', 'a': 'Yes. We buy homes throughout Wayne County including Waynesboro, Clifton, and all surrounding communities along the Tennessee River. Rural and remote properties are welcome.'},
        {'q': 'Can I sell a hunting property or cabin in Wayne County?', 'a': 'We buy hunting properties, cabins, and recreational land in Wayne County. Whether it is a seasonal cabin or a year-round home, we will make you a cash offer.'},
    ],
    'weakley': [
        {'q': 'Do you buy homes in Martin, Dresden, or Greenfield in Weakley County?', 'a': 'Yes. We purchase homes throughout Weakley County including Martin (home of UT Martin), Dresden, and Greenfield. Student housing and family homes are all welcome.'},
        {'q': 'Can I sell a property near UT Martin in Weakley County?', 'a': 'We buy properties near the University of Tennessee at Martin campus and throughout Weakley County. Investment properties, rentals, and owner-occupied homes are all ones we purchase.'},
    ],
    'white': [
        {'q': 'Do you buy homes in Sparta or Doyle in White County?', 'a': 'Yes. We buy homes throughout White County including Sparta, Doyle, and all surrounding communities. We are familiar with the Cumberland Plateau market.'},
        {'q': 'Can I sell a property in White County near Burgess Falls or the Calfkiller River?', 'a': 'We buy properties throughout White County including those near Burgess Falls State Park and along the Calfkiller River. Location and condition do not matter.'},
    ],
    'williamson': [
        {'q': 'Is now a good time to sell my Williamson County home given the market growth?', 'a': 'Williamson County is one of Tennessee\'s most expensive and fastest-growing counties. Property values in Franklin, Brentwood, and Spring Hill remain strong. Selling to us for cash means you can take advantage of current values without months of showings and negotiations.'},
        {'q': 'Do you buy luxury or high-value homes in Williamson County?', 'a': 'Yes. We buy homes at all price points in Williamson County, including higher-value properties in Franklin and Brentwood. Our cash offers are competitive and reflect the premium market in this area.'},
    ],
    'wilson': [
        {'q': 'Is Wilson County part of the Nashville metro for property values?', 'a': 'Yes. Wilson County — including Lebanon, Mt. Juliet, and Watertown — is one of Nashville\'s fastest-growing suburban counties. Our cash offers reflect strong Nashville-area demand and current market conditions.'},
        {'q': 'Do you buy homes in Mt. Juliet or Providence in Wilson County?', 'a': 'We buy homes throughout Wilson County including Mt. Juliet, Lebanon, Watertown, and the Providence master-planned community. New construction and older homes are all welcome.'},
    ],
}

# ── UNIQUE FAQ DATA FOR ALL 22 CITY PAGES ──
CITY_FAQS = {
    'antioch': [
        {'q': 'Is Antioch a good area to sell a house for cash right now?', 'a': 'Antioch is one of Nashville\'s most diverse and rapidly developing suburbs with strong buyer demand. Our cash offers reflect Antioch\'s growing market. You can sell quickly without waiting for the right traditional buyer.'},
        {'q': 'Do you buy investment or rental properties in Antioch?', 'a': 'Yes. Antioch has a large rental market and we buy investment properties, duplexes, and single-family rentals whether they are occupied or vacant.'},
    ],
    'chapel-hill': [
        {'q': 'Is Chapel Hill too small to get a good cash offer on my home?', 'a': 'Not at all. Chapel Hill may be a small town, but its location between Nashville and Huntsville gives it growing value. Our cash offers reflect the area\'s potential and current market conditions.'},
        {'q': 'Do you buy homes on large lots or acreage in Chapel Hill?', 'a': 'Yes. Many Chapel Hill properties sit on large lots or acreage. We buy homes on any size lot and do not require subdivision or survey before closing.'},
    ],
    'chattanooga': [
        {'q': 'How does Chattanooga\'s revitalized downtown affect cash offers on my home?', 'a': 'Chattanooga\'s downtown revitalization and growing tech sector have strengthened property values across the city. Our cash offers reflect the current Chattanooga market, and selling to us means you avoid the competitive listing process.'},
        {'q': 'Do you buy homes in all Chattanooga neighborhoods including North Shore and East Brainerd?', 'a': 'Yes. We buy homes in every Chattanooga neighborhood — North Shore, Southside, East Brainerd, Red Bank, Hixson, Ooltewah, and everywhere in between. Condition does not matter.'},
    ],
    'clarksville': [
        {'q': 'Do you work with military families selling homes in Clarksville?', 'a': 'Yes. Clarksville is home to Fort Campbell and we regularly help military families who need to sell quickly due to PCS orders or deployment. We can close on a timeline that matches your military schedule.'},
        {'q': 'Is Clarksville\'s rapid growth good for sellers looking for cash offers?', 'a': 'Clarksville is one of Tennessee\'s fastest-growing cities, which means strong property values. Our cash offers reflect this growth. You get a competitive price without waiting months for a traditional sale.'},
    ],
    'columbia': [
        {'q': 'How is Columbia\'s real estate market given the growth from Nashville?', 'a': 'Columbia has experienced significant growth as Nashville\'s influence extends south along the I-65 corridor. Major employers and new development have boosted property values. Our cash offers reflect Columbia\'s strong and growing market.'},
        {'q': 'Do you buy homes near the Columbia downtown square?', 'a': 'Yes. We buy homes throughout Columbia including near the historic downtown square, in established neighborhoods, and in newer developments. All conditions are welcome.'},
    ],
    'crossville': [
        {'q': 'Do you buy retirement homes or properties in Crossville golf communities?', 'a': 'Yes. Crossville is a popular retirement destination and we buy homes in Fairfield Glade, Lake Tansi, and other planned communities. HOA properties, golf course homes, and standard residences are all welcome.'},
        {'q': 'Can I sell a home in Crossville if I am downsizing or moving to assisted living?', 'a': 'We frequently help Crossville homeowners who are downsizing or transitioning to assisted living. We handle everything so you can focus on your next chapter.'},
    ],
    'franklin': [
        {'q': 'Does Franklin\'s premium real estate market mean higher cash offers?', 'a': 'Franklin is one of Tennessee\'s most desirable and expensive markets. Our cash offers reflect Franklin\'s premium property values. You get a competitive offer without the months-long process of staging, listing, and negotiating.'},
        {'q': 'Do you buy historic homes in downtown Franklin?', 'a': 'Yes. We buy homes in all Franklin neighborhoods including historic downtown, Westhaven, Berry Farms, and surrounding areas. Historic homes that need restoration work are no problem.'},
    ],
    'gallatin': [
        {'q': 'Is Gallatin considered part of the Nashville market for home prices?', 'a': 'Yes. Gallatin is a key suburb in the Nashville metro with strong property values driven by lakeside living and proximity to Nashville. Our cash offers reflect Gallatin\'s position in this growing market.'},
        {'q': 'Do you buy lakefront homes on Old Hickory Lake in Gallatin?', 'a': 'Yes. We buy lakefront properties on Old Hickory Lake in and around Gallatin. Whether your lake home needs work or is in great condition, we will make you a cash offer.'},
    ],
    'hendersonville': [
        {'q': 'How does Hendersonville\'s lakeside location affect your cash offers?', 'a': 'Hendersonville sits on Old Hickory Lake and is one of Nashville\'s most desirable suburbs. Our offers reflect the premium that lakeside living and strong schools bring to Hendersonville property values.'},
        {'q': 'Do you buy homes in all Hendersonville neighborhoods?', 'a': 'Yes. We buy homes throughout Hendersonville including Indian Lake, Walton Ferry, Saundersville, and all lakefront and interior neighborhoods. Every condition is welcome.'},
    ],
    'jackson': [
        {'q': 'Do you buy homes in all Jackson neighborhoods including North and South Jackson?', 'a': 'Yes. We buy homes in every Jackson neighborhood — North Jackson, South Jackson, near the university, downtown, and all surrounding areas. We do not avoid any neighborhoods.'},
        {'q': 'Can I sell a property in Jackson if it has foundation or structural issues?', 'a': 'Absolutely. We buy homes in Jackson with foundation problems, structural damage, and any other major issues. No repairs are needed, and our offer reflects the property\'s as-is value.'},
    ],
    'knoxville': [
        {'q': 'How does Knoxville\'s real estate market compare for cash home sales?', 'a': 'Knoxville has a strong and growing real estate market with rising property values across most neighborhoods. Our cash offers reflect current Knoxville market conditions. You skip the listing hassle while still getting a competitive price.'},
        {'q': 'Do you buy homes near the University of Tennessee or in West Knoxville?', 'a': 'Yes. We buy homes in all Knoxville areas including near UT campus, West Knoxville, South Knoxville, Farragut, and Powell. Student housing, investment properties, and family homes are all welcome.'},
    ],
    'la-vergne': [
        {'q': 'Is La Vergne a good area to sell a home for cash?', 'a': 'La Vergne is centrally located between Nashville and Murfreesboro with easy interstate access. The area\'s affordability and growth make it attractive to buyers. Our cash offers reflect La Vergne\'s strong position in the Nashville metro market.'},
        {'q': 'Do you buy townhomes or condos in La Vergne?', 'a': 'Yes. We buy townhomes, condos, and single-family homes throughout La Vergne. HOA properties and all conditions are welcome.'},
    ],
    'lebanon': [
        {'q': 'Is Lebanon\'s growth from Nashville benefiting home sellers?', 'a': 'Lebanon and Wilson County are among Nashville\'s fastest-growing areas. Major Amazon and other distribution operations have brought jobs and demand. Our cash offers reflect Lebanon\'s strong and increasing property values.'},
        {'q': 'Do you buy homes near the Lebanon outlets or I-40 corridor?', 'a': 'Yes. We buy homes throughout Lebanon including near the outlet mall, along the I-40 corridor, in historic downtown, and in all residential neighborhoods.'},
    ],
    'mcminnville': [
        {'q': 'Do you buy homes near the nursery industry area in McMinnville?', 'a': 'Yes. McMinnville is the Nursery Capital of the World and we buy all types of properties in the area including homes near nursery operations, rural residential properties, and in-town homes.'},
        {'q': 'Can I sell a fixer-upper in McMinnville?', 'a': 'Absolutely. We buy homes in McMinnville in any condition, from minor cosmetic needs to major structural issues. You do not need to invest in repairs before selling to us.'},
    ],
    'memphis': [
        {'q': 'Do you buy homes in all Memphis neighborhoods including South Memphis and Whitehaven?', 'a': 'Yes. We buy homes in every Memphis neighborhood — Midtown, South Memphis, Whitehaven, Cordova, Bartlett, Raleigh, Frayser, and everywhere in between. We do not avoid any area of Memphis.'},
        {'q': 'Can I sell a Memphis rental property with tenants still living in it?', 'a': 'We buy occupied rental properties in Memphis regularly. You do not need to evict tenants or wait for leases to expire. We handle the tenant situation and close on your schedule.'},
    ],
    'murfreesboro': [
        {'q': 'How does Murfreesboro\'s rapid growth affect cash offers on my home?', 'a': 'Murfreesboro is one of Tennessee\'s fastest-growing cities with strong demand driving property values up. Our cash offers reflect this competitive market. You get a fair price without the lengthy listing process.'},
        {'q': 'Do you buy homes near MTSU or in new Murfreesboro subdivisions?', 'a': 'Yes. We buy homes throughout Murfreesboro including near Middle Tennessee State University, in Blackman, along Medical Center Parkway, and in all new and established neighborhoods.'},
    ],
    'nashville': [
        {'q': 'How does Nashville\'s hot real estate market affect your cash offers?', 'a': 'Nashville is one of the hottest real estate markets in the Southeast. Our cash offers reflect current Nashville market conditions and comparable sales. Selling to us means you avoid months of showings and buyer negotiations while getting a competitive price.'},
        {'q': 'Do you buy homes in all Nashville neighborhoods including East Nashville and The Nations?', 'a': 'Yes. We buy homes in every Nashville neighborhood — East Nashville, The Nations, Germantown, Sylvan Park, Madison, Antioch, Donelson, and all surrounding areas. No neighborhood is off limits.'},
    ],
    'old-hickory': [
        {'q': 'Is Old Hickory a good location to sell a home for cash?', 'a': 'Old Hickory sits on Old Hickory Lake and offers easy access to Nashville. The area\'s lakeside appeal and proximity to the city make it a desirable market. Our cash offers reflect Old Hickory\'s unique position.'},
        {'q': 'Do you buy lakefront homes in Old Hickory?', 'a': 'Yes. We buy lakefront and lake-area properties throughout Old Hickory. Whether your home has a dock, needs repairs, or sits on the waterfront, we are interested.'},
    ],
    'shelbyville': [
        {'q': 'Do you buy homes related to the Walking Horse industry in Shelbyville?', 'a': 'Shelbyville is the Walking Horse Capital of the World and we buy all types of properties including horse farms, homes with acreage, and residential properties in the heart of town.'},
        {'q': 'Can I sell a home in Shelbyville if the Bedford County market is slow?', 'a': 'The traditional market in Shelbyville can be slower than Nashville suburbs. That is where we come in — we buy directly for cash with no waiting for buyers, no showings, and no uncertainty.'},
    ],
    'smyrna': [
        {'q': 'Does Smyrna\'s proximity to the Nissan plant affect home values?', 'a': 'Yes. Smyrna\'s economy benefits significantly from the Nissan manufacturing plant and other employers. Strong employment drives housing demand, and our cash offers reflect Smyrna\'s solid market fundamentals.'},
        {'q': 'Do you buy homes in all Smyrna neighborhoods?', 'a': 'Yes. We buy homes throughout Smyrna including near the town center, Sam Ridley Parkway corridor, and all residential neighborhoods. Townhomes, single-family homes, and all conditions are welcome.'},
    ],
    'spring-hill': [
        {'q': 'How does Spring Hill\'s explosive growth affect your cash offers?', 'a': 'Spring Hill is one of Tennessee\'s fastest-growing cities, straddling Williamson and Maury Counties. Rapid development has driven property values significantly higher. Our cash offers reflect this premium market.'},
        {'q': 'Do you buy homes in Spring Hill\'s newer subdivisions?', 'a': 'Yes. We buy homes throughout Spring Hill including in newer master-planned communities, established neighborhoods, and rural areas. Whether your home is brand new or decades old, we are interested.'},
    ],
    'woodbury': [
        {'q': 'Is Woodbury too small to get a fair cash offer on my home?', 'a': 'Not at all. While Woodbury is a small town, its location in Middle Tennessee and growing interest from Nashville commuters give it value. Our cash offers are based on fair market conditions regardless of town size.'},
        {'q': 'Do you buy homes with well water and septic in Woodbury?', 'a': 'Yes. Many Woodbury and Cannon County homes use well water and septic systems. We buy these properties in any condition without requiring inspections or repairs on your part.'},
    ],
}

# ── Injection logic ──
def inject_faq_extra(filepath, faq_data, var_name):
    """Insert faq_extra key into the $county or $city array in a page file."""
    with open(filepath, 'r') as f:
        content = f.read()

    # Check if faq_extra already injected
    if 'faq_extra' in content:
        return 'skipped (already has faq_extra)'

    # Build PHP array string for faq_extra
    php_items = []
    for item in faq_data:
        q = item['q'].replace("'", "\\'")
        a = item['a'].replace("'", "\\'")
        php_items.append(f"        ['q' => '{q}', 'a' => '{a}']")
    php_array = "    'faq_extra'    => [\n" + ",\n".join(php_items) + ",\n    ],\n"

    # Find the closing ]; of the array and insert before it
    # Pattern: find the last ]; before the include statement
    pattern = re.compile(r'(\n\];\s*\n)')
    match = pattern.search(content)
    if not match:
        return 'FAILED (could not find array closing)'

    insert_pos = match.start()
    new_content = content[:insert_pos] + "\n" + php_array + content[insert_pos:]

    with open(filepath, 'w') as f:
        f.write(new_content)

    return 'OK'


def main():
    results = {'ok': 0, 'skipped': 0, 'failed': []}

    # Process county pages
    for slug, faqs in COUNTY_FAQS.items():
        filename = f'page-county-{slug}-county.php'
        filepath = os.path.join(COUNTY_DIR, filename)
        if not os.path.exists(filepath):
            results['failed'].append(f'{filename} (file not found)')
            continue
        status = inject_faq_extra(filepath, faqs, 'county')
        if status == 'OK':
            results['ok'] += 1
        elif 'skipped' in status:
            results['skipped'] += 1
        else:
            results['failed'].append(f'{filename} ({status})')

    # Process city pages
    for slug, faqs in CITY_FAQS.items():
        filename = f'page-location-{slug}.php'
        filepath = os.path.join(CITY_DIR, filename)
        if not os.path.exists(filepath):
            results['failed'].append(f'{filename} (file not found)')
            continue
        status = inject_faq_extra(filepath, faqs, 'city')
        if status == 'OK':
            results['ok'] += 1
        elif 'skipped' in status:
            results['skipped'] += 1
        else:
            results['failed'].append(f'{filename} ({status})')

    print(f"\n=== FAQ INJECTION RESULTS ===")
    print(f"Successfully updated: {results['ok']}")
    print(f"Skipped (already done): {results['skipped']}")
    print(f"Failed: {len(results['failed'])}")
    if results['failed']:
        print("\nFailed files:")
        for f in results['failed']:
            print(f"  - {f}")
    print()

if __name__ == '__main__':
    main()
