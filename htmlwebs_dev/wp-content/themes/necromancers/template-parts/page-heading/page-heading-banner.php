<?php
/**
 * Page Heading - Side Banner
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.4.1
 */

$side_logo_display = isset( $args['side_logo_display'] ) ? $args['side_logo_display'] : true;
$side_logo         = isset( $args['side_logo'] ) ? $args['side_logo'] : false;
$side_decor        = isset( $args['side_decor'] ) ? $args['side_decor'] : true;
$side_duotone      = isset( $args['side_duotone'] ) ? $args['side_duotone'] : get_theme_mod( 'necromancers_page_heading_side_duotone', 'base' );
$side_bg_color     = isset( $args['side_bg_color'] ) ? $args['side_bg_color'] : false;
$side_bg_img_on    = isset( $args['side_bg_img_on'] ) ? $args['side_bg_img_on'] : true;
$side_bg_img       = isset( $args['side_bg_img'] ) ? $args['side_bg_img'] : false;

$classes = [
  'page-thumbnail',
  'page-thumbnail--default',
];

// Duotone
if ( $side_duotone !== 'no_effect' ) {
  $classes[] = 'effect-duotone';
  $classes[] = 'effect-duotone--' . $side_duotone;
}

// Background Color and Image
$bg_output = [];
if ( ! $side_bg_img_on ) {
  $bg_output[] = 'background-image: none';
}

if ( $side_bg_img_on && $side_bg_img ) {
  $bg_output[] = 'background-image: url( ' . esc_url( $side_bg_img ) . ' )';
}

if ( $side_bg_color ) {
  $bg_output[] = 'background-color:' . $side_bg_color;
}
?>

<figure class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="<?php echo implode( '; ', $bg_output ); ?>">
  <?php
  if ( $side_logo_display ) {
    // Side Logo
    $logo_path = $side_logo ? $side_logo : get_template_directory_uri() . '/assets/img/page-bg-logo.png';
    echo '<img src="' . esc_url( $logo_path ) . '" class="page-bg-logo" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
  }
  ?>

  <?php if ( $side_duotone !== 'no_effect' ) : ?>
    <div class="effect-duotone__layer">
      <div class="effect-duotone__layer-inner"></div>
    </div>
  <?php endif; ?>

  <?php if ( $side_decor ) : ?>
    <div class="page-heading-effect page-heading-effect--gradient-1"></div>
    <div class="page-heading-effect page-heading-effect--gradient-2"></div>

    <div class="ncr-page-decor">
      <div class="ncr-page-decor__layer-1">
        <div class="ncr-page-decor__layer-bg"></div>
      </div>
      <div class="ncr-page-decor__layer-2"></div>
      <div class="ncr-page-decor__layer-3">
        <div class="ncr-page-decor__layer-bg"></div>
      </div>
      <div class="ncr-page-decor__layer-4"></div>
      <div class="ncr-page-decor__layer-5"></div>
      <div class="ncr-page-decor__layer-6"></div>
    </div>
  <?php endif; ?>

</figure>
