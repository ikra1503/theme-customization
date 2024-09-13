<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.3.0
 */

if ( ! function_exists( 'necromancers_posted_on' ) ) :
  /**
   * Prints HTML with meta information for the current post-date/time.
   */
  function necromancers_posted_on() {
    echo '<span class="post__meta-item post__meta-item--date posted-on"><time class="entry-date published" datetime="'. get_the_date('c') . '">'. get_the_date() . '</time></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  }
endif;

if ( ! function_exists( 'necromancers_posted_by' ) ) :
  /**
   * Prints HTML with meta information for the current author.
   */
  function necromancers_posted_by() {
    $byline = sprintf(
      /* translators: %s: post author. */
      esc_html_x( 'by %s', 'post author', 'necromancers' ),
      '<span class="author vcard">' . esc_html( get_the_author() ) . '</span>'
    );

    echo '<span class="post__meta-item post__meta-item--author"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

  }
endif;


if ( ! function_exists( 'necromancers_entry_meta' ) ) :
  /**
   * Prints HTML with meta information for the categories and comments.
   */
  function necromancers_entry_meta( $custom_class = '' ) {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {

      // Get Post Catgorries
      $terms = get_the_terms( get_the_ID(), 'category' );

      $output = '<ul class="post__cats list-unstyled ' . esc_attr( $custom_class ) . '">';
      foreach ( $terms as $term ) {
        $output .= '<li class="post__cats-item">';
          $output .= '<a href="' . esc_url( get_term_link( $term->term_id ) ) . '" class="category-' . $term->slug . '">' . $term->name . '</a>';
        $output .= '</li>';
      }
      $output .= '</ul>';

      echo wp_kses_post( $output );
    }
  }
endif;


if ( ! function_exists( 'necromancers_entry_tags' ) ) :
  /**
   * Prints HTML with meta information for the tags.
   */
  function necromancers_entry_tags( $class = '' ) {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {

      /* translators: used between list items, there is a space after the comma */
      $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'necromancers' ) );
      if ( $tags_list ) {
        /* translators: 1: list of tags. */
        echo '<span class="tags-links ' . esc_attr( $class ) . '">' . $tags_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      }
    }
  }
endif;

if ( ! function_exists( 'necromancers_post_thumbnail' ) ) :
  /**
   * Displays an optional post thumbnail.
   *
   * Wraps the post thumbnail in an anchor element on index views, or a div
   * element when on single views.
   */
  function necromancers_post_thumbnail( $class = '' ) {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
      return;
    }

    if ( is_singular() ) :
      ?>

      <figure class="post__thumbnail <?php echo esc_attr( $class ); ?>">
        <?php
        // Lazy-loading attributes should be skipped for thumbnails since they are immediately in the viewport.
        the_post_thumbnail( 'necromancers-single-post-thumbnail', array( 'loading' => false ) );
        if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) :
          ?>
          <figcaption class="post__thumbnail-caption"><?php echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figcaption>
          <?php
        endif;
        ?>
      </figure><!-- .post__thumbnail -->

      <?php
    else :
      ?>
      <figure class="post__thumbnail <?php echo esc_attr( $class ); ?>">
        <a class="post__thumbnail-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
          <?php
          the_post_thumbnail(
            'necromancers-post-thumbnail-rect-xl',
            array(
              'alt' => the_title_attribute(
                array(
                  'echo' => false,
                )
              ),
            )
          );
          ?>
        </a>
      </figure><!-- .post__thumbnail -->

      <?php
    endif; // End is_singular().
  }
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
  /**
   * Shim for sites older than 5.2.
   *
   * @link https://core.trac.wordpress.org/ticket/12563
   */
  function wp_body_open() {
    do_action( 'wp_body_open' );
  }
endif;



if ( ! function_exists( 'necromancers_comments' ) ) {
  /**
   * Return Custom Comments markup
   */
  function necromancers_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract( $args, EXTR_SKIP );

    $post = get_post();

    $avatar_classes = array(
      'comment__avatar'
    );
    $avatar_size = 60;

    $comment_type = $comment->comment_type;
    ?>

    <li id="comment-<?php comment_ID() ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent'); ?>>
      <?php if ( $args['avatar_size'] != 0 && 'comment' === $comment_type ) : ?>
        <figure class="<?php echo esc_attr( implode(' ', $avatar_classes ) ); ?>">
          <?php echo get_avatar( $comment, $avatar_size ); ?>
        </figure>
      <?php endif; ?>
      <div class="comment__body">
        <h6 class="comment__author">
          <?php
          // Author
          comment_author();

          // Add 'Author' label
          if ( $comment->user_id === $post->post_author ) {
            echo '<span class="badge badge-primary comment__author-badge">' . esc_html__( 'Author', 'necromancers' ) . '</span>';
          }
          ?>
        </h6>
        <?php comment_text() ?>
        <div class="comment__meta">
          <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment__date">
            <?php printf( __('%1$s', 'necromancers'), get_comment_date()) ?>
          </a>
          <?php edit_comment_link( esc_html__( '(Edit)', 'necromancers' ),'  ','' ); ?>
          <div class="comment__reply">
            <?php comment_reply_link(array_merge( $args, array(
              'add_below'   => 'comment',
              'depth'       => $depth,
              'reply_text'  => esc_html__( 'Reply', 'necromancers' ),
              'max_depth'   => $args['max_depth']
            ))) ?>
          </div>
        </div>
      </div>

      <?php if ( $comment->comment_approved == '0' ) : ?>
        <div class="comment-awaiting-moderation alert alert-warning">
          <?php esc_html_e( 'Your comment is awaiting moderation.', 'necromancers' ) ?>
        </div>
      <?php endif; ?>
    <?php
    // </li> is not needed here, because it's added automatically by WordPress
  }
}



if ( ! function_exists('necromancers_posts_navigation') ) {
  /**
   * Return HTML for blog pagination
   */
  function necromancers_posts_navigation( $pages = '', $range = 2) {
    $showitems = ( $range * 2 ) + 1;

    global $paged;
    if ( empty( $paged ) ) {
      $paged = 1;
    }

    if ( $pages == '' ) {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if ( ! $pages ) {
        $pages = 1;
      }
    }

    if ( 1 != $pages ) {
      echo '<nav class="navigation pagination">';
        echo '<h2 class="screen-reader-text">' . esc_html__( 'Navigation', 'necromancers' ) . '</h2>';
        echo '<div class="nav-links">';
          if ( $paged > 1 ) {
            echo '<a href="' . get_pagenum_link( $paged - 1 ) . '" class="prev page-numbers"><span><i class="fa fa-chevron-left"></i></span></a>';
          }
          for ( $i = 1; $i <= $pages; $i++ ) {
            if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range-1) || $pages <= $showitems ) ) {
              if ( $paged == $i ) {
                echo '<span aria-current="page" class="page-numbers current">' . $i . '</span>';
              } else {
                echo '<a href="' . get_pagenum_link( $i ) . '" class="page-numbers">' . $i . '</a>';
              }
            }
          }
          if ( $paged < $pages ) {
            echo '<a href="' . get_pagenum_link( $paged + 1 ) . '" class="next page-numbers"><span><i class="fa fa-chevron-right"></i></span></a>';
          }
        echo '</div>';
      echo '</nav>';
    }
  }
}
