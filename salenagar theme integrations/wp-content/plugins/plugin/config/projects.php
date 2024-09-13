<?php 

use WebinaneCommerce\Fields\Media;
use WebinaneCommerce\Fields\Number;
use WebinaneCommerce\Fields\Select;
use WebinaneCommerce\Fields\Switcher;
use WebinaneCommerce\Fields\Text;
use WebinaneCommerce\Fields\Textarea;

return array(
	'id'			=> 'project_settings',
	'post_types'	=> array('project'),
	'meta_key'		=> 'webinane_donation_project_settings',
	'heading'		=> esc_html__( 'Project Additional Fields', 'lifeline-donation-pro' ),
	'group'			=> true,
	'fields'		=> array(

		// Project or causes layout
		Number::make(
			esc_html__( 'Donation Needed', 'lifeline-donation-pro' ),
			'donation'
		)
		->setMax(100000000)
		->setHelp(esc_html__( 'Choose the archive pages layout for projects and causes.', 'lifeline-donation-pro' )),
		
		Text::make(
			esc_html__( 'Project Location', 'lifeline-donation-pro' ),
			'location'
		)->setHelp(esc_html__( 'Enter location of the project.', 'lifeline-donation-pro' )),
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
			esc_html__( 'Project Layout', 'lifeline-donation-pro' ),
			'sidebar_layout'
		)
		->setOptions([
			'left'	=> esc_html__('Left', 'lifeline-donation-pro'),
			'full'	=> esc_html__('Full', 'lifeline-donation-pro'),
			'right'	=> esc_html__('Right', 'lifeline-donation-pro'),
		])
		->setHelp(esc_html__( 'Choose the project layout', 'lifeline-donation-pro' )),

		
		Select::make(
			esc_html__( 'Select sidebar', 'lifeline-donation-pro' ),
			'sidebar'
		)->setOptions(function() {
			return wpcm_sidebar_data([]);
		})
		->setDependency(array('key' => 'sidebar_layout', 'value' => 'full', 'compare' => '!='))
		->setHelp(esc_html__( 'Select sidebar to show on project detail page', 'lifeline-donation-pro' )),
	)
);