<?php
/**
 * Local Government Resources section.
 * Include from county-template.php or location-template.php after the FAQ section.
 *
 * Required variables before include:
 *   $gov_name       — display name used in headings (e.g. "Davidson County", "Nashville", "Tennessee")
 *   $gov_county_key — county key used to look up resource URLs (e.g. "Davidson"); empty when $gov_type === 'statewide'
 *   $gov_type       — 'county', 'city', or 'statewide' (statewide mode shows only TN-wide resources)
 */

if ( empty( $gov_name ) ) return;
if ( empty( $gov_county_key ) && $gov_type !== 'statewide' ) return;

// For county/city pages, load the county-specific resource data
if ( $gov_type !== 'statewide' ) {
    include_once get_template_directory() . '/gov-resources-data.php';
    if ( ! function_exists( 'tcfh_get_gov_resources' ) ) return;
    $gov_resources = tcfh_get_gov_resources( $gov_county_key );
    if ( empty( $gov_resources ) ) return;
}

// Icon SVGs for each resource type
$gov_icons = [
    'assessor'  => '<svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/></svg>',
    'trustee'   => '<svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    'register'  => '<svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
    'chancery'  => '<svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>',
    'circuit'   => '<svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>',
    'thda'      => '<svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
];

// Tags mapping
$gov_tags = [
    'assessor' => 'Inherited Property, Probate',
    'trustee'  => 'Behind on Taxes, Foreclosure',
    'register' => 'Inherited Property, Probate',
    'chancery' => 'Foreclosure, Probate, Divorce',
    'circuit'  => 'Divorce',
    'thda'     => 'Foreclosure',
];

// Labels for each resource type
$gov_labels = [
    'assessor' => $gov_county_key . ' County Property Assessor',
    'trustee'  => $gov_county_key . ' County Trustee',
    'register' => $gov_county_key . ' County Register of Deeds',
    'chancery' => $gov_county_key . ' County Chancery Court',
    'circuit'  => $gov_county_key . ' County Circuit Court',
    'thda'     => 'Tennessee Housing Development Agency (THDA)',
];

// Descriptions for each resource type
$gov_descs = [
    'assessor' => 'Look up your assessed home value, property tax history, and ownership records for your ' . $gov_county_key . ' County property.',
    'trustee'  => 'Check your property tax balance, find out if you\'re delinquent, or learn about upcoming tax sales in ' . $gov_county_key . ' County.',
    'register' => 'Search deed transfers, liens, mortgages, and ownership history for properties in ' . $gov_county_key . ' County.',
    'chancery' => 'Handles foreclosure filings, probate proceedings, and divorce-related property matters in ' . $gov_county_key . ' County.',
    'circuit'  => 'Oversees divorce proceedings and other civil matters that may affect your ability to sell your ' . $gov_county_key . ' County property.',
    'thda'     => 'Statewide foreclosure prevention resources and housing assistance programs for Tennessee homeowners.',
];

// Statewide mode: used on situation pages which are not county-specific.
// Shows only Tennessee-wide resources (THDA, TN Bar Association, HUD counselors, TN Legal Aid).
if ( $gov_type === 'statewide' ) {
    $gov_resources = [
        'thda'        => 'https://thda.org',
        'hud'         => 'https://www.hud.gov/i_want_to/talk_to_a_housing_counselor',
        'tn_bar'      => 'https://www.tba.org/page/PublicInfo',
        'tn_legalaid' => 'https://www.tn.gov/tsc/help/tennessee-legal-aid-organizations.html',
    ];
    $gov_icons['hud'] = '<svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>';
    $gov_icons['tn_bar'] = '<svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>';
    $gov_icons['tn_legalaid'] = '<svg width="24" height="24" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>';
    $gov_tags['hud']         = 'Foreclosure, Counseling';
    $gov_tags['tn_bar']      = 'Legal Referrals';
    $gov_tags['tn_legalaid'] = 'Free Legal Help';
    $gov_labels['thda']        = 'Tennessee Housing Development Agency (THDA)';
    $gov_labels['hud']         = 'HUD-Approved Housing Counselors';
    $gov_labels['tn_bar']      = 'Tennessee Bar Association';
    $gov_labels['tn_legalaid'] = 'Tennessee Legal Aid';
    $gov_descs['thda']        = 'Statewide foreclosure prevention programs, down payment assistance, and homeowner counseling services for Tennessee residents.';
    $gov_descs['hud']         = 'Free foreclosure avoidance and housing counseling from HUD-certified agencies serving all of Tennessee.';
    $gov_descs['tn_bar']      = 'Free lawyer referral service and public legal information resources for Tennessee homeowners navigating divorce, probate, or foreclosure.';
    $gov_descs['tn_legalaid'] = 'Directory of Tennessee legal aid organizations that offer free or low-cost civil legal help to income-eligible homeowners statewide.';
}

// Determine intro text based on page type
if ( $gov_type === 'statewide' ) {
    $intro_text = 'These Tennessee-wide resources can help homeowners across the state navigate foreclosure, probate, divorce, and other difficult situations. Whether you are considering selling your house or just need information, these statewide offices and programs can help.';
} elseif ( $gov_type === 'city' ) {
    $intro_text = 'These resources are provided to help ' . $gov_name . ' homeowners navigate difficult situations like foreclosure, probate, or property taxes in ' . $gov_county_key . ' County. Whether you are considering selling your house in ' . $gov_name . ' or just need information, these ' . $gov_county_key . ' County offices can help.';
} else {
    $intro_text = 'These resources are provided to help ' . $gov_name . ' homeowners navigate difficult situations like foreclosure, probate, or property taxes in ' . $gov_name . '. Whether you are considering selling your house in ' . $gov_name . ' or just need information, these local offices can help.';
}
?>

