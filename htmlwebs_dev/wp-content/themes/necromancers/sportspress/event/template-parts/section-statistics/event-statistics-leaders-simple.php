<?php
/**
 * Event: Statistics - Leaders - Simple Layout
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

extract( $args, EXTR_SKIP );

if ( $leaders_performances ) :
  // loop through selected Performances (keys)
  foreach ( $leaders_performances as $performance_name ) :

    // get Performance post by 'post_name'
    if ( $performance_post = get_page_by_path( $performance_name, OBJECT, 'sp_performance' ) ) {
      $performance_id = $performance_post->ID;
    } else {
      $performance_id = 0;
    }

    // get the title
    $performance_title   = get_post_field( 'post_title', $performance_id );
    $performance_excerpt = get_post_field( 'post_excerpt', $performance_id );

    // loop through the performances array and remove players without performances
    foreach ( $performance_combined as $performance_combined_key => $performance_combined_value ) {
      if ( ! array_key_exists( $performance_name, $performance_combined_value ) ) {
        unset( $performance_combined[ $performance_combined_key] );
      }
    }

    // sort players by selected performance
    necromancers_sort_by_highest_key_uasort( $performance_combined, $performance_name );
    // get only top players based on selected value
    $performance_combined_top = array_slice( $performance_combined, 0, $leaders_performances_num, true );

    // loop through players
    foreach ( $performance_combined_top as $player_id => $player_performance ) :

      // Team ID
      $team_id = $player_performance['team'];

      // Name
      $name = get_the_title( $player_id );
      if ( $link_posts ):
        $permalink = get_post_permalink( $player_id );
        $name = '<a href="' . $permalink . '">' . $name . '</a>';
      endif;

      // Metrics
      $metrics = (array) get_post_meta( $player_id, 'sp_metrics', true );

      // First Name
      $fname = isset( $metrics['fname'] ) ? $metrics['fname'] : '';
      // Last Name
      $lname = isset( $metrics['lname'] ) ? $metrics['lname'] : '';
      ?>
      <ul class="match-stats-widget__item">
        <li>
          <figure class="ncr-team-id-<?php echo esc_attr( $team_id ); ?> match-player match-player--wrapped" role="group">
            <figure class="match-player__avatar">
              <?php
              if ( has_post_thumbnail( $player_id ) ) :
                echo get_the_post_thumbnail( $player_id, 'sportspress-fit-icon' );
              else :
                ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholders/placeholder-player-left-90x70.png" class="match-player__placeholder" alt="<?php echo esc_attr( get_the_title( $player_id ) ); ?>" />
                <?php
              endif;
              ?>
            </figure>
            <figcaption>
              <span class="match-player__nickname"><?php echo wp_kses_post( $name ); ?></span>
              <span class="match-player__name"><?php echo esc_html( $fname . ' ' . $lname ); ?></span>
            </figcaption>
          </figure>
          <figure class="ncr-team-id-<?php echo esc_attr( $team_id ); ?> match-team-logo" role="group">
            <?php sp_the_logo( $team_id, 'mini' ); ?>
          </figure>
        </li>
        <li>
          <span>
            <?php
            if ( $performance_excerpt ) {
              echo esc_html( $performance_excerpt );
            } else {
              echo esc_html( $performance_title );
            }
            ?>
          </span>
          <span><?php echo esc_html( $player_performance[ $performance_name ] ); ?></span>
        </li>
      </ul>
      <?php
    endforeach;
  endforeach;
endif;
