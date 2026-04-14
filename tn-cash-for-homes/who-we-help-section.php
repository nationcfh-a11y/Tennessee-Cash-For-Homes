<?php
/**
 * "Who We Help" situation cards section.
 * Include from county-template.php or location-template.php.
 *
 * Expects:
 *   $name    – display name (e.g. "Davidson County" or "Nashville")
 *   $ms_type – 'county' or 'city'
 */

$wwh_label = $name; // used in headings and card copy

// Generate a deterministic variant index (0-3) from the location name
// so every page gets consistent but varied copy
$wwh_hash = crc32( $name );

// Copy variant pools per situation (4 variants each)
$wwh_situations = [
    [
        'title'  => 'Facing Foreclosure',
        'url'    => '/sell-my-house-foreclosure-tennessee',
        'icon'   => '<svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M3 21h18l-9-16-9 16z"/></svg>',
        'copy'   => [
            'Tennessee law allows lenders to foreclose in as little as 22 days. If you need to sell your house in %s before the auction date, we can close fast and help you avoid the lasting damage a foreclosure leaves on your credit.',
            'A foreclosure filing in %s can feel overwhelming, but you still have options. We buy houses directly from homeowners facing pre-foreclosure, giving you a fair cash offer and a quick closing so you can move forward.',
            'Time is critical when foreclosure proceedings begin in %s. Tennessee is a non-judicial foreclosure state, which means the process moves quickly. Selling to us lets you pay off your mortgage and protect your financial future.',
            'If you have received a notice of default on your %s home, acting fast matters. We purchase properties at any stage of the foreclosure timeline and can close in as few as 7 days so you can settle your debt and start fresh.',
        ],
    ],
    [
        'title'  => 'Going Through Divorce',
        'url'    => '/sell-my-house-divorce-tennessee',
        'icon'   => '<svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/><line x1="6" y1="2" x2="18" y2="22"/></svg>',
        'copy'   => [
            'Dividing property during a divorce in %s adds stress to an already difficult time. Selling your house for cash lets both parties split the proceeds quickly and cleanly without months of listing, showings, and negotiations.',
            'When %s homeowners going through divorce need to liquidate shared real estate, a fast cash sale eliminates the delays of the traditional market. We handle the process discreetly and close on a timeline that works for both parties.',
            'Divorce often means neither spouse wants to keep the %s home. We make it simple by purchasing directly, so you can divide the equity without waiting for a buyer or dealing with agent commissions.',
            'Selling a marital home in %s does not have to prolong your divorce proceedings. Our cash offer process is straightforward, letting you and your spouse resolve the property quickly so you can both move on.',
        ],
    ],
    [
        'title'  => 'Inherited a Property',
        'url'    => '/sell-inherited-house-tennessee',
        'icon'   => '<svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0v-2M5 21H3m2 0v-2m4-14h2m-2 4h2m4-4h2m-2 4h2"/></svg>',
        'copy'   => [
            'Inheriting a home in %s can come with unexpected costs like property taxes, insurance, and maintenance. If you would rather convert that inherited property to cash than manage it long-distance, we make the process simple with a fair offer.',
            'Tennessee probate can take several months, and holding an inherited property in %s during that time means ongoing expenses. We work with estates at every stage and can purchase the home as soon as probate clears.',
            'Many %s homeowners inherit properties they never planned to keep. Whether the home needs repairs, has tenants, or is sitting vacant, we buy inherited houses in any condition and handle all the details.',
            'If you have inherited a house in %s and are unsure what to do with it, selling for cash is often the simplest path. We take care of the paperwork and can close quickly so you can settle the estate without hassle.',
        ],
    ],
    [
        'title'  => 'Relocating or Moving',
        'url'    => '/sell-my-house-relocating-tennessee',
        'icon'   => '<svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>',
        'copy'   => [
            'A job transfer or life change that requires leaving %s quickly does not give you time for a traditional listing. We buy houses on your schedule, so you can relocate without paying two mortgages or worrying about a vacant property.',
            'When %s homeowners need to relocate fast, the last thing they want is an open-ended listing. Our cash offer lets you sell before you move and avoid the stress of managing a property from another city or state.',
            'Moving out of %s for work, family, or retirement? Selling your home for cash means no staging, no showings, and no waiting. We close on your timeline so you can focus on your fresh start.',
            'Relocating from %s is stressful enough without a house sitting on the market. We give you a fair cash offer and can close in days, letting you move confidently with funds in hand.',
        ],
    ],
    [
        'title'  => 'Major Repairs Needed',
        'url'    => '/sell-house-as-is-tennessee/',
        'icon'   => '<svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>',
        'copy'   => [
            'Roof damage, foundation issues, or outdated systems can make selling a %s home on the traditional market nearly impossible. We buy houses as-is, so you never have to spend a dime on repairs before closing.',
            'Many %s homeowners put off selling because the cost of repairs feels overwhelming. We purchase properties in any condition, from minor cosmetic issues to major structural problems, and handle all renovations ourselves.',
            'If your %s home needs more work than you can afford or want to deal with, selling as-is for cash is the smartest option. No inspections, no contractor bids, no repair negotiations. We buy it exactly as it stands.',
            'Homes in %s that need significant repairs often sit on the market for months with traditional agents. We skip the repair demands entirely and give you a fair cash offer based on the property potential.',
        ],
    ],
    [
        'title'  => 'Tired Landlord',
        'url'    => '/sell-rental-property-tennessee/',
        'icon'   => '<svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>',
        'copy'   => [
            'Being a landlord in %s comes with tenant headaches, maintenance calls, and unexpected expenses. If you are ready to walk away from the rental game, we buy investment properties with or without tenants in place.',
            'Late rent, property damage, and constant upkeep wear down even the most dedicated %s landlords. Selling your rental for cash lets you cash out your equity without dealing with another lease cycle.',
            'Tennessee landlord-tenant laws can be complex, and managing a rental in %s is rarely passive income. We purchase rental properties in any condition and can work around existing tenant situations.',
            '%s landlords tired of the day-to-day grind of property management can sell directly to us. No need to wait for a lease to end or evict tenants. We handle the transition and pay you a fair price.',
        ],
    ],
    [
        'title'  => 'Behind on Taxes',
        'url'    => '/sell-house-behind-on-taxes-tennessee/',
        'icon'   => '<svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        'copy'   => [
            'Falling behind on property taxes in %s can lead to a tax lien sale, putting your home at risk. Selling to us for cash lets you settle your tax debt and keep the remaining equity rather than losing everything at auction.',
            'Tennessee counties can sell tax liens after just one year of delinquency. If you owe back taxes on your %s home, a quick cash sale can help you pay what is owed and avoid the penalties that keep adding up.',
            '%s homeowners behind on property taxes often feel trapped, watching penalties and interest accumulate. We can purchase your home quickly, pay off the tax debt at closing, and put the remaining proceeds in your pocket.',
            'Delinquent property taxes on a %s home do not have to end in a tax sale. We buy houses with tax liens and handle the payoff at closing, giving you a clean break and cash in hand.',
        ],
    ],
    [
        'title'  => 'Downsizing',
        'url'    => '/sell-my-house-downsizing-tennessee',
        'icon'   => '<svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1m-2 0h2"/></svg>',
        'copy'   => [
            'Many %s homeowners reach a point where their house is simply more space than they need. Selling for cash makes downsizing easy. Skip the months of listing and showings and move into your next chapter with money in the bank.',
            'Whether the kids have moved out or you are ready for a simpler lifestyle, downsizing your %s home does not have to be complicated. We offer a fast, hassle-free sale so you can transition on your own terms.',
            'Maintaining a larger home in %s costs more in utilities, taxes, and upkeep every year. Selling to us for cash frees up your equity quickly so you can find the right-sized space without financial pressure.',
            '%s homeowners looking to downsize often dread the traditional selling process. We eliminate the hassle with a straightforward cash offer, no staging, no open houses, and a closing date you choose.',
        ],
    ],
    [
        'title'  => 'Probate Sale',
        'url'    => '/sell-house-probate-tennessee/',
        'icon'   => '<svg width="28" height="28" fill="none" stroke="#84CC9C" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
        'copy'   => [
            'Navigating probate in Tennessee while managing a %s property can be exhausting. We work directly with executors and administrators to purchase probate properties quickly, simplifying the estate settlement process.',
            'Tennessee probate proceedings can take months, and a vacant %s property during that time means ongoing costs. We buy homes in probate and coordinate with your attorney to ensure a smooth closing.',
            'If you are the executor of an estate with property in %s, selling for cash can speed up the probate timeline. We handle the complexities and close once the court grants approval, saving you time and carrying costs.',
            'Probate properties in %s often need repairs, are sitting vacant, or have title complications. We specialize in buying homes in these exact situations and work with estate attorneys to make the sale as simple as possible.',
        ],
    ],
];
?>

