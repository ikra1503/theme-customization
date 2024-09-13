<?php
/**
 * Menu Panel
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.7
 */

$off_canvas_nav       = get_theme_mod( 'necromancers_off_canvas_nav', true );
$off_canvas_copyright = get_theme_mod( 'necromancers_off_canvas_copyright', '' );
?>

<!-- Page Off Canvas -->
<div class="menu-panel">

  <?php
  // Mobile Menu
  get_template_part( 'template-parts/page-off-canvas/header-mobile/mobile-menu' );
  ?>

  <div class="menu-panel__content d-none d-md-flex <?php echo esc_attr( ! $off_canvas_nav ? 'justify-content-center' : ''); ?>">
    <?php
    // Off-canvas Menu
    if ( $off_canvas_nav ) {
      get_template_part( 'template-parts/page-off-canvas/dlmenu' );
    }
    ?>

    <div class="menu-panel__widget-area">
      <div class="row">

        <?php if ( get_theme_mod( 'necromancers_off_canvas_widget_primary', false ) ) : ?>
          <div class="col-md-12 col-lg-6 col-xl-5">

            <!-- Widget: Primary Info -->
            <div class="widget widget-text widget--primary-info">
              <h5 class="widget__title">
                <?php
                echo get_theme_mod( 'necromancers_off_canvas_widget_primary_title', esc_html__( 'Join Our Team', 'necromancers' ) );
                ?>
              </h5>
              <div class="widget__content">
                <?php
                $primary_desc = get_theme_mod( 'necromancers_off_canvas_widget_primary_desc', false );
                
                if ( get_theme_mod( 'necromancers_off_canvas_widget_primary_desc' ) ) {
                  echo '<p>' . esc_html( $primary_desc ) . '</p>';
                }

                // Primary Links, Emails
                $primary_links = get_theme_mod( 'necromancers_off_canvas_widget_primary_links', [] );

                if ( ! empty( $primary_links ) ) :
                  foreach( $primary_links as $link ) :
                    ?>
                    <div class="info-box">
                      <?php if ( $link['link_subtitle'] ) : ?>
                        <div class="info-box__label"><?php echo esc_html( $link['link_subtitle'] ); ?></div>
                      <?php endif; ?>
                      <?php if ( $link['link_url'] ) : ?>
                      <div class="info-box__content">
                        <a href="<?php echo esc_attr( $link['link_url'] ); ?>"><?php echo esc_attr( $link['link_title'] ); ?></a>
                      </div>
                      <?php endif; ?>
                    </div>
                    <?php
                  endforeach;
                endif;
                ?>
              </div>
            </div>
            <!-- Widget: Primary Info / End -->
          </div>
        <?php endif; ?>

        <?php if ( get_theme_mod( 'necromancers_off_canvas_widget_secondary', false ) ) : ?>
          <div class="col-md-12 col-lg-6 col-xl-5 offset-xl-2 mt-5 mt-lg-0">
            <!-- Widget: Secondary Info -->
            <div class="widget widget-contact-info">
              <h5 class="widget__title">
                <?php
                echo get_theme_mod( 'necromancers_off_canvas_widget_secondary_title', esc_html__( 'Contact Info', 'necromancers' ) );
                ?>
              </h5>
              <div class="widget__content">
                <?php
                $secondary_desc = get_theme_mod( 'necromancers_off_canvas_widget_secondary_desc', false );
                
                if ( get_theme_mod( 'necromancers_off_canvas_widget_secondary_desc' ) ) {
                  echo '<p>' . esc_html( $secondary_desc ) . '</p>';
                }
                
                // Secondary Links, Emails
                $secondary_links = get_theme_mod( 'necromancers_off_canvas_widget_secondary_links', [] );

                if ( ! empty( $secondary_links ) ) :
                  foreach( $secondary_links as $link ) :
                    ?>
                    <div class="info-box">
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
                    </div>
                    <?php
                  endforeach;
                endif;

                // Social Links
                $social_links = get_theme_mod( 'necromancers_off_canvas_widget_secondary_social_links', [] );

                if ( ! empty( $social_links ) ) :
                  ?>
                  <ul class="social-menu social-menu--default">
                    <?php foreach( $social_links as $social_link ) : ?>
                      <li>
                        <a href="<?php echo esc_url( $social_link['link_url'] ); ?>" target="_blank" title="<?php echo esc_attr( $social_link['link_title'] ); ?>"></a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                  <?php
                endif;
                ?>
              </div>
            </div>
            <!-- Widget: Secondary Info / End -->
          </div>
        <?php endif; ?>

      </div>

      <?php
      if ( get_theme_mod( 'necromancers_off_canvas_partners', false ) ) :
        $partners = get_theme_mod( 'necromancers_off_canvas_partners_imgs', [] );
        ?>
        <div class="row">
          <div class="col-md-12">
            <!-- Widget: Partners Carousel -->
            <div class="widget widget-partners-carousel">
              <h5 class="widget__title">
                <?php echo get_theme_mod( 'necromancers_off_canvas_partners_title', esc_html__( 'Our Partners', 'necromancers' ) ); ?>
              </h5>
              <div class="widget__content">
                <?php
                get_template_part(
                  'template-parts/page-off-canvas/partners-carousel',
                  null,
                  [
                    'partners' => $partners,
                    'class'    => '',
                  ] );
                ?>
              </div>
            </div>
            <!-- Widget: Partners Carousel / End -->
          </div>
        </div>
        <?php
      endif;
      ?>

      <?php
      // Copyright
      if ( $off_canvas_copyright ) :
        ?>
        <div class="row">
          <div class="col-lg-12">
            <?php echo wp_kses_post( $off_canvas_copyright ); ?>
          </div>
        </div>
        <?php
      endif;
      ?>

    </div>
  </div>

</div>
<!-- Page Off Canvas / End -->
