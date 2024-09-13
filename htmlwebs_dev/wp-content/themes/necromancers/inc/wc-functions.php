<?php
/**
 * WooCommerce Functions
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.3.1
 * @version   1.3.1
 */


/**
 * Enqueue scripts and styles.
 */
require get_theme_file_path( '/inc/front/wc-enqueue.php' );


/**
 * General
 */

// removes styling
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// determines the Product Catalog Loop style
$catalog_rows_option = absint( get_option( 'woocommerce_catalog_rows', 2 ) );
$catalog_rows_get    = isset( $_GET['woocommerce_catalog_rows'] ) ? absint( $_GET['woocommerce_catalog_rows'] ) : false;

// for demo purposes
if ( $catalog_rows_get ) {
  $catalog_style = $catalog_rows_get == 1 ? 'style-2' : 'style-1';
} else {
  $catalog_style = $catalog_rows_option == 1 ? 'style-2' : 'style-1';
}


/**
 * Catalog
 */

// Sorting Control. Removes the product sorting options.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'necromancers_products_filter', 'woocommerce_catalog_ordering', 10 );

// Page Title. Removes Page Title on the Shop and Shop Category
add_filter( 'woocommerce_show_page_title', 'necromancers_hide_shop_page_title' );
if ( ! function_exists( 'necromancers_hide_shop_page_title' ) ) {
  function necromancers_hide_shop_page_title( $title ) {
    if ( is_shop() || is_product_category() ) {
      $title = false;
    }
    return $title;
  }
}

// Product Count
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );

// Shop Notices. Remove notices wrapper from the Shop page.
add_action( 'init', 'necromancers_remove_before_shop_loop_notices', 99 );
if ( ! function_exists( 'necromancers_remove_before_shop_loop_notices' ) ) {
  function necromancers_remove_before_shop_loop_notices() {
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
  }
}


// Product

// remove default link
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// remove default thumbnail
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// add thumbnail with additional markup and link - open
add_action( 'woocommerce_before_shop_loop_item_title', 'necromancers_template_loop_product_thumbnail_open', 10 );
if ( ! function_exists( 'necromancers_template_loop_product_thumbnail_open' ) ) {
  function necromancers_template_loop_product_thumbnail_open() {

    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '<div class="product__thumbnail"><div class="product__thumbnail-inner">' . woocommerce_get_product_thumbnail() . '</div>';
  }
}

if ( $catalog_style === 'style-2' ) {
  // add Buttons wrapper open
  add_action( 'woocommerce_before_shop_loop_item_title', 'necromancers_template_loop_buttons_open', 11 );
  if ( ! function_exists( 'necromancers_template_loop_buttons_open' ) ) {
    function necromancers_template_loop_buttons_open() {
      echo '<div class="product__btns">';
    }
  }

  // add Add to Cart button
  add_action( 'woocommerce_before_shop_loop_item_title', 'necromancers_template_loop_add_to_cart', 12 );
  if ( ! function_exists( 'necromancers_template_loop_add_to_cart' ) ) {
    /**
     * Get the add to cart template for the loop.
     *
     * @param array $args Arguments.
     */
    function necromancers_template_loop_add_to_cart( $args = array() ) {
      global $product;

      if ( $product ) {
        $defaults = array(
          'quantity'   => 1,
          'class'      => implode(
            ' ',
            array_filter(
              array(
                'btn',
                'btn-tertiary',
                'product_type_' . $product->get_type(),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
              )
            )
          ),
          'attributes' => array(
            'data-product_id'  => $product->get_id(),
            'data-product_sku' => $product->get_sku(),
            'aria-label'       => $product->add_to_cart_description(),
            'rel'              => 'nofollow',
          ),
        );

        $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

        if ( isset( $args['attributes']['aria-label'] ) ) {
          $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
        }

        wc_get_template( 'loop/add-to-cart.php', $args );
      }
    }
  }

  // add Buttons wrapper open
  add_action( 'woocommerce_before_shop_loop_item_title', 'necromancers_template_loop_buttons_close', 13 );
  if ( ! function_exists( 'necromancers_template_loop_buttons_close' ) ) {
    function necromancers_template_loop_buttons_close() {
      echo '</div>';
    }
  }
}

