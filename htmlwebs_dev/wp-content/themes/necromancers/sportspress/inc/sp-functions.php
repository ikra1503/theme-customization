<?php
/**
 * Sportspress Functions
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.4.0
 */


/**
 * General: Remove Align, Paddings, Frontend styles
 */
if ( ! function_exists( 'necromancers_sp_general_removal' ) ) {
  function necromancers_sp_general_removal( $options = array() ) {
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'id' ), [ 'sportspress_table_text_align', 'sportspress_table_padding', 'sportspress_styles'] ) ) {
        unset( $options[ $index ] );
      }
    }
    return $options;
  }
}
add_filter( 'sportspress_script_styling_options', 'necromancers_sp_general_removal' );

/**
 * General: Remove SportsPress Color schemes
 */
if ( ! function_exists( 'necromancers_sp_general_remove_script_styling_options' ) ) {
  function necromancers_sp_general_remove_script_styling_options( $options = array() ) {
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'type' ), array( 'colors' ) ) ) {
        unset( $options[ $index ] );
      }
    }
    return $options;
  }
}
add_filter( 'sportspress_script_styling_options', 'necromancers_sp_general_remove_script_styling_options' );


/**
 * Events - Remove Tabs
 */
if ( ! function_exists( 'necromancers_remove_event_tabs' ) ) {
  function necromancers_remove_event_tabs( $options = array() ) {
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'type' ), array( 'event_tabs' ) ) ) {
        unset( $options[ $index ] );
      }
    }
    return $options;
  }
}
add_filter( 'sportspress_event_options', 'necromancers_remove_event_tabs' );

/**
 * Events: Blocks
 * removes pagination, pagination rows
 */
if ( ! function_exists( 'necromancers_event_blocks_pagination_remove' ) ) {
  function necromancers_event_blocks_pagination_remove( $options = array() ) {
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'id' ), [ 'sportspress_event_blocks_paginated', 'sportspress_event_blocks_rows' ] ) ) {
        unset( $options[ $index ] );
      }
    }
    return $options;
  }
}
add_filter( 'sportspress_event_blocks_options', 'necromancers_event_blocks_pagination_remove' );

/**
 * Events: Comments
 */
if ( ! function_exists( 'necromancers_event_comments_remove' ) ) {
  function necromancers_event_comments_remove( $options = array() ) {
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'id' ), [ 'sportspress_event_comment_status' ] ) ) {
        unset( $options[ $index ] );
      }
    }
    return $options;
  }
}
add_filter( 'sportspress_event_options', 'necromancers_event_comments_remove' );

/**
 * Events: Venue
 */
if ( ! function_exists( 'necromancers_event_venue_remove' ) ) {
  function necromancers_event_venue_remove( $options = array() ) {
    return $options = [];
  }
}
add_filter( 'sportspress_venue_options', 'necromancers_event_venue_remove' );

/**
 * Events: Countdown
 */
if ( ! function_exists( 'necromancers_event_countdown_remove' ) ) {
  function necromancers_event_countdown_remove( $options = array() ) {
    return $options = [];
  }
}
add_filter( 'sportspress_countdown_options', 'necromancers_event_countdown_remove' );


/**
 * Team: Remove Tabs
 */
if ( ! function_exists( 'necromancers_remove_team_tabs' ) ) {
  function necromancers_remove_team_tabs( $options = array() ) {
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'type' ), array( 'team_tabs' ) ) ) {
        unset( $options[ $index ] );
      }
    }
    return $options;
  }
}
add_filter( 'sportspress_team_options', 'necromancers_remove_team_tabs' );

/**
 * Team: Remove Comments
 */
if ( ! function_exists( 'necromancers_team_comments_remove' ) ) {
  function necromancers_team_comments_remove( $options = array() ) {
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'id' ), [ 'sportspress_team_comment_status' ] ) ) {
        unset( $options[ $index ] );
      }
    }
    return $options;
  }
}
add_filter( 'sportspress_team_options', 'necromancers_team_comments_remove' );


/**
 * Player - Remove Tabs
 */
