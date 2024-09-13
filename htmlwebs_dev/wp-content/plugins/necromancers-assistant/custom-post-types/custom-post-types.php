<?php
/**
 * Register Custom Post Types
 *
 * @author    Dan Fisher
 * @package   Necromancers Assistant
 * @since     1.0.0
 * @version   1.0.1
 */

/**
 * Partners Custom Post Type
 */
add_action('init', 'necromancers_partners_custom_init');
function necromancers_partners_custom_init(){

  // Initialize Partners Custom Type Labels
  $labels = array(
    'name'               => _x( 'Partners', 'post type general name', 'necromancers-assistant' ),
    'singular_name'      => _x( 'Partner', 'post type singular name', 'necromancers-assistant' ),
    'add_new'            => _x( 'Add New', 'Partner', 'necromancers-assistant' ),
    'add_new_item'       => esc_html__( 'Add New Partner', 'necromancers-assistant'),
    'edit_item'          => esc_html__( 'Edit Partner', 'necromancers-assistant'),
    'new_item'           => esc_html__( 'New Partner', 'necromancers-assistant'),
    'view_item'          => esc_html__( 'View Partner', 'necromancers-assistant'),
    'search_items'       => esc_html__( 'Search Partners', 'necromancers-assistant'),
    'not_found'          => esc_html__( 'No partners found', 'necromancers-assistant'),
    'not_found_in_trash' => esc_html__( 'No partners found in Trash', 'necromancers-assistant'),
    'parent_item_colon'  => '',
    'menu_name'          => esc_html__( 'Partners', 'necromancers-assistant'),
  );

  $args = array(
    'labels'        => $labels,
    'public'        => true,
    'show_ui'       => true,
    'has_archive'   => true,
    'query_var'     => true,
    'rewrite'       => array(
      'slug' => get_option( 'necromancers_partners_slug', 'partners' ),
    ),
    'menu_position' => 30,
    'menu_icon'     => 'dashicons-money',
    'show_in_rest'  => true,
    'supports' => array(
      'title',
      'thumbnail',
      'excerpt',
    )
  );
  register_post_type( 'partners', $args );

  // Initialize New Categories Labels
  $labels = array(
    'name'              => _x( 'Partners Categories', 'category general name', 'necromancers-assistant' ),
    'singular_name'     => _x( 'Partners Category', 'taxonomy singular name', 'necromancers-assistant' ),
    'search_items'      => esc_html__( 'Search Category', 'necromancers-assistant' ),
    'all_items'         => esc_html__( 'All Categories', 'necromancers-assistant' ),
    'parent_item'       => esc_html__( 'Parent Category', 'necromancers-assistant' ),
    'parent_item_colon' => esc_html__( 'Parent Category:', 'necromancers-assistant' ),
    'edit_item'         => esc_html__( 'Edit Category', 'necromancers-assistant' ),
    'update_item'       => esc_html__( 'Update Category', 'necromancers-assistant' ),
    'add_new_item'      => esc_html__( 'Add New Category', 'necromancers-assistant' ),
    'new_item_name'     => esc_html__( 'New Category Name', 'necromancers-assistant' ),
  );

  // Custom taxonomy for Album Categories
  register_taxonomy( 'catpartners', array('partners'), array(
    'hierarchical' => true,
    'public'       => true,
    'labels'       => $labels,
    'show_ui'      => true,
    'query_var'    => true,
    'rewrite'      => array(
      'slug' => 'cat-partners'
    ),
  ));
}
