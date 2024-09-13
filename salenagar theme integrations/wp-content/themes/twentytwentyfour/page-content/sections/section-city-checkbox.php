<?php
$city_prices = get_field('city_prices', 'option');

if (!empty($city_prices)) {
    foreach ($city_prices as $city) {
        $city_name = $city['city_name'];
        $price_for_city = $city['price_for_city'];
        echo '<input type="radio" name="selected_city" id="' . $city_name . '" value="' . $price_for_city . '">';
        echo '<label for="' . $city_name . '">' . $city_name . '</label><br>';
    }
}

?>