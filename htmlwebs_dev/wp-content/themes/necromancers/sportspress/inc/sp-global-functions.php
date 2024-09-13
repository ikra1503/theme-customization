<?php
/**
 * Sportspress Global Functions
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

/**
 * SportsPress Presets
 */

// Sets custom 'necromancers_current_sport_preset' option based on 'sportspress_sport'
if ( ! function_exists( 'necromancers_sp_current_sport_preset' ) ) {
  function necromancers_sp_current_sport_preset() {
    $current_sport = get_option( 'sportspress_sport', 'lol' );

    if ( 'none' == $current_sport ) {
      $current_sport = 'lol';
    }
    update_option( 'necromancers_current_sport_preset', $current_sport );
  }
  add_action( 'sportspress_init', 'necromancers_sp_current_sport_preset' );
}


// Adds args depends on current preset
if ( ! function_exists( 'necromancers_sp_preset_options' ) ) {
  function necromancers_sp_preset_options() {
    $current_theme_preset = get_option( 'necromancers_current_sport_preset', 'lol' );

    if ( 'csgo' == $current_theme_preset ) {
      $preset     = 'csgo';
      $body_class = 'ncr-template-csgo';
    } elseif ( 'dota2' == $current_theme_preset ) {
      $preset     = 'dota2';
      $body_class = 'ncr-template-dota2';
    } else {
      $preset     = 'lol';
      $body_class = 'ncr-template-lol';
    }

    $args = array(
      'preset'     => $preset,
      'body_class' => $body_class
    );

    return $args;
  }
}


// Checks what preset is active
if ( ! function_exists( 'necromancers_sp_preset' ) ) {
  function necromancers_sp_preset( $preset_slug ) {
    $args = necromancers_sp_preset_options();
    return ( $args['preset'] == $preset_slug ) ? true : false;
  }
}


// Adds class to body depends on active preset
if ( ! function_exists( 'necromancers_preset_body_class' ) ) {
  function necromancers_preset_body_class( $classes ) {
    $args = necromancers_sp_preset_options();
    $classes[] = $args['body_class'];
    return $classes;
  }
  add_filter( 'body_class', 'necromancers_preset_body_class' );
}


// Adds class to body depends on active preset (admin)
if ( ! function_exists( 'necromancers_preset_admin_body_class' ) ) {
  function necromancers_preset_admin_body_class( $classes ) {
    $args = necromancers_sp_preset_options();
    $current_sport = $args['body_class'];

    return "$classes $current_sport";
  }
  add_filter( 'admin_body_class', 'necromancers_preset_admin_body_class' );
}
