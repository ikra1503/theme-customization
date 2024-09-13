<?php
/**
 * Player: Achievements
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.0
 */

extract( $args['defaults'], EXTR_SKIP );

$player_id       = $args['player_id'];
$player          = $args['player'];
$current_team_id = $args['current_team_id'];
$data            = $player->data(0);

// remove labels
unset( $data[0] );

// Display stats for current season or total
if ( ! empty( $current_season ) && ! $show_total ) {
  if ( isset( $data[ $current_season ] ) ) {
    $data = $data[ $current_season ];
  }
} else {
  if ( isset( $data[-1] )) {
    $data = $data[-1];
  }
}
?>

<div class="swiper-slide team-carousel__item" data-icon="achievements" data-hash="achievements">
  <div class="row">
    <div class="col-lg-12 col-xl-6">
      <h3 class="player-info-subtitle h5"><?php echo esc_html( $args['player']->post->post_title ); ?></h3>
      <h2 class="player-info-title h-lead-2 text-uppercase"><?php echo get_theme_mod( 'necromancers_sp_player_achievements_title', esc_html__( 'Achievements', 'necromancers' ) ); ?></h2>
      <div class="row">
        <div class="col-sm-12 col-md-8 col-xl-8">
          <?php
          if ( have_rows( 'ncr_player_section_achievements' ) ) :
            while ( have_rows( 'ncr_player_section_achievements' ) ) : the_row();

              // Primary Achievements
              if ( have_rows( 'ncr_player_section_achievements_primary' ) ) :
                ?>
                <div class="player-info-carousel" id="player-info-carousel-1">
                  <?php
                  while ( have_rows( 'ncr_player_section_achievements_primary' ) ) : the_row();
                    $icon     = get_sub_field( 'ncr_player_section_achievements_primary_icon' );
                    $title    = get_sub_field( 'ncr_player_section_achievements_primary_title' );
                    $subtitle = get_sub_field( 'ncr_player_section_achievements_primary_subtitle' );
                    $meta     = get_sub_field( 'ncr_player_section_achievements_primary_meta' );
                    ?>
                    <div class="player-info-detail player-info-detail--icon">
                      <div class="player-info-detail__icon player-info-detail__icon--lg">
                        <svg role="img" class="df-icon df-icon--<?php echo esc_attr( $icon ); ?>">
                          <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#<?php echo esc_attr( $icon ); ?>"/>
                        </svg>
                      </div>
                      <div class="player-info-detail__body">
                        <div class="player-info-detail__title"><?php echo esc_html( $title ); ?></div>
                        <div class="player-info-detail__label color-primary"><?php echo esc_html( $subtitle ); ?></div>
                        <div class="player-info-detail__label"><?php echo esc_html( $meta ); ?></div>
                      </div>
                    </div>
                    <?php
                  endwhile;
                  ?>
                </div>
                <?php
              endif;

              // Secondary Achievements
              if ( have_rows( 'ncr_player_section_achievements_secondary' ) ) :
                ?>
                <div class="player-info-carousel" id="player-info-carousel-2">
                  <?php
                  while ( have_rows( 'ncr_player_section_achievements_secondary' ) ) : the_row();
                    $icon     = get_sub_field( 'ncr_player_section_achievements_secondary_icon' );
                    $title    = get_sub_field( 'ncr_player_section_achievements_secondary_title' );
                    $subtitle = get_sub_field( 'ncr_player_section_achievements_secondary_subtitle' );
                    $meta     = get_sub_field( 'ncr_player_section_achievements_secondary_meta' );
                    ?>
                    <div class="player-info-detail player-info-detail--icon">
                      <div class="player-info-detail__icon player-info-detail__icon--lg">
                        <svg role="img" class="df-icon df-icon--<?php echo esc_attr( $icon ); ?>">
                          <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#<?php echo esc_attr( $icon ); ?>"/>
                        </svg>
                      </div>
                      <div class="player-info-detail__body">
                        <div class="player-info-detail__title"><?php echo esc_html( $title ); ?></div>
                        <div class="player-info-detail__label color-primary"><?php echo esc_html( $subtitle ); ?></div>
                        <div class="player-info-detail__label"><?php echo esc_html( $meta ); ?></div>
                      </div>
                    </div>
                    <?php
                  endwhile;
                  ?>
                </div>
                <?php
              endif;
            endwhile;
          endif;
          ?>
        </div>
      </div>

      <?php
      // 1. get all event posts
      $events = sp_get_posts('sp_event');

      // 2. get events if the player participated
      $performances_player = [];

      foreach ( $events as $event ) {
        // get performances from the event
        $performances = sp_get_performance( $event->ID );
        $performances_team = isset( $performances[ $current_team_id ] ) ? $performances[ $current_team_id ] : null;
        if ( $performances_team ) {
          if ( array_key_exists( $player_id, $performances_team ) ) {
            $performances_player[] = $performances[ $current_team_id ][ $player_id ];
          }
        }
      }

      // Performances
      $performances = get_theme_mod( 'necromancers_sp_player_achievements_records', [] );
      $performances_output = [];

      if ( $performances ) {
        foreach ( $performances as $performance ) {
          $performance_name = $performance['stat_post'];

          // get Performance post by 'post_name'
          if ( $performance_post = get_page_by_path( $performance_name, OBJECT, 'sp_performance' ) ) {
            $performance_id = $performance_post->ID;
          } else {
            $performance_id = 0;
          }

          if ( 'empty' === $performance_id || empty( $performance_name ) ) {
            continue; // skip if placebo
          };

          // 3. order posts by a higher value for the player (e.g. 'kills')
          necromancers_sort_by_highest_key( $performances_player, $performance_name );

          $value = isset( $performances_player[0][ $performance_name ] ) ? $performances_player[0][ $performance_name ] : 0;

           $performances_output[ $performance_name ] = [
            'id'              => $performance_id,
            'title'           => get_post_field( 'post_title', $performance_id ),
            'icon'            => isset( $icon ) && ! empty( $icon ) ? $icon : false,
            'custom_title'    => $performance['stat_title'],
            'value'           => $value,
          ];
        }
      }

      // 4. output the value
      ?>
      <div class="row row-between-xl-2col">
        <?php
        foreach ( $performances_output as $performance_key => $performance_value ) :
          $id    = $performance_value['id'];
          $value = $performance_value['value'];
          $title = isset( $performance_value['custom_title'] ) && ! empty( $performance_value['custom_title'] ) ? $performance_value['custom_title'] : esc_html__( 'Record', 'necromancers' ) . ' ' . $performance_value['title'];
          ?>
          <div class="col-md-4 col-xl-4">
            <div class="player-info-detail player-info-detail--icon">
              <div class="player-info-detail__icon">
                <?php
                // icon
                if ( has_post_thumbnail( $id ) ) {
                  the_post_thumbnail(
                    $id,
                    'sportspress-fit-mini',
                    array(
                      'title' => sp_get_singular_name( $id ),
                    )
                  );
                } else {
                  echo '<svg role="img" class="df-icon df-icon--' . necromancers_sp_get_icon( $id, false ) . '">
                    <use xlink:href="' . get_template_directory_uri() . '/assets/img/necromancers.svg#' . necromancers_sp_get_icon( $id, false ) . '"/>
                  </svg>';
                }
                ?>
              </div>
              <div class="player-info-detail__body">
                <div class="player-info-detail__title"><?php echo esc_html( $value ); ?></div>
                <div class="player-info-detail__label"><?php echo wp_kses_post( $title ); ?></div>
              </div>
            </div>
          </div>
          <?php
        endforeach;
        ?>
      </div>
      
    </div>
  </div>
</div>
