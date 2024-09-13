add_filter('woocommerce_cart_shipping_method_full_label', 'customize_shipping_method_label_and_cost', 10, 2);

function customize_shipping_method_label_and_cost($label, $method)
{
    // Check if sessions are enabled and started
    if (!session_id()) {
        return $label; // If session is not started, return the original label
    }

    $city = isset($_SESSION['city_name']) ? $_SESSION['city_name'] : '';

    $ahmedabad_price = get_field('ahmedabad_price', 'option');
    $gandhinagar_price = get_field('rajkot_price', 'option');
    $other_price = get_field('other_city_price', 'option');

    if ($method->method_id === 'free_shipping' && $method->label === 'Home Delivery') {
        if ($city == 'Ahmedabad') {
            $method->cost = $ahmedabad_price;
        } elseif ($city == 'Gandhinagar') {
            $method->cost = $gandhinagar_price;
        } else {
            $method->cost = $other_price;
        }
        WC()->session->set('free_shipping_cost', $method->cost);
        $label = 'Home Delivery ' . wc_price($method->cost);
    } 

    return $label;
}


// Calculate order total using updated shipping cost
add_filter('woocommerce_cart_totals_order_total_html', 'update_order_total_with_custom_shipping_cost', 10, 1);
add_action('woocommerce_checkout_order_review', 'update_order_total_with_custom_shipping_cost', 10, 1);
function update_order_total_with_custom_shipping_cost($order_total_html)
{
    $other_price = get_option('other_city_price');


    $cart = WC()->cart;

    $shipping_cost = WC()->session->get('custom_shipping_cost');

    if (!$shipping_cost) {
        $shipping_cost = $other_price;

    }

    if (WC()->session->get('free_shipping_cost')) {
        $shipping_cost = WC()->session->get('free_shipping_cost');
    } elseif (WC()->session->get('local_pickup_cost')) {
        $shipping_cost = WC()->session->get('local_pickup_cost');
    }


    $new_order_total = $cart->get_subtotal() + $shipping_cost;
    $new_order_total_html = wc_price($new_order_total);
    $order_total_html = $new_order_total_html;

    return $order_total_html;
}