<?php
/**
 * Player List Slider for Single Team
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.7
 */

$team        = $args['team'];
$decorations = $args['decorations']
?>

<div class="team-player">
  <div class="container container--large">
    <div class="row">
      <div class="col-md-12 col-lg-4 offset-lg-7 team-player__inner">

        <?php
        // Player List
        $lists = $team->lists();
        if ( empty( $lists ) ) return;
        $last_list = end( $lists ); // get the latest selected table
        $last_list_id = $last_list->ID;

        $list_data = sp_get_list( $last_list_id );
        // Remove the first row and 'head' row to leave us with the actual data
        unset( $list_data[0] );
        ?>

        <ul class="team-player__filter list-unstyled nav">
          <?php
          $i = 0;
          foreach ( $list_data as $player_id => $player ) :
            ?>
            <li class="team-player__filter-item">
              <a href="#player-<?php echo esc_attr( $player_id ); ?>" role="tab" data-toggle="tab" class="team-player__filter-inner <?php echo esc_attr( $i == 0 ? 'active' : '' ); ?>">
                <?php
                if ( has_post_thumbnail( $player_id ) ) :
                  echo get_the_post_thumbnail(
                    $player_id,
                    'sportspress-fit-icon',
                    [
                      'class' => 'team-player__filter-img'
                    ]
                  );
                endif;
                ?>
              </a>
            </li>
            <?php
            $i++;
          endforeach;
          ?>
        </ul>


        <div class="tab-content">

          <?php
          $i = 0;
          foreach ( $list_data as $player_id => $player ) :

            // Metrics
            $metrics = (array) get_post_meta( $player_id, 'sp_metrics', true );
            $fname = isset( $metrics['fname'] ) ? $metrics['fname'] : '';
            $lname = isset( $metrics['lname'] ) ? $metrics['lname'] : '';

            // Color
            $player_color = get_field( 'ncr_player_color', $player_id ) ? get_field( 'ncr_player_color', $player_id ) : 'default';
            ?>
            <div class="tab-pane fade <?php echo esc_attr( $i == 0 ? 'show active' : '' ); ?>" id="player-<?php echo esc_attr( $player_id ); ?>" role="tabpanel">

              <?php if ( $decorations ) : ?>
                <!-- Decoration -->
                <div class="ncr-page-decor ncr-page-decor--<?php echo esc_attr( $player_color ); ?>">
                  <div class="ncr-page-decor__layer-1">
                    <div class="ncr-page-decor__layer-bg"></div>
                  </div>
                  <div class="ncr-page-decor__layer-2">
                    <div class="ncr-page-decor__layer-bg"></div>
                  </div>
                  <div class="ncr-page-decor__layer-3"></div>
                  <div class="ncr-page-decor__layer-4"></div>
                  <div class="ncr-page-decor__layer-5"></div>
                </div>
                <!-- Decoration / End -->
              <?php endif; ?>

              <div class="team-player__info">
                <div class="team-player__header">
                  <h2 class="team-player__name h4 color-primary"><?php echo esc_html( $fname . ' ' . $lname ); ?></h2>
                  <h1 class="team-player__nickname h3">
                    <span class="position-relative"><?php echo sp_get_player_name( $player_id ); ?><a class="add-icon" href="<?php echo esc_url( get_permalink( $player_id ) ); ?>"></a></span>
                  </h1>
                  <?php
                  // Social Links
                  if ( have_rows( 'ncr_player_social_links', $player_id ) ) :
                    ?>
                    <ul class="social-menu social-menu--default">
                      <?php
                      while ( have_rows( 'ncr_player_social_links', $player_id ) ) : the_row();
                        $url = get_sub_field( 'ncr_player_social_link_url' );
                        ?>
                        <li><a href="<?php echo esc_url( $url ); ?>" target="_blank"></a></li>
                        <?php
                      endwhile;
                      ?>
                    </ul>
                    <?php
                  endif;
                  ?>
                  
                </div>
                <div class="team-player__photo">
                  <?php
                  if ( has_post_thumbnail( $player_id ) ) :
                    $thumb_id = get_post_thumbnail_id( $player_id );
                    $thumb_url = wp_get_attachment_image_src( $thumb_id, 'necromancers-sp-fit-lg', true );
                    $post_thumb = $thumb_url[0];

                    echo '<img src="' . esc_url( $thumb_url[0] ) . '" alt="' . esc_attr( $fname . ' ' . $lname ) . '"/>';
                  endif;
                  ?>
                </div>
              </div>
            </div>
            <?php
            $i++;
          endforeach;
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
