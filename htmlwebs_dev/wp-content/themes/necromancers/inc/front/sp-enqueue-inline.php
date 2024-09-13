<?php
/**
 * Enqueue inline styles for SportsPress.
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

if ( ! function_exists( 'necromancers_sp_enqueue_inline' ) ) {
  function necromancers_sp_enqueue_inline() {

    $uri = get_theme_file_uri();
    $custom_css = '';

    // Team Colors
    $teams = get_posts( array(
      'post_type'      => 'sp_team',
      'orderby'        => 'title',
      'order'          => 'ASC',
      'posts_per_page' => -1,
      'post_status'    => 'publish',
    ));

    $team_colors = [];
    if ( $teams ) {
      foreach ( $teams as $team ) {
        $team_id = $team->ID;
        $team_color = get_field( 'ncr_team_color', $team_id );
        if ( $team_color ) {
          $custom_css .= '
          .ncr-team-id-' . $team_id . ',
          .ncr-team-id-' . $team_id . ',
          .ncr-team-id-' . $team_id . ' {
            --team-color: ' . $team_color . ' !important;
            --team-color_rgb: ' . necromancers_hex_to_rgb( $team_color ) . ' !important;
          }';
        }
      }
    }

    // Character Colors
    $characters = get_terms( array(
      'taxonomy' => array( 'sp_position' )
    ) );

    foreach ( $characters as $character ) {
      $character_color = get_field( 'ncr_character_color', 'term_' . $character->term_id );
      if ( $character_color ) {
        $custom_css .= "
        .ncr-character-id-{$character->term_id} {
          --character-color: {$character_color};
        }";
      }
    }

    // Add custom styles
    wp_add_inline_style( 'necromancers-style', $custom_css );

  }

  add_action( 'wp_enqueue_scripts', 'necromancers_sp_enqueue_inline' );
}
