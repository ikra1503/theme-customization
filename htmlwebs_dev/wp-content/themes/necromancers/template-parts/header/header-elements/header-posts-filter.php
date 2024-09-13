<?php
/**
 * Header Posts Filter
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */
?>

<div class="header-filter-toggle">
  <svg role="img" class="df-icon df-icon--filter">
    <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#filter"/>
  </svg>
  <div class="filter-menu">
    <form id="necromancers_filters" action="#" class="filter-menu__form">
      <?php
      if ( $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name' ) ) ) :
        ?>
        <div class="filter-menu__select">
          <label class="filter-menu__label" for="categoryfilter"><?php esc_html_e( 'Category', 'necromancers' ); ?></label>
          <select class="cs-select" name="categoryfilter">
            <option value=""><?php esc_html_e( 'All Categories', 'necromancers' ); ?></option>
            <?php
            // ID of the category as the value of an option
            foreach ( $terms as $term ) :
              echo '<option value="' . esc_attr( $term->term_id ) . '">' . esc_html( $term->name ) . '</option>';
            endforeach;
            ?>
          </select>
        </div>
        <?php
      endif;
      ?>
      <div class="filter-menu__select">
        <label class="filter-menu__label" for="necromancers_order_by"><?php esc_html_e( 'Filter By', 'necromancers' ); ?></label>
        <?php
        $orderby_options = apply_filters(
          'necromancers_post_filter_order_by',
          [
            'post_date'     => esc_html__( 'Article Date', 'necromancers' ),
            'comment_count' => esc_html__( 'Comments', 'necromancers' ),
            'rand'          => esc_html__( 'Random', 'necromancers' ),
          ] );
        ?>
        <select class="cs-select" name="necromancers_order_by" id="necromancers_order_by">
          <?php
          foreach ( $orderby_options as $value => $label ) {
            $selected_orderby = ( isset( $_GET['orderby'] ) ? selected( $_GET['orderby'], $value ) : '');
            echo '<option value="' . esc_attr( $value ) . '" ' . $selected_orderby . '>' . esc_html( $label ) . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="filter-menu__select">
        <label class="filter-menu__label" for="necromancers_order"><?php esc_html_e( 'Order', 'necromancers' ); ?></label>
        <select class="cs-select" name="necromancers_order" id="necromancers_order">
          <option value="DESC"><?php esc_html_e( 'Descending', 'necromancers' ); ?></option>
          <option value="ASC"><?php esc_html_e( 'Ascending', 'necromancers' ); ?></option>
        </select>
      </div>
      <input type="hidden" name="action" value="necromancersfilter" />
      <input type="hidden" name="necromancers_blog_page_layout" value="<?php echo get_theme_mod( 'necromancers_blog_page_layout', 'default' ); ?>" />
      <div class="filter-menu__submit">
        <button type="submit" class="btn btn-primary btn-sm btn-block ncr-filter-button">
          <i class="fas fa-circle-notch fa-spin mr-1 d-none ncr-filter-button__icon"></i>
          <span class="ncr-filter-button__txt"><?php esc_html_e( 'Filter News', 'necromancers' ); ?></span>
        </button>
      </div>
    </form>
  </div>
</div>
