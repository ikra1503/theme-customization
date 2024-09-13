<?php
/**
 * Event: Overview
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.2
 */

extract( $args['defaults'], EXTR_SKIP );

$event_id    = $args['event_id'];
$event       = $args['event'];
$data        = $args['data'];
$show_origin = $args['show_origin'];
?>

<div class="swiper-slide ncr-event-carousel__item" data-icon="stats" data-hash="stats">
  <div class="container ncr-event-carousel__item-inner">
    <?php
    // Event Page Heading
    get_template_part(
      'sportspress/event/template-parts/event-page-heading',
      null,
      [
        'event_id'  => $event_id,
        'event'     => $event,
        'show_date' => $show_date
      ]
    );
    ?>
    <div class="match-stats-container">
      <div class="row">
        <?php
        // Get the Statistics parts.
        $statistic_layout_parts = get_theme_mod( 'necromancers_sp_event_statistics_layout', [
          'general',
          'matchup',
          'leaders',
        ] );

        $col_num = count( $statistic_layout_parts );

        if ( 1 === $col_num ) {
          $col_class = 'col-lg-12';
        } elseif ( 2 === $col_num ) {
          $col_class = 'col-lg-6';
        } else {
          $col_class = 'col-lg-4';
        }

        // Loop Statistics parts.
        foreach ( $statistic_layout_parts as $statistic_layout_part ) {
          get_template_part( 'sportspress/event/template-parts/event-statistics', $statistic_layout_part, [
            'event_id'    => $event_id,
            'event'       => $event,
            'col_class'   => $col_class,
            'data'        => $data,
            'show_origin' => $show_origin,
          ] );
        }
        ?>
      </div>
    </div>
  </div>
</div>
