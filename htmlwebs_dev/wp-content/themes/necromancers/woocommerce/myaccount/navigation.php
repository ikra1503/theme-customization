<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );

// Current User
$current_user    = wp_get_current_user();
$current_user_id = $current_user->ID;

// Comments
$comments_args = [
	'user_id'   => $current_user_id,
	'count'     => true,
	'post_type' => 'post',
	'post_status' => 'publish',
];
$comments_count = get_comments( $comments_args );

// Reviews
$reviews_args = [
	'user_id'     => $current_user_id,
	'count'       => true,
	'post_type'   => 'product',
	'post_status' => 'publish',
	'status'      => 'approve',
];
$reviews_count = get_comments( $reviews_args );

// Number of order
$orders_number = wc_get_customer_order_count( $current_user_id );
?>

<nav class="account-navigation">
	<div class="account-navigation__header">
		<a class="account-navigation__logout" href="<?php echo esc_url( wc_logout_url() ); ?>">
			<svg role="img" class="df-icon df-icon--logout-circle">
				<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#logout-circle" />
			</svg>
			<svg role="img" class="df-icon df-icon--logout-arrow">
				<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#logout-arrow" />
			</svg>
		</a>
		<span class="account-navigation__avatar">
			<?php echo get_avatar( $current_user->ID, 80 ); ?>
		</span>
		<div class="account-navigation__subtitle"><?php esc_html_e( 'Welcome back!', 'necromancers' ); ?></div>
		<?php
		// User Name
		if ( $current_user ) :
			?>
			<div class="account-navigation__name h4"><?php echo esc_html( $current_user->display_name ); ?></div>
			<?php
		endif;
		?>
		<ul class="account-navigation__meta">
			<li><?php echo esc_html( $comments_count ); ?><span><?php esc_html_e( 'comments', 'necromancers' ); ?></span></li>
			<li><?php echo esc_html( $reviews_count ); ?><span><?php esc_html_e( 'reviews', 'necromancers' ); ?></span></li>
			<li><?php echo esc_html( $orders_number ); ?><span><?php esc_html_e( 'orders', 'necromancers' ); ?></span></li>
		</ul>
	</div>
	<ul class="account-navigation__menu">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
