<?php
/**
 * Template Name: Centered Page
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

get_header();
  
  $subtitle = get_field( 'ncr_page_subtitle' );
  ?>
  <main class="site-content site-content--center page" id="wrapper">
    <div class="container container--large">
      <div class="page-heading page-heading--default text-center w-100">
        <?php
        if ( $subtitle ) :
          ?>
          <div class="page-heading__subtitle h5">
            <span class="color-primary"><?php echo esc_html( $subtitle ); ?></span>
          </div>
          <?php
        endif;
        ?>
        <h1 class="page-heading__title h-lead-2"><?php the_title(); ?></h1>
      </div>
      <div class="mt-sm-auto mb-sm-auto">
        <?php
        /* Start the Loop */
        while ( have_posts() ) :
          the_post();

          the_content();

        endwhile; // End of the loop.
        ?>
      </div>
    </div>
  </main><!-- .site-content -->
  <?php
get_footer();
