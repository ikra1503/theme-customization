<?php
/**
 * Template part for displaying page content width side Google Map on pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.5.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php the_title('<h1 class="page-title">', '</h1>'); ?>

  <div class="page-content">
    <?php
    the_content();

    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'necromancers'),
        'after' => '</div>',
      )
    );
    ?>
  </div><!-- .page-content -->

  <!-- Google Map -->
  <?php
  // Get the current post ID
  $post_id = 2399;

  // Retrieve map data from page editor
  $gmap_address = get_post_meta($post_id, 'necromancers_gmap_address', true);
  $gmap_style = get_post_meta($post_id, 'necromancers_gmap_style', true);
  $gmap_zoom = get_post_meta($post_id, 'necromancers_gmap_zoom', true);
  $gmap_marker = get_post_meta($post_id, 'necromancers_gmap_marker', true);
  $gmap_info_title = get_post_meta($post_id, 'necromancers_gmap_info_title', true);
  $gmap_info_subtitle = get_post_meta($post_id, 'necromancers_gmap_info_subtitle', true);
  $gmap_info_desc = get_post_meta($post_id, 'necromancers_gmap_info_description', true);
  ?>
  <div class="gm-map gm-map--aside" data-map-style="<?php echo esc_attr($gmap_style); ?>"
    data-map-center="<?php echo esc_attr($gmap_address); ?>" data-map-icon="<?php echo esc_url($gmap_marker); ?>"
    data-map-zoom="<?php echo esc_attr($gmap_zoom); ?>">
    <div class="gm-map__info">
      <?php echo esc_html($gmap_info_title); ?></br>
      <span class="color-primary"><?php echo esc_html($gmap_info_subtitle); ?></span>
      <address><?php echo esc_html($gmap_info_desc); ?></address>
    </div>
  </div>

  <!-- Google Map / End -->

</article><!-- #post-<?php the_ID(); ?> -->