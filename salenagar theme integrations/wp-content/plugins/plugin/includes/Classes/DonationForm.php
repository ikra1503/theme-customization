<?php
/**
 * Donation form.
 *
 * @package	LifelineDonation
 * @version 1.2
 */

namespace LifelineDonation\Classes;

use Illuminate\Support\Arr;
use LifelineDonation\Helpers\DonationData;
use WebinaneCommerce\Models\Post as ModelsPost;
use WeDevs\ORM\WP\Post;

/**
 * Donation form class.
 */
class DonationForm {
	use DonationData;

	public function boot() {
		add_action( 'wp_ajax_lifeline_donation_data', array( $this, 'ajax' ) );
		add_action( 'wp_ajax_nopriv_lifeline_donation_data', array( $this, 'ajax' ) );

		add_filter('lifeline_donation_form_style_1_components', array( $this, 'style_one_components' ), 10, 3 );
		add_filter('lifeline_donation_form_style_2_components', array( $this, 'style_two_components' ), 10, 3 );
		add_filter('lifeline_donation_form_style_3_components', array( $this, 'style_three_components' ), 10, 3 );
	}

	/**
	 * Boot function
	 *
	 * @return void
	 */
	public function ajax() {
		$style = esc_attr( Arr::get( $_POST, 'style', 1 ) );
		$id    = absint( Arr::get( $_POST, 'id' ) );

		$config = include LIFELINE_DONATION_PATH . 'config/modal.php';
		$config = apply_filters( 'lifeline_donation_form_config', $config );

		$current_config = Arr::get( $config, 'style' . $style, $config['style1'] );

		$components = apply_filters( "lifeline_donation_form_style_{$style}_components", [], $id, $current_config );
		wp_send_json_success(
			array(
				'components' => $components,
				'config'     => $current_config,
			)
		);
	}

	/**
	 * Stle one components.
	 *
	 * @param int $post_id Post id.
	 * @return array
	 */
	public function style_one_components( $components, $post_id, $config ) {
		$settings = wpcm_get_settings();
		$post = ModelsPost::find($post_id);
		$currencies = $this->getCurrencies();
		$color_scheme = $settings->get('general_setting_color_scheme', '#d8281b');
		// print_r($post->post_type);exit('rrrrrrr');
		return array(
			array(
				'is'    => 'lifeline-donation-info',
				'props' => array_merge(['class' => 'wpcm-col-sm-4', 'color_scheme' => $color_scheme], $this->donation_info( $post_id )),
				'slot'  => 'right_sidebar',
			),
			array(
				'is'    => 'lifeline-donation-box-title',
				'props' => array(
					'top_title'     => 
					'cause' == $post->post_type ? $settings->get( 'donation_Cpost_text' ) : $settings->get( 'donation_popup_text' ),
					'img'           => ( $settings->get( 'donation_general_bg' ) ) ? wp_get_attachment_url( $settings->get( 'donation_general_bg' ) ) : LIFELINE_DONATION_URL . 'assets/images/bg-style-1.jpg',
					'title'         => ( $post ) ? esc_attr( $post->post_title ) : $settings->get( 'donation_genral_title' ),
					'tagline'       => 'cause' == $post->post_type ? $settings->get( 'donation_Cpost_subtitle' ) : $settings->get( 'donation_genral_subtitle' ),
				),
				'slot'  => 'global_top',
			),
			array(
				'is'       => 'lifeline-donation-gateways',
				'props'    => $this->gateway_info(false),
				'slot'     => 'global_top',
				// 'children' => apply_filters( 'lifeline_donation_form_gateways_data', array() ),
			),
			array(
				'is'    => 'lifeline-donation-form',
				'props' => array_merge(array('class' => 'wpcm-col-sm-12'), $this->form_components( $post_id )),
				'slot'  => 'step_1_top',
			),
			array(
				'is'    => 'lifeline-donation-amount-box',
				'props' => ['class' => 'wpcm-col-sm-12', 'title'	=> esc_html__('Give a custom amount', 'lifeline-donation-pro'), 'custom_amount' => true, 'symbol' => webinane_currency_symbol(), 'symbols' => $this->currency_symbols( $currencies ),],
				'slot'  => 'step_1_bottom',
				'children'	=> array(
					array(
						'is' => 'lifeline-donation-next-btn', 
						'props' => array('class' => 'wpcm-proceed-btn', 'text' => esc_html__('Proceed', 'lifeline-donation-pro')),
						'slot'	=> 'in_box'
					)
				)
			),
			array(
				'is'    => 'lifeline-donation-billing-form',
				'props' => $this->billing_form(),
				'slot'  => 'step_2_top',
				'children'	=> apply_filters('lifeline_donation_billing_form_data', array())
			),
			array(
				'is'       => 'lifeline-donation-gateways',
				'props'    => array(
					'gateways'	=> wpcm_get_active_gateways( true ),
					'show_recurring' => false,
					'strings'        => array(),
					'class'			 => 'w-100',
					'default_gateway' => $settings->get('default_gateway')
				),
				'slot'     => 'step_2_top',
				'children' => apply_filters( 'lifeline_donation_form_gateways_data', array(
					array('is' => 'lifeline-donation-proceed-btn', 'props' => array('class' => 'w-50 d-inline-block', 'text' => esc_html__('Proceed', 'lifeline-donation-pro')), ),
					array('is' => 'lifeline-donation-back-btn', 'props' => array('class' => 'wpcm-back-btn w-50 d-inline-block', 'text' => esc_html__('Back', 'lifeline-donation-pro')), )
				) ),
			),
		);
	}

