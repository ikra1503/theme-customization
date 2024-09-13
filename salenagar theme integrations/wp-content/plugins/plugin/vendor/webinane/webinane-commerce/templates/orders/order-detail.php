<?php
	global $wpdb; 
	if( ! $order ) {
		return;
	} 
?>
<div class="success-page-orders">
	
	<h3><?php esc_html_e('Order Detail', 'lifeline-donation-pro' ); ?></h3>
	<table class="wpcm-table">
		<thead>
			<tr>
				<th><?php esc_html_e('Item Name', 'lifeline-donation-pro' ); ?></th>
				<th><?php esc_html_e('Quantity', 'lifeline-donation-pro' ); ?></th>
				<th><?php esc_html_e('Price', 'lifeline-donation-pro' ); ?></th>
				<th><?php esc_html_e('Total', 'lifeline-donation-pro' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $order->order_items as $order_item ) : ?>
				<tr>
					<td><?php echo esc_attr( $order_item->order_item_name ) ?></td>
					<td><?php echo esc_attr( $order_item->itemmeta['quantity'] ) ?></td>
					<td><?php echo esc_attr( round( $order_item->itemmeta['price'] / $order_item->itemmeta['quantity'], 2 ) ) ?></td>
					<td><?php echo esc_attr( $order_item->itemmeta['price'] ) ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>