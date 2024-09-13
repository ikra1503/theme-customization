<?php
/**
 * Blog Post Feed - Layout 3
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.3.0
 */
?>

<article <?php post_class( 'post' ); ?>>
  <div class="post__thumbnail">
    <?php if ( has_post_thumbnail() ) : ?>
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail( 'post-thumbnail' ); ?>
      </a>
    <?php endif; ?>
  </div>
  <div class="post__body">
    <div class="post__header">
      <?php necromancers_entry_meta(); ?>
      <h2 class="post__title h4">
        <?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?>
      </h2>
      <div class="post__meta">
        <?php
        // Post Date
        necromancers_posted_on();
        
        // Post Author
        if ( get_theme_mod( 'necromancers_blog_meta_author', false ) ) {
          necromancers_posted_by();
        }
        ?>
      </div>
    </div>
  </div>
</article>
