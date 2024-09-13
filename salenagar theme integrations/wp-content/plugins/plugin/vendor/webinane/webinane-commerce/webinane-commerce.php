<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



defined( 'WNCM_FILE' ) || define( 'WNCM_FILE', __FILE__ );
defined( 'WNCM_PATH' ) || define( 'WNCM_PATH', plugin_dir_path( WNCM_FILE ) );
defined( 'WNCM_URL' ) || define( 'WNCM_URL', plugin_dir_url( WNCM_FILE ) );

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function webincom_load_textdomain() {
	load_plugin_textdomain( 'webinane-commerce', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action( 'plugins_loaded', 'webincom_load_textdomain' );


// Include the main WPCommerce class.
if ( ! class_exists( 'WebinaneCommerce\Loader' ) ) {
	include_once WNCM_PATH . 'includes/Loader.php';
}
add_action( 'wp_ajax_get_custom_media_list', function() {
    if ( ! current_user_can( 'upload_files' ) ) {
        wp_send_json_error();
    }

    if ( ! isset( $_REQUEST['id'] ) ) {
        wp_send_json_error();
    }

    if ( strpos($_REQUEST['id'], ',') ) {
        $ids = explode( ',', $_REQUEST['id'] );
    } else {
        $ids = (array) $_REQUEST['id'];
    }

    $ids = array_filter($ids);

    foreach ($ids as $id) {
        
        $id = absint( $id );
        if ( ! $id ) {
            wp_send_json_error();
        }

        $post = get_post( $id );
        if ( ! $post ) {
            continue;
            wp_send_json_error();
        }

        if ( 'attachment' !== $post->post_type ) {
            wp_send_json_error();
        }

        $attachment[] = wp_prepare_attachment_for_js( $id );
        if ( ! $attachment ) {
            wp_send_json_error();
        }
    }   

    wp_send_json_success( $attachment );
} );
