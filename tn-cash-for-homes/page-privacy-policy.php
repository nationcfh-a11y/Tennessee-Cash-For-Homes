<?php
/*
Template Name: Privacy Policy
*/

// SEO meta
$meta_title       = 'Privacy Policy | Tennessee Cash For Homes';
$meta_description = 'Read the Privacy Policy for Tennessee Cash For Homes. Learn how we collect, use, and protect your personal information.';

add_filter( 'pre_get_document_title', function( $title ) use ( $meta_title ) {
    return $meta_title;
}, 99 );

if ( ! empty( $meta_description ) ) {
    update_post_meta( get_the_ID(), '_tcfh_meta_desc', $meta_description );
}

get_header();
?>

<section class="privacy-policy">
  <div class="container">
    <div class="privacy-policy__inner">

      <header class="privacy-policy__header">
        <h1 class="privacy-policy__title">Privacy Policy</h1>
        <p class="privacy-policy__updated">Last Updated: April 2026</p>
      </header>

      <nav class="privacy-policy__toc" aria-label="Table of contents">
        <p class="privacy-policy__toc-title">Table of Contents</p>
        <ol class="privacy-policy__toc-list">
          <li><a href="#introduction">Introduction</a></li>
          <li><a href="#information-we-collect">Information We Collect</a></li>
          <li><a href="#how-we-use-your-information">How We Use Your Information</a></li>
          <li><a href="#sms-consent-tcpa">SMS Text Message Consent and TCPA Disclosure</a></li>
          <li><a href="#cookies-and-tracking">Cookies and Tracking</a></li>
          <li><a href="#third-party-services">Third Party Services</a></li>
          <li><a href="#data-security">Data Security</a></li>
          <li><a href="#your-rights">Your Rights</a></li>
          <li><a href="#childrens-privacy">Children's Privacy</a></li>
          <li><a href="#changes-to-this-policy">Changes to This Policy</a></li>
          <li><a href="#contact-us">Contact Us</a></li>
        </ol>
      </nav>

      <div class="privacy-policy__content">

        <h2 id="introduction">1. Introduction</h2>
        <p>Tennessee Cash For Homes ("we," "us," or "our") operates the website tncashforhomes.com. This Privacy Policy explains how we collect, use, and protect your personal information when you visit our website or submit a form.</p>

        <h2 id="information-we-collect">2. Information We Collect</h2>
        <p>When you interact with our website or submit a form, we may collect the following information:</p>
        <ul>
          <li>Full name</li>
          <li>Phone number</li>
          <li>Email address (where collected)</li>
          <li>Property address</li>
          <li>How urgently you need to sell (collected through our foreclosure form)</li>
          <li>Device type and browser information</li>
          <li>Referring URL and traffic source</li>
          <li>IP address</li>
        </ul>

        <h2 id="how-we-use-your-information">3. How We Use Your Information</h2>
        <p>We use the information we collect for the following purposes:</p>
        <ul>
          <li>To contact you about purchasing your property.</li>
          <li>To send you a follow up text message within minutes of your form submission. This is how our team reaches you first, and we disclose it here to comply with TCPA requirements.</li>
          <li>To respond to your inquiry by phone, text, or email.</li>
          <li>To improve our website and marketing.</li>
          <li>To send your information to our internal CRM (Airtable) for lead management.</li>
        </ul>
        <p>We do not sell your information to third parties.</p>

        <h2 id="sms-consent-tcpa">4. SMS Text Message Consent and TCPA Disclosure</h2>
        <p>By submitting any form on this website, you expressly consent to receive automated SMS text messages from Tennessee Cash For Homes at the phone number you provided.</p>
        <ul>
          <li>Message frequency varies. You may receive an initial response text shortly after submitting your information, followed by additional messages related to your inquiry.</li>
          <li>Standard message and data rates may apply.</li>
          <li>You can opt out at any time by replying <strong>STOP</strong> to any text message.</li>
          <li>You can opt back in at any time by replying <strong>START</strong>.</li>
          <li>For help, reply <strong>HELP</strong> or contact us at <a href="mailto:info@tncashforhomes.com">info@tncashforhomes.com</a>.</li>
          <li>Consent to receive SMS messages is not a condition of any purchase or service.</li>
        </ul>

        <h2 id="cookies-and-tracking">5. Cookies and Tracking</h2>
        <p>We use cookies and similar tracking technologies to understand how visitors use our website and to improve your experience.</p>
        <ul>
          <li>We use Google Analytics (GA4) to track website usage.</li>
          <li>GA4 collects anonymous data about page views, session duration, and traffic sources.</li>
          <li>We use Google Ads conversion tracking to measure the performance of our advertising.</li>
          <li>You can opt out of Google Analytics by installing the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">Google Analytics opt-out browser add-on</a>.</li>
          <li>We also use standard WordPress cookies for site functionality.</li>
        </ul>

        <h2 id="third-party-services">6. Third Party Services</h2>
        <p>We share limited information with the following third party services to operate our website and respond to leads:</p>
        <ul>
          <li><strong>Google Analytics</strong> — website analytics.</li>
          <li><strong>Google Ads</strong> — advertising and conversion tracking.</li>
          <li><strong>Airtable</strong> — CRM and lead management.</li>
          <li><strong>Twilio</strong> — SMS text message delivery.</li>
          <li><strong>Calendly</strong> — appointment booking.</li>
          <li><strong>Rank Math</strong> — SEO.</li>
          <li><strong>WP Pusher</strong> — theme deployment.</li>
        </ul>

        <h2 id="data-security">7. Data Security</h2>
        <ul>
          <li>We take reasonable measures to protect your information from unauthorized access, disclosure, or misuse.</li>
          <li>No method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</li>
          <li>We retain your information only as long as necessary to fulfill the purposes outlined in this policy.</li>
        </ul>

        <h2 id="your-rights">8. Your Rights</h2>
        <ul>
          <li>You have the right to request access to the personal information we have collected about you.</li>
          <li>You have the right to request deletion of your personal information.</li>
          <li>To make a request, contact us at <a href="mailto:info@tncashforhomes.com">info@tncashforhomes.com</a> or call <a href="tel:+16158018126">(615) 801-8126</a>.</li>
        </ul>

        <h2 id="childrens-privacy">9. Children's Privacy</h2>
        <ul>
          <li>Our website is not directed at children under 13.</li>
          <li>We do not knowingly collect information from children under 13. If you believe a child has provided us with personal information, please contact us so we can remove it.</li>
        </ul>

        <h2 id="changes-to-this-policy">10. Changes to This Policy</h2>
        <ul>
          <li>We may update this Privacy Policy from time to time.</li>
          <li>We will update the "Last Updated" date at the top of this page when changes are made.</li>
          <li>Continued use of the website after changes constitutes acceptance of the updated policy.</li>
        </ul>

        <h2 id="contact-us">11. Contact Us</h2>
        <p>If you have any questions about this Privacy Policy or our data practices, you can reach us here:</p>
        <ul>
          <li><strong>Tennessee Cash For Homes</strong></li>
          <li>Email: <a href="mailto:info@tncashforhomes.com">info@tncashforhomes.com</a></li>
          <li>Phone: <a href="tel:+16158018126">(615) 801-8126</a></li>
          <li>Website: <a href="https://tennesseecashforhomes.com/">tennesseecashforhomes.com</a></li>
        </ul>

      </div>
    </div>
  </div>
