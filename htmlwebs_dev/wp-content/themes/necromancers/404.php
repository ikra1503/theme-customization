<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

get_header();

$error_title    = get_theme_mod( 'necromancers_404_title' );
$error_subtitle = get_theme_mod( 'necromancers_404_subtitle' );
$error_desc     = get_theme_mod( 'necromancers_404_desc' );
$error_logo     = get_theme_mod( 'necromancers_404_logo' );
?>

  <main class="site-content" id="wrapper">
    <div class="container">
      <div class="row">
        <div class="error__logo-wrapper col-md-6 d-none d-md-block">
          <?php
          $error_logo_path = $error_logo ? $error_logo : get_template_directory_uri() . '/assets/img/page-bg-logo.png';

          echo '<img src="' . esc_url( $error_logo_path ) . '" class="error__logo" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
          ?>
          <!-- Decoration -->
          <div class="ncr-page-decor">
            <div class="ncr-page-decor__layer-3"></div>
          </div>
          <!-- Decoration / End -->
        </div>
        <div class="error__txt-wrapper col-md-5 align-self-center offset-md-1">
          <h1 class="error__title">
            <?php
            if ( $error_title ) {
              echo wp_kses_post( $error_title );
            } else {
              esc_html_e( '404', 'necromancers' );
            }
            ?>
          </h1>
          <h2 class="error__subtitle">
            <?php
            if ( $error_subtitle ) {
              echo wp_kses_post( $error_subtitle );
            } else {
              esc_html_e( 'Page Not Found', 'necromancers' );
            }
            ?>
          </h2>
          <div class="error__desc">
            <?php
            if ( $error_desc ) {
              echo wp_kses_post( $error_desc );
            } else {
              printf(
                wp_kses_post(
                  __( 'Sorry! The page that you’re trying to see does not exist or was moved. <a href="%s">Click here</a> to go back and keep browsing!',
                  'necromancers' )
                ),
                esc_url( home_url( '/' ) )
              );
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    
  </main><!-- .site-content -->

<?php
get_footer();
