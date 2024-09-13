<?php
/**
 * Lifeline Donation
 *
 * @package WordPress
 */

use Illuminate\Support\Arr;
use WebinaneCommerce\Fields\Select;
use WebinaneCommerce\Classes\Orders;
use WebinaneCommerce\Classes\Customers;
use WebinaneCommerce\Models\OrderItems;
use LifelineDonation\Classes\DonationForm;
use LifelineDonation\Classes\SingleDonation;
use LifelineDonation\Classes\GeneralDonation;
use LifelineDonation\Classes\LifelineDonation;
use LifelineDonation\Classes\DbUpgradeFromThree;
use Rakit\Validation\Validator;

/**
 * Webinane Donation main class.
 */
class Lifeline_Donation {



	/**
	 * Init method.
	 *
	 * @return void [description]
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue' ), 1000 );

		add_filter( 'wpcommerce_admin_orders_metabox_title', array( __CLASS__, 'donation_metabox_title' ) );
		add_filter( 'wpcommerce_settings', array( __CLASS__, 'settings' ) );

		add_filter( 'manage_cause_posts_columns', array( __CLASS__, 'cpt_columns' ) );
		add_filter( 'manage_project_posts_columns', array( __CLASS__, 'cpt_columns' ) );
		add_action( 'manage_posts_custom_column', array( __CLASS__, 'custom_columns' ) );

		add_filter( 'wpcommerce_metabox_fields_supported_post_types', array( __CLASS__, 'get_supported_post_types' ) );

		add_shortcode( 'webinane_donation_page', array( __CLASS__, 'shortcode_donation_page' ) );

		add_action( 'wp_ajax_webinane_donation_admin_order_data', array( __CLASS__, 'admin_order_data' ) );
		self::image_sizes();

		add_filter(
			'wpcm_orders_admin_menu_label',
			function ( $label ) {
				return esc_html__( 'Donations', 'lifeline-donation-pro' );
			}
		);
		add_filter(
			'wpcm_order_admin_menu_label',
			function ( $label ) {
				return esc_html__( 'Donation', 'lifeline-donation-pro' );
			}
		);
		add_filter(
			'wpcm_price_label',
			function ( $label ) {
				return esc_html__( 'Donation', 'lifeline-donation-pro' );
			}
		);

		add_action( 'wpcm_new_order_process_meta', array( __CLASS__, 'update_donation_meta' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_enqueue' ) );

		add_filter( 'webinane_commerce/settings/display_settings', array( __CLASS__, 'display_settings' ) );

		add_filter(
			'lifeline_donation/settings',
			function ( $settings ) {
				$settings[] = include LIFELINE_DONATION_PATH . 'config/donation_settings.php';
				$settings[] = include LIFELINE_DONATION_PATH . 'config/general_popup.php';
				$settings[] = include LIFELINE_DONATION_PATH . 'config/posttype_popup.php';
				$settings[] = include LIFELINE_DONATION_PATH . 'config/menu_button.php';
				$settings[] = include LIFELINE_DONATION_PATH . 'config/archive_setting.php';

				return $settings;
			}
		);

		(new DonationForm)->boot();

		add_action( 'wp_ajax_lifeline_donation_donate_now', array( __CLASS__, 'donate_now' ) );
		add_action( 'wp_ajax_nopriv_lifeline_donation_donate_now', array( __CLASS__, 'donate_now' ) );

		add_filter( 'wi_posts_title', array(__CLASS__, 'wi_post_type_filter') );

		add_action('webinane_commerce_settings_saved', function($settings) {
			if ( array_get($settings, 'donation_multicurrency') && array_get($settings, 'selective_currency') ) {
				delete_transient('lifeline_donation_pro_exchange_rates');
			}
		});
	}


	/**
	 * Add image sizes.
	 *
	 * @return void [description]
	 */
	public static function image_sizes() {
		add_image_size( 'wi_donation_460x490', 460, 490, true );
		add_image_size( 'wi_donation_350x270', 350, 270, true );
		add_image_size( 'wi_donation_370x475', 370, 475, true );
		add_image_size( 'wi_donation_540x380', 540, 380, true );
		add_image_size( 'wi_donation_504x305', 504, 305, true );
	}

