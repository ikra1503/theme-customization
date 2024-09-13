<?php
/**
 * Template part for displaying page content in page-fullwidth.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.2.0
 * @version   1.2.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <div class="page-content">
    <?php
    the_content();

    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'necromancers' ),
        'after'  => '</div>',
      )
    );
    ?>
  </div><!-- .page-content -->
</article><!-- #post-<?php the_ID(); ?> -->
