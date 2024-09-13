<?php
namespace WebinaneCommerce\Classes;

use Illuminate\Support\Arr;

class ExportOrders {


	static function init() {
		add_action( 'wp_ajax_wpcm_export_orders', array( __CLASS__, 'user_export_opt' ) );
	}

	static function user_export_opt() {
		$_post = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

		$columns = webinane_set( $_post, 'columns' );
		$status  = webinane_set( $_post, 'status' );
		$st_date = webinane_set( $_post, 'st_date' );
		$nd_date = webinane_set( $_post, 'nd_date' );

		if ( ! empty( $status ) ) {

			self::export( $columns, $status, $st_date, $nd_date );
		}

		wp_send_json_error( esc_html__( 'Please select the columns and post status.', 'lifeline-donation-pro' ) );
	}

	static function export( $columns, $status, $st_date = '', $nd_date = '' ) {

		$data_array          = array();
		$_data_array         = array();
		$query               = array(
			'post_type'   => 'orders',
			'post_status' => $status,
		);
		$query['date_query'] = array();

		if ( ! empty( $st_date ) && ! empty( $nd_date ) ) {
			$query['date_query'] = array(
				array(
					'after'     => array(
						'year'  => date( 'Y', strtotime( $st_date ) ),
						'month' => date( 'm', strtotime( $st_date ) ),
						'day'   => date( 'd', strtotime( $st_date ) ),
					),
					'before'    => array(
						'year'  => date( 'Y', strtotime( $nd_date ) ),
						'month' => date( 'm', strtotime( $nd_date ) ),
						'day'   => date( 'd', strtotime( $nd_date ) ),
					),
					'inclusive' => true,
				),
			);
		}
		$post = new \WP_Query( $query );
		$post = webinane_set( $post, 'posts' );
		if ( $post ) {
			foreach ( $post as $p ) {
				$meta       = get_post_meta( $p->ID );
				$order_data = maybe_unserialize( webinane_set( webinane_set( $meta, '_wpcm_order_submitted_data' ), 0 ) );

				foreach ( $columns as $column ) {
					switch ( $column ) {
						case 'ID':
							$_data_array['ID'] = $p->ID;
							break;
						case 'Name':
							$name = array();
							foreach ( $order_data['items'] as $items ) {
								$name[] = get_the_title( webinane_set( $items, 'item_id' ) );
							}
							$_data_array['Name'] = implode( '|', $name );
							break;
						case 'Cost':
							$price = array();
							foreach ( $order_data['items'] as $items ) {
								$price[] = webinane_set( $items, 'price' );
							}
							$_data_array['Cost'] = implode( '|', $price );
							break;
						case 'QTY':
							$quantity = array();
							foreach ( $order_data['items'] as $items ) {
								$quantity[] = webinane_set( $items, 'quantity' );
							}
							$_data_array['QTY'] = implode( '|', $quantity );
							break;
						case 'Total':
							$_data_array['Total'] = webinane_set( $order_data, '_order_total' );
							break;
						case 'Currency':
							$_data_array['Currency'] = webinane_set( $order_data, 'currency' );
							break;
						case 'Status':
							$_data_array['Status'] = $p->post_status;
							break;
						case 'Date Created':
							$_data_array['Date Created'] = webinane_set( $order_data, 'date' );
							break;
						case 'Customer Name':
							$_data_array['Customer Name'] = Arr::get( $order_data, 'user_info.first_name' ). ' ' . Arr::get( $order_data, 'user_info.last_name' );
							break;
						case 'Email':
							$_data_array['Email'] = webinane_set( $order_data, 'user_email' );
							break;
						case 'Gateway':
							$_data_array['Gateway'] = webinane_set( webinane_set( $meta, '_wpcm_order_gateway' ), 0 );
							break;
						case 'Recurring':
							$_data_array['Recurring'] = webinane_set( webinane_set( $meta, '_wpcm_is_recurring' ), 0 );
							break;
						case 'Recurring Cycle':
							$_data_array['Recurring Cycle'] = webinane_set( webinane_set( $meta, '_wpcm_recurring_cycle' ), 0 );
							break;
						case 'Recurring Frequency':
							$_data_array['Recurring Frequency'] = webinane_set( webinane_set( $meta, '_wpcm_recurring_frequency' ), 0 );
							break;
					}
				}
				$data_array[] = $_data_array;
			}
		}
		wp_reset_postdata();
		if ( empty( $data_array ) ) {
				wp_send_json_error( array( 'message' => esc_html__( 'No record found', 'lifeline-donation-pro' ) ) );
		}
		$url = self::get_csv( $data_array );
		wp_send_json_success( array( 'url' => $url ) );
	}

	public static function get_csv( $report_data ) {
		$csv_file_name = 'wpcm-order-report-' . time() . '.csv';
		$dir           = wp_get_upload_dir()['basedir'] . '/wpcm-roder-export';
		if ( ! is_dir( $dir ) ) {
			wp_mkdir_p( $dir );
		}
		$file_dir_set = $dir . '/' . $csv_file_name;
		$fop          = @fopen( $file_dir_set, 'w' );

		$header_displayed = false;
		if ( ! empty( $report_data ) ) {
			foreach ( $report_data as $data ) {
				if ( ! $header_displayed ) {
					fputcsv( $fop, array_keys( $data ) );
					$header_displayed = true;
				}
				fputcsv( $fop, $data );

			}
		}
		fclose( $fop );

		if ( ! file_exists( wp_get_upload_dir()['basedir'] . '/wpcm-roder-export/' . $csv_file_name ) ) {
			return;
		}

		return wp_get_upload_dir()['baseurl'] . '/wpcm-roder-export/' . $csv_file_name;
	}
}
