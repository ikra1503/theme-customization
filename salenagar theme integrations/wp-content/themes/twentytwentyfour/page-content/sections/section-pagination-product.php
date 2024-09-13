<?php
$products_list = isset($args['posts']) ? $args['posts'] : '';
$perPageRecord = isset($args['perPageRecord']) ? $args['perPageRecord'] : '';
$currentPageNumber = isset($args['currentPageNumber']) ? $args['currentPageNumber'] : '';
$isTherePagination = isset($args['isTherePagination']) ? $args['isTherePagination'] : '';
$total_products = $products_list->found_posts;

if ($products_list->have_posts()):
    ?>
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
                    <?php
                    while ($products_list->have_posts()):
                        $products_list->the_post();
                        global $product;
                        $stock_status = $product->get_stock_status();
                        $out_of_stock_class = $stock_status == 'outofstock' ? 'product out-of-stock' : 'product';
                        ?>
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
                                                $default_variation_id = $product->get_default_attributes();
                                                if ($default_variation_id) {
                                                    $variation = new WC_Product_Variation($default_variation_id);
                                                    echo $variation->get_price_html();
                                                } else {
                                                    echo $product->get_price_html();
                                                }
                                                ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="price">
                                                <?php echo $product->get_price_html(); ?>
                                            </span>
                                        <?php endif; ?>
                                        <span class='saved'>
                                            <?php
                                            $regular_price = $product->get_regular_price();
                                            $sale_price = $product->get_sale_price();
                                            $regular_price_int = (int) $regular_price;
                                            $sale_price_int = (int) $sale_price;
                                            $saved_money = $regular_price_int - $sale_price_int;

                                            if ($regular_price_int >= 0 && $sale_price_int !== 0) {
                                                $percentage_saved = round(($saved_money * 100 / $regular_price), 0);
                                                if ($percentage_saved > 0 && $percentage_saved !== '') {
                                                    echo '<span class="saved badge">' . $percentage_saved . '% Off</span>';
                                                }
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

                                        // Iterate through cart items
                                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                            // Check if variation and product IDs match
                                            if ($cart_item['variation_id'] == $variation_id && $cart_item['product_id'] == $product_id) {
                                                $in_cart_quantity += $cart_item['quantity']; // Add quantity to total
                                            }
                                        }
                                    }
                                } else {
                                    $product_id = $product->get_id();
                                    // Iterate through cart items
                                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                        // Check if product ID matches
                                        if ($cart_item['product_id'] == $product_id) {
                                            $in_cart_quantity += $cart_item['quantity']; // Add quantity to total
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
                                <div class="btn-group" style="<?php echo $in_cart_quantity > 0 ? 'display:none' : ''; ?>">
                                    <a href="<?php echo wc_get_cart_url(); ?>" class="button add-to-cart"
                                        data-product-id="<?php echo $product->get_id(); ?>"
                                        data-variation-id="<?php echo esc_attr($variation_id); ?>">
                                        Add to Cart<i class="icon-cart"></i>
                                    </a>
                                </div>
                                <div class="qty-box" style="<?php echo $in_cart_quantity > 0 ? '' : 'display:none'; ?>"
                                    data-product-id="<?php echo $product->get_id(); ?>">
                                    <div class="quantity">
                                        <input type="button" value="-" class="qty-minus">
                                        <input type="number" name="quantity"
                                            value="<?php echo $in_cart_quantity !== 0 ? $in_cart_quantity : 1; ?>" title="Qty"
                                            class="qty" size="4" id="qnty" min="1" max="100">
                                        <input type="button" value="+" class="qty-plus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
else:
    echo 'No products found';
endif;

if ($products_list->have_posts() && $isTherePagination && ($total_products > $perPageRecord)):
    ?>
    <div class="products-list-pagination-div">
        <?php
        echo paginate_links(
            array(
                'base' => add_query_arg('paged', '%#%'),
                'format' => '',
                'current' => $currentPageNumber,
                'total' => $products_list->max_num_pages,
                'prev_text' => __('<'),
                'next_text' => __('>'),
                // 'type' => 'list'
            )
        );
        ?>
    </div>
<?php endif; ?>