<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

get_header();
?>

	<main id="wrapper" class="site-content">
		<div class="site-content__inner">
			<div class="site-content__holder">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/post/content', 'single' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>
		</div>

	</main><!-- #wrapper -->


<?php
get_footer();
