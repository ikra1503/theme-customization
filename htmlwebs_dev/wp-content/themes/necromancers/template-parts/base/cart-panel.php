<?php
/**
 * Cart Panel
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.2.0
 * @version   1.2.0
 */

$product_count = sprintf('%d', WC()->cart->cart_contents_count, WC()->cart->cart_contents_count );
?>

<!-- Cart Panel -->
<div class="cart-panel">
  <h3 class="cart-panel__title"><?php esc_html_e( 'Shopping Cart', 'necromancers' ); ?> (<span class="cart-panel__items-count"><?php echo esc_html( $product_count ); ?></span>)</h3>
  <div class="cart-panel__content">
    <div class="widget_shopping_cart_content"></div>
  </div>
</div>
<!-- Cart Panel / End -->
