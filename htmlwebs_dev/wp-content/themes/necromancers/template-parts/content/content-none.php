<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

?>

<div class="page-not-found">
  <div class="page-content">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
      <div class="alert alert-info font-weight-normal">
        <?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'necromancers' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?>
      </div>
    <?php elseif ( is_search() ) : ?>
      <div class="alert alert-warning font-weight-normal">
        <strong><?php esc_html_e( 'Nothing Found!', 'necromancers' ); ?></strong><br>
        <?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'necromancers' ); ?>
      </div>
    <?php else : ?>
      <div class="alert alert-warning font-weight-normal">
        <?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'necromancers' ); ?>
      </div>
    <?php endif; ?>
  </div><!-- .page-content -->
</div>
