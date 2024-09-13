<?php
/**
 * Button Block Init.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'button',
  'title'             => esc_html__( 'NCR - Button', 'necromancers-blocks' ),
  'description'       => esc_html__( 'A custom button block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/button/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'button',
  'keywords'          => [ 'button', 'btn', 'link' ],
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ]
]);
