<?php
/**
 * Event: Statistics - General
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$col_class   = $args['col_class'];
$data        = $args['data'];
$event_id    = $args['event_id'];
$event       = $args['event'];
$show_origin = $args['show_origin'];

// Performance
$performance = $event->performance();
unset( $performance[0] ); // remove labels

$performance = array_filter( $performance );

// Results
$results = sp_get_results( $event_id );
unset( $results[0] ); // remove labels

$primary_result = sp_get_main_result_option();

// Status
$status = sp_get_status( $event ); // results, future

// MVP
$stars = $event->stars();

// Teams
$teams = get_post_meta( $event_id, 'sp_team', false );
$teams = array_filter( $teams, 'sp_filter_positive' );
$winner = sp_get_winner( $event );
$team_winner_pos = '';

if ( count( $teams ) > 1 ) {
  $team1 = $teams[0];
  $team2 = $teams[1];

  // get the winner position
  if ( $winner == $team1 ) {
    $team_winner_pos = 'left';
  } elseif ( $winner == $team2 ) {
    $team_winner_pos = 'right';
  }
}

// Positions IDs (Heroes IDs)
$position_ids = [];
$stars_teams = [];
foreach( $performance as $team_id => $team_data ) {
  unset( $team_data[0] ); // remove totals

  // Extends Stars (MVP)
  foreach ( $stars as $player_id => $stars_type ) {
    if ( array_key_exists( $player_id, $team_data ) ) {
      $stars_teams[ $team_id ][ $player_id ] = $stars_type;
    }
  }

  foreach ( $team_data as $player_id => $player ) {
    $position_ids[ $team_id ][] = sp_get_the_term_id( $player_id, 'sp_position' );
  }
}
?>

<div class="<?php echo esc_attr( $col_class ); ?>">
  <div class="match-stats-widget match-stats-widget--general match-score--status-<?php echo esc_attr( $status ); ?>">
    <div class="match-stats-widget__header">
      <?php echo esc_html( get_theme_mod( 'necromancers_sp_event_statistics_general_title', esc_html__( 'General Stats', 'necromancers' ) ) ); ?>
    </div>
    <ul class="match-stats-widget__body">
      <li class="match-stats-widget__score">
        <?php
        foreach( $teams as $team ) :
          $team_name = get_the_title( $team );
          ?>
          <figure class="match-team <?php echo esc_attr( $winner == $team ? 'match-team--winner' : '' ); ?>" role="group">
            <figure class="match-team-logo ncr-team-id-<?php echo esc_attr( $team ); ?>" role="group">
              <?php sp_the_logo( $team, 'mini' ); ?>
            </figure>
            <figcaption>
              <div class="match-team__name"><?php echo esc_html( sp_team_name( $team, 'abbreviation' ) ); ?></div>
              <?php
              if ( $show_origin ) :
                $origin = get_field( 'ncr_team_origin_abbr', $team );
                if ( $origin ) :
                  ?>
                  <div class="match-team__country"><?php echo esc_html( $origin ); ?></div>
                  <?php
                endif;
              endif;
              ?>
            </figcaption>
          </figure>
          <?php
        endforeach;
        ?>
        <div class="match-result match-result--winner-<?php echo esc_attr( $team_winner_pos ); ?>">
          <span class="match-result__score">
            <?php
            foreach ( $results as $result ) {
              if ( isset( $result[ $primary_result] ) ) {
                echo '<span class="match-result__score-digit">' . esc_html( $result[ $primary_result ] ) . '</span>';
              } else {
                echo '<span class="match-result__score-digit">0</span>';
              }
            }
            ?>
          </span>
        </div>
      </li>
      <?php
      // get Event Sections on current page
      $event_sections = get_field( 'ncr_event_section_statistics' ) ? get_field( 'ncr_event_section_statistics' ) : [];

      // Get the Event Info parts on current page
      $event_info_parts_on_page = isset( $event_sections['ncr_event_section_statistics_general_stats_layout'] ) ? $event_sections['ncr_event_section_statistics_general_stats_layout'] : false;

      // Get the Event Info parts
      $event_info_parts = $event_info_parts_on_page ? $event_info_parts_on_page : get_theme_mod( 'necromancers_sp_event_statistics_general_layout', [
        'venue',
        'duration',
        'time',
        'status',
      ] );

      // Event Info
      foreach ( $event_info_parts as $event_info_part ) :
        $label = '';
        $value = '';

        switch ( $event_info_part ) :
          // Duration
          case 'duration' :
            $label = esc_html__( 'Duration', 'necromancers' );
            $full_time = get_post_meta( $event_id, 'sp_minutes', true );
            if ( '' === $full_time ) {
              $full_time = get_option( 'sportspress_event_minutes', 90 );
            }
            $value = $full_time . '\'';
            break;
          // Venue
          case 'venue' :
            $label = esc_html__( 'Venue', 'necromancers' );
            $venues = get_the_terms( $event_id, 'sp_venue' );
            if ( $venues ) {
              $value = implode( ', ', wp_list_pluck( $venues, 'name' ) );
            }
            break;
          // Match Day
          case 'match_day' :
            $label = esc_html__( 'Match Day', 'necromancers' );
            $match_day = get_post_meta( $event_id, 'sp_day', true );
            $value = $match_day;
            break;
          // Time
          case 'time' :
            $label = esc_html__( 'Time', 'necromancers' );
            $value = get_the_time( get_option('time_format'), $event_id );
            break;
          // Status
          case 'status' :
            $label = esc_html__( 'Status', 'necromancers' );
            $value = $status === 'results' ? esc_html__( 'Final Score', 'necromancers' ) : esc_html__( 'Scheduled', 'necromancers' );
            break;
          // Heroes (Picks)
          case 'picks' :
            ?>
            <li class="match-team-list-wrapper">
              <?php
              foreach ( $position_ids as $position_id => $positions ) :
                ?>
                <ul class="match-team-list">
                  <?php
                  foreach ( $positions as $position ) :
                    $position_image = get_field( 'ncr_character_image', 'term_' . $position );
                    ?>
                    <li><?php echo wp_get_attachment_image( $position_image, 'sportspress-fit-mini' ); ?></li>
                    <?php
                  endforeach;
                  ?>
                </ul>
                <?php
              endforeach;
              ?>
              <span class="match-team-list-divider"><?php esc_html_e( 'Picks', 'necromancers' ); ?></span>
            </li>
            <?php
            break;
          // Match MVP
          case 'mvp' :
            if ( is_array( $stars_teams ) ) :
              foreach ( $stars_teams as $team_id => $players ) :

                if ( is_array( $players ) ) :
                  foreach ( $players as $player_id => $stars_type ) :
                    ?>
                    <li class="match-team-item ncr-team-id-<?php echo esc_attr( $team_id ); ?>">
                      <figure class="match-player match-player--small" role="group">
                        <figure class="match-player__avatar">
                          <svg role="img" class="df-icon df-icon--medal">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#medal"></use>
                          </svg>
                        </figure>
                        <figcaption>
                          <span class="match-player__nickname"><?php echo sp_get_player_name( $player_id ); ?></span>
                          <span class="match-player__name color-primary"><?php esc_html_e( 'Match MVP', 'necromancers' ); ?></span>
                        </figcaption>
                      </figure>
                      <?php
                      if ( $stars_type ):
                        $player_stars = sp_array_value( $stars, $player_id, 0 );
                        if ( $player_stars ):
                          switch ( $stars_type ):
                            case 1:
                              echo '<span class="sp-event-stars"><i class="sp-event-star dashicons dashicons-star-filled" title="' . esc_html__( 'Player of the Match', 'necromancers' ) . '"></i></span>';
                              break;
                            case 2:
                              echo '<span class="sp-event-stars">' . str_repeat( '<i class="sp-event-star dashicons dashicons-star-filled" title="' . esc_html__( 'Stars', 'necromancers' ) . '"></i>', $player_stars ) . '</span>';
                              break;
                            case 3:
                              echo '<span class="sp-event-stars"><i class="sp-event-star sp-event-star-' . $player_stars . '  dashicons dashicons-star-filled" title="' . esc_html__( 'Stars', 'necromancers' ) . '"></i><span class="sp-event-star-number">' . $player_stars . '</span></span>';
                              break;
                          endswitch;
                        endif;
                      endif;
                      ?>
                      
                    </li>
                    <?php
                  endforeach;
                endif;
              endforeach;
            endif;
            break;
        endswitch;
        // Output info item
        if ( $label && $value ) :
          ?>
          <li><span><?php echo esc_html( $label ); ?></span><span><?php echo esc_html( $value ); ?></span></li>
          <?php
        endif;
      endforeach;
      ?>
    </ul>
  </div>
</div>
