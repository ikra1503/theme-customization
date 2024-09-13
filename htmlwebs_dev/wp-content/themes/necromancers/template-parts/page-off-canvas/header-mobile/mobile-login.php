<?php
/**
 * Mobile Login/Logout
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.1
 */

$login_logout = get_theme_mod( 'necromancers_header_login_logout', false );

if ( ! $login_logout ) {
  return;
}

$login_link        = class_exists( 'Woocommerce' ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : wp_login_url();
$registration_link = class_exists( 'Woocommerce' ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : wp_registration_url();
$logout_link       = class_exists( 'Woocommerce' ) ? wc_logout_url() : wp_logout_url();

if ( is_user_logged_in() ) :
  ?>
  <li class="mobile-bar-item mobile-bar-item--logout">
    <a href="<?php echo esc_url( $logout_link ); ?>" class="mobile-bar-item__header">
      <?php esc_html_e( 'Logout', 'necromancers' ); ?>
    </a>
  </li>
  <?php
else :
  ?>
  <li class="mobile-bar-item mobile-bar-item--login">
    <a href="<?php echo esc_url( $login_link ); ?>" class="mobile-bar-item__header">
      <?php esc_html_e( 'Login', 'necromancers' ); ?>
    </a>
  </li>
  <?php
  if ( get_option( 'users_can_register' ) ) :
    ?>
    <li class="mobile-bar-item mobile-bar-item--register">
      <a href="<?php echo esc_url( $registration_link ); ?>" class="mobile-bar-item__header">
        <?php esc_html_e( 'Register', 'necromancers' ); ?>
      </a>
    </li>
    <?php
  endif;
endif;
