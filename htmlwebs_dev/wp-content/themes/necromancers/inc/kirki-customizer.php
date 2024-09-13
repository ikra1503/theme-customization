<?php
/**
 * Kirki configuration
 * 
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.5.0
 */

// Duotone Effects
$duotone_effects = [
  'base'      => esc_html__( 'Base', 'necromancers' ),
  'purple'    => esc_html__( 'Purple', 'necromancers' ),
  'blue'      => esc_html__( 'Blue', 'necromancers' ),
  'red'       => esc_html__( 'Red', 'necromancers' ),
  'no_effect' => esc_html__( 'No Effect', 'necromancers' ),
];


/**
 * Config
 */

if ( class_exists( 'SportsPress' ) ) {
  // Event Results
  $sp_results_posts = get_posts( [
    'post_type'      => 'sp_result',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
  ] );

  $sp_results = [];
  if ( $sp_results_posts ) {
    foreach( $sp_results_posts as $sp_result ){
      $sp_results[ $sp_result->post_name ] = $sp_result->post_title;
    }
  }

  // Performances
  $sp_performances_posts = get_posts( [
    'post_type'      => 'sp_performance',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
  ] );

  $sp_performances = [];
  if ( $sp_performances_posts ) {
    foreach( $sp_performances_posts as $sp_performance ){
      $sp_performances[ $sp_performance->post_name ] = $sp_performance->post_title;
    }
  }

  // Statistics
  $sp_statistics_posts = get_posts( [
    'post_type'      => 'sp_statistic',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
  ] );

  $sp_statistics = [];
  if ( $sp_statistics_posts ) {
    foreach( $sp_statistics_posts as $sp_statistic ){
      $sp_statistics[ $sp_statistic->post_name ] = $sp_statistic->post_title;
    }
  }

  // Column (Stastics in League Tables)
  $sp_columns_posts = get_posts( [
    'post_type'      => 'sp_column',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
  ] );

  $sp_columns = [];
  if ( $sp_columns_posts ) {
    foreach( $sp_columns_posts as $sp_column ){
      $sp_columns[ $sp_column->post_name ] = $sp_column->post_title;
    }
  }
}


/**
 * Panels
 */

new \Kirki\Panel( 'necromancers_panel_page_heading', array(
  'priority'    => 40,
  'title'       => esc_html__( 'Page Heading', 'necromancers' ),
) );

new \Kirki\Panel( 'necromancers_panel_styling', array(
  'priority'    => 41,
  'title'       => esc_html__( 'Styling', 'necromancers' ),
) );

new \Kirki\Panel( 'necromancers_panel_off_canvas', array(
  'priority'    => 50,
  'title'       => esc_html__( 'Off-Canvas', 'necromancers' ),
) );

new \Kirki\Panel( 'necromancers_panel_blog', array(
  'priority'    => 60,
  'title'       => esc_html__( 'Blog', 'necromancers' ),
) );

new \Kirki\Panel( 'necromancers_panel_partners', array(
  'priority'    => 61,
  'title'       => esc_html__( 'Partners', 'necromancers' ),
) );

if ( class_exists( 'SportsPress' ) ) {
  new \Kirki\Panel( 'necromancers_panel_event', array(
    'priority'    => 62,
    'title'       => esc_html__( 'Event', 'necromancers' ),
  ) );
  
  new \Kirki\Panel( 'necromancers_panel_player', array(
    'priority'    => 63,
    'title'       => esc_html__( 'Player', 'necromancers' ),
  ) );

  new \Kirki\Panel( 'necromancers_panel_player_list', array(
    'priority'    => 64,
    'title'       => esc_html__( 'Player List', 'necromancers' ),
  ) );
  
  new \Kirki\Panel( 'necromancers_panel_team', array(
    'priority'    => 65,
    'title'       => esc_html__( 'Team', 'necromancers' ),
  ) );
  
  new \Kirki\Panel( 'necromancers_panel_table', array(
    'priority'    => 66,
    'title'       => esc_html__( 'League Table', 'necromancers' ),
  ) );
  
  new \Kirki\Panel( 'necromancers_panel_calendar', array(
    'priority'    => 67,
    'title'       => esc_html__( 'Calendar', 'necromancers' ),
  ) );
  new \Kirki\Panel( 'necromancers_panel_streams_archive', array(
    'priority'    => 68,
    'title'       => esc_html__( 'Streams Archive', 'necromancers' ),
  ) );
}

new \Kirki\Panel( 'necromancers_panel_footer', array(
  'priority'    => 70,
  'title'       => esc_html__( 'Footer', 'necromancers' ),
) );


/**
 * Sections
 */

// Section: Header
new \Kirki\Section( 'necromancers_section_header_elements', array(
  'priority'       => 20,
  'title'          => esc_html__( 'Header', 'necromancers' ),
) );

// Section: Typography
new \Kirki\Section( 'necromancers_section_typography', array(
  'priority'       => 41,
  'title'          => esc_html__( 'Typography', 'necromancers' ),
) );

// Section: Page Heading
new \Kirki\Section( 'necromancers_section_page_heading_classic', array(
  'panel'          => 'necromancers_panel_page_heading',
  'title'          => esc_html__( 'Page Heading - Classic', 'necromancers' ),
) );
new \Kirki\Section( 'necromancers_section_page_heading_side', array(
  'panel'          => 'necromancers_panel_page_heading',
  'title'          => esc_html__( 'Page Heading - Side Banner', 'necromancers' ),
) );
new \Kirki\Section( 'necromancers_section_page_heading_side_header', array(
  'panel'          => 'necromancers_panel_page_heading',
  'title'          => esc_html__( 'Page Heading - Side Header', 'necromancers' ),
) );

// Section: Styling
new \Kirki\Section( 'necromancers_section_styling_colors', array(
  'panel'          => 'necromancers_panel_styling',
  'title'          => esc_html__( 'Main Colors', 'necromancers' ),
) );
new \Kirki\Section( 'necromancers_section_styling_decor_colors', array(
  'panel'          => 'necromancers_panel_styling',
  'title'          => esc_html__( 'Decoration Colors', 'necromancers' ),
) );
new \Kirki\Section( 'necromancers_section_styling_backgrounds', array(
  'panel'          => 'necromancers_panel_styling',
  'title'          => esc_html__( 'Backgrounds', 'necromancers' ),
) );

// Section: Off-canvas
new \Kirki\Section( 'necromancers_section_off_canvas_nav', array(
  'panel'          => 'necromancers_panel_off_canvas',
  'title'          => esc_html__( 'Navigation', 'necromancers' ),
) );
new \Kirki\Section( 'necromancers_section_off_canvas_info_primary', array(
  'panel'          => 'necromancers_panel_off_canvas',
  'title'          => esc_html__( 'Primary Info', 'necromancers' ),
) );
new \Kirki\Section( 'necromancers_section_off_canvas_info_secondary', array(
  'panel'          => 'necromancers_panel_off_canvas',
  'title'          => esc_html__( 'Secondary Info', 'necromancers' ),
) );
new \Kirki\Section( 'necromancers_section_off_canvas_partners', array(
  'panel'          => 'necromancers_panel_off_canvas',
  'title'          => esc_html__( 'Partners', 'necromancers' ),
) );
new \Kirki\Section( 'necromancers_section_off_canvas_copyright', array(
  'panel'          => 'necromancers_panel_off_canvas',
  'title'          => esc_html__( 'Copyright', 'necromancers' ),
) );

// Section: Blog
new \Kirki\Section( 'necromancers_section_blog_page', array(
  'panel'          => 'necromancers_panel_blog',
  'title'          => esc_html__( 'Blog Page', 'necromancers' ),
) );
new \Kirki\Section( 'necromancers_section_blog_post', array(
  'panel'          => 'necromancers_panel_blog',
  'title'          => esc_html__( 'Single Post', 'necromancers' ),
) );

// Section: Partners
new \Kirki\Section( 'necromancers_section_partners_content', array(
  'panel'          => 'necromancers_panel_partners',
  'title'          => esc_html__( 'Content', 'necromancers' ),
) );
new \Kirki\Section(
  'necromancers_section_partners_design',
  [
    'title' => esc_html__( 'Design', 'necromancers' ),
    'panel' => 'necromancers_panel_partners',
    'tabs'  => [
      'design_page_heading' => [
        'label' => esc_html__( 'Heading', 'necromancers' ),
      ],
      'design_content'  => [
        'label' => esc_html__( 'Content', 'necromancers' ),
      ],
    ],
  ]
);


