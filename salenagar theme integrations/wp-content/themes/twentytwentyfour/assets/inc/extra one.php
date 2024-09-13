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
        <?php
        global $woocommerce;
        // echo '<pre>';
        // print_r($cart_contents);
        foreach ($cart_contents as $cart_item_key => $cart_item):
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            // Get selected variation attributes (color and size)
            $selected_variation_attributes = $_product->get_variation_attributes();
            $selected_color = isset($selected_variation_attributes['attribute_pa_color']) ? $selected_variation_attributes['attribute_pa_color'] : '';
            $selected_size = isset($selected_variation_attributes['attribute_pa_size']) ? $selected_variation_attributes['attribute_pa_size'] : '';
            ?>

            <div class="product" style="height: auto;" data-product-id="<?php echo $cart_item['product_id']; ?>"
                data-variation-id="<?php echo $cart_item['variation_id']; ?>">
                <a href="<?php echo $_product->get_permalink(); ?>">
                    <figure>
                        <?php echo $_product->get_image('thumbnail'); ?>
                    </figure>
                </a>
                <h6>
                    <?php echo $_product->get_name(); ?>
                </h6>
                <div class="price-row">
                    <div class="price-info">
                        <span class="price">
                            <?php echo $_product->get_price_html(); ?>
                        </span>
                        <p>(Inclusive of all taxes)</p>
                    </div>
                </div>

                <div class="form-group no-swiping">
                    <?php
                    if ($_product->is_type('variable')) {
                        $attributes = $_product->get_variation_attributes();
                        if ($attributes) {
                            foreach ($attributes as $attribute_name => $options) {
                                echo '<div class="form-group no-swiping">';
                                echo '<label for="' . esc_attr($attribute_name) . '">Select ' . esc_html($attribute_name) . '</label>';
                                echo '<select name="attribute_' . esc_attr($attribute_name) . '_' . $_product->get_id() . '" id="' . esc_attr($attribute_name) . '_' . $_product->get_id() . '" class="form-control variation-select" data-_product-id="' . esc_attr($_product->get_id()) . '">';
                                foreach ($options as $option) {
                                    echo '<option value="' . esc_attr($option) . '">' . esc_html($option) . '</option>';
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
                <div class="btn-group" style="<?php echo $in_cart_quantity > 0 ? 'display:none' : ''; ?>">
                    <a href="<?php echo wc_get_cart_url(); ?>" class="button add-to-cart"
                        data-product-id="<?php echo $cart_item['product_id']; ?>"
                        data-variation-id="<?php echo $cart_item['variation_id']; ?>">
                        Add to Cart<i class="icon-cart"></i>
                    </a>
                </div>
                <div class="qty-box" style="<?php echo $in_cart_quantity > 0 ? '' : 'display:none'; ?>">
                    <div class="quantity" data-product-id="<?php echo $cart_item['product_id']; ?>">
                        <input type="button" value="-" class="qty-minus">
                        <input type="number" name="quantity" value="<?php echo $in_cart_quantity; ?>" title="Qty" class="qty"
                            size="4" id="qnty" min="1" max="100" data-variation-id="<?php echo $cart_item['variation_id']; ?>">
                        <input type="button" value="+" class="qty-plus">
                    </div>
                </div>
                <input type="hidden" name="variation" class="varid" value="<?php echo $cart_item['variation_id']; ?>">
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

add_action('wp_ajax_update_mini_cart', 'update_mini_cart');
add_action('wp_ajax_nopriv_update_mini_cart', 'update_mini_cart');
