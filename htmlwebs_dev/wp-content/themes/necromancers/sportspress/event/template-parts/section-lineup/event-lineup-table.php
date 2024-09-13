<?php
/**
 * Event Lineup Table (v1)
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Initialize totals
$totals = array();

// Set null
if ( ! isset( $section ) ) $section = -1;
if ( ! isset( $section_label ) ) $section_label = null;
if ( ! isset( $class ) ) $class = null;

// Initialize arrays
if ( ! isset( $lineups ) ) $lineups = array();
if ( ! isset( $subs ) ) $subs = array();

$responsive = get_option( 'sportspress_enable_responsive_tables', 'no' ) == 'yes' ? true : false;
//Create a unique identifier based on the current time in microseconds
$identifier = uniqid( 'performance_' );
$i = 0;
?>
<div class="ncr-template ncr-template-event-performance ncr-template-event-performance-<?php echo esc_attr( $mode ); ?><?php if ( isset( $class ) ) { echo ' ' . $class; } ?>">
  <div class="sp-table-wrapper">
    <table class="matches-table lineups-table lineups-table--layout-1 sp-event-performance sp-data-table<?php if ( $mode == 'values' ) { ?><?php if ( $scrollable ) { ?> sp-scrollable-table<?php }if ( $responsive ) { echo ' sp-responsive-table '. $identifier; } if ( $sortable ) { ?> sp-sortable-table<?php } ?><?php } ?>">
      <thead>
        <tr>
          <th class="data-name">
            <?php
            if ( isset( $section_label ) ) {
              echo esc_html( $section_label );
            } else {
              esc_html_e( 'Player', 'necromancers' );
            }
            ?>
          </th>
          <th class="data-position-icon">
            <?php esc_html_e( 'Role', 'necromancers'); ?>
          </th>
          <th class="data-position">
            <?php esc_html_e( 'Hero', 'necromancers'); ?>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php

        $lineups = array_filter( $data, array( $event, 'lineup_filter' ) );
        $subs = array_filter( $data, array( $event, 'sub_filter' ) );

        $lineup_sub_relation = array();
        foreach ( $subs as $sub_id => $sub ):
          if ( ! $sub_id )
            continue;
          $i = sp_array_value( $sub, 'sub', 0 );
          $lineup_sub_relation[ $i ] = $sub_id;
        endforeach;

        $data = apply_filters( 'sportspress_event_performance_players', $data, $lineups, $subs, $mode );

        $stars_type = get_option( 'sportspress_event_performance_stars_type', 0 );

        foreach ( $data as $player_id => $row ):

          if ( ! $player_id )
            continue;

          $name = get_the_title( $player_id );

          if ( ! $name )
            continue;

          echo '<tr class="' . sp_array_value( $row, 'status', 'lineup' ) . ' ' . ( $i % 2 == 0 ? 'odd' : 'even' ) . '">';

          if ( $link_posts ):
            $permalink = get_post_permalink( $player_id );
            $name =  '<a href="' . $permalink . '">' . $name . '</a>';
          endif;

          // Metrics
          $metrics = (array) get_post_meta( $player_id, 'sp_metrics', true );

          // First Name
          $fname = isset( $metrics['fname'] ) ? $metrics['fname'] : '';
          // Last Name
          $lname = isset( $metrics['lname'] ) ? $metrics['lname'] : '';

          if ( has_post_thumbnail( $player_id ) ) {
            $player_photo = get_the_post_thumbnail( $player_id, 'sportspress-fit-icon' );
          } else {
            $player_photo = '<img src="' . get_template_directory_uri() . '/assets/img/placeholders/placeholder-player-90x60.png" class="match-player__placeholder" alt="' . esc_attr( get_the_title( $player_id ) ) . '" />';
          }

          // Current Team
          $current_teams = get_post_meta( $player_id, 'sp_current_team' );
          $current_team_id = ! empty( $current_teams[0] ) ? $current_teams[0] : 0;

          if ( $stars_type ):
            $player_stars = sp_array_value( $stars, $player_id, 0 );
            if ( $player_stars ):
              switch ( $stars_type ):
                case 1:
                  $name .= ' <span class="sp-event-stars"><i class="sp-event-star dashicons dashicons-star-filled" title="' . esc_html__( 'Player of the Match', 'necromancers' ) . '"></i></span>';
                  break;
                case 2:
                  $name .= ' <span class="sp-event-stars">' . str_repeat( '<i class="sp-event-star dashicons dashicons-star-filled" title="' . esc_html__( 'Stars', 'necromancers' ) . '"></i>', $player_stars ) . '</span>';
                  break;
                case 3:
                  $name .= ' <span class="sp-event-stars"><i class="sp-event-star sp-event-star-' . $player_stars . '  dashicons dashicons-star-filled" title="' . esc_html__( 'Stars', 'necromancers' ) . '"></i><span class="sp-event-star-number">' . $player_stars . '</span></span>';
                  break;
              endswitch;
            endif;
          endif;

          $name = '<figure class="ncr-team-id-' . $current_team_id . ' match-player" role="group">
            <figure class="match-player__avatar">' . $player_photo . '</figure>
            <figcaption>
              <span class="match-player__nickname">' . $name . '</span>
              <span class="match-player__name">' . $fname . ' ' . $lname . '</span>
            </figcaption>
          </figure>';

          if ( array_key_exists( $player_id, $lineup_sub_relation ) ):
            $name .= ' <span class="sub-in" title="' . get_the_title( $lineup_sub_relation[ $player_id ] ) . '">' . sp_array_value( sp_array_value( $data, $lineup_sub_relation[ $player_id ], array() ), 'number', null ) . '</span>';
          elseif ( isset( $row['sub'] ) && $row['sub'] ):
            $subbed = (int) $row['sub'];
            $name .= ' <span class="sub-out" title="' . get_the_title( $row[ 'sub' ] ) . '">' . sp_array_value( sp_array_value( $data, $subbed, array() ), 'number', null ) . '</span>';
          endif;

          $position = null;

          foreach ( $labels as $key => $label ):
            if ( 'name' == $key )
              continue;

            $format = sp_array_value( $formats, $key, 'number' );
            $placeholder = sp_get_format_placeholder( $format );

            if ( ! array_key_exists( $key, $totals ) ):
              $totals[ $key ] = $placeholder;
            endif;

            if ( 'time' === $format ):
              $totals[ $key ] = '&nbsp;';
            endif;
            
            $value = '-';
            if ( $key == 'position' ):
              $positions = [];
              $position_icons = [];
              if ( array_key_exists( $key, $row ) && $row[ $key ] != '' ):
                $position_ids = (array) $row[ $key ];
              else:
                $position_ids = (array) sp_get_the_term_id( $player_id, 'sp_position' );
              endif;

              foreach ( $position_ids as $position_id ) {
                $player_position = get_term_by( 'id', $position_id, 'sp_position' );
                if ( $player_position ) $positions[] = $player_position->name;
              }

              foreach ( $position_ids as $position_id ) {
                $position_icon = get_field( 'ncr_character_icon', 'term_' . $position_id );
                if ( $position_icon ) {
                  $position_icons[] = $position_icon;
                }
              }
              
              $positions = array_unique( $positions );

              if ( sizeof( $positions ) ):
                $value = $position = implode( ', ', $positions );
              endif;
            endif;
          endforeach;

          echo '<td class="data-name" data-label="' . ( isset( $section_label ) ? $section_label : __( 'Player', 'necromancers' ) ) .'">' . $name . '</td>';

          echo '<td class="data-position-icon" data-label="' . esc_attr__( 'Role', 'necromancers' ) . '">';
            foreach ( $position_icons as $position_icon ) {
              echo '<svg role="img" class="df-icon df-icon--' . $position_icon . '"><use xlink:href="' . get_template_directory_uri() . '/assets/img/necromancers.svg#' . $position_icon . '"/></svg>';
            }
          echo '</td>';

          echo '<td class="data-position" data-label="' . esc_attr__( 'Hero', 'necromancers' ) .'">' . $position . '</td>';

          echo '</tr>';

          $i++;

        endforeach;
        ?>
      </tbody>
    </table>
  </div>
  <?php do_action( 'sportspress_after_event_performance_table', $data, $lineups, $subs, $class ); ?>
</div>