if ( class_exists( 'SportsPress' ) ) {

  // Section: Staff
  new \Kirki\Section( 'necromancers_section_staff', array(
    'priority'       => 69,
    'title'          => esc_html__( 'Staff', 'necromancers' ),
  ) );

  // Section: Event
  new \Kirki\Section( 'necromancers_section_event_bg', array(
    'panel'          => 'necromancers_panel_event',
    'title'          => esc_html__( 'Background', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_event_stats', array(
    'panel'          => 'necromancers_panel_event',
    'title'          => esc_html__( 'Section - Statistics', 'necromancers' ),
  ) );

  // Section: Player
  new \Kirki\Section( 'necromancers_section_player_bg', array(
    'panel'          => 'necromancers_panel_player',
    'title'          => esc_html__( 'Background', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_player_overview', array(
    'panel'          => 'necromancers_panel_player',
    'title'          => esc_html__( 'Section - Overview', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_player_statistics', array(
    'panel'          => 'necromancers_panel_player',
    'title'          => esc_html__( 'Section - Statistics', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_player_achievements', array(
    'panel'          => 'necromancers_panel_player',
    'title'          => esc_html__( 'Section - Achievements', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_player_hardware', array(
    'panel'          => 'necromancers_panel_player',
    'title'          => esc_html__( 'Section - Hardware', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_player_stream', array(
    'panel'          => 'necromancers_panel_player',
    'title'          => esc_html__( 'Section - Stream', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_player_youtube', array(
    'panel'          => 'necromancers_panel_player',
    'title'          => esc_html__( 'Section - YouTube', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_player_tiktok', array(
    'panel'          => 'necromancers_panel_player',
    'title'          => esc_html__( 'Section - TikTok', 'necromancers' ),
  ) );

  // Section: Player List
  new \Kirki\Section( 'necromancers_section_player_list_bg', array(
    'panel'          => 'necromancers_panel_player_list',
    'title'          => esc_html__( 'Background', 'necromancers' ),
  ) );

  // Section: Team
  new \Kirki\Section( 'necromancers_section_team_bg', array(
    'panel'          => 'necromancers_panel_team',
    'title'          => esc_html__( 'Background', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_team_player_list', array(
    'panel'          => 'necromancers_panel_team',
    'title'          => esc_html__( 'Player List', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_team_overview', array(
    'panel'          => 'necromancers_panel_team',
    'title'          => esc_html__( 'Section - Overview', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_team_statistics', array(
    'panel'          => 'necromancers_panel_team',
    'title'          => esc_html__( 'Section - Statistics', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_team_awards', array(
    'panel'          => 'necromancers_panel_team',
    'title'          => esc_html__( 'Section - Awards', 'necromancers' ),
  ) );
  new \Kirki\Section( 'necromancers_section_team_events', array(
    'panel'          => 'necromancers_panel_team',
    'title'          => esc_html__( 'Section - Events', 'necromancers' ),
  ) );

  // Section: League Table
  new \Kirki\Section( 'necromancers_section_table_bg', array(
    'panel'          => 'necromancers_panel_table',
    'title'          => esc_html__( 'Background', 'necromancers' ),
  ) );

  // Section: Calendar
  new \Kirki\Section( 'necromancers_section_calendar_bg', array(
    'panel'          => 'necromancers_panel_calendar',
    'title'          => esc_html__( 'Background', 'necromancers' ),
  ) );

  // Section: Streams Archive
  new \Kirki\Section( 'necromancers_section_streams_archive_design', array(
    'panel'          => 'necromancers_panel_streams_archive',
    'title'          => esc_html__( 'Design', 'necromancers' ),
  ) );
}

// Section: Google Map
new \Kirki\Section( 'necromancers_section_gmap', array(
  'priority'       => 71,
  'title'          => esc_html__( 'Google Map', 'necromancers' ),
) );

// Section: Footer
new \Kirki\Section( 'necromancers_section_footer_copyright', array(
  'panel'          => 'necromancers_panel_footer',
  'title'          => esc_html__( 'Copyright', 'necromancers' ),
) );

// Section: 404
new \Kirki\Section( 'necromancers_section_404', array(
  // 'panel'          => 'necromancers_panel_header',
  'priority'       => 72,
  'title'          => esc_html__( '404 Error', 'necromancers' ),
) );

// Section: Custom Cursor
new \Kirki\Section( 'necromancers_section_custom_cursor', array(
  'priority'       => 73,
  'title'          => esc_html__( 'Custom Cursor', 'necromancers' ),
) );

// Section: Preloader
new \Kirki\Section( 'necromancers_section_preloader', array(
  'priority'       => 74,
  'title'          => esc_html__( 'Preloader', 'necromancers' ),
) );

if ( class_exists( 'Woocommerce' ) ) {
  // Section: Featured Product
  new \Kirki\Section( 'necromancers_section_catalog_featured_product', array(
    'panel'          => 'woocommerce',
    'title'          => esc_html__( 'Featured Product', 'necromancers' ),
  ) );
}


/**
 * Fields
 */

// - Custom Colors

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_background_color',
  'label'       => esc_html__( 'Page & Post Background Color', 'necromancers' ),
  'description' => esc_attr__( 'Adds custom background color to Pages and Posts. Applied to standard pages (Default Page, Page with Side Banner, Page with Google Map) and posts.', 'necromancers' ),
  'section'     => 'necromancers_section_styling_backgrounds',
  'default'     => '#ffffff',
] );

new \Kirki\Field\Background( [
  'settings'    => 'necromancers_color_background',
  'label'       => esc_attr__( 'Page & Post Background Image', 'necromancers' ),
  'description' => esc_attr__( 'The same as the previous option, but adds the background image.', 'necromancers' ),
  'section'     => 'necromancers_section_styling_backgrounds',
  'default'     => [
    'background-color'      => '#ffffff', // is not applied to due RGBA format bug
    'background-image'      => '',
    'background-repeat'     => 'no-repeat',
    'background-position'   => 'center center',
    'background-size'       => 'cover',
    'background-attachment' => 'scroll',
  ],
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_body',
  'label'       => esc_html__( 'Body Color', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#222430',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_body_dark',
  'label'       => esc_html__( 'Body Color Inverse', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#c6cbea',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_primary',
  'label'       => esc_html__( 'Primary', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#a3ff12',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_secondary',
  'label'       => esc_html__( 'Secondary', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#5e627e',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_tertiary',
  'label'       => esc_html__( 'Tertiary', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#222430',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_quaternary',
  'label'       => esc_html__( 'Quaternary', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#3d4055',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_success',
  'label'       => esc_html__( 'Success', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#88df00',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_info',
  'label'       => esc_html__( 'Info', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#ced0da',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_warning',
  'label'       => esc_html__( 'Warning', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#ffcc00',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_danger',
  'label'       => esc_html__( 'Danger', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#ff1c5c',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_light',
  'label'       => esc_html__( 'Light', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#ffffff',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_lighter',
  'label'       => esc_html__( 'Lighter', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#f7f8fa',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_dark',
  'label'       => esc_html__( 'Dark', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#151720',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_black',
  'label'       => esc_html__( 'Black', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#13151e',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_tiny',
  'label'       => esc_html__( 'Subtle', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#5e627e',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_landing_primary',
  'label'       => esc_html__( 'Landing Primary', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#68ff01',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_landing_secondary',
  'label'       => esc_html__( 'Landing Secondary', 'necromancers' ),
  'section'     => 'necromancers_section_styling_colors',
  'default'     => '#ccff3a',
] );


// Decoration Colors
new \Kirki\Field\Generic( [
  'settings'    => 'necromancers_color_decor_custom_desc',
  'section'     => 'necromancers_section_styling_decor_colors',
  'description' => esc_html__( 'Decorations are CSS figures made with gradients and displayed on the Pages with Side Banner, Headings, on the Player and Team Pages.', 'necromancers' ),
  'choices'     => []
] );
new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_decor_layer-1-gradient-start',
  'label'       => esc_html__( 'Layer 1 Gradient Start', 'necromancers' ),
  'section'     => 'necromancers_section_styling_decor_colors',
  'default'     => '#73bb00',
] );
new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_decor_layer-1-gradient-stop',
  'label'       => esc_html__( 'Layer 1 Gradient End', 'necromancers' ),
  'section'     => 'necromancers_section_styling_decor_colors',
  'default'     => '#1d3000',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_decor_layer-2-gradient-start',
  'label'       => esc_html__( 'Layer 2 Gradient Start', 'necromancers' ),
  'section'     => 'necromancers_section_styling_decor_colors',
  'default'     => '#a0e700',
] );
new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_decor_layer-2-gradient-stop',
  'label'       => esc_html__( 'Layer 2 Gradient End', 'necromancers' ),
  'section'     => 'necromancers_section_styling_decor_colors',
  'default'     => '#29a000',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_decor_layer-3-gradient-start',
  'label'       => esc_html__( 'Layer 3 Gradient Start', 'necromancers' ),
  'section'     => 'necromancers_section_styling_decor_colors',
  'default'     => '#e7f800',
] );
new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_decor_layer-3-gradient-stop',
  'label'       => esc_html__( 'Layer 3 Gradient End', 'necromancers' ),
  'section'     => 'necromancers_section_styling_decor_colors',
  'default'     => '#24bd00',
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_color_decor_line',
  'label'       => esc_html__( 'Line Color', 'necromancers' ),
  'section'     => 'necromancers_section_styling_decor_colors',
  'default'     => '#f3ff38',
] );




// - Header

new \Kirki\Field\Select( [
  'settings'    => 'necromancers_header_position',
  'label'       => esc_html__( 'Header Position', 'necromancers' ),
  'section'     => 'necromancers_section_header_elements',
  'default'     => 'bottom',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => [
    'top'    => esc_html__( 'Top', 'necromancers' ),
    'bottom' => esc_html__( 'Bottom', 'necromancers' ),
  ],
] );

new \Kirki\Field\Checkbox_Switch( [
  'settings'    => 'necromancers_header_login_logout',
  'label'       => esc_html__( 'Login/Logout', 'necromancers' ),
  'section'     => 'necromancers_section_header_elements',
  'default'     => 'off',
  'choices'     => [
    'on'  => esc_html__( 'On', 'necromancers' ),
    'off' => esc_html__( 'Off', 'necromancers' ),
  ],
  'transport'   => 'postMessage',
  'js_vars'     => array(
    array(
      'element'  => '.mobile-bar-item--logout, mobile-bar-item--login, .mobile-bar-item--register',
      'function' => 'toggleClass',
      'class'    => 'd-none',
      'value'    => false
    ),
    array(
      'element'  => '.header-account',
      'function' => 'toggleClass',
      'class'    => 'd-none',
      'value'    => false
    ),
  )
] );

new \Kirki\Field\Checkbox_Switch( [
  'settings'    => 'necromancers_header_search_form',
  'label'       => esc_html__( 'Search Form', 'necromancers' ),
  'section'     => 'necromancers_section_header_elements',
  'default'     => 'on',
  'choices'     => [
    'on'  => esc_html__( 'On', 'necromancers' ),
    'off' => esc_html__( 'Off', 'necromancers' ),
  ],
  'transport'   => 'postMessage',
  'js_vars'     => array(
    array(
      'element'  => '.header-search-toggle',
      'function' => 'toggleClass',
      'class'    => 'd-none',
      'value'    => false
    ),
    array(
      'element'  => '.search-panel',
      'function' => 'toggleClass',
      'class'    => 'd-none',
      'value'    => false
    ),
  )
] );

new \Kirki\Field\Checkbox_Switch( [
  'settings'    => 'necromancers_header_social_links',
  'label'       => esc_html__( 'Social Links', 'necromancers' ),
  'section'     => 'necromancers_section_header_elements',
  'default'     => 'on',
  'choices'     => [
    'on'  => esc_html__( 'On', 'necromancers' ),
    'off' => esc_html__( 'Off', 'necromancers' ),
  ],
  'transport'   => 'postMessage',
  'js_vars'     => [
    [
      'element'  => '.header-social-toggle',
      'function' => 'toggleClass',
      'class'    => 'd-md-block',
      'value'    => true
    ],
  ]
] );

if ( class_exists( 'Woocommerce' ) ) {
  new \Kirki\Field\Checkbox_Switch( [
    'settings'    => 'necromancers_header_cart',
    'label'       => esc_html__( 'Cart', 'necromancers' ),
    'section'     => 'necromancers_section_header_elements',
    'default'     => 'on',
    'choices'     => [
      'on'  => esc_html__( 'On', 'necromancers' ),
      'off' => esc_html__( 'Off', 'necromancers' ),
    ],
    'transport'   => 'postMessage',
    'js_vars'     => [
      [
        'element'  => '.header-cart-toggle',
        'function' => 'toggleClass',
        'class'    => 'd-none',
        'value'    => false
      ],
    ]
  ] );
}

new \Kirki\Field\Repeater( [
  'settings'    => 'necromancers_header_social_links_list',
  'label'       => esc_html__( 'Social Links', 'necromancers' ),
  'section'     => 'necromancers_section_header_elements',
  'row_label' => [
    'type'  => 'field',
    'value' => esc_html__( 'Social Link', 'necromancers' ),
    'field' => 'link_title',
  ],
  'button_label' => esc_html__('Add new Social Link', 'necromancers' ),
  'default'      => [
    [
      'link_title'    => esc_html__( 'Necrochat', 'necromancers' ),
      'link_subtitle' => esc_html__( 'Discord', 'necromancers' ),
      'link_url'      => 'https://discord.gg/',
    ],
    [
      'link_title' => esc_html__( 'Necroplay', 'necromancers' ),
      'link_subtitle' => esc_html__( 'Twitch', 'necromancers' ),
      'link_url'  => 'https://www.twitch.tv/',
    ],
    [
      'link_title' => esc_html__( 'Necrotwt', 'necromancers' ),
      'link_subtitle' => esc_html__( 'Twitter', 'necromancers' ),
      'link_url'  => 'https://twitter.com/',
    ],
    [
      'link_title' => esc_html__( 'Necrogame', 'necromancers' ),
      'link_subtitle' => esc_html__( 'Facebook', 'necromancers' ),
      'link_url'  => 'https://www.facebook.com/',
    ],
  ],
  'fields' => [
    'link_title' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link Title', 'necromancers' ),
      'description' => esc_html__( 'Add the title, e.g. your username', 'necromancers' ),
      'default'     => '',
    ],
    'link_subtitle' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link Subtitle', 'necromancers' ),
      'description' => esc_html__( 'Add the subtitle, e.g. the social network name', 'necromancers' ),
      'default'     => '',
    ],
    'link_url'  => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link URL', 'necromancers' ),
      'description' => esc_html__( 'Add the link URL', 'necromancers' ),
      'default'     => '',
    ],
  ],
  'active_callback' => [
    [
      'setting'  => 'necromancers_header_social_links',
      'operator' => '==',
      'value'    => true,
    ]
  ],
] );

new \Kirki\Field\Select( [
  'settings'    => 'necromancers_header_mobile_menu',
  'label'       => esc_html__( 'Mobile Menu', 'necromancers' ),
  'description' => esc_attr__( 'The Advanced Mobile Menu includes all items, e.g. Partners, Login/Logout, Social Links, when the Simple Mobile Menu includes only the navigation.', 'necromancers' ),
  'section'     => 'necromancers_section_header_elements',
  'default'     => 'advanced',
  'placeholder' => esc_html__( 'Select the mobile menu...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => [
    'simple'    => esc_html__( 'Simple', 'necromancers' ),
    'advanced'  => esc_html__( 'Advanced', 'necromancers' ),
  ],
] );


// - Page Heading

// Page Heading: Classic
new \Kirki\Field\Image( [
  'settings'    => 'necromancers_page_heading_classic_bg_img',
  'label'       => esc_attr__( 'Background Image', 'necromancers' ),
  'description' => esc_attr__( 'Add your custom background to Page Heading.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_classic',
  'default'     => '',
  'output' => array(
    array(
      'element'  => '.page-header',
      'property' => 'background-image',
    ),
  ),
] );

new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_page_heading_classic_bg_overlay',
  'label'       => esc_html__( 'Overlay', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_classic',
  'default'     => true
] );

new \Kirki\Field\Color( [
  'settings'    => 'necromancers_page_heading_classic_bg_overlay_color',
  'label'       => esc_attr__( 'Overlay Color', 'necromancers' ),
  'description' => esc_attr__( 'Customize overlay color for Page Heading.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_classic',
  'default'     => 'rgba(0,0,0,0.6)',
  'choices'     => array(
    'alpha' => true,
  ),
  'output' => array(
    array(
      'element'  => '.page-header--has-overlay::before',
      'property' => 'background-color',
    ),
  ),
  'active_callback' => [
    [
      'setting'  => 'necromancers_page_heading_classic_bg_overlay',
      'operator' => '==',
      'value'    => true,
    ]
  ],
] );


// Page Heading: Side Banner
new \Kirki\Field\Background( [
  'settings'    => 'necromancers_page_heading_side_bg',
  'label'       => esc_attr__( 'Background', 'necromancers' ),
  'description' => esc_attr__( 'Add your custom background to the Page Heading - Side Banner.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_side',
  'default'     => [
    'background-color'      => '#151720',
    'background-image'      => '',
    'background-repeat'     => 'no-repeat',
    'background-position'   => 'center center',
    'background-size'       => 'cover',
    'background-attachment' => 'scroll',
  ],
  // 'transport'   => 'auto',
  'output' => [
    [
      'element'  => '.page-thumbnail--default',
    ]
  ],
] );

new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_page_heading_side_logo_display',
  'label'       => esc_html__( 'Display Logo', 'necromancers' ),
  'description' => esc_attr__( 'Enables option to display Logo in the Side Banner.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_side',
  'default'     => true
] );

new \Kirki\Field\Image( [
  'settings'    => 'necromancers_page_heading_side_logo',
  'label'       => esc_attr__( 'Logo', 'necromancers' ),
  'description' => esc_attr__( 'Add your custom logo to the Page Heading - Side Banner.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_side',
  'default'     => '',
  'active_callback' => [
    [
      'setting'  => 'necromancers_page_heading_side_logo_display',
      'operator' => '==',
      'value'    => true,
    ]
  ],
] );

new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_page_heading_side_decor_display',
  'label'       => esc_html__( 'Display Decorations', 'necromancers' ),
  'description' => esc_attr__( 'Enables decorations in the Side Banner.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_side',
  'default'     => true
] );

new \Kirki\Field\Select( [
  'settings'    => 'necromancers_page_heading_side_duotone',
  'label'       => esc_html__( 'Duotone Effect', 'necromancers' ),
  'description' => esc_html__( 'Duotone effect applied on selected background image.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_side',
  'default'     => 'base',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => $duotone_effects,
] );



// Page Heading: Side Header
new \Kirki\Field\Background( [
  'settings'    => 'necromancers_page_heading_side_header_bg',
  'label'       => esc_attr__( 'Background', 'necromancers' ),
  'description' => esc_attr__( 'Add your custom background to the Page Heading - Side Header.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_side_header',
  'default'     => [
    'background-color'      => '#222430',
    'background-image'      => '',
    'background-repeat'     => 'no-repeat',
    'background-position'   => 'center center',
    'background-size'       => 'cover',
    'background-attachment' => 'scroll',
  ],
  'output' => [
    [
      'element'  => '.page-heading--loop',
    ]
  ],
] );

new \Kirki\Field\Select( [
  'settings'    => 'necromancers_page_heading_side_header_duotone',
  'label'       => esc_html__( 'Duotone Effect', 'necromancers' ),
  'description' => esc_html__( 'Duotone effect applied on selected background image.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_side_header',
  'default'     => 'base',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => $duotone_effects,
] );

new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_page_heading_side_header_decorations',
  'label'       => esc_html__( 'Display Decorations', 'necromancers' ),
  'description' => esc_html__( 'Decorations includes dots and gradients.', 'necromancers' ),
  'section'     => 'necromancers_section_page_heading_side_header',
  'default'     => true,
] );


// - Typography

// Base Font
new \Kirki\Field\Typography( [
  'settings'    => 'necromancers_typography_base',
  'label'       => esc_html__( 'Base Font', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => [
    'font-family'    => 'Rajdhani',
  ],
] );

// Font Size: Base
new \Kirki\Field\Dimension( [
  'settings'    => 'necromancers_typography_font_size_base',
  'label'       => esc_html__( 'Base Font Size', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => '1rem',
] );

// Font Size: Heading Lead 1
new \Kirki\Field\Dimension( [
  'settings'    => 'necromancers_typography_font_size_h_lead1',
  'label'       => esc_html__( 'Heading Lead 1', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => '6.375rem',
] );

// Font Size: Heading Lead 2
new \Kirki\Field\Dimension( [
  'settings'    => 'necromancers_typography_font_size_h_lead2',
  'label'       => esc_html__( 'Heading Lead 2', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => '4.5rem',
] );

// Font Size: H1
new \Kirki\Field\Dimension( [
  'settings'    => 'necromancers_typography_font_size_h1',
  'label'       => esc_html__( 'H1', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => '2.875rem',
] );

// Font Size: H2
new \Kirki\Field\Dimension( [
  'settings'    => 'necromancers_typography_font_size_h2',
  'label'       => esc_html__( 'H2', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => '2rem',
] );

// Font Size: H3
new \Kirki\Field\Dimension( [
  'settings'    => 'necromancers_typography_font_size_h3',
  'label'       => esc_html__( 'H3', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => '1.375rem',
] );

// Font Size: H4
new \Kirki\Field\Dimension( [
  'settings'    => 'necromancers_typography_font_size_h4',
  'label'       => esc_html__( 'H4', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => '1.125rem',
] );

// Font Size: H5
new \Kirki\Field\Dimension( [
  'settings'    => 'necromancers_typography_font_size_h5',
  'label'       => esc_html__( 'H5', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => '1rem',
] );

// Font Size: H6
new \Kirki\Field\Dimension( [
  'settings'    => 'necromancers_typography_font_size_h6',
  'label'       => esc_html__( 'H6', 'necromancers' ),
  'section'     => 'necromancers_section_typography',
  'default'     => '0.8125rem',
] );


// - Off-Canvas

// Navigation
new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_off_canvas_nav',
  'label'       => esc_html__( 'Display Navigation', 'necromancers' ),
  'description' => esc_attr__( 'Navigation is displayed by default in Off-Canvas.', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_nav',
  'default'     => true,
] );

// Primary Info
new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_off_canvas_widget_primary',
  'label'       => esc_html__( 'Display Primary Info', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_info_primary',
  'default'     => false,
] );

new \Kirki\Field\Text( [
  'settings'    => 'necromancers_off_canvas_widget_primary_title',
  'label'       => esc_html__( 'Title', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_info_primary',
  'default'     => esc_html__( 'Join Our Team', 'necromancers' ),
] );

new \Kirki\Field\Textarea( [
  'settings'    => 'necromancers_off_canvas_widget_primary_desc',
  'label'       => esc_html__( 'Description', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_info_primary',
  'default'     => '',
] );

new \Kirki\Field\Repeater( [
  'settings'    => 'necromancers_off_canvas_widget_primary_links',
  'label'       => esc_html__( 'Links and Emails', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_info_primary',
  'row_label' => [
    'type'  => 'field',
    'value' => esc_html__( 'Link', 'necromancers' ),
    'field' => 'link_title',
  ],
  'button_label' => esc_html__( 'Add new Link', 'necromancers' ),
  'default'      => [
    [
      'link_title'     => 'mp-recruit@necromancers.com',
      'link_subtitle'  => esc_html__( 'Max Parker - Recruiter', 'necromancers' ),
      'link_url'       => 'mailto:mp-recruit@necromancers.com',
    ],
    [
      'link_title'     => 'partners@necromancers.com',
      'link_subtitle'  => esc_html__( 'Be our partner!', 'necromancers' ),
      'link_url'       => 'mailto:partners@necromancers.com',
    ]
  ],
  'fields' => [
    'link_title' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link Title', 'necromancers' ),
      'description' => esc_html__( 'Add the link title', 'necromancers' ),
      'default'     => '',
    ],
    'link_subtitle' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link Subtitle', 'necromancers' ),
      'description' => esc_html__( 'Add the link subtitle, e.g. the team name', 'necromancers' ),
      'default'     => '',
    ],
    'link_url'  => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link URL', 'necromancers' ),
      'description' => esc_html__( 'Add the link URL', 'necromancers' ),
      'default'     => '',
    ],
  ]
] );


// Secondary Info
new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_off_canvas_widget_secondary',
  'label'       => esc_html__( 'Display Secondary Info', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_info_secondary',
  'default'     => false,
] );

new \Kirki\Field\Text( [
  'settings'    => 'necromancers_off_canvas_widget_secondary_title',
  'label'       => esc_html__( 'Title', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_info_secondary',
  'default'     => esc_html__( 'Join Our Team', 'necromancers' ),
] );

new \Kirki\Field\Textarea( [
  'settings'    => 'necromancers_off_canvas_widget_secondary_desc',
  'label'       => esc_html__( 'Description', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_info_secondary',
  'default'     => '',
] );

new \Kirki\Field\Repeater( [
  'settings'    => 'necromancers_off_canvas_widget_secondary_links',
  'label'       => esc_html__( 'Links and Emails', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_info_secondary',
  'row_label' => [
    'type'  => 'field',
    'value' => esc_html__( 'Link', 'necromancers' ),
    'field' => 'link_title',
  ],
  'button_label' => esc_html__( 'Add new Link', 'necromancers' ),
  'default'      => [
    [
      'link_title'     => 'inquiries@necromancers.com',
      'link_subtitle'  => esc_html__( 'General Inquiries', 'necromancers' ),
      'link_url'       => 'mailto:inquiries@necromancers.com',
    ]
  ],
  'fields' => [
    'link_title' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link Title', 'necromancers' ),
      'description' => esc_html__( 'Add the link title', 'necromancers' ),
      'default'     => '',
    ],
    'link_subtitle' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link Subtitle', 'necromancers' ),
      'description' => esc_html__( 'Add the link subtitle, e.g. the team name', 'necromancers' ),
      'default'     => '',
    ],
    'link_url'  => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link URL', 'necromancers' ),
      'description' => esc_html__( 'Add the link URL', 'necromancers' ),
      'default'     => '',
    ],
  ]
] );

new \Kirki\Field\Repeater( [
  'settings'    => 'necromancers_off_canvas_widget_secondary_social_links',
  'label'       => esc_html__( 'Social Links', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_info_secondary',
  'row_label' => [
    'type'  => 'field',
    'value' => esc_html__( 'Social Link', 'necromancers' ),
    'field' => 'link_title',
  ],
  'button_label' => esc_html__('Add new Social Link', 'necromancers' ),
  'default'      => [
    [
      'link_title' => esc_html__( 'Facebook', 'necromancers' ),
      'link_url'  => 'https://www.facebook.com/',
    ],
    [
      'link_title' => esc_html__( 'Twitter', 'necromancers' ),
      'link_url'  => 'https://twitter.com/',
    ],
    [
      'link_title' => esc_html__( 'Twitch', 'necromancers' ),
      'link_url'  => 'https://www.twitch.tv/',
    ],
    [
      'link_title' => esc_html__( 'Discord', 'necromancers' ),
      'link_url'      => 'https://discord.gg/',
    ],
  ],
  'fields' => [
    'link_title' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link Subtitle', 'necromancers' ),
      'description' => esc_html__( 'Add the subtitle, e.g. the social network name', 'necromancers' ),
      'default'     => '',
    ],
    'link_url'  => [
      'type'        => 'text',
      'label'       => esc_html__( 'Link URL', 'necromancers' ),
      'description' => esc_html__( 'Add the link URL', 'necromancers' ),
      'default'     => '',
    ],
  ]
] );


// Partners
new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_off_canvas_partners',
  'label'       => esc_html__( 'Display Partners Carousel', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_partners',
  'default'     => false,
] );

new \Kirki\Field\Text( [
  'settings'    => 'necromancers_off_canvas_partners_title',
  'label'       => esc_html__( 'Title', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_partners',
  'default'     => esc_html__( 'Our Partners', 'necromancers' ),
] );

new \Kirki\Field\Repeater( [
  'settings'    => 'necromancers_off_canvas_partners_imgs',
  'label'       => esc_html__( 'Images', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_partners',
  'row_label' => [
    'type'  => 'field',
    'value' => esc_html__( 'Image', 'necromancers' ),
    'field' => 'item_title',
  ],
  'button_label' => esc_html__( 'Add a new Partner', 'necromancers' ),
  'default'      => '',
  'fields' => [
    'item_title' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Name', 'necromancers' ),
      'description' => esc_html__( 'Add business name, e.g. HoneyComb', 'necromancers' ),
      'default'     => '',
    ],
    'item_img'  => [
      'type'        => 'image',
      'label'       => esc_html__( 'Image', 'necromancers' ),
      'description' => esc_html__( 'Add or upload image.', 'necromancers' ),
      'default'     => '',
      'choices'     => [
        'save_as' => 'array',
      ],
    ],
    'item_url'  => [
      'type'        => 'text',
      'label'       => esc_html__( 'URL', 'necromancers' ),
      'description' => esc_html__( 'Enter partner URL.', 'necromancers' ),
      'default'     => '',
    ],
  ]
] );

new \Kirki\Field\Textarea( [
  'settings'    => 'necromancers_off_canvas_copyright',
  'label'       => esc_html__( 'Copyright', 'necromancers' ),
  'description' => esc_html__( 'Add copyright text here. ', 'necromancers' ),
  'section'     => 'necromancers_section_off_canvas_copyright',
  'default'     => '',
] );



// - Blog

// Blog Page Layout
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_blog_page_layout',
  'label'       => esc_html__( 'Blog Page Layout', 'necromancers' ),
  'description' => esc_html__( 'Select preferred blog page layout.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => 'default',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => [
    'default' => esc_html__( 'Default', 'necromancers' ),
    'style-1' => esc_html__( 'Layout 1', 'necromancers' ),
    'style-2' => esc_html__( 'Layout 2', 'necromancers' ),
    'style-3' => esc_html__( 'Layout 3', 'necromancers' ),
    'style-4' => esc_html__( 'Layout 4', 'necromancers' ),
  ],
] );

// Featured Posts
new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_blog_page_featured_posts_toggle',
  'label'       => esc_html__( 'Display Featured Posts', 'necromancers' ),
  'description' => esc_html__( 'Featured Posts displayed in a carousel before the main posts feed.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => true,
] );

// Featured Posts Query
new \Kirki\Field\Radio_Buttonset( [
  'settings'    => 'necromancers_blog_page_featured_posts_query',
  'label'       => esc_html__( 'Featured Posts Query', 'necromancers' ),
  'description' => esc_html__( 'Select the posts query option.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => 'selection',
  'choices'     => [
    'selection' => esc_html__( 'Posts Selection', 'necromancers' ),
    'custom'    => esc_html__( 'Custom Query', 'necromancers' ),
  ],
  'active_callback' => [
    [
      'setting'  => 'necromancers_blog_page_featured_posts_toggle',
      'operator' => '==',
      'value'    => true,
    ]
  ],
] );

// Featured Posts Number
new \Kirki\Field\Number( [
  'settings'    => 'necromancers_blog_page_featured_posts_num',
  'label'       => esc_html__( 'Featured Posts - Number of Posts', 'necromancers' ),
  'description' => esc_html__( 'Set the number of posts to display as Featured Posts.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => 3,
  'choices'     => [
    'min'  => 1,
    'max'  => 10,
    'step' => 1,
  ],
  'active_callback' => [
    [
      'setting'  => 'necromancers_blog_page_featured_posts_toggle',
      'operator' => '==',
      'value'    => true,
    ],
    [
      'setting'  => 'necromancers_blog_page_featured_posts_query',
      'operator' => '==',
      'value'    => 'custom',
    ]
  ],
] );

// Featured Posts Order By
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_blog_page_featured_posts_orderby',
  'label'       => esc_html__( 'Featured Posts - Order By', 'necromancers' ),
  'description' => esc_html__( 'Sort retrieved posts by parameter.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => 'date',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => [
    'date'          => esc_html__( 'Date', 'necromancers' ),
    'ID'            => esc_html__( 'ID', 'necromancers' ),
    'author'        => esc_html__( 'Author', 'necromancers' ),
    'title'         => esc_html__( 'Title', 'necromancers' ),
    'modified'      => esc_html__( 'Modified', 'necromancers' ),
    'comment_count' => esc_html__( 'Comment count', 'necromancers' ),
    'menu_order'    => esc_html__( 'Menu order', 'necromancers' ),
    'rand'          => esc_html__( 'Random', 'necromancers' ),
  ],
  'active_callback' => [
    [
      'setting'  => 'necromancers_blog_page_featured_posts_toggle',
      'operator' => '==',
      'value'    => true,
    ],
    [
      'setting'  => 'necromancers_blog_page_featured_posts_query',
      'operator' => '==',
      'value'    => 'custom',
    ]
  ],
] );

// Featured Posts Order
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_blog_page_featured_posts_order',
  'label'       => esc_html__( 'Featured Posts - Order', 'necromancers' ),
  'description' => esc_html__( 'Designates the ascending or descending order of the "orderby" parameter.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => 'DESC',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => [
    'DESC' => esc_html__( 'Descending', 'necromancers' ),
    'ASC' => esc_html__( 'Ascending', 'necromancers' ),
  ],
  'active_callback' => [
    [
      'setting'  => 'necromancers_blog_page_featured_posts_toggle',
      'operator' => '==',
      'value'    => true,
    ],
    [
      'setting'  => 'necromancers_blog_page_featured_posts_query',
      'operator' => '==',
      'value'    => 'custom',
    ]
  ],
] );

// Featured Posts Categories
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_blog_page_featured_posts_categories',
  'label'       => esc_html__( 'Featured Posts - Categories', 'necromancers' ),
  'description' => esc_html__( 'Show posts associated with certain categories.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => null,
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 99,
  'choices'     => Kirki_Helper::get_terms(
    [
      'taxonomy' => 'category',
    ]
  ),
  'active_callback' => [
    [
      'setting'  => 'necromancers_blog_page_featured_posts_toggle',
      'operator' => '==',
      'value'    => true,
    ],
    [
      'setting'  => 'necromancers_blog_page_featured_posts_query',
      'operator' => '==',
      'value'    => 'custom',
    ]
  ],
] );

// Featured Posts Tags
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_blog_page_featured_posts_tags',
  'label'       => esc_html__( 'Featured Posts - Tags', 'necromancers' ),
  'description' => esc_html__( 'Show posts associated with certain tags.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => null,
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 99,
  'choices'     => Kirki_Helper::get_terms(
    [
      'taxonomy' => 'post_tag',
    ]
  ),
  'active_callback' => [
    [
      'setting'  => 'necromancers_blog_page_featured_posts_toggle',
      'operator' => '==',
      'value'    => true,
    ],
    [
      'setting'  => 'necromancers_blog_page_featured_posts_query',
      'operator' => '==',
      'value'    => 'custom',
    ]
  ],
] );

// Featured Posts selection
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_blog_page_featured_posts',
  'label'       => esc_html__( 'Select Featured Posts', 'necromancers' ),
  'description' => esc_html__( 'Select posts that would be displayed in the carousel.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => 'default',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 6,
  'choices'     => Kirki_Helper::get_posts( array(
    'posts_per_page' => 999,
  ) ),
  'active_callback' => [
    [
      'setting'  => 'necromancers_blog_page_featured_posts_toggle',
      'operator' => '==',
      'value'    => true,
    ],
    [
      'setting'  => 'necromancers_blog_page_featured_posts_query',
      'operator' => '==',
      'value'    => 'selection',
    ]
  ],
] );

new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_blog_meta_author',
  'label'       => esc_html__( 'Meta: Post Author', 'necromancers' ),
  'description' => esc_html__( 'Enables post author meta info.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_page',
  'default'     => false,
] );

// Post
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_blog_post_layout',
  'label'       => esc_html__( 'Post Layout', 'necromancers' ),
  'description' => esc_html__( 'Select preferred post layout.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_post',
  'default'     => 'default',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => [
    'default' => esc_html__( 'Default', 'necromancers' ),
    'thumb_left' => esc_html__( 'Featured Image Left', 'necromancers' ),
  ],
] );

new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_blog_post_meta_author',
  'label'       => esc_html__( 'Meta: Post Author', 'necromancers' ),
  'description' => esc_html__( 'Enables post author meta info.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_post',
  'default'     => false,
] );

new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_blog_post_sharing',
  'label'       => esc_html__( 'Post Sharing', 'necromancers' ),
  'description' => esc_html__( 'Enables post sharing links.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_post',
  'default'     => false,
] );

new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_blog_post_author',
  'label'       => esc_html__( 'Post Author', 'necromancers' ),
  'description' => esc_html__( 'Enables post author block.', 'necromancers' ),
  'section'     => 'necromancers_section_blog_post',
  'default'     => false,
] );

new \Kirki\Field\Radio( [
  'settings'    => 'necromancers_blog_post_sharing_position',
  'label'       => esc_html__( 'Post Sharing Position', 'necromancers' ),
  'section'     => 'necromancers_section_blog_post',
  'default'     => 'default',
  'choices'     => [
    'default'   => esc_html__( 'Default', 'necromancers' ),
    'center'    => esc_html__( 'Center', 'necromancers' ),
  ],
  'active_callback' => [
    [
      'setting'  => 'necromancers_blog_post_sharing',
      'operator' => '==',
      'value'    => true,
    ]
  ],
] );



// - Partners

// Title
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_partners_title',
  'label'       => esc_html__( 'Title', 'necromancers' ),
  'description' => esc_html__( 'Displayed on the Partners page.', 'necromancers' ),
  'section'     => 'necromancers_section_partners_content',
  'default'     => esc_html__( 'Partners', 'necromancers' ),
] );

// Subtitle
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_partners_subtitle',
  'label'       => esc_html__( 'Subtitle', 'necromancers' ),
  'description' => esc_html__( 'Displayed on the Partners page.', 'necromancers' ),
  'section'     => 'necromancers_section_partners_content',
  'default'     => esc_html__( 'Necromancers', 'necromancers' ),
] );

// Email Label
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_partners_email_label',
  'label'       => esc_html__( 'Email Label', 'necromancers' ),
  'description' => esc_html__( 'Displayed on the Partners page.', 'necromancers' ),
  'section'     => 'necromancers_section_partners_content',
  'default'     => esc_html__( 'Wanna be our partner?', 'necromancers' ),
] );

// Email Address
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_partners_email_address',
  'label'       => esc_html__( 'Email Address', 'necromancers' ),
  'description' => esc_html__( 'Displayed on the Partners page.', 'necromancers' ),
  'section'     => 'necromancers_section_partners_content',
  'default'     => 'partners@necromancers.com',
] );

// Design > Heading > Background
new \Kirki\Field\Background( [
  'settings'    => 'necromancers_partners_page_heading_side_header_bg',
  'label'       => esc_attr__( 'Page Heading Background', 'necromancers' ),
  'description' => esc_attr__( 'Add your custom background to the Page Heading - Side Header.', 'necromancers' ),
  'section'     => 'necromancers_section_partners_design',
  'tab'         => 'design_page_heading',
  'default'     => [
    'background-color'      => '#222430',
    'background-image'      => '',
    'background-repeat'     => 'no-repeat',
    'background-position'   => 'center center',
    'background-size'       => 'cover',
    'background-attachment' => 'scroll',
  ],
  'output' => [
    [
      'element'  => '.post-type-archive-partners .page-heading--loop',
    ]
  ],
] );

// Design > Heading > Duotone
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_partners_page_heading_side_header_duotone',
  'label'       => esc_html__( 'Duotone Effect', 'necromancers' ),
  'description' => esc_html__( 'Duotone effect applied on selected background image.', 'necromancers' ),
  'section'     => 'necromancers_section_partners_design',
  'tab'         => 'design_page_heading',
  'default'     => 'base',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => $duotone_effects,
] );

