<?php
/**
 * Event: Statistics - Matchup - Progress Bar - Layout 1
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$title         = $args['title'];
$event_results = $args['event_results'];
?>

<li class="match-stats-progress-item match-stats-progress-item--padding-sm">
  <div class="match-stats-progress match-stats-progress--default">
    <div class="match-stats-progress__label"><?php echo esc_html( $title ); ?></div>
    <?php
    // Values
    foreach ( $event_results as $team_id => $event_result ) :
      $value = $event_result['value'];
      ?>
      <div class="match-stats-progress__score"><?php echo esc_html( necromancers_format_big_number( $value ) ); ?></div>
      <?php
    endforeach;
    ?>
    <div class="match-stats-progress__bar">
      <?php
      // Percentage
      $result_sum = array_sum( array_column( $event_results, 'value' ) );
      $i = 1;
      foreach ( $event_results as $team_id => $event_result ) :
        $value      = $event_result['value'];
        $percentage = $result_sum ? $value / $result_sum * 100 : 0;

        if ( $i === 1 ) :
          // output width only for first bar
          ?>
          <span class="ncr-team-id-<?php echo esc_attr( $team_id ); ?>" style="width: <?php echo esc_attr( round( $percentage ) ); ?>%;">&nbsp;</span>
          <?php
        else :
          // don't output width for other bars
          ?>
          <span class="ncr-team-id-<?php echo esc_attr( $team_id ); ?>">&nbsp;</span>
          <?php
        endif;

        $i++;
      endforeach;
      ?>
    </div>
  </div>
</li>
