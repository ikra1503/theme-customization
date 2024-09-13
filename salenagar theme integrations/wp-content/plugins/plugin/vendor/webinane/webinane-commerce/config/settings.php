<?php
use WebinaneCommerce\Fields\Checkbox;
use WebinaneCommerce\Fields\Color;
use WebinaneCommerce\Fields\Country;
use WebinaneCommerce\Fields\Image;
use WebinaneCommerce\Fields\ImageList;
use WebinaneCommerce\Fields\Media;
use WebinaneCommerce\Fields\Select;
use WebinaneCommerce\Fields\Switcher;
use WebinaneCommerce\Fields\Text;
use WebinaneCommerce\Fields\Textarea;
use WebinaneCommerce\Fields\Repeater;

$gateways_data = webinane_get_json('assets/data/gateways.json')->toArray();

$email_tpl_placeholders = '<code>{{customer_name}} {{customer_email}} {{site_name}} {{site_url}}</code>  <code>{{admin_email}} {{customer_account_url}} {{admin_order_url}}</code> <code>{{total_amount}}</code>';
return array(

	array(
		'title'    => esc_html__( 'General', 'lifeline-donation-pro' ),
		'icon'     => 'el-icon-setting',
		'id'       => 'general_settings',
		'children' => array(
			apply_filters(
				'webinane_commerce/settings/address_fields',
				array(
					'id'      => 'address-info',
					'title'   => esc_html__( 'Address Info', 'lifeline-donation-pro' ),
					'heading' => esc_html__( 'Address Information', 'lifeline-donation-pro' ),
					'fields'  => array(

						/*
						Repeater::make(__('Select Country and State', 'lifeline-donation'), 'base_repeater')
							->fields([
								Text::make('City'),
								Text::make('Address')
							])
							->default(['country' => 'USA', 'state' => ''])
							->setHelp(esc_html__( 'Choose the base country and state', 'lifeline-donation' )),*/
						Country::make( __( 'Select Country and State', 'lifeline-donation-pro' ), 'base_country' )
							->default(
								array(
									'country' => 'USA',
									'state'   => '',
								)
							)
							->setHelp( esc_html__( 'Choose the base country and state', 'lifeline-donation-pro' ) ),

						Text::make( esc_html__( 'City', 'lifeline-donation-pro' ), 'base_city' )
							->default( 'New York' )
							->setHelp( esc_html__( 'Enter the base city', 'lifeline-donation-pro' ) ),
						Text::make( esc_html__( 'Add Address', 'lifeline-donation-pro' ), 'address_line_1' )
							->default( 'Webinane Plaza, 3rd Floor NY' )
							->setHelp( esc_html__( 'Enter the business address', 'lifeline-donation-pro' ) ),
						Text::make( esc_html__( 'Address Line 2', 'lifeline-donation-pro' ), 'address_line_2' )
							->setHelp( esc_html__( 'Enter the business address', 'lifeline-donation-pro' ) ),
						Text::make( esc_html__( 'ZIP Code', 'lifeline-donation-pro' ), 'zip_code' )
							->default( '10200' )
							->setHelp( esc_html__( 'Enter the ZIP / Postal Code', 'lifeline-donation-pro' ) ),

					),
				)
			),
			apply_filters(
				'webinane_commerce/settings/currency_info_fields',
				array(
					'id'      => 'currency-info',
					'title'   => esc_html__( 'Currency Info', 'lifeline-donation-pro' ),
					'heading' => esc_html__( 'Currency Information', 'lifeline-donation-pro' ),
					'fields'  => array(

						Select::make( esc_html__( 'Select Currency', 'lifeline-donation-pro' ), 'base_currency' )
							->default( 'USD' )
							->setOptions( wpcm_currency_assos_data() )
							->setHelp( esc_html__( 'Choose the base currency', 'lifeline-donation-pro' ) ),
						Select::make( esc_html__( 'Currency Symbol Position', 'lifeline-donation-pro' ), 'currency_position' )
						->default( 'left' )
						->setOptions(
							array(
								'left'    => esc_html__( 'Left (eg: $2,000.00)', 'lifeline-donation-pro' ),
								'right'   => esc_html__( 'Right (eg: 2,000.00$)', 'lifeline-donation-pro' ),
								'left_s'  => esc_html__( 'Left with Space (eg: $ 2,000.00)', 'lifeline-donation-pro' ),
								'right_s' => esc_html__( 'Right with Space (eg: 2,000.00 $)', 'lifeline-donation-pro' ),
							)
						)
						->setHelp( esc_html__( 'Choose the currency symbol position', 'lifeline-donation-pro' ) ),

						Text::make( esc_html__( 'Thousand Saparate', 'lifeline-donation-pro' ), 'thousand_saparator' )
							->default( ',' )
							->setHelp( esc_html__( 'Enter the thousand amount saparator', 'lifeline-donation-pro' ) ),
						Text::make( esc_html__( 'Decimal Separator', 'lifeline-donation-pro' ), 'decimal_saparator' )
							->default( '.' )
							->setHelp( esc_html__( 'Enter the decimal saparator', 'lifeline-donation-pro' ) ),
						Text::make( esc_html__( 'Number of decimals', 'lifeline-donation-pro' ), 'number_decimals' )
							->default( '.' )
							->setHelp( esc_html__( 'Enter the number of decimals', 'lifeline-donation-pro' ) ),

					),
				)
			),
			apply_filters(
				'webinane_commerce/settings/general_setting_fields',
				array(
					'id'      => 'general-setting-info',
					'title'   => esc_html__( 'Setting Info', 'lifeline-donation-pro' ),
					'heading' => esc_html__( 'Setting Information', 'lifeline-donation-pro' ),
					'fields'  => array(

						Color::make( __( 'Color Scheme', 'lifeline-donation-pro' ), 'general_setting_color_scheme' )
							->setHelp( esc_html__( 'Choose the color scheme', 'lifeline-donation-pro' ) )
							//->default( '#2f88e4' ),

					),
				)
			),

		),

	),
	array(
		'title'    => esc_html__( 'Payments', 'lifeline-donation-pro' ),
		'icon'     => 'el-icon-bank-card',
		'id'       => 'payment_settings',
		'children' => apply_filters(
			'wpcommerce_payment_gateways_setting_tabs',
			array(
				array(
					'title'   => esc_html__( 'General', 'lifeline-donation-pro' ),
					'icon'    => 'fa fa-th',
					'id'      => 'general_gateways_settings',
					'heading' => esc_html__( 'Gateway Settings', 'lifeline-donation-pro' ),
					'fields'  => array(
						Switcher::make( esc_html__( 'Test Mode', 'lifeline-donation-pro' ), 'gateways_test_mode' )
						->setHelp( esc_html__( 'While in the test mode no live payments are processed. To fully use test mode, you must have a sandbox(test) account for payment gateway', 'lifeline-donation-pro' ) ),
						Checkbox::make( esc_html__( 'Gateways', 'lifeline-donation-pro' ), 'active_gateways' )
						->setOptions(
							function() {
								$gateways = apply_filters( 'wpcommerce_payment_gateways', array() );
								$return = array();
								foreach ( $gateways as $gateway ) {
									$return[ $gateway->id ] = $gateway->name;
								}
								return $return;
							}
						)->withMeta( array( 'class' => 'display-block' ) )
						->setHelp( sprintf( __( 'Enable your payment gateway. Want to get more payment gateways? <a href="%s" target="_blank">Click Here</a>', 'lifeline-donation-pro' ), 'https://www.webinane.com/plugins' ) ),

						// Default gateway
						Select::make( esc_html__( 'Default Gateway', 'lifeline-donation-pro' ), 'default_gateway' )
						->setOptions(
							function() {
								$gateways = apply_filters( 'wpcommerce_payment_gateways', array() );
								$return = array();
								foreach ( $gateways as $gateway ) {
									$return[ $gateway->id ] = $gateway->name;
								}
								return $return;
							}
						)
						->setHelp( esc_html__( 'Choose the default gateway. The gateway will be select by default.', 'lifeline-donation-pro' ) ),

					),
				),
				array(
					'title'   => esc_html__( 'Payment Gateways', 'lifeline-donation-pro' ),
					'icon'    => 'fa fa-th',
					'id'      => 'general_gateways_payment_gateways_list',
					// 'heading' => esc_html__( 'Gateway Settings', 'lifeline-donation-pro' ),
					'fields'  => array(
						ImageList::make('', 'gateways_list' )
						->items($gateways_data)
						->width('33.333%')
					)
				)
			)
		),
	),
	array(
		'title'  => esc_html__( 'Display', 'lifeline-donation-pro' ),
		'icon'   => 'el-icon-monitor',
		'id'     => 'display_settings',
		'fields' => apply_filters(
			'webinane_commerce/settings/display_settings',
			array(

				Select::make( esc_html__( 'Checkout Page', 'lifeline-donation-pro' ), 'checkout_page' )
				->setOptions(
					wpcm_posts_data(
						array(
							'post_type'      => 'page',
							'posts_per_page' => 100,
						)
					)
				)
				->setHelp( esc_html__( 'Choose the checkout page', 'lifeline-donation-pro' ) ),

				Select::make( esc_html__( 'Order Success Page', 'lifeline-donation-pro' ), 'success_page' )
				->setOptions(
					wpcm_posts_data(
						array(
							'post_type'      => 'page',
							'posts_per_page' => 100,
						)
					)
				)
				   ->setHelp( esc_html__( 'Choose the to show when an order is successfull', 'lifeline-donation-pro' ) ),

				Select::make( esc_html__( 'My Account Page', 'lifeline-donation-pro' ), 'my_account_page' )
				->setOptions(
					wpcm_posts_data(
						array(
							'post_type'      => 'page',
							'posts_per_page' => 100,
						)
					)
				)
				   ->setHelp( esc_html__( 'Choose the my account page', 'lifeline-donation-pro' ) ),

				Switcher::make( esc_html__( 'Redirect to Checkout', 'lifeline-donation-pro' ), 'redirect_to_checkout' )
					   ->setHelp( esc_html__( 'Redirect user to checkout page after add to cart', 'lifeline-donation-pro' ) ),
			)
		),
	),
	array(
		'title'    => esc_html__( 'Emails', 'lifeline-donation-pro' ),
		'icon'     => 'el-icon-message',
		'id'       => 'emails_settings',
		'children' => array(
			apply_filters(
				'webinane_commerce/settings/email_general_settings',
				array(
					'id'      => 'email_genera_settings',
					'title'   => esc_html__( 'General', 'lifeline-donation-pro' ),
					'heading' => esc_html__( 'Email General Settings', 'lifeline-donation-pro' ),
					'fields'  => array(
						Text::make( esc_html__( 'Form Name', 'lifeline-donation-pro' ), 'email_template_from_name' )
							->default( get_bloginfo( 'name' ) )
							->setHelp( esc_html__( 'How the sender name appears in the outgoing Emails', 'lifeline-donation-pro' ) ),
						Text::make( esc_html__( 'Form Email', 'lifeline-donation-pro' ), 'email_template_from_email' )
							->default( get_option( 'admin_email' ) )
							->setHelp( esc_html__( 'How the sender email appears in the outgoing Emails', 'lifeline-donation-pro' ) ),
						Media::make( esc_html__( 'Header Logo', 'lifeline-donation-pro' ), 'customer_email_header_logo' )
							->setAddText( esc_html__( 'Add Logo', 'lifeline-donation-pro' ) )
							->setUpdateText( esc_html__( 'Change Logo', 'lifeline-donation-pro' ) )
							->setHelp( esc_html__( 'Choose the logo you want to show in the email header', 'lifeline-donation-pro' ) ),
						Text::make( esc_html__( 'Footer Text', 'lifeline-donation-pro' ), 'email_template_footer_text' )
							->default( '{{site_name}} &mdash; Built with {{LifelineDonation}}' )
							->setHelp( esc_html__( 'The text appears in the footer of all the emails', 'lifeline-donation-pro' ) ),
						Media::make( esc_html__( 'Footer Logo', 'lifeline-donation-pro' ), 'customer_email_footer_logo' )
							->setAddText( esc_html__( 'Add Logo', 'lifeline-donation-pro' ) )
							->setUpdateText( esc_html__( 'Change Logo', 'lifeline-donation-pro' ) )
							->setHelp( esc_html__( 'Choose the logo you want to show in the email footer', 'lifeline-donation-pro' ) ),
						Color::make( __( 'Base Color', 'lifeline-donation-pro' ), 'email_template_base_color' )
							->setHelp( esc_html__( 'Choose the base color for email template', 'lifeline-donation-pro' ) )
							->default( '#2f88e4' ),
						Color::make( __( 'Background Color', 'lifeline-donation-pro' ), 'email_template_bg_color' )
							->setHelp( esc_html__( 'Choose the background color for email template', 'lifeline-donation-pro' ) )
							->default( '#f7f7f7' ),
						Color::make( __( 'Body Background Color', 'lifeline-donation-pro' ), 'email_template_body_bg_color' )
							->setHelp( esc_html__( 'Choose the body background color for email template', 'lifeline-donation-pro' ) )
							->default( '#ffffff' ),
						Color::make( __( 'Body Text color', 'lifeline-donation-pro' ), 'email_template_body_text_color' )
							->setHelp( esc_html__( 'Choose the body text color for email template', 'lifeline-donation-pro' ) )
							->default( '#3c3c3c' ),

					),
				)
			),
			apply_filters(
				'webinane_commerce/settings/customer_email_settings',
				array(
					'id'      => 'customer_email_settings',
					'title'   => esc_html__( 'Customer Email', 'lifeline-donation-pro' ),
					'heading' => esc_html__( 'Email Setting for Customers', 'lifeline-donation-pro' ),
					'fields'  => array(

						Text::make( __( 'Subject', 'lifeline-donation-pro' ), 'customer_email_subject' )
							->setHelp( sprintf( __( 'Enter the subject for customer\'s email. You can use placeholders %s', 'lifeline-donation-pro' ), $email_tpl_placeholders ) ),
						Text::make( esc_html__( 'Greeting Text', 'lifeline-donation-pro' ), 'customer_email_greeting_text' )
							->default( 'Thanks for your Donation!' )
							->setHelp( esc_html__( 'Enter the greeting text of the email', 'lifeline-donation-pro' ) ),
						Textarea::make( esc_html__( 'Email Body', 'lifeline-donation-pro' ), 'customer_email_body' )
							->withMeta( array( 'rows' => 8 ) )
							->setHelp( sprintf( __( 'You can use HTML Tags. You can use the placeholders %s', 'lifeline-donation-pro' ), $email_tpl_placeholders ) ),
						Switcher::make( esc_html__( 'Show Customer Detail', 'lifeline-donation-pro' ), 'customer_email_show_customer_detail' )
							->default( true )
							->setHelp( esc_html__( 'Whether to show the customer\' detail in email', 'lifeline-donation-pro' ) ),
						Switcher::make( esc_html__( 'Show Item Detail', 'lifeline-donation-pro' ), 'customer_email_show_item_info' )
							->default( true )
							->setHelp( esc_html__( 'Whether to show the item or donation detail in email', 'lifeline-donation-pro' ) ),

					),
				)
			),
			apply_filters(
				'webinane_commerce/settings/owner_email_settings',
				array(
					'id'      => 'owner_email_settings',
					'title'   => esc_html__( 'Admin Email', 'lifeline-donation-pro' ),
					'heading' => esc_html__( 'Email Setting for Admin', 'lifeline-donation-pro' ),
					'fields'  => array(

						Text::make( __( 'Subject', 'lifeline-donation-pro' ), 'admin_email_subject' )
							->setHelp( sprintf( __( 'Enter the subject for admin\'s email. You can use placeholders %s', 'lifeline-donation-pro' ), $email_tpl_placeholders ) ),
						Text::make( esc_html__( 'Greeting Text', 'lifeline-donation-pro' ), 'admin_email_greeting_text' )
							->default( 'Thanks for your Donation!' )
							->setHelp( esc_html__( 'Enter the greeting text of the email', 'lifeline-donation-pro' ) ),
						Textarea::make( esc_html__( 'Email Body', 'lifeline-donation-pro' ), 'admin_email_body' )
							->withMeta( array( 'rows' => 8 ) )
							->setHelp( sprintf( __( 'You can use HTML Tags. You can use the placeholders %s', 'lifeline-donation-pro' ), $email_tpl_placeholders ) ),
					),
				)
			),
		),
	),

);
