<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account form" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<div class="row">

		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" placeholder="<?php esc_attr_e( 'First name *', 'necromancers' ); ?>" />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" placeholder="<?php esc_attr_e( 'Last name *', 'necromancers' ); ?>" />
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" placeholder="<?php esc_attr_e( 'Display name', 'necromancers' ); ?>" /> <span class="form-notice"><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'necromancers' ); ?></span>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<input type="email" class="form-control" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" placeholder="<?php esc_attr_e( 'Email address *', 'necromancers' ); ?>" />
			</div>
		</div>

		<?php
			/**
			 * Hook where additional fields should be rendered.
			 *
			 * @since 8.7.0
			 */
			do_action( 'woocommerce_edit_account_form_fields' );
		?>

	</div>

	<fieldset class="ncr-password-change-form">
		<legend class="h3 mb-5"><?php esc_html_e( 'Password change', 'necromancers' ); ?></legend>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<input type="password" class="form-control" name="password_current" id="password_current" autocomplete="off" placeholder="<?php esc_attr_e( 'Current password (leave blank to leave unchanged)', 'necromancers' ); ?>" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<input type="password" class="form-control" name="password_1" id="password_1" autocomplete="off" placeholder="<?php esc_attr_e( 'New password (leave blank to leave unchanged)', 'necromancers' ); ?>" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<input type="password" class="form-control" name="password_2" id="password_2" autocomplete="off" placeholder="<?php esc_attr_e( 'Confirm new password', 'necromancers' ); ?>" />
				</div>
			</div>
		</div>
	</fieldset>

	<?php
		/**
		 * My Account edit account form.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_edit_account_form' );
	?>

	<div class="form-group">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="btn btn-lg btn-secondary<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'necromancers' ); ?>"><?php esc_html_e( 'Save changes', 'necromancers' ); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</div>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
