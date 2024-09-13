<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="row justify-content-center">
	<div class="col-md-8 col-lg-6 col-xl-4">
		<?php do_action( 'woocommerce_before_reset_password_form' ); ?>
		<form method="post" class="woocommerce-ResetPassword lost_reset_password text-left">

			<h3><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'necromancers' ) ); ?></h3><?php // @codingStandardsIgnoreLine ?>

			<div class="form-group">
				<input type="password" class="form-control" name="password_1" id="password_1" autocomplete="new-password" placeholder="<?php esc_attr_e( 'New password *', 'necromancers' ); ?>" />
			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="password_2" id="password_2" autocomplete="new-password" placeholder="<?php esc_attr_e( 'Re-enter new password', 'necromancers' ); ?>" />
			</div>

			<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
			<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

			<div class="clear"></div>

			<?php do_action( 'woocommerce_resetpassword_form' ); ?>

			<div class="form-group">
				<input type="hidden" name="wc_reset_password" value="true" />
				<button type="submit" class="woocommerce-Button btn btn-lg btn-block btn-secondary<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Save', 'necromancers' ); ?>"><?php esc_html_e( 'Save', 'necromancers' ); ?></button>
			</div>

			<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>

		</form>
	</div>
</div>
<?php
do_action( 'woocommerce_after_reset_password_form' );

