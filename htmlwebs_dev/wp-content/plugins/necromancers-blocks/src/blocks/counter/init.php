<?php
/**
 * Counter Block Init.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'counter',
  'title'             => esc_html__( 'NRC - Counter', 'necromancers-blocks' ),
  'description'       => esc_html__( 'A custom counter block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/counter/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'chart-pie',
  'keywords'          => [ 'counter', 'count', 'number' ],
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ],
  'enqueue_assets'    => function() {
    wp_enqueue_script(
      'necromancers-waypoints',
      NCR_BLOCKS_URL . 'src/blocks/counter/js/jquery.waypoints.min.js',
      [ 'jquery' ],
      '4.0.1',
      true
    );
    wp_enqueue_script(
      'necromancers-counterup',
      NCR_BLOCKS_URL . 'src/blocks/counter/js/jquery.counterup.min.js',
      [ 'jquery' ],
      '2.1.0',
      true
    );
    wp_enqueue_script(
      'necromancers-counterup-init',
      NCR_BLOCKS_URL . 'src/blocks/counter/js/init.js',
      [ 'necromancers-counterup' ],
      '1.0.0',
      true
    );
  },
]);
