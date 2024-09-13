<?php
/**
 * Demo Import
 * 
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

if ( ! function_exists( 'necromancers_ocdi_import_demo_files' ) ) {
  // Import content, widgets and theme options
  function necromancers_ocdi_import_demo_files() {
    return [
      [
        'import_file_name'             => 'Default',
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/content.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo/widgets.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo/customizer.dat',
        'import_preview_image_url'     => get_template_directory_uri() . '/inc/demo/screenshot.png',
        'preview_url'                  => 'https://necromancers-wp.dan-fisher.dev',
      ]
    ];
  }
}
add_filter( 'pt-ocdi/import_files', 'necromancers_ocdi_import_demo_files' );


// Assign Front Page and Posts Page and menu locations, options etc.
if ( ! function_exists( 'necromancers_ocdi_after_import_setup' ) ) {
  function necromancers_ocdi_after_import_setup( $selected_import ) {

    $import_sport_demo = $selected_import['import_file_name'];

    // Assign menus to their locations.
    $primary_menu = get_term_by( 'name', esc_html__( 'Primary Menu', 'necromancers' ), 'nav_menu' );

    if ( isset( $primary_menu->term_id ) ) {
      set_theme_mod( 'nav_menu_locations', [
        'primary'     => $primary_menu->term_id,
      ]);
    }

    // Assign home and posts page (blog page).
    $front_page_id = get_page_by_title( 'Landing - Image' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
    update_option( 'posts_per_page', 16 );

    // Set LOL as a default sport
    SP_Admin_Sports::apply_preset( 'lol' );
    update_option('sportspress_sport', 'lol');

    // Update Primary Result
    update_option( 'sportspress_primary_result', 'score' );

    // SportsPress: General
    update_option( 'sportspress_enable_responsive_tables', 'no');


    // SportsPress: Events
    // Event Options
    update_option( 'sportspress_event_show_day', 'yes' );
    update_option( 'sportspress_event_show_full_time', 'yes' );

    // Event Results
    update_option( 'sportspress_event_show_outcome', 'yes' );

    // Box Score
    update_option( 'sportspress_event_show_total', 'no' );
    update_option( 'sportspress_event_performance_columns', 'manual' );
    update_option( 'sportspress_event_performance_stars_type', 1 );
    update_option( 'sportspress_event_show_player_numbers', 'no' );

    // Event List
    update_option( 'sportspress_event_list_show_logos', 'yes');
    update_option( 'sportspress_event_list_title_format', 'teams' );
    update_option( 'sportspress_event_list_rows', 4 );

    // Event Blocks
    update_option( 'sportspress_event_blocks_show_title', 'yes');
    update_option( 'sportspress_event_blocks_show_league', 'yes');
    update_option( 'sportspress_event_blocks_show_season', 'yes');


    // SportsPress: Teams
    // League Tables
    update_option( 'sportspress_table_increment', 'yes');


    // SportsPress: Players
    // Details
    update_option( 'sportspress_player_show_name', 'yes');
    update_option( 'sportspress_player_show_past_teams', 'no' );
    update_option( 'sportspress_player_show_leagues', 'yes');

    // Birthday
    update_option( 'sportspress_player_show_age', 'yes');

    // Statistics
    update_option( 'sportspress_player_show_total', 'yes');
    update_option( 'sportspress_player_show_career_total', 'yes');
    

    // SportsPress: Staff
    update_option( 'sportspress_staff_show_flags', 'no' );
    update_option( 'sportspress_staff_show_birthday', 'yes');
    update_option( 'sportspress_staff_show_age', 'yes');
  }
}
add_action( 'pt-ocdi/after_import', 'necromancers_ocdi_after_import_setup' );

// Disable branding
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
