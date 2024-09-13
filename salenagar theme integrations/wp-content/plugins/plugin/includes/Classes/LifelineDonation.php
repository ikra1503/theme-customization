<?php
/**
 * Lifeline Donation file.
 *
 * @package WordPress
 */

namespace LifelineDonation\Classes;

/**
 * Lifeline Donation class.
 */
class LifelineDonation {

	public static $version = '1.1.2.2';
	/**
	 * Init methods.
	 *
	 * @return void
	 */
	public static function init() {
		/**
		 * Hooked up to print custom markup in donation popup.
		 */

		add_filter('webinane_commerce/settings/menu_label', function($label) {
			return esc_html__('Lifeline Donation', 'lifeline-donation-pro');
		});
		add_filter('webinane_commerce/settings/page_heading', function($label) {
			return esc_html__('Lifeline Donation Settings', 'lifeline-donation-pro');
		});
		add_filter('webinane_commerce/settings/menu_icon', function($label) {
			return 'dashicons-smiley';
		});
		
	}
}
