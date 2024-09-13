<?php
namespace LifelineDonation\Shortcodes;

use LifelineDonation\Shortcodes\Shortcodes;

class Parallax_Simple extends Shortcodes
{

	static function init() {
		self::$shortcode = 'wi_donation_parallax_simple';
		self::$vc_map = self::vc_map();
		parent::init();
	}

	static function vc_map() {
		return [
			"name" => esc_html__("About Us", 'lifeline-donation-pro'),
            "base" => self::$shortcode,
            "icon" => 'about_blog.png',
            "category" => self::$category,
            "params" => array(
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Title", 'lifeline-donation-pro'),
                    "param_name" => "title",
                    "description" => esc_html__("Enter the title to show in about us section", 'lifeline-donation-pro')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Sub Title", 'lifeline-donation-pro'),
                    "param_name" => "sub_title",
                    "description" => esc_html__("Enter the sub title to show in about us section", 'lifeline-donation-pro')
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => esc_html__("Description", 'lifeline-donation-pro'),
                    "param_name" => "description",
                    "description" => esc_html__("Enter the description to show in about us section", 'lifeline-donation-pro')
                ),
                array(
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => esc_html__('Show Causes', 'lifeline-donation-pro'),
                    "param_name" => "causes",
                    "value" => array('Enable Causes' => 'true'),
                    "description" => esc_html__('Enable to show causes on this section', 'lifeline-donation-pro'),
                ),
                array(
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => esc_html__('Show Button', 'lifeline-donation-pro'),
                    "param_name" => "more_button",
                    "value" => array('Enable Button' => 'true'),
                    "description" => esc_html__('Enable to show read more button on this section', 'lifeline-donation-pro'),
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Button Label", 'lifeline-donation-pro'),
                    "param_name" => "label",
                    "description" => esc_html__("Enter the button label to show in this section", 'lifeline-donation-pro'),
                    "dependency" => array(
                        "element" => "more_button",
                        "value" => array("true")
                    ),
                ),
                array(
                 "type" => "textfield",
                 "class" => "",
                 "heading" => esc_html__("Button URL", 'lifeline-donation-pro'),
                 "param_name" => "button_url",
                 "description" => esc_html__("Enter the button url to show in this section", 'lifeline-donation-pro'),
                 "dependency" => array(
                  "element" => "more_button",
                  "value" => array("true")
              ),
             ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__('Media Type', 'lifeline-donation-pro'),
                    "param_name" => "media_type",
                    "value" => array(esc_html__('Image', 'lifeline-donation-pro') => 'image', esc_html__('Gallery', 'lifeline-donation-pro') => 'gallery', esc_html__('Slider', 'lifeline-donation-pro') => 'slider', esc_html__('Video', 'lifeline-donation-pro') => 'video'),
                    "description" => esc_html__("Select media type to show for this section", 'lifeline-donation-pro')
                ),
                array(
                    "type" => "attach_image",
                    "class" => "",
                    "heading" => esc_html__("Image", 'lifeline-donation-pro'),
                    "param_name" => "image",
                    "description" => esc_html__("Upload image to show in this section", 'lifeline-donation-pro'),
                    "dependency" => array(
                        "element" => "media_type",
                        "value" => array("image", "video")
                    ),
                ),
                array(
                    "type" => "attach_images",
                    "class" => "",
                    "heading" => esc_html__("Gallery/Slider Images", 'lifeline-donation-pro'),
                    "param_name" => "images",
                    "description" => esc_html__("Upload images to show images gallery/slider in this section", 'lifeline-donation-pro'),
                    "dependency" => array(
                        "element" => "media_type",
                        "value" => array("slider", "gallery")
                    ),
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Vimeo Video URL", 'lifeline-donation-pro'),
                    "param_name" => "url",
                    "description" => esc_html__("Enter the video url like 'https://vimeo.com/248072144' to show video in this section", 'lifeline-donation-pro'),
                    "dependency" => array(
                        "element" => "media_type",
                        "value" => array("video")
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__('Section Style', 'lifeline-donation-pro'),
                    "param_name" => "sect_style",
                    "value" => array(esc_html__('Old Style', 'lifeline-donation-pro') => 'old', esc_html__('New Style', 'lifeline-donation-pro') => 'new'),
                    "description" => esc_html__("Select section style", 'lifeline-donation-pro')
                ),
            )
			
		];
	}
}

Parallax_Simple::init();