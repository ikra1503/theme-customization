<?php
/**
 * Partners Carousel
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.0
 */

extract( $args, EXTR_SKIP );

if ( ! empty( $partners ) ) :
  ?>
  <ul class="<?php echo esc_attr( $class ); ?>">
    <?php
    foreach( $partners as $partner ) :
      ?>
      <li>
        <a href="<?php echo esc_url( $partner['item_url'] ); ?>" target="_blank">
          <?php
          if ( is_numeric( $partner['item_img'] ) ) {
            echo wp_get_attachment_image( $partner['item_img'], 'full', false, [ 'alt' => $partner['item_title'] ] );
          } else {
            if ( is_array( $partner['item_img'] ) ) {
              echo wp_get_attachment_image( $partner['item_img']['id'], 'full', false, [ 'alt' => $partner['item_title'] ] );
            } else {
              echo '<img src="' . esc_url( $partner['item_img'] ) .'" alt="' . $partner['item_title'] . '">';
            }
          }
          ?>
        </a>
      </li>
      <?php
    endforeach;
    ?>
  </ul>
  <?php
endif;
