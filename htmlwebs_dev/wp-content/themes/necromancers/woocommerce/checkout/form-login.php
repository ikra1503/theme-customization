<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>
<div class="col-md-6">
	<div class="woocommerce-form-login-toggle checkout-login bg-image bg--checkout-login">

		<?php wc_print_notice( '<div class="checkout-login__subtitle">' . apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'necromancers' ) ) . '</div>
		<a href="#" class="checkout-login__title stretched-link showlogin"><span>' . esc_html__( 'Login', 'necromancers' ) . '</span>&nbsp;' . esc_html__( 'now', 'necromancers' ) . '</a>
		<div class="checkout-login__tiny">' . esc_html__( 'or create an account in just seconds!', 'necromancers' ). '</div>', 'notice' ); ?>
	</div>

	<?php
	woocommerce_login_form(
		array(
			'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'necromancers' ),
			'redirect' => wc_get_checkout_url(),
			'hidden'   => true,
		)
	);
	?>
</div>
