<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$post_format = get_post_format();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

  <?php
  // Thumbnail
  necromancers_post_thumbnail();
  ?>

  <div class="post__body">
    <?php
    // Header
    get_template_part( 'template-parts/posts/post', 'header' );

    // Excerpt
    get_template_part( 'template-parts/posts/post-excerpt', $post_format );
    ?>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
