<?php
/**
 * The template for displaying Single League Table
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

get_header();

$id = get_the_ID();

$defaults = array(
  'show_title' => get_option( 'sportspress_table_show_title', 'yes' ) == 'yes' ? true : false,
);

extract( $defaults, EXTR_SKIP );

$args = array(
  'post_type' => 'sp_table',
  'numberposts' => 500,
  'posts_per_page' => 500,
  'orderby' => 'title',
  'order' => 'ASC',
);

$tables = get_posts( $args );

$options = array();

if ( $tables && is_array( $tables ) ):
  foreach ( $tables as $table ):
    $options[] = '<option value="' . get_post_permalink( $table->ID ) . '" ' . selected( $table->ID, $id, false ) . '>' . $table->post_title . '</option>';
  endforeach;
endif;
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

    <?php
    if ( sizeof( $options ) > 1 ):
      ?>
      <div class="matches-filter">
        <label class="matches-filter__label"><?php esc_html_e( 'Competition filter', 'necromancers' ); ?></label>
        <select class="cs-select js-cs-select-redirect">
          <?php echo implode( $options ); ?>
        </select>
      </div>
      <?php
    endif;
    ?>

    <div class="mt-sm-auto mb-sm-auto">
      <?php
      sp_get_template(
        'league-table.php',
        [
          'show_title' => false,
        ] );
      ?>
    </div>

  </div>
</main>

<?php
get_footer();
