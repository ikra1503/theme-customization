<?php
/**
 * Social Links (Mobile)
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */


$social_links = get_theme_mod( 'necromancers_header_social_links_list', [] );

if ( ! empty( $social_links ) ) :
	?>
	<li class="mobile-bar-item">
		<a class="mobile-bar-item__header collapsed" data-toggle="collapse" href="#mobile_menu__social_links" role="button" aria-expanded="false" aria-controls="mobile_menu__social_links">
			<?php esc_html_e( 'Social Links', 'necromancers' ); ?>
			<span class="main-nav__toggle">&nbsp;</span>
		</a>
		<div id="mobile_menu__social_links" class="collapse mobile-bar-item__body">
			<ul class="social-menu social-menu--mobile-bar">
				<?php foreach ( $social_links as $social_link ) : ?>
					<li>
						<a href="<?php echo esc_url( $social_link['link_url'] ); ?>" target="_blank">
							<?php if ( $social_link['link_subtitle'] ) : ?>
								<span><?php echo esc_html( $social_link['link_subtitle'] ); ?></span>
							<?php endif; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</li>
	<?php
endif;
