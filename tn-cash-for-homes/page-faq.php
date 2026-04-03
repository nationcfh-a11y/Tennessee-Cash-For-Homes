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

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>How does the process work?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>It's simple. You contact us, we schedule a quick walkthrough or virtual assessment of your home, and we present you with a fair no-obligation cash offer within 24 hours. If you accept, we handle all the paperwork and close on your timeline as fast as 7 days.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>Is there any obligation when I request an offer?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>Absolutely none. Our cash offer is completely free with zero pressure. You can take your time, ask questions, and decide what is best for you. We will never push you into a decision.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>Do I need to make repairs before selling?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>No. We buy homes in any condition including damaged, outdated, fire damaged, or unfinished. You do not need to lift a finger or spend a dime before closing.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>How fast can you close?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>We can close in as little as 7 days. If you need more time, that works too. We close on your schedule, not ours.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>Will I have to pay any fees or commissions?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>No agent commissions, no closing costs, no hidden fees. The number we offer is the number you walk away with.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>How do you determine your offer price?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>We look at the location, condition, and market value of your home along with recent comparable sales in the area. We make fair offers that reflect the real value of your property while accounting for the repairs and updates we will need to make.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>What types of properties do you buy?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>We buy all types of properties across Tennessee including single family homes, multi-family properties, rental properties, inherited homes, vacant land, and more. Any condition, any situation.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>What if I am behind on mortgage payments or facing foreclosure?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>We specialize in situations like this. We can move fast enough to stop the foreclosure process and protect your credit. Contact us as soon as possible so we have time to help.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>What if I have tenants living in the property?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>No problem. We buy rental properties with tenants in place. You do not need to handle evictions or wait for leases to end.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>Do you buy land?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>Yes. We buy vacant land and rural properties across Tennessee. Reach out and let us know what you have.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>How is this different from listing with a real estate agent?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>When you list with an agent you typically wait months for a buyer, pay 5 to 6 percent in commissions, make repairs, deal with showings, and risk the buyer backing out at the last minute. With us, you get a cash offer in 24 hours, no repairs, no fees, and a guaranteed closing on your timeline.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>Are you local?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>Yes. We are a family-owned Tennessee business. You deal directly with local decision makers with no call centers, no out-of-state investors, and no runaround.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>What areas of Tennessee do you buy in?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>We buy across all of Middle Tennessee including Nashville, Clarksville, Murfreesboro, Franklin, Spring Hill, Columbia, Cookeville, and surrounding areas.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>What if my house needs a lot of work?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>That is actually our specialty. The more work a home needs, the harder it is to sell on the open market. We buy homes that need major repairs, full renovations, or even cleanup after a hoarding or estate situation.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question" aria-expanded="false">
            <span>How do I get started?</span>
            <svg class="faq-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="faq-item__answer">
            <p>Just fill out the form on our website or give us a call at <a href="tel:+16158018126">(615) 801-8126</a>. We will reach out quickly to learn more about your property and get the process started.</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- ── CTA SECTION ── -->
<section class="cta-band">
  <div class="container">
    <h2>Still Have Questions?</h2>
    <p>We are happy to talk through your situation with no pressure and no obligation.</p>
    <a href="/#hero-form" class="btn-white">Get My Cash Offer &rarr;</a>
    <span class="cta-phone">Or call us directly at <a href="tel:+16158018126">(615) 801-8126</a></span>
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
