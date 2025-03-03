<?php
/**
 * Header Template for Twenty Twenty-Four Child Theme
 *
 * @package TwentyTwentyFour Child
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="fac.css"> -->
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <!-- Load WordPress Head Functions -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    $header_logo = get_field('header_logo', 'option');
    $header_logo = is_array($header_logo) ? $header_logo : [];
    $header_logoUrl = $header_logo['url'];
    $header_logoTitle = $header_logo['title'];
    $get_started_button = get_field('get_started_button', 'option');
    $get_started_button = is_array($get_started_button) ? $get_started_button : [];
    $get_started_buttonUrl = $get_started_button['url'];
    $get_started_buttonTarget = $get_started_button['target'];
    $get_started_buttonTitle = $get_started_button['title'];
    ?>
    <!-- Header -->
    <section class="header">
        <div class="container">
            <nav>
                <!-- Logo -->
                <?php if ($header_logoUrl): ?>
                    <div class="fac-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo $header_logoUrl; ?>" alt="<?php echo $header_logoTitle; ?>">
                        </a>
                    </div>
                <?php endif; ?>
                <!-- Mobile Menu Toggle -->
                <div class="menu-toggle" onclick="toggleMenu()">
                    <i class="fa-solid fa-bars"></i>
                </div>

                <div class="nav-links">
                    <div class="menu-close" onclick="toggleMenu()">
                        <i class="fa-solid fa-times"></i>
                    </div>

                    <!-- WordPress Navigation Menu -->
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary-menu',
                        'menu_class' => 'nav-link',
                        'container' => false,
                        'fallback_cb' => false,
                    ]);
                    ?>

                    <!-- Get Started Button -->
                    <?php if ($get_started_buttonUrl): ?>
                        <div class="get-start-btn">
                            <button><a href="<?php echo $get_started_buttonUrl; ?>"
                                    target="<?php echo $get_started_buttonTarget; ?>"><?php echo $get_started_buttonTitle; ?></a></button>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </section>