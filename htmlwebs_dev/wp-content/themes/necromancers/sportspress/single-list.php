<?php
/**
 * The template for displaying Single Player  List
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.3.2
 * @version   1.3.2
 */

get_header();

$id = get_the_ID();

$defaults = array(
  'show_title' => get_option( 'sportspress_list_show_title', 'yes' ) == 'yes' ? true : false,
);

extract( $defaults, EXTR_SKIP );

// Layout
$layout = get_post_meta( $id, 'sp_format', 'list' );
?>

<!-- Content
================================================== -->
<main class="site-content site-content--center page" id="wrapper">
  <div class="container container--large">
    <div class="page-heading page-heading--default">
      <?php
      // Title (caption)
      if ( $show_title ) {
        $caption = get_post_meta( $id, 'sp_caption', true );
        if ( $caption ) {
          echo '<div class="page-heading__subtitle h5 color-primary">' . esc_html( $caption ) . '</div>';
        }
      }
      ?>
      <h1 class="page-heading__title h-lead-2"><?php the_title(); ?></h1>
    </div>

    <div class="mt-sm-auto mb-sm-auto">
      <?php
      sp_get_template(
        "player-{$layout}.php",
        [
          'show_title'   => false,
          'custom_class' => 'ncr-player-list-table'
        ] );
      ?>
    </div>

  </div>
</main>

<?php
get_footer();