	/**
	 * Donation modal enquque scripts and styles.
	 *
	 * @return void [description]
	 */
	public static function enqueue() {
		wp_enqueue_style( array( 'wpcommerce_main' ) );
		global $post;

		$settings = wpcm_get_settings();

		$min        = ( ! WP_DEBUG ) ? '.min' : '';
		$version  = ( WP_DEBUG ) ? time() : LifelineDonation::$version;
		$show_style = array_get( $settings, 'donation_enable_plugin_css', true );
		$show_style = ( 'false' === $show_style || ! $show_style ) ? false : $show_style;
		$show_style = apply_filters( 'webinane_donation_load_plugin_style', $show_style, $settings );

		wp_enqueue_style('lifeline-donation-google-fonts', 'https://fonts.googleapis.com/css?family=Manrope%3A400%2C700%2C900%7CZilla+Slab%3A400%2C700%2C900');
		if ( $show_style ) {
			wp_enqueue_style( 'lifeline-donation-syle', LIFELINE_DONATION_URL . 'assets/css/style' . $min . '.css', array(), LifelineDonation::$version );
		}

		wp_register_style( 'webinane-shortcodes', LIFELINE_DONATION_URL . 'assets/css/webinane-shortcodes' . $min . '.css', array(), LifelineDonation::$version );
		wp_register_style( 'webinane-flat-icon', LIFELINE_DONATION_URL . 'assets/css/flaticon.css', array(), LifelineDonation::$version );

		wp_register_script( 'knob', LIFELINE_DONATION_URL . 'assets/js/jquery.knob.js', array( 'jquery' ), LifelineDonation::$version, true );
		wp_register_script( 'select2', LIFELINE_DONATION_URL . 'assets/js/select2.min.js', array( 'jquery' ), LifelineDonation::$version, true );
		wp_register_script( 'lifeline-donation-modal', LIFELINE_DONATION_URL . 'assets/js/index.js', array( 'element-ui-en', 'vuex', 'knob', 'select2' ), $version, true );
		wp_register_script( 'Youplyer', LIFELINE_DONATION_URL . 'assets/js/jquery.youtube-background.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'counterup', LIFELINE_DONATION_URL . 'assets/js/jquery.counterup.min.js', array( 'jquery' ) , '' , true );
		wp_register_script( 'waypoints', LIFELINE_DONATION_URL . 'assets/js/waypoints.js', array( 'jquery' ), '' , true );
		wp_register_script( 'owl-carousel', LIFELINE_DONATION_URL . 'assets/js/owl.carousel.min.js', array( 'jquery' ), LifelineDonation::$version  , true  );
		wp_register_script( 'lifeline-donation-script', LIFELINE_DONATION_URL . 'assets/js/script.js', array( 'jquery' ), LifelineDonation::$version  , true );


		wp_enqueue_script( array( 'wp-i18n', 'underscore', 'lifeline-donation-modal' ) );
		wp_set_script_translations( 'lifeline-donation-modal', 'lifeline-donation-pro', LIFELINE_DONATION_PATH . 'languages' );

		wp_localize_script(
			'jquery',
			'lifeline_donation',
			array(
				'eventBus' => array(),
				'ajaxurl'  => admin_url( 'admin-ajax.php' ),
				'homeurl'  => esc_url( home_url('/') ),
				'nonce'    => wp_create_nonce( 'LIFELINE_DONATION' ),
				'exchange_rates'	=> self::exchange_rates(),
				'required_strings'	=> [
					'payment_method' => esc_html__( 'Please select the payment method', 'lifeline-donation-pro' ),
					'first_name' => esc_html__( 'First name is required', 'lifeline-donation-pro' ),
					'last_name' => esc_html__( 'Last name is required', 'lifeline-donation-pro' ),
					'address' => esc_html__( 'Addres is required', 'lifeline-donation-pro' ),
					'email' => esc_html__( 'Email is required and must be a valid email', 'lifeline-donation-pro' ),
				],
			)
		);
	}

	/**
	 * Get exchange rates.
	 */
	protected static function exchange_rates() {
		$settings = wpcm_get_settings();

		$base_currency = $settings->get('base_currency', 'USD');

		$return = [ $base_currency => 1 ];

		if ( $settings->get('donation_multicurrency') && $settings->get('selective_currency') ) {

			$transient = get_transient('lifeline_donation_pro_exchange_rates');

			if ( $transient === false ) {
				$response = webinane_exchange_rates( implode(',', $settings->get('selective_currency')), $base_currency);
				if ( array_get( $response, 'base') ) {
					set_transient('lifeline_donation_pro_exchange_rates', $response['rates'], DAY_IN_SECONDS );
					return $response['rates'];
				}
			} else {
				return $transient;
			}
		}

		return $return;
	}
	/**
	 * [fontend_donation_form_data description]
	 *
	 * @return void [description]
	 */
	public static function fontend_donation_form_data() {
		$_post = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

		$nonce = sanitize_text_field( webinane_set( $_post, 'nonce' ) );

		if ( ! wp_verify_nonce( $nonce, WPCM_GLOBAL_KEY ) ) {
			wp_send_json(
				array(
					'success' => false,
					'message' => esc_html__(
						'Security verification failed',
						'lifeline-donation-pro'
					),
				),
				403
			);
		}

		if ( array_get( $_post, 'type' ) == 'general' ) {
			GeneralDonation::instance()->getData( $_post );
		} else {
			SingleDonation::instance()->getData( $_post );
		}

	}

	/**
	 * Get currency symbol.
	 *
	 * @return void [description]
	 */
	public static function currency_symbol() {
		$_post = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
		if ( ! sanitize_text_field( webinane_set( $_post, 'currency' ) ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'No currency data provided', 'lifeline-donation-pro' ) ) );
		}