</section>

<style>
  .privacy-policy {
    background: var(--white);
    padding: 72px 0 96px;
  }
  .privacy-policy__inner {
    max-width: 820px;
    margin: 0 auto;
  }
  .privacy-policy__header {
    margin-bottom: 40px;
  }
  .privacy-policy__title {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: clamp(32px, 5vw, 48px);
    color: var(--charcoal);
    line-height: 1.2;
    margin: 0 0 10px;
  }
  .privacy-policy__updated {
    font-size: 14px;
    color: var(--charcoal-light);
    opacity: 0.75;
    margin: 0;
  }

  .privacy-policy__toc {
    background: var(--bg-light);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 24px 28px;
    margin-bottom: 48px;
  }
  .privacy-policy__toc-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--charcoal);
    margin: 0 0 12px;
  }
  .privacy-policy__toc-list {
    margin: 0;
    padding-left: 22px;
    color: var(--charcoal-light);
    font-size: 15px;
    line-height: 1.9;
  }
  .privacy-policy__toc-list a {
    color: var(--green-dark);
    text-decoration: none;
    transition: color .15s;
  }
  .privacy-policy__toc-list a:hover {
    color: var(--green);
    text-decoration: underline;
  }

  .privacy-policy__content {
    font-family: Tahoma, Geneva, Verdana, sans-serif;
    font-size: 16px;
    line-height: 1.85;
    color: var(--charcoal-light);
  }
  .privacy-policy__content h2 {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 26px;
    color: var(--charcoal);
    line-height: 1.3;
    margin: 48px 0 16px;
    scroll-margin-top: 100px;
  }
  .privacy-policy__content h2:first-child {
    margin-top: 0;
  }
  .privacy-policy__content p {
    margin: 0 0 18px;
  }
  .privacy-policy__content ul {
    margin: 0 0 20px 22px;
    padding: 0;
  }
  .privacy-policy__content ul li {
    margin-bottom: 10px;
  }
  .privacy-policy__content a {
    color: var(--green-dark);
    text-decoration: underline;
    font-weight: 500;
  }
  .privacy-policy__content a:hover {
    color: var(--green);
  }
  .privacy-policy__content strong {
    color: var(--charcoal);
    font-weight: 600;
  }

  @media (max-width: 600px) {
    .privacy-policy {
      padding: 48px 0 72px;
    }
    .privacy-policy__toc {
      padding: 20px 22px;
      margin-bottom: 36px;
    }
    .privacy-policy__content {
      font-size: 15px;
      line-height: 1.8;
    }
    .privacy-policy__content h2 {
      font-size: 22px;
      margin: 40px 0 14px;
    }
  }
</style>

<?php get_footer(); ?>
