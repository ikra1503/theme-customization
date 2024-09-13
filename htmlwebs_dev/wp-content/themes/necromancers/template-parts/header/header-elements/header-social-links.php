<?php
/**
 * Header Elements - Social Links
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */
?>
<div class="header-social-toggle d-none d-md-block">
	<svg role="img" class="df-icon df-icon--thumb-up">
		<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#thumb-up"/>
	</svg>
	<span class="header-social-toggle__plus">&nbsp;</span>

	<?php
	// Social Links
	$social_links = get_theme_mod( 'necromancers_header_social_links_list', [] );

	if ( ! empty( $social_links ) ) :
		?>
		<ul class="social-menu social-menu--header">
			<?php foreach( $social_links as $social_link ) : ?>
				<li>
					<a href="<?php echo esc_url( $social_link['link_url'] ); ?>" target="_blank">
						<?php if ( $social_link['link_subtitle'] ) : ?>
							<span class="link-subtitle"><?php echo esc_html( $social_link['link_subtitle'] ); ?></span>
						<?php endif; ?>
						<?php echo esc_html( $social_link['link_title'] ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php
	endif;
	?>
</div>
