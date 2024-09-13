<?php
/**
 * The template for displaying Single Team
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.7
 */

get_header();

$defaults = array(
  'link_teams' => get_option( 'sportspress_link_teams', 'no' ) == 'yes' ? true : false,
  'link_venues' => get_option( 'sportspress_link_venues', 'no' ) == 'yes' ? true : false,
);

extract( $defaults, EXTR_SKIP );

if ( ! isset( $team_id ) ) {
  $team_id = get_the_ID();
}

// Team
$team = new SP_Team( $team_id );

// Sections
$team_sections = (array) get_option( 'sportspress_team_template_order', [
  'overview',
  'statistics',
  'awards',
  'events',
] );

// Player List Layout
$player_list_layout  = get_theme_mod( 'necromancers_sp_team_player_list', 'slider' );

// Decorations
$team_decorations = get_theme_mod( 'necromancers_sp_team_bg_decorations', true );
?>

<main class="site-content team-info-page" id="wrapper">
  <div class="container container--large">
    <div class="row">
      <div class="col-lg-7">
        <?php if ( ! empty( $team_sections ) ) : ?>
          <div class="team-carousel">
            <div class="swiper-container team-carousel__content js-team-carousel">
              <div class="swiper-wrapper">
                <?php
                foreach ( $team_sections as $key => $section ) {
                  // Ignore templates that are unavailable or that have been turned off
                  if ( 'content' === $section ) continue;
                  $section_option = 'sportspress_team_show_' . $section;
                  if ( 'yes' !== get_option( $section_option, sp_array_value( $section, 'default', 'yes' ) ) ) continue;
                  // Render the template
                  get_template_part( 'sportspress/team/section', $section, [
                    'team_id'       => $team_id,
                    'team'          => $team,
                    'defaults'      => $defaults,
                  ]);
                }
                ?>
              </div>
              <ul class="swiper-pagination slick-dots"></ul>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php
  // Player List
  get_template_part(
    'sportspress/team/player-list',
    $player_list_layout,
    [
      'team'        => $team,
      'decorations' => $team_decorations
    ]
  );
  ?>
</main>

<?php
get_footer();
