<?php
/**
 * The template for displaying the footer
 *
 * Contains Footer, Custom Cursor and Preloader.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.0
 */


// Copyright
get_template_part('template-parts/footer/copyright');

// Overlay
get_template_part('template-parts/base/site-overlay');

// Search Panel
if (get_theme_mod('necromancers_header_search_form', true)) {
  get_template_part('template-parts/base/search-panel');
}

// Cart
if (class_exists('Woocommerce')) {
  if (get_theme_mod('necromancers_header_cart', true)) {
    get_template_part('template-parts/base/cart-panel');
  }
}

// Menu Panel
if (has_nav_menu('primary')) {
  get_template_part('template-parts/page-off-canvas/page-off-canvas');
}
?>

</div><!-- .site-wrapper -->

<?php
// Custom Cursor
if (get_theme_mod('necromancers_custom_cursor', false)) {
  get_template_part('template-parts/base/custom-cursor');
}

// Preloader
if (get_theme_mod('necromancers_preloader', true)) {
  get_template_part('template-parts/base/preloader');
}

wp_footer();
?>
<script>
  jQuery(document).ready(function () {
    var $carousel = jQuery('.site-wrapper');
    $carousel.find('.slick-prev').last().remove();
    $carousel.find('.slick-next').last().remove();
  });
</script>
</body>

</html>