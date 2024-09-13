<?php
/**
 * Blog Post Feed - Layout 4
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
      <a href="<?php the_permalink(); ?>" class="stretched-link position-static">
        <?php the_post_thumbnail( 'post-thumbnail' ); ?>
      </a>
    <?php endif; ?>
  </div>
  <div class="post__body">
    <div class="post__header">
      <?php necromancers_entry_meta(); ?>
      <h2 class="post__title">
        <?php the_title(); ?>
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
    <div class="post__excerpt">
      <?php the_excerpt(); ?>
    </div>
  </div>
</article>
