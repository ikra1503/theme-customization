<?php 

use WebinaneCommerce\Fields\Media;
use WebinaneCommerce\Fields\Number;
use WebinaneCommerce\Fields\Select;
use WebinaneCommerce\Fields\Switcher;
use WebinaneCommerce\Fields\Text;
use WebinaneCommerce\Fields\Textarea;
use WebinaneCommerce\Fields\MediaGallery;

return array(
	'id'			=> 'causes_settings',
	'post_types'	=> array('cause'),
	'meta_key'		=> 'lifeline_cause_settings',
	'heading'		=> esc_html__( 'Cause Settings', 'lifeline-donation-pro' ),
	'group'			=> true,
	'fields'		=> array(
		Number::make(
			esc_html__( 'Donation Needed', 'lifeline-donation-pro' ),
			'donation'
		)
		->setMax(100000000)
		->setHelp(esc_html__( 'Enter the donation needed amount.', 'lifeline-donation-pro' )),

		Text::make(
			esc_html__( 'Cause Location', 'lifeline-donation-pro' ),
			'location'
		)->setHelp(esc_html__( 'Enter location of the cause.', 'lifeline-donation-pro' )),

		Switcher::make(
			esc_html__( 'Show Title Section', 'lifeline-donation-pro' ),
			'show_title'
		)->setHelp(esc_html__( 'Whether to show title section or not', 'lifeline-donation-pro' )),

		Text::make(
			esc_html__( 'Header Banner Custom Title', 'lifeline-donation-pro' ),
			'banner_custom_title'
		)
		->setDependency(array('key' => 'show_title', 'value' => true, 'compare' => '='))
		->setHelp(esc_html__( 'Enter the custom title for header banner section', 'lifeline-donation-pro' )),

		Switcher::make(
			esc_html__( 'Show Breadcrumb section', 'lifeline-donation-pro' ),
			'show_breadcrumbs'
		)->setHelp(esc_html__( 'Show or hide Breadcrumb section', 'lifeline-donation-pro' )),

		Media::make(
			esc_html__( 'Title section background', 'lifeline-donation-pro' ),
			'title_section_bg'
		)
		->setAddText(esc_html__( 'Add Background', 'lifeline-donation-pro' ))
		->setUpdateText(esc_html__( 'Change Background', 'lifeline-donation-pro' ))
		->setHelp(esc_html__( 'Upload background image for page title section', 'lifeline-donation-pro' )),
		
		Select::make(
			esc_html__( 'Cause Layout', 'lifeline-donation-pro' ),
			'sidebar_layout'
		)
		->setOptions([
			'left'	=> esc_html__('Left', 'lifeline-donation-pro'),
			'full'	=> esc_html__('full', 'lifeline-donation-pro'),
			'right'	=> esc_html__('Right', 'lifeline-donation-pro'),
		])
		->setHelp(esc_html__( 'Choose the cause layout', 'lifeline-donation-pro' )),
		
		Select::make(
			esc_html__( 'Select sidebar', 'lifeline-donation-pro' ),
			'sidebar'
		)->setOptions(function() {
			return wpcm_sidebar_data([]);
		})
		->setHelp(esc_html__( 'Select sidebar to show on cause detail page', 'lifeline-donation-pro' )),
		
		Select::make(
			esc_html__( 'Cause Format', 'lifeline-donation-pro' ),
			'cause_format'
		)->setOptions(function() {
			return array(
				'slider' => esc_html__('Slider', 'lifeline-donation-pro'),
				'image' => esc_html__('Image', 'lifeline-donation-pro'),
				'video' => esc_html__('Video', 'lifeline-donation-pro'),
				'gallery' => esc_html__('Gallery', 'lifeline-donation-pro'),
			);
		})
		->setHelp(esc_html__( 'Select the format', 'lifeline-donation-pro' )),

		Textarea::make(
			esc_html__( 'Video Code', 'lifeline-donation-pro' ),
			'donation_cause_video'
		)->withMeta(['rows' => 4])
		->setHelp(esc_html__( 'Enter cause link like "https://www.youtube.com/watch?v=IvWjhp62zhM"', 'lifeline-donation-pro' ))
		->setDependency(array('key' => 'cause_format', 'value' => 'video', 'compare' => '=')),

		MediaGallery::make(
			esc_html__( 'Gallery Images', 'lifeline-donation-pro' ),
			'donation_cause_gallery'
		)
		->setAddText(esc_html__( 'Add Gallery', 'lifeline-donation-pro' ))
		->setUpdateText(esc_html__( 'Update Gallery', 'lifeline-donation-pro' ))
		->setHelp(esc_html__( 'Upload gallery images.', 'lifeline-donation-pro' ))
		->setDependency(array('key' => 'cause_format', 'value' => 'gallery', 'compare' => '=')),

		/*array(
			'name'       => esc_html__( 'Gallery Images', 'lifeline-donation' ),
			'desc'       => esc_html__( 'Upload gallery images.', 'lifeline-donation' ),
			'id'         => 'donation_cause_gallery',
			'type'       => 'gallery',
			'is'	     => 'wpcm-gallery',
		),
		*/		
	)
);