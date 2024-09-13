<?php
/**
 * Displays the post header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$post_format = get_post_format();
?>

<div class="post__header">
	<?php necromancers_entry_meta( 'h6' ); ?>
	<?php get_template_part( 'template-parts/posts/post-header', 'title' ); ?>
	<div class="post__meta">
		<?php necromancers_posted_on(); ?>
		<?php necromancers_entry_tags( 'post__meta-item post__meta-item--tags'); ?>
	</div><!-- .post__meta -->
</div>