<!-- ── WHO WE HELP ── -->
<section class="section section--alt wwh-section">
  <div class="container">
    <div class="section__header section__header--center">
      <p class="section__eyebrow">Situations We Help With</p>
      <h2 class="section__title">We Help <?php echo esc_html( $wwh_label ); ?> Homeowners In Any Situation</h2>
      <p class="section__subtitle">No matter what life throws your way, <?php echo esc_html( $wwh_label ); ?> homeowners can sell their house fast for cash. Whether you need to sell your house in <?php echo esc_html( $wwh_label ); ?> due to financial hardship, a life change, or simply because you are ready to move on, we are here to help with a fair offer and a quick closing.</p>
    </div>
    <div class="wwh-grid">
      <?php foreach ( $wwh_situations as $idx => $sit ) :
          $variant = abs( $wwh_hash + $idx ) % 4;
          $copy    = sprintf( $sit['copy'][ $variant ], $wwh_label );
      ?>
      <a href="<?php echo esc_url( home_url( $sit['url'] ) ); ?>" class="wwh-card">
        <div class="wwh-card__icon"><?php echo $sit['icon']; ?></div>
        <h3 class="wwh-card__title"><?php echo esc_html( $sit['title'] . ' in ' . $wwh_label ); ?></h3>
        <p class="wwh-card__copy"><?php echo esc_html( $copy ); ?></p>
        <span class="wwh-card__link">Learn More &rarr;</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
