(function($) {
  'use strict';

  // Run on DOM ready
  $(function(){
    /*
    * Products - Load More
    */
    $('#necromancers_products_loadmore').on('click', function(){

      $.ajax({
        url : necromancersProductsData.ajaxurl, // AJAX handler
        data : {
          'action': 'productsloadmorebutton', // the parameter for admin-ajax.php
          'query': necromancersProductsData.products, // loop parameters passed by wp_localize_script()
          'page' : necromancersProductsData.current_page // current page
        },
        type : 'POST',
        beforeSend : function ( xhr ) {
          $('#necromancers_products_loadmore .load-more-fab__icon').removeClass('fa-plus').addClass('fa-circle-notch fa-spin'); // some type of preloader
        },
        success : function( products ){
          if ( products ) {

            $('#necromancers_products_loadmore .load-more-fab__icon').addClass('fa-plus').removeClass('fa-circle-notch fa-spin'); // some type of preloader
            $('#necromancers_products_wrap').append( products ); // insert new products
            necromancersProductsData.current_page++;

            if ( necromancersProductsData.current_page == necromancersProductsData.max_page ) {
              $('#necromancers_products_loadmore').hide(); // if last page, HIDE the button
            }

          } else {
            $('#necromancers_products_loadmore').hide(); // if no data, HIDE the button as well
          }
        }
      });
      return false;
    });

    /*
    * Products - Filter
    */
    $('#necromancers_products_filters').on('submit', function(){

      $.ajax({
        url : necromancersProductsData.ajaxurl,
        data : $('#necromancers_products_filters').serialize(), // form data
        dataType : 'json',
        type : 'POST',
        beforeSend : function(xhr){
          $('.ncr-filter-button__txt').text(necromancersProductsData.filter_before_send_txt);
          $('.ncr-filter-button__icon').toggleClass('d-none');
        },
        success : function( data ){

          // when filter applied:
          // set the current page to 1
          necromancersProductsData.current_page = 1;

          // set the new query parameters
          necromancersProductsData.products = data.products;

          // set the new max page parameter
          necromancersProductsData.max_page = data.max_page;

          // change the button label back
          $('.ncr-filter-button__txt').text(necromancersProductsData.filter_txt);
          $('.ncr-filter-button__icon').toggleClass('d-none');

          // insert the products to the container
          $('#necromancers_products_wrap').html(data.content);

          // hide load more button, if there are not enough products for the second page
          if ( data.max_page < 2 ) {
            $('#necromancers_products_loadmore').hide();
          } else {
            $('#necromancers_products_loadmore').show();
          }
        }
      });

      // do not submit the form
      return false;

    });
  });

})(jQuery);
