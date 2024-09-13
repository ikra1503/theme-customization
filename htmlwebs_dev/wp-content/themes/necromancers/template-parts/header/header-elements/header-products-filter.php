<?php
/**
 * Header Products Filter
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.2.0
 * @version   1.2.0
 */
?>

<div class="header-filter-toggle">
  <svg role="img" class="df-icon df-icon--filter">
    <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/necromancers.svg#filter"/>
  </svg>
  <div class="filter-menu">
    <form id="necromancers_products_filters" action="#" class="filter-menu__form">
      <?php
      $terms = get_terms( [
        'taxonomy' => 'product_cat',
        'orderby'  => 'name'
      ] );

      if ( $terms ) :
        ?>
        <div class="filter-menu__select">
          <label class="filter-menu__label" for="productCategoryFilter"><?php esc_html_e( 'Category', 'necromancers' ); ?></label>
          <select class="cs-select" name="productCategoryFilter">
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
        <label class="filter-menu__label" for="necromancersProductsSortBy"><?php esc_html_e( 'Sort By', 'necromancers' ); ?></label>
        <?php
        $orderby_options = apply_filters(
          'necromancers_products_filter_sort_by',
          [
            'menu_order' => esc_html__( 'Default sorting', 'necromancers' ),
            'popularity' => esc_html__( 'Sort by popularity', 'necromancers' ),
            'rating'     => esc_html__( 'Sort by average rating', 'necromancers' ),
            'date'       => esc_html__( 'Sort by latest', 'necromancers' ),
            'price'      => esc_html__( 'Sort by price: low to high', 'necromancers' ),
            'price-desc' => esc_html__( 'Sort by price: high to low', 'necromancers' ),
          ] );
        ?>
        <select class="cs-select" name="necromancersProductsSortBy" id="necromancersProductsSortBy">
          <?php
          foreach ( $orderby_options as $value => $label ) {
            $selected_orderby = ( isset( $_GET['orderby'] ) ? selected( $_GET['orderby'], $value ) : '');
            echo '<option value="' . esc_attr( $value ) . '" ' . $selected_orderby . '>' . esc_html( $label ) . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="filter-menu__select">
        <label class="filter-menu__label" for="necromancersProductsView"><?php esc_html_e( 'Per Page', 'necromancers' ); ?></label>
        <select class="cs-select" name="necromancersProductsView" id="necromancersProductsView">
          <option value=""><?php esc_html_e( 'Default', 'necromancers' ); ?></option>
          <option value="6"><?php esc_html_e( '6 per page', 'necromancers' ); ?></option>
          <option value="12"><?php esc_html_e( '12 per page', 'necromancers' ); ?></option>
          <option value="18"><?php esc_html_e( '18 per page', 'necromancers' ); ?></option>
        </select>
      </div>
      <input type="hidden" name="action" value="necromancers_products_filter" />
      <div class="filter-menu__submit">
        <button type="submit" class="btn btn-primary btn-sm btn-block ncr-filter-button">
          <i class="fas fa-circle-notch fa-spin mr-1 d-none ncr-filter-button__icon"></i>
          <span class="ncr-filter-button__txt"><?php esc_html_e( 'Filter Items', 'necromancers' ); ?></span>
        </button>
      </div>
    </form>
  </div>
</div>
