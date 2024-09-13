<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var WPBakeryShortCode_Vc_Btn $this
 */
wp_enqueue_style( 'webinane-shortcodes');
wp_enqueue_script(array('lifeline-donation-modal'));

$atts = wi_donation_shortcode_atts( 'wi_donation_parallax4', $atts );
extract( $atts );
$html = wp_kses_allowed_html( 'post' );
?>
<div class="wpcm-wrapper">
	<div class="wpcm-container lifeline-donation-app">
		<div class="wpcm-row">
			<div class="wpcm-col-lg-12">
				<div class="wpcm-start-campaign" style="background-image:<?php echo wp_get_attachment_url( $bg_image ); ?>">
					<div class="start-campaign-contnt">
						<h2><?php echo wp_kses( $title, $html ); ?></h2>
						<p><?php echo wp_kses( $text, $html ); ?></p>
						<?php  if( $button ) {
							if ( $action == 'link_add' && $link ) {
								$link_ = ( '||' === $link ) ? '' : $link;  
								$link_n = vc_build_link( $link_ ); 
								$target = $link_n['target'] ? 'target=_blank' : '';
								echo '<a href="'. esc_url( $link_n['url'] ).'" class="wpcm-btn wpcm-btn-radius wpcm-btn-blk" >' . $btn_label . '</a>';
							} elseif($post_id) {
								echo '
								<lifeline-donation-button :id="'.esc_attr($post_id).'">
									<a href="" class="wpcm-btn wpcm-btn-radius wpcm-btn-blk donation-modal-box-callerrrr">' . esc_attr($btn_label) . '</a>
								</lifeline-donation-button>';
							} }
						?>
					</div>
					<span><i class="flaticon-flower"></i></span>	
				</div>
			</div>
		</div>
	</div>
</div>
