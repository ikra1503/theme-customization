<?php

namespace LifelineDonation\PostTypes;

class Cause
{
	public static $_instance;

	function init() {
		add_action( 'init', [$this, 'register'] );

		add_filter( 'post_updated_messages', [$this, 'updated_messages'] );

		add_action( 'load-options-permalink.php', [$this, 'load_permalinks'] );
	}

	public static function instance() {
		if(is_null(self::$_instance)) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	/**
	 * Registers the `cause` post type.
	 */
	function register() {

		$status = webinane_donation_post_is_active('donation_causes_status');

		if( ! $status ) {
			return;
		}
		$slug = get_option('lifeline_donation_cause_base');
		$slug = (! $slug) ? 'cause' : $slug;


		$post_type = apply_filters('lifeline2_donation_cause_post', [
			'slug'=> 'cause',
			'args'=> apply_filters( 'webinane_donation_register_cause_post_type', [
				'labels'                => [
					'name'                  => esc_html__( 'Causes',
						'lifeline-donation-pro' ),
					'singular_name'         => esc_html__( 'Cause',
						'lifeline-donation-pro' ),
					'all_items'             => esc_html__( 'All Causes',
						'lifeline-donation-pro' ),
					'archives'              => esc_html__( 'Cause Archives',
						'lifeline-donation-pro' ),
					'attributes'            => esc_html__( 'Cause Attributes',
						'lifeline-donation-pro' ),
					'insert_into_item'      => esc_html__( 'Insert into Cause',
						'lifeline-donation-pro' ),
					'uploaded_to_this_item' => esc_html__( 'Uploaded to this Cause',
						'lifeline-donation-pro' ),
					'featured_image'        => _x( 'Featured Image', 'cause',
						'lifeline-donation-pro' ),
					'set_featured_image'    => _x( 'Set featured image', 'cause',
						'lifeline-donation-pro' ),
					'remove_featured_image' => _x( 'Remove featured image', 'cause',
						'lifeline-donation-pro' ),
					'use_featured_image'    => _x( 'Use as featured image', 'cause',
						'lifeline-donation-pro' ),
					'filter_items_list'     => esc_html__( 'Filter Causes list',
						'lifeline-donation-pro' ),
					'items_list_navigation' => esc_html__( 'Causes list navigation',
						'lifeline-donation-pro' ),
					'items_list'            => esc_html__( 'Causes list',
						'lifeline-donation-pro' ),
					'new_item'              => esc_html__( 'New Cause',
						'lifeline-donation-pro' ),
					'add_new'               => esc_html__( 'Add New',
						'lifeline-donation-pro' ),
					'add_new_item'          => esc_html__( 'Add New Cause',
						'lifeline-donation-pro' ),
					'edit_item'             => esc_html__( 'Edit Cause',
						'lifeline-donation-pro' ),
					'view_item'             => esc_html__( 'View Cause',
						'lifeline-donation-pro' ),
					'view_items'            => esc_html__( 'View Causes',
						'lifeline-donation-pro' ),
					'search_items'          => esc_html__( 'Search Causes',
						'lifeline-donation-pro' ),
					'not_found'             => esc_html__( 'No Causes found',
						'lifeline-donation-pro' ),
					'not_found_in_trash'    => esc_html__( 'No Causes found in trash',
						'lifeline-donation-pro' ),
					'parent_item_colon'     => esc_html__( 'Parent Cause:',
						'lifeline-donation-pro' ),
					'menu_name'             => esc_html__( 'Causes',
						'lifeline-donation-pro' ),
				],
				'public'                => TRUE,
				'hierarchical'          => FALSE,
				'show_ui'               => TRUE,
				'show_in_nav_menus'     => TRUE,
				'supports'              => [
					'title',
					'editor',
					'thumbnail',
					'author'
				],
				'has_archive'           => TRUE,
				'rewrite'               => array('slug' => $slug),
				'query_var'             => TRUE,
				'menu_icon'             => 'dashicons-palmtree',
				'show_in_rest'          => TRUE,
				'rest_base'             => 'cause',
				'rest_controller_class' => 'WP_REST_Posts_Controller',
			] )
		]);

		if(empty($post_type)){
			return;
		}

		register_post_type( $post_type['slug'], $post_type['args']);

	}

	/**
	 * Sets the post updated messages for the `cause` post type.
	 *
	 * @param  array $messages Post updated messages.
	 * @return array Messages for the `cause` post type.
	 */
	function updated_messages( $messages ) {
		global $post;

		$status = webinane_donation_post_is_active('donation_causes_status');

		if( ! $status ) {
			return;
		}

		$permalink = get_permalink( $post );

		$messages['cause'] = array(
			0  => '', // Unused. Messages start at index 1.
			/* translators: %s: post permalink */
			1  => sprintf( __( 'Cause updated. <a target="_blank" href="%s">View Cause</a>', 'lifeline-donation-pro' ), esc_url( $permalink ) ),
			2  => esc_html__( 'Custom field updated.', 'lifeline-donation-pro' ),
			3  => esc_html__( 'Custom field deleted.', 'lifeline-donation-pro' ),
			4  => esc_html__( 'Cause updated.', 'lifeline-donation-pro' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Cause restored to revision from %s', 'lifeline-donation-pro' ), wp_post_revision_title( (int) sanitize_text_field($_GET['revision']), false ) ) : false,
			/* translators: %s: post permalink */
			6  => sprintf( __( 'Cause published. <a href="%s">View Cause</a>', 'lifeline-donation-pro' ), esc_url( $permalink ) ),
			7  => esc_html__( 'Cause saved.', 'lifeline-donation-pro' ),
			/* translators: %s: post permalink */
			8  => sprintf( __( 'Cause submitted. <a target="_blank" href="%s">Preview Cause</a>', 'lifeline-donation-pro' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
			/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
			9  => sprintf( __( 'Cause scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Cause</a>', 'lifeline-donation-pro' ),
			date_i18n( __( 'M j, Y @ G:i', 'lifeline-donation-pro' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
			/* translators: %s: post permalink */
			10 => sprintf( __( 'Cause draft updated. <a target="_blank" href="%s">Preview Cause</a>', 'lifeline-donation-pro' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		);

		return $messages;
	}

	/**
	 * Set the permalink settings.
	 */
	function load_permalinks() {

        if( isset( $_POST['lifeline_donation_cause_base'] ) ) {
            update_option( 'lifeline_donation_cause_base', sanitize_title_with_dashes( $_POST['lifeline_donation_cause_base'] ) );
        }
        if( isset( $_POST['lifeline_donation_cause_cat_base'] ) ) {
            update_option( 'lifeline_donation_cause_cat_base', sanitize_title_with_dashes( $_POST['lifeline_donation_cause_cat_base'] ) );
        }

        // Add a settings field to the permalink page
        add_settings_field( 'lifeline_donation_cause_base', __( 'Cause Base', 'lifeline-donation-pro' ), [$this, 'cause_callback'], 'permalink', 'optional' );
        add_settings_field( 'lifeline_donation_cause__cat_base', __( 'Cause Category Base', 'lifeline-donation-pro' ), [$this, 'cause_category_callback'], 'permalink', 'optional' );

        
    }

    function cause_callback()
    {
        $value = get_option( 'lifeline_donation_cause_base' );   
        $value = ($value) ? $value : 'cause'; 
        $is_multi = is_multisite() ? '' : '';
        echo $is_multi.'<input type="text" value="' . esc_attr( $value ) . '" name="lifeline_donation_cause_base" id="lifeline_donation_cause_base" class="regular-text" />';
    }

    /**
     * Cause Category slug
     */
    function cause_category_callback()
    {
        $value = get_option( 'lifeline_donation_cause_cat_base' );
        $value = ($value) ? $value : 'cause_cat';

        $is_multi = is_multisite() ? '' : '';
        echo $is_multi.'<input type="text" value="' . esc_attr( $value ) . '" name="lifeline_donation_cause_cat_base" id="lifeline_donation_cause_cat_base" class="regular-text" />';
    }
}


Cause::instance()->init();
