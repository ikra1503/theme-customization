<?php
if (!defined('ABSPATH'))
  exit; // Exit if accessed directly 64
/**
 * The footer.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Euverman & Nuyts
 * @since Euverman & Nuyts 1.0
 */ ?>
<?php wp_footer(); ?>
<footer id="footer">
  <div class="wrap">
    <div class="footer-row">
      <!-- <div class="footer-about">
        <a href="#" title="Salenagar" class="logo">
          <img src="img/logo-white.svg" alt="Salenagar" width="183" height="44">
        </a>
        <p>Lorem ipsum dolor sit amet consectetur. Eget eu at eu nisl tempus. Volutpat libero pellentesque.</p>
      </div> -->
      <div class="footer-links">
        <?php wp_nav_menu(array('container' => false, 'items_wrap' => '<ul>%3$s</ul>', 'theme_location' => 'footer_main_menu')); ?>
        <?php wp_nav_menu(array('container' => false, 'items_wrap' => '<ul>%3$s</ul>', 'theme_location' => 'footer_sub_menu')); ?>
      </div>
      <div class="footer-social-links">
        <h6>Follow Us</h6>
        <ul>
          <li><a href="#" title="Instagram"><i class="icon-instagram"></i></a></li>
          <li><a href="#" title="Facebook"><i class="icon-facebook"></i></a></li>
          <li><a href="#" title="Twitter"><i class="icon-twitter"></i></a></li>
          <li><a href="#" title="Linked-In"><i class="icon-linked-in"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>