<?php
/**
 * Icon Block Template.
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
$id = 'icon-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-icon';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$icon       = get_field( 'ncr_icon' );
$icon_color = get_field( 'ncr_icon_color' ) ? : '#444';


if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/icon/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Icon">';
else :
  ?>

  <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
    <svg role="img" class="df-icon df-icon--<?php echo esc_attr( $icon ); ?> df-icon--32x32">
      <use xlink:href="<?php echo get_theme_file_uri() . '/assets/img/necromancers.svg#' . esc_attr( $icon ); ?>" fill="<?php echo esc_attr( $icon_color ); ?>"/>
    </svg>
  </div>
  <?php
endif;
