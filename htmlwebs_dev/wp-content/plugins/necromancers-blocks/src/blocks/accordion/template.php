<?php
/**
 * Accordion Block Template.
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
$id = 'ncr-accordion-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-accordion';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/accordion/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Accordion">';
else :

  if ( have_rows( 'ncr_accordion' ) ) :
    ?>

    <div class="accordion" id="<?php echo esc_attr( $id ); ?>">

      <?php
      $acc_counter = 0;
      while ( have_rows( 'ncr_accordion' ) ) : the_row();
        ++$acc_counter;
        $acc_title = get_sub_field( 'ncr_accordion_title' );
        $acc_content = get_sub_field( 'ncr_accordion_content' );
        $acc_expanded = get_sub_field( 'ncr_accordion_expanded' );
        ?>

        <div class="accordion-item">

          <div class="accordion-item__header" id="<?php echo esc_attr( $id ); ?>-heading-<?php echo esc_attr( $acc_counter ); ?>">
            <button class="accordion-item__link <?php echo esc_attr( !$acc_expanded ? 'collapsed' : '' ); ?>" type="button" data-toggle="collapse" data-target="#<?php echo esc_attr( $id ); ?>-panel-<?php echo esc_attr( $acc_counter ); ?>" aria-expanded="true" aria-controls="<?php echo esc_attr( $id ); ?>-panel-<?php echo esc_attr( $acc_counter ); ?>">
              <?php echo esc_html( $acc_title ); ?>
              <span class="accordion-item__icon">&nbsp;</span>
            </button>
          </div>

          <div id="<?php echo esc_attr( $id ); ?>-panel-<?php echo esc_attr( $acc_counter ); ?>" class="collapse <?php echo esc_attr( $acc_expanded ? 'show' : '' ); ?>" aria-labelledby="<?php echo esc_attr( $id ); ?>-heading-<?php echo esc_attr( $acc_counter ); ?>" data-parent="#<?php echo esc_attr( $id ); ?>">
            <div class="accordion-item__body">
              <?php echo $acc_content; ?>
            </div>
          </div>
          
        </div>
        <?php
      endwhile;
      ?>
    </div>
    <?php
  endif;
endif;
