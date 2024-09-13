<?php 

wp_enqueue_style('webinane-shortcodes');
wp_enqueue_script(array('lifeline-donation-modal', 'lifeline-donation-script' , 'Youplyer'));

$html = wp_kses_allowed_html('post');

$bg_image = $settings->get('bg_image');
$bg_image = $bg_image['id'];
$title    = $settings->get('title');
$text 	  = $settings->get('text');
$button   = $settings->get('button');
$action   = $settings->get('action');

// echo '<pre>';
// print_r( $settings->get('background_type') );

if( $settings->get('background_type') == 'image' ) {
    $this->add_render_attribute( 'background_type', 'style', 'background: url(' . wp_get_attachment_url($bg_image) . ') no-repeat;'   );
} elseif ( $settings->get('background_type') == 'video' ) {
    $this->add_render_attribute( 'background_type', 'data-youtube', $settings->get( 'video_url' )  );
}

$button2   = $settings->get('button2');
$action2   = $settings->get('action2');

?>

<div <?php echo wp_kses($this->get_render_attribute_string('wrapper'), $html) ?>>
    <?php if ( $settings->get('background_type') != 'carousel' ) : ?>
        <div class="wpcm-campaign-parallax" <?php echo wp_kses( $this->get_render_attribute_string( 'background_type' ), $html ) ?> ></div>
    <?php else : ?>
        <div class="wpcm-campaign-parallax parallex-carousel-1">
            <?php foreach( $settings->get('carousel') as $carousel_image ) : ?>
                <?php echo wp_get_attachment_image( $carousel_image['images']['id'], 'full' ) ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="wpcm-container">
        <div class="wpcm-row">
            <div class="wpcm-col-lg-12">
                <div class="campaign-para-content text-center wpcm-p-150">
                    <i class="flaticon-love-and-romance"></i>
                    <h2 class="heading"><?php echo wp_kses($title, $html); ?></h2>
                    <p class="description"><?php echo wp_kses($text, $html); ?></p>
                
                    <?php  if ($button) {
                    	$btn_label = $settings->get('btn_label');
                    	$post_id   = $settings->get('post_id');
                        if ($action == 'link_add') {
                    		// @codingStandardsIgnoreLine
                    		$link_n = $settings['link']['url'];
                            $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                            $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                            echo '<a href="'. esc_url($link_n).'" ' . $target . $nofollow . '  class="wpcm-btn btn1 wpcm-btn-radius wpcm-btn-yellow">' . $btn_label . '</a>';
                        } else {
                    		// @codingStandardsIgnoreLine
                            
                    		echo '<lifeline-donation-button :id="'.esc_attr($post_id).'">
                                    <a class="wpcm-btn btn1 wpcm-btn-radius wpcm-btn-yellow donation-modal-box-callerrrr"  href="#">' . $btn_label . '</a>
                                </lifeline-donation-button>';
                        }
                    }
                    ?>
                    <?php  if ($button2) : ?>
                        <div class="wpcm-donte-btn">
                            <span><?php esc_html_e('or', 'lifeline-donation-pro'); ?>
                            <?php 
                            	$btn2_label = $settings->get('btn_label2');
                    			$post_id2   = $settings->get('post_id2');
                            ?>
                            <?php if ($action2 == 'link_add') {
                        		// @codingStandardsIgnoreLine
                        		$link_n = $settings['link2']['url'];
                    			$target = $settings['link2']['is_external'] ? ' target="_blank"' : '';
		                         $nofollow = $settings['link2']['nofollow'] ? ' rel="nofollow"' : '';
                                echo '<a class="btn2" href="'. esc_url($link_n).'" ' . $target . $nofollow . '>' . $btn2_label . '</a>';
                            } else {
                        		// @codingStandardsIgnoreLine
                        		echo '<lifeline-donation-button :id="'.esc_attr($post_id2).'">
                                <a class="donation-modal-box-callerrrr btn2"  href="#">' . $btn2_label . '</a>
                                </lifeline-donation-button>';
                            } ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>  
</div>

 <?php 
  wp_enqueue_script( 'owl-carousel' );

  $carousel = "jQuery(document).ready(function ($) { 
      \"use strict\";
        $('.parallex-carousel-1').owlCarousel({
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