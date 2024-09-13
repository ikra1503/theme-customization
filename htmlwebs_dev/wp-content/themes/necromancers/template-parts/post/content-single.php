<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.3.0
 */

$post_layout    = get_theme_mod( 'necromancers_blog_post_layout', 'default' );
$post_classess  = 'post';
$post_classess .= 'thumb_left' === $post_layout ? ' post--single-side-thumbnail' : ' post--single';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classess ); ?>>

  <?php
  // Featured Thumbnail
  if ( 'thumb_left' === $post_layout ) {
    necromancers_post_thumbnail();
  }
  ?>

  <?php
  if ( get_theme_mod( 'necromancers_blog_post_sharing', false ) ) :
    $post_sharing_position = get_theme_mod( 'necromancers_blog_post_sharing_position', 'default' );
    ?>
    <ul class="post__sharing post__sharing--<?php echo esc_attr( $post_sharing_position ); ?>">
      <li class="post__sharing-item post__sharing-item--menu"><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><i>&nbsp;</i></a></li>
      <?php
      if ( function_exists( 'ncr_assistant_social_share' ) ) {
        ncr_assistant_social_share();
      }
      ?>
      <li class="post__sharing-item post__sharing-item--comments">
        <a href="#comments">
          <span><?php echo get_comments_number( ); ?></span>
          <svg role="img" class="df-icon df-icon--comments-small">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#comments-small"/>
          </svg>
        </a>
      </li>
    </ul>
    <?php
  endif;
  ?>

  <div class="post__header">
    <?php necromancers_entry_meta( 'h5' ); ?>
    <?php
    if ( is_singular() ) :
      the_title( '<h1 class="post__title">', '</h1>' );
    else :
      the_title( '<h2 class="post__title h1"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;

    if ( 'post' === get_post_type() ) :
      ?>
      <div class="post__meta">
        <?php
        // Post Date
        necromancers_posted_on();

        // Post Author
        if ( get_theme_mod( 'necromancers_blog_post_meta_author', false ) ) {
          necromancers_posted_by();
        }
        ?>
      </div><!-- .entry-meta -->
      <?php
    endif;
    ?>
  </div>

  <?php
  // Featured Thumbnail
  if ( 'default' === $post_layout ) {
    necromancers_post_thumbnail( 'alignwide' );
  }
  ?>

  <div class="post__body">
    <?php
    the_content();

    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'necromancers' ),
        'after'  => '</div>',
      )
    );
    ?>
  </div>

  <div class="post__footer"><?php necromancers_entry_tags(); ?></div>

  <?php
  if ( get_theme_mod( 'necromancers_blog_post_author', false ) ) :
    ?>
    <!-- Post Author -->
    <div class="post__author">
      <figure class="post__author-avatar">
        <?php echo get_avatar( get_the_author_meta('email'), '60' ); ?>
      </figure>
      <div class="post__author-info">
        <h5 class="post__author-name"><?php the_author(); ?></h5>
        <span class="post__author-description"><?php echo get_the_author_meta( 'user_description' ); ?></span>
      </div>
    </div>
    <!-- Post Author / End -->
    <?php
  endif;
  ?>
</article><!-- #post-<?php the_ID(); ?> -->
