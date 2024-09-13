<?php
/**
 * Mobile Info
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

$primary_links   = get_theme_mod( 'necromancers_off_canvas_widget_primary_links', [] );
$secondary_links = get_theme_mod( 'necromancers_off_canvas_widget_secondary_links', [] );

if ( empty( $primary_links ) && empty( $secondary_links ) ) {
  return;
}
?>

<li class="mobile-bar-item mobile-bar-item--info">
  <a class="mobile-bar-item__header collapsed" data-toggle="collapse" href="#mobile_menu__info" role="button" aria-expanded="false" aria-controls="mobile_menu__info">
    <?php esc_html_e( 'Get in Touch!', 'necromancers' ); ?>
    <span class="main-nav__toggle">&nbsp;</span>
  </a>
  <div id="mobile_menu__info" class="collapse mobile-bar-item__body">
    <div class="mobile-bar-item__inner">

      <?php
      // Merge Primary and Secondary Links, Emails
      $comb_links = wp_parse_args(
        $primary_links,
        $secondary_links
      );

      if ( ! empty( $comb_links ) ) :
        ?>
        <ul class="list-unstyled">
        <?php
        foreach( $comb_links as $link ) :
          ?>
          <li class="info-box">
            <?php
            if ( $link['link_subtitle'] ) :
              ?>
              <div class="info-box__label"><?php echo esc_html( $link['link_subtitle'] ); ?></div>
              <?php
            endif;

            if ( $link['link_url'] ) :
              ?>
              <div class="info-box__content">
                <a href="<?php echo esc_attr( $link['link_url'] ); ?>"><?php echo esc_attr( $link['link_title'] ); ?></a>
              </div>
              <?php
            endif;
            ?>
          </li>
          <?php
        endforeach;
        ?>
        </ul>
        <?php
      endif;
      ?>
    </div>
  </div>
</li>
