<?php
/**
 * Menu Panel - Dlmenu
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */


// Page Off Canvas navigation
if ( has_nav_menu( 'primary' ) ) {
  wp_nav_menu(
    array(
      'theme_location'  => 'primary',
      'container'       => false,
      'menu_class'      => 'dl-menu dl-menuopen',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'items_wrap'      => '<div class="menu-panel__navigation"><div id="dl-menu" class="dl-menuwrapper"><ul id="%1$s" class="%2$s">%3$s</ul></div></div>',
      'depth'           => 0,
      'walker'          => new Necromancers_Off_Canvas_Nav()
    )
  );
}
