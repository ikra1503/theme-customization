<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     7.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<p class="mt-3"><?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?></p>

	<div class="form-group">
		<input type="text" class="form-control" name="username" id="username" autocomplete="username" placeholder="<?php esc_attr_e( 'Username or email *', 'necromancers' ); ?>" />
	</div>
	<div class="form-group">
		<input class="input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php esc_attr_e( 'Password *', 'necromancers' ); ?>" />
	</div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="form-group d-flex justify-content-between align-items-center">
		<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme checkbox checkbox-inline">
			<input class="woocommerce-form__input woocommerce-form__input-checkbox checkbox-input" name="rememberme" type="checkbox" id="rememberme" value="forever" /><?php esc_html_e( 'Remember me', 'necromancers' ); ?><span class="checkbox-label">&nbsp;</span>
		</label>
		<span class="lost_password password-reminder">
			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'necromancers' ); ?></a>
		</span>
	</div>

	<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
	<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
	<button type="submit" class="woocommerce-button button woocommerce-form-login__submit btn btn-lg btn-primary btn-block<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Login', 'necromancers' ); ?>"><?php esc_html_e( 'Login', 'necromancers' ); ?></button>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
