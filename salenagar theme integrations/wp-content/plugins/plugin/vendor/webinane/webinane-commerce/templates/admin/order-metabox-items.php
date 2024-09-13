
<div class="wpcm-order-items">
	
	<table class="wpcm-table" style="width: 100%;">
		<thead>
			<tr>
				<th colspan="2" style="width: 60%"><?php esc_html_e( 'Item', 'lifeline-donation-pro' ); ?></th>
				<th><?php esc_html_e( 'Cost', 'lifeline-donation-pro' ); ?></th>
				<th><?php esc_html_e( 'Qty', 'lifeline-donation-pro' ); ?></th>
				<th><?php esc_html_e( 'Total', 'lifeline-donation-pro' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $order->order_items as $item ) : ?>
				<tr>
					<td><?php esc_html_e( 'Image', 'lifeline-donation-pro' ) ?></td>
					<td><?php echo esc_attr( $item->order_item_name ) ?></td>
					<td><?php echo esc_attr($item->itemmeta['price']) ?></td>
					<td><?php echo esc_attr($item->itemmeta['quantity']) ?></td>
					<td><?php echo esc_attr($item->itemmeta['price']) ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>