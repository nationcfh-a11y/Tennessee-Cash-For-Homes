<?php
/**
 * Shared market-stats overview section.
 *
 * Expected variables before include:
 *   $ms_name  – display name ("Davidson County" or "Nashville")
 *   $ms_slug  – lookup key in the data array (e.g. "davidson-county" or "nashville")
 *   $ms_type  – "county" or "city"
 */

$ms_data_file = get_template_directory() . '/market-stats-data.php';
if ( ! file_exists( $ms_data_file ) ) return;

$ms_all = include $ms_data_file;
if ( ! isset( $ms_all[ $ms_slug ] ) ) return;

$ms = $ms_all[ $ms_slug ];
?>

<!-- ── MARKET STATS OVERVIEW ── -->
<section class="section market-overview" id="market-stats">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow"><?php echo esc_html( $ms_name ); ?> Housing Market</p>
      <h2 class="section__title"><?php echo esc_html( $ms_name ); ?> Real Estate Market Overview</h2>
    </div>
    <p class="market-overview__intro"><?php echo esc_html( $ms['intro'] ); ?></p>

    <div class="market-overview__grid">

      <!-- 1. Median Home Price -->
      <div class="market-card">
        <div class="market-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <div class="market-card__value"><?php echo esc_html( $ms['median_price'] ); ?></div>
        <div class="market-card__label">Median Home Price</div>
        <div class="market-card__trend market-card__trend--<?php echo esc_attr( $ms['yoy_direction'] ); ?>">
          <?php echo $ms['yoy_direction'] === 'up' ? '&#9650;' : '&#9660;'; ?>
          <?php echo esc_html( $ms['yoy_change'] ); ?> year-over-year
        </div>
        <p class="market-card__context"><?php echo esc_html( $ms['ctx_price'] ); ?></p>
      </div>

      <!-- 2. Avg Days on Market -->
      <div class="market-card">
        <div class="market-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        </div>
        <div class="market-card__value"><?php echo esc_html( $ms['avg_dom'] ); ?> Days</div>
        <div class="market-card__label">Avg Days on Market</div>
        <p class="market-card__context"><?php echo esc_html( $ms['ctx_dom'] ); ?></p>
      </div>

      <!-- 3. Homes Sold (12 mo) -->
      <div class="market-card">
        <div class="market-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path d="M9 22V12h6v10"/></svg>
        </div>
        <div class="market-card__value"><?php echo esc_html( $ms['homes_sold_12mo'] ); ?></div>
        <div class="market-card__label">Homes Sold (12 Months)</div>
        <p class="market-card__context"><?php echo esc_html( $ms['ctx_sold'] ); ?></p>
      </div>

      <!-- 4. Foreclosure / Distressed -->
      <div class="market-card">
        <div class="market-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="market-card__value"><?php echo esc_html( $ms['foreclosure_rate'] ); ?></div>
        <div class="market-card__label">Foreclosure Rate</div>
        <p class="market-card__context"><?php echo esc_html( $ms['ctx_foreclosure'] ); ?></p>
      </div>

      <!-- 5. Property Tax Rate -->
      <div class="market-card">
        <div class="market-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
        </div>
        <div class="market-card__value"><?php echo esc_html( $ms['property_tax_rate'] ); ?></div>
        <div class="market-card__label">Property Tax Rate</div>
        <p class="market-card__context"><?php echo esc_html( $ms['ctx_tax'] ); ?></p>
      </div>

      <!-- 6. Population -->
      <div class="market-card">
        <div class="market-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <div class="market-card__value"><?php echo esc_html( $ms['population'] ); ?></div>
        <div class="market-card__label">Population (<?php echo $ms['pop_growth'] === 'growing' ? 'Growing' : 'Declining'; ?>)</div>
        <p class="market-card__context"><?php echo esc_html( $ms['ctx_population'] ); ?></p>
      </div>

      <!-- 7. Median Household Income -->
      <div class="market-card">
        <div class="market-card__icon">
          <svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
        </div>
        <div class="market-card__value"><?php echo esc_html( $ms['median_income'] ); ?></div>
        <div class="market-card__label">Median Household Income</div>
        <p class="market-card__context"><?php echo esc_html( $ms['ctx_income'] ); ?></p>
      </div>

    </div><!-- /.market-overview__grid -->

    <p class="market-overview__closing"><?php echo esc_html( $ms['closing'] ); ?></p>

    <div class="market-overview__source">
      <small>Sources: U.S. Census Bureau, Zillow, Redfin, Tennessee Comptroller of the Treasury &mdash; Data reflects most recent available figures (2024&ndash;2025).</small>
    </div>
  </div>
