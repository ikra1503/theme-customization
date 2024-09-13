<?php
/**
 * Featured Posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.1
 */

$featured_posts_query = get_theme_mod( 'necromancers_blog_page_featured_posts_query', 'selection' );
?>

<div class="widget-area widger-area--before-loop">
  <div class="widget widget-carousel slick-slider">

    <?php
    // Featured Posts - args
    $featured_posts_args = [
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
    ];

    if ( 'selection' == $featured_posts_query ) {
      // Manually picked posts
      $featured_posts = get_theme_mod( 'necromancers_blog_page_featured_posts', [] );
      $featured_posts_args['post__in'] = $featured_posts;
    } else {
      // Built based on query variables
      $featured_posts_args_cat = get_theme_mod( 'necromancers_blog_page_featured_posts_categories', null );
      $featured_posts_args_tags = get_theme_mod( 'necromancers_blog_page_featured_posts_tags', null );

      $featured_posts_args['posts_per_page'] = get_theme_mod( 'necromancers_blog_page_featured_posts_num', 3 );
      $featured_posts_args['orderby'] = get_theme_mod( 'necromancers_blog_page_featured_posts_orderby', 'date' );
      $featured_posts_args['order'] = get_theme_mod( 'necromancers_blog_page_featured_posts_order', 'DESC' );

      // Categories
      if ( $featured_posts_args_cat && ! $featured_posts_args_cat[0] == '' ) {
        $featured_posts_args['cat'] = $featured_posts_args_cat;
      }

      // Tags
      if ( $featured_posts_args_tags && ! $featured_posts_args_tags[0] == '' ) {
        $featured_posts_args['tag__in'] = $featured_posts_args_tags;
      }
    }

    $featured_posts_query = new WP_Query( $featured_posts_args );

    // Featured Posts - loop
    if ( $featured_posts_query->have_posts() ) :
      while ( $featured_posts_query->have_posts() ) :
        $featured_posts_query->the_post();
        ?>
        <article class="widget-carousel__item post slick-slide">
          <?php if ( has_post_thumbnail() ) : ?>
            <figure class="post__thumbnail">
              <?php the_post_thumbnail( 'necromancers-post-thumbnail-vertical-lg', [ 'loading' => false ] ); ?>
              
            </figure>
          <?php endif; ?>
          <div class="post__body">
            <?php necromancers_entry_meta( ); ?>
            <h2 class="post__title"><?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?></h2>
            <div class="post__meta">
              <?php necromancers_posted_on(); ?>
            </div>
          </div>
        </article>
        <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>
</div>
