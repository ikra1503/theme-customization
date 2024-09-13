<?php
/**
 * Event: Lineups
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
$defaults    = $args['defaults'];

// Layout
$layout = isset( $_GET['sportspress_event_player_lineup_layout'] ) && ! empty( $_GET['sportspress_event_player_lineup_layout'] ) ? $_GET['sportspress_event_player_lineup_layout'] : get_option( 'sportspress_event_player_lineup_layout', 'layout-1');

$teams = get_post_meta( $event_id, 'sp_team', false );

$is_individual = sp_get_post_mode( $event_id ) === 'player' ? true : false;

if ( is_array( $teams ) ) :
  ob_start();

  $performance = $event->performance();
  $stars       = $event->stars();

  $link_posts = get_option( 'sportspress_link_players', 'yes' ) == 'yes' ? true : false;
  $scrollable = get_option( 'sportspress_enable_scrollable_tables', 'yes' ) == 'yes' ? true : false;
  $sortable   = get_option( 'sportspress_enable_sortable_tables', 'yes' ) == 'yes' ? true : false;
  $mode       = get_option( 'sportspress_event_performance_mode', 'values' );

  // The first row should be column labels
  $labels = apply_filters( 'sportspress_event_box_score_labels', $performance[0], $event, $mode );

  // Add position to labels if selected
  if ( $show_position ) {
    $labels = array_merge( array( 'position' => esc_html__( 'Hero', 'necromancers' ) ), $labels );
  }

  // Remove the first row to leave us with the actual data
  unset( $performance[0] );

  $performance = array_filter( $performance );

  $status = $event->status();

  if ( 'future' == $status ) {
    $show_total = false;
  }

  // Get performance ids for icons
  if ( $mode == 'icons' ):
    $performance_ids = [];
    $performance_posts = get_posts([
      'posts_per_page' => -1,
      'post_type'      => 'sp_performance'
    ]);
    foreach ( $performance_posts as $post ):
      $performance_ids[ $post->post_name ] = $post->ID;
    endforeach;
  endif;

  if ( $reverse_teams ) {
    $teams = array_reverse( $teams, true );
  }

  // Get performance columns
  $args = array(
    'post_type' => 'sp_performance',
    'numberposts' => 100,
    'posts_per_page' => 100,
    'orderby' => 'menu_order',
    'order' => 'ASC',
  );

  $columns = get_posts( $args );

  // Get formats
  $formats = [];

  // Add to formats
  foreach ( $columns as $column ) {
    $format = get_post_meta( $column->ID, 'sp_format', true );
    if ( '' === $format ) {
      $format = 'number';
    }
    $formats[ $column->post_name ] = $format;
  }

  do_action( 'sportspress_before_event_performance', $columns );


  if ( $is_individual ) {
    // Combined table
    $data = array();
    foreach ( $performance as $players ) {
      foreach ( $players as $player_id => $player ) {
        if ( $player_id == 0 ) continue;
        $data[ $player_id ] = $player;
      }
    }
  
    sp_get_template( 'event-performance-table.php', array(
      'scrollable'      => $scrollable,
      'sortable'        => $sortable,
      'show_players'    => $show_players,
      'show_numbers'    => $show_numbers,
      'show_minutes'    => $show_minutes,
      'show_total'      => $show_total,
      'caption'         => esc_html__( 'Box Score', 'necromancers' ),
      'labels'          => $labels,
      'formats'         => $formats,
      'mode'            => $mode,
      'data'            => $data,
      'event'           => $event,
      'stars'           => $stars,
      'link_posts'      => $link_posts,
      'performance_ids' => isset( $performance_ids ) ? $performance_ids : null,
      'primary'         => 'primary' == $total ? $primary : null,
      'layout'          => $layout,
    ) );
  } else {
    foreach( $teams as $index => $team_id ) {
      if ( -1 == $team_id ) continue;

      // Get results for players in the team
      $players = sp_array_between( (array)get_post_meta( $event_id, 'sp_player', false ), 0, $index );
      $has_players = sizeof( $players ) > 1;

      $players = apply_filters( 'sportspress_event_performance_split_team_players', $players );

      $show_team_players = $show_players && $has_players;

      if ( ! $show_team_players && ! $show_staff && ! $show_total ) continue;

      if ( $show_team_players || $show_total ) {
        if ( 0 < $team_id ) {
          $data = sp_array_combine( $players, sp_array_value( $performance, $team_id, array() ) );
        } elseif ( 0 == $team_id ) {
          $data = array();
          foreach ( $players as $player_id ) {
            if ( isset( $performance[ $player_id ][ $player_id ] ) ) {
              $data[ $player_id ] = $performance[ $player_id ][ $player_id ];
            }
          }
        } else {
          $data = sp_array_value( array_values( $performance ), $index );
        }
        ?>

        <div class="col-12 col-lg-6">
          <?php
          $caption = '<figure class="ncr-team-id-' . esc_attr( $team_id ) . ' match-team match-team--v-align match-team--lineup-3">';
            if ( has_post_thumbnail( $team_id ) ) {
              $caption .= '<figure class="match-team-logo">';
                $caption .= sp_get_logo( $team_id, 'mini' );
              $caption .= '</figure>';
            }
            $caption .= '<figcaption>';
              $caption .= '<div class="match-team__name">' . sp_team_name( $team_id ). '</div>';
              $caption .= '<div class="match-team__country">' . get_field( 'ncr_team_origin', $team_id ) . '</div>';
            $caption .= '</figcaption>';
          $caption .= '</figure>';

          if ( 'layout-1' !== $layout ) {
            sp_get_template( 'event-performance-table.php', [
              'id'              => $event_id,
              'index'           => $index,
              'scrollable'      => $scrollable,
              'sortable'        => $sortable,
              'show_players'    => $show_team_players,
              'show_staff'      => $show_staff,
              'show_numbers'    => $show_numbers,
              'show_minutes'    => $show_minutes,
              'show_total'      => $show_total,
              'team_id'         => $team_id,
              'caption'         => $caption,
              'labels'          => $labels,
              'formats'         => $formats,
              'mode'            => $mode,
              'data'            => $data,
              'event'           => $event,
              'stars'           => $stars,
              'link_posts'      => $link_posts,
              'performance_ids' => isset( $performance_ids ) ? $performance_ids : null,
              'primary'         => 'primary' == $total ? $primary : null,
              'layout'          => $layout,
            ] );

          } else {
            sp_get_template( 'event/template-parts/section-lineup/event-lineup-table.php', [
              'id'              => $event_id,
              'index'           => $index,
              'scrollable'      => $scrollable,
              'sortable'        => $sortable,
              'labels'          => $labels,
              'formats'         => $formats,
              'mode'            => $mode,
              'data'            => $data,
              'event'           => $event,
              'stars'           => $stars,
              'link_posts'      => $link_posts,
            ] );
          }
          ?>
        </div>

        <?php
      }
    }
  }

  do_action( 'sportspress_event_performance' );

  $content = ob_get_clean();

  $content = trim( $content );
endif;
?>

<div class="swiper-slide ncr-event-carousel__item" data-icon="lineups" data-hash="lineups">

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
    <div class="match-lineups-container">
      <?php
      // Lineup
      get_template_part(
        'sportspress/event/template-parts/section-lineup/event-lineup-layout',
        null,
        [
          'content' => $content,
        ]
      );
      ?>
    </div>
  </div>
</div>
