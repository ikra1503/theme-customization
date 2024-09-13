<?php
/**
 * Enqueue scripts and styles.
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.0
 */

if ( ! function_exists( 'necromancers_enqueue_inline' ) ) {
  function necromancers_enqueue_inline() {

    $uri = get_theme_file_uri();
    $custom_css = '';

    // Custom Properties (CSS variables)
    $custom_css .= ":root {"; // needed here to declare custom properties (CSS variables)

    // Typography: Font Base
    $font_base = get_theme_mod( 'necromancers_typography_base', 'Rajdhani' );
    $font_base_output = is_array( $font_base ) ? $font_base['font-family'] : $font_base;

    $custom_css .= "
      --font-base: {$font_base_output};
    ";

    // Typography: Font Size - Base
    $font_size_base = get_theme_mod( 'necromancers_typography_font_size_base', '1rem' );

    $custom_css .= "
      --font-size-base: {$font_size_base};
    ";

    // Typography: Font Size - Heading Lead 1
    $font_size_h_lead1 = get_theme_mod( 'necromancers_typography_font_size_h_lead1', '6.375rem' );

    $custom_css .= "
      --h-lead1-font-size: {$font_size_h_lead1};
    ";

    // Typography: Font Size - Heading Lead 2
    $font_size_h_lead2 = get_theme_mod( 'necromancers_typography_font_size_h_lead2', '4.5rem' );

    $custom_css .= "
      --h-lead2-font-size: {$font_size_h_lead2};
    ";

    // Typography: Font Size - H1
    $font_size_h1 = get_theme_mod( 'necromancers_typography_font_size_h1', '3.875rem' );

    $custom_css .= "
      --h1-font-size: {$font_size_h1};
    ";

    // Typography: Font Size - H2
    $font_size_h2 = get_theme_mod( 'necromancers_typography_font_size_h2', '2.875rem' );

    $custom_css .= "
      --h2-font-size: {$font_size_h2};
    ";

    // Typography: Font Size - H3
    $font_size_h3 = get_theme_mod( 'necromancers_typography_font_size_h3', '2rem' );

    $custom_css .= "
      --h3-font-size: {$font_size_h3};
    ";

    // Typography: Font Size - H4
    $font_size_h4 = get_theme_mod( 'necromancers_typography_font_size_h4', '1.5rem' );

    $custom_css .= "
      --h4-font-size: {$font_size_h4};
    ";

    // Typography: Font Size - H5
    $font_size_h5 = get_theme_mod( 'necromancers_typography_font_size_h5', '1.125rem' );

    $custom_css .= "
      --h5-font-size: {$font_size_h5};
    ";

    // Typography: Font Size - H6
    $font_size_h6 = get_theme_mod( 'necromancers_typography_font_size_h6', '1rem' );

    $custom_css .= "
      --h6-font-size: {$font_size_h6};
    ";

    // Color: Body Background Color
    $color_background = get_theme_mod( 'necromancers_color_background_color', '#ffffff' );
    $color_background_hsl = necromancers_hex_to_hsl( $color_background );

    $custom_css .= "
      --color-body-bg: {$color_background};
      --color-body-bg-h: {$color_background_hsl['H']};
      --color-body-bg-s: {$color_background_hsl['S']}%;
      --color-body-bg-l: {$color_background_hsl['L']}%;
    ";

    // Color: Body Font Color
    $color_body = get_theme_mod( 'necromancers_color_body', '#222430' );
    $color_body_hsl = necromancers_hex_to_hsl( $color_body );

    $custom_css .= "
      --color-body: {$color_body};
      --color-body-h: {$color_body_hsl['H']};
      --color-body-s: {$color_body_hsl['S']}%;
      --color-body-l: {$color_body_hsl['L']}%;
    ";

    // Color: Body Font Color - Inverse
    $color_body_dark = get_theme_mod( 'necromancers_color_body_dark', '#c6cbea' );
    $color_body_dark_hsl = necromancers_hex_to_hsl( $color_body_dark );

    $custom_css .= "
      --color-body-dark: {$color_body_dark};
      --color-body-dark-h: {$color_body_dark_hsl['H']};
      --color-body-dark-s: {$color_body_dark_hsl['S']}%;
      --color-body-dark-l: {$color_body_dark_hsl['L']}%;
    ";

    // Color: Primary
    $color_primary = get_theme_mod( 'necromancers_color_primary', '#a3ff12' );
    $color_primary_hsl = necromancers_hex_to_hsl( $color_primary );

    $custom_css .= "
      --color-primary: {$color_primary};
      --color-primary-h: {$color_primary_hsl['H']};
      --color-primary-s: {$color_primary_hsl['S']}%;
      --color-primary-l: {$color_primary_hsl['L']}%;
    ";

    // Color: Secondary
    $color_secondary = get_theme_mod( 'necromancers_color_secondary', '#5e627e' );

    // Convert my HEX
    $color_secondary_hsl = necromancers_hex_to_hsl( $color_secondary );

    $custom_css .= "
      --color-secondary: {$color_secondary};
      --color-secondary-h: {$color_secondary_hsl['H']};
      --color-secondary-s: {$color_secondary_hsl['S']}%;
      --color-secondary-l: {$color_secondary_hsl['L']}%;
    ";

    // Color: Tertiary
    $color_tertiary = get_theme_mod( 'necromancers_color_tertiary', '#222430' );
    $color_tertiary_hsl = necromancers_hex_to_hsl( $color_tertiary );

    $custom_css .= "
      --color-tertiary: {$color_tertiary};
      --color-tertiary-h: {$color_tertiary_hsl['H']};
      --color-tertiary-s: {$color_tertiary_hsl['S']}%;
      --color-tertiary-l: {$color_tertiary_hsl['L']}%;
    ";

    // Color: Quaternary
    $color_quaternary = get_theme_mod( 'necromancers_color_quaternary', '#3d4055' );
    $color_quaternary_hsl = necromancers_hex_to_hsl( $color_quaternary );

    $custom_css .= "
      --color-quaternary: {$color_quaternary};
      --color-quaternary-h: {$color_quaternary_hsl['H']};
      --color-quaternary-s: {$color_quaternary_hsl['S']}%;
      --color-quaternary-l: {$color_quaternary_hsl['L']}%;
    ";

    // Color: Success
    $color_success = get_theme_mod( 'necromancers_color_success', '#88df00' );
    $color_success_hsl = necromancers_hex_to_hsl( $color_success );

    $custom_css .= "
      --color-success: {$color_success};
      --color-success-h: {$color_success_hsl['H']};
      --color-success-s: {$color_success_hsl['S']}%;
      --color-success-l: {$color_success_hsl['L']}%;
    ";

    // Color: Info
    $color_info = get_theme_mod( 'necromancers_color_info', '#ced0da' );
    $color_info_hsl = necromancers_hex_to_hsl( $color_info );

    $custom_css .= "
      --color-info: {$color_info};
      --color-info-h: {$color_info_hsl['H']};
      --color-info-s: {$color_info_hsl['S']}%;
      --color-info-l: {$color_info_hsl['L']}%;
    ";

    // Color: Warning
    $color_warning = get_theme_mod( 'necromancers_color_warning', '#ffcc00' );
    $color_warning_hsl = necromancers_hex_to_hsl( $color_warning );

    $custom_css .= "
      --color-warning: {$color_warning};
      --color-warning-h: {$color_warning_hsl['H']};
      --color-warning-s: {$color_warning_hsl['S']}%;
      --color-warning-l: {$color_warning_hsl['L']}%;
    ";

    // Color: Danger
    $color_danger = get_theme_mod( 'necromancers_color_danger', '#ff1c5c' );
    $color_danger_hsl = necromancers_hex_to_hsl( $color_danger );

    $custom_css .= "
      --color-danger: {$color_danger};
      --color-danger-h: {$color_danger_hsl['H']};
      --color-danger-s: {$color_danger_hsl['S']}%;
      --color-danger-l: {$color_danger_hsl['L']}%;
    ";

    // Color: Light
    $color_light = get_theme_mod( 'necromancers_color_light', '#ffffff' );
    $color_light_hsl = necromancers_hex_to_hsl( $color_light );

    $custom_css .= "
      --color-light: {$color_light};
      --color-light-h: {$color_light_hsl['H']};
      --color-light-s: {$color_light_hsl['S']}%;
      --color-light-l: {$color_light_hsl['L']}%;
    ";

    // Color: Lighter
    $color_lighter = get_theme_mod( 'necromancers_color_lighter', '#f7f8fa' );
    $color_lighter_hsl = necromancers_hex_to_hsl( $color_lighter );

    $custom_css .= "
      --color-lighter: {$color_lighter};
      --color-lighter-h: {$color_lighter_hsl['H']};
      --color-lighter-s: {$color_lighter_hsl['S']}%;
      --color-lighter-l: {$color_lighter_hsl['L']}%;
    ";

    // Color: Dark
    $color_dark = get_theme_mod( 'necromancers_color_dark', '#151720' );
    $color_dark_hsl = necromancers_hex_to_hsl( $color_dark );

    $custom_css .= "
      --color-dark: {$color_dark};
      --color-dark-h: {$color_dark_hsl['H']};
      --color-dark-s: {$color_dark_hsl['S']}%;
      --color-dark-l: {$color_dark_hsl['L']}%;
    ";

    // Color: Black
    $color_black = get_theme_mod( 'necromancers_color_black', '#13151e' );
    $color_black_hsl = necromancers_hex_to_hsl( $color_black );

    $custom_css .= "
      --color-black: {$color_black};
      --color-black-h: {$color_black_hsl['H']};
      --color-black-s: {$color_black_hsl['S']}%;
      --color-black-l: {$color_black_hsl['L']}%;
    ";

    // Color: Subtle
    $color_tiny = get_theme_mod( 'necromancers_color_tiny', '#5e627e' );
    $color_tiny_hsl = necromancers_hex_to_hsl( $color_tiny );

    $custom_css .= "
      --color-tiny: {$color_tiny};
      --color-tiny-h: {$color_tiny_hsl['H']};
      --color-tiny-s: {$color_tiny_hsl['S']}%;
      --color-tiny-l: {$color_tiny_hsl['L']}%;
    ";

    // Color: Landing Primary
    $color_landing_primary = get_theme_mod( 'necromancers_color_landing_primary', '#68ff01' );
    $color_landing_primary_hsl = necromancers_hex_to_hsl( $color_landing_primary );

    $custom_css .= "
      --color-landing-detail-primary: {$color_landing_primary};
      --color-landing-detail-primary-h: {$color_landing_primary_hsl['H']};
      --color-landing-detail-primary-s: {$color_landing_primary_hsl['S']}%;
      --color-landing-detail-primary-l: {$color_landing_primary_hsl['L']}%;
    ";

    // Color: Landing Secondary
    $color_landing_secondary = get_theme_mod( 'necromancers_color_landing_secondary', '#ccff3a' );
    $color_landing_secondary_hsl = necromancers_hex_to_hsl( $color_landing_secondary );

    $custom_css .= "
      --color-landing-detail-secondary: {$color_landing_secondary};
      --color-landing-detail-secondary-h: {$color_landing_secondary_hsl['H']};
      --color-landing-detail-secondary-s: {$color_landing_secondary_hsl['S']}%;
      --color-landing-detail-secondary-l: {$color_landing_secondary_hsl['L']}%;
    ";

    // Decoration Color: Layer 1 Gradient Start
    $color_decor_layer_1_gradient_start = get_theme_mod( 'necromancers_color_decor_layer-1-gradient-start', '#73bb00' );
    $color_decor_layer_1_gradient_start_hsl = necromancers_hex_to_hsl( $color_decor_layer_1_gradient_start );

    $custom_css .= "
      --color-decor-page-layer-1-gradient-start: {$color_decor_layer_1_gradient_start};
      --color-decor-page-layer-1-gradient-start-h: {$color_decor_layer_1_gradient_start_hsl['H']};
      --color-decor-page-layer-1-gradient-start-s: {$color_decor_layer_1_gradient_start_hsl['S']}%;
      --color-decor-page-layer-1-gradient-start-l: {$color_decor_layer_1_gradient_start_hsl['L']}%;
    ";

    // Decoration Color: Layer 1 Gradient Stop
    $color_decor_layer_1_gradient_stop = get_theme_mod( 'necromancers_color_decor_layer-1-gradient-stop', '#1d3000' );
    $color_decor_layer_1_gradient_stop_hsl = necromancers_hex_to_hsl( $color_decor_layer_1_gradient_stop );

    $custom_css .= "
      --color-decor-page-layer-1-gradient-stop: {$color_decor_layer_1_gradient_stop};
      --color-decor-page-layer-1-gradient-stop-h: {$color_decor_layer_1_gradient_stop_hsl['H']};
      --color-decor-page-layer-1-gradient-stop-s: {$color_decor_layer_1_gradient_stop_hsl['S']}%;
      --color-decor-page-layer-1-gradient-stop-l: {$color_decor_layer_1_gradient_stop_hsl['L']}%;
    ";

    // Decoration Color: Layer 2 Gradient Start
    $color_decor_layer_2_gradient_start = get_theme_mod( 'necromancers_color_decor_layer-2-gradient-start', '#b6e900' );
    $color_decor_layer_2_gradient_start_hsl = necromancers_hex_to_hsl( $color_decor_layer_2_gradient_start );

    $custom_css .= "
      --color-decor-page-layer-2-gradient-start: {$color_decor_layer_2_gradient_start};
      --color-decor-page-layer-2-gradient-start-h: {$color_decor_layer_2_gradient_start_hsl['H']};
      --color-decor-page-layer-2-gradient-start-s: {$color_decor_layer_2_gradient_start_hsl['S']}%;
      --color-decor-page-layer-2-gradient-start-l: {$color_decor_layer_2_gradient_start_hsl['L']}%;
    ";

    // Decoration Color: Layer 2 Gradient Stop
    $color_decor_layer_2_gradient_stop = get_theme_mod( 'necromancers_color_decor_layer-2-gradient-stop', '#55cc00' );
    $color_decor_layer_2_gradient_stop_hsl = necromancers_hex_to_hsl( $color_decor_layer_2_gradient_stop );

    $custom_css .= "
      --color-decor-page-layer-2-gradient-stop: {$color_decor_layer_2_gradient_stop};
      --color-decor-page-layer-2-gradient-stop-h: {$color_decor_layer_2_gradient_stop_hsl['H']};
      --color-decor-page-layer-2-gradient-stop-s: {$color_decor_layer_2_gradient_stop_hsl['S']}%;
      --color-decor-page-layer-2-gradient-stop-l: {$color_decor_layer_2_gradient_stop_hsl['L']}%;
    ";

    // Decoration Color: Layer 3 Gradient Start
    $color_decor_layer_3_gradient_start = get_theme_mod( 'necromancers_color_decor_layer-3-gradient-start', '#c8ff19' );
    $color_decor_layer_3_gradient_start_hsl = necromancers_hex_to_hsl( $color_decor_layer_3_gradient_start );

    $custom_css .= "
      --color-decor-page-layer-3-gradient-start: {$color_decor_layer_3_gradient_start};
      --color-decor-page-layer-3-gradient-start-h: {$color_decor_layer_3_gradient_start_hsl['H']};
      --color-decor-page-layer-3-gradient-start-s: {$color_decor_layer_3_gradient_start_hsl['S']}%;
      --color-decor-page-layer-3-gradient-start-l: {$color_decor_layer_3_gradient_start_hsl['L']}%;
    ";

    // Decoration Color: Layer 3 Gradient Stop
    $color_decor_layer_3_gradient_stop = get_theme_mod( 'necromancers_color_decor_layer-3-gradient-stop', '#7fff0b' );
    $color_decor_layer_3_gradient_stop_hsl = necromancers_hex_to_hsl( $color_decor_layer_3_gradient_stop );

    $custom_css .= "
      --color-decor-page-layer-3-gradient-stop: {$color_decor_layer_3_gradient_stop};
      --color-decor-page-layer-3-gradient-stop-h: {$color_decor_layer_3_gradient_stop_hsl['H']};
      --color-decor-page-layer-3-gradient-stop-s: {$color_decor_layer_3_gradient_stop_hsl['S']}%;
      --color-decor-page-layer-3-gradient-stop-l: {$color_decor_layer_3_gradient_stop_hsl['L']}%;
    ";

    // Decoration Color: Line
    $color_decor_line = get_theme_mod( 'necromancers_color_decor_line', '#f3ff38' );
    $color_decor_line_hsl = necromancers_hex_to_hsl( $color_decor_line );

    $custom_css .= "
      --color-decor-page-line: {$color_decor_line};
      --color-decor-page-line-h: {$color_decor_line_hsl['H']};
      --color-decor-page-line-s: {$color_decor_line_hsl['S']}%;
      --color-decor-page-line-l: {$color_decor_line_hsl['L']}%;
    ";

    // Preloader: Background
    $preloader_bg_color = get_theme_mod( 'necromancers_preloader_background_color', '#151720' );
    $preloader_bg_color_hsl = necromancers_hex_to_hsl( $preloader_bg_color );

    $custom_css .= "
      --color-preloader-bg: {$preloader_bg_color};
      --color-preloader-bg-h: {$preloader_bg_color_hsl['H']};
      --color-preloader-bg-s: {$preloader_bg_color_hsl['S']}%;
      --color-preloader-bg-l: {$preloader_bg_color_hsl['L']}%;
    ";

    // Preloader: Base
    $preloader_base_color = get_theme_mod( 'necromancers_preloader_base_color', '#5e627e' );
    $preloader_base_color_hsl = necromancers_hex_to_hsl( $preloader_base_color );

    $custom_css .= "
      --color-preloader-base: {$preloader_base_color};
      --color-preloader-base-h: {$preloader_base_color_hsl['H']};
      --color-preloader-base-s: {$preloader_base_color_hsl['S']}%;
      --color-preloader-base-l: {$preloader_base_color_hsl['L']}%;
    ";

    // Preloader: Highlight
    $preloader_highlight_color = get_theme_mod( 'necromancers_preloader_highlight_color', '#ffffff' );
    $preloader_highlight_color_hsl = necromancers_hex_to_hsl( $preloader_highlight_color );

    $custom_css .= "
      --color-preloader-highlight: {$preloader_highlight_color};
      --color-preloader-highlight-h: {$preloader_highlight_color_hsl['H']};
      --color-preloader-highlight-s: {$preloader_highlight_color_hsl['S']}%;
      --color-preloader-highlight-l: {$preloader_highlight_color_hsl['L']}%;
    ";

    // Preloader: Accent
    $preloader_accent_color = get_theme_mod( 'necromancers_preloader_accent_color', '#a3ff12' );
    $preloader_accent_color_hsl = necromancers_hex_to_hsl( $preloader_accent_color );

    $custom_css .= "
      --color-preloader-accent: {$preloader_accent_color};
      --color-preloader-accent-h: {$preloader_accent_color_hsl['H']};
      --color-preloader-accent-s: {$preloader_accent_color_hsl['S']}%;
      --color-preloader-accent-l: {$preloader_accent_color_hsl['L']}%;
    ";

    $custom_css .= "}"; // close root


    // Background Image: Body Background Image
    $color_background = get_theme_mod( 'necromancers_color_background', [
      'background-image'      => '',
      'background-repeat'     => 'no-repeat',
      'background-position'   => 'center center',
      'background-size'       => 'cover',
      'background-attachment' => 'scroll',
    ] );

    $custom_css .= ".site-layout--default .site-content__inner {";
      if ( isset( $color_background['background-image'] ) && ! empty( $color_background['background-image'] ) ) {
        $custom_css .= "background-image: url({$color_background['background-image']});";
      }
      if ( isset( $color_background['background-repeat'] ) && ! empty( $color_background['background-repeat'] ) ) {
        $custom_css .= "background-repeat: {$color_background['background-repeat']};";
      }
      if ( isset( $color_background['background-position'] ) && ! empty( $color_background['background-position'] ) ) {
        $custom_css .= "background-position: {$color_background['background-position']};";
      }
      if ( isset( $color_background['background-size'] ) && ! empty( $color_background['background-size'] ) ) {
        $custom_css .= "background-size: {$color_background['background-size']};";
      }
      if ( isset( $color_background['background-attachment'] ) && ! empty( $color_background['background-attachment'] ) ) {
        $custom_css .= "background-attachment: {$color_background['background-attachment']};";
      }
    $custom_css .= "}";

    // Post Categories custom colors
    $terms = get_terms( array(
      'taxonomy' => array( 'category' )
    ) );

    foreach ( $terms as $term ) {
      $term_color = get_field( 'category_color', 'term_' . $term->term_id );
      if ( $term_color ) {
        $custom_css .= "
        .post__cats-item .category-{$term->slug} {
          color: {$term_color};
        }";
      }
    }

    // Custom Background
    if ( is_page_template( 'page-landing.php' ) || is_page_template( 'page-center.php' ) ) {
      $custom_bg = get_field( 'ncr_page_custom_background_image' );

      if ( $custom_bg ) {
        $id = get_the_ID();
        $custom_css .= "
        .page-id-{$id} {
          background-image: url('{$custom_bg}');
        }";
      }
    }

    // Preloader
    $preloader_bg_color = get_theme_mod( 'necromancers_preloader_background_color', '#151720' );
    if ( ! empty( $preloader_bg_color ) ) {
      $custom_css .= ".preloader-overlay { background-color: {$preloader_bg_color}; }";
    }

    $preloader_base_color = get_theme_mod( 'necromancers_preloader_base_color', '#5e627e' );
    if ( ! empty( $preloader_base_color ) ) {
      $custom_css .= ".preloader svg { fill: {$preloader_base_color}; }";
    }

    // Add custom styles
    wp_add_inline_style( 'necromancers-components', $custom_css );

  }

  add_action( 'wp_enqueue_scripts', 'necromancers_enqueue_inline' );
}
