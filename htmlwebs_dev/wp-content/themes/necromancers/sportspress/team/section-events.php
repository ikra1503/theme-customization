<?php
/**
 * Team: Events
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.5.1
 */

extract( $args['defaults'], EXTR_SKIP );

$team_id    = $args['team_id'];
$team       = $args['team'];
?>

<div class="swiper-slide team-carousel__item" data-icon="overview" data-hash="events">
  <div class="row">
    <div class="col-lg-11">
      <h3 class="player-info-subtitle h4 text-uppercase"><?php echo esc_html( $team->post->post_title ); ?></h3>
      <h2 class="player-info-title h-lead-1 text-uppercase"><?php echo get_theme_mod( 'necromancers_sp_team_events_title', esc_html__( 'Events', 'necromancers' ) ); ?></h2>

      <div class="team-carousel-tabs">
        <div class="team-carousel-tabs__content tab-content">
          <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
            <?php
            $args_last_match = array(
              'post_type'      => 'sp_event',
              'post_id'        => $team_id,
              'posts_per_page' => 1,
              'orderby'        => 'date',
              'order'          => 'DESC',
            );

            $query_last_match = new WP_Query( $args_last_match );

            if ( $query_last_match->have_posts() ) {
              while ( $query_last_match->have_posts() ) {
                $query_last_match->the_post();
                $event_id = get_the_ID();
                sp_get_template(
                  'event/ncr-event-block.php',
                  [
                    'id'          => $event_id,
                    'team'        => $team_id,
                    'status'      => 'publish',
                    'number'      => 1,
                    'show_origin' => true,
                  ]
                );
              }
              wp_reset_postdata();
            }
            ?>
          </div>
          <div class="tab-pane fade" id="tab-2" role="tabpanel">
            <?php
            $args_future_match = array(
              'post_type'      => 'sp_event',
              'post_id'        => $team_id,
              'post_status'    => 'future',
              'posts_per_page' => 1,
              'orderby'        => 'date',
              'order'          => 'ASC',
            );

            $query_feature_match = new WP_Query( $args_future_match );

            if ( $query_feature_match->have_posts() ) {
              while ( $query_feature_match->have_posts() ) {
                $query_feature_match->the_post();
                $future_event_id = get_the_ID();
                sp_get_template(
                  'event/ncr-event-block.php',
                  [
                    'id'          => $future_event_id,
                    'team'        => $team_id,
                    'status'      => 'future',
                    'number'      => 1,
                    'show_origin' => true,
                  ]
                );
              }
              wp_reset_postdata();
            }
            ?>
          </div>
        </div>
        <ul class="team-carousel-tabs__navigation nav" role="tablist">
          <li class="nav-item">
            <a href="#tab-1" role="tab" data-toggle="tab" class="active">Last Match</a>
          </li>
          <li class="nav-item">
            <a href="#tab-2" role="tab" data-toggle="tab" class="">Next Match</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