		$currency   = sanitize_text_field( webinane_set( $_post, 'currency' ) );
		$currencies = webinane_array( webinane_currencies() );

		$symbol = $currencies->filter(
			function ( $value ) use ( $currency ) {
				return $value['iso']['code'] == $currency;
			}
		)->first();

		$symbol = array_get( $symbol, 'units.major.symbol', '$' );
		wp_send_json_success( $symbol );
	}
	/**
	 * Donate now.
	 *
	 * @return void [description]
	 */
	public static function donate_now() {
		$_post = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

		$nonce = sanitize_text_field( webinane_set( $_post, 'nonce' ) );

		if ( ! wp_verify_nonce( $nonce, 'LIFELINE_DONATION' ) ) {
			wp_send_json(
				array(
					'success' => false,
					'message' => esc_html__(
						'Security verification failed',
						'lifeline-donation-pro'
					),
				),
				403
			);
		}
		$validator = new Validator();

		$validation = $validator->make(
			$_post,
			array(
				'info.first_name' => 'alpha_spaces|required',
				'info.last_name'  => 'alpha_spaces|required',
				'info.email'      => 'email|required',
				// 'info.phone'            => 'regex:/^\+[0-9]/|required',
				'info.address'    => 'regex:/^(\w*\s*[\#\-\,\/\.\(\)\&]*)+/|required',
				'amount'          => 'numeric|required|min:1',
				'gateway'         => 'required|regex:/[A-Za-z0-9_]/',
			)
		);
		$validation->setAlias( 'info.first_name', esc_html__( 'First Name', 'lifeline-donation-pro' ) );
		$validation->setAlias( 'info.last_name', esc_html__( 'Last Name', 'lifeline-donation-pro' ) );
		$validation->setAlias( 'info.email', esc_html__( 'Email', 'lifeline-donation-pro' ) );
		$validation->setAlias( 'info.phone', esc_html__( 'Phone', 'lifeline-donation-pro' ) );
		$validation->setAlias( 'info.address', esc_html__( 'Address', 'lifeline-donation-pro' ) );

		$validation->validate();

		if ( $validation->fails() ) {
			$errors = $validation->errors();
			wp_send_json_error( array( 'messages' => $errors->all() ), 403 );
		}

		$type = Arr::get( $_post, 'type' );
		if ( 'general' === $type ) {
			GeneralDonation::instance()->donateNow( $_post );
		} else {
			SingleDonation::instance()->donateNow( $_post );
		}
	}

	/**
	 * Metabox title.
	 *
	 * @return [type] [description]
	 */
	public static function donation_metabox_title() {
		return esc_html__( 'Donation Setting', 'lifeline-donation-pro' );
	}

	/**
	 * Load settings.
	 *
	 * @param [type] $settings [description].
	 *
	 * @return [type]           [description]
	 */
	public static function settings( $settings ) {
		$donation_settings = include LIFELINE_DONATION_PATH . 'config/settings.php';
		$settings          = array_merge( $settings, $donation_settings );
		return $settings;
	}

	/**
	 * Display settings.
	 *
	 * @param [type] $settings [description].
	 *
	 * @return [type]           [description]
	 */
	public static function display_settings( $settings ) {
		$_setting = array(
			Select::make(
				esc_html__( 'Donation History Page', 'lifeline-donation-pro' ),
				'donors_donation_listing_page'
			)->setOptions(
				wpcm_posts_data(
					array(
						'post_type'      => 'page',
						'posts_per_page' => 100,
					)
				)
			)
		->setHelp(
			esc_html__( 'This page shows a complete donation history for the specific user. The donation history "shortcode should be on this page."', 'lifeline-donation-pro' )
		),
		);
		$settings = array_merge( (array) $settings, $_setting );

		foreach ( $settings as $key => $value ) {
			if ( in_array( $value->attribute, array( 'checkout_page', 'redirect_to_checkout' ) ) ) {
				unset( $settings[ $key ] );
			}
		}

		return array_values( $settings );
	}

	/**
	 * Custom post types columns.
	 *
	 * @param [type] $columns [description].
	 *
	 * @return [type]          [description]
	 */
	public static function cpt_columns( $columns ) {
		$mycol = array(
			'cb'        => '<input type="checkbox" />',
			'thumbnail' => '<span><span title="Thumbnail" class="dashicons dashicons-format-image"><span class="screen-reader-text">' . esc_html__( 'Thumbnail', 'lifeline-donation-pro' ) . '</span></span></span>',
		);

		$columns = array_merge( $mycol, $columns );

		$columns['collected'] = esc_html__( 'Collected', 'lifeline-donation-pro' );
		$columns['target']    = esc_html__( 'Target', 'lifeline-donation-pro' );

		return $columns;
	}

	/**
	 * Custom column
	 *
	 * @param [type] $column [description].
	 *
	 * @return [type]         [description]
	 */
	public static function custom_columns( $column ) {
		global $post, $wpdb;

		if ( ! in_array( $post->post_type, array( 'cause', 'project', 'product' ) ) ) {
			return;
		}

		switch ( $column ) {
			case 'thumbnail':
				echo get_the_post_thumbnail( $post, array( 50, 50 ) );
				break;
			case 'collected':
				$ids    = $post->ID;
				$orders = OrderItems::whereHas(
					'order',
					function ( $query ) use ( $ids ) {
						return $query->where( 'post_id', $ids )->status( 'completed' );
					}
				)->sum( 'price' );
				echo '<strong>' . webinane_currency_symbol() . '</strong>' . $orders;
				break;
			case 'target':
				$key_set = '';
				if ( $post->post_type == 'cause' ) {
					$key_set = 'causes_settings';
				}
				if ( $post->post_type == 'project' ) {
					$key_set = 'project_settings';
				}
				$meta = get_post_meta( $post->ID, $key_set, true );
				if ( webinane_set( $meta, 'donation' ) ) {
					echo '<strong>' . webinane_currency_symbol() . '</strong>' . webinane_set( $meta, 'donation' );
				} else {
					echo '<strong>' . webinane_currency_symbol() . '</strong> 0';
				}
				break;

		}
	}

	/**
	 * Hookup enabled post types
	 *
	 * @param [type] $post_types [description].
	 *
	 * @return [type]             [description]
	 */
	public static function get_supported_post_types( $post_types ) {
		if ( wpcm_get_settings()->get( 'donation_causes_status' ) ) {
			$post_types[] = 'cause';
		}

		if ( wpcm_get_settings()->get( 'donation_projects_status' ) ) {
			$post_types[] = 'project';
		}

		return $post_types;
	}

	/**
	 * Change the upgrade status after completion.
	 *
	 * @param [type] $status [description].
	 *
	 * @return [type]         [description]
	 */
	public static function db_upgrade_status( $status ) {
		$query = new WP_Query( array( 'post_type' => 'lif_causes' ) );

		if ( $query->have_posts() ) {
			$res = 'YES';
		} else {
			$res = 'NO';
		}
		wp_reset_postdata();

		return $res;
	}

	/**
	 * Finally run db update.
	 *
	 * @return void [description]
	 */
	public static function run_database_upgrade() {
		 DbUpgradeFromThree::init();
	}


	/**
	 * Shortcode Donation page.
	 *
	 * @param  array  $atts    Array of attributes.
	 * @param  string $content HTML content.
	 * @param  string $tag     shortcode name.
	 * @return string          Returns the output of shortcode.
	 */
	public static function shortcode_donation_page( $atts, $content = null, $tag ) {
		$atts = shortcode_atts(
			array(
				'id'    => 0,
				'style' => 1,
				'title' => '',
			),
			$atts
		);

		extract( $atts );

		if ( isset( $_GET['post_id'] ) ) {
			$id = sanitize_text_field( webinane_set( $_GET, 'post_id' ) );
		}

		wp_enqueue_script( array( 'lifeline-donation-modal' ) );

		$file = '';

		ob_start();

		if ( file_exists( $file ) ) {
			include $file;
			return ob_get_clean();
		} else {
			include LIFELINE_DONATION_PATH . 'templates/donation-templates/donation-page.php';
		}

		return ob_get_clean();
	}

	/**
	 * [new_donation_email_template description]
	 *
	 * @param [type] $template    [description].
	 * @param [type] $order       [description].
	 * @param [type] $customer_id [description].
	 *
	 * @return [type]              [description]
	 */
	public static function new_donation_email_template( $template, $order, $customer_id ) {
		 ob_start();
		include LIFELINE_DONATION_PATH . 'templates/emails/customer-new-donation.php';
		return ob_get_clean();
	}
	/**
	 * [new_donation_email_template description]
	 *
	 * @param [type] $template    [description].
	 * @param [type] $order       [description].
	 * @param [type] $customer_id [description].
	 *
	 * @return [type]              [description]
	 */
	public static function new_donation_admin_email_template( $template, $order, $customer_id ) {
		ob_start();
		include LIFELINE_DONATION_PATH . 'templates/emails/owner-new-donation.php';
		return ob_get_clean();
	}

	/**
	 * [update_donation_meta description]
	 *
	 * @param [type] $data  [description].
	 * @param [type] $order [description].
	 *
	 * @return void        [description]
	 */
	public static function update_donation_meta( $data, $order ) {
		$dropdown = array_get( $data, 'post_data.extras.dropdown' );
		if ( $dropdown ) {
			update_post_meta( $order->ID, '_donation_extra_dropdown', $dropdown );
		}
	}

	/**
	 * [admin_enqueue description]
	 *
	 * @return void [description]
	 */
	public static function admin_enqueue() {
		global $post_type;

		if ( 'orders' === $post_type ) {
			wp_enqueue_script( 'lifeline-donation', LIFELINE_DONATION_URL . 'assets/js/admin.js', array( 'vuejs' ), '1.0.3', true );
		}
	}

	/**
	 * [admin_order_data description]
	 *
	 * @return void [description]
	 */
	public static function admin_order_data() {
		 $_post = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
		$id     = absint( sanitize_text_field( array_get( $_post, 'id' ) ) );

		if ( $id ) {
			$meta = get_post_meta( $id, '_donation_extra_dropdown', true );

			wp_send_json_success( $meta );
		}
		wp_send_json_success( '' );
	}


	public static function preloader() {        ?>
		<div class="donation-modal-wraper"></div>
		<div class="donation-modal-preloader"><div class="my_loader"></div></div>
		<div class="donation-modal-box"></div>
		<?php
	}

	/**
	 * Post type filter
	 * 
	 * @return array
	 */
	public static function wi_post_type_filter( $posts_name = array() ) {

		$options = array();
		$posts = get_posts( array(
			'post_type'  => $posts_name,
		) );
	
		foreach ( $posts as $key => $post ) {
			$options[$post->ID] = get_the_title($post->ID);
		}
		return $options;
	}
	
}

Lifeline_Donation::init();
