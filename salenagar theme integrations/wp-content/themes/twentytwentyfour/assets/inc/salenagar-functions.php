<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
/**
 * Functions and definitions 64
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Euverman & Nuyts
 * @since Euverman & Nuyts 1.0
 */

// if (!defined('API_URL')) 
// {
//     define('API_URL', 'https://api.realworks.nl/wonen/v1/objecten');
// }

if (!function_exists('salenagar_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since Euverman & Nuyts 1.0
     *
     * @return void
     */

    function salenagar_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Twenty Twenty-One, use a find and replace
         * to change 'twentytwentyone' to the name of your theme in all the template files.
         */
        load_theme_textdomain('salenagar', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');



        add_theme_support('menus');

        add_theme_support('widgets');
        /*
         * Let WordPress manage the document title.
         * This theme does not use a hard-coded <title> tag in the document head,
         * WordPress will provide it for us.
         */
        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        /**
         * Add post-formats support.
         */
        add_theme_support(
            'post-formats',
            array(
                'link',
                'aside',
                'gallery',
                'image',
                'quote',
                'status',
                'video',
                'audio',
                'chat',
            )
        );

        register_nav_menus(
            array(
                'main_menu' => esc_html__('Header Menu'),
                'footer_main_menu' => esc_html__('Footer Main Menu'),
                'footer_sub_menu' => esc_html__('Footer Sub Menu'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
                'navigation-widgets',
            )
        );

        /*
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        $logo_width = 300;
        $logo_height = 100;

        add_theme_support(
            'custom-logo',
            array(
                'height' => $logo_height,
                'width' => $logo_width,
                'flex-width' => true,
                'flex-height' => true,
                'unlink-homepage-logo' => true,
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // Add support for custom line height controls.
        add_theme_support('custom-line-height');

        // Add support for experimental link color control.
        add_theme_support('experimental-link-color');

        // Add support for experimental cover block spacing.
        add_theme_support('custom-spacing');

        // Remove feed icon link from legacy RSS widget.
        add_filter('rss_widget_feed_link', '__return_false');

        add_post_type_support('post', 'page-attributes');

        add_theme_support('woocommerce');

        //require get_parent_theme_file_path( '/inc/woocommerce.php' );
        //require get_parent_theme_file_path( '/inc/woocommerce.php' );

        // Options Page
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(
                array(
                    'page_title' => 'Theme General Settings',
                    'menu_title' => 'Theme Settings',
                    'menu_slug' => 'theme-general-settings',
                    'capability' => 'edit_posts',
                    'redirect' => false
                )
            );
        }

    }
}
add_action('after_setup_theme', 'salenagar_setup');
require_once ('admin-filter.php');
// ************************** styles and scripts registration ****************************//
function enqueue_styles_and_scripts()
{
    $rand = rand();
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/assets/css/styles.css', array(), $rand, 'all');
    wp_enqueue_style('custom-stylee', get_stylesheet_directory_uri() . '/assets/css/hotel.css', array(), $rand, 'all');
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), $rand, true);
    wp_enqueue_script('app-js-script', get_stylesheet_directory_uri() . '/assets/js/app.js', array('jquery'), $rand, true);
    wp_enqueue_script('app-js-map', get_stylesheet_directory_uri() . '/assets/js/app.js.map', array('jquery'), $rand, true);

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', null, 1.0, true);


    wp_localize_script('custom-script', 'PHP_ENV', array('WP_AJAX' => admin_url('admin-ajax.php'), 'cart_hash_key' => WC()->session->get('key')));
    // Localize script to pass data from PHP to JavaScript
    wp_localize_script(
        'api-fetch',
        'apiData',
        array(
            'apiKey' => '96a5a6309amsh3b7cc425ea168fcp17fc5bjsna9bca28bad2e',
        )
    );


    //fonts
    wp_enqueue_style('icomoon-fonts', get_stylesheet_directory_uri() . '/assets/fonts/icomoon.eot', array(), $rand, 'all');
    wp_enqueue_style('icomoon-fonts', get_stylesheet_directory_uri() . '/assets/fonts/icomoon.ttf', array(), $rand, 'all');
    wp_enqueue_style('icomoon-fonts', get_stylesheet_directory_uri() . '/assets/fonts/icomoon.woff', array(), $rand, 'all');

    //bootstrap
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css', array(), '5.0.0', 'all');
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js', array('jquery'), '5.0.0', true);


}
add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');



//  function to customize shop page through hoook

function before_shop_loop()
{ ?>


    <?php
    echo $perpage = get_field('products_per_page', 10);
    ?>
    <div id="products-sidebar-grid" class="row" style="display: flex;">
        <?php $product_categories = get_terms('product_cat'); ?>
        <div class="woocommerce-categories-checkbox" style="margin-right: 40px;">
            <p>Filter by Category</p>
            <?php foreach ($product_categories as $category): ?>
                <label>
                    <input type="checkbox" class="filter-checkbox" data-taxonomy="product_cat"
                        data-term="<?php echo esc_attr($category->slug); ?>" value="<?php echo esc_attr($category->slug); ?>">
                    <?php echo esc_html($category->name); ?>
                </label>
                <br>
            <?php endforeach; ?>
        </div>

        <?php
        // Color filter
        $colors = get_terms(
            array(
                'taxonomy' => 'pa_color',
                'hide_empty' => false,
            )
        );

        if ($colors): ?>

            <div class="woocommerce-color-checkbox" style="margin-right: 20px;">
                <p>Color:</p>
                <?php
                foreach ($colors as $color):
                    ?>
                    <label>
                        <input type="checkbox" class="color-checkbox" data-taxonomy="pa_color"
                            data-term="<?php echo esc_attr($color->slug); ?>" value="<?php echo esc_attr($color->slug); ?>" <?php echo isset($_GET['pa_color']) && in_array($color->slug, $_GET['pa_color']) ? 'checked' : ''; ?>>
                        <?php echo esc_html($color->name); ?>
                    </label>
                    <br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php
        // Size filter
        $sizes = get_terms(
            array(
                'taxonomy' => 'pa_size',
                'hide_empty' => false,
            )
        );

        if ($sizes): ?>
            <div class="woocommerce-size-checkbox" style="">
                <p>Size:</p>
                <?php
                foreach ($sizes as $size):
                    ?>
                    <label>
                        <input type="checkbox" class="size-checkbox" data-taxonomy="pa_size"
                            data-term="<?php echo esc_attr($size->slug); ?>" value="<?php echo esc_attr($size->slug); ?>" <?php echo isset($_GET['pa_size']) && in_array($size->slug, $_GET['pa_size']) ? 'checked' : ''; ?>>
                        <?php echo esc_html($size->name); ?>
                    </label>
                    <br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="woocom-show-result" style="margin-left:20px; margin-top:15px;">
            <label for="sorting-select">Sort by:</label>
            <select id="sorting-select">
                <option value="default">Default Sorting</option>
                <option value="meta_value_num" data-order="ASC">Price: Low to High</option>
                <option value="meta_value_num" data-order="DESC">Price: High to Low</option>
                <option value="name" data-order="ASC">Name: A-Z</option>
                <option value="name" data-order="DESC">Name: Z-A</option>
            </select>
        </div>
    </div>
    <?php
}
add_action('woocommerce_before_shop_loop', 'before_shop_loop');


// filter function

function filter_products()
{
    ob_start();

    // Retrieve selected filters, size, color, sorting, etc.
    $selectedFilters = isset($_POST['selectedFilters']) ? ($_POST['selectedFilters']) : '';
    $selectedSize = isset($_POST['selectedSize']) ? ($_POST['selectedSize']) : '';
    $selectedColor = isset($_POST['selectedColors']) ? ($_POST['selectedColors']) : '';
    $selectedSorting = isset($_POST['selectedSorting']) ? ($_POST['selectedSorting']) : '';
    $order = isset($_POST['order']) ? ($_POST['order']) : '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $perPageRecord = 3;

    // Initialize taxonomy queries
    $category_tax_queries = array();
    $size_color_tax_queries = array();

    // Prepare taxonomy queries for category, size, and color
    foreach ($selectedFilters as $filter) {
        $category_tax_queries[] = array(
            'taxonomy' => $filter['taxonomy'],
            'field' => 'slug',
            'terms' => $filter['term'],
        );
    }
    $category_tax_queries['relation'] = 'OR';
    foreach ($selectedSize as $size) {
        $size_color_tax_queries[] = array(
            'taxonomy' => $size['taxonomy'],
            'field' => 'slug',
            'terms' => $size['term'],
        );
    }
    foreach ($selectedColor as $color) {
        $size_color_tax_queries[] = array(
            'taxonomy' => $color['taxonomy'],
            'field' => 'slug',
            'terms' => $color['term'],
        );
    }


    $size_color_tax_queries['relation'] = 'OR';

    // Build the main query
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'paged' => $paged,
        'tax_query' => array(
            'relation' => 'AND',
            $category_tax_queries,
            $size_color_tax_queries
        ),
        'meta_query' => array(
            array(
                'key' => '_price',
                'type' => 'NUMERIC',
            ),
        ),
        'orderby' => $selectedSorting,
        'order' => $order,
        'posts_per_page' => $perPageRecord,
    );

    // Execute the query
    $query = new WP_Query($args);
    $total_products = $query->found_posts;

    // Output pagination section
    if ($perPageRecord) {
        get_template_part(
            "page-content/sections/section",
            "pagination-product",
            [
                "posts" => $query,
                "perPageRecord" => $perPageRecord,
                'currentPageNumber' => $paged,
                'isTherePagination' => true
            ]
        );
    }
    $total_pages = $query->max_num_pages;


    if ($total_products > $perPageRecord) {
        ?>
        <div id="product-list-pagination-div" style="justify-content:center;"> </div>
        <?php
    }

    $output = ob_get_clean();

    // Return JSON response
    echo json_encode(array('status' => 'success', 'display' => $output));

    // End PHP script
    wp_die();
}




add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');

function remove_woocommerce_sorting()
{
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
}
add_action('woocommerce_before_shop_loop', 'remove_woocommerce_sorting');


remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

function my_custom_search()
{
    $search_query = sanitize_text_field($_GET['s']);

    // Use WooCommerce's product query to search for products
    $product_query = new WP_Query(
        array(
            's' => $search_query,
            'post_type' => 'product',
        )
    );

    // Check if there are any products found
    if ($product_query->have_posts()) {
        // Start output buffering to capture the HTML output
        ob_start();

        // Loop through each product found
        while ($product_query->have_posts()) {
            $product_query->the_post();
            global $product;
            $num_results = $product_query->found_posts;

            // Display product details
            ?>
            <div class="search-result">
                <?php echo '<h5>Your search result for "' . $search_query . '": ' . $num_results . ' results found</h5>'; ?>

                <div class="product-thumbnail">
                    <?php

                    // Product image
                    if (has_post_thumbnail()) {
                        echo '<a href="' . esc_url(get_permalink()) . '">' . get_the_post_thumbnail($product->get_id(), 'thumbnail') . '</a>';
                    }
                    ?>
                </div>
                <div class="product-details">
                    <h3 class="product-title"><a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a></h3>
                    <?php
                    // Product price
                    echo '<span class="price">' . $product->get_price_html() . '</span>';

                    // Add to cart button
                    echo '<div class="add-to-cart">' . woocommerce_template_loop_add_to_cart() . '</div>';
                    ?>
                </div>
            </div>
            <?php
        }

        // End output buffering and return the captured HTML output
        $output = ob_get_clean();
        echo $output;
    } else {
        $num_results = $product_query->found_posts;
        echo '<h5>Your search result for "' . $search_query . '": ' . $num_results . ' results found</h5>';

    }

    // Reset post data and terminate the script
    wp_reset_postdata();
    wp_die();
}

function custom_product_filters()
{
    global $wpdb;

    // Retrieve colors
    $colors = $wpdb->get_col("
        SELECT DISTINCT meta_value
        FROM {$wpdb->prefix}postmeta
        WHERE meta_key = 'pa_color'
    ");

    if (!empty($colors)) {
        echo '<select name="filter_by_color">';
        echo '<option value="">Filter by Color</option>';
        foreach ($colors as $color) {
            echo '<option value="' . $color . '">' . $color . '</option>';
        }
        echo '</select>';
    }

    // Retrieve sizes
    $sizes = $wpdb->get_col("
        SELECT DISTINCT meta_value
        FROM {$wpdb->prefix}postmeta
        WHERE meta_key = 'pa_size'
    ");

    if (!empty($sizes)) {
        echo '<select name="filter_by_size">';
        echo '<option value="">Filter by Size</option>';
        foreach ($sizes as $size) {
            echo '<option value="' . $size . '">' . $size . '</option>';
        }
        echo '</select>';
    }
}

add_action('restrict_manage_posts', 'custom_product_filters');

// Handle filtering based on custom options
function custom_filter_products($query)
{
    global $pagenow, $post_type, $wpdb;

    if (is_admin() && $pagenow == 'edit.php' && $post_type == 'product') {
        $meta_query = array('relation' => 'AND');

        if (isset($_GET['filter_by_color']) && $_GET['filter_by_color'] != '') {
            $meta_query[] = array(
                'key' => 'pa_color',
                'value' => $_GET['filter_by_color'],
                'compare' => 'LIKE'
            );
        }

        if (isset($_GET['filter_by_size']) && $_GET['filter_by_size'] != '') {
            $meta_query[] = array(
                'key' => 'pa_size',
                'value' => $_GET['filter_by_size'],
                'compare' => 'LIKE'
            );
        }

        if (count($meta_query) > 1) {
            $query->set('meta_query', $meta_query);
        }
    }
}

add_filter('parse_query', 'custom_filter_products');

//add to cart with ajax
add_action('wp_ajax_add_to_cart_ajax', 'add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_to_cart_ajax', 'add_to_cart_ajax'); // for non-logged in users


// 50%working function
// function add_to_cart_ajax()
// {
//     if (isset($_POST['product_id'])) {
//         $product_id = intval($_POST['product_id']); // Sanitize product ID as an integer
//         $productcolor = isset($_POST['selectedColor']) ? sanitize_text_field($_POST['selectedColor']) : ''; // Sanitize selected color as text
//         $productsize = isset($_POST['selectedSize']) ? sanitize_text_field($_POST['selectedSize']) : ''; // Sanitize selected size as text

//         $result = WC()->cart->add_to_cart($product_id, 1, '', array(), array(
//             'pa_color' => $productcolor,
//             'pa_size' => $productsize
//         )
//         );

//         // Return response
//         if ($result) {
//             wp_send_json_success('Product added to cart!');
//         } else {
//             wp_send_json_error('Failed to add product to cart.');
//         }
//     } else {
//         wp_send_json_error('Product ID is not set.');
//     }

//     // Make sure to exit after sending the response
//     wp_die();
// }


// 1st function add to cart ajax
// function add_to_cart_ajax()
// {
//     if (isset($_POST['product_id'])) {
//         $product_id = intval($_POST['product_id']); // Sanitize product ID as an integer
//         $productcolor = isset($_POST['selectedColor']) ? sanitize_text_field($_POST['selectedColor']) : ''; // Sanitize selected color as text
//         $productsize = isset($_POST['selectedSize']) ? sanitize_text_field($_POST['selectedSize']) : ''; // Sanitize selected size as text

//         // Check if the product is a variation
//         $variation_id = '';
//         $variation_data = array();

//         $product = wc_get_product($product_id);
//         if ($product && $product->is_type('variable')) {
//             echo 'this is variaion product';
//             $available_variations = $product->get_available_variations();
//             foreach ($available_variations as $variation) {
//                 if ($variation['attributes']['attribute_pa_color'] === $productcolor && $variation['attributes']['attribute_pa_size'] === $productsize) {
//                     $variation_id = $variation['variation_id'];

//                     break;
//                 }
//             }
//             if ($variation_id === 0) {
//                 wp_send_json_error('Variation not found.');
//                 return;
//             }
//             $variation_data['pa_color'] = $productcolor;
//             $variation_data['pa_size'] = $productsize;
//         } else {
//             $result = WC()->cart->add_to_cart($product_id, 1);
//         }

//         // Add to cart
//         $result = WC()->cart->add_to_cart($product_id, 1, $variation_id, $variation_data);

//         // Return response
//         if ($result) {
//             wp_send_json_success('Product added to cart!');

//         } else {
//             wp_send_json_error('Failed to add product to cart.');
//         }
//     } else {
//         wp_send_json_error('Product ID is not set.');
//     }

//     // Make sure to exit after sending the response
//     wp_die();
// }


// 2nd function dd to cart ajax
// function add_to_cart_ajax()
// {
//     if (isset($_POST['product_id'])) {
//         $product_id = intval($_POST['product_id']); // Sanitize product ID as an integer
//         $variation_id = intval($_POST['variation_Id']);

//         $product = wc_get_product($product_id);
//         if ($product && $product->is_type('variable')) {
//             $variation = new WC_Product_Variation($variation_id);
//             $variation_data = array(
//                 'variation_id' => $variation_id,
//                 'variation' => $variation->get_variation_attributes(),
//                 'color' => $variation->get_attribute('pa_color'), 
//                 'regular_price' => $variation->get_regular_price(),
//             );


//         } else {
//             // If not a variable product, directly add to cart
//             $result = WC()->cart->add_to_cart($product_id, 1);
//         }

//         // Add to cart with variation data if available
//         if ($variation_id !== 0) {
//             $result = WC()->cart->add_to_cart($product_id, 1, $variation_id, $variation_data);
//         }

//         // Return response
//         if ($result) {
//             wp_send_json_success('Product added to cart!');
//         } else {
//             wp_send_json_error('Failed to add product to cart.');
//         }
//     } else {
//         wp_send_json_error('Product ID is not set.');
//     }

//     // Make sure to exit after sending the response
//     wp_die();
// }
// 3rd function using ajax
// function add_to_cart_ajax()
// {
//     if (isset($_POST['product_id'])) {
//         $product_id = intval($_POST['product_id']); // Sanitize product ID as an integer
//         $variation_id_col = intval($_POST['variation_Id_color']);
//         $variation_Id_size = intval($_POST['variation_Id_size']);



//         $product = wc_get_product($product_id);
//         if ($product && $product->is_type('variable')) {
//             $variation = new WC_Product_Variation($variation_id);
//             $variation_data = array(
//                 'variation_id_col' => $variation_id_col,
//                 'variation_Id_size' => $variation_Id_size,
//                 'variation' => $variation->get_variation_attributes(),
//                 'color' => $variation->get_attribute('pa_color'),
//                 'regular_price' => $variation->get_regular_price(),
//             );


//         } else {
//             // If not a variable product, directly add to cart
//             $result = WC()->cart->add_to_cart($product_id, 1);
//         }

//         // Add to cart with variation data if available
//         if ($variation_id !== 0) {
//             $result = WC()->cart->add_to_cart($product_id, 1, $variation_id, $variation_data);
//         }

//         // Return response
//         if ($result) {
//             wp_send_json_success('Product added to cart!');
//         } else {
//             wp_send_json_error('Failed to add product to cart.');
//         }
//     } else {
//         wp_send_json_error('Product ID is not set.');
//     }

//     // Make sure to exit after sending the response
//     wp_die();
// }


//4th function on add to cart

add_action('wp_ajax_add_to_cart_ajax', 'add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_to_cart_ajax', 'add_to_cart_ajax');

function add_to_cart_ajax()
{
    if (isset($_POST['product_id']) && isset($_POST['variation_Id'])) {
        $product_id = intval($_POST['product_id']);
        $variation_Id = intval($_POST['variation_Id']);
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
        $current_quantity = 0;
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            if (
                ($product_id && $variation_Id && $cart_item['product_id'] == $product_id && $cart_item['variation_id'] == $variation_Id) ||
                ($product_id && !$variation_Id && $cart_item['product_id'] == $product_id)
            ) {
                $current_quantity = $cart_item['quantity'];
                break;
            }
        }

        $quantity_difference = $quantity - $current_quantity;

        if ($quantity_difference > 0) {
            if ($product_id !== 0 && $variation_Id !== 0) {
                $result = WC()->cart->add_to_cart($product_id, $quantity_difference, $variation_Id);
            } else {
                $result = WC()->cart->add_to_cart($product_id, $quantity_difference);
            }
        } elseif ($quantity_difference < 0) {

            $result = WC()->cart->set_quantity($cart_item_key, $current_quantity + $quantity_difference);
        }



        if ($result !== false) {

            wp_send_json_success('Product added to cart!');

        } else {
            wp_send_json_error('Failed to add product to cart.');

        }
    } else {
        wp_send_json_error('Product ID or Variation ID is not set.');
    }
    wp_die();
}


add_action('wp_ajax_get_variation_ajax', 'get_variation_ajax');
add_action('wp_ajax_nopriv_get_variation_ajax', 'get_variation_ajax');

function get_variation_ajax()
{
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $variation_color = isset($_POST['variation_Id_color']) ? sanitize_text_field($_POST['variation_Id_color']) : '';
    $variation_size = isset($_POST['variation_Id_size']) ? sanitize_text_field($_POST['variation_Id_size']) : '';


    $variation_id = 0;
    $product_type = '';
    $variation_data = array();
    $product_quantity_in_cart = 0;
    $product_quantity_in_cart = WC()->cart->get_cart_item_quantities();

    // Get product
    $product = wc_get_product($product_id);
    $product_type = $product->get_type();

    // Initialize product image
    $product_image_src = '';

    // If product is a variation product
    if ($product_type === 'variable') {
        // Get available variations
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
            if ($match) {
                $regular_price = $variation['display_regular_price'];
                $sale_price = $variation['display_price'];
                $saved_money = $regular_price - $sale_price;
                // Calculate the percentage saved
                $percentage_saved = 0;
                if ($regular_price > 0) {
                    $saved_money = $regular_price - $sale_price;
                    $percentage_saved = round(($saved_money * 100 / $regular_price), 0);
                }
                $variation_id = $variation['variation_id'];
                $variation_data = array(
                    'variation_id' => $variation_id,
                    'quantity' => isset($product_quantity_in_cart[$variation_id]) ? $product_quantity_in_cart[$variation_id] : 0,
                    'price' => $sale_price,
                    'regular_price' => $regular_price,
                    'savedMoney' => $saved_money,
                    'saved' => $percentage_saved,
                    'image' => $variation['image']['src'],
                    'title' => $product->get_name(),
                    'SelectedColor' => $variation_color,
                    'SelectedSize' => $variation_size,
                    'stock_quantity' => $variation['max_qty']
                );
                // Set variation image
                $product_image_src = $variation['image']['src'];
                break;
            }
        }
    } else {
        // If product is not a variation product, use the main product image
        $product_image_id = $product->get_image_id();
        $product_image_src = wp_get_attachment_url($product_image_id);
    }

    // If no image is found, use a default fallback
    // if (empty($product_image_src)) {
    //     $product_image_src = 'path/to/default/image.jpg'; 
    // }

    // Prepare the response data
    $response_data = array(
        'variation_id' => $variation_id,
        'productid' => $product_id,
        'variation_data' => $variation_data,
        'product_type' => $product_type,
        'product_image_src' => $product_image_src
    );

    // Return the response as JSON
    wp_send_json($response_data);

    // Always use wp_die() to terminate immediately and return a proper response
    wp_die();
}



// Add Clear All button to cart
add_action('woocommerce_after_cart_table', 'add_clear_all_button_to_cart');
function add_clear_all_button_to_cart()
{
    echo '<div class="clear-all-button">';
    echo '<button id="clear-cart-button" class="button">Clear All</button>';
    echo '</div>';
}
//function of clearing cart
// Clear cart via AJAX
add_action('wp_ajax_clear_cart', 'clear_cart_ajax');
add_action('wp_ajax_nopriv_clear_cart', 'clear_cart_ajax'); // Allow non-logged in users to clear cart
function clear_cart_ajax()
{
    if (isset(WC()->cart)) {
        WC()->cart->empty_cart();
    }
    wp_die(); // Always use wp_die() to end AJAX requests
}
add_action('woocommerce_cart_actions', 'remove_default_cart_actions', 10);
function remove_default_cart_actions()
{
    // Remove the default coupon form
    remove_action('woocommerce_cart_totals_after_order_total', 'woocommerce_cart_totals_coupon_form');

    // Remove the default update cart button
    remove_action('woocommerce_cart_actions', 'woocommerce_cart_totals_update_cart_button');
}


add_action('woocommerce_proceed_to_checkout', 'add_custom_content_after_order_total');
function add_custom_content_after_order_total()
{ ?>
    <div class="discount">
        <label for="discount_code" class="screen-reader-text">Discount:</label>
        <input type="text" name="discount_code" class="input-text" id="discount_code" value="" placeholder="Discount code">
        <button type="submit" class="button custom-button" name="apply_discount" value="Apply discount">Apply
            discount</button>
    </div>

    <button type="submit" class="button custom-button" name="update_cart" value="Update cart" disabled="">Update
        cart</button>

    <input type="hidden" id="custom-cart-nonce" name="custom-cart-nonce" value="b5947b5f96">
    <input type="hidden" name="_wp_http_referer" value="/wordpress/cart/">
    <?php
}
// Add content to mini cart



add_filter('woocommerce_package_rates', 'custom_free_shipping_costs', 10, 2);

function custom_free_shipping_costs($rates, $package)
{
    // Check if free shipping is available
    session_start();
    echo 'Hello';
    $free_shipping_key = 'free_shipping:8';
    if (isset($rates[$free_shipping_key])) {
        // Get user's shipping city
        $city = isset($_SESSION['city_name']) ? $_SESSION['city_name'] : '';

        if (!$city && isset($_SESSION) && isset($_SESSION['selected_district']) && $_SESSION['selected_district']) {
            $city = $_SESSION['selected_district'];
        }

        $totals = WC()->cart->get_totals();
        $total_cart = $totals['subtotal'] + $totals['subtotal_tax'];

        // Define shipping costs based on city
        $ahmedabad_price = 100;
        $gandhinagar_price = 1000;
        $other_price = 10000;


        if ($city == 'Ahmedabad') {
            if ($total_cart >= 5000) {
                $rates[$free_shipping_key]->cost = 0;
            } else {
                $rates[$free_shipping_key]->cost = $ahmedabad_price;
            }
        } elseif ($city == 'Gandhinagar') {
            if ($total_cart >= 8000) {
                $rates[$free_shipping_key]->cost = 0;
            } else {
                $rates[$free_shipping_key]->cost = $gandhinagar_price;
            }
        } else {
            $rates[$free_shipping_key]->cost = $other_price;
        }
    }
    return $rates;
}






function save_city_to_session($posted_data)
{
    if (isset($posted_data['billing_city'])) {
        WC()->session->set('city_name', $posted_data['billing_city']);
    }
}


$pincodes = array(
    'Gandhinagar' => array(
        '382010',
        '382011',
        '382012',
        '382013',
        '382014',
        '382015',
        '382016',
        '382017',
        '382018',
        '382019'
    ),
    'Ahmedabad' => array(
        '380001',
        '380002',
        '380003',
        '380004',
        '380005',
        '380006',
        '380007',
        '380008',
        '380009',
        '380010'
    ),
    'Junagadh' => array('362001'),
    'Rajkot' => array('360001'),
    'Jamnagar' => array('361001')
);

add_action('wp_ajax_nopriv_suggest_cities', 'suggest_cities');
add_action('wp_ajax_suggest_cities', 'suggest_cities');

function suggest_cities()
{
    global $pincodes;
    // Retrieve the pincode sent via AJAX
    $pincode = $_POST['pincode'];

    // Your array of pincodes


    $suggested_cities = array();

    // Iterate through the pincodes array to find matching cities
    foreach ($pincodes as $city => $city_pincodes) {
        if (in_array($pincode, $city_pincodes)) {
            $suggested_cities[] = $city;
        }
    }

    // Return suggested cities as JSON
    echo json_encode($suggested_cities);

    // Always remember to exit
    wp_die();
}

function get_city_info()
{
    global $pincodes;

    // Start or resume the session
    if (!session_id()) {
        session_start();
    }

    // Check if pincode parameter is set
    if (isset($_POST['pincode'])) {
        $pincode = $_POST['pincode'];

        $matched_city = '';
        foreach ($pincodes as $city => $pin_array) {
            if (in_array($pincode, $pin_array)) {
                $matched_city = $city;
                break;
            }
        }

        if (!empty($matched_city)) {

            $_SESSION['city_name'] = $matched_city;
            echo "The pincode $pincode matches with $matched_city";
        } else {
            echo "No city found for the pincode $pincode";
        }
    } else {
        wp_die('Pincode parameter not set');
    }


    exit;
}

// Hooking the function to the WordPress AJAX action
add_action('wp_ajax_get_city_info', 'get_city_info');
add_action('wp_ajax_nopriv_get_city_info', 'get_city_info'); // For non-logged in users


// Custom Colour Filters for Products in Admin Panel


// AJAX handler for WooCommerce product search
add_action('wp_ajax_nopriv_woocommerce_product_search', 'woocommerce_product_search');
add_action('wp_ajax_woocommerce_product_search', 'woocommerce_product_search');
function woocommerce_product_search()
{
    if (!session_id()) {
        session_start();
    }

    // Get the search term from the AJAX request
    $search_term = sanitize_text_field($_POST['search_term']);
    $_SESSION['search_queries'][] = $search_term;

    // Perform the search query
    $args = array(
        'post_type' => 'product',
        's' => $search_term,
    );

    $query = new WP_Query($args);

    // Create an array to store search results
    $search_results = array();

    // Loop through the search results and store them in the array
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            $stock_status = $product->get_stock_status();
            $out_of_stock_class = $stock_status == 'outofstock' ? 'product out-of-stock' : 'product';
            // Get product details
            $product_id = $product->get_id();
            $attributes = $product->get_attributes();

            ob_start();
            ?>
            <div class="<?php echo $out_of_stock_class; ?>" style="height: auto;">
                <a href=" <?php the_permalink(); ?>">
                    <figure>

                        <?php the_post_thumbnail('thumbnail'); ?>

                    </figure>
                </a>
                <h6>
                    <?php the_title(); ?>
                </h6>
                <div class="price-row">
                    <div class="price-info">
                        <del>
                            <?php echo $product->get_regular_price(); ?>
                        </del>
                        <span class="price">
                            <?php
                            if ($product->is_type('variable')) {
                                // Initialize an empty array to hold the attribute key-value pairs
                                $variation_attributes = array();

                                // Get all attributes of the product
                                $attributes = $product->get_attributes();

                                // Loop through each attribute
                                foreach ($attributes as $attribute) {
                                    // Get the attribute name
                                    $attribute_name = $attribute->get_name();

                                    // Get the selected value for this attribute
                                    $selected_value = isset($_REQUEST['attribute_' . sanitize_title($attribute_name) . '_' . $product->get_id()]) ? $_REQUEST['attribute_' . sanitize_title($attribute_name) . '_' . $product->get_id()] : '';

                                    // Add this attribute and its selected value to the variation attributes array
                                    $variation_attributes['attribute_' . sanitize_title($attribute_name)] = $selected_value;
                                }

                                // Get the variation ID based on selected attributes
                                $variation_id = $product->get_id();
                                $variation_data_store = WC_Data_Store::load('product-variable');
                                $variation_id = $variation_data_store->find_matching_product_variation(
                                    $product,
                                    $variation_attributes
                                );

                                // Get the variation price
                                if ($variation_id) {
                                    $variation = new WC_Product_Variation($variation_id);
                                    echo $variation->get_price_html();
                                } else {
                                    // If variation not found, display the default product price
                                    echo $product->get_price_html();
                                }
                            } else {
                                // For simple products, display the default product price
                                echo $product->get_price_html();
                            }
                            ?>
                        </span>

                        <p>(Inclusive of all taxes)</p>
                    </div>
                </div>
                <?php
                global $product;
                $in_cart_quantity = 0;
                if ($product->is_type('variable')) {
                    $variations = $product->get_available_variations();
                    if (!empty($variations)) {
                        // Get the first variation
                        $first_variation = reset($variations);
                        $variation_id = $first_variation['variation_id'];
                        $product_id = $product->get_id();
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                            if ($cart_item['variation_id'] == $variation_id && $cart_item['product_id'] == $product_id) {
                                $in_cart_quantity += $cart_item['quantity'];
                            }
                        }
                    }
                } else {
                    $product_id = $product->get_id();
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        if ($cart_item['product_id'] == $product_id) {
                            $in_cart_quantity += $cart_item['quantity'];
                        }
                    }
                }
                ?>
                <div class="form-group no-swiping">

                    <?php
                    if ($product->is_type('variable')) {
                        $attributes = $product->get_attributes();

                        if ($attributes) {
                            foreach ($attributes as $attribute) {
                                $attribute_name = $attribute->get_name();
                                echo '<div class="form-group no-swiping">';
                                echo '<label for="' . esc_attr($attribute_name) . '">' . 'Select ' . esc_html($attribute_name) . '</label>';
                                echo '<select name="attribute_' . esc_attr($attribute_name) . '_' . $product->get_id() . '" id="' . esc_attr($attribute_name) . '_' . $product->get_id() . '" class="form-control variation-select" data-product-id="' . esc_attr($product->get_id()) . '">';
                                $attribute_terms = wc_get_product_terms($product->get_id(), $attribute_name, array('fields' => 'all'));

                                foreach ($attribute_terms as $term) {
                                    $variations = $product->get_available_variations();
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
                $style_btn = $in_cart_quantity > 0 ? 'display:none' : '';
                $style_qty = $in_cart_quantity > 0 ? '' : 'display:none';
                ?>
                <div class="btn-group" style="<?php echo $style_btn; ?>">
                    <a href="<?php echo wc_get_cart_url(); ?>" class="button add-to-cart"
                        data-product-id="<?php echo $product->get_id(); ?>"
                        data-variation-id="<?php echo esc_attr($variation_id); ?>">
                        Add to Cart<i class="icon-cart"></i>
                    </a>
                </div>
                <?php $in_cart_quantity = ($in_cart_quantity !== 0) ? $in_cart_quantity : 1; ?>

                <div class="qty-box" style="<?php echo $style_qty; ?>">
                    <div class="quantity">
                        <input type="button" value="-" class="qty-minus">
                        <input type="number" name="quantity" value="<?php echo $in_cart_quantity; ?>" title="Qty" class="qty"
                            size="4" id="qnty" min="1" max="100">
                        <input type="button" value="+" class="qty-plus">
                    </div>
                </div>


            </div>

            <?php
            $product_html = ob_get_clean();
            $search_results[] = array(
                'html' => $product_html,
                'product_id' => $product_id
            );
        }
    }
    echo json_encode($search_results);

    // Always remember to exit
    wp_die();
}

// AJAX handler for clearing all searches
// Hook for logged-in users
add_action('wp_ajax_clear_searches', 'clear_searches_callback');
function clear_searches_callback()
{

    // Start the session if it hasn't been started already
    if (!session_id()) {
        session_start();
    }

    // Check if 'search_queries' session variable is set and is an array
    if (isset($_SESSION['search_queries']) && is_array($_SESSION['search_queries'])) {
        // Unset the entire 'search_queries' session variable array
        unset($_SESSION['search_queries']);
        // Return success message
        echo json_encode(array('success' => true));
    } else {
        // Return failure message
        echo json_encode(array('success' => false));
    }

    // Always include wp_die() to terminate script execution
    wp_die();
}


// Hook for non-logged-in users
add_action('wp_ajax_nopriv_clear_searches', 'clear_searches_callback');




// Add content to the header of the shop page
function custom_header_content()
{
    if (is_shop()) {
        get_header();
    }
}
add_action('woocommerce_before_main_content', 'custom_header_content');

//mini cart functions
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

// add_action('woocommerce_after_single_product_summary', 'QuadLayers_callback_function');
// function QuadLayers_callback_function()
// {
//     printf('
//     <h1> Hey there !</h1>
//     <div><h5>Welcome to my custom product page</h5>
//     <h4><a href="?link-to-somewere">Link to somewere!</a></h4>
//     <img src="https://img.freepik.com/free-vector/bird-silhouette-logo-vector-illustration_141216-100.jpg" />
//     </div>');
// }
// Add a filter to modify the rating count HTML


function display_review_count()
{
    global $product;

    if ($product->get_review_count() > 0) {
        $count = $product->get_review_count();
        $label = sprintf(_n('%s review', '%s reviews', $count, 'woocommerce'), $count);
        echo '<div class="woocommerce-review-count">' . esc_html($label) . '</div>';
    }
}
add_action('woocommerce_single_product_summary', 'display_review_count', 10);

function display_best_rated_products()
{
    // Query best rated products
    $best_rated_args = array(
        'post_type' => 'product',
        'posts_per_page' => 5, // Adjust the number of products to display
        'orderby' => 'meta_value_num',
        'meta_key' => '_wc_average_rating', // Use WooCommerce's average rating meta key
        'order' => 'DESC',
    );
    $best_rated_query = new WP_Query($best_rated_args);

    // Display best rated products
    if ($best_rated_query->have_posts()) { ?>
        <div class="products-block">
            <div class="wrap">
                <div class="section-title">
                    <h4 class="title-line">Best Selling Products</h4>
                    <div class="products-swiper-btn">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev swiper-button-disabled"></div>
                    </div>
                </div>
                <div
                    class="swiper products-swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                    <div class="swiper-wrapper" style="cursor: grab; transform: translate3d(0px, 0px, 0px);">
                        <?php while ($best_rated_query->have_posts()) {
                            $best_rated_query->the_post();
                            global $product;
                            $stock_status = $product->get_stock_status();
                            $out_of_stock_class = $stock_status == 'outofstock' ? 'product out-of-stock' : 'product'; ?>
                            <div class="swiper-slide swiper-slide-active" style="width: 277.5px; margin-right: 20px;">
                                <div class="<?php echo $out_of_stock_class; ?>" style="height: auto;"
                                    data-product-id="<?php echo $product->get_id(); ?>">
                                    <a href="<?php the_permalink(); ?>">
                                        <figure>
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </figure>
                                    </a>
                                    <h6>
                                        <?php the_title(); ?>
                                    </h6>
                                    <div class="price-row">
                                        <div class="price-info">
                                            <?php if ($product->is_type('variable')): ?>
                                                <span class="price">
                                                    <?php
                                                    // Get the default variation ID
                                                    $default_variation_id = $product->get_default_attributes();

                                                    // If default variation ID exists, display its price
                                                    if ($default_variation_id) {
                                                        $variation = new WC_Product_Variation($default_variation_id);
                                                        echo $variation->get_price_html();
                                                    } else {
                                                        // If no default variation is set, display the default product price
                                                        echo $product->get_price_html();
                                                    }
                                                    ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="price">
                                                    <?php echo $product->get_price_html(); ?>
                                                </span>
                                            <?php endif; ?>
                                            <p>(Inclusive of all taxes)</p>
                                        </div>
                                    </div>

                                    <?php
                                    global $product;
                                    $in_cart_quantity = 0;
                                    if ($product->is_type('variable')) {
                                        $variations = $product->get_available_variations();
                                        if (!empty($variations)) {
                                            // Get the first variation
                                            $first_variation = reset($variations);
                                            $variation_id = $first_variation['variation_id'];
                                            $product_id = $product->get_id();
                                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                                if ($cart_item['variation_id'] == $variation_id && $cart_item['product_id'] == $product_id) {
                                                    $in_cart_quantity += $cart_item['quantity'];
                                                }
                                            }
                                        }
                                    } else {
                                        $product_id = $product->get_id();
                                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                            if ($cart_item['product_id'] == $product_id) {
                                                $in_cart_quantity += $cart_item['quantity'];
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="form-group no-swiping">
                                        <?php
                                        if ($product->is_type('variable')) {
                                            $attributes = $product->get_attributes();
                                            if ($attributes) {
                                                foreach ($attributes as $attribute) {
                                                    $attribute_name = $attribute->get_name(); ?>
                                                    <div class="form-group no-swiping">
                                                        <label for="<?php echo esc_attr($attribute_name); ?>">
                                                            <?php echo 'Select ' . esc_html($attribute_name); ?>
                                                        </label>
                                                        <select
                                                            name="attribute_<?php echo esc_attr($attribute_name) . '_' . $product->get_id(); ?>"
                                                            id="<?php echo esc_attr($attribute_name) . '_' . $product->get_id(); ?>"
                                                            class="form-control variation-select"
                                                            data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                                                            <?php
                                                            $attribute_terms = wc_get_product_terms($product->get_id(), $attribute_name, array('fields' => 'all'));
                                                            foreach ($attribute_terms as $term) {
                                                                $variations = $product->get_available_variations();
                                                                foreach ($variations as $variation) {
                                                                    $variation_attributes = $variation['attributes'];
                                                                    if ($variation_attributes['attribute_' . $attribute_name] == $term->slug) {
                                                                        echo '<option value="' . esc_attr($term->name) . '">' . esc_html($term->name) . '</option>';
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                <?php }
                                            }
                                        } ?>
                                    </div>
                                    <?php
                                    $style_btn = $in_cart_quantity > 0 ? 'display:none' : '';
                                    $style_qty = $in_cart_quantity > 0 ? '' : 'display:none'; ?>
                                    <div class="btn-group" style="<?php echo $style_btn; ?>">
                                        <a href="<?php echo wc_get_cart_url(); ?>" class="button add-to-cart"
                                            data-product-id="<?php echo $product->get_id(); ?>">
                                            Add to Cart<i class="icon-cart"></i>
                                        </a>
                                    </div>
                                    <?php $in_cart_quantity = ($in_cart_quantity !== 0) ? $in_cart_quantity : 1; ?>
                                    <div class="qty-box" style="<?php echo $style_qty; ?>"
                                        data-product-id="<?php echo $product->get_id(); ?>">
                                        <div class="quantity">
                                            <input type="button" value="-" class="qty-minus">
                                            <input type="number" name="quantity" value="<?php echo $in_cart_quantity; ?>"
                                                title="Qty" class="qty" size="4" id="qnty" min="1" max="100">
                                            <input type="button" value="+" class="qty-plus">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    wp_reset_postdata();
}

// Hook the function to display at the end of the product detail page
add_action('woocommerce_after_single_product', 'display_best_rated_products', 10);





// Add variation buttons to product summary
add_action('woocommerce_after_shop_loop_item', 'display_variation_buttons_loop', 5);
add_action('woocommerce_single_product_summary', 'display_variation_buttons_single', 5);

function display_variation_buttons_loop()
{
    global $product;

    if ($product->is_type('variable')) {

        // Get available variations
        $available_variations = $product->get_available_variations();

        // Display variation buttons
        foreach ($available_variations as $variation) {
            $variation_id = $variation['variation_id'];
            $variation_attributes = $variation['attributes'];

            // Output button with variation attribute
            echo '<a href="' . esc_url(get_permalink($variation_id)) . '" class="variation-button">';
            echo implode(' / ', $variation_attributes);
            echo '</a>';
        }
    }
}

function display_variation_buttons_single()
{
    global $product;

    if ($product->is_type('variable')) {
        $product_id = $product->get_id();
        // Get available variations
        $available_variations = $product->get_available_variations();
        echo '<div class="variations-btns">';
        echo '<h6> Seelct varients:</h6>';
        // Display variation buttons
        foreach ($available_variations as $variation) {
            $variation_id = $variation['variation_id'];
            $variation_attributes = $variation['attributes'];


            // Output button with variation attribute

            echo '<a href="' . esc_url(get_permalink($variation_id)) . '" class="variation-button"data-variation-id="' . $variation_id . '" data-product-id="' . $product_id . '">';
            echo implode(' / ', $variation_attributes);

            echo '</a>';


        }
        echo "</div>";
    }
}


//variation price 
// Add this PHP code in your theme's functions.php file or in a custom plugin

add_action('wp_ajax_get_variation_info', 'get_variation_info_callback');
add_action('wp_ajax_nopriv_get_variation_info', 'get_variation_info_callback');

function get_variation_info_callback()
{

    if (isset($_POST['product_id']) && isset($_POST['variation_id'])) {
        $variation_id = intval($_POST['variation_id']);
        $product_id = intval($_POST['product_id']);
        $product = wc_get_product($product_id);
        $variation = wc_get_product($variation_id);
        if ($product && $variation) {
            $variation_regular_price = $variation->get_regular_price();
            $variation_sale_price = $variation->get_sale_price();
            $discount = $variation_regular_price - $variation_sale_price;
            if ($discount != 0) {
                $percentage_discount = ($discount / $variation_regular_price) * 100;
                $percentage_discount = round($percentage_discount, 2);
            }
            // Get variation image URL
            $product_quantity_in_cart = 0;
            $product_quantity_in_cart = WC()->cart->get_cart_item_quantities();

            $response_data = array(
                'variation_regular_price' => $variation_regular_price,
                'variation_sale_price' => $variation_sale_price,
                'save' => $percentage_discount,
                'quantity' => isset($product_quantity_in_cart[$variation_id]) ? $product_quantity_in_cart[$variation_id] : 0,


            );
            wp_send_json($response_data);
        } else {
            wp_send_json_error('Product or variation not found');
        }
    } else {
        wp_send_json_error('Product ID or variation ID is missing');
    }
}

add_filter('woocommerce_product_tabs', 'woo_new_product_tab');
function woo_new_product_tab($tabs)
{
    // Adds the new tab
    $tabs['test_tab'] = array(
        'title' => __('Country of Origin', 'woocommerce'),
        'priority' => 50,
        'callback' => 'woo_new_product_tab_content'
    );
    return $tabs;
}

function woo_new_product_tab_content()
{
    echo '<p>Liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari.</p>';
}
add_action('woocommerce_review_order_after_shipping', 'custom_content_before_order_total');

function custom_content_before_order_total()
{
    // Get the cart total
    // Get the shipping total from the cart
    $shipping_total = WC()->cart->get_shipping_total();

    // Display the delivery charge row
    ?>
    <tr class="order-delivery">
        <th>
            <?php _e('Delivery Charge', 'twentytwentyfour'); ?>
        </th>
        <td colspan="2">
            <?php echo wc_price($shipping_total); ?>
        </td>
    </tr>
    <?php
}
function apply_custom_css()
{
    if (is_checkout()) {
        ?>
        <style>
            tr.woocommerce-shipping-totals.shipping,
            tr.tax-total,
            tr.cart-subtotal {
                display: none !important;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'apply_custom_css');



// Step 1: Define Custom Order Status
add_action('init', 'register_custom_order_status');

function register_custom_order_status()
{
    register_post_status(
        'wc-scam-detected',
        array(
            'label' => _x('Scam Detected', 'Order status', 'woocommerce'),
            'public' => true,
            'exclude_from_search' => false,
            'show_in_admin_all_list' => true,
            'show_in_admin_status_list' => true,
            'label_count' => _n_noop('Scam Detected <span class="count">(%s)</span>', 'Scam Detected <span class="count">(%s)</span>'),
        )
    );




    register_post_status(
        'wc-not-interested',
        array(
            'label' => _x('Not Interested', 'Order status', 'woocommerce'),
            'public' => true,
            'exclude_from_search' => false,
            'show_in_admin_all_list' => true,
            'show_in_admin_status_list' => true,
            'label_count' => _n_noop('Not Interested <span class="count">(%s)</span>', 'Not Interested <span class="count">(%s)</span>'),
        )
    );
}

// Step 2: Update Order Statuses
add_filter('wc_order_statuses', 'add_custom_order_status');

function add_custom_order_status($order_statuses)
{
    $order_statuses['wc-scam-detected'] = _x('Scam Detected', 'Order status', 'woocommerce');
    $order_statuses['wc-not-interested'] = _x('Not Interested', 'Order status', 'woocommerce');

    return $order_statuses;
}

// Step 3: Style the Status
add_action('admin_head', 'custom_order_status_style');

function custom_order_status_style()
{
    ?>
    <style>
        .order-status.status-scam-detected {
            background: #ff0000;
            color: #ffffff;
        }

        .order-status.status-not-interested {
            background: black;
            color: white;
        }
    </style>
    <?php
}



add_action('woocommerce_order_status_changed', 'cancel_order_on_scam_detected', 10, 4);

function cancel_order_on_scam_detected($order_id, $old_status, $new_status, $order)
{
    // Check if the new status is "Scam Detected" and the old status is not already "Cancelled"
    if ($new_status === 'wc-scam-detected' && $old_status !== 'cancelled') {
        // Cancel the order
        $order->update_status('cancelled', __('Order cancelled due to scam detection.', 'twentytwentyfour'));

        // Add a note to the order's history
        $order->add_order_note(__('Order cancelled due to scam detection.', 'your-text-domain'));
    }
}


add_action('woocommerce_order_status_changed', 'cancel_order_on_not_interested', 10, 4);

function cancel_order_on_not_interested($order_id, $old_status, $new_status, $order)
{
    // Check if the new status is "Scam Detected" and the old status is not already "Cancelled"
    if ($new_status === 'wc-not-interested' && $old_status !== 'cancelled') {
        // Cancel the order
        $order->update_status('cancelled', __('Order cancelled due to Not Innterested.', 'twentytwentyfour'));

        // Add a note to the order's history
        $order->add_order_note(__('Order cancelled due to Not Innterested.', 'twentytwentyfour'));
    }
}


function custom_login_logo()
{
    $logo_url = get_template_directory_uri() . '/assets/images/login loog.png';
    ?>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            var logo = document.querySelector('.login h1 a');
            if (logo) {
                logo.style.backgroundImage = 'url("<?php echo $logo_url; ?>")';
                logo.style.backgroundSize = 'contain';
                logo.style.width = '100%';

            }
        });
    </script>
    <?php
}
add_action('login_enqueue_scripts', 'custom_login_logo');



function custom_login_placeholder_text($translated_text, $text, $domain)
{
    if ('Username or Email Address' === $translated_text) {
        $translated_text = 'Please enter your Mail';
    } elseif ('Password' === $translated_text) {
        $translated_text = 'Please enter your Password';
    } else if ('Log In' === $translated_text) {
        $translated_text = 'Submit';
    }

    return $translated_text;
}
add_filter('gettext', 'custom_login_placeholder_text', 20, 3);


// Add custom CSS to the login page
function custom_login_css()
{
    ?>
    <style type="text/css">
        #login {
            width: 50%;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        .language-switcher {
            display: none;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'custom_login_css');





function remove_downloads_menu_item($items)
{
    unset($items['dashboard']);
    unset($items['downloads']);
    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_downloads_menu_item');


add_filter('woocommerce_account_menu_items', 'rename_downloads');

function rename_downloads($menu_links)
{


    $menu_links['orders'] = 'My Orders';
    $menu_links['edit-address'] = 'My Address';
    $menu_links['edit-account'] = 'My Profile';


    return $menu_links;
}

add_filter('woocommerce_account_menu_items', 'menu_links_reorder');

function menu_links_reorder($menu_links)
{

    return array(
        'edit-account' => __('My Profile', 'woocommerce'),
        'orders' => __('My Orders', 'woocommerce'),
        'edit-address' => __('My Address', 'woocommerce'),
        'customer-logout' => __('Logout', 'woocommerce')
    );

}
// Add Mid-Sale Price Field
// Add Custom Price Field to Variation Options
add_action('woocommerce_product_after_variable_attributes', 'add_custom_price_field_to_variations', 10, 3);

function add_custom_price_field_to_variations($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => '_mid_sale_price_' . $variation->ID,
            'name' => '_mid_sale_price[' . $variation->ID . ']',
            'label' => __('Mid-Sale Price', 'woocommerce'),
            'data_type' => 'price',
            'value' => get_post_meta($variation->ID, '_mid_sale_price', true),
            'desc_tip' => 'true',
            'description' => __('Enter the mid-sale price here.', 'woocommerce'),
        )
    );
}

// Save Custom Price Field for Variations
add_action('woocommerce_save_product_variation', 'save_custom_price_field_for_variations', 10, 2);

function save_custom_price_field_for_variations($variation_id, $loop)
{
    $mid_sale_price = isset($_POST['_mid_sale_price'][$variation_id]) ? sanitize_text_field($_POST['_mid_sale_price'][$variation_id]) : '';
    update_post_meta($variation_id, '_mid_sale_price', $mid_sale_price);
}

// Override WooCommerce product price display
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'custom_woocommerce_template_single_price', 10);

function custom_woocommerce_template_single_price()
{
    global $product;

    // Get Mid-Sale Price
    $mid_sale_price = get_post_meta($product->get_id(), '_mid_sale_price', true);

    // Inline CSS for strikethrough
    $strike_through_style = 'style="text-decoration: line-through; color: #999;"';

    // Display price based on product state
    if ($product->is_on_sale()) {
        echo '<p class="price">';
        echo '<del ' . $strike_through_style . '>' . wc_price($product->get_regular_price()) . '</del> ';
        if (!empty($mid_sale_price)) {
            echo '<del class="mid-sale-price" ' . $strike_through_style . '>' . wc_price($mid_sale_price) . '</del> ';
        }
        echo '<ins>' . wc_price($product->get_sale_price()) . '</ins>';
        echo '</p>';
    } else {
        echo '<p class="price">' . wc_price($product->get_price()) . '</p>';
    }
}

// Function to fetch hotel offers from Amadeus API
function fetch_amadeus_hotel_offers()
{
    $api_key = 'ZmOxy5vvWQAk1AwbAQEsX1I4JrVKzjdM';
    $api_secret = 'xn7uxDOERN0Z6GUV';
    $endpoint = 'https://test.api.amadeus.com/v2/shopping/hotel-offers';

    // Example parameters
    $cityCode = 'PAR';  // Example: Paris city code
    $checkInDate = '2024-08-01';  // Example: August 1, 2024
    $checkOutDate = '2024-08-05';  // Example: August 5, 2024

    $query_params = array(
        'cityCode' => $cityCode,
        'checkInDate' => $checkInDate,
        'checkOutDate' => $checkOutDate,
        // Add more parameters as required by Amadeus API documentation
    );

    $response = wp_remote_get(
        $endpoint,
        array(
            'headers' => array(
                'Authorization' => 'Bearer ' . base64_encode($api_key . ':' . $api_secret),
                'Content-Type' => 'application/json',
            ),
            'body' => json_encode($query_params),
        )
    );

    if (is_wp_error($response)) {
        return 'Error: ' . $response->get_error_message();
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        return $data;
    }
}

// Shortcode to display Amadeus hotel offers
function display_amadeus_hotel_offers()
{
    $hotel_offers = fetch_amadeus_hotel_offers();
    if (is_string($hotel_offers)) {
        return $hotel_offers;
    } else {
        // Customize this to display the hotel offers as you like
        $output = '<ul>';
        foreach ($hotel_offers['data'] as $offer) {
            $output .= '<li>' . $offer['hotel']['name'] . ' - ' . $offer['offers'][0]['price']['total'] . '</li>';
        }
        $output .= '</ul>';
        return $output;
    }
}
add_shortcode('amadeus_hotel_offers', 'display_amadeus_hotel_offers');


function display_api_data()
{
    return '<div id="api-data-container">Loading data...</div>';
}
add_shortcode('api_data', 'display_api_data');

// AJAX handler for fetching train schedule
add_action('wp_ajax_get_train_schedule', 'get_train_schedule_callback');
add_action('wp_ajax_nopriv_get_train_schedule', 'get_train_schedule_callback');

function get_train_schedule_callback()
{
    $train_no = $_POST['trainNo'];

    // Perform API request
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://irctc1.p.rapidapi.com/api/v1/getTrainSchedule?trainNo=$train_no",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: irctc1.p.rapidapi.com",
            "x-rapidapi-key: 96a5a6309amsh3b7cc425ea168fcp17fc5bjsna9bca28bad2e"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $data = json_decode($response, true);
        if (isset($data['trainSchedule'])) {
            ob_start();
            ?>
            <div id="train-schedule-results">
                <h3>Train Schedule for Train Number <?php echo $train_no; ?></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Station Name</th>
                            <th>Departure Time</th>
                            <th>Arrival Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['trainSchedule'] as $schedule): ?>
                            <tr>
                                <td><?php echo $schedule['station']['name']; ?></td>
                                <td><?php echo $schedule['departure']; ?></td>
                                <td><?php echo $schedule['arrival']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php
            $output = ob_get_clean();
            echo $output;
        } else {
            echo "No schedule found for this train.";
        }
    }

    wp_die();
}

function localize_api_data()
{
    wp_localize_script('custom-script', 'api_data', array(
        'endpoint' => 'https://irctc1.p.rapidapi.com/api/v1/getTrainSchedule',
        'api_key' => '96a5a6309amsh3b7cc425ea168fcp17fc5bjsna9bca28bad2e'
    )
    );
}
add_action('wp_enqueue_scripts', 'localize_api_data');



// AJAX handler for fetching train schedule
add_action('wp_ajax_get_train_schedule', 'get_train_schedule');
add_action('wp_ajax_nopriv_get_train_schedule', 'get_train_schedule');

function get_train_schedule()
{
    $train_number = $_POST['train_number'];

    // Perform API request
    $endpoint = 'https://irctc1.p.rapidapi.com/api/v1/getTrainSchedule?trainNo=' . urlencode($train_number);
    $response = wp_remote_get($endpoint, array(
        'headers' => array(
            'X-RapidAPI-Key' => '96a5a6309amsh3b7cc425ea168fcp17fc5bjsna9bca28bad2e'
        )
    )
    );

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        echo json_encode(array('error' => $error_message));
    } else {
        $body = wp_remote_retrieve_body($response);
        echo $body;
    }

    wp_die();
}

// Shortcode for displaying train schedule form
function train_schedule_shortcode()
{
    ob_start(); ?>

    <div id="train-schedule-form-container">
        <form id="train-schedule-form">
            <label for="train-number">Enter Train Number:</label>
            <input type="text" id="train-number" name="train_number">
            <input type="submit" value="Get Schedule">
        </form>
    </div>

    <div id="train-schedule-result"></div>

    <?php
    return ob_get_clean();
}
add_shortcode('train_schedule', 'train_schedule_shortcode');



// Add Shortcode
function fetch_real_estate_data_shortcode() {
    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue custom script for AJAX call
    wp_enqueue_script('real-estate-ajax-script', get_template_directory_uri() . '/js/real-estate-ajax.js', array('jquery'), null, true );

    // Localize script with nonce for security
    wp_localize_script('real-estate-ajax-script', 'realEstateAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

    // Output the container where data will be displayed
    return '<div id="real-estate-data-container">Loading...</div>';
}
add_shortcode('fetch_real_estate_data', 'fetch_real_estate_data_shortcode');

// AJAX handler function
function fetch_real_estate_data() {
    $tokens = array(
        'b72ef1fa-ada7-45c1-a9f3-c7fb932d5aee',
        '9286f864-c4bd-4cf3-b9e8-41f50b3697df',
        'b1e0d592-909c-4605-a182-f48056745445',
        'de474650-a04f-4985-833b-fffa94fad8c8',
        'e7a602d0-1a8d-4068-a312-296dccc12172'
    );

    // Randomly select a token
    $token = $tokens[array_rand($tokens)];

    // API URL
    $url = 'https://api.realworks.nl/wonen/v1/objecten';

    // Make the request
    $response = wp_remote_get($url, array(
        'headers' => array(
            'Authorization' => 'rwauth ' . $token
        )
    ));

    if (is_wp_error($response)) {
        wp_send_json_error('Failed to fetch data');
    }

    $data = wp_remote_retrieve_body($response);
    wp_send_json_success($data);
}
add_action('wp_ajax_nopriv_fetch_real_estate_data', 'fetch_real_estate_data');
add_action('wp_ajax_fetch_real_estate_data', 'fetch_real_estate_data');
