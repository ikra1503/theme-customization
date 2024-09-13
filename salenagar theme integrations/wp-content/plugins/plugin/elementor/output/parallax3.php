<?php 

wp_enqueue_style('webinane-shortcodes');
wp_enqueue_script(array('lifeline-donation-modal'));

wp_enqueue_style('webinane-shortcodes');
wp_enqueue_script(array('lifeline-donation-modal'));

$html = wp_kses_allowed_html('post');

$side_image = $settings->get('bg_image');
$side_image = $side_image['id'];
// print_r( $bg_image );exit('ss');
$title    = $settings->get('title');
$text 	  = $settings->get('text');
$button   = $settings->get('button');
$action   = $settings->get('action');

$button2   = $settings->get('button2');
$action2   = $settings->get('action2');

?>

<div <?php echo wp_kses($this->get_render_attribute_string('wrapper'), $html) ?>>
	<div class="wpcm-container">
		<div class="wpcm-donation-style2">
			<div class="wpcm-row">
				<div class="wpcm-col-lg-7">
					<div class="donation-style2-content">
						<h2 class="heading"><?php echo wp_kses( $title, $html ); ?></h2>
						<p class="description"><?php echo wp_kses( $text, $html ); ?></p>
						<div class="donation-style2-btns">
							<?php if( $button ) {
								$btn_label = $settings->get('btn_label');
                    			$post_id   = $settings->get('post_id');
									if ( $action == 'link_add' ) {
										$link_n = $settings['link']['url'];
			                            $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
			                            $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
										echo '<a href="'. esc_url( $link_n ).'" ' . $target . $nofollow . ' class="wpcm-btn btn1 wpcm-btn-radius wpcm-btn-blk" >' . $btn_label . '</a>';
									} elseif($post_id) {
										echo '<lifeline-donation-button :id="'.esc_attr($post_id).'">
												<a href="#" class="wpcm-btn btn1 wpcm-btn-radius wpcm-btn-blk donation-modal-box-callerrrr">' . $btn_label . '</a>
											</lifeline-donation-button>';
									} 
							}?>
							<?php if( $button2 ) {
								$btn_label2 = $settings->get('btn_label2');
                    			$post_id2   = $settings->get('post_id2');
								if ( $action2 == 'link_add' ) {
									$link_n = $settings['link2']['url'];
			                            $target = $settings['link2']['is_external'] ? ' target="_blank"' : '';
			                            $nofollow = $settings['link2']['nofollow'] ? ' rel="nofollow"' : '';
									echo '<a href="'. esc_url( $link_n ).'" ' . $target . $nofollow . ' class="wpcm-btn btn2 wpcm-btn-radius wpcm-btn-blk" >' . $btn_label2 . '</a>';
								} elseif($post_id2) {
									echo '<lifeline-donation-button :id="'.esc_attr($post_id2).'">
											<a href="" class="wpcm-btn btn2 wpcm-btn-radius wpcm-btn-blk donation-modal-box-callerrrr">' . esc_attr($btn_label2) . '</a>
										</lifeline-donation-button>';
								} 
							} ?>
						</div>
						<div class="wpcm-icon-box">
							<span><i class="flaticon-hands-and-gestures"></i></span>
						</div>	
					</div>
				</div>
				<div class="wpcm-col-lg-5">
					<div class="donation-style2-img">
						<figure>
							<?php echo wp_get_attachment_image( $side_image, 'full' ); ?>
						</figure>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>