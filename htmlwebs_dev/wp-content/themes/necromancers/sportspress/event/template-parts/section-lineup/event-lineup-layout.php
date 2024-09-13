<?php
/**
 * Event: Lineup Layout 1
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$content       = $args['content'];
$kses_defaults = wp_kses_allowed_html( 'post' );

$svg_args = array(
  'svg'   => [
    'class' => true,
    'role' => true,
  ],
  'use'     => [
    'xlink:href' => true,
  ],
);

$allowed_tags = array_merge( $kses_defaults, $svg_args );

if ( ! empty( $content ) ):
  ?>
  <div class="sp-event-performance-tables sp-event-performance-teams">
    <div class="row no-gutters flex-md-nowrap">
      <?php echo wp_kses( $content, $allowed_tags ); ?>
    </div>
  </div><!-- .sp-event-performance-tables -->
  <?php
endif;
