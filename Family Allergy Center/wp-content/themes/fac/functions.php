<?php
/**
 * Functions and definitions for the Twenty Twenty-Four Child Theme
 *
 * @package TwentyTwentyFour Child
 * @author Webtech Evolution
 * @version 1.0
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Setup Theme Support and Features
 */
function twentytwentyfour_child_theme_setup()
{
    // Load Parent Theme Styles
    // add_action('wp_enqueue_scripts', 'twentytwentyfour_child_enqueue_styles');

    // Theme Supports
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');

    // Register Navigation Menus
    register_nav_menus([
        'primary-menu' => __('Primary Menu', 'twentytwentyfour'),
        'footer-menu' => __('Footer Menu', 'twentytwentyfour'),
    ]);

    // Add Theme Support for WooCommerce (if needed)
    if (class_exists('WooCommerce')) {
        add_theme_support('woocommerce');
    }
}
add_action('after_setup_theme', 'twentytwentyfour_child_theme_setup');
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'General Settings',
        'menu_title' => 'General Settings',
        'menu_slug' => 'general-settings',
        'capability' => 'manage_options',
        'redirect' => false
    ]);
}

function allow_webp_uploads($mimes)
{
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'allow_webp_uploads');
function enable_svg_uploads($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'enable_svg_uploads');

/**
 * Enqueue Child Theme Styles & Scripts
 */
function twentytwentyfour_child_enqueue_assets()
{
    // Load Parent Theme CSS
    // wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Load Child Theme CSS
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/assets/css/style.css', [], rand());

    // Load Child Theme JS
    // wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/assets/js/script.js', [], rand(), true);
}
add_action('wp_enqueue_scripts', 'twentytwentyfour_child_enqueue_assets');


function header_bg_css() {
$banner_top_right_image=get_field('banner_top_right_image','option');
$banner_top_right_image=is_array($banner_top_right_image)?$banner_top_right_image:[];
    $image_url =$banner_top_right_image['url']; 
   
    ?>
    <style>
        section.header::after {
            content: url("<?php echo esc_url($image_url); ?>") !important;
            position: absolute;
            right: 1px;
            top: 0px;
            z-index: -1;
        }
    </style>
    <?php
}
add_action('wp_head', 'header_bg_css');
function dequeue_parent_theme_styles() {
    wp_dequeue_style('parent-theme-style'); // Replace with actual parent theme handle
    wp_deregister_style('parent-theme-style'); // Optional: Fully remove the style
}
add_action('wp_enqueue_scripts', 'dequeue_parent_theme_styles', 20);
