<?php

/**
 * Registers the `project_cat` taxonomy,
 * for use with 'project'.
 */
function webinane_donation_project_cat_init() {
	
	$status = webinane_donation_post_is_active('donation_projects_status');

	if( ! $status ) {
		return;
	}

	$slug = get_option('lifeline_donation_project_cat_base');
	$slug = (! $slug) ? 'project_cat' : $slug;
    
	register_taxonomy( 'project_cat', array( 'project' ), apply_filters('webinane_donation_register_project_cat_taxonomy', array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => $slug),
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => esc_html__( 'Project categories', 'lifeline-donation-pro' ),
			'singular_name'              => _x( 'Project category', 'taxonomy general name', 'lifeline-donation-pro' ),
			'search_items'               => esc_html__( 'Search Project categories', 'lifeline-donation-pro' ),
			'popular_items'              => esc_html__( 'Popular Project categories', 'lifeline-donation-pro' ),
			'all_items'                  => esc_html__( 'All Project categories', 'lifeline-donation-pro' ),
			'parent_item'                => esc_html__( 'Parent Project category', 'lifeline-donation-pro' ),
			'parent_item_colon'          => esc_html__( 'Parent Project category:', 'lifeline-donation-pro' ),
			'edit_item'                  => esc_html__( 'Edit Project category', 'lifeline-donation-pro' ),
			'update_item'                => esc_html__( 'Update Project category', 'lifeline-donation-pro' ),
			'view_item'                  => esc_html__( 'View Project category', 'lifeline-donation-pro' ),
			'add_new_item'               => esc_html__( 'Add New Project category', 'lifeline-donation-pro' ),
			'new_item_name'              => esc_html__( 'New Project category', 'lifeline-donation-pro' ),
			'separate_items_with_commas' => esc_html__( 'Separate project categories with commas', 'lifeline-donation-pro' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove project categories', 'lifeline-donation-pro' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used project categories', 'lifeline-donation-pro' ),
			'not_found'                  => esc_html__( 'No project categories found.', 'lifeline-donation-pro' ),
			'no_terms'                   => esc_html__( 'No project categories', 'lifeline-donation-pro' ),
			'menu_name'                  => esc_html__( 'Category', 'lifeline-donation-pro' ),
			'items_list_navigation'      => esc_html__( 'Project Categories list navigation', 'lifeline-donation-pro' ),
			'items_list'                 => esc_html__( 'Project Categories list', 'lifeline-donation-pro' ),
			'most_used'                  => _x( 'Most Used', 'project_cat', 'lifeline-donation-pro' ),
			'back_to_items'              => esc_html__( '&larr; Back to Project cats', 'lifeline-donation-pro' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'project_cat',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) ) );

}
add_action( 'init', 'webinane_donation_project_cat_init' );

/**
 * Sets the post updated messages for the `project_cat` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `project_cat` taxonomy.
 */
function webinane_donation_project_cat_updated_messages( $messages ) {

	$settings = wpcm_get_settings()->get('donation_projects_status');

	if( ! $settings ) {
		return;
	}

	$messages['project_cat'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => esc_html__( 'Project category added.', 'lifeline-donation-pro' ),
		2 => esc_html__( 'Project category deleted.', 'lifeline-donation-pro' ),
		3 => esc_html__( 'Project category updated.', 'lifeline-donation-pro' ),
		4 => esc_html__( 'Project category not added.', 'lifeline-donation-pro' ),
		5 => esc_html__( 'Project category not updated.', 'lifeline-donation-pro' ),
		6 => esc_html__( 'Project category deleted.', 'lifeline-donation-pro' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'webinane_donation_project_cat_updated_messages' );