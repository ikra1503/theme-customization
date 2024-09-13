<?php
/**
 * Template for displaying Partners
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

get_header();
  ?>
  <main class="site-content" id="wrapper">
    <?php
    // Page Heading
    $title                    = get_theme_mod( 'necromancers_partners_title', esc_html__( 'Partners', 'necromancers' ) );
    $subtitle                 = get_theme_mod( 'necromancers_partners_subtitle', esc_html__( 'Necromancers', 'necromancers' ) );
    $email_label              = get_theme_mod( 'necromancers_partners_email_label' );
    $email_address            = get_theme_mod( 'necromancers_partners_email_address' );
    $page_heading_duotone     = get_theme_mod( 'necromancers_partners_page_heading_side_header_duotone', 'base' );
    $page_heading_decorations = get_theme_mod( 'necromancers_partners_page_heading_side_header_decorations', true );
    $extra_classes            = 'page-heading--partners';

    get_template_part(
      'template-parts/page-heading/page-heading-side',
      null,
      [
        'title'                    => $title,
        'subtitle'                 => $subtitle,
        'email_label'              => $email_label,
        'email_address'            => $email_address,
        'page_heading_duotone'     => $page_heading_duotone,
        'page_heading_decorations' => $page_heading_decorations,
        'extra_classes'            => $extra_classes,
      ]
    );
    ?>
    
    <div class="content partners-layout">

      <?php
      while ( have_posts() ) :
        the_post();

        $partner_url = get_field( 'ncr_partner_url' );
        ?>
        <article class="partner">
          <div class="partner__logo">
            <?php the_post_thumbnail(); ?>
          </div>
          <div class="partner__header">
            <h2 class="partner__title h4"><?php the_title(); ?></h2>
            <a href="<?php echo esc_url( $partner_url ); ?>" class="partner__info"><?php echo esc_html( preg_replace("(^https?://)", "", $partner_url )); ?></a>
          </div>
          <p class="partner__excerpt"><?php echo get_the_excerpt(); ?></p>
          <?php
          if ( have_rows( 'ncr_partner_social_links' ) ) :
            ?>
            <ul class="social-menu social-menu--links">
              <?php
              while ( have_rows( 'ncr_partner_social_links' ) ) : the_row();
                $url = get_sub_field( 'ncr_partner_social_link_url' );
                ?>
                <li><a href="<?php echo esc_url( $url ); ?>" target="_blank"></a></li>
                <?php
              endwhile;
              ?>
            </ul>
            <?php
          endif;
          ?>
        </article>
        <?php
      endwhile;
      ?>

    </div>

  </main><!-- .site-content -->
  <?php
get_footer();
