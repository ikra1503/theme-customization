<?php
/**
 * Heading Lead Block Init.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'heading-lead',
  'title'             => esc_html__( 'NCR - Heading Lead', 'necromancers-blocks' ),
  'description'       => esc_html__( 'A custom heading block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/heading-lead/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'heading',
  'keywords'          => [ 'heading', 'title', 'text' ],
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ],
]);
