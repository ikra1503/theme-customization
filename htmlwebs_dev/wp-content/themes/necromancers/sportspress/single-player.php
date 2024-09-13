<?php
/**
 * The template for displaying Single Player
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.4.0
 */

get_header();

$defaults = array(
  'show_number' => get_option( 'sportspress_player_show_number', 'no' ) == 'yes' ? true : false,
  'show_name' => get_option( 'sportspress_player_show_name', 'no' ) == 'yes' ? true : false,
  'show_nationality' => get_option( 'sportspress_player_show_nationality', 'yes' ) == 'yes' ? true : false,
  'show_positions' => get_option( 'sportspress_player_show_positions', 'yes' ) == 'yes' ? true : false,
  'show_current_teams' => get_option( 'sportspress_player_show_current_teams', 'yes' ) == 'yes' ? true : false,
  'show_past_teams' => get_option( 'sportspress_player_show_past_teams', 'yes' ) == 'yes' ? true : false,
  'show_leagues' => get_option( 'sportspress_player_show_leagues', 'no' ) == 'yes' ? true : false,
  'show_seasons' => get_option( 'sportspress_player_show_seasons', 'no' ) == 'yes' ? true : false,
  'show_nationality_flags' => get_option( 'sportspress_player_show_flags', 'yes' ) == 'yes' ? true : false,
  'link_teams' => get_option( 'sportspress_link_teams', 'no' ) == 'yes' ? true : false,
  'show_age' => get_option( 'sportspress_player_show_age', 'yes' ) == 'yes' ? true : false,
  'show_player_birthday' => get_option( 'sportspress_player_show_birthday', 'no' ) == 'yes' ? true : false,
  'current_season' => get_option( 'sportspress_season', '' ),
  'show_total'     => get_option( 'sportspress_player_show_total', 'yes' ) == 'yes' ? true : false,
);

extract( $defaults, EXTR_SKIP );

// Color
$player_color = get_field( 'ncr_player_color' );

// Decorations
$player_decorations = get_theme_mod( 'necromancers_sp_player_bg_decorations', true );
?>

<main class="site-content player-info-page" id="wrapper">
  <div class="container container--large">
    <?php
    if ( ! isset( $player_id ) ) {
      $player_id = get_the_ID();
    }
    $player = new SP_Player( $player_id );

    // Current team
    $current_teams = get_post_meta( $player_id, 'sp_current_team' );
    $current_team_id = ! empty( $current_teams[0] ) ? $current_teams[0] : '';

    // Metrics
    $metrics = (array) get_post_meta( $player_id, 'sp_metrics', true );

    // Sections
    $player_sections = (array) get_option( 'sportspress_player_template_order', [
      'overview',
      'statistics',
      'achievements',
      'hardware',
      'stream',
      'youtube',
      'tiktok',
    ] );

    if ( ! empty( $player_sections ) ) :
      ?>
      <!-- Pagination -->
      <div class="team-carousel">
        <div class="swiper-container team-carousel__content js-player-carousel">
          <div class="swiper-wrapper">
            <?php
            foreach ( $player_sections as $key => $section ) {
              // Ignore templates that are unavailable or that have been turned off
              if ( 'content' === $section ) continue;
              $section_option = 'sportspress_player_show_' . $section;
              if ( 'yes' !== get_option( $section_option, sp_array_value( $section, 'default', 'yes' ) ) ) continue;
              // Render the template
              get_template_part( 'sportspress/player/section', $section, [
                'player_id'       => $player_id,
                'player'          => $player,
                'current_teams'   => $current_teams,
                'current_team_id' => $current_team_id,
                'defaults'        => $defaults,
                'metrics'         => $metrics,
              ]);
            }
            ?>
          </div>
          <ul class="swiper-pagination slick-dots"></ul>
        </div>
      </div>
      <?php
    endif;
    ?>

    <div class="team-player">
      <div class="team-player__photo">
        <?php
        // Player Photo
        if ( has_post_thumbnail() ) {
          the_post_thumbnail('necromancers-sp-fit-xl');
        } else {
          echo '<img src="'. get_template_directory_uri() . '/assets/img/placeholders/placeholder-sp-fit-lg.png" alt="' . esc_attr( sp_get_player_name( $player_id ) ). '">';
        }
        ?>
      </div>
      <div class="team-player__base">
        <?php if ( $player_decorations ) : ?>
          <!-- Decoration -->
          <div class="ncr-page-decor ncr-page-decor--<?php echo esc_attr( $player_color ); ?>">
            <div class="ncr-page-decor__layer-1">
              <div class="ncr-page-decor__layer-bg"></div>
            </div>
            <div class="ncr-page-decor__layer-2"></div>
            <div class="ncr-page-decor__layer-3">
              <div class="ncr-page-decor__layer-bg"></div>
            </div>
            <div class="ncr-page-decor__layer-4"></div>
            <div class="ncr-page-decor__layer-5"></div>
          </div>
          <!-- Decoration / End -->
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<?php
get_footer();
