<?php
/**
 * Enqueue scripts and styles.
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.5.0
 */

if (!function_exists('necromancers_enqueue')) {
  function necromancers_enqueue()
  {

    $uri = get_template_directory_uri();

    // Styles

    // Vendor CSS
    wp_enqueue_style(
      'magnificpopup',
      $uri . '/assets/vendor/magnific-popup/css/magnific-popup.css',
      array(),
      '1.1.0'
    );
    wp_enqueue_style(
      'slick',
      $uri . '/assets/vendor/slick/css/slick.css',
      array(),
      '1.6.0'
    );
    wp_enqueue_style(
      'swiper',
      $uri . '/assets/vendor/swiper/swiper-bundle.min.css',
      array(),
      '6.8.2'
    );

    // Main CSS
    wp_enqueue_style(
      'necromancers-style',
      $uri . '/assets/css/style-theme.css',
      array(),
      THEME_VERSION
    );

    // Components CSS
    wp_enqueue_style(
      'necromancers-components',
      $uri . '/assets/css/components.css',
      array(),
      THEME_VERSION
    );

    // wp_enqueue_style(
    //   'necromancers-custom',
    //   $uri . '/assets/css/custom.css',
    //   array(),
    //   THEME_VERSION
    // );

    // FontAwesome
    wp_enqueue_style(
      'fontawesome',
      $uri . '/assets/vendor/fontawesome/css/all.css',
      array(),
      '5.15.1'
    );

    // Default CSS with Theme Info
    wp_enqueue_style(
      'necromancers-info',
      get_theme_file_uri('style.css'),
      array(),
      THEME_VERSION
    );


    // Scripts
    wp_enqueue_script(
      'bootstrap',
      $uri . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
      array(),
      '4.5.2',
      true
    );
    wp_enqueue_script(
      'mousewheel',
      $uri . '/assets/vendor/mousewheel/jquery.mousewheel.js',
      array('jquery'),
      '3.1.13',
      true
    );
    wp_enqueue_script(
      'custom-select-classie',
      $uri . '/assets/vendor/custom-select/classie.js',
      array(),
      '1.0.0',
      true
    );
    wp_enqueue_script(
      'custom-select-selectFx',
      $uri . '/assets/vendor/custom-select/selectFx.js',
      array(),
      '1.0.0',
      true
    );
    wp_enqueue_script(
      'slick',
      $uri . '/assets/vendor/slick/js/slick.js',
      array(),
      '1.6.0',
      true
    );
    wp_enqueue_script(
      'swiper',
      $uri . '/assets/vendor/swiper/swiper-bundle.min.js',
      array(),
      '6.8.2',
      true
    );
    wp_enqueue_script(
      'countdown',
      $uri . '/assets/vendor/countdown/jquery.countdown.js',
      array('jquery'),
      '2.2.0',
      true
    );
    wp_enqueue_script(
      'modernizr',
      $uri . '/assets/vendor/dlmenu/modernizr.custom.js',
      array(),
      '1.0.0',
      true
    );
    wp_enqueue_script(
      'dlmenu',
      $uri . '/assets/vendor/dlmenu/jquery.dlmenu.js',
      array('jquery'),
      '1.0.1',
      true
    );
    wp_enqueue_script(
      'magnificpopup',
      $uri . '/assets/vendor/magnific-popup/js/jquery.magnific-popup.js',
      array('jquery'),
      '1.1.0',
      true
    );
    wp_enqueue_script(
      'imagesloaded',
      $uri . '/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js',
      array(),
      '4.1.1',
      true
    );
    wp_enqueue_script(
      'isotope',
      $uri . '/assets/vendor/isotope/isotope.pkgd.js',
      array(),
      '3.0.1',
      true
    );
    wp_enqueue_script(
      'isotope-fitcolumns',
      $uri . '/assets/vendor/isotope/fitcolumns.js',
      array('isotope'),
      '1.1.4',
      true
    );
    wp_enqueue_script(
      'progressbar',
      $uri . '/assets/vendor/progressbar/progressbar.js',
      array(),
      '1.0.0',
      true
    );
    wp_enqueue_script(
      'jpinning',
      $uri . '/assets/vendor/jpinning/jpinning.js',
      array('jquery'),
      '0.1.0',
      true
    );
    wp_enqueue_script(
      'easyembed',
      $uri . '/assets/vendor/easyembed/jquery.easyembed.js',
      array('jquery'),
      '1.1.2',
      true
    );

    // Load Google Map Scripts only on the Page Google Map template
    // $gmap_key = 'AIzaSyCG39EpX8oGAXWTHK-CPU_uZgtyFRkERRU';
    // $gmap_key = get_theme_mod('necromancers_gmap_key'); ?>
    <?php if (is_plugin_active('advanced-custom-fields-pro/acf.php')): ?>
      <?php
      $gmap_key = get_field('api_key', 'option');
      wp_enqueue_script(
        'gmap',
        $uri . '/assets/vendor/gmap3/gmap3.min.js',
        array('jquery', 'google_maps_api'),
        '7.2',
        true
      );
      wp_enqueue_script(
        'google_maps_api',
        esc_url(
          add_query_arg(
            array(
              'key' => $gmap_key,
              'callback' => 'Function.prototype',
            ),
            '//maps.googleapis.com/maps/api/js'
          )
        ),
        array(),
        null,
        true
      );
    ?>
    <?php endif; ?>
    <?php



    // Register Scripts
    wp_register_script(
      'necromancers-init',
      $uri . '/assets/js/init.js',
      array(),
      THEME_VERSION,
      true
    );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
    }

    wp_localize_script(
      'necromancers-init',
      'necromancersData',
      [
        'template_url' => get_template_directory_uri(),
        'dlmenu_back' => esc_html__('Back', 'necromancers'),
        'countdown_days' => esc_html__('Days', 'necromancers'),
        'countdown_hours' => esc_html__('Hours', 'necromancers'),
        'countdown_mins' => esc_html__('Mins', 'necromancers'),
        'countdown_secs' => esc_html__('Secs', 'necromancers'),
      ]
    );

    // Enqueue Script Init
    wp_enqueue_script('necromancers-init');

  }
}