if ( ! function_exists( 'necromancers_remove_player_tabs' ) ) {
  function necromancers_remove_player_tabs( $options = array() ) {
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'type' ), array( 'player_tabs' ) ) ) {
        unset( $options[ $index ] );
      }
    }
    return $options;
  }
  add_filter( 'sportspress_player_options', 'necromancers_remove_player_tabs' );
}



/**
 * Staff - Remove Layout Builder
 */
if ( ! function_exists( 'necromancers_remove_staff_layout' ) ) {
  function necromancers_remove_staff_layout( $options = array() ) {
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'type' ), array( 'staff_layout', 'staff_tabs' ) ) ) {
        unset( $options[ $index ] );
      }
    }
    return $options;
  }
  add_filter( 'sportspress_staff_options', 'necromancers_remove_staff_layout' );
}


/**
 * Event - Logos options
 */
if ( ! function_exists( 'necromancers_event_logos_options' ) ) {
  function necromancers_event_logos_options( $options = array() ) {

    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'id' ), [
        'sportspress_event_logos_format',
        'sportspress_event_logos_show_team_names',
        'sportspress_event_logos_show_results',
        'sportspress_event_logos_show_time',
        ] ) ) {
        unset( $options[ $index ] );
      }
    }

    return $options;
  }
}
add_filter( 'sportspress_event_logo_options', 'necromancers_event_logos_options' );


/**
 * Convert date to Age
 */
if ( ! function_exists( 'necromancers_get_age' ) ) {
  function necromancers_get_age( $date, $show_years = false ) {
    $date = explode( '-', $date );
    $age = ( date( 'md', date( 'U', mktime( 0, 0, 0, $date[0], $date[1], $date[2] ) ) ) > date('md')
      ? ( ( date( 'Y' ) - $date[2] ) - 1 )
      : ( date( 'Y' ) - $date[2] ) );

    if ( $show_years ) {
      $age = $age . ' ' . _n( 'Year', 'Years', $age, 'necromancers' );
    }

    return $age;
  }
}


/**
 * Get main result option
 */
if ( ! function_exists( 'necromancers_sportspress_primary_result' ) ) {
  function necromancers_sportspress_primary_result() {
    $primary_result = 'score';
    if ( get_option( 'sportspress_primary_result' ) != null ) {
      $primary_result = get_option( 'sportspress_primary_result' );
    }

    return $primary_result;
  }
}



/**
 * Get Icon of SportsPress variable
 */
if ( ! function_exists( 'necromancers_sp_get_icon' ) ) {
  function necromancers_sp_get_icon( $post = 0, $is_prefixed = true ) {
    $icon = get_post_meta( $post, 'sp_icon', true );
    if ( '' !== $icon ) {
      if ( ! $is_prefixed ) {
        return str_replace( 'ncr-', '', $icon );
      } else {
        return $icon;
      }
    } else {
      return 'marker';
    }
  }
}


/**
 * Get Icon Color of SportsPress variable
 */
if ( ! function_exists( 'necromancers_sp_get_icon_color' ) ) {
  function necromancers_sp_get_icon_color( $post = 0, $default_color = '#222222' ) {
    $icon_color = get_post_meta( $post, 'sp_color', true );
    if ( '' !== $icon_color ) {
      return $icon_color;
    } else {
      return $default_color;
    }
  }
}


/**
 * Get array of Performance IDs
 */
if ( ! function_exists( 'necromancers_get_performance_ids' ) ) {
  function necromancers_get_performance_ids() {
    $performance_ids = array();
    $performance_posts = get_posts( array(
      'posts_per_page' => -1,
      'post_type'      => 'sp_performance'
    ) );
    foreach ( $performance_posts as $post ):
      $performance_ids[ $post->post_name ] = $post->ID;
    endforeach;

    return $performance_ids;
  }
}




/**
 * Removes Team Colors (SportsPress Pro)
 */
