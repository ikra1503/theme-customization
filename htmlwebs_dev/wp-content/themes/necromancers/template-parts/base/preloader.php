<?php
/**
 * The template for displaying the Preloader
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.0
 */

// preloader type
$preloader_type = get_theme_mod( 'necromancers_preloader_type', 'default' );
?>

<div class="preloader-overlay">
  <div id="js-preloader" class="preloader">
    <div class="preloader-inner fadeInUp">
      
      <?php
      // check selected preloder type
      if ( 'css' === $preloader_type ) :
        // CSS Preloader
        $preloader_css = get_theme_mod( 'necromancers_preloader_type_css', 'circle' );
        ?>
        <div class="lds-<?php echo esc_html( $preloader_css ); ?>">
          <?php
          switch ( $preloader_css ) {
            case 'ellipsis':
              echo '<div></div><div></div><div></div><div></div>';
              break;
            case 'grid':
              echo '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>';
              break;
            case 'ring':
              echo '<div></div><div></div><div></div>';
              break;
            case 'ripple':
              echo '<div></div><div></div>';
              break;
            case 'roller':
              echo '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>';
              break;
            case 'spinner':
              echo '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>';
              break;
            default:
              echo '<div class="lds-' . esc_html( $preloader_css ) . '__inner"></div>';
              break;
          }
          ?>
        </div>
        <?php
      elseif ( 'custom_img' === $preloader_type ) :
        // Custom Image
        $preloader_image = get_theme_mod( 'necromancers_preloader_type_custom_img' );
        if ( $preloader_image ) :
          ?>
          <img src="<?php echo esc_url( $preloader_image ); ?> " alt="">
          <?php
        endif;
      else :
        // Default (ping-pong machine) preloader
        ?>
        <div class="pong-loader"></div>
        <svg role="img" class="df-icon df-icon--preloader-arcade">
          <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#preloader-arcade"/>
        </svg>
        <?php
      endif;
      ?>

    </div>
  </div>
</div>
