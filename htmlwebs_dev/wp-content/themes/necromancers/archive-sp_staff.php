<?php
/**
 * Template for displaying Staff Archive
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.1.2
 */

get_header();

$defaults = array(
  'show_age' => get_option( 'sportspress_staff_show_age', 'no' ) == 'yes' ? true : false,
  'show_birthday' => get_option( 'sportspress_staff_show_birthday', 'no' ) == 'yes' ? true : false,
  'show_nationality' => get_option( 'sportspress_staff_show_nationality', 'yes' ) == 'yes' ? true : false,
  'show_current_teams' => get_option( 'sportspress_staff_show_current_teams', 'yes' ) == 'yes' ? true : false,
  'show_past_teams' => get_option( 'sportspress_staff_show_past_teams', 'yes' ) == 'yes' ? true : false,
  'show_nationality_flags' => get_option( 'sportspress_staff_show_flags', 'yes' ) == 'yes' ? true : false,
  'link_teams' => get_option( 'sportspress_link_teams', 'no' ) == 'yes' ? true : false,
);

extract( $defaults, EXTR_SKIP );

// get all countries
$countries = SP()->countries->countries;
?>
<main class="site-content" id="wrapper">
  <?php
  // Page Heading
  $title                    = get_theme_mod( 'necromancers_staff_title', esc_html__( 'Management & Staff', 'necromancers' ) );
  $subtitle                 = get_theme_mod( 'necromancers_staff_subtitle', esc_html__( 'Necromancers', 'necromancers' ) );
  $page_heading_duotone     = get_theme_mod( 'necromancers_staff_page_heading_side_header_duotone', 'base' );
  $page_heading_decorations = get_theme_mod( 'necromancers_staff_page_heading_side_header_decorations', true );

  get_template_part(
    'template-parts/page-heading/page-heading-side',
    null,
    [
      'title'                    => $title,
      'subtitle'                 => $subtitle,
      'page_heading_duotone'     => $page_heading_duotone,
      'page_heading_decorations' => $page_heading_decorations,
    ]
  );
  ?>
  
  <div class="content staff-layout">

    <?php
    while ( have_posts() ) :
      the_post();

      $staff_id = get_the_ID();

      $staff = new SP_Staff( $staff_id );
      $nationalities = $staff->nationalities();
      $roles = $staff->roles();
      $role_names = [];

      if ( $roles ) {
        foreach ( $roles as $role ) {
          $role_names[] = $role->name;
        }
      }
      ?>

      <article class="staff-member has-post-thumbnail">
        <div class="staff-member__thumbnail">
          <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail( 'post-thumbnail' ); ?>
            </a>
          <?php endif; ?>
        </div>
        <div class="staff-member__body">
          <?php
          if ( ! empty( $role_names ) ) :
            ?>
            <div class="staff-member__position"><?php echo esc_html( implode( ', ', $role_names ) ); ?></div>
            <?php
          endif;
          ?>
          <h2 class="staff-member__title h3">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>

          <ul class="staff-member__meta list-unstyled">
            <?php
            // Age
            if ( $show_age ) :
              ?>
              <li class="staff-member__meta-item">
                <span><?php esc_html_e( 'Age', 'necromancers' ); ?></span>
                <?php echo esc_html( necromancers_get_age( get_the_date( 'm-d-Y', $staff_id ) ) ) . ' ' . esc_html__( 'Years', 'necromancers' ); ?>
              </li>
              <?php
            endif;

            // Nationality
            if ( $show_nationality ) :
              ?>
              <li class="staff-member__meta-item">
                <span><?php esc_html_e( 'Nationality', 'necromancers' ); ?></span>
                <?php
                if ( $nationalities && is_array( $nationalities ) ) {
                  $values = array();
                  foreach ( $nationalities as $nationality ):
                    $country_name = sp_array_value( $countries, $nationality, null );
                    $values[] = $country_name ? ( $show_nationality_flags ? '<img src="' . plugin_dir_url( SP_PLUGIN_FILE ) . 'assets/images/flags/' . strtolower( $nationality ) . '.png" class="player-info-detail__flag" alt="' . esc_attr( $nationality ) . '"> ' : '' ) . $country_name : '&mdash;';
                  endforeach;
                  $country_names_string = implode( ', ', $values );
                  echo wp_kses_post( $country_names_string );
                } else {
                  esc_html_e( 'n/a', 'necromancers' );
                }
                ?>
              </li>
              <?php
            endif;

            // Birthday
            if ( $show_birthday ) :
              ?>
              <li class="staff-member__meta-item">
                <span><?php esc_html_e( 'Birthday', 'necromancers' ); ?></span>
                <?php echo esc_html( get_the_date( 'M Y', $staff_id ) ); ?>
              </li>
              <?php
            endif;
            ?>
          </ul>

          <div class="staff-member__excerpt">
            <?php echo get_the_excerpt(); ?>
          </div>

          <?php
          // Social Links
          if ( have_rows( 'ncr_staff_social_links' ) ) :
            ?>
            <ul class="social-menu social-menu--links">
              <?php
              while ( have_rows( 'ncr_staff_social_links' ) ) : the_row();
                $url = get_sub_field( 'ncr_staff_social_link_url' );
                ?>
                <li><a href="<?php echo esc_url( $url ); ?>" target="_blank"></a></li>
                <?php
              endwhile;
              ?>
            </ul>
            <?php
          endif;
          ?>
        </div>
      </article>
      <?php
    endwhile;
    ?>

  </div>

</main><!-- .site-content -->
<?php
get_footer();
