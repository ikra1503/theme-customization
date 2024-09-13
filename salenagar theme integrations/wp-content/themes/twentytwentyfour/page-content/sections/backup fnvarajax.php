function get_variation_ajax()
{
    
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $variation_color = isset($_POST['variation_Id_color']) ? sanitize_text_field($_POST['variation_Id_color']) : '';
    $variation_size = isset($_POST['variation_Id_size']) ? sanitize_text_field($_POST['variation_Id_size']) : '';

  
    $variation_id = 0;
    $product_type = '';

   
    $product = wc_get_product($product_id);
    $product_type = $product->get_type();

   
    $variation_id = 0;

   
    $variations = new WC_Product_Variable($product_id);
    $available_variations = $variations->get_available_variations();

    // Loop through variations to find a match
    foreach ($available_variations as $variation) {
        $variation_attributes = $variation['attributes'];

        // Initialize match as true
        $match = true;

        // Check for color if provided
        if (!empty($variation_color)) {
            $pa_attribute_name_color = 'attribute_pa_color';
            if (!isset($variation_attributes[$pa_attribute_name_color]) || $variation_attributes[$pa_attribute_name_color] != $variation_color) {
                $match = false;
            }
        }

        // Check for size if provided
        if (!empty($variation_size)) {
            $pa_attribute_name_size = 'attribute_pa_size';
            if (!isset($variation_attributes[$pa_attribute_name_size]) || $variation_attributes[$pa_attribute_name_size] != $variation_size) {
                $match = false;
            }
        }

        // If at least one attribute matches, set variation_id and break the loop
        if ($match) {
            $variation_id = $variation['variation_id'];
            break;
        }
    }

    // Prepare the response data
    $response_data = array(
        'variation_id' => $variation_id,
        'product_type' => $product_type
    );

    // Return the response as JSON
    wp_send_json($response_data);

    // Always use wp_die() to terminate immediately and return a proper response
    wp_die();
}
