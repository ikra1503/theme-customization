<?php
/**
 * Displays the post header title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

// Don't show the title if the post-format is `aside` or `status`.
$post_format = get_post_format();
if ( ( 'aside' === $post_format || 'status' === $post_format ) ) {
	return;
};

the_title( '<h2 class="post__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
