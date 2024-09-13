<?php
/**
 * Team: Awards
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

extract( $args['defaults'], EXTR_SKIP );

$team       = $args['team'];
?>

<div class="swiper-slide team-carousel__item" data-icon="achievements" data-hash="awards">
  <div class="row">
    <div class="col-lg-11">
      <h3 class="player-info-subtitle h4 text-uppercase"><?php echo esc_html( $team->post->post_title ); ?></h3>
      <h2 class="player-info-title h-lead-1 text-uppercase"><?php echo get_theme_mod( 'necromancers_sp_team_awards_title', esc_html__( 'Awards', 'necromancers' ) ); ?></h2>

      <?php
      if ( have_rows( 'ncr_team_section_awards' ) ) :
        while ( have_rows( 'ncr_team_section_awards' ) ) : the_row();

          // Awards
          if ( have_rows( 'ncr_team_section_awards_items' ) ) :
            ?>
            <div class="row">
              <div class="col-md-12 col-xl-8">
                <div class="player-info-carousel" id="player-info-carousel-1">
                  <?php
                  while ( have_rows( 'ncr_team_section_awards_items' ) ) : the_row();
                    $icon     = get_sub_field( 'ncr_team_section_awards_items_icon' );
                    $title    = get_sub_field( 'ncr_team_section_awards_items_title' );
                    $subtitle = get_sub_field( 'ncr_team_section_awards_items_subtitle' );
                    $meta     = get_sub_field( 'ncr_team_section_awards_items_meta' );
                    ?>
                    <div class="player-info-detail player-info-detail--icon">
                      <div class="player-info-detail__icon player-info-detail__icon--lg">
                        <svg role="img" class="df-icon df-icon--<?php echo esc_attr( $icon ); ?>">
                          <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#<?php echo esc_attr( $icon ); ?>"/>
                        </svg>
                      </div>
                      <div class="player-info-detail__body">
                        <div class="player-info-detail__title"><?php echo esc_html( $title ); ?></div>
                        <div class="player-info-detail__label color-primary"><?php echo esc_html( $subtitle ); ?></div>
                        <div class="player-info-detail__label"><?php echo esc_html( $meta ); ?></div>
                      </div>
                    </div>
                    <?php
                  endwhile;
                  ?>
                </div>
              </div>
            </div>
            <?php
          endif;

          // Info
          if ( have_rows( 'ncr_team_section_awards_info' ) ) :
            ?>
            <div class="row row-mb-balance">
              <?php
              while ( have_rows( 'ncr_team_section_awards_info' ) ) : the_row();
                $title    = get_sub_field( 'ncr_team_section_awards_info_title' );
                $subtitle = get_sub_field( 'ncr_team_section_awards_info_subtitle' );
                ?>
                <div class="col-md-4 col-xl-4">
                  <div class="player-info-detail">
                    <div class="player-info-detail__label"><?php echo esc_html( $subtitle ); ?></div>
                    <div class="player-info-detail__title"><?php echo esc_html( $title ); ?></div>
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