// add thumbnail with additional markup and link - close
add_action( 'woocommerce_before_shop_loop_item_title', 'necromancers_template_loop_product_thumbnail_close', 14 );
if ( ! function_exists( 'necromancers_template_loop_product_thumbnail_close' ) ) {
  function necromancers_template_loop_product_thumbnail_close() {
    global $product;

    $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '<a class="stretched-link" href="' . esc_url( $link ) . '"></a></div>';
  }
}

// product body wrapper open
add_action( 'woocommerce_before_shop_loop_item_title', 'necromancers_template_loop_product_body_open', 15 );
if ( ! function_exists( 'necromancers_template_loop_product_body_open' ) ) {
  function necromancers_template_loop_product_body_open() {
    echo '<div class="product__body">';
  }
}

// product header open
add_action( 'woocommerce_before_shop_loop_item_title', 'necromancers_template_loop_product_header_open', 15 );
if ( ! function_exists( 'necromancers_template_loop_product_header_open' ) ) {
  function necromancers_template_loop_product_header_open() {
    echo '<div class="product__header">';
  }
}

// remove default product title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// add category
add_action( 'woocommerce_before_shop_loop_item_title', 'necromancers_output_product_category', 25);
if ( ! function_exists( 'necromancers_output_product_category' ) ) {
  function necromancers_output_product_category() {
    global $product;
  
    $product_cats = wp_get_post_terms( $product->get_id(), 'product_cat' );
  
    echo '<ul class="product__cats list-unstyled">';
      foreach ( $product_cats as $key => $cat ) {
        echo '<li class="product__cats-item"><a href="' . get_category_link( $cat->term_id) . '">' . $cat->name . '</a></li>';
      }
    echo '</ul>';
  }
}

// product title with custom classes and linked
add_action( 'woocommerce_shop_loop_item_title', 'necromancers_template_loop_product_title', 15 );
if ( ! function_exists( 'necromancers_template_loop_product_title' ) ) {
  function necromancers_template_loop_product_title() {
    global $product;

    $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

    echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'product__title h4' ) ) . '"><a href="' . esc_url( $link ) . '">' . get_the_title() . '</a></h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  }
}

// product header close
add_action( 'woocommerce_after_shop_loop_item_title', 'necromancers_template_loop_product_header_close', 50 );
if ( ! function_exists( 'necromancers_template_loop_product_header_close' ) ) {
  function necromancers_template_loop_product_header_close() {
    echo '</div>';
  }
}

// product body wrapper close
add_action( 'woocommerce_after_shop_loop_item', 'necromancers_template_loop_product_body_close', 50 );
if ( ! function_exists( 'necromancers_template_loop_product_body_close' ) ) {
  function necromancers_template_loop_product_body_close() {
    echo '</div>';
  }
}

// remove default Price
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

// add Product Meta open
add_action( 'woocommerce_after_shop_loop_item_title', 'necromancers_template_loop_meta_open', 5 );
if ( ! function_exists( 'necromancers_template_loop_meta_open' ) ) {
  function necromancers_template_loop_meta_open() {
    echo '<ul class="product__meta list-unstyled">';
  }
}

// add Product Price
add_action( 'woocommerce_after_shop_loop_item_title', 'necromancers_template_loop_price', 10 );
if ( ! function_exists( 'necromancers_template_loop_price' ) ) {
  /**
   * Get the product price for the loop.
   */
  function necromancers_template_loop_price() {
    wc_get_template( 'loop/price.php' );
  }
}

// remove default Rating
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// add Product Rating
add_action( 'woocommerce_after_shop_loop_item_title', 'necromancers_template_loop_rating', 15 );
if ( ! function_exists( 'necromancers_template_loop_rating' ) ) {
  /**
   * Display the average rating in the loop.
   */
  function necromancers_template_loop_rating() {
    wc_get_template( 'loop/rating.php' );
  }
}

// add Product Meta close
add_action( 'woocommerce_after_shop_loop_item_title', 'necromancers_template_loop_meta_close', 45 );
if ( ! function_exists( 'necromancers_template_loop_meta_close' ) ) {
  function necromancers_template_loop_meta_close() {
    echo '</ul>';
  }
}

