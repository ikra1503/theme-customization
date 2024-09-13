<?php
/**
 * Player: Stream
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

extract( $args['defaults'], EXTR_SKIP );
?>

<div class="swiper-slide team-carousel__item" data-icon="replay" data-hash="stream">
  <div class="row">
    <div class="col-lg-12 col-xl-6">
      <h3 class="player-info-subtitle h5"><?php echo esc_html( $args['player']->post->post_title ); ?></h3>
      <?php
      if ( have_rows( 'ncr_player_section_livestream' ) ) :
        while ( have_rows( 'ncr_player_section_livestream' ) ) : the_row();
          $user_name  = get_sub_field( 'ncr_player_section_livestream_twitch_name' );
          $poster_id  = get_sub_field( 'ncr_player_section_livestream_twitch_img' );
          $poster_url = wp_get_attachment_image_url( $poster_id, 'necromancers-post-thumbnail-rect-xmd' );
          ?>
          <a href="https://www.twitch.tv/<?php echo esc_attr( $user_name ); ?>" class="btn btn-twitch float-right" target="_blank">
            <i class="fab fa-twitch">&nbsp;</i><?php esc_html_e( 'Follow Me!', 'necromancers' ); ?>
          </a>
          <h2 class="player-info-title h-lead-2 text-uppercase"><?php echo get_theme_mod( 'necromancers_sp_player_stream_title', esc_html__( 'Livestream', 'necromancers' ) ); ?></h2>
          <article class="stream has-post-thumbnail" data-id="<?php echo esc_attr( $user_name ); ?>" data-controls="true" data-provider="twitch-channel" data-thumbnail="<?php echo esc_url( $poster_url ); ?>" data-setsize="true" data-easy-embed>
            <div class="stream__thumbnail">
              <?php echo wp_get_attachment_image( $poster_id, 'necromancers-post-thumbnail-rect-xmd' ); ?>
            </div>
            <div class="stream__icon"></div>
          </article>
          <?php
        endwhile;
      endif;
      ?>

    </div>
  </div>
</div>
