<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
  return;
}
?>

<div id="comments" class="post-comments">

  <?php
  // You can start editing here -- including this comment!
  if ( have_comments() ) :
    ?>
    <h4 class="post-comments__title h2">
      <?php
      $necromancers_comment_count = get_comments_number();
      printf(
        /* translators: 1: comment count number. */
        esc_html( _nx( 'Comment (%1$s)', 'Comments (%1$s)', $necromancers_comment_count, 'comments title', 'necromancers' ) ),
        number_format_i18n( $necromancers_comment_count ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      );
      ?>
    </h4><!-- .comments-title -->

    <?php the_comments_navigation(); ?>

    <ol class="comments">
      <?php wp_list_comments('type=all&callback=necromancers_comments'); ?>
    </ol><!-- .comment-list -->

    <?php
    the_comments_navigation();

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() ) :
      ?>
      <p class="alert alert-warning no-comments mt-5"><?php esc_html_e( 'Comments are closed.', 'necromancers' ); ?></p>
      <?php
    endif;

  endif; // Check for have_comments().
  ?>

  <!-- Comment Form -->
  <div class="post-comments-form">
    <?php
    $commenter = wp_get_current_commenter();
    $req       = get_option( 'require_name_email' );
    $aria_req  = ( $req ? " aria-required=true" : '' );
    $consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

    $comments_args = array(
      'id_form'              => 'commentform',
      'id_submit'            => 'submit',
      'class_form'           => 'comment-form',
      'class_submit'         => 'btn btn-secondary',
      'title_reply_before'   => '<h4 class="post-comments-form__title h2">',
      'title_reply_after'    => '</h4>',
      'title_reply'          => esc_html__( 'Leave a Reply', 'necromancers' ),
      'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'necromancers' ),
      'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'necromancers' ),
      'label_submit'         => esc_html__( 'Post Comment', 'necromancers' ),

      'comment_notes_before' => '',
      'comment_notes_after'  => '',
      'must_log_in'          => '<div class="alert alert-warning">' . sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'necromancers' ), array('a' => array( 'href' => array() ))), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</div>',

      'fields' => apply_filters( 'comment_form_default_fields', array(

        'author' =>
          '<div class="row">' .
          '<div class="col-md-6">' .
          '<div class="comment-form-author form-group">' .
          '<input id="author" name="author" type="text" class="form-control" placeholder="' . esc_attr__( 'Your Name', 'necromancers' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
          '" size="30"' . esc_attr( $aria_req ) . ' />' .
          '</div>' .
          '</div>',

        'email' =>
          '<div class="col-md-6">' .
          '<div class="comment-form-email form-group">' .
          '<input id="email" name="email" type="email" class="form-control" placeholder="' . esc_attr__( 'Your Email', 'necromancers' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
          '" size="30"' . esc_attr( $aria_req ) . ' />' .
          '</div>' .
          '</div>' .
          '</div>',

          'cookies' =>
            '<p class="comment-form-cookies-consent">' .
            '<label class="checkbox checkbox-inline" for="wp-comment-cookies-consent">' .
              '<input type="checkbox" name="wp-comment-cookies-consent" type="checkbox" id="wp-comment-cookies-consent" class="checkbox-input" value="yes"' . $consent . '>' .
              esc_html__( 'Save my name and email in this browser for the next time I comment.', 'necromancers' ) .
              '<span class="checkbox-label"></span>' .
            '</label>' .
            '</p>',
        )
      ),
      'comment_field' =>
        '<div class="comment-form-message form-group">' .
        '<textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Your Comment', 'necromancers' ) . '" cols="30" rows="5" class="form-control" aria-required="true"></textarea>' .
        '</div>',
    );

    // Comment Form output
    comment_form( $comments_args );
    ?>
  </div>
  <!-- Comment Form / End -->

</div><!-- #comments -->