<!-- ── LOCAL GOVERNMENT RESOURCES ── -->
<section class="section gov-resources-section">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Local Resources</p>
      <h2 class="section__title">Helpful <?php echo esc_html( $gov_name ); ?> Resources for Homeowners</h2>
      <p class="section__subtitle"><?php echo esc_html( $intro_text ); ?></p>
    </div>
    <div class="gov-resources-list">
      <?php $row_index = 0; foreach ( $gov_resources as $type => $url ) :
        if ( empty( $url ) ) continue;
        $icon  = isset( $gov_icons[ $type ] )  ? $gov_icons[ $type ]  : '';
        $label = isset( $gov_labels[ $type ] ) ? $gov_labels[ $type ] : '';
        $desc  = isset( $gov_descs[ $type ] )  ? $gov_descs[ $type ]  : '';
        $tag   = isset( $gov_tags[ $type ] )   ? $gov_tags[ $type ]   : '';
        $row_class = ( $row_index % 2 === 1 ) ? ' gov-resource-row--alt' : '';
      ?>
      <div class="gov-resource-row<?php echo $row_class; ?>">
        <div class="gov-resource-row__icon"><?php echo $icon; ?></div>
        <div class="gov-resource-row__body">
          <h3 class="gov-resource-row__title">
            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
          </h3>
          <p class="gov-resource-row__desc"><?php echo esc_html( $desc ); ?></p>
        </div>
        <?php if ( $tag ) : ?>
        <div class="gov-resource-row__tag">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/></svg>
          Helpful for: <?php echo esc_html( $tag ); ?>
        </div>
        <?php endif; ?>
        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="gov-resource-row__cta">Visit Website &rarr;</a>
      </div>
      <?php $row_index++; endforeach; ?>
    </div>
  </div>
</section>

<style>
/* ── Government Resources Section ── */
.gov-resources-section {
  padding: 72px 0;
  background: #F2F2F2;
}
.gov-resources-section .section__eyebrow {
  color: #2D6A4F;
}
.gov-resources-section .section__title {
  color: #1a1a1a;
}
.gov-resources-section .section__subtitle {
  color: #5a5a5a;
}
.gov-resources-list {
  margin-top: 40px;
}
.gov-resource-row {
  display: flex;
  align-items: center;
  gap: 24px;
  padding: 22px 28px;
  border-left: 3px solid #2D6A4F;
  transition: background 0.2s ease;
}
.gov-resource-row--alt {
  background: rgba(0, 0, 0, 0.03);
}
.gov-resource-row:hover {
  background: rgba(0, 0, 0, 0.05);
}
.gov-resource-row__icon {
  flex-shrink: 0;
  line-height: 0;
}
.gov-resource-row__body {
  flex: 1;
  min-width: 0;
}
.gov-resource-row__title {
  font-family: 'Poppins', sans-serif;
  font-size: 1.05rem;
  font-weight: 600;
  color: #1a1a1a;
  margin: 0 0 4px;
  line-height: 1.3;
}
.gov-resource-row__title a {
  color: #1a1a1a;
  text-decoration: none;
  transition: color 0.2s ease;
}
.gov-resource-row__title a:hover {
  color: #2D6A4F;
}
.gov-resource-row__desc {
  font-size: 0.9rem;
  color: #5a5a5a;
  line-height: 1.5;
  margin: 0;
}
.gov-resource-row__tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 0.78rem;
  font-weight: 600;
  color: #2D6A4F;
  background: rgba(132, 204, 156, 0.15);
  padding: 5px 12px;
  border-radius: 20px;
  flex-shrink: 0;
  letter-spacing: 0.02em;
  white-space: nowrap;
}
.gov-resource-row__tag svg {
  flex-shrink: 0;
  color: #84CC9C;
}
.gov-resource-row__cta {
  font-size: 0.875rem;
  font-weight: 600;
  color: #2D6A4F;
  text-decoration: none;
  letter-spacing: 0.02em;
  transition: color 0.2s ease;
  flex-shrink: 0;
  white-space: nowrap;
}
.gov-resource-row__cta:hover {
  color: #84CC9C;
}

/* Tablet */
@media (max-width: 1024px) {
  .gov-resource-row {
    flex-wrap: wrap;
    gap: 12px 20px;
    padding: 20px 24px;
  }
  .gov-resource-row__body {
    flex: 1 1 calc(100% - 60px);
  }
  .gov-resource-row__tag {
    order: 4;
  }
  .gov-resource-row__cta {
    order: 5;
    margin-left: auto;
  }
}
/* Mobile */
@media (max-width: 600px) {
  .gov-resources-section {
    padding: 48px 0;
  }
  .gov-resource-row {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    padding: 20px 20px;
  }
  .gov-resource-row__icon {
    margin-bottom: 2px;
  }
  .gov-resource-row__body {
    width: 100%;
  }
  .gov-resource-row__tag {
    order: 0;
  }
  .gov-resource-row__cta {
    order: 0;
    align-self: flex-start;
  }
}
</style>
