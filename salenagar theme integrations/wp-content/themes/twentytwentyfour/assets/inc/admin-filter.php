<?php
function custom_colour_filter($output)
{
    $selected_color = isset($_GET['pa_color']) ? sanitize_text_field(wp_unslash($_GET['pa_color'])) : '';

    $output .= wc_product_dropdown_categories(
        array(
            'show_option_none' => 'Filter by colour',
            'taxonomy' => 'pa_color',
            'name' => 'pa_color',
            'selected' => $selected_color,
        ));

    return $output;
}
function custom_size_filter($output)
{
    $selected_size = isset($_GET['pa_size']) ? sanitize_text_field(wp_unslash($_GET['pa_size'])) : '';

    $output .= wc_product_dropdown_categories(
        array(
            'show_option_none' => 'Filter by colour',
            'taxonomy' => 'pa_size',
            'name' => 'pa_size',
            'selected' => $selected_size,
        ));

    return $output;
}
add_filter('woocommerce_product_filters', 'custom_colour_filter');
function custom_color_product_filter_query($query)
{
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $tax_query = array();

    if (isset($_GET['pa_color']) && !empty($_GET['pa_color'])) {
        $tax_query[] = array(
            'taxonomy' => 'pa_color',
            'field' => 'slug',
            'terms' => sanitize_text_field($_GET['pa_color']),
        );
    }

    if (isset($_GET['pa_size']) && !empty($_GET['pa_size'])) {
        $tax_query[] = array(
            'taxonomy' => 'pa_size',
            'field' => 'slug',
            'terms' => sanitize_text_field($_GET['pa_size']),
        );
    }

    if (!empty($tax_query)) {
        $query->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'custom_color_product_filter_query');
?>