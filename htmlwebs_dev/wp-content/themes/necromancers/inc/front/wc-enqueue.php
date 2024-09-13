<?php
/**
 * Enqueue WooCommerce scripts and styles.
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.2.0
 * @version   1.4.2
 */

if ( ! function_exists( 'necromancers_wc_enqueue' ) ) {
  function necromancers_wc_enqueue() {

    $uri = get_template_directory_uri();

    // Styles

    // WooCommerce CSS
    wp_enqueue_style(
      'necromancers-woocommerce',
      $uri . '/assets/css/woocommerce.css',
      array(),
      THEME_VERSION
    );
    
  }
}

add_action( 'wp_enqueue_scripts', 'necromancers_wc_enqueue' );

// Add mini cart dropdown to header
if ( ! function_exists( 'necromancers_add_mini_cart' ) ) {
  function necromancers_add_mini_cart() {
    wp_enqueue_script( 'wc-cart-fragments' );
  }
}
add_action( 'wp_enqueue_scripts', 'necromancers_add_mini_cart' );

// Catalog loop specific scripts
if ( ! function_exists( 'necromancers_wc_products_scripts' ) ) {
  function necromancers_wc_products_scripts() {

    // absolutely need it, because we will get $wp_query->query_vars and $wp_query->max_num_pages from it.
    global $wp_query;

    // Products Script
    wp_register_script(
      'necromancers-products-filter',
      get_template_directory_uri() . '/assets/js/products-filter.js',
      array(),
      THEME_VERSION,
      true
    );
    
    // pass products data to JS if we're on the blog page
    wp_localize_script(
      'necromancers-products-filter',
      'necromancersProductsData',
      [
        'ajaxurl'                => admin_url( 'admin-ajax.php' ), // WordPress AJAX
        'products'               => json_encode( $wp_query->query_vars ), // everything about your loop is here
        'current_page'           => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
        'max_page'               => $wp_query->max_num_pages,
        'filter_txt'             => esc_html__( 'Filter Items', 'necromancers' ),
        'filter_before_send_txt' => esc_html__( 'Filtering...', 'necromancers' ),
      ]
    );
  }
}

add_action( 'wp_enqueue_scripts', 'necromancers_wc_products_scripts' );
