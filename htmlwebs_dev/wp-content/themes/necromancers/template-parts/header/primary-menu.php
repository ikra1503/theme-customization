<?php
/**
 * Primary Menu
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

// Primary Navigation
if ( has_nav_menu( 'primary' ) ) {
  wp_nav_menu(
    array(
      'theme_location'  => 'primary',
      'container'       => false,
      'menu_class'      => 'main-nav__list',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'items_wrap'      => '<nav class="main-nav"><ul id="%1$s" class="%2$s">%3$s</ul></nav>',
      'depth'           => 0,
      'walker'          => new Necromancers_Nav_Menu()
    )
  );
}
