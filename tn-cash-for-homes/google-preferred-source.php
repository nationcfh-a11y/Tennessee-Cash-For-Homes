<?php
/**
 * Google Preferred Sources button.
 *
 * Reader opt-in, not an endorsement badge: a visitor who clicks this marks
 * tennesseecashforhomes.com as a preferred source on their own Google account,
 * which surfaces our articles more often in Top Stories, AI Mode and AI
 * Overviews — for that reader only.
 *
 * Docs: https://developers.google.com/search/docs/appearance/preferred-sources
 *
 * The button itself is rendered by Google's publisher.js into an OPEN SHADOW
 * ROOT attached to the element carrying the `google-add-preferred-source-btn`
 * attribute: a <publisher-md-outlined-button> custom element, roughly 218x40.
 * Nothing is added to the light DOM, so slot.children is always empty even
 * when the button is on screen. (Older versions of publisher.js appended a
 * cross-origin iframe instead; the script below still accepts that.)
 *
 * publisher.js is loaded in <head> under the identical is_singular('post')
 * condition — see functions.php.
 *
 * Preference is domain-level, so one button per page is enough. Loaded via
 * get_template_part('google-preferred-source') at the end of single.php.
 *
 * ── ANALYTICS ──
 * This partial is deliberately markup-only: no gtag, no dataLayer.push. It
 * exposes stable hooks for GTM to bind click triggers to:
 *
 *   #preferred-source-block        wrapper  [data-track="preferred-source"]
 *   .preferred-source__fallback    anchor   [data-track="preferred-source-fallback"]
 *
 * Clicks inside the shadow root are retargeted to the slot element, so a GTM
 * click trigger sees them on [google-add-preferred-source-btn], not on
 * Google's inner button.
 *
 * ── WHY THE BUTTON KEPT DISAPPEARING ──
 * Every earlier version of the script below decided whether Google's button
 * existed by looking at the slot's light-DOM children (or for an iframe in
 * them). Because the button lives in a shadow root, that check always said
 * "missing". The first version hid the whole card after 3s; the next one
 * parked Google's working button off-screen after 3s and swapped in the
 * fallback link, which readers saw as the button changing while they scrolled.
 *
 * The rule now: Google's button is the button. Once it has been seen painted
 * at a real size it is locked in for the life of the page and the script
 * stops watching. The fallback link appears only if Google's button has not
 * painted by the end of the grace period (script blocked, network failure),
 * and even then a late render takes the space back. There is never a swap
 * away from Google's button.
 */

// Explicit guard rather than relying on the template hierarchy. single.php is
// currently reached only by blog posts, but that holds only while attachment
// pages stay redirected and while no custom post type is registered — neither
// is a guarantee. Must stay identical to the wp_head condition in functions.php
// that loads publisher.js.
if ( ! is_singular( 'post' ) ) {
    return;
}

// Domain-level only — Google ignores paths on the deeplink fallback.
$tcfh_ps_domain = wp_parse_url( home_url(), PHP_URL_HOST );
?>
<!-- ── GOOGLE PREFERRED SOURCES ── -->
<aside class="preferred-source"
       id="preferred-source-block"
       data-track="preferred-source"
       aria-labelledby="preferred-source-title">
  <div class="preferred-source__text">
    <p class="preferred-source__title" id="preferred-source-title">Want more Tennessee home-selling guides?</p>
    <p class="preferred-source__copy">Add us as a preferred source and Google will show our articles more often when you search. One click, and you stay on this page.</p>
  </div>

  <div class="preferred-source__action" id="preferred-source-action">
    <!--
      Google attaches a shadow root to this element and renders its button
      inside it. The parent .preferred-source__action reserves the height so
      the async render does not shift layout.
    -->
    <div class="preferred-source__slot" google-add-preferred-source-btn data-theme="light" data-lang="en"></div>

    <!--
      Fallback deeplink. Hidden by default and revealed only if Google's
      button has not painted by the end of the grace period, so readers never
      see two competing buttons and never see an empty box. See the script.
    -->
    <a class="preferred-source__fallback"
       data-track="preferred-source-fallback"
       href="https://www.google.com/preferences/source?q=<?php echo rawurlencode( $tcfh_ps_domain ); ?>"
       target="_blank" rel="noopener">Add us on Google</a>
  </div>
</aside>

<script>
(function () {
  var host = document.getElementById('preferred-source-action');
  if ( ! host ) return;
  var slot = host.querySelector('[google-add-preferred-source-btn]');
  var fallback = host.querySelector('.preferred-source__fallback');
  if ( ! slot || ! fallback ) return;

  // Google's button is ~40px tall. Anything shorter has not painted yet.
  var MIN_HEIGHT = 24;
  // Grace for the async publisher.js load. Until it expires the block shows
  // neither control and just holds its reserved height, so a normal page load
  // never flashes the fallback before Google's button lands.
  var GRACE_MS = 3000;

  var locked = false;
  var observer = null;
  var poll = null;

  function googleButton() {
    // Current publisher.js: a custom element inside an open shadow root.
    if ( slot.shadowRoot ) {
      var inner = slot.shadowRoot.querySelector('publisher-md-outlined-button') ||
                  slot.shadowRoot.querySelector('button, [role="button"]');
      if ( inner ) return inner;
    }
    // Older publisher.js: a cross-origin iframe in the light DOM.
    return slot.querySelector('iframe') || slot.firstElementChild;
  }

  function isPainted() {
    var el = googleButton();
    if ( ! el ) return false;
    // In fallback state the slot is parked off-screen at a real width, so the
    // button still lays out and reports a size. That is what lets a late
    // render take the space back.
    var box = el.getBoundingClientRect();
    return box.width > 0 && box.height >= MIN_HEIGHT;
  }

  // Google's button has painted: show it and never look again. Re-measuring
  // after this point is what used to swap a working button for the fallback.
  function lockToGoogle() {
    locked = true;
    host.classList.remove('is-fallback');
    if ( observer ) observer.disconnect();
    if ( poll ) clearInterval( poll );
  }

  function check() {
    if ( ! locked && isPainted() ) lockToGoogle();
  }

  // publisher.js marks the slot data-initialized and attaches its shadow root
  // whenever it finishes loading, which may be after this script parses.
  if ( window.MutationObserver ) {
    observer = new MutationObserver( check );
    observer.observe( slot, { attributes: true, childList: true } );
  }
  // A shadow root's contents fire no mutations on the host, so poll as well:
  // quickly while the page settles, then slowly in case the library is late.
  var ticks = 0;
  poll = setInterval(function () {
    ticks++;
    check();
    if ( ticks === 20 && ! locked ) {
      clearInterval( poll );
      poll = setInterval( check, 5000 );
    }
  }, 250 );

  setTimeout(function () {
    check();
    if ( ! locked ) host.classList.add('is-fallback');
  }, GRACE_MS );

  check();
})();
</script>
