<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$content_col_class = is_active_sidebar( 'necromancers-sidebar' ) ? 'col-lg-8' : 'col-lg-8 offset-lg-2';

get_header();

  // Page Heading
  get_template_part( 'template-parts/page-heading/page-heading-blog');
  ?>

  <main class="site-content blog-layout--classic" id="wrapper">
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

              the_posts_pagination();

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

  </main><!-- .site-content -->

<?php
get_sidebar();
get_footer();
