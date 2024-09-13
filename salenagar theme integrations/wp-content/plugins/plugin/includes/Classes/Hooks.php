<?php

namespace LifelineDonation\Classes;

use WebinaneCommerce\Admin\Install;
use WebinaneCommerce\Classes\Webinane;

/**
 * Define all hooks here in this class.
 *
 * @since 2.0
 */
class Hooks {
	const DOCS     = 'https://plugins.webinane.com/docs/lifeline-donation';
	const EXT      = 'https://www.webinane.com/plugins';
	const SERVICES = 'https://www.webinane.com/our-services';

	/**
	 * Init the class.
	 *
	 * @return void
	 */
	public function init() {
		$plugin_base = plugin_basename( LIFELINE_DONATION_FILE );
		add_action( 'in_plugin_update_message-' . $plugin_base, array( $this, 'update_message' ), 10, 2 );
		add_action( 'after_plugin_row_' . $plugin_base, array( $this, 'multisite_update_message' ), 10, 2 );
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
		add_filter( 'plugin_action_links_' . $plugin_base, array( $this, 'plugin_action_links' ) );
		add_filter( 'lifeline_donation_form_gateways_data', array( $this, 'recurring_cycle_component' ) );

		add_filter( 'lifeline_donation_form_extra_dropdowns', array( $this, 'donation_form_dropdowns' ), 10 );
	}

	/**
	 * Plugin activation hook.
	 *
	 * @return void
	 */
	public static function activation() {
		flush_rewrite_rules( true );
		delete_transient( 'webinane_commerce_db_upgrade_status' );

		if (
			class_exists( 'WebinaneCommerce\\Loader' )
		) {
			Install::init();
			Webinane::update_database();
		}
	}

	/**
	 * Database upgrade process.
	 *
	 * @return void
	 */
	public static function upgrade_process( $upgrader_object, $options ) {
		$current_plugin_path_name = plugin_basename( LIFELINE_DONATION_FILE );

		if ( 'update' === $options['action'] && 'plugin' === $options['type'] ) {
			if ( isset( $options['plugins'] ) ) {
				foreach ( $options['plugins'] as $each_plugin ) {
					if ( $each_plugin === $current_plugin_path_name ) {
						\WebinaneCommerce\Classes\Webinane::update_database();
					}
				}
			} elseif ( isset( $options['plugin'] ) ) {
				if ( $options['plugin'] === $current_plugin_path_name ) {
					\WebinaneCommerce\Classes\Webinane::update_database();
				}
			}
		}
	}

	/**
	 * Plugin Update message.
	 *
	 * @param  array $data      Array of data.
	 * @param  array $response  Arra of response.
	 * @return void
	 */
	public function update_message( $data, $response ) {
		if ( isset( $data['upgrade_notice'] ) ) {
			printf(
				'<div class="update-message">%s</div>',
				wpautop( $data['upgrade_notice'] )
			);
		}
	}

	/**
	 * Multisite plugin update message.
	 *
	 * @return void
	 */
	public function multisite_update_message( $file, $plugin ) {
		$new_version = isset($plugin['new_version']) ? $plugin['new_version'] : '1.1';
		if ( is_multisite() && version_compare( $plugin['Version'], $new_version, '<' ) ) {
			$wp_list_table = _get_list_table( 'WP_Plugins_List_Table' );
			printf(
				'<tr class="plugin-update-tr"><td colspan="%s" class="plugin-update update-message notice inline notice-warning notice-alt"><div class="update-message"><h4 style="margin: 0; font-size: 14px;">%s</h4>%s</div></td></tr>',
				$wp_list_table->get_column_count(),
				$plugin['Name'],
				''
			);
		}
	}

	/**
	 * Plguin row meta.
	 *
	 * @param  array  $links Array of links.
	 * @param  string $file  Path to the files.
	 * @return array
	 */
	public function plugin_row_meta( $links, $file ) {
		if ( plugin_basename( LIFELINE_DONATION_FILE ) === $file ) {
			$row_meta = array(
				'docs'       => '<a href="' . esc_url( static::DOCS ) . '" target="_blank">' . esc_html__( 'Docs', 'lifeline-donation-pro' ) . '</a>',
				'extensions' => '<a href="' . esc_url( static::EXT ) . '" target="_blank" >' . esc_html__( 'Extensions', 'lifeline-donation-pro' ) . '</a>',
				'services'   => '<a href="' . esc_url( static::SERVICES ) . '" target="_blank" >' . esc_html__( 'Services', 'lifeline-donation-pro' ) . '</a>',
			);

			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

	/**
	 * Plugin action links
	 *
	 * @return array
	 */
	public function plugin_action_links( $links ) {
		$links[] = '<a href="' .
		esc_url( admin_url( 'admin.php?page=wp-commerce-settings' ) ) .
		'" target="_blank">' . esc_html__( 'Settings', 'lifeline-donation-pro' ) . '</a>';
		return $links;
	}

	/**
	 * Recurring cycle options component.
	 *
	 * @return array
	 */
	public function recurring_cycle_component( $components ) {
		$options      = array(
			'weekly'    => esc_html__( 'Weekly', 'lifeline-donation-pro' ),
			'monthly'   => esc_html__( 'Monthly', 'lifeline-donation-pro' ),
			'quarterly' => esc_html__( 'Quarterly', 'lifeline-donation-pro' ),
			'yearly'    => esc_html__( 'Yearly', 'lifeline-donation-pro' ),
		);
		$options      = apply_filters( 'lifeline_donation_reucrring_cyce_options', $options );
		$components[] = array(
			'is'    => 'recurring-cycle',
			'slot'  => 'gateway_data',
			'props' => array( 'options' => $options, 'class' => 'wpcm-recurring-cycle-drp' ),
		);

		return $components;
	}

	/**
	 * Donation form custom dropdowns hook
	 *
	 * @param array $dropdowns Array of dropdowns.
	 * @return array
	 */
	public function donation_form_dropdowns( $dropdowns ) {
		$dropdowns[] = array(
			'is'    => 'general-dropdowns',
			'props' => array(
				'strings'    => array(
					'title'                   => esc_html__( 'Where would you like to donate to?', 'lifeline-donation-pro' ),
					'all_projects_causes'     => esc_html__( 'All Projects and Causes', 'lifeline-donation-pro' ),
					'all_projects'            => esc_html__( 'All Projects', 'lifeline-donation-pro' ),
					'all_causes'              => esc_html__( 'All Causes', 'lifeline-donation-pro' ),
					'own_selection'           => esc_html__( 'My Own Selection', 'lifeline-donation-pro' ),
					'custom_donation_purpose' => esc_html__( 'Choose Custom Donation Options', 'lifeline-donation-pro' ),
					'projects'                => esc_html__( 'Projects', 'lifeline-donation-pro' ),
					'causes'                  => esc_html__( 'Causes', 'lifeline-donation-pro' ),
				),
				'post_types' => array( 'cause', 'project' ),
				'projects'   => webinane_donation_get_posts_blocks( 'project', true ),
				'causes'     => webinane_donation_get_posts_blocks( 'cause', true ),
			),
			'slot'  => 'donation_dropdowns',
		);
		return $dropdowns;
	}
}
