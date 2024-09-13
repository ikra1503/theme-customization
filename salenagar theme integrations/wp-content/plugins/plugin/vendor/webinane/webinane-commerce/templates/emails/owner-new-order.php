<?php 
	$settings = wpcm_get_settings();
	$new_order = wpcm_order($order);

	$items = $new_order->items(); 
	$item = $items->first();
	$meta = $new_order->meta->pluck('meta_value', 'meta_key');
	
	$customers = new \WebinaneCommerce\Classes\Customers($customer_id);
	$customer = $customers->customer;
	$orders_label = apply_filters('wpcm_orders_admin_menu_label', esc_html__('Orders', 'lifeline-donation-pro'));
	$order_label = apply_filters('wpcm_order_admin_menu_label', esc_html__('Order', 'lifeline-donation-pro'));
?>


<?php do_action('webinane_commerce_email_header', $order); ?>

<?php if( $settings->get('customer_email_show_item_info') ) : ?>
	<tr>
		<td align="left" valign="top" width="100%" style="font-family: 'Barlow', sans-serif; color: #1a1a1a; font-weight: 600; font-size: 22px; padding-top: 15px; padding-bottom: 16px;">
			<?php echo get_the_title($item->post_id) ?>
		</td>
	</tr>
<?php endif; ?>

{{email_body}}

<?php if( $customer->address && $settings->get('customer_email_show_customer_detail') ) : ?>
	<table cellpadding="8" border="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" valign="top" style="font-family: 'Barlow', sans-serif; color: #999999; font-size: 17px; line-height: 30px;">
				{{customer_address}}<br/> 
				{{customer_city}}<br/>
				{{customer_state}} {{customer_country}}
			</td>
		</tr>
	</table>
<?php endif; ?>
<a href="{{customer_account_url}}" target="_blank" style="color:#FFFFFF; text-decoration:none;"><?php printf(esc_html__('VIEW %s', 'lifeline-donation-pro'), $orders_label ); ?></a>
<?php if($settings->get('customer_email_show_qty')) : ?>
	<table cellpadding="8" border="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" valign="top" style="font-family: 'Barlow', sans-serif; color: #666666; font-size: 15px;">
				<?php esc_html_e('Quantity', 'lifeline-donation-pro'); ?>:  
			</td>
			<td align="right" valign="top" style="font-family: 'Barlow', sans-serif; color: #666666; font-size: 15px;">
				<?php echo esc_attr($new_order->all_qty) ?>
			</td>
		</tr>
	</table>
<?php endif; ?>

<?php do_action('webinane_commerce_email_footer', $order); ?>