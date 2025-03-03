<?php
/**
 * Template Name: Home Page
 * Description: Custom home page template for Family Allergy Center.
 *
 * @package TwentyTwentyFour Child
 */

get_header();
?>

<!-- Home Page Content -->
<?php get_template_part('sections/banner-section'); ?>
<?php get_template_part('sections/box-section'); ?>
<?php get_template_part('sections/special-service'); ?>
<?php get_template_part('sections/three-step-section'); ?>
<?php get_template_part('sections/map-section'); ?>
<?php get_template_part('sections/testimonial-section'); ?>


<?php get_footer(); ?>