// add Product Short Description
add_action( 'woocommerce_after_shop_loop_item_title', 'necromancers_short_description', 55 );
if ( ! function_exists( 'necromancers_short_description' ) ) {
  function necromancers_short_description() {
    $char_count      = 104;
    $excerpt         = get_the_excerpt();
    $excerpt_trimmed = substr( get_the_excerpt(), 0, $char_count );

    echo '<div class="product__excerpt">';
      echo strlen( $excerpt ) > $char_count ? $excerpt_trimmed . '...' : $excerpt_trimmed;
    echo '</div>';
  }
}

// remove add to cart
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

if ( $catalog_style === 'style-1' ) {
  // add Buttons wrapper open
  add_action( 'woocommerce_after_shop_loop_item', 'necromancers_template_loop_buttons_open', 10 );
  if ( ! function_exists( 'necromancers_template_loop_buttons_open' ) ) {
    function necromancers_template_loop_buttons_open() {
      echo '<div class="product__btns">';
    }
  }

  // add Add to Cart button
  add_action( 'woocommerce_after_shop_loop_item', 'necromancers_template_loop_add_to_cart', 15 );
  if ( ! function_exists( 'necromancers_template_loop_add_to_cart' ) ) {
    /**
     * Get the add to cart template for the loop.
     *
     * @param array $args Arguments.
     */
    function necromancers_template_loop_add_to_cart( $args = array() ) {
      global $product;

      if ( $product ) {
        $defaults = array(
          'quantity'   => 1,
          'class'      => implode(
            ' ',
            array_filter(
              array(
                'btn',
                'btn-secondary',
                'product_type_' . $product->get_type(),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
              )
            )
          ),
          'attributes' => array(
            'data-product_id'  => $product->get_id(),
            'data-product_sku' => $product->get_sku(),
            'aria-label'       => $product->add_to_cart_description(),
            'rel'              => 'nofollow',
          ),
        );

        $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

        if ( isset( $args['attributes']['aria-label'] ) ) {
          $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
        }

        wc_get_template( 'loop/add-to-cart.php', $args );
      }
    }
  }

  // add Buttons wrapper open
  add_action( 'woocommerce_after_shop_loop_item', 'necromancers_template_loop_buttons_close', 20 );
  if ( ! function_exists( 'necromancers_template_loop_buttons_close' ) ) {
    function necromancers_template_loop_buttons_close() {
      echo '</div>';
    }
  }
}


// removes Pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );


/**
 * Load More Ajax handler for Products Filter
 */

add_action('wp_ajax_productsloadmorebutton', 'necromancers_products_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_productsloadmorebutton', 'necromancers_products_loadmore_ajax_handler');

