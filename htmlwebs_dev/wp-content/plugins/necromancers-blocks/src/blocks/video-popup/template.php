<?php
/**
 * Video Popup Block Template.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ncr-video-popup-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-video-popup';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$video_url = get_field( 'ncr_video_popup_url' );
$cover_img = get_field( 'ncr_video_popup_cover_image' ) ? : NCR_BLOCKS_URL . '/assets/img/placeholder-436x244.jpg';

if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/video-popup/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Video Popup">';
else :
  ?>
  <figure id="<?php echo esc_attr( $id ); ?>" class="lightbox lightbox--video">
    <a href="<?php echo esc_url( $video_url ); ?>" class="mp_iframe">
      <img src="<?php echo esc_url( $cover_img ); ?>" alt="">
      <span class="lightbox__icon"></span>
    </a>
  </figure>
  <?php
endif;
