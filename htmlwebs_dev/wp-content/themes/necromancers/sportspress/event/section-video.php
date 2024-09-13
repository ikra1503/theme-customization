<?php
/**
 * Event: Video
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.2
 */

extract( $args['defaults'], EXTR_SKIP );

$event_id    = $args['event_id'];
$event       = $args['event'];

// Video
$video_url    = get_post_meta( $event_id, 'sp_video', true );
$video_data   = necromancers_determine_video_type( $video_url );
?>

<div class="swiper-slide ncr-event-carousel__item" data-icon="replay" data-hash="video">
  <div class="container ncr-event-carousel__item-inner">
    <?php
    // Event Page Heading
    get_template_part(
      'sportspress/event/template-parts/event-page-heading',
      null,
      [
        'event_id'  => $event_id,
        'event'     => $event,
        'show_date' => $show_date
      ]
    );
    ?>
    <div class="match-replay stream has-post-thumbnail" data-id="<?php echo esc_attr( $video_data['video_id'] ); ?>" data-controls="true" data-provider="<?php echo esc_attr( $video_data['video_type'] ); ?>" data-easy-embed>
      <div class="stream__thumbnail">
       <?php
        if ( has_post_thumbnail() ) {
          the_post_thumbnail( 'necromancers-single-post-thumbnail' );
        }
        ?>
      </div>
      <div class="stream__icon"></div>
    </div>
  </div>
</div>
