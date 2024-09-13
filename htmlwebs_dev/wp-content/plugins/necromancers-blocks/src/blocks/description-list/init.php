<?php
/**
 * Description List Block Init.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'description-list',
  'title'             => esc_html__( 'NCR - Description List', 'necromancers-blocks' ),
  'description'       => esc_html__( 'A description List block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/description-list/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'list-view',
  'keywords'          => [ 'description', 'list', 'dl' ],
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ],
  'enqueue_assets'    => function() {
    wp_enqueue_script(
      'necromancers-dl-init',
      NCR_BLOCKS_URL . 'src/blocks/description-list/js/init.js',
      [ 'jquery' ],
      '1.0.0',
      true
    );
  },
]);
