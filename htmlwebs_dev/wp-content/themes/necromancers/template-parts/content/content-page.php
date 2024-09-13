<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.0
 */

?>
<div class="site-content__inner">
	<div class="site-content__holder">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			
			<div class="page-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'necromancers' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .page-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>