// Design > Heading > Decorations
new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_partners_page_heading_side_header_decorations',
  'label'       => esc_html__( 'Display Decorations', 'necromancers' ),
  'description' => esc_html__( 'Decorations includes dots and gradients.', 'necromancers' ),
  'section'     => 'necromancers_section_partners_design',
  'tab'         => 'design_page_heading',
  'default'     => true,
] );

// Design > Content > Background
new \Kirki\Field\Background( [
  'settings'    => 'necromancers_partners_content_bg',
  'label'       => esc_attr__( 'Content Background', 'necromancers' ),
  'description' => esc_attr__( 'Add your custom background to the content.', 'necromancers' ),
  'section'     => 'necromancers_section_partners_design',
  'tab'         => 'design_content',
  'default'     => [
    'background-color'      => '#151720',
    'background-image'      => get_template_directory_uri() . '/assets/img/bg-texture-01.jpg',
    'background-repeat'     => 'no-repeat',
    'background-position'   => 'center center',
    'background-size'       => 'cover',
    'background-attachment' => 'fixed',
  ],
  'output' => [
    [
      'element'  => 'body.post-type-archive-partners',
    ]
  ],
] );



if ( class_exists( 'SportsPress' ) ) {

  // - Staff

  // Title
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_staff_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Displayed on the Staff page.', 'necromancers' ),
    'section'     => 'necromancers_section_staff',
    'default'     => esc_html__( 'Management & Staff', 'necromancers' ),
  ] );

  // Subtitle
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_staff_subtitle',
    'label'       => esc_html__( 'Subtitle', 'necromancers' ),
    'description' => esc_html__( 'Displayed on the Staff page.', 'necromancers' ),
    'section'     => 'necromancers_section_staff',
    'default'     => esc_html__( 'Necromancers', 'necromancers' ),
  ] );

  // Background
  new \Kirki\Field\Background( [
    'settings'    => 'necromancers_staff_page_heading_side_header_bg',
    'label'       => esc_attr__( 'Page Heading Background', 'necromancers' ),
    'description' => esc_attr__( 'Add your custom background to the Page Heading - Side Header.', 'necromancers' ),
    'section'     => 'necromancers_section_staff',
    'default'     => [
      'background-color'      => '#222430',
      'background-image'      => '',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'scroll',
    ],
    'output' => [
      [
        'element'  => '.post-type-archive-sp_staff .page-heading--loop',
      ]
    ],
  ] );

  // Duotone
  new \Kirki\Field\Select( [
    'settings'    => 'necromancers_staff_page_heading_side_header_duotone',
    'label'       => esc_html__( 'Duotone Effect', 'necromancers' ),
    'description' => esc_html__( 'Duotone effect applied on selected background image.', 'necromancers' ),
    'section'     => 'necromancers_section_staff',
    'default'     => 'base',
    'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
    'multiple'    => 1,
    'choices'     => $duotone_effects,
  ] );

  // Decorations
  new \Kirki\Field\Checkbox( [
    'settings'    => 'necromancers_staff_page_heading_side_header_decorations',
    'label'       => esc_html__( 'Display Decorations', 'necromancers' ),
    'description' => esc_html__( 'Decorations includes dots and gradients.', 'necromancers' ),
    'section'     => 'necromancers_section_staff',
    'default'     => true,
  ] );



  // - Event

  // Background
  new \Kirki\Field\Background( [
    'settings'    => 'necromancers_sp_event_bg',
    'label'       => esc_attr__( 'Background', 'necromancers' ),
    'description' => esc_attr__( 'Add your custom background to the Single Event page.', 'necromancers' ),
    'section'     => 'necromancers_section_event_bg',
    'default'     => [
      'background-color'      => '#222430',
      'background-image'      => '',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'fixed',
    ],
    'output' => [
      [
        'element'  => '.single-sp_event .ncr-bg__img-layer',
      ]
    ],
  ] );

  // Background: Dotted
  new \Kirki\Field\Checkbox( [
    'settings'    => 'necromancers_sp_event_bg_dotted',
    'label'       => esc_html__( 'Dotted Overlay', 'necromancers' ),
    'description' => esc_html__( 'Enables dotted overlay over the background.', 'necromancers' ),
    'section'     => 'necromancers_section_event_bg',
    'default'     => false,
  ] );

  // Background: Duotone
  new \Kirki\Field\Select( [
    'settings'    => 'necromancers_sp_event_bg_duotone',
    'label'       => esc_html__( 'Duotone Effect', 'necromancers' ),
    'description' => esc_html__( 'Duotone effect applied on selected background image.', 'necromancers' ),
    'section'     => 'necromancers_section_event_bg',
    'default'     => 'base',
    'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
    'multiple'    => 1,
    'choices'     => $duotone_effects,
  ] );


  // Event: Statistics Layout
  new \Kirki\Field\Sortable( [
    'settings'    => 'necromancers_sp_event_statistics_layout',
    'label'       => esc_html__( 'Layout', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'default'      => [
      'general',
      'matchup',
      'leaders',
    ],
    'choices' => [
      'general' => esc_html__( 'General Stats', 'necromancers' ),
      'matchup' => esc_html__( 'Teams Matchup', 'necromancers' ),
      'leaders' => esc_html__( 'Game Leaders', 'necromancers')
    ],
  ] );

  // Event: Statistics - General Stats
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_event_statistics_general_title',
    'label'       => esc_html__( 'General Stats - Title', 'necromancers' ),
    'description' => esc_html__( 'Title for the General Stats section.', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'default'     => esc_html__( 'General Stats', 'necromancers' ),
  ] );

  // Event: Statistics - General Stats - Info Layout
  new \Kirki\Field\Sortable( [
    'settings'    => 'necromancers_sp_event_statistics_general_layout',
    'label'       => esc_html__( 'General Stats - Layout', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'default'      => [
      'venue',
      'duration',
      'time',
      'status',
    ],
    'choices' => [
      'duration'  => esc_html__( 'Duration', 'necromancers' ),
      'match_day' => esc_html__( 'Match Day', 'necromancers' ),
      'time'      => esc_html__( 'Time', 'necromancers'),
      'venue'     => esc_html__( 'Venue', 'necromancers'),
      'status'    => esc_html__( 'Status', 'necromancers'),
      'picks'     => esc_html__( 'Heroes', 'necromancers'),
      'mvp'       => esc_html__( 'MVP', 'necromancers'),
    ],
  ] );

  // Event: Statistics - Teams Matchup
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_event_statistics_matchup_title',
    'label'       => esc_html__( 'Teams Matchup - Title', 'necromancers' ),
    'description' => esc_html__( 'Title for the Teams Matchup section.', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'default'     => esc_html__( 'Teams Matchup', 'necromancers' ),
  ] );


  // Event: Event Result Layout
  new \Kirki\Field\Select( [
    'settings'    => 'necromancers_sp_event_statistics_matchup_layout',
    'label'       => esc_html__( 'Teams Matchup - Layout', 'necromancers' ),
    'description' => esc_html__( 'Select layout for Teams Matchup.', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'default'     => 'layout-1',
    'placeholder' => esc_html__( 'Select layout...', 'necromancers' ),
    'multiple'    => 1,
    'choices'     => [
      'layout-1' => esc_html__( 'Label above the bars', 'necromancers' ),
      'layout-2' => esc_html__( 'Label between the bars', 'necromancers' ),
      'layout-3' => esc_html__( 'Label at the side of the bars', 'necromancers' ),
    ],
  ] );

  // Event: Event Result Items
  new \Kirki\Field\Repeater( [
    'settings'    => 'necromancers_sp_event_results',
    'label'       => esc_html__( 'Teams Matchup - Event Results', 'necromancers' ),
    'description' => esc_html__( 'Select Event Results to display.', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'row_label' => [
      'type'  => 'field',
      'value' => esc_html__( 'Event Result', 'necromancers' ),
      'field' => 'result_post',
    ],
    'button_label' => esc_html__( 'Add new Event Result', 'necromancers' ),
    'default'      => '',
    'fields' => [
      'result_post' => [
        'type'        => 'select',
        'label'       => esc_html__( 'Event Result', 'necromancers' ),
        'default'     => '',
        'choices'     => [ 'empty' => esc_html__( '- Select Event Result -', 'necromancers' ) ] + $sp_results,
      ],
    ],
  ] );

  // Event: Statistics - Game Leaders
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_event_statistics_leaders_title',
    'label'       => esc_html__( 'Game Leaders - Title', 'necromancers' ),
    'description' => esc_html__( 'Title for the Game Leaders section.', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'default'     => esc_html__( 'Game Leaders', 'necromancers' ),
  ] );

  // Event: Statists - Game Leaders - Layout
  new \Kirki\Field\Select( [
    'settings'    => 'necromancers_sp_event_statistics_leaders_layout',
    'label'       => esc_html__( 'Game Leaders - Layout', 'necromancers' ),
    'description' => esc_html__( 'Select layout for Game Leaders.', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'default'     => 'simple',
    'placeholder' => esc_html__( 'Select layout...', 'necromancers' ),
    'multiple'    => 1,
    'choices'     => [
      'simple' => esc_html__( 'Player Blocks', 'necromancers' ),
      'tabbed' => esc_html__( 'Tabbed Performances', 'necromancers' ),
    ],
  ] );

  // Event: Statists - Game Leaders - Performances
  new \Kirki\Field\Repeater( [
    'settings'    => 'necromancers_sp_event_statistics_leaders_performance',
    'label'       => esc_html__( 'Game Leaders - Performances', 'necromancers' ),
    'description' => esc_html__( 'Select performances to display Game Leaders.', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'row_label' => [
      'type'  => 'field',
      'value' => esc_html__( 'Performance', 'necromancers' ),
      'field' => 'stat_post',
    ],
    'button_label' => esc_html__( 'Add New Performance', 'necromancers' ),
    'default'      => '',
    'fields' => [
      'stat_post' => [
        'type'        => 'select',
        'label'       => esc_html__( 'Performance', 'necromancers' ),
        'default'     => '',
        'choices'     => [ 'empty' => esc_html__( '- Select a Performance -', 'necromancers' ) ] + $sp_performances,
      ],
    ],
  ] );

  // Event: Statistics - Game Leaders - Number of Players
  new \Kirki\Field\Number( [
    'settings'    => 'necromancers_sp_event_statistics_leaders_num',
    'label'       => esc_html__( 'Game Leaders - Number of Players', 'necromancers' ),
    'description' => esc_html__( 'Set the number of players to display Game Leaders.', 'necromancers' ),
    'section'     => 'necromancers_section_event_stats',
    'default'     => 1,
    'choices'     => [
      'min'  => 1,
      'max'  => 3,
      'step' => 1,
    ],
  ] );


  // - Player

  // Background
  new \Kirki\Field\Background( [
    'settings'    => 'necromancers_sp_player_bg',
    'label'       => esc_attr__( 'Background', 'necromancers' ),
    'description' => esc_attr__( 'Add your custom background to the Single Player page.', 'necromancers' ),
    'section'     => 'necromancers_section_player_bg',
    'default'     => [
      'background-color'      => '#222430',
      'background-image'      => get_template_directory_uri() . '/assets/img/bg-texture-01.jpg',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'fixed',
    ],
    'output' => [
      [
        'element'  => '.single-sp_player',
      ]
    ],
  ] );

  // Background: Dotted
  new \Kirki\Field\Checkbox( [
    'settings'    => 'necromancers_sp_player_bg_dotted',
    'label'       => esc_html__( 'Dotted Overlay', 'necromancers' ),
    'description' => esc_html__( 'Enables dotted overlay over the background.', 'necromancers' ),
    'section'     => 'necromancers_section_player_bg',
    'default'     => true,
  ] );

  // Background: Decoration
  new \Kirki\Field\Checkbox( [
    'settings'    => 'necromancers_sp_player_bg_decorations',
    'label'       => esc_html__( 'Display Decorations', 'necromancers' ),
    'description' => esc_html__( 'Decorations displayed behind the player by default.', 'necromancers' ),
    'section'     => 'necromancers_section_player_bg',
    'default'     => true
  ] );

  // Player: Overview
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_player_overview_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_player_overview',
    'default'     => esc_html__( 'Overview', 'necromancers' ),
  ] );

  // Player: Statistics
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_player_statistics_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_player_statistics',
    'default'     => esc_html__( 'Statistics', 'necromancers' ),
  ] );


  // Player: Statistics Items
  new \Kirki\Field\Repeater( [
    'settings'    => 'necromancers_sp_player_statistics_items',
    'label'       => esc_html__( 'Statistics', 'necromancers' ),
    'section'     => 'necromancers_section_player_statistics',
    'row_label' => [
      'type'  => 'field',
      'value' => esc_html__( 'Statistic', 'necromancers' ),
      'field' => 'stat_post',
    ],
    'button_label' => esc_html__( 'Add new Statistic', 'necromancers' ),
    'default'      => '',
    'fields' => [
      'stat_post' => [
        'type'        => 'select',
        'label'       => esc_html__( 'Statistic', 'necromancers' ),
        'default'     => '',
        'choices'     => [ 'empty' => esc_html__( '- Select Statistic -', 'necromancers' ) ] + $sp_statistics,
      ],
      'stat_title' => [
        'type'        => 'text',
        'label'       => esc_html__( 'Title', 'necromancers' ),
        'default'     => '',
      ],
      'stat_subtitle' => [
        'type'        => 'text',
        'label'       => esc_html__( 'Subtitle', 'necromancers' ),
        'default'     => '',
      ],
      'stat_is_percentage' => [
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Percentage', 'necromancers' ),
        'default'     => false
      ]
    ],
  ] );

  // Player: Achievements
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_player_achievements_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_player_achievements',
    'default'     => esc_html__( 'Achievements', 'necromancers' ),
  ] );

  // Player: Achievements Records
  new \Kirki\Field\Repeater( [
    'settings'    => 'necromancers_sp_player_achievements_records',
    'label'       => esc_html__( 'Records', 'necromancers' ),
    'section'     => 'necromancers_section_player_achievements',
    'row_label' => [
      'type'  => 'field',
      'value' => esc_html__( 'Record', 'necromancers' ),
      'field' => 'stat_post',
    ],
    'button_label' => esc_html__( 'Add New Record', 'necromancers' ),
    'default'      => '',
    'fields' => [
      'stat_post' => [
        'type'        => 'select',
        'label'       => esc_html__( 'Record', 'necromancers' ),
        'default'     => '',
        'choices'     => [ 'empty' => esc_html__( '- Select Record -', 'necromancers' ) ] + $sp_performances,
      ],
      'stat_title' => [
        'type'        => 'text',
        'label'       => esc_html__( 'Title', 'necromancers' ),
        'default'     => '',
      ],
    ],
  ] );

  // Player: Hardware
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_player_hardware_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_player_hardware',
    'default'     => esc_html__( 'Hardware', 'necromancers' ),
  ] );

  // Player: Stream
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_player_stream_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_player_stream',
    'default'     => esc_html__( 'Livestream', 'necromancers' ),
  ] );

  // Player: YouTube
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_player_youtube_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_player_youtube',
    'default'     => esc_html__( 'YouTube', 'necromancers' ),
  ] );

  // Player: TikTok
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_player_tiktok_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_player_tiktok',
    'default'     => esc_html__( 'TikTok', 'necromancers' ),
  ] );


  // - Player List

  // Background
  new \Kirki\Field\Background( [
    'settings'    => 'necromancers_sp_list_bg',
    'label'       => esc_attr__( 'Background', 'necromancers' ),
    'description' => esc_attr__( 'Add your custom background to the Single Player List page.', 'necromancers' ),
    'section'     => 'necromancers_section_player_list_bg',
    'default'     => [
      'background-color'      => '#222430',
      'background-image'      => get_template_directory_uri() . '/assets/img/bg-texture-01.jpg',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'fixed',
    ],
    'output' => [
      [
        'element'  => '.single-sp_list',
      ]
    ],
  ] );




  // - Team

  // Background
  new \Kirki\Field\Background( [
    'settings'    => 'necromancers_sp_team_bg',
    'label'       => esc_attr__( 'Background', 'necromancers' ),
    'description' => esc_attr__( 'Add your custom background to the Single Team page.', 'necromancers' ),
    'section'     => 'necromancers_section_team_bg',
    'default'     => [
      'background-color'      => '#222430',
      'background-image'      => get_template_directory_uri() . '/assets/img/bg-texture-01.jpg',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'fixed',
    ],
    'output' => [
      [
        'element'  => '.single-sp_team',
      ]
    ],
  ] );

  // Background: Dotted
  new \Kirki\Field\Checkbox( [
    'settings'    => 'necromancers_sp_team_bg_dotted',
    'label'       => esc_html__( 'Dotted Overlay', 'necromancers' ),
    'description' => esc_html__( 'Enables dotted overlay over the background.', 'necromancers' ),
    'section'     => 'necromancers_section_team_bg',
    'default'     => true,
  ] );

  // Background: Decoration
  new \Kirki\Field\Checkbox( [
    'settings'    => 'necromancers_sp_team_bg_decorations',
    'label'       => esc_html__( 'Display Decorations', 'necromancers' ),
    'description' => esc_html__( 'Decorations displayed behind the players by default.', 'necromancers' ),
    'section'     => 'necromancers_section_team_bg',
    'default'     => true
  ] );

  // Team: Player List
  new \Kirki\Field\Radio_Image( [
    'settings'    => 'necromancers_sp_team_player_list',
    'label'       => esc_html__( 'Player List', 'necromancers' ),
    'description' => esc_html__( 'Select layout for Player List on Team pages.', 'necromancers' ),
    'section'     => 'necromancers_section_team_player_list',
    'default'     => 'slider',
    'choices'     => [
      'slider'   => get_template_directory_uri() . '/inc/admin/assets/img/team_player_list_slider.jpg',
      'carousel' => get_template_directory_uri() . '/inc/admin/assets/img/team_player_list_carousel.jpg',
    ],
  ] );

  // Team: Overview
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_team_overview_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_team_overview',
    'default'     => esc_html__( 'Overview', 'necromancers' ),
  ] );

  // Team: Statistics
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_team_statistics_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_team_statistics',
    'default'     => esc_html__( 'Statistics', 'necromancers' ),
  ] );

  // Team: Statistics Items
  new \Kirki\Field\Repeater( [
    'settings'    => 'necromancers_sp_team_statistics_items',
    'label'       => esc_html__( 'Statistics', 'necromancers' ),
    'section'     => 'necromancers_section_team_statistics',
    'row_label' => [
      'type'  => 'field',
      'value' => esc_html__( 'Statistic', 'necromancers' ),
      'field' => 'stat_post',
    ],
    'button_label' => esc_html__( 'Add New Statistic', 'necromancers' ),
    'default'      => '',
    'fields' => [
      'stat_post' => [
        'type'        => 'select',
        'label'       => esc_html__( 'Statistic', 'necromancers' ),
        'default'     => '',
        'choices'     => [ 'empty' => esc_html__( '- Select Statistic -', 'necromancers' ) ] + $sp_columns,
      ],
      'stat_title' => [
        'type'        => 'text',
        'label'       => esc_html__( 'Title', 'necromancers' ),
        'default'     => '',
      ],
      'stat_subtitle' => [
        'type'        => 'text',
        'label'       => esc_html__( 'Subtitle', 'necromancers' ),
        'default'     => '',
      ],
      'stat_is_percentage' => [
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Percentage', 'necromancers' ),
        'default'     => false
      ]
    ],
  ] );

  // Team: Awards
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_team_awards_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_team_awards',
    'default'     => esc_html__( 'Awards', 'necromancers' ),
  ] );

  // Team: Events
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_sp_team_events_title',
    'label'       => esc_html__( 'Title', 'necromancers' ),
    'description' => esc_html__( 'Section title.', 'necromancers' ),
    'section'     => 'necromancers_section_team_events',
    'default'     => esc_html__( 'Events', 'necromancers' ),
  ] );



  // - League Table

  // Background
  new \Kirki\Field\Background( [
    'settings'    => 'necromancers_sp_table_bg',
    'label'       => esc_attr__( 'Background', 'necromancers' ),
    'description' => esc_attr__( 'Add your custom background to the League Table page.', 'necromancers' ),
    'section'     => 'necromancers_section_table_bg',
    'default'     => [
      'background-color'      => '#222430',
      'background-image'      => get_template_directory_uri() . '/assets/img/bg-texture-01.jpg',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'fixed',
    ],
    'output' => [
      [
        'element'  => '.single-sp_table',
      ]
    ],
  ] );



  // - Calendar

  // Background
  new \Kirki\Field\Background( [
    'settings'    => 'necromancers_sp_calendar_bg',
    'label'       => esc_attr__( 'Background', 'necromancers' ),
    'description' => esc_attr__( 'Add your custom background to the Single Calendar page.', 'necromancers' ),
    'section'     => 'necromancers_section_calendar_bg',
    'default'     => [
      'background-color'      => '#222430',
      'background-image'      => get_template_directory_uri() . '/assets/img/bg-texture-01.jpg',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'fixed',
    ],
    'output' => [
      [
        'element'  => '.single-sp_calendar',
      ]
    ],
  ] );



  // - Streams Archive

  // Content Background
  new \Kirki\Field\Background( [
    'settings'    => 'necromancers_streams_archive_content_bg',
    'label'       => esc_attr__( 'Content Background', 'necromancers' ),
    'description' => esc_attr__( 'Add your custom background to the content.', 'necromancers' ),
    'section'     => 'necromancers_section_streams_archive_design',
    'tab'         => 'design_content',
    'default'     => [
      'background-color'      => '#151720',
      'background-image'      => get_template_directory_uri() . '/assets/img/bg-texture-01.jpg',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'fixed',
    ],
    'output' => [
      [
        'element'  => 'body.page-template-page-streams',
      ]
    ],
  ] );

}