if ( ! function_exists( 'necromancers_products_loadmore_ajax_handler' ) ) {
  function necromancers_products_loadmore_ajax_handler(){

    // prepare our arguments for the query
    $params = json_decode( stripslashes( $_POST['query'] ), true ); // query_posts() takes care of the necessary sanitization 
    $params['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $params['post_status'] = 'publish';
  
    // it is always better to use WP_Query but not here
    query_posts( $params );
  
    if ( have_posts() ) :
  
      // run the loop
      while ( have_posts() ) :
        
        the_post();
  
        wc_get_template( 'content-product.php' );
  
      endwhile;
    endif;
    die; // here we exit the script and even no wp_reset_query() required!
  }
}



/**
 * Products Filter and Load More button
 */

add_action('wp_ajax_necromancers_products_filter', 'necromancers_products_filter_function');
add_action('wp_ajax_nopriv_necromancers_products_filter', 'necromancers_products_filter_function');

if ( ! function_exists( 'necromancers_products_filter_function' ) ) {
  function necromancers_products_filter_function(){

    // specify the Catalog Layout
    if ( isset( $_POST['necromancersProductsView'] ) && ! empty( $_POST['necromancersProductsView'] ) ) {
      $catalog_per_page = $_POST['necromancersProductsView'];
    } else {
      $catalog_cols        = absint( get_option( 'woocommerce_catalog_columns', 3 ) );
      $catalog_rows_option = absint( get_option( 'woocommerce_catalog_rows', 2 ) );
      $catalog_rows_mod    = absint( get_theme_mod( 'woocommerce_catalog_rows', 0 ) );

      // for demo purposes
      if ( $catalog_rows_mod ) {
        $catalog_per_page = $catalog_cols * $catalog_rows_mod;
      } else {
        $catalog_per_page = $catalog_cols * $catalog_rows_option;
      }
    }

    // parameters
    $params = [
      'post_type'      => 'product',
      'posts_per_page' => $catalog_per_page,
      'orderby'        => $_POST['necromancersProductsSortBy'] // example: date
    ];
  
    // for taxonomies / categories
    if ( isset( $_POST['productCategoryFilter'] ) && ! empty( $_POST['productCategoryFilter'] ) ) {
      $params['tax_query'] = [
        [
          'taxonomy' => 'product_cat',
          'field'    => 'id',
          'terms'    => $_POST['productCategoryFilter']
        ]
      ];
    }
  
    query_posts( $params );

    // absolutely need it, because we will get $wp_query->query_vars and $wp_query->max_num_pages from it.
    global $wp_query;
  
    if ( have_posts() ) :
  
      ob_start(); // start buffering because we do not need to print the posts now
  
      while ( have_posts() ) :
        
        the_post();
  
        wc_get_template( 'content-product.php' );
  
      endwhile;
      
      $products_html = ob_get_contents(); // we pass the posts to variable
      
      ob_end_clean(); // clear the buffer
  
    else:

      $products_html = '<div class="alert alert-warning">' . esc_html__( 'Nothing found for your criteria.', 'necromancers' ) . '</div>';

    endif;
  
    // no wp_reset_query() required
  
    echo json_encode( array(
      'products'    => json_encode( $wp_query->query_vars ),
      'max_page'    => $wp_query->max_num_pages,
      'found_posts' => $wp_query->found_posts,
      'content'     => $products_html
    ) );
  
    die();
  }
}




/**
 * Single Product
 */

// Product: notices. Remove notices wrapper from the Shop page.
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
add_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 20 );

// Product: add extra wrapper before the product
add_action( 'woocommerce_before_single_product', 'necromancers_single_product_before', 10 );
if ( ! function_exists( 'necromancers_single_product_before' ) ) {
  function necromancers_single_product_before() {
    echo '<div class="site-content__inner"><div class="site-content__holder">';
  }
}

// Product: add extra wrapper after the product
add_action( 'woocommerce_after_single_product', 'necromancers_single_product_after', 10 );
if ( ! function_exists( 'necromancers_single_product_after' ) ) {
  function necromancers_single_product_after() {
    echo '</div></div>';
  }
}

// Product: add custom class to single product
add_filter( 'woocommerce_post_class', 'necromancers_filter_woocommerce_post_class', 10, 2 );
if ( ! function_exists( 'necromancers_filter_woocommerce_post_class' ) ) {
  function necromancers_filter_woocommerce_post_class( $classes, $product ) {
    global $woocommerce_loop;
    
    // is_product() - Returns true on a single product page
    // NOT single product page, so return
    if ( ! is_product() ) {
      return $classes;
    }
    
    // The related products section, so return
    if ( $woocommerce_loop['name'] == 'related' ) {
      return $classes;
    }
    
    // Add new class
    $classes[] = 'product--single';
    
    return $classes;
  }
}

// Product: add custom class to Single Product Image Gallery
add_filter( 'woocommerce_single_product_image_gallery_classes', 'necromancers_single_product_gallery_custom_classes' );
if ( ! function_exists( 'necromancers_single_product_gallery_custom_classes' ) ) {
  function necromancers_single_product_gallery_custom_classes( $classes ) {
    $classes[] = 'product__thumbnail';

    return $classes;
  }
}


// Product: Flexslider is not need since we're using Slick Carousel
add_filter( 'woocommerce_single_product_photoswipe_enabled', '__return_false' );
add_filter( 'woocommerce_single_product_flexslider_enabled', '__return_false' );

