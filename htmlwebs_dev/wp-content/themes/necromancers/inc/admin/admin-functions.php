<?php
/**
 * Functions used on backend
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.0
 */

/**
 * Check if it's a menu page
 */
if ( ! function_exists( 'necromancers_theme_is_menus' ) ) {
  function necromancers_theme_is_menus() {
    global $pagenow;

    if ( $pagenow === 'nav-menus.php' ) {
      return true;
    }

    // to be add some check code for validate only in theme options pages
    return false;
  }
}

// Theme Info
function df_get_theme_info() {
  $theme      = wp_get_theme();
  $theme_name = $theme->get('Name');
  $theme_v    = $theme->get('Version');

  $theme_info = array(
    'name' => $theme_name,
    'slug' => sanitize_file_name( strtolower( $theme_name ) ),
    'v'    => $theme_v,
  );

  return $theme_info;
}

/**
 * Activation helper class
 */
if ( ! function_exists( 'df_is_theme_activated' ) ) {
  function df_is_theme_activated() {
    return apply_filters( 'necromancers_is_theme_activated', false );
  }
}


/**
 * Adds custom classes to the array of admin body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function necromancers_admin_body_classes( $classes ) {

	if ( df_is_theme_activated() ) {
		$classes .= ' necromancers-is-activated';
	} else {
		$classes .= ' necromancers-is-not-activated';
	}

	return $classes;
}
add_filter( 'admin_body_class', 'necromancers_admin_body_classes' );
