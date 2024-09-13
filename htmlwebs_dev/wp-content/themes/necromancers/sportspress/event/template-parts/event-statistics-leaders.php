<?php
/**
 * Event: Statistics - Leaders
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$col_class = $args['col_class'];
$event     = $args['event'];
$event_id  = $args['event_id'];

// get Event Sections on current page
$event_sections = get_field( 'ncr_event_section_statistics' ) ? get_field( 'ncr_event_section_statistics' ) : [];

$link_posts = get_option( 'sportspress_link_players', 'yes' ) == 'yes' ? true : false;

// Performance
$performance = $event->performance();
unset( $performance[0] ); // remove labels

$performance_combined = [];
foreach ( $performance as $team_id => $players ) {
  foreach ( $players as $player_id => $player_performance ) {
    if ( 0 === $player_id ) continue; // skip if totals
    $performance_combined[ $player_id ] = [
      'team' => $team_id,
    ] + $player_performance;
  }
}

// Game Leaders Performances options

// Layout
$leaders_layout_on_page   = isset( $event_sections['ncr_event_section_statistics_leaders_layout'] ) ? $event_sections['ncr_event_section_statistics_leaders_layout'] : 'default';
$leaders_layout           = 'default' !== $leaders_layout_on_page ? $leaders_layout_on_page : get_theme_mod( 'necromancers_sp_event_statistics_leaders_layout', 'simple' );

// Performances
$leaders_performances_on_page = isset( $event_sections['ncr_event_section_statistics_leaders_performance'] ) ? $event_sections['ncr_event_section_statistics_leaders_performance'] : [];

if ( ! $leaders_performances_on_page ) {
  // if no performances selected for the particular event use the default ones
  $leaders_performances_common = get_theme_mod( 'necromancers_sp_event_statistics_leaders_performance', [] );

  // convert multidimensional Performances array to a single dimensional
  $leaders_performances = array_column( $leaders_performances_common, 'stat_post' );

} else {

  // modify the page Performances array to get the same structure as a common Performances
  $leaders_performances_on_page_mod = [];
  if ( ! empty( $leaders_performances_on_page ) ) {
    foreach ( $leaders_performances_on_page as $leaders_performances ) {
      $leaders_performances_on_page_mod[] = $leaders_performances->post_name;
    }
  }
  // selected performances on the event page
  $leaders_performances = $leaders_performances_on_page_mod;
}

// Number of players
$leaders_performances_num_on_page = isset( $event_sections['ncr_event_section_statistics_leaders_num'] ) ? $event_sections['ncr_event_section_statistics_leaders_num'] : '';
$leaders_performances_num = $leaders_performances_num_on_page ? $leaders_performances_num_on_page : get_theme_mod( 'necromancers_sp_event_statistics_leaders_num', 1 );
?>

<div class="<?php echo esc_attr( $col_class ); ?>">
  <div class="match-stats-widget match-stats-widget--leaders">
    <div class="match-stats-widget__header">
      <?php echo esc_html( get_theme_mod( 'necromancers_sp_event_statistics_leaders_title', esc_html__( 'Game Leaders', 'necromancers' ) ) ); ?>
    </div>
    <?php
    get_template_part( 'sportspress/event/template-parts/section-statistics/event-statistics-leaders', $leaders_layout, [
      'event'                    => $event,
      'event_id'                 => $event_id,
      'link_posts'               => $link_posts,
      'leaders_performances'     => $leaders_performances,
      'leaders_performances_num' => $leaders_performances_num,
      'performance_combined'     => $performance_combined,
    ] );
    ?>
  </div>
</div>
