<?php
/**
 * Search form
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */
?>

<!-- Search Panel -->
<div class="search-panel">
	<div class="search-panel__content">
		<form action="<?php echo esc_url( home_url('/') ); ?>" id="header-search-form" class="search-form search-form--header">
			<input type="text" name="s" id="s" class="form-control" placeholder="<?php esc_attr_e( 'What are you looking for...?', 'necromancers' ); ?>">
		</form>
		<span><?php esc_html_e( 'Write what you are looking for, and press enter to begin your search!', 'necromancers'); ?></span>
	</div>
</div>
<!-- Search Panel / End -->
