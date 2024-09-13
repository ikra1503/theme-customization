<?php
/**
 * Social Links Block Init.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'social-links',
  'title'             => esc_html__( 'NCR - Social Links', 'necromancers-blocks' ),
  'description'       => esc_html__( 'A social links block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/social-links/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'share',
  'keywords'          => [ 'social', 'link', 'network' ],
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ],
]);
