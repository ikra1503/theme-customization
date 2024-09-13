<?php
/**
 * Header Elements - Cart Toggle
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.2.0
 * @version   1.2.0
 */

$product_count = sprintf('%d', WC()->cart->cart_contents_count, WC()->cart->cart_contents_count );
?>

<div class="header-cart-toggle">
  <svg role="img" class="df-icon df-icon--bag">
    <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#bag"/>
  </svg>
  <svg role="img" class="df-icon df-icon--close">
    <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#close"/>
  </svg>
  <span class="header-cart-toggle__items-count"><?php echo esc_html( $product_count ); ?></span>
</div>