	/**
	 * Stle two components.
	 *
	 * @param int $post_id Post id.
	 * @return array
	 */
	public function style_two_components( $components, $post_id, $config ) {
		$settings = wpcm_get_settings();
		$post = ModelsPost::find($post_id);
		$currencies = $this->getCurrencies();
		return array(
			array(
				'is'       => 'lifeline-donation-gateways',
				'props'    => $this->gateway_info(false),
				'slot'     => 'global_top',
				// 'children' => apply_filters( 'lifeline_donation_form_gateways_data', array() ),
			),
			
			array(
				'is'    => 'lifeline-donation-heading',
				'props' => array('text' => esc_html__('Select Currency and Amount', 'lifeline-donation-pro'), 'tag' => 'h3', 'class' => 'wpcm-col-sm-12 wpcm-heading'),
				'slot'  => 'step_1_top',
			),
			array(
				'is'    => 'lifeline-donation-form',
				'props' => array_merge($this->form_components( $post_id ), array('class' => 'wpcm-col-sm-12', 'show_amounts' => false)),
				'slot'  => 'step_1_top',
				'children'	=> array(
					// array('is' => 'lifeline-donation-heading', 'slot' => 'donation_dropdowns', 'props' => array('tag' => 'h2', 'text' => 'Custom Donation Amount', 'class' => 'wpcm-custm-amnt-txt') )
				)
			),
			array(
				'is'    => 'lifeline-donation-amount-box',
				'props' => ['class' => 'wpcm-col-sm-12 wpcm-amt-box-with-predfd', 'custom_amount' => true, 'symbol' => webinane_currency_symbol(), 'symbols' => $this->currency_symbols( $currencies ),],
				'slot'  => 'step_1_bottom',
				'children'	=> array(
					array('is' => 'lifeline-donation-heading', 'slot' => 'before_title', 'props' => array('tag' => 'h2', 'text' => esc_html__('How much would you like to donate?', 'lifeline-donation-pro'), 'class' => 'wpcm-cstm-amt-txt') ),
					array('is' => 'lifeline-donation-heading', 'slot' => 'before_title', 'props' => array('tag' => 'h2', 'text' => ('Or enter custom amount'), 'class' => 'wpcm-cstm-amt-txt') ),
					array(
						'is' => 'lifeline-donation-predefined-amounts', 
						'props'	=> array( 
							'amounts'                => $this->getPredefinedAmount(),
							'symbols'                => $this->currency_symbols( $currencies ),
							'symbol'                 => webinane_currency_symbol(),
							'format_price'			=> array(
								'position' 	=> $settings->get('currency_position', 'left'),
								'sep' 		=> $settings->get('thousand_saparator', ''), // Thousand Separator
								'd_sep' 	=> $settings->get('decimal_separator', '.'), // Decimal separator
								'd_point' 	=> $settings->get('number_decimals', 0) // Decimal numbers
							),
						),
						'slot'					 => 'before_box'
					)
				)
			),
			array(
				'is'    => 'lifeline-donation-next-btn',
				'props' => array('text' => esc_html__('Proceed', 'lifeline-donation-pro'), 'class' => 'wpcm-next-btn'),
				'slot'  => 'step_1_bottom',
			),
			array(
				'is'    => 'lifeline-donation-billing-form',
				'props' => $this->billing_form(),
				'slot'  => 'step_2_top',
				'children'	=> apply_filters('lifeline_donation_billing_form_data', array())
			),
			array(
				'is'       => 'lifeline-donation-gateways',
				'props'    => array(
					'gateways'	=> wpcm_get_active_gateways( true ),
					'show_recurring' => false,
					'strings'        => array(),
					'class'			 => 'w-100',
					'default_gateway' => $settings->get('default_gateway')
				),
				'slot'     => 'step_2_top',
				'children' => apply_filters( 'lifeline_donation_form_gateways_data', array(
					array('is' => 'lifeline-donation-proceed-btn', 'props' => array('class' => 'w-50 d-inline-block', 'text' => esc_html__('Proceed', 'lifeline-donation-pro')), ),
					array('is' => 'lifeline-donation-back-btn', 'props' => array('class' => 'wpcm-back-btn w-50 d-inline-block', 'text' => esc_html__('Back', 'lifeline-donation-pro')), )
				) ),
			),
		);
	}