// - Google Map

// Google Map API Key
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_gmap_key',
  'label'       => esc_html__( 'Google Map API Key', 'necromancers' ),
  'description' => sprintf(
    esc_html__( 'Follow %s to generate Google Maps API Key.', 'necromancers' ),
    '<a href="' . esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) . '" rel="nofollow">'
    . esc_html__( 'this instruction', 'necromancers' )
    . '</a>'
  ),
  'section'     => 'necromancers_section_gmap',
  'default'     => '',
] );

// Address
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_gmap_address',
  'label'       => esc_html__( 'Lat an Long coordinates', 'necromancers' ),
  'description' => esc_html__( 'Latitude and Longitude divided by coma.', 'necromancers' ),
  'section'     => 'necromancers_section_gmap',
  'default'     => '40.714609648488235, -74.002422350488',
] );

// Map Style
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_gmap_style',
  'label'       => esc_html__( 'Map Style', 'necromancers' ),
  'description' => esc_html__( 'Choose your map style.', 'necromancers' ),
  'section'     => 'necromancers_section_gmap',
  'default'     => 'necromancers',
  'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
  'multiple'    => 1,
  'choices'     => [
    'necromancers' => esc_html__( 'Necromancers', 'necromancers' ),
    'ultra-light' => esc_html__( 'Ultra Light', 'necromancers' ),
    'light-dream' => esc_html__( 'Light Dream', 'necromancers' ),
    'shades-of-grey' => esc_html__( 'Shades of Grey', 'necromancers' ),
    'blue-water' => esc_html__( 'Blue Water', 'necromancers' ),
    'default' => esc_html__( 'Default', 'necromancers' ),
  ],
] );

