<div
            class="swiper products-swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
            <div class="swiper-wrapper" style="cursor: grab; transform: translate3d(0px, 0px, 0px);">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                );

                $products = new WP_Query($args);

                if ($products->have_posts()):
                    while ($products->have_posts()):
                        $products->the_post();
                        global $product;
                        ?>
                        <div class="swiper-slide swiper-slide-active" style="width: 277.5px; margin-right: 20px;">

                            <div class="product" style="height: auto;">
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
                                                // Get the variation ID based on selected attributes
                                                $variation_id = $product->get_id();
                                                $variation_data_store = WC_Data_Store::load('product-variable');
                                                $variation_id = $variation_data_store->find_matching_product_variation(
                                                    $product,
                                                    array(
                                                        'attribute_pa_color' => 'pa_color',
                                                        'attribute_pa_size' => 'pa-size'
                                                    )
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

                                <div class="form-group no-swiping">
                                    <?php
                                    if ($product->is_type('variable')) {
                                        $attributes = $product->get_attributes();

                                        if ($attributes) {
                                            foreach ($attributes as $attribute) {

                                                $attribute_name = $attribute->get_name();
                                                $attribute_options = $attribute->get_options();
                                                echo '<div class="form-group no-swiping">';
                                                echo '<label for="' . esc_attr($attribute_name) . '">' . esc_html($attribute_name) . '</label>';
                                                echo '<select name="attribute_' . esc_attr($attribute_name) . '_' . $product->get_id() . '" id="' . esc_attr($attribute_name) . '_' . $product->get_id() . '" class="form-control">';
                                                echo '<option value="">' . esc_html__('Select ' . $attribute_name, 'twentytwentyfour') . '</option>';
                                                $attribute_terms = wc_get_product_terms($product->get_id(), $attribute_name, array('fields' => 'all'));
                                                foreach ($attribute_terms as $term) {
                                                    echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                                                }
                                                echo '</select>';
                                                echo '</div>';
                                            }
                                        }
                                    }
                                    ?>
                                </div>


                                <div class="btn-group">
                                    <a href="<?php echo wc_get_cart_url(); ?>" class="button add-to-cart"
                                        data-product-id="<?php echo $product->get_id(); ?>"
                                        data-variation-id="<?php echo esc_attr($variation_id); ?>">
                                        Add to Cart<i class="icon-cart"></i>
                                    </a>
                                </div>

                            </div>

                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

        </div>