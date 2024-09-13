<?php
/**
 * Page Heading - Streams
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.4.1
 */

extract( $args, EXTR_SKIP );

$subtitle    = get_field( 'ncr_page_subtitle' );
$description = get_field( 'ncr_page_desc' );
$duotone     = get_field( 'ncr_page_heading_duotone' );
$bg_img      = get_field( 'ncr_page_heading_bg_img' );
$decorations = get_field( 'ncr_page_heading_decorations' );

$classes = [
  'page-heading',
  'page-heading--loop',
  'page-heading--streams-archive',
];

// Duotone
if ( $duotone !== 'no_effect' ) {
  $classes[] = 'effect-duotone';
  $classes[] = 'effect-duotone--' . $duotone;
}

// Custom Background Image
$bg_img_output = '';
if ( $bg_img ) {
  $bg_img_output = 'style="background-image: url(' . esc_url( $bg_img ) . ');"';
}
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" <?php echo wp_kses_post( $bg_img_output ); ?>>
  <?php
  if ( $subtitle ) :
    ?>
    <div class="page-heading__subtitle h5 color-warning"><?php echo esc_html( $subtitle ); ?></div>
    <?php
  endif;
  ?>
  <h1 class="page-heading__title h-lead-2"><?php the_title(); ?></h1>
  <div class="page-heading__body">
    <?php echo wp_kses_post( $description ); ?>
  </div>

  <?php
  // Player List Filter
  $player_list_img = get_field( 'ncr_page_player_list_img' ) ? get_field( 'ncr_page_player_list_img' ) : get_template_directory_uri() . '/assets/img/logo.png';
  ?>
  <div class="streams-filter-wrapper">
    <ul class="streams-filter filter js-filter list-unstyled">
      <li>
        <button class="btn active" data-filter="*">
          <img src="<?php echo esc_url( $player_list_img ); ?>" alt="<?php echo esc_attr( 'Show All', 'necromancers' ); ?>" class="streams-filter__img streams-filter__img--all">
        </button>
      </li>
      <?php
      // Players
      if ( $player_list_data ) :
        foreach ( $player_list_data as $player_id => $player ) :
          ?>
          <li>
            <button class="btn" data-filter=".player-id-<?php echo esc_attr( $player_id ); ?>">
            <?php
            if ( has_post_thumbnail( $player_id ) ) :
              echo get_the_post_thumbnail( $player_id, 'sportspress-fit-icon', [
                'class' => 'streams-filter__img',
              ] );
            else :
              ?>
              <img src="<?php echo get_template_directory_uri() ; ?>/assets/img/placeholders/placeholder-player-128x128.png" class="streams-filter__img" alt="<?php echo esc_attr( sp_get_player_name( $player_id ) ); ?>">
              <?php
            endif;
            ?>
            </button>
          </li>
          <?php
        endforeach;
      endif;
      ?>
    </ul>
  </div>

  <?php if ( $duotone !== 'no_effect' ) : ?>
    <div class="effect-duotone__layer">
      <div class="effect-duotone__layer-inner"></div>
    </div>
  <?php endif; ?>

  <?php if ( $decorations ) : ?>
    <div class="page-heading-effect page-heading-effect--gradient-1"></div>
    <div class="page-heading-effect page-heading-effect--gradient-2"></div>
    <div class="page-heading-effect page-heading-effect--pattern page-heading-effect--pattern-1"></div>
    <div class="page-heading-effect page-heading-effect--pattern page-heading-effect--pattern-2"></div>
  <?php endif; ?>
</div>
