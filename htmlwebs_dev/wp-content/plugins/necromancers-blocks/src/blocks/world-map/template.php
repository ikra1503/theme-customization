<?php
/**
 * World Map Block Template.
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
$id = 'ncr-world-map-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-world-map';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

$custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_image = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );
$default_logo_image = NCR_BLOCKS_URL . '/assets/img/logo-necromancers-32.png';
$logo_image_output = $custom_logo_image ? $custom_logo_image[0] : $default_logo_image;

if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/world-map/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - World Map">';
else :
  ?>

  <div class="world-map">
    <?php
    if ( have_rows( 'ncr_world_map_pins' ) ) :
      while ( have_rows( 'ncr_world_map_pins' ) ) : the_row();
        $pin_title = get_sub_field( 'ncr_world_map_title' );
        $pin_subtitle = get_sub_field( 'ncr_world_map_subtitle' );
        $pin_align = get_sub_field( 'ncr_world_map_text_alignment' );
        $pin_x_pos = get_sub_field( 'ncr_world_map_x' );
        $pin_y_pos = get_sub_field( 'ncr_world_map_y' );
        $pin_img = get_sub_field( 'ncr_world_map_pin_image' );
        ?>
        <div class="world-map-team world-map-team--<?php echo esc_attr( $pin_align ); ?>" style="<?php echo esc_attr( $pin_align ); ?>: <?php echo esc_attr( $pin_x_pos ); ?>%; bottom: <?php echo esc_attr( $pin_y_pos ); ?>%;">
          <div class="world-map-team__wrapper">
            <figure class="world-map-team__logo" role="group">
              <?php $pin_img_output = $pin_img ? $pin_img : $logo_image_output; ?>
              <img src="<?php echo esc_url( $pin_img_output ); ?>" alt="<?php echo esc_attr( $pin_title ); ?>">
            </figure>
            <figcaption>
              <div class="world-map-team__name"><?php echo esc_html( $pin_title ); ?></div>
              <?php if ( $pin_subtitle ) : ?>
                <div class="world-map-team__country"><?php echo esc_html( $pin_subtitle ); ?></div>
              <?php endif; ?>
            </figcaption>
          </div>
          <div class="world-map-team__anchor"></div>
        </div>
        <?php
      endwhile;
    endif;
    ?>
  </div>
  <?php
endif;
