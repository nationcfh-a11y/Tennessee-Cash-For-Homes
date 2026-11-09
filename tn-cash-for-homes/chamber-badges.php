<?php
/**
 * "Proud Member of" chamber of commerce badges, linking to our listing in each
 * chamber's member directory.
 *
 * Static on purpose: the chambers' own embed (ChamberMaster Member.js) loads a
 * third-party script on every page view. The logos are the ones that embed
 * shows, saved locally as small WebP files.
 *
 * Args (get_template_part( 'chamber-badges', null, $args )):
 *   chambers  keys from the list below, in display order
 *   size      'small' for the compact homepage version (optional)
 */
$tcfh_chambers = array(
    'spring-hill' => array(
        'name' => 'Spring Hill Chamber of Commerce',
        'url'  => 'https://springhillchambertn.chambermaster.com/list/member/tennessee-cash-for-homes-1659366',
        'logo' => 'spring-hill-chamber-logo.webp',
    ),
    'maury' => array(
        'name' => 'Maury County Chamber & Economic Alliance',
        'url'  => 'https://mauryalliance.chambermaster.com/list/member/tennessee-cash-for-homes-14926',
        'logo' => 'maury-alliance-logo.webp',
    ),
);

$tcfh_want = isset( $args['chambers'] ) ? (array) $args['chambers'] : array();
$tcfh_keys = array_values( array_intersect( $tcfh_want, array_keys( $tcfh_chambers ) ) );
if ( ! $tcfh_keys ) return;

$tcfh_small = isset( $args['size'] ) && 'small' === $args['size'];
$tcfh_img   = $tcfh_small ? 40 : 56;

echo '<div class="chamber-badges' . ( $tcfh_small ? ' chamber-badges--small' : '' ) . '">';
foreach ( $tcfh_keys as $tcfh_key ) :
    $tcfh_c = $tcfh_chambers[ $tcfh_key ];
    ?>
<a class="chamber-badge<?php echo $tcfh_small ? ' chamber-badge--small' : ''; ?>" href="<?php echo esc_url( $tcfh_c['url'] ); ?>" target="_blank" rel="noopener">
  <img class="chamber-badge__logo" src="<?php echo esc_url( get_template_directory_uri() . '/brand_assets/' . $tcfh_c['logo'] ); ?>" alt="<?php echo esc_attr( 'Proud member of the ' . $tcfh_c['name'] ); ?>" width="<?php echo $tcfh_img; ?>" height="<?php echo $tcfh_img; ?>" loading="lazy" decoding="async" />
  <span class="chamber-badge__text">
    <span class="chamber-badge__eyebrow">Proud Member of</span>
    <span class="chamber-badge__name"><?php echo esc_html( $tcfh_c['name'] ); ?></span>
  </span>
</a>
<?php
endforeach;
echo '</div>';
