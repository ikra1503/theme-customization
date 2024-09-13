<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Euverman & Nuyts
 * @since Euverman & Nuyts 1.0
 */

?>
<?php
session_start();
?>

<head>
    <title>
        <?php bloginfo('name'); ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="shortcut icon" href="images/favicon.svg"> -->
    <!-- Include google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@800&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header id="header">
        <div class="header-top" style="">
            <div class="container">
                <div class="address-info">
                    <ul>

                        <li><i class="icon-truck"></i>Free delivery in <strong>Ahmedabad</strong> (Rs. 3,000+)</li>
                        <li><strong>Gandhinagar</strong> (Rs. 6,000+)</li>
                    </ul>
                    <div class="contact">
                        <a href="mailto:salenagar@gmail.com"><i class="icon-mail"></i>salenagar@gmail.com</a>
                        <a href="tel:911234567890"><i class="icon-call"></i>+91 1234567890</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'main_menu',
                    'container' => 'nav', // you can also set to 'div' or other HTML elements
                    'container_class' => 'main-menu-class', // add classes to the container
                    'menu_class' => 'menu', // add classes to the ul element
                    'fallback_cb' => false, // fallback function if menu doesn't exist
                )
            );
            ?>

            <nav id="mainmenu">
                <div class="categories" data-trigger="all-categories">
                    <a href="#"><span class="hamburger-icon lines"><em class="line"></em></span> All Categories</a>
                </div>
                <ul>
                    <?php
                    $categories = get_terms(
                        array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                        )
                    );
                    foreach ($categories as $category) {
                        ?>
                        <li>
                            <a href="<?php echo esc_url(get_term_link($category)); ?>"
                                title="<?php echo esc_attr($category->name); ?>">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    $cart_items = WC()->cart->get_cart();
                    $product_ids = array();

                    foreach ($cart_items as $cart_item_key => $cart_item) {
                        $product_ids[] = $cart_item['product_id'];
                    }
                    $product_count = count(array_unique($product_ids));
                    ?>
                    <button id="show-mini-cart"><span class="icon-cart"></span>Show Mini Cart (0)
                    </button>
                    <div class="mini-cart" id="mini-cart">

                        <div class="mini-cart-items">
                        </div>
                        <a class="button" href="<?php echo wc_get_cart_url(); ?>">
                            <?php echo __('Go to Cart', 'twentytwentyfour'); ?>
                        </a>
                    </div>
                </ul>
            </nav>

        </div>
        <div class="search-field">
            <?php
            // Check if pincode is available in session
            $pincode = isset($_SESSION['city_name']) ? htmlspecialchars($_SESSION['city_name']) : '';
            ?>
            <input type="text" class="pin-input" placeholder="<?php echo $pincode ? $pincode : 'Enter pincode'; ?>">
            <button name="btn-check" id="btn-check">Done</button>
        </div>

        <div id="city-info"></div>
        <div class="line-bar"></div>
        <div class="search-form">
            <?php get_search_form(); ?>
        </div>
        <div class="recent-search">
            <?php if (isset($_SESSION['search_queries']) && !empty($_SESSION['search_queries'])): ?>
                <div class="recent-searches">
                    <h5>Recent Searches:</h5>
                    <ul>
                        <?php
                        $uniqueSearchQueries = array_unique($_SESSION['search_queries']); // Remove duplicate search queries
                        foreach ($uniqueSearchQueries as $query): ?>
                            <li>
                                <a href="#" class="recent-search-item">
                                    <?php echo htmlspecialchars($query); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="clear-all">
                    <a href="#" id="clearSearches">Clear All Searches</a>
                    <input type="hidden" name="clear-data" value="clear-data">
                </div>
            <?php endif; ?>
        </div>
    </header>