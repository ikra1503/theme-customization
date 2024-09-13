<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Necromancers
 */

if ( ! is_active_sidebar( 'necromancers-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="sidebar widget-area">
	<?php dynamic_sidebar( 'necromancers-sidebar' ); ?>
</aside><!-- #secondary -->
