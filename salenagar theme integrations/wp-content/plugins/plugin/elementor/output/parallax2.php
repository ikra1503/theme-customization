<?php 

wp_enqueue_style(array('webinane-shortcodes', 'webinane-flat-icon'));
wp_enqueue_script(array('lifeline-donation-modal'));

$html = wp_kses_allowed_html('post');

$bg_image = $settings->get('bg_image');
$bg_image = $bg_image['id'];
$title    = $settings->get('title');
$sub_title 	  = $settings->get('text');
$button   = $settings->get('button');
$action   = $settings->get('action');

if( $settings->get('background_type') == 'image' ) {
    $this->add_render_attribute( 'background_type', 'style', 'background: url(' . wp_get_attachment_url($bg_image) . ') no-repeat;'   );
} elseif ( $settings->get('background_type') == 'video' ) {
    $this->add_render_attribute( 'background_type', 'data-youtube', $settings->get( 'video_url' )  );
}

?>

<div <?php echo wp_kses($this->get_render_attribute_string('wrapper'), $html) ?>>
    <div class="wpcm-container">
        <div class="wpcm-row">
            <div class="wpcm-col-lg-12">
                <div class="wpcm-donation-style1 text-center wpcm-p-100 lifeline-donation-app" >
                    <?php if ( $settings->get('background_type') != 'carousel' ) : ?>
                        <div class="wpcm-campaign-parallax" <?php echo wp_kses( $this->get_render_attribute_string( 'background_type' ), $html ) ?> ></div>
                    <?php else : ?>
                        <div class="wpcm-campaign-parallax parallex-carousel-2">
                            <?php foreach( $settings->get('carousel') as $carousel_image ) : ?>
                                <?php echo wp_get_attachment_image( $carousel_image['images']['id'], 'full' ) ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="donation-style1-inner">
                        <i class="flaticon-honest"></i>
                        <h2 class="heading"><?php echo wp_kses($title, $html); ?></h2>
                        <span class="description"><?php echo wp_kses($sub_title, $html); ?></span>
                        <?php  if ($button) {
                        	$btn_label = $settings->get('btn_label');
                    		$post_id   = $settings->get('post_id');
                            if ($action == 'link_add' ) {
                        		// @codingStandardsIgnoreLine
                                $link_n = $settings['link']['url'];
                                $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                                echo '<a  href="'. esc_url($link_n) .'"' . $target . $nofollow . ' class="wpcm-btn btn1 wpcm-btn-icon wpcm-btn-red"><span><i class="flaticon-hand"></i></span>' . esc_attr($btn_label) . '</a>';
                            } elseif($post_id) {
                        		// @codingStandardsIgnoreLine
                        		echo '
                                <div class="lifeline-donation-app">
                                    <lifeline-donation-button :id="'.esc_attr($post_id).'">
                                        <a href="#" class="wpcm-btn btn1 wpcm-btn-icon wpcm-btn-red donation-modal-box-callerrrr"><span><i class="flaticon-hand"></i></span>' . esc_attr($btn_label) . '</a>
                                    </lifeline-donation-button>
                                </div>
                                ';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

wp_enqueue_script( 'owl-carousel' );

  $carousel = "jQuery(document).ready(function ($) { 
        \"use strict\";
        $('.parallex-carousel-2').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            items:1,
            autoplay:true,
            autoplayTimeout:5000,
        });
      });";
    wp_add_inline_script('owl-carousel', $carousel);
?>