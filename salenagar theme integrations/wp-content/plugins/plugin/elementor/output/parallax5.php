<?php 

wp_enqueue_style('webinane-shortcodes');
wp_enqueue_script(array('lifeline-donation-modal'));

$html = wp_kses_allowed_html('post');

$bg_image = $settings->get('bg_image');
$bg_image = $bg_image['id'];
// print_r( $bg_image );exit('ss');
$title    = $settings->get('title');
$text 	  = $settings->get('text');
$button   = $settings->get('button');
$action   = $settings->get('action');

?>

<div <?php echo wp_kses($this->get_render_attribute_string('wrapper'), $html) ?>
	<div class="wpcm-container">
		<div class="wpcm-row">
			<div class="wpcm-col-lg-12">
				<div class="wpcm-campaign-style2" style="background:url('<?php echo wp_get_attachment_url( $bg_image ); ?> ') no-repeat">
					<div class="strt-campaign-desc">
						<h2 class="heading"><?php echo wp_kses( $title, $html ); ?></h2>
						<p class="description"><?php echo wp_kses( $text, $html ); ?></p>
						<?php  if( $button ) {
							$btn_label = $settings->get('btn_label');
                    		$post_id   = $settings->get('post_id');
							if ( $action == 'link_add' ) {
								$link_n = $settings['link']['url'];
	                            $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
	                            $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
								echo '<a href="'. esc_url( $link_n ).'" class="wpcm-btn wpcm-btn-radius wpcm-btn-blk" >' . $btn_label . '</a>';
							} elseif($post_id) {
								echo '
									<lifeline-donation-button :id="'.esc_attr($post_id).'">
										<a href="#" class="wpcm-btn wpcm-btn-radius wpcm-btn-blk donation-modal-box-callerrrr">' . esc_attr($btn_label) . '</a>
									</lifeline-donation-button>';
							} }
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>