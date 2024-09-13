<?php if(!defined('ABSPATH')) exit; // exit if not defined
/**
 * Template Name: Home Banner
 */

get_header(); 

if(have_posts()) {
    get_template_part('page-content/content', 'a-plus');
}

get_footer();