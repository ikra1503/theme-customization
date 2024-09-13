<?php
/**
 * TGM Init Class
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.5.1
 */

if ( ! function_exists( 'necromancers_register_plugins' ) ) {
  function necromancers_register_plugins() {

    $plugins = array(
      array(
        'name'         => 'Kirki Customizer Framework',
        'slug'         => 'kirki',
        'required'     => true,
      ),
      array(
        'name'         => 'Necromancers Assistant',
        'slug'         => 'necromancers-assistant',
        'source'       => 'https://danfisher-bucket-2.s3.eu-west-3.amazonaws.com/necromancers/plugins/3N66DmMJukAU/necromancers-assistant.zip',
        'required'     => true,
        'version'      => '1.0.2',
      ),
      array(
        'name'         => 'Necromancers Blocks',
        'slug'         => 'necromancers-blocks',
        'source'       => 'https://danfisher-bucket-2.s3.eu-west-3.amazonaws.com/necromancers/plugins/3N66DmMJukAU/necromancers-blocks.zip',
        'required'     => true,
        'version'      => '1.1.3',
      ),
      array(
        'name'         => 'Advanced Custom Fields Pro',
        'slug'         => 'advanced-custom-fields-pro',
        'source'       => 'https://danfisher-bucket-2.s3.eu-west-3.amazonaws.com/necromancers/plugins/3N66DmMJukAU/advanced-custom-fields-pro.zip',
        'required'     => true,
        'version'      => '6.2.8',
      ),
      array(
        'name'         => 'Advanced Custom Fields: SVG Icon',
        'slug'         => 'acf-svg-icon',
        'source'       => 'https://github.com/BeAPI/acf-svg-icon/archive/2.0.4.zip',
        'external_url' => 'https://github.com/BeAPI/acf-svg-icon',
        'required'     => true,
        'version'      => '2.0.4'
      ),
      array(
        'name'         => 'One Click Demo Import',
        'slug'         => 'one-click-demo-import',
        'required' 	   => true,
      ),
      array(
        'name'         => 'Contact Form 7',
        'slug'         => 'contact-form-7',
        'required'     => false,
      ),
      array(
        'name'         => 'WooCommerce',
        'slug'         => 'woocommerce',
        'required'     => false,
      ),
      array(
        'name'         => 'Cherry Live Demo Mods Switcher',
        'slug'         => 'cherry-ld-mods-switcher',
        'source'       => 'https://danfisher-bucket-2.s3.eu-west-3.amazonaws.com/necromancers/plugins/3N66DmMJukAU/cherry-ld-mods-switcher.zip',
        'required'     => false,
        'version'      => '1.1'
      ),
    );

    // Require SportsPress only if SportsPress Pro is not activated
    if ( ! class_exists( 'SportsPress_Pro' ) ) {
      $plugins[] = array(
        'name'         => 'SportsPress',
        'slug'         => 'sportspress',
        'required'     => true,
        'version'      => '2.7.15',
      );
    }

    $config = array(
      'id'             => 'necromancers',             // Unique ID for hashing notices for multiple instances of TGMPA.
      'default_path'   => '',                         // Default absolute path to pre-packaged plugins
      'menu'           => 'tgmpa-install-plugins',    // Menu slug
      'has_notices'    => true,                       // Show admin notices or not
      'is_automatic'   => true,                       // Automatically activate plugins after installation or not
      'dismissable'    => true,                       // If false, a user cannot dismiss the nag message.
      'dismiss_msg'    => '',                         // If 'dismissable' is false, this message will be output at top of nag.
      'message'        => '',
    );

    tgmpa( $plugins, $config );

  }
}

add_action( 'tgmpa_register', 'necromancers_register_plugins' );


/**
 * Adds plugins depends on selected Sport preset
 */
if ( ! function_exists( 'necromancers_sp_extension_plugins' ) ) {
  function necromancers_sp_extension_plugins() {
    $sport = necromancers_array_value( $_POST, 'sportspress_sport', get_option( 'sportspress_sport', null ) );
    if ( ! $sport ) return;

    $plugins = array();

    if ( 'lol' == $sport || 'csgo' == $sport || 'dota2' == $sport ) {
      $plugins = array(
        array(
          'name'         => 'Necromancers League of Legends for SportsPress',
          'slug'         => 'necromancers-lol',
          'source'       => 'https://danfisher-bucket-2.s3.eu-west-3.amazonaws.com/necromancers/plugins/uFbnybMSmk7f/necromancers-lol.zip',
          'required'     => true,
          'version'      => '1.0.1',
        ),
      );
    }

    $config = array(
      'id'           => 'necromancers',
      'default_path' => '',
      'menu'         => 'tgmpa-install-plugins',
      'has_notices'  => true,
      'dismissable'  => true,
      'is_automatic' => true,
      'message'      => '',
    );

    tgmpa( $plugins, $config );
  }
}
add_action( 'tgmpa_register', 'necromancers_sp_extension_plugins' );
