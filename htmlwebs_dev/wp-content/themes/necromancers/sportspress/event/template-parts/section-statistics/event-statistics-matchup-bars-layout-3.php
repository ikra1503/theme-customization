<?php
/**
 * Event: Statistics - Matchup - Progress Bar - Layout 3
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$title         = $args['title'];
$event_results = $args['event_results'];

/*
 * Event Results don't have Icon by default, but Performances do.
 * Because of this, we display Performance Icons accordingly.
*/
$event_result_icon = 'kills';
foreach ( $event_results as $event_result ) {

  if ( $performance = get_page_by_path( $event_result['name'], OBJECT, 'sp_performance' ) ) {
    $event_result_icon = $performance->ID;
  } else {
    $event_result_icon = 0;
  }
}
?>

<li>
  <div class="match-stats-progress match-stats-progress--icon">
    <svg role="img" class="match-stats-progress__icon df-icon df-icon--<?php echo esc_attr( necromancers_sp_get_icon( $event_result_icon, false ) ); ?>">
      <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#<?php echo esc_attr( necromancers_sp_get_icon( $event_result_icon, false ) ); ?>"/>
    </svg>
    <div class="match-stats-progress__label"><?php echo esc_html( $title ); ?></div>
    <div>
      <?php
      // Values
      $result_sum = array_sum( array_column( $event_results, 'value' ) );
      foreach ( $event_results as $team_id => $event_result ) :
        $value      = $event_result['value'];
        $percentage = $result_sum ? $value / $result_sum * 100 : 0;
        ?>
        <div class="match-stats-progress__bar-group">
          <div class="match-stats-progress__bar">
            <span class="ncr-team-id-<?php echo esc_attr( $team_id ); ?>" style="width: <?php echo esc_attr( $percentage ); ?>%;">&nbsp;</span>
          </div>
          <div class="match-stats-progress__score"><?php echo esc_html( necromancers_format_big_number( $value ) ); ?></div>
        </div>
        <?php
      endforeach;
      ?>
    </div>
  </div>
</li>
