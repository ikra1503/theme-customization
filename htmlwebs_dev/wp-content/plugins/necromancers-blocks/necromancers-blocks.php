<?php
/**
 * Plugin Name: Necromancers Blocks
 * Description: Custom Blocks extension.
 * Plugin URI:  https://1.envato.market/kjoKkN
 * Version:     1.1.3
 * Author:      Dan Fisher
 * Author URI:  https://dan-fisher.dev
 * Text Domain: necromancers-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Necromancers_Blocks' ) ) {
  
  class Necromancers_Blocks {

    /**
     * Constructor.
     */
    public function __construct() {

      // Define constants
      $this->define_constants();

      // Load plugin text domain
      add_action( 'init', array( $this, 'load_plugin_textdomain' ), 0 );

      // Front Styles
      add_action( 'wp_enqueue_style', array( $this, 'front_enqueue_style' ) );

      // Admin Styles
      add_action( 'after_setup_theme', array( $this, 'admin_enqueue_style' ), 30 );

      // Front Scripts
      add_action( 'wp_enqueue_script', array( $this, 'front_enqueue_script' ) );

      // Blocks
      add_action( 'acf/init', array( $this, 'acf_block_types' ) );
      
      // Icons
      add_filter( 'acf_svg_icon_filepath', array( $this, 'svg_icon_filepath' ) );

      // Custom Categories
      add_filter( 'block_categories', array( $this, 'block_categories' ), 10, 2 );
    }

    /**
     * Define constants.
    */
    private function define_constants() {
      if ( !defined( 'NCR_BLOCKS_VERSION' ) ) {
        define( 'NCR_BLOCKS_VERSION', '1.1.3' );
      }

      if ( !defined( 'NCR_BLOCKS_URL' ) ) {
        define( 'NCR_BLOCKS_URL', plugin_dir_url( __FILE__ ) );
      }

      if ( !defined( 'NCR_BLOCKS_DIR' ) ) {
        define( 'NCR_BLOCKS_DIR', plugin_dir_path( __FILE__ ) );
      }
    }

    /**
     * Load Localisation files.
     *
     * Note: the first-loaded translation file overrides any following ones if the same translation is present
     */
    public function load_plugin_textdomain() {
      $locale = apply_filters( 'plugin_locale', get_locale(), 'necromancers-blocks' );
      
      // Global + Frontend Locale
      load_textdomain( 'necromancers-blocks', WP_LANG_DIR . "/necromancers-blocks/necromancers-blocks-$locale.mo" );
      load_plugin_textdomain( 'necromancers-blocks', false, plugin_basename( dirname( __FILE__ ) . "/languages" ) );
    }

    /**
     * Enqueue front styles.
     */
    public static function front_enqueue_style() {
      wp_enqueue_style( 'necromancers-blocks-front', NCR_BLOCKS_URL . 'assets/css/style.css', array(), NCR_BLOCKS_VERSION );
    }

    /**
     * Enqueue admin styles.
     */
    public static function admin_enqueue_style() {

      /*
      * Add theme support for editor styles.
      */
      add_theme_support( 'editor-styles' );

      add_editor_style([
        'https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap',
        NCR_BLOCKS_URL . 'assets/css/style.css',
        'assets/css/style-theme.css',
        'assets/css/components.css',
      ]);
    }

    /**
     * Enqueue front scripts.
     */
    public static function front_enqueue_script() {
      wp_enqueue_script( 'necromancers-blocks-front', NCR_BLOCKS_URL . 'assets/js/script.js', array(), NCR_BLOCKS_VERSION, true );
    }

    /**
     * Add blocks.
     */
    public function acf_block_types() {
      if ( function_exists( 'acf_register_block_type' ) ) {
        require_once NCR_BLOCKS_DIR . 'src/blocks/accordion/init.php';
        require_once NCR_BLOCKS_DIR . 'src/blocks/alert/init.php';
        require_once NCR_BLOCKS_DIR . 'src/blocks/button/init.php';
        require_once NCR_BLOCKS_DIR . 'src/blocks/description-list/init.php';
        require_once NCR_BLOCKS_DIR . 'src/blocks/counter/init.php';
        require_once NCR_BLOCKS_DIR . 'src/blocks/heading-lead/init.php';
        require_once NCR_BLOCKS_DIR . 'src/blocks/icon/init.php';
        require_once NCR_BLOCKS_DIR . 'src/blocks/social-links/init.php';
        require_once NCR_BLOCKS_DIR . 'src/blocks/video-popup/init.php';
        require_once NCR_BLOCKS_DIR . 'src/blocks/world-map/init.php';

        // SportsPress blocks
        if ( class_exists( 'SportsPress' ) ) {
          require_once NCR_BLOCKS_DIR . 'src/blocks/team-gallery/init.php';
        }
      }
    }

    /**
     * SVG Icons.
     */
    public function svg_icon_filepath( $filepath ) {
      $filepath[] = get_template_directory() . '/assets/img/necromancers.svg';
      return $filepath;
    }

    /**
     * Block categories.
     */
    public function block_categories( $categories, $post ) {
      return array_merge(
        $categories,
        array(
          array(
            'slug'  => 'necromancers-blocks',
            'title' => esc_html__( 'Necromancers', 'necromancers-blocks' ),
            'icon'  => 'games',
          ),
        )
      );
    }
  }
}

new Necromancers_Blocks();
