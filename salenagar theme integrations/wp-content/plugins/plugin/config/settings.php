<?php
return array(

	array(
		'title'			=> esc_html__( 'Donations', 'lifeline-donation-pro' ),
		'icon'			=> 'el-icon-umbrella',
		'id'			=> 'donation_settings',
		'children'		=> apply_filters('lifeline_donation/settings', array()),
	),
);