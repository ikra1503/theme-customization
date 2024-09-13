<?php
function simple_menu(){

$location = array(
    'menu'=>'Left side nav menus',
    'footer' => 'Footer menu item'
);

register_nav_menus($location);
}
add_action('init','simple_menu');

function add_css()
{
 wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css',true,rand(),'all');
 wp_enqueue_style( 'bootstrap');

 wp_register_style('awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', true,rand());
 wp_enqueue_style( 'awesome');

 wp_register_style('style', get_template_directory_uri() . '/assets/css/style.css', true,rand(),'all');
 wp_enqueue_style( 'style');

 wp_register_style('responsive', get_template_directory_uri() . '/assets/css/responsive.css', true,rand());
 wp_enqueue_style( 'responsive');

 wp_register_style('bootstrap_style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
 wp_enqueue_style('bootstrap_style');

 wp_register_style('splieds_style', 'https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide-core.min.css');
 wp_enqueue_style('splieds_style');

 wp_register_style('sps_style', ' https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide.min.css');
 wp_enqueue_style('sps_style');

 wp_register_style('font_style', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap');
 wp_enqueue_style('font_style');

 wp_register_style('owl_style', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
 wp_enqueue_style('owl_style');

}
add_action('wp_enqueue_scripts', 'add_css');

function add_script()
{
 wp_register_script('aos-script', get_template_directory_uri() . '/assets/js/custom.js', array ( 'jquery' ), 1.1, true);
 wp_enqueue_script( 'aos-script');

 wp_register_script('aos-script', get_template_directory_uri() . '/assets/js/bootstrap.js', array ( 'jquery' ), 1.1, true);
 wp_enqueue_script( 'aos-script');

 wp_register_script('aos-script', get_template_directory_uri() . '/assets/js/jquery-3.4.1.min.js', array ( 'jquery' ), 1.1, true);
 wp_enqueue_script( 'aos-script');

 wp_register_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), '2.3.4', true);
 wp_enqueue_script('owl-carousel');

 wp_register_script('maps-script', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap', array('jquery'), '2.3.4', true);
 wp_enqueue_script('maps-script');

 wp_register_script('cdn-script', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"', array('jquery'), '2.3.4', true);
 wp_enqueue_script('cdn-script');

 wp_register_script('splide-script', 'https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js', array('jquery'), '2.3.4', true);
 wp_enqueue_script('splide-script');
}

add_action('wp_enqueue_scripts', 'add_script');

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
}