<?php
/**
 * Template part for displaying page content for Streams
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.3.2
 */

// Player List
$player_list_id   = get_field( 'ncr_page_player_list' );
$player_list_data = (array) sp_get_list( $player_list_id );

unset( $player_list_data[0] );

// Heading Banner
get_template_part(
  'template-parts/page-heading/page-heading-streams',
  null,
  [
    'player_list_id'   => $player_list_id,
    'player_list_data' => $player_list_data,
  ]
);
?>

<div class="content streams-archive">

  <?php
  // Streams based on selected player list
  foreach ( $player_list_data as $player_id => $player ) :
    if ( have_rows( 'ncr_player_section_livestream', $player_id ) ) :
      while ( have_rows( 'ncr_player_section_livestream', $player_id ) ) : the_row();

        // Player Name
        $player_name = sp_get_player_name( $player_id );

        // Current team
        $current_teams = get_post_meta( $player_id, 'sp_current_team' );
        $current_team_id = ! empty( $current_teams[0] ) ? $current_teams[0] : '';

        // Metrics
        $metrics = (array) get_post_meta( $player_id, 'sp_metrics', true );
        $fname = isset( $metrics['fname'] ) ? $metrics['fname'] : '';
        $lname = isset( $metrics['lname'] ) ? $metrics['lname'] : '';

        // Twitch
        $user_name  = get_sub_field( 'ncr_player_section_livestream_twitch_name' );
        $poster_id  = get_sub_field( 'ncr_player_section_livestream_twitch_img' );
        $poster_url = wp_get_attachment_image_url( $poster_id, 'necromancers-post-thumbnail-rect-xmd' );
        ?>
        <article class="stream ncr-team-id-<?php echo esc_attr( $current_team_id ); ?> player-id-<?php echo esc_attr( $player_id ); ?> has-post-thumbnail" data-id="<?php echo esc_attr( $user_name ); ?>" data-controls="true" data-provider="twitch-channel" data-thumbnail="<?php echo esc_url( $poster_url ); ?>" data-easy-embed>
          <div class="stream__thumbnail">
            <?php echo wp_get_attachment_image( $poster_id, 'necromancers-single-post-thumbnail' ); ?>
          </div>
          <div class="stream__icon"></div>
          <div class="stream__header">
            <div class="stream__info">
              <div class="stream__avatar">
                <div class="stream__avatar-inner">
                  <?php
                  if ( has_post_thumbnail( $player_id ) ) :
                    echo get_the_post_thumbnail( $player_id, 'necromancers-sp-fit-icon-sm' );
                  else :
                    ?>
                    <img src="<?php echo get_template_directory_uri() ; ?>/assets/img/placeholders/placeholder-player-60x60.png" alt="<?php echo esc_attr( $player_name ); ?>">
                    <?php
                  endif;
                  ?>
                </div>
              </div>
              <h6 class="stream__title">
                <?php echo esc_html( $player_name ); ?>
                <?php esc_html_e( 'livestream channel', 'necromancers' ); ?>
              </h6>
              <?php
              if ( $fname || $lname) :
                ?>
                <div class="stream__date"><?php echo esc_html( $fname . ' ' . $lname ); ?></div>
                <?php
              endif;
              ?>
            </div>
            <a href="https://twitch.tv/<?php echo esc_attr( $user_name ); ?>" class="btn btn-twitch btn-twitch--advanced" target="_blank">
              <i class="fab fa-twitch">&nbsp;</i>
              <span class="d-none d-lg-inline-block btn__text-inner">
                <?php esc_html_e( 'Follow', 'necromancers' ); ?>
                <?php echo esc_html( $player_name ); ?>
              </span>
            </a>
          </div>
        </article>
        <?php
      endwhile;
    endif;
  endforeach;
  ?>
</div>
