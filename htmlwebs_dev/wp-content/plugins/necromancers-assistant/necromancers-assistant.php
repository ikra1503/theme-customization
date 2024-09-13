<?php
/*
Plugin Name: Necromancers Assistant
Plugin URI: https://themeforest.net/user/dan_fisher/portfolio
Description: This plugin adds social sharing, widgets, custom post types to Necromancers WordPress Theme.
Version: 1.0.2
Author: Dan Fisher
Author URI: https://themeforest.net/user/dan_fisher
Text Domain: necromancers-assistant
License: GPLv2
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/*
 * 1. PLUGIN GLOBAL VARIABLES
 */

// Plugin Paths
if (!defined('NCRASSISTANT_THEME_DIR'))
    define('NCRASSISTANT_THEME_DIR', get_stylesheet_directory());

if (!defined('NCRASSISTANT_PLUGIN_NAME'))
    define('NCRASSISTANT_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('NCRASSISTANT_PLUGIN_DIR'))
    define('NCRASSISTANT_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . NCRASSISTANT_PLUGIN_NAME);

if (!defined('NCRASSISTANT_PLUGIN_URL'))
    define('NCRASSISTANT_PLUGIN_URL', WP_PLUGIN_URL . '/' . NCRASSISTANT_PLUGIN_NAME);

// Plugin Version
if (!defined('NCRASSISTANT_VERSION_KEY'))
    define('NCRASSISTANT_VERSION_KEY', 'ncrsocial_version');

if (!defined('NCRASSISTANT_VERSION_NUM'))
    define('NCRASSISTANT_VERSION_NUM', '1.0.2');


// echo '<pre>' . var_export(NCRASSISTANT_PLUGIN_URL, true). '</pre>';


/*
 * 2. INCLUDES
 */

// Social Share
include NCRASSISTANT_PLUGIN_DIR . '/includes/social-share/social-share.php';

// Widgets
include NCRASSISTANT_PLUGIN_DIR . '/includes/widgets/widget-posts.php';
include NCRASSISTANT_PLUGIN_DIR . '/includes/widgets/widget-recent-comments.php';

// Custom Post Types
include NCRASSISTANT_PLUGIN_DIR . '/custom-post-types/admin-permalinks-settings.php';
include NCRASSISTANT_PLUGIN_DIR . '/custom-post-types/custom-post-types.php';



/*
 * 3. TRANSLATION
 */

add_action( 'plugins_loaded', 'ncr_assistant_language_init' );
function ncr_assistant_language_init() {
  load_plugin_textdomain( 'necromancers-assistant', false, NCRASSISTANT_PLUGIN_URL . '/languages/' );
}
