<?php
/**
 * Template Name: Streams Archive
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

get_header();
  ?>
  <main class="site-content" id="wrapper">
    <?php
    /* Start the Loop */
    while ( have_posts() ) :
      the_post();

      get_template_part( 'template-parts/content/content-page-streams' );

    endwhile; // End of the loop.
    ?>
  </main><!-- .site-content -->
  <?php
get_footer();
