<?php
use WebinaneCommerce\Fields\Country;
use WebinaneCommerce\Fields\Media;
use WebinaneCommerce\Fields\Text;

return array(

	array(
		'title'			=> esc_html__( 'Personal Profile', 'lifeline-donation-pro' ),
		'icon'			=> 'fa fa-user-alt',
		'id'			=> 'profile_settings',
		'component'		=> 'myaccount-profile',
		'fields'		=> apply_filters( 'webinane_frontend_my_account_profile', array(
			Media::make(esc_html__('Profile Image', 'lifeline-donation-pro'), 'avatar')
				->setAddText(esc_html__( 'Add Avatar', 'lifeline-donation-pro' ))
				->setUpdateText(esc_html__( 'Change Avatar', 'lifeline-donation-pro' ))
				->setHelp(esc_html__( 'Choose the avatar you want to show', 'lifeline-donation-pro' )),
			Text::make(esc_html__('Account Name', 'lifeline-donation-pro'), 'user_login')
				->withMeta(['disabled' => true])
				->setHelp(esc_html__('Enter your name', 'lifeline-donation-pro')),
			Text::make(esc_html__('Email Address', 'lifeline-donation-pro'), 'user_email')
				->setHelp(esc_html__('Enter acount email address', 'lifeline-donation-pro')),
			Text::make(esc_html__('Password', 'lifeline-donation-pro'), 'user_password')
				->setHelp(esc_html__('Enter acount password, leave empty if you do not want to change', 'lifeline-donation-pro'))
				->withMeta(['type' => 'password']),
			Text::make(esc_html__('Website', 'lifeline-donation-pro'), 'user_url')
				->setHelp(esc_html__('Enter acount website address', 'lifeline-donation-pro')),
			Text::make(esc_html__('Author Bio', 'lifeline-donation-pro'), 'description')
				->withMeta(['type' => 'textarea', 'rows' => 4])
				->setHelp(esc_html__('Enter something about you.', 'lifeline-donation-pro')),

			// Billing Fields.
			Text::make(esc_html__('First Name', 'lifeline-donation-pro'), 'billing_first_name', function() {
				if ( $value = get_user_meta( get_current_user_id(), 'first_name', true ) ) {
					return $value;
				}
			})
				->withMeta(['heading' => __('Billing Information', 'lifeline-donation-pro')])
				->setHelp(esc_html__('Enter your first name.', 'lifeline-donation-pro')),
			
			Text::make(esc_html__('Last Name', 'lifeline-donation-pro'), 'billing_last_name', function() {
				if ( $value = get_user_meta( get_current_user_id(), 'last_name', true ) ) {
					return $value;
				}
			})
				->setHelp(esc_html__('Enter your last name.', 'lifeline-donation-pro')),
			Text::make(esc_html__('Company Name', 'lifeline-donation-pro'), 'billing_company')
				->setHelp(esc_html__('Enter your company name.', 'lifeline-donation-pro')),
			Country::make(esc_html__('Country', 'lifeline-donation-pro'), 'billing_base_country')
				->default(['country' => 'USA', 'state' => ''])
				->setHelp(esc_html__('Choose the country.', 'lifeline-donation-pro')),
			Text::make(esc_html__('Address', 'lifeline-donation-pro'), 'billing_address_line_1')
				->setHelp(esc_html__('Enter the street address.', 'lifeline-donation-pro')),
			Text::make(esc_html__('Address 2', 'lifeline-donation-pro'), 'billing_address_line_2')
				->setHelp(esc_html__('Enter the street address.', 'lifeline-donation-pro')),
			Text::make(esc_html__('Town / City', 'lifeline-donation-pro'), 'billing_city')
				->setHelp(esc_html__('Enter the city', 'lifeline-donation-pro')),
			Text::make(esc_html__('Zip / Postcode', 'lifeline-donation-pro'), 'billing_zip')
				->setHelp(esc_html__('Enter the zip or post code', 'lifeline-donation-pro')),
			Text::make(esc_html__('Phone', 'lifeline-donation-pro'), 'billing_phone')
				->setHelp(esc_html__('Enter the phone', 'lifeline-donation-pro')),
			
			// Social Profiles
			Text::make(esc_html__('Facebook', 'lifeline-donation-pro'), 'facebook')
				->withMeta(['heading' => __('Social Profiles', 'lifeline-donation-pro')])
				->setHelp(esc_html__('Enter the facebook profile URL', 'lifeline-donation-pro')),
			Text::make(esc_html__('Twitter', 'lifeline-donation-pro'), 'twitter')
				->setHelp(esc_html__('Enter the twitter profile URL', 'lifeline-donation-pro')),
			Text::make(esc_html__('Linkedin', 'lifeline-donation-pro'), 'linkedin')
				->setHelp(esc_html__('Enter the linkedin profile URL', 'lifeline-donation-pro')),
			Text::make(esc_html__('Pinterest', 'lifeline-donation-pro'), 'pinterest')
				->setHelp(esc_html__('Enter the pinterest profile URL', 'lifeline-donation-pro')),
			
		))
	),
	array(
		'title'			=> apply_filters( 'wpcm_orders_admin_menu_label', esc_html__( 'My Orders', 'lifeline-donation-pro' ) ),
		'icon'			=> 'fa fa-user-alt',
		'id'			=> 'profile_settings',
		'component'		=> 'myaccount-orders',
		'fields'		=> apply_filters( 'webinane_frontend_my_account_orders', array(
			array()
		))
	),

	array(
		'title'			=> esc_html__( 'Payment Methods', 'lifeline-donation-pro' ),
		'icon'			=> 'fa fa-dollar-sign',
		'id'			=> 'payment_methods_settings',
		'component'		=> 'myaccount-payment-methods',
		'fields'		=> apply_filters( 'webinane_frontend_may_account_payment_methods', array(
			array()
		))
	)
);
