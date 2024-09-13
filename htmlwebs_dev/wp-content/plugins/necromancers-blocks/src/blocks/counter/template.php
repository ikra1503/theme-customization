<?php
/**
 * Counter Block Template.
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
$id = 'ncr-counter-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-counter';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$number = get_field( 'ncr_counter_number' ) ? : 0;
$title = get_field( 'ncr_counter_title' ) ? : esc_html__( 'Your Title', 'necromancers-blocks');
$icon = get_field( 'ncr_counter_icon' ) ? : 'joystick';
$icon_position = get_field( 'ncr_counter_icon_position' ) ? : 'left';

$time = get_field( 'ncr_counter_duration' ) ? : 1000;
$delay = get_field( 'ncr_counter_delay' ) ? : 0;
$beginat = get_field( 'ncr_counter_begin_at' ) ? : 0;

$styles = [ 'counter' ];

if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/counter/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Counter">';
else :
  ?>
  <div class="<?php echo esc_attr( implode( ' ', $styles ) ); ?>">
    <div class="counter__icon counter__icon--<?php echo esc_attr( $icon_position ); ?>">
      <svg role="img" class="df-icon df-icon--<?php echo esc_attr( $icon ); ?>">
        <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#<?php echo esc_attr( $icon ); ?>"/>
      </svg>
    </div>
    <div class="counter__number js-counter__number" data-counterup-time="<?php echo esc_attr( $time ); ?>" data-counterup-delay="<?php echo esc_attr( $delay ); ?>" data-counterup-beginat="<?php echo esc_attr( $beginat ); ?>"><?php echo esc_html( $number ); ?></div>
    <div class="counter__label"><?php echo esc_html( $title) ; ?></div>
  </div>
  <?php
endif;
