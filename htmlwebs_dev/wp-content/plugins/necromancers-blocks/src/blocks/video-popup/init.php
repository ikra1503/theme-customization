<?php
/**
 * Video Popup Block Init.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'video-popup',
  'title'             => esc_html__( 'NRC - Video Popup', 'necromancers-blocks' ),
  'description'       => esc_html__( 'A video popup block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/video-popup/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'video-alt3',
  'keywords'          => [ 'video', 'clip', 'popup' ],
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ],
]);
