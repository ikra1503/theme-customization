<?php
/**
 * Mobile Navigation
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

// Primary Navigation
if ( has_nav_menu('primary') ) :
  ?>
  <li class="mobile-bar-item">
    <a class="mobile-bar-item__header collapsed" data-toggle="collapse" href="#mobile_menu__primary_menu" role="button" aria-expanded="false" aria-controls="mobile_menu__primary_menu">
      <?php esc_html_e( 'Main Links', 'necromancers'); ?>
      <span class="main-nav__toggle">&nbsp;</span>
    </a>
    <div id="mobile_menu__primary_menu" class="collapse mobile-bar-item__body">
      <?php
        wp_nav_menu(
          array(
            'theme_location'  => 'primary',
            'container'       => false,
            'menu_class'      => 'mobile-nav__list',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'items_wrap'      => '<nav class="mobile-nav"><ul id="%1$s" class="%2$s">%3$s</ul></nav>',
            'depth'           => 0
          )
        );
      ?>
    </div>
  </li>
  <?php
endif;

