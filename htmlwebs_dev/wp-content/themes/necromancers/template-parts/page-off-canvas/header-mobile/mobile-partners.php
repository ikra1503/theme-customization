<?php
/**
 * Mobile Partners
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$partners = get_theme_mod( 'necromancers_off_canvas_partners_imgs', [] );

if ( empty( $partners ) ) {
  return;
}
?>

<li class="mobile-bar-item mobile-bar-item--partners">
  <a class="mobile-bar-item__header collapsed" data-toggle="collapse" href="#mobile_menu__partners" role="button" aria-expanded="false" aria-controls="mobile_menu__partners">
    <?php esc_html_e( 'Our Partners', 'necromancers' ); ?>
    <span class="main-nav__toggle">&nbsp;</span>
  </a>
  <div id="mobile_menu__partners" class="collapse mobile-bar-item__body">
    <div class="mobile-bar-item__inner">
      <?php
      get_template_part(
        'template-parts/page-off-canvas/partners-carousel',
        null,
        [
          'partners' => $partners,
          'class'    => 'widget-partners-mobile-carousel'
        ]
      );
      ?>
    </div>
  </div>
</li>
