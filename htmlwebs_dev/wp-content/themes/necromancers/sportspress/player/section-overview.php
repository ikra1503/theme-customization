<?php
/**
 * Player: Overview
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.4
 */

extract( $args['defaults'], EXTR_SKIP );

$player_id       = $args['player_id'];
$player          = $args['player'];
$current_teams   = $args['current_teams'];
$current_team_id = $args['current_team_id'];

// Countries
$countries = SP()->countries->countries;

// First & Last Name
$fname = isset( $args['metrics']['fname'] ) ? $args['metrics']['fname'] : '';
$lname = isset( $args['metrics']['lname'] ) ? $args['metrics']['lname'] : '';
?>

<div class="swiper-slide team-carousel__item" data-icon="lineups" data-hash="overview">
  <div class="row">
    <div class="col-lg-12 col-xl-6">
      <h3 class="player-info-subtitle h4 text-uppercase">
        <?php echo esc_html( $fname . ' ' . $lname ); ?>
      </h3>
      <h2 class="player-info-title h-lead-1"><?php echo esc_html( $player->post->post_title ); ?></h2>
      <div class="row">

        <?php
        // Age
        if ( $show_age ) :
          ?>
          <div class="col-6 col-md-4 col-lg-3 col-xl-4">
            <div class="player-info-detail">
              <div class="player-info-detail__label">
                <?php esc_html_e( 'Age', 'necromancers' ); ?>
              </div>
              <div class="player-info-detail__title">
                <?php echo esc_html( necromancers_get_age( get_the_date( 'm-d-Y', $player_id ) ) ); ?>
                <?php echo esc_html_e( 'Years', 'necromancers' ); ?>
              </div>
            </div>
          </div>
          <?php
        endif;
        ?>

        <?php
        // Birthday
        if ( $show_player_birthday ) :
          ?>
          <div class="col-6 col-md-4 col-lg-3 col-xl-4">
            <div class="player-info-detail">
              <div class="player-info-detail__label">
                <?php esc_html_e( 'Birthday', 'necromancers' ); ?>
              </div>
              <div class="player-info-detail__title">
                <?php echo esc_html( get_the_date( get_option( 'date_format'), $player_id ) ); ?>
              </div>
            </div>
          </div>
          <?php
        endif;
        ?>
        
        <?php
        // Current Team
        if ( $show_current_teams ) :
          if ( $current_teams ) :
            ?>
            <div class="col-6 col-md-4 col-lg-3 col-xl-4">
              <div class="player-info-detail">
                <div class="player-info-detail__label"><?php esc_html_e( 'Team', 'necromancers' ); ?></div>
                <?php
                $teams = array();
                foreach ( $current_teams as $team ):
                  $team_name = sp_team_name( $team );
                  if ( $link_teams ) {
                    $team_name = '<a href="' . get_post_permalink( $team ) . '">' . $team_name . '</a>';
                  }
                  $teams[] = $team_name;
                endforeach;
                $team_names_string = implode( ', ', $teams );
                ?>
                <div class="player-info-detail__title"><?php echo wp_kses_post( $team_names_string ); ?></div>
              </div>
            </div>
            <?php
          endif;
        endif;
        ?>

        <?php
        // Past Teams
        if ( $show_past_teams ) :
          $past_teams = $player->past_teams();

          if ( $past_teams ) :
            ?>
            <div class="col-6 col-md-4 col-lg-3 col-xl-4">
              <div class="player-info-detail">
                <div class="player-info-detail__label"><?php esc_html_e( 'Past Teams', 'necromancers' ); ?></div>
                <?php
                $teams = array();
                foreach ( $past_teams as $team ) {
                  $team_name = sp_team_name( $team );
                  if ( $link_teams ) {
                    $team_name = '<a href="' . get_post_permalink( $team ) . '">' . $team_name . '</a>';
                  }
                  $teams[] = $team_name;
                }
                $team_names_string = implode( ', ', $teams );
                echo '<div class="player-info-detail__title">' . $team_names_string . '</div>';
                ?>
              </div>
            </div>
            <?php
          endif;
        endif;
        ?>

        <?php
        // Nationality
        if ( $show_nationality ) :
          ?>
          <div class="col-6 col-md-4 col-lg-3 col-xl-4">
            <div class="player-info-detail">
              <div class="player-info-detail__label"><?php esc_html_e( 'Nationality', 'necromancers' ); ?></div>
              <?php
              $nationalities = $player->nationalities();
              if ( $nationalities && is_array( $nationalities ) ) {
                $values = array();
                foreach ( $nationalities as $nationality ):
                  $country_name = sp_array_value( $countries, $nationality, null );
                  $values[] = $country_name ? ( $show_nationality_flags ? '<img src="' . plugin_dir_url( SP_PLUGIN_FILE ) . 'assets/images/flags/' . strtolower( $nationality ) . '.png" class="player-info-detail__flag" alt="' . esc_attr( $nationality ) . '"> ' : '' ) . $country_name : '&mdash;';
                endforeach;
                $country_names_string = implode( ', ', $values );
                echo '<div class="player-info-detail__title">' . $country_names_string . '</div>';
              } else {
                echo '<div class="player-info-detail__title">' . esc_html__( 'n/a', 'necromancers' ) . '</div>';
              }
              ?>
            </div>
          </div>
          <?php
        endif;
        ?>

        <?php
        // Character (Position)
        if ( $show_positions ) :
          ?>
          <div class="col-6 col-md-4 col-lg-3 col-xl-4">
            <div class="player-info-detail">
            <div class="player-info-detail__label"><?php echo esc_html_e( 'Character', 'necromancers' ); ?></div>
              <?php
              $positions = $player->positions();
              if ( $positions && is_array( $positions ) ) {
                $position_names = array();
                foreach ( $positions as $position ) {
                  $position_names[] = $position->name;
                }
                $position_names_string = implode( ', ', $position_names );
                echo '<div class="player-info-detail__title">' . $position_names_string . '</div>';
              } else {
                echo '<div class="player-info-detail__title">' . esc_html__( 'n/a', 'necromancers' ) . '</div>';
              }
              ?>
            </div>
          </div>
          <?php
        endif;
        ?>

        <?php
        // Leagues
        if ( $show_leagues ) :
          ?>
          <div class="col-6 col-md-4 col-lg-3 col-xl-4">
            <div class="player-info-detail">
            <div class="player-info-detail__label"><?php echo esc_html_e( 'Leagues', 'necromancers' ); ?></div>
              <?php
              $leagues = $player->leagues();
              if ( $leagues && ! is_wp_error( $leagues ) ):
                $terms = array();
                foreach ( $leagues as $league ):
                  $terms[] = $league->name;
                endforeach;
                $terms_leagues_string = implode( ', ', $terms );
                echo '<div class="player-info-detail__title">' . $terms_leagues_string . '</div>';
              endif;
              ?>
            </div>
          </div>
          <?php
        endif;
        ?>

        <?php
        // Seasons
        if ( $show_seasons ) :
          ?>
          <div class="col-6 col-md-4 col-lg-3 col-xl-4">
            <div class="player-info-detail">
            <div class="player-info-detail__label"><?php echo esc_html_e( 'Seasons', 'necromancers' ); ?></div>
              <?php
              $seasons = $player->seasons();
              if ( $seasons && ! is_wp_error( $seasons ) ):
                $terms = array();
                foreach ( $seasons as $season ):
                  $terms[] = $season->name;
                endforeach;
                $terms_seasons_string = implode( ', ', $terms );
                echo '<div class="player-info-detail__title">' . $terms_seasons_string . '</div>';
              endif;
              ?>
            </div>
          </div>
          <?php
        endif;
        ?>

        <?php
        // Social Links
        if ( have_rows('ncr_player_social_links') ) :
          ?>
          <div class="col-6 col-md-4 col-lg-3 col-xl-4">
            <div class="player-info-detail">
              <div class="player-info-detail__label"><?php esc_html_e( 'Social', 'necromancers' ); ?></div>
              <ul class="social-menu social-menu--default">
                <?php
                while ( have_rows('ncr_player_social_links') ) : the_row();
                  $url = get_sub_field('ncr_player_social_link_url');
                  ?>
                  <li><a href="<?php echo esc_url( $url ); ?>" target="_blank"></a></li>
                  <?php
                endwhile;
                ?>
              </ul>
            </div>
          </div>
          <?php
        endif;
        ?>

      </div>

      <div class="content-text">
        <?php echo get_the_content(); ?>
      </div>
    </div>
  </div>
</div>
