<?php $address_fields = array(
	'address_line_1' 	=> esc_html__( 'Address Line 1', 'lifeline-donation-pro' ),
	'address_line_2' 	=> esc_html__( 'Address Line 2', 'lifeline-donation-pro' ),
	'city' 				=> esc_html__( 'City', 'lifeline-donation-pro' ),
	'base_country'		=> esc_html__( 'Country', 'lifeline-donation-pro' ),
	'zip'				=> esc_html__( 'Zip Code', 'lifeline-donation-pro' ),
); ?>

<div class="wpcm-order-detail wpcm-wrapper">
	
	<notif v-on:done="onDone" :result="result" :type="result_type" :msg="result_msg"></notif>
	<div class="wpcm-content" v-loading="loading">
		<general title="<?php esc_html_e('Order Action', 'lifeline-donation-pro' ) ?>"></general>
		<div class="wpcm-row">
			<div class="wpcm-col-sm-6">
				<billing-address />
			</div>
			<div class="wpcm-col-sm-6">
				<shipping-address />
			</div>
		</div>

		<order-items></order-items>
		<order-notes></order-notes>
	</div>
</div>