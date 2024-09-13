<?php
/**
 * Enqueue scripts and styles on backend
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

if ( ! function_exists( 'necromancers_menus_hook' ) ) {
  function necromancers_menus_hook() {
    wp_enqueue_script(
      'necromancers-menus-scripts',
      get_template_directory_uri() . '/inc/admin/assets/js/menus-scripts.js',
      array( 'jquery' ),
      false,
      true
    );
    wp_enqueue_style(
      'necromancers-menus-styles',
      get_template_directory_uri() . '/inc/admin/assets/css/menus-styles.css'
    );
  }
}

if ( necromancers_theme_is_menus() ) {
  add_action( 'admin_init', 'necromancers_menus_hook' );
}


if ( ! function_exists( 'necromancers_admin_scripts' ) ) {
  function necromancers_admin_scripts() {
    wp_enqueue_script(
      'necromancers-admin-scripts',
      get_template_directory_uri() . '/inc/admin/assets/js/admin-scripts.js',
      array( 'jquery' ),
      false,
      true
    );
  }
}
add_action( 'admin_init', 'necromancers_admin_scripts' );
