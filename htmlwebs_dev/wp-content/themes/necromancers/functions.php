<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.5.1
 */

// define( 'NRC_DEV_MODE', true );
if (!defined('THEME_VERSION')) {
  // Replace the version number of the theme on each release.
  define('THEME_VERSION', wp_get_theme(get_template())->get('Version'));
}

if (!defined('NRC_DEV_MODE')) {
  // If dev mode is not defined switch ACF to lite mode.
  add_filter('acf/settings/show_admin', '__return_false');
}

if (!function_exists('necromancers_setup')):
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function necromancers_setup()
  {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('necromancers', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(385, 385, true); // Normal post thumbnails
    add_image_size('necromancers-single-post-thumbnail', 1200, 800, false); // Thumbnail Normal
    add_image_size('necromancers-post-thumbnail-rect-sm', 370, 130, true); // Thumbnail Small Rectangle
    add_image_size('necromancers-post-thumbnail-rect-md', 500, 250, true); // Thumbnail Medium Rectangle
    add_image_size('necromancers-post-thumbnail-rect-xmd', 580, 348, true); // Thumbnail Medium Alt Rectangle
    add_image_size('necromancers-post-thumbnail-rect-xl', 770, 367, true); // Thumbnail Large Rectangle
    add_image_size('necromancers-post-thumbnail-vertical-lg', 540, 700, true); // Thumbnail Large Vertical

    add_image_size('necromancers-sp-fit-icon-sm', 90, 90, false); // SP - Icon Small
    add_image_size('necromancers-sp-fit-md', 330, 440, false); // SP - Medium
    add_image_size('necromancers-sp-fit-lg', 680, 850, false); // SP - Large
    add_image_size('necromancers-sp-fit-xl', 920, 1120, false); // SP - Extra Large

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
      array(
        'primary' => esc_html__('Primary', 'necromancers'),
      )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
      'html5',
      array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
      )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
      'custom-logo',
      array(
        'height' => 200,
        'width' => 200,
        'flex-width' => true,
        'flex-height' => true,
      )
    );

    /*
     * Declare support for Sportspress.
     */
    add_theme_support('sportspress');

    /**
     * Disable Widgets Block Editor
     */
    remove_theme_support('widgets-block-editor');

    /*
     * Enable support for WooCommerce
     */
    add_theme_support(
      'woocommerce',
      [
        'thumbnail_image_width' => 348,
        'gallery_thumbnail_image_width' => 100,
        'single_image_width' => 500,
        'product_grid' => array(
          'default_columns' => 3,
          'min_columns' => 1,
          'max_columns' => 10,
          'default_rows' => 2,
          'min_rows' => 1,
          'max_rows' => 2,
        ),
      ],
    );


  }
