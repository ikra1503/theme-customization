function addLoader() {
    jQuery('body').addClass('overlay');
    jQuery('body').append('<div class="spinner"></div>');
}

function removeLoader() {
    jQuery('body').removeClass('overlay');
    jQuery('div.spinner').remove();
}
$(document).ready(function () {
    update_mini_cart();
    $('.categories').click(function () {
        $('.all-categories').toggle();
    });
    var originalTitle = document.title;
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === 'visible') {
            document.title = originalTitle;
        } else {
            document.title = originalTitle + " =>Comeback Soon :(";
        }
    });

    var currentPage = 1;

    function filterAndSortProducts(pagedValue) {

        var selectedFilters = [];
        var selectedSize = [];
        var selectedColors = [];

        var selectedSorting = $('#sorting-select').val();
        var selectedSortingOrder = $('#sorting-select option:selected').data('order');
        var pagedValue = pagedValue;
        $('.filter-checkbox:checked').each(function () {
            selectedFilters.push({
                taxonomy: $(this).data('taxonomy'),
                term: $(this).data('term'),
            });

        });

        $('.size-checkbox:checked').each(function () {
            selectedSize.push({
                taxonomy: $(this).data('taxonomy'),
                term: $(this).data('term'),
            });

        });

        $('.color-checkbox:checked').each(function () {
            selectedColors.push({
                taxonomy: $(this).data('taxonomy'),
                term: $(this).data('term'),
            });

        });
        var data = {
            action: 'filter_products',
            selectedFilters: selectedFilters,
            selectedColors: selectedColors,
            selectedSize: selectedSize,
            selectedSorting: selectedSorting,
            order: selectedSortingOrder,
            page: currentPage,
            paged: pagedValue,
        };

        $.ajax({
            type: 'POST',
            url: PHP_ENV.WP_AJAX,
            data: data,
            success: function (result) {
                response = JSON.parse(result);
                $('.wp-block-post-template ').html(response.display);
                $('#products-list-pagination-div').remove();
                $('#products-list-pagination-div').html($('.products-list-pagination-div').html());

            },
        });

        currentPage = 1;
    }

    $('.filter-checkbox, .size-checkbox, .color-checkbox').on('change', function () {
        filterAndSortProducts(1);
    });


    $('#sorting-select').on('change', function () {
        filterAndSortProducts(1);
    });

    //pagination for SHOP page
    $(document).on('click', '.products-list-pagination-div a', function (e) {
        e.preventDefault();


        var currentURL = $(this).attr('href');
        var match = currentURL.match(/[?&]paged=([^&]+)/);
        var pagedValue = match ? match[1] : 1;
        filterAndSortProducts(pagedValue);
        return false;
    });

    $('.wc-block-catalog-sorting').hide();






    //add to cart function
    // jQuery(document).ready(function ($) {
    //     $('.add-to-cart').on('click', function (e) {
    //         var $container = $(this).closest('.product');
    //         var productId = $(this).data('product-id');
    //         var variationIdColor = $container.find('#pa_color_' + productId).val().toLowerCase();
    //         var variationIdSize = $container.find('#pa_size_' + productId).val().toLowerCase();

    //         $.ajax({
    //             type: 'POST',
    //             url: PHP_ENV.WP_AJAX,
    //             data: {
    //                 action: 'get_variation_ajax',
    //                 product_id: productId,
    //                 variation_Id_color: variationIdColor,
    //                 variation_Id_size: variationIdSize,
    //             },
    //             success: function (response) {
    //                 variationid = response;
    //                 function add_to_cart_ajax_func(variationid, product_id);
    //                 addLoader();
    //             },
    //             error: function (xhr, status, error) {
    //                 console.error(xhr.responseText);
    //                 removeLoader();
    //             }
    //         });
    //     });
    //     function add_to_cart_ajax_func(variationid, productId) {
    //         addLoader();
    //         $.ajax({
    //             type: 'POST',
    //             url: PHP_ENV.WP_AJAX,
    //             data: {
    //                 action: 'add_to_cart_ajax',
    //                 product_id: productId
    //             },
    //             success: function (response) {
    //                 removeLoader();
    //                 // Handle success response
    //             },
    //             error: function (xhr, status, error) {
    //                 // Handle error
    //                 console.error(xhr.responseText);
    //                 removeLoader();
    //             }
    //         });

    //     }
    // });






    //increment and decrement by one 


    $(document).on('click', '.quantity .qty-plus', function () {

        var $container = $(this).closest('.quantity');
        var input = $container.find('.qty');
        input.val(parseInt(input.val()) + 1);
    });

    $(document).on('click', '.quantity .qty-minus', function () {
        var productId = $(this).data('product-id');
        var $container = $(this).closest('.quantity');
        var input = $container.find('.qty');
        if (parseInt(input.val()) > 0) {
            input.val(parseInt(input.val()) - 1);
            checkQuantity(productId);
        }
    });


    // jQuery(document).ready(function () {
    //     var typingTimer;
    //     var doneTypingInterval = 500; // milliseconds

    //     $('.product').on('input', '#qnty', function (event) {
    //         event.stopPropagation();

    //         var $container = $(this).closest('.product');

    //         clearTimeout(typingTimer);
    //         typingTimer = setTimeout(function () {
    //             doneTyping($container);
    //         }, doneTypingInterval);
    //     });

    //     function doneTyping($container) {
    //         var quantity = $container.find('.qty').val();
    //         if (!isNaN(quantity)) {
    //             quantity = parseInt($container.find('.qty').val());
    //             console.log('befre add to cart ' + quantity);

    //             addLoader();
    //         }
    //     }

    //     $('.add-to-cart').on('click', function (e, quantity) {
    //         e.preventDefault();


    //         addLoader();

    //         var $container = $(this).closest('.product');

    //         var productId = $(this).data('product-id');
    //         var variationIdColor = $container.find('#pa_color_' + productId).val();
    //         var variationIdSize = $container.find('#pa_size_' + productId).val();

    //         if (variationIdColor) {
    //             variationIdColor = variationIdColor.toLowerCase();
    //         }

    //         if (variationIdSize) {
    //             variationIdSize = variationIdSize.toLowerCase();
    //         }
    //         $.ajax({
    //             type: 'POST',
    //             url: PHP_ENV.WP_AJAX,
    //             data: {
    //                 action: 'get_variation_ajax',
    //                 product_id: productId,
    //                 variation_Id_color: variationIdColor,
    //                 variation_Id_size: variationIdSize,

    //             },
    //             success: function (response) {
    //                 variationid = response;
    //                 add_to_cart_ajax_func(variationid, productId, quantity);
    //                 console.log('on success' + quantity);
    //                 console.log(variationid);
    //             },
    //             error: function (xhr, status, error) {
    //                 console.error(xhr.responseText);
    //                 removeLoader();
    //                 alert('failed');
    //             }
    //         });
    //     });


    //     function add_to_cart_ajax_func(variationid, productId, quantity) {
    //         console.log(quantity);
    //         addLoader();
    //         $.ajax({
    //             type: 'POST',
    //             url: PHP_ENV.WP_AJAX,
    //             data: {
    //                 action: 'add_to_cart_ajax',
    //                 product_id: productId,
    //                 variation_Id: variationid,
    //                 quantity: quantity
    //             },
    //             success: function (response) {
    //                 removeLoader();
    //                 // alert("product has been added successfully");

    //             },
    //             error: function (xhr, status, error) {
    //                 // Handle error
    //                 console.error(xhr.responseText);
    //                 removeLoader();
    //                 alert('failed to add');
    //             }
    //         });
    //     }
    // });








    // Function to update mini cart
    function update_mini_cart() {

        var data = {
            action: 'update_mini_cart',
        };
        $.ajax({
            url: PHP_ENV.WP_AJAX,
            method: 'POST',
            data: data,
            success: function (response) {
                $('.mini-cart').html(response.html);
                $('#show-mini-cart').html('Show Mini Cart (' + response.unique_product_id_count_in_cart + ')');
            },
            error: function (xhr, status, error) {
                console.error('Error updating mini cart:', error);
            }
        });
    }






    // another working jquery

    function showPopupNotification(message) {
        var popup = $('<div class="popupNotification">' + message + '</div>');
        $('body').append(popup);
        popup.fadeIn(300);
        setTimeout(function () {
            popup.fadeOut(300, function () {
                $(this).remove();
            });
        }, 3000);
    }
    function showSuccess(message) {
        var popup = $('<div class="popupNotificationsuccess">' + message + '</div>');
        $('body').append(popup);
        popup.fadeIn(300);
        setTimeout(function () {
            popup.fadeOut(300, function () {
                $(this).remove();
            });
        }, 3000);
    }



    function checkQuantity(productId) {
        var button = $('.btn-group a[data-product-id="' + productId + '"]');
        var qtyBox = $('.qty-box[data-product-id="' + productId + '"]');
        var quantity = parseInt(qtyBox.find('.qty').val());
        if (quantity === 0 || isNaN(quantity)) {
            qtyBox.hide();
            button.closest('.btn-group').show();
        }
        else {
            qtyBox.show();
            button.closest('.btn-group').hide();
        }
    }



    var typingTimer;
    var doneTypingInterval = 1100;
    $(document).on('input click', '.product #qnty, .product .qty-plus, .product .qty-minus,.product .qty-minuss,.product .qty-pluss', function (event) {



        event.stopPropagation();
        event.stopPropagation();
        var $container = $(this).closest('.product');
        var productId = $(this).data('product-id');
        var variationIdColorr = $container.find('.selected-color').val();
        var variationIdSizee = $container.find('.selected-size').val();
        checkQuantity(productId);
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            doneTyping($container, productId, variationIdColorr, variationIdSizee);
        }, doneTypingInterval);





        $(document).on('click', '.add-to-cart', function (e) {
            e.preventDefault();
            var $container = $(this).closest('.product');
            var productId = $(this).data('product-id');
            var variationIdColor = $container.find('#pa_color_' + productId).val();
            var variationIdSize = $container.find('#pa_size_' + productId).val();
            if (variationIdColor) {
                variationIdColor = variationIdColor.toLowerCase();
            } else {
                variationIdColor = variationIdColorr;
            }
            if (variationIdSize) {
                variationIdSize = variationIdSize.toLowerCase();
            } else {
                variationIdSize = variationIdSizee;
            }
            var quantity = $container.find('.qty').val();
            checkQuantity(productId);
            add_cart(productId, variationIdColor, variationIdSize, quantity);

        });
        function doneTyping($container, productId) {
            var quantity = $container.find('.qty').val();
            checkQuantity(productId);
            if (!isNaN(quantity) && quantity !== 0) {
                quantity = parseInt(quantity);
                $container.find('.qty').value = quantity;
                $('.add-to-cart', $container).trigger('click');

            }
        }

        function add_cart(productId, variationIdColor, variationIdSize, quantity) {
            addLoader();
            $.ajax({
                type: 'POST',
                url: PHP_ENV.WP_AJAX,
                data: {
                    action: 'get_variation_ajax',
                    product_id: productId,
                    variation_Id_color: variationIdColor,
                    variation_Id_size: variationIdSize,

                },
                success: function (response) {
                    var variationid = response.variation_id;
                    add_to_cart_ajax_func(variationid, productId, quantity);
                },
                error: function (xhr, status, error) {

                    // console.error(xhr.responseText);
                    removeLoader();
                    // alert('failed');
                },
            });
        }

        function add_to_cart_ajax_func(variationid, productId, quantity) {

            addLoader();
            $.ajax({
                type: 'POST',
                url: PHP_ENV.WP_AJAX,
                data: {
                    action: 'add_to_cart_ajax',
                    product_id: productId,
                    variation_Id: variationid,
                    quantity: quantity
                },
                success: function (response) {
                    removeLoader();
                    showSuccess(quantity + ' Product has been added successfully');
                    if (quantity == 0) {
                        showPopupNotification("Product has been removed");
                    }
                    checkQuantity(productId);
                    console.log(productId);

                    console.log('Product Has been added Quantity:' + quantity);
                    update_mini_cart();

                },
                error: function (xhr, status, error) {
                    // Handle error
                    // console.error(xhr.responseText);              
                    removeLoader();

                    update_mini_cart();
                    // alert('failed to add');
                }
            });
        }

        // Function to add debounce functionality
        function debounce(func, delay) {
            var timer;
            return function () {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    func.apply(context, args);
                }, delay);
            };
        }

        // Your event handler with debouncing for select boxes
        $(document).on('change', '.variation-select', debounce(function () {
            addLoader();
            var $container = $(this).closest('.product');
            var productId = $(this).data('product-id');
            var variationIdColor = $container.find('#pa_color_' + productId).val();
            var variationIdSize = $container.find('#pa_size_' + productId).val();
            if (variationIdColor) {
                variationIdColor = variationIdColor.toLowerCase();
            }
            if (variationIdSize) {
                variationIdSize = variationIdSize.toLowerCase();
            }
            $.ajax({
                type: 'POST',
                url: PHP_ENV.WP_AJAX,
                data: {
                    action: 'get_variation_ajax',
                    product_id: productId,
                    variation_Id_color: variationIdColor,
                    variation_Id_size: variationIdSize,
                },
                success: function (response) {
                    removeLoader();
                    var variationid = response.variation_id;
                    var productType = response.product_type;
                    if (variationid == 0 && productType !== 'simple') {
                        showPopupNotification('This variation is not available. Please select another variation.');
                        removeLoader();
                        return false;
                    }
                    var variationData = response.variation_data;


                    $('.product[data-product-id="' + productId + '"] figure img').attr('src', variationData.image).attr('alt', variationData.title);
                    $('.product[data-product-id="' + productId + '"] h6').text(variationData.title);
                    $('.product[data-product-id="' + productId + '"] .price-info .price ').text('₹' + variationData.price);
                    // console.log(variationData.price);

                    $('.product[data-product-id="' + productId + '"] label[for="color"]').text('Selected Color: ' + variationData.SelectedColor);
                    $('.product[data-product-id="' + productId + '"] label[for="size"]').text('Selected Size: ' + variationData.SelectedSize);

                    if (variationData.quantity > 0) {
                        $('.product[data-product-id="' + productId + '"] .btn-group').hide();
                        $('.product[data-product-id="' + productId + '"] .qty-box').show();
                        $('.product[data-product-id="' + productId + '"] .qty').val(variationData.quantity);
                    } else {
                        $('.product[data-product-id="' + productId + '"] .btn-group').show();
                        $('.product[data-product-id="' + productId + '"] .qty-box').hide();
                    }
                },
                error: function (xhr, status, error) {
                    // console.error(xhr.responseText);
                    removeLoader();
                    // alert('failed');
                },
            });
        }, 2500));

    });
    jQuery(document).ready(function ($) {
        $('#clear-cart-button').on('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to clear all items from your cart?')) {
                addLoader();
                $.ajax({
                    type: 'POST',
                    url: PHP_ENV.WP_AJAX,
                    data: {
                        action: 'clear_cart'
                    },
                    success: function (response) {
                        removeLoader();
                        // Refresh the current page after clearing the cart
                        window.location.reload();
                    }
                });
            }
        });
    });


    //  triggering code for coupon and discount
    jQuery(document).ready(function ($) {
        $('.button.custom-button[name="apply_discount"]').on('click', function (e) {
            e.preventDefault();
            var discountCodeValue = $('input[name="discount_code"]').val();
            $('input[name="coupon_code"]').val(discountCodeValue);
            $('.button.wp-element-button[name="apply_coupon"]').click();
        });

        // Example: Triggering the 'update_cart' button click after 2 seconds
        setTimeout(function () {
            $('.actions button[name="update_cart"]').trigger('click');
        }, 2000);
    });
    $(document).ready(function () {
        // Listen for change event on any input field within the .quantity element
        $('.quantity input[type="number"]').on('change', function () {
            // Check if the value of the input field is greater than 0
            if ($(this).val() > 0) {
                // Enable the "Update cart" button
                $('.button.custom-button[name="update_cart"]').prop('disabled', false);
            } else {
                // Disable the "Update cart" button if the value is not greater than 0
                $('.button.custom-button[name="update_cart"]').prop('disabled', true);
            }
            $('.button.custom-button[name="update_cart"]').on('click', function (e) {
                e.preventDefault();

                // Trigger click event on the Update cart button with class wp-element-button
                $('.button.wp-element-button[name="update_cart"]').click();
            });

        });


        //opening mini cart
        jQuery(function ($) {
            // Open mini cart
            $('.mini-cart-toggle').on('click', function (e) {
                e.preventDefault();

            });

            // Close mini cart
            $('#mini-cart').on('click', function (e) {
                if (e.target === this) {
                    $(this).removeClass('slide-out');
                }
            });
        });

    });





    // $(document).ready(function () {
    //     $('input[name="selected_city"]').change(function () {
    //         var selectedValue = $(this).val();
    //         $.ajax({
    //             type: "POST",
    //             url: PHP_ENV.WP_AJAX,
    //             data: {
    //                 action: 'customize_shipping_method_label_and_cost',
    //                 city_value: selectedValue // Pass the selected city value
    //             },
    //             success: function (response) {
    //                 console.log("Ajax request successful");
    //                 console.log(response); // Log the response from the server for debugging
    //             },
    //             error: function (xhr, status, error) {
    //                 console.error(xhr.responseText);
    //             }
    //         });
    //     });
    // });

    $(document).ready(function () {
        $('#pincodeForm').submit(function (event) {
            event.preventDefault(); // Prevent default form submission

            var pincode = $('#pincode').val();
            var apiKey = 'AIzaSyCG39EpX8oGAXWTHK-CPU_uZgtyFRkERRU';
            var geocodeUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=' + encodeURIComponent(pincode) + '&key=' + apiKey;

            $.ajax({
                url: geocodeUrl,
                type: 'GET',
                success: function (response) {
                    if (response.status === 'OK' && response.results.length > 0) {
                        var city = '';
                        response.results[0].address_components.forEach(function (component) {
                            if (component.types.includes('locality')) {
                                city = component.long_name;
                            }
                        });
                        if (city !== '') {
                            $('#cityResult').html('City: ' + city);
                        } else {
                            $('#cityResult').html('City not found');
                        }
                    } else {
                        $('#cityResult').html('Error occurred');
                    }
                },
                error: function () {
                    $('#cityResult').html('Error occurred');
                }
            });
        });
    });



    // minicart closed outsid
    $(document).ready(function () {
        // Function to handle clicks outside the mini cart
        function handleClickOutside(event) {
            var miniCart = $('#mini-cart');
            var showMiniCartBtn = $('#show-mini-cart');
            if (!miniCart.is(event.target) && !showMiniCartBtn.is(event.target) && miniCart.has(event.target).length === 0) {
                miniCart.css('right', '-300px'); // Slide out
            }
        }

        // Event listener to show/hide mini cart
        $('#show-mini-cart').click(function () {
            var miniCart = $('#mini-cart');
            if (miniCart.css('right') === '-300px') {
                miniCart.css('right', '0'); // Slide in
                // Attach click event to the document to handle clicks outside the mini cart
                $(document).on('click', handleClickOutside);
            } else {
                miniCart.css('right', '-300px'); // Slide out
                // Remove click event from the document when the mini cart is hidden
                $(document).off('click', handleClickOutside);
            }
        });
    });






    $(document).ready(function () {
        $('#btn-check').click(function () {
            var pincode = $('.pin-input').val();
            addLoader();
            console.log(pincode);
            $.ajax({
                type: "POST",
                url: PHP_ENV.WP_AJAX,
                data: {
                    pincode: pincode,
                    action: 'get_city_info'
                },
                success: function (response) {

                    location.reload();
                    removeLoader();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });


    // city suggestions 
    jQuery(document).ready(function ($) {
        $('.pin-input').keyup(function () {
            var pincode = $(this).val();
            // Check if the pincode has at least 3 characters before sending the AJAX request
            if (pincode.length >= 3) {
                $.ajax({
                    type: 'POST',
                    url: PHP_ENV.WP_AJAX, // This variable is defined by WordPress and holds the URL to admin-ajax.php
                    data: {
                        action: 'suggest_cities',
                        pincode: pincode
                    },
                    success: function (response) {
                        // Parse the JSON response
                        var cities = JSON.parse(response);
                        // Clear previous suggestions
                        $('#city-info').empty();
                        // Append each city as a new element
                        cities.forEach(function (city) {
                            $('#city-info').append('<div class="suggested-city" data-city="' + city + '">' + city + '</div>');
                        });
                    }
                });
            }
        });

        // Click handler for suggested cities
        $('#city-info').on('click', '.suggested-city', function () {
            // Get the clicked city
            var cityName = $(this).data('city');
            // Get the corresponding pincode from the mapping
            var pincode = cityToPincode[cityName];
            // Update the search box with the pincode
            $('.pin-input').val(pincode);
        });
    });


    // search form
    jQuery(document).ready(function ($) {
        $('.search-form').submit(function (e) {
            e.preventDefault();
            addLoader();

            var search_term = $(this).find('.search-field').val();
            $.ajax({
                type: 'POST',
                url: PHP_ENV.WP_AJAX,
                data: {
                    action: 'woocommerce_product_search',
                    search_term: search_term
                },
                success: function (response) {
                    removeLoader();
                    var results = JSON.parse(response);
                    if (results.length > 0) {
                        var productId = results[0].product_id;
                        checkQuantity(productId);
                    }



                    if (results.length > 0) {
                        $('.search-result').empty();
                        results.forEach(function (result) {
                            $('.search-result').append(result.html);
                            $(document).on('click', function (event) {
                                if (!$(event.target).closest('.search-result').length) {
                                    $('.search-result').remove();
                                }
                            });
                        });
                    } else {
                        $('.search-result').html('No results found');
                    }
                    // Scroll to search results
                    $('html, body').animate({
                        scrollTop: $('.search-result').offset().top
                    }, 'slow');
                }
            });
        });
    });


    //recent search + clear search
    jQuery(document).ready(function ($) {
        $('.recent-search-item').click(function (e) {
            e.preventDefault();
            var searchTerm = $(this).text();
            $('.search-field').val(searchTerm);
        });

    });
    jQuery(document).ready(function ($) {
        // Functionality to clear all searches
        $('#clearSearches').click(function (event) {
            event.preventDefault();

            var clearDataValue = $('input[name="clear-data"]').val();
            addLoader();
            $.ajax({
                url: PHP_ENV.WP_AJAX,
                type: 'POST',
                data: {
                    action: 'clear_searches',
                    clearDataValue: clearDataValue
                },
                success: function (response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.success) {


                            $('.recent-search').html('');
                            $('.clear-all').hide();
                            removeLoader();
                            // window.location.reload();

                        } else {
                            console.log('Failed to clear searches.');
                        }
                    } catch (error) {
                        console.error('Error parsing AJAX response:', error);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });
    });

});