// Zoom Level
new \Kirki\Field\Number( [
  'settings'    => 'necromancers_gmap_zoom',
  'label'       => esc_html__( 'Zoom Level', 'necromancers' ),
  'description' => esc_html__( 'Set map zoom level.', 'necromancers' ),
  'section'     => 'necromancers_section_gmap',
  'default'     => 15,
  'choices'     => [
    'min'  => 0,
    'max'  => 19,
    'step' => 1,
  ],
] );

// Marker
new \Kirki\Field\Image( [
  'settings'    => 'necromancers_gmap_marker',
  'label'       => esc_html__( 'Marker', 'necromancers' ),
  'description' => esc_html__( 'Replace default marker with a custom one.', 'necromancers' ),
  'section'     => 'necromancers_section_gmap',
  'default'     => get_template_directory_uri() . '/assets/img/map-marker.png',
] );

// Info: Title
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_gmap_info_title',
  'label'       => esc_html__( 'Info: Title', 'necromancers' ),
  'description' => esc_html__( 'Add Title to info popup.', 'necromancers' ),
  'section'     => 'necromancers_section_gmap',
  'default'     => esc_html__( 'Necromancers', 'necromancers' ),
] );

// Info: Subtitle
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_gmap_info_subtitle',
  'label'       => esc_html__( 'Info: Subtitle', 'necromancers' ),
  'description' => esc_html__( 'Add Subtitle to info popup.', 'necromancers' ),
  'section'     => 'necromancers_section_gmap',
  'default'     => esc_html__( 'Headquarters', 'necromancers' ),
] );

