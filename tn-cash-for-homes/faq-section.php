<?php
/**
 * Shared FAQ section template.
 *
 * Required variables before include:
 *   $faq_name  — display name (e.g. "Williamson County" or "Nashville")
 *   $faq_extra — array of ['q'=>'...','a'=>'...'] unique location questions
 */

if ( empty( $faq_name ) || ! isset( $faq_extra ) ) return;

// ── Build FAQ items array ──
$faq_items = [
    [
        'q' => "How much will you pay for my house in {$faq_name}?",
        'a' => "Every property in {$faq_name} is different, so our offers are based on the home's condition, location, and current market trends. We aim to provide a fair cash offer that reflects the true value of your property. There are no obligations — request your free offer and decide if it works for you.",
    ],
    [
        'q' => "How fast can you close on a house in {$faq_name}?",
        'a' => "We can close on your {$faq_name} home in as little as 7 days. If you need more time, we will work around your schedule. Unlike traditional sales that take months, our process is designed to get you cash quickly with no delays or financing contingencies.",
    ],
    [
        'q' => "Do I need to make repairs before selling my {$faq_name} home?",
        'a' => "Absolutely not. We buy houses in {$faq_name} in any condition — whether it needs minor cosmetic updates or major structural repairs. You do not need to spend a dime fixing up your property. We handle all of that after closing.",
    ],
    [
        'q' => "Are there any fees or commissions when selling to you in {$faq_name}?",
        'a' => "No. When you sell your {$faq_name} home to Tennessee Cash For Homes, there are zero agent commissions, no closing costs, and no hidden fees. The cash offer we present is the amount you walk away with at closing.",
    ],
    [
        'q' => "What types of properties do you buy in {$faq_name}?",
        'a' => "We buy all types of properties in {$faq_name} including single-family homes, duplexes, multi-family properties, townhomes, mobile homes, and vacant land. No matter the type or condition, we are interested in making you an offer.",
    ],
];

// Append location-specific unique questions
foreach ( $faq_extra as $item ) {
    $faq_items[] = $item;
}
?>

<!-- ── FAQ SECTION ── -->
<section class="section faq-section">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow"><?php echo esc_html( $faq_name ); ?> FAQ</p>
      <h2 class="section__title">Frequently Asked Questions About Selling Your House in <?php echo esc_html( $faq_name ); ?></h2>
      <p class="section__subtitle">Get answers to the most common questions homeowners in <?php echo esc_html( $faq_name ); ?> ask before selling their house for cash.</p>
    </div>
    <div class="faq-accordion">
      <?php foreach ( $faq_items as $i => $faq ) : ?>
      <div class="faq-accordion__item">
        <button class="faq-accordion__trigger" aria-expanded="false" aria-controls="faq-panel-<?php echo $i; ?>">
          <span class="faq-accordion__question"><?php echo esc_html( $faq['q'] ); ?></span>
          <span class="faq-accordion__icon" aria-hidden="true">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </span>
        </button>
        <div class="faq-accordion__panel" id="faq-panel-<?php echo $i; ?>" role="region">
          <p class="faq-accordion__answer"><?php echo esc_html( $faq['a'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FAQ Schema (JSON-LD) -->
<script type="application/ld+json">
<?php
echo json_encode([
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map( function( $faq ) {
        return [
            '@type' => 'Question',
            'name'  => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }, $faq_items ),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
?>
</script>

<style>
/* ── FAQ Accordion ── */
.faq-section {
  padding: 64px 0;
}
.faq-accordion {
  max-width: 820px;
  margin: 32px auto 0;
  display: flex;
  flex-direction: column;
  gap: 0;
}
.faq-accordion__item {
  border-bottom: 1px solid #e2e2e2;
}
.faq-accordion__item:first-child {
  border-top: 1px solid #e2e2e2;
}
.faq-accordion__trigger {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 20px 0;
  background: none;
  border: none;
  cursor: pointer;
  text-align: left;
  gap: 16px;
  font-family: inherit;
}
.faq-accordion__trigger:hover .faq-accordion__question {
  color: #2D6A4F;
}
.faq-accordion__question {
  font-size: 1.05rem;
  font-weight: 600;
  color: #1a1a1a;
  line-height: 1.4;
  transition: color 0.2s ease;
}
.faq-accordion__icon {
  flex-shrink: 0;
  color: #2D6A4F;
  transition: transform 0.3s ease;
}
.faq-accordion__trigger[aria-expanded="true"] .faq-accordion__icon {
  transform: rotate(180deg);
}
.faq-accordion__panel {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.35s ease, padding 0.35s ease;
}
.faq-accordion__trigger[aria-expanded="true"] + .faq-accordion__panel {
  max-height: 500px;
}
.faq-accordion__answer {
  padding: 0 0 20px;
  font-size: 0.98rem;
  color: #555;
  line-height: 1.7;
  margin: 0;
}
@media (max-width: 768px) {
  .faq-section {
    padding: 48px 0;
  }
  .faq-accordion__question {
    font-size: 0.97rem;
  }
  .faq-accordion__answer {
    font-size: 0.93rem;
  }
}
</style>

<script>
(function(){
  document.querySelectorAll('.faq-accordion__trigger').forEach(function(btn){
    btn.addEventListener('click', function(){
      var expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !expanded);
    });
  });
})();
</script>
