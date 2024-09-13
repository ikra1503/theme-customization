<?php
/**
 * Team: Overview
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.4
 */

extract( $args['defaults'], EXTR_SKIP );

$team_id    = $args['team_id'];
$team       = $args['team'];

$data = [];

// Leagues
$terms = get_the_terms( $team_id, 'sp_league' );
if ( $terms ):
  $leagues = [];
  foreach ( $terms as $term ):
    $leagues[] = $term->name;
  endforeach;
  $data[ esc_html__( 'Leagues', 'necromancers' ) ] = implode( ', ', $leagues );
endif;

// Seasons
$terms = get_the_terms( $team_id, 'sp_season' );
if ( $terms ):
  $seasons = [];
  foreach ( $terms as $term ):
    $seasons[] = $term->name;
  endforeach;
  $data[ esc_html__( 'Seasons', 'necromancers' ) ] = implode( ', ', $seasons );
endif;

// Venues
$terms = get_the_terms( $team_id, 'sp_venue' );
if ( $terms ):
  if ( get_option( 'sportspress_team_link_venues', 'no' ) === 'yes' ):
    $data[ esc_html__( 'Home', 'necromancers' ) ] = get_the_term_list( $team_id, 'sp_venue', '', ', ' );
  else:
    $venues = [];
    foreach ( $terms as $term ):
      $venues[] = $term->name;
    endforeach;
    $data[ esc_html__( 'Home', 'necromancers' ) ] = implode( ', ', $venues );
  endif;
endif;
?>

<div class="swiper-slide team-carousel__item" data-icon="team-overview" data-hash="overview">
  <div class="row">
    <div class="col-lg-11">
      <h3 class="player-info-subtitle h4 text-uppercase"><?php echo esc_html( $team->post->post_title ); ?></h3>
      <h2 class="player-info-title h-lead-1 text-uppercase"><?php echo get_theme_mod( 'necromancers_sp_team_overview_title', esc_html__( 'Overview', 'necromancers' ) ); ?></h2>

      <div class="row">
        <?php foreach( $data as $label => $value ) : ?>
          <div class="col-6 col-md-4 col-xl-4">
            <div class="player-info-detail">
              <div class="player-info-detail__label"><?php echo esc_html( $label ); ?></div>
              <div class="player-info-detail__title"><?php echo wp_kses_post( $value ); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="content-text">
        <?php echo get_the_content(); ?>
      </div>
    </div>
  </div>
</div>
