<?php
/**
 * Page Heading - Blog
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$page_heading_classes = 'page-header';
$page_heading_classes .= true === get_theme_mod( 'necromancers_page_heading_classic_bg_overlay', true ) ? ' page-header--has-overlay' : '';
?>

<div class="<?php echo esc_attr( $page_heading_classes ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<?php if ( ! is_singular( 'post' ) ) : ?>
					<h2 class="page-header__title">
						<?php
						if ( is_404() ) {
							esc_html_e( 'Error', 'necromancers' );
						} elseif ( is_archive() ) {
							echo get_the_archive_title();
						} elseif ( is_search() ) {
							esc_html_e( 'Search results', 'necromancers' );
						} elseif ( is_home() ) {
							if ( ( get_option( 'show_on_front' ) == 'page' ) && ( get_option( 'page_for_posts' ) != 0 ) ) {
								echo get_the_title( get_option( 'page_for_posts' ) );
							} else {
								esc_html_e( 'Blog', 'necromancers');
							}
						} else {
							the_title();
						}
						?>
					</h2>
				<?php elseif ( is_singular( 'post' ) ) : ?>
					<h1 class="page-header__title">
						<?php the_title(); ?>
					</h1>
				<?php endif; ?>

				<?php if ( is_category() ) : ?>
					<div class="page-header__subtitle h6">
						<?php echo category_description(); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_search() ) : ?>
					<p class="page-header__subtitle h6">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'for: %s', 'necromancers' ), '<span>"' . get_search_query() . '"</span>' );
						?>
					</p>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