// Product: Remove related products output
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Product: Remove product image links
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'necromancers_remove_product_image_link', 10, 2 );
if ( ! function_exists( 'necromancers_remove_product_image_link' ) ) {
  function necromancers_remove_product_image_link( $html, $post_id ) {
    return preg_replace( "!<(a|/a).*?>!", '', $html );
  }
}

// Product: Change the size on the Single Product page
add_filter( 'woocommerce_gallery_thumbnail_size', 'necromancers_single_product_gallery_thumbnail_size' );
if ( ! function_exists( 'necromancers_single_product_gallery_thumbnail_size' ) ) {
  function necromancers_single_product_gallery_thumbnail_size() {
    return 'full';
  }
}

// Product: Add category before the product title
add_action( 'woocommerce_single_product_summary', 'necromancers_output_product_category', 4 );

// Product: Add product sharing
add_action( 'woocommerce_single_product_summary', 'necromancers_output_single_product_sharing', 1 );
if ( ! function_exists( 'necromancers_output_single_product_sharing' ) ) {
  function necromancers_output_single_product_sharing() {
    ?>
    <ul class="post__sharing post__sharing--default">
      <li class="post__sharing-item post__sharing-item--menu"><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><i>&nbsp;</i></a></li>
      <?php
      if ( function_exists( 'ncr_assistant_social_share' ) ) {
        ncr_assistant_social_share();
      }
      ?>
    </ul>
    <?php
  }
}

// Product: Add wrapper for the product header - open
add_action( 'woocommerce_single_product_summary', 'necromancers_output_single_product_header_start', 2 );
if ( ! function_exists( 'necromancers_output_single_product_header_start' ) ) {
  function necromancers_output_single_product_header_start() {
    echo '<div class="product__header">';
  }
}

// Product: Add wrapper for the product header - close
add_action( 'woocommerce_single_product_summary', 'necromancers_output_single_product_header_end', 20 );
if ( ! function_exists( 'necromancers_output_single_product_header_end' ) ) {
  function necromancers_output_single_product_header_end() {
    echo '</div>';
  }
}

// Product: Add wrapper for the product meta - open
add_action( 'woocommerce_single_product_summary', 'necromancers_output_single_product_meta_start', 9 );
if ( ! function_exists( 'necromancers_output_single_product_meta_start' ) ) {
  function necromancers_output_single_product_meta_start() {
    echo '<ul class="product__meta list-unstyled">';
  }
}

// Product: Add wrapper for the product meta - close
add_action( 'woocommerce_single_product_summary', 'necromancers_output_single_product_meta_end', 19 );
if ( ! function_exists( 'necromancers_output_single_product_meta_end' ) ) {
  function necromancers_output_single_product_meta_end() {
    echo '</ul>';
  }
}

// Product: move the rating after the price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );

// Product: move the excerpt
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 21 );

// Product: variations
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'filter_dropdown_variation_args', 10 );
if ( ! function_exists( 'filter_dropdown_variation_args' ) ) {
  function filter_dropdown_variation_args( $args ) {
    $args['class'] = 'ncr-select-control';

    return $args;
  }
}



/**
 * My Account
 */

// move the the privacy policy after the button in register form
remove_action( 'woocommerce_register_form', 'wc_registration_privacy_policy_text', 20 );
add_action( 'woocommerce_register_form_end', 'wc_registration_privacy_policy_text', 10 );


add_action( 'woocommerce_account_content', 'necromancers_account_title', 1 );
if ( ! function_exists( 'necromancers_account_title' ) ) {
  function necromancers_account_title() {
    echo '<h2 class="ncr-account-title">' . wc_page_endpoint_title( get_the_title() ) . '</h2>';
  }
}


