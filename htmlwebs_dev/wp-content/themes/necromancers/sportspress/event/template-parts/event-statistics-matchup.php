<?php
/**
 * Event: Statistics - Matchup
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$col_class = $args['col_class'];
$data      = $args['data'];
$event_id  = $args['event_id'];

$teams = get_post_meta( $event_id, 'sp_team', false );
$teams = array_filter( $teams, 'sp_filter_positive' );

// get Event Sections on current page
$event_sections = get_field( 'ncr_event_section_statistics' ) ? get_field( 'ncr_event_section_statistics' ) : [];

// Progress Bars Layout
$bars_layout_on_page = isset( $event_sections['ncr_event_section_statistics_matchup_layout'] ) ? $event_sections['ncr_event_section_statistics_matchup_layout'] : 'default';
$bars_layout = 'default' !== $bars_layout_on_page ? $bars_layout_on_page : get_theme_mod( 'necromancers_sp_event_statistics_matchup_layout', 'layout-1' );

// Event Results
$event_results = [];
$event_results_output = [];
$event_results_common = get_theme_mod( 'necromancers_sp_event_results', [] );

// convert multidimensional Event Results array to a single dimensional
$event_results = array_column( $event_results_common, 'result_post' );

// check if Event Results selected on the current page
$event_results_on_page = isset( $event_sections['ncr_event_section_statistics_matchup_results'] ) ? $event_sections['ncr_event_section_statistics_matchup_results'] : [];

// modify the page Event Results array to get the same structure as a common Event Results
$event_results_on_page_mod = [];
if ( ! empty( $event_results_on_page ) ) {
  foreach ( $event_results_on_page as $event_result ) {
    $event_results_on_page_mod[] = $event_result->post_name;
  }
}

// use common Event Results or selected on the page
$event_results = $event_results_on_page_mod ? $event_results_on_page_mod : $event_results;

if ( $event_results ) {
  foreach ( $event_results as $event_result_name ) {
    if ( 'empty' === $event_result_name ) {
      continue; // skip if placebo
    };

    // Get Event Result by 'post_name'
    if ( $event_result_post = get_page_by_path( $event_result_name, OBJECT, 'sp_result' ) ) {
      $event_result_id = $event_result_post->ID;
    } else {
      $event_result_id = 0;
    }

    $values = [];
    foreach ( $teams as $team ) {
      $values[ $team ] = [
        'name' => $event_result_name,
        'value' => $data[ $team ][ $event_result_name ],
      ];
    }

    $event_results_output[ $event_result_name ] = [
      'title'  => get_post_field( 'post_title', $event_result_id ),
      'values' => $values,
    ];
  }
}
?>

<div class="<?php echo esc_attr( $col_class ); ?>">
  <div class="match-stats-widget match-stats-widget--matchup">
    <div class="match-stats-widget__header">
      <?php echo esc_html( get_theme_mod( 'necromancers_sp_event_statistics_matchup_title', esc_html__( 'Teams Matchup', 'necromancers' ) ) ); ?>
    </div>
    <ul class="match-stats-widget__body">
      <?php
      foreach ( $event_results_output as $event_result_key => $event_result_values ) :
        $title = $event_result_values['title'];
        
        get_template_part( 'sportspress/event/template-parts/section-statistics/event-statistics-matchup-bars', $bars_layout, [
          'title'         => $title,
          'event_results' => $event_result_values['values'],
        ] );

      endforeach;
      ?>
    </ul>
  </div>
</div>
