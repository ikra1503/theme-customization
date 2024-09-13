<?php
/**
 * Icon Block Init.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'icon',
  'title'             => esc_html__( 'NRC - Icon', 'necromancers-blocks' ),
  'description'       => esc_html__( 'An icon block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/icon/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'lightbulb',
  'keywords'          => [ 'icon' ],
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ],
]);
