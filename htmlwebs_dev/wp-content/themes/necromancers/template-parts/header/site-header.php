<?php
/**
 * Header
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.1
 */

$wrapper_classes  = 'site-header';

$wrapper_classes .= get_theme_mod( 'necromancers_header_position', 'bottom' ) === 'top' ? ' site-header--top' : ' site-header--bottom';

$top_logo_field   = get_field( 'ncr_page_top_logo' );
$top_logo         = isset( $top_logo_field ) ? $top_logo_field : false;

if ( ! is_page_template( 'page-landing.php' ) ) :
  ?>

  <header id="header" class="<?php echo esc_attr( $wrapper_classes ); ?>">

    <?php
    // Logo
    get_template_part( 'template-parts/header/header-logo' );

    // Primary Menu
    get_template_part( 'template-parts/header/primary-menu');

    // Header Elements
    get_template_part( 'template-parts/header/header-elements');
    ?>

  </header><!-- #header -->
  <?php
endif;

if ( $top_logo ) :
  ?>
  <header id="header-top" class="site-header site-header--landing">
    <?php get_template_part( 'template-parts/header/header-logo' ); ?>
  </header>
  <?php
endif;
