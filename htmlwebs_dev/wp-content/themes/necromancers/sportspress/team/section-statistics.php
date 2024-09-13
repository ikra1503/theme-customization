<?php
/**
 * Team: Statistics
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

extract( $args['defaults'], EXTR_SKIP );

$team_id    = $args['team_id'];
$team       = $args['team'];

// League Tables
$tables = $team->tables();
// get the latest selected table
$last_table = end( $tables );
if ( ! isset( $last_table->ID ) ) {
  // if no League Tables selected, all data is used
  $table = new SP_League_Table( null );
} else {
  $table = new SP_League_Table( $last_table->ID );
}

// Jump into League Table data
$data = $table->data();

// Remove the first row to leave us with the actual data
unset( $data[0] );

// Stats
$stats = get_theme_mod( 'necromancers_sp_team_statistics_items', [] );
$stats_output = [];

if ( $stats ) {
  foreach ( $stats as $stat ) {
    $stat_name = $stat['stat_post'];

    // get SP Column post by 'post_name'
    if ( $stat_post = get_page_by_path( $stat_name, OBJECT, 'sp_column' ) ) {
      $stat_id = $stat_post->ID;
    } else {
      $stat_id = 0;
    }

    if ( 'empty' === $stat_id ) {
      continue; // skip if placebo
    };

    $stats_output[ $stat_name ] = [
      'key'             => $stat_name,
      'type'            => get_post_field( 'sp_type', $stat_id ),
      'title'           => get_post_field( 'post_title', $stat_id ),
      'custom_title'    => $stat['stat_title'],
      'custom_subtitle' => $stat['stat_subtitle'],
      'value'           => $data[ $team_id ][ $stat_name ],
      'is_percent'      => $stat['stat_is_percentage'],
    ];
  }
}
?>

<div class="swiper-slide team-carousel__item" data-icon="stats" data-hash="stats">
  <div class="row">
    <div class="col-lg-11">
      <h3 class="player-info-subtitle h4 text-uppercase"><?php echo esc_html( $team->post->post_title ); ?></h3>
      <h2 class="player-info-title h-lead-1 text-uppercase"><?php echo get_theme_mod( 'necromancers_sp_team_statistics_title', esc_html__( 'Statistics', 'necromancers' ) ); ?></h2>

      <div class="row row-mb-balance">
        <?php
        foreach ( $stats_output as $key => $stat ) :
          $value    = $stat['value'];
          $title    = isset( $stat['custom_title'] ) && ! empty( $stat['custom_title'] ) ? $stat['custom_title'] : $stat['title'];
          $subtitle = isset( $stat['custom_subtitle'] ) && ! empty( $stat['custom_subtitle'] ) ? $stat['custom_subtitle'] : esc_html__( 'Overall', 'necromancers' );

          if ( $stat['is_percent'] ) :
            ?>
            <div class="col-6 col-md-4 col-lg-6 col-xl-4">
              <div class="player-info-detail player-info-detail--bar">
                <div class="player-info-detail__bar" data-value="<?php echo esc_attr( $value ); ?>" data-id="progress-path-<?php echo esc_attr( $key ); ?>">
                  <svg width="61" height="61" viewBox="0 0 61 61">
                    <path fill-opacity="0" stroke-width="6" d="M3.008,29.000 L29.009,3.009 L55.009,29.000 L29.009,54.991 L3.008,29.000 Z"/>
                    <path fill-opacity="0" id="progress-path-<?php echo esc_attr( $key ); ?>" stroke-width="6" stroke-linecap="square" d="M3.008,29.000 L29.009,3.009 L55.009,29.000 L29.009,54.991 L3.008,29.000 Z"/>
                  </svg>
                  <i class="fa fa-star">&nbsp;</i>
                </div>
                <div class="player-info-detail__body">
                  <div class="player-info-detail__label"><?php echo esc_html( $title ); ?></div>
                  <div class="player-info-detail__title"><?php echo esc_html( $value ); ?>%</div>
                </div>
              </div>
            </div>
            <?php
          else :
            ?>
            <div class="col-6 col-md-4 col-lg-6 col-xl-4">
              <div class="player-info-detail player-info-detail--value">
                <div class="player-info-detail__value h3"><?php echo esc_html( necromancers_format_big_number( $value ) ); ?></div>
                <div class="player-info-detail__body">
                  <div class="player-info-detail__label"><?php echo esc_html( $subtitle ); ?></div>
                  <div class="player-info-detail__title"><?php echo esc_html( $title ); ?></div>
                </div>
              </div>
            </div>
            <?php
          endif;
        endforeach;
        ?>
      </div>
    </div>
  </div>
</div>
