(function($) {
	'use strict';

	// Run on DOM ready
	$(function(){
		/*
		* Posts - Load More
		*/
		$('#necromancers_loadmore').on('click', function(){

			$.ajax({
				url : necromancersPostData.ajaxurl, // AJAX handler
				data : {
					'action': 'loadmorebutton', // the parameter for admin-ajax.php
					'query': necromancersPostData.posts, // loop parameters passed by wp_localize_script()
					'page' : necromancersPostData.current_page, // current page,
					'blog_layout': necromancersPostData.blog_layout // blog layout,
				},
				type : 'POST',
				beforeSend : function ( xhr ) {
					$('#necromancers_loadmore .load-more-fab__icon').removeClass('fa-plus').addClass('fa-circle-notch fa-spin'); // some type of preloader
				},
				success : function( posts ){
					if ( posts ) {

						$('#necromancers_loadmore .load-more-fab__icon').addClass('fa-plus').removeClass('fa-circle-notch fa-spin'); // some type of preloader
						$('#necromancers_posts_wrap').append( posts ); // insert new posts
						necromancersPostData.current_page++;

						if ( necromancersPostData.current_page == necromancersPostData.max_page ) {
							$('#necromancers_loadmore').hide(); // if last page, HIDE the button
						}

					} else {
						$('#necromancers_loadmore').hide(); // if no data, HIDE the button as well
					}
				}
			});
			return false;
		});

		/*
		* Posts - Filter
		*/
		$('#necromancers_filters').on('submit', function(){

			$.ajax({
				url : necromancersPostData.ajaxurl,
				data : $('#necromancers_filters').serialize(), // form data
				dataType : 'json',
				type : 'POST',
				beforeSend : function(xhr){
					$('.ncr-filter-button__txt').text(necromancersPostData.filter_before_send_txt);
					$('.ncr-filter-button__icon').toggleClass('d-none');
				},
				success : function( data ){

					// when filter applied:
					// set the current page to 1
					necromancersPostData.current_page = 1;

					// set the new query parameters
					necromancersPostData.posts = data.posts;

					// set the new max page parameter
					necromancersPostData.max_page = data.max_page;

					// change the button label back
					$('.ncr-filter-button__txt').text(necromancersPostData.filter_txt);
					$('.ncr-filter-button__icon').toggleClass('d-none');

					// insert the posts to the container
					$('#necromancers_posts_wrap').html(data.content);

					// hide load more button, if there are not enough posts for the second page
					if ( data.max_page < 2 ) {
						$('#necromancers_loadmore').hide();
					} else {
						$('#necromancers_loadmore').show();
					}
				}
			});

			// do not submit the form
			return false;

		});
	});

})(jQuery);