endif;
add_action('after_setup_theme', 'necromancers_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function necromancers_content_width()
{
  $GLOBALS['content_width'] = apply_filters('necromancers_content_width', 640);
}
add_action('after_setup_theme', 'necromancers_content_width', 0);


/**
 * Functions used on backend which enhance the theme by hooking into WordPress.
 */
require get_theme_file_path('/inc/admin/admin-functions.php');

/**
 * Enqueue scripts and styles on backend.
 */
require get_theme_file_path('/inc/admin/admin-enqueue.php');

/**
 * Enqueue scripts and styles.
 */
require get_theme_file_path('/inc/front/enqueue.php');
require get_theme_file_path('/inc/front/enqueue-inline.php');

/**
 * Custom Nav Walkers
 */
require get_theme_file_path('/inc/custom-nav-walker.php');
require get_theme_file_path('/inc/custom-off-page-nav-walker.php');

/**
 * Register widget areas.
 */
require get_theme_file_path('/inc/widgets.php');

/**
 * ACF configuration.
 */
require get_template_directory() . '/inc/front/acf/acf-init.php';

/**
 * Add Kirki configuration.
 */
if (class_exists('Kirki')) {
  require get_template_directory() . '/inc/kirki-customizer.php';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Menu Custom Fields on backend
 */
require get_theme_file_path('/inc/admin/menu-item-custom-fields/menu-item-custom-fields.php');

/**
 * SportsPress global functions
 */
include get_template_directory() . '/sportspress/inc/sp-global-functions.php';

/**
 * SportsPress functions
 */
if (class_exists('SportsPress')) {
  include_once get_template_directory() . '/sportspress/inc/sp-functions.php';

  // inline styles for SportsPress
  require get_theme_file_path('/inc/front/sp-enqueue-inline.php');
}

/**
 * WooCommerce functions
 */
if (class_exists('Woocommerce')) {
  include_once get_template_directory() . '/inc/wc-functions.php';
}

/**
 * Load ACF fields
 */
require get_template_directory() . '/inc/acf-fields.php';

/**
 * Demo Import
 */
if (class_exists('OCDI_Plugin')) {
  require_once get_template_directory() . '/inc/demo-import.php';
}

/**
 * Update and Activation
 */
require get_template_directory() . '/inc/admin/update/update-base.php';
require get_template_directory() . '/inc/admin/update/update.php';

/**
 * SportsPress Referral
 */
function sportspress_pro_url_theme_9($url)
{
  return add_query_arg('theme', '9', $url);
}
add_filter('sportspress_pro_url', 'sportspress_pro_url_theme_9');
function add_svg_to_upload_mimes($upload_mimes)
{
  $upload_mimes['svg'] = 'image/svg+xml';
  $upload_mimes['svgz'] = 'image/svg+xml';
  $upload_mimes['ico'] = 'image/x-icon';
  return $upload_mimes;
}
add_filter('upload_mimes', 'add_svg_to_upload_mimes', 10, 1);
// Enable ACF in admin
add_filter('acf/settings/show_admin', '__return_true');
function remove_body_classes($classes)
{
  // List of classes to remove
  $classes_to_remove = array(
    'site-layout--landing',
    'bg--type-dark',
    'bg-image',
    'bg-fixed',
    'bg--texture-05'
  );

  // Remove specified classes
  $classes = array_diff($classes, $classes_to_remove);

  return $classes;
}
add_filter('body_class', 'remove_body_classes', 10, 1);

function remove_body_classes_script()
{
  ?>
  <script type="text/javascript">
    jQuery(document).ready(function ($) {
      $('body').removeClass('site-layout--landing bg--type-dark bg-image bg-fixed bg--texture-05');
    });
  </script>
  <?php
}
add_action('wp_footer', 'remove_body_classes_script');
function enqueue_custom_css()
{
  // Enqueue custom CSS
  wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0', 'all');
  wp_enqueue_style('responsive-css', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0', 'all');
  
}
add_action('wp_enqueue_scripts', 'enqueue_custom_css');
function theme_register_menus()
{
  register_nav_menus(
    array(
      'navbar' => 'Navbar Menu',
      'off-canvas'=>'Off Canvas Menu'
    )
  );
}
add_action('after_setup_theme', 'theme_register_menus');

if (function_exists('acf_add_options_page')) {

  acf_add_options_page(
      array(
          'page_title' => 'Theme General Settings',
          'menu_title' => 'Theme Settings',
          'menu_slug' => 'theme-general-settings',
          'capability' => 'edit_posts',
          'redirect' => false
      )
  );
}
function add_custom_nav_link_class($atts, $item, $args) {
  if ($args->theme_location === 'header-menu') {
      if (!isset($atts['class'])) {
          $atts['class'] = '';
      }
      if (in_array('current-menu-item', $item->classes) ){
          $atts['class'] .= 'active ';
      }
      $atts['class'] .= 'menu-item menu-item-type-post_type menu-item-object-page no-mega-menu';
  }
  return $atts;
}
add_filter('nav_menu_link_attributes', 'add_custom_nav_link_class', 10, 3);

function enqueue_necromancers_general_script() {
  wp_enqueue_script('necromancers-general-script', get_template_directory_uri() . '/assets/js/necromancers-general.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_necromancers_general_script');

function enqueue_necromancers_dl_init_js()
{
  // Enqueue the script
  wp_enqueue_script('necromancers-dl-init-js', 'http://64.4.160.99/htmlwebs/wp-content/plugins/necromancers-blocks/src/blocks/description-list/js/init.js', array(), '1.0.0', true);
}

// Hook the function to the wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'enqueue_necromancers_dl_init_js');