<?php
/*
 * Template Name: Thank You
 */
get_header();
?>

<main class="thank-you-page" style="min-height: 60vh;">
  <div class="container" style="max-width: 800px; margin: 0 auto; padding: 80px 24px 0;">

    <!-- Green checkmark -->
    <div style="text-align: center; margin-bottom: 24px;">
      <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <circle cx="40" cy="40" r="40" fill="#84CC9C"/>
        <path d="M24 41L35 52L56 28" stroke="#fff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

    <h1 style="text-align: center; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 2.4rem; color: var(--charcoal); margin-bottom: 16px;">
      Thank you!
    </h1>

    <p style="text-align: center; font-size: 1.15rem; color: var(--charcoal-light); line-height: 1.7; max-width: 640px; margin: 0 auto 48px;">
      Our team will be in touch with you as soon as possible, so please keep an eye on your phone. If you'd prefer to schedule a specific time for your call, feel free to book an appointment below.
    </p>

    <!-- Calendly inline embed -->
    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
    <div class="calendly-inline-widget"
         data-url="https://calendly.com/nationcfh/call-with-tennessee-cash-for-homes"
         style="min-width: 320px; height: 1100px;">
    </div>
    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>

  </div>
</main>

<?php get_footer(); ?>
