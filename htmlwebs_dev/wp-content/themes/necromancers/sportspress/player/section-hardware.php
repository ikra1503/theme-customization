<?php
/**
 * Player: Hardware
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */
?>

<div class="swiper-slide team-carousel__item" data-icon="hardware" data-hash="hardware">
  <div class="row">
    <div class="col-lg-12 col-xl-6">
      <h3 class="player-info-subtitle h5"><?php echo esc_html( $args['player']->post->post_title ); ?></h3>
      <h2 class="player-info-title h-lead-2 text-uppercase"><?php echo get_theme_mod( 'necromancers_sp_player_hardware_title', esc_html__( 'Hardware', 'necromancers' ) ); ?></h2>

      <?php
      // Hardware items
      if ( have_rows( 'ncr_player_section_hardware' ) ) :
        while ( have_rows( 'ncr_player_section_hardware' ) ) : the_row();
          if ( have_rows( 'ncr_player_section_hardware_item' ) ) :
            ?>
            <div class="row">
              <?php
              while ( have_rows( 'ncr_player_section_hardware_item' ) ) : the_row();
                $icon     = get_sub_field( 'ncr_player_section_hardware_item_icon' );
                $name     = get_sub_field( 'ncr_player_section_hardware_item_name' );
                $brand    = get_sub_field( 'ncr_player_section_hardware_item_brand' );
                $link_txt = get_sub_field( 'ncr_player_section_hardware_item_link_text' );
                $link_url = get_sub_field( 'ncr_player_section_hardware_item_link_url' );
                ?>
                <div class="col-6 col-md-6">
                  <div class="player-info-detail player-info-detail--icon">
                    <div class="player-info-detail__icon player-info-detail__icon--lg">
                      <svg role="img" class="df-icon df-icon--<?php echo esc_attr( $icon ); ?>">
                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#<?php echo esc_attr( $icon ); ?>"/>
                      </svg>
                    </div>
                    <div class="player-info-detail__body">
                      <div class="player-info-detail__title"><?php echo esc_html( $name ); ?></div>
                      <div class="player-info-detail__label color-primary"><?php echo esc_html( $brand ); ?></div>
                      <a href="<?php echo esc_url( $link_url ); ?>" class="player-info-detail__link"><?php echo esc_html( $link_txt ); ?></a>
                    </div>
                  </div>
                </div>
                <?php
              endwhile;
              ?>
            </div>
            <?php
          endif;
        endwhile;
      endif;
      ?>
    </div>
  </div>
</div>
