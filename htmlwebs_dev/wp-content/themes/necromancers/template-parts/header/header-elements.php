<?php
/**
 * Header Elements
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.3.1
 */

$blog_layout = get_theme_mod( 'necromancers_blog_page_layout', 'default' );
?>

<div class="header-actions">

  <?php
  // Header Player Navigation
  if ( is_singular( 'sp_team' ) && get_theme_mod( 'necromancers_sp_team_player_list', 'slider' ) == 'carousel' ) {
    get_template_part( 'template-parts/header/header-elements/header-players-nav' );
  }

  // Header Posts Filter
  if ( is_home() && 'default' !== $blog_layout || ( is_front_page() && is_home() && 'default' !== $blog_layout ) ) {
    get_template_part( 'template-parts/header/header-elements/header-posts-filter' );
  }

  // Header Products Filter
  if ( class_exists( 'Woocommerce' ) ) {
    if ( is_shop() ) {
      get_template_part( 'template-parts/header/header-elements/header-products-filter' );
    }
  }

  // Header Social Links Toggle
  if ( get_theme_mod( 'necromancers_header_social_links', true ) ) {
    get_template_part( 'template-parts/header/header-elements/header-social-links' );
  }

  // Header Cart Toggle
  if ( class_exists( 'Woocommerce' ) ) {
    if ( get_theme_mod( 'necromancers_header_cart', true ) ) {
      get_template_part( 'template-parts/header/header-elements/header-cart-toggle' );
    }
  }

  // Header Search Toggle
  if ( get_theme_mod( 'necromancers_header_search_form', true ) ) {
    get_template_part( 'template-parts/header/header-elements/header-search-toggle' );
  }

  // Header Account
  if ( get_theme_mod( 'necromancers_header_login_logout' , true ) ) {
    get_template_part( 'template-parts/header/header-elements/header-account' );
  }

  if ( has_nav_menu( 'primary' ) ) {
    // Header Menu Toggle
    get_template_part( 'template-parts/header/header-elements/header-menu-toggle' );
  }
  ?>
  
</div>
