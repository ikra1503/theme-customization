<?php
/**
 * Donation page shortocde templates.
 *
 * @package WordPress
 */

$html = wp_kses_allowed_html( 'post' );
$settings = wpcm_get_settings();
?>
<div class="custom-dropp wpcm-wrapper lifeline-donation-app" >
	<lifeline-donation-page-template
		:showModal="true"
		:id="<?php echo esc_attr($id) ?>"
		dstyle="<?php echo esc_attr($style);?>"
	></lifeline-donation-page-template>
</div>
