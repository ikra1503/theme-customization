<?php
/**
 * The template for displaying Single Calendar
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.4.0
 */

get_header();

$id = get_the_ID();

$caption       = get_post_meta( $id, 'sp_caption', true );
$format        = get_post_meta( $id, 'sp_format', true );
$teams_default = sp_get_teams( $id );

// Calendar
$calendar   = new SP_Calendar( $id );
$data       = $calendar->data();
$usecolumns = $calendar->columns;
$status     = $calendar->status;

$event_dates = [];
foreach ( $data as $event ) {
  $event_dates[] = [
    'year' => get_the_time( 'Y', $event ),
    'month' => get_the_time( 'M', $event ),
  ];
}
$event_dates = array_unique( $event_dates, SORT_REGULAR );


// Teams Filter
if ( $teams_default ) {
  // Teams are selected in the Calendar
  $teams            = $teams_default;
  $options          = [];
  $selected_team_id = isset( $_GET['team'] ) && ! empty( $_GET['team'] ) ? $_GET['team'] : false;

  if ( $teams && is_array( $teams ) ):
    foreach ( $teams as $teamId ):
      $options[] = '<option value="' . get_post_permalink( $id ) . '?team=' . esc_attr( $teamId ) . '" ' . selected( $teamId, $selected_team_id, false ) . '>' . sp_team_name( $teamId ) . '</option>';
    endforeach;
  endif;

} else {

  // Teams are NOT selected in the Calendar
  $args_team = array(
    'post_type'      => 'sp_team',
    'numberposts'    => 500,
    'posts_per_page' => 500,
    'orderby'        => 'title',
    'order'          => 'ASC',
  );

  $teams            = get_posts( $args_team );
  $options          = [];
  $selected_team_id = isset( $_GET['team'] ) && ! empty( $_GET['team'] ) ? $_GET['team'] : false;

  if ( $teams && is_array( $teams ) ):
    foreach ( $teams as $team ):
      $options[] = '<option value="' . get_post_permalink( $id ) . '?team=' . esc_attr( $team->ID ) . '" ' . selected( $team->ID, $selected_team_id, false ) . '>' . $team->post_title . '</option>';
    endforeach;
  endif;
}
?>

<main class="site-content site-content--center page" id="wrapper">
  <div class="container container--large">
    <div class="page-heading page-heading--default">
      <?php
      // Title (caption)
      if ( $caption ) {
        echo '<div class="page-heading__subtitle h5 color-primary">' . esc_html( $caption ) . '</div>';
      }
      ?>
      <h1 class="page-heading__title h-lead-2"><?php the_title(); ?></h1>
    </div>

    <?php
    if ( $format === 'blocks' ) :
      ?>
      <ul class="matches-scores__navigation js-filter">
        <li data-filter="*" class="active"><span><?php esc_html_e( 'Show', 'necromancers' ); ?></span><?php esc_html_e( 'All', 'necromancers' ); ?></li>
        <?php
        foreach ( $event_dates as $event_date ) :
          $event_year = $event_date['year'];
          $event_month = $event_date['month'];
          $event_date_slug = sanitize_title( $event_date['year'] . $event_date['month'] );
          ?>
          <li data-filter=".js-date-<?php echo esc_attr( $event_date_slug ); ?>"><span><?php echo esc_html( $event_year ); ?></span><?php echo esc_html( $event_month ); ?></li>
          <?php
        endforeach;
        ?>
      </ul>
      <?php
    endif;
    ?>
    
    <?php
    // Don't display the filter if we have only one Team selected
    if ( is_array( $teams ) && count( $teams ) > 1 ) :
      ?>
      <div class="matches-filter">
        <label class="matches-filter__label"><?php esc_html_e( 'Team filter', 'necromancers' ); ?></label>
        <select class="cs-select js-cs-select-redirect">
          <?php
          echo '<option value="' . get_post_permalink( $id ) . '?team=all">' . esc_html__( 'All Teams', 'necromancers' ). '</option>';
          echo implode( $options );
          ?>
        </select>
      </div>
      <?php
    endif;
    ?>

    <div class="mt-sm-auto mb-sm-auto">
      <?php
      $args = [
        'id'          => $id,
        'show_title'  => false,
        'thead'       => false,
        'show_origin' => true,
      ];

      // Status
      if ( ! empty( $status) ) {
        $args['status'] = $status;
      }

      // Columns
      if ( ! empty( $usecolumns ) ) {
        $args['columns'] = $usecolumns;
      }

      // Team
      if ( $selected_team_id && $selected_team_id !== 'all' ) {
        $args['team'] = $_GET['team'];
      }

      sp_get_template( 'event-' . $format . '.php', $args );
      ?>
    </div>

  </div>
</main>

<?php
get_footer();
