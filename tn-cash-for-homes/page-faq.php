<?php
/**
 * Template Name: FAQ
 * Template for the FAQ page
 */
get_header(); ?>

<!-- ── PAGE HERO ── -->
<section class="hero" id="hero-form">
  <div class="container">
    <div class="hero__inner">
      <div class="hero__content">
        <nav class="breadcrumb">
          <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
          <span>&rsaquo;</span>
          <span>FAQ</span>
        </nav>
        <h1 class="hero__title">
          <span class="hero__title--white">Frequently Asked</span>
          <span class="hero__title--green"> Questions</span>
        </h1>
        <p class="hero__subtitle">Everything you need to know about selling your home to Tennessee Cash For Homes.</p>
        <div class="hero__trust-row">
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            No Agent Fees
          </span>
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Close in 7 Days
          </span>
          <span class="hero__trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="#84CC9C" stroke-width="2"/>
              <path d="M8 12l3 3 5-5" stroke="#84CC9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Any Condition
          </span>
        </div>
      </div>

      <div class="hero__form-card" id="get-offer">
        <h2 class="form-card__title">Get Your Free Cash Offer</h2>
        <p class="form-card__sub">Takes less than 60 seconds. No obligation.</p>
        <form id="leadForm" onsubmit="handleSubmit(event)">
          <input type="hidden" name="lead_source" value="FAQ" />
          <div class="form-group">
            <label for="faq-address">Property Address</label>
            <input type="text" id="faq-address" name="address" placeholder="123 Main St, Nashville, TN" required />
          </div>
          <div class="form-group">
            <label for="faq-name">Your Name</label>
            <input type="text" id="faq-name" name="name" placeholder="John Smith" required />
          </div>
          <div class="form-group">
            <label for="faq-phone">Phone Number</label>
            <input type="tel" id="faq-phone" name="phone" placeholder="(615) 555-0123" required />
          </div>
          <button type="submit" class="btn-primary btn-primary--block">
            Get My Cash Offer &rarr;
          </button>
        </form>
        <p class="form-disclaimer">&#128274; Your info is private and never shared.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── FAQ ACCORDION ── -->
<section class="section faq-section">
  <div class="container">
    <div class="faq-section__inner">

      <div class="faq-accordion">

        <?php
        $faq_items = function_exists( 'tcfh_get_faq_page_items' ) ? tcfh_get_faq_page_items() : array();
        foreach ( $faq_items as $item ) :
          $q = $item['q'];
          $a = $item['a'];
          // Render the phone number as a clickable tel: link where it appears.
          $a_html = str_replace( '(615) 801-8126', '<a href="tel:+16158018126">(615) 801-8126</a>', esc_html( $a ) );
        ?>
        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span><?php echo esc_html( $q ); ?></span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p><?php echo $a_html; ?></p>
          </div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</section>

<!-- ── FAQ STYLES ── -->
<style>
  .faq-section {
    background: var(--bg-light);
  }
  .faq-section__inner {
    max-width: 800px;
    margin: 0 auto;
  }
  .faq-accordion {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .faq-item {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
    transition: box-shadow .2s;
  }
  .faq-item:hover {
    box-shadow: var(--shadow);
  }
  .faq-item__question {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 20px 24px;
    background: none;
    border: none;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 16px;
    color: var(--charcoal);
    text-align: left;
    line-height: 1.4;
    transition: color .2s;
  }
  .faq-item__question:hover {
    color: var(--green-dark);
  }
  .faq-item__icon {
    flex-shrink: 0;
    transition: transform .3s ease;
    color: var(--charcoal-light);
  }
  .faq-item.active .faq-item__icon {
    transform: rotate(180deg);
    color: var(--green);
  }
  .faq-item.active .faq-item__question {
    color: var(--green-dark);
  }
  .faq-item__answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height .35s ease, padding .35s ease;
    padding: 0 24px;
  }
  .faq-item.active .faq-item__answer {
    padding: 0 24px 20px;
  }
  .faq-item__answer p {
    font-family: Tahoma, Geneva, Verdana, sans-serif;
    font-size: 15px;
    line-height: 1.7;
    color: var(--charcoal-light);
    margin: 0;
  }
  .faq-item__answer a {
    color: var(--green-dark);
    font-weight: 600;
    text-decoration: underline;
  }
  .faq-item__answer a:hover {
    color: var(--green);
  }

  @media (max-width: 600px) {
    .faq-item__question {
      padding: 16px 18px;
      font-size: 15px;
    }
    .faq-item__answer {
      padding: 0 18px;
    }
    .faq-item.active .faq-item__answer {
      padding: 0 18px 16px;
    }
  }
</style>

<!-- ── FAQ ACCORDION JS ── -->
<script>
(function() {
  var items = document.querySelectorAll('.faq-item');
  items.forEach(function(item) {
    var btn = item.querySelector('.faq-item__question');
    var answer = item.querySelector('.faq-item__answer');
    btn.addEventListener('click', function() {
      var isOpen = item.classList.contains('active');

      // Close all
      items.forEach(function(other) {
        other.classList.remove('active');
        other.querySelector('.faq-item__question').setAttribute('aria-expanded', 'false');
        other.querySelector('.faq-item__answer').style.maxHeight = null;
      });

      // Open clicked (if it was closed)
      if (!isOpen) {
        item.classList.add('active');
        btn.setAttribute('aria-expanded', 'true');
        answer.style.maxHeight = answer.scrollHeight + 20 + 'px';
      }
    });
  });
})();
</script>

<?php get_footer(); ?>
