<?php
/**
 * The template for displaying Woocommerce pages
 *
 * This is the template that displays all WooCommerce pages by default.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.2.0
 * @version   1.2.0
 */

get_header();

  $wc_content_class = [ 'site-content' ];

  if ( is_product( ) ) {
    $wc_content_class[] = 'site-content--product-single';
  } 
  ?>
  <main class="<?php echo esc_html( implode(' ', $wc_content_class ) ); ?>" id="wrapper">

    <?php
    // Featured Product
    $featured_product = get_theme_mod( 'necromancers_catalog_featured_product_toggle', 'on' );

    if ( $featured_product && ( is_shop() || is_product_category() ) ) {
      get_template_part( 'woocommerce/featured-product/featured-product' );
    }

    /* Start the Loop */
    wp_enqueue_script( 'necromancers-products-filter' );
    // global $wp_query; // you can remove this line if everything works for you

    if ( have_posts() ) {
      woocommerce_content();
    }
    
    if ( $wp_query->max_num_pages > 1 ) :
      echo '<a href="#" id="necromancers_products_loadmore" class="btn btn-tertiary load-more-fab"><i class="fas fa-lg fa-plus load-more-fab__icon"></i></a>';
    endif;
    ?>
  </main><!-- .site-content -->
  <?php
get_footer();
