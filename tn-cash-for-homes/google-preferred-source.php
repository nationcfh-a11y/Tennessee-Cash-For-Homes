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
 * The button itself is rendered by Google's publisher.js, which appends a
 * CROSS-ORIGIN IFRAME (news.google.com/swg/ui/v1/addpreferredsourcebuttoniframe)
 * inside the element carrying the `google-add-preferred-source-btn` attribute.
 * The real click therefore lands inside Google's document, not ours — nothing
 * in the parent page can observe it. See the analytics note below.
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
 * Only the fallback anchor is actually observable by a GTM click trigger. The
 * primary button is inside Google's iframe and cannot be measured from here.
 *
 * ── WHY THE SCRIPT BELOW IS NOT JUST A TIMEOUT ──
 * It used to be: after 3s, if the slot had no children, hide the slot and show
 * the fallback, permanently. That produced an intermittently missing button two
 * ways. If publisher.js landed after the 3s mark it rendered into a slot that
 * was already display:none, so nothing was visible at all. And a slot with a
 * child was assumed healthy, so an iframe Google rendered and then collapsed to
 * zero height (which happens when it re-measures, e.g. on the resize a mobile
 * URL-bar show/hide fires while scrolling to the bottom of a post) left an
 * empty box with the fallback still hidden.
 *
 * Judging the slot by rendered height fixed the detection. It did not fix the
 * two ways the block could still end up showing NOTHING for the rest of the
 * page's life:
 *
 *   1. Nothing re-checked after the first few seconds. The listeners were
 *      resize / orientationchange / load / pageshow plus a poll that stopped
 *      after 12 ticks. Scrolling fires none of those on desktop, so a button
 *      that collapsed as the reader scrolled past it was never re-evaluated.
 *   2. The settle timer could clear itself into a dead end. If isHealthy() went
 *      momentarily true at the instant the timer fired, the timer exited
 *      without setting a state and without rearming, leaving an empty slot and
 *      a hidden fallback until some other event happened to fire.
 *
 * The rule now is that the block is never allowed to show nothing. After a
 * short initial grace for publisher.js to load, the state is always exactly one
 * of "Google's button is confirmed painted" or "the fallback link is visible",
 * and every timer path ends by committing to one of them. Detection is
 * scroll-aware and keeps a slow heartbeat for the life of the page, so a late
 * render or a recovery still hands the space back to the real button.
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
      Google appends its iframe into this element and overwrites its inline
      styles with position:relative; width:100%; min-height:60px — the parent
      .preferred-source__action is sized in CSS to accommodate that.
    -->
    <div class="preferred-source__slot" google-add-preferred-source-btn data-theme="light" data-lang="en"></div>

    <!--
      Fallback deeplink. Hidden by default and revealed only while Google's
      button is absent or collapsed, so readers never see two competing
      buttons and never see an empty box. See the script below.
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

  // A rendered Google button is an iframe roughly 40-60px tall. Anything
  // shorter than this is a slot that is empty, still loading, or one Google
  // rendered into and then collapsed.
  var MIN_HEIGHT = 24;
  // Grace for the async publisher.js load. Until it expires the block shows
  // neither control and just holds its reserved height, which is what keeps a
  // normal page load from flashing the fallback before Google's button lands.
  var GRACE_MS = 3000;
  // Once grace is over an unhealthy slot must surface the fallback. This delay
  // exists only to ride out the frame or two Google blanks its iframe for while
  // re-measuring; it is deliberately short, because every millisecond of it is
  // a millisecond the reader sees an empty box.
  var SHOW_FALLBACK_MS = 250;

  var started = Date.now();
  var timer = null;
  var scheduled = false;
  var graceOver = false;

  function isHealthy() {
    // Measure the injected iframe, NOT the slot: publisher.js writes an inline
    // min-height:60px onto the slot, so the slot looks tall even when the
    // iframe inside it has collapsed to nothing.
    var el = slot.querySelector('iframe') || slot.firstElementChild;
    if ( ! el ) return false;
    // In fallback state the slot is parked off-screen at a real width, so the
    // iframe still lays out and still reports a height. That is what lets the
    // button come back if Google renders late or recovers from a collapse.
    var box = el.getBoundingClientRect();
    return box.width > 0 && box.height >= MIN_HEIGHT;
  }

  // The single place the visible state changes. Every path that can end a timer
  // goes through here, so the block cannot come to rest showing nothing.
  function commit( healthy ) {
    if ( timer ) { clearTimeout( timer ); timer = null; }
    host.classList.toggle( 'is-fallback', ! healthy );
  }

  function apply() {
    scheduled = false;

    if ( isHealthy() ) {
      // Reclaim the space for the real button immediately. There is no gap to
      // cover here: the fallback is only replaced by something else visible.
      graceOver = true;
      commit( true );
      return;
    }

    if ( ! graceOver && Date.now() - started < GRACE_MS ) {
      // Still inside the initial load window. Show neither, but guarantee a
      // re-check at the moment grace ends so this cannot stall here.
      if ( ! timer ) {
        timer = setTimeout(function () {
          timer = null;
          graceOver = true;
          apply();
        }, Math.max( 0, GRACE_MS - ( Date.now() - started ) ) + 50 );
      }
      return;
    }

    graceOver = true;

    if ( host.classList.contains('is-fallback') || timer ) return;

    timer = setTimeout(function () {
      timer = null;
      // Commit either way. The old code returned without setting a state when
      // the slot looked healthy at this instant, which is how the block got
      // stuck blank.
      commit( isHealthy() );
    }, SHOW_FALLBACK_MS );
  }

  function check() {
    if ( scheduled ) return;
    scheduled = true;
    requestAnimationFrame( apply );
  }

  // The slot's own height is pinned by publisher.js (inline min-height:60px),
  // so it does not move when the iframe inside it collapses. Observe the iframe
  // itself as soon as one shows up.
  var sizeObserver = window.ResizeObserver ? new ResizeObserver( check ) : null;
  var watchedFrame = null;
  function watchFrame() {
    var frame = slot.querySelector('iframe');
    if ( ! frame || frame === watchedFrame ) return;
    if ( sizeObserver && watchedFrame ) sizeObserver.unobserve( watchedFrame );
    watchedFrame = frame;
    if ( sizeObserver ) sizeObserver.observe( frame );
    // A cross-origin iframe still fires load/error on the parent side.
    frame.addEventListener('load', check);
  }

  // publisher.js injects its iframe whenever it finishes loading, which may be
  // well after this script parses. attributes:true matters as much as
  // childList: Google resizes the iframe by rewriting its style attribute, and
  // a collapse to zero height is exactly that and nothing else.
  if ( window.MutationObserver ) {
    new MutationObserver(function () {
      watchFrame();
      check();
    }).observe( slot, {
      childList: true,
      subtree: true,
      attributes: true,
      attributeFilter: ['style', 'height', 'width', 'hidden']
    });
  }
  if ( sizeObserver ) sizeObserver.observe( slot );
  watchFrame();

  // Scrolling is the interaction that actually exposed the bug: on desktop it
  // fires no resize, so without this the button could collapse as the reader
  // moved past it and nothing would ever look again.
  window.addEventListener('scroll', check, { passive: true });
  window.addEventListener('resize', check, { passive: true });
  window.addEventListener('orientationchange', check, { passive: true });
  window.addEventListener('load', check);
  // Back/forward cache restores can resurrect a stale collapsed iframe.
  window.addEventListener('pageshow', check);
  document.addEventListener('visibilitychange', function () {
    if ( ! document.hidden ) check();
  });

  // Heartbeat. Fast while the page settles, then slow but never cancelled:
  // without a standing check, a browser with no ResizeObserver, or a collapse
  // that fires no observable mutation, would leave the block stranded. The work
  // is one getBoundingClientRect, and it is skipped while the tab is hidden.
  var ticks = 0;
  var heartbeat = setInterval(function () {
    ticks++;
    if ( document.hidden ) return;
    watchFrame();
    check();
    if ( ticks === 15 ) {
      clearInterval( heartbeat );
      heartbeat = setInterval(function () {
        if ( document.hidden ) return;
        watchFrame();
        check();
      }, 5000 );
    }
  }, 1000 );

  check();
})();
</script>
