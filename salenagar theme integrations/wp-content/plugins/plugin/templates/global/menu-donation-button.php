<?php

/**
 * Menu donation button template
 * 
 * @package WordPress
 * @subpackage Lifeline Donation
 * @author Webinane
 * @version 1.0
 */

$settings = wpcm_get_settings();
$type = $settings->get('donation_general_type');
$label = $settings->get('menu_donation_button_title');
$color = $settings->get('menu_donation_button_font_color');
$hover_color = $settings->get('menu_donation_button_text_hover_color');
$bg_color = $settings->get('menu_donation_button_color');
$bg_hover_color = $settings->get('menu_donation_button_hover_color');
$post_id = $settings->get('donation_dummy_page_select') ? $settings->get('donation_dummy_page_select') : 2;
$style = $settings->get('donation_popup_style');
?>

<li class="menu-item menu-dnt-btn lifeline-donation-app">
	<?php if ($type == 'external_link') : ?>

		<?php $external_link = $settings->get('donation_button_linkGeneral') ?>
		<a href="<?php echo esc_url($external_link) ?>" class="wpc-theme-btn wpcm-btn wpcm-btn-radius wpcm-btn-blk" style="color: <?php echo esc_attr($color) ?>; background-color: <?php echo esc_attr($bg_color) ?>" onMouseOver="this.style.color='<?php echo esc_attr($hover_color) ?>'; this.style.backgroundColor='<?php echo esc_attr($bg_hover_color) ?>'" onMouseOut="this.style.color='<?php echo esc_attr($color) ?>';this.style.backgroundColor='<?php echo esc_attr($bg_color) ?>'"><?php echo esc_attr($label); ?></a>

	<?php elseif ($type == 'donation_page_template') : ?>
		<?php $page_link = $settings->get('donation_shortcode_page') ?>
		<?php $page_link = ($page_link) ? get_permalink($settings->get('donation_shortcode_page')) : '' ?>
		<a href="<?php echo esc_url($page_link) ?>" class="wpc-theme-btn wpcm-btn wpcm-btn-radius wpcm-btn-blk" style="color: <?php echo esc_attr($color) ?>; background-color: <?php echo esc_attr($bg_color) ?>" onMouseOver="this.style.color='<?php echo esc_attr($hover_color) ?>'; this.style.backgroundColor='<?php echo esc_attr($bg_hover_color) ?>'" onMouseOut="this.style.color='<?php echo esc_attr($color) ?>';this.style.backgroundColor='<?php echo esc_attr($bg_color) ?>'"><?php echo esc_attr($label); ?></a>

	<?php else : ?>
		<?php //if ($post_id) : 
		?>
		<lifeline-donation-button :id="<?php echo esc_attr($post_id); ?>" dstyle="<?php echo esc_attr($style) ?>">
			<a href="" class="wpc-theme-btn wpcm-btn wpcm-btn-radius wpcm-btn-blk" style="color: <?php echo esc_attr($color) ?>; background-color:<?php echo esc_attr($bg_color) ?>;" onMouseOver="this.style.color='<?php echo esc_attr($hover_color) ?>'; this.style.backgroundColor='<?php echo esc_attr($bg_hover_color) ?>'" onMouseOut="this.style.color='<?php echo esc_attr($color) ?>';this.style.backgroundColor='<?php echo esc_attr($bg_color) ?>'"><?php echo esc_attr($label); ?></a>
		</lifeline-donation-botton>
		<?php //endif; 
		?>
	<?php endif; ?>
</li>