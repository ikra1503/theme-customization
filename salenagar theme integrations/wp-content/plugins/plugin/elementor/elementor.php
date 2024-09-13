<?php
namespace LifelineDonation\Elementor;


class Elementor
{
	static $widgets = array(
		'button',
		'causes',
		'causes2',
		'causes3',
		'causes4',
		'causes5',
		'heading',
		'heading2',
		'single_causes_widget',
		'causes_listing_widget',
		'parallax',
		'parallax2',
		'parallax3',
		'parallax4',
		'parallax5',
		'stat_counter',
	);

	static function init() {
		add_action('elementor/init', array(__CLASS__, 'loader') );
		add_action( 'elementor/elements/categories_registered', array(__CLASS__, 'register_cats') );
	}

	static function loader() {

		foreach( self::$widgets as $widget ) {

		    $file = LIFELINE_DONATION_PATH . 'elementor/'.$widget.'.php';
		    if( file_exists($file)) {
		    	require_once $file;
		    }
		    
		    add_action('elementor/widgets/widgets_registered', array(__CLASS__, 'register'));
		}
	}

	static function register($elemntor) {
		foreach( self::$widgets as $widget ) {
			$class = '\\LifelineDonation\\Elementor\\'.ucwords($widget);

			if( class_exists($class) ) {
        		$elemntor->register_widget_type(new $class);
			}
		}
    }

    static function register_cats( $elements_manager ) {

		$elements_manager->add_category(
			'donations',
			[
				'title' => esc_html__( 'Webinane Donations', 'lifeline-donation-pro' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

	static function filter_custom_post_type(  ) {

		// add_action( 'elementor/query/my_custom_filter', function( $query ) {
		// 	// Here we set the query to fetch posts with
		// 	// post type of 'custom-post-type1' and 'custom-post-type2'
		// 	$query->set( 'post_type', [ 'custom-post-type1', 'custom-post-type2' ] );
		// } );

		$options = array();
        $posts = get_posts( array(
            'post_type'  => 'post'
        ) );

        foreach ( $posts as $key => $post ) {
            $options[$post->ID] = get_the_title($post->ID);
        }
        return $options;
		
	}
}

Elementor::init();