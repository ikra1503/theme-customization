<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
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

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="col-md-6">
	<div class="woocommerce-form-coupon-toggle checkout-redeem bg-image bg--checkout-redeem">
		<?php
		wc_print_notice( '<div class="checkout-redeem__subtitle">' . apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'necromancers' ) . '</div>
		<a href="#" class="checkout-redeem__title showcoupon stretched-link"><span>' . esc_html__( 'Redeem', 'necromancers' ) . '</span>' . '&nbsp;' . esc_html__( 'it!', 'necromancers' ) . '</a>
		<div class="checkout-redeem__tiny">' . esc_html__( 'Click here to access great discounts', 'necromancers' ). '</div>' ), 'notice' );
		?>
	</div>
	
	<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
	
		<p class="mt-3"><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'necromancers' ); ?></p>
	
		<div class="form-row">
			<div class="form-group col-md-8">
				<input type="text" name="coupon_code" class="input-text form-control" placeholder="<?php esc_attr_e( 'Coupon code', 'necromancers' ); ?>" id="coupon_code" value="" />
			</div>
			<div class="form-group col-md-4">
				<button type="submit" class="button btn btn-secondary btn-block<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'necromancers' ); ?>"><?php esc_html_e( 'Apply coupon', 'necromancers' ); ?></button>
			</div>
		</div>
	
	</form>
</div>