if ( ! function_exists( 'woocommerce_form_field' ) ) {

  /**
   * Outputs a checkout/address form field.
   *
   * @param string $key Key.
   * @param mixed  $args Arguments.
   * @param string $value (default: null).
   * @return string
   */
  function woocommerce_form_field( $key, $args, $value = null ) {
    $defaults = array(
      'type'              => 'text',
      'label'             => '',
      'description'       => '',
      'placeholder'       => '',
      'maxlength'         => false,
      'required'          => false,
      'autocomplete'      => false,
      'id'                => $key,
      'class'             => array(),
      'label_class'       => array(),
      'input_class'       => array( 'form-control' ),
      'return'            => false,
      'options'           => array(),
      'custom_attributes' => array(),
      'validate'          => array(),
      'default'           => '',
      'autofocus'         => '',
      'priority'          => '',
    );

    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

    if ( $args['required'] ) {
      $args['class'][] = 'validate-required';
      $required        = esc_attr__( '*', 'necromancers' );
    } else {
      $required = '(' . esc_html__( 'optional', 'necromancers' ) . ')';
    }

    if ( is_string( $args['label_class'] ) ) {
      $args['label_class'] = array( $args['label_class'] );
    }

    if ( is_null( $value ) ) {
      $value = $args['default'];
    }

    // Custom attribute handling.
    $custom_attributes         = array();
    $args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );

    if ( $args['maxlength'] ) {
      $args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
    }

    if ( ! empty( $args['autocomplete'] ) ) {
      $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
    }

    if ( true === $args['autofocus'] ) {
      $args['custom_attributes']['autofocus'] = 'autofocus';
    }

    if ( $args['description'] ) {
      $args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
    }

    if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
      foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
        $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
      }
    }

    if ( ! empty( $args['validate'] ) ) {
      foreach ( $args['validate'] as $validate ) {
        $args['class'][] = 'validate-' . $validate;
      }
    }

    $field           = '';
    $label_id        = $args['id'];
    $sort            = $args['priority'] ? $args['priority'] : '';
    $field_container = '<div class="form-group %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</div>';

    switch ( $args['type'] ) {
      case 'country':
        $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

        if ( 1 === count( $countries ) ) {

          $field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

          $field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" readonly="readonly" />';

        } else {
          $data_label = ! empty( $args['label'] ) ? 'data-label="' . esc_attr( $args['label'] ) . '"' : '';

          $field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_attr__( 'Country / Region', 'necromancers' ) ) . $required . '" ' . $data_label . '><option value="">' . esc_html__( 'Country / Region', 'necromancers' ) . $required . '</option>';

          foreach ( $countries as $ckey => $cvalue ) {
            $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
          }

          $field .= '</select>';

          $field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country / region', 'necromancers' ) . '">' . esc_html__( 'Update country / region', 'necromancers' ) . '</button></noscript>';

        }

        break;
      case 'state':
        /* Get country this state field is representing */
        $for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
        $states      = WC()->countries->get_states( $for_country );

        if ( is_array( $states ) && empty( $states ) ) {

          $field_container = '<div class="form-group %1$s" id="%2$s" style="display: none">%3$s</div>';

          $field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" readonly="readonly" data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '"/>';

        } elseif ( ! is_null( $for_country ) && is_array( $states ) ) {
          $data_label = ! empty( $args['label'] ) ? 'data-label="' . esc_attr( $args['label'] ) . '"' : '';

          $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_html__( 'Select an option&hellip;', 'necromancers' ) ) . '"  data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . $data_label . '>
            <option value="">' . esc_html__( 'Select an option&hellip;', 'necromancers' ) . '</option>';

          foreach ( $states as $ckey => $cvalue ) {
            $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
          }

          $field .= '</select>';

        } else {

          $field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '"/>';

        }

        break;
      case 'textarea':
        $field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="4"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

        break;
      case 'checkbox':
        $field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
            <input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> ' . $args['label'] . $required . '</label>';

        break;
      case 'text':
      case 'password':
      case 'datetime':
      case 'datetime-local':
      case 'date':
      case 'month':
      case 'time':
      case 'week':
      case 'number':
      case 'email':
      case 'url':
      case 'tel':
        $field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['label'] ) . ' ' . $required . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

        break;
      case 'hidden':
        $field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-hidden ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

        break;
      case 'select':
        $field   = '';
        $options = '';

        if ( ! empty( $args['options'] ) ) {
          foreach ( $args['options'] as $option_key => $option_text ) {
            if ( '' === $option_key ) {
              // If we have a blank option, select2 needs a placeholder.
              if ( empty( $args['placeholder'] ) ) {
                $args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'necromancers' );
              }
              $custom_attributes[] = 'data-allow_clear="true"';
            }
            $options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_html( $option_text ) . '</option>';
          }

          $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
              ' . $options . '
            </select>';
        }

        break;
      case 'radio':
        $label_id .= '_' . current( array_keys( $args['options'] ) );

        if ( ! empty( $args['options'] ) ) {
          foreach ( $args['options'] as $option_key => $option_text ) {
            $field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
            $field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . esc_html( $option_text ) . '</label>';
          }
        }

        break;
    }

    if ( ! empty( $field ) ) {
      $field_html = '';

      $field_html .= '<span class="woocommerce-input-wrapper">' . $field;

      if ( $args['description'] ) {
        $field_html .= '<span class="description" id="' . esc_attr( $args['id'] ) . '-description" aria-hidden="true">' . wp_kses_post( $args['description'] ) . '</span>';
      }

      $field_html .= '</span>';

      $container_class = esc_attr( implode( ' ', $args['class'] ) );
      $container_id    = esc_attr( $args['id'] ) . '_field';
      $field           = sprintf( $field_container, $container_class, $container_id, $field_html );
    }

    /**
     * Filter by type.
     */
    $field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

    /**
     * General filter on form fields.
     *
     * @since 3.4.0
     */
    $field = apply_filters( 'woocommerce_form_field', $field, $key, $args, $value );

    if ( $args['return'] ) {
      return $field;
    } else {
      // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      echo $field;
    }
  }
}



