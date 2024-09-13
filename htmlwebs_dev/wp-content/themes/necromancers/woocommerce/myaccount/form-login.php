<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$is_registration_enabled = 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="row justify-content-center <?php echo esc_attr( $is_registration_enabled ? 'ncr-login-form-registration-enabled' : '' ); ?>">

		<div class="col-md-6">

			<h2 class="h3 form__title"><?php esc_html_e( 'Login', 'necromancers' ); ?></h2>

			<form class="form login-form" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<div class="form-group">
					<input type="text" class="form-control" name="username" id="username" autocomplete="username" placeholder="<?php esc_html_e( 'Username or email address *', 'necromancers' ); ?>" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php esc_html_e( 'Password *', 'necromancers' ); ?>" />
				</div>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<div class="form-group d-flex justify-content-between align-items-center">
					<label class="checkbox checkbox-inline">
						<input class="checkbox-input" name="rememberme" type="checkbox" id="rememberme" value="forever">
						<?php esc_html_e( 'Remember me', 'necromancers' ); ?><span class="checkbox-label">&nbsp;</span>
					</label>
					<span class="password-reminder">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'necromancers' ); ?></a>
					</span>
				</div>

				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="btn btn-lg btn-block login-form__button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'necromancers' ); ?>"><?php esc_html_e( 'Log in', 'necromancers' ); ?></button>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>

		</div>

	<?php if ( $is_registration_enabled ) : ?>

		<div class="col-md-6">

			<h2 class="h3 form__title"><?php esc_html_e( 'Register', 'necromancers' ); ?></h2>

			<form method="post" class="form register-form" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<div class="form-group">
						<input type="text" class="form-control" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Username *', 'necromancers' ); ?>" /><?php // @codingStandardsIgnoreLine ?>
					</div>

				<?php endif; ?>

				<div class="form-group">
					<input type="email" class="form-control" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Email address *', 'necromancers' ); ?>" /><?php // @codingStandardsIgnoreLine ?>
				</div>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<div class="form-group">
						<input type="password" class="form-control" name="password" id="reg_password" autocomplete="new-password" placeholder="<?php esc_attr_e( 'Password *', 'necromancers' ); ?>" />
					</div>

				<?php else : ?>

					<p class="register-form__info mt-0"><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'necromancers' ); ?></p>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<div class="form-group">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="btn btn-lg btn-primary btn-block register-form__button <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="register" value="<?php esc_attr_e( 'Register', 'necromancers' ); ?>"><?php esc_html_e( 'Register', 'necromancers' ); ?></button>
				</div>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>

		</div>

	<?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
