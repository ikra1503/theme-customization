<?php
/**
 * Mobile Menu
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$mobile_menu_type = get_theme_mod( 'necromancers_header_mobile_menu', 'simple' );

if ( 'simple' === $mobile_menu_type ) :
  if ( has_nav_menu( 'primary' ) ) :
    wp_nav_menu(
      array(
        'theme_location'  => 'primary',
        'container'       => false,
        'menu_class'      => 'mobile-nav__list d-md-none',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'items_wrap'      => '<nav class="mobile-nav mobile-nav--simple"><ul id="%1$s" class="%2$s">%3$s</ul></nav>',
        'depth'           => 0
      )
    );
  endif;
else :
  ?>
  
  <ul class="menu-panel__mobile-bar list-unstyled d-md-none">
    <?php
    // Mobile Navigation
    get_template_part( 'template-parts/page-off-canvas/header-mobile/mobile-navigation');
    
    // Social Links
    get_template_part( 'template-parts/page-off-canvas/header-mobile/social-links');

    // Info
    get_template_part( 'template-parts/page-off-canvas/header-mobile/mobile-info');
    
    // Partners
    get_template_part( 'template-parts/page-off-canvas/header-mobile/mobile-partners');

    // Login
    get_template_part( 'template-parts/page-off-canvas/header-mobile/mobile-login');
    ?>
  </ul>

  <?php
endif;