</section>

<!-- ── FAQPage Schema ── -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is the median home price in <?php echo esc_js( $ms_name ); ?>?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "The median home price in <?php echo esc_js( $ms_name ); ?> is <?php echo esc_js( $ms['median_price'] ); ?>, which is <?php echo esc_js( $ms['yoy_change'] ); ?> <?php echo $ms['yoy_direction'] === 'up' ? 'higher' : 'lower'; ?> than last year."
      }
    },
    {
      "@type": "Question",
      "name": "How long do homes take to sell in <?php echo esc_js( $ms_name ); ?>?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Homes in <?php echo esc_js( $ms_name ); ?> spend an average of <?php echo esc_js( $ms['avg_dom'] ); ?> days on the market. Tennessee Cash For Homes can make a cash offer in 24 hours and close in as little as 7 days."
      }
    },
    {
      "@type": "Question",
      "name": "What is the property tax rate in <?php echo esc_js( $ms_name ); ?>?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "The property tax rate in <?php echo esc_js( $ms_name ); ?> is <?php echo esc_js( $ms['property_tax_rate'] ); ?> of assessed value. Tennessee assesses residential property at 25% of appraised value."
      }
    },
    {
      "@type": "Question",
      "name": "Can I sell my house fast for cash in <?php echo esc_js( $ms_name ); ?>?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. Tennessee Cash For Homes buys houses in <?php echo esc_js( $ms_name ); ?> for cash in any condition. We make fair offers within 24 hours, charge no fees or commissions, and can close in as little as 7 days."
      }
    }
  ]
}
</script>

<style>
/* ── Market Overview Section ── */
.market-overview {
  padding: 64px 0 56px;
}
.market-overview__intro {
  max-width: 820px;
  margin: 0 auto 40px;
  text-align: center;
  font-size: 1.05rem;
  color: #555;
  line-height: 1.7;
}
.market-overview__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-bottom: 40px;
}
.market-card {
  background: #fff;
  border: 1px solid #e8e8e8;
  border-radius: 12px;
  padding: 28px 24px;
  text-align: center;
  transition: box-shadow 0.3s ease, transform 0.2s ease;
}
.market-card:hover {
  box-shadow: 0 8px 24px rgba(0,0,0,0.08);
  transform: translateY(-2px);
}
.market-card__icon {
  margin-bottom: 14px;
}
.market-card__value {
  font-size: 1.6rem;
  font-weight: 700;
  color: #1a1a1a;
  margin-bottom: 4px;
}
.market-card__label {
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: #888;
  margin-bottom: 8px;
}
.market-card__trend {
  font-size: 13px;
  font-weight: 600;
  margin-bottom: 12px;
  display: inline-block;
  padding: 3px 10px;
  border-radius: 12px;
}
.market-card__trend--up {
  color: #2D6A4F;
  background: rgba(132, 204, 156, 0.2);
}
.market-card__trend--down {
  color: #b91c1c;
  background: rgba(185, 28, 28, 0.1);
}
.market-card__context {
  font-size: 13.5px;
  color: #666;
  line-height: 1.6;
  margin: 0;
}
.market-overview__closing {
  max-width: 820px;
  margin: 0 auto 24px;
  text-align: center;
  font-size: 1.05rem;
  color: #444;
  line-height: 1.7;
  font-weight: 500;
}
.market-overview__source {
  text-align: center;
  color: #aaa;
  font-size: 12px;
}
.market-overview__source small {
  font-style: italic;
}

/* ── Responsive ── */
@media (max-width: 1024px) {
  .market-overview__grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 600px) {
  .market-overview__grid {
    grid-template-columns: 1fr;
  }
  .market-card__value {
    font-size: 1.35rem;
  }
}
</style>
