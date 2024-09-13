<?php
/**
 * ACF fallback.
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

/**
 * Check if plugin active
 */

if ( ! function_exists( 'necromancers_acf_fallback' ) ) {
  function necromancers_acf_fallback() {
    
    /**
     * ACF fallback (if not installed or activated)
     */
    if ( ! is_admin() && ! function_exists( 'get_field' ) ) {
      function the_field( $selector, $post_id = false, $format_value = true ) {
        return false;
      }

      function get_field( $selector, $post_id = false, $format_value = true ) {
        return false;
      }

      function have_rows( $selector, $post_id = false ) {
        return false;
      }

      function get_sub_field( $selector, $format_value = true ) {
        return false;
      }

      function the_row( $format = false ) {
        return false;
      }
    }
  }
}

add_action( 'init', 'necromancers_acf_fallback' );
