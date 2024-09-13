<?php 
	
	wp_enqueue_script( array( 'waypoints', 'counterup' ) );
	$counters = $settings->get( 'stat_count_list' );
	$style    = $settings->get( 'stat_couter_style' );
	$col      = ( $style != '1' ) ? 'col-md-4' : 'col-sm-12';

?>

<div class="stat-counter">
	<div class="row">
		<?php foreach( $counters as $count ) : ?>
		<div class="<?php echo $col ?>">
			<div class="stat-item">
				<i class="<?php echo $count['icon']['value'] ?>"></i>
				<div class="stat-count">
					<?php echo $count['symbol'] ?>
					<span class="counter"><?php echo $count['number'] ?></span>
				</div>
				<h2><?php echo esc_html__( $count['title'], 'lifeline-donation-pro' ) ?></h2>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>

<?php 

	$script = "jQuery(document).ready(function ($) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });";

    wp_add_inline_script( 'counterup', $script );

?>