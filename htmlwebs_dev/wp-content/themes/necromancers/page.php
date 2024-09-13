<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.0
 */

get_header();

$content_class = [ 'site-content' ];

if ( class_exists( 'Woocommerce' ) ) {
  if ( is_account_page() ) {
    // add different classes depends on the login state
    $content_class[] = is_user_logged_in() ? 'account-page' : 'login-page';
  } elseif ( is_checkout() ) {
    $content_class[] = 'checkout-page';
  }
}
?>

<main class="<?php echo esc_attr( implode(' ', $content_class ) ); ?>" id="wrapper">
  <?php
  /* Start the Loop */
  while ( have_posts() ) :
    the_post();

    if ( class_exists( 'Woocommerce' ) ) :
      if ( is_account_page() || is_checkout() ) :
        if ( is_wc_endpoint_url( 'order-received' ) ) :
          get_template_part( 'template-parts/content/content-page' );
        else :
          if ( is_user_logged_in() ) {
            the_content();
          } else {
            get_template_part( 'template-parts/content/content-page-fullwidth' );
          }
        endif;
      else :
        get_template_part( 'template-parts/content/content-page' );
      endif;
    else :
      get_template_part( 'template-parts/content/content-page' );
    endif;

    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
      comments_template();
    endif;

  endwhile; // End of the loop.
  ?>
</main><!-- .site-content -->

<?php
get_footer();
