<?php
/**
 * Event: Overview
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.4
 */

extract( $args['defaults'], EXTR_SKIP );

$event_id    = $args['event_id'];
$event       = $args['event'];
$data        = $args['data'];
$labels      = $args['labels'];
$show_origin = $args['show_origin'];

$show_outcomes = array_key_exists( 'outcome', $labels );

$status = $event->status();
?>

<div class="swiper-slide ncr-event-carousel__item match-overview" data-icon="overview" data-hash="overview">

  <div class="container ncr-event-carousel__item-inner">
    <?php
    // Event Page Heading
    get_template_part(
      'sportspress/event/template-parts/event-page-heading',
      null,
      [
        'event_id'  => $event_id,
        'event'     => $event,
        'show_date' => $show_date,
        'class'     => 'page-heading--bottom-padding-lg',
      ]
    );
    ?>
    <div class="match-overview__body">

      <?php
      // Team Logos
      foreach( $data as $team_id => $result ) :
        ?>
        <figure class="match-team" role="group">
          <figure class="ncr-team-id-<?php echo esc_attr( $team_id ); ?> match-team-logo" role="group">
            <?php
            if ( $link_teams && sp_post_exists( $team_id ) ) {
              echo '<a href="' . get_post_permalink( $team_id ) . '">' . sp_get_logo( $team_id, 'medium' ) . '</a>';
            } else {
              sp_the_logo( $team_id, 'medium' );
            }
            ?>
          </figure>
          <figcaption class="match-team__info">
            <div class="match-team__name">
              <?php
              if ( $link_teams && sp_post_exists( $team_id ) ) {
                echo '<a href="' . get_post_permalink( $team_id ) . '">' . sp_team_name( $team_id ) . '</a>';
              } else {
                echo sp_team_name( $team_id );
              }
              ?>
            </div>
            <?php
            if ( $show_origin ) :
              $origin = get_field( 'ncr_team_origin', $team_id );
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
      
      // Event Results
      $teams = sp_get_teams( $event_id );
      $winner = sp_get_winner( $event_id );
      $team_winner_pos = '';

      if ( count( $teams ) > 1 ) {
        $team1 = $teams[0];
        $team2 = $teams[1];

        // get the winner position
        if ( $winner == $team1 ) {
          $team_winner_pos = 'match-result--winner-left';
        } elseif ( $winner == $team2 ) {
          $team_winner_pos = 'match-result--winner-right';
        }
      }
      // sp_get_teams
      ?>
      <div class="col-md-4">
        <div class="match-overview__result">
          <div class="match-result <?php echo esc_attr( $team_winner_pos ); ?>">
            <span class="match-result__score">
              <?php
              if ( 'results' === $status ) {
                sp_the_main_results( $event_id, ' : ' );
              } else {
                echo '&mdash;';
              }
              ?>
            </span>
            <span class="match-result__label">
              <?php
              if ( 'results' === $status ) {
                esc_html_e( 'Final score', 'necromancers' );
              } else {
                esc_html_e( 'Scheduled', 'necromancers' );
              }
              ?>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Event Details -->
    <ul class="match-overview__footer list-unstyled">
      <?php
      // Match Day
      $day = get_post_meta( $event_id, 'sp_day', true );

      if ( $show_day && '' !== $day ) :
        ?>
        <li class="match-overview__footer-item match-overview__footer-item--matchday">
          <span><?php esc_html_e( 'Match Day', 'necromancers' ); ?></span>
          <?php echo esc_html( $day ); ?>
        </li>
        <?php
      endif;
      
      // Event Time
      if ( $show_time ) :
        ?>
        <li class="match-overview__footer-item match-overview__footer-item--time">
          <span><?php esc_html_e( 'Time', 'necromancers' ); ?></span>
          <?php echo esc_html( get_the_time( get_option('time_format'), $event_id ) ); ?>
        </li>
        <?php
      endif;
      
      // Full Time (Duration)
      if ( $show_full_time && 'results' === $status ) :
        ?>
        <li class="match-overview__footer-item match-overview__footer-item--duration">
          <span><?php esc_html_e( 'Total Duration', 'necromancers' ); ?></span>
          <?php
          $full_time = get_post_meta( $event_id, 'sp_minutes', true );
          if ( '' === $full_time ) {
            $full_time = get_option( 'sportspress_event_minutes', 90 );
          }
          echo esc_html( $full_time ) . '\'';
          ?>
        </li>
        <?php
      endif;
      ?>

      <li class="match-overview__footer-item match-overview__footer-item--venue">
        <span><?php esc_html_e( 'Venue', 'necromancers' ); ?></span>
        <?php
        // Venue
        if ( $link_venues ) {
          the_terms( $event_id, 'sp_venue' );
        } else {
          $venues = get_the_terms( $event_id, 'sp_venue' );
          if ( $venues ) {
            echo implode( ', ', wp_list_pluck( $venues, 'name' ) );
          }
        }
        ?>
      </li>

      <?php
      // Season
      $seasons = get_the_terms( $event_id, 'sp_season' );
      if ( $seasons ) :
        ?>
        <li class="match-overview__footer-item match-overview__footer-item--season">
          <span><?php esc_html_e( 'Season', 'necromancers' ); ?></span>
          <?php
          $season = array_shift( $seasons );
          echo esc_html( $season->name );
          ?>
        </li>
        <?php
      endif;
      ?>
    </ul>
    <!-- Event Details / End -->

  </div>
</div>
