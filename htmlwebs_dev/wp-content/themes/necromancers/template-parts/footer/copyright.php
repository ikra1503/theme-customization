<?php
/**
 * The template for displaying the footer copyright
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.1
 */

$copyright_toggle = get_theme_mod( 'necromancers_footer_copyright_toggle', 'on' );

if ( get_theme_mod( 'necromancers_header_position', 'bottom' ) === 'top' && ( $copyright_toggle || $copyright_toggle === 'on' ) ) :
  ?>
  <footer class="footer footer--classic">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <?php
          $copyright = ! empty( get_theme_mod( 'necromancers_footer_copyright', '' ) ) ? get_theme_mod( 'necromancers_footer_copyright' ) : '';
          if ( $copyright ) {
            echo wp_kses_post( $copyright );
          } else {
            /* translators: 1: Theme name */
            printf( esc_html__( '%1$s 2021 | All Rights Reserved', 'necromancers' ), '<a href="https://necromancers-wp.dan-fisher.dev">Necromancers</a>' );
          }
          ?>
        </div>
      </div>
    </div>
  </footer><!-- .footer -->
  <?php
endif;
