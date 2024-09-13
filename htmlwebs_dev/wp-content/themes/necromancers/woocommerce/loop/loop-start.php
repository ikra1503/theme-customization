<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$catalog_rows_option = absint( get_option( 'woocommerce_catalog_rows', 2 ) );
$catalog_rows_mod    = absint( get_theme_mod( 'woocommerce_catalog_rows', 0 ) );

// for demo purposes
if ( $catalog_rows_mod ) {
	$catalog_style = $catalog_rows_mod == 1 ? 'style-2' : 'style-1';
} else {
	$catalog_style = $catalog_rows_option == 1 ? 'style-2' : 'style-1';
}
?>

<ul class="content list-unstyled shop-layout--<?php echo esc_attr( $catalog_style ); ?>" id="necromancers_products_wrap">
