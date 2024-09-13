<?php
/**
 * Plugin Name:     Lifeline Donation Pro
 * Plugin URI:      https://webinane.com/plugins/donation
 * Description:     A WordPress plugin to collect online donations using various payment gateways. Lifeline Donation comes with beautiful donations popups and forms. Admin can see various statistics of donations.
 * Author:          Webinane
 * Author URI:      https://webinane.com
 * Text Domain:     lifeline-donation-pro
 * Domain Path:     /languages
 * Version:         2.2.1
 *
 * @package         Lifeline_Donation
 */

defined( 'LIFELINE_DONATION_PATH' ) || define( 'LIFELINE_DONATION_PATH', plugin_dir_path( __FILE__ ) );
defined( 'LIFELINE_DONATION_FILE' ) || define( 'LIFELINE_DONATION_FILE', __FILE__ );
defined( 'LIFELINE_DONATION_URL' ) || define( 'LIFELINE_DONATION_URL', plugin_dir_url( __FILE__ ) );
defined( 'WNCM_URL' ) || define( 'WNCM_URL', plugin_dir_url( __FILE__ ) . 'wpcm/' );

require_once LIFELINE_DONATION_PATH . 'includes/freemius.php';
require_once LIFELINE_DONATION_PATH . 'vendor/autoload.php';
require_once LIFELINE_DONATION_PATH . 'includes/Classes/Hooks.php';

add_action('plugins_loaded', function() {

	load_plugin_textdomain( 'lifeline-donation-pro', false, basename( dirname( __FILE__ ) ) . '/languages' );
}, 2);

add_action( 'webinane_commerce_loaded', 'lifeline_donation_init' );

/**
 * Webinane donation main init hooked up with commerce loading.
 *
 * @return void
 */
function lifeline_donation_init() {
	require_once LIFELINE_DONATION_PATH . 'includes/load.php';

	Lifeline_Donation_Loader::init();
}

/**
 * REgister plugin activation hook.
 */
register_activation_hook(
	LIFELINE_DONATION_FILE,
	['LifelineDonation\Classes\Hooks', 'activation']
);

add_action( 'upgrader_process_complete', ['LifelineDonation\Classes\Hooks', 'upgrade_process'],10, 2);

(new \LifelineDonation\Classes\Hooks)->init();

/**
 * Css variable
 */
add_action('wp_head', function(){
    $settings = wpcm_get_settings();
    $color_scheme = $settings->get( 'general_setting_color_scheme', '#2f88e4' );
    $allowed_html = wp_kses_allowed_html();
    if ( $color_scheme ) {
        $data = '';
        $data .= "body{--ldp-primary-color: {$color_scheme};}";
        printf(
            "<style id='ldp-css-variable'>%s</style>",
            $data,
        );
    }
}, 3);