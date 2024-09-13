<?php
/**
 * Button Block Template.
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
$id = 'button-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-button';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text   = get_field( 'btn_text' ) ? : esc_html__( 'Button Text', 'necromancers-blocks');
$size   = get_field( 'btn_size' ) ? : 'md';
$color  = get_field( 'btn_color' ) ? : 'primary';
$type   = get_field( 'btn_type' ) ? : 'simple';
$url    = get_field( 'btn_url' ) ? : '#';
$target = get_field( 'btn_target' ) ? : '_self';

$styles = [ 'btn' ];
$styles[] = 'btn-' . $size;
$styles[] = 'btn-' . $color;
$styles[] = 'btn--' . $type;

if ( $target === 1 ) {
  $target = '_blank';
}


if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/button/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Button">';
else :
  ?>
  <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
    <a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( implode( ' ', $styles ) ); ?>" target="<?php echo esc_attr( $target ); ?>">
      <span><?php echo esc_html( $text ); ?></span>
    </a>
  </div>
  <?php
endif;
