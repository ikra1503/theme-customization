<?php
/**
 * Logo for the header
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.1
 */
?>

<div class="header-logo header-logo--img">
  <?php
    // Logo: Custom
    if ( has_custom_logo() ) :
      the_custom_logo();
    else :
      // Logo: Default
      ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/logo@2x.png 2x" alt="<?php esc_attr( bloginfo('name') ); ?>">
      </a>
      <?php
    endif;
  ?>
</div>
