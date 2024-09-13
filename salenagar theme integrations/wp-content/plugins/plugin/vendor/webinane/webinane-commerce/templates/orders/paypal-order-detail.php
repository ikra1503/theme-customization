<?php
/**
 * Paypal order detail.
 *
 * @package WordPress
 */

$transaction = get_post_meta( $order->ID, '_order_transaction_id', true );
$total = get_post_meta( $order->ID, '_order_total', true );
$fee = get_post_meta( $order->ID, '_order_fee', true );
$currency = get_post_meta( $order->ID, '_order_currency', true );
$order_data = WebinaneCommerce\Classes\Orders::order_data( $order );
$orders_label = apply_filters( 'wpcm_orders_admin_menu_label', esc_html__( 'Orders', 'lifeline-donation-pro' ) );
$order_label = apply_filters( 'wpcm_order_admin_menu_label', esc_html__( 'Order', 'lifeline-donation-pro' ) )
?>

<div class="wpcm-order-success-detail wpcm-wrapper alignfull">
	<h3>
		<?php
			// translators: The orders label.
			printf( esc_html__( '%s Detail', 'lifeline-donation-pro' ), esc_html( $order_label ) );
		?>
	</h3>

	<table class="table">
		<tbody>
			<tr>
				<th><?php esc_html_e( 'Transaction ID', 'lifeline-donation-pro' ); ?></th>
				<td><?php echo esc_attr( $transaction ); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Gateway', 'lifeline-donation-pro' ); ?></th>
				<td><?php esc_html_e( 'PayPal', 'lifeline-donation-pro' ); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Transaction Status', 'lifeline-donation-pro' ); ?></th>
				<td><?php echo esc_attr( $order->display_status ); ?></td>
			</tr>
			<tr>
				<th>
					<?php
					// translators: Order label.
					printf( esc_html__( '%s Total', 'lifeline-donation-pro' ), esc_attr( $order_label ) );
					?>
				</th>
				<?php if ( isset( $order->items[0] ) ) : ?>
					<td><?php echo wp_kses_post( $order->items[0]->formattedPrice() ); ?></td>
				<?php endif; ?>
			</tr>
			<?php if ( $fee ) : ?>
				<tr>
					<th><?php esc_html_e( 'Transaction Fee', 'lifeline-donation-pro' ); ?></th>
					<td><?php echo esc_attr( $fee ); ?></td>
				</tr>
			<?php endif; ?>
			<tr>
				<th><?php esc_html_e( 'Currency', 'lifeline-donation-pro' ); ?></th>
				<td><?php echo esc_attr( $currency ); ?></td>
			</tr>
			<?php $is_recurring = get_post_meta( $order->ID, '_wpcm_order_is_recurring', true ); ?>
			<?php if ( $is_recurring ) : ?>
				<tr>
					<th><?php esc_html_e( 'Recurring', 'lifeline-donation-pro' ); ?></th>
					<td><?php esc_html_e( 'Yes', 'lifeline-donation-pro' ) ?></td>
				</tr>
			<?php endif; ?>
			<?php $period = get_post_meta( $order->ID, '_wpcm_order_recurring_period', true ); ?>
			<?php if ( $period ) : ?>
				<tr>
					<th><?php esc_html_e( 'Recurring Interval', 'lifeline-donation-pro' ); ?></th>
					<td><?php echo esc_html( $period ) ?></td>
				</tr>
			<?php endif; ?>
			<?php $tax_code = get_post_meta( $order->ID, '_order_tax_code', true ); ?>
			<?php if ( $tax_code ) : ?>
				<tr>
					<th><?php esc_html_e( 'Tax Code', 'lifeline-donation-pro' ); ?></th>
					<td><?php echo esc_html( $tax_code ) ?></td>
				</tr>
			<?php endif; ?>
			<?php $custom_dropdown = get_post_meta( $order->ID, '_order_donation_custom_dropdown', true ); ?>
			<?php if ( $custom_dropdown ) : ?>
				<tr>
					<th><?php esc_html_e( 'Custom Dropdown Value', 'lifeline-donation-pro' ); ?></th>
					<td><?php echo esc_html( $custom_dropdown ) ?></td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php if ( isset( $order_data->order_items ) ) : ?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Item Name', 'lifeline-donation-pro' ); ?></th>
					<th><?php esc_html_e( 'Price', 'lifeline-donation-pro' ); ?></th>
					<th><?php esc_html_e( 'Quantity', 'lifeline-donation-pro' ); ?></th>
					<th><?php esc_html_e( 'Total', 'lifeline-donation-pro' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $order_data->order_items as $item ) : ?>
					<tr>
						<td><?php echo esc_attr( $item->order_item_name ); ?></td>
						<td><?php echo wp_kses( $item->formattedPrice(), wp_kses_allowed_html('post') ); ?></td>
						<td><?php echo esc_attr( $item->qty ); ?></td>
						<td><?php echo wp_kses( $item->formattedTotalPrice(), wp_kses_allowed_html( 'post' ) ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</div>
