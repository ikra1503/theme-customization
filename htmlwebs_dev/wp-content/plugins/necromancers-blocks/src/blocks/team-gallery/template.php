<?php
/**
 * SportsPress: Team Gallery Block Template.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.1
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */


// Create id attribute allowing for custom "anchor" value.
$id = 'ncr-team-gallery-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-team-gallery row justify-content-center';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

$team_gallery_style = get_field( 'ncr_block_gallery_style' );

if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/team-gallery/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Team Gallery">';
else :

  if ( have_rows( 'ncr_block_gallery_teams' ) ) :
    ?>
    <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">

      <?php
      while( have_rows( 'ncr_block_gallery_teams' ) ) : the_row();
        $team_id     = get_sub_field( 'ncr_block_gallery_team' );
        $title       = get_sub_field( 'ncr_block_gallery_team_title' );
        $subtitle    = get_sub_field( 'ncr_block_gallery_team_subtitle' );
        $bg_img      = get_sub_field( 'ncr_block_gallery_team_bg' );
        $custom_logo = get_sub_field( 'ncr_block_gallery_team_custom_logo' );
        if ( 'style-2' === $team_gallery_style ) {
          $front_img = get_sub_field( 'ncr_block_gallery_team_front_style2' );
        } else {
          $front_img = get_sub_field( 'ncr_block_gallery_team_front_style3' );
        }

        // Team Name
        $team_name = ! empty( $title ) ? $title : sp_team_name( $team_id );

        // Team Background
        $team_bg = ! empty( $bg_img ) ? $bg_img : sp_get_logo_url( $team_id, 'sportspress-fit-medium' );

        // Style 1
        if ( 'style-1' === $team_gallery_style ) :
          ?>
          <div class="team-selection-col col-sm-6 col-lg-3">
            <div class="ncr-team-id-<?php echo esc_attr( $team_id ); ?> team-selection-item team-selection-item--<?php echo esc_attr( $team_gallery_style ); ?> text-center">
              <a href="<?php echo get_post_permalink( $team_id ); ?>" class="team-selection-item__thumbnail">
                <div class="team-selection-item__thumbnail-inner">
                  <img src="<?php echo esc_url( $team_bg ); ?>" alt="<?php echo esc_attr( $team_name ); ?>">
                </div>
                <?php
                if ( $custom_logo ) {
                  echo wp_get_attachment_image(
                    $custom_logo,
                    'necromancers-sp-fit-icon-sm',
                    false,
                    [
                      'class' => 'team-selection-item__logo team-selection-item__logo--middle',
                    ]
                  );
                } else {
                  if ( has_post_thumbnail( $team_id ) ) {
                    echo get_the_post_thumbnail(
                      $team_id,
                      'necromancers-sp-fit-icon-sm',
                      [
                        'class' => 'team-selection-item__logo team-selection-item__logo--middle',
                      ]
                    );
                  }
                }
                ?>
              </a>
              <?php
              if ( $subtitle ) :
                ?>
                <span class="team-selection-item__subtitle h6"><?php echo esc_html( $subtitle ); ?></span>
                <?php
              endif;
              ?>
              <h2 class="team-selection-item__title"><?php echo esc_html( $team_name ); ?></h2>
            </div>
          </div>
          <?php


        // Style 2
        elseif ( 'style-2' === $team_gallery_style ) :
          ?>
          <div class="team-selection-col col-sm-6 col-lg-3">
            <div class="ncr-team-id-<?php echo esc_attr( $team_id ); ?> team-selection-item team-selection-item--<?php echo esc_attr( $team_gallery_style ); ?> text-center">
              <a href="<?php echo get_post_permalink( $team_id ); ?>" class="team-selection-item__thumbnail">
                <div class="team-selection-item__thumbnail-inner">
                  <img src="<?php echo esc_url( $team_bg ); ?>" alt="<?php echo esc_attr( $team_name ); ?>">
                  <?php
                  if ( $front_img ) :
                    ?>
                    <img src="<?php echo esc_url( $front_img ); ?>" alt="<?php echo esc_attr( $team_name ); ?>">
                    <?php
                  endif;
                  ?>
                </div>
              </a>
              <?php
              if ( $custom_logo ) {
                echo wp_get_attachment_image(
                  $custom_logo,
                  'necromancers-sp-fit-icon-sm',
                  false,
                  [
                    'class' => 'team-selection-item__logo team-selection-item__logo--bottom',
                  ]
                );
              } else {
                if ( has_post_thumbnail( $team_id ) ) {
                  echo get_the_post_thumbnail(
                    $team_id,
                    'necromancers-sp-fit-icon-sm',
                    [
                      'class' => 'team-selection-item__logo team-selection-item__logo--bottom',
                    ]
                  );
                }
              }
              
              if ( $subtitle ) :
                ?>
                <span class="team-selection-item__subtitle h6"><?php echo esc_html( $subtitle ); ?></span>
                <?php
              endif;
              ?>
              <h2 class="team-selection-item__title"><?php echo esc_html( $team_name ); ?></h2>
            </div>
          </div>
          <?php


        // Style 3
        elseif ( 'style-3' === $team_gallery_style ) :
          ?>
          <div class="team-selection-col col-sm-6 col-lg-3">
            <div class="ncr-team-id-<?php echo esc_attr( $team_id ); ?> team-item team-item--v3">
              <a href="<?php echo get_post_permalink( $team_id ); ?>" class="team-item__thumbnail">
                <div class="team-item__bg-holder">
                  <div class="team-item__bg" style="background-image: url(<?php echo esc_url( $team_bg ); ?>);"></div>
                </div>
                <?php
                if ( $front_img ) :
                  ?>
                  <div style="background-image: url(<?php echo esc_url( $front_img ); ?>);" class="team-item__img-primary"></div>
                  <?php
                endif;
                ?>
              </a>
              <?php if ( $subtitle ) : ?>
                <span class="team-item__subtitle h6"><?php echo esc_html( $subtitle ); ?></span>
              <?php endif; ?>
              <h2 class="team-item__title"><?php echo esc_html( $team_name ); ?></h2>
            </div>
          </div>
          <?php
        endif;
      endwhile;
      ?>
    </div>
    <?php
  endif;

endif;