if ( class_exists('SportsPress_Team_Colors')) {
  if( !function_exists( 'necromancers_remove_teamcolors_metaboxes' ) ) {
    function necromancers_remove_teamcolors_metaboxes() {
      remove_meta_box( 'sp_colorssdiv', 'sp_team', 'normal' );
    }
    add_action( 'do_meta_boxes' , 'necromancers_remove_teamcolors_metaboxes' );
  }
}


/**
 * Get last event
 */
if ( ! function_exists( 'necromancers_sp_last_event_id' ) ) {
  function necromancers_sp_last_event_id( $team_id = null ) {
    $events = get_posts( array(
      'post_type'      => 'sp_event',
      'posts_per_page' => 1,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'post_status'    => 'publish',
      'fields'         => 'ids',
      'meta_query' => array(
        array(
          'key'     => 'sp_team',
          'value'   => $team_id,
          'compare' => '=',
        )
      )
    ));

    $event_id = '';
    if ( ! empty( $events ) ) {
      $event_id = $events[0];
    }

    return $event_id;
  }
}


/**
 * Adds a class with current Team ID on Single Player pages
 */
if ( ! function_exists( 'necromancers_add_team_id_to_player' ) ) {
  function necromancers_add_team_id_to_player( $classes ) {
    if ( is_singular( 'sp_player' ) ) {
        global $post;
        $current_teams = get_post_meta( $post->ID, 'sp_current_team', false );
        $current_team_id = false;
        if ( $current_teams && is_array( $current_teams ) ) {
          $current_team_id = $current_teams[0];
        }
        $classes[] = 'necromancers-current-team-id-' . $current_team_id;
    }
    return $classes;
  }
  add_filter( 'body_class', 'necromancers_add_team_id_to_player' );
}



/**
 * Adds SVG sprite to ACF icon picker
 */
add_filter( 'acf_svg_icon_filepath', 'necromancers_svg_icon_filepath' );
function necromancers_svg_icon_filepath( $filepath ) {
  if ( is_file( get_template_directory() . '/assets/img/necromancers.svg' ) ) {
    $filepath[] = get_template_directory() . '/assets/img/necromancers.svg';
  }
  return $filepath;
}


/**
 * Event
 */

if ( ! function_exists( 'necromancers_add_custom_sections_to_event' ) ) {
  function necromancers_add_custom_sections_to_event( $options = [] ) {
    unset( $options['logos'] );
    unset( $options['excerpt'] );

    $options['overview'] = [
      'title' => esc_html__( 'Overview', 'necromancers' ),
      'option' => 'sportspress_event_show_overview',
      'action' => 'sportspress_output_event_overview',
      'default' => 'yes',
    ];

    $options['statistics'] = [
      'title' => esc_html__( 'Statistics', 'necromancers' ),
      'option' => 'sportspress_event_show_statistics',
      'action' => 'sportspress_output_event_statistics',
      'default' => 'yes',
    ];

    $options['lineups'] = [
      'title' => esc_html__( 'Lineups', 'necromancers' ),
      'option' => 'sportspress_event_show_lineups',
      'action' => 'sportspress_output_event_lineups',
      'default' => 'yes',
    ];

    $options['video'] = [
      'title' => esc_html__( 'Video', 'necromancers' ),
      'option' => 'sportspress_event_show_video',
      'action' => 'sportspress_output_event_video',
      'default' => 'yes',
    ];

    return $options;
  }
}
add_filter( 'sportspress_before_event_template', 'necromancers_add_custom_sections_to_event' );

if ( ! function_exists( 'necromancers_remove_default_sections_for_event' ) ) {
  function necromancers_remove_default_sections_for_event( $options = array() ) {
    unset( $options['video'] );
    unset( $options['details'] );
    unset( $options['venue'] );
    unset( $options['results'] );
    unset( $options['performance'] );

    return $options;
  }
}
add_filter( 'sportspress_after_event_template', 'necromancers_remove_default_sections_for_event' );


if ( ! function_exists( 'necromancers_event_performance_options' ) ) {
  function necromancers_event_performance_options( $options = [] ) {

    // Remove default Player Order option
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'id' ), array( 'sportspress_event_performance_sections' ) ) ) {
        unset( $options[ $index ] );
      }
    }

    return $options;
  }
}
add_filter( 'sportspress_performance_options', 'necromancers_event_performance_options' );



