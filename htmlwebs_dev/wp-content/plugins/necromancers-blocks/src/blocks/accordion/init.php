<?php
/**
 * Accordion Block Init.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'accordion',
  'title'             => esc_html__( 'NCR - Accordion', 'necromancers-blocks' ),
  'description'       => esc_html__( 'An accordion block.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/accordion/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'insert-after',
  'keywords'          => array( 'accordion', 'faq', 'collapse' ),
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ]
]);
