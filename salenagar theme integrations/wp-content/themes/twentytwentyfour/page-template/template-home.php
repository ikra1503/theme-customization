<?php 
if(!defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * Template Name: Home Template
 * The template for displaying the Home Template
 *  
 * @package WordPress
 * @subpackage Euverman & Nuyts
 * @since Euverman & Nuyts 1.0
 */

get_header(); // header
if( have_posts() ) 
{
    // Show content for Home Template
    get_template_part('page-content/content', 'home');
} // endif

get_footer(); // footer

?>