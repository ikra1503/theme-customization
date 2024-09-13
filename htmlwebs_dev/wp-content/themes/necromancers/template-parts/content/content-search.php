<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Necromancers
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post no-post-thumbnail' ); ?>>

	<div class="post__body">
		<?php
		// Header
		get_template_part( 'template-parts/posts/post', 'header' );

		// Excerpt
		get_template_part( 'template-parts/posts/post-excerpt' );
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
