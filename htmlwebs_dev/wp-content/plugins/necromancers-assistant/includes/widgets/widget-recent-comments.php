<?php
/**
 * Recent Comments
 *
 * @author    Dan Fisher
 * @package   Necromancers Assistant
 * @since     1.0.0
 * @version   1.0.0
 */


// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
  exit( 'Direct script access denied.' );
}


/**
 * Widget class.
 */

class Necromancers_Widget_Recent_Comments extends WP_Widget {


  /**
   * Constructor.
   *
   * @access public
   */
  function __construct() {

    $widget_ops = array(
      'classname' => 'ncr-comments',
      'description' => esc_html__( 'A widget to show the most recent comments.', 'necromancers-assistant' ),
    );
    $control_ops = array(
      'id_base' => 'ncr-comments-widget'
    );

    parent::__construct( 'ncr-comments-widget', 'NCR - Recent Comments', $widget_ops, $control_ops );

  }


  /**
   * Outputs the widget content.
   */

  function widget( $args, $instance ) {

    extract( $args );

    $title        = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
    $comments_num = isset( $instance['comments_num'] ) ? $instance['comments_num'] : 3;
    $excerpt      = isset( $instance['excerpt'] ) ? $instance['excerpt'] : 20;

    echo wp_kses_post( $before_widget );

    if ( $title ) {
      echo wp_kses_post( $before_title ) . esc_html( $title ) . wp_kses_post( $after_title );
    }

    $comments_query = new WP_Comment_Query();
    $comments = $comments_query->query( array(
      'number'    => $comments_num,
      'status'    => 'approve',
      'type'      => 'comment',
      'post_type' => 'post',
    ));

    $comments_list_classes = array(
      'ncr-comments-list',
      'list-unstyled'
    );
    ?>
    <ul class="<?php echo esc_attr( implode( ' ', $comments_list_classes ) ); ?>">

      <?php
      if ( $comments ) :
        foreach ( $comments as $comment ) :
        ?>
        <li class="ncr-comments-list__item media ncr-comment">
          <figure class="ncr-comment__avatar">
            <?php echo get_avatar( $comment->comment_author_email, 60 ) ?>
          </figure>
          <div class="ncr-comment__body media-body">
            <div class="ncr-comment__header">
              <h5 class="ncr-comment__title"><?php echo get_comment_author( $comment->comment_ID ); ?></h5>
              <h6 class="ncr-comment__subtitle"><a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>#comment-<?php echo esc_attr( $comment->comment_ID ); ?>"><?php echo get_the_title( $comment->comment_post_ID ); ?></a></h6>
            </div>
            <div class="ncr-comment__content">
              <?php echo strip_tags( necromancers_string_limit_words( apply_filters( 'get_comment_text', $comment->comment_content ), $excerpt) ); ?>
            </div>
            <div class="ncr-comment__footer">
              <time class="ncr-comment__date" datetime="<?php echo esc_attr( $comment->comment_date ); ?>">
                <?php
                printf(
                  _x( '%s ago', '%s = human-readable time difference', 'necromancers-assistant' ),
                  human_time_diff(
                    get_comment_date( 'U', $comment->comment_ID ),
                    current_time( 'timestamp' )
                  )
                );
                ?>
              </time>
            </div>
          </div>
        </li>
        <?php
        endforeach;
      else :
        ?>

        <li class="ncr-comments-list__item media ncr-comment">
          <div class="ncr-comment__body media-body">
            <div class="ncr-comment__content">
              <?php esc_html_e( 'No comments.', 'necromancers-assistant' ); ?>
            </div>
          </div>
        </li>

        <?php
      endif;
      ?>

    </ul>

    <?php
    echo wp_kses_post( $after_widget );
  }

  /**
   * Updates a particular instance of a widget.
   */

  function update($new_instance, $old_instance) {

    $instance = $old_instance;

    $instance['title']        = strip_tags( $new_instance['title'] );
    $instance['comments_num'] = $new_instance['comments_num'];
    $instance['excerpt']      = $new_instance['excerpt'];

    return $instance;
  }


  /**
   * Outputs the settings update form.
   */

  function form( $instance ) {

    $defaults = array(
      'title'        => '',
      'comments_num' => 3,
      'excerpt'      => 20,
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'necromancers-assistant' ); ?></label>
      <input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'comments_num' ) ); ?>"><?php esc_html_e( 'Number of comments:', 'necromancers-assistant' ); ?></label>
      <input class="tiny-text" type="number" id="<?php echo esc_attr( $this->get_field_id( 'comments_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comments_num' ) ); ?>" step="1" min="1" size="3" value="<?php echo esc_attr( $instance['comments_num'] ); ?>" />
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>"><?php esc_html_e( 'Comment size (number of words):', 'necromancers-assistant' ); ?></label>
      <input class="tiny-text" type="number" id="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt' ) ); ?>" step="1" min="1" size="3" value="<?php echo esc_attr( $instance['excerpt'] ); ?>" />
    </p>


    <?php

  }
}

// Register and load the widget
function ncr_load_widget_recent_comments() {
  register_widget( 'Necromancers_Widget_Recent_Comments' );
}
add_action( 'widgets_init', 'ncr_load_widget_recent_comments' );