// Info: Description
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_gmap_info_description',
  'label'       => esc_html__( 'Info: Description', 'necromancers' ),
  'description' => esc_html__( 'Add description to info popup.', 'necromancers' ),
  'section'     => 'necromancers_section_gmap',
  'default'     => esc_html__( '1284 W 52nd Street Suite 8, New York', 'necromancers' ),
] );


// - Footer

// Copyright Toggle
new \Kirki\Field\Checkbox_Switch( [
  'settings'    => 'necromancers_footer_copyright_toggle',
  'label'       => esc_html__( 'Copyright', 'necromancers' ),
  'description' => esc_html__( 'The copyright is displayed if the Header Position is set to top. Otherwise use the Off-Canvas copyright.', 'necromancers' ),
  'section'     => 'necromancers_section_footer_copyright',
  'default'     => 'on',
  'choices'     => [
    'on'  => esc_html__( 'On', 'necromancers' ),
    'off' => esc_html__( 'Off', 'necromancers' ),
  ],
] );

// Copyright
new \Kirki\Field\Textarea( [
  'settings'    => 'necromancers_footer_copyright',
  'label'       => esc_html__( 'Text', 'necromancers' ),
  'description' => esc_html__( 'Add copyright text here.', 'necromancers' ),
  'section'     => 'necromancers_section_footer_copyright',
  'default'     => '',
  'active_callback' => [
    [
      'setting'  => 'necromancers_footer_copyright_toggle',
      'operator' => '==',
      'value'    => true,
    ]
  ],
] );



