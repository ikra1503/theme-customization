<?php
/**
 * Player: YouTube
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.4.0
 * @version   1.4.0
 */

extract( $args['defaults'], EXTR_SKIP );
?>

<div class="swiper-slide team-carousel__item" data-icon="tiktok" data-hash="tiktok">
  <div class="row">
    <div class="col-lg-12 col-xl-6">
      <h3 class="player-info-subtitle h5">
        <?php echo esc_html( $args['player']->post->post_title ); ?>
      </h3>
      <?php
      // TikTok Section
      if ( have_rows( 'ncr_player_section_tiktok' ) ) :
        while ( have_rows( 'ncr_player_section_tiktok' ) ) : the_row();
          $channe_url = get_sub_field( 'ncr_player_section_tiktok_channel_url' );
          ?>
          <a href="<?php echo esc_url( $channe_url ); ?>" class="btn btn-tiktok float-right" target="_blank">
            <i class="fab fa-tiktok">&nbsp;</i><?php esc_html_e( 'Follow me', 'necromancers' ); ?>
          </a>
          <h2 class="player-info-title h-lead-2 text-uppercase"><?php echo get_theme_mod( 'necromancers_sp_player_tiktok_title', esc_html__( 'TikTok', 'necromancers' ) ); ?></h2>

          <?php
          // TikTok Videos
          if ( have_rows( 'ncr_player_section_tiktok_videos' ) ) :
            ?>
            <div class="ncr-player-section-video ncr-player-section-video__grid-2">
              <?php
              while ( have_rows( 'ncr_player_section_tiktok_videos' ) ) : the_row();
                $poster_id  = get_sub_field( 'ncr_player_section_tiktok_img' );
                $video_id   = get_sub_field( 'ncr_player_section_tiktok_video_id' );
                $poster_url = wp_get_attachment_image_url( $poster_id, 'necromancers-post-thumbnail-rect-xmd' );
                ?>
                <a href="https://www.tiktok.com/embed/v2/<?php echo esc_attr( $video_id ); ?>" class="mp_iframe stream has-post-thumbnail">
                  <div class="stream__thumbnail">
                    <?php echo wp_get_attachment_image( $poster_id, 'necromancers-post-thumbnail-rect-xmd' ); ?>
                  </div>
                  <div class="stream__icon"></div>
                </a>
                <?php
              endwhile;
              ?>
            </div>
            <?php
          endif;
          ?>
          <?php
        endwhile;
      endif;
      ?>

    </div>
  </div>
</div>
