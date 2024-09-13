<?php
/**
 * Template for displaying search forms
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 *
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="form-control search-form__text" name="s" placeholder="<?php esc_attr_e( 'Enter your search...', 'necromancers' ); ?>" />
	<button type="submit" class="search-form__submit" name="submit">
		<i class="fas fa-search"></i>
	</button>
</form>