// - 404 Error

// Title
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_404_title',
  'label'       => esc_html__( 'Title', 'necromancers' ),
  'description' => esc_html__( 'Add title here.', 'necromancers' ),
  'section'     => 'necromancers_section_404',
  'default'     => '',
] );

// Subtitle
new \Kirki\Field\Text( [
  'settings'    => 'necromancers_404_subtitle',
  'label'       => esc_html__( 'Subtitle', 'necromancers' ),
  'description' => esc_html__( 'Add subtitle here.', 'necromancers' ),
  'section'     => 'necromancers_section_404',
  'default'     => '',
] );

// Description
new \Kirki\Field\Textarea( [
  'settings'    => 'necromancers_404_desc',
  'label'       => esc_html__( 'Description', 'necromancers' ),
  'description' => esc_html__( 'Add copyright text here.', 'necromancers' ),
  'section'     => 'necromancers_section_404',
  'default'     => '',
] );

// Logo
new \Kirki\Field\Image( [
  'settings'    => 'necromancers_404_logo',
  'label'       => esc_attr__( 'Logo', 'necromancers' ),
  'description' => esc_attr__( 'Add your custom logo to the 404 page.', 'necromancers' ),
  'section'     => 'necromancers_section_404',
  'default'     => '',
] );



// - Custom Cursor

new \Kirki\Field\Checkbox( [
  'settings'    => 'necromancers_custom_cursor',
  'label'       => esc_html__( 'Custom Cursor', 'necromancers' ),
  'description' => esc_html__( 'Enables custom cursor.', 'necromancers' ),
  'section'     => 'necromancers_section_custom_cursor',
  'default'     => false
] );



// - Preloader

new \Kirki\Field\Checkbox_Switch( [
  'settings'    => 'necromancers_preloader',
  'label'       => esc_html__( 'Preloader', 'necromancers' ),
  'description' => esc_html__( 'Show preloading screen before content is loaded.', 'necromancers' ),
  'section'     => 'necromancers_section_preloader',
  'default'     => 'on',
  'choices'     => [
    'on'  => esc_html__( 'On', 'necromancers' ),
    'off' => esc_html__( 'Off', 'necromancers' ),
  ],
] );


// Type
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_preloader_type',
  'label'       => esc_html__( 'Type', 'necromancers' ),
  'description' => esc_html__( 'Select preloader type.', 'necromancers' ),
  'section'     => 'necromancers_section_preloader',
  'default'     => 'default',
  'placeholder' => esc_html__( 'Choose a preloader type', 'necromancers' ),
  'choices'     => [
    'default'    => esc_html__( 'Default', 'necromancers' ),
    'css'        => esc_html__( 'CSS preloaders', 'necromancers' ),
    'custom_img' => esc_html__( 'Custom Image', 'necromancers' ),
  ],
  'active_callback' => [
    [
      'setting'  => 'necromancers_preloader',
      'operator' => '==',
      'value'    => true,
    ]
  ],
] );

