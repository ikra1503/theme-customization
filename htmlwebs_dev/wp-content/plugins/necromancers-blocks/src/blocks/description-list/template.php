<?php
/**
 * Description List Block Template.
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
$id = 'ncr-dl-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-dl';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/description-list/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Description List">';
else :

  if ( have_rows( 'ncr_dl' ) ) :
    ?>

    <div class="info-box info-box--content" id="<?php echo esc_attr( $id ); ?>">

      <?php
      while ( have_rows( 'ncr_dl' ) ) : the_row();
        $dl_title = get_sub_field( 'ncr_dl_title' );
        $dl_description = get_sub_field( 'ncr_dl_description' );
        ?>
          <div class="info-box__label"><?php echo esc_html( $dl_title ); ?></div>
          <div class="info-box__content js-info-box__content">
            <a href="mailto:<?php echo $dl_description; ?>"><?php echo $dl_description; ?></a>
          </div>
        <?php
      endwhile;
      ?>
    </div>
    <?php
  endif;
endif;
