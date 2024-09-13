<?php
/**
 * World Map Block Init.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'world-map',
  'title'             => esc_html__( 'NRC - World Map', 'necromancers-blocks' ),
  'description'       => esc_html__( 'A world map block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/world-map/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'admin-site-alt3',
  'keywords'          => [ 'map', 'world', 'pointer' ],
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ],
]);
