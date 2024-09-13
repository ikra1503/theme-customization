<?php
/**
 * Event: Statistics - Matchup - Progress Bar - Layout 2
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$title         = $args['title'];
$event_results = $args['event_results'];
?>

<li class="match-stats-progress-item match-stats-progress-item--padding-lg">
  <div class="match-stats-progress match-stats-progress--double">
    <div class="match-stats-progress__label"><?php echo esc_html( $title ); ?></div>
    <?php
    // Values
    $result_sum = array_sum( array_column( $event_results, 'value' ) );
    foreach ( $event_results as $team_id => $event_result ) :
      $value      = $event_result['value'];
      $percentage = $result_sum ? $value / $result_sum * 100 : 0;
      ?>
      <div class="match-stats-progress__score"><?php echo esc_html( necromancers_format_big_number( $value ) ); ?></div>
      <div class="match-stats-progress__bar">
        <span class="ncr-team-id-<?php echo esc_attr( $team_id ); ?>" style="width: <?php echo esc_attr( $percentage ); ?>%;">&nbsp;</span>
      </div>
      <?php
    endforeach;
    ?>
  </div>
</li>
