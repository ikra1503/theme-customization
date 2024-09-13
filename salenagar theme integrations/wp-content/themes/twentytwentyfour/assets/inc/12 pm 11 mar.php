<?php


function update_mini_cart()
{
    // Initialize response array
    $response = array();

    // Get all products in the cart
    $cart_contents = WC()->cart->get_cart();

    // Initialize variables to store cart information
    $product_quantity_in_cart = 0;
    $unique_product_ids_in_cart = count(array_unique(array_column($cart_contents, 'product_id')));

    // Loop through cart contents to calculate quantities
    foreach ($cart_contents as $cart_item) {
        $product_quantity_in_cart += $cart_item['quantity'];
    }

    // Add product quantity and unique product ID count in cart to the response
    $response['quantity_in_cart'] = $product_quantity_in_cart;
    $response['unique_product_id_count_in_cart'] = $unique_product_ids_in_cart;

    // HTML for mini cart
    ob_start();
    ?>
    <div class="mini-cart-items">
        <h3>Mini Cart:
            <?php echo $response['unique_product_id_count_in_cart']; ?>
        </h3>
        <?php global $woocommerce;
        foreach ($cart_contents as $cart_item_key => $cart_item):
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            ?>
            <div class="mini-cart-item product">
                <div class="mini-cart-item-image">
                    <?php echo $_product->get_image(); ?>
                </div>
                <div class="mini-cart-item-details">
                    <p class="mini-cart-item-name">
                        <?php echo $_product->get_name(); ?>
                    </p>
                    <p class="mini-cart-item-price">
                        <?php echo $woocommerce->cart->get_product_price($_product); ?>
                    </p>
                    <p class="mini-cart-item-quantity">
                        <?php echo __('Quantity', 'twentytwentyfour') . ': ' . $cart_item['quantity']; ?>
                    </p>
                    <div class="form-group no-swiping">
                        <?php
                        if ($_product->is_type('variable')) {
                            $attributes = $_product->get_attributes();
                            if ($attributes) {
                                foreach ($attributes as $attribute) {
                                    $attribute_name = $attribute->get_name();
                                    echo '<div class="form-group no-swiping">';
                                    echo '<label for="' . esc_attr($attribute_name) . '">' . 'Select ' . esc_html($attribute_name) . '</label>';
                                    echo '<select name="attribute_' . esc_attr($attribute_name) . '_' . $_product->get_id() . '" id="' . esc_attr($attribute_name) . '_' . $_product->get_id() . '" class="form-control variation-select" data-product-id="' . esc_attr($_product->get_id()) . '">';
                                    $attribute_terms = wc_get_product_terms($_product->get_id(), $attribute_name, array('fields' => 'all'));

                                    foreach ($attribute_terms as $term) {
                                        $variations = $_product->get_available_variations();
                                        foreach ($variations as $variation) {
                                            $variation_attributes = $variation['attributes'];
                                            if ($variation_attributes['attribute_' . $attribute_name] == $term->slug) {
                                                echo '<option value="' . esc_attr($term->name) . '">' . esc_html($term->name) . '</option>';
                                                break;
                                            }
                                        }
                                    }
                                    echo '</select>';
                                    echo '</div>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php
                    $in_cart_quantity = $cart_item['quantity'];
                    ?>
                    <?php
                    $style_btn = $in_cart_quantity > 0 ? 'display:none' : '';
                    $style_qty = $in_cart_quantity > 0 ? '' : 'display:none';
                    ?>
                    <div class="btn-group" style="<?php echo $style_btn; ?>">
                        <a href="<?php echo wc_get_cart_url(); ?>" class="button add-to-cart"
                            data-product-id="<?php echo $_product->get_id(); ?>" data-variation-id="">
                            Add to Cart<i class="icon-cart"></i>
                        </a>
                    </div>
                    <div class="qty-box" style="<?php echo $style_qty; ?>">
                        <div class="quantity">
                            <input type="button" value="-" class="qty-minus">
                            <input type="number" name="quantity" value="<?php echo $in_cart_quantity; ?>" title="Qty"
                                class="qty" size="4" id="qnty" min="1" max="100">
                            <input type="button" value="+" class="qty-plus">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="go-to-cart">
            <a href="<?php echo wc_get_cart_url(); ?>" class="button go-to-cart-btn">Go to Cart</a>
        </div>
    </div>
    <?php
    $html = ob_get_clean();

    // Merge HTML with the response
    $response['html'] = $html;

    // Send JSON response
    wp_send_json($response);
}

