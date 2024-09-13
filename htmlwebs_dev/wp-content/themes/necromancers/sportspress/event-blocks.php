<?php
/**
 * Event Blocks
 *
 * @author      ThemeBoy
 * @package     SportsPress/Templates
 * @version   2.7.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$defaults = array(
  'id'                   => null,
	'event'                => null,
	'title'                => false,
	'status'               => 'default',
	'format'               => 'default',
	'date'                 => 'default',
	'date_from'            => 'default',
	'date_to'              => 'default',
	'date_past'            => 'default',
	'date_future'          => 'default',
	'date_relative'        => 'default',
	'day'                  => 'default',
	'league'               => null,
	'season'               => null,
	'venue'                => null,
	'team'                 => null,
	'teams_past'           => null,
	'date_before'          => null,
	'player'               => null,
	'number'               => -1,
	'show_team_logo'       => get_option( 'sportspress_event_blocks_show_logos', 'yes' ) == 'yes' ? true : false,
	'link_teams'           => get_option( 'sportspress_link_teams', 'no' ) == 'yes' ? true : false,
	'link_events'          => get_option( 'sportspress_link_events', 'yes' ) == 'yes' ? true : false,
	'paginated'            => get_option( 'sportspress_event_blocks_paginated', 'yes' ) == 'yes' ? true : false,
	'rows'                 => get_option( 'sportspress_event_blocks_rows', 5 ),
	'orderby'              => 'default',
	'order'                => 'default',
	'columns'              => null,
  'show_all_events_link' => false,
  'show_title'           => get_option( 'sportspress_event_blocks_show_title', 'no' ) == 'yes' ? true : false,
	'show_league'          => get_option( 'sportspress_event_blocks_show_league', 'no' ) == 'yes' ? true : false,
	'show_season'          => get_option( 'sportspress_event_blocks_show_season', 'no' ) == 'yes' ? true : false,
	'show_matchday'        => get_option( 'sportspress_event_blocks_show_matchday', 'no' ) == 'yes' ? true : false,
	'show_venue'           => get_option( 'sportspress_event_blocks_show_venue', 'no' ) == 'yes' ? true : false,
	'hide_if_empty'        => false,
);

extract( $defaults, EXTR_SKIP );

$calendar = new SP_Calendar( $id );

if ( $status != 'default' ) {
	$calendar->status = $status;
}
if ( $format != 'default' ) {
	$calendar->event_format = $format;
}
if ( $date != 'default' ) {
	$calendar->date = $date;
}
if ( $date_from != 'default' ) {
	$calendar->from = $date_from;
}
if ( $date_to != 'default' ) {
	$calendar->to = $date_to;
}
if ( $date_past != 'default' ) {
	$calendar->past = $date_past;
}
if ( $date_future != 'default' ) {
	$calendar->future = $date_future;
}
if ( $date_relative != 'default' ) {
	$calendar->relative = $date_relative;
}
if ( $event ) {
	$calendar->event = $event;
}
if ( $league ) {
	$calendar->league = $league;
}
if ( $season ) {
	$calendar->season = $season;
}
if ( $venue ) {
	$calendar->venue = $venue;
}
if ( $team ) {
	$calendar->team = $team;
}
if ( $teams_past ) {
	$calendar->teams_past = $teams_past;
}
if ( $date_before ) {
	$calendar->date_before = $date_before;
}
if ( $player ) {
	$calendar->player = $player;
}
if ( $order != 'default' ) {
	$calendar->order = $order;
}
if ( $orderby != 'default' ) {
	$calendar->orderby = $orderby;
}
if ( $day != 'default' ) {
	$calendar->day = $day;
}
$data       = $calendar->data();
$usecolumns = $calendar->columns;

if ( isset( $columns ) ) :
	if ( is_array( $columns ) ) {
		$usecolumns = $columns;
	} else {
		$usecolumns = explode( ',', $columns );
	}
endif;

if ( $hide_if_empty && empty( $data ) ) {
	return false;
}

if ( $show_title && false === $title && $id ) :
	$caption = $calendar->caption;
	if ( $caption ) {
		$title = $caption;
	} else {
		$title = get_the_title( $id );
	}
endif;

$primary_result = sp_get_main_result_option();
?>

<div class="matches-scores row">
  <?php
  $i = 0;

  if ( intval( $number ) > 0 ) {
    $limit = $number;
  }

  foreach ( $data as $event ) :
    if ( isset( $limit ) && $i >= $limit ) {
      continue;
    }

    $event_id  = $event->ID;
    $permalink = get_post_permalink( $event, false, true );
    $results   = sp_get_results( $event );
    unset( $results[0] ); // remove labels

    // Date
    $event_year      = get_the_time( 'Y', $event );
    $event_month     = get_the_time( 'M', $event );
    $event_date_slug = sanitize_title( $event_year . $event_month );

    // Status
    $status = sp_get_status( $event ); // results, feature

    $teams = array_unique( get_post_meta( $event_id, 'sp_team' ) );
    $teams = array_filter( $teams, 'sp_filter_positive' );

    if ( get_option( 'sportspress_event_reverse_teams', 'no' ) === 'yes' ) {
      $teams   = array_reverse( $teams, true );
      $results = array_reverse( $results, true );
    }

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
    ?>
    <div class="match-score-wrapper col-md-12 col-lg-6 js-date-<?php echo esc_attr( $event_date_slug ); ?>" itemscope itemtype="http://schema.org/SportsEvent">
      <div class="match-score <?php echo esc_attr( ( $i % 2 == 0 ? ' alternate ' : '' ) ) . ' match-score--status-' . esc_attr( $status ); ?>">
        <?php do_action( 'sportspress_event_blocks_before', $event, $usecolumns ); ?>

        <div class="match-score__header">

          <?php
          if ( $show_league || $show_season ) :
            ?>
            <div class="match-score__competition">
              <?php
              // League
              if ( $show_league ) :
                $leagues = get_the_terms( $event, 'sp_league' );
                if ( $leagues ) :
                  $league = array_shift( $leagues );
                  ?>
                  <span class="sp-event-league"><?php echo esc_html( $league->name ); ?></span>
                  <?php
                endif;
              endif;

              // Season
              if ( $show_season ) :
                $seasons = get_the_terms( $event, 'sp_season' );
                if ( $seasons ) :
                  $season = array_shift( $seasons );
                  ?>
                  <span class="sp-event-season"><?php echo esc_html( $season->name ); ?></span>
                  <?php
                endif;
              endif;
              ?>
            </div>
            <?php
          endif;
          ?>
          
          <div class="match-score__date">
            <time class="sp-event-date" datetime="<?php echo esc_attr( $event->post_date ); ?>" itemprop="startDate" content="<?php echo mysql2date( 'Y-m-d\TH:iP', $event->post_date ); ?>">
            <?php echo get_the_time( get_option( 'date_format' ), $event ) . ', ' . wp_kses_post( apply_filters( 'sportspress_event_time', sp_get_time( $event ), $event->ID ) ); ?>
            </time>
          </div>
        </div>

        <div class="match-score__body">
          <?php
          foreach( $teams as $team ) :
            $team_name = get_the_title( $team );
            ?>
            <figure class="match-team <?php echo esc_attr( $winner == $team ? 'match-team--winner' : '' ); ?>" role="group">
              <figure class="ncr-team-id-<?php echo esc_attr( $team ); ?> match-team-logo" role="group">
                <?php echo get_the_post_thumbnail( $team, 'necromancers-sp-fit-icon-sm' ); ?>
              </figure>
              <figcaption>
                <div class="match-team__name"><?php echo esc_html( sp_team_name( $team ) ); ?></div>
                <?php
                if ( $show_origin ) :
                  $origin = get_field( 'ncr_team_origin', $team );
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
                  echo '<span class="match-result__score-digit">-</span>';
                }
              }
              ?>
            </span>
            <?php if ( $status == 'results' ) : ?>
              <span class="match-result__label"><?php esc_html_e( 'Final Score', 'necromancers' ); ?></span>
            <?php elseif ( $status == 'future') : ?>
              <span class="match-result__label"><?php esc_html_e( 'Scheduled', 'necromancers' ); ?></span>
            <?php endif; ?>
            
          </div>
        </div>

        <div class="match-score__footer">
          <?php foreach( $teams as $team ) : ?>
            <figure class="ncr-team-id-<?php echo esc_attr( $team ); ?> match-team-logo" role="group">
              <?php echo get_the_post_thumbnail( $team, 'necromancers-sp-fit-icon-sm' ); ?>
            </figure>
          <?php endforeach; ?>

          <?php
          $event_sections = (array) get_option( 'sportspress_event_template_order', [
            'overview',
            'statistics',
            'lineups',
            'video',
          ] );

          if ( ! empty( $event_sections ) ) :
            ?>
            <ul class="match-stats-links">
              <?php
              foreach ( $event_sections as $section ) :
                // Video
                $video_url = get_post_meta( $event_id, 'sp_video', true );
                // Ignore templates that are unavailable or that have been turned off
                if ( 'content' === $section ) continue;
                // Skip Video section if no video set
                if ( 'video' === $section && ! $video_url ) continue;

                $section_option = 'sportspress_event_show_' . $section;
                if ( 'yes' !== get_option( $section_option, sp_array_value( $section, 'default', 'yes' ) ) ) continue;

                // Slide options
                $icon = 'overview';
                $hash = 'overview';
                switch ( $section ) {
                  case 'overview' :
                    $hash = false;
                    break;
                  case 'statistics' :
                    $hash = 'stats';
                    $icon = 'stats';
                    break;
                  case 'lineups' :
                    $hash = 'lineups';
                    $icon = 'lineups';
                    break;
                  case 'video' :
                    $hash = 'video';
                    $icon = 'replay';
                    break;
                }
                ?>
                <li>
                  <a href="<?php echo esc_url( $permalink ); ?><?php echo esc_attr( $hash ? '#' . $hash : '' ); ?>">
                    <svg role="img" class="df-icon df-icon--<?php echo esc_attr( $icon ); ?>">
                      <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#<?php echo esc_attr( $icon ); ?>"/>
                    </svg>
                  </a>
                </li>
                <?php
              endforeach;
              ?>
            </ul>
            <?php
          endif;
          ?>
        </div>

        <?php do_action( 'sportspress_event_blocks_after', $event, $usecolumns ); ?>

      </div>
    </div>
    <?php
    $i++;
  endforeach;
  ?>
  <?php
  if ( $id && $show_all_events_link ) {
    echo '<div class="sp-calendar-link sp-view-all-link"><a href="' . esc_url( get_permalink( $id ) ) . '">' . esc_html__( 'View all events', 'necromancers' ) . '</a></div>';
  }
  ?>
</div>
