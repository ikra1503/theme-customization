<?php
/**
 * Posts - Layout 1
 *
 * @author    Dan Fisher
 * @package   Necromancers Assistant
 * @since     1.0.0
 * @version   1.0.2
 */
?>

<div <?php post_class( $post_classes ); ?>>

  <?php if ( has_post_thumbnail() ) : ?>
    <figure class="post__thumbnail">
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail( $post_thumb_size, array( 'class' => '' ) ); ?>
      </a>
    </figure>
  <?php endif; ?>

  <div class="post__body">
    <div class="post__header">
      <?php necromancers_entry_meta(); ?>
      <h2 class="post__title h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="post__meta">
        <?php necromancers_posted_on(); ?>
      </div>
    </div>
  </div>
</div>
