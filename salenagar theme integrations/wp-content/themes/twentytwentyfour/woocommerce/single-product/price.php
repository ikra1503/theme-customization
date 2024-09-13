<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


global $product;

// Get Mid-Sale Price
$mid_sale_price = get_post_meta($product->get_id(), '_mid_sale_price', true);

if ($product->is_on_sale()) :
    echo '<p class="price">';
    echo '<del>' . wc_price($product->get_regular_price()) . '</del> ';
    echo '<ins>' . wc_price($product->get_sale_price()) . '</ins>';
    if (!empty($mid_sale_price)) {
        echo ' <span class="mid-sale-price">' . __('Mid-Sale Price:', 'woocommerce') . ' ' . wc_price($mid_sale_price) . '</span>';
    }
    echo '</p>';
else :
    echo '<p class="price">' . wc_price($product->get_price()) . '</p>';
endif;