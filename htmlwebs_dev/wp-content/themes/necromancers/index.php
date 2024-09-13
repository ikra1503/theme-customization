<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.7
 */

get_header();

  // Blog Layout
  $blog_layout = get_theme_mod( 'necromancers_blog_page_layout', 'default' );

  $content_wrapper_classes = 'site-content';

  if ( 'default' === $blog_layout ) {
    $content_wrapper_classes .= ' blog-layout--classic';
  }
  ?>

  <main class="<?php echo esc_attr( $content_wrapper_classes ); ?>" id="wrapper">

    <?php
    if ( $blog_layout !== 'default' ) :

      wp_enqueue_script( 'necromancers-posts-filter' );
      
      // Featured Posts
      $featured_posts_toggle = get_theme_mod( 'necromancers_blog_page_featured_posts_toggle', true );

      if ( $featured_posts_toggle ) {
        get_template_part( 'template-parts/featured-posts/featured-posts' );
      }
      ?>

      <div class="content blog-layout--<?php echo esc_attr( $blog_layout ); ?>" id="necromancers_posts_wrap">

        <?php
        if ( have_posts() ) :

          /* Start the Loop */
          while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/loop/post', $blog_layout );

          endwhile;

        endif;
        ?>

      </div>

      <?php
      if ( $wp_query->max_num_pages > 1 ) :
        echo '<a href="#" id="necromancers_loadmore" class="btn btn-tertiary load-more-fab"><i class="fas fa-lg fa-plus load-more-fab__icon"></i></a>';
      endif;

    else :

      // Default (Classic)

      $content_col_class = is_active_sidebar( 'necromancers-sidebar' ) ? 'col-lg-8' : 'col-lg-8 offset-lg-2';
      
      // Page Heading
      get_template_part( 'template-parts/page-heading/page-heading-blog');
      ?>

      <div class="site-content__inner">
        <div class="site-content__holder">
          <div class="container">
            <div class="row">
              <div class="<?php echo esc_attr( $content_col_class ); ?>">
              <?php
              if ( have_posts() ) :

                /* Start the Loop */
                while ( have_posts() ) :
                  the_post();

                  /*
                  * Include the Post-Type-specific template for the content.
                  * If you want to override this in a child theme, then include a file
                  * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                  */
                  get_template_part( 'template-parts/content/content', get_post_type() );

                endwhile;

                necromancers_posts_navigation();

              else :

                get_template_part( 'template-parts/content/content', 'none' );

              endif;
              ?>
              </div>

              <?php if ( is_active_sidebar( 'necromancers-sidebar' ) ) : ?>
                <div class="col-lg-4">
                  <?php get_sidebar(); ?>
                </div>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>

      <?php
    endif;
    ?>

  </main><!-- .site-content -->

<?php
get_footer();
