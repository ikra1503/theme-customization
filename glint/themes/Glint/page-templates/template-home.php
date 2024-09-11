<?php
//Exit if Directly accessed
if (!defined('ABSPATH')) { exit; }



/*
 * Template Name: Home Page
 * description: ---
  Page template without sidebar
 */

// Additional code goes here...

get_header();
while (have_posts()): the_post();
	get_template_part('page-contents/content', 'home');
    
endwhile;
get_footer();?>
