<?php
function glint_website_register_styles_and_scripts()
{
    // Enqueue styles
    wp_enqueue_style('glint-base-style', get_template_directory_uri() . '/assets/css/base.css');
    wp_enqueue_style('glint-vendor-style', get_template_directory_uri() . '/assets/css/vendor.css');
    wp_enqueue_style('glint-main-style', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('glint-fonts-style', get_template_directory_uri() . '/assets/css/fonts.css');
    wp_enqueue_style('glint-vendor-style', get_template_directory_uri() . '/assets/css/micons/micons.css');


    wp_enqueue_style('lora-bolditalic', get_template_directory_uri() . '/assets/fonts/lora/lora-bolditalic-webfont.woff', array(), null);
    wp_enqueue_style('lora-bold', get_template_directory_uri() . '/assets/fonts/lora/lora-bold-webfont.woff', array(), null);
    wp_enqueue_style('lora-italic', get_template_directory_uri() . '/assets/fonts/lora/lora-italic-webfont.woff', array(), null);
    wp_enqueue_style('lora-regular', get_template_directory_uri() . '/assets/fonts/lora/lora-regular-webfont.woff', array(), null);


    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome/css/font-awesome.min.css', array(), '5.15.4');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome/css/font-awesome.css', array(), '5.15.4');

    // Enqueue Font Awesome fonts
    wp_enqueue_style('font-awesome-fonts', get_template_directory_uri() . '/assets/css/font-awesome/fonts/fontawesome-webfont.woff2', array(), '5.15.4');
    wp_enqueue_style('font-awesome-fonts', get_template_directory_uri() . '/assets/css/font-awesome/fonts/fontawesome-webfont.woff', array(), '5.15.4');
    wp_enqueue_style('font-awesome-fonts', get_template_directory_uri() . '/assets/css/font-awesome/fonts/fontawesome-webfont.eot', array(), '5.15.4');

    // Enqueue scripts
    wp_enqueue_script('glint-modernizr-script', get_template_directory_uri() . '/assets/js/modernizr.js', array(), null, true);
    wp_enqueue_script('glint-pace-script', get_template_directory_uri() . '/assets/js/pace.min.js', array(), null, true);
    wp_enqueue_script('glint-main-script2', get_template_directory_uri() . '/assets/js/jquery-min.js', array('jquery'), null, true);
    wp_enqueue_script('glint-pace-script3', get_template_directory_uri() . '/assets/js/plugins.js', array(), null, true);
    wp_enqueue_script('glint-main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);

    // Define AJAX URL
    wp_localize_script('glint-main-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));




}

add_action('wp_enqueue_scripts', 'glint_website_register_styles_and_scripts');
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

register_nav_menus(
    array(
        'primary' => esc_html__('HeaderMenu', 'Glint'),

    )
);
?>