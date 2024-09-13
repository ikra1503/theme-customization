<?php
/**
 * Social Share
 *
 * @author    Dan Fisher
 * @package   Necromancers Assistant
 * @since     1.0.0
 * @version   1.0.0
 */

// Social Share buttons with icons
function ncr_assistant_social_share() {

	global $post;

	$url = urlencode( get_permalink( $post->ID ));
	$title = urlencode( get_the_title( $post->ID ));
	$thumbnail = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'full' );
	?>
	<li class="post__sharing-item">
		<a target="_blank" onClick="popup = window.open('https://www.facebook.com/share.php?u=<?php echo $url; ?>&title=<?php echo esc_html( $title ); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#" class="post__sharing-item-link post__sharing-item-link--fb" rel="nofollow"></a>
	</li>
	<li class="post__sharing-item">
		<a target="_blank" onClick="popup = window.open('https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#" class="post__sharing-item-link post__sharing-item-link--twitter" rel="nofollow"></a>
	</li>
	<?php
}
