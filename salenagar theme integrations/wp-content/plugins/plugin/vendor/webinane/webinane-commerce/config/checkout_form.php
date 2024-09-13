<?php

return array(

	array(
		'title'			=> esc_html__( 'WP Commerce', 'lifeline-donation-pro' ),
		'id'			=> 'wpcommerce_frontend_checkout_form_customer_info',
		'object_types'	=> array('none'),
		'hookup'		=> false,
		'save_fields'	=> false,
		'fields'		=> apply_filters( 'wpcm_frotend_checkout_form_cutomer_info', array(
			array(
				'name'       => esc_html__( 'First Name', 'lifeline-donation-pro' ),
				'desc'       => esc_html__( 'Enter the first name', 'lifeline-donation-pro' ),
				'id'         => 'first_name',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Last Name', 'lifeline-donation-pro' ),
				'desc'       => esc_html__( 'Please enter your last name', 'lifeline-donation-pro' ),
				'id'         => 'last_name',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Address Line 1', 'lifeline-donation-pro' ),
				'desc'       => esc_html__( 'Enter the store address', 'lifeline-donation-pro' ),
				'id'         => 'address_line_1',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Address Line 2', 'lifeline-donation-pro' ),
				'desc'       => esc_html__( 'Enter the store address', 'lifeline-donation-pro' ),
				'id'         => 'address_line_2',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'City', 'lifeline-donation-pro' ),
				'desc'       => esc_html__( 'Enter the store city', 'lifeline-donation-pro' ),
				'id'         => 'city',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Base Country', 'lifeline-donation-pro' ),
				'desc'       => esc_html__( 'Choose the base country', 'lifeline-donation-pro' ),
				'id'         => 'base_country',
				'type'       => 'select',
				'options'	 => wpcm_countries()->toArray()
			),
			array(
				'name'       => esc_html__( 'Postcode / ZIP', 'lifeline-donation-pro' ),
				'desc'       => esc_html__( 'Enter the postcode or ZIP', 'lifeline-donation-pro' ),
				'id'         => 'zip',
				'type'       => 'text',
			),

		))
	),
);