	/**
	 * Stle three components.
	 *
	 * @param int $post_id Post id.
	 * @return array
	 */
	public function style_three_components( $components, $post_id, $config ) {
		$settings = wpcm_get_settings();
		$post = ModelsPost::find($post_id);
		$currencies = $this->getCurrencies();
		return array(
			array(
				'is'    => 'lifeline-donation-heading',
				'props' => array('text' => esc_html__('Donate for Us', 'lifeline-donation-pro'), 'tag' => 'h2', 'class' => 'wpcm-heading'),
				'slot'  => 'global_top',
			),
			array(
				'is'       => 'lifeline-donation-gateways',
				'props'    => array_merge( array('class' => 'mb-4'), $this->gateway_info(false) ),
				'slot'     => 'global_top',
				// 'children' => apply_filters( 'lifeline_donation_form_gateways_data', array() ),
			),
			array(
				'is'    => 'lifeline-donation-form',
				'props' => array_merge($this->form_components( $post_id ), array('class' => 'wpcm-col-sm-12', 'show_amounts' => true)),
				'slot'  => 'step_1_top',
			),
			array(
				'is'    => 'lifeline-donation-amount-box',
				'props' => ['class' => 'wpcm-col-sm-12', 'custom_amount' => true, 'symbol' => webinane_currency_symbol(), 'symbols' => $this->currency_symbols( $currencies ),],
				'slot'  => 'step_1_bottom',
				'children'	=> array(
					array(
						'is'    => 'lifeline-donation-next-btn',
						'props' => array('text' => esc_html__('Proceed', 'lifeline-donation-pro'), 'class' => 'wpcm-next-btn w-100'),
						// 'slot'  => 'step_1_bottom',
					),
				)
			),
			array(
				'is'    => 'lifeline-donation-billing-form',
				'props' => $this->billing_form(),
				'slot'  => 'step_2_top',
				'children'	=> apply_filters('lifeline_donation_billing_form_data', array())
			),
			array(
				'is'       => 'lifeline-donation-gateways',
				'props'    => array(
					'gateways'	=> wpcm_get_active_gateways( true ),
					'show_recurring' => false,
					'strings'        => array(),
					'class'			 => 'w-100',
					'default_gateway' => $settings->get('default_gateway')
				),
				'slot'     => 'step_2_top',
				'children' => apply_filters( 'lifeline_donation_form_gateways_data', array(
					array('is' => 'lifeline-donation-proceed-btn', 'props' => array('class' => 'w-50 d-inline-block', 'text' => esc_html__('Proceed', 'lifeline-donation-pro')), ),
					array('is' => 'lifeline-donation-back-btn', 'props' => array('class' => 'wpcm-back-btn w-50 d-inline-block', 'text' => esc_html__('Back', 'lifeline-donation-pro')), )
				) ),
			),
		);
	}


	/**
	 * Form components.
	 *
	 * @return array
	 */
	public function form_components() {
		$settings   = wpcm_get_settings();
		$currencies = $this->getCurrencies();
		
		return array(
			'amounts'                => $this->getPredefinedAmount(),
			'currencies'             => $currencies,
			'base_currency'             	 => $settings->get('base_currency', 'USD'),
			'symbols'                => $this->currency_symbols( $currencies ),
			'symbol'                 => webinane_currency_symbol(),
			'show_currency_dropdown' => $settings->get( 'donation_multicurrency' ),
			'show_amounts'           => $settings->get( 'donation_predefined_amounts' ),
			'custom_amount'          => $settings->get( 'donation_custom_amount' ),
			'show_recurring'         => $settings->get( 'donation_recurring_payments' ),
			'enable_custom_dropdown' => $settings->get( 'enable_custom_dropdown' ),
			'donation_custom_dropdown' => $settings->get( 'donation_custom_dropdown' ),
			'format_price'			=> array(
				'position' 	=> $settings->get('currency_position', 'left'),
				'sep' 		=> $settings->get('thousand_saparator', ''), // Thousand Separator
				'd_sep' 	=> $settings->get('decimal_separator', '.'), // Decimal separator
				'd_point' 	=> $settings->get('number_decimals', 0) // Decimal numbers
			),
			'strings'                => array(
				'how_much'        => esc_html__( 'How much would you like to donate?', 'lifeline-donation-pro' ),
				'recurring'       => esc_html__( 'Recurring', 'lifeline-donation-pro' ),
				'one_time'        => esc_html__( 'One Time', 'lifeline-donation-pro' ),
				'donation_amount' => esc_html__( 'Enter the Amount you want to donate', 'lifeline-donation-pro' ),
			),
		);

	}

