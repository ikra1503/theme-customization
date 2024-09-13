<?php
/**
 * The template for displaying Single Staff
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
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

if ( ! isset( $staff_id ) ) {
  $staff_id = get_the_ID();
}

$countries = SP()->countries->countries;

$staff = new SP_Staff( $staff_id );

$nationalities = $staff->nationalities();
$current_teams = $staff->current_teams();
$past_teams = $staff->past_teams();
$roles = $staff->roles();

// Metrics
$metrics = (array) get_post_meta( $staff_id, 'sp_metrics', true );
?>

<main class="site-content" id="wrapper">
  <div class="site-content__inner">
    <div class="site-content__holder">
      <figure class="page-thumbnail page-thumbnail--default">
        <?php
        // Player Photo
        if ( has_post_thumbnail() ) {
          the_post_thumbnail( 'full' );
        } else {
          echo '<img src="'. get_template_directory_uri() . '/assets/img/placeholders/placeholder-sp-fit-lg.png" alt="' . esc_attr( get_the_title( $staff_id ) ) . '">';
        }
        ?>
      </figure>
      <div class="staff-member staff-member--single">
        <div class="staff-member__body">
          <?php
          if ( ! empty( $roles ) ) :
            ?>
            <div class="staff-member__position">
              <?php
              foreach ( $roles as $role ) {
                $role_names[] = $role->name;
              }
              echo esc_html( implode( ', ', $role_names ) );
              ?>
            </div>
            <?php
          endif;
          ?>
          <h2 class="staff-member__title h3"><?php echo esc_html( get_the_title( $staff_id ) ); ?></h2>
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

          <div class="staff-member__content">
            <?php echo get_the_content(); ?>
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
      </div>
    </div>
  </div>
</main>

<?php
get_footer();
