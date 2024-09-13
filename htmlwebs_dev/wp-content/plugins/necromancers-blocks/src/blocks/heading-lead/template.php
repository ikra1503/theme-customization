<?php
/**
 * Icon Block Template.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.3
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'heading-lead-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-heading-lead';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$title          = get_field( 'ncr_heading_lead_title' );
$subtitle       = get_field( 'ncr_heading_lead_subtitle' );
$subtitle_color = get_field( 'ncr_heading_lead_subtitle_color' );

if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/heading-lead/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Heading Lead">';
else :
  ?>

  <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
    <h1 class="landing-title h-lead-1">
      <?php
      if ( $subtitle ) :
        ?>
        <span class="subtitle landing-subtitle subtitle--<?php echo esc_attr( $subtitle_color ); ?>"><?php echo esc_html( $subtitle ); ?></span>
        <?php
      endif;
      echo wp_kses_post( $title );
      ?>
    </h1>
  </div>
  
  <?php
endif;
