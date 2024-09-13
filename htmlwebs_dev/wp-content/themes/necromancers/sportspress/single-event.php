<?php
/**
 * The template for displaying Single Event
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.4
 */

get_header();

$defaults = array(
  'link_venues'    => get_option( 'sportspress_link_venues', 'yes' ) == 'yes' ? true : false,
  'show_minutes'   => get_option( 'sportspress_event_performance_show_minutes', 'no' ) === 'yes' ? true : false,
  'show_date'      => get_option( 'sportspress_event_show_date', 'yes' ) === 'yes' ? true : false,
  'show_time'      => get_option( 'sportspress_event_show_time', 'yes' ) === 'yes' ? true : false,
  'show_full_time' => get_option( 'sportspress_event_show_full_time', 'yes' ) === 'yes' ? true : false,
  'show_day'       => get_option( 'sportspress_event_show_day', 'yes' ) === 'yes' ? true : false,
  'link_teams'     => get_option( 'sportspress_link_teams', 'no' ) === 'yes' ? true : false,
  'reverse_teams'  => get_option( 'sportspress_event_reverse_teams', 'no' ) === 'yes' ? true : false,
  'show_origin'    => false,
  'sections'       => -1, // combined
  'show_position'  => get_option( 'sportspress_event_show_position', 'yes' ) === 'yes' ? true : false,
  'primary'        => sp_get_main_performance_option(),
  'total'          => get_option( 'sportspress_event_total_performance', 'all'),

  'show_numbers' => get_option( 'sportspress_event_show_player_numbers', 'yes' ) === 'yes' ? true : false,
  'show_players' => get_option( 'sportspress_event_show_players', 'yes' ) === 'yes' ? true : false,
  'show_staff'   => get_option( 'sportspress_event_show_staff', 'yes' ) === 'yes' ? true : false,
  'show_total'   => get_option( 'sportspress_event_show_total', 'yes' ) === 'yes' ? true : false,
);

extract( $defaults, EXTR_SKIP );

// Page Options
$page_bg_color  = get_field( 'ncr_page_custom_bg_color' );
$page_bg_img_on = get_field( 'ncr_page_custom_bg_img_on' );
$page_bg_img    = get_field( 'ncr_page_custom_bg_img' );
$page_duotone   = get_field( 'ncr_page_custom_duotone_effect' );

// Duotone
if ( 'default' !== $page_duotone && ! is_null( $page_duotone ) ) {
  $duotone = $page_duotone;
} else {
  $duotone = get_theme_mod( 'necromancers_sp_event_bg_duotone', 'base' );
}

$bg_output = [];

// Background Color
$bg_color = $page_bg_color ? $page_bg_color : '';

if ( $page_bg_color ) {
  $bg_output[] = 'background-color: ' . $page_bg_color;
}

// Background Image
$bg_img = $page_bg_img_on && ! empty( $page_bg_img ) ? $page_bg_img : '';

if ( 'custom' === $page_bg_img_on && $page_bg_img ) {
  $bg_output[] = 'background-image: url(' . $bg_img . ')';
} elseif ( 'disable' === $page_bg_img_on ) {
  $bg_output[] = 'background-image: none';
}

$bg_output = implode( '; ', $bg_output );

// CSS Classes
$classes = [
  'ncr-bg',
];

if ( $duotone !== 'no_effect' ) {
  $classes[] = 'effect-duotone';
  $classes[] = 'effect-duotone--' . $duotone;
}

?>

<main class="site-content" id="wrapper">
  <div class="ncr-single-event-container">

    <?php
    // Event ID
    if ( ! isset( $event_id ) ) {
      $event_id = get_the_ID();
    }

    $event = new SP_Event( $event_id );

    // Get event result data
    $data = $event->results();

    // The first row should be column labels
    $labels = $data[0];

    // Remove the first row to leave us with the actual data
    unset( $data[0] );

    if ( empty( $data ) ) {
      return false;
    }

    // Reverse teams order if the option "Events > Teams > Order > Reverse order" is enabled.
    if ( $reverse_teams ) {
      $data = array_reverse( $data, true );
    }

    // Video
    $video_url = get_post_meta( $event_id, 'sp_video', true );

    // Sections
    $event_sections = (array) get_option( 'sportspress_event_template_order', [
      'overview',
      'statistics',
      'lineups',
      'video',
    ] );

    if ( ! empty( $event_sections ) ) :
      ?>
      <div class="ncr-event-carousel">
        <div class="swiper-container ncr-event-carousel__inner js-ncr-event-carousel">
          <div class="swiper-wrapper">
            <?php
            foreach ( $event_sections as $key => $section ) {
              // Ignore templates that are unavailable or that have been turned off
              if ( 'content' === $section ) continue;
              // Skip Video section if no video set
              if ( 'video' === $section && ! $video_url ) continue;
            
              $section_option = 'sportspress_event_show_' . $section;
              if ( 'yes' !== get_option( $section_option, sp_array_value( $section, 'default', 'yes' ) ) ) continue;
              // Render the template
              get_template_part( 'sportspress/event/section', $section, [
                'event_id'    => $event_id,
                'event'       => $event,
                'data'        => $data,
                'labels'      => $labels,
                'defaults'    => $defaults,
                'show_origin' => true,
              ]);
            }
            ?>
          </div>
          <ul class="match-stats-links match-stats-links--main"></ul>
        </div>
      </div>
      <?php
    endif;
    ?>

  </div>
</main>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
  <div class="ncr-bg__img-layer" style="<?php echo esc_attr( $bg_output ); ?>"></div>

  <?php if ( $duotone !== 'no_effect' ) : ?>
    <div class="effect-duotone__layer">
      <div class="effect-duotone__layer-inner"></div>
    </div>

    <div class="ncr-bg-effect ncr-bg-effect--gradient-1"></div>
    <div class="ncr-bg-effect ncr-bg-effect--gradient-2"></div>
  <?php endif; ?>
</div>

<?php
get_footer();
