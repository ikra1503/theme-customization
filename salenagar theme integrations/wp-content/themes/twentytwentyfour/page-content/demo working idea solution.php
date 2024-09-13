<div class="form-group no-swiping">
    <div class="form-group no-swiping focus"><label for="pa_color">Select pa_color</label><select
            name="attribute_pa_color_809" id="pa_color_809" class="form-control variation-select" data-product-id="809">
            <option value="1125">Blue</option>
            <option value="1127">Green</option>
            <option value="1129">Red</option>
        </select></div>
    <div class="form-group no-swiping focus"><label for="pa_size">Select pa_size</label><select
            name="attribute_pa_size_809" id="pa_size_809" class="form-control variation-select" data-product-id="809">
            <option value="1125">Large</option>
            <option value="1128">Small</option>
        </select></div>
</div>




<div class="demo">
    <?php
    global $product;

    $product_id = 809; // Replace with your product ID
    $attribute_values = array(
        'attribute_pa_color' => 'blue',   // Example: attribute value for 'color'
        'attribute_pa_size' => 'small'    // Example: attribute value for 'size'
    );

    // Get variations of the product
    $variations = new WC_Product_Variable($product_id);
    $available_variations = $variations->get_available_variations();

    // Loop through variations to find a match
    foreach ($available_variations as $variation) {
        $variation_attributes = $variation['attributes'];

        $match = true;
        foreach ($attribute_values as $attribute_name => $attribute_value) {
            if (!isset($variation_attributes[$attribute_name]) || $variation_attributes[$attribute_name] != $attribute_value) {
                $match = false;
                break;
            }
        }
        if ($match) {
            $variation_id = $variation['variation_id'];
            // Variation found, $variation_id holds the ID you're looking for
            break;
        }
    }

    // Output Variation ID
    echo "Variation ID: " . $variation_id;
    ?>
</div>