/**
 * Checkout
 */

add_action( 'woocommerce_before_checkout_form', 'necromancers_before_checkout_form_wrap_open', 9 );
if ( ! function_exists( 'necromancers_before_checkout_form_wrap_open' ) ) {
  function necromancers_before_checkout_form_wrap_open() {
    echo '<div class="row mb-4"><div class="col-lg-8"><div class="row">';
  }
}

add_action( 'woocommerce_before_checkout_form', 'necromancers_before_checkout_form_wrap_close', 20 );
if ( ! function_exists( 'necromancers_before_checkout_form_wrap_close' ) ) {
  function necromancers_before_checkout_form_wrap_close() {
    echo '</div></div></div>';
  }
}


/**
 * Header Cart
 */

// Ajaxify Cart in the Header
add_filter( 'woocommerce_add_to_cart_fragments', 'necromancers_header_add_to_cart_fragment' );
if ( ! function_exists( 'necromancers_header_add_to_cart_fragment' ) ) {
  function necromancers_header_add_to_cart_fragment( $fragments ) {

    ob_start();

    $product_count = sprintf('%d', WC()->cart->cart_contents_count, WC()->cart->cart_contents_count );
    ?>

    <span class="header-cart-toggle__items-count"><?php echo esc_html( $product_count ); ?></span>

    <?php
    $fragments['.header-cart-toggle__items-count'] = ob_get_clean();

    return $fragments;
  }
}

// Ajaxify Cart in the Panel
add_filter( 'woocommerce_add_to_cart_fragments', 'necromancers_header_add_to_cart_panel_fragment' );
if ( ! function_exists( 'necromancers_header_add_to_cart_panel_fragment' ) ) {
  function necromancers_header_add_to_cart_panel_fragment( $fragments ) {

    ob_start();

    $product_count = sprintf('%d', WC()->cart->cart_contents_count, WC()->cart->cart_contents_count );
    ?>

    <span class="cart-panel__items-count"><?php echo esc_html( $product_count ); ?></span>

    <?php
    $fragments['.cart-panel__items-count'] = ob_get_clean();

    return $fragments;
  }
}


if ( ! function_exists( 'woocommerce_widget_shopping_cart_button_view_cart' ) ) {
  /**
   * Output the view cart button.
   */
  function woocommerce_widget_shopping_cart_button_view_cart() {
    echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="btn btn-secondary wc-forward">' . esc_html__( 'View cart', 'necromancers' ) . '</a>';
  }
}

if ( ! function_exists( 'woocommerce_widget_shopping_cart_proceed_to_checkout' ) ) {

  /**
   * Output the proceed to checkout button.
   */
  function woocommerce_widget_shopping_cart_proceed_to_checkout() {
    echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="btn btn-primary checkout wc-forward">' . esc_html__( 'Checkout', 'necromancers' ) . '</a>';
  }
}