/* ── Who We Help Section ── */
.wwh-section {
  padding: 64px 0;
}
.wwh-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-top: 40px;
}
.wwh-card {
  display: flex;
  flex-direction: column;
  background: #fff;
  border: 1px solid #e8e8e8;
  border-radius: 12px;
  padding: 28px 24px;
  text-decoration: none;
  color: inherit;
  transition: box-shadow 0.3s ease, transform 0.3s ease;
}
.wwh-card:hover {
  box-shadow: 0 8px 24px rgba(0,0,0,0.08);
  transform: translateY(-2px);
}
.wwh-card__icon {
  margin-bottom: 16px;
  line-height: 0;
}
.wwh-card__title {
  font-family: 'Poppins', sans-serif;
  font-size: 1.05rem;
  font-weight: 600;
  color: #1a1a1a;
  margin: 0 0 10px;
  line-height: 1.3;
}
.wwh-card__copy {
  font-size: 0.92rem;
  color: #5a5a5a;
  line-height: 1.6;
  margin: 0 0 16px;
  flex: 1;
}
.wwh-card__link {
  font-size: 0.875rem;
  font-weight: 600;
  color: #2D6A4F;
  letter-spacing: 0.02em;
  transition: color 0.2s ease;
}
.wwh-card:hover .wwh-card__link {
  color: #84CC9C;
}

/* Tablet: 2 columns */
@media (max-width: 1024px) {
  .wwh-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
/* Mobile: 1 column */
@media (max-width: 600px) {
  .wwh-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  .wwh-section {
    padding: 48px 0;
  }
}
</style>