add_action('wp_enqueue_scripts', 'necromancers_enqueue');


// Blog posts specific script
if (!function_exists('necromancers_posts_scripts')) {
  function necromancers_posts_scripts()
  {

    // absolutely need it, because we will get $wp_query->query_vars and $wp_query->max_num_pages from it.
    global $wp_query;

    // Posts Script
    wp_register_script(
      'necromancers-posts-filter',
      get_template_directory_uri() . '/assets/js/posts-filter.js',
      array(),
      THEME_VERSION,
      true
    );

    // pass posts data to JS if we're on the blog page
    wp_localize_script(
      'necromancers-posts-filter',
      'necromancersPostData',
      [
        'ajaxurl' => admin_url('admin-ajax.php'), // WordPress AJAX
        'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
        'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
        'max_page' => $wp_query->max_num_pages,
        'blog_layout' => get_theme_mod('necromancers_blog_page_layout', 'default'),
        'filter_txt' => esc_html__('Filter News', 'necromancers'),
        'filter_before_send_txt' => esc_html__('Filtering...', 'necromancers'),
      ]
    );
  }
}

add_action('wp_enqueue_scripts', 'necromancers_posts_scripts');



/**
 * Admin styling
 */
if (!function_exists('necromancers_custom_admin_css')) {
  function necromancers_custom_admin_css()
  {
    if (is_admin()) {
      wp_enqueue_style('necromancers-custom-admin', get_template_directory_uri() . '/inc/admin/assets/css/df-admin.css', array(), THEME_VERSION);
    }
  }
}
add_action('admin_enqueue_scripts', 'necromancers_custom_admin_css');

if (!function_exists('necromancers_custom_admin_no_registered')) {
  function necromancers_custom_admin_no_registered()
  {
    if (!df_is_theme_activated()) {

      wp_enqueue_style(
        'necromancers-custom-admin-not-registered',
        get_theme_file_uri('inc/admin/assets/css/df-admin-not-registered.css'),
        array(),
        THEME_VERSION
      );

      wp_enqueue_script(
        'necromancers-custom-js-admin',
        get_theme_file_uri('inc/admin/assets/js/min/necromancers-admin-min.js'),
        array(),
        THEME_VERSION
      );
    }
  }
}
add_action('admin_enqueue_scripts', 'necromancers_custom_admin_no_registered');