	/**
	 * Donation info.
	 *
	 * @param int $post_id Post id.
	 * @return array
	 */
	public function donation_info( $post_id ) {
		$settings = wpcm_get_settings();
		$post     = Post::with( 'meta' )->find( $post_id );

		return array(
			'show_title'    => true,
			'top_title'     => $settings->get( 'donation_popup_text' ),
			'img'           => LIFELINE_DONATION_URL . 'assets/images/new-img.png',
			'title'         => ( $post ) ? esc_attr( $post->post_title ) : $settings->get( 'donation_genral_title' ),
			'tagline'       => ( $post ) ? $post->post_title : $settings->get( 'donation_genral_subtitle' ),
			'collected'     => $this->getCollectedAmount( array( $post->post_type ), array( $post_id ) ),
			'needed'        => $this->getNeededAmount( $post ),
			'symbol'        => webinane_currency_symbol(),
			'show_progress' => $settings->get( 'donation_calculation_bar' ),
			'show_collection'	=> true,
			'currency_position' 	=> $settings->get('currency_position', 'left'),
			'strings'       => array(
				'collection'    => esc_html__( 'Current Collection', 'lifeline-donation-pro' ),
				'target'        => esc_html__( 'Target Needed', 'lifeline-donation-pro' ),
				'completed'     => esc_html__( 'Completed', 'lifeline-donation-pro' ),
				'make_donation' => esc_html__( 'Make a Donation', 'lifeline-donation-pro' ),
			),
		);
	}

	/**
	 * Gateway info.
	 *
	 * @return array
	 */
	public function gateway_info($gateways = true) {
		$settings = wpcm_get_settings();
		return array(
			'gateways'       => ($gateways) ? wpcm_get_active_gateways( true ) : array(),
			'show_recurring' => $settings->get( 'donation_recurring_payments' ),
			'strings'        => array(
				'recurring' => esc_html__( 'Recurring', 'lifeline-donation-pro' ),
				'one_time'  => esc_html__( 'One Time', 'lifeline-donation-pro' ),
			),
		);
	}

	/**
	 * Billing form.
	 * 
	 * @return array
	 */
	public function billing_form() {
		$user = wp_get_current_user();

		$settings = wpcm_get_settings();

		$country = array_get( $settings, 'enable_country_field' );
		$county = array_get( $settings, 'enable_county_field' );
		$city = array_get( $settings, 'enable_city_field' );
		$postal_code = array_get( $settings, 'enable_postal_code_field' );
		$tax_code = array_get( $settings, 'enable_tax_code_field' );
		$company = array_get( $settings, 'enable_company_field' );
		$phone_no = array_get( $settings, 'enable_phone_no_field' );

		return array(
			'is_logged_in' => is_user_logged_in(),
			'email'        => ( $user ) ? $user->data->user_email : '',
			'show_country'	=> $country,
			'show_county'	=> $county,
			'show_city'		=> $city,
			'show_postal'	=> $postal_code,
			'show_tax'	=> $tax_code,
			'show_company'	=> $company,
			'show_phone_no'	=> $phone_no,
			'strings'      => array(
				'title'      => esc_html__( 'Personal Details', 'lifeline-donation-pro' ),
				'first_name' => esc_html__( 'First Name', 'lifeline-donation-pro' ),
				'last_name'  => esc_html__( 'Last Name', 'lifeline-donation-pro' ),
				'email'      => esc_html__( 'Email', 'lifeline-donation-pro' ),
				'phone'      => esc_html__( 'Phone', 'lifeline-donation-pro' ),
				'address'    => esc_html__( 'Address', 'lifeline-donation-pro' ),
				'country'    => esc_html__( 'Country', 'lifeline-donation-pro' ),
				'county'     => esc_html__( 'County', 'lifeline-donation-pro' ),
				'city'	     => esc_html__( 'City', 'lifeline-donation-pro' ),
				'postal_code' => esc_html__( 'Postal Code', 'lifeline-donation-pro' ),
				'tax_code' => esc_html__( 'Tax Code', 'lifeline-donation-pro' ),
				'company' => esc_html__( 'Company', 'lifeline-donation-pro' ),
				'phone_no' => esc_html__( 'Phone Number', 'lifeline-donation-pro' ),
			),
		);
	}

	/**
	 * Currency symbols.
	 *
	 * @param array $currencies Post id.
	 * @return array
	 */
	private function currency_symbols( $currencies ) {
		$symbols = array();
		$all     = webinane_currencies();
		foreach ( $currencies as $code => $name ) {
			$symbols[ $code ] = Arr::get( $all, $code . '.units.major.symbol' );
		}

		return $symbols;
	}
}
