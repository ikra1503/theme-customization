<?php
function update_mini_cart()
{
    // Get product ID and variation ID from the AJAX request
    $product_id = isset($_POST['productid']) ? absint($_POST['productid']) : 0;
    $variation_id = isset($_POST['variationid']) ? absint($_POST['variationid']) : 0;


    $response = array();
    if ($product_id) {
        if ($variation_id) {
            $product = wc_get_product($variation_id);
        } else {
            $product = wc_get_product($product_id);
        }
        if ($product && $product->exists()) {
            $response['name'] = $product->get_name();
            $response['price'] = $product->get_price();
            $cart_contents = WC()->cart->get_cart();
            $product_quantity_in_cart = 0;
            $product_ids_in_cart = array(); // Array to store unique product IDs
            foreach ($cart_contents as $cart_item_key => $cart_item) {
                $product_quantity_in_cart += $cart_item['quantity'];
                // Store product IDs in the array
                $product_ids_in_cart[] = $cart_item['product_id'];
            }

            // Count unique product IDs
            $unique_product_ids_in_cart = count(array_unique($product_ids_in_cart));

            // Add product quantity and unique product ID count in cart to the response
            $response['quantity_in_cart'] = $product_quantity_in_cart;
            $response['unique_product_id_count_in_cart'] = $unique_product_ids_in_cart;
        }
    }

    // HTML for mini cart
    ob_start();
    ?>
    <div class="mini-cart-items">
        <h3>Mini Cart :
            <?php echo $response['unique_product_id_count_in_cart']; ?>
        </h3>
        <?php global $woocommerce;
        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item):
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            ?>
            <div class="mini-cart-item">
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

add_action('wp_ajax_update_mini_cart', 'update_mini_cart');
add_action('wp_ajax_nopriv_update_mini_cart', 'update_mini_cart');

