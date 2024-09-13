<?php
/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( 'necromancers_widgets_init' ) ) {
	function necromancers_widgets_init() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'necromancers' ),
				'id'            => 'necromancers-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'necromancers' ),
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'before_widget' => '<div class="widget widget--sidebar %2$s"><div class="widget-content">',
				'after_widget'  => '</div></div>',
			)
		);
		
	}
	add_action( 'widgets_init', 'necromancers_widgets_init' );
}
