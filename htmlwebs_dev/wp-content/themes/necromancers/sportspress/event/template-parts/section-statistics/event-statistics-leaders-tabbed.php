<?php
/**
 * Event: Statistics - Leaders - Tabbed
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

extract( $args, EXTR_SKIP );

if ( $leaders_performances ) :
  ?>
  <div class="match-stats-widget-tabs">
    <ul class="match-stats-widget-tabs__header nav list-unstyled " role="tablist">
      <?php
      // loop through selected Performances (keys)
      $i = 1;
      foreach ( $leaders_performances as $performance_name ) :

        // get Performance post by 'post_name'
        if ( $performance_post = get_page_by_path( $performance_name, OBJECT, 'sp_performance' ) ) {
          $performance_id = $performance_post->ID;
        } else {
          $performance_id = 0;
        }

        // get the title
        $performance_title   = get_post_field( 'post_title', $performance_id );
        ?>

        <li><a href="#match-stats-widget-tab-<?php echo esc_attr( $performance_name ); ?>" role="tab" data-toggle="tab" class="<?php echo esc_html( 1 === $i ? 'active' : ''); ?>"><?php echo esc_html( $performance_title ); ?></a></li>

        <?php
        $i++;
      endforeach;
      ?>
    </ul>
    <div class="match-stats-widget-tabs__body tab-content">
      <?php
      // loop through selected Performances (keys)
      $i = 1;
      foreach ( $leaders_performances as $performance_name ) :

        // get Performance post by 'post_name'
        if ( $performance_post = get_page_by_path( $performance_name, OBJECT, 'sp_performance' ) ) {
          $performance_id = $performance_post->ID;
        } else {
          $performance_id = 0;
        }

        // get the title
        $performance_title   = get_post_field( 'post_title', $performance_id );

        // sort players by selected performance
        necromancers_sort_by_highest_key_uasort( $performance_combined, $performance_name );
        // get only top players based on selected value
        $performance_combined_top = array_slice( $performance_combined, 0, $leaders_performances_num, true );
        ?>
        
        <ul class="list-unstyled tab-pane fade <?php echo esc_html( 1 === $i ? 'show active' : ''); ?>" id="match-stats-widget-tab-<?php echo esc_attr( $performance_name ); ?>" role="tabpanel">

          <?php
          // loop through players
          $k = 1;
          $top_value = 1;
          foreach ( $performance_combined_top as $player_id => $player_performance ) :

            // get top value (first item has highest value)
            if ( 1 === $k ) {
              $top_value = is_numeric( $player_performance[ $performance_name ] ) ? $player_performance[ $performance_name ] : 1;
            }
            // calculate the percentage
            if ( is_numeric( $player_performance[ $performance_name ] ) ) {
              $percentage = $player_performance[ $performance_name ] / $top_value * 100;
            } else {
              $percentage = 0;
            }
            

            // Team ID
            $team_id = $player_performance['team'];

            // Name
            $name = get_the_title( $player_id );
            if ( $link_posts ):
              $permalink = get_post_permalink( $player_id );
              $name = '<a href="' . $permalink . '">' . $name . '</a>';
            endif;

            $positions = [];
            $position_ids = (array) sp_get_the_term_id( $player_id, 'sp_position' );

            foreach ( $position_ids as $position_id ) {
              $player_position = get_term_by( 'id', $position_id, 'sp_position' );
              if ( $player_position ) {
                $positions[] = [
                  'id'   => $position_id,
                  'name' => $player_position->name,
                  'role'  => get_field( 'ncr_character_role', 'term_' . $position_id ),
                  'image' => get_field( 'ncr_character_image', 'term_' . $position_id ),
                  'icon'  => get_field( 'ncr_character_icon', 'term_' . $position_id )
                ];
              }
            }

            $positions = array_unique( $positions );
            ?>
            <li class="ncr-team-id-<?php echo esc_attr( $team_id ); ?>">
              <figure class="match-player match-player--small match-player--xs" role="group">
                <?php
                $hero_img = isset( $positions[0]['image'] ) ? $positions[0]['image'] : '';
                if ( isset( $positions[0]['image'] ) ) :
                  ?>
                  <figure class="match-player__avatar">
                    <?php echo wp_get_attachment_image( $positions[0]['image'], 'sportspress-fit-mini' ); ?>
                  </figure>
                  <?php
                endif;
                ?>
                <figcaption>
                  <span class="match-player__nickname"><?php echo wp_kses_post( $name ); ?></span>
                  <?php
                  $role = isset( $positions[0]['role'] ) ? $positions[0]['role'] : '';
                  if ( $role ) :
                    ?>
                    <span class="match-player__name"><?php echo esc_html( $role ); ?></span>
                    <?php
                  endif;
                  ?>
                  
                </figcaption>
              </figure>
              <div class="match-stats-progress">
                <div class="match-stats-progress__score"><?php echo esc_html( $player_performance[ $performance_name ] ); ?></div>
                <div class="match-stats-progress__bar">
                  <span class="ncr-team-id-<?php echo esc_attr( $team_id ); ?>" style="width: <?php echo esc_attr( round( $percentage ) ); ?>%">&nbsp;</span>
                </div>
              </div>
            </li>
            <?php
            $k++;
          endforeach;
          ?>
        </ul>
        <?php
        $i++;
      endforeach;
      ?>
    </div>
  </div>
  <?php
endif;
