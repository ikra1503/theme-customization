<?php
/**
 * Page Heading - Side
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.4.1
 */

$title         = isset( $args['title'] ) ? $args['title'] : get_the_title();
$subtitle      = isset( $args['subtitle'] ) ? $args['subtitle'] : get_bloginfo( 'name' );
$email_label   = isset( $args['email_label'] ) ? $args['email_label'] : '';
$email_address = isset( $args['email_address'] ) ? $args['email_address'] : '';
$duotone       = isset( $args['page_heading_duotone'] ) ? $args['page_heading_duotone'] : get_theme_mod( 'necromancers_page_heading_side_header_duotone', 'base' );
$decorations = isset( $args['page_heading_decorations'] ) ? $args['page_heading_decorations'] : get_theme_mod( 'necromancers_page_heading_side_header_decorations', true );

$classes = [
  'page-heading',
  'page-heading--loop',
];

// Duotone
if ( $duotone !== 'no_effect' ) {
  $classes[] = 'effect-duotone';
  $classes[] = 'effect-duotone--' . $duotone;
}

$extra_classes = isset( $args['extra_classes'] ) ? $classes[] = $args['extra_classes'] : '';
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
  <div class="page-heading__subtitle h5 color-primary"><?php echo esc_html( $subtitle ); ?></div>
  <h1 class="page-heading__title h-lead-2"><?php echo esc_html( $title ); ?></h1>

  <div class="page-heading__body">
    <?php if ( $email_label ) : ?>
      <div class="h6 color-primary"><?php echo esc_html( $email_label ); ?></div>
    <?php endif; ?>
    <?php if ( $email_address ) : ?>
      <div class="h4"><a href="mailto:<?php echo esc_attr( $email_address ); ?>"><?php echo esc_html( $email_address ); ?></a></div>
    <?php endif; ?>
  </div>

  <?php if ( $duotone !== 'no_effect' ) : ?>
    <div class="effect-duotone__layer">
      <div class="effect-duotone__layer-inner"></div>
    </div>
  <?php endif; ?>

  <?php if ( $decorations ) : ?>
    <div class="page-heading-effect page-heading-effect--gradient-1"></div>
    <div class="page-heading-effect page-heading-effect--gradient-2"></div>
    <div class="page-heading-effect page-heading-effect--pattern page-heading-effect--pattern-1"></div>
    <div class="page-heading-effect page-heading-effect--pattern page-heading-effect--pattern-2"></div>
  <?php endif; ?>

</div>
