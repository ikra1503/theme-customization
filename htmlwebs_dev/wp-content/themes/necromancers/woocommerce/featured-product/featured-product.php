<?php
/**
 * Featured Product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.2.0
 * @version   1.4.1
 */

// Get the Product ID
$featured_product_id = get_theme_mod( 'necromancers_catalog_featured_product', false );

// Background
$duotone     = get_theme_mod( 'necromancers_catalog_featured_product_duotone', 'base' );
$decorations = get_theme_mod( 'necromancers_catalog_featured_product_decorations', true );

$classes = [
  'widget',
  'widget-featured-product',
];

// Duotone
if ( $duotone !== 'no_effect' ) {
  $classes[] = 'effect-duotone';
  $classes[] = 'effect-duotone--' . $duotone;
}

// check if the Product ID is set
if ( $featured_product_id ) :
  $featured_product_subtitle            = get_theme_mod( 'necromancers_catalog_featured_product_subtitle', esc_html__( 'Featured Item', 'necromancers' ) );
  $featured_product_custom_image_toggle = get_theme_mod( 'necromancers_catalog_featured_product_custom_image_toggle', true );
  $featured_product_custom_image        = get_theme_mod( 'necromancers_catalog_featured_product_custom_image', get_template_directory_uri() . '/assets/img/shop/widget-featured-product-img-01.png' );
  $featured_product_price_title         = get_theme_mod( 'necromancers_catalog_featured_product_price_title', esc_html__( 'Get It For', 'necromancers' ) );
  $featured_product_title_highlight     = get_theme_mod( 'necromancers_catalog_featured_product_highlight', true );

  // get the product
  $product = wc_get_product( $featured_product_id );
  ?>

  <div class="widget-area widger-area--before-loop">
    <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
      <?php if ( $featured_product_subtitle ) : ?>
        <div class="widget__subtitle"><?php echo esc_html( $featured_product_subtitle ); ?></div>
      <?php endif; ?>

      <h1 class="widget__title h2 <?php echo esc_html( $featured_product_title_highlight ? 'widget__title--highlight' : '' ); ?>"><?php echo esc_html( $product->get_title() ); ?></h1>
      <div class="widget__thumbnail">
        <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
          <?php
          if ( $featured_product_custom_image_toggle && $featured_product_custom_image ) {
            echo '<img src="' . $featured_product_custom_image . '" alt="">';
          } else {
            echo wp_kses_post( $product->get_image() );
          }
          ?>
        </a>
        <div class="widget__price">
          <span class="add-icon"></span>
          <?php if ( $featured_product_price_title ) : ?>
            <div class="widget__price-label"><?php echo esc_html( $featured_product_price_title ); ?> </div>
          <?php endif; ?>
          <div class="widget__price-count">
            <?php echo wp_kses_post( $product->get_price_html() ); ?>
          </div>
        </div>
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
        <div class="page-heading-effect page-heading-effect--pattern page-heading-effect--pattern-3"></div>
      <?php endif; ?>

    </div>
  </div>
  <?php
endif;
