<?php

namespace WebinaneCommerce;

use WebinaneCommerce\Admin\Install;
use WebinaneCommerce\Classes\Ajax;
use WebinaneCommerce\Classes\DashboardWidgets;
use WebinaneCommerce\Classes\Emails;
use WebinaneCommerce\Classes\ExportOrders;
use WebinaneCommerce\Classes\Metaboxes;
use WebinaneCommerce\Classes\Orders;
use WebinaneCommerce\Classes\RestRoutes;
use WebinaneCommerce\Classes\TaxonomyMetaboxes;
use WebinaneCommerce\Classes\Webinane;
use WebinaneCommerce\Libraries\ClassLoader;

final class Loader
{
	static function init() {
		self::defines();
		self::includes();
		self::start();
	}

	/**
	 * Defind constants.
	 * @return [type] [description]
	 */
	static function defines() {
		defined('WPCM_SETTINGS_KEY') || define('WPCM_SETTINGS_KEY', '_wpcommerce_settings	');
		defined('WPCM_AJAX_ACTION') || define('WPCM_AJAX_ACTION', '_wpcm_ajax');
		defined('WPCM_GLOBAL_KEY') || define('WPCM_GLOBAL_KEY', 'WPCM_GLOBAL_KEY');
		defined('WPCM_VERSION') || define('WPCM_VERSION', '2.2.1');
	}

	static function includes() {
		require_once WNCM_PATH . 'includes/Functions.php';
	}

	/**
	 * Start the application.
	 *
	 * @return [type] [description]
	 */
	static function start() {

		register_activation_hook( WNCM_FILE, array( Install::class, 'init' ), 1000 );
		add_action('plugins_loaded', array(Webinane::class, 'plugins_loaded' ), 10 );
		add_action('after_setup_theme', array(Webinane::class, 'init' ), 1000 );

		add_action('init', array(Webinane::class, 'wpInit') );

		add_action('wp_ajax_' . WPCM_AJAX_ACTION, [Ajax::class, 'init']);
		add_action('wp_ajax_nopriv_' . WPCM_AJAX_ACTION, [Ajax::class, 'init']);

		Orders::init();
		ExportOrders::init();
		DashboardWidgets::init();
		Emails::init();
		RestRoutes::init();

		Metaboxes::register();
		Metaboxes::init();

		TaxonomyMetaboxes::register();
		TaxonomyMetaboxes::init();
	}
}

Loader::init();
