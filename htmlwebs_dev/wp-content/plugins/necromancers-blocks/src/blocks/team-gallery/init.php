<?php
/**
 * SportsPress: Team Gallery.
 *
 * @author    Dan Fisher
 * @package   Necromancers Blocks
 * @since     1.0.0
 * @version   1.1.0
 */

acf_register_block_type([
  'name'              => 'team-gallery',
  'title'             => esc_html__( 'NCR - Team Gallery', 'necromancers-blocks' ),
  'description'       => esc_html__( 'A custom team gallery.', 'necromancers-blocks' ),
  'render_template'   => NCR_BLOCKS_DIR . 'src/blocks/team-gallery/template.php',
  'category'          => 'necromancers-blocks',
  'icon'              => 'shield-alt',
  'keywords'          => [ 'sportspress', 'esports', 'team', 'gallery', 'selection' ],
  'align'             => false,
  'example'           => [
    'attributes' => [
      'mode' => 'preview',
      'data' => [ 'is_preview' => true ],
    ]
  ],
]);
