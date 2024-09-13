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
function wi_donation_campaigns5_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'campaigns5/index.js';
	wp_register_script(
		'wi_donation_campaigns5-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'campaigns5/editor.css';
	wp_register_style(
		'wi_donation_campaigns5-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'campaigns5/style.css';
	wp_register_style(
		'wi_donation_campaigns5-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'lifeline-donation/campaigns5', array(
		'editor_script' => 'wi_donation_campaigns5-block-editor',
		'editor_style'  => 'wi_donation_campaigns5-block-editor',
		'render_callback'	=> 'wi_donation_campaigns5_render_callback'
	) );
}
add_action( 'init', 'wi_donation_campaigns5_block_init' );


function wi_donation_campaigns5_render_callback($atts, $output) {
	$html = wp_kses_allowed_html( 'post' );
	wp_enqueue_script(array('lifeline-donation-modal'));

	$arr = webinane_array($atts);
	$query = new WP_Query(array(
		'post_type'			=> $arr->get('source', 'cause'),
		'posts_per_page' 	=> $arr->get('number', 2),
		'order' 			=> $arr->get('order', 'DESC'),
		'orderby' 			=> $arr->get('orderBy', 'date'),
	));

	ob_start();
	?>
	<?php if( $query->have_posts() ) : ?>
		<section class="wpcm-wrapper wp-block-lifeline-donation-campaigns3 lifeline-donation-app">
			<div class="wpcm-causes-style5">
				<div class="wpcm-row">
					<?php while($query->have_posts() ) : $query->the_post() ?>

						<?php 
							global $post;
							$meta = get_post_meta(get_the_id(), get_post_type().'s_settings', true);
							$location = webinane_set($meta, 'location');
							$total = \WebinaneCommerce\Classes\Orders::get_items_total($post);
							$needed = webinane_set($meta, 'donation');
							$percent = ($needed) ? ((int)$total/(int)$needed)*100 : 0;
						?>
						<div class="wpcm-col-lg-4 wpcm-col-lg-6">
							<div class="wpcm-cause-style5">
								<div class="wpcm-cause-style5-img">
									<figure>
										<?php the_post_thumbnail( array(540, 380) ) ?>
									</figure>
								</div>
								<div class="wpcm-cause-style5-contnt">
									<div class="wpcm-cause-style5-info">
										<?php $term = get_the_terms( get_the_ID(), 'cause_cat' ); ?>
										<?php if ( $term[0] ) : ?>
											<a href="<?php echo esc_url( get_term_link( $term[0]->term_id ) ) ?>" title="<?php echo esc_attr( $term[0]->name ); ?>"><?php echo esc_html( $term[0]->name ) ?></a>
										<?php endif; ?>
										<h2>
											<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
												<?php the_title() ?>
											</a>
										</h2>
										<span>
											<?php esc_html_e('Raised:', 'lifeline-donation-pro'); ?> 
											<strong>  <?php echo wp_kses( webinane_cm_price_with_symbol($total), $html ) ?></strong>
										</span>
									</div>
									<div class="wpcm-cause-style5-meta">
										<span class="wpcm-cause-meta"><i class="flaticon-calendar"></i><?php echo get_the_date() ?></span>
										<span class="wpcm-cause-meta"><i class="flaticon-place"></i><?php echo sanitize_text_field($location) ?></span>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
	<?php

	endif;
	$content = ob_get_clean();

	wp_reset_postdata();

	return $content;
}