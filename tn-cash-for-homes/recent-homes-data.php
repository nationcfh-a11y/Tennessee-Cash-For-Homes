<?php
/**
 * Recent Homes We've Bought: real case studies, shown by recent-homes-section.php.
 *
 * Each story is written once and listed by the pages that show it. No street
 * names, addresses, or anything else that could identify a seller.
 *
 * Quotes are shown as plain text with no review schema unless the same words
 * are confirmed as a Google review (the guardian's quote below is not yet).
 *
 * Facts are the company's own figures, worded exactly as given: "over 100"
 * and "7+ years". Do not round them up or add others.
 */
$tcfh_maury_facts = array(
    array( 'value' => 'Over 100', 'label' => 'Homes bought in Maury County' ),
    array( 'value' => '7+ years', 'label' => 'Buying houses in Maury County' ),
);

return array(
    'stories' => array(
        'spring-hill-foreclosure' => array(
            'title' => 'Helping a family facing foreclosure in Spring Hill',
            'date'  => 'September 2026',
            'body'  => 'After an unexpected loss in the family, a Spring Hill homeowner fell behind on payments and was one month away from a foreclosure auction. We came out to see the house the same day they called, made an offer that met their goals, and started the process immediately. We helped postpone the foreclosure, worked through the title being in a late spouse\'s name, helped resolve a vehicle issue tied to the situation, and paid off what was owed so the family could start a new chapter. The house needed a lot of work, which is exactly what we buy.',
            'quote' => array( 'text' => 'Amazing company. I would definitely recommend.', 'by' => 'Seller\'s guardian' ),
        ),
        'columbia-widow' => array(
            'title' => 'Helping a widow with a house that needed major repairs',
            'date'  => 'September 2026',
            'body'  => 'An elderly Columbia homeowner had lost her husband, and the house needed more repairs than she could afford. We worked closely with her son, handled the title still being in her late husband\'s name, and put together a sale that solved her problems. Closed in about a month, as-is.',
        ),
        'columbia-out-of-state' => array(
            'title' => 'Helping an out-of-state seller who needed to move fast',
            'date'  => 'April 2026',
            'body'  => 'A seller who had bought a Columbia home with cash a year earlier had a family emergency back home and needed to sell immediately. Her agent\'s listing wasn\'t getting the price she needed, so she and her agent reached out to us. The house only needed paint and landscaping. We closed in under three weeks and handled the belongings she left behind.',
        ),
        'columbia-quick-sale' => array(
            'title' => 'A quick, simple sale for a seller who valued time',
            'date'  => 'August 2026',
            'body'  => 'This seller wanted the speed and convenience of a cash sale rather than paying for repairs and waiting on the market. The house needed paint, flooring, landscaping, and minor repairs. We cleared a secondary HVAC lien at closing and closed in about a month.',
        ),
        'columbia-bankruptcy' => array(
            'title' => 'Helping a seller through bankruptcy',
            'date'  => 'May 2026',
            'body'  => 'A Columbia homeowner going through bankruptcy had run out of money, and their house needed roof, foundation, basement, and upstairs work, so listing it wasn\'t realistic. We worked directly with their bankruptcy attorney, closed in about 30 days, put money in the seller\'s pocket, and helped them find a new place to live.',
        ),
    ),
    'pages' => array(
        'columbia'     => array(
            'stories' => array( 'columbia-widow', 'columbia-quick-sale', 'columbia-bankruptcy', 'columbia-out-of-state' ), // newest first
            'facts'   => $tcfh_maury_facts,
        ),
        'spring-hill'  => array(
            'stories' => array( 'spring-hill-foreclosure' ),
            'facts'   => $tcfh_maury_facts,
        ),
        'maury-county' => array(
            'stories' => array( 'spring-hill-foreclosure', 'columbia-widow' ),
            'facts'   => $tcfh_maury_facts,
            'more'    => array(
                array( 'url' => '/where-we-buy/columbia/#recent-homes', 'text' => 'Columbia' ),
                array( 'url' => '/where-we-buy/spring-hill/#recent-homes', 'text' => 'Spring Hill' ),
            ),
        ),
    ),
);
