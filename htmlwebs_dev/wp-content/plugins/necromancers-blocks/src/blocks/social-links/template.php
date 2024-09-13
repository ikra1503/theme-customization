<?php
/**
 * Social Links Block Template.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ncr-social-links-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ncr-social-links';
if ( ! empty( $block['className'] ) ) {
  $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $className .= ' align' . $block['align'];
}

if ( get_field( 'is_preview' ) ) :
  echo '<img src="' . NCR_BLOCKS_URL . 'src/blocks/social-links/preview/preview.jpg' . '" style="width: 100%; height: auto;" alt="NCR - Social Links">';
else :
  if ( have_rows( 'ncr_social_links' ) ) :
    ?>
    <ul class="social-menu social-menu--landing social-menu--landing-glitch">
      <?php
      while ( have_rows('ncr_social_links') ) : the_row();
        $title    = get_sub_field('ncr_social_links_title');
        $subtitle = get_sub_field('ncr_social_links_subtitle');
        $url      = get_sub_field('ncr_social_links_url');
        ?>
        <li>
          <a href="<?php echo esc_url( $url ); ?>" target="_blank" class="social-menu__link">
            <i class="social-menu__icon glitch-layer glitch-layer--1"></i>
            <i class="social-menu__icon glitch-layer glitch-layer--2"></i>
            <i class="social-menu__icon glitch-layer"></i>
            <span class="link-subtitle"><?php echo esc_html( $subtitle ); ?></span>
            <?php echo esc_html( $title ); ?>
          </a>
        </li>
        <?php
      endwhile;
      ?>
    </ul>
    <?php
  endif;
endif;
