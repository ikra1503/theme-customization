<?php
/**
 * Template part for displaying page content width side banner on pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.2
 */

$page_heading_fields = get_field( 'ncr_page_heading_side_banner' );

$defaults = [
  'ncr_page_heading_bg_color' => isset( $page_heading_fields['ncr_page_heading_bg_color'] ) ? $page_heading_fields['ncr_page_heading_bg_color'] : '',
  'ncr_page_heading_custom_bg_img_on' => isset( $page_heading_fields['ncr_page_heading_custom_bg_img_on'] ) ? $page_heading_fields['ncr_page_heading_custom_bg_img_on'] : 'default',
  'ncr_page_heading_custom_bg_img' => isset( $page_heading_fields['ncr_page_heading_custom_bg_img'] ) ? $page_heading_fields['ncr_page_heading_custom_bg_img'] : false,
  'ncr_page_heading_custom_duotone_effect' => isset( $page_heading_fields['ncr_page_heading_custom_duotone_effect'] ) ? $page_heading_fields['ncr_page_heading_custom_duotone_effect'] : 'default',
  'ncr_page_heading_custom_logo_on' => isset( $page_heading_fields['ncr_page_heading_custom_logo_on'] ) ? $page_heading_fields['ncr_page_heading_custom_logo_on'] : 'default',
  'ncr_page_heading_custom_logo_img' => isset( $page_heading_fields['ncr_page_heading_custom_logo_img'] ) ? $page_heading_fields['ncr_page_heading_custom_logo_img'] : false,
  'ncr_page_heading_decorations' => isset( $page_heading_fields['ncr_page_heading_decorations'] ) ? $page_heading_fields['ncr_page_heading_decorations'] : 'default',
];
extract( $defaults, EXTR_SKIP );

// Side Banner Background Image - On/Off
if ( $ncr_page_heading_custom_bg_img_on === 'disable' ) {
  $side_bg_img_on = false;
} else {
  $side_bg_img_on = true;
}

// Side Banner Background Color
$side_bg_color = $ncr_page_heading_bg_color;

// Side Banner Background Image
if ( $ncr_page_heading_custom_bg_img && $side_bg_img_on ) {
  $side_bg_img = $ncr_page_heading_custom_bg_img;
} else {
  $side_bg_img = false;
}

// Duotone
$side_duotone = $ncr_page_heading_custom_duotone_effect !== 'default' ? $ncr_page_heading_custom_duotone_effect : get_theme_mod( 'necromancers_page_heading_side_duotone', 'base' );

// Side Banner Logo - On/Off
if ( $ncr_page_heading_custom_logo_on === 'default' ) {
  $side_logo_display = get_theme_mod( 'necromancers_page_heading_side_logo_display', true );
} elseif ( $ncr_page_heading_custom_logo_on === 'disable' ) {
  $side_logo_display = false;
} else {
  $side_logo_display = true;
}

// Side Banner Logo
if ( $ncr_page_heading_custom_logo_img && $ncr_page_heading_custom_logo_on === 'custom' ) {
  $side_logo = $ncr_page_heading_custom_logo_img;
} else {
  $side_logo = get_theme_mod( 'necromancers_page_heading_side_logo' );
}

// Decorations
if ( $ncr_page_heading_decorations === 'default' ) {
  $side_decor = get_theme_mod( 'necromancers_page_heading_side_decor_display', true );
} elseif ( $ncr_page_heading_decorations === 'disable' ) {
  $side_decor = false;
} else {
  $side_decor = true;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php
  // Heading Banner
  get_template_part(
    'template-parts/page-heading/page-heading-banner',
    null,
    [
      'side_logo_display' => $side_logo_display,
      'side_logo'         => $side_logo,
      'side_decor'        => $side_decor,
      'side_duotone'      => $side_duotone,
      'side_bg_color'     => $side_bg_color,
      'side_bg_img_on'    => $side_bg_img_on,
      'side_bg_img'       => $side_bg_img,
    ]
  );

  // Title
  the_title( '<h1 class="page-title">', '</h1>' );
  ?>
  
  <div class="page-content">
    <?php
    the_content();

    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'necromancers' ),
        'after'  => '</div>',
      )
    );
    ?>
  </div><!-- .page-content -->
</article><!-- #post-<?php the_ID(); ?> -->
