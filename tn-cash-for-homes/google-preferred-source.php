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
    <p class="preferred-source__title" id="preferred-source-title">Want more Tennessee home-selling guides like this?</p>
    <p class="preferred-source__copy">Add us as a preferred source and Google will show our articles more often when you search. It takes one click and you stay right on this page.</p>
  </div>

  <div class="preferred-source__action">
    <!--
      Google appends its iframe into this element and overwrites its inline
      styles with position:relative; width:100%; min-height:60px — the parent
      .preferred-source__action is sized in CSS to accommodate that.
    -->
    <div google-add-preferred-source-btn data-theme="light" data-lang="en"></div>

    <!--
      Fallback deeplink. Hidden by default and revealed only if publisher.js
      never ran at all (script blocked by an extension or the network), so
      readers never see two competing buttons.
    -->
    <a class="preferred-source__fallback"
       data-track="preferred-source-fallback"
       href="https://www.google.com/preferences/source?q=<?php echo rawurlencode( $tcfh_ps_domain ); ?>"
       target="_blank" rel="noopener">Add us on Google</a>
  </div>
</aside>

<script>
(function () {
  var host = document.querySelector('.preferred-source__action');
  if ( ! host ) return;
  var slot = host.querySelector('[google-add-preferred-source-btn]');
  var fallback = host.querySelector('.preferred-source__fallback');
  // publisher.js is async; give it room to land before deciding it failed.
  // It appends its iframe synchronously once it runs, so an empty slot at this
  // point means the library never executed — not that the button failed to paint.
  setTimeout(function () {
    if ( slot && fallback && slot.children.length === 0 ) {
      slot.style.display = 'none';
      fallback.style.display = 'inline-flex';
    }
  }, 3000);
})();
</script>