/**
 * Player
 */

if ( ! function_exists( 'necromancers_add_custom_sections_to_player' ) ) {
  function necromancers_add_custom_sections_to_player( $options = array() ) {
    unset( $options['selector'] );
    unset( $options['photo'] );
    unset( $options['details'] );
    unset( $options['excerpt'] );

    $options['overview'] = [
      'title' => esc_html__( 'Overview', 'necromancers' ),
      'option' => 'sportspress_player_show_overview',
      'action' => 'sportspress_player_output_overview',
      'default' => 'yes',
    ];

    $options['statistics'] = [
      'title' => esc_html__( 'Statistics', 'necromancers' ),
      'option' => 'sportspress_player_show_stats',
      'action' => 'sportspress_player_output_stats',
      'default' => 'yes',
    ];

    $options['achievements'] = [
      'title' => esc_html__( 'Achievements', 'necromancers' ),
      'option' => 'sportspress_player_show_achievements',
      'action' => 'sportspress_player_output_achievements',
      'default' => 'yes',
    ];

    $options['hardware'] = [
      'title' => esc_html__( 'Hardware', 'necromancers' ),
      'option' => 'sportspress_player_show_hardware',
      'action' => 'sportspress_player_output_hardware',
      'default' => 'yes',
    ];

    $options['stream'] = [
      'title' => esc_html__( 'Stream', 'necromancers' ),
      'option' => 'sportspress_player_show_stream',
      'action' => 'sportspress_player_output_stream',
      'default' => 'yes',
    ];

    $options['youtube'] = [
      'title' => esc_html__( 'YouTube', 'necromancers' ),
      'option' => 'sportspress_player_show_youtube',
      'action' => 'sportspress_player_output_youtube',
      'default' => 'no',
    ];

    $options['tiktok'] = [
      'title' => esc_html__( 'TikTok', 'necromancers' ),
      'option' => 'sportspress_player_show_tiktok',
      'action' => 'sportspress_player_output_tiktok',
      'default' => 'no',
    ];

    return $options;
  }
}
add_filter( 'sportspress_before_player_template', 'necromancers_add_custom_sections_to_player' );


// Player: Lineup Layout
if ( ! function_exists( 'necromancers_add_custom_options_to_player' ) ) {
  function necromancers_add_custom_options_to_player( $options = [] ) {

    // Remove default Player Order option
    foreach ( $options as $index => $option ) {
      if ( in_array( sp_array_value( $option, 'id' ), array( 'sportspress_event_player_sort' ) ) ) {
        unset( $options[ $index ] );
      }
    }

    // add Lineup layout option
    $options[] = [
      'title'   => esc_html__( 'Lineup Layout', 'necromancers' ),
      'id'      => 'sportspress_event_player_lineup_layout',
      'default' => 'layout-1',
      'type'    => 'select',
      'options' => [
        'layout-1' => esc_html__( 'Players + Heroes', 'necromancers' ),
        'layout-2' => esc_html__( 'Heroes + Statistics', 'necromancers' ),
        'layout-3' => esc_html__( 'Players + Statistics', 'necromancers' ),
      ],
    ];

    return $options;
  }
}
add_filter( 'sportspress_eventplayer_options', 'necromancers_add_custom_options_to_player' );


/**
 * Team
 */

