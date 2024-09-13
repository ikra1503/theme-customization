<?php
/**
 * Button Alert Init
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'alert',
  'title'             => esc_html__( 'NCR - Alert', 'necromancers-blocks' ),
  'description'       => esc_html__( 'A custom alert block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/alert/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'info-outline',
  'keywords'          => [ 'alert', 'info', 'box' ],
  'align'             => false,
  'enqueue_style'     => get_theme_file_uri() . '/assets/vendor/fontawesome/css/all.css',
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ]
]);
