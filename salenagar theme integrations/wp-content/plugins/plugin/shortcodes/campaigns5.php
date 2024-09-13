<?php
namespace LifelineDonation\Shortcodes;

use LifelineDonation\Shortcodes\Shortcodes;

class Campaigns5 extends Shortcodes
{
	static function init() {
		self::$shortcode = 'wi_donation_campaigns5';
		self::$vc_map = self::vc_map();
		parent::init();

	}

	static function vc_map() {
		return [
			"name" => esc_html__("Campaign Style 5", 'lifeline-donation-pro'),
            "base" => self::$shortcode,
            "icon" => LIFELINE_DONATION_URL . 'assets/images/icon.png',
            "category" => self::$category,
            'html_template' => self::get_template_path(),
            "params" => array(
                 array(
                    'type'              => 'dropdown',
                    'class'             => '',
                    'heading'           => esc_html__( 'Select Post Type', 'lifeline-donation-pro' ),
                    'param_name'        => 'post',
                    'value'             => array( esc_html__( 'Causes', 'lifeline-donation-pro' ) => 'cause',esc_html__( 'Projects', 'lifeline-donation-pro' ) => 'project'  ),
                    'description'       => esc_html__( 'Select post type which you wants to show in this section', 'lifeline-donation-pro' )
                ),

                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => esc_html__( "Number", 'lifeline-donation-pro' ),
                    "param_name"  => "num",
                    "description" => esc_html__( "Enter the number of events to show in this section", 'lifeline-donation-pro' )
                ),
                array(
                    "type"        => "checkbox",
                    "class"       => "",
                    "heading"     => esc_html__( 'Select Categories', 'lifeline-donation-pro' ),
                    "param_name"  => "cat1",
                    "value"       => array_flip( webinane_donation_get_categories( array( 'taxonomy' => 'cause_cat', 'hide_empty' => FALSE, 'show_all' => true ), true ) ),
                    "description" => esc_html__( 'Choose cause categories for which cause you wants to show', 'lifeline-donation-pro' ),
                    'dependency'  => array(
                        'element' => 'post',
                        'value'   => array( 'cause' )
                    ),
                ),
                 array(
                    "type"        => "checkbox",
                    "class"       => "",
                    "heading"     => esc_html__( 'Select Categories', 'lifeline-donation-pro' ),
                    "param_name"  => "cat2",
                    "value"       => array_flip( webinane_donation_get_categories( array( 'taxonomy' => 'project_cat', 'hide_empty' => FALSE, 'show_all' => true ), true ) ),
                    "description" => esc_html__( 'Choose project categories for which projects you wants to show', 'lifeline-donation-pro' ),
                    'dependency'  => array(
                        'element' => 'post',
                        'value'   => array( 'project' )
                    ),
                ),
                array(
                    'type'              => 'dropdown',
                    'class'             => '',
                    'heading'           => esc_html__( 'Order', 'lifeline-donation-pro' ),
                    'param_name'        => 'order',
                    'value'             => array( esc_html__( 'Ascending', 'lifeline-donation-pro' ) => 'ASC',esc_html__( 'Descending', 'lifeline-donation-pro' ) => 'DESC'  ),
                    'description'       => esc_html__( 'Select sorting order ascending or descending for blog listing', 'lifeline-donation-pro' )
                ),
                 array( 
        			'type'              => 'checkbox',
        			'class'             => '',
        			'group'             => esc_html__( 'Button', 'lifeline-donation-pro' ),
        			'param_name'        => 'button',
        			'value'             => array( 'Enable Button' => 'true' ),
        			'description'       => esc_html__( 'Enable to show button.', 'lifeline-donation-pro' ),
        		),
                array(
    				'type'       => 'textfield',
    				'heading'    => esc_html__( 'Button Label', 'lifeline-donation-pro' ),
    				'param_name' => 'button_label',
    				'group'      => esc_html__( 'Button', 'lifeline-donation-pro' ),
    				'value'      => esc_html__( 'Donate Us', 'lifeline-donation-pro' ),
    				 'dependency'  => array(
    					'element'  => 'button',
    					'value'    => 'true',
    				),
    			),
    			array(
                    "type"        => "dropdown",
                    "class"       => "",
                    "heading"     => esc_html__('Action', 'lifeline-donation-pro'),
                    "param_name"  => "action",
                    'group'       => esc_html__( 'Button', 'lifeline-donation-pro' ),
                    "description" => esc_html__('Choose whether to show donation popup or link to a page', 'lifeline-donation-pro'),
                    'value'		  => array(
                    	esc_html__( 'Show Donation Popup', 'lifeline-donation-pro' ) => 'popup',
                    	esc_html__( 'Redirect to post details page', 'lifeline-donation-pro' ) => 'detail',
                    ),
                    'dependency'  => array(
    					'element' => 'button',
    					'value'   => 'true',
    				),
                ),
                array(
    				'type'       => 'textfield',
    				'heading'    => esc_html__( 'Button  Label', 'lifeline-donation-pro' ),
    				'param_name' => 'btn_label',
    				'group'      => esc_html__( 'Button', 'lifeline-donation-pro' ),
    				'value'      => esc_html__( 'Donation', 'lifeline-donation-pro' ),
    				 'dependency'  => array(
    					'element'  => 'button',
    					'value'    => 'true',
    				),
    			),

	
            )
			
		];
	}

}

Campaigns5::init();