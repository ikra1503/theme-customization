<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package lifeline-donation
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function wi_donation_campaigns2_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'campaigns2/index.js';
	wp_register_script(
		'wi_donation_campaigns2-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-editor',
			'wp-plugins',
            'wp-edit-post',
            'wp-data',
            'underscore'
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'campaigns2/editor.css';
	wp_register_style(
		'wi_donation_campaigns2-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'campaigns2/style.css';
	wp_register_style(
		'wi_donation_campaigns2-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'lifeline-donation/campaigns2', array(
		'editor_script' => 'wi_donation_campaigns2-block-editor',
		'editor_style'  => 'wi_donation_campaigns2-block-editor',
		'style'         => 'wi_donation_campaigns2-block',
		'render_callback'	=> 'wi_donation_campaigns2_render_callback'
	) );
}
add_action( 'init', 'wi_donation_campaigns2_block_init' );

function wi_donation_campaigns2_render_callback($atts, $output) {
	$html = wp_kses_allowed_html( 'post' );
	wp_enqueue_script(array('lifeline-donation-modal'));
	$settings = wpcm_get_settings();

	$arr = webinane_array($atts);
	$query = new WP_Query(array(
		'post_type'			=> $arr->get('source', 'cause'),
		'posts_per_page' 	=> $arr->get('number', 2),
		'order' 			=> $arr->get('order', 'DESC'),
		'orderby' 			=> $arr->get('orderBy', 'date'),
	));

	ob_start();
	?>
		<section class="wpcm-wrapper wp-block-lifeline-donation-campaigns2 lifeline-donation-app">
			<div class="wpcm-row">
				<?php while($query->have_posts() ) : $query->the_post() ?>

					<?php 
						global $post;
						$meta = get_post_meta(get_the_id(), get_post_type().'s_settings', true);
						$total = \WebinaneCommerce\Classes\Orders::get_items_total($post);
						$needed = webinane_set($meta, 'donation');
						$percent = ($needed) ? ((int)$total/(int)$needed)*100 : 0;
					?>
					<div class="wpcm-col-lg-4 wpcm-col-md-4">
						<div class="wpcm-cause-style2">
							<div class="cause-style2-iner">
								<figure>
									<?php the_post_thumbnail( array(350, 270) ) ?>
									<?php $term = get_the_terms( get_the_ID(), 'cause_cat' ); ?>
									<?php if ( $term[0] ) : ?>
										<a href="<?php echo esc_url( get_term_link( $term[0]->term_id ) ) ?>" title="<?php echo esc_attr( $term[0]->name ); ?>"><?php echo esc_html( $term[0]->name ) ?></a>
									<?php endif; ?>								
								</figure>
								<h3><?php the_title() ?></h3>
								<p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p>
								<div class="progress">
								 	<div class="progress-bar" style="width:<?php echo esc_attr($percent) ?>%">
								 		<span><?php echo sanitize_text_field( round($percent, 2) ) ?>%</span>
								 	</div>
								</div> 
								<div class="dontn-amnt-info">
									<span><strong><?php esc_html_e('GOAL', 'lifeline-donation-pro'); ?>:</strong>  <?php echo wp_kses(webinane_cm_price_with_symbol($needed), $html) ?></span>
									<span><strong><?php esc_html_e('Raise', 'lifeline-donation-pro'); ?>:  </strong>  <?php echo wp_kses(webinane_cm_price_with_symbol($total), $html) ?></span>
								</div>
								<lifeline-donation-button :id="<?php the_ID(); ?>" dstyle="<?php echo esc_attr( $settings->get('donation_popup_style') ) ?>">
									<a href="#" class="wpcm-btn wpcm-btn-border">
										<?php esc_html_e('Donate Now', 'lifeline-donation-pro'); ?>
									</a>
								</lifeline-donation-button>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
	<?php

	$content = ob_get_clean();

	wp_reset_postdata();

	return $content;
}
