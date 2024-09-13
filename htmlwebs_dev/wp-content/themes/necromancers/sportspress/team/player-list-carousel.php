<?php
/**
 * Player List Carousel for Single Team
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$team = $args['team'];
?>

<div class="team-player team-player--slider-wrapper">
  <div class="team-player__slider js-team-player__slider">

    <?php
    // Player List
    $lists = $team->lists();
    $last_list = end( $lists ); // get the latest selected table
    $last_list_id = $last_list->ID;

    $list_data = sp_get_list( $last_list_id );
    // Remove the first row and 'head' row to leave us with the actual data
    unset( $list_data[0] );

    // Players
    $i = 0;
    foreach ( $list_data as $player_id => $player ) :

      // Color
      $player_color = get_field( 'ncr_player_color', $player_id ) ? get_field( 'ncr_player_color', $player_id ) : 'default';

      // Metrics
      $metrics = (array) get_post_meta( $player_id, 'sp_metrics', true );
      $fname = isset( $metrics['fname'] ) ? $metrics['fname'] : '';
      $lname = isset( $metrics['lname'] ) ? $metrics['lname'] : '';
      ?>

      <div class="team-player__slide team-player__slide--color-<?php echo esc_attr( $player_color ); ?>">
        <div class="team-player__slide-inner">
          <div class="team-player__slide-decor">
            <div class="team-player__slide-line-1"></div>
            <div class="team-player__slide-line-2"></div>
          </div>
          <?php
          if ( has_post_thumbnail( $player_id ) ) :
            $thumb_id = get_post_thumbnail_id( $player_id );
            $thumb_url = wp_get_attachment_image_src( $thumb_id, 'necromancers-sp-fit-lg', true );
            $post_thumb = $thumb_url[0];

            echo '<img src="' . esc_url( $thumb_url[0] ) . '" class="team-player__slide-img" alt="' . esc_attr( $fname . ' ' . $lname ) . '"/>';
          endif;
          ?>
          <div class="team-player__slide-meta-holder">
            <div class="team-player__slide-meta">
              <h4 class="team-player__slide-subtitle h6 color-primary"><?php echo esc_html( $fname . ' ' . $lname ); ?></h4>
              <h3 class="team-player__slide-title"><?php echo sp_get_player_name( $player_id ); ?></h3>
              <a href="<?php echo esc_url( get_permalink( $player_id ) ); ?>" class="team-player__slide-link link-plus"></a>
            </div>
          </div>
        </div>
      </div>
      <?php
      $i++;
    endforeach;
    ?>

    <!-- Empty Slide -->
    <div class="team-player__slide">
      <div class="team-player__slide-inner">
        <div class="team-player__slide-meta-holder"></div>
      </div>
    </div>
    <!-- Empty Slide / End -->

  </div>
</div>
