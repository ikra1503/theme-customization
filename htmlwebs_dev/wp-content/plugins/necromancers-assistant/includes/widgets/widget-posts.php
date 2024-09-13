<?php
/**
 * Recent Posts
 *
 * @author    Dan Fisher
 * @package   Necromancers Assistant
 * @since     1.0.0
 * @version   1.0.2
 */


// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


/**
 * Widget class.
 */

class Necromancers_Widget_Posts extends WP_Widget {


	/**
	 * Constructor.
	 *
	 * @access public
	 */
	function __construct() {

		$widget_ops = array(
			'classname' => 'ncr-posts',
			'description' => esc_html__( 'Display your posts.', 'necromancers-assistant' ),
		);
		$control_ops = array(
			'id_base' => 'ncr-posts-widget'
		);

		parent::__construct( 'ncr-posts-widget', 'NCR - Posts', $widget_ops, $control_ops );

	}


	/**
	 * Outputs the widget content.
	 */

	function widget( $args, $instance ) {

		extract( $args );

		$title        = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$number       = isset( $instance['number'] ) ? $instance['number'] : 4;
		$orderby      = isset( $instance['orderby'] ) ? $instance['orderby'] : 'date';
		$date         = isset( $instance['date'] ) ? $instance['date'] : 'default';
		$cat          = isset( $instance['cat'] ) ? $instance['cat'] : '';
		$layout_style = isset( $instance['layout_style'] ) ? $instance['layout_style'] : 'layout-1';

		echo wp_kses_post( $before_widget );

		if ( $title ) {
			echo wp_kses_post( $before_title ) . esc_html( $title ) . wp_kses_post( $after_title );
		}

		$args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $number,
			'orderby'             => $orderby,
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
		);

		// Date
		if ( $date && 'default' != $date ) {
			$args['date_query'] = array(
				array(
					'after' => $date,
				)
			);
		}

		// Filter by Categories if set
		if ( $cat ) {
			$args['cat'] = $cat;
		}

		// Post List classes
		$posts_list_classes = array(
			'ncr-posts-list',
			'list-unstyled'
		);
		$post_thumb_size = 'thumbnail';

		if ( $layout_style === 'layout-2' ) {
			$posts_list_classes[] = 'ncr-posts-list--thumb-on-bg';
			$post_thumb_size = 'necromancers-post-thumbnail-rect-sm';
		}

		// Post Item classes
		$post_classes = array(
			'ncr-posts-list__item'
		);

		// Start the Loop
		$wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ) :
			?>

			<div class="<?php echo esc_attr( implode( ' ', $posts_list_classes ) ); ?>">
				<?php
				while ( $wp_query->have_posts() ) : $wp_query->the_post();

					include NCRASSISTANT_PLUGIN_DIR . '/includes/widgets/widget-posts/post-' . $layout_style . '.php';

				endwhile;
				wp_reset_postdata();
				?>
			</div>

			<?php
		endif;

		echo wp_kses_post( $after_widget );
	}

	/**
	 * Updates a particular instance of a widget.
	 */

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['number']       = $new_instance['number'];
		$instance['orderby']      = $new_instance['orderby'];
		$instance['date']         = $new_instance['date'];
		$instance['cat']          = $new_instance['cat'];
		$instance['layout_style'] = $new_instance['layout_style'];

		return $instance;
	}


	/**
	 * Outputs the settings update form.
	 */

	function form( $instance ) {

		$defaults = array(
			'title'        => esc_html__( 'Recent Posts', 'necromancers-assistant' ),
			'number'       => 3,
			'orderby'      => 'date',
			'date'         => 'default',
			'cat'          => esc_html__( 'All', 'necromancers-assistant' ),
			'layout_style' => 'small',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'necromancers-assistant' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of items to show:', 'necromancers-assistant' ); ?></label>
			<input class="tiny-text" type="number" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" step="1" min="1" size="3" value="<?php echo esc_attr( $instance['number'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order by:', 'necromancers-assistant' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" class="widefat" style="width:100%;">
				<option value="date" <?php echo ( 'date' == $instance['orderby'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Date', 'necromancers-assistant' ); ?></option>
				<option value="meta_value_num" <?php echo ( 'meta_value_num' == $instance['orderby'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Popularity', 'necromancers-assistant' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>"><?php esc_html_e( 'Date:', 'necromancers-assistant' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" class="widefat" style="width:100%;">
				<option value="default" <?php echo ( 'default' == $instance['date'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Default', 'necromancers-assistant' ); ?></option>
				<option value="1 week ago" <?php echo ( '1 week ago' == $instance['date'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Last 7 days', 'necromancers-assistant' ); ?></option>
				<option value="1 month ago" <?php echo ( '1 month ago' == $instance['date'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Last 30 days', 'necromancers-assistant' ); ?></option>
				<option value="3 months ago" <?php echo ( '3 months ago' == $instance['date'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Last 90 days', 'necromancers-assistant' ); ?></option>
				<option value="6 months ago" <?php echo ( '6 months ago' == $instance['date'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Last 6 months', 'necromancers-assistant' ); ?></option>
				<option value="1 year ago" <?php echo ( '1 year ago' == $instance['date'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Last 12 months', 'necromancers-assistant' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><?php esc_html_e( 'Category:', 'necromancers-assistant' ); ?></label>
			<?php wp_dropdown_categories( array(
				'show_option_all'    => esc_attr__( 'All', 'necromancers-assistant' ),
				'orderby'            => 'ID',
				'order'              => 'ASC',
				'show_count'         => 0,
				'hide_empty'         => 0,
				'hide_if_empty'      => false,
				'echo'               => 1,
				'selected'           => $instance['cat'],
				'hierarchical'       => 1,
				'name'               => $this->get_field_name( 'cat' ),
				'id'                 => $this->get_field_id( 'cat' ),
				'class'              => 'widefat',
				'taxonomy'           => 'category',
			) ); ?>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout_style' ) ); ?>"><?php esc_html_e( 'Layout:', 'necromancers-assistant' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'layout_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout_style' ) ); ?>" class="widefat" style="width:100%;">
				<option value="layout-1" <?php echo ( 'layout-1' == $instance['layout_style'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Thumbs', 'necromancers-assistant' ); ?></option>
				<option value="layout-2" <?php echo ( 'layout-2' == $instance['layout_style'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Blocks', 'necromancers-assistant' ); ?></option>
			</select>
		</p>

		<?php

	}
}


// Register and load the widget
function ncr_load_widget_posts() {
	register_widget( 'Necromancers_Widget_Posts' );
}
add_action( 'widgets_init', 'ncr_load_widget_posts' );
