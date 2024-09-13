<?php
/**
 * Alert Block Template.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   int|string $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'alert-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-alert';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$type    = get_field( 'ncr_alert_type' ) ? : 'alert-success';
$content = get_field( 'ncr_alert_content' );

$styles = [ 'alert' ];
$styles[] = 'alert-' . $type;


if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/alert/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Alert">';
else :
  ?>

  <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
    <div class="<?php echo esc_attr( implode( ' ', $styles ) ); ?>" role="alert">
      <?php echo $content; ?>
    </div>
  </div>

  <?php
endif;
