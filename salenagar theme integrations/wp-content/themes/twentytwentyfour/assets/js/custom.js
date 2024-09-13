function addLoader() {
    jQuery('body').addClass('overlay');
    jQuery('body').append('<div class="spinner"></div>');
}

function removeLoader() {
    jQuery('body').removeClass('overlay');
    jQuery('div.spinner').remove();
}
$(document).ready(function () {

    $('.categories').click(function () {
        $('.all-categories').toggle();
    });
    var originalTitle = document.title;
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === 'visible') {
            document.title = originalTitle;
        } else {
            document.title = originalTitle;
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


    $(document).ready(function () {
        update_mini_cart();

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
        $(document).on('input click', '.product #qnty, .product .qty-plus, .product .qty-minus', function (event) {
            event.stopPropagation();
            event.stopPropagation();
            var $container = $(this).closest('.product');
            var productId = $(this).data('product-id');
            checkQuantity(productId);
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function () {
                doneTyping($container, productId);
            }, doneTypingInterval);
        });

        $(document).on('click', '.add-to-cart', function (e) {
            e.preventDefault();
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
                    showSuccess(quantity + ' Product has been added successfully');
                    if (quantity == 0) {
                        showPopupNotification("Product has been removed");
                    }
                    checkQuantity(productId);
                    console.log(productId);
                    console.log('Product Has been added Quantity:' + quantity);
                    update_mini_cart();
                    removeLoader();

                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                    removeLoader();


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
                    $('.product[data-product-id="' + productId + '"] .price-info .saved').html('<span class="badge">' + variationData.saved + '% off</span>');
                    $('.product[data-product-id="' + productId + '"] .price-info .save-money').html('<span class="saved-money">Save:₹ ' + variationData.savedMoney + '</span>');

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
                    action: 'get_city_info',
                },
                success: function (response) {

                    var ajaxUrl = PHP_ENV.WP_AJAX.toString().replace('%%endpoint%%', 'get_refreshed_fragments');
                    console.log("action:" + ajaxUrl);
                    var carthash = PHP_ENV.cart_hash_key;
                    console.log(carthash);
                    $.ajax({
                        type: 'GET',
                        url: ajaxUrl,
                        data: {
                            'action': 'get_refreshed_fragments',
                            'cart_hash': PHP_ENV.cart_hash_key
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log('Fragments:', response.fragments);

                            if (response && response.fragments) {
                                // Replace fragments in the DOM
                                $.each(response.fragments, function (key, value) {
                                    $(key).replaceWith(value);
                                });

                                // Trigger fragment refresh event
                                $(document.body).trigger('wc_fragment_refresh');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            console.error('XHR Object:', xhr);
                        }
                    });

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

            if (pincode.length >= 3) {
                $.ajax({
                    type: 'POST',
                    url: PHP_ENV.WP_AJAX,
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
$(document).ready(function () {
    $('.product-quantity input[type="number"]').change(function () {
        $('button[name="update_cart"]').removeAttr('disabled').trigger('click');


    });
});

$(document).ready(function () {
    var shippingMethodRadios = document.querySelectorAll('input.shipping_method');

    // Loop through each radio button
    shippingMethodRadios.forEach(function (radio) {
        // Add change event listener to each radio button
        radio.addEventListener('change', function (event) {
            $('button[name="update_cart"]').removeAttr('disabled').trigger('click');
        });
    });
});



var isShopPage = document.body.classList.contains('woocommerce-shop') && document.body.classList.contains('archive');

if (isShopPage) {
    console.log('This is the WooCommerce shop page.');
    var search = $('.woocom-search').val();

    filterAndSortProducts(1, search);
}

jQuery(document).ready(function ($) {
    // Attach click event listener to variation buttons
    $('.variation-button').click(function (event) {
        event.preventDefault();
        addLoader();
        var variationID = $(this).data('variation-id');
        var ProductID = $(this).data('product-id');

        // AJAX request to get price
        $.ajax({
            url: PHP_ENV.WP_AJAX,
            type: 'POST',
            data: {
                action: 'get_variation_info',
                product_id: ProductID,
                variation_id: variationID
            },
            success: function (response) {

                if (response.variation_regular_price) {
                    var sale_price = response.variation_sale_price;
                    var Regular_price = response.variation_regular_price;
                    var save = response.save;
                    var cart_quantity = response.quantity;

                    var productPriceHtml = '<span class="woocommerce-Price-amount amount" style="text-decoration: line-through;"><bdi><span class="woocommerce-Price-currencySymbol">$</span>&nbsp;' + Regular_price + '</bdi></span>' +
                        '<br/>' +
                        '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>&nbsp;' + sale_price + '</bdi></span>' +
                        '<br/>' +
                        '<span>You save: ' + save + '%</span>' +
                        '<br/>' +
                        '<span>Quantity in cart: ' + cart_quantity + '</span>';

                    $('.wc-block-components-product-price').html(productPriceHtml);
                }


                removeLoader();
            },
            error: function (jqXHR, textStatus, errorThrown) {

                // Handle error
                console.error('AJAX Error: ' + textStatus, errorThrown);
            }
        });
    });
});

jQuery(document).ready(function ($) {
    // Set the API endpoint and key
    var apiKey = '96a5a6309amsh3b7cc425ea168fcp17fc5bjsna9bca28bad2e';
    var requestUrl = "https://booking-com.p.rapidapi.com/v1/hotels/search?checkout_date=2024-09-15&order_by=popularity&filter_by_currency=AED&include_adjacency=true&children_number=2&categories_filter_ids=class%3A%3A2%2Cclass%3A%3A4%2Cfree_cancellation%3A%3A1&room_number=1&dest_id=-553173&dest_type=city&adults_number=2&page_number=0&checkin_date=2024-09-14&locale=en-gb&units=metric&children_ages=5%2C0";

    // Fetch data from the API
    $.ajax({
        url: requestUrl,
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': apiKey,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'x-rapidapi-ua': 'RapidAPI-Playground',
            'x-rapidapi-host': 'booking-com.p.rapidapi.com'
        },
        success: function (response) {
            // Process and display the data
            var dataContainer = $('#api-data-container');
            dataContainer.html(formatData(response));
        },
        error: function (xhr, status, error) {
            console.log('Error:', error);
        }
    });

    // Function to format and return HTML from API response
    function formatData(response) {
        var html = '';
        if (response && response.result) {
            $.each(response.result, function (index, hotel) {
                html += '<div class="hotel">';
                html += '<h2>' + hotel.hotel_name + '</h2>';
                html += '<img src="' + hotel.main_photo_url + '" alt="' + hotel.hotel_name + '" style="max-width: 100%;">';
                html += '<p>Address: ' + hotel.address + '</p>';
                html += '<p>City: ' + hotel.city + '</p>';
                html += '<p>Distance from city center: ' + hotel.distance + ' km</p>';
                html += '<p>Review Score: ' + hotel.review_score + '</p>';
                html += '<p>Price: ' + hotel.price_breakdown.gross_price + ' ' + hotel.currency_code + '</p>';
                html += '<p><a href="' + hotel.url + '" target="_blank">Book Now</a></p>';
                html += '</div>';
            });
        } else {
            html = '<p>No hotels found</p>';
        }
        return html;
    }
});

jQuery(document).ready(function ($) {
    $('#train-schedule-form').on('submit', function (e) {
        e.preventDefault();

        var trainNumber = $('#train-number').val();

        $.ajax({
            url: PHP_ENV.WP_AJAX,
            type: 'POST',
            data: {
                action: 'get_train_schedule',
                train_number: trainNumber
            },
            success: function (response) {
                // Handle the response and display in a div
                $('#train-schedule-result').html(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
jQuery(document).ready(function($) {
    $.ajax({
        url: realEstateAjax.ajaxurl,
        method: 'POST',
        data: {
            action: 'fetch_real_estate_data'
        },
        success: function(response) {
            if(response.success) {
                var data = JSON.parse(response.data);
                var htmlContent = generateHTMLContent(data);
                $('#real-estate-data-container').html(htmlContent);
            } else {
                $('#real-estate-data-container').html('Failed to load data.');
            }
        },
        error: function() {
            $('#real-estate-data-container').html('Failed to load data.');
        }
    });

    function generateHTMLContent(data) {
        var html = '';

        data.resultaten.forEach(function(item) {
            html += '<div class="real-estate-item">';
            
            // Financieel
            html += '<h2>Financieel</h2>';
            html += '<p>Koopprijs: ' + item.financieel.overdracht.koopprijs + '</p>';
            html += '<p>Transactieprijs: ' + item.financieel.overdracht.transactieprijs + '</p>';
            html += '<p>Status: ' + item.financieel.overdracht.status + '</p>';
            
            // Algemeen
            html += '<h2>Algemeen</h2>';
            html += '<p>Woonoppervlakte: ' + item.algemeen.woonoppervlakte + ' m²</p>';
            html += '<p>Bouwjaar: ' + item.algemeen.bouwjaar + '</p>';
            html += '<p>Onderhoud buiten: ' + item.algemeen.onderhoudswaarderingBuiten + '</p>';
            html += '<p>Onderhoud binnen: ' + item.algemeen.onderhoudswaarderingBinnen + '</p>';
            html += '<p>Aantal kamers: ' + item.algemeen.aantalKamers + '</p>';
            html += '<p>Inhoud: ' + item.algemeen.inhoud + ' m³</p>';
            
            // Detail
            html += '<h2>Details</h2>';
            item.detail.etages.forEach(function(etage) {
                html += '<h3>' + etage.etageomschrijving + '</h3>';
                html += '<p>Aantal kamers: ' + etage.aantalKamers + '</p>';
                html += '<p>Aantal slaapkamers: ' + etage.aantalSlaapkamers + '</p>';
            });

            // Media
            html += '<h2>Media</h2>';
            item.media.forEach(function(media) {
                if(media.soort === 'FOTO') {
                    html += '<img src="' + media.link + '" alt="Real Estate Image">';
                } else if(media.soort === 'VIDEO') {
                    html += '<video controls><source src="' + media.link + '" type="video/mp4">Your browser does not support the video tag.</video>';
                } else if(media.soort === 'DOCUMENT') {
                    html += '<a href="' + media.link + '" target="_blank">' + media.titel + '</a>';
                }
            });

            html += '</div>';
        });

        return html;
    }
});
