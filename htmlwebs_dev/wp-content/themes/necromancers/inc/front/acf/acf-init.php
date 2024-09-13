<?php
/**
 * ACF configuration.
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

/**
 * Fallback
 */
require_once get_template_directory() . '/inc/front/acf/acf-fallback.php';

/**
 * Load ACF fields
 */
require_once get_template_directory() . '/inc/front/acf/acf-fields.php';

/**
 * Disabled update notification
 */
add_action( 'acf/init', 'necromancers_acf_updates' );
function necromancers_acf_updates() {
	acf_update_setting( 'show_updates', false );
}
