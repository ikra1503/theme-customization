<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.3.1
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'necromancers_body_classes' ) ) {
  function necromancers_body_classes( $classes ) {

    if ( get_theme_mod( 'necromancers_preloader', true ) ) {
      // Adds a preloader class
      $classes[] = 'preloader-is--active';
    } else {
      $classes[] = 'scroll-is--active';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
      $classes[] = 'hfeed';
    }

    if ( df_is_theme_activated() ) {
      $classes[] = 'necromancers-is-activated';
    } else {
      $classes[] = 'necromancers-is-not-activated';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'necromancers-sidebar' ) ) {
      $classes[] = 'no-sidebar';
    }

    // Blog Layout
    $blog_layout = get_theme_mod( 'necromancers_blog_page_layout', 'default' );

    // Add different classes depends on the viewed page
    if ( is_404() ) {
      $classes[] = 'site-layout--landing site-layout--landing-error bg-image bg-fixed bg--texture-01 bg--dotted-3x3 ';
    } elseif ( is_home() && 'default' !== $blog_layout || ( is_front_page() && is_home() && 'default' !== $blog_layout ) ) {
      $classes[] = 'site-layout--horizontal preloader--no-transform ';
    } elseif ( is_post_type_archive( 'sp_staff' ) || is_post_type_archive( 'partners' ) ) {
      $classes[] = 'site-layout--horizontal ';
    } elseif ( is_singular( 'sp_event' ) ) {
      $dotted_overlay = get_theme_mod( 'necromancers_sp_event_bg_dotted', false );
      $page_dotted_overlay = get_field( 'ncr_page_custom_dotted_overlay', get_the_ID() );
      if ( ( $dotted_overlay && 'default' === $page_dotted_overlay ) || 'yes' === $page_dotted_overlay ) {
        $classes[] = 'bg--dotted-3x3 ';
      }
    } elseif ( is_singular( 'sp_player' ) && get_theme_mod( 'necromancers_sp_player_bg_dotted', true ) ) {
      $classes[] = 'bg--dotted-3x3 ';
    } elseif ( is_singular( 'sp_team' ) && get_theme_mod( 'necromancers_sp_team_bg_dotted', true ) ) {
      $classes[] = 'bg--dotted-3x3 ';
    } elseif ( is_singular( 'sp_table' ) && get_theme_mod( 'necromancers_sp_table_bg', true ) ) {
      $classes[] = 'bg--dotted-3x3 ';
    } elseif ( is_singular( 'sp_calendar' ) && get_theme_mod( 'necromancers_sp_calendar_bg', true ) ) {
      $classes[] = 'bg--dotted-3x3 ';
    } elseif ( is_singular( 'sp_list' ) && get_theme_mod( 'necromancers_sp_calendar_bg', true ) ) {
      $classes[] = 'bg--dotted-3x3 ';
    } else {

      if ( is_page_template( 'page-landing.php' ) ) {
        // Background
        $page_bg_type_img_video = get_field('ncr_page_background_type_img_video');
        $page_bg_type           = get_field( 'ncr_page_background_type' );

        $classes[] = 'site-layout--landing bg--type-' . $page_bg_type . ' ';

        if ( $page_bg_type_img_video === 'video') {
          // Video
          $classes[] = ' preloader--no-transform';
        } else {
          // Image
          $page_bg        = get_field( 'ncr_page_background_image' );
          $page_dotted_bg = get_field( 'ncr_page_dotted_overlay' );

          $classes[] = 'bg-image bg-fixed bg--' . $page_bg . ' ';

          if ( $page_dotted_bg ) {
            $classes[] = 'bg--dotted-3x3 ';
          }
        }
      } elseif ( is_page_template( 'page-streams.php' ) ) {
        $classes[] = 'site-layout--horizontal ';
      } elseif ( is_page_template( 'page-center.php' ) ) {
        $page_bg_type   = get_field( 'ncr_page_background_type' );
        $page_bg        = get_field( 'ncr_page_background_image' );
        $page_dotted_bg = get_field( 'ncr_page_dotted_overlay' );

        $classes[] = 'bg-image bg-fixed bg--' . $page_bg . ' ';

        if ( $page_dotted_bg ) {
          $classes[] = 'bg--dotted-3x3 ';
        }

        $classes[] = 'bg--type-' . $page_bg_type . ' ';
        
      } else {

        // WooCommerce
        if ( class_exists( 'Woocommerce' ) ) {

          // Shop, Category
          if ( is_shop() || is_product_category() ) {
            $classes[] = 'site-layout--horizontal ';
          }

          // Single Product
          if ( is_product() ) {
            $classes[] = 'site-layout--default';
          }
        } else {
          $classes[] = 'preloader--no-transform ';
        }
      }
    }

    return $classes;
  }
}
add_filter( 'body_class', 'necromancers_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
if ( ! function_exists( 'necromancers_pingback_header' ) ) {
  function necromancers_pingback_header() {
    if ( is_singular() && pings_open() ) {
      printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
  }
}
add_action( 'wp_head', 'necromancers_pingback_header' );



/**
 * Register and add Google Fonts
 *
 */
if ( ! function_exists( 'necromancers_fonts_url' ) ) {

  function necromancers_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Rajdhani, translate this to 'off'. Do not translate
    * into your own language.
    */
    $font_base       = _x( 'on', 'Rajdhani font: on or off', 'necromancers' );
    $font_base_arg   = 'Rajdhani:300,400,500,600,700';

    if ( 'off' !== $font_base ) {
      $font_families = array();

      if ( 'off' !== $font_base ) {
        $font_families[] = $font_base_arg;
      }

      $query_args = array(
        'family'  => implode( '%7C', $font_families ),
        'subset'  => 'latin,latin-ext',
        'display' => 'swap',
      );

      $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
  }
}

if ( ! function_exists( 'necromancers_scripts_styles' ) ) {
  function necromancers_scripts_styles() {
    wp_enqueue_style( 'necromancers-fonts', necromancers_fonts_url(), array(), null );
  }
  add_action( 'wp_enqueue_scripts', 'necromancers_scripts_styles' );
}


/**
 * Removes font-sizes from the tagcloud
 */
if ( !function_exists( 'necromancers_remove_inline_style_tagcloud' ) ) {
  function necromancers_remove_inline_style_tagcloud( $tagcloud ) {
    return preg_replace( '/ style=(["\'])[^\1]*?\1/i', '', $tagcloud, -1 );
  }
  add_filter( 'wp_tag_cloud', 'necromancers_remove_inline_style_tagcloud' );
}


/**
 * Adds SVG duotone color filter to the footer
 */
add_action( 'wp_footer', 'necromancers_footer_svg_color_filter' );
function necromancers_footer_svg_color_filter() {
  echo '<svg xmlns="http://www.w3.org/2000/svg" class="svg-filters">
    <filter id="duotone_base">
      <feColorMatrix type="matrix" result="grayscale"
        values="1 0 0 0 0
                1 0 0 0 0
                1 0 0 0 0
                0 0 0 1 0" />
      <feComponentTransfer color-interpolation-filters="sRGB" result="duotone_base_filter">
        <feFuncR type="table" tableValues="0.082352941176471 0.419607843137255"></feFuncR>
        <feFuncG type="table" tableValues="0.090196078431373 0.443137254901961"></feFuncG>
        <feFuncB type="table" tableValues="0.125490196078431 0.6"></feFuncB>
        <feFuncA type="table" tableValues="0 1"></feFuncA>
      </feComponentTransfer>
    </filter>
  </svg>';
}


/**
 * Displays custom classes to the array of wrapper classes.
 */

if ( ! function_exists( 'necromancers_wrapper_class' ) ) {
  function necromancers_wrapper_class( $class = '' ) {
    // Separates class names with a single space, collates class names for body element.
    echo 'class="' . esc_attr( join( ' ', necromancers_get_wrapper_class( $class ) ) ) . '"';
  }
}

/**
 * Adds custom classes to the array of wrapper classes.
 */
if ( ! function_exists( 'necromancers_get_wrapper_class' ) ) {
  function necromancers_get_wrapper_class( $class = '' ) {
    global $wp_query;
  
    $classes = array( 'site-wrapper' );

    // Blog Layout
    $blog_layout = get_theme_mod( 'necromancers_blog_page_layout', 'default' );

    // Blog Page
    if ( is_front_page() && is_home() && 'default' === $blog_layout ) {
      $classes[] = 'site-layout--classic';
    } elseif ( is_home() && 'default' === $blog_layout ) {
      $classes[] = 'site-layout--classic';
    }

    // Single Page or Post
    if ( is_singular( 'post' ) ) {
      if ( 'thumb_left' === get_theme_mod( 'necromancers_blog_post_layout', 'default' ) && has_post_thumbnail() ) {
        $classes[] = 'site-layout--default';
      } else {
        $classes[] = 'site-layout--default site-layout--default-without-post-thumb';
      }
    } elseif ( is_singular( 'sp_team' ) ) {
      $classes[] = 'site-layout--default';
    } elseif ( is_singular( 'sp_staff' ) ) {
      $classes[] = 'site-layout--default-inverse';
    } elseif ( is_singular( 'page' ) ) {
      if ( is_page_template( 'page-side-banner.php' ) || is_page_template( 'page-side-map.php' ) || is_page_template( 'page-center.php' ) ) {
        $classes[] = 'site-layout--default';
      } elseif ( is_page_template( 'page-landing.php' ) ) {
        $classes[] = '';
      } else {
        $classes[] = 'site-layout--default site-layout--default-without-post-thumb';
      }
    }
  
    if ( ! empty( $class ) ) {
      if ( ! is_array( $class ) ) {
        $class = preg_split( '#\s+#', $class );
      }
      $classes = array_merge( $classes, $class );
    } else {
      // Ensure that we always coerce class to being an array.
      $class = array();
    }
  
    $classes = array_map( 'esc_attr', $classes );
  
    /**
     * Filters the list of CSS wrapper class names for the current post or page.
     *
     * @param string[] $classes An array of wrapper class names.
     * @param string[] $class   An array of additional class names added to the wrapper.
     */
    $classes = apply_filters( 'necromancers_wrapper_class', $classes, $class );
  
    return array_unique( $classes );
  }
}


/**
 * Move Comment field to bottom (Comments)
 */
if ( ! function_exists('necromancers_move_comment_field_to_bottom' ) ) {
  function necromancers_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
  }

  add_filter( 'comment_form_fields', 'necromancers_move_comment_field_to_bottom' );
}


/**
 * Move Single Post Cookies Checkbox field to bottom (Comments)
 */
if ( ! function_exists( 'necromancers_move_cookies_checkbox_field_to_bottom' ) ) {
  function necromancers_move_cookies_checkbox_field_to_bottom( $fields ) {
    if ( ! empty( $fields['cookies'] ) ) {
      $cookies_checkbox_field = $fields['cookies'];
      unset( $fields['cookies'] );
      $fields['cookies'] = $cookies_checkbox_field;
      return $fields;
    } else {
      return $fields;
    }
  }

  add_filter( 'comment_form_fields', 'necromancers_move_cookies_checkbox_field_to_bottom' );
}


/**
 * Filters the maximum number of words in a post excerpt.
 */

if ( ! function_exists( 'necromaners_custom_excerpt_length' ) ) {
  function necromaners_custom_excerpt_length( $length ) {
    return 30;
  }
  add_filter( 'excerpt_length', 'necromaners_custom_excerpt_length', 999 );
}


/**
 * Creates continue reading text
 */
function necromancers_continue_reading_text() {
  $continue_reading = sprintf(
    /* translators: %s: Name of current post. */
    esc_html__( 'Continue reading %s', 'necromancers' ),
    the_title( '<span class="screen-reader-text">', '</span>', false )
  );

  return $continue_reading;
}

/**
 * Create the continue reading link for excerpt.
 */
function necromancers_continue_reading_link_excerpt() {
  if ( ! is_admin() ) {
    return '&hellip; <div class="more-link-container"><a class="more-link btn btn-secondary" href="' . esc_url( get_permalink() ) . '">' . necromancers_continue_reading_text() . '</a></div>';
  }
}
// Filter the excerpt more link.
add_filter( 'excerpt_more', 'necromancers_continue_reading_link_excerpt' );

/**
 * Create the continue reading link.
 */
function necromancers_continue_reading_link() {
  if ( ! is_admin() ) {
    return '<div class="more-link-container"><a class="more-link btn btn-secondary" href="' . esc_url( get_permalink() ) . '#more-' . esc_attr( get_the_ID() ) . '">' . necromancers_continue_reading_text() . '</a></div>';
  }
}
// Filter the excerpt more link.
add_filter( 'the_content_more_link', 'necromancers_continue_reading_link' );


/**
 * Password protected post
 */
if ( ! function_exists( 'necromancers_password_form' ) ) {
  function necromancers_password_form() {
    global $post;
    $label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
    $output = '<form class="form-post-pass-protected" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>' . esc_html__( 'To view this protected post, enter the password below:', 'necromancers' ) . '</p>
    <div class="form-post-pass-protected__holder"><input class="form-control form-control--password" name="post_password" id="' . esc_attr( $label ) . '" type="password" size="20" maxlength="20" placeholder="' . esc_html__( 'Password:', 'necromancers' ) . '" /><input type="submit" class="btn btn-primary form-control--submit" name="Submit" value="' . esc_attr__( 'Enter', 'necromancers' ) . '" /></div>
    </form>
    ';
    return $output;
  }
}
add_filter( 'the_password_form', 'necromancers_password_form' );


/**
 * Set Default Favicon
 */
if ( ! function_exists( 'necromancers_wp_site_icon' ) ) {
  function necromancers_wp_site_icon() {
    if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {

      $favicon_uri = trailingslashit( get_template_directory_uri() ) . 'assets/img/favicons/';

      echo '<link rel="shortcut icon" href="' . $favicon_uri . 'favicon.ico" type="image/x-icon" />' . "\n";
      echo '<link rel="apple-touch-icon" sizes="120x120" href="' . $favicon_uri . 'favicon-120.png">' . "\n";
      echo '<link rel="apple-touch-icon" sizes="152x152" href="' . $favicon_uri . 'favicon-152.png">' . "\n";

    }
  }
}
add_action( 'wp_head', 'necromancers_wp_site_icon' );


/**
 * Limit text based on words
 */
if ( ! function_exists( 'necromancers_string_limit_words' ) ) {
  function necromancers_string_limit_words( $string, $word_limit ) {
    $words = explode( ' ', $string, ( $word_limit + 1 ) );
    if ( count( $words ) > $word_limit )
    array_pop( $words );
    return wp_strip_all_tags( implode( ' ', $words) . '<span class="text-ellipsis">...</span> ' );
  }
}


/**
 * Site URL relative
 */

if ( !is_admin() ) {
  add_action('init', 'necromancers_site_url_shortcode_ob_callback_trigger');
}

if ( ! function_exists( 'necromancers_site_url_shortcode_ob_callback' ) ) {
  function necromancers_site_url_shortcode_ob_callback($html) {
    // Don't bother looking for shortcode if not a wordpress page (e.g. binary)
    if (!preg_match('/(<\/html>|<\/rss>|<\/feed>|<\/urlset|<\?xml)/i', $html )) {
      return $html;
    }

    $html = apply_filters( 'site_url_shortcode_pre', $html );

    // Site url
    $siteUrl = site_url();
    $siteUrlNoProtocol = preg_replace('%^((.*?)//)%', '', $siteUrl);

    /* First replace instances of [site-url] preceded by a protocl
        with protocol-less site url, preserving the specified protocol */
    $html = str_replace('//[site-url]', sprintf('//%s', $siteUrlNoProtocol), $html);

    // Then replace standalone [site-url] with the full site url with protocol
    $html = str_replace('[site-url]', $siteUrl, $html);

    return apply_filters('site_url_shortcode', $html);
  }
}

if ( ! function_exists('necromancers_site_url_shortcode_ob_callback_trigger') ) {
  function necromancers_site_url_shortcode_ob_callback_trigger() {
    ob_start( 'necromancers_site_url_shortcode_ob_callback' );
  }
}


/**
 * Load More Ajax handler for Posts Filter
 */

add_action('wp_ajax_loadmorebutton', 'necromancers_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmorebutton', 'necromancers_loadmore_ajax_handler');

if ( ! function_exists( 'necromancers_loadmore_ajax_handler' ) ) {
  function necromancers_loadmore_ajax_handler(){

    // prepare our arguments for the query
    $params = json_decode( stripslashes( $_POST['query'] ), true ); // query_posts() takes care of the necessary sanitization 
    $params['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $params['post_status'] = 'publish';

    // specify the Blog Layout
    if ( isset( $_POST['blog_layout'] ) && ! empty( $_POST['blog_layout'] ) ) {
      $blog_layout = $_POST['blog_layout'];
    } else {
      $blog_layout = get_theme_mod( 'necromancers_blog_page_layout', 'default' );
    }
  
    // it is always better to use WP_Query but not here
    query_posts( $params );
  
    if ( have_posts() ) :
  
      // run the loop
      while( have_posts() ): the_post();
  
        get_template_part( 'template-parts/loop/post', $blog_layout );
  
      endwhile;
    endif;
    die; // here we exit the script and even no wp_reset_query() required!
  }
}



/**
 * Posts Filter and Load More button
 */

add_action('wp_ajax_necromancersfilter', 'necromancers_filter_function'); 
add_action('wp_ajax_nopriv_necromancersfilter', 'necromancers_filter_function');

if ( ! function_exists( 'necromancers_filter_function' ) ) {
  function necromancers_filter_function(){

    // specify the Blog Layout
    if ( isset( $_POST['necromancers_blog_page_layout'] ) && ! empty( $_POST['necromancers_blog_page_layout'] ) ) {
      $blog_layout = $_POST['necromancers_blog_page_layout'];
    } else {
      $blog_layout = get_theme_mod( 'necromancers_blog_page_layout', 'default' );
    }

    // parameters
    $params = array(
      'post_status'    => 'publish',
      'orderby'        => $_POST['necromancers_order_by'], // example: date
      'order'          => $_POST['necromancers_order'] // example: ASC
    );
  
    // for taxonomies / categories
    if ( isset( $_POST['categoryfilter'] ) && ! empty( $_POST['categoryfilter'] ) ) {
      $params['tax_query'] = array(
        array(
          'taxonomy' => 'category',
          'field'    => 'id',
          'terms'    => $_POST['categoryfilter']
        )
      );
    }
  
    query_posts( $params );

    // absolutely need it, because we will get $wp_query->query_vars and $wp_query->max_num_pages from it.
    global $wp_query;
  
    if ( have_posts() ) :
  
      ob_start(); // start buffering because we do not need to print the posts now
  
      while ( have_posts() ): the_post();
  
        get_template_part( 'template-parts/loop/post', $blog_layout );
  
      endwhile;
      
      $posts_html = ob_get_contents(); // we pass the posts to variable
      
      ob_end_clean(); // clear the buffer
  
    else:

      $posts_html = '<div class="alert alert-warning">' . esc_html__( 'Nothing found for your criteria.', 'necromancers' ) . '</div>';

    endif;
  
    // no wp_reset_query() required
  
    echo json_encode( array(
      'posts'       => json_encode( $wp_query->query_vars ),
      'max_page'    => $wp_query->max_num_pages,
      'found_posts' => $wp_query->found_posts,
      'content'     => $posts_html,
      'bloglayout'  => $blog_layout
    ) );
  
    die();
  }
}



/**
 * Format big numbers
 */
if ( ! function_exists( 'necromancers_format_big_number') ) {
  function necromancers_format_big_number( $number, $precision = 1, $remove_zero = false, $add_suffix = true ) {

    if ( ! is_numeric( $number ) ) {
      return '-';
    };

    if ( $number < 900 ) {
      // 0 - 900
      $number_format = number_format( $number, $precision );
      $suffix = '';
    } elseif ( $number < 900000 ) {
      // 0.9k-850k
      $number_format = number_format( $number / 1000, $precision );
      $suffix = esc_html__( 'K', 'necromancers' );
    } elseif ( $number < 900000000 ) {
      // 0.9m-850m
      $number_format = number_format( $number / 1000000, $precision );
      $suffix = esc_html( 'M', 'necromancers' );
    }
    // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
    // Intentionally does not affect partials, eg "1.50" -> "1.50"
    if ( ! $remove_zero && $precision > 0 ) {
      $dotzero = '.' . str_repeat( '0', $precision );
      $number_format = str_replace( $dotzero, '', $number_format );
    }

    if ( $add_suffix ) {
      return $number_format . $suffix;
    } else {
      return $number_format;
    }
  }
}



/**
 * Sort array by a highest key
 */
if ( ! function_exists( 'necromancers_sort_by_highest_key') ) {
  function necromancers_sort_by_highest_key(&$values, $key) {
    usort( $values, function( $a, $b ) use ( $key ) {
      return intval( $b[ $key ] ) - intval( $a[ $key ] );
    });
  }
}


/**
 * Sort array by a highest key retaining key associations
 */
if ( ! function_exists( 'necromancers_sort_by_highest_key_uasort') ) {
  function necromancers_sort_by_highest_key_uasort(&$values, $key) {
    uasort( $values, function( $a, $b ) use ( $key ) {
      if ( is_numeric( $b[ $key ] ) && is_numeric( $a[ $key ] ) ) {
        return $b[ $key ] - $a[ $key ];
      } else {
        return 0;
      }
    });
  }
}



/**
 * Converts HEX to RGB color
 */
if ( ! function_exists( 'necromancers_hex_to_rgb') ) {
  function necromancers_hex_to_rgb( $color ) {
    $color = str_replace( '#', '', $color );
    // Convert shorthand colors to full format, e.g. "FFF" -> "FFFFFF"
    $color = preg_replace( '~^(.)(.)(.)$~', '$1$1$2$2$3$3', $color );

    $rgb['R'] = hexdec( $color[0].$color[1] );
    $rgb['G'] = hexdec( $color[2].$color[3] );
    $rgb['B'] = hexdec( $color[4].$color[5] );
    return implode( ',', $rgb );
  }
}


/**
 * Sanitize HEX color
 */
if ( ! function_exists( 'necromancers_sanitize_hex') ) {
  function necromancers_sanitize_hex( $hex ) {
    // Strip # sign if it is present
    $color = str_replace("#", "", $hex);

    // Validate hex string
    if (!preg_match('/^[a-fA-F0-9]+$/', $color)) {
      throw new Exception("HEX color does not match format");
    }

    // Make sure it's 6 digits
    if ( strlen($color) === 3) {
      $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
    } elseif ( strlen( $color ) !== 6 ) {
      throw new Exception("HEX color needs to be 6 or 3 digits long");
    }

    return $color;
  }
}

/**
 * Converts HEX to HSL color
 */
if ( ! function_exists( 'necromancers_hex_to_hsl') ) {
  function necromancers_hex_to_hsl( $color ) {
    // Sanity check
    $color = necromancers_sanitize_hex( $color );
  
    // Convert HEX to DEC
    $R = hexdec($color[0] . $color[1]);
    $G = hexdec($color[2] . $color[3]);
    $B = hexdec($color[4] . $color[5]);
  
    $HSL = array();
  
    $var_R = ($R / 255);
    $var_G = ($G / 255);
    $var_B = ($B / 255);
  
    $var_Min = min($var_R, $var_G, $var_B);
    $var_Max = max($var_R, $var_G, $var_B);
    $del_Max = $var_Max - $var_Min;
  
    $L = ($var_Max + $var_Min) / 2;
  
    if ($del_Max == 0) {
      $H = 0;
      $S = 0;
    } else {
      if ($L < 0.5) {
          $S = $del_Max / ($var_Max + $var_Min);
      } else {
          $S = $del_Max / (2 - $var_Max - $var_Min);
      }
  
      $del_R = ((($var_Max - $var_R) / 6) + ($del_Max / 2)) / $del_Max;
      $del_G = ((($var_Max - $var_G) / 6) + ($del_Max / 2)) / $del_Max;
      $del_B = ((($var_Max - $var_B) / 6) + ($del_Max / 2)) / $del_Max;
  
      if ($var_R == $var_Max) {
          $H = $del_B - $del_G;
      } elseif ($var_G == $var_Max) {
          $H = (1 / 3) + $del_R - $del_B;
      } elseif ($var_B == $var_Max) {
          $H = (2 / 3) + $del_G - $del_R;
      }
  
      if ($H < 0) {
          $H++;
      }
      if ($H > 1) {
          $H--;
      }
    }
  
    $HSL['H'] = ($H * 360);
    $HSL['S'] = ($S * 100);
    $HSL['L'] = ($L * 100);
  
    return $HSL;
  }
}


/**
 * Determines video type
 */
if ( ! function_exists( 'necromancers_determine_video_type') ) {
  function necromancers_determine_video_type( $url ) {

    $youtube_rx = '/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/';
    $has_match_youtube = preg_match( $youtube_rx, $url, $youtube_matches);

    $vimeo_rx = '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([‌​0-9]{6,11})[?]?.*/';
    $has_match_vimeo = preg_match( $vimeo_rx, $url, $vimeo_matches );

    $twitch_video_rx = '#^https?://www\.twitch\.tv/videos/(?P<id>\d+)(?:\?t=(?P<time>[0-9hms]+))?$#si';
    $has_match_twitch_video = preg_match( $twitch_video_rx, $url, $twitch_video_matches );

    $twitch_channel_rx = '#^https?://(?P<subdomain>www|clips)\.twitch\.tv/(?P<id>\w+)$#i';
    $has_match_twitch_channel = preg_match( $twitch_channel_rx, $url, $twitch_channel_matches );

    // Then we want the video id which is:
    if ( $has_match_youtube ) {
      $video_id = $youtube_matches[5];
      $type = 'youtube';
    } elseif ( $has_match_vimeo ) {
      $video_id = $vimeo_matches[5];
      $type = 'vimeo';
    } elseif ( $has_match_twitch_video ) {
      $video_id = $twitch_video_matches['id'];
      $type = 'twitch-video';
    } elseif ( $has_match_twitch_channel ) {
      $video_id = $twitch_channel_matches['id'];
      $type = 'twitch-channel';
    } else {
      $video_id = 0;
      $type = 'none';
    }

    $data['video_id'] = $video_id;
    $data['video_type'] = $type;

    return $data;

  }
}


/**
 * Get an array value
 */
if ( ! function_exists( 'necromancers_array_value' ) ) {
  function necromancers_array_value( $arr = array(), $key = 0, $default = null ) {
    return ( isset( $arr[ $key ] ) ? $arr[ $key ] : $default );
  }
}


/**
 * Partners
 */

// Display all Partners on the Partners Archive
add_action( 'pre_get_posts', 'necromacners_partners_archive' );
function necromacners_partners_archive( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'partners' ) ) {
    $query->set( 'posts_per_page', '-1' );
  }
}


/**
 * Extend list of allowed protocols.
 *
 * @param array $protocols List of default protocols allowed by WordPress.
 *
 * @return array $protocols Updated list including new protocols.
 */
if ( ! function_exists( 'necromancers_extend_allowed_protocols' ) ) {
  function necromancers_extend_allowed_protocols( $protocols ){
    $protocols[] = 'ts3server';
    return $protocols;
  }
}
add_filter( 'kses_allowed_protocols' , 'necromancers_extend_allowed_protocols' );