if ( ! function_exists( 'necromancers_add_custom_sections_to_team' ) ) {
  function necromancers_add_custom_sections_to_team( $options = array() ) {
    unset( $options['logo'] );
    unset( $options['excerpt'] );

    $options['overview'] = [
      'title' => esc_html__( 'Overview', 'necromancers' ),
      'option' => 'sportspress_team_show_overview',
      'action' => 'sportspress_team_output_overview',
      'default' => 'yes',
    ];

    $options['statistics'] = [
      'title' => esc_html__( 'Statistics', 'necromancers' ),
      'option' => 'sportspress_team_show_statistics',
      'action' => 'sportspress_team_output_statistics',
      'default' => 'yes',
    ];

    $options['awards'] = [
      'title' => esc_html__( 'Awards', 'necromancers' ),
      'option' => 'sportspress_team_show_awards',
      'action' => 'sportspress_team_output_awards',
      'default' => 'yes',
    ];

    $options['events'] = [
      'title' => esc_html__( 'Events', 'necromancers' ),
      'option' => 'sportspress_team_show_events',
      'action' => 'sportspress_team_output_events',
      'default' => 'yes',
    ];

    return $options;
  }
  add_filter( 'sportspress_before_team_template', 'necromancers_add_custom_sections_to_team' );
}

if ( ! function_exists( 'necromancers_remove_team_sections_after' ) ) {
  function necromancers_remove_team_sections_after( $options = array() ) {
    unset( $options['link'] );
    unset( $options['details'] );
    unset( $options['staff'] );

    return $options;
  }
  add_filter( 'sportspress_after_team_template', 'necromancers_remove_team_sections_after' );
}

/**
 * Allow to remove method for an hook when, it's a class method used and class don't have variable, but you know the class name :)
 */
if ( ! function_exists( 'necromancers_remove_filters_for_anonymous_class' ) ) {
  function necromancers_remove_filters_for_anonymous_class( $hook_name = '', $class_name ='', $method_name = '', $priority = 0 ) {
    global $wp_filter;

    // Take only filters on right hook name and priority
    if ( !isset($wp_filter[$hook_name][$priority]) || !is_array($wp_filter[$hook_name][$priority]) )
      return false;

    // Loop on filters registered
    foreach( (array) $wp_filter[$hook_name][$priority] as $unique_id => $filter_array ) {
      // Test if filter is an array ! (always for class/method)
      if ( isset($filter_array['function']) && is_array($filter_array['function']) ) {
        // Test if object is a class, class and method is equal to param !
        if ( is_object($filter_array['function'][0]) && get_class($filter_array['function'][0]) && get_class($filter_array['function'][0]) == $class_name && $filter_array['function'][1] == $method_name ) {
          if ( is_a( $wp_filter[$hook_name], 'WP_Hook' ) ) {
            unset( $wp_filter[$hook_name]->callbacks[$priority][$unique_id] );
          }
          else {
            unset($wp_filter[$hook_name][$priority][$unique_id]);
          }
        }
      }
    }

    return false;
  }
}

// Player
necromancers_remove_filters_for_anonymous_class( 'sportspress_after_player_template', 'SportsPress_Calendars', 'add_player_template', 40 );

// Team
necromancers_remove_filters_for_anonymous_class( 'sportspress_after_team_template', 'SportsPress_Player_Lists', 'add_team_template', 20 );
necromancers_remove_filters_for_anonymous_class( 'sportspress_after_team_template', 'SportsPress_League_Tables', 'add_team_template', 30 );
necromancers_remove_filters_for_anonymous_class( 'sportspress_after_team_template', 'SportsPress_Calendars', 'add_team_template', 40 );

/**
 * Dequeue scripts
 */
if ( ! function_exists( 'necromancers_remove_sp_style' ) ) {
  function necromancers_remove_sp_style() {
    wp_dequeue_style( 'sportspress-style' );
  }
  add_action( 'wp_enqueue_scripts', 'necromancers_remove_sp_style' );
}


/**
 * Staff
 */

// Enables Staff archives
if ( ! function_exists( 'necromancers_sp_staff_customize' ) ) {
  function necromancers_sp_staff_customize( $defaults) {
    return array_merge( $defaults, array(
      'has_archive' => true,
      'query_var'   => true,
    ));
  }
}
add_filter( 'sportspress_register_post_type_staff', 'necromancers_sp_staff_customize' );

// Display all Staff member on the Staff Archive
add_action( 'pre_get_posts', 'necromacners_sp_staff_archive' );
function necromacners_sp_staff_archive( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'sp_staff' ) ) {
    $query->set( 'posts_per_page', '-1' );
  }
}
