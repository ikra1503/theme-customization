<?php
/**
 * Event: Page Heading
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$event_id  = $args['event_id'];
$event     = $args['event'];
$show_date = $args['show_date'];
$class     = isset( $args['class'] ) ? $args['class'] : '';
?>

<div class="page-heading page-heading--default text-small text-center w-100 <?php echo esc_attr( $class ? $class : ''); ?>">
  <div class="page-heading__subtitle h5">
    <span class="color-primary page-heading__subtitle-separator">
      <?php
      // Event Date
      if ( $show_date ) {
        echo esc_html( get_the_time( get_option('date_format'), $event_id ) );
      }
      ?>
    </span>
    <?php
    // League
    $leagues = get_the_terms( $event_id, 'sp_league' );
    if ( $leagues ) :
      $league = array_shift( $leagues );
      echo esc_html( $league->name );
    endif;
    ?>
  </div>
  <h1 class="page-heading__title h-lead-2"><?php echo esc_html( $event->post->post_title ); ?></h1>
</div>
