<?php
/**
 * Player: Statistics
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.2.0
 */

extract( $args['defaults'], EXTR_SKIP );

$player_id = $args['player_id'];
$player = $args['player'];
$data = $player->data(0);

// // remove labels
unset( $data[0] );

// Display stats for current season or total
if ( ! empty( $current_season ) && ! $show_total ) {
  if ( isset( $data[ $current_season ] ) ) {
    $data = $data[ $current_season ];
  }
} else {
  if ( isset( $data[-1] )) {
    $data = $data[-1];
  }
}

// Stats
$stats = get_theme_mod( 'necromancers_sp_player_statistics_items', [] );
$stats_output = [];

if ( $stats ) {
  foreach ( $stats as $stat ) {
    $stat_name = $stat['stat_post'];

    // get Statistics post by 'post_name'
    if ( $stat_post = get_page_by_path( $stat_name, OBJECT, 'sp_statistic' ) ) {
      $stat_id = $stat_post->ID;
    } else {
      $stat_id = 0;
    }

    if ( 'empty' === $stat_id ) {
      continue; // skip if placebo
    };

    $stats_output[ $stat_name ] = [
      'type'            => get_post_field( 'sp_type', $stat_id ),
      'title'           => get_post_field( 'post_title', $stat_id ),
      'custom_title'    => $stat['stat_title'],
      'custom_subtitle' => $stat['stat_subtitle'],
      'value'           => isset( $data[ $stat_name ] ) ? $data[ $stat_name ] : '-',
      'is_percent'      => $stat['stat_is_percentage'],
    ];
  }
}
?>

<div class="swiper-slide team-carousel__item" data-icon="stats" data-hash="stats">
  <div class="row">
    <div class="col-lg-12 col-xl-6">
      <h3 class="player-info-subtitle h5"><?php echo esc_html( $args['player']->post->post_title ); ?></h3>
      <h2 class="player-info-title h-lead-2 text-uppercase"><?php echo get_theme_mod( 'necromancers_sp_player_statistics_title', esc_html__( 'Statistics', 'necromancers' ) ); ?></h2>

      <div class="row">
        <?php
        foreach ( $stats_output as $stat ) :
          $value    = $stat['value'];
          $title    = isset( $stat['custom_title'] ) && ! empty( $stat['custom_title'] ) ? $stat['custom_title'] : $stat['title'];
          $subtitle = isset( $stat['custom_subtitle'] ) && ! empty( $stat['custom_subtitle'] ) ? $stat['custom_subtitle'] : esc_html__( 'Average', 'necromancers' );

          if ( $stat['is_percent'] ) :
            ?>
            <div class="col-6 col-md-4 col-lg-6 col-xl-4">
              <div class="player-info-detail player-info-detail--bar">
                <div class="player-info-detail__bar" data-value="<?php echo esc_attr( $value ); ?>" data-id="progress-path-1">
                  <svg width="61" height="61" viewBox="0 0 61 61">
                    <path fill-opacity="0" stroke-width="6" d="M3.008,29.000 L29.009,3.009 L55.009,29.000 L29.009,54.991 L3.008,29.000 Z"/>
                    <path fill-opacity="0" id="progress-path-1" stroke-width="6" stroke-linecap="square" d="M3.008,29.000 L29.009,3.009 L55.009,29.000 L29.009,54.991 L3.008,29.000 Z"/>
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
                <div class="player-info-detail__value h3"><?php echo esc_html( necromancers_format_big_number( $value, 1, false, false ) ); ?></div>
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

      <?php
      // Character (Position)
      if ( $show_positions ) :
        $positions = $player->positions();
        $position_names = [];

        // set data array to represent the character
        if ( $positions && is_array( $positions ) ) {
          foreach ( $positions as $position ) {
            $term_id = $position->term_id;
            $position_names[ $term_id ] = [
              'name'  => $position->name,
              'role'  => get_field( 'ncr_character_role', 'term_' . $term_id ),
              'image' => get_field( 'ncr_character_image', 'term_' . $term_id ),
              'icon'  => get_field( 'ncr_character_icon', 'term_' . $term_id )
            ];
          }
        }

        // Role
        ?>
        <div class="player-info-page__statistics-footer">

          <?php
          if ( $position_names && is_array( $position_names ) ) :
            foreach ( $position_names as $position_id => $value ) :
              $name  = $value['name'];
              $image = $value['image'];
              $role  = $value['role'];
              $icon  = $value['icon'];
              ?>
              <div class="player-info-detail player-info-detail--hero">
                <?php
                // Character Image
                if ( $image ) :
                  ?>
                  <div class="player-info-detail__hero ncr-character-id-<?php echo esc_attr( $position_id ); ?>">
                    <?php echo wp_get_attachment_image( $image, 'necromancers-sp-fit-icon-sm' ); ?>
                  </div>
                  <?php
                endif;
                ?>
                <div class="player-info-detail__body">
                  <div class="player-info-detail__title"><?php echo esc_html( $name ); ?></div>
                  <div class="player-info-detail__label"><?php esc_html_e( 'Most Played Hero', 'necromancers' ); ?></div>
                </div>
              </div>
              <div class="player-info-detail ml-sm-auto text-sm-right clearfix">
                <div class="player-info-detail__title"><?php echo esc_html( $role ); ?></div>
                <div class="player-info-detail__label"><?php esc_html_e( 'Hero Role', 'necromancers' ); ?></div>
              </div>
              <div class="player-info-detail text-right">
                <div class="player-info-detail__title">
                  <svg role="img" class="df-icon df-icon--<?php echo esc_attr( $icon ); ?>">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#<?php echo esc_attr( $icon ); ?>"/>
                  </svg>
                </div>
                <div class="player-info-detail__label"><?php esc_html_e( 'Hero Icon', 'necromancers' ); ?></div>
              </div>
              <?php
            endforeach;
          endif;
          ?>
          
        </div>
        <?php
      endif;
      ?>
      
    </div>
  </div>
</div>
