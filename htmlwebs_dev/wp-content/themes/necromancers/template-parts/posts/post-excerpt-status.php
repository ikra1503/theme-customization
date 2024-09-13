<?php
/**
 * Show the appropriate content for the Status post format.
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */
?>

<div class="post__excerpt">
	<?php
	// Print the full content.
	the_content();

	// More link
	echo necromancers_continue_reading_link();
	?>
</div>
