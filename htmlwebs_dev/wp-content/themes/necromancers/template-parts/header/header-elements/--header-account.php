<?php
/**
 * Header Elements - Account
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.3.0
 */

$login_link  = class_exists( 'Woocommerce' ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : wp_login_url();
$logout_link = class_exists( 'Woocommerce' ) ? wc_logout_url() : wp_logout_url();

if ( is_user_logged_in() ) :
  ?>

  <div class="header-account hide">
    <div class="header-account__avatar">
      <?php echo get_avatar( get_current_user_id(), 32 ); ?>
    </div>
    <div class="header-account__body">
      <?php esc_html_e( 'Hello!', 'necromancers' ); ?>
      <div class="header-account__name"><?php echo wp_get_current_user()->display_name; ?></div>
    </div>
    <div class="header-account__icon">
      <?php if ( class_exists( 'Woocommerce' ) ) : ?>
      <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
        <svg role="img" class="df-icon df-icon--account">
          <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#account"></use>
        </svg>
      </a>
      <?php endif; ?>

      <a href="<?php echo esc_url( $logout_link ); ?>">
        <svg role="img" class="df-icon df-icon--logout" title="<?php esc_attr_e( 'Log Out', 'necromancers'); ?>">
          <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#logout"/>
        </svg>
      </a>
    </div>
  </div>

  <?php
else :
  ?>

  <div class="header-account header-account--guest hide">
    <div class="header-account__avatar">
      <img src="<?php echo get_theme_file_uri( '/assets/img/account-guest-avatar.jpg' ); ?>" alt="<?php esc_attr_e( 'Guest Avatar', 'necromancers' ); ?>">
    </div>
    <div class="header-account__body">
      <?php esc_html_e( 'Welcome', 'necromancers' ); ?>
      <div class="header-account__name"><?php esc_html_e( 'Necro Guest', 'necromancers' ); ?></div>
    </div>
    <div class="header-account__icon">
      <a href="<?php echo esc_url( $login_link ); ?>">
        <svg role="img" class="df-icon df-icon--login-register">
          <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#login-register"/>
        </svg>
      </a>
    </div>
  </div>
  <?php
endif;