// CSS
new \Kirki\Field\Select( [
  'settings'    => 'necromancers_preloader_type_css',
  'label'       => esc_html__( 'CSS Preloaders', 'necromancers' ),
  'description' => esc_html__( 'Select CSS preloader.', 'necromancers' ),
  'section'     => 'necromancers_section_preloader',
  'default'     => 'circle',
  'placeholder' => esc_html__( 'Choose a preloader type', 'necromancers' ),
  'choices'     => [
    'circle'    => esc_html__( 'Circle', 'necromancers' ),
    'dual-ring' => esc_html__( 'Dual Ring', 'necromancers' ),
    'ellipsis'  => esc_html__( 'Ellipsis', 'necromancers' ),
    'grid'      => esc_html__( 'Grid', 'necromancers' ),
    'ring'      => esc_html__( 'Ring', 'necromancers' ),
    'ripple'    => esc_html__( 'Ripple', 'necromancers' ),
    'roller'    => esc_html__( 'Roller', 'necromancers' ),
    'spinner'   => esc_html__( 'Spinner', 'necromancers' ),
  ],
  'active_callback' => [
    [
      'setting'  => 'necromancers_preloader_type',
      'operator' => '==',
      'value'    => 'css',
    ]
  ],
] );

// Custom Image
new \Kirki\Field\Image( [
  'settings'    => 'necromancers_preloader_type_custom_img',
  'label'       => esc_attr__( 'Custom Preloader Image', 'necromancers' ),
  'description' => esc_attr__( 'Select a custom image to display as the Preloader.', 'necromancers' ),
  'section'     => 'necromancers_section_preloader',
  'default'     => '',
  'active_callback' => [
    [
      'setting'  => 'necromancers_preloader_type',
      'operator' => '==',
      'value'    => 'custom_img',
    ]
  ],
] );

// Background Color
new \Kirki\Field\Color( [
  'settings'    => 'necromancers_preloader_background_color',
  'label'       => esc_html__( 'Background Color', 'necromancers' ),
  'description' => esc_attr__( 'Set custom background color to preloader overlay.', 'necromancers' ),
  'section'     => 'necromancers_section_preloader',
  'default'     => '#151720',
  'active_callback' => [
    [
      'setting'  => 'necromancers_preloader',
      'operator' => '==',
      'value'    => true,
    ]
  ],
] );

// Icon Base Color
new \Kirki\Field\Color( [
  'settings'    => 'necromancers_preloader_base_color',
  'label'       => esc_html__( 'Icon Base Color', 'necromancers' ),
  'description' => esc_attr__( 'Set base color to preloader icon.', 'necromancers' ),
  'section'     => 'necromancers_section_preloader',
  'default'     => '#5e627e',
  'active_callback' => [
    [
      'setting'  => 'necromancers_preloader',
      'operator' => '==',
      'value'    => true,
    ],
    [
      'setting'  => 'necromancers_preloader_type',
      'operator' => '==',
      'value'    => 'default',
    ]
  ],
] );

// Icon Highlight Color
new \Kirki\Field\Color( [
  'settings'    => 'necromancers_preloader_highlight_color',
  'label'       => esc_html__( 'Icon Highlight Color', 'necromancers' ),
  'description' => esc_attr__( 'Set highlight color to preloader icon.', 'necromancers' ),
  'section'     => 'necromancers_section_preloader',
  'default'     => '#ffffff',
  'active_callback' => [
    [
      'setting'  => 'necromancers_preloader',
      'operator' => '==',
      'value'    => true,
    ],
    [
      'setting'  => 'necromancers_preloader_type',
      'operator' => '==',
      'value'    => 'default',
    ]
  ],
] );

// Icon Accent Color
new \Kirki\Field\Color( [
  'settings'    => 'necromancers_preloader_accent_color',
  'label'       => esc_html__( 'Icon Accent Color', 'necromancers' ),
  'description' => esc_attr__( 'Set accent color to preloader icon.', 'necromancers' ),
  'section'     => 'necromancers_section_preloader',
  'default'     => '#a3ff12',
  'active_callback' => [
    [
      'setting'  => 'necromancers_preloader',
      'operator' => '==',
      'value'    => true,
    ],
    [
      'setting'  => 'necromancers_preloader_type',
      'operator' => '!=',
      'value'    => 'custom_img',
    ],
  ],
] );



if ( class_exists( 'Woocommerce' ) ) {

  // - WooCommerce

  // Product Toggle
  new \Kirki\Field\Checkbox_Switch( [
    'settings'    => 'necromancers_catalog_featured_product_toggle',
    'label'       => esc_html__( 'Featured Product', 'necromancers' ),
    'section'     => 'necromancers_section_catalog_featured_product',
    'default'     => 'on',
    'choices'     => [
      'on'  => esc_html__( 'On', 'necromancers' ),
      'off' => esc_html__( 'Off', 'necromancers' ),
    ],
  ] );

  add_action( 'init', function() {
    // Featured Product selection
    new \Kirki\Field\Select( [
      'settings'    => 'necromancers_catalog_featured_product',
      'label'       => esc_html__( 'Select Featured Product', 'necromancers' ),
      'description' => esc_html__( 'Select product that would be displayed in the Featured section.', 'necromancers' ),
      'section'     => 'necromancers_section_catalog_featured_product',
      'default'     => 'default',
      'placeholder' => esc_html__( 'Select a product...', 'necromancers' ),
      'multiple'    => 1,
      'priority'    => 10,
      'choices'     => Kirki\Util\Helper::get_posts( [
        'post_type' => [
          'product',
        ],
        'posts_per_page' => -1,
      ] ),
      'active_callback' => [
        [
          'setting'  => 'necromancers_catalog_featured_product_toggle',
          'operator' => '==',
          'value'    => true,
        ]
      ],
    ] );
  } );

  // Subtitle
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_catalog_featured_product_subtitle',
    'label'       => esc_html__( 'Subtitle', 'necromancers' ),
    'description' => esc_html__( 'Subtitle displayed above the product title.', 'necromancers' ),
    'section'     => 'necromancers_section_catalog_featured_product',
    'default'     => esc_html__( 'Featured Item', 'necromancers' ),
    'priority'    => 20,
    'active_callback' => [
      [
        'setting'  => 'necromancers_catalog_featured_product_toggle',
        'operator' => '==',
        'value'    => true,
      ]
    ],
  ] );

  // Custom Product Image Toggle
  new \Kirki\Field\Checkbox_Switch( [
    'settings'    => 'necromancers_catalog_featured_product_custom_image_toggle',
    'label'       => esc_html__( 'Custom Product Image', 'necromancers' ),
    'description' => esc_attr__( 'If disabled then the product image is displayed by default.', 'necromancers' ),
    'section'     => 'necromancers_section_catalog_featured_product',
    'default'     => 'on',
    'priority'    => 30,
    'choices'     => [
      'on'  => esc_html__( 'On', 'necromancers' ),
      'off' => esc_html__( 'Off', 'necromancers' ),
    ],
    'active_callback' => [
      [
        'setting'  => 'necromancers_catalog_featured_product_toggle',
        'operator' => '==',
        'value'    => true,
      ]
    ],
  ] );

  // Custom Product Image
  new \Kirki\Field\Image( [
    'settings'    => 'necromancers_catalog_featured_product_custom_image',
    'label'       => esc_attr__( 'Set Custom Product Image', 'necromancers' ),
    'description' => esc_attr__( 'Select a custom product image to display as the Featured Product.', 'necromancers' ),
    'section'     => 'necromancers_section_catalog_featured_product',
    'default'     => get_template_directory_uri() . '/assets/img/shop/widget-featured-product-img-01.png',
    'priority'    => 40,
    'active_callback' => [
      [
        'setting'  => 'necromancers_catalog_featured_product_custom_image_toggle',
        'operator' => '==',
        'value'    => true,
      ]
    ],
  ] );

  // Price Title
  new \Kirki\Field\Text( [
    'settings'    => 'necromancers_catalog_featured_product_price_title',
    'label'       => esc_html__( 'Price Title', 'necromancers' ),
    'description' => esc_html__( 'Displayed above the product price.', 'necromancers' ),
    'section'     => 'necromancers_section_catalog_featured_product',
    'default'     => esc_html__( 'Get It For', 'necromancers' ),
    'priority'    => 50,
    'active_callback' => [
      [
        'setting'  => 'necromancers_catalog_featured_product_toggle',
        'operator' => '==',
        'value'    => true,
      ]
    ],
  ] );

  // Highlight
  new \Kirki\Field\Checkbox_Switch( [
    'settings'    => 'necromancers_catalog_featured_product_highlight',
    'label'       => esc_html__( 'Highlight', 'necromancers' ),
    'description' => esc_html__( 'Highlights the first line of the Product Title.', 'necromancers' ),
    'section'     => 'necromancers_section_catalog_featured_product',
    'default'     => 'on',
    'priority'    => 60,
    'choices'     => [
      'on'  => esc_html__( 'On', 'necromancers' ),
      'off' => esc_html__( 'Off', 'necromancers' ),
    ],
    'active_callback' => [
      [
        'setting'  => 'necromancers_catalog_featured_product_toggle',
        'operator' => '==',
        'value'    => true,
      ]
    ],
  ] );

  // Background
  new \Kirki\Field\Background( [
    'settings'    => 'necromancers_catalog_featured_product_bg',
    'label'       => esc_attr__( 'Page Heading Background', 'necromancers' ),
    'description' => esc_attr__( 'Add your custom background to the Page Heading - Side Header.', 'necromancers' ),
    'section'     => 'necromancers_section_catalog_featured_product',
    'priority'    => 70,
    'default'     => [
      'background-color'      => '#222430',
      'background-image'      => '',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'scroll',
    ],
    'output' => [
      [
        'element'  => '.widget-featured-product',
      ]
    ],
  ] );

  // Duotone
  new \Kirki\Field\Select( [
    'settings'    => 'necromancers_catalog_featured_product_duotone',
    'label'       => esc_html__( 'Duotone Effect', 'necromancers' ),
    'description' => esc_html__( 'Duotone effect applied on selected background image.', 'necromancers' ),
    'section'     => 'necromancers_section_catalog_featured_product',
    'default'     => 'base',
    'placeholder' => esc_html__( 'Select an option...', 'necromancers' ),
    'multiple'    => 1,
    'choices'     => $duotone_effects,
    'priority'    => 80,
  ] );

  // Decorations
  new \Kirki\Field\Checkbox( [
    'settings'    => 'necromancers_catalog_featured_product_decorations',
    'label'       => esc_html__( 'Display Decorations', 'necromancers' ),
    'description' => esc_html__( 'Decorations includes dots and gradients.', 'necromancers' ),
    'section'     => 'necromancers_section_catalog_featured_product',
    'default'     => true,
    'priority'    => 90,
  ] );

}
