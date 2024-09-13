<?php
/**
 * Header Elements - Menu Toggle
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.1
 */

$widget_primary   = get_theme_mod( 'necromancers_off_canvas_widget_primary', false );
$widget_secondary = get_theme_mod( 'necromancers_off_canvas_widget_secondary', false );
$widget_partners  = get_theme_mod( 'necromancers_off_canvas_partners', false );
$offcanvas_nav    = get_theme_mod( 'necromancers_off_canvas_nav', true );

$toggle_class = ( ! $widget_primary && ! $widget_secondary && ! $widget_partners && ! $offcanvas_nav ) ? 'd-xl-none' : '';
?>

<div class="header-menu-toggle <?php echo esc_attr( $toggle_class ); ?>">
  <div class="header-menu-toggle__inner">
    <span>&nbsp;</span>
    <span>&nbsp;</span>
    <span>&nbsp;</span>
  </div>
</div>
