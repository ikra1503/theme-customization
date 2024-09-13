<?php
/**
 * Template Name: Page with Side Banner
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

get_header();
	?>
	<main class="site-content" id="wrapper">
		<div class="site-content__inner">
			<div class="site-content__holder">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content-page-side-banner' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			</div>
		</div>
	</main><!-- .site-content -->
	<?php
get_footer();
