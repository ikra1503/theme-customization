<?php
/**
 * Permalinks settings
 *
 * Adds settings to the permalinks admin settings page.
 *
 * @author    Dan Fisher
 * @package   Necromancers Assistant
 * @version   1.0.0
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( ! class_exists( 'NCR_Admin_Permalink_Settings' ) ) :

  /**
   * NCR_Admin_Permalink_Settings Class
   */
  class NCR_Admin_Permalink_Settings {

    /**
     * Hook in tabs.
     */
    public function __construct() {
      $this->slugs = apply_filters( 'necromancers_permalink_slugs', array(
        array( 'partners', esc_html__( 'Partners', 'necromancers-assistant' ) ),
      ) );

      add_action( 'admin_init', array( $this, 'settings_init' ) );
      add_action( 'admin_init', array( $this, 'settings_save' ) );
    }

    /**
     * Init our settings
     */
    public function settings_init() {
      // Add a section to the permalinks page
      add_settings_section( 'necromancers-permalink', esc_html__( 'Necromancers', 'necromancers-assistant' ), array( $this, 'settings' ), 'permalink' );

      // Add our settings
      foreach ( $this->slugs as $slug ):
        add_settings_field(
          $slug[0],                     // id
          $slug[1],                     // setting title
          array( $this, 'slug_input' ), // display callback
          'permalink',                  // settings page
          'necromancers-permalink'      // settings section
        );
      endforeach;
    }

    /**
     * Show a slug input box.
     */
    public function slug_input() {
      $slug = array_shift( $this->slugs );
      $key = $slug[0];
      $text = get_option( 'necromancers_' . $key . '_slug', null );
      ?><fieldset><input id="necromancers_<?php echo $key; ?>_slug" name="necromancers_<?php echo $key; ?>_slug" type="text" class="regular-text code" value="<?php echo $text; ?>" placeholder="<?php echo $key; ?>"></fieldset><?php
    }

    /**
     * Show the settings
     */
    public function settings() {
      echo wpautop( __( 'These settings control the permalinks used for the Necromancers custom post types. These settings only apply when <strong>not using "plain" permalinks above</strong>.', 'necromancers-assistant' ) );
    }

    /**
     * Save the settings
     */
    public function settings_save() {
      if ( ! is_admin() )
        return;

      if ( isset( $_POST['permalink_structure'] ) ):
        foreach ( $this->slugs as $slug ):
          $key = 'necromancers_' . $slug[0] . '_slug';
          $value = null;
          if ( isset( $_POST[ $key ] ) )
            $value = sanitize_text_field( $_POST[ $key ] );
          if ( empty( $value ) )
            delete_option( $key );
          else
            update_option( $key, $value );
        endforeach;
        flush_rewrite_rules();
      endif;
    }
  }

endif;

return new NCR_Admin_Permalink_Settings();
