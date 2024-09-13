<?php

use WebinaneCommerce\Fields\MultiText;
use WebinaneCommerce\Fields\Select;
use WebinaneCommerce\Fields\Switcher;
return array(
	'id'	=> 'general_donation_settings',
	'title'	=> esc_html__('General', 'lifeline-donation-pro'),
	'heading'	=> esc_html__('Donation General Settings', 'lifeline-donation-pro'),
	'fields'		=> apply_filters( 'webinane_settings_donation_settings', array(
		
		Switcher::make(
			esc_html__( 'Enable Plugin Style', 'lifeline-donation-pro' ),
			'donation_enable_plugin_css'
		)->setHelp(esc_html__( 'Enable to apply plugin styles', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		))->default(true),
		
		// Enable causes.
		Switcher::make(
			esc_html__( 'Enable Causes', 'lifeline-donation-pro' ),
			'donation_causes_status'
		)->setHelp(esc_html__( 'Enable to collect donation on causes (custom post type)', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		))->default(true),
		
		// Enable projects.
		Switcher::make(
			esc_html__( 'Enable Projects', 'lifeline-donation-pro' ),
			'donation_projects_status'
		)->setHelp(esc_html__( 'Enable to collect donation on projects (custom post type)', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		))->default(true),
		

		// Enable projects.
		Switcher::make(
			esc_html__( 'Show Currency Selector', 'lifeline-donation-pro' ),
			'donation_multicurrency'
		)->setHelp(esc_html__( 'Allow donors to select currency on donation form', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),
		
		// Enable multi currency.
		Select::make(
			esc_html__( 'Choose Currencies to show in Donation Popup', 'lifeline-donation-pro' ),
			'selective_currency'
		)->setOptions(wpcm_currency_assos_data())
		->setHelp(esc_html__( 'Choose currency to show as selective on donation popup', 'lifeline-donation-pro' ))
		->multiple()
		->setDependency(array('key' => 'donation_multicurrency', 'value' => true, 'compare' => '='))
		->withMeta(['filterable' => true]),


		// Pre Defined Donation Amount
		Switcher::make(
			esc_html__( 'Pre Defined Donation Amount', 'lifeline-donation-pro' ),
			'donation_predefined_amounts'
		)->setHelp(esc_html__( 'Enable pre defined donations amounts', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),

		// Donation Amounts
		MultiText::make(
			esc_html__( 'Donation Amounts', 'lifeline-donation-pro' ),
			'donation_predefined_amounts_list'
		)->setHelp(esc_html__( 'It will convert currency based on USD rates only', 'lifeline-donation-pro' ))
		->setDependency(array('key' => 'donation_predefined_amounts', 'value' => true, 'compare' => '='))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),

		// Custom Donation Amount
		Switcher::make(
			esc_html__( 'Custom Donation Amount', 'lifeline-donation-pro' ),
			'donation_custom_amount'
		)->setHelp(esc_html__( 'Enable custom donations amount', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),

		// Enable recurring payments
		Switcher::make(
			esc_html__( 'Enable recurring payments', 'lifeline-donation-pro' ),
			'donation_recurring_payments'
		)->setHelp(esc_html__( 'Enable recurring payments', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),
		
		
		// Enable custom dropdowns
		Switcher::make(
			esc_html__( 'Enable Custom Dropdown', 'lifeline-donation-pro' ),
			'enable_custom_dropdown'
		)->setHelp(esc_html__( 'Enable to show custom dropdown in donation form.', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),		
		// Dropdown Options
		MultiText::make(
			esc_html__( 'Dropdown Options', 'lifeline-donation-pro' ),
			'donation_custom_dropdown'
		)->setHelp(esc_html__( 'Enable custom donations dropdown options', 'lifeline-donation-pro' ))
		->setDependency(array('key' => 'enable_custom_dropdown', 'value' => true, 'compare' => '=')),

		// Enable company field
		Switcher::make(
			esc_html__( 'Enable Company Field', 'lifeline-donation-pro' ),
			'enable_company_field'
		)->setHelp(esc_html__( 'Enable to show company field in donation form.', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),

		// Enable country field
		Switcher::make(
			esc_html__( 'Enable Country Field', 'lifeline-donation-pro' ),
			'enable_country_field'
		)->setHelp(esc_html__( 'Enable to show country field in donation form.', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),

		// Enable country field
		Switcher::make(
			esc_html__( 'Enable County Field', 'lifeline-donation-pro' ),
			'enable_county_field'
		)->setHelp(esc_html__( 'Enable to show county field in donation form.', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),

		// Enable city field
		Switcher::make(
			esc_html__( 'Enable City Field', 'lifeline-donation-pro' ),
			'enable_city_field'
		)->setHelp(esc_html__( 'Enable to show city field in donation form.', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),

		// Enable phone field
		Switcher::make(
			esc_html__( 'Enable Phone Number Field', 'lifeline-donation-pro' ),
			'enable_phone_no_field'
		)->setHelp(esc_html__( 'Enable to show phone number field in donation form.', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),

		// Enable city field
		Switcher::make(
			esc_html__( 'Enable Postal Code Field', 'lifeline-donation-pro' ),
			'enable_postal_code_field'
		)->setHelp(esc_html__( 'Enable to show postal code field in donation form.', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),

		// Enable city field
		Switcher::make(
			esc_html__( 'Enable Tax Code Field', 'lifeline-donation-pro' ),
			'enable_tax_code_field'
		)->setHelp(esc_html__( 'Enable to show tax code field in donation form.', 'lifeline-donation-pro' ))
		->withMeta(array(
			'active-text' => esc_html__( 'YES', 'lifeline-donation-pro' ),
			'inactive-text' => esc_html__( 'NO', 'lifeline-donation-pro' ),
		)),
		
	))
);