<?php
/**
 * Offline order
 *
 * @package WordPress
 */
$settings = wpcm_get_settings();
$offline_gateway = array_get($settings, 'gateways.offline_gateway');
$offline_gateway = ( ! empty( $offline_gateway ) ) ? $offline_gateway : $settings;
$description = array_get($offline_gateway, 'offline_payment_description' );
$instructions = array_get($offline_gateway, 'offline_payment_instruction' );
$total = get_post_meta( $order->ID, '_wpcm_order_total', true );

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
				<th><?php esc_html_e( 'Description', 'lifeline-donation-pro' ); ?></th>
				<td><?php echo wp_kses_post( $description ); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Gateway', 'lifeline-donation-pro' ); ?></th>
				<td><?php esc_html_e( 'Offline', 'lifeline-donation-pro' ); ?></td>
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
			<?php if ( $currency ) : ?>
				<tr>
					<th><?php esc_html_e( 'Currency', 'lifeline-donation-pro' ); ?></th>
					<td><?php echo esc_attr( $currency ); ?></td>
				</tr>
			<?php endif; ?>
			<?php $is_recurring = get_post_meta( $order->ID, '_order_is_recurring', true ); ?>
			<?php if ( $is_recurring ) : ?>
				<tr>
					<th><?php esc_html_e( 'Recurring', 'lifeline-donation-pro' ); ?></th>
					<td><?php esc_html_e( 'Yes', 'lifeline-donation-pro' ) ?></td>
				</tr>
			<?php endif; ?>
			<?php $interval = get_post_meta( $order->ID, '_order_recurring_interval', true ); ?>
			<?php if ( $interval ) : ?>
				<tr>
					<th><?php esc_html_e( 'Recurring Interval', 'lifeline-donation-pro' ); ?></th>
					<td><?php echo esc_html( $interval ) ?></td>
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

	<h4><?php esc_html_e( 'Offline Payment Instructions', 'lifeline-donation-pro' ); ?></h4>
	<p><?php echo wp_kses_post( $description ); ?></p>
	<p><?php echo wp_kses_post( $instructions ); ?></p>

